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
     * Generate database-only sync package on the server.
     */
    public function generateDatabasePackage(): string
    {
        $timestamp = date('Y-m-d_His');
        $randomId = bin2hex(random_bytes(6));
        $zipPath = $this->tempDir . "/server_db_{$timestamp}_{$randomId}.zip";
        $sqlPath = $this->tempDir . "/database_{$timestamp}_{$randomId}.sql";

        $this->backupService->generateSqlDump(null, true, true, $sqlPath);

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            if (File::exists($sqlPath)) File::delete($sqlPath);
            throw new Exception("Gagal membuat arsip database ZIP di server.");
        }

        $zip->addFile($sqlPath, 'database.sql');

        $meta = [
            'app' => config('app.name', 'pediOcare'),
            'type' => 'database',
            'generated_at' => date('Y-m-d H:i:s'),
            'database' => DB::connection()->getDatabaseName(),
            'total_tables' => count($this->backupService->getTablesInfo()),
        ];
        $zip->addFromString('sync_manifest.json', json_encode($meta, JSON_PRETTY_PRINT));
        $zip->close();

        if (File::exists($sqlPath)) {
            File::delete($sqlPath);
        }

        return $zipPath;
    }

    /**
     * Generate assets-only sync package on the server.
     */
    public function generateAssetsPackage(): string
    {
        $timestamp = date('Y-m-d_His');
        $randomId = bin2hex(random_bytes(6));
        $zipPath = $this->tempDir . "/server_assets_{$timestamp}_{$randomId}.zip";

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new Exception("Gagal membuat arsip aset media ZIP di server.");
        }

        $assetCount = 0;
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

                    if (basename($filePath) === '.gitignore') {
                        continue;
                    }

                    $zip->addFile($filePath, $relativePath);
                    $assetCount++;
                }
            }
        }

        $meta = [
            'app' => config('app.name', 'pediOcare'),
            'type' => 'assets',
            'generated_at' => date('Y-m-d H:i:s'),
            'total_assets' => $assetCount,
        ];
        $zip->addFromString('sync_manifest.json', json_encode($meta, JSON_PRETTY_PRINT));
        $zip->close();

        return $zipPath;
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

        if (File::exists($sqlPath)) {
            File::delete($sqlPath);
        }

        return $zipPath;
    }

    /**
     * Download a file from remote server to a unique temp path without file locking conflicts.
     */
    protected function downloadToFile(
        string $url,
        string $secretToken,
        int $timeout = 600,
        ?callable $statusCallback = null
    ): array {
        $uniqueId = uniqid() . '_' . mt_rand(1000, 9999);
        $tempPath = $this->tempDir . '/remote_file_' . $uniqueId . '.zip';

        $customOptions = array_merge($this->getHttpOptions(), [
            'connect_timeout' => 60,
        ]);

        $httpClient = Http::withOptions($customOptions)
            ->withHeaders([
                'X-Sync-Token' => $secretToken,
                'Accept' => 'application/zip, application/json',
            ]);

        if ($timeout > 0) {
            $httpClient = $httpClient->timeout($timeout);
        } else {
            $httpClient = $httpClient->timeout(0);
        }

        $response = $httpClient->sink($tempPath)->get($url);
        $status = $response->status();

        $errorPayload = null;
        $fileSize = File::exists($tempPath) ? File::size($tempPath) : 0;
        if ($fileSize > 0 && $fileSize < 100000) {
            $rawContent = @File::get($tempPath);
            if (!empty($rawContent)) {
                $json = @json_decode($rawContent, true);
                if (is_array($json)) {
                    $errorPayload = $json['message'] ?? $json['error'] ?? null;
                }
            }
        }

        unset($response, $httpClient);

        return [
            'status' => $status,
            'file_path' => $tempPath,
            'size' => $fileSize,
            'error_message' => $errorPayload,
        ];
    }

    /**
     * Pull database-only from remote server (fast, lightweight, anti-timeout).
     */
    public function pullDatabase(
        string $serverUrl,
        string $secretToken,
        ?callable $statusCallback = null,
        int $timeout = 600
    ): array {
        $serverUrl = rtrim($serverUrl, '/');
        if (empty($serverUrl) || empty($secretToken)) {
            throw new Exception("URL Server dan Secret Token wajib diisi.");
        }

        $startTime = microtime(true);
        $tempFiles = [];
        $extractDir = $this->tempDir . '/remote_extract_db_' . uniqid() . '_' . mt_rand(1000, 9999);

        if ($statusCallback) {
            $statusCallback('init', ['message' => 'Menghubungi server dan mengunduh database SQL...']);
        }

        try {
            // First try dedicated /api/sync/database endpoint
            $url = "{$serverUrl}/api/sync/database";
            $res = $this->downloadToFile($url, $secretToken, $timeout, $statusCallback);
            $tempFiles[] = $res['file_path'];

            // Fallback to /api/sync/package if server hasn't been updated with /database route
            if ($res['status'] === 404) {
                $fallbackUrl = "{$serverUrl}/api/sync/package";
                $res = $this->downloadToFile($fallbackUrl, $secretToken, $timeout, $statusCallback);
                $tempFiles[] = $res['file_path'];
            }

            if ($res['status'] === 403 || $res['status'] === 401) {
                $msg = $res['error_message'] ?: "Secret Sync Token salah atau belum diset di server.";
                throw new Exception("Autentikasi Gagal (HTTP {$res['status']}): {$msg}");
            }

            if ($res['status'] < 200 || $res['status'] >= 300) {
                $msg = $res['error_message'] ?: "Server merespons dengan kode error HTTP {$res['status']}.";
                throw new Exception($msg);
            }

            $zipPath = $res['file_path'];
            if (!File::exists($zipPath) || $res['size'] < 100) {
                throw new Exception("File arsip database yang diunduh kosong atau rusak.");
            }

            // Extract
            File::makeDirectory($extractDir, 0755, true);
            $zip = new ZipArchive();
            if ($zip->open($zipPath) !== true) {
                throw new Exception("Gagal membuka file arsip database ZIP.");
            }
            $zip->extractTo($extractDir);
            $zip->close();

            // Import SQL
            $extractedSql = $extractDir . '/database.sql';
            if (!File::exists($extractedSql)) {
                throw new Exception("File database.sql tidak ditemukan di dalam paket arsip.");
            }

            $dbResult = $this->backupService->importSqlFile($extractedSql);
            $duration = round(microtime(true) - $startTime, 2);

            return [
                'success' => true,
                'queries_executed' => $dbResult['queries_executed'] ?? 0,
                'download_size' => $res['size'],
                'download_size_formatted' => self::formatBytesStatic($res['size']),
                'duration_seconds' => $duration,
                'message' => "Database berhasil disinkronkan ({$dbResult['queries_executed']} query dieksekusi dalam {$duration} detik).",
            ];
        } catch (Exception $e) {
            Log::error("ServerSyncService pullDatabase Error: " . $e->getMessage());
            throw $e;
        } finally {
            foreach ($tempFiles as $file) {
                if (File::exists($file)) {
                    @unlink($file);
                }
            }
            if (File::exists($extractDir)) {
                @File::deleteDirectory($extractDir);
            }
        }
    }

    /**
     * Pull assets-only from remote server.
     */
    public function pullAssets(
        string $serverUrl,
        string $secretToken,
        ?callable $statusCallback = null,
        int $timeout = 1200
    ): array {
        $serverUrl = rtrim($serverUrl, '/');
        if (empty($serverUrl) || empty($secretToken)) {
            throw new Exception("URL Server dan Secret Token wajib diisi.");
        }

        $startTime = microtime(true);
        $tempFiles = [];
        $extractDir = $this->tempDir . '/remote_extract_assets_' . uniqid() . '_' . mt_rand(1000, 9999);

        if ($statusCallback) {
            $statusCallback('init', ['message' => 'Menghubungi server dan mengunduh berkas aset media...']);
        }

        try {
            // First try dedicated /api/sync/assets endpoint
            $url = "{$serverUrl}/api/sync/assets";
            $res = $this->downloadToFile($url, $secretToken, $timeout, $statusCallback);
            $tempFiles[] = $res['file_path'];

            // Fallback to /api/sync/package if server hasn't been updated with /assets route
            if ($res['status'] === 404) {
                $fallbackUrl = "{$serverUrl}/api/sync/package";
                $res = $this->downloadToFile($fallbackUrl, $secretToken, $timeout, $statusCallback);
                $tempFiles[] = $res['file_path'];
            }

            if ($res['status'] === 403 || $res['status'] === 401) {
                $msg = $res['error_message'] ?: "Secret Sync Token salah atau belum diset di server.";
                throw new Exception("Autentikasi Gagal (HTTP {$res['status']}): {$msg}");
            }

            if ($res['status'] < 200 || $res['status'] >= 300) {
                $msg = $res['error_message'] ?: "Server merespons dengan kode error HTTP {$res['status']}.";
                throw new Exception($msg);
            }

            $zipPath = $res['file_path'];
            if (!File::exists($zipPath) || $res['size'] < 100) {
                throw new Exception("File arsip aset yang diunduh kosong atau rusak.");
            }

            // Extract
            File::makeDirectory($extractDir, 0755, true);
            $zip = new ZipArchive();
            if ($zip->open($zipPath) !== true) {
                throw new Exception("Gagal membuka file arsip aset ZIP.");
            }
            $zip->extractTo($extractDir);
            $zip->close();

            // Copy assets
            $assetsSyncedCount = 0;
            $extractedAssets = $extractDir . '/assets';
            if (File::exists($extractedAssets)) {
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

            return [
                'success' => true,
                'assets_count' => $assetsSyncedCount,
                'download_size' => $res['size'],
                'download_size_formatted' => self::formatBytesStatic($res['size']),
                'duration_seconds' => $duration,
                'message' => "Aset media berhasil disinkronkan ({$assetsSyncedCount} berkas disalin dalam {$duration} detik).",
            ];
        } catch (Exception $e) {
            Log::error("ServerSyncService pullAssets Error: " . $e->getMessage());
            throw $e;
        } finally {
            foreach ($tempFiles as $file) {
                if (File::exists($file)) {
                    @unlink($file);
                }
            }
            if (File::exists($extractDir)) {
                @File::deleteDirectory($extractDir);
            }
        }
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
     *
     * @param string $serverUrl
     * @param string $secretToken
     * @param bool $syncDb
     * @param bool $syncAssets
     * @param callable|null $statusCallback Callback for progress reporting: function(string $stage, mixed $data)
     * @param int $timeout Timeout in seconds (default 1800s / 30 mins, 0 for infinite)
     * @return array
     */
    public function pullFromServer(
        string $serverUrl,
        string $secretToken,
        bool $syncDb = true,
        bool $syncAssets = true,
        ?callable $statusCallback = null,
        int $timeout = 1800
    ): array {
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

        if ($statusCallback) {
            $statusCallback('init', [
                'message' => 'Menghubungi server dan menunggu arsip snapshot dibuat di server...',
                'url' => $downloadUrl,
            ]);
        }

        try {
            $downloadStartTime = null;
            $lastReportTime = 0.0;
            $lastDownloadedBytes = 0;
            $currentSpeed = 0.0;
            $lastProgressData = [];

            $customOptions = array_merge($this->getHttpOptions(), [
                'connect_timeout' => 60,
                'progress' => function ($downloadTotal, $downloadedBytes, $uploadTotal, $uploadedBytes) use (
                    $statusCallback,
                    &$downloadStartTime,
                    &$lastReportTime,
                    &$lastDownloadedBytes,
                    &$currentSpeed,
                    &$lastProgressData
                ) {
                    if (!$statusCallback) {
                        return;
                    }

                    $now = microtime(true);

                    if ($downloadedBytes > 0 && $downloadStartTime === null) {
                        $downloadStartTime = $now;
                        $lastReportTime = $now;
                    }

                    $isFinished = ($downloadTotal > 0 && $downloadedBytes >= $downloadTotal);

                    // Throttle updates to at most once every 100ms unless finished
                    if (!$isFinished && ($now - $lastReportTime) < 0.1) {
                        return;
                    }

                    $elapsed = $downloadStartTime ? ($now - $downloadStartTime) : 0.0;
                    $intervalTime = $now - $lastReportTime;

                    if ($intervalTime >= 0.25) {
                        $intervalBytes = $downloadedBytes - $lastDownloadedBytes;
                        $instantSpeed = $intervalTime > 0 ? ($intervalBytes / $intervalTime) : 0;
                        $currentSpeed = ($currentSpeed > 0) ? ($currentSpeed * 0.65 + $instantSpeed * 0.35) : $instantSpeed;
                        $lastDownloadedBytes = $downloadedBytes;
                        $lastReportTime = $now;
                    } elseif ($currentSpeed <= 0 && $elapsed > 0) {
                        $currentSpeed = $downloadedBytes / $elapsed;
                    }

                    $percentage = ($downloadTotal > 0) ? min(100.0, ($downloadedBytes / $downloadTotal) * 100.0) : 0.0;
                    $remainingBytes = max(0, $downloadTotal - $downloadedBytes);
                    $etaSeconds = ($currentSpeed > 0 && $remainingBytes > 0) ? (int) round($remainingBytes / $currentSpeed) : null;

                    $lastProgressData = [
                        'stage' => 'downloading',
                        'total_bytes' => (int) $downloadTotal,
                        'downloaded_bytes' => (int) $downloadedBytes,
                        'percentage' => round($percentage, 1),
                        'speed_bytes_per_sec' => (int) $currentSpeed,
                        'speed_formatted' => self::formatBytesStatic((int) $currentSpeed) . '/s',
                        'downloaded_formatted' => self::formatBytesStatic((int) $downloadedBytes),
                        'total_formatted' => $downloadTotal > 0 ? self::formatBytesStatic((int) $downloadTotal) : 'Tidak Diketahui',
                        'elapsed_seconds' => round($elapsed, 1),
                        'eta_seconds' => $etaSeconds,
                        'eta_formatted' => self::formatEta($etaSeconds),
                    ];

                    $statusCallback('downloading', $lastProgressData);
                },
            ]);

            $httpClient = Http::withOptions($customOptions)
                ->withHeaders([
                    'X-Sync-Token' => $secretToken,
                    'Accept' => 'application/zip, application/json',
                ]);

            if ($timeout > 0) {
                $httpClient = $httpClient->timeout($timeout);
            } else {
                $httpClient = $httpClient->timeout(0);
            }

            $response = $httpClient->sink($tempZipPath)->get($downloadUrl);

            // Read error response if any was written to temp file
            $errorPayload = null;
            if (File::exists($tempZipPath) && File::size($tempZipPath) < 100000) {
                $rawContent = @File::get($tempZipPath);
                if (!empty($rawContent)) {
                    $json = @json_decode($rawContent, true);
                    if (is_array($json)) {
                        $errorPayload = $json['message'] ?? $json['error'] ?? null;
                    }
                }
            }

            if ($response->status() === 403 || $response->status() === 401) {
                $msg = $errorPayload ?: "Secret Sync Token salah atau belum diset di server.";
                throw new Exception("Autentikasi Gagal (HTTP {$response->status()}): {$msg}");
            }

            if (!$response->successful()) {
                $msg = $errorPayload ?: "Server merespons dengan kode error HTTP {$response->status()}.";
                throw new Exception("{$msg} Pastikan URL server benar dan route /api/sync/package aktif.");
            }

            if (!File::exists($tempZipPath) || File::size($tempZipPath) < 100) {
                throw new Exception("File arsip sinkronisasi yang diunduh kosong atau rusak.");
            }

            $downloadDuration = $downloadStartTime ? round(microtime(true) - $downloadStartTime, 2) : 0;
            $downloadedFileSize = File::size($tempZipPath);

            if ($statusCallback) {
                $statusCallback('download_completed', [
                    'total_bytes' => $downloadedFileSize,
                    'total_formatted' => self::formatBytesStatic($downloadedFileSize),
                    'duration_seconds' => $downloadDuration,
                    'average_speed_formatted' => self::formatBytesStatic((int) ($downloadedFileSize / max(1, $downloadDuration))) . '/s',
                ]);
            }

            // 2. Extract ZIP package
            if ($statusCallback) {
                $statusCallback('extracting', ['message' => 'Mengekstrak file snapshot...']);
            }

            File::makeDirectory($extractDir, 0755, true);
            $zip = new ZipArchive();
            if ($zip->open($tempZipPath) !== true) {
                throw new Exception("Gagal membuka file arsip ZIP yang diunduh dari server.");
            }
            $zip->extractTo($extractDir);
            $zip->close();

            if ($statusCallback) {
                $statusCallback('extracted', ['message' => 'Ekstraksi arsip ZIP selesai.']);
            }

            $dbResult = null;
            $assetsSyncedCount = 0;

            // 3. Sync Database if requested
            $extractedSql = $extractDir . '/database.sql';
            if ($syncDb && File::exists($extractedSql)) {
                if ($statusCallback) {
                    $statusCallback('syncing_db', ['message' => 'Mengimpor struktur dan data database MySQL...']);
                }

                $dbResult = $this->backupService->importSqlFile($extractedSql);

                if ($statusCallback) {
                    $statusCallback('db_synced', [
                        'queries_executed' => $dbResult['queries_executed'] ?? 0,
                        'duration' => $dbResult['duration_seconds'] ?? 0,
                    ]);
                }
            }

            // 4. Sync Assets if requested
            $extractedAssets = $extractDir . '/assets';
            if ($syncAssets && File::exists($extractedAssets)) {
                if ($statusCallback) {
                    $statusCallback('syncing_assets', ['message' => 'Menyalin file aset media ke storage/app/public...']);
                }

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

                if ($statusCallback) {
                    $statusCallback('assets_synced', [
                        'assets_count' => $assetsSyncedCount,
                    ]);
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

            $result = [
                'success' => true,
                'duration_seconds' => $duration,
                'download_size' => $downloadedFileSize,
                'download_size_formatted' => self::formatBytesStatic($downloadedFileSize),
                'db_synced' => $syncDb,
                'queries_executed' => $dbResult['queries_executed'] ?? 0,
                'assets_synced' => $syncAssets,
                'assets_count' => $assetsSyncedCount,
                'message' => "Sinkronisasi Berhasil! {$summaryText} dari server online telah diperbarui ke local dalam {$duration} detik.",
            ];

            if ($statusCallback) {
                $statusCallback('completed', $result);
            }

            return $result;

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
                ])->timeout(20)->get($checkUrl);

            if ($response->status() === 403 || $response->status() === 401) {
                $body = $response->json();
                $msg = $body['message'] ?? "Secret Sync Token tidak valid atau belum dikonfigurasi di server (.env).";
                return [
                    'success' => false,
                    'message' => "Koneksi terhubung tetapi Token Ditolak (HTTP {$response->status()}): {$msg}",
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
     * Parse sync exceptions into structured human-readable error info with troubleshooting tips.
     */
    public static function parseSyncError(\Throwable $e, ?array $context = null): array
    {
        $rawMessage = $e->getMessage();
        $serverUrl = $context['server_url'] ?? null;
        $downloadedBytes = $context['downloaded_bytes'] ?? null;
        $totalBytes = $context['total_bytes'] ?? null;
        $timeout = $context['timeout'] ?? null;

        $type = 'UNKNOWN';
        $title = 'Terjadi Kesalahan Saat Sinkronisasi';
        $detail = $rawMessage;
        $suggestions = [];

        // 1. Timeout / cURL error 28
        if (
            str_contains($rawMessage, 'cURL error 28') ||
            str_contains($rawMessage, 'timed out') ||
            str_contains($rawMessage, 'Maximum execution time')
        ) {
            $type = 'TIMEOUT';
            $title = 'Batas Waktu Terlampaui (cURL Timeout Error 28)';

            if (preg_match('/with\s+(\d+)\s+out of\s+(\d+)\s+bytes received/i', $rawMessage, $m)) {
                $downloaded = (int) $m[1];
                $total = (int) $m[2];
                $percent = round(($downloaded / max(1, $total)) * 100, 1);
                $detail = "Proses unduh terhenti karena koneksi mencapai batas waktu (timeout). Server telah mengirim " . self::formatBytesStatic($downloaded) . " dari " . self::formatBytesStatic($total) . " ({$percent}%) sebelum koneksi diputus.";
            } elseif ($downloadedBytes !== null && $totalBytes !== null && $totalBytes > 0) {
                $percent = round(($downloadedBytes / $totalBytes) * 100, 1);
                $detail = "Proses unduh terhenti karena mencapai batas waktu (timeout). Terunduh " . self::formatBytesStatic($downloadedBytes) . " dari " . self::formatBytesStatic($totalBytes) . " ({$percent}%).";
            } else {
                $detail = "Waktu tunggu unduhan melebihi batas waktu (" . ($timeout ? "{$timeout} detik" : "timeout") . ") karena kecepatan jaringan lambat atau ukuran file snapshot besar.";
            }

            $suggestions[] = "Jalankan perintah dengan timeout lebih panjang: php artisan server:pull --timeout=3600 (3600 detik = 1 jam)";
            $suggestions[] = "Gunakan opsi tanpa batas waktu: php artisan server:pull --timeout=0";
            $suggestions[] = "Jika hanya butuh database MySQL tanpa aset foto: php artisan server:pull --no-assets";
            $suggestions[] = "Periksa kecepatan internet Anda dan pastikan server online tidak sedang mengalami beban tinggi / restart.";
        }
        // 2. Auth error (401 / 403)
        elseif (
            str_contains($rawMessage, '401') ||
            str_contains($rawMessage, '403') ||
            str_contains(strtolower($rawMessage), 'unauthorized') ||
            str_contains(strtolower($rawMessage), 'token')
        ) {
            $type = 'AUTH_ERROR';
            $title = 'Autentikasi Gagal / Token Ditolak (HTTP 401/403)';
            $detail = "Secret Sync Token yang dimasukkan tidak cocok dengan variabel SYNC_SECRET_TOKEN di server Railway.";
            $suggestions[] = "Buka Railway Dashboard -> pilih Service Aplikasi -> tab 'Variables'.";
            $suggestions[] = "Salin nilai 'SYNC_SECRET_TOKEN' yang terpasang di server.";
            $suggestions[] = "Masukkan token yang sama di .env local atau gunakan opsi: php artisan server:pull --token=\"TOKEN_ANDA\"";
        }
        // 3. SSL error (cURL 60 / 77)
        elseif (
            str_contains($rawMessage, 'cURL error 60') ||
            str_contains($rawMessage, 'cURL error 77') ||
            str_contains(strtolower($rawMessage), 'ssl') ||
            str_contains(strtolower($rawMessage), 'certificate')
        ) {
            $type = 'SSL_ERROR';
            $title = 'Masalah Sertifikat SSL Lokal (cURL Error 60)';
            $detail = "cURL pada PHP lokal Anda tidak dapat memvalidasi sertifikat SSL HTTPS server online.";
            $suggestions[] = "Pastikan file cacert.pem terpasang dan disetting di php.ini (curl.cainfo).";
            $suggestions[] = "Jika menggunakan Laragon, pastikan SSL CA bundle up to date.";
        }
        // 4. DNS / Host / Connection Refused (cURL 6 / 7)
        elseif (
            str_contains($rawMessage, 'cURL error 6') ||
            str_contains($rawMessage, 'cURL error 7') ||
            str_contains($rawMessage, 'Could not resolve host') ||
            str_contains($rawMessage, 'Failed to connect')
        ) {
            $type = 'CONNECTION_ERROR';
            $title = 'Gagal Menghubungi Server (Host Tidak Ditemukan / Offline)';
            $detail = "Tidak dapat terhubung ke server target (" . ($serverUrl ?: "URL") . "). Server mungkin sedang restart, sleeping, atau URL salah.";
            $suggestions[] = "Pastikan URL server benar, contoh: https://ortotik-production.up.railway.app";
            $suggestions[] = "Buka URL server di browser untuk memastikan aplikasi Railway dalam kondisi aktif (Running).";
            $suggestions[] = "Periksa koneksi jaringan internet komputer lokal Anda.";
        }
        // 5. HTTP 5xx (500, 502, 503, 504)
        elseif (
            str_contains($rawMessage, 'HTTP 500') ||
            str_contains($rawMessage, 'HTTP 502') ||
            str_contains($rawMessage, 'HTTP 503') ||
            str_contains($rawMessage, 'HTTP 504') ||
            str_contains($rawMessage, 'kode error HTTP 5')
        ) {
            $type = 'SERVER_ERROR';
            $title = 'Server Online Mengalami Kesalahan Internal (HTTP 5xx)';
            $detail = "Server Railway mengalami error saat mengekspor database atau mengompres arsip aset: {$rawMessage}";
            $suggestions[] = "Buka Railway Dashboard -> Deployments -> View Logs untuk memeriksa log backend server.";
            $suggestions[] = "Pastikan server Railway memiliki sisa memori RAM dan disk storage yang cukup.";
            $suggestions[] = "Coba unduh database saja terlebih dahulu: php artisan server:pull --no-assets";
        }
        // 6. HTTP 404
        elseif (str_contains($rawMessage, 'HTTP 404') || str_contains($rawMessage, '404 Not Found')) {
            $type = 'NOT_FOUND';
            $title = 'Endpoint Sinkronisasi Tidak Ditemukan (HTTP 404)';
            $detail = "Route /api/sync/package tidak ditemukan di server target.";
            $suggestions[] = "Pastikan server online sudah di-deploy dengan versi code terbaru yang memiliki fitur Sync.";
            $suggestions[] = "Pastikan URL server tidak memiliki subfolder yang salah.";
        }
        // 7. Zip Archive / Extract error
        elseif (
            str_contains(strtolower($rawMessage), 'zip') ||
            str_contains(strtolower($rawMessage), 'arsip') ||
            str_contains(strtolower($rawMessage), 'ekstrak')
        ) {
            $type = 'ZIP_ERROR';
            $title = 'Gagal Mengekstrak Arsip Snapshot ZIP';
            $detail = "File arsip yang diunduh rusak atau tidak lengkap: {$rawMessage}";
            $suggestions[] = "Pastikan kapasitas penyimpanan drive komputer Anda masih memiliki sisa ruang bebas.";
            $suggestions[] = "Coba ulangi proses sinkronisasi: php artisan server:pull";
        }
        // 8. Database import error
        elseif (
            str_contains($rawMessage, 'SQLSTATE') ||
            str_contains(strtolower($rawMessage), 'database') ||
            str_contains(strtolower($rawMessage), 'import')
        ) {
            $type = 'DATABASE_ERROR';
            $title = 'Gagal Mengimpor Database SQL ke Local';
            $detail = "Terjadi kesalahan saat mengeksekusi query database ke MySQL local: {$rawMessage}";
            $suggestions[] = "Pastikan MySQL / MariaDB di Laragon / XAMPP sedang berjalan aktif.";
            $suggestions[] = "Periksa konfigurasi DB_DATABASE, DB_USERNAME, dan DB_PASSWORD di file .env local.";
        }

        return [
            'type' => $type,
            'title' => $title,
            'detail' => $detail,
            'raw_message' => $rawMessage,
            'server_url' => $serverUrl,
            'suggestions' => $suggestions,
        ];
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
     * Format ETA seconds to string HH:MM:SS or MM:SS.
     */
    public static function formatEta(?int $seconds): string
    {
        if ($seconds === null || $seconds < 0) {
            return '--:--';
        }
        if ($seconds >= 3600) {
            $h = (int) floor($seconds / 3600);
            $m = (int) floor(($seconds % 3600) / 60);
            $s = $seconds % 60;
            return sprintf('%02d:%02d:%02d', $h, $m, $s);
        }
        $m = (int) floor($seconds / 60);
        $s = $seconds % 60;
        return sprintf('%02d:%02d', $m, $s);
    }

    /**
     * Format bytes helper (static).
     */
    public static function formatBytesStatic(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Format bytes helper (instance).
     */
    public function formatBytes(int $bytes, int $precision = 2): string
    {
        return self::formatBytesStatic($bytes, $precision);
    }
}

