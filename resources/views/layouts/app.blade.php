<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', ($settings['clinic_name'] ?? 'pediOcare') . ' - ' . ($settings['clinic_tagline'] ?? 'Care your milestone'))</title>
    <meta name="description" content="@yield('meta_description', $settings['meta_description'] ?? 'Pusat pelayanan Ortotik Prostetik profesional tersertifikasi. Care your milestone.')"/>
    <meta name="keywords" content="@yield('meta_keywords', $settings['meta_keywords'] ?? 'kaki palsu jogja, ortotik prostetik jogja, klinik kaki palsu jogja, pembuatan kaki palsu yogyakarta, pediocare')"/>
    
    <!-- Google Fonts: Plus Jakarta Sans & Material Symbols Outlined -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS CDN with Plugins -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('logo/logo.jpg') }}"/>

    <!-- Alpine.js CDN -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#0F2C59",
                        "primary-dark": "#0A1D3B",
                        "primary-light": "#1E3A8A",
                        "secondary": "#0284C7",
                        "secondary-light": "#38BDF8",
                        "tertiary": "#0369A1",
                        "deep-forest": "#0B1E38",
                        "success-emerald": "#0284C7",
                        "background-subtle": "#F8FAFC",
                        "surface-white": "#FFFFFF",
                        "surface-container-low": "#F0F7FF",
                        "surface-container-lowest": "#FFFFFF",
                        "surface-container": "#E0F2FE",
                        "surface-container-high": "#BAE6FD",
                        "surface-container-highest": "#7DD3FC",
                        "on-surface": "#0F172A",
                        "on-surface-variant": "#334155",
                        "on-background": "#0F172A",
                        "on-primary": "#FFFFFF",
                        "on-primary-container": "#F0F7FF",
                        "on-secondary": "#FFFFFF",
                        "on-secondary-container": "#0369A1",
                        "on-tertiary": "#FFFFFF",
                        "on-tertiary-container": "#F8FAFC",
                        "outline": "#64748B",
                        "outline-variant": "#CBD5E1",
                        "secondary-container": "#BAE6FD",
                        "primary-fixed": "#BAE6FD",
                        "secondary-fixed": "#E0F2FE",
                        "tertiary-fixed": "#F0F7FF",
                        "error": "#BA1A1A",
                        "surface": "#F8FAFC",
                        "surface-dim": "#CBD5E1",
                        "surface-bright": "#F8FAFC",
                        "surface-variant": "#E2E8F0",
                        "surface-tint": "#0F2C59",
                        "inverse-surface": "#0F172A",
                        "inverse-on-surface": "#F8FAFC",
                        "inverse-primary": "#38BDF8",
                        "background": "#F8FAFC"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "3xl": "1.5rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "unit": "8px",
                        "margin-mobile": "16px",
                        "gutter": "24px",
                        "margin-desktop": "32px",
                        "container-max": "1280px"
                    },
                    fontFamily: {
                        "sans": ["'Plus Jakarta Sans'", "sans-serif"],
                        "headline-xl": ["'Plus Jakarta Sans'", "sans-serif"],
                        "headline-lg": ["'Plus Jakarta Sans'", "sans-serif"],
                        "headline-md": ["'Plus Jakarta Sans'", "sans-serif"],
                        "body-lg": ["'Plus Jakarta Sans'", "sans-serif"],
                        "body-md": ["'Plus Jakarta Sans'", "sans-serif"],
                        "body-sm": ["'Plus Jakarta Sans'", "sans-serif"],
                        "label-md": ["'Plus Jakarta Sans'", "sans-serif"],
                        "label-sm": ["'Plus Jakarta Sans'", "sans-serif"]
                    },
                    fontSize: {
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.02em", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "body-sm": ["14px", { "lineHeight": "22px", "fontWeight": "400" }],
                        "headline-xl": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-xl-mobile": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "letterSpacing": "0.04em", "fontWeight": "500" }],
                        "headline-lg-mobile": ["28px", { "lineHeight": "36px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>
    
    <style>
        .shadow-1 { box-shadow: 0px 4px 16px rgba(15, 44, 89, 0.06); }
        .shadow-2 { box-shadow: 0px 8px 24px rgba(15, 44, 89, 0.10); }
        .shadow-hover { box-shadow: 0px 12px 32px rgba(15, 44, 89, 0.15); }
        
        .fade-in-up {
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .fade-in-left {
            animation: fadeInLeft 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .fade-in-right {
            animation: fadeInRight 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(24px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            0% {
                opacity: 0;
                transform: translateX(-32px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            0% {
                opacity: 0;
                transform: translateX(32px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes floatSlow {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        .delay-400 { animation-delay: 400ms; }
        .delay-500 { animation-delay: 500ms; }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
            line-height: 1;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        @keyframes shimmerSweep {
            0% {
                transform: translateX(-150%) skewX(-25deg);
            }
            45%, 100% {
                transform: translateX(250%) skewX(-25deg);
            }
        }

        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }

        .btn-shimmer::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.08) 25%,
                rgba(255, 255, 255, 0.5) 50%,
                rgba(255, 255, 255, 0.08) 75%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: translateX(-150%) skewX(-25deg);
            animation: shimmerSweep 3.2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
            pointer-events: none;
        }

        .btn-shimmer:hover::after {
            animation-duration: 1.8s;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-background-subtle text-on-surface font-sans antialiased selection:bg-primary/20 selection:text-primary flex flex-col min-h-screen">

    @php
        $clinicName = $settings['clinic_name'] ?? 'pediOcare';
        $clinicTagline = $settings['clinic_tagline'] ?? 'Care your milestone';
        $hotlineWA = $settings['hotline_whatsapp'] ?? '0856 9792 2194';
        $cleanWA = preg_replace('/[^0-9]/', '', $hotlineWA);
        if (str_starts_with($cleanWA, '0')) {
            $cleanWA = '62' . substr($cleanWA, 1);
        }
        $contactPhone = $settings['phone_number'] ?? $hotlineWA;
        $contactEmail = $settings['contact_email'] ?? 'info@pediocare.id';
        $footerAddr = $settings['footer_address'] ?? ($settings['clinic_address'] ?? 'Jl. Kaliurang KM 8.5, Sinduharjo, Ngaglik, Sleman, D.I. Yogyakarta 55581');
    @endphp

    <!-- TopAppBar / Header -->
    <header class="bg-surface-white dark:bg-on-background sticky top-0 w-full z-50 border-b border-outline-variant/30 shadow-sm transition-all duration-300">
        <div class="flex justify-between items-center px-margin-mobile md:px-margin-desktop py-3.5 max-w-container-max mx-auto">
            <a href="{{ route('home') }}" class="flex items-center group py-0.5">
                <img src="{{ asset('logo/logo.jpg') }}" alt="{{ $clinicName }}" class="h-10 sm:h-12 w-auto object-contain hover:opacity-90 transition">
            </a>
            <nav class="hidden md:flex gap-gutter items-center">
                <a class="{{ request()->routeIs('home') ? 'text-primary dark:text-primary-fixed border-b-2 border-primary font-bold pb-1' : 'dark:text-on-surface-variant/80 font-medium hover:text-primary text-on-surface-variant' }} font-label-md text-label-md transition-colors duration-200" href="{{ route('home') }}">Beranda</a>
                <a class="{{ request()->routeIs('services.*') ? 'text-primary dark:text-primary-fixed border-b-2 border-primary font-bold pb-1' : 'dark:text-on-surface-variant/80 font-medium hover:text-primary text-on-surface-variant' }} font-label-md text-label-md transition-colors duration-200" href="{{ route('services.index') }}">Layanan</a>
                <a class="{{ request()->routeIs('products.*') ? 'text-primary dark:text-primary-fixed border-b-2 border-primary font-bold pb-1' : 'dark:text-on-surface-variant/80 font-medium hover:text-primary text-on-surface-variant' }} font-label-md text-label-md transition-colors duration-200" href="{{ route('products.index') }}">Product</a>
                <a class="{{ request()->routeIs('custom-products.*') ? 'text-primary dark:text-primary-fixed border-b-2 border-primary font-bold pb-1' : 'dark:text-on-surface-variant/80 font-medium hover:text-primary text-on-surface-variant' }} font-label-md text-label-md transition-colors duration-200" href="{{ route('custom-products.index') }}">Alur Pasien</a>
                <a class="{{ request()->routeIs('about*') ? 'text-primary dark:text-primary-fixed border-b-2 border-primary font-bold pb-1' : 'dark:text-on-surface-variant/80 font-medium hover:text-primary text-on-surface-variant' }} font-label-md text-label-md transition-colors duration-200" href="{{ route('about') }}">Tentang Kami</a>
                <a class="{{ request()->routeIs('articles.*') ? 'text-primary dark:text-primary-fixed border-b-2 border-primary font-bold pb-1' : 'dark:text-on-surface-variant/80 font-medium hover:text-primary text-on-surface-variant' }} font-label-md text-label-md transition-colors duration-200" href="{{ route('articles.index') }}">Artikel</a>
                <a class="{{ request()->routeIs('contact') ? 'text-primary dark:text-primary-fixed border-b-2 border-primary font-bold pb-1' : 'dark:text-on-surface-variant/80 font-medium hover:text-primary text-on-surface-variant' }} font-label-md text-label-md transition-colors duration-200" href="{{ route('contact') }}">Kontak</a>
            </nav>
            <div class="hidden md:flex items-center gap-unit">
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $contactPhone) }}" aria-label="call" class="flex items-center justify-center p-2 text-on-surface-variant hover:text-primary transition-colors duration-200 rounded-full hover:bg-surface-variant" title="Telepon">
                    <span class="material-symbols-outlined">call</span>
                </a>
                <a href="https://wa.me/{{ $cleanWA }}" target="_blank" aria-label="whatsapp" class="flex items-center justify-center p-2 text-on-surface-variant hover:text-primary transition-colors duration-200 rounded-full hover:bg-surface-variant" title="WhatsApp {{ $hotlineWA }}">
                    <span class="material-symbols-outlined">chat</span>
                </a>
                <a href="{{ route('contact') }}" class="bg-primary text-on-primary px-5 py-2.5 rounded-xl font-label-md text-label-md hover:bg-secondary hover:shadow-lg transition-all duration-300 ml-2 inline-flex items-center justify-center font-bold">Konsultasi</a>
            </div>
            <button class="md:hidden text-primary p-2 focus:outline-none" id="mobile-menu-btn" aria-label="Buka Menu">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </header>

    <!-- SideNavBar (Mobile Drawer & Backdrop) -->
    <div id="mobile-nav-backdrop" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-[55] opacity-0 pointer-events-none transition-opacity duration-300 md:hidden" aria-hidden="true"></div>
    <div class="fixed inset-y-0 right-0 w-80 max-w-[85vw] z-[60] bg-surface-container-lowest dark:bg-inverse-surface shadow-2xl flex flex-col h-full p-5 sm:p-6 pb-8 sm:pb-6 transform translate-x-full transition-transform duration-300 md:hidden overflow-y-auto" id="mobile-nav">
        <div class="flex justify-between items-center mb-4 shrink-0">
            <a href="{{ route('home') }}" class="block">
                <img src="{{ asset('logo/logo.jpg') }}" alt="{{ $clinicName }}" class="h-9 sm:h-10 w-auto object-contain">
            </a>
            <button class="text-on-surface-variant p-2 hover:text-primary hover:bg-surface-container-high rounded-lg transition" id="close-mobile-nav" aria-label="Tutup Menu">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <nav class="flex-1 flex flex-col gap-1.5 overflow-y-auto mb-3 pr-1">
            <a class="flex items-center gap-3.5 p-2.5 {{ request()->routeIs('home') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl font-body-md text-body-md hover:pl-3.5 transition-all duration-200" href="{{ route('home') }}">
                <span class="material-symbols-outlined text-xl">home</span> Beranda
            </a>
            <a class="flex items-center gap-3.5 p-2.5 {{ request()->routeIs('services.*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl font-body-md text-body-md hover:pl-3.5 transition-all duration-200" href="{{ route('services.index') }}">
                <span class="material-symbols-outlined text-xl">medical_services</span> Layanan
            </a>
            <a class="flex items-center gap-3.5 p-2.5 {{ request()->routeIs('products.*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl font-body-md text-body-md hover:pl-3.5 transition-all duration-200" href="{{ route('products.index') }}">
                <span class="material-symbols-outlined text-xl">inventory_2</span> Product
            </a>
            <a class="flex items-center gap-3.5 p-2.5 {{ request()->routeIs('custom-products.*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl font-body-md text-body-md hover:pl-3.5 transition-all duration-200" href="{{ route('custom-products.index') }}">
                <span class="material-symbols-outlined text-xl">mobile_share_stack</span> Alur Pasien
            </a>
            <a class="flex items-center gap-3.5 p-2.5 {{ request()->routeIs('about*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl font-body-md text-body-md hover:pl-3.5 transition-all duration-200" href="{{ route('about') }}">
                <span class="material-symbols-outlined text-xl">info</span> Tentang Kami
            </a>
            <a class="flex items-center gap-3.5 p-2.5 {{ request()->routeIs('articles.*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl font-body-md text-body-md hover:pl-3.5 transition-all duration-200" href="{{ route('articles.index') }}">
                <span class="material-symbols-outlined text-xl">newspaper</span> Artikel & Edukasi
            </a>
            <a class="flex items-center gap-3.5 p-2.5 {{ request()->routeIs('contact') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl font-body-md text-body-md hover:pl-3.5 transition-all duration-200" href="{{ route('contact') }}">
                <span class="material-symbols-outlined text-xl">contacts</span> Kontak
            </a>
        </nav>
        <div class="pt-4 border-t border-outline-variant/30 flex flex-col shrink-0 mt-auto">
            <a href="{{ route('contact') }}" class="w-full bg-[#E5A500] hover:bg-[#CC9200] text-white py-3.5 rounded-xl font-label-md text-label-md text-center font-bold shadow-md hover:shadow-lg transition flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-lg">contacts</span>
                <span>Hubungi / Kontak Kami</span>
            </a>
        </div>
    </div>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Floating Action WhatsApp Button -->
    <aside aria-label="WhatsApp Quick Contact">
        <a href="https://wa.me/{{ $cleanWA }}?text=Halo%20{{ urlencode($clinicName) }},%20saya%20ingin%20konsultasi%20mengenai%20alat%20medis%20dan%20jadwal%20klinik." 
           target="_blank" rel="noopener noreferrer"
           class="fixed bottom-6 right-6 bg-[#25D366] hover:bg-[#20ba5a] text-white p-3.5 sm:p-4 rounded-full shadow-2 hover:shadow-hover hover:-translate-y-2 transition-all duration-300 z-50 flex items-center justify-center group ring-4 ring-[#25D366]/20 active:scale-95"
           aria-label="Konsultasi WhatsApp {{ $hotlineWA }}">
            <svg class="w-7 h-7 sm:w-8 sm:h-8 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.04 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67M8.53 7.33C8.37 7.33 8.1 7.39 7.87 7.64C7.65 7.89 7.02 8.48 7.02 9.68C7.02 10.88 7.9 12.04 8.02 12.2C8.14 12.37 9.73 14.83 12.18 15.88C14.21 16.76 14.63 16.58 15.07 16.54C15.52 16.5 16.5 15.96 16.7 15.39C16.91 14.81 16.91 14.33 16.85 14.22C16.78 14.12 16.62 14.05 16.38 13.94C16.14 13.82 14.96 13.24 14.74 13.16C14.52 13.08 14.36 13.04 14.2 13.28C14.03 13.53 13.57 14.06 13.43 14.22C13.29 14.38 13.15 14.4 12.91 14.28C12.67 14.16 11.9 13.91 10.98 13.09C10.26 12.45 9.78 11.66 9.64 11.42C9.5 11.17 9.62 11.04 9.74 10.92C9.85 10.81 9.99 10.63 10.11 10.49C10.23 10.34 10.28 10.24 10.36 10.08C10.44 9.91 10.4 9.77 10.34 9.66C10.28 9.54 9.8 8.35 9.59 7.86C9.4 7.39 9.2 7.45 9.04 7.44C8.89 7.43 8.71 7.33 8.53 7.33Z"/>
            </svg>
        </a>
    </aside>

    <!-- Footer -->
    <footer class="relative bg-on-background text-on-primary-container w-full py-16 pt-16 md:pt-20 mb-0">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto font-body-sm text-body-sm text-surface-variant/70">
            <div class="col-span-1 md:col-span-2">
                <div class="mb-4">
                    <a href="{{ route('home') }}" class="inline-block bg-white p-2.5 rounded-2xl shadow-md hover:opacity-95 transition">
                        <img src="{{ asset('logo/logo.jpg') }}" alt="{{ $clinicName }}" class="h-10 sm:h-12 w-auto object-contain">
                    </a>
                </div>
                <div class="text-xs font-bold text-tertiary-fixed uppercase tracking-wider mb-4">{{ $clinicTagline }}</div>
                <p class="mb-6 max-w-sm leading-relaxed text-slate-300">{{ $settings['footer_description'] ?? 'Pusat pelayanan Ortotik Prostetik profesional dengan semangat bermanfaat untuk menunjang fungsi gerak dan kualitas hidup Anda.' }}</p>
                <div class="flex items-center gap-2 text-surface-white font-label-sm text-label-sm bg-surface-white/10 px-4 py-2 rounded-full w-fit border border-surface-white/20">
                    <span class="material-symbols-outlined text-sm text-primary-fixed">verified</span> Certified
                </div>
            </div>
            <div class="mt-8 md:mt-0">
                <h4 class="text-surface-white font-label-md text-label-md mb-6 uppercase tracking-wider font-semibold">Tautan Cepat</h4>
                <ul class="flex flex-col gap-4 text-slate-300">
                    <li><a class="hover:text-primary-fixed transition-colors" href="{{ route('services.index') }}">Layanan Medis</a></li>
                    <li><a class="hover:text-primary-fixed transition-colors" href="{{ route('products.index') }}">E-Katalog Produk</a></li>
                    <li><a class="hover:text-primary-fixed transition-colors" href="{{ route('custom-products.index') }}">Alur Pasien Custom</a></li>
                    <li><a class="hover:text-primary-fixed transition-colors" href="{{ route('about') }}">Tentang Kami</a></li>
                    <li><a class="hover:text-primary-fixed transition-colors" href="{{ route('articles.index') }}">Artikel & Edukasi</a></li>
                    <li><a class="hover:text-primary-fixed transition-colors" href="{{ route('contact') }}">Cabang & Kontak</a></li>
                </ul>
            </div>
            <div class="mt-8 md:mt-0">
                <h4 class="text-surface-white font-label-md text-label-md mb-6 uppercase tracking-wider font-semibold">Kontak & Konsultasi</h4>
                <ul class="flex flex-col gap-4 text-slate-300">
                    <li class="flex items-start gap-3"><span class="material-symbols-outlined text-sm mt-1 text-primary-fixed">location_on</span> {{ $footerAddr }}</li>
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-sm text-primary-fixed">mail</span> {{ $contactEmail }}</li>
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-sm text-primary-fixed">call</span> {{ $contactPhone }}</li>
                    <li class="flex items-center gap-3"><span class="material-symbols-outlined text-sm text-primary-fixed">chat</span> WhatsApp: {{ $hotlineWA }}</li>
                </ul>
            </div>
        </div>
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mt-16 pt-8 border-t border-surface-variant/10 text-center font-body-sm text-body-sm text-surface-variant/50 text-slate-400">
            &copy; {{ date('Y') }} {{ $clinicName }}. Certified. {{ $clinicTagline }}. All rights reserved.
        </div>
    </footer>

    <!-- Global Scripts: Mobile Menu & Backdrop -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const closeMobileNav = document.getElementById('close-mobile-nav');
            const mobileNav = document.getElementById('mobile-nav');
            const mobileNavBackdrop = document.getElementById('mobile-nav-backdrop');

            function openMenu() {
                if (mobileNav) mobileNav.classList.remove('translate-x-full');
                if (mobileNavBackdrop) {
                    mobileNavBackdrop.classList.remove('opacity-0', 'pointer-events-none');
                    mobileNavBackdrop.classList.add('opacity-100', 'pointer-events-auto');
                }
                document.body.classList.add('overflow-hidden');
            }

            function closeMenu() {
                if (mobileNav) mobileNav.classList.add('translate-x-full');
                if (mobileNavBackdrop) {
                    mobileNavBackdrop.classList.remove('opacity-100', 'pointer-events-auto');
                    mobileNavBackdrop.classList.add('opacity-0', 'pointer-events-none');
                }
                document.body.classList.remove('overflow-hidden');
            }

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', openMenu);
            }
            
            if (closeMobileNav) {
                closeMobileNav.addEventListener('click', closeMenu);
            }

            if (mobileNavBackdrop) {
                mobileNavBackdrop.addEventListener('click', closeMenu);
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeMenu();
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
