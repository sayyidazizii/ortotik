@extends('layouts.app')

@section('title', 'Solusi Ortotik & Prostetik Medis Presisi - Klinik Ortotik Indonesia')

@section('content')
<!-- SECTION 1: HERO BANNER -->
<section class="hero-pattern relative text-white pt-20 pb-28 md:pt-28 md:pb-36 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-tealmed-500/20 text-tealmed-200 border border-tealmed-500/30 text-xs font-bold tracking-wide">
                    <span class="w-2 h-2 rounded-full bg-tealmed-400 animate-pulse"></span>
                    <span>STANDAR MEDIS & SERTIFIKASI KEMENKES RI</span>
                </div>
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.15] text-white">
                    Reborn Your Life <br class="hidden sm:inline">With <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 to-cyan-200">Precision Orthotics & Prosthetics</span>
                </h1>
                <p class="text-base sm:text-lg text-slate-200 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    Pusat penanganan kelainan muskuloskeletal, pembuatan kaki & tangan palsu bionik carbon fiber, korset skoliosis 3D non-bedah, dan insole medis cetak presisi.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                    <a href="{{ route('consultation.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2.5 bg-gradient-to-r from-tealmed-500 to-tealmed-600 hover:from-tealmed-600 hover:to-tealmed-700 text-slate-900 font-bold px-8 py-4 rounded-full shadow-lg hover:shadow-tealmed-500/30 transition transform hover:-translate-y-0.5 text-base">
                        <i data-lucide="calendar" class="w-5 h-5"></i>
                        <span>Konsultasi Klinisi Spesialis</span>
                    </a>
                    <a href="{{ route('products.index') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold px-7 py-4 rounded-full border border-white/20 backdrop-blur-sm transition text-base">
                        <span>Lihat E-Katalog Produk</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
                <!-- Stats badge banner -->
                <div class="pt-8 grid grid-cols-3 gap-4 border-t border-white/10 text-center lg:text-left">
                    <div>
                        <span class="block text-2xl sm:text-3xl font-black text-white">2.500+</span>
                        <span class="text-xs text-slate-300">Pasien Terbantu</span>
                    </div>
                    <div>
                        <span class="block text-2xl sm:text-3xl font-black text-white">100%</span>
                        <span class="text-xs text-slate-300">Garansi Custom Fitting</span>
                    </div>
                    <div>
                        <span class="block text-2xl sm:text-3xl font-black text-white">15+ Th</span>
                        <span class="text-xs text-slate-300">Pengalaman Klinis</span>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-white/10 bg-slate-800">
                        <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=800&q=80" alt="Klinik Ortotik & Prostetik" class="w-full h-[420px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-900/20 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 p-4 rounded-xl bg-white/90 backdrop-blur-md text-slate-900 shadow-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-tealmed-500 text-white flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-slate-900">3D CAD/CAM Scanning System</h4>
                                    <p class="text-xs text-slate-600">Presisi pengukuran hingga milimeter tanpa rasa sakit.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2: COMPANY CREDIBILITY SNIPPET -->
<section class="py-16 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
            <div class="pt-4 md:pt-0">
                <div class="w-12 h-12 rounded-xl bg-medical-50 text-medical-700 mx-auto flex items-center justify-center mb-3">
                    <i data-lucide="award" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-slate-900 text-base">Tenaga Ahli Bersertifikasi</h4>
                <p class="text-xs text-slate-500 mt-1">Ortotis & Prostetis teregistrasi resmi Kemenkes.</p>
            </div>
            <div class="pt-4 md:pt-0">
                <div class="w-12 h-12 rounded-xl bg-tealmed-50 text-tealmed-600 mx-auto flex items-center justify-center mb-3">
                    <i data-lucide="scan" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-slate-900 text-base">Teknologi 3D Precision</h4>
                <p class="text-xs text-slate-500 mt-1">Soket dan brace custom fit tanpa tekanan berlebih.</p>
            </div>
            <div class="pt-4 md:pt-0">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 mx-auto flex items-center justify-center mb-3">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-slate-900 text-base">Garansi Penyesuaian</h4>
                <p class="text-xs text-slate-500 mt-1">Layanan purna jual & gratis penyesuaian berkala.</p>
            </div>
            <div class="pt-4 md:pt-0">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 mx-auto flex items-center justify-center mb-3">
                    <i data-lucide="map-pin" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-slate-900 text-base">2 Cabang Klinik Utama</h4>
                <p class="text-xs text-slate-500 mt-1">Akses mudah di Jakarta Pusat dan Surabaya.</p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 3: 5 PILAR LAYANAN MEDIS -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-tealmed-600 font-bold text-xs uppercase tracking-widest block mb-2">KOMPREHENSIF & TERPADU</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">5 Pilar Layanan Medis Kami</h2>
            <p class="text-slate-600 mt-3 text-base">Dirancang oleh klinisi spesialis untuk menangani kelainan postur, cedera olahraga, hingga pemulihan pasca amputasi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $svc)
            <div class="bg-white rounded-2xl p-7 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-medical-200 transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-medical-50 to-tealmed-50 text-medical-700 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-medical-700 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i data-lucide="{{ $svc->icon_name ?? 'activity' }}" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 group-hover:text-medical-700 transition">
                        <a href="{{ route('services.show', $svc->slug) }}">{{ $svc->title }}</a>
                    </h3>
                    <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                        {{ $svc->summary }}
                    </p>
                    @if($svc->indications && count($svc->indications) > 0)
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Indikasi Penanganan:</span>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(array_slice($svc->indications, 0, 3) as $ind)
                            <span class="inline-block bg-slate-100 text-slate-700 text-[11px] font-medium px-2.5 py-1 rounded-md">{{ $ind }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="mt-6 pt-4">
                    <a href="{{ route('services.show', $svc->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-medical-700 hover:text-tealmed-600 transition">
                        <span>Pelajari Selengkapnya</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 4: KATALOG PRODUK UNGGULAN (FEATURED PRODUCTS) -->
<section class="py-20 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-tealmed-600 font-bold text-xs uppercase tracking-widest block mb-2">READY STOCK & STANDAR MEDIS</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Katalog Produk Medis Unggulan</h2>
                <p class="text-slate-600 mt-2 text-sm max-w-xl">Penyangga dan alat ortopedi siap pakai dengan material impor berkualitas tinggi untuk percepatan pemulihan.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-medical-700 hover:text-tealmed-600 transition">
                    <span>Lihat Semua Produk ({{ count($featuredProducts) }}+)</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProducts as $prod)
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="relative bg-slate-100 h-52 flex items-center justify-center overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80" alt="{{ $prod->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @if($prod->discount_price)
                        <span class="absolute top-3 left-3 bg-red-600 text-white text-[11px] font-extrabold px-2.5 py-1 rounded-full uppercase shadow">Promo</span>
                        @endif
                        <span class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-slate-800 text-[11px] font-bold px-2.5 py-1 rounded-full shadow-sm">{{ $prod->category->name ?? 'Medis' }}</span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-base text-slate-900 leading-snug group-hover:text-medical-700 transition">
                            <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 line-clamp-2">{{ $prod->excerpt ?? strip_tags($prod->description) }}</p>
                        
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-baseline gap-2">
                            <span class="text-lg font-extrabold text-medical-800">{{ $prod->formatted_price }}</span>
                            @if($prod->formatted_discount_price)
                            <span class="text-xs text-slate-400 line-through">{{ $prod->formatted_discount_price }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-0 flex gap-2">
                    <a href="{{ route('products.show', $prod->slug) }}" class="flex-1 text-center py-2.5 px-3 rounded-xl border border-slate-300 hover:border-medical-700 text-slate-700 hover:text-medical-700 text-xs font-bold transition">
                        Detail
                    </a>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($prod->name) }}" target="_blank" class="flex-1 inline-flex justify-center items-center gap-1.5 py-2.5 px-3 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white text-xs font-bold shadow transition">
                        <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                        <span>Order WA</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 5: CUSTOM MADE PRODUCTS SHOWCASE -->
<section class="py-20 bg-gradient-to-b from-slate-900 to-slate-950 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5 space-y-6">
                <span class="text-tealmed-400 font-bold text-xs uppercase tracking-widest block">INDIVIDUAL CUSTOM FABRICATION</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                    Produk Custom-Made: Presisi Sempurna Sesuai Tubuh Anda
                </h2>
                <p class="text-slate-300 text-sm leading-relaxed">
                    Setiap tubuh memiliki karakteristik unik. Kami memproduksi alat bantu ortotik prostetik kustom dengan 4 tahapan presisi: <strong>Konsultasi & Scan 3D → Desain CAD → Fabrikasi Carbon → Dynamic Fitting & Adjustment</strong>.
                </p>
                <div class="space-y-3 pt-2">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-tealmed-500/20 text-tealmed-400 flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-sm font-medium text-slate-200">Kaki Palsu Bawah & Atas Lutut Carbon Fiber</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-tealmed-500/20 text-tealmed-400 flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-sm font-medium text-slate-200">Korset Skoliosis 3D Cheneau TLSO (Non-Operasi)</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-tealmed-500/20 text-tealmed-400 flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-sm font-medium text-slate-200">Insole Medis 3D Flat Foot & Plantar Fasciitis</span>
                    </div>
                </div>
                <div class="pt-4">
                    <a href="{{ route('custom-products.index') }}" class="inline-flex items-center gap-2 bg-tealmed-500 hover:bg-tealmed-600 text-slate-950 font-bold px-6 py-3.5 rounded-full transition shadow-lg">
                        <span>Lihat Alur & Portofolio Custom</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach($customProducts as $cProd)
                <div class="bg-slate-800/80 border border-slate-700/80 rounded-2xl p-6 backdrop-blur-sm hover:border-tealmed-500/50 transition">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-tealmed-400 bg-tealmed-950/60 px-2.5 py-1 rounded-md border border-tealmed-800/40 inline-block mb-3">Custom Made</span>
                    <h3 class="text-lg font-bold text-white mb-2">{{ $cProd->name }}</h3>
                    <p class="text-xs text-slate-300 leading-relaxed line-clamp-3 mb-4">{{ $cProd->summary }}</p>
                    <a href="{{ route('custom-products.show', $cProd->slug) }}" class="text-xs font-bold text-tealmed-400 hover:text-tealmed-300 inline-flex items-center gap-1">
                        <span>Lihat Tahapan Pembuatan</span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- SECTION 6: TESTIMONI PASIEN (SUCCESS STORIES) -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-tealmed-600 font-bold text-xs uppercase tracking-widest block mb-2">CERITA KEPUASAN</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Kisah Inspiratif & Testimoni Pasien</h2>
            <p class="text-slate-600 mt-2 text-sm">Kembali bergerak mandiri dan beraktivitas tanpa hambatan bersama Klinik Ortotik.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testi)
            <div class="bg-white rounded-2xl p-7 border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex text-amber-400 mb-4">
                        @for($i=0; $i<$testi->rating; $i++)
                        <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                        @endfor
                    </div>
                    <p class="text-slate-700 text-sm leading-relaxed italic">
                        "{{ $testi->testimony }}"
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-medical-700 text-white font-bold flex items-center justify-center text-sm flex-shrink-0">
                        {{ substr($testi->patient_name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">{{ $testi->patient_name }}</h4>
                        <span class="text-xs text-slate-500">{{ $testi->patient_info }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 7: ARTIKEL EDUKASI MEDIS -->
<section class="py-20 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-tealmed-600 font-bold text-xs uppercase tracking-widest block mb-2">EDUKASI KESEHATAN</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Artikel & Tips Pemulihan Medis</h2>
                <p class="text-slate-600 mt-2 text-sm">Informasi klinis terpercaya seputar kesehatan tulang, sendi, dan alat bantu gerak.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-medical-700 hover:text-tealmed-600 transition">
                    <span>Lihat Semua Artikel</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latestArticles as $art)
            <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between group">
                <div>
                    <div class="h-48 bg-slate-100 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&q=80" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-slate-800 text-[11px] font-bold px-2.5 py-1 rounded-full">{{ $art->category->name ?? 'Edukasi' }}</span>
                    </div>
                    <div class="p-6">
                        <span class="text-xs text-slate-400 block mb-2">{{ $art->published_at ? $art->published_at->format('d M Y') : 'Terbaru' }} &bull; {{ $art->read_time }} menit baca</span>
                        <h3 class="font-bold text-base text-slate-900 group-hover:text-medical-700 transition leading-snug">
                            <a href="{{ route('articles.show', $art->slug) }}">{{ $art->title }}</a>
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">{{ $art->summary }}</p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-0">
                    <a href="{{ route('articles.show', $art->slug) }}" class="text-xs font-bold text-medical-700 hover:text-tealmed-600 inline-flex items-center gap-1">
                        <span>Baca Selengkapnya</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 8: CABANG KLINIK & PETA LOKASI -->
<section class="py-20 bg-slate-50 border-t border-slate-200" x-data="{ activeBranch: '0' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-tealmed-600 font-bold text-xs uppercase tracking-widest block mb-2">LOKASI PRAKTEK KLINIK</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Kunjungi Cabang Klinik Kami</h2>
            <p class="text-slate-600 mt-2 text-sm">Fasilitas workshop ortotik prostetik lengkap dan ruang evaluasi biomekanik modern.</p>
            
            <!-- Branch switcher tab -->
            <div class="flex justify-center gap-3 mt-6">
                @foreach($branches as $index => $br)
                <button @click="activeBranch = '{{ $index }}'" :class="activeBranch === '{{ $index }}' ? 'bg-medical-700 text-white shadow' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100'" class="px-5 py-2.5 rounded-full text-xs font-bold transition">
                    {{ $br->name }}
                </button>
                @endforeach
            </div>
        </div>

        @foreach($branches as $index => $br)
        <div x-show="activeBranch === '{{ $index }}'" class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 lg:p-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-6 space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-tealmed-50 text-tealmed-700 text-xs font-bold">
                    <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                    <span>{{ $br->city }}</span>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">{{ $br->name }}</h3>
                <p class="text-sm text-slate-600 leading-relaxed">{{ $br->address }}</p>
                
                <div class="space-y-2.5 pt-3 text-sm text-slate-700 border-t border-slate-100">
                    <div class="flex items-center gap-3">
                        <i data-lucide="phone" class="w-4 h-4 text-medical-700"></i>
                        <span>Telepon: <strong>{{ $br->phone_number }}</strong></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i data-lucide="message-circle" class="w-4 h-4 text-[#25D366]"></i>
                        <span>WhatsApp: <strong>+{{ $br->whatsapp_number }}</strong></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
                        <span>{{ $br->opening_hours }}</span>
                    </div>
                </div>

                <div class="pt-4 flex flex-wrap gap-3">
                    <a href="https://wa.me/{{ $br->whatsapp_number }}?text=Halo%20Admin%20Klinik%20{{ urlencode($br->name) }},%20saya%20ingin%20jadwalkan%20konsultasi." target="_blank" class="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white font-bold text-xs px-5 py-3 rounded-xl shadow transition">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>Hubungi Cabang Ini</span>
                    </a>
                    <a href="{{ route('consultation.create') }}?branch_id={{ $br->id }}" class="inline-flex items-center gap-2 bg-medical-700 hover:bg-medical-800 text-white font-bold text-xs px-5 py-3 rounded-xl shadow transition">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>Buat Janji Temu</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-6 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200 h-72 flex items-center justify-center">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8488!3d-6.1947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTEnNDAuOSJTIDEwNsKwNTAnNTUuNyJF!5e0!3m2!1sid!2sid!4v1600000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- SECTION 9 & 10: BOTTOM CTA CONSULTATION BANNER -->
<section class="py-16 gradient-medical text-white relative overflow-hidden">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
        <h2 class="text-3xl sm:text-4xl font-black tracking-tight">Siap Untuk Kembali Melangkah Bebas Tanpa Nyeri?</h2>
        <p class="text-slate-100 text-base max-w-2xl mx-auto">
            Konsultasikan keluhan ortopedi, koreksi skoliosis, atau pembuatan kaki palsu Anda sekarang. Klinisi kami siap memberikan evaluasi awal gratis via WhatsApp atau di klinik.
        </p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 pt-2">
            <a href="{{ route('consultation.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-white text-medical-800 hover:bg-slate-100 font-extrabold px-8 py-4 rounded-full shadow-xl transition transform hover:-translate-y-0.5 text-base">
                <i data-lucide="calendar" class="w-5 h-5 text-tealmed-600"></i>
                <span>Isi Formulir Janji Temu Medis</span>
            </a>
            <a href="https://wa.me/6281234567890?text=Halo%20Klinik%20Ortotik,%20saya%20ingin%20konsultasi%20langsung%20dengan%20klinisi%20spesialis." target="_blank" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white font-extrabold px-8 py-4 rounded-full shadow-xl transition transform hover:-translate-y-0.5 text-base">
                <i data-lucide="message-circle" class="w-5 h-5"></i>
                <span>Chat WhatsApp Cepat</span>
            </a>
        </div>
    </div>
</section>
@endsection
