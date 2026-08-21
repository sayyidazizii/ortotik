<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class KakiPalsuJogjaArticleSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $cat = Category::where('slug', 'panduan-pasien')->first() 
            ?? Category::where('type', 'article')->first();

        $content = '<p class="lead text-lg text-slate-700 font-medium leading-relaxed mb-6">
    Bagi penyandang disabilitas atau pasien yang baru saja menjalani tindakan amputasi akibat trauma kecelakaan, diabetes, maupun kelainan bawaan, menemukan <strong>layanan pembuatan kaki palsu di Jogja</strong> yang terpercaya, nyaman, dan presisi adalah langkah awal yang sangat krusial untuk mengembalikan kemandirian bergerak dan kualitas hidup.
</p>

<p class="mb-6 leading-relaxed text-slate-700">
    Di <strong>pediOcare Yogyakarta</strong>, kami meyakini bahwa setiap langkah adalah pencapaian berharga <em>(Care your milestone)</em>. Lebih dari satu dekade kami berdedikasi menghadirkan solusi prostesis individual (custom-made) yang didesain secara khusus mengikuti kontur anatomis dan biomekanik tubuh setiap pasien.
</p>

<h2 class="text-xl sm:text-2xl font-bold text-slate-900 mt-8 mb-4 border-b border-slate-100 pb-2 flex items-center gap-2">
    <span>Mengapa Memilih Kaki Palsu di pediOcare Jogja?</span>
</h2>

<p class="mb-4 leading-relaxed text-slate-700">
    Memilih tempat pembuatan kaki palsu tidak boleh sembarangan. Kaki palsu yang kurang presisi dapat menyebabkan lecet pada stump (puntung), nyeri punggung, hingga pola jalan yang pincang. Berikut keunggulan layanan ortotik prostetik di pediOcare Jogja:
</p>

<ul class="space-y-3 mb-6 list-disc list-inside text-slate-700">
    <li><strong>Tenaga Klinis Tersertifikasi Resmi (STR & SIP Kemenkes):</strong> Dikerjakan langsung oleh tim Ortotis-Prostetis lulusan profesi resmi yang memahami secara mendalam kaidah rehabilitasi medis dan anatomi muskuloskeletal.</li>
    <li><strong>100% Garansi Fitting & Kenyamanan Soket:</strong> Soket adalah komponen terpenting yang menghubungkan tubuh pasien dengan alat. Kami memberikan garansi penyesuaian (fitting) hingga pasien merasa nyaman dan bebas lecet.</li>
    <li><strong>Material Ringan & Berkualitas Internasional:</strong> Pilihan material mulai dari resin laminasi fiber, thermoplastic tahan lama, hingga <em>carbon fiber composite</em> yang sangat ringan dan kuat.</li>
    <li><strong>Komponen Sendi & Telapak Bionik:</strong> Menggunakan pilihan kaki dinamis <em>(Dynamic Response Foot)</em>, sendi lutut mekanik/hidrolik bersertifikasi standar mutu global.</li>
    <li><strong>Fasilitas Pelatihan Berjalan (Gait Training):</strong> Dilengkapi paralel bar dan tim terapis untuk melatih pola jalan pasien dari awal hingga mandiri beraktivitas normal.</li>
</ul>

<h2 class="text-xl sm:text-2xl font-bold text-slate-900 mt-8 mb-4 border-b border-slate-100 pb-2 flex items-center gap-2">
    <span>Jenis-Jenis Kaki Palsu yang Diproduksi di pediOcare</span>
</h2>

<p class="mb-4 leading-relaxed text-slate-700">
    Berdasarkan level amputasi dan kebutuhan mobilitas pasien, kami memproduksi berbagai jenis kaki palsu:
</p>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-6">
    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
        <h3 class="font-bold text-primary text-base">1. Kaki Palsu Bawah Lutut (Transtibial)</h3>
        <p class="text-xs text-slate-600 leading-relaxed">
            Dikhususkan bagi pasien dengan amputasi di bawah sendi lutut. Menggunakan sistem suspensi terkini (pin lock, shuttle lock, atau vacuum suction) agar menempel erat dan stabil saat melangkah.
        </p>
    </div>
    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
        <h3 class="font-bold text-primary text-base">2. Kaki Palsu Atas Lutut (Transfemoral)</h3>
        <p class="text-xs text-slate-600 leading-relaxed">
            Dilengkapi unit sendi lutut mekanik atau hidrolik presisi untuk memberikan keamanan fase tumpuan <em>(stance phase)</em> dan kelembutan ayunan <em>(swing phase)</em> saat berjalan.
        </p>
    </div>
    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
        <h3 class="font-bold text-primary text-base">3. Kaki Palsu Disartikulasi Lutut (Through-Knee)</h3>
        <p class="text-xs text-slate-600 leading-relaxed">
            Dirancang khusus untuk amputasi tepat pada sendi lutut dengan soket anatomis berkekuatan tinggi tanpa menekan ujung tulang.
        </p>
    </div>
    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
        <h3 class="font-bold text-primary text-base">4. Prostesis Telapak Kaki (Chopart / Syme / Lisfranc)</h3>
        <p class="text-xs text-slate-600 leading-relaxed">
            Solusi prostesis parsial untuk amputasi telapak kaki atau pergelangan kaki dengan insole kosmetik yang menyerupai bentuk kaki asli.
        </p>
    </div>
</div>

<h2 class="text-xl sm:text-2xl font-bold text-slate-900 mt-8 mb-4 border-b border-slate-100 pb-2">
    <span>9 Alur Prosedur Pelayanan Kaki Palsu di pediOcare Jogja</span>
</h2>

<p class="mb-4 leading-relaxed text-slate-700">
    Untuk menjamin kualitas dan kenyamanan maksimal, setiap pasien akan melalui 9 tahapan SOP pelayanan standar medis:
</p>

<ol class="space-y-2 mb-6 list-decimal list-inside text-slate-700 text-sm">
    <li><strong>Penerimaan Klien (Admission):</strong> Konsultasi awal, riwayat kesehatan, dan pendataan kebutuhan aktivitas sehari-hari.</li>
    <li><strong>Asesmen & Pengukuran (Assessment):</strong> Pemeriksaan fisik kondisi puntung, rentang gerak sendi (ROM), kekuatan otot, dan gait analysis.</li>
    <li><strong>Perumusan Resep Prostetik (Prescription):</strong> Menentukan desain soket, jenis telapak, dan komponen terbaik sesuai budget & mobilitas.</li>
    <li><strong>Pencetakan Gips / Scanning 3D (Casting):</strong> Mengambil cetakan negatif anatomis tubuh dengan plester gips presisi tinggi.</li>
    <li><strong>Modifikasi Model Positif (Rectification):</strong> Membentuk titik tumpuan beban (weight-bearing area) dan relief zona sensitif tulang.</li>
    <li><strong>Fabrikasi & Perakitan (Fabrication):</strong> Proses laminasi soket berkualitas dan perakitan alignment sudut sumbu biomekanik.</li>
    <li><strong>Uji Coba Pengepasan (Fitting):</strong> Pasien mencoba soket, memeriksa tekanan dan keselarasan langkah kaki.</li>
    <li><strong>Penyerahan & Edukasi (Delivery & Check Out):</strong> Serah terima kaki palsu resmi beserta panduan pemakaian dan perawatan mandiri.</li>
    <li><strong>Evaluasi Berkala (Follow Up):</strong> Pemantauan rutin 1 bulan, 3 bulan, dan 6 bulan pasca pemakaian untuk memastikan kenyamanan jangka panjang.</li>
</ol>

<div class="my-8 p-6 rounded-3xl bg-gradient-to-r from-teal-900 to-slate-900 text-white shadow-xl flex flex-col sm:flex-row items-center justify-between gap-6">
    <div class="space-y-1 text-center sm:text-left">
        <span class="text-xs font-bold text-teal-300 uppercase tracking-wider">Konsultasi Gratis Kaki Palsu Jogja</span>
        <h3 class="text-lg sm:text-xl font-black">Ingin Konsultasi Kondisi Kaki Anda?</h3>
        <p class="text-xs text-slate-300 max-w-md">Kunjungi klinik kami di Sleman Yogyakarta atau hubungi WhatsApp untuk jadwal pemeriksaan.</p>
    </div>
    <a href="https://wa.me/6285697922194?text=Halo%20pediOcare%20Jogja,%20saya%20ingin%20konsultasi%20mengenai%20pembuatan%20kaki%20palsu." target="_blank" rel="noopener noreferrer" class="px-6 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs uppercase tracking-wider shadow-md transition-all shrink-0">
        Chat WhatsApp Kami
    </a>
</div>

<h2 class="text-xl sm:text-2xl font-bold text-slate-900 mt-8 mb-4 border-b border-slate-100 pb-2">
    <span>Lokasi Klinik Pembuatan Kaki Palsu pediOcare Jogja</span>
</h2>

<p class="mb-4 leading-relaxed text-slate-700">
    Klinik utama pediOcare berlokasi strategis di <strong>Jl. Kaliurang KM 8.5, Sinduharjo, Ngaglik, Sleman, D.I. Yogyakarta 55581</strong>. Kami melayani pasien dari seluruh wilayah Yogyakarta (Kota Jogja, Sleman, Bantul, Kulon Progo, Gunungkidul), Jawa Tengah (Klaten, Solo, Magelang, Purworejo), hingga luar pulau.
</p>';

        Article::updateOrCreate(
            ['slug' => 'layanan-pembuatan-kaki-palsu-jogja-pediocare'],
            [
                'user_id' => $user ? $user->id : 1,
                'category_id' => $cat ? $cat->id : null,
                'title' => 'Layanan Pembuatan Kaki Palsu Jogja: Solusi Kaki Palsu Nyaman, Ringan & Bergaransi',
                'summary' => 'Pusat pembuatan kaki palsu Jogja berkualitas tinggi & bergaransi fitting di pediOcare Yogyakarta. Dikerjakan oleh tim Ortotis-Prostetis berlisensi resmi Kemenkes RI dengan standar 9 tahapan klinis.',
                'content' => $content,
                'thumbnail' => 'images/client_update/image3.png',
                'read_time' => 5,
                'views_count' => 184,
                'is_published' => true,
                'published_at' => now(),
                'meta_title' => 'Layanan Pembuatan Kaki Palsu Jogja Berkualitas | Klinik pediOcare',
                'meta_description' => 'Mencari pembuatan kaki palsu Jogja? Kunjungi klinik pediOcare Sleman, Yogyakarta. Kaki palsu bawah/atas lutut presisi, ringan, dan 100% bergaransi fitting.',
            ]
        );
    }
}
