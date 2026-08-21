<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ServerSyncService;
use Exception;

class SyncPullCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:pull 
                            {--url= : URL Server Online Railway/Produksi (contoh: https://ortotik-production.up.railway.app)}
                            {--token= : Secret Sync Token}
                            {--no-db : Lewati sinkronisasi database MySQL}
                            {--no-assets : Lewati sinkronisasi aset media storage}
                            {--force : Jalankan tanpa konfirmasi interaktif}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tarik dan sinkronkan seluruh database dan file media/aset dari Server Online (Railway) ke Local';

    protected ServerSyncService $syncService;

    public function __construct(ServerSyncService $syncService)
    {
        parent::__construct();
        $this->syncService = $syncService;
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info("==================================================================");
        $this->info("   SINKRONISASI SERVER ONLINE (RAILWAY) ➔ LOCAL DEVELOPMENT       ");
        $this->info("==================================================================");

        $serverUrl = $this->option('url') ?: config('services.sync.server_url') ?: env('SYNC_SERVER_URL');
        $secretToken = $this->option('token') ?: config('services.sync.secret_token') ?: env('SYNC_SECRET_TOKEN');

        if (empty($serverUrl)) {
            $serverUrl = $this->ask('Masukkan URL Server Online Anda (contoh: https://ortotik-production.up.railway.app)');
        }

        if (empty($secretToken)) {
            $secretToken = $this->secret('Masukkan SYNC_SECRET_TOKEN server');
        }

        if (empty($serverUrl) || empty($secretToken)) {
            $this->error('Error: URL Server dan Secret Token wajib diisi.');
            return 1;
        }

        $syncDb = !$this->option('no-db');
        $syncAssets = !$this->option('no-assets');

        $this->line("Target Server : <comment>{$serverUrl}</comment>");
        $this->line("Sync Database : " . ($syncDb ? "<info>YA</info>" : "<fg=gray>TIDAK</fg=gray>"));
        $this->line("Sync Assets   : " . ($syncAssets ? "<info>YA</info>" : "<fg=gray>TIDAK</fg=gray>"));
        $this->newLine();

        // 1. Test Connection
        $this->output->write("⏳ Menguji koneksi ke server...");
        $connTest = $this->syncService->testConnection($serverUrl, $secretToken);
        if (!$connTest['success']) {
            $this->output->writeln(" <fg=red>[GAGAL]</fg=red>");
            $this->error($connTest['message']);
            return 1;
        }
        $this->output->writeln(" <info>[TERHUBUNG]</info>");

        if (isset($connTest['server_info']['data'])) {
            $info = $connTest['server_info']['data'];
            $this->table(
                ['Statistik Server Online', 'Jumlah'],
                [
                    ['Total Tabel Database', $info['database_tables'] ?? '-'],
                    ['Total Baris Data', number_format($info['database_rows'] ?? 0)],
                    ['Ukuran Database', $info['database_size'] ?? '-'],
                    ['File Aset Media (Storage)', ($info['assets_count'] ?? 0) . " file (" . ($info['assets_size'] ?? '-') . ")"],
                ]
            );
        }

        if (!$this->option('force')) {
            $confirmed = $this->confirm('Apakah Anda yakin ingin menimpa database & file aset di LOCAL dengan data dari server?', true);
            if (!$confirmed) {
                $this->warn('Proses sinkronisasi dibatalkan.');
                return 0;
            }
        }

        // 2. Perform Pull & Sync
        $this->newLine();
        $this->output->write("🚀 Mengunduh snapshot paket dari server...");
        
        try {
            $result = $this->syncService->pullFromServer($serverUrl, $secretToken, $syncDb, $syncAssets);
            
            $this->output->writeln(" <info>[SELESAI]</info>");
            $this->newLine();
            $this->info("✅ " . $result['message']);
            $this->newLine();
            $this->line("Localhost Anda sekarang sudah 100% sinkron dengan data dan aset terbaru dari server.");
            return 0;
        } catch (Exception $e) {
            $this->output->writeln(" <fg=red>[ERROR]</fg=red>");
            $this->error("Gagal melakukan sinkronisasi: " . $e->getMessage());
            return 1;
        }
    }
}
