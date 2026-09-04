<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('custom_products')) {
            DB::table('custom_products')
                ->where('slug', 'kaki-palsu-bawah-lutut-carbon-custom')
                ->update([
                    'summary' => 'Casting gips secara presisi. Dengan pilihan suspensi standar, silicone lock & berbagai jenis telapak kaki sesuai kebutuhan.',
                    'workflow_steps' => json_encode([
                        ['step' => 1, 'title' => 'Konsultasi & Casting Gips Presisi', 'desc' => 'Pemeriksaan kondisi stump dan proses casting gips secara presisi.'],
                        ['step' => 2, 'title' => 'Fabrikasi Soket Presisi', 'desc' => 'Pencetakan soket carbon fiber berkualitas tinggi di workshop medik.'],
                        ['step' => 3, 'title' => 'Pemasangan & Dynamic Alignment', 'desc' => 'Penyetelan sudut keseimbangan dan uji coba berjalan.'],
                        ['step' => 4, 'title' => 'Gait Training & Garansi', 'desc' => 'Latihan pola jalan mandiri dan garansi penyesuaian fitting gratis.']
                    ]),
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('custom_products')) {
            DB::table('custom_products')
                ->where('slug', 'kaki-palsu-bawah-lutut-carbon-custom')
                ->update([
                    'summary' => 'Prostesis bawah lutut dengan soket cetak presisi 3D, silikon suspension lock, dan telapak kaki carbon dinamis.',
                    'workflow_steps' => json_encode([
                        ['step' => 1, 'title' => 'Konsultasi & 3D Scanning', 'desc' => 'Pemeriksaan kondisi stump dan pemindaian 3D non-invasif.'],
                        ['step' => 2, 'title' => 'Fabrikasi Soket Presisi', 'desc' => 'Pencetakan soket carbon fiber berkualitas tinggi di workshop medik.'],
                        ['step' => 3, 'title' => 'Pemasangan & Dynamic Alignment', 'desc' => 'Penyetelan sudut keseimbangan dan uji coba berjalan.'],
                        ['step' => 4, 'title' => 'Gait Training & Garansi', 'desc' => 'Latihan pola jalan mandiri dan garansi penyesuaian fitting gratis.']
                    ]),
                ]);
        }
    }
};
