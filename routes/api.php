<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SyncController;

/*
|--------------------------------------------------------------------------
| API Routes for Server Synchronization (Railway <-> Local)
|--------------------------------------------------------------------------
|
| These routes are protected by the X-Sync-Token header secret and allow
| authorized local development environments to safely pull database snapshots
| and uploaded storage assets from the remote production server.
|
*/

Route::prefix('sync')->group(function () {
    Route::get('/health', [SyncController::class, 'health'])->name('api.sync.health');
    Route::get('/package', [SyncController::class, 'downloadPackage'])->name('api.sync.package');
});
