<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Exception;
use ZipArchive;
use SimpleXMLElement;
use PDO;

class BackupService
{
    /**
     * Directory path for storing backup files.
     */
    protected string $backupDir;

    public function __construct()
    {
        $this->backupDir = storage_path('app/backups');
        if (!File::exists($this->backupDir)) {
            File::makeDirectory($this->backupDir, 0755, true);
        }
    }

    /**
     * Get list of all tables in the current database with statistics.
     */
    public function getTablesInfo(): array
    {
        $databaseName = DB::connection()->getDatabaseName();
        $tables = [];

        try {
            $rawTables = DB::select("
                SELECT 
                    TABLE_NAME AS name,
                    ENGINE AS engine,
                    TABLE_ROWS AS row_count,
                    DATA_LENGTH AS data_size,
                    INDEX_LENGTH AS index_size,
                    (DATA_LENGTH + INDEX_LENGTH) AS total_size,
                    TABLE_COLLATION AS collation,
                    TABLE_COMMENT AS comment
                FROM information_schema.TABLES
                WHERE TABLE_SCHEMA = ?
                ORDER BY TABLE_NAME ASC
            ", [$databaseName]);

            foreach ($rawTables as $table) {
                // Get exact count if TABLE_ROWS is approximate (InnoDB)
                $exactCount = DB::table($table->name)->count();

                $tables[] = [
                    'name' => $table->name,
                    'engine' => $table->engine ?? 'InnoDB',
                    'rows' => $exactCount,
                    'data_size' => (int) ($table->data_size ?? 0),
                    'index_size' => (int) ($table->index_size ?? 0),
                    'total_size' => (int) ($table->total_size ?? 0),
                    'formatted_size' => $this->formatBytes((int) ($table->total_size ?? 0)),
                    'collation' => $table->collation ?? 'utf8mb4_unicode_ci',
                ];
            }
        } catch (Exception $e) {
            // Fallback for simple SHOW TABLES
            $rawTables = DB::select('SHOW TABLES');
            $key = "Tables_in_{$databaseName}";
            foreach ($rawTables as $row) {
                $tableName = $row->$key ?? current((array)$row);
                $count = DB::table($tableName)->count();
                $tables[] = [
                    'name' => $tableName,
                    'engine' => 'InnoDB',
                    'rows' => $count,
                    'data_size' => 0,
                    'index_size' => 0,
                    'total_size' => 0,
                    'formatted_size' => '-',
                    'collation' => 'utf8mb4_unicode_ci',
                ];
            }
        }

        return $tables;
    }

    /**
     * Get database summary statistics.
     */
    public function getDatabaseSummary(): array
    {
        $databaseName = DB::connection()->getDatabaseName();
        $tables = $this->getTablesInfo();

        $totalRows = array_sum(array_column($tables, 'rows'));
        $totalSizeBytes = array_sum(array_column($tables, 'total_size'));

        return [
            'database' => $databaseName,
            'driver' => DB::connection()->getDriverName(),
            'host' => config('database.connections.mysql.host', '127.0.0.1'),
            'total_tables' => count($tables),
            'total_rows' => $totalRows,
            'total_size_bytes' => $totalSizeBytes,
            'total_size_formatted' => $this->formatBytes($totalSizeBytes),
            'tables' => $tables,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | MySQL SQL Backup & Restore (Export & Import)
    |--------------------------------------------------------------------------
    */

    /**
     * Generate complete MySQL SQL Dump.
     */
    public function generateSqlDump(?array $selectedTables = null, bool $includeStructure = true, bool $includeData = true, ?string $outputPath = null): string
    {
        $databaseName = DB::connection()->getDatabaseName();
        $allTables = array_column($this->getTablesInfo(), 'name');
        
        $tablesToDump = !empty($selectedTables) 
            ? array_intersect($allTables, $selectedTables) 
            : $allTables;

        $fp = null;
        $sqlBuffer = '';

        if ($outputPath) {
            $fp = fopen($outputPath, 'w');
        }

        $write = function (string $text) use (&$sqlBuffer, $fp) {
            if ($fp) {
                fwrite($fp, $text);
            } else {
                $sqlBuffer .= $text;
            }
        };

        // Header Comments & Environment setup
        $now = date('Y-m-d H:i:s');
        $write("-- ========================================================\n");
        $write("-- Database Backup for: `{$databaseName}`\n");
        $write("-- Generated At: {$now}\n");
        $write("-- Application: PT Ortotik & Prostetik Indonesia (pediOcare)\n");
        $write("-- Tables Dumped: " . count($tablesToDump) . "\n");
        $write("-- ========================================================\n\n");

        $write("/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n");
        $write("/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n");
        $write("/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n");
        $write("/*!40101 SET NAMES utf8mb4 */;\n");
        $write("/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;\n");
        $write("/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;\n");
        $write("/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;\n");
        $write("/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;\n\n");

        $pdo = DB::connection()->getPdo();

        foreach ($tablesToDump as $tableName) {
            $write("\n-- --------------------------------------------------------\n");
            $write("-- Table structure and data for table `{$tableName}`\n");
            $write("-- --------------------------------------------------------\n\n");

            if ($includeStructure) {
                $write("DROP TABLE IF EXISTS `{$tableName}`;\n");
                $createTableQuery = DB::select("SHOW CREATE TABLE `{$tableName}`");
                if (!empty($createTableQuery)) {
                    $createStatement = $createTableQuery[0]->{'Create Table'} ?? current((array)$createTableQuery[0]);
                    $write($createStatement . ";\n\n");
                }
            }

            if ($includeData) {
                $totalRows = DB::table($tableName)->count();
                if ($totalRows > 0) {
                    $write("/*!40000 ALTER TABLE `{$tableName}` DISABLE KEYS */;\n");
                    
                    // Fetch in chunks of 500 rows to optimize memory
                    DB::table($tableName)->orderBy(DB::raw('1'))->chunk(500, function ($rows) use ($write, $tableName, $pdo) {
                        if ($rows->isEmpty()) {
                            return;
                        }

                        $firstRow = (array) $rows->first();
                        $columns = array_keys($firstRow);
                        $columnsEscaped = array_map(fn($col) => "`" . str_replace("`", "``", $col) . "`", $columns);
                        $columnsList = implode(', ', $columnsEscaped);

                        $write("INSERT INTO `{$tableName}` ({$columnsList}) VALUES\n");

                        $rowCount = count($rows);
                        $idx = 0;
                        foreach ($rows as $row) {
                            $idx++;
                            $values = [];
                            foreach ($columns as $col) {
                                $val = $row->$col ?? null;
                                if ($val === null) {
                                    $values[] = "NULL";
                                } elseif (is_numeric($val) && !is_string($val)) {
                                    $values[] = $val;
                                } else {
                                    $values[] = $pdo->quote((string)$val);
                                }
                            }

                            $write("(" . implode(', ', $values) . ")");
                            $write($idx === $rowCount ? ";\n" : ",\n");
                        }
                    });

                    $write("/*!40000 ALTER TABLE `{$tableName}` ENABLE KEYS */;\n\n");
                }
            }
        }

        // Footer setup
        $write("\n-- ========================================================\n");
        $write("/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;\n");
        $write("/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;\n");
        $write("/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;\n");
        $write("/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\n");
        $write("/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\n");
        $write("/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;\n");
        $write("/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;\n");
        $write("-- Dump completed on {$now}\n");

        if ($fp) {
            fclose($fp);
            return $outputPath;
        }

        return $sqlBuffer;
    }

    /**
     * Import / Restore MySQL Database from SQL file.
     */
    public function importSqlFile(string $sqlFilePath): array
    {
        if (!File::exists($sqlFilePath)) {
            throw new Exception("File SQL tidak ditemukan: {$sqlFilePath}");
        }

        $startTime = microtime(true);
        $executedQueries = 0;

        $pdo = DB::connection()->getPdo();
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
        $pdo->exec("SET FOREIGN_KEY_CHECKS=0;");
        $pdo->exec("SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';");

        $handle = fopen($sqlFilePath, 'r');
        if (!$handle) {
            throw new Exception("Gagal membuka file SQL untuk dibaca.");
        }

        $query = '';
        $inMultiLineComment = false;

        try {
            while (($line = fgets($handle)) !== false) {
                $trimmed = trim($line);

                // Handle multi-line comments
                if ($inMultiLineComment) {
                    if (str_contains($line, '*/')) {
                        $inMultiLineComment = false;
                    }
                    continue;
                }
                if (str_starts_with($trimmed, '/*') && !str_starts_with($trimmed, '/*!')) {
                    if (!str_contains($line, '*/')) {
                        $inMultiLineComment = true;
                    }
                    continue;
                }

                // Ignore single line comments and empty lines
                if ($trimmed === '' || str_starts_with($trimmed, '--') || str_starts_with($trimmed, '#')) {
                    continue;
                }

                $query .= $line;

                // Check if query ends with semicolon
                if (str_ends_with($trimmed, ';')) {
                    $pdo->exec($query);
                    $executedQueries++;
                    $query = '';
                }
            }

            // Execute any remaining query
            if (trim($query) !== '') {
                $pdo->exec($query);
                $executedQueries++;
            }

            fclose($handle);
        } catch (Exception $e) {
            if ($handle) fclose($handle);
            $pdo->exec("SET FOREIGN_KEY_CHECKS=1;");
            Log::error("BackupService SQL Import Error: " . $e->getMessage());
            throw new Exception("Gagal merestore database: " . $e->getMessage());
        } finally {
            $pdo->exec("SET FOREIGN_KEY_CHECKS=1;");
        }

        $duration = round(microtime(true) - $startTime, 2);

        return [
            'success' => true,
            'queries_executed' => $executedQueries,
            'duration_seconds' => $duration,
            'message' => "Database berhasil direstore ({$executedQueries} query dalam {$duration} detik).",
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Excel (.xlsx / .csv / .zip) Export & Import
    |--------------------------------------------------------------------------
    */

    /**
     * Export Single Table to CSV with UTF-8 BOM.
     */
    public function exportTableToCsv(string $tableName, ?string $outputPath = null): string
    {
        $rows = DB::table($tableName)->get();
        
        $fp = null;
        $csvBuffer = '';
        if ($outputPath) {
            $fp = fopen($outputPath, 'w');
        } else {
            $fp = fopen('php://memory', 'r+');
        }

        // Add UTF-8 BOM for Microsoft Excel compatibility
        fwrite($fp, "\xEF\xBB\xBF");

        if ($rows->isNotEmpty()) {
            $columns = array_keys((array)$rows->first());
            fputcsv($fp, $columns);

            foreach ($rows as $row) {
                $values = array_map(fn($v) => is_null($v) ? '' : (string)$v, (array)$row);
                fputcsv($fp, $values);
            }
        } else {
            // Write column headers from table schema if empty
            $columns = Schema::getColumnListing($tableName);
            fputcsv($fp, $columns);
        }

        if (!$outputPath) {
            rewind($fp);
            $csvBuffer = stream_get_contents($fp);
            fclose($fp);
            return $csvBuffer;
        }

        fclose($fp);
        return $outputPath;
    }

    /**
     * Export All Tables to a ZIP archive containing individual Excel-compatible CSVs.
     */
    public function exportAllTablesToZip(?array $selectedTables = null, ?string $outputPath = null): string
    {
        $allTables = array_column($this->getTablesInfo(), 'name');
        $tablesToExport = !empty($selectedTables) ? array_intersect($allTables, $selectedTables) : $allTables;

        if (!$outputPath) {
            $databaseName = DB::connection()->getDatabaseName();
            $timestamp = date('Y-m-d_His');
            $outputPath = $this->backupDir . "/backup-excel-all-{$databaseName}-{$timestamp}.zip";
        }

        $zip = new ZipArchive();
        if ($zip->open($outputPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new Exception("Gagal membuat file ZIP untuk export Excel.");
        }

        foreach ($tablesToExport as $table) {
            $csvContent = $this->exportTableToCsv($table);
            $zip->addFromString("{$table}.csv", $csvContent);
        }

        $zip->close();
        return $outputPath;
    }

    /**
     * Export Table(s) to native OpenXML Excel (.xlsx).
     * Supports single table or multi-sheet workbook for all tables.
     */
    public function exportToXlsx(?string $singleTable = null, ?array $selectedTables = null, ?string $outputPath = null): string
    {
        $databaseName = DB::connection()->getDatabaseName();
        $timestamp = date('Y-m-d_His');

        if (!$outputPath) {
            $nameSuffix = $singleTable ? "table-{$singleTable}" : "all-tables";
            $outputPath = $this->backupDir . "/backup-excel-{$nameSuffix}-{$databaseName}-{$timestamp}.xlsx";
        }

        $tables = [];
        if ($singleTable) {
            $tables[] = $singleTable;
        } else {
            $allTables = array_column($this->getTablesInfo(), 'name');
            $tables = !empty($selectedTables) ? array_intersect($allTables, $selectedTables) : $allTables;
        }

        $zip = new ZipArchive();
        if ($zip->open($outputPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new Exception("Gagal membuat file OpenXML XLSX.");
        }

        // 1. [Content_Types].xml
        $contentTypes = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";
        $contentTypes .= '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">' . "\n";
        $contentTypes .= '  <Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>' . "\n";
        $contentTypes .= '  <Default Extension="xml" ContentType="application/xml"/>' . "\n";
        $contentTypes .= '  <Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>' . "\n";
        $contentTypes .= '  <Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>' . "\n";
        foreach ($tables as $index => $t) {
            $sheetNum = $index + 1;
            $contentTypes .= '  <Override PartName="/xl/worksheets/sheet' . $sheetNum . '.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>' . "\n";
        }
        $contentTypes .= '</Types>';
        $zip->addFromString('[Content_Types].xml', $contentTypes);

        // 2. _rels/.rels
        $rootRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";
        $rootRels .= '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">' . "\n";
        $rootRels .= '  <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>' . "\n";
        $rootRels .= '</Relationships>';
        $zip->addFromString('_rels/.rels', $rootRels);

        // 3. xl/_rels/workbook.xml.rels
        $wbRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";
        $wbRels .= '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">' . "\n";
        $wbRels .= '  <Relationship Id="rIdStyles" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>' . "\n";
        foreach ($tables as $index => $t) {
            $sheetNum = $index + 1;
            $rId = 'rId' . ($sheetNum + 10);
            $wbRels .= '  <Relationship Id="' . $rId . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet' . $sheetNum . '.xml"/>' . "\n";
        }
        $wbRels .= '</Relationships>';
        $zip->addFromString('xl/_rels/workbook.xml.rels', $wbRels);

        // 4. xl/workbook.xml
        $workbook = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";
        $workbook .= '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">' . "\n";
        $workbook .= '  <sheets>' . "\n";
        foreach ($tables as $index => $tableName) {
            $sheetNum = $index + 1;
            $rId = 'rId' . ($sheetNum + 10);
            // Excel sheet names max 31 chars and no special chars
            $sheetName = substr(preg_replace('/[\\\\\/\?\*\[\]\:]/', '', $tableName), 0, 31);
            $workbook .= '    <sheet name="' . htmlspecialchars($sheetName, ENT_XML1) . '" sheetId="' . $sheetNum . '" r:id="' . $rId . '"/>' . "\n";
        }
        $workbook .= '  </sheets>' . "\n";
        $workbook .= '</workbook>';
        $zip->addFromString('xl/workbook.xml', $workbook);

        // 5. xl/styles.xml
        $styles = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";
        $styles .= '<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">' . "\n";
        $styles .= '  <fonts count="2">' . "\n";
        $styles .= '    <font><sz val="11"/><color rgb="FF000000"/><name val="Segoe UI"/></font>' . "\n";
        $styles .= '    <font><b/><sz val="11"/><color rgb="FFFFFFFF"/><name val="Segoe UI"/></font>' . "\n";
        $styles .= '  </fonts>' . "\n";
        $styles .= '  <fills count="3">' . "\n";
        $styles .= '    <fill><patternFill patternType="none"/></fill>' . "\n";
        $styles .= '    <fill><patternFill patternType="gray125"/></fill>' . "\n";
        $styles .= '    <fill><patternFill patternType="solid"><fgColor rgb="FF0F4C81"/></patternFill></fill>' . "\n"; // Medical blue header
        $styles .= '  </fills>' . "\n";
        $styles .= '  <borders count="2">' . "\n";
        $styles .= '    <border><left/><right/><top/><bottom/></border>' . "\n";
        $styles .= '    <border><left style="thin"><color rgb="FFCBD5E1"/></left><right style="thin"><color rgb="FFCBD5E1"/></right><top style="thin"><color rgb="FFCBD5E1"/></top><bottom style="thin"><color rgb="FFCBD5E1"/></bottom></border>' . "\n";
        $styles .= '  </borders>' . "\n";
        $styles .= '  <cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>' . "\n";
        $styles .= '  <cellXfs count="3">' . "\n";
        $styles .= '    <xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>' . "\n"; // Standard cell (idx 0)
        $styles .= '    <xf numFmtId="0" fontId="1" fillId="2" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center"/></xf>' . "\n"; // Header cell (idx 1)
        $styles .= '    <xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyBorder="1"/>' . "\n"; // Data cell with border (idx 2)
        $styles .= '  </cellXfs>' . "\n";
        $styles .= '</styleSheet>';
        $zip->addFromString('xl/styles.xml', $styles);

        // 6. Generate each sheet XML
        foreach ($tables as $index => $tableName) {
            $sheetNum = $index + 1;
            $sheetXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";
            $sheetXml .= '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">' . "\n";
            $sheetXml .= '  <sheetData>' . "\n";

            $rows = DB::table($tableName)->get();
            $columns = $rows->isNotEmpty() ? array_keys((array)$rows->first()) : Schema::getColumnListing($tableName);

            // Row 1: Header Row
            $sheetXml .= '    <row r="1" ht="24" customHeight="1">' . "\n";
            foreach ($columns as $colIdx => $colName) {
                $cellRef = $this->getColumnLetter($colIdx + 1) . '1';
                $sheetXml .= '      <c r="' . $cellRef . '" t="inlineStr" s="1"><is><t>' . htmlspecialchars($colName, ENT_XML1) . '</t></is></c>' . "\n";
            }
            $sheetXml .= '    </row>' . "\n";

            // Data Rows
            $rowNumber = 2;
            foreach ($rows as $row) {
                $sheetXml .= '    <row r="' . $rowNumber . '">' . "\n";
                $rowArray = (array)$row;
                foreach ($columns as $colIdx => $colName) {
                    $cellRef = $this->getColumnLetter($colIdx + 1) . $rowNumber;
                    $val = $rowArray[$colName] ?? null;

                    if (is_null($val)) {
                        $sheetXml .= '      <c r="' . $cellRef . '" s="2"/>' . "\n";
                    } elseif (is_numeric($val) && !str_starts_with((string)$val, '0') && strlen((string)$val) < 15) {
                        $sheetXml .= '      <c r="' . $cellRef . '" s="2"><v>' . $val . '</v></c>' . "\n";
                    } else {
                        $safeVal = htmlspecialchars((string)$val, ENT_XML1);
                        $sheetXml .= '      <c r="' . $cellRef . '" t="inlineStr" s="2"><is><t>' . $safeVal . '</t></is></c>' . "\n";
                    }
                }
                $sheetXml .= '    </row>' . "\n";
                $rowNumber++;
            }

            $sheetXml .= '  </sheetData>' . "\n";
            $sheetXml .= '</worksheet>';
            $zip->addFromString("xl/worksheets/sheet{$sheetNum}.xml", $sheetXml);
        }

        $zip->close();
        return $outputPath;
    }

    /**
     * Convert 1-based column index to Excel column letters (A, B, ..., Z, AA, AB, etc.).
     */
    protected function getColumnLetter(int $colIndex): string
    {
        $letter = '';
        while ($colIndex > 0) {
            $modulo = ($colIndex - 1) % 26;
            $letter = chr(65 + $modulo) . $letter;
            $colIndex = (int)(($colIndex - $modulo) / 26);
        }
        return $letter;
    }

    /**
     * Import Excel (.xlsx / .csv / .zip) file into database tables.
     */
    public function importExcelFile(string $filePath, ?string $targetTable = null, string $mode = 'append'): array
    {
        if (!File::exists($filePath)) {
            throw new Exception("File tidak ditemukan: {$filePath}");
        }

        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if ($ext === 'csv') {
            $tableName = $targetTable ?: pathinfo($filePath, PATHINFO_FILENAME);
            return $this->importCsvToTable($filePath, $tableName, $mode);
        } elseif ($ext === 'zip') {
            return $this->importZipOfCsvs($filePath, $mode);
        } elseif ($ext === 'xlsx') {
            return $this->importXlsxFile($filePath, $targetTable, $mode);
        } else {
            throw new Exception("Format file tidak didukung. Harap upload file .xlsx, .csv, atau .zip.");
        }
    }

    /**
     * Import CSV into a specific table.
     */
    public function importCsvToTable(string $csvPath, string $tableName, string $mode = 'append'): array
    {
        if (!Schema::hasTable($tableName)) {
            throw new Exception("Tabel `{$tableName}` tidak ditemukan dalam database.");
        }

        $handle = fopen($csvPath, 'r');
        if (!$handle) {
            throw new Exception("Gagal membuka file CSV.");
        }

        // Read first bytes to detect BOM and skip it
        $bom = fread($handle, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($handle);
        }

        // Read Header
        $header = fgetcsv($handle, 0, ',');
        if (!$header) {
            fclose($handle);
            throw new Exception("File CSV kosong atau tidak memiliki header.");
        }

        // Trim column names
        $header = array_map('trim', $header);
        $validTableColumns = Schema::getColumnListing($tableName);
        $matchedColumns = array_intersect($header, $validTableColumns);

        if (empty($matchedColumns)) {
            fclose($handle);
            throw new Exception("Header CSV tidak cocok dengan kolom apapun pada tabel `{$tableName}`.");
        }

        $pdo = DB::connection()->getPdo();
        $pdo->exec("SET FOREIGN_KEY_CHECKS=0;");

        if ($mode === 'replace') {
            DB::table($tableName)->truncate();
        }

        $rowsToInsert = [];
        $importedCount = 0;

        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            if (count($row) === 1 && is_null($row[0])) {
                continue; // Skip empty rows
            }

            $record = [];
            foreach ($header as $index => $col) {
                if (in_array($col, $validTableColumns) && isset($row[$index])) {
                    $val = trim($row[$index]);
                    $record[$col] = $val === '' ? null : $val;
                }
            }

            if (!empty($record)) {
                $rowsToInsert[] = $record;
                $importedCount++;

                if (count($rowsToInsert) >= 200) {
                    DB::table($tableName)->insert($rowsToInsert);
                    $rowsToInsert = [];
                }
            }
        }

        if (!empty($rowsToInsert)) {
            DB::table($tableName)->insert($rowsToInsert);
        }

        fclose($handle);
        $pdo->exec("SET FOREIGN_KEY_CHECKS=1;");

        return [
            'success' => true,
            'table' => $tableName,
            'rows_imported' => $importedCount,
            'message' => "Berhasil mengimpor {$importedCount} data ke tabel `{$tableName}`.",
        ];
    }

    /**
     * Import a ZIP archive containing multiple CSVs for each table.
     */
    public function importZipOfCsvs(string $zipPath, string $mode = 'append'): array
    {
        $zip = new ZipArchive();
        if ($zip->open($zipPath) !== true) {
            throw new Exception("Gagal membuka file ZIP.");
        }

        $tempExtractDir = storage_path('app/temp_import_' . uniqid());
        File::makeDirectory($tempExtractDir, 0755, true);
        $zip->extractTo($tempExtractDir);
        $zip->close();

        $results = [];
        $totalImported = 0;

        $files = File::files($tempExtractDir);
        foreach ($files as $file) {
            $tableName = $file->getFilenameWithoutExtension();
            if (Schema::hasTable($tableName)) {
                $res = $this->importCsvToTable($file->getRealPath(), $tableName, $mode);
                $results[$tableName] = $res['rows_imported'];
                $totalImported += $res['rows_imported'];
            }
        }

        File::deleteDirectory($tempExtractDir);

        return [
            'success' => true,
            'tables_imported' => count($results),
            'total_rows_imported' => $totalImported,
            'details' => $results,
            'message' => "Berhasil mengimpor total {$totalImported} data ke " . count($results) . " tabel.",
        ];
    }

    /**
     * Import native OpenXML XLSX file.
     */
    public function importXlsxFile(string $xlsxPath, ?string $targetTable = null, string $mode = 'append'): array
    {
        $zip = new ZipArchive();
        if ($zip->open($xlsxPath) !== true) {
            throw new Exception("Gagal membuka file Excel XLSX.");
        }

        // Read workbook to map sheets
        $workbookXmlContent = $zip->getFromName('xl/workbook.xml');
        if (!$workbookXmlContent) {
            $zip->close();
            throw new Exception("Struktur file XLSX tidak valid (xl/workbook.xml hilang).");
        }

        $wbXml = new SimpleXMLElement($workbookXmlContent);
        $sheets = [];
        $sheetIndex = 1;
        foreach ($wbXml->sheets->sheet as $sheet) {
            $name = (string)$sheet['name'];
            $sheets[] = [
                'name' => $name,
                'file' => "xl/worksheets/sheet{$sheetIndex}.xml"
            ];
            $sheetIndex++;
        }

        // Shared strings if any
        $sharedStrings = [];
        $sharedStringsXml = $zip->getFromName('xl/sharedStrings.xml');
        if ($sharedStringsXml) {
            $ssXml = new SimpleXMLElement($sharedStringsXml);
            foreach ($ssXml->si as $si) {
                $sharedStrings[] = (string)($si->t ?? $si->r->t ?? '');
            }
        }

        $totalImported = 0;
        $tablesImported = 0;
        $pdo = DB::connection()->getPdo();
        $pdo->exec("SET FOREIGN_KEY_CHECKS=0;");

        try {
            foreach ($sheets as $sheetMeta) {
                $tableName = $targetTable ?: $sheetMeta['name'];
                if (!Schema::hasTable($tableName)) {
                    continue;
                }

                $sheetXmlContent = $zip->getFromName($sheetMeta['file']);
                if (!$sheetXmlContent) {
                    continue;
                }

                $sheetXml = new SimpleXMLElement($sheetXmlContent);
                $rows = $sheetXml->sheetData->row;

                if (count($rows) === 0) {
                    continue;
                }

                // Header row
                $headerRow = $rows[0];
                $header = [];
                foreach ($headerRow->c as $cell) {
                    $header[] = $this->extractCellValue($cell, $sharedStrings);
                }

                $validColumns = Schema::getColumnListing($tableName);

                if ($mode === 'replace') {
                    DB::table($tableName)->truncate();
                }

                $rowsToInsert = [];
                for ($i = 1; $i < count($rows); $i++) {
                    $row = $rows[$i];
                    $record = [];
                    $cellIdx = 0;

                    foreach ($row->c as $cell) {
                        $colName = $header[$cellIdx] ?? null;
                        if ($colName && in_array($colName, $validColumns)) {
                            $val = $this->extractCellValue($cell, $sharedStrings);
                            $record[$colName] = $val === '' ? null : $val;
                        }
                        $cellIdx++;
                    }

                    if (!empty($record)) {
                        $rowsToInsert[] = $record;
                        $totalImported++;

                        if (count($rowsToInsert) >= 200) {
                            DB::table($tableName)->insert($rowsToInsert);
                            $rowsToInsert = [];
                        }
                    }
                }

                if (!empty($rowsToInsert)) {
                    DB::table($tableName)->insert($rowsToInsert);
                }

                $tablesImported++;
            }
        } finally {
            $zip->close();
            $pdo->exec("SET FOREIGN_KEY_CHECKS=1;");
        }

        return [
            'success' => true,
            'tables_imported' => $tablesImported,
            'total_rows_imported' => $totalImported,
            'message' => "Berhasil mengimpor {$totalImported} baris data ke {$tablesImported} tabel dari file Excel.",
        ];
    }

    /**
     * Extract cell value from OpenXML cell element.
     */
    protected function extractCellValue(SimpleXMLElement $cell, array $sharedStrings): string
    {
        $type = (string)$cell['t'];

        if ($type === 's') { // Shared String
            $index = (int)$cell->v;
            return $sharedStrings[$index] ?? '';
        } elseif ($type === 'inlineStr') {
            return (string)$cell->is->t;
        } elseif (isset($cell->v)) {
            return (string)$cell->v;
        }

        return '';
    }

    /*
    |--------------------------------------------------------------------------
    | Backup Storage & History Management
    |--------------------------------------------------------------------------
    */

    /**
     * List all stored backup files in storage/app/backups.
     */
    public function listBackups(): array
    {
        $files = File::files($this->backupDir);
        $backups = [];

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $extension = strtolower($file->getExtension());
            $size = $file->getSize();
            $createdAt = $file->getMTime();

            $type = 'Unknown';
            $badgeColor = 'slate';
            $icon = 'file';

            if ($extension === 'sql') {
                $type = 'MySQL Dump (.sql)';
                $badgeColor = 'medical';
                $icon = 'database';
            } elseif ($extension === 'xlsx') {
                $type = 'Excel (.xlsx)';
                $badgeColor = 'emerald';
                $icon = 'table';
            } elseif ($extension === 'zip') {
                $type = 'Excel Archive (.zip)';
                $badgeColor = 'amber';
                $icon = 'archive';
            } elseif ($extension === 'csv') {
                $type = 'CSV Spreadsheet (.csv)';
                $badgeColor = 'teal';
                $icon = 'file-spreadsheet';
            }

            $backups[] = [
                'filename' => $filename,
                'filepath' => $file->getRealPath(),
                'extension' => $extension,
                'type' => $type,
                'badge_color' => $badgeColor,
                'icon' => $icon,
                'size_bytes' => $size,
                'formatted_size' => $this->formatBytes($size),
                'created_at' => date('Y-m-d H:i:s', $createdAt),
                'created_human' => $this->humanTimeDiff($createdAt),
                'is_restorable' => in_array($extension, ['sql', 'xlsx', 'csv', 'zip']),
                'is_sql' => $extension === 'sql',
            ];
        }

        // Sort descending by created time
        usort($backups, fn($a, $b) => strcmp($b['created_at'], $a['created_at']));

        return $backups;
    }

    /**
     * Create and store a new backup file.
     */
    public function createStoredBackup(string $type = 'mysql', ?array $tables = null): array
    {
        $databaseName = DB::connection()->getDatabaseName();
        $timestamp = date('Y-m-d_His');

        if ($type === 'mysql') {
            $filename = "backup-mysql-{$databaseName}-{$timestamp}.sql";
            $filePath = $this->backupDir . '/' . $filename;
            $this->generateSqlDump($tables, true, true, $filePath);
        } elseif ($type === 'excel_xlsx') {
            $filename = "backup-excel-{$databaseName}-{$timestamp}.xlsx";
            $filePath = $this->backupDir . '/' . $filename;
            $this->exportToXlsx(null, $tables, $filePath);
        } elseif ($type === 'excel_zip') {
            $filename = "backup-excel-all-{$databaseName}-{$timestamp}.zip";
            $filePath = $this->backupDir . '/' . $filename;
            $this->exportAllTablesToZip($tables, $filePath);
        } else {
            throw new Exception("Tipe backup tidak valid: {$type}");
        }

        $size = File::size($filePath);

        return [
            'filename' => $filename,
            'filepath' => $filePath,
            'size' => $this->formatBytes($size),
            'type' => $type,
        ];
    }

    /**
     * Delete a single backup file.
     */
    public function deleteBackup(string $filename): bool
    {
        // Path traversal protection
        $safeName = basename($filename);
        $filePath = $this->backupDir . '/' . $safeName;

        if (File::exists($filePath)) {
            return File::delete($filePath);
        }

        return false;
    }

    /**
     * Delete all backup files.
     */
    public function cleanAllBackups(): int
    {
        $files = File::files($this->backupDir);
        $count = 0;

        foreach ($files as $file) {
            if (File::delete($file->getRealPath())) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Get path of a stored backup file safely.
     */
    public function getBackupPath(string $filename): ?string
    {
        $safeName = basename($filename);
        $filePath = $this->backupDir . '/' . $safeName;

        return File::exists($filePath) ? $filePath : null;
    }

    /**
     * Format bytes to human-readable size.
     */
    protected function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Human readable time diff helper.
     */
    protected function humanTimeDiff(int $timestamp): string
    {
        $diff = time() - $timestamp;
        if ($diff < 60) return 'Baru saja';
        if ($diff < 3600) return round($diff / 60) . ' menit lalu';
        if ($diff < 86400) return round($diff / 3600) . ' jam lalu';
        return round($diff / 86400) . ' hari lalu';
    }
}
