@extends('layouts.app')

@section('title', $service->title . ' - pediOcare')
@section('meta_description', $service->summary)

@section('content')

<!-- Sub-Nav Breadcrumb -->
<div class="bg-surface-white border-b border-outline-variant/30 py-3.5 px-4 sm:px-6 lg:px-8 text-xs text-on-surface-variant font-medium">
    <div class="max-w-container-max mx-auto flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <span class="text-outline-variant">/</span>
        <a href="{{ route('services.index') }}" class="hover:text-primary transition-colors">Layanan Medis</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">{{ $service->title }}</span>
    </div>
</div>

<!-- Header Banner -->
<div class="bg-surface-container-low border-b border-outline-variant/30 py-12 md:py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <div class="max-w-container-max mx-auto relative z-10 space-y-4">
        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-primary"></span>
            Prosedur Klinis Spesialis
        </span>
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-headline-xl font-extrabold tracking-tight text-on-background leading-tight max-w-4xl">
            {{ $service->title }}
        </h1>
        <p class="text-on-surface-variant text-sm sm:text-base max-w-3xl leading-relaxed">
            {{ $service->summary }}
        </p>
    </div>
</div>

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 md:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
        
        <!-- Main Content (Left, 8 Cols) -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bg-surface-white rounded-3xl border border-outline-variant/30 p-6 sm:p-10 space-y-8 shadow-1">
                
                @php
                    $serviceImages = [];
                    if (str_contains(strtolower($service->slug), 'prosthet')) {
                        $serviceImages = [
                            asset('images/client_update/image3.png'),
                            asset('images/client_update/image1.png'),
                            asset('images/client_update/image5.png')
                        ];
                    } elseif (str_contains(strtolower($service->slug), 'bracing')) {
                        $serviceImages = [
                            asset('images/client_update/image7.png'),
                            asset('images/client_update/image4.png')
                        ];
                    } elseif (str_contains(strtolower($service->slug), 'scoliosis')) {
                        $serviceImages = [
                            asset('images/client_update/image6.png'),
                            asset('images/client_update/image2.png')
                        ];
                    } else {
                        $serviceImages = [
                            asset('images/client_update/image4.png'),
                            asset('images/client_update/image5.png')
                        ];
                    }
                @endphp

                <!-- Gallery Auto-Slide and Summary Intro Grid -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                    <!-- Photo Slideshow (5 cols) -->
                    <div class="md:col-span-6 relative rounded-2xl overflow-hidden shadow-md h-64 sm:h-72 border border-outline-variant/30 group"
                         x-data="{ currentImg: 0, imgs: @json($serviceImages) }"
                         x-init="if (imgs.length > 1) setInterval(() => { currentImg = (currentImg + 1) % imgs.length }, 3500)">
                        <template x-for="(imgSrc, iIdx) in imgs" :key="iIdx">
                            <img :src="imgSrc" :alt="'{{ $service->title }} - Slide ' + (iIdx + 1)"
                                 x-show="currentImg === iIdx"
                                 x-transition:enter="transition ease-out duration-700"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
                        </template>
                        <div class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-sm text-white text-[10px] px-2 py-0.5 rounded-full font-mono">
                            <span x-text="(currentImg + 1) + '/' + imgs.length"></span>
                        </div>
                    </div>

                    <!-- Intro Highlights (6 cols) -->
                    <div class="md:col-span-6 space-y-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-primary">Standar Layanan Kemenkes</span>
                        <h2 class="text-lg sm:text-xl font-bold text-slate-900 leading-snug">
                            {{ $service->title }}
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            {{ $service->summary }}
                        </p>
                        <div class="pt-2 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-xs font-semibold text-slate-700">Garansi Fitting & Evaluasi Berkala</span>
                        </div>
                    </div>
                </div>

                <!-- Main Content Body -->
                <div class="prose prose-slate max-w-none text-sm sm:text-base text-on-surface-variant leading-relaxed space-y-4 pt-4 border-t border-outline-variant/20">
                    {!! $service->content !!}
                </div>

                <!-- Box Konsultasi Medis Di Bawah Deskripsi -->
                <div class="p-6 rounded-2xl bg-gradient-to-r from-teal-50 to-emerald-50 border border-teal-200/80 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="space-y-1 text-center sm:text-left">
                        <span class="text-xs font-extrabold text-teal-800 uppercase tracking-wider block">Konsultasi Medis Klinis</span>
                        <h4 class="text-sm sm:text-base font-bold text-slate-900">Ingin berkonsultasi mengenai {{ $service->title }}?</h4>
                        <p class="text-xs text-slate-600">Jadwalkan pemeriksaan klinis langsung dengan praktisi Ortotis Prostetis ber-STR & ber-SIP.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                        <a href="https://wa.me/6285697922194?text=Halo%20pediOcare,%20saya%20ingin%20konsultasi%20layanan%20{{ urlencode($service->title) }}." target="_blank"
                           class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-sm">
                            <span class="material-symbols-outlined text-sm">chat</span> WhatsApp
                        </a>
                        <a href="{{ route('consultation.create') }}?service_id={{ $service->id }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-primary hover:bg-secondary text-white text-xs font-bold transition shadow-sm">
                            <span class="material-symbols-outlined text-sm">calendar_month</span> Buat Janji
                        </a>
                    </div>
                </div>

                <!-- Indikasi Klinis -->
                @if($service->indications && count($service->indications) > 0)
                <div class="p-6 bg-surface-container-low rounded-2xl border border-outline-variant/30 space-y-3 mt-4">
                    <h3 class="font-headline-md font-bold text-primary text-sm sm:text-base uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-xl">fact_check</span>
                        <span>Indikasi Klinis Penanganan:</span>
                    </h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs sm:text-sm text-on-surface">
                        @foreach($service->indications as $ind)
                        <li class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-primary text-sm mt-0.5 shrink-0">check_circle</span>
                            <span>{{ $ind }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Bottom Consultation Green Banner -->
            <div class="bg-primary text-surface-white p-8 rounded-3xl flex flex-col sm:flex-row justify-between items-center gap-6 shadow-2">
                <div class="space-y-2 text-center sm:text-left">
                    <h3 class="font-headline-md text-xl font-bold text-white">Butuh Penanganan Khusus untuk Kondisi Anda?</h3>
                    <p class="text-xs text-white/85 max-w-md">Konsultasikan keluhan Anda bersama tim ortotis dan prostetis berpengalaman kami hari ini.</p>
                </div>
                <a href="{{ route('consultation.create') }}?service_id={{ $service->id }}" class="shrink-0 bg-white hover:bg-slate-100 text-primary text-xs font-bold px-7 py-3.5 rounded-xl transition-all shadow-md hover:shadow-lg flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm text-primary">calendar_month</span> Buat Janji Temu
                </a>
            </div>
        </div>

        <!-- Sidebar Actions (Right, 4 Cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Booking Card -->
            <div class="bg-surface-white rounded-3xl border border-outline-variant/30 p-6 space-y-5 shadow-1 sticky top-24">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-primary block mb-1">Konsultasi Medis</span>
                    <h3 class="font-headline-md font-bold text-lg text-on-background">Buat Janji Temu & Konsultasi</h3>
                    <p class="text-xs text-on-surface-variant leading-relaxed mt-1">
                        Dapatkan evaluasi klinis dan asesmen postur tubuh bersama praktisi spesialis kami.
                    </p>
                </div>

                <div class="space-y-3 pt-2">
                    <a href="{{ route('consultation.create') }}?service_id={{ $service->id }}" 
                       class="w-full flex items-center justify-center bg-primary hover:bg-secondary text-surface-white text-sm font-bold h-12 rounded-xl transition shadow-sm">
                        Buat Janji Temu
                    </a>
                    <a href="https://wa.me/6285697922194?text=Halo%20pediOcare,%20saya%20ingin%20konsultasi%20layanan%20{{ urlencode($service->title) }}." target="_blank"
                       class="w-full flex items-center justify-center bg-surface-container-low hover:bg-surface-container-high text-primary text-sm font-bold h-12 rounded-xl border border-outline-variant/30 transition">
                        <span class="material-symbols-outlined text-lg mr-2">chat</span> Chat WhatsApp (0856 9792 2194)
                    </a>
                </div>

                <!-- Guarantee & Accreditation -->
                <div class="pt-4 border-t border-outline-variant/20 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-primary">Jaminan Layanan pediOcare</h4>
                    <div class="space-y-3 text-xs text-on-surface-variant">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">verified</span>
                            <div>
                                <strong class="text-on-background block">Standar Kemenkes RI</strong>
                                <span>Praktisi berlisensi dengan STR dan SIP aktif.</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5 shrink-0">published_with_changes</span>
                            <div>
                                <strong class="text-on-background block">Garansi Penyesuaian Fitting</strong>
                                <span>Penyesuaian soket gratis selama masa adaptasi pasien.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
