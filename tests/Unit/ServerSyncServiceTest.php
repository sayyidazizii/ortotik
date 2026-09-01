<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ServerSyncService;
use Exception;

class ServerSyncServiceTest extends TestCase
{
    public function test_format_bytes_static(): void
    {
        $this->assertEquals('0 B', ServerSyncService::formatBytesStatic(0));
        $this->assertEquals('1 KB', ServerSyncService::formatBytesStatic(1024, 0));
        $this->assertEquals('1 MB', ServerSyncService::formatBytesStatic(1024 * 1024, 0));
        $this->assertEquals('12.52 MB', ServerSyncService::formatBytesStatic(13128192, 2));
    }

    public function test_format_eta(): void
    {
        $this->assertEquals('--:--', ServerSyncService::formatEta(null));
        $this->assertEquals('--:--', ServerSyncService::formatEta(-5));
        $this->assertEquals('00:45', ServerSyncService::formatEta(45));
        $this->assertEquals('02:15', ServerSyncService::formatEta(135));
        $this->assertEquals('01:05:20', ServerSyncService::formatEta(3920));
    }

    public function test_parse_sync_error_timeout(): void
    {
        $rawError = "cURL error 28: Operation timed out after 600011 milliseconds with 12524944 out of 40724210 bytes received (see https://curl.se/libcurl/c/libcurl-errors.html) for https://ortotik-production.up.railway.app/api/sync/package";
        $exception = new Exception($rawError);

        $parsed = ServerSyncService::parseSyncError($exception, [
            'server_url' => 'https://ortotik-production.up.railway.app',
            'timeout' => 600,
        ]);

        $this->assertEquals('TIMEOUT', $parsed['type']);
        $this->assertStringContainsString('Batas Waktu Terlampaui', $parsed['title']);
        $this->assertStringContainsString('11.94 MB', $parsed['detail']); // 12524944 bytes in MB
        $this->assertStringContainsString('38.84 MB', $parsed['detail']); // 40724210 bytes in MB
        $this->assertStringContainsString('30.8%', $parsed['detail']);
        $this->assertNotEmpty($parsed['suggestions']);
        $this->assertStringContainsString('--timeout=3600', $parsed['suggestions'][0]);
    }

    public function test_parse_sync_error_auth(): void
    {
        $rawError = "Autentikasi Gagal (HTTP 403): SYNC_SECRET_TOKEN tidak valid atau belum dikonfigurasi di server (.env).";
        $exception = new Exception($rawError);

        $parsed = ServerSyncService::parseSyncError($exception);

        $this->assertEquals('AUTH_ERROR', $parsed['type']);
        $this->assertStringContainsString('Autentikasi Gagal', $parsed['title']);
        $this->assertNotEmpty($parsed['suggestions']);
    }

    public function test_parse_sync_error_connection(): void
    {
        $rawError = "cURL error 6: Could not resolve host: invalid-domain-test.up.railway.app";
        $exception = new Exception($rawError);

        $parsed = ServerSyncService::parseSyncError($exception, [
            'server_url' => 'https://invalid-domain-test.up.railway.app',
        ]);

        $this->assertEquals('CONNECTION_ERROR', $parsed['type']);
        $this->assertStringContainsString('Gagal Menghubungi Server', $parsed['title']);
        $this->assertNotEmpty($parsed['suggestions']);
    }
}
