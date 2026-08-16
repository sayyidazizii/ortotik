@extends('layouts.app')

@section('title', 'Klinik Ortotik & Prostetik Indonesia - Pelayanan Medis Presisi & Holistik')
@section('meta_description', 'Pusat pembuatan kaki palsu bionik carbon fiber, korset skoliosis 3D non-bedah, AFO/KAFO, dan insole medis cetak berstandar Kemenkes RI.')

@section('content')

<!-- HERO SECTION: Maven Clinic - Editorial Warm Linen Composition with Video Asset -->
<section class="relative bg-cappuccino-light py-16 sm:py-20 lg:py-24 border-b border-border overflow-hidden" x-data="{ videoModal: false }">
    <!-- Ambient Warm Emerald & Mint Glow -->
    <div class="absolute -top-32 -right-32 w-96 h-96 bg-mint/50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-blush/60 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

    <div class="relative max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- Left: Editorial Headline & Actions (Maven Clinic: Domaine Display Serif Style) -->
            <div class="lg:col-span-7 space-y-7 text-left">
                
                <!-- Maven Clinic Tag / Chip (Mint Julep Background with Emerald Text) -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-mint text-primary border border-primary/20 text-xs font-semibold shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                    <span>Pelayanan Ortotik & Prostetik Resmi Standar Kemenkes RI</span>
                </div>

                <!-- Expressive Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-[60px] font-serif font-medium text-primary leading-[1.08] tracking-tight">
                    Kesehatan mobilitas Anda, <br class="hidden sm:inline">
                    <span class="text-terracotta italic font-normal">didampingi dengan presisi</span> & empati.
                </h1>

                <!-- Body copy (Maven Clinic: Humanistic Sans 18px) -->
                <p class="text-secondary/80 text-base sm:text-lg lg:text-[19px] leading-[1.7] font-light max-w-2xl">
                    Klinik modern untuk pembuatan kaki & tangan palsu bionik, koreksi skoliosis 3D non-bedah, dan brace ortopedi presisi dengan pendampingan klinisi tersertifikasi resmi.
                </p>

                <!-- Action Cluster: Emerald Pill CTA + Video Play Button -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <!-- button-primary (Deep Emerald Pill, 56px height) -->
                    <a href="{{ route('consultation.create') }}"
                        class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white text-base font-semibold px-9 h-14 rounded-full btn-maven shadow-xs transition">
                        <span>Buat Janji Temu Medis</span>
                    </a>
                    
                    <!-- Video Action Button with Pulse -->
                    <button @click="videoModal = true"
                        class="inline-flex items-center justify-center bg-white hover:bg-cappuccino text-secondary border border-border text-sm font-semibold px-6 h-14 rounded-full btn-maven transition gap-3 group shadow-2xs">
                        <span class="w-8 h-8 rounded-full bg-terracotta text-white flex items-center justify-center group-hover:scale-110 transition shadow-2xs">
                            <i data-lucide="play" class="w-3.5 h-3.5 fill-current ml-0.5"></i>
                        </span>
                        <span>Lihat Video Klinik</span>
                    </button>

                    <!-- Text Link -->
                    <a href="{{ route('products.index') }}" class="inline-flex items-center text-sm font-semibold text-primary hover:text-terracotta transition ml-2">
                        <span>E-Katalog Produk &rarr;</span>
                    </a>
                </div>

                <!-- Credibility Metrics Band (Maven Clinic Warm Style) -->
                <div class="pt-8 border-t border-border grid grid-cols-2 sm:grid-cols-4 gap-6">
                    <div>
                        <span class="block text-3xl sm:text-4xl font-serif font-semibold text-primary">12+ Thn</span>
                        <span class="text-xs text-tertiary font-light mt-1 block">Pengalaman Klinis</span>
                    </div>
                    <div>
                        <span class="block text-3xl sm:text-4xl font-serif font-semibold text-primary">8.500+</span>
                        <span class="text-xs text-tertiary font-light mt-1 block">Pasien Terlayani</span>
                    </div>
                    <div>
                        <span class="block text-3xl sm:text-4xl font-serif font-semibold text-terracotta">100%</span>
                        <span class="text-xs text-tertiary font-light mt-1 block">Garansi Fitting Pas</span>
                    </div>
                    <div>
                        <span class="block text-3xl sm:text-4xl font-serif font-semibold text-primary">2 Cabang</span>
                        <span class="text-xs text-tertiary font-light mt-1 block">Jakarta & Surabaya</span>
                    </div>
                </div>

            </div>

            <!-- Right: Maven Clinic Style Visual Card -->
            <div class="lg:col-span-5 relative">
                <div class="relative bg-white p-3.5 rounded-3xl border border-border shadow-xs">
                    
                    <!-- Main Video/Image Frame with Looping Clinic Video Simulation -->
                    <div class="relative aspect-[4/5] rounded-2xl overflow-hidden bg-cappuccino group cursor-pointer" @click="videoModal = true">
                        <!-- High Quality Clinic Photo -->
                        <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1000&q=85"
                            alt="Maven Clinic Style Healthcare Experience"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        
                        <!-- Soft Ambient Emerald Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent"></div>

                        <!-- Video Play Indicator Badge -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-16 h-16 rounded-full bg-white/90 text-primary flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:bg-terracotta group-hover:text-white transition duration-300">
                                <i data-lucide="play" class="w-6 h-6 fill-current ml-1"></i>
                            </div>
                        </div>

                        <!-- Bottom Floating Video Card Info -->
                        <div class="absolute bottom-4 left-4 right-4 p-4 rounded-xl bg-white/95 backdrop-blur-sm border border-white/40 shadow-xs flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-full bg-mint text-primary flex items-center justify-center shrink-0">
                                <i data-lucide="sparkles" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-serif font-semibold text-primary leading-tight">Teknologi 3D Scanning & Casting</h4>
                                <p class="text-xs text-tertiary font-light mt-0.5">Pemindaian anatomis non-invasif tanpa rasa sakit.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Subtle Floating Tag in Terra Cotta -->
                    <div class="absolute -bottom-4 -left-4 bg-terracotta text-white px-5 py-2.5 rounded-full font-semibold text-xs shadow-md border border-white/50 flex items-center gap-2">
                        <i data-lucide="heart" class="w-4 h-4 fill-current text-white"></i>
                        <span>Pendampingan Klinisi Berempati</span>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Video Modal Dialog -->
    <div x-show="videoModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-primary-dark/80 backdrop-blur-sm"
        @keydown.escape.window="videoModal = false">
        <div class="relative bg-white rounded-3xl max-w-3xl w-full p-4 overflow-hidden shadow-2xl border border-border" @click.outside="videoModal = false">
            <div class="flex justify-between items-center pb-3 px-2 border-b border-border">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-terracotta"></span>
                    <h3 class="font-serif text-lg font-semibold text-primary">Tur Fasilitas & Prosedur Medis Ortotik</h3>
                </div>
                <button @click="videoModal = false" class="p-1 rounded-full text-secondary hover:bg-cappuccino transition">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <div class="relative aspect-video rounded-2xl overflow-hidden mt-3 bg-black">
                <video controls autoplay loop muted class="w-full h-full object-cover">
                    <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4" type="video/mp4">
                    Browser Anda tidak mendukung tag video.
                </video>
            </div>
            <div class="pt-4 px-2 text-xs text-tertiary flex justify-between items-center">
                <span>Dokumentasi proses 3D scanning, workshop fabrikasi carbon fiber, dan sesi latihan berjalan pasien.</span>
                <a href="{{ route('consultation.create') }}" class="text-terracotta font-semibold hover:underline">Jadwalkan Kunjungan &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2: 5 PILAR LAYANAN MEDIS KAMI (Maven Clinic Style: Warm Linen Cards, Emerald Serif Headlines) -->
<section class="py-24 bg-cappuccino" id="layanan">
    <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header (Maven Clinic headline-lg: Serif 42-48px) -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="max-w-2xl">
                <span class="text-xs text-terracotta font-semibold uppercase tracking-wider block mb-2 font-sans">STANDAR PENANGANAN MEDIS</span>
                <h2 class="text-3xl sm:text-4xl lg:text-[46px] font-serif font-medium tracking-tight text-primary leading-tight">
                    5 Pilar Layanan Medis Kami
                </h2>
                <p class="text-secondary/80 text-base sm:text-lg mt-3 font-light leading-relaxed">
                    Pendekatan terintegrasi mulai dari evaluasi biomekanik 3D, pembuatan alat kustom, hingga terapi adaptasi dan gait training.
                </p>
            </div>
            <div>
                <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white text-sm font-medium px-7 h-12 rounded-full btn-maven transition shadow-xs">
                    <span>Semua Layanan Medis</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($services as $svc)
            <!-- Maven Clinic Card -->
            <div class="bg-white rounded-3xl border border-border p-8 flex flex-col justify-between hover:border-primary/40 hover:shadow-md transition duration-300 group">
                <div>
                    <!-- Icon Box in Mint Circle -->
                    <div class="w-14 h-14 rounded-full bg-mint text-primary flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition duration-300">
                        <i data-lucide="{{ $svc->icon_name ?? 'activity' }}" class="w-7 h-7"></i>
                    </div>

                    <h3 class="text-2xl font-serif font-medium text-primary leading-snug mb-3 group-hover:text-terracotta transition">
                        <a href="{{ route('services.show', $svc->slug) }}">{{ $svc->title }}</a>
                    </h3>

                    <p class="text-sm text-secondary/80 font-light leading-relaxed mb-6">
                        {{ $svc->summary }}
                    </p>

                    @if($svc->indications && count($svc->indications) > 0)
                    <div class="pt-5 border-t border-border space-y-2.5">
                        <span class="text-xs font-semibold text-primary uppercase tracking-wider block font-sans">Indikasi Penanganan:</span>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(array_slice($svc->indications, 0, 3) as $ind)
                            <span class="bg-cappuccino text-secondary text-xs font-normal px-3 py-1 rounded-full border border-border/60">{{ $ind }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mt-8 pt-5 border-t border-border flex items-center justify-between">
                    <a href="{{ route('services.show', $svc->slug) }}" class="text-sm font-semibold text-primary hover:text-terracotta transition">
                        Detail Prosedur &rarr;
                    </a>
                    <a href="{{ route('consultation.create') }}?service_id={{ $svc->id }}" class="text-xs font-semibold text-terracotta hover:text-primary transition">
                        Jadwalkan Kunjungan
                    </a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- SECTION 3: E-KATALOG PRODUK MEDIS UNGGULAN (Maven Clinic Editorial Product Grid) -->
<section class="py-24 bg-cappuccino-light border-t border-b border-border" id="katalog">
    <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="max-w-2xl">
                <span class="text-xs text-terracotta font-semibold uppercase tracking-wider block mb-2 font-sans">PROVEN MEDICAL DEVICES</span>
                <h2 class="text-3xl sm:text-4xl lg:text-[46px] font-serif font-medium tracking-tight text-primary leading-tight">
                    Katalog Produk Medis Siap Pakai
                </h2>
                <p class="text-secondary/80 text-base sm:text-lg mt-3 font-light leading-relaxed">
                    Penyangga ortopedi, kolar leher, dan brace sendi dengan material medis impor berstandar internasional.
                </p>
            </div>
            <div>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center bg-white hover:bg-cappuccino text-secondary text-sm font-semibold px-7 h-12 rounded-full btn-maven border border-border transition shadow-2xs">
                    <span>Lihat Seluruh Katalog ({{ count($featuredProducts) }}+ Produk)</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProducts as $prod)
            <!-- Product Card -->
            <div class="bg-white rounded-3xl border border-border overflow-hidden flex flex-col justify-between hover:border-primary/40 hover:shadow-md transition duration-300 group">
                <div>
                    <!-- Product Image Stage with Warm Linen Tone -->
                    <div class="relative bg-cappuccino aspect-square flex items-center justify-center overflow-hidden border-b border-border">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80" alt="{{ $prod->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        
                        <!-- Badges -->
                        <span class="absolute top-4 left-4 bg-white/95 text-secondary text-xs font-semibold px-3.5 py-1 rounded-full border border-border shadow-2xs">
                            {{ $prod->category->name ?? 'Ortotik' }}
                        </span>

                        <span class="absolute top-4 right-4 bg-mint text-primary text-xs font-semibold px-3.5 py-1 rounded-full border border-primary/20">
                            Ready Stock
                        </span>
                    </div>

                    <!-- Metadata Rows -->
                    <div class="p-7 space-y-3">
                        <h3 class="text-xl font-serif font-medium text-primary leading-snug group-hover:text-terracotta transition line-clamp-1">
                            <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                        </h3>

                        <p class="text-xs text-tertiary font-light line-clamp-2 leading-relaxed">
                            {{ $prod->short_description ?? 'Alat bantu ortopedi standar klinis presisi tinggi untuk pemulihan optimal.' }}
                        </p>

                        <!-- Price Row -->
                        <div class="pt-2 flex items-baseline gap-3">
                            <span class="text-xl font-serif font-semibold text-primary">{{ $prod->formatted_price }}</span>
                            @if($prod->formatted_discount_price)
                            <span class="text-xs text-tertiary line-through">{{ $prod->formatted_discount_price }}</span>
                            <span class="text-xs font-semibold text-terracotta">Diskon Promo</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Card Actions (Maven Clinic Pill Buttons) -->
                <div class="p-7 pt-0 grid grid-cols-2 gap-3">
                    <a href="{{ route('products.show', $prod->slug) }}" class="flex items-center justify-center bg-cappuccino hover:bg-cappuccino-deep text-secondary text-xs font-semibold h-11 rounded-full btn-maven border border-border transition">
                        Detail
                    </a>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($prod->name) }}" target="_blank"
                        class="flex items-center justify-center bg-terracotta hover:bg-terracotta-dark text-white text-xs font-semibold h-11 rounded-full btn-maven transition">
                        Order WA
                    </a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- SECTION 4: 4 TAHAPAN PROSES PELAYANAN PASIEN (Maven Clinic Step Workflow) -->
<section class="py-24 bg-cappuccino">
    <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-2xl mb-16">
            <span class="text-xs text-terracotta font-semibold uppercase tracking-wider block mb-2 font-sans">STANDARD OPERATING PROCEDURE</span>
            <h2 class="text-3xl sm:text-4xl lg:text-[46px] font-serif font-medium tracking-tight text-primary leading-tight">
                Alur 4 Tahapan Pelayanan Pasien
            </h2>
            <p class="text-secondary/80 text-base sm:text-lg mt-3 font-light leading-relaxed">
                Setiap tahapan dirancang sistematis untuk menjamin akurasi biomekanik dan kenyamanan adaptasi soket.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-8 rounded-3xl border border-border flex flex-col justify-between shadow-2xs">
                <div>
                    <span class="w-12 h-12 rounded-full bg-mint text-primary font-serif font-bold text-lg flex items-center justify-center mb-6">01</span>
                    <h3 class="text-lg font-serif font-medium text-primary mb-2">Konsultasi & Gait Analysis</h3>
                    <p class="text-xs text-tertiary font-light leading-relaxed">Pemeriksaan fisik oleh klinisi Ortotis-Prostetis dan evaluasi pola gerak tubuh pasien.</p>
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-border flex flex-col justify-between shadow-2xs">
                <div>
                    <span class="w-12 h-12 rounded-full bg-mint text-primary font-serif font-bold text-lg flex items-center justify-center mb-6">02</span>
                    <h3 class="text-lg font-serif font-medium text-primary mb-2">3D Scanning & Casting</h3>
                    <p class="text-xs text-tertiary font-light leading-relaxed">Pengukuran presisi menggunakan scanner optik 3D atau casting gips cetak anatomis.</p>
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-border flex flex-col justify-between shadow-2xs">
                <div>
                    <span class="w-12 h-12 rounded-full bg-mint text-primary font-serif font-bold text-lg flex items-center justify-center mb-6">03</span>
                    <h3 class="text-lg font-serif font-medium text-primary mb-2">Fabrikasi Carbon Fiber</h3>
                    <p class="text-xs text-tertiary font-light leading-relaxed">Pengerjaan di workshop berlisensi dengan material carbon composite dan komponen bersertifikasi ISO.</p>
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-border flex flex-col justify-between shadow-2xs">
                <div>
                    <span class="w-12 h-12 rounded-full bg-mint text-primary font-serif font-bold text-lg flex items-center justify-center mb-6">04</span>
                    <h3 class="text-lg font-serif font-medium text-primary mb-2">Fitting & Gait Training</h3>
                    <p class="text-xs text-tertiary font-light leading-relaxed">Uji coba dinamis, penyetelan kenyamanan soket, dan pendampingan latihan berjalan hingga mandiri.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- SECTION 5: FAQ ACCORDION -->
<section class="py-24 bg-cappuccino-light border-t border-border">
    <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
            
            <div class="lg:col-span-5 space-y-5">
                <span class="text-xs text-terracotta font-semibold uppercase tracking-wider block font-sans">PATIENT INQUIRY</span>
                <h2 class="text-3xl sm:text-4xl font-serif font-medium tracking-tight text-primary leading-tight">
                    Pertanyaan Seputar Pelayanan
                </h2>
                <p class="text-secondary/80 text-base leading-relaxed font-light">
                    Jawaban seputar prosedur pembuatan kaki palsu, jadwal konsultasi, penanganan skoliosis, hingga garansi penyesuaian alat.
                </p>
                <div class="pt-3">
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Klinik%20Ortotik,%20saya%20ingin%20tanya%20prosedur%20pembuatan%20alat." target="_blank"
                        class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white text-sm font-semibold px-7 h-12 rounded-full btn-maven shadow-xs transition">
                        <span>Tanya Langsung via WhatsApp</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-7 divide-y divide-border bg-white rounded-3xl border border-border p-8 sm:p-10 shadow-2xs">
                <!-- FAQ Row 1 -->
                <div class="py-6 first:pt-0 last:pb-0 space-y-3" x-data="{ open: true }">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-lg font-serif font-medium text-primary">Berapa lama proses pembuatan kaki palsu custom?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-terracotta transition transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" class="text-sm text-secondary/80 font-light leading-relaxed pt-2">
                        Proses pembuatan rata-rata memakan waktu 5 hingga 10 hari kerja, mencakup tahapan casting, fabrikasi soket carbon fiber, dynamic alignment, serta sesi fitting dan gait training bersama fisioterapis.
                    </div>
                </div>

                <!-- FAQ Row 2 -->
                <div class="py-6 first:pt-0 last:pb-0 space-y-3" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-lg font-serif font-medium text-primary">Apakah tersedia layanan pengukuran ke rumah (Home Visit)?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-terracotta transition transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="text-sm text-secondary/80 font-light leading-relaxed pt-2">
                        Ya, tim klinisi kami melayani Home Visit untuk pasien lanjut usia, pasca stroke, atau kondisi pasca operasi yang memiliki keterbatasan mobilitas untuk datang ke klinik.
                    </div>
                </div>

                <!-- FAQ Row 3 -->
                <div class="py-6 first:pt-0 last:pb-0 space-y-3" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-lg font-serif font-medium text-primary">Bagaimana dengan garansi dan penyesuaian berkala?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-terracotta transition transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="text-sm text-secondary/80 font-light leading-relaxed pt-2">
                        Setiap produk custom-made dilengkapi garansi fitting pas 100%. Kami memberikan layanan penyesuaian soket gratis selama masa garansi apabila terjadi perubahan volume puntung pasien.
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SECTION 6: BOTTOM CALL TO ACTION (Maven Clinic Signature Emerald Green Banner with Terra Cotta / Mint Buttons) -->
<section class="py-24 bg-primary text-cappuccino relative overflow-hidden">
    <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-7 relative z-10">
        <span class="text-xs text-mint font-semibold uppercase tracking-wider block font-sans">SMART APPOINTMENT BOOKING</span>
        <h2 class="text-3xl sm:text-5xl lg:text-[52px] font-serif font-medium tracking-tight text-white max-w-3xl mx-auto leading-tight">
            Siap untuk Kembali Melangkah Bebas dan Mandiri?
        </h2>
        <p class="text-cappuccino/85 text-base sm:text-lg max-w-xl mx-auto leading-relaxed font-light">
            Jadwalkan pemeriksaan biomekanik dan konsultasi bersama tim Ortotis-Prostetis resmi kami di klinik Jakarta atau Surabaya.
        </p>
        <div class="flex flex-wrap justify-center items-center gap-4 pt-4">
            <a href="{{ route('consultation.create') }}" class="inline-flex items-center justify-center bg-terracotta hover:bg-terracotta-dark text-white text-base font-semibold px-9 h-14 rounded-full btn-maven shadow-md transition">
                <span>Isi Formulir Janji Temu Medis</span>
            </a>
            <a href="https://wa.me/6281234567890?text=Halo%20Klinik%20Ortotik,%20saya%20ingin%20jadwalkan%20konsultasi." target="_blank"
                class="inline-flex items-center justify-center bg-white/10 hover:bg-white/20 text-white border border-white/30 text-sm font-semibold px-8 h-14 rounded-full btn-maven transition">
                <i data-lucide="message-circle" class="w-4 h-4 mr-2 text-mint"></i>
                <span>Hubungi via WhatsApp</span>
            </a>
        </div>
    </div>
</section>

@endsection
