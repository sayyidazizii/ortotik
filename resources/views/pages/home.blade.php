@extends('layouts.app')

@section('title', 'Klinik Ortotik & Prostetik Indonesia - Precision Orthotics & Prosthetics')
@section('meta_description', 'Pusat pembuatan kaki palsu bionik carbon fiber, korset skoliosis 3D non-bedah, AFO/KAFO, dan insole medis cetak berstandar Kemenkes RI.')

@section('content')

<!-- SECTION 1: EDITORIAL CAMPAIGN HERO ({component.campaign-tile} with {typography.display-campaign}) -->
<section class="relative bg-ink text-canvas overflow-hidden">
    <div class="relative w-full h-[580px] sm:h-[680px] lg:h-[760px] bg-charcoal overflow-hidden">
        <!-- Campaign Editorial Image -->
        <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=1920&q=85"
            alt="Precision Orthotics & Prosthetics"
            class="w-full h-full object-cover object-center opacity-85">
        
        <!-- Subtle Cinematic Dark Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-ink/90 via-ink/30 to-transparent"></div>

        <!-- Headline Burned Into Lower-Left ({typography.display-campaign}) -->
        <div class="absolute bottom-10 sm:bottom-16 left-0 right-0">
            <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
                
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-canvas/90 backdrop-blur-md text-ink text-xs font-semibold tracking-wider uppercase">
                    <span class="w-2 h-2 rounded-full bg-success"></span>
                    <span>Standar Pelayanan Medis Kemenkes RI</span>
                </div>

                <!-- Towering Uppercase Headline -->
                <h1 class="font-display text-5xl sm:text-7xl lg:text-[96px] leading-[0.9] uppercase text-canvas font-medium tracking-tight max-w-4xl">
                    REBORN YOUR LIFE WITH PRECISION ORTHOTICS
                </h1>

                <p class="text-canvas/90 text-sm sm:text-base max-w-xl font-normal leading-relaxed pt-1">
                    Solusi alat bantu gerak presisi: kaki & tangan palsu bionik carbon fiber, korset skoliosis 3D non-bedah, dan brace ortopedi dengan garansi fitting 100%.
                </p>

                <!-- On-Image Pill CTA Cluster ({component.button-outline-on-image} & {component.button-primary}) -->
                <div class="flex flex-wrap items-center gap-3 pt-3">
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Klinik%20Ortotik,%20saya%20ingin%20konsultasi%20mengenai%20alat%20medis." target="_blank"
                        class="inline-flex items-center justify-center bg-canvas hover:bg-soft-cloud text-ink text-xs sm:text-sm font-medium px-8 h-12 rounded-full btn-pill-tap shadow-lg transition">
                        <span>Konsultasi WhatsApp</span>
                    </a>
                    
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center justify-center bg-ink/80 hover:bg-ink text-canvas border border-canvas/40 text-xs sm:text-sm font-medium px-8 h-12 rounded-full btn-pill-tap backdrop-blur-md transition">
                        <span>E-Katalog Produk Medis</span>
                    </a>

                    <a href="{{ route('consultation.create') }}"
                        class="inline-flex items-center justify-center bg-soft-cloud hover:bg-canvas text-ink text-xs sm:text-sm font-medium px-7 h-12 rounded-full btn-pill-tap transition">
                        <span>Janji Temu Klinik</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- SECTION 2: SHOP BY CATEGORY / ANATOMY RAIL (4-up portrait full-bleed cards with on-image pill CTA) -->
<section class="py-12 bg-canvas border-b border-hairline-soft">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-6">
            <h2 class="text-2xl sm:text-3xl font-medium tracking-tight text-ink uppercase font-sans">
                Kategori Alat Bantu Medis
            </h2>
            <a href="{{ route('products.index') }}" class="text-xs font-semibold text-ink underline hover:text-mute transition">
                Lihat Semua Kategori &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
            <!-- Category 1: Kaki Palsu & Prostesis -->
            <div class="relative bg-soft-cloud aspect-[4/5] overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80" alt="Prostetik Kaki & Tangan" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-ink/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6">
                    <span class="text-xs text-canvas/75 uppercase tracking-wider font-semibold block mb-1">Prostetik Bionik</span>
                    <h3 class="text-lg font-bold text-canvas leading-tight mb-3">Kaki & Tangan Palsu Carbon Fiber</h3>
                    <a href="{{ route('services.index') }}" class="inline-flex items-center bg-canvas text-ink text-xs font-semibold px-5 py-2.5 rounded-full btn-pill-tap transition">
                        <span>Jelajahi Solusi</span>
                    </a>
                </div>
            </div>

            <!-- Category 2: Korset Skoliosis 3D -->
            <div class="relative bg-soft-cloud aspect-[4/5] overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&q=80" alt="Korset Skoliosis 3D" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-ink/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6">
                    <span class="text-xs text-canvas/75 uppercase tracking-wider font-semibold block mb-1">Spine Center</span>
                    <h3 class="text-lg font-bold text-canvas leading-tight mb-3">Korset Skoliosis 3D Cheneau TLSO</h3>
                    <a href="{{ route('services.index') }}" class="inline-flex items-center bg-canvas text-ink text-xs font-semibold px-5 py-2.5 rounded-full btn-pill-tap transition">
                        <span>Jelajahi Solusi</span>
                    </a>
                </div>
            </div>

            <!-- Category 3: Brace Ekstremitas Bawah (AFO / KAFO) -->
            <div class="relative bg-soft-cloud aspect-[4/5] overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=600&q=80" alt="Brace Ekstremitas Bawah" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-ink/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6">
                    <span class="text-xs text-canvas/75 uppercase tracking-wider font-semibold block mb-1">Lower Limb Ortotik</span>
                    <h3 class="text-lg font-bold text-canvas leading-tight mb-3">AFO, KAFO & Knee Brace Presisi</h3>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center bg-canvas text-ink text-xs font-semibold px-5 py-2.5 rounded-full btn-pill-tap transition">
                        <span>Jelajahi Solusi</span>
                    </a>
                </div>
            </div>

            <!-- Category 4: Custom Insole Medis -->
            <div class="relative bg-soft-cloud aspect-[4/5] overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80" alt="Custom Insole Medis" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-ink/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6">
                    <span class="text-xs text-canvas/75 uppercase tracking-wider font-semibold block mb-1">Foot Biomechanics</span>
                    <h3 class="text-lg font-bold text-canvas leading-tight mb-3">Insole Medis 3D Flat Foot & Plantar</h3>
                    <a href="{{ route('custom-products.index') }}" class="inline-flex items-center bg-canvas text-ink text-xs font-semibold px-5 py-2.5 rounded-full btn-pill-tap transition">
                        <span>Jelajahi Solusi</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 3: 5 PILAR LAYANAN MEDIS KAMI (Required assertion string) -->
<section class="py-12 bg-canvas border-b border-hairline-soft" id="layanan">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-xs text-mute font-semibold uppercase tracking-widest block mb-1">Standar Penanganan Medis</span>
                <h2 class="text-3xl sm:text-4xl font-medium tracking-tight text-ink uppercase font-sans">
                    5 Pilar Layanan Medis Kami
                </h2>
                <p class="text-mute text-sm mt-1 max-w-2xl">Penanganan terintegrasi mulai dari evaluasi biomekanik 3D, pembuatan alat kustom, hingga terapi adaptasi pola berjalan.</p>
            </div>
            <div>
                <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center bg-ink hover:bg-charcoal text-canvas text-xs font-medium px-6 h-10 rounded-full btn-pill-tap transition">
                    <span>Semua Layanan</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($services as $svc)
            <div class="bg-canvas border border-hairline-soft p-6 flex flex-col justify-between group">
                <div>
                    <!-- Icon / Badge -->
                    <div class="w-12 h-12 bg-soft-cloud text-ink flex items-center justify-center mb-6">
                        <i data-lucide="{{ $svc->icon_name ?? 'activity' }}" class="w-6 h-6"></i>
                    </div>

                    <h3 class="text-xl font-bold text-ink leading-snug mb-2 group-hover:text-mute transition">
                        <a href="{{ route('services.show', $svc->slug) }}">{{ $svc->title }}</a>
                    </h3>

                    <p class="text-xs text-mute leading-relaxed mb-4">
                        {{ $svc->summary }}
                    </p>

                    @if($svc->indications && count($svc->indications) > 0)
                    <div class="pt-4 border-t border-hairline-soft">
                        <span class="text-[11px] font-semibold text-ink uppercase tracking-wider block mb-2">Indikasi Klinis:</span>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(array_slice($svc->indications, 0, 3) as $ind)
                            <span class="bg-soft-cloud text-ink text-[11px] font-medium px-2.5 py-1 rounded-full">{{ $ind }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mt-6 pt-4 border-t border-hairline-soft flex items-center justify-between">
                    <a href="{{ route('services.show', $svc->slug) }}" class="text-xs font-semibold text-ink underline hover:text-mute transition">
                        Detail Prosedur
                    </a>
                    <a href="{{ route('consultation.create') }}?service_id={{ $svc->id }}" class="text-xs font-medium text-mute hover:text-ink transition">
                        Jadwal &rarr;
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 4: E-KATALOG PRODUK UNGGULAN ({component.product-card}: 1:1 image on soft-cloud, swatch dots, zero padding) -->
<section class="py-12 bg-canvas border-b border-hairline-soft" id="katalog">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-xs text-mute font-semibold uppercase tracking-widest block mb-1">E-Katalog Resmi</span>
                <h2 class="text-3xl sm:text-4xl font-medium tracking-tight text-ink uppercase font-sans">
                    Katalog Produk Medis Siap Pakai
                </h2>
                <p class="text-mute text-sm mt-1 max-w-2xl">Penyangga ortopedi, kolar leher, dan brace sendi dengan material medis impor berstandar internasional.</p>
            </div>
            <div>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center bg-soft-cloud hover:bg-hairline-soft text-ink text-xs font-medium px-6 h-10 rounded-full btn-pill-tap transition">
                    <span>Lihat Seluruh Katalog</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
            @foreach($featuredProducts as $prod)
            <!-- {component.product-card} -->
            <div class="bg-canvas border border-hairline-soft p-0 flex flex-col justify-between group">
                <div>
                    <!-- 1:1 Image Studio Area ({component.product-card-image}: soft-cloud background, zero radius) -->
                    <div class="relative bg-soft-cloud aspect-square flex items-center justify-center overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80" alt="{{ $prod->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        
                        <!-- Promo Badge Pill ({component.badge-promo}) -->
                        <span class="absolute top-3 left-3 bg-canvas border border-hairline text-ink text-[11px] font-medium px-3 py-1 rounded-full shadow-xs">
                            {{ $prod->category->name ?? 'Ortotik' }}
                        </span>

                        <span class="absolute top-3 right-3 bg-canvas border border-hairline text-ink text-[11px] font-medium px-3 py-1 rounded-full shadow-xs">
                            Ready Stock
                        </span>
                    </div>

                    <!-- Metadata Rows with 8px rhythm -->
                    <div class="p-4 space-y-2">
                        <!-- Swatch Dots ({component.swatch-dot}) -->
                        <div class="flex items-center gap-1.5 pt-1">
                            <span class="w-3 h-3 rounded-full bg-ink ring-2 ring-ink ring-offset-2"></span>
                            <span class="w-3 h-3 rounded-full bg-mute"></span>
                            <span class="w-3 h-3 rounded-full bg-hairline"></span>
                        </div>

                        <!-- Product Title ({typography.body-strong} ink) -->
                        <h3 class="text-base font-medium text-ink leading-snug group-hover:text-mute transition">
                            <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                        </h3>

                        <!-- Category Subtitle ({typography.caption-md} mute) -->
                        <p class="text-xs text-mute font-medium line-clamp-1">
                            {{ $prod->short_description ?? 'Alat bantu ortopedi standar klinis presisi tinggi' }}
                        </p>

                        <!-- Price Row ({colors.ink} or {colors.sale}) -->
                        <div class="pt-1 flex items-baseline gap-2">
                            <span class="text-base font-bold text-ink">{{ $prod->formatted_price }}</span>
                            @if($prod->formatted_discount_price)
                            <span class="text-xs text-mute line-through">{{ $prod->formatted_discount_price }}</span>
                            <span class="text-xs font-semibold text-sale">Diskon Promo</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Card Bottom Pill Actions -->
                <div class="p-4 pt-0 grid grid-cols-2 gap-2">
                    <a href="{{ route('products.show', $prod->slug) }}" class="flex items-center justify-center bg-soft-cloud hover:bg-hairline-soft text-ink text-xs font-medium h-10 rounded-full btn-pill-tap transition">
                        Detail Produk
                    </a>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($prod->name) }}" target="_blank"
                        class="flex items-center justify-center bg-ink hover:bg-charcoal text-canvas text-xs font-medium h-10 rounded-full btn-pill-tap transition">
                        Order WA
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 5: CLINICAL WORKFLOW (4-Step Process on Soft-Cloud) -->
<section class="py-16 bg-soft-cloud border-b border-hairline-soft">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-10">
            <span class="text-xs text-mute font-semibold uppercase tracking-widest block mb-1">Standard Operating Procedure</span>
            <h2 class="text-3xl sm:text-4xl font-medium tracking-tight text-ink uppercase font-sans">
                Alur 4 Tahapan Pelayanan Pasien
            </h2>
            <p class="text-mute text-sm mt-1">Setiap tahapan dirancang sistematis untuk menjamin akurasi biomekanik dan kenyamanan adaptasi soket.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-canvas p-6 border border-hairline-soft flex flex-col justify-between">
                <div>
                    <span class="text-3xl font-display text-ink block mb-2">01</span>
                    <h3 class="text-base font-bold text-ink mb-2">Konsultasi & Gait Analysis</h3>
                    <p class="text-xs text-mute leading-relaxed">Pemeriksaan fisik oleh klinisi Ortotis-Prostetis dan evaluasi pola gerak tubuh pasien.</p>
                </div>
            </div>

            <div class="bg-canvas p-6 border border-hairline-soft flex flex-col justify-between">
                <div>
                    <span class="text-3xl font-display text-ink block mb-2">02</span>
                    <h3 class="text-base font-bold text-ink mb-2">3D Scanning & Casting</h3>
                    <p class="text-xs text-mute leading-relaxed">Pengukuran presisi menggunakan scanner optik 3D atau casting gips cetak anatomis.</p>
                </div>
            </div>

            <div class="bg-canvas p-6 border border-hairline-soft flex flex-col justify-between">
                <div>
                    <span class="text-3xl font-display text-ink block mb-2">03</span>
                    <h3 class="text-base font-bold text-ink mb-2">Fabrikasi Carbon Fiber</h3>
                    <p class="text-xs text-mute leading-relaxed">Pengerjaan di workshop berlisensi dengan material carbon composite dan komponen bersertifikasi ISO.</p>
                </div>
            </div>

            <div class="bg-canvas p-6 border border-hairline-soft flex flex-col justify-between">
                <div>
                    <span class="text-3xl font-display text-ink block mb-2">04</span>
                    <h3 class="text-base font-bold text-ink mb-2">Fitting & Gait Training</h3>
                    <p class="text-xs text-mute leading-relaxed">Uji coba dinamis, penyetelan kenyamanan soket, dan pendampingan latihan berjalan hingga mandiri.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 6: FAQ ACCORDION DISCLOSURE ROWS ({component.faq-row} & {component.pdp-disclosure-row}) -->
<section class="py-16 bg-canvas border-b border-hairline-soft">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-5 space-y-4">
                <span class="text-xs text-mute font-semibold uppercase tracking-widest block">Pertanyaan Umum</span>
                <h2 class="text-3xl sm:text-4xl font-medium tracking-tight text-ink uppercase font-sans">
                    Frequently Asked Questions
                </h2>
                <p class="text-mute text-sm leading-relaxed">
                    Jawaban seputar prosedur pembuatan kaki palsu, jadwal konsultasi, penanganan skoliosis, hingga garansi penyesuaian alat.
                </p>
                <div class="pt-2">
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Klinik%20Ortotik,%20saya%20ingin%20tanya%20prosedur%20pembuatan%20alat." target="_blank"
                        class="inline-flex items-center justify-center bg-ink hover:bg-charcoal text-canvas text-xs font-medium px-6 h-10 rounded-full btn-pill-tap transition">
                        <span>Tanya Langsung via WhatsApp</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-7 divide-y divide-hairline">
                <!-- FAQ Row 1 -->
                <div class="py-6 space-y-2" x-data="{ open: true }">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-base font-bold text-ink">Berapa lama proses pembuatan kaki palsu custom?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-ink transition transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" class="text-xs text-mute leading-relaxed pt-2">
                        Proses pembuatan rata-rata memakan waktu 5 hingga 10 hari kerja, mencakup tahapan casting, fabrikasi soket carbon fiber, dynamic alignment, serta sesi fitting dan gait training bersama fisioterapis.
                    </div>
                </div>

                <!-- FAQ Row 2 -->
                <div class="py-6 space-y-2" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-base font-bold text-ink">Apakah tersedia layanan pengukuran ke rumah (Home Visit)?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-ink transition transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="text-xs text-mute leading-relaxed pt-2">
                        Ya, tim klinisi kami melayani Home Visit untuk pasien lanjut usia, pasca stroke, atau kondisi pasca operasi yang memiliki keterbatasan mobilitas untuk datang ke klinik.
                    </div>
                </div>

                <!-- FAQ Row 3 -->
                <div class="py-6 space-y-2" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-base font-bold text-ink">Bagaimana dengan garansi dan penyesuaian berkala?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-ink transition transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="text-xs text-mute leading-relaxed pt-2">
                        Setiap produk custom-made dilengkapi garansi fitting pas 100%. Kami memberikan layanan penyesuaian soket gratis selama masa garansi apabila terjadi perubahan volume puntung pasien.
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SECTION 7: BOTTOM CAMPAIGN BANNER ({component.campaign-tile}) -->
<section class="relative bg-ink text-canvas py-20 overflow-hidden">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <span class="text-xs text-mute font-semibold uppercase tracking-widest block">Konsultasi Medis & Pemeriksaan</span>
        <h2 class="font-display text-4xl sm:text-6xl lg:text-[72px] leading-[0.9] uppercase text-canvas font-medium tracking-tight max-w-3xl mx-auto">
            SIAP UNTUK KEMBALI MELANGKAH BEBAS DAN MANDIRI?
        </h2>
        <p class="text-canvas/80 text-sm max-w-xl mx-auto leading-relaxed">
            Jadwalkan pemeriksaan biomekanik dan konsultasi bersama tim Ortotis-Prostetis resmi kami di klinik Jakarta atau Surabaya.
        </p>
        <div class="flex flex-wrap justify-center items-center gap-3 pt-2">
            <a href="{{ route('consultation.create') }}" class="inline-flex items-center justify-center bg-canvas hover:bg-soft-cloud text-ink text-xs sm:text-sm font-medium px-8 h-12 rounded-full btn-pill-tap transition">
                <span>Isi Formulir Janji Temu Medis</span>
            </a>
            <a href="https://wa.me/6281234567890?text=Halo%20Klinik%20Ortotik,%20saya%20ingin%20jadwalkan%20konsultasi." target="_blank"
                class="inline-flex items-center justify-center bg-transparent hover:bg-canvas/10 text-canvas border border-canvas/40 text-xs sm:text-sm font-medium px-8 h-12 rounded-full btn-pill-tap transition">
                <span>Hubungi via WhatsApp</span>
            </a>
        </div>
    </div>
</section>

@endsection
