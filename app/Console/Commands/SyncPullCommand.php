<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ServerSyncService;
use Symfony\Component\Console\Helper\ProgressBar;
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
                            {--timeout=1800 : Batas waktu unduh dalam detik (default: 1800s / 30 menit, gunakan 0 untuk tanpa batas)}
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
        $timeout = (int) ($this->option('timeout') ?? 1800);

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
        $this->line("Batas Timeout : <comment>" . ($timeout > 0 ? "{$timeout} detik (" . round($timeout / 60, 1) . " menit)" : "Tanpa Batas (0)") . "</comment>");
        $this->newLine();

        // 1. Test Connection
        $this->output->write("⏳ Menguji koneksi ke server...");
        $connTest = $this->syncService->testConnection($serverUrl, $secretToken);
        if (!$connTest['success']) {
            $this->output->writeln(" <fg=red>[GAGAL]</fg=red>");
            $this->newLine();
            $errorInfo = ServerSyncService::parseSyncError(new Exception($connTest['message']), [
                'server_url' => $serverUrl,
            ]);
            $this->renderErrorBox($errorInfo);
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
        $this->info("🚀 Memulai proses sinkronisasi dari server...");
        $this->newLine();

        /** @var ProgressBar|null $progressBar */
        $progressBar = null;
        $progressData = [];
        $downloadInitialized = false;

        ProgressBar::setPlaceholderFormatterDefinition('sync_current', function () use (&$progressData) {
            return $progressData['downloaded_formatted'] ?? '0 B';
        });
        ProgressBar::setPlaceholderFormatterDefinition('sync_max', function () use (&$progressData) {
            return $progressData['total_formatted'] ?? '0 B';
        });
        ProgressBar::setPlaceholderFormatterDefinition('sync_speed', function () use (&$progressData) {
            return $progressData['speed_formatted'] ?? '0 B/s';
        });
        ProgressBar::setPlaceholderFormatterDefinition('sync_eta', function () use (&$progressData) {
            return $progressData['eta_formatted'] ?? '--:--';
        });

        $statusCallback = function (string $stage, mixed $data) use (
            &$progressBar,
            &$progressData,
            &$downloadInitialized
        ) {
            if (is_array($data)) {
                $progressData = array_merge($progressData, $data);
            }

            switch ($stage) {
                case 'init':
                    $this->output->writeln("⏳ <fg=yellow>[1/4]</fg=yellow> Menghubungi server & menunggu server menyiapkan arsip snapshot...");
                    $this->line("   <fg=gray>(Server sedang mengekspor SQL database & mengompres berkas storage)</fg=gray>");
                    break;

                case 'downloading':
                    if (!$downloadInitialized) {
                        $downloadInitialized = true;
                        $this->newLine();
                        $this->output->writeln("📥 <fg=yellow>[2/4]</fg=yellow> Mengunduh arsip snapshot dari server:");

                        $total = ($data['total_bytes'] ?? 0) > 0 ? (int) $data['total_bytes'] : 100;
                        $progressBar = $this->output->createProgressBar($total);
                        $progressBar->setBarWidth(32);
                        $progressBar->setFormat("   %sync_current% / %sync_max% [%bar%] <info>%percent:3s%%</info> | <comment>%sync_speed%</comment> | Sisa: <fg=cyan>%sync_eta%</fg=cyan>");
                        $progressBar->start();
                    }

                    if ($progressBar) {
                        $totalBytes = (int) ($data['total_bytes'] ?? 0);
                        if ($totalBytes > 0 && $progressBar->getMaxSteps() !== $totalBytes) {
                            $progressBar->setMaxSteps($totalBytes);
                        }
                        $progressBar->setProgress((int) ($data['downloaded_bytes'] ?? 0));
                    }
                    break;

                case 'download_completed':
                    if ($progressBar) {
                        $progressBar->finish();
                        $this->newLine();
                    }
                    $this->line("   <info>✅ Unduhan selesai ({$data['total_formatted']} dalam {$data['duration_seconds']}s | Rata-rata: {$data['average_speed_formatted']})</info>");
                    $this->newLine();
                    break;

                case 'extracting':
                    $this->output->write("📦 <fg=yellow>[3/4]</fg=yellow> Mengekstrak paket arsip ZIP...");
                    break;

                case 'extracted':
                    $this->output->writeln(" <info>[SELESAI]</info>");
                    $this->newLine();
                    $this->output->writeln("🗄️  <fg=yellow>[4/4]</fg=yellow> Menerapkan data & aset ke local environment:");
                    break;

                case 'syncing_db':
                    $this->output->write("   ├─ Mengimpor struktur dan data database MySQL...");
                    break;

                case 'db_synced':
                    $this->output->writeln(" <info>[SELESAI ({$data['queries_executed']} query)]</info>");
                    break;

                case 'syncing_assets':
                    $this->output->write("   └─ Menyalin file aset media ke storage/app/public...");
                    break;

                case 'assets_synced':
                    $this->output->writeln(" <info>[SELESAI ({$data['assets_count']} file)]</info>");
                    break;
            }
        };

        try {
            $result = $this->syncService->pullFromServer(
                $serverUrl,
                $secretToken,
                $syncDb,
                $syncAssets,
                $statusCallback,
                $timeout
            );

            $this->newLine();
            $this->info("==================================================================");
            $this->info("✅ SINKRONISASI BERHASIL 100%!");
            $this->info("==================================================================");
            $this->line($result['message']);
            $this->newLine();
            $this->line("Localhost Anda sekarang sudah <info>100% sinkron</info> dengan data dan aset terbaru dari server online.");
            return 0;

        } catch (Exception $e) {
            if ($progressBar) {
                $this->newLine();
            }

            $errorInfo = ServerSyncService::parseSyncError($e, [
                'server_url' => $serverUrl,
                'downloaded_bytes' => $progressData['downloaded_bytes'] ?? null,
                'total_bytes' => $progressData['total_bytes'] ?? null,
                'timeout' => $timeout,
            ]);

            $this->renderErrorBox($errorInfo);
            return 1;
        }
    }

    /**
     * Render structured error box with title, details, and actionable solution suggestions.
     */
    protected function renderErrorBox(array $errorInfo): void
    {
        $this->newLine();
        $this->output->writeln("<fg=white;bg=red;options=bold> ================================================================== </>");
        $this->output->writeln("<fg=white;bg=red;options=bold>  ❌ GAGAL MELAKUKAN SINKRONISASI DARI SERVER ONLINE               </>");
        $this->output->writeln("<fg=white;bg=red;options=bold> ================================================================== </>");
        $this->newLine();

        $this->line("  <fg=yellow;options=bold>📌 Masalah         :</fg=yellow;options=bold> <options=bold>{$errorInfo['title']}</options=bold>");
        if (!empty($errorInfo['server_url'])) {
            $this->line("  <fg=yellow;options=bold>🌐 Server Target   :</fg=yellow;options=bold> {$errorInfo['server_url']}");
        }
        $this->line("  <fg=yellow;options=bold>📝 Penjelasan      :</fg=yellow;options=bold> {$errorInfo['detail']}");

        if (!empty($errorInfo['raw_message']) && $errorInfo['raw_message'] !== $errorInfo['detail']) {
            $this->newLine();
            $this->line("  <fg=gray>Pesan Error Asli: {$errorInfo['raw_message']}</fg=gray>");
        }

        if (!empty($errorInfo['suggestions'])) {
            $this->newLine();
            $this->line("  <fg=green;options=bold>💡 REKOMENDASI SOLUSI / CARA MENGATASI:</fg=green;options=bold>");
            foreach ($errorInfo['suggestions'] as $idx => $suggestion) {
                $num = $idx + 1;
                $this->line("  <fg=cyan;options=bold>{$num}.</fg=cyan;options=bold> {$suggestion}");
            }
        }

        $this->newLine();
        $this->line("<fg=gray>==================================================================</fg=gray>");
    }
}

