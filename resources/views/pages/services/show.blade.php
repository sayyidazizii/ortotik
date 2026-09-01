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
                    $serviceImages = $service->slider_images;
                @endphp

                <!-- Gallery Auto-Slide and Summary Intro Grid -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                    <!-- Photo Slideshow (6 cols) -->
                    <div class="md:col-span-6 space-y-3"
                         x-data="serviceGallerySlider(@js($serviceImages))"
                         @mouseenter="stopAutoplay()"
                         @mouseleave="startAutoplay()">
                        
                        <!-- Main Slider Image Box -->
                        <div class="relative rounded-2xl overflow-hidden shadow-md h-72 sm:h-80 border border-outline-variant/30 group bg-slate-900">
                            <template x-for="(imgSrc, iIdx) in imgs" :key="iIdx">
                                <img :src="imgSrc" :alt="'{{ $service->title }} - Slide ' + (iIdx + 1)"
                                     x-show="currentImg === iIdx"
                                     x-transition:enter="transition ease-out duration-700"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
                            </template>

                            <!-- Navigation Arrows (Shown if multiple images) -->
                            <template x-if="hasMultipleImages">
                                <div class="absolute inset-x-2 top-1/2 -translate-y-1/2 flex items-center justify-between pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <button type="button" @click="prev()" class="pointer-events-auto w-8 h-8 rounded-full bg-black/60 hover:bg-primary text-white flex items-center justify-center backdrop-blur-sm transition shadow-md">
                                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                                    </button>
                                    <button type="button" @click="next()" class="pointer-events-auto w-8 h-8 rounded-full bg-black/60 hover:bg-primary text-white flex items-center justify-center backdrop-blur-sm transition shadow-md">
                                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                                    </button>
                                </div>
                            </template>

                            <!-- Slider Counter Badge -->
                            <div class="absolute bottom-2.5 right-3 bg-black/60 backdrop-blur-sm text-white text-[10px] px-2.5 py-1 rounded-full font-mono flex items-center gap-1.5 shadow-sm">
                                <span class="material-symbols-outlined text-xs">photo_camera</span>
                                <span x-text="(currentImg + 1) + ' / ' + imgs.length"></span>
                            </div>
                        </div>

                        <!-- Thumbnail Strip (if multiple images) -->
                        <template x-if="hasMultipleImages">
                            <div class="flex items-center gap-2 overflow-x-auto pb-1">
                                <template x-for="(thumb, tIdx) in imgs" :key="tIdx">
                                    <button type="button" @click="currentImg = tIdx"
                                            :class="currentImg === tIdx ? 'ring-2 ring-primary scale-105 opacity-100' : 'opacity-60 hover:opacity-100'"
                                            class="w-14 h-11 rounded-lg overflow-hidden shrink-0 border border-outline-variant/30 transition-all duration-200">
                                        <img :src="thumb" class="w-full h-full object-cover">
                                    </button>
                                </template>
                            </div>
                        </template>
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
                <div class="p-6 rounded-2xl bg-gradient-to-r from-blue-50 via-sky-50 to-indigo-50 border border-sky-200/80 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="space-y-1 text-center sm:text-left">
                        <span class="text-xs font-extrabold text-primary uppercase tracking-wider block">Konsultasi Medis Klinis</span>
                        <h4 class="text-sm sm:text-base font-bold text-slate-900">Ingin berkonsultasi mengenai {{ $service->title }}?</h4>
                        <p class="text-xs text-slate-600">Jadwalkan pemeriksaan klinis langsung dengan praktisi Ortotis Prostetis ber-STR & ber-SIP.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                        <a href="https://wa.me/6285697922194?text=Halo%20pediOcare,%20saya%20ingin%20konsultasi%20layanan%20{{ urlencode($service->title) }}." target="_blank"
                           class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white text-xs font-bold transition shadow-sm">
                            <span class="material-symbols-outlined text-sm">chat</span> WhatsApp
                        </a>
                        <a href="{{ route('contact') }}?service_id={{ $service->id }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-primary hover:bg-primary-light text-white text-xs font-bold transition shadow-sm">
                            <span class="material-symbols-outlined text-sm">contacts</span> Kontak / Janji Temu
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
                <a href="{{ route('contact') }}?service_id={{ $service->id }}" class="shrink-0 bg-white hover:bg-slate-100 text-primary text-xs font-bold px-7 py-3.5 rounded-xl transition-all shadow-md hover:shadow-lg flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm text-primary">contacts</span> Hubungi Kami
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
                    <a href="{{ route('contact') }}?service_id={{ $service->id }}" 
                       class="w-full flex items-center justify-center bg-primary hover:bg-secondary text-surface-white text-sm font-bold h-12 rounded-xl transition shadow-sm">
                        Hubungi / Jadwalkan Konsultasi
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

<script>
    function serviceGallerySlider(images) {
        return {
            currentImg: 0,
            imgs: Array.isArray(images) && images.length > 0 ? images : [],
            autoplayTimer: null,
            get hasMultipleImages() {
                return this.imgs && this.imgs.length > 1;
            },
            next() {
                if (this.imgs.length > 0) {
                    this.currentImg = (this.currentImg + 1) % this.imgs.length;
                }
            },
            prev() {
                if (this.imgs.length > 0) {
                    this.currentImg = (this.currentImg - 1 + this.imgs.length) % this.imgs.length;
                }
            },
            startAutoplay() {
                if (this.hasMultipleImages) {
                    this.stopAutoplay();
                    this.autoplayTimer = setInterval(() => {
                        this.next();
                    }, 4000);
                }
            },
            stopAutoplay() {
                if (this.autoplayTimer) {
                    clearInterval(this.autoplayTimer);
                    this.autoplayTimer = null;
                }
            },
            init() {
                this.startAutoplay();
            }
        };
    }
</script>
@endsection
