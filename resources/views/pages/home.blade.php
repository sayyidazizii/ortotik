@extends('layouts.app')

@section('title', 'Klinik Ortotik & Prostetik Indonesia - Solusi Kaki Palsu & Brace Ortopedi Medis')
@section('meta_description', 'Pusat pelayanan ortotik dan prostetik terpercaya di Indonesia. Pembuatan kaki palsu bionik carbon fiber, korset skoliosis 3D non-operasi, dan brace ortopedi presisi berstandar Kemenkes RI.')

@section('content')

<!-- SECTION 1: HERO BANNER (Soft Light Blue Theme - Orthocare Indonesia Inspired) -->
<section class="bg-hero-soft pt-12 pb-20 lg:pt-20 lg:pb-28 border-b border-sky-100/80 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Copy -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <!-- Accreditation Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-100/90 text-sky-800 border border-sky-200 text-xs font-bold shadow-xs">
                    <i data-lucide="shield-check" class="w-4 h-4 text-medical-600"></i>
                    <span>STANDAR PELAYANAN MEDIS & KEMENKES RI</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-3xl sm:text-5xl lg:text-[54px] font-black tracking-tight leading-[1.15] text-slate-900">
                    Kembali Bergerak Mandiri dengan <span class="text-medical-600">Ortotik & Prostetik Presisi</span>
                </h1>

                <!-- Subtitle / Value Prop -->
                <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    Pusat pembuatan alat bantu gerak tubuh spesialis: <strong>kaki & tangan palsu carbon fiber</strong>, <strong>korset skoliosis 3D non-bedah</strong>, <strong>AFO/KAFO</strong>, dan <strong>insole medis flatfoot</strong> dengan garansi kenyamanan fitting 100%.
                </p>

                <!-- Action CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5 pt-2">
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Klinik%20Ortotik,%20saya%20ingin%20konsultasi%20mengenai%20alat%20bantu%20medis." target="_blank"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2.5 bg-[#25D366] hover:bg-[#20ba5a] text-white font-bold px-7 py-3.5 rounded-xl shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 text-sm">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>Konsultasi WhatsApp Cepat</span>
                    </a>
                    
                    <a href="{{ route('consultation.create') }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-medical-600 hover:bg-medical-700 text-white font-bold px-7 py-3.5 rounded-xl shadow-sm transition-all transform hover:-translate-y-0.5 text-sm">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>Buat Janji Temu di Klinik</span>
                    </a>

                    <a href="{{ route('products.index') }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-1.5 bg-white hover:bg-slate-50 text-slate-700 font-bold px-5 py-3.5 rounded-xl border border-slate-300 shadow-xs transition text-sm">
                        <span>E-Katalog</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 text-slate-400"></i>
                    </a>
                </div>

                <!-- Trust Metrics Bar -->
                <div class="pt-6 grid grid-cols-3 gap-4 border-t border-sky-200/60 text-center lg:text-left">
                    <div>
                        <span class="block text-2xl sm:text-3xl font-black text-slate-900">8.500+</span>
                        <span class="text-xs text-slate-500 font-semibold">Pasien Terbantu</span>
                    </div>
                    <div>
                        <span class="block text-2xl sm:text-3xl font-black text-slate-900">100%</span>
                        <span class="text-xs text-slate-500 font-semibold">Garansi Pas & Nyaman</span>
                    </div>
                    <div>
                        <span class="block text-2xl sm:text-3xl font-black text-slate-900">12+ Th</span>
                        <span class="text-xs text-slate-500 font-semibold">Pengalaman Medis</span>
                    </div>
                </div>
            </div>

            <!-- Right Visual Graphic -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <!-- Main Card Container -->
                    <div class="rounded-3xl overflow-hidden shadow-card border border-sky-100 bg-white p-3">
                        <div class="rounded-2xl overflow-hidden relative bg-slate-100 aspect-[4/3]">
                            <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=800&q=80" alt="Pemeriksaan Ortotik Prostetik Medis" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
                            
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-md text-slate-900 font-bold text-[11px] px-3 py-1 rounded-full shadow-sm flex items-center gap-1.5">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-medical-600"></i>
                                <span>Spesialis Ortotis-Prostetis</span>
                            </span>
                        </div>

                        <!-- Mini Credibility Row inside Hero Card -->
                        <div class="p-4 space-y-2.5">
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold text-slate-700">Teknologi Pemindaian 3D Presisi</span>
                                <span class="font-extrabold text-medical-600">Akurat & Nyaman</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-gradient-to-r from-medical-500 to-tealmed-500 h-full w-full rounded-full"></div>
                            </div>
                            <p class="text-[11px] text-slate-500">Pemeriksaan alignment tubuh dan postur menggunakan standar biomekanik internasional.</p>
                        </div>
                    </div>

                    <!-- Floating Badge Card 1 -->
                    <div class="hidden sm:flex absolute -bottom-5 -left-5 bg-white p-3.5 rounded-2xl shadow-card border border-sky-100 items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                            <i data-lucide="award" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-slate-900">Garansi Fitting 100%</p>
                            <p class="text-[10px] text-slate-500">Gratis Penyetelan Berkala</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SECTION 2: 4 CLINICAL CREDIBILITY PILLARS (Clean Medical Strip) -->
<section class="py-10 bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-sky-50/50 border border-sky-100">
                <div class="w-11 h-11 rounded-xl bg-medical-100 text-medical-700 flex items-center justify-center shrink-0">
                    <i data-lucide="user-check" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 text-xs uppercase tracking-wider">Klinisi Bersertifikasi</h4>
                    <p class="text-xs text-slate-600 mt-0.5">Ortotis-Prostetis resmi dengan STR Kemenkes RI.</p>
                </div>
            </div>

            <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-sky-50/50 border border-sky-100">
                <div class="w-11 h-11 rounded-xl bg-medical-100 text-medical-700 flex items-center justify-center shrink-0">
                    <i data-lucide="scan" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 text-xs uppercase tracking-wider">3D CAD/CAM Scanning</h4>
                    <p class="text-xs text-slate-600 mt-0.5">Presisi cetakan milimeter untuk soket tanpa nyeri.</p>
                </div>
            </div>

            <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-sky-50/50 border border-sky-100">
                <div class="w-11 h-11 rounded-xl bg-medical-100 text-medical-700 flex items-center justify-center shrink-0">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 text-xs uppercase tracking-wider">Garansi Penyesuaian</h4>
                    <p class="text-xs text-slate-600 mt-0.5">Pendampingan gait training hingga lancar berjalan.</p>
                </div>
            </div>

            <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-sky-50/50 border border-sky-100">
                <div class="w-11 h-11 rounded-xl bg-medical-100 text-medical-700 flex items-center justify-center shrink-0">
                    <i data-lucide="home" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 text-xs uppercase tracking-wider">Layanan Home Visit</h4>
                    <p class="text-xs text-slate-600 mt-0.5">Pemeriksaan dan casting langsung di rumah pasien.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SECTION 3: 5 PILAR LAYANAN MEDIS SPESIALIS (Orthocare Indonesia Card Style) -->
<section class="py-20 bg-slate-50/60" id="layanan">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-medical-600 font-extrabold text-xs uppercase tracking-widest block mb-2">LAYANAN MEDIS TERPADU</span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">5 Pilar Layanan Medis Kami</h2>
            <p class="text-slate-600 mt-2.5 text-sm">Ditangani langsung oleh tim klinisi spesialis untuk menangani kelainan bentuk tubuh, kelumpuhan, dan pemulihan pasca amputasi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($services as $svc)
            <div class="bg-white rounded-2xl p-7 border border-slate-200/80 shadow-card hover:shadow-card-hover hover:border-sky-300 transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <!-- Icon Container -->
                    <div class="w-14 h-14 rounded-2xl bg-sky-50 text-medical-600 border border-sky-100 flex items-center justify-center mb-6 group-hover:bg-medical-600 group-hover:text-white transition-all duration-300">
                        <i data-lucide="{{ $svc->icon_name ?? 'activity' }}" class="w-7 h-7"></i>
                    </div>

                    <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-medical-600 transition leading-snug">
                        <a href="{{ route('services.show', $svc->slug) }}">{{ $svc->title }}</a>
                    </h3>

                    <p class="text-xs text-slate-600 mt-3 leading-relaxed">
                        {{ $svc->summary }}
                    </p>

                    @if($svc->indications && count($svc->indications) > 0)
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Indikasi Penanganan:</span>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(array_slice($svc->indications, 0, 3) as $ind)
                            <span class="inline-block bg-sky-50/80 text-sky-800 text-[10px] font-bold px-2 py-0.5 rounded border border-sky-100">{{ $ind }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                    <a href="{{ route('services.show', $svc->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-medical-600 hover:text-medical-700 transition">
                        <span>Pelajari Prosedur</span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </a>

                    <a href="{{ route('consultation.create') }}?service_id={{ $svc->id }}" class="text-[11px] font-bold text-slate-500 hover:text-slate-800 transition">
                        Jadwalkan &rarr;
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 4: E-KATALOG PRODUK UNGGULAN (Clean Product Card Grid) -->
<section class="py-20 bg-white border-t border-slate-200/80" id="katalog">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-medical-600 font-extrabold text-xs uppercase tracking-widest block mb-2">PRODUK STANDAR MEDIS</span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Katalog Alat Bantu Medis Unggulan</h2>
                <p class="text-slate-600 mt-2 text-sm max-w-xl">Penyangga dan alat ortopedi siap pakai berstandar medis tinggi dengan garansi fitting presisi.</p>
            </div>
            <div>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 hover:text-medical-600 transition shadow-xs">
                    <span>Lihat Semua E-Katalog</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-slate-400"></i>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($featuredProducts as $prod)
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-card hover:shadow-card-hover hover:border-sky-300 transition-all duration-300 flex flex-col justify-between group overflow-hidden">
                <div>
                    <!-- Product Image Container -->
                    <div class="relative bg-gradient-to-b from-sky-50/60 to-slate-50 h-52 flex items-center justify-center overflow-hidden border-b border-slate-100">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80" alt="{{ $prod->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        
                        <!-- Category Badge -->
                        <span class="absolute top-3 left-3 bg-white/95 backdrop-blur-md text-slate-800 text-[10px] font-extrabold px-2.5 py-1 rounded-md shadow-xs border border-slate-200/60">
                            {{ $prod->category->name ?? 'Ortotik' }}
                        </span>

                        <!-- Stock Badge -->
                        <span class="absolute top-3 right-3 bg-emerald-50 text-emerald-700 text-[10px] font-extrabold px-2.5 py-1 rounded-md border border-emerald-200">
                            Ready Stock
                        </span>
                    </div>

                    <div class="p-6">
                        <h3 class="font-extrabold text-base text-slate-900 leading-snug group-hover:text-medical-600 transition line-clamp-1">
                            <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                        </h3>
                        
                        <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                            {{ $prod->short_description ?? strip_tags($prod->description) }}
                        </p>

                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-baseline justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 uppercase font-bold block">Estimasi Harga</span>
                                <span class="text-lg font-black text-slate-900">{{ $prod->formatted_price }}</span>
                            </div>
                            <span class="text-[10px] text-slate-500 font-semibold">Garansi 1 Th</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="px-6 pb-6 pt-0 grid grid-cols-2 gap-2">
                    <a href="{{ route('products.show', $prod->slug) }}" class="text-center py-2.5 px-3 rounded-xl border border-slate-200 hover:border-medical-500 text-slate-700 hover:text-medical-600 text-xs font-bold transition">
                        Detail Produk
                    </a>
                    
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($prod->name) }}" target="_blank"
                        class="inline-flex justify-center items-center gap-1.5 py-2.5 px-3 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white text-xs font-bold shadow-xs transition">
                        <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                        <span>Order WA</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 5: ALUR 4 TAHAPAN PELAYANAN PASIEN (Orthocare Workflow) -->
<section class="py-20 bg-sky-50/40 border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-medical-600 font-extrabold text-xs uppercase tracking-widest block mb-2">STANDAR PROSEDUR KLINIS</span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">4 Langkah Alur Pelayanan Pasien</h2>
            <p class="text-slate-600 mt-2.5 text-sm">Proses terstruktur untuk memastikan setiap alat bantu dibuat presisi, nyaman, dan mendukung fungsi gerak optimal.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Step 1 -->
            <div class="bg-white p-6 rounded-2xl border border-sky-100 shadow-card relative flex flex-col justify-between">
                <div>
                    <span class="w-10 h-10 rounded-xl bg-medical-600 text-white font-black text-base flex items-center justify-center mb-4 shadow-sm">
                        01
                    </span>
                    <h3 class="font-extrabold text-base text-slate-900 mb-2">Konsultasi & Evaluasi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Pemeriksaan klinis, analisis gait berjalan, dan penentuan desain alat bantu medis yang tepat.</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="bg-white p-6 rounded-2xl border border-sky-100 shadow-card relative flex flex-col justify-between">
                <div>
                    <span class="w-10 h-10 rounded-xl bg-medical-600 text-white font-black text-base flex items-center justify-center mb-4 shadow-sm">
                        02
                    </span>
                    <h3 class="font-extrabold text-base text-slate-900 mb-2">Scanning & Cetakan 3D</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Pengambilan ukuran anatomi tubuh via 3D scanner atau casting gips medis presisi tinggi.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="bg-white p-6 rounded-2xl border border-sky-100 shadow-card relative flex flex-col justify-between">
                <div>
                    <span class="w-10 h-10 rounded-xl bg-medical-600 text-white font-black text-base flex items-center justify-center mb-4 shadow-sm">
                        03
                    </span>
                    <h3 class="font-extrabold text-base text-slate-900 mb-2">Fabrikasi Workshop</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Proses pengerjaan alat bantu di workshop dengan material carbon fiber & komponen impor standar ISO.</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="bg-white p-6 rounded-2xl border border-sky-100 shadow-card relative flex flex-col justify-between">
                <div>
                    <span class="w-10 h-10 rounded-xl bg-emerald-600 text-white font-black text-base flex items-center justify-center mb-4 shadow-sm">
                        04
                    </span>
                    <h3 class="font-extrabold text-base text-slate-900 mb-2">Fitting & Gait Training</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Uji coba pemakaian langsung, penyesuaian kenyamanan soket, dan latihan fisioterapi gerak.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 6: TESTIMONI PASIEN (Authentic Patient Stories) -->
<section class="py-20 bg-white border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-medical-600 font-extrabold text-xs uppercase tracking-widest block mb-2">BUKTI KEPUASAN</span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Kisah & Pengalaman Pasien Kami</h2>
            <p class="text-slate-600 mt-2 text-sm">Kembali beraktivitas dan melangkah mandiri tanpa hambatan bersama Klinik Ortotik.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
            @foreach($testimonials as $testi)
            <div class="bg-white rounded-2xl p-7 border border-slate-200/80 shadow-card flex flex-col justify-between">
                <div>
                    <div class="flex text-amber-400 mb-3.5">
                        @for($i=0; $i<$testi->rating; $i++)
                        <i data-lucide="star" class="w-4 h-4 fill-amber-400"></i>
                        @endfor
                    </div>
                    <p class="text-slate-700 text-xs leading-relaxed italic">
                        "{{ $testi->testimony }}"
                    </p>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-medical-600 to-medical-500 text-white font-black flex items-center justify-center text-xs shrink-0">
                        {{ strtoupper(substr($testi->patient_name, 0, 2)) }}
                    </div>
                    <div>
                        <h4 class="font-extrabold text-xs text-slate-900">{{ $testi->patient_name }}</h4>
                        <span class="text-[11px] text-slate-400">{{ $testi->patient_info }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 7: CABANG KLINIK & PETA LOKASI INTERAKTIF -->
<section class="py-20 bg-slate-50/70 border-t border-slate-200/80" x-data="{ activeBranch: '0' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-medical-600 font-extrabold text-xs uppercase tracking-widest block mb-2">LOKASI PRAKTEK KLINIK</span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Kunjungi Cabang Klinik Terdekat</h2>
            <p class="text-slate-600 mt-2 text-sm">Fasilitas workshop pembuatan ortotik prostetik lengkap dan ruang evaluasi biomekanik modern.</p>
            
            <!-- Branch switcher tab -->
            <div class="flex justify-center gap-3 mt-6">
                @foreach($branches as $index => $br)
                <button @click="activeBranch = '{{ $index }}'"
                    :class="activeBranch === '{{ $index }}' ? 'bg-medical-600 text-white shadow-sm' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100'"
                    class="px-5 py-2.5 rounded-full text-xs font-bold transition">
                    {{ $br->name }}
                </button>
                @endforeach
            </div>
        </div>

        @foreach($branches as $index => $br)
        <div x-show="activeBranch === '{{ $index }}'" class="bg-white rounded-3xl border border-slate-200/80 shadow-card p-8 lg:p-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-6 space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-50 text-sky-800 text-xs font-bold border border-sky-100">
                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-medical-600"></i>
                    <span>Wilayah: {{ $br->city }}</span>
                </div>
                
                <h3 class="text-2xl font-black text-slate-900">{{ $br->name }}</h3>
                <p class="text-xs text-slate-600 leading-relaxed">{{ $br->address }}</p>
                
                <div class="space-y-2.5 pt-3 text-xs text-slate-700 border-t border-slate-100">
                    <div class="flex items-center gap-3">
                        <i data-lucide="phone" class="w-4 h-4 text-medical-600"></i>
                        <span>Telepon: <strong>{{ $br->phone_number }}</strong></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i data-lucide="message-circle" class="w-4 h-4 text-[#25D366]"></i>
                        <span>WhatsApp Konsultasi: <strong>{{ $br->whatsapp_number }}</strong></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
                        <span>{{ $br->opening_hours ?? 'Senin - Sabtu: 08:30 - 17:00 WIB' }}</span>
                    </div>
                </div>

                <div class="pt-4 flex flex-wrap gap-3">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $br->whatsapp_number) }}?text=Halo%20Admin%20Klinik%20{{ urlencode($br->name) }},%20saya%20ingin%20jadwalkan%20konsultasi." target="_blank"
                        class="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white font-bold text-xs px-5 py-3 rounded-xl shadow-xs transition">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>Chat WhatsApp Cabang Ini</span>
                    </a>
                    <a href="{{ route('consultation.create') }}?branch_id={{ $br->id }}"
                        class="inline-flex items-center gap-2 bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs px-5 py-3 rounded-xl shadow-xs transition">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>Buat Janji Temu</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-6 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200 h-72 flex items-center justify-center">
                @if($br->google_maps_embed)
                    {!! $br->google_maps_embed !!}
                @else
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8488!3d-6.1947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTEnNDAuOSJTIDEwNsKwNTAnNTUuNyJF!5e0!3m2!1sid!2sid!4v1600000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- SECTION 8: BOTTOM CTA BANNER (Soft Light Blue & Clinical Tone) -->
<section class="py-16 bg-gradient-to-r from-medical-600 to-medical-700 text-white relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-5">
        <h2 class="text-3xl sm:text-4xl font-black tracking-tight leading-tight">Siap Untuk Melangkah Bebas dan Nyaman Kembali?</h2>
        <p class="text-sky-100 text-sm max-w-2xl mx-auto leading-relaxed">
            Konsultasikan kondisi ortopedi, koreksi skoliosis, atau kebutuhan kaki palsu Anda sekarang. Tim klinisi kami siap memberikan evaluasi awal gratis via WhatsApp maupun di klinik.
        </p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-3.5 pt-3">
            <a href="{{ route('consultation.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-white text-medical-800 hover:bg-slate-100 font-extrabold px-8 py-3.5 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 text-xs uppercase tracking-wider">
                <i data-lucide="calendar" class="w-4 h-4 text-medical-600"></i>
                <span>Isi Formulir Janji Temu Medis</span>
            </a>
            <a href="https://wa.me/6281234567890?text=Halo%20Klinik%20Ortotik,%20saya%20ingin%20konsultasi%20langsung%20dengan%20spesialis." target="_blank" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white font-extrabold px-8 py-3.5 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 text-xs uppercase tracking-wider">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>Hubungi via WhatsApp</span>
            </a>
        </div>
    </div>
</section>

@endsection
