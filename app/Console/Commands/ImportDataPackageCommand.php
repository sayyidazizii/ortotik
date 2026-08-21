<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DataPackageService;
use Illuminate\Support\Facades\File;
use Exception;

class ImportDataPackageCommand extends Command
{
    protected $signature = 'app:import-package {file? : Path file .zip paket atau nama file di storage/app/packages}';
    protected $description = 'Import database and media assets from a .zip package into this server';

    public function handle(DataPackageService $service): int
    {
        $filePath = $this->argument('file');

        if (!$filePath) {
            $existing = $service->getExistingPackages();
            if (empty($existing)) {
                $this->error('❌ Tidak ada file paket yang ditemukan di storage/app/packages/ dan tidak ada path file yang ditentukan.');
                $this->line('Gunakan: `php artisan app:import-package [path_to_zip]`');
                return Command::FAILURE;
            }

            $choices = array_column($existing, 'filename');
            $selected = $this->choice('Pilih paket yang ingin di-restore / di-import:', $choices, 0);
            $filePath = storage_path('app/packages/' . $selected);
        }

        if (!File::exists($filePath)) {
            // Check in storage/app/packages
            $altPath = storage_path('app/packages/' . basename($filePath));
            if (File::exists($altPath)) {
                $filePath = $altPath;
            } else {
                $this->error("❌ File paket tidak ditemukan: {$filePath}");
                return Command::FAILURE;
            }
        }

        $this->warn("⚠️  PERINGATAN: Mengimport paket ini akan menimpa data database dan memperbarui file aset!");
        if (!$this->confirm('Apakah Anda yakin ingin melanjutkan proses import?', true)) {
            $this->info('Operasi dibatalkan.');
            return Command::SUCCESS;
        }

        $this->info('🔄 Memproses ekstraksi dan import data + aset...');

        try {
            $stats = $service->importPackage($filePath);

            $this->newLine();
            $this->info('🎉 IMPORT BERHASIL SELESAI!');
            $this->line('📊 Rincian:');
            $this->line('  - Database SQL Restored: ' . ($stats['database_restored'] ? '<info>Ya (100%)</info>' : '<error>Tidak</error>'));
            $this->line('  - Storage Files Disinkronkan: <comment>' . $stats['storage_files_imported'] . ' file</comment>');
            $this->line('  - Public Images Disinkronkan: <comment>' . $stats['image_files_imported'] . ' file</comment>');
            $this->newLine();

            return Command::SUCCESS;
        } catch (Exception $e) {
            $this->error('❌ Terjadi kesalahan saat mengimport paket: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
