<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Branch;
use App\Models\Category;
use App\Models\CustomProduct;
use App\Models\MedicalService;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Super Admin Account
        $admin = User::firstOrCreate(
            ['email' => 'admin@ortotik.co.id'],
            [
                'name' => 'Super Admin Ortotik',
                'password' => Hash::make('PasswordOrtotik2026!'),
                'role' => 'superadmin',
            ]
        );

        // 2. Categories
        // Service Categories
        $catOrtotik = Category::create([
            'name' => 'Ortotik (Brace & Insole Medis)',
            'slug' => 'ortotik',
            'type' => 'service',
            'description' => 'Layanan alat bantu penopang, penyangga, dan pengoreksi sistem muskuloskeletal tubuh.',
            'order_position' => 1,
        ]);

        $catProstetik = Category::create([
            'name' => 'Prostetik (Kaki & Tangan Palsu)',
            'slug' => 'prostetik',
            'type' => 'service',
            'description' => 'Layanan penggantian anggota tubuh yang hilang dengan prostesis fungsional modern.',
            'order_position' => 2,
        ]);

        $catSkoliosis = Category::create([
            'name' => 'Scoliosis Care & Spine Correction',
            'slug' => 'skoliosis-care',
            'type' => 'service',
            'description' => 'Pusat koreksi kelainan tulang belakang dan penanganan skoliosis terpadu.',
            'order_position' => 3,
        ]);

        $catRehab = Category::create([
            'name' => 'Rehabilitasi & Fisioterapi',
            'slug' => 'rehabilitasi',
            'type' => 'service',
            'description' => 'Pemulihan fungsi gerak, adaptasi alat bantu, dan terapi neuro robotik.',
            'order_position' => 4,
        ]);

        // Product Anatomy Categories
        $catCervical = Category::create([
            'name' => 'Leher (Cervical)',
            'slug' => 'leher-cervical',
            'type' => 'product',
            'description' => 'Penyangga leher untuk pasca cedera servikal, whiplash, dan pasca operasi leher.',
            'order_position' => 1,
        ]);

        $catShoulder = Category::create([
            'name' => 'Bahu & Lengan (Shoulder & Arm)',
            'slug' => 'bahu-lengan',
            'type' => 'product',
            'description' => 'Alat imobilisasi bahu pasca dislokasi, fraktur humerus, dan cedera rotator cuff.',
            'order_position' => 2,
        ]);

        $catSpine = Category::create([
            'name' => 'Punggung & Pinggang (Spine & Lumbar)',
            'slug' => 'punggung-spine',
            'type' => 'product',
            'description' => 'Korset lumbar, TLSO, dan penyangga tulang belakang untuk HNP / saraf terjepit dan stabilitas postur.',
            'order_position' => 3,
        ]);

        $catKnee = Category::create([
            'name' => 'Lutut & Panggul (Knee & Hip)',
            'slug' => 'lutut-knee',
            'type' => 'product',
            'description' => 'Brace ligamen lutut (ACL/PCL/MCL), unloading brace untuk osteoarthritis, dan immobilizer sendi.',
            'order_position' => 4,
        ]);

        $catAnkle = Category::create([
            'name' => 'Kaki & Pergelangan (Ankle & Foot)',
            'slug' => 'kaki-ankle-foot',
            'type' => 'product',
            'description' => 'Walker boot, AFO, insole medis ortopedi, dan ankle support untuk cedera pergelangan kaki.',
            'order_position' => 5,
        ]);

        $catWrist = Category::create([
            'name' => 'Pergelangan Tangan & Jari (Wrist & Hand)',
            'slug' => 'pergelangan-tangan',
            'type' => 'product',
            'description' => 'Splint carpal tunnel syndrome, finger splint, dan brace imobilisasi pergelangan tangan.',
            'order_position' => 6,
        ]);

        // Article Categories
        $catArticleEdu = Category::create([
            'name' => 'Edukasi Medis & Kesehatan',
            'slug' => 'edukasi-medis',
            'type' => 'article',
            'description' => 'Informasi terpercaya seputar kesehatan tulang, sendi, dan ortotik prostetik.',
            'order_position' => 1,
        ]);

        $catArticleGuide = Category::create([
            'name' => 'Panduan Pasien & Pemulihan',
            'slug' => 'panduan-pasien',
            'type' => 'article',
            'description' => 'Tips perawatan alat bantu gerak, latihan rehabilitasi di rumah, dan nutrisi pemulihan.',
            'order_position' => 2,
        ]);

        // 3. Medical Services (5 Pilar Utama)
        $svcProsthetic = MedicalService::create([
            'category_id' => $catProstetik->id,
            'title' => 'Prosthetics (Kaki & Tangan Palsu Berteknologi Tinggi)',
            'slug' => 'prosthetics',
            'summary' => 'Pembuatan kaki dan tangan palsu berstandar internasional dengan soket presisi 3D scan, material carbon fiber ringan, dan komponen modular bionik.',
            'content' => '<h3>Solusi Mobilitas Purna Mandiri Pasca Amputasi</h3>
            <p>Klinik Ortotik & Prostetik kami melayani pembuatan alat prostesis komprehensif mulai dari konsultasi awal, pencetakan soket berteknologi 3D CAD/CAM, pemilihan komponen sendi hidrolik/pneumatik, hingga program gait training intensif.</p>
            <h4>Keunggulan Layanan Prostetik Kami:</h4>
            <ul>
                <li><strong>Custom Socket Fit Presisi:</strong> Menggunakan silicone liner medis bebas iritasi dan sistem vacuum suspension modern.</li>
                <li><strong>Material Ultralight Carbon Fiber:</strong> Ringan, kokoh, dan tahan lama untuk aktivitas harian hingga olahraga.</li>
                <li><strong>Garansi Kenyamanan & Fitting:</strong> Monitoring berkala penyesuaian volume stump pasien hingga berjalan normal tanpa pincang.</li>
            </ul>',
            'icon_name' => 'Activity',
            'indications' => [
                'Pasca amputasi bawah lutut (Transtibial)',
                'Pasca amputasi atas lutut (Transfemoral)',
                'Disartikulasi panggul atau lutut',
                'Amputasi lengan bawah atau atas',
                'Penggantian prostesis lama yang longgar / sakit'
            ],
            'meta_title' => 'Layanan Kaki & Tangan Palsu Presisi Medis - Ortotik Prostetik',
            'meta_description' => 'Pembuatan kaki palsu bawah lutut, atas lutut, dan tangan palsu bionik berkualitas internasional dengan garansi fitting.',
            'order_position' => 1,
            'is_active' => true,
        ]);

        $svcBracing = MedicalService::create([
            'category_id' => $catOrtotik->id,
            'title' => 'Bracing & Orthopaedic Supports',
            'slug' => 'bracing-supports',
            'summary' => 'Penyangga ortopedi medis untuk koreksi sudut kelainan anatomi sendi, stabilisasi pasca cedera ligamen, dan penanganan drop foot.',
            'content' => '<h3>Penyangga Sendi & Tulang Medis Berstandar Global</h3>
            <p>Kami merancang dan memproduksi custom brace seperti KAFO (Knee Ankle Foot Orthosis), AFO (Ankle Foot Orthosis), serta custom orthotic insole untuk membantu anak-anak dengan kelainan tumbuh kembang maupun orang dewasa pasca stroke/trauma.</p>',
            'icon_name' => 'Shield',
            'indications' => [
                'Koreksi Kaki O (Genu Varum) & Kaki X (Genu Valgum)',
                'Drop Foot akibat Stroke / Cedera Saraf Peroneal',
                'Osteoarthritis Lutut Derajat 1-4',
                'Cedera Ligamen Lutut (ACL, PCL, MCL, LCL)',
                'Flat Foot (Telapak Kaki Datar) & Nyeri Plantar Fasciitis'
            ],
            'meta_title' => 'Penyangga Medis & Brace Korektif Ortopedi - Ortotik Prostetik',
            'meta_description' => 'Solusi brace ortopedi custom dan ready stock untuk koreksi kaki O, kaki X, drop foot, dan sendi lutut.',
            'order_position' => 2,
            'is_active' => true,
        ]);

        $svcScoliosis = MedicalService::create([
            'category_id' => $catSkoliosis->id,
            'title' => 'Scoliosis Center (Koreksi Skoliosis Medis)',
            'slug' => 'scoliosis-center',
            'summary' => 'Pusat penanganan skoliosis non-operatif terpadu menggunakan korset korektif 3D Cheneau Style TLSO dengan presisi pemindaian 3D scan.',
            'content' => '<h3>Koreksi Kurva Skoliosis Remaja & Dewasa Tanpa Operasi</h3>
            <p>Melalui evaluasi biomekanik menyeluruh dan analisa rotasi tulang belakang berbasis radiologi, kami membuat brace skoliosis 3D custom yang aktif mendorong de-rotasi kurva saat anak bertumbuh.</p>',
            'icon_name' => 'Layers',
            'indications' => [
                'Skoliosis Idiopatik Remaja (AIS) Sudut Cobb 20° - 45°',
                'Ketidaksimetrisan bahu dan pinggul pada anak',
                'Nyeri punggung kronis akibat kelainan postur',
                'Pemantauan berkala sudut Cobb pra dan pasca bracing'
            ],
            'meta_title' => 'Pusat Penanganan & Korset Skoliosis 3D - Ortotik Prostetik',
            'meta_description' => 'Korset skoliosis 3D Cheneau TLSO custom fit untuk meluruskan tulang belakang anak dan remaja tanpa operasi.',
            'order_position' => 3,
            'is_active' => true,
        ]);

        $svcPhysio = MedicalService::create([
            'category_id' => $catRehab->id,
            'title' => 'Physiotherapy & Gait Rehabilitation',
            'slug' => 'physiotherapy',
            'summary' => 'Layanan fisioterapi muskuloskeletal, latihan pola jalan fungsional (Gait Training), dan adaptasi penggunaan alat bantu ortosis/prostesis.',
            'content' => '<h3>Pemulihan Gerak & Pola Jalan Mandiri</h3>
            <p>Fisioterapis klinis kami mendampingi pasien dalam latihan penguatan otot stump, keseimbangan tubuh, dan teknik melangkah alami saat menggunakan kaki palsu atau brace ortopedi.</p>',
            'icon_name' => 'HeartPulse',
            'indications' => [
                'Latihan adaptasi kaki palsu baru',
                'Rehabilitasi pasca cedera olahraga dan operasi sendi',
                'Pelemahan otot tungkai bawah'
            ],
            'meta_title' => 'Fisioterapi & Latihan Pola Jalan - Ortotik Prostetik',
            'meta_description' => 'Layanan fisioterapi khusus adaptasi prostesis dan pemulihan gerak sendi.',
            'order_position' => 4,
            'is_active' => true,
        ]);

        $svcNeuro = MedicalService::create([
            'category_id' => $catRehab->id,
            'title' => 'Neuro Robotic Rehabilitation',
            'slug' => 'neuro-robotic',
            'summary' => 'Terapi pemulihan neuro-motorik canggih berbasis robotik eksoskeleton dan sensor biofeedback untuk pasien stroke & cedera saraf medula spinalis.',
            'content' => '<h3>Teknologi Rehabilitasi Robotik Modern</h3>
            <p>Kombinasi robotik eksoskeleton terkomputerisasi membantu menstimulasi jalur saraf motorik otak pasien secara repetitif, presisi, dan terukur.</p>',
            'icon_name' => 'Cpu',
            'indications' => [
                'Hemiparesis pasca Stroke',
                'Spinal Cord Injury (Cedera Medula Spinalis)',
                'Cerebral Palsy pada anak',
                'Gangguan kontrol motorik ekstremitas'
            ],
            'meta_title' => 'Rehabilitasi Neuro Robotik - Ortotik Prostetik',
            'meta_description' => 'Terapi robotik eksoskeleton modern untuk rehabilitasi stroke dan gangguan saraf motorik.',
            'order_position' => 5,
            'is_active' => true,
        ]);

        // 4. Products (E-Katalog Ready Stock)
        Product::create([
            'category_id' => $catCervical->id,
            'medical_service_id' => $svcBracing->id,
            'name' => 'ASPEN Vista Adjustable Cervical Collar',
            'slug' => 'aspen-vista-adjustable-cervical-collar',
            'sku' => 'ASP-VIST-01',
            'price' => 1850000,
            'discount_price' => 1650000,
            'stock_status' => 'in_stock',
            'thumbnail' => '/images/products/cervical-collar.jpg',
            'excerpt' => 'Kolar leher medis premium dengan 6 tingkat penyesuaian tinggi untuk imobilisasi servikal presisi.',
            'description' => '<p>ASPEN Vista Collar dirancang untuk membatasi gerak leher pasca trauma servikal atau pasca operasi dengan bantalan busa breathable anti-dekubitus yang nyaman digunakan jangka panjang.</p>',
            'medical_indications' => 'Trauma servikal, pasca operasi fusi tulang leher, radikulopati servikal, sprain leher berat.',
            'specifications' => [
                'Bahan' => 'High-Density Polyethylene & Busa Antimikroba',
                'Ukuran' => 'Universal (Tinggi & Lingkar Dapat Disesuaikan)',
                'Fitur' => 'Dial penyesuaian 6 titik tinggi, bukaan trakeostomi besar'
            ],
            'is_featured' => true,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $catKnee->id,
            'medical_service_id' => $svcBracing->id,
            'name' => 'DonJoy Armor Knee Brace with FourcePoint',
            'slug' => 'donjoy-armor-knee-brace',
            'sku' => 'DJ-ARM-FP',
            'price' => 9500000,
            'discount_price' => 8900000,
            'stock_status' => 'in_stock',
            'thumbnail' => '/images/products/knee-brace-armor.jpg',
            'excerpt' => 'Brace pelindung ligamen lutut grade kompetisi untuk stabilitas maksimal pasca rekonstruksi ACL/PCL.',
            'description' => '<p>DonJoy Armor adalah standar emas brace lutut di dunia medis dan olahraga ekstrem dengan rangka aluminium 6061 T6 grade pesawat udara dan mekanisme engsel FourcePoint yang membatasi hyperextension berbahaya.</p>',
            'medical_indications' => 'Ketidakstabilan ACL, PCL, CI, pasca operasi ligamen lutut, proteksi olahraga ekstrem.',
            'specifications' => [
                'Rangka' => 'Aircraft Aluminum 6061 T6',
                'Sistem Engsel' => 'FourcePoint Technology 4-Points-of-Leverage',
                'Garansi' => 'Garansi Rangka 2 Tahun'
            ],
            'is_featured' => true,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $catAnkle->id,
            'medical_service_id' => $svcBracing->id,
            'name' => 'AirCast AirSelect Elite Fracture Walker Boot',
            'slug' => 'aircast-airselect-elite-walker',
            'sku' => 'AC-WALK-ELITE',
            'price' => 3200000,
            'discount_price' => 2950000,
            'stock_status' => 'in_stock',
            'thumbnail' => '/images/products/aircast-walker.jpg',
            'excerpt' => 'Boot gips modern dengan pompa kompresi udara terintegrasi untuk pemulihan patah tulang dan sprain ankle berat.',
            'description' => '<p>Pengganti gips konvensional yang memungkinkan pasien berjalan lebih nyaman dengan sol rocker bottom penyerap benturan dan bantalan udara Duplex ganda untuk meredakan bengkak.</p>',
            'medical_indications' => 'Fraktur stabil pergelangan kaki / metatarsal, sprain ligamen ankle grade 3, pasca operasi tendon achilles.',
            'specifications' => [
                'Bahan' => 'Semi-rigid shell dengan bantalan udara bergradasi',
                'Ukuran' => 'S, M, L, XL',
                'Fitur' => 'Selector dial pompa udara independen kiri-kanan'
            ],
            'is_featured' => true,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $catSpine->id,
            'medical_service_id' => $svcScoliosis->id,
            'name' => 'Cybertech Spinal Posture TLSO Support',
            'slug' => 'cybertech-spinal-posture-tlso',
            'sku' => 'CYB-TLSO-01',
            'price' => 4500000,
            'discount_price' => 4200000,
            'stock_status' => 'in_stock',
            'thumbnail' => '/images/products/tlso-brace.jpg',
            'excerpt' => 'Penyangga tulang belakang torakolumbal dengan pulley system mekanik bertenaga tinggi untuk dekompresi tulang belakang.',
            'description' => '<p>Memberikan stabilisasi superior dari tulang thoracal bawah hingga sacrum dengan tarikan tali presisi yang mudah dikencangkan bahkan oleh pasien lanjut usia.</p>',
            'medical_indications' => 'HNP Lumbal (Saraf Terjepit), Spondylolisthesis, Fraktur Kompresi Osteoporosis, Postur Kifosis.',
            'specifications' => [
                'Mekanisme' => 'Patented Mechanical Pulley Compression System',
                'Panel' => 'Ergonomic Anterior & Posterior Rigid Plates'
            ],
            'is_featured' => false,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $catAnkle->id,
            'medical_service_id' => $svcBracing->id,
            'name' => 'Custom Insole Medis 3D Scan Orthotic',
            'slug' => 'custom-insole-medis-3d-scan',
            'sku' => 'INS-3D-MED',
            'price' => 2200000,
            'discount_price' => 1950000,
            'stock_status' => 'in_stock',
            'thumbnail' => '/images/products/custom-insole.jpg',
            'excerpt' => 'Sol sepatu ortopedi cetak custom berbasis pemindaian dinamika telapak kaki 3D komputerisasi.',
            'description' => '<p>Mengoreksi lengkungan arcus telapak kaki yang rata (Flatfoot), meredakan nyeri tumit berlebih, dan mendistribusikan tekanan beban tubuh secara seimbang pada saat berdiri dan melangkah.</p>',
            'medical_indications' => 'Flat Foot / Pes Planus, Plantar Fasciitis (Nyeri Tumit), Heel Spur, Diabetic Foot Pressure Relief.',
            'specifications' => [
                'Bahan' => 'Multi-density EVA Medis & Poron XRD Shock Absorber',
                'Ketebalan' => '3mm - 6mm (Sesuai tipe sepatu kerja / lari / kasual)'
            ],
            'is_featured' => true,
            'is_active' => true,
        ]);

        // 5. Custom Made Products (P&O Showcase)
        CustomProduct::create([
            'name' => 'Kaki Palsu Bawah Lutut Carbon Fiber (Transtibial Custom Prosthesis)',
            'slug' => 'kaki-palsu-bawah-lutut-carbon-custom',
            'category_type' => 'prosthetic_leg',
            'thumbnail' => '/images/custom/transtibial-carbon.jpg',
            'summary' => 'Prostesis bawah lutut dengan soket cetak presisi 3D, silikon suspension lock, dan telapak kaki carbon dinamis.',
            'description' => '<p>Didesain khusus mengikuti anatomi tungkai sisa pasien dengan bobot super ringan namun mampu menahan beban aktifitas lari dan melompat.</p>',
            'indications' => ['Amputasi bawah lutut', 'Revisi soket kaki palsu lama'],
            'features' => [
                'Soket Carbon Fiber Ringan & Anti-Pecah',
                'Silicone Liner dengan Locking Pin System',
                'Dynamic Response Carbon Foot Blade',
                'Kosmetik Busa Waterproof Mirip Kulit Asli'
            ],
            'workflow_steps' => [
                ['step' => 1, 'title' => 'Konsultasi & 3D Scanning', 'desc' => 'Pemeriksaan kondisi stump dan pemindaian 3D non-invasif.'],
                ['step' => 2, 'title' => 'Fabrikasi Soket Presisi', 'desc' => 'Pencetakan soket carbon fiber berkualitas tinggi di workshop medik.'],
                ['step' => 3, 'title' => 'Pemasangan & Dynamic Alignment', 'desc' => 'Penyetelan sudut keseimbangan dan uji coba berjalan.'],
                ['step' => 4, 'title' => 'Gait Training & Garansi', 'desc' => 'Latihan pola jalan mandiri dan garansi penyesuaian fitting gratis.']
            ],
            'is_active' => true,
        ]);

        CustomProduct::create([
            'name' => 'Korset Skoliosis 3D Cheneau Style TLSO',
            'slug' => 'korset-skoliosis-3d-cheneau-tlso',
            'category_type' => 'scoliosis_brace',
            'thumbnail' => '/images/custom/scoliosis-cheneau-brace.jpg',
            'summary' => 'Brace koreksi skoliosis 3 dimensi berbasis de-rotasi aktif tanpa menghambat fungsi pernapasan anak.',
            'description' => '<p>Metode terbaik koreksi skoliosis non-bedah dengan ruang ekspansi bernapas yang nyaman dipakai 18-20 jam sehari.</p>',
            'indications' => ['Skoliosis idiopatik remaja', 'Sudut Cobb 20-45 derajat'],
            'features' => [
                'Desain asimetris 3D aktif de-rotasi kurva',
                'Material Polypropylene Medis Ringan & Hipoalergenik',
                'Dilengkapi ventilasi sirkulasi udara'
            ],
            'workflow_steps' => [
                ['step' => 1, 'title' => 'Analisa X-Ray & Scanner 3D', 'desc' => 'Perhitungan Cobb angle dan rotasi vertebra oleh klinisi.'],
                ['step' => 2, 'title' => 'Pemodelan CAD Korektif', 'desc' => 'Perancangan titik tekan (pressure pad) dan ruang ekspansi.'],
                ['step' => 3, 'title' => 'Fitting & Evaluasi Radiologi', 'desc' => 'Pengecekan in-brace correction untuk memastikan reduksi sudut.']
            ],
            'is_active' => true,
        ]);

        // 6. Branches
        Branch::create([
            'name' => 'Klinik Ortotik Cabang Jakarta Pusat (Pusat)',
            'city' => 'Jakarta Pusat',
            'address' => 'Jl. Salemba Raya No. 45, Paseban, Senen, Jakarta Pusat, DKI Jakarta 10440',
            'phone_number' => '021-3901234',
            'whatsapp_number' => '6281234567890',
            'email' => 'jakarta@ortotik.co.id',
            'google_maps_url' => 'https://maps.google.com/?q=Jakarta',
            'opening_hours' => 'Senin - Sabtu: 08:30 - 17:00 WIB',
            'image' => '/images/branches/jakarta.jpg',
            'is_main_branch' => true,
            'is_active' => true,
        ]);

        Branch::create([
            'name' => 'Klinik Ortotik Cabang Surabaya',
            'city' => 'Surabaya',
            'address' => 'Jl. Dharmahusada No. 88, Mojo, Kec. Gubeng, Surabaya, Jawa Timur 60285',
            'phone_number' => '031-5901234',
            'whatsapp_number' => '6281234567891',
            'email' => 'surabaya@ortotik.co.id',
            'google_maps_url' => 'https://maps.google.com/?q=Surabaya',
            'opening_hours' => 'Senin - Sabtu: 08:30 - 17:00 WIB',
            'image' => '/images/branches/surabaya.jpg',
            'is_main_branch' => false,
            'is_active' => true,
        ]);

        // 7. Testimonials
        Testimonial::create([
            'patient_name' => 'Bpk. Hendra Gunawan (45 th)',
            'patient_info' => 'Jakarta • Pasien Kaki Palsu Bawah Lutut',
            'service_used' => 'Kaki Palsu Transtibial Carbon',
            'testimony' => 'Setelah amputasi akibat kecelakaan, saya sempat putus asa. Alhamdulillah di Klinik Ortotik saya dibuatkan kaki palsu yang pas sekali di stump, tidak ada lecet sama sekali, dan sekarang saya sudah bisa mengemudi dan jogging kembali.',
            'photo' => '/images/testimonials/patient-1.jpg',
            'rating' => 5,
            'is_featured' => true,
            'is_active' => true,
        ]);

        Testimonial::create([
            'patient_name' => 'Ibu Ratna (Ibunda dari Sarah, 14 th)',
            'patient_info' => 'Surabaya • Pasien Koreksi Skoliosis',
            'service_used' => 'Korset Skoliosis 3D Cheneau',
            'testimony' => 'Putri saya terdiagnosa skoliosis 32 derajat. Setelah pemakaian rutin korset 3D dari klinik ini selama 9 bulan, hasil rontgen menunjukkan sudutnya berkurang drastis menjadi 14 derajat tanpa perlu tindakan operasi.',
            'photo' => '/images/testimonials/patient-2.jpg',
            'rating' => 5,
            'is_featured' => true,
            'is_active' => true,
        ]);

        Testimonial::create([
            'patient_name' => 'Bpk. Suryadi (52 th)',
            'patient_info' => 'Tangerang • Pasien Nyeri Tumit & Flatfoot',
            'service_used' => 'Custom Medical Insole 3D',
            'testimony' => 'Nyeri tumit bertahun-tahun saat bangun tidur hilang dalam 2 minggu setelah menggunakan custom insole 3D dari Ortotik. Sangat direkomendasikan untuk siapa saja yang punya keluhan telapak kaki datar.',
            'photo' => '/images/testimonials/patient-3.jpg',
            'rating' => 5,
            'is_featured' => true,
            'is_active' => true,
        ]);

        // 8. Articles
        Article::create([
            'user_id' => $admin->id,
            'category_id' => $catArticleEdu->id,
            'title' => 'Mengenal Ciri-Ciri Kaki O dan Kaki X pada Anak Sejak Dini',
            'slug' => 'mengenal-ciri-kaki-o-dan-x-pada-anak',
            'summary' => 'Panduan bagi orang tua untuk mendeteksi kelainan sudut lutut pada anak dan kapan waktu yang tepat untuk melakukan koreksi brace.',
            'content' => '<p>Kelainan sudut tungkai bawah seperti Genu Varum (Kaki O) dan Genu Valgum (Kaki X) seringkali dianggap normal pada fase awal balita. Namun, apabila jarak antar lutut melebihi 4-5 cm setelah usia 3 tahun, intervensi ortotik dengan brace korektif sangat dianjurkan untuk mencegah osteoartritis dini.</p>',
            'thumbnail' => '/images/articles/kaki-ox.jpg',
            'read_time' => 4,
            'views_count' => 125,
            'is_published' => true,
            'published_at' => now(),
            'meta_title' => 'Ciri Kaki O dan X pada Anak - Klinik Ortotik',
            'meta_description' => 'Deteksi dini kelainan lutut anak dan panduan penanganan koreksi brace ortopedi.',
        ]);

        Article::create([
            'user_id' => $admin->id,
            'category_id' => $catArticleGuide->id,
            'title' => 'Tips Merawat Kaki Palsu dan Stump agar Bebas Luka Lecet',
            'slug' => 'tips-merawat-kaki-palsu-dan-stump',
            'summary' => 'Langkah-langkah higienis membersihkan silicone liner medis dan menjaga elastisitas kulit tungkai sisa.',
            'content' => '<p>Kenyamanan menggunakan kaki palsu sangat bergantung pada kebersihan liner dan kesesuaian volume soket. Bersihkan liner setiap malam dengan sabun ber-pH netral dan periksakan ke klinik ortotis jika soket mulai terasa longgar.</p>',
            'thumbnail' => '/images/articles/perawatan-prostesis.jpg',
            'read_time' => 3,
            'views_count' => 98,
            'is_published' => true,
            'published_at' => now(),
            'meta_title' => 'Panduan Perawatan Kaki Palsu - Klinik Ortotik',
            'meta_description' => 'Tips merawat silicone liner dan soket kaki palsu agar bebas lecet dan awet.',
        ]);

        // 9. Site Settings
        SiteSetting::set('site_name', 'Klinik Ortotik & Prostetik Indonesia', 'general');
        SiteSetting::set('site_tagline', 'Solusi Ortotik & Prostetik Medis Presisi & Modern', 'general');
        SiteSetting::set('company_phone', '021-3901234', 'contact');
        SiteSetting::set('company_email', 'info@ortotik.co.id', 'contact');
        SiteSetting::set('whatsapp_global', '6281234567890', 'contact');
        SiteSetting::set('company_address', 'Jl. Salemba Raya No. 45, Jakarta Pusat, DKI Jakarta 10440', 'contact');
        SiteSetting::set('working_hours', 'Senin - Sabtu: 08:30 - 17:00 WIB', 'general');
        SiteSetting::set('facebook_url', 'https://facebook.com/ortotikindonesia', 'social');
        SiteSetting::set('instagram_url', 'https://instagram.com/ortotikindonesia', 'social');
        SiteSetting::set('youtube_url', 'https://youtube.com/@ortotikindonesia', 'social');
    }
}
