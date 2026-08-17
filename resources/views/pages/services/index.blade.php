@extends('layouts.app')

@section('title', 'Layanan Ortotik & Prostetik Spesialis - PT. Orthocare Indonesia')
@section('meta_description', 'Solusi komprehensif untuk pemulihan mobilitas Anda, didukung oleh teknologi mutakhir 3D scanning dan tim prostetis ortotis berpengalaman.')

@section('content')

<!-- Hero Section -->
<section class="relative text-center mx-auto space-y-6 py-20 md:py-28 px-6 md:px-12 text-white w-full overflow-hidden fade-in-up" 
         style='background-image: linear-gradient(rgba(13, 28, 47, 0.75), rgba(13, 28, 47, 0.75)), url("https://lh3.googleusercontent.com/aida-public/AB6AXuD8DxcjaMxpSaM5-0EYyzDMgWMw0biWQv7GHHGkOGe5_WhXA3N9xHYjgX8Mh9tLgQ-lWfAUCpRc97YGi2wzD0tCahPe1KOctBn1J9fMXAE1V3urJ6YhWGuKYKxLtJNqm7BfjKhOSvU5-gujkWl49CMT_fydGMAUd8aR5yeITUxuNxICOgYn5348w3NbJJ5TPAN5hquSn6LqtDyMIOpwYAjFBX3Jkmwhqo_Qk-rMbw8GbO7HcA3kBds"); background-size: cover; background-position: center;'>
    <div class="max-w-container-max mx-auto relative z-10 space-y-4">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-white/10 text-primary-fixed border border-surface-white/20 text-xs font-semibold uppercase tracking-wider backdrop-blur-sm">
            <span class="w-2 h-2 rounded-full bg-primary-fixed animate-pulse"></span>
            Pelayanan Klinis Terintegrasi
        </span>
        <h1 class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl font-bold tracking-tight text-white max-w-3xl mx-auto leading-tight">
            Layanan Ortotik & Prostetik Spesialis
        </h1>
        <p class="font-body-lg text-body-lg leading-relaxed text-slate-200 max-w-2xl mx-auto">
            Solusi komprehensif untuk pemulihan mobilitas Anda, didukung oleh teknologi pemindaian 3D mutakhir dan tim medis tersertifikasi resmi Kemenkes RI.
        </p>
    </div>
</section>

<!-- Main Services Section -->
<section class="py-16 md:py-24 bg-[#f8f9ff] relative overflow-hidden">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop space-y-16">
        
        <!-- Featured Service Spotlight (Prosthetics with Interactive Preview Card) -->
        <div class="bg-surface-white rounded-3xl border border-outline-variant/30 p-8 md:p-12 shadow-1 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-7 space-y-6">
                <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">accessibility_new</span>
                </div>
                <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg font-semibold text-on-background tracking-tight">
                    Prosthetics (Kaki & Tangan Palsu Presisi)
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                    Kami merancang solusi prostetik kustom yang memadukan kenyamanan soket anatomis dengan komponen bionik dan carbon fiber teringan untuk mengembalikan kemandirian penuh Anda.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                    <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/20">
                        <span class="font-bold text-primary text-sm block mb-1">01. Asesmen Klinis</span>
                        <p class="text-xs text-on-surface-variant">Pemeriksaan kondisi stump & pola gerak.</p>
                    </div>
                    <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/20">
                        <span class="font-bold text-primary text-sm block mb-1">02. 3D Scanning</span>
                        <p class="text-xs text-on-surface-variant">Pemindaian optik presisi milimeter.</p>
                    </div>
                    <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant/20">
                        <span class="font-bold text-primary text-sm block mb-1">03. Gait Training</span>
                        <p class="text-xs text-on-surface-variant">Latihan berjalan hingga mandiri.</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="{{ route('consultation.create') }}" class="bg-primary text-on-primary px-8 py-3.5 rounded-xl font-label-md font-semibold hover:bg-secondary transition shadow-sm hover:shadow-md">
                        Konsultasi Prostetik
                    </a>
                    <a href="{{ route('services.show', 'prosthetics') }}" class="border border-outline-variant text-on-surface hover:text-primary hover:border-primary px-6 py-3.5 rounded-xl font-label-md font-semibold transition bg-surface-white">
                        Detail Prosedur
                    </a>
                </div>
            </div>
            <div class="lg:col-span-5 relative rounded-2xl overflow-hidden shadow-lg h-[360px] md:h-[420px] bg-surface-container-low border border-outline-variant/20 group">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBRX96KTlDSHiomGN3OyOvDA8gmpFo6nH9DuQJ13zV-uwYj0On4T643XIIvI7ZfTgEHlGNMCnzLWygdnoChDtXh3HKQ3iKaxsBs2SXt9HZXR5pM7Qtw8KzFBwh-xAkBI6kBHJNij2YKEAiHE2MhApvaIyUSmfo0V7MtHqYRgFzaU3IRMw5FPuoduXReXEcCNbLjLVDm5pEO5HM2XWxQXW-P6GZ1bJoBKdVpdMOPdViOhKinS3glyd4" 
                     alt="Prosthetic Care Technology" 
                     class="w-full h-full object-contain p-6 mix-blend-multiply group-hover:scale-105 transition-transform duration-500"/>
                <div class="absolute top-4 right-4 bg-surface-white/90 backdrop-blur-sm border border-outline-variant/30 text-primary text-xs font-semibold px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-success-emerald animate-pulse"></span>
                    Carbon Composite
                </div>
            </div>
        </div>

        <!-- 5 Service Pillar Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $svc)
            <div class="bg-surface-white p-8 rounded-3xl shadow-1 hover:shadow-hover transition-all duration-300 border border-outline-variant/20 flex flex-col justify-between group hover:-translate-y-1">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-surface-container-low text-primary flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        @if(str_contains(strtolower($svc->slug), 'prosthet'))
                            <span class="material-symbols-outlined text-3xl">accessible_forward</span>
                        @elseif(str_contains(strtolower($svc->slug), 'bracing'))
                            <span class="material-symbols-outlined text-3xl">accessibility_new</span>
                        @elseif(str_contains(strtolower($svc->slug), 'scoliosis'))
                            <span class="material-symbols-outlined text-3xl">airline_seat_recline_extra</span>
                        @elseif(str_contains(strtolower($svc->slug), 'physio'))
                            <span class="material-symbols-outlined text-3xl">physical_therapy</span>
                        @elseif(str_contains(strtolower($svc->slug), 'neuro'))
                            <span class="material-symbols-outlined text-3xl">smart_toy</span>
                        @else
                            <span class="material-symbols-outlined text-3xl">medical_services</span>
                        @endif
                    </div>
                    
                    <h3 class="font-headline-md text-[22px] font-semibold text-on-background mb-3 tracking-tight group-hover:text-primary transition-colors">
                        <a href="{{ route('services.show', $svc->slug) }}">{{ $svc->title }}</a>
                    </h3>
                    
                    <p class="text-body-sm text-on-surface-variant leading-relaxed mb-6">
                        {{ $svc->summary }}
                    </p>

                    @if($svc->indications && count($svc->indications) > 0)
                    <div class="pt-4 border-t border-outline-variant/15 space-y-2 mb-6">
                        <span class="text-xs font-semibold text-primary uppercase tracking-wider block">Indikasi Penanganan:</span>
                        <ul class="space-y-1 text-xs text-on-surface-variant">
                            @foreach(array_slice($svc->indications, 0, 3) as $ind)
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-xs">check_circle</span>
                                <span>{{ $ind }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                <div class="pt-5 border-t border-outline-variant/15 flex items-center justify-between mt-auto">
                    <a href="{{ route('services.show', $svc->slug) }}" class="text-primary font-semibold text-sm flex items-center gap-1 hover:text-secondary group-hover:gap-2 transition-all">
                        Detail Prosedur <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                    <a href="{{ route('consultation.create') }}?service_id={{ $svc->id }}" class="text-xs font-semibold bg-primary hover:bg-secondary text-white px-4 py-2 rounded-xl transition-all shadow-sm hover:shadow-md flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">calendar_month</span> Janji Temu
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Technology Spotlight -->
        <div class="bg-surface-container-low rounded-3xl p-8 md:p-12 relative overflow-hidden border border-outline-variant/30 flex flex-col md:flex-row items-center gap-8 shadow-1">
            <div class="md:w-1/2 space-y-5">
                <span class="text-xs font-semibold uppercase tracking-wider text-primary">Inovasi Fabrikasi Modern</span>
                <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg font-semibold text-on-background tracking-tight">
                    Teknologi Digital 3D Scanning & Modifikasi CAD/CAM
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                    Tinggalkan metode cetak gips tradisional yang memakan waktu. Kami menggunakan pemindai 3D optik presisi tinggi yang dikombinasikan dengan pemodelan software biomedis untuk menciptakan soket dan brace yang akurat serta pas sempurna dengan anatomi tubuh Anda.
                </p>
                <div class="flex flex-wrap gap-4 pt-2">
                    <div class="flex items-center gap-2 text-sm font-medium text-on-surface bg-surface-white px-3.5 py-2 rounded-xl border border-outline-variant/20 shadow-2xs">
                        <span class="material-symbols-outlined text-primary text-base">verified</span> Akurasi Hingga Milimeter
                    </div>
                    <div class="flex items-center gap-2 text-sm font-medium text-on-surface bg-surface-white px-3.5 py-2 rounded-xl border border-outline-variant/20 shadow-2xs">
                        <span class="material-symbols-outlined text-primary text-base">speed</span> Proses Cepat Tanpa Sakit
                    </div>
                </div>
            </div>
            <div class="md:w-1/2 relative h-[280px] md:h-[340px] w-full rounded-2xl overflow-hidden border-4 border-surface-white shadow-md">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDnzbcnd-h_d84ohAqDZlDMQuyQIpJDRMS_zB5cowSkt4V9Ee9Hs-FJdjPsFSK4od-hNCyFMN9WkUXGC9hS-nQZbdmGvFjmbgojvSvhWTAaDSek5ov7M2dqhrlxfT38AkZ7VyQfR54DnAwofDzJ6A3I7Gt_W5AkKOA-JiBEs3aLnE7s0njfxBPfCUlMtKUEmM8aERJVk1Cwtl9FONOv4StQ0zq8JeQW9jo43AFf0l1_zjnkb9bQZio"
                     alt="3D Scanning Technology" class="w-full h-full object-cover"/>
            </div>
        </div>

    </div>
</section>

@endsection
