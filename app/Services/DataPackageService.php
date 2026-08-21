<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use ZipArchive;
use Exception;

class DataPackageService
{
    /**
     * Create a complete backup package (.zip) containing Database SQL + Storage Assets + Public Images
     */
    public function createPackage(): string
    {
        $packageDir = storage_path('app/packages');
        if (!File::exists($packageDir)) {
            File::makeDirectory($packageDir, 0755, true);
        }

        $timestamp = date('Y_m_d_His');
        $zipFilename = "ortotik_data_package_{$timestamp}.zip";
        $zipPath = $packageDir . DIRECTORY_SEPARATOR . $zipFilename;

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new Exception("Gagal membuat file ZIP di {$zipPath}");
        }

        // 1. Generate SQL Dump
        $sqlDump = $this->generateSqlDump();
        $zip->addFromString('database.sql', $sqlDump);

        // 2. Add files from storage/app/public
        $storagePublicPath = storage_path('app/public');
        $storageFileCount = 0;
        if (File::exists($storagePublicPath)) {
            $storageFileCount = $this->addDirectoryToZip($zip, $storagePublicPath, 'storage');
        }

        // 3. Add files from public/images
        $publicImagesPath = public_path('images');
        $imageFileCount = 0;
        if (File::exists($publicImagesPath)) {
            $imageFileCount = $this->addDirectoryToZip($zip, $publicImagesPath, 'images');
        }

        // 4. Add Manifest metadata
        $manifest = [
            'app_name' => config('app.name', 'pediOcare'),
            'version' => '1.0.0',
            'created_at' => date('c'),
            'database_dump_size' => strlen($sqlDump),
            'storage_files_count' => $storageFileCount,
            'image_files_count' => $imageFileCount,
            'tables_included' => $this->getAllTables(),
        ];
        $zip->addFromString('manifest.json', json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        $zip->close();

        return $zipPath;
    }

    /**
     * Import and restore data + assets from a .zip package
     */
    public function importPackage(string $zipPath): array
    {
        if (!File::exists($zipPath)) {
            throw new Exception("File paket tidak ditemukan di {$zipPath}");
        }

        $zip = new ZipArchive();
        if ($zip->open($zipPath) !== true) {
            throw new Exception("Gagal membuka file ZIP paket.");
        }

        $extractPath = storage_path('app/temp_import_' . uniqid());
        File::makeDirectory($extractPath, 0755, true);
        $zip->extractTo($extractPath);
        $zip->close();

        $stats = [
            'database_restored' => false,
            'storage_files_imported' => 0,
            'image_files_imported' => 0,
        ];

        try {
            // 1. Restore Database SQL
            $sqlFile = $extractPath . DIRECTORY_SEPARATOR . 'database.sql';
            if (File::exists($sqlFile)) {
                $sqlContent = File::get($sqlFile);
                $this->restoreSqlDump($sqlContent);
                $stats['database_restored'] = true;
            }

            // 2. Restore Storage public files
            $tempStorage = $extractPath . DIRECTORY_SEPARATOR . 'storage';
            $targetStorage = storage_path('app/public');
            if (File::exists($tempStorage)) {
                if (!File::exists($targetStorage)) {
                    File::makeDirectory($targetStorage, 0755, true);
                }
                $stats['storage_files_imported'] = $this->copyDirectoryRecursive($tempStorage, $targetStorage);
            }

            // 3. Restore Public Images
            $tempImages = $extractPath . DIRECTORY_SEPARATOR . 'images';
            $targetImages = public_path('images');
            if (File::exists($tempImages)) {
                if (!File::exists($targetImages)) {
                    File::makeDirectory($targetImages, 0755, true);
                }
                $stats['image_files_imported'] = $this->copyDirectoryRecursive($tempImages, $targetImages);
            }

            // 4. Ensure storage symlink & clear caches
            try {
                Artisan::call('storage:link');
            } catch (Exception $e) {
                // Ignore if symlink already exists
            }

            try {
                Artisan::call('view:clear');
                Artisan::call('cache:clear');
            } catch (Exception $e) {
                // Ignore cache clearing errors
            }

        } finally {
            // Cleanup temp extraction directory
            if (File::exists($extractPath)) {
                File::deleteDirectory($extractPath);
            }
        }

        return $stats;
    }

    /**
     * Get list of generated packages in storage/app/packages
     */
    public function getExistingPackages(): array
    {
        $packageDir = storage_path('app/packages');
        if (!File::exists($packageDir)) {
            return [];
        }

        $files = File::files($packageDir);
        $packages = [];

        foreach ($files as $file) {
            if ($file->getExtension() === 'zip') {
                $packages[] = [
                    'filename' => $file->getFilename(),
                    'path' => $file->getPathname(),
                    'size' => $this->formatBytes($file->getSize()),
                    'size_bytes' => $file->getSize(),
                    'created_at' => date('Y-m-d H:i:s', $file->getMTime()),
                    'timestamp' => $file->getMTime(),
                ];
            }
        }

        usort($packages, fn($a, $b) => $b['timestamp'] <=> $a['timestamp']);

        return $packages;
    }

    /**
     * Delete a package file
     */
    public function deletePackage(string $filename): bool
    {
        $packagePath = storage_path('app/packages/' . basename($filename));
        if (File::exists($packagePath)) {
            return File::delete($packagePath);
        }
        return false;
    }

    /**
     * Generate SQL dump string for all database tables
     */
    protected function generateSqlDump(): string
    {
        $tables = $this->getAllTables();
        $skipDataTables = ['cache', 'cache_locks', 'failed_jobs', 'job_batches', 'jobs', 'sessions', 'password_reset_tokens'];

        $sql = "-- ========================================================\n";
        $sql .= "-- pediOcare Database Backup & Migration Package\n";
        $sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
        $sql .= "-- ========================================================\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n";
        $sql .= "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n";
        $sql .= "SET time_zone = '+00:00';\n\n";

        foreach ($tables as $table) {
            // Drop & Create Table DDL
            $sql .= "-- --------------------------------------------------------\n";
            $sql .= "-- Structure for table `{$table}`\n";
            $sql .= "-- --------------------------------------------------------\n";
            $sql .= "DROP TABLE IF EXISTS `{$table}`;\n";

            $createTableResult = DB::select("SHOW CREATE TABLE `{$table}`");
            if (!empty($createTableResult)) {
                $createTableArr = (array) $createTableResult[0];
                $createSql = $createTableArr['Create Table'] ?? array_values($createTableArr)[1];
                $sql .= $createSql . ";\n\n";
            }

            // Skip data insertion for transient cache/session tables
            if (in_array($table, $skipDataTables)) {
                continue;
            }

            // Table Data Inserts
            $rows = DB::table($table)->get();
            if ($rows->count() > 0) {
                $sql .= "-- Dumping data for table `{$table}` ({$rows->count()} records)\n";

                $chunks = $rows->chunk(100);
                foreach ($chunks as $chunk) {
                    $insertValues = [];
                    foreach ($chunk as $row) {
                        $values = [];
                        foreach ((array)$row as $col => $val) {
                            if (is_null($val)) {
                                $values[] = "NULL";
                            } elseif (is_numeric($val) && !is_string($val)) {
                                $values[] = $val;
                            } else {
                                $escaped = str_replace(
                                    ['\\', "\0", "\n", "\r", "'", '"', "\x1a"],
                                    ['\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'],
                                    (string)$val
                                );
                                $values[] = "'{$escaped}'";
                            }
                        }
                        $insertValues[] = "(" . implode(", ", $values) . ")";
                    }

                    if (!empty($insertValues)) {
                        $firstRowCols = array_keys((array)$chunk->first());
                        $colNames = implode("`, `", $firstRowCols);
                        $sql .= "INSERT INTO `{$table}` (`{$colNames}`) VALUES\n" . implode(",\n", $insertValues) . ";\n";
                    }
                }
                $sql .= "\n";
            }
        }

        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        return $sql;
    }

    /**
     * Restore SQL dump into database
     */
    protected function restoreSqlDump(string $sqlContent): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        // Split SQL statements by semicolon at the end of line
        $queries = preg_split('/;\s*[\r\n]+/', $sqlContent);

        foreach ($queries as $query) {
            $trimmed = trim($query);
            if (!empty($trimmed) && !str_starts_with($trimmed, '--') && !str_starts_with($trimmed, '/*')) {
                try {
                    DB::unprepared($trimmed);
                } catch (Exception $e) {
                    // Log or handle single query error gracefully
                }
            }
        }

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }

    /**
     * Recursively add directory contents to ZipArchive
     */
    protected function addDirectoryToZip(ZipArchive $zip, string $dirPath, string $zipSubdir): int
    {
        $fileCount = 0;
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dirPath, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($dirPath) + 1);
            $zipEntryPath = $zipSubdir . '/' . str_replace('\\', '/', $relativePath);

            if ($file->isDir()) {
                $zip->addEmptyDir($zipEntryPath);
            } else {
                $zip->addFile($filePath, $zipEntryPath);
                $fileCount++;
            }
        }

        return $fileCount;
    }

    /**
     * Copy directory contents recursively and count files
     */
    protected function copyDirectoryRecursive(string $src, string $dst): int
    {
        $count = 0;
        $dir = opendir($src);
        @mkdir($dst, 0755, true);

        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                $srcFile = $src . DIRECTORY_SEPARATOR . $file;
                $dstFile = $dst . DIRECTORY_SEPARATOR . $file;
                if (is_dir($srcFile)) {
                    $count += $this->copyDirectoryRecursive($srcFile, $dstFile);
                } else {
                    copy($srcFile, $dstFile);
                    $count++;
                }
            }
        }
        closedir($dir);

        return $count;
    }

    /**
     * Get all tables in current database
     */
    protected function getAllTables(): array
    {
        $tables = [];
        $rawTables = DB::select('SHOW TABLES');
        foreach ($rawTables as $t) {
            $arr = (array) $t;
            $tables[] = array_values($arr)[0];
        }
        return $tables;
    }

    /**
     * Helper to format byte sizes
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
}
