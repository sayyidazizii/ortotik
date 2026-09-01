@extends('layouts.app')

@section('title', 'pediOcare - Care your milestone')
@section('meta_description', 'pediOcare berdedikasi melakukan pelayanan Ortotik Prostetik untuk membantu menunjang fungsi gerak, kenyamanan, serta kualitas hidup pengguna. Care your milestone.')

@section('content')

@php
    $heroMedia = $settings['hero_home_media'] ?? 'https://lh3.googleusercontent.com/aida/AP1WRLu-cYuotNRMpQoNz8xiNuno33F9xSgeFfAKDWqxDogo2VSMvAuCS4QUt2jbop_cQ4e18T36Uqa6an8ezvVtDtXtwih7tYUxTzRHyWrqiqVAcV-b3G6wS_YbGIeB9Bl7tYBFGY4K81YU6TE_o1OvhLPzQstL7r4XrQEGsJ3mWxHjfxXavdzURFHoctGm1HxnTSA9wW180ytfdljOX3A9UWVLpKx5mwhgV3xHx-gbLfAcVFwk-s2AOYLy';
    if (!str_starts_with($heroMedia, 'http') && !str_starts_with($heroMedia, '/') && !empty($heroMedia)) {
        $heroMedia = asset($heroMedia);
    }
    $heroMediaType = $settings['hero_home_media_type'] ?? (preg_match('/\.(mp4|webm|ogg|mov)$/i', $heroMedia) ? 'video' : 'image');
    $clinicName = $settings['clinic_name'] ?? 'pediOcare';
    $hotlineWA = $settings['hotline_whatsapp'] ?? '0856 9792 2194';
    $cleanWA = preg_replace('/[^0-9]/', '', $hotlineWA);
    if (str_starts_with($cleanWA, '0')) {
        $cleanWA = '62' . substr($cleanWA, 1);
    }
@endphp

<!-- Hero Section -->
<section class="relative bg-surface-container-low overflow-hidden min-h-[620px] md:min-h-[760px] flex items-center pb-24 md:pb-36">
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden leading-[0]">
        @if($heroMediaType === 'video')
            <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-45">
                <source src="{{ $heroMedia }}" type="video/mp4">
            </video>
        @else
            <img alt="Hero Medical Background" class="w-full h-full object-cover opacity-50" src="{{ $heroMedia }}"/>
        @endif
        <div class="absolute inset-0 z-0">
            <svg class="w-full h-full opacity-90 block" preserveAspectRatio="none" fill="none" viewBox="0 0 1440 800" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0H800C600 0 400 400 400 800H0V0Z" fill="white"></path>
                <path d="M0 0H600C450 0 300 300 300 800H0V0Z" fill="#f8f9ff" opacity="0.5"></path>
            </svg>
        </div>
    </div>
    
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 md:py-20 grid grid-cols-1 md:grid-cols-12 gap-10 lg:gap-12 items-center relative z-10 w-full">
        
        <!-- Left: Text Slide In from Left -->
        <div class="md:col-span-7 lg:col-span-7 flex flex-col gap-6 fade-in-left">
            <div>
                <h1 class="font-headline-xl-mobile text-headline-xl-mobile md:font-headline-xl md:text-headline-xl text-on-background leading-tight relative font-black">
                    pedi<span class="text-secondary">O</span>care
                    <span class="text-primary text-xl sm:text-2xl md:text-3xl font-extrabold block mt-1 tracking-tight">{{ $settings['clinic_tagline'] ?? 'Care your milestone' }}</span>
                </h1>
            </div>
            
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl leading-relaxed text-sm sm:text-base">
                {{ $settings['hero_home_description'] ?? 'Sebaik-baik manusia adalah yang bermanfaat untuk orang lain. Kami memandang manusia sebagai makhluk ciptaan yang sempurna. Sudah lebih dari satu dekade pediOcare melayani, membantu dan memberi solusi bagi masyarakat yang membutuhkan layanan alat bantu Ortosis Prostesis. Suatu kebahagiaan bagi Kami ketika dapat melihat klien/pasien yang mengalami amputasi kaki namun dapat kembali berjalan penuhi harapan, anak lahir yang ditakdirkan memiliki keistimewaan dapat tumbuh dan berkembang sesuai capaian (milestone).' }}
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 mt-2">
                <a href="https://wa.me/{{ $cleanWA }}?text=Halo%20{{ urlencode($clinicName) }},%20saya%20ingin%20konsultasi%20layanan%20kesehatan%20ortopedi." 
                   target="_blank" rel="noopener noreferrer"
                   class="btn-shimmer group relative bg-gradient-to-r from-primary via-primary-light to-primary hover:from-secondary hover:to-secondary-light text-on-primary px-7 py-3.5 rounded-xl font-label-md text-sm font-semibold shadow-lg shadow-primary/25 hover:shadow-2xl hover:shadow-primary/40 hover:-translate-y-1 active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-2.5">
                    <!-- WhatsApp SVG Icon -->
                    <svg class="w-5 h-5 fill-current shrink-0 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.04 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67M8.53 7.33C8.37 7.33 8.1 7.39 7.87 7.64C7.65 7.89 7.02 8.48 7.02 9.68C7.02 10.88 7.9 12.04 8.02 12.2C8.14 12.37 9.73 14.83 12.18 15.88C14.21 16.76 14.63 16.58 15.07 16.54C15.52 16.5 16.5 15.96 16.7 15.39C16.91 14.81 16.91 14.33 16.85 14.22C16.78 14.12 16.62 14.05 16.38 13.94C16.14 13.82 14.96 13.24 14.74 13.16C14.52 13.08 14.36 13.04 14.2 13.28C14.03 13.53 13.57 14.06 13.43 14.22C13.29 14.38 13.15 14.4 12.91 14.28C12.67 14.16 11.9 13.91 10.98 13.09C10.26 12.45 9.78 11.66 9.64 11.42C9.5 11.17 9.62 11.04 9.74 10.92C9.85 10.81 9.99 10.63 10.11 10.49C10.23 10.34 10.28 10.24 10.36 10.08C10.44 9.91 10.4 9.77 10.34 9.66C10.28 9.54 9.8 8.35 9.59 7.86C9.4 7.39 9.2 7.45 9.04 7.44C8.89 7.43 8.71 7.33 8.53 7.33Z"/>
                    </svg>
                    <span>WhatsApp: {{ $hotlineWA }}</span>
                </a>
                <a href="{{ route('services.index') }}" 
                   class="border-2 border-primary/25 hover:border-primary text-on-surface hover:text-primary px-7 py-3.5 rounded-xl font-label-md text-sm font-semibold hover:bg-primary/5 transition-all duration-300 flex items-center justify-center bg-surface-white/80 backdrop-blur-sm shadow-xs hover:shadow-md">
                    Lihat Layanan
                </a>
            </div>

            <!-- Quick Feature Stat Badges -->
            <div class="grid grid-cols-3 gap-4 pt-4 border-t border-outline-variant/20 mt-2">
                <div>
                    <span class="font-bold text-base md:text-lg text-primary block">100%</span>
                    <span class="text-[11px] text-on-surface-variant font-medium">Garansi Fitting</span>
                </div>
                <div>
                    <span class="font-bold text-base md:text-lg text-primary block">3D CAD</span>
                    <span class="text-[11px] text-on-surface-variant font-medium">Scan Presisi</span>
                </div>
                <div>
                    <span class="font-bold text-base md:text-lg text-primary block">Kemenkes</span>
                    <span class="text-[10px] sm:text-[11px] text-on-surface-variant font-medium leading-tight block">memiliki Surat Tanda Registrasi dan Surat Izin Praktik</span>
                </div>
            </div>
        </div>

        <!-- Right: Doctor Cutout Visual Slide In from Right (Auto & Manual Slider) -->
        <div class="md:col-span-5 lg:col-span-5 relative flex items-center justify-center fade-in-right delay-200">
            <!-- Glowing Aura Circles -->
            <div class="absolute w-72 h-72 md:w-96 md:h-96 rounded-full bg-gradient-to-tr from-primary/20 to-secondary/20 blur-3xl -z-10 animate-pulse"></div>
            <div class="absolute w-60 h-60 md:w-80 md:h-80 rounded-full border-2 border-dashed border-primary/30 -z-10 animate-spin" style="animation-duration: 40s;"></div>

            @php
                $heroDoctorsRaw = $settings['hero_doctors'] ?? \App\Models\SiteSetting::get('hero_doctors');
                $heroDoctorsList = [];
                if (!empty($heroDoctorsRaw)) {
                    $decoded = is_array($heroDoctorsRaw) ? $heroDoctorsRaw : json_decode($heroDoctorsRaw, true);
                    if (is_array($decoded) && count($decoded) > 0) {
                        $heroDoctorsList = $decoded;
                    }
                }
                
                if (empty($heroDoctorsList)) {
                    $heroDoctorsList = [
                        [
                            'image' => asset('images/client_update/image5.png'),
                            'name'  => 'Muhammad Antas Salam., S.Tr.Kes',
                            'title' => 'Praktisi Ortotik & Prostetik Medis',
                            'badge' => 'Tim Klinis Spesialis'
                        ],
                        [
                            'image' => asset('images/client_update/image4.png'),
                            'name'  => 'Muhammad Antas Salam., S.Tr.Kes',
                            'title' => 'Spesialis Ortotik & Prostetik',
                            'badge' => 'Tim Klinis Spesialis'
                        ],
                        [
                            'image' => asset('images/client_update/image2.png'),
                            'name'  => 'Tim Ortotik Prostetik pediOcare',
                            'title' => 'Praktisi Berlisensi STR & SIP Kemenkes',
                            'badge' => 'Tim Klinis Spesialis'
                        ],
                    ];
                }

                foreach ($heroDoctorsList as &$docItem) {
                    $img = $docItem['image'] ?? '';
                    if (empty($img)) {
                        $docItem['image'] = asset('images/client_update/image5.png');
                    } else {
                        // If stored with domain (e.g. http://127.0.0.1:8000/images/...), strip domain
                        if (preg_match('#(?:https?:)?//[^/]+/(images/.+|storage/.+)#i', $img, $m)) {
                            $img = $m[1];
                        }

                        if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://') || str_starts_with($img, '//') || str_starts_with($img, 'data:image/')) {
                            $docItem['image'] = $img;
                        } elseif (str_starts_with($img, 'images/') || str_starts_with($img, '/images/')) {
                            $docItem['image'] = asset(ltrim($img, '/'));
                        } elseif (str_starts_with($img, 'storage/') || str_starts_with($img, '/storage/')) {
                            $docItem['image'] = asset(ltrim($img, '/'));
                        } else {
                            $docItem['image'] = asset('storage/' . $img);
                        }
                    }
                }
                unset($docItem);
            @endphp

            <!-- Doctor Cutout Card with Smooth Float, Auto-Slide & Manual Controls -->
            <div class="relative w-full max-w-sm md:max-w-md animate-float group/slider" 
                 x-data="{ 
                     currentHeroSlide: 0, 
                     totalSlides: {{ count($heroDoctorsList) }},
                     heroSlides: @js($heroDoctorsList),
                     timer: null,
                     isPaused: false,
                     touchStartX: 0,
                     touchEndX: 0,
                     startAutoSlide() {
                         this.stopAutoSlide();
                         this.timer = setInterval(() => {
                             if (!this.isPaused && this.totalSlides > 1) {
                                 this.nextSlide(false);
                             }
                         }, 4500);
                     },
                     stopAutoSlide() {
                         if (this.timer) clearInterval(this.timer);
                     },
                     nextSlide(manual = true) {
                         this.currentHeroSlide = (this.currentHeroSlide + 1) % this.totalSlides;
                         if (manual) this.startAutoSlide();
                     },
                     prevSlide(manual = true) {
                         this.currentHeroSlide = (this.currentHeroSlide - 1 + this.totalSlides) % this.totalSlides;
                         if (manual) this.startAutoSlide();
                     },
                     goToSlide(index) {
                         this.currentHeroSlide = index;
                         this.startAutoSlide();
                     },
                     handleTouchStart(e) {
                         this.touchStartX = e.changedTouches[0].screenX;
                     },
                     handleTouchEnd(e) {
                         this.touchEndX = e.changedTouches[0].screenX;
                         if (this.touchStartX - this.touchEndX > 45) {
                             this.nextSlide(true);
                         } else if (this.touchEndX - this.touchStartX > 45) {
                             this.prevSlide(true);
                         }
                     }
                 }" 
                 x-init="startAutoSlide()"
                 @mouseenter="isPaused = true"
                 @mouseleave="isPaused = false"
                 @touchstart.passive="handleTouchStart($event)"
                 @touchend.passive="handleTouchEnd($event)">
                
                <div class="relative rounded-3xl overflow-hidden shadow-2xl bg-gradient-to-b from-surface-white via-surface-container-low to-surface-container-high border-2 border-primary/20 p-2 sm:p-3">
                    <template x-for="(doc, dIdx) in heroSlides" :key="dIdx">
                        <div x-show="currentHeroSlide === dIdx"
                             x-transition:enter="transition ease-out duration-700"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="relative flex flex-col items-center">
                            <div class="relative w-full h-[320px] sm:h-[380px] md:h-[420px] rounded-2xl overflow-hidden bg-gradient-to-t from-primary/10 via-transparent to-transparent flex items-end justify-center">
                                <img :src="doc.image" 
                                     :alt="doc.name" 
                                     class="w-full h-full object-cover object-top filter contrast-105 drop-shadow-md"/>
                                
                                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-primary/90 via-primary/50 to-transparent p-4 text-center text-white">
                                    <span class="inline-block bg-white/20 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[10px] font-bold tracking-wide uppercase mb-1" x-text="doc.badge || 'Tim Klinis Spesialis'"></span>
                                    <h3 class="font-bold text-sm sm:text-base leading-snug drop-shadow-sm" x-text="doc.name"></h3>
                                    <p class="text-[11px] text-white/85 font-medium leading-tight mt-0.5" x-text="doc.title"></p>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Manual Prev Slide Button -->
                    <button type="button" 
                            @click.stop="prevSlide()"
                            class="absolute left-2.5 top-1/2 -translate-y-1/2 z-20 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-black/35 hover:bg-primary backdrop-blur-md text-white border border-white/25 flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-lg group-hover/slider:opacity-100 opacity-70 focus:outline-none"
                            title="Praktisi Sebelumnya"
                            aria-label="Praktisi Sebelumnya">
                        <span class="material-symbols-outlined text-lg sm:text-xl">chevron_left</span>
                    </button>

                    <!-- Manual Next Slide Button -->
                    <button type="button" 
                            @click.stop="nextSlide()"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 z-20 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-black/35 hover:bg-primary backdrop-blur-md text-white border border-white/25 flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-lg group-hover/slider:opacity-100 opacity-70 focus:outline-none"
                            title="Praktisi Selanjutnya"
                            aria-label="Praktisi Selanjutnya">
                        <span class="material-symbols-outlined text-lg sm:text-xl">chevron_right</span>
                    </button>
                </div>

                <!-- Floating Badge 1: Kemenkes (Top Left) -->
                <div class="absolute -top-3 -left-3 sm:-left-6 bg-surface-white/95 backdrop-blur-md p-3.5 rounded-2xl shadow-xl border border-outline-variant/30 flex items-center gap-3 animate-float delay-100 max-w-[220px] z-30">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-xl">verified_user</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-on-background block">{{ $settings['hero_badge_1_title'] ?? 'Kemenkes' }}</span>
                        <span class="text-[9px] text-primary font-semibold leading-tight block">{{ $settings['hero_badge_1_subtitle'] ?? 'memiliki STR & SIP Resmi' }}</span>
                    </div>
                </div>

                <!-- Floating Badge 2: 100% Garansi Fitting (Bottom Right) -->
                <div class="absolute -bottom-3 -right-3 sm:-right-6 bg-surface-white/95 backdrop-blur-md p-3.5 rounded-2xl shadow-xl border border-outline-variant/30 flex items-center gap-3 animate-float delay-300 max-w-[220px] z-30">
                    <div class="w-10 h-10 rounded-xl bg-secondary/15 text-secondary flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-xl">precision_manufacturing</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-on-background block">{{ $settings['hero_badge_2_title'] ?? '100% Garansi Fitting' }}</span>
                        <span class="text-[10px] text-secondary font-semibold">{{ $settings['hero_badge_2_subtitle'] ?? 'Akurasi & Kenyamanan' }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <!-- Wave Transition: Edge-to-Edge -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-[0] z-20 pointer-events-none -mb-[1px]">
        <svg class="relative block w-full w-[calc(100%+1.3px)] -ml-[0.5px] h-[60px] sm:h-[90px] md:h-[130px]" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-[#0F2C59]" d="M0,0 C150,100 350,0 500,80 C650,160 850,40 1200,100 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- Tentang Kami (About Us) -->
<section class="relative py-20 md:py-28 pb-28 md:pb-40 bg-[#F0F7FF] overflow-hidden fade-in-up" id="tentang">
    <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="grid md:grid-cols-2 gap-12 md:gap-20 items-center">
            
            <!-- Left: Text Slide In from Left -->
            <div class="fade-in-left delay-100">
                <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider mb-3">
                    Dedikasi & Integritas Medis
                </span>
                <h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-on-background mb-6 font-semibold">
                    Tentang {{ $settings['clinic_name'] ?? 'pediOcare' }}
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-6 leading-relaxed">
                    {{ $settings['about_company_description'] ?? 'Pediocare Berdedikasi melakukan Pelayanan Ortotik Prostetik untuk membantu menunjang fungsi gerak, kenyamanan, serta kualitas hidup pengguna. Sejak 2012 Pediocare telah melayani dengan menghadirkan produk custom maupun readymade dengan mengutamakan kualitas bahan, kerapian pengerjaan, serta memperhatikan kebutuhan setiap pengguna. Dengan 14 tahun pengalaman di dunia alat bantu, Pediocare akan selalu berkomitmen memberi solusi yang terbaik dan dapat diandalkan.' }}
                </p>
                <ul class="flex flex-col gap-4 mb-8">
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-white bg-primary p-1.5 rounded-full text-base">check</span>
                        <span class="font-body-md text-on-surface font-medium">Teknologi terkini dengan standar pelayanan & alat customize yang presisi.</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-white bg-primary p-1.5 rounded-full text-base">check</span>
                        <span class="font-body-md text-on-surface font-medium">Praktisi Ortotis Prostetis legal memiliki STR & Surat Ijin Praktik Dinas Kesehatan.</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-white bg-primary p-1.5 rounded-full text-base">check</span>
                        <span class="font-body-md text-on-surface font-medium">Pelayanan komprehensif dan paripurna (konsultasi gratis).</span>
                    </li>
                </ul>
                <a class="inline-flex items-center font-label-md text-label-md text-primary hover:text-secondary group transition-colors font-semibold" href="{{ route('about') }}">
                    Pelajari Lebih Lanjut <span class="material-symbols-outlined text-sm ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <!-- Right: Photo Gallery Box (Auto-slide Activity Photos) -->
            @php
                $aboutActivityImages = [];
                $rawActivitySetting = $settings['about_activity_images'] ?? null;
                if (!empty($rawActivitySetting)) {
                    $decoded = is_array($rawActivitySetting) ? $rawActivitySetting : json_decode($rawActivitySetting, true);
                    if (is_array($decoded)) {
                        foreach ($decoded as $img) {
                            if (!empty($img)) {
                                $aboutActivityImages[] = (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) ? $img : ('/' . ltrim($img, '/'));
                            }
                        }
                    }
                }
                if (empty($aboutActivityImages)) {
                    $aboutActivityImages = [
                        asset('images/client_update/image2.png'),
                        asset('images/client_update/image5.png'),
                        asset('images/client_update/image3.png'),
                        asset('images/client_update/image7.png'),
                    ];
                }
            @endphp
            <div class="relative rounded-3xl overflow-hidden shadow-2xl h-[420px] md:h-[500px] fade-in-right delay-200 hover:-translate-y-2 transition-transform duration-500 border border-outline-variant/30 group"
                 x-data="{ currentAboutSlide: 0, aboutImages: @js($aboutActivityImages) }" 
                 x-init="if (aboutImages.length > 1) { setInterval(() => { currentAboutSlide = (currentAboutSlide + 1) % aboutImages.length }, 3500) }">
                <template x-for="(imgSrc, gIdx) in aboutImages" :key="gIdx">
                    <img :src="imgSrc" alt="{{ $settings['about_activity_title'] ?? 'Kegiatan Pelayanan Klinis pediOcare' }}" 
                         x-show="currentAboutSlide === gIdx"
                         x-transition:enter="transition ease-out duration-700"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
                </template>
                <div class="absolute inset-0 bg-gradient-to-t from-on-background/70 via-transparent to-transparent flex items-end p-8">
                    <div class="bg-surface-white/95 backdrop-blur-md p-4 rounded-2xl border border-outline-variant/30 flex items-center gap-4 w-full shadow-lg">
                        <div class="w-12 h-12 rounded-xl bg-primary text-white flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-2xl">biotech</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-on-background">{{ $settings['about_activity_title'] ?? 'Kegiatan Pelayanan Klinis pediOcare' }}</h4>
                            <p class="text-xs text-on-surface-variant">{{ $settings['about_activity_subtitle'] ?? 'Fabrikasi & Penanganan Ortotik Prostetik Berkualitas.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <!-- Wave Transition: Edge-to-Edge -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-[0] z-20 pointer-events-none -mb-[1px]">
        <svg class="relative block w-full w-[calc(100%+1.3px)] -ml-[0.5px] h-[70px] sm:h-[110px] md:h-[160px]" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-[#0F2C59] opacity-40" d="M0,40 C200,120 400,20 600,100 C800,180 1000,60 1200,120 L1200,120 L0,120 Z"></path>
            <path class="fill-[#0F2C59]" d="M0,0 C150,100 350,0 500,80 C650,160 850,40 1200,100 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- Layanan Unggulan (Our Services) - Circular Horizontal Animated Slider -->
<section class="relative py-20 md:py-28 pb-28 md:pb-40 bg-[#F8FAFC] overflow-hidden fade-in-up" id="layanan">
    <div class="absolute -left-20 top-1/4 w-64 h-64 bg-secondary opacity-5 rounded-full blur-3xl z-0 pointer-events-none"></div>
    <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        
        <!-- Header & Slider Navigation -->
        <div class="flex flex-col md:flex-row justify-between items-center md:items-end gap-6 mb-10 md:mb-14">
            <div class="text-center md:text-left">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider mb-3">
                    <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                    Solusi Klinis Terintegrasi
                </span>
                <h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-on-background font-black leading-tight">
                    Layanan Orthosis Prosthesis<br class="hidden sm:inline"> Dan Alat Bantu Ortopedi
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mt-1">
                    Solusi komprehensif untuk berbagai kebutuhan ortopedi, prostetik bionik, dan pemulihan gerak.
                </p>
            </div>
            
            <!-- Slider Control Buttons -->
            <div class="flex items-center gap-3">
                <button id="service-prev-btn" aria-label="Slide Sebelumnya" 
                        class="w-11 h-11 rounded-full bg-surface-white border border-outline-variant/30 text-primary hover:bg-primary hover:text-white shadow-1 flex items-center justify-center transition-all duration-300 active:scale-95 cursor-pointer">
                    <span class="material-symbols-outlined text-2xl">chevron_left</span>
                </button>
                <button id="service-next-btn" aria-label="Slide Berikutnya" 
                        class="w-11 h-11 rounded-full bg-surface-white border border-outline-variant/30 text-primary hover:bg-primary hover:text-white shadow-1 flex items-center justify-center transition-all duration-300 active:scale-95 cursor-pointer">
                    <span class="material-symbols-outlined text-2xl">chevron_right</span>
                </button>
            </div>
        </div>
        
        <!-- Horizontal Circular Slider Track (Mobile & Desktop) -->
        <div class="relative overflow-hidden -mx-margin-mobile md:-mx-margin-desktop px-margin-mobile md:px-margin-desktop">
            <div id="service-slider-track" 
                 class="flex items-center gap-6 sm:gap-8 overflow-x-auto no-scrollbar scroll-smooth py-6 px-2 cursor-grab select-none">
                
                <!-- Circle 1: Prosthetics -->
                <a href="{{ route('services.show', 'prosthetics') }}" 
                   class="service-circle-card group flex-shrink-0 w-52 h-52 sm:w-56 sm:h-56 md:w-64 md:h-64 rounded-full bg-surface-white border-2 border-primary/20 hover:border-primary shadow-1 hover:shadow-hover transition-all duration-500 flex flex-col items-center justify-center p-6 text-center hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 rounded-full transition-colors duration-500"></div>
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-3 group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-500 shadow-sm">
                        <span class="material-symbols-outlined text-2xl md:text-3xl">accessible_forward</span>
                    </div>
                    <h3 class="font-headline-md text-sm md:text-base font-bold text-on-background group-hover:text-primary transition-colors leading-tight mb-1">
                        Prosthetics
                    </h3>
                    <p class="text-[11px] md:text-xs text-on-surface-variant line-clamp-2 px-2 leading-relaxed">
                        Kaki & Tangan Palsu Presisi
                    </p>
                    <span class="text-[11px] text-primary font-semibold flex items-center gap-0.5 mt-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        Lihat <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </span>
                </a>

                <!-- Circle 2: Bracing & Supports -->
                <a href="{{ route('services.show', 'bracing-supports') }}" 
                   class="service-circle-card group flex-shrink-0 w-52 h-52 sm:w-56 sm:h-56 md:w-64 md:h-64 rounded-full bg-surface-white border-2 border-primary/20 hover:border-primary shadow-1 hover:shadow-hover transition-all duration-500 flex flex-col items-center justify-center p-6 text-center hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 rounded-full transition-colors duration-500"></div>
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-3 group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-500 shadow-sm">
                        <span class="material-symbols-outlined text-2xl md:text-3xl">accessibility_new</span>
                    </div>
                    <h3 class="font-headline-md text-sm md:text-base font-bold text-on-background group-hover:text-primary transition-colors leading-tight mb-1">
                        Bracing & Supports
                    </h3>
                    <p class="text-[11px] md:text-xs text-on-surface-variant line-clamp-2 px-2 leading-relaxed">
                        Penyangga Sendi Ortopedi
                    </p>
                    <span class="text-[11px] text-primary font-semibold flex items-center gap-0.5 mt-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        Lihat <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </span>
                </a>

                <!-- Circle 3: Scoliosis Center -->
                <a href="{{ route('services.show', 'scoliosis-center') }}" 
                   class="service-circle-card group flex-shrink-0 w-52 h-52 sm:w-56 sm:h-56 md:w-64 md:h-64 rounded-full bg-surface-white border-2 border-primary/20 hover:border-primary shadow-1 hover:shadow-hover transition-all duration-500 flex flex-col items-center justify-center p-6 text-center hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 rounded-full transition-colors duration-500"></div>
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-3 group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-500 shadow-sm">
                        <span class="material-symbols-outlined text-2xl md:text-3xl">airline_seat_recline_extra</span>
                    </div>
                    <h3 class="font-headline-md text-sm md:text-base font-bold text-on-background group-hover:text-primary transition-colors leading-tight mb-1">
                        Scoliosis Center
                    </h3>
                    <p class="text-[11px] md:text-xs text-on-surface-variant line-clamp-2 px-2 leading-relaxed">
                        Koreksi Skoliosis 3D
                    </p>
                    <span class="text-[11px] text-primary font-semibold flex items-center gap-0.5 mt-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        Lihat <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </span>
                </a>

                <!-- Circle 4: Physiotherapy -->
                <a href="{{ route('services.show', 'physiotherapy') }}" 
                   class="service-circle-card group flex-shrink-0 w-52 h-52 sm:w-56 sm:h-56 md:w-64 md:h-64 rounded-full bg-surface-white border-2 border-primary/20 hover:border-primary shadow-1 hover:shadow-hover transition-all duration-500 flex flex-col items-center justify-center p-6 text-center hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 rounded-full transition-colors duration-500"></div>
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-3 group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-500 shadow-sm">
                        <span class="material-symbols-outlined text-2xl md:text-3xl">physical_therapy</span>
                    </div>
                    <h3 class="font-headline-md text-sm md:text-base font-bold text-on-background group-hover:text-primary transition-colors leading-tight mb-1">
                        Physiotherapy
                    </h3>
                    <p class="text-[11px] md:text-xs text-on-surface-variant line-clamp-2 px-2 leading-relaxed">
                        Gait Training & Terapi Gerak
                    </p>
                    <span class="text-[11px] text-primary font-semibold flex items-center gap-0.5 mt-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        Lihat <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </span>
                </a>

                <!-- Circle 5: Neuro Robotic -->
                <a href="{{ route('services.show', 'neuro-robotic') }}" 
                   class="service-circle-card group flex-shrink-0 w-52 h-52 sm:w-56 sm:h-56 md:w-64 md:h-64 rounded-full bg-surface-white border-2 border-primary/20 hover:border-primary shadow-1 hover:shadow-hover transition-all duration-500 flex flex-col items-center justify-center p-6 text-center hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 rounded-full transition-colors duration-500"></div>
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-3 group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-500 shadow-sm">
                        <span class="material-symbols-outlined text-2xl md:text-3xl">smart_toy</span>
                    </div>
                    <h3 class="font-headline-md text-sm md:text-base font-bold text-on-background group-hover:text-primary transition-colors leading-tight mb-1">
                        Neuro Robotic
                    </h3>
                    <p class="text-[11px] md:text-xs text-on-surface-variant line-clamp-2 px-2 leading-relaxed">
                        Rehabilitasi Motorik Robotik
                    </p>
                    <span class="text-[11px] text-primary font-semibold flex items-center gap-0.5 mt-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        Lihat <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </span>
                </a>

                <!-- Circle 6: Custom Foot Insole 3D -->
                <a href="{{ route('custom-products.index') }}" 
                   class="service-circle-card group flex-shrink-0 w-52 h-52 sm:w-56 sm:h-56 md:w-64 md:h-64 rounded-full bg-surface-white border-2 border-primary/20 hover:border-primary shadow-1 hover:shadow-hover transition-all duration-500 flex flex-col items-center justify-center p-6 text-center hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 rounded-full transition-colors duration-500"></div>
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-3 group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-500 shadow-sm">
                        <span class="material-symbols-outlined text-2xl md:text-3xl">footprint</span>
                    </div>
                    <h3 class="font-headline-md text-sm md:text-base font-bold text-on-background group-hover:text-primary transition-colors leading-tight mb-1">
                        Custom Insole 3D
                    </h3>
                    <p class="text-[11px] md:text-xs text-on-surface-variant line-clamp-2 px-2 leading-relaxed">
                        Koreksi Flatfoot & Nyeri Tumit
                    </p>
                    <span class="text-[11px] text-primary font-semibold flex items-center gap-0.5 mt-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        Lihat <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </span>
                </a>

                <!-- Circle 7: Pediatric Care (Ortotik Anak) -->
                <a href="{{ route('services.index') }}" 
                   class="service-circle-card group flex-shrink-0 w-52 h-52 sm:w-56 sm:h-56 md:w-64 md:h-64 rounded-full bg-surface-white border-2 border-primary/20 hover:border-primary shadow-1 hover:shadow-hover transition-all duration-500 flex flex-col items-center justify-center p-6 text-center hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 rounded-full transition-colors duration-500"></div>
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-3 group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-500 shadow-sm">
                        <span class="material-symbols-outlined text-2xl md:text-3xl">child_care</span>
                    </div>
                    <h3 class="font-headline-md text-sm md:text-base font-bold text-on-background group-hover:text-primary transition-colors leading-tight mb-1">
                        Pediatric Care
                    </h3>
                    <p class="text-[11px] md:text-xs text-on-surface-variant line-clamp-2 px-2 leading-relaxed">
                        Koreksi Kaki O / Kaki X Anak
                    </p>
                    <span class="text-[11px] text-primary font-semibold flex items-center gap-0.5 mt-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        Lihat <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </span>
                </a>

            </div>
        </div>

        <!-- Slider Pagination Indicator Dots -->
        <div class="flex justify-center items-center gap-2 mt-8" id="service-slider-dots"></div>

    </div>
    
    <!-- Wave Transition: Edge-to-Edge -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-[0] z-20 pointer-events-none -mb-[1px]">
        <svg class="relative block w-full w-[calc(100%+1.3px)] -ml-[0.5px] h-[70px] sm:h-[110px] md:h-[160px]" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-[#0F2C59] opacity-30" d="M0,20 C300,90 600,20 900,100 C1050,140 1150,80 1200,60 L1200,120 L0,120 Z"></path>
            <path class="fill-[#0F2C59]" d="M0,60 C200,120 500,40 800,100 C1000,140 1100,80 1200,100 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- Produk Terlaris (Best Seller Products) -->
<section class="relative py-20 md:py-28 pb-28 md:pb-40 bg-[#F0F7FF] overflow-hidden fade-in-up" id="produk">
    <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="text-center md:text-left mb-10 md:mb-12 flex flex-col md:flex-row justify-between items-center md:items-end gap-4">
            <div class="fade-in-left">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider mb-2">
                    <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                    E-Katalog Ready Stock
                </span>
                <h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-on-background font-semibold">
                    Produk Ready Stock Terlaris
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mt-1">
                    Pilihan alat bantu ortotik dan ortopedi siap pakai dengan standar mutu dan fitting presisi.
                </p>
            </div>
            <a href="{{ route('products.index') }}" class="hidden md:inline-flex items-center gap-1.5 px-6 py-3 rounded-xl border border-outline-variant/40 text-primary font-bold text-xs hover:bg-primary hover:text-white transition-all bg-surface-white shadow-2xs hover:shadow-md fade-in-right">
                <span>Lihat Semua Katalog</span>
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
        
        @if(isset($featuredProducts) && $featuredProducts->count() > 0)
        <!-- Grid Real Database Products (Lapakgaming Compact Style) -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
            @foreach($featuredProducts as $prod)
            <a href="{{ route('products.show', $prod->slug) }}" 
               class="bg-surface-white border border-outline-variant/30 hover:border-primary rounded-2xl sm:rounded-3xl p-3 sm:p-3.5 transition-all duration-300 group flex flex-col justify-between h-full shadow-1 hover:shadow-hover hover:-translate-y-1 relative">
                
                <!-- Inner Image Box -->
                <div class="relative w-full aspect-square rounded-xl sm:rounded-2xl bg-surface-container-low/70 border border-outline-variant/20 overflow-hidden flex items-center justify-center p-3 sm:p-4 group-hover:bg-primary/5 transition-colors">
                    <img src="{{ $prod->thumbnail_url }}" alt="{{ $prod->name }}" 
                         class="w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-300"/>
                    
                    <!-- Category Badge (Positioned at Bottom-Left of Image) -->
                    <div class="absolute bottom-2 left-2 max-w-[calc(100%-16px)]">
                        <span class="bg-primary/95 text-white font-bold text-[9px] sm:text-[10px] px-2 py-0.5 rounded-md shadow-2xs truncate block leading-tight">
                            {{ $prod->category->name ?? 'Ortotik' }}
                        </span>
                    </div>

                    @if($prod->stock_status === 'in_stock' || $prod->stock_status === 'ready_stock')
                    <div class="absolute top-2 right-2">
                        <span class="bg-white/90 backdrop-blur-sm text-secondary font-bold text-[8px] sm:text-[9px] px-1.5 py-0.5 rounded-md border border-secondary/30 shadow-2xs">
                            Ready Stock
                        </span>
                    </div>
                    @endif
                </div>
                
                <!-- Compact Content Details -->
                <div class="pt-3 pb-0.5 flex flex-col justify-between flex-grow space-y-2">
                    <h3 class="text-xs sm:text-sm font-bold text-on-surface line-clamp-1 group-hover:text-primary transition-colors leading-snug">
                        {{ $prod->name }}
                    </h3>
                    
                    <div class="flex items-center justify-between pt-2 border-t border-outline-variant/15 mt-auto gap-1">
                        <div>
                            <span class="text-xs sm:text-sm md:text-base font-extrabold text-primary block leading-tight">{{ $prod->formatted_price }}</span>
                            @if($prod->formatted_discount_price)
                            <span class="text-[10px] text-slate-400 line-through block">{{ $prod->formatted_discount_price }}</span>
                            @endif
                        </div>
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-surface-container-low group-hover:bg-primary group-hover:text-white text-on-surface-variant flex items-center justify-center transition-colors shrink-0 shadow-2xs">
                            <span class="material-symbols-outlined text-sm sm:text-base">arrow_forward</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif
        
        <div class="mt-8 text-center md:hidden">
            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center gap-1.5 px-6 py-3 rounded-xl border border-outline-variant/40 text-primary font-bold text-xs hover:bg-primary hover:text-white transition-all w-full bg-surface-white shadow-sm">
                <span>Lihat Semua Katalog Produk</span>
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
    </div>
    
    <!-- Wave Transition: Edge-to-Edge -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-[0] z-20 pointer-events-none -mb-[1px]">
        <svg class="relative block w-full w-[calc(100%+1.3px)] -ml-[0.5px] h-[70px] sm:h-[110px] md:h-[160px]" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-[#FFFFFF]" d="M0,0 C150,100 350,0 500,80 C650,160 850,40 1200,100 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- Apa Kata Pasien Kami (Testimonials) -->
<section class="relative py-20 md:py-28 bg-surface-white overflow-hidden fade-in-up" id="testimoni">
    <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="text-center mb-16">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider mb-2">
                Ulasan & Kepuasan Pasien
            </span>
            <h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-on-background mb-4 font-semibold">
                Apa Kata Pasien Kami
            </h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mx-auto">
                Kepercayaan Anda adalah motivasi kami untuk terus memberikan pelayanan terbaik.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($testimonials as $t)
            <div class="bg-background-subtle p-8 rounded-2xl border border-outline-variant/20 flex flex-col justify-between hover:shadow-lg transition-shadow duration-300">
                <div class="space-y-4">
                    <div class="flex gap-1 text-primary">
                        @for($s = 1; $s <= 5; $s++)
                            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' {{ $s <= $t->rating ? '1' : '0' }};">star</span>
                        @endfor
                    </div>
                    <p class="font-body-md text-on-surface-variant italic leading-relaxed">
                        "{{ $t->testimony }}"
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-outline-variant/15 flex items-center gap-4">
                    @if($t->photo_url)
                    <img src="{{ $t->photo_url }}" alt="{{ $t->patient_name }}" class="w-12 h-12 rounded-full object-cover border border-outline-variant/30 shrink-0 shadow-2xs">
                    @else
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg shrink-0">
                        {{ strtoupper(substr($t->patient_name, 0, 1)) }}
                    </div>
                    @endif
                    <div class="min-w-0">
                        <h4 class="font-label-md text-on-background font-semibold truncate">{{ $t->patient_name }}</h4>
                        <p class="font-label-sm text-primary font-medium truncate">{{ $t->service_used }}</p>
                        @if($t->patient_info)
                        <p class="text-[11px] text-on-surface-variant truncate">{{ $t->patient_info }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <!-- Fallback Static Testimonials if DB empty -->
            <div class="bg-background-subtle p-8 rounded-2xl border border-outline-variant/20 flex flex-col gap-4 hover:shadow-lg transition-shadow duration-300">
                <div class="flex gap-1 text-primary">
                    @for($s = 1; $s <= 5; $s++)
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    @endfor
                </div>
                <p class="font-body-md text-on-surface-variant italic leading-relaxed">
                    "Pelayanan sangat profesional. Kaki palsu yang saya dapatkan sangat nyaman dan membantu saya kembali bekerja dengan percaya diri."
                </p>
                <div class="mt-4 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg">B</div>
                    <div>
                        <h4 class="font-label-md text-on-background font-semibold">Bapak Budi</h4>
                        <p class="font-label-sm text-on-surface-variant">Pasien Prostetik</p>
                    </div>
                </div>
            </div>

            <div class="bg-background-subtle p-8 rounded-2xl border border-outline-variant/20 flex flex-col gap-4 hover:shadow-lg transition-shadow duration-300">
                <div class="flex gap-1 text-primary">
                    @for($s = 1; $s <= 5; $s++)
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    @endfor
                </div>
                <p class="font-body-md text-on-surface-variant italic leading-relaxed">
                    "Tim di {{ $settings['clinic_name'] ?? 'pediOcare' }} sangat sabar menjelaskan proses pembuatan brace untuk anak saya. Hasilnya sangat presisi dan berkualitas."
                </p>
                <div class="mt-4 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg">I</div>
                    <div>
                        <h4 class="font-label-md text-on-background font-semibold">Ibu Indah</h4>
                        <p class="font-label-sm text-on-surface-variant">Orang Tua Pasien Ortotik</p>
                    </div>
                </div>
            </div>

            <div class="bg-background-subtle p-8 rounded-2xl border border-outline-variant/20 flex flex-col gap-4 hover:shadow-lg transition-shadow duration-300">
                <div class="flex gap-1 text-primary">
                    @for($s = 1; $s <= 5; $s++)
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    @endfor
                </div>
                <p class="font-body-md text-on-surface-variant italic leading-relaxed">
                    "Teknologi 3D scanning mereka luar biasa. Proses fitting jadi jauh lebih cepat dan akurat dibanding tempat lain yang pernah saya kunjungi."
                </p>
                <div class="mt-4 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg">A</div>
                    <div>
                        <h4 class="font-label-md text-on-background font-semibold">Andi Wijaya</h4>
                        <p class="font-label-sm text-on-surface-variant">Pasien Rehabilitasi</p>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Lokasi Kami & Form Janji Temu -->
<section class="relative py-20 md:py-28 pb-28 md:pb-40 bg-[#F0F7FF] overflow-hidden fade-in-up" id="lokasi">
    <div class="absolute -right-32 bottom-1/4 w-96 h-96 bg-secondary opacity-5 rounded-full blur-3xl z-0 pointer-events-none"></div>
    <div class="relative z-10 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
            
            <!-- Left: Lokasi Kami (Slide In from Left) -->
            <div class="lg:col-span-5 flex flex-col gap-8 fade-in-left">
                <div>
                    <h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-background mb-4 font-semibold">
                        Lokasi Kami
                    </h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-6">
                        Kunjungi klinik {{ $settings['clinic_name'] ?? 'pediOcare' }} untuk konsultasi langsung dengan ahli ortopedi kami.
                    </p>
                </div>
                @php
                    $mapsEmbed = $settings['google_maps_embed'] ?? null;
                    $clinicAddr = $settings['clinic_address'] ?? ($settings['footer_address'] ?? 'Jl. Kaliurang KM 8.5, Sinduharjo, Ngaglik, Sleman, D.I. Yogyakarta 55581');
                    if (empty($mapsEmbed)) {
                        $mapsSrc = "https://maps.google.com/maps?q=" . urlencode($clinicAddr) . "&t=&z=15&ie=UTF8&iwloc=&output=embed";
                    } else {
                        if (preg_match('/src="([^"]+)"/', $mapsEmbed, $matches)) {
                            $mapsSrc = $matches[1];
                        } else {
                            $mapsSrc = $mapsEmbed;
                        }
                    }
                    $clinicCity = $settings['clinic_city'] ?? 'Sleman, D.I. Yogyakarta';
                @endphp
                
                <div class="bg-surface-white rounded-2xl p-8 shadow-1 border border-outline-variant/20 flex flex-col gap-8 hover:shadow-hover transition-shadow duration-300">
                    <div class="flex items-start gap-5">
                        <div class="bg-primary/10 p-3.5 rounded-xl text-primary">
                            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">location_on</span>
                        </div>
                        <div>
                            <h3 class="font-headline-md text-headline-md text-on-surface mb-2 font-semibold">Klinik {{ $settings['clinic_name'] ?? 'pediOcare' }} ({{ $clinicCity }})</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                {{ $clinicAddr }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-5">
                        <div class="bg-primary/10 p-3.5 rounded-xl text-primary">
                            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">call</span>
                        </div>
                        <div>
                            <h3 class="font-headline-md text-headline-md text-on-surface mb-2 font-semibold">Kontak & Konsultasi</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                {{ $settings['hotline_whatsapp'] ?? '0856 9792 2194' }}<br/>{{ $settings['contact_email'] ?? 'info@pediocare.id' }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-surface-white rounded-2xl shadow-1 border border-outline-variant/20 overflow-hidden h-72 relative">
                    <iframe 
                        title="Peta Lokasi {{ $settings['clinic_name'] ?? 'pediOcare' }} - {{ $clinicCity }}"
                        src="{{ $mapsSrc }}" 
                        class="w-full h-full border-0" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Right: Buat Janji Temu Form (Slide In from Right) -->
            <div class="lg:col-span-7 fade-in-right delay-200">
                <div class="bg-surface-white rounded-3xl p-8 md:p-10 shadow-2 border border-outline-variant/20 h-full">
                    <h2 class="font-headline-lg-mobile md:font-headline-md text-headline-lg-mobile md:text-headline-md text-primary mb-2 font-bold">
                        Buat Janji Temu
                    </h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-8">
                        Jadwalkan konsultasi dengan tim ahli kami.
                    </p>

                    @if ($errors->any())
                    <div class="p-4 mb-6 bg-red-50 border-l-4 border-error text-sm text-red-700 rounded-lg">
                        <p class="font-semibold mb-1">Mohon perbaiki formulir:</p>
                        <ul class="list-disc list-inside text-xs">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('consultation.store') }}" method="POST" class="flex flex-col gap-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface mb-2 font-medium">Nama Lengkap *</label>
                                <input class="w-full rounded-xl border border-outline-variant bg-surface/50 focus:bg-surface focus:border-primary focus:ring-1 focus:ring-primary px-4 py-3.5 font-body-sm transition-colors" 
                                       placeholder="Masukkan nama lengkap" type="text" name="full_name" value="{{ old('full_name') }}" required/>
                            </div>
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface mb-2 font-medium">Nomor Telepon / WA *</label>
                                <input class="w-full rounded-xl border border-outline-variant bg-surface/50 focus:bg-surface focus:border-primary focus:ring-1 focus:ring-primary px-4 py-3.5 font-body-sm transition-colors" 
                                       placeholder="Contoh: 08123456789" type="tel" name="phone_number" value="{{ old('phone_number') }}" required/>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface mb-2 font-medium">Layanan *</label>
                                <select class="w-full rounded-xl border border-outline-variant bg-surface/50 focus:bg-surface focus:border-primary focus:ring-1 focus:ring-primary px-4 py-3.5 font-body-sm text-on-surface-variant transition-colors"
                                        name="complaint_type" required>
                                    <option value="" disabled selected>Pilih layanan...</option>
                                    <option value="Prostetik" {{ old('complaint_type') == 'Prostetik' ? 'selected' : '' }}>Prostetik (Kaki / Tangan Palsu)</option>
                                    <option value="Ortotik" {{ old('complaint_type') == 'Ortotik' ? 'selected' : '' }}>Ortotik (Brace / Penyangga)</option>
                                    <option value="Scoliosis" {{ old('complaint_type') == 'Scoliosis' ? 'selected' : '' }}>Koreksi Skoliosis 3D</option>
                                    <option value="Fisioterapi" {{ old('complaint_type') == 'Fisioterapi' ? 'selected' : '' }}>Fisioterapi & Gait Training</option>
                                    <option value="Konsultasi" {{ old('complaint_type') == 'Konsultasi' ? 'selected' : '' }}>Konsultasi Dokter & Evaluasi</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface mb-2 font-medium">Tanggal</label>
                                <input class="w-full rounded-xl border border-outline-variant bg-surface/50 focus:bg-surface focus:border-primary focus:ring-1 focus:ring-primary px-4 py-3.5 font-body-sm transition-colors" 
                                       type="date" name="preferred_date" value="{{ old('preferred_date', date('Y-m-d')) }}"/>
                            </div>
                        </div>

                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2 font-medium">Pesan Tambahan</label>
                            <textarea class="w-full rounded-xl border border-outline-variant bg-surface/50 focus:bg-surface focus:border-primary focus:ring-1 focus:ring-primary px-4 py-3.5 font-body-sm h-32 transition-colors" 
                                      placeholder="Keluhan atau kebutuhan Anda" name="notes">{{ old('notes') }}</textarea>
                        </div>

                        <button class="w-full bg-[#E5A500] hover:bg-[#CC9200] text-surface-white px-8 py-4 rounded-xl font-label-md font-semibold transition-colors flex items-center justify-center gap-2 mt-4 shadow-lg hover:shadow-xl cursor-pointer" type="submit">
                            <span class="material-symbols-outlined">calendar_month</span> Jadwalkan Konsultasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Wave Transition to Dark Footer: Edge-to-Edge -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-[0] z-20 pointer-events-none -mb-[1px]">
        <svg class="relative block w-full w-[calc(100%+1.3px)] -ml-[0.5px] h-[60px] sm:h-[90px] md:h-[130px]" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-[#0d1c2f]" d="M0,0 C300,100 600,20 900,80 C1050,110 1150,70 1200,90 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- Circular Horizontal Slider Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const track = document.getElementById('service-slider-track');
        const prevBtn = document.getElementById('service-prev-btn');
        const nextBtn = document.getElementById('service-next-btn');
        const dotsContainer = document.getElementById('service-slider-dots');
        
        if (!track) return;

        const cards = track.querySelectorAll('.service-circle-card');
        const totalCards = cards.length;

        // Generate dot indicators
        if (dotsContainer) {
            dotsContainer.innerHTML = '';
            for (let i = 0; i < totalCards; i++) {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = `w-2.5 h-2.5 rounded-full transition-all duration-300 ${i === 0 ? 'bg-primary w-7' : 'bg-outline-variant/50 hover:bg-primary/50'}`;
                dot.setAttribute('aria-label', `Slide ${i + 1}`);
                dot.addEventListener('click', () => {
                    if (cards[i]) {
                        cards[i].scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                    }
                });
                dotsContainer.appendChild(dot);
            }
        }

        const updateDots = () => {
            if (!dotsContainer) return;
            const dots = dotsContainer.children;
            const scrollLeft = track.scrollLeft;
            const cardWidth = cards[0] ? cards[0].offsetWidth + 24 : 250;
            const activeIndex = Math.min(totalCards - 1, Math.max(0, Math.round(scrollLeft / cardWidth)));

            for (let i = 0; i < dots.length; i++) {
                if (i === activeIndex) {
                    dots[i].className = 'w-7 h-2.5 rounded-full bg-primary transition-all duration-300';
                } else {
                    dots[i].className = 'w-2.5 h-2.5 rounded-full bg-outline-variant/50 hover:bg-primary/50 transition-all duration-300';
                }
            }
        };

        track.addEventListener('scroll', updateDots, { passive: true });

        // Step scroll buttons
        const getStepDistance = () => {
            return cards[0] ? cards[0].offsetWidth + 24 : 260;
        };

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                const maxScroll = track.scrollWidth - track.clientWidth;
                if (track.scrollLeft >= maxScroll - 10) {
                    track.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    track.scrollBy({ left: getStepDistance(), behavior: 'smooth' });
                }
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                if (track.scrollLeft <= 10) {
                    const maxScroll = track.scrollWidth - track.clientWidth;
                    track.scrollTo({ left: maxScroll, behavior: 'smooth' });
                } else {
                    track.scrollBy({ left: -getStepDistance(), behavior: 'smooth' });
                }
            });
        }

        // Auto sliding animation
        let autoSlideTimer = null;
        let isHovered = false;

        const startAutoSlide = () => {
            stopAutoSlide();
            autoSlideTimer = setInterval(() => {
                if (!isHovered) {
                    const maxScroll = track.scrollWidth - track.clientWidth;
                    if (track.scrollLeft >= maxScroll - 15) {
                        track.scrollTo({ left: 0, behavior: 'smooth' });
                    } else {
                        track.scrollBy({ left: getStepDistance(), behavior: 'smooth' });
                    }
                }
            }, 3200);
        };

        const stopAutoSlide = () => {
            if (autoSlideTimer) clearInterval(autoSlideTimer);
        };

        track.addEventListener('mouseenter', () => { isHovered = true; });
        track.addEventListener('mouseleave', () => { isHovered = false; });
        track.addEventListener('touchstart', () => { isHovered = true; }, { passive: true });
        track.addEventListener('touchend', () => { 
            setTimeout(() => { isHovered = false; }, 2000); 
        }, { passive: true });

        // Drag to scroll for desktop mouse
        let isDown = false;
        let startX;
        let scrollLeftPos;

        track.addEventListener('mousedown', (e) => {
            isDown = true;
            track.classList.add('cursor-grabbing');
            track.classList.remove('cursor-grab');
            startX = e.pageX - track.offsetLeft;
            scrollLeftPos = track.scrollLeft;
            isHovered = true;
        });

        window.addEventListener('mouseup', () => {
            if (isDown) {
                isDown = false;
                track.classList.remove('cursor-grabbing');
                track.classList.add('cursor-grab');
                isHovered = false;
            }
        });

        track.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - track.offsetLeft;
            const walk = (x - startX) * 1.5;
            track.scrollLeft = scrollLeftPos - walk;
        });

        // Initialize auto slider
        startAutoSlide();
    });
</script>

@endsection
