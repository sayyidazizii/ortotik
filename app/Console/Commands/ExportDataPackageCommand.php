<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DataPackageService;
use Exception;

class ExportDataPackageCommand extends Command
{
    protected $signature = 'app:export-package';
    protected $description = 'Export full database and uploaded assets into a portable .zip package';

    public function handle(DataPackageService $service): int
    {
        $this->info('📦 Memulai pembuatan paket data dan aset pediOcare...');

        try {
            $zipPath = $service->createPackage();
            $fileSize = round(filesize($zipPath) / (1024 * 1024), 2);

            $this->newLine();
            $this->info('✅ Paket berhasil dibuat!');
            $this->line("📍 Lokasi: <comment>{$zipPath}</comment>");
            $this->line("📊 Ukuran: <comment>{$fileSize} MB</comment>");
            $this->newLine();
            $this->line('👉 Anda dapat mengunggah file ini ke server online melalui menu Admin Settings atau command `php artisan app:import-package`.');

            return Command::SUCCESS;
        } catch (Exception $e) {
            $this->error('❌ Terjadi kesalahan saat membuat paket: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
