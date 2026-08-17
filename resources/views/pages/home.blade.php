@extends('layouts.app')

@section('title', 'Beranda - PT. Orthocare Indonesia')
@section('meta_description', 'Solusi berteknologi tinggi untuk mobilitas dan kenyamanan Anda. Kami menghadirkan perawatan ortopedi presisi dengan sentuhan hangat.')

@section('content')

<!-- Hero Section -->
<section class="relative bg-surface-container-low overflow-hidden min-h-[620px] md:min-h-[760px] flex items-center pb-24 md:pb-36">
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden leading-[0]">
        <img alt="Hero Medical Background" class="w-full h-full object-cover opacity-50" src="https://lh3.googleusercontent.com/aida/AP1WRLu-cYuotNRMpQoNz8xiNuno33F9xSgeFfAKDWqxDogo2VSMvAuCS4QUt2jbop_cQ4e18T36Uqa6an8ezvVtDtXtwih7tYUxTzRHyWrqiqVAcV-b3G6wS_YbGIeB9Bl7tYBFGY4K81YU6TE_o1OvhLPzQstL7r4XrQEGsJ3mWxHjfxXavdzURFHoctGm1HxnTSA9wW180ytfdljOX3A9UWVLpKx5mwhgV3xHx-gbLfAcVFwk-s2AOYLy"/>
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
            <h1 class="font-headline-xl-mobile text-headline-xl-mobile md:font-headline-xl md:text-headline-xl text-on-background leading-tight relative font-bold">
                PT. Orthocare Indonesia: <span class="text-primary">Reborn Your Life</span> With Us
            </h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl leading-relaxed">
                Solusi berteknologi tinggi untuk mobilitas dan kenyamanan Anda. Kami menghadirkan perawatan ortopedi presisi dengan teknologi 3D scanning, material carbon fiber ringan, dan sentuhan klinis praktisi tersertifikasi.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 mt-2">
                <a href="https://wa.me/6281234567890?text=Halo%20PT.%20Orthocare%20Indonesia,%20saya%20ingin%20konsultasi%20layanan%20kesehatan%20ortopedi." target="_blank" rel="noopener noreferrer"
                   class="bg-primary text-on-primary px-7 py-3.5 rounded-xl font-label-md text-sm font-semibold hover:bg-secondary shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">chat</span> WhatsApp Consultation
                </a>
                <a href="{{ route('services.index') }}" 
                   class="border-2 border-primary/25 hover:border-primary text-on-surface hover:text-primary px-7 py-3.5 rounded-xl font-label-md text-sm font-semibold hover:bg-primary/5 transition-all duration-300 flex items-center justify-center bg-surface-white/80 backdrop-blur-sm">
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
                    <span class="text-[11px] text-on-surface-variant font-medium">Resmi Berlisensi</span>
                </div>
            </div>
        </div>

        <!-- Right: Doctor Cutout Visual Slide In from Right (Half Page) -->
        <div class="md:col-span-5 lg:col-span-5 relative flex items-center justify-center fade-in-right delay-200">
            <!-- Glowing Aura Circles -->
            <div class="absolute w-72 h-72 md:w-96 md:h-96 rounded-full bg-gradient-to-tr from-primary/20 to-secondary/20 blur-3xl -z-10 animate-pulse"></div>
            <div class="absolute w-60 h-60 md:w-80 md:h-80 rounded-full border-2 border-dashed border-primary/30 -z-10 animate-spin" style="animation-duration: 40s;"></div>

            <!-- Doctor Cutout Card with Smooth Float -->
            <div class="relative w-full max-w-sm md:max-w-md animate-float">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-surface-white bg-gradient-to-b from-primary/10 via-surface-white/40 to-transparent backdrop-blur-sm">
                    <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=800&q=80" 
                         alt="Dokter Spesialis Ortotik Prostetik PT. Orthocare Indonesia" 
                         class="w-full h-[380px] sm:h-[440px] md:h-[480px] object-cover object-top filter contrast-105 brightness-105"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-on-background/75 via-transparent to-transparent flex items-end p-6">
                        <div class="text-white">
                            <span class="text-[11px] uppercase tracking-wider font-semibold text-primary-fixed bg-white/15 px-3 py-1 rounded-full backdrop-blur-md inline-block mb-1.5">
                                Tim Klinis Spesialis
                            </span>
                            <h3 class="text-lg font-bold">dr. Hendra Pratama, Sp.OT</h3>
                            <p class="text-xs text-slate-200">Praktisi Ortotik & Prostetik Bionik</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Badge 1: Kemenkes (Top Left) -->
                <div class="absolute -top-3 -left-3 sm:-left-6 bg-surface-white/95 backdrop-blur-md p-3.5 rounded-2xl shadow-xl border border-outline-variant/30 flex items-center gap-3 animate-float delay-100">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl">verified_user</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-on-background block">Kemenkes RI</span>
                        <span class="text-[10px] text-primary font-semibold">Tersertifikasi Resmi</span>
                    </div>
                </div>

                <!-- Floating Badge 2: 3D Bionic (Bottom Right) -->
                <div class="absolute -bottom-3 -right-3 sm:-right-6 bg-surface-white/95 backdrop-blur-md p-3.5 rounded-2xl shadow-xl border border-outline-variant/30 flex items-center gap-3 animate-float delay-300">
                    <div class="w-10 h-10 rounded-xl bg-[#E5A500]/15 text-[#E5A500] flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl">precision_manufacturing</span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-on-background block">3D CAD/CAM</span>
                        <span class="text-[10px] text-[#E5A500] font-semibold">Akurasi Milimeter</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <!-- Wave Transition: Edge-to-Edge -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-[0] z-20 pointer-events-none -mb-[1px]">
        <svg class="relative block w-full w-[calc(100%+1.3px)] -ml-[0.5px] h-[60px] sm:h-[90px] md:h-[130px]" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-[#306D29]" d="M0,0 C150,100 350,0 500,80 C650,160 850,40 1200,100 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- Tentang Kami (About Us) -->
<section class="relative py-20 md:py-28 pb-28 md:pb-40 bg-[#f0fdfa] overflow-hidden fade-in-up" id="tentang">
    <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="grid md:grid-cols-2 gap-12 md:gap-20 items-center">
            
            <!-- Left: Text Slide In from Left -->
            <div class="fade-in-left delay-100">
                <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider mb-3">
                    Dedikasi & Integritas Medis
                </span>
                <h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-on-background mb-6 font-semibold">
                    Tentang PT. Orthocare Indonesia
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-6 leading-relaxed">
                    Berdedikasi untuk memberikan solusi mobilitas terbaik, PT. Orthocare Indonesia memadukan keahlian klinis dengan teknologi tinggi. Tim prostetis dan ortotis bersertifikasi kami merancang alat bantu yang disesuaikan secara khusus untuk mengembalikan fungsi dan meningkatkan kualitas hidup pasien.
                </p>
                <ul class="flex flex-col gap-4 mb-8">
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary bg-primary/10 p-1.5 rounded-full text-base">check</span>
                        <span class="font-body-md text-on-surface font-medium">Teknologi 3D Scanning & Printing Terkini</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary bg-primary/10 p-1.5 rounded-full text-base">check</span>
                        <span class="font-body-md text-on-surface font-medium">Sertifikasi Kemenkes Resmi</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary bg-primary/10 p-1.5 rounded-full text-base">check</span>
                        <span class="font-body-md text-on-surface font-medium">Pelayanan Komprehensif (Konsultasi hingga Rehabilitasi)</span>
                    </li>
                </ul>
                <a class="inline-flex items-center font-label-md text-label-md text-primary hover:text-secondary group transition-colors font-semibold" href="{{ route('about') }}">
                    Pelajari Lebih Lanjut <span class="material-symbols-outlined text-sm ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <!-- Right: Workshop Image Card Slide In from Right -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl h-[420px] md:h-[500px] fade-in-right delay-200 hover:-translate-y-2 transition-transform duration-500 border border-outline-variant/30 group">
                <img alt="Tentang Kami - Fasilitas & Workshop PT. Orthocare Indonesia" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida/AP1WRLsQeJ73W2vO0_8Vv2_uR_3cT7-T_u-f_Hq0_80K89kL0_QvT12_29Z_w3-F05W4-B97x6H5k_l7k2uL_t2K0fL0wVp3F2Q1M5s7C5A3Q0T8_m9-l2rZ3W50M1Z2qW9M3Q7x91c0"/>
                <div class="absolute inset-0 bg-gradient-to-t from-on-background/70 via-transparent to-transparent flex items-end p-8">
                    <div class="bg-surface-white/95 backdrop-blur-md p-4 rounded-2xl border border-outline-variant/30 flex items-center gap-4 w-full shadow-lg">
                        <div class="w-12 h-12 rounded-xl bg-primary text-white flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-2xl">biotech</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-on-background">Workshop Standar Internasional</h4>
                            <p class="text-xs text-on-surface-variant">Fabrikasi soket bionik & carbon fiber presisi.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <!-- Wave Transition: Edge-to-Edge -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-[0] z-20 pointer-events-none -mb-[1px]">
        <svg class="relative block w-full w-[calc(100%+1.3px)] -ml-[0.5px] h-[70px] sm:h-[110px] md:h-[160px]" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-[#306D29] opacity-40" d="M0,40 C200,120 400,20 600,100 C800,180 1000,60 1200,120 L1200,120 L0,120 Z"></path>
            <path class="fill-[#306D29]" d="M0,0 C150,100 350,0 500,80 C650,160 850,40 1200,100 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- Layanan Unggulan (Our Services) - Circular Horizontal Animated Slider -->
<section class="relative py-20 md:py-28 pb-28 md:pb-40 bg-[#f6fdfc] overflow-hidden fade-in-up" id="layanan">
    <div class="absolute -left-20 top-1/4 w-64 h-64 bg-[#306D29] opacity-5 rounded-full blur-3xl z-0 pointer-events-none"></div>
    <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        
        <!-- Header & Slider Navigation -->
        <div class="flex flex-col md:flex-row justify-between items-center md:items-end gap-6 mb-10 md:mb-14">
            <div class="text-center md:text-left">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider mb-3">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    Solusi Klinis Terintegrasi
                </span>
                <h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-on-background font-semibold">
                    Layanan Unggulan Kami
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
            <path class="fill-[#306D29] opacity-30" d="M0,20 C300,90 600,20 900,100 C1050,140 1150,80 1200,60 L1200,120 L0,120 Z"></path>
            <path class="fill-[#306D29]" d="M0,60 C200,120 500,40 800,100 C1000,140 1100,80 1200,100 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- Produk Terlaris (Best Seller Products) -->
<section class="relative py-20 md:py-28 pb-28 md:pb-40 bg-[#f0f9f8] overflow-hidden fade-in-up" id="produk">
    <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="text-center md:text-left mb-12 flex flex-col md:flex-row justify-between items-end gap-4">
            <div class="fade-in-left">
                <h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-on-background mb-4 font-semibold">
                    Produk Ready Stock Terlaris
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Solusi langsung untuk kebutuhan ortopedi Anda.
                </p>
            </div>
            <a href="{{ route('products.index') }}" class="hidden md:inline-flex items-center justify-center px-6 py-2.5 rounded-lg border border-outline text-on-surface font-label-md hover:bg-surface-variant transition-colors bg-surface-white font-semibold fade-in-right">
                Lihat Semua Produk
            </a>
        </div>
        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-6 lg:gap-8">
            <!-- Product 1 -->
            <div class="bg-surface-white rounded-2xl shadow-1 hover:shadow-hover p-3.5 sm:p-5 border border-outline-variant/20 flex flex-col group transition-all duration-300 hover:-translate-y-1 fade-in-up delay-100">
                <div class="aspect-square bg-background-subtle rounded-xl mb-3 sm:mb-5 relative overflow-hidden flex items-center justify-center p-3 sm:p-6">
                    <img alt="Advanced Articulating Knee Orthosis" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBRX96KTlDSHiomGN3OyOvDA8gmpFo6nH9DuQJ13zV-uwYj0On4T643XIIvI7ZfTgEHlGNMCnzLWygdnoChDtXh3HKQ3iKaxsBs2SXt9HZXR5pM7Qtw8KzFBwh-xAkBI6kBHJNij2YKEAiHE2MhApvaIyUSmfo0V7MtHqYRgFzaU3IRMw5FPuoduXReXEcCNbLjLVDm5pEO5HM2XWxQXW-P6GZ1bJoBKdVpdMOPdViOhKinS3glyd4"/>
                </div>
                <h3 class="font-label-md text-xs sm:text-sm md:text-base text-on-background mb-2 sm:mb-3 line-clamp-2 leading-snug font-semibold">
                    Advanced Articulating Knee Orthosis
                </h3>
                <div class="flex justify-between items-center mt-auto pt-2 border-t border-outline-variant/10 gap-1.5">
                    <span class="font-body-md text-xs sm:text-sm md:text-base text-primary font-bold">Rp 4.500.000</span>
                    <a href="https://wa.me/6281234567890?text=Halo%20PT.%20Orthocare%20Indonesia,%20saya%20tertarik%20pesan%20Advanced%20Articulating%20Knee%20Orthosis." target="_blank" rel="noopener noreferrer"
                       class="text-primary bg-primary/5 hover:bg-primary hover:text-surface-white p-2 sm:p-2.5 rounded-lg transition-all duration-300 flex items-center justify-center shrink-0" aria-label="Beli via WhatsApp">
                        <span class="material-symbols-outlined text-sm sm:text-base">shopping_cart</span>
                    </a>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="bg-surface-white rounded-2xl shadow-1 hover:shadow-hover p-3.5 sm:p-5 border border-outline-variant/20 flex flex-col group transition-all duration-300 hover:-translate-y-1 fade-in-up delay-200">
                <div class="aspect-square bg-background-subtle rounded-xl mb-3 sm:mb-5 relative overflow-hidden flex items-center justify-center p-3 sm:p-6">
                    <img alt="Post-Op Knee Brace" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida/AP1WRLvP5_T_X177T_O2m4uL3n9fG_2bW8mG7z28Z6n1x9Y_X04K51Z36_V61E7tV9U6V_l5w9Q5D2k5B5q8X93zH7n6O_E0G5K35Q4v0R8G8V9P_7R7w8D2U1uL9P8S_2O6D5oK9Q9G_F3I4M7L2K0dF7pQ0qK6G_5dZ9F_X8I"/>
                </div>
                <h3 class="font-label-md text-xs sm:text-sm md:text-base text-on-background mb-2 sm:mb-3 line-clamp-2 leading-snug font-semibold">
                    Post-Op Knee Brace
                </h3>
                <div class="flex justify-between items-center mt-auto pt-2 border-t border-outline-variant/10 gap-1.5">
                    <span class="font-body-md text-xs sm:text-sm md:text-base text-primary font-bold">Rp 2.100.000</span>
                    <a href="https://wa.me/6281234567890?text=Halo%20PT.%20Orthocare%20Indonesia,%20saya%20tertarik%20pesan%20Post-Op%20Knee%20Brace." target="_blank" rel="noopener noreferrer"
                       class="text-primary bg-primary/5 hover:bg-primary hover:text-surface-white p-2 sm:p-2.5 rounded-lg transition-all duration-300 flex items-center justify-center shrink-0" aria-label="Beli via WhatsApp">
                        <span class="material-symbols-outlined text-sm sm:text-base">shopping_cart</span>
                    </a>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="bg-surface-white rounded-2xl shadow-1 hover:shadow-hover p-3.5 sm:p-5 border border-outline-variant/20 flex flex-col group transition-all duration-300 hover:-translate-y-1 fade-in-up delay-300">
                <div class="aspect-square bg-background-subtle rounded-xl mb-3 sm:mb-5 relative overflow-hidden flex items-center justify-center p-3 sm:p-6">
                    <img alt="Pneumatic Walker Boot" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida/AP1WRLt9R2Z_K8mN1_yJ6n3A_4cZ0Q_1H7B3T9tV_7V5t_G0oO9wM1W6c4V3rG2D_wO_H4tN2H2_rG0V6M4U4Y6wE4O8A9Y1qU_5lH6qC_D2O8L_t5E3zW0oU6sZ9I6xQ5nN_7K9oQ_tH0Q_T4_K1rO1qI9cO9uI_9eL"/>
                </div>
                <h3 class="font-label-md text-xs sm:text-sm md:text-base text-on-background mb-2 sm:mb-3 line-clamp-2 leading-snug font-semibold">
                    Pneumatic Walker Boot
                </h3>
                <div class="flex justify-between items-center mt-auto pt-2 border-t border-outline-variant/10 gap-1.5">
                    <span class="font-body-md text-xs sm:text-sm md:text-base text-primary font-bold">Rp 1.850.000</span>
                    <a href="https://wa.me/6281234567890?text=Halo%20PT.%20Orthocare%20Indonesia,%20saya%20tertarik%20pesan%20Pneumatic%20Walker%20Boot." target="_blank" rel="noopener noreferrer"
                       class="text-primary bg-primary/5 hover:bg-primary hover:text-surface-white p-2 sm:p-2.5 rounded-lg transition-all duration-300 flex items-center justify-center shrink-0" aria-label="Beli via WhatsApp">
                        <span class="material-symbols-outlined text-sm sm:text-base">shopping_cart</span>
                    </a>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="bg-surface-white rounded-2xl shadow-1 hover:shadow-hover p-3.5 sm:p-5 border border-outline-variant/20 flex flex-col group transition-all duration-300 hover:-translate-y-1 fade-in-up delay-400">
                <div class="aspect-square bg-background-subtle rounded-xl mb-3 sm:mb-5 relative overflow-hidden flex items-center justify-center p-3 sm:p-6">
                    <img alt="Shoulder Abduction Sling" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAomziuJgJ2pOhXZgdUea70UNAeDJWO2fp4tlHGaJSsRZzvuRuB2Kc2_T2okGTeJOAS_3ltSSAEzvli_BLT0dtUyfNpv15k7BgkIBMyvxqNj-Xi7vFkNO0qsQv4XOcHozbKjNAJ4gxdbqLkV_DzX5TZ_AFikagGERipBHIk8EDYY16XTxgkTLlp3BZ0z-fE9hJrv4zTlytToR1ap0wVxS0FT9t2cVYYuPOu67YgO1nGdYVm8x2gSS0"/>
                </div>
                <h3 class="font-label-md text-xs sm:text-sm md:text-base text-on-background mb-2 sm:mb-3 line-clamp-2 leading-snug font-semibold">
                    Shoulder Abduction Sling
                </h3>
                <div class="flex justify-between items-center mt-auto pt-2 border-t border-outline-variant/10 gap-1.5">
                    <span class="font-body-md text-xs sm:text-sm md:text-base text-primary font-bold">Rp 1.250.000</span>
                    <a href="https://wa.me/6281234567890?text=Halo%20PT.%20Orthocare%20Indonesia,%20saya%20tertarik%20pesan%20Shoulder%20Abduction%20Sling." target="_blank" rel="noopener noreferrer"
                       class="text-primary bg-primary/5 hover:bg-primary hover:text-surface-white p-2 sm:p-2.5 rounded-lg transition-all duration-300 flex items-center justify-center shrink-0" aria-label="Beli via WhatsApp">
                        <span class="material-symbols-outlined text-sm sm:text-base">shopping_cart</span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="mt-8 text-center md:hidden">
            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 rounded-lg border border-outline text-on-surface font-label-md hover:bg-surface-variant transition-colors w-full bg-surface-white font-semibold">
                Lihat Semua Produk
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
<section class="relative py-20 md:py-28 bg-surface-white overflow-hidden fade-in-up">
    <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="text-center mb-16">
            <h2 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-on-background mb-4 font-semibold">
                Apa Kata Pasien Kami
            </h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mx-auto">
                Kepercayaan Anda adalah motivasi kami untuk terus memberikan pelayanan terbaik.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-background-subtle p-8 rounded-2xl border border-outline-variant/20 flex flex-col gap-4 hover:shadow-lg transition-shadow duration-300">
                <div class="flex gap-1 text-[#306D29]">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
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

            <!-- Testimonial 2 -->
            <div class="bg-background-subtle p-8 rounded-2xl border border-outline-variant/20 flex flex-col gap-4 hover:shadow-lg transition-shadow duration-300">
                <div class="flex gap-1 text-[#306D29]">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                </div>
                <p class="font-body-md text-on-surface-variant italic leading-relaxed">
                    "Tim di Orthocare sangat sabar menjelaskan proses pembuatan brace untuk anak saya. Hasilnya sangat presisi dan berkualitas."
                </p>
                <div class="mt-4 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg">I</div>
                    <div>
                        <h4 class="font-label-md text-on-background font-semibold">Ibu Indah</h4>
                        <p class="font-label-sm text-on-surface-variant">Orang Tua Pasien Ortotik</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-background-subtle p-8 rounded-2xl border border-outline-variant/20 flex flex-col gap-4 hover:shadow-lg transition-shadow duration-300">
                <div class="flex gap-1 text-[#306D29]">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
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
        </div>
    </div>
</section>

<!-- Lokasi Kami & Form Janji Temu -->
<section class="relative py-20 md:py-28 pb-28 md:pb-40 bg-[#e6f4f2] overflow-hidden fade-in-up" id="lokasi">
    <div class="absolute -right-32 bottom-1/4 w-96 h-96 bg-[#306D29] opacity-[0.03] rounded-full blur-3xl z-0 pointer-events-none"></div>
    <div class="relative z-10 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
            
            <!-- Left: Lokasi Kami (Slide In from Left) -->
            <div class="lg:col-span-5 flex flex-col gap-8 fade-in-left">
                <div>
                    <h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-background mb-4 font-semibold">
                        Lokasi Kami
                    </h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-6">
                        Kunjungi klinik kami untuk konsultasi langsung dengan ahli ortopedi.
                    </p>
                </div>
                
                <div class="bg-surface-white rounded-2xl p-8 shadow-1 border border-outline-variant/20 flex flex-col gap-8 hover:shadow-hover transition-shadow duration-300">
                    <div class="flex items-start gap-5">
                        <div class="bg-primary/10 p-3.5 rounded-xl text-primary">
                            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">location_on</span>
                        </div>
                        <div>
                            <h3 class="font-headline-md text-headline-md text-on-surface mb-2 font-semibold">Klinik Pusat Sleman</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                Jl. Kaliurang KM 8.5, Sinduharjo, Ngaglik<br/>Kab. Sleman, D.I. Yogyakarta 55581<br/>Indonesia
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-5">
                        <div class="bg-primary/10 p-3.5 rounded-xl text-primary">
                            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">call</span>
                        </div>
                        <div>
                            <h3 class="font-headline-md text-headline-md text-on-surface mb-2 font-semibold">Kontak</h3>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                (0274) 889912 / 0812-3456-7890<br/>info@orthocare.co.id
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-surface-white rounded-2xl shadow-1 border border-outline-variant/20 overflow-hidden h-72 relative">
                    <iframe 
                        title="Peta Lokasi PT. Orthocare Indonesia - Sleman Yogyakarta"
                        src="https://maps.google.com/maps?q=Jl.+Kaliurang+KM+8.5,+Sinduharjo,+Ngaglik,+Sleman,+Yogyakarta&t=&z=15&ie=UTF8&iwloc=&output=embed" 
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
