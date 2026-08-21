<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class ServerSyncService
{
    protected BackupService $backupService;
    protected string $storagePublicPath;
    protected string $tempDir;

    public function __construct(BackupService $backupService)
    {
        $this->backupService = $backupService;
        $this->storagePublicPath = storage_path('app/public');
        $this->tempDir = storage_path('app/temp_sync');

        if (!File::exists($this->tempDir)) {
            File::makeDirectory($this->tempDir, 0755, true);
        }
    }

    /**
     * Generate complete sync package (Database SQL + Storage Assets) on the server.
     * Returns the absolute path of the generated ZIP file.
     */
    public function generateSyncPackage(): string
    {
        $timestamp = date('Y-m-d_His');
        $randomId = bin2hex(random_bytes(6));
        $zipPath = $this->tempDir . "/server_snapshot_{$timestamp}_{$randomId}.zip";
        $sqlPath = $this->tempDir . "/database_{$timestamp}_{$randomId}.sql";

        // 1. Generate full SQL dump
        $this->backupService->generateSqlDump(null, true, true, $sqlPath);

        // 2. Create ZIP package
        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            if (File::exists($sqlPath)) File::delete($sqlPath);
            throw new Exception("Gagal membuat arsip sinkronisasi ZIP di server.");
        }

        // Add database.sql to zip
        $zip->addFile($sqlPath, 'database.sql');

        // Add all storage public assets
        if (File::exists($this->storagePublicPath)) {
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($this->storagePublicPath, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = 'assets/' . substr($filePath, strlen($this->storagePublicPath) + 1);
                    $relativePath = str_replace('\\', '/', $relativePath);
                    
                    // Exclude .gitignore or temporary files
                    if (basename($filePath) === '.gitignore') {
                        continue;
                    }

                    $zip->addFile($filePath, $relativePath);
                }
            }
        }

        // Add metadata JSON
        $meta = [
            'app' => config('app.name', 'pediOcare'),
            'generated_at' => date('Y-m-d H:i:s'),
            'database' => DB::connection()->getDatabaseName(),
            'total_tables' => count($this->backupService->getTablesInfo()),
        ];
        $zip->addFromString('sync_manifest.json', json_encode($meta, JSON_PRETTY_PRINT));

        $zip->close();

        // Delete temporary sql file
        if (File::exists($sqlPath)) {
            File::delete($sqlPath);
        }

        return $zipPath;
    }

    /**
     * Get Server Health / Status for Syncing.
     */
    public function getServerSummary(): array
    {
        $databaseSummary = $this->backupService->getDatabaseSummary();
        $assetCount = 0;
        $assetSize = 0;

        if (File::exists($this->storagePublicPath)) {
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($this->storagePublicPath, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::LEAVES_ONLY
            );
            foreach ($files as $file) {
                if (!$file->isDir() && basename($file->getRealPath()) !== '.gitignore') {
                    $assetCount++;
                    $assetSize += $file->getSize();
                }
            }
        }

        return [
            'status' => 'online',
            'server_time' => date('Y-m-d H:i:s'),
            'database_tables' => $databaseSummary['total_tables'],
            'database_rows' => $databaseSummary['total_rows'],
            'database_size' => $databaseSummary['total_size_formatted'],
            'assets_count' => $assetCount,
            'assets_size' => $this->formatBytes($assetSize),
        ];
    }

    /**
     * Pull data and assets from Remote Server and apply to Local environment.
     */
    public function pullFromServer(string $serverUrl, string $secretToken, bool $syncDb = true, bool $syncAssets = true): array
    {
        $serverUrl = rtrim($serverUrl, '/');
        if (empty($serverUrl)) {
            throw new Exception("URL Server Online belum diisi.");
        }
        if (empty($secretToken)) {
            throw new Exception("Secret Sync Token belum diisi.");
        }

        $startTime = microtime(true);

        // 1. Download snapshot package from Server
        $downloadUrl = "{$serverUrl}/api/sync/package";
        $tempZipPath = $this->tempDir . '/remote_download_' . uniqid() . '.zip';
        $extractDir = $this->tempDir . '/remote_extract_' . uniqid();

        try {
            // Stream/download zip directly to file with 10-minute timeout
            $response = Http::withOptions($this->getHttpOptions())
                ->withHeaders([
                    'X-Sync-Token' => $secretToken,
                    'Accept' => 'application/zip, application/json',
                ])
                ->timeout(600)
                ->sink($tempZipPath)
                ->get($downloadUrl);

            if ($response->status() === 403 || $response->status() === 401) {
                throw new Exception("Autentikasi Gagal (HTTP {$response->status()}): Secret Sync Token salah atau belum diset di server.");
            }

            if (!$response->successful()) {
                throw new Exception("Server merespons dengan kode error HTTP {$response->status()}. Pastikan URL server benar dan route /api/sync/package aktif.");
            }

            if (!File::exists($tempZipPath) || File::size($tempZipPath) < 100) {
                throw new Exception("File arsip sinkronisasi yang diunduh kosong atau rusak.");
            }

            // 2. Extract ZIP package
            File::makeDirectory($extractDir, 0755, true);
            $zip = new ZipArchive();
            if ($zip->open($tempZipPath) !== true) {
                throw new Exception("Gagal membuka file arsip ZIP yang diunduh dari server.");
            }
            $zip->extractTo($extractDir);
            $zip->close();

            $dbResult = null;
            $assetsSyncedCount = 0;

            // 3. Sync Database if requested
            $extractedSql = $extractDir . '/database.sql';
            if ($syncDb && File::exists($extractedSql)) {
                $dbResult = $this->backupService->importSqlFile($extractedSql);
            }

            // 4. Sync Assets if requested
            $extractedAssets = $extractDir . '/assets';
            if ($syncAssets && File::exists($extractedAssets)) {
                if (!File::exists($this->storagePublicPath)) {
                    File::makeDirectory($this->storagePublicPath, 0755, true);
                }

                $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($extractedAssets, RecursiveDirectoryIterator::SKIP_DOTS),
                    RecursiveIteratorIterator::LEAVES_ONLY
                );

                foreach ($files as $file) {
                    if (!$file->isDir()) {
                        $sourcePath = $file->getRealPath();
                        $relPath = substr($sourcePath, strlen($extractedAssets) + 1);
                        $targetPath = $this->storagePublicPath . DIRECTORY_SEPARATOR . $relPath;

                        // Ensure subdirectories exist
                        $targetDir = dirname($targetPath);
                        if (!File::exists($targetDir)) {
                            File::makeDirectory($targetDir, 0755, true);
                        }

                        File::copy($sourcePath, $targetPath);
                        $assetsSyncedCount++;
                    }
                }
            }

            $duration = round(microtime(true) - $startTime, 2);

            $messageParts = [];
            if ($syncDb && $dbResult) {
                $messageParts[] = "Database ({$dbResult['queries_executed']} query)";
            }
            if ($syncAssets) {
                $messageParts[] = "{$assetsSyncedCount} file aset media";
            }

            $summaryText = implode(' dan ', $messageParts);

            return [
                'success' => true,
                'duration_seconds' => $duration,
                'db_synced' => $syncDb,
                'queries_executed' => $dbResult['queries_executed'] ?? 0,
                'assets_synced' => $syncAssets,
                'assets_count' => $assetsSyncedCount,
                'message' => "Sinkronisasi Berhasil! {$summaryText} dari server online telah diperbarui ke local dalam {$duration} detik.",
            ];

        } catch (Exception $e) {
            Log::error("ServerSyncService Error: " . $e->getMessage());
            throw $e;
        } finally {
            // Clean up temporary files
            if (File::exists($tempZipPath)) {
                File::delete($tempZipPath);
            }
            if (File::exists($extractDir)) {
                File::deleteDirectory($extractDir);
            }
        }
    }

    /**
     * Check connection and authenticate with remote server without pulling data.
     */
    public function testConnection(string $serverUrl, string $secretToken): array
    {
        $serverUrl = rtrim($serverUrl, '/');
        if (empty($serverUrl) || empty($secretToken)) {
            throw new Exception("URL Server dan Secret Token wajib diisi.");
        }

        $checkUrl = "{$serverUrl}/api/sync/health";

        try {
            $response = Http::withOptions($this->getHttpOptions())
                ->withHeaders([
                    'X-Sync-Token' => $secretToken,
                    'Accept' => 'application/json',
                ])->timeout(15)->get($checkUrl);

            if ($response->status() === 403 || $response->status() === 401) {
                return [
                    'success' => false,
                    'message' => "Koneksi terhubung tetapi Token Ditolak (HTTP {$response->status()}). Pastikan SYNC_SECRET_TOKEN sama di server dan local.",
                ];
            }

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => true,
                    'message' => "Koneksi ke server online BERHASIL dan TERVERIFIKASI!",
                    'server_info' => $data,
                ];
            }

            return [
                'success' => false,
                'message' => "Gagal terhubung: Server merespons dengan HTTP {$response->status()}.",
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => "Gagal terhubung ke server: " . $e->getMessage(),
            ];
        }
    }

    /**
     * Get HTTP client options with fallback SSL certificate handling.
     */
    protected function getHttpOptions(): array
    {
        $options = [];

        // Determine valid SSL CA bundle path
        $possibleCaPaths = [
            'D:/laragon/etc/ssl/cacert.pem',
            'C:/laragon/etc/ssl/cacert.pem',
            ini_get('curl.cainfo'),
            ini_get('openssl.cafile'),
        ];

        $validCaPath = null;
        foreach ($possibleCaPaths as $path) {
            if (!empty($path) && File::exists($path)) {
                $validCaPath = $path;
                break;
            }
        }

        if ($validCaPath) {
            $options['verify'] = $validCaPath;
        } elseif (app()->environment('local')) {
            $options['verify'] = false;
        }

        return $options;
    }

    /**
     * Format bytes helper.
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
