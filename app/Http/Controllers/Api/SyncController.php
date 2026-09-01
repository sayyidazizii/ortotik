<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ServerSyncService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Http\JsonResponse;
use Exception;

class SyncController extends Controller
{
    protected ServerSyncService $syncService;

    public function __construct(ServerSyncService $syncService)
    {
        $this->syncService = $syncService;
    }

    /**
     * Authenticate sync request using secret token.
     */
    protected function authorizeSync(Request $request): bool
    {
        $serverSecret = config('services.sync.secret_token') ?: env('SYNC_SECRET_TOKEN');

        if (empty($serverSecret)) {
            return false;
        }

        $providedToken = $request->header('X-Sync-Token') ?: $request->input('token');

        if (empty($providedToken)) {
            return false;
        }

        return hash_equals($serverSecret, $providedToken);
    }

    /**
     * Health check and server stats endpoint.
     */
    public function health(Request $request): JsonResponse
    {
        if (!$this->authorizeSync($request)) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'SYNC_SECRET_TOKEN tidak valid atau belum dikonfigurasi di server (.env).',
            ], 403);
        }

        try {
            $summary = $this->syncService->getServerSummary();
            return response()->json([
                'success' => true,
                'data' => $summary,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Download database snapshot only (.sql wrapped in lightweight .zip).
     */
    public function downloadDatabase(Request $request): BinaryFileResponse|JsonResponse
    {
        if (!$this->authorizeSync($request)) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Akses ditolak: SYNC_SECRET_TOKEN tidak valid atau belum dikonfigurasi di server (.env).',
            ], 403);
        }

        try {
            set_time_limit(600);
            ini_set('memory_limit', '512M');

            $zipPath = $this->syncService->generateDatabasePackage();
            $filename = "pediocare-db-sync-" . date('Y-m-d_His') . ".zip";

            return response()->download($zipPath, $filename, [
                'Content-Type' => 'application/zip',
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
            ])->deleteFileAfterSend(true);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Database Export Failed',
                'message' => 'Gagal membuat arsip database di server: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Download storage assets snapshot only.
     */
    public function downloadAssets(Request $request): BinaryFileResponse|JsonResponse
    {
        if (!$this->authorizeSync($request)) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Akses ditolak: SYNC_SECRET_TOKEN tidak valid atau belum dikonfigurasi di server (.env).',
            ], 403);
        }

        try {
            set_time_limit(1800);
            ini_set('memory_limit', '1024M');

            $zipPath = $this->syncService->generateAssetsPackage();
            $filename = "pediocare-assets-sync-" . date('Y-m-d_His') . ".zip";

            return response()->download($zipPath, $filename, [
                'Content-Type' => 'application/zip',
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
            ])->deleteFileAfterSend(true);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Assets Export Failed',
                'message' => 'Gagal membuat arsip aset media di server: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Download full snapshot package (Database SQL + Storage Assets).
     */
    public function downloadPackage(Request $request): BinaryFileResponse|JsonResponse
    {
        if (!$this->authorizeSync($request)) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Akses ditolak: SYNC_SECRET_TOKEN tidak valid atau belum dikonfigurasi di server (.env).',
            ], 403);
        }

        try {
            // Increase execution time limit for large backups
            set_time_limit(1800);
            ini_set('memory_limit', '1024M');

            $zipPath = $this->syncService->generateSyncPackage();
            $filename = "pediocare-server-sync-" . date('Y-m-d_His') . ".zip";

            return response()->download($zipPath, $filename, [
                'Content-Type' => 'application/zip',
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
            ])->deleteFileAfterSend(true);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Export Failed',
                'message' => 'Gagal membuat paket sinkronisasi di server: ' . $e->getMessage(),
            ], 500);
        }
    }
}
