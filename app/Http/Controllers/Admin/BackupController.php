<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BackupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Exception;

class BackupController extends Controller
{
    protected BackupService $backupService;

    public function __construct(BackupService $backupService)
    {
        $this->backupService = $backupService;
    }

    /**
     * Display the Backup & Database Management Dashboard.
     */
    public function index()
    {
        $summary = $this->backupService->getDatabaseSummary();
        $backups = $this->backupService->listBackups();
        $tables = $this->backupService->getTablesInfo();

        return view('admin.backup.index', compact('summary', 'backups', 'tables'));
    }

    /**
     * Export MySQL Database (.sql).
     */
    public function exportSql(Request $request)
    {
        $request->validate([
            'tables' => 'nullable|array',
            'tables.*' => 'string',
            'action' => 'nullable|in:download,save',
            'include_structure' => 'nullable|boolean',
            'include_data' => 'nullable|boolean',
        ]);

        $selectedTables = $request->input('tables');
        $action = $request->input('action', 'download');
        $includeStructure = $request->boolean('include_structure', true);
        $includeData = $request->boolean('include_data', true);

        try {
            if ($action === 'save') {
                $backup = $this->backupService->createStoredBackup('mysql', $selectedTables);
                return redirect()->route('admin.backup.index')
                    ->with('success', "Backup MySQL berhasil disimpan: {$backup['filename']} ({$backup['size']})");
            }

            // Direct Download
            $databaseName = config('database.connections.mysql.database', 'database');
            $timestamp = date('Y-m-d_His');
            $filename = "backup-mysql-{$databaseName}-{$timestamp}.sql";

            return response()->streamDownload(function () use ($selectedTables, $includeStructure, $includeData) {
                echo $this->backupService->generateSqlDump($selectedTables, $includeStructure, $includeData);
            }, $filename, [
                'Content-Type' => 'application/sql',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            ]);
        } catch (Exception $e) {
            return redirect()->route('admin.backup.index')
                ->with('error', 'Gagal membuat backup MySQL: ' . $e->getMessage());
        }
    }

    /**
     * Export to Excel (.xlsx, .csv, or .zip).
     */
    public function exportExcel(Request $request)
    {
        $request->validate([
            'table' => 'nullable|string',
            'tables' => 'nullable|array',
            'format' => 'nullable|in:xlsx,csv,zip',
            'action' => 'nullable|in:download,save',
        ]);

        $table = $request->input('table');
        $tables = $request->input('tables');
        $format = $request->input('format', 'xlsx');
        $action = $request->input('action', 'download');

        try {
            $databaseName = config('database.connections.mysql.database', 'database');
            $timestamp = date('Y-m-d_His');

            if ($action === 'save') {
                $type = $format === 'zip' ? 'excel_zip' : 'excel_xlsx';
                $backup = $this->backupService->createStoredBackup($type, $tables);
                return redirect()->route('admin.backup.index')
                    ->with('success', "Backup Excel berhasil disimpan: {$backup['filename']} ({$backup['size']})");
            }

            // Direct Download
            if ($table && $table !== 'all') {
                // Single table export
                if ($format === 'csv') {
                    $filename = "export-{$table}-{$timestamp}.csv";
                    return response()->streamDownload(function () use ($table) {
                        echo $this->backupService->exportTableToCsv($table);
                    }, $filename, [
                        'Content-Type' => 'text/csv; charset=UTF-8',
                        'Content-Disposition' => "attachment; filename=\"{$filename}\"",
                    ]);
                } else {
                    $filename = "export-{$table}-{$timestamp}.xlsx";
                    $tempPath = storage_path("app/temp_{$filename}");
                    $this->backupService->exportToXlsx($table, null, $tempPath);
                    return response()->download($tempPath, $filename)->deleteFileAfterSend(true);
                }
            } else {
                // All tables export
                if ($format === 'zip' || $format === 'csv') {
                    $filename = "export-excel-all-{$databaseName}-{$timestamp}.zip";
                    $tempPath = storage_path("app/temp_{$filename}");
                    $this->backupService->exportAllTablesToZip($tables, $tempPath);
                    return response()->download($tempPath, $filename)->deleteFileAfterSend(true);
                } else {
                    $filename = "export-excel-all-{$databaseName}-{$timestamp}.xlsx";
                    $tempPath = storage_path("app/temp_{$filename}");
                    $this->backupService->exportToXlsx(null, $tables, $tempPath);
                    return response()->download($tempPath, $filename)->deleteFileAfterSend(true);
                }
            }
        } catch (Exception $e) {
            return redirect()->route('admin.backup.index')
                ->with('error', 'Gagal mengekspor data ke Excel: ' . $e->getMessage());
        }
    }

    /**
     * Import / Restore MySQL Database from uploaded .sql file.
     */
    public function importSql(Request $request)
    {
        $request->validate([
            'sql_file' => 'required|file|max:102400', // 100MB
        ]);

        $file = $request->file('sql_file');
        $ext = strtolower($file->getClientOriginalExtension());

        if (!in_array($ext, ['sql', 'txt'])) {
            return redirect()->route('admin.backup.index', ['tab' => 'import_sql'])
                ->with('error', 'Format file harus berupa file .sql');
        }

        try {
            $result = $this->backupService->importSqlFile($file->getRealPath());
            return redirect()->route('admin.backup.index', ['tab' => 'import_sql'])
                ->with('success', $result['message']);
        } catch (Exception $e) {
            return redirect()->route('admin.backup.index', ['tab' => 'import_sql'])
                ->with('error', 'Gagal restore database: ' . $e->getMessage());
        }
    }

    /**
     * Import Data from Excel (.xlsx / .csv / .zip) file.
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|max:102400',
            'target_table' => 'nullable|string',
            'mode' => 'required|in:append,replace',
        ]);

        $file = $request->file('excel_file');
        $targetTable = $request->input('target_table');
        $mode = $request->input('mode', 'append');

        try {
            $result = $this->backupService->importExcelFile($file->getRealPath(), $targetTable, $mode);
            return redirect()->route('admin.backup.index', ['tab' => 'import_excel'])
                ->with('success', $result['message']);
        } catch (Exception $e) {
            return redirect()->route('admin.backup.index', ['tab' => 'import_excel'])
                ->with('error', 'Gagal import Excel: ' . $e->getMessage());
        }
    }

    /**
     * Create Stored Backup in server storage.
     */
    public function createStored(Request $request)
    {
        $request->validate([
            'type' => 'required|in:mysql,excel_xlsx,excel_zip',
            'tables' => 'nullable|array',
        ]);

        $type = $request->input('type');
        $tables = $request->input('tables');

        try {
            $backup = $this->backupService->createStoredBackup($type, $tables);
            return redirect()->route('admin.backup.index')
                ->with('success', "File backup berhasil dibuat: {$backup['filename']} ({$backup['size']})");
        } catch (Exception $e) {
            return redirect()->route('admin.backup.index')
                ->with('error', 'Gagal membuat backup: ' . $e->getMessage());
        }
    }

    /**
     * Download a stored backup file.
     */
    public function download(string $filename)
    {
        $filePath = $this->backupService->getBackupPath($filename);

        if (!$filePath) {
            abort(404, 'File backup tidak ditemukan.');
        }

        return response()->download($filePath, $filename);
    }

    /**
     * Restore database from an existing stored backup file.
     */
    public function restore(string $filename)
    {
        $filePath = $this->backupService->getBackupPath($filename);

        if (!$filePath) {
            return redirect()->route('admin.backup.index')
                ->with('error', 'File backup tidak ditemukan.');
        }

        try {
            $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            if ($ext === 'sql') {
                $result = $this->backupService->importSqlFile($filePath);
                return redirect()->route('admin.backup.index')
                    ->with('success', $result['message']);
            } elseif (in_array($ext, ['xlsx', 'csv', 'zip'])) {
                $result = $this->backupService->importExcelFile($filePath, null, 'append');
                return redirect()->route('admin.backup.index')
                    ->with('success', $result['message']);
            } else {
                return redirect()->route('admin.backup.index')
                    ->with('error', 'Format backup tidak dapat direstore secara otomatis.');
            }
        } catch (Exception $e) {
            return redirect()->route('admin.backup.index')
                ->with('error', 'Gagal merestore dari riwayat backup: ' . $e->getMessage());
        }
    }

    /**
     * Delete a single stored backup file.
     */
    public function destroy(string $filename)
    {
        if ($this->backupService->deleteBackup($filename)) {
            return redirect()->route('admin.backup.index')
                ->with('success', "File backup `{$filename}` berhasil dihapus.");
        }

        return redirect()->route('admin.backup.index')
            ->with('error', "Gagal menghapus file backup `{$filename}`.");
    }

    /**
     * Delete all stored backup files.
     */
    public function cleanAll()
    {
        $count = $this->backupService->cleanAllBackups();

        return redirect()->route('admin.backup.index')
            ->with('success', "Semua riwayat backup ({$count} file) berhasil dibersihkan.");
    }

    /**
     * Pull and Sync Database & Assets directly from Remote Server (Railway).
     */
    public function pullSync(Request $request, \App\Services\ServerSyncService $syncService)
    {
        $request->validate([
            'server_url' => 'required|url',
            'secret_token' => 'required|string',
            'sync_database' => 'nullable|boolean',
            'sync_assets' => 'nullable|boolean',
        ]);

        $serverUrl = $request->input('server_url');
        $secretToken = $request->input('secret_token');
        $syncDatabase = $request->boolean('sync_database', true);
        $syncAssets = $request->boolean('sync_assets', true);

        if (!$syncDatabase && !$syncAssets) {
            return redirect()->route('admin.backup.index', ['tab' => 'server_sync'])
                ->with('error', 'Pilih minimal satu opsi yang ingin disinkronkan (Database atau Aset Media).');
        }

        try {
            set_time_limit(600);
            ini_set('memory_limit', '512M');

            $result = $syncService->pullFromServer($serverUrl, $secretToken, $syncDatabase, $syncAssets);

            return redirect()->route('admin.backup.index', ['tab' => 'server_sync'])
                ->with('success', $result['message']);
        } catch (Exception $e) {
            return redirect()->route('admin.backup.index', ['tab' => 'server_sync'])
                ->with('error', 'Gagal sinkronisasi dari server: ' . $e->getMessage());
        }
    }

    /**
     * Test connection to Remote Server for sync.
     */
    public function testSyncConnection(Request $request, \App\Services\ServerSyncService $syncService)
    {
        $request->validate([
            'server_url' => 'required|url',
            'secret_token' => 'required|string',
        ]);

        $serverUrl = $request->input('server_url');
        $secretToken = $request->input('secret_token');

        $result = $syncService->testConnection($serverUrl, $secretToken);

        return response()->json($result);
    }
}
