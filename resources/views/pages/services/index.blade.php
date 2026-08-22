@extends('layouts.app')

@section('title', 'Layanan Orthosis Prosthesis & Alat Bantu Ortopedi - pediOcare')
@section('meta_description', 'Dengan kaidah Rehabilitasi Medis, Kami berusaha yang terbaik untuk memberikan solusi yang komprehensif untuk mencapai kualitas hidup Anda.')

@section('content')

@php
    $heroServicesBg = $settings['hero_services_image'] ?? asset('images/client_update/image4.png');
    if (!str_starts_with($heroServicesBg, 'http') && !str_starts_with($heroServicesBg, '/')) {
        $heroServicesBg = asset($heroServicesBg);
    }
@endphp

<!-- Hero Section -->
<section class="relative text-center mx-auto py-10 md:py-14 px-margin-mobile md:px-margin-desktop text-white w-full overflow-hidden fade-in-up" 
         style='background-image: linear-gradient(rgba(13, 28, 47, 0.82), rgba(13, 28, 47, 0.82)), url("{{ $heroServicesBg }}"); background-size: cover; background-position: center;'>
    <div class="max-w-container-max mx-auto relative z-10 space-y-2.5 sm:space-y-3">
        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-surface-white/15 text-primary-fixed border border-surface-white/25 text-[11px] font-bold uppercase tracking-wider backdrop-blur-sm">
            {{ $settings['hero_services_badge'] ?? 'Pelayanan profesional dengan semangat bermanfaat' }}
        </span>
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight text-white max-w-3xl mx-auto leading-tight">
            {{ $settings['hero_services_title'] ?? 'Layanan Orthosis Prosthesis & Alat Bantu Ortopedi' }}
        </h1>
        <p class="font-body-md text-body-md leading-relaxed text-slate-200 max-w-2xl mx-auto text-xs sm:text-sm">
            {{ $settings['hero_services_subtitle'] ?? 'Dengan kaidah Rehabilitasi Medis, Kami berusaha yang terbaik untuk memberikan solusi yang komprehensif untuk mencapai kualitas hidup Anda.' }}
        </p>
    </div>
</section>

<!-- Main Services Section -->
<section class="py-16 md:py-24 bg-[#f8f9ff] relative overflow-hidden">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop space-y-16">
        
        <!-- Featured Service Spotlight (Prosthetics with Interactive 9-Step Procedure) -->
        <div class="bg-surface-white rounded-3xl border border-outline-variant/30 p-8 md:p-12 shadow-1 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-7 space-y-6">
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary">
                        <!-- Wheelchair / Disability Icon -->
                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">accessible_forward</span>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-primary bg-primary/10 px-3 py-1 rounded-full">Standar Kemenkes RI</span>
                </div>
                
                <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg font-bold text-on-background tracking-tight">
                    Prostesis (Kaki dan tangan Tiruan)
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                    Kami melayani pembuatan kaki dan tangan palsu sesuai dengan standar pelayanan yang ditetapkan oleh Kementerian Kesehatan Republik Indonesia.
                </p>

                <!-- 9 Steps Clinical Workflow -->
                <div class="space-y-3 pt-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-700 block">
                        Alur Prosedur Pelayanan (9 Tahapan Standar Klinis):
                    </span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2.5">
                        <div class="p-2.5 rounded-xl bg-surface-container-low border border-outline-variant/20 flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-primary text-white text-[11px] font-bold flex items-center justify-center shrink-0">1</span>
                            <div class="text-xs font-semibold text-slate-800">Pemeriksaan <span class="text-[10px] text-slate-500 font-normal italic block">(assessment)</span></div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-surface-container-low border border-outline-variant/20 flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-primary text-white text-[11px] font-bold flex items-center justify-center shrink-0">2</span>
                            <div class="text-xs font-semibold text-slate-800">Diagnosis, preskripsi <span class="text-[10px] text-slate-500 font-normal italic block">(prescription)</span></div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-surface-container-low border border-outline-variant/20 flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-primary text-white text-[11px] font-bold flex items-center justify-center shrink-0">3</span>
                            <div class="text-xs font-semibold text-slate-800">Pengukuran <span class="text-[10px] text-slate-500 font-normal italic block">(measurement)</span></div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-surface-container-low border border-outline-variant/20 flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-primary text-white text-[11px] font-bold flex items-center justify-center shrink-0">4</span>
                            <div class="text-xs font-semibold text-slate-800">Pencetakan <span class="text-[10px] text-slate-500 font-normal italic block">(casting)</span></div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-surface-container-low border border-outline-variant/20 flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-primary text-white text-[11px] font-bold flex items-center justify-center shrink-0">5</span>
                            <div class="text-xs font-semibold text-slate-800">Rektifikasi <span class="text-[10px] text-slate-500 font-normal italic block">(rectification)</span></div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-surface-container-low border border-outline-variant/20 flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-primary text-white text-[11px] font-bold flex items-center justify-center shrink-0">6</span>
                            <div class="text-xs font-semibold text-slate-800">Fabrikasi <span class="text-[10px] text-slate-500 font-normal italic block">(fabrication)</span></div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-surface-container-low border border-outline-variant/20 flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-primary text-white text-[11px] font-bold flex items-center justify-center shrink-0">7</span>
                            <div class="text-xs font-semibold text-slate-800">Pengepasan <span class="text-[10px] text-slate-500 font-normal italic block">(fitting)</span></div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-surface-container-low border border-outline-variant/20 flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-primary text-white text-[11px] font-bold flex items-center justify-center shrink-0">8</span>
                            <div class="text-xs font-semibold text-slate-800">Penyerahan <span class="text-[10px] text-slate-500 font-normal italic block">(delivery & check out)</span></div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-surface-container-low border border-outline-variant/20 flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-primary text-white text-[11px] font-bold flex items-center justify-center shrink-0">9</span>
                            <div class="text-xs font-semibold text-slate-800">Evaluasi & tindak lanjut <span class="text-[10px] text-slate-500 font-normal italic block">(follow up)</span></div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="{{ route('contact') }}" class="bg-primary text-on-primary px-8 py-3.5 rounded-xl font-label-md font-bold hover:bg-secondary transition shadow-sm hover:shadow-md">
                        Konsultasi / Kontak
                    </a>
                    <a href="{{ route('services.show', 'prosthetics') }}" class="border border-outline-variant text-on-surface hover:text-primary hover:border-primary px-6 py-3.5 rounded-xl font-label-md font-bold transition bg-surface-white">
                        Detail Prosedur
                    </a>
                </div>
            </div>
            @php
                $spotlightImg = $settings['services_spotlight_image'] ?? asset('images/client_update/image3.png');
                if (!str_starts_with($spotlightImg, 'http') && !str_starts_with($spotlightImg, '/')) {
                    $spotlightImg = asset($spotlightImg);
                }
            @endphp
            <div class="lg:col-span-5 relative rounded-2xl overflow-hidden shadow-lg h-[360px] md:h-[450px] bg-surface-container-low border border-outline-variant/20 group">
                <img src="{{ $spotlightImg }}" 
                     alt="Prostesis Kaki dan Tangan Tiruan pediOcare" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                <div class="absolute top-4 right-4 bg-surface-white/90 backdrop-blur-sm border border-outline-variant/30 text-primary text-xs font-bold px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-success-emerald animate-pulse"></span>
                    {{ $settings['services_spotlight_badge'] ?? 'Standar Kemenkes RI' }}
                </div>
            </div>
        </div>

        <!-- 5 Service Pillar Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $svc)
            <div class="bg-surface-white rounded-3xl shadow-1 hover:shadow-hover transition-all duration-300 border border-outline-variant/20 flex flex-col justify-between group hover:-translate-y-1 overflow-hidden">
                <!-- Card Image Thumbnail -->
                <div class="relative h-48 sm:h-52 w-full bg-surface-container-low overflow-hidden">
                    <img src="{{ $svc->thumbnail_url }}" alt="{{ $svc->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    
                    <div class="absolute top-4 left-4">
                        <div class="w-11 h-11 rounded-xl bg-white/90 backdrop-blur-sm text-primary shadow-sm flex items-center justify-center">
                            @if(str_contains(strtolower($svc->slug), 'prosthet'))
                                <span class="material-symbols-outlined text-2xl">accessible_forward</span>
                            @elseif(str_contains(strtolower($svc->slug), 'bracing'))
                                <span class="material-symbols-outlined text-2xl">accessibility_new</span>
                            @elseif(str_contains(strtolower($svc->slug), 'scoliosis'))
                                <span class="material-symbols-outlined text-2xl">airline_seat_recline_extra</span>
                            @elseif(str_contains(strtolower($svc->slug), 'physio'))
                                <span class="material-symbols-outlined text-2xl">physical_therapy</span>
                            @elseif(str_contains(strtolower($svc->slug), 'neuro'))
                                <span class="material-symbols-outlined text-2xl">smart_toy</span>
                            @else
                                <span class="material-symbols-outlined text-2xl">medical_services</span>
                            @endif
                        </div>
                    </div>

                    @if(count($svc->slider_images) > 1)
                    <div class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-sm text-white text-[11px] px-2.5 py-0.5 rounded-full font-mono flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">photo_library</span>
                        <span>{{ count($svc->slider_images) }} Foto</span>
                    </div>
                    @endif
                </div>

                <div class="p-6 sm:p-7 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-headline-md text-xl font-bold text-on-background mb-2.5 tracking-tight group-hover:text-primary transition-colors">
                            <a href="{{ route('services.show', $svc->slug) }}">{{ $svc->title }}</a>
                        </h3>
                        
                        <p class="text-body-sm text-on-surface-variant leading-relaxed mb-5 line-clamp-3">
                            {{ $svc->summary }}
                        </p>

                        @if($svc->indications && count($svc->indications) > 0)
                        <div class="pt-3 border-t border-outline-variant/15 space-y-1.5 mb-5">
                            <span class="text-[11px] font-bold text-primary uppercase tracking-wider block">Indikasi Penanganan:</span>
                            <ul class="space-y-1 text-xs text-on-surface-variant">
                                @foreach(array_slice($svc->indications, 0, 2) as $ind)
                                <li class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-primary text-xs shrink-0">check_circle</span>
                                    <span class="truncate">{{ $ind }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-outline-variant/15 flex items-center justify-between mt-auto">
                        <a href="{{ route('services.show', $svc->slug) }}" class="text-primary font-semibold text-sm flex items-center gap-1 hover:text-secondary group-hover:gap-2 transition-all">
                            Detail Prosedur <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                        <a href="{{ route('contact') }}?service_id={{ $svc->id }}" class="text-xs font-semibold bg-primary hover:bg-secondary text-white px-4 py-2 rounded-xl transition-all shadow-sm hover:shadow-md flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">contacts</span> Kontak / Janji
                        </a>
                    </div>
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
