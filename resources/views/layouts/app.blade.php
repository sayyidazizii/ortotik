<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Klinik Ortotik & Prostetik Indonesia - Pelayanan Medis Presisi & Holistik')</title>
    <meta name="description" content="@yield('meta_description', 'Pusat pembuatan alat bantu ortopedi presisi, kaki palsu bionik carbon fiber, korset skoliosis 3D non-bedah, dan insole medis cetak sesuai standar Kemenkes RI.')">
    
    <!-- Google Fonts: Fraunces / Playfair Display (Domaine Display Serif Style) & Plus Jakarta Sans (Humanistic Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,400;1,9..144,500&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Maven Clinic Signature Jewel-Tone Palette
                        primary: '#0D5C46',          // Hero Emerald Green
                        'primary-dark': '#074332',   // Deep Forest Emerald
                        'primary-light': '#17795E',  // Vibrant Emerald
                        terracotta: '#C86D51',       // Warm Terra Cotta
                        'terracotta-dark': '#B0593F',// Deep Terra Cotta
                        mint: '#D8ECE5',             // Mint Julep
                        'mint-light': '#EEF7F4',     // Soft Mint Wash
                        cappuccino: '#F6F3EE',       // Warm Linen Cappuccino
                        'cappuccino-light': '#FAF8F5', // Pale Canvas
                        'cappuccino-deep': '#ECE5DA', // Darker Neutral
                        blush: '#F9ECE8',            // Soft Terra Blush
                        secondary: '#1A2E26',        // Deep Evergreen Charcoal Text
                        tertiary: '#65776F',         // Muted Slate-Sage
                        surface: '#FFFFFF',          // Pure Crisp White
                        border: '#E3DDD5',           // Warm Neutral Divider
                        accent: '#C86D51',           // Warm Terra Cotta Accent
                        error: '#D64545',
                        whatsapp: '#25D366',
                    },
                    fontFamily: {
                        serif: ['"Fraunces"', '"Playfair Display"', 'Georgia', 'serif'],
                        editorial: ['"Fraunces"', '"Playfair Display"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    borderRadius: {
                        'none': '0px',
                        'sm': '6px',
                        'md': '10px',
                        'lg': '18px',
                        'xl': '28px',
                        '2xl': '36px',
                        'full': '9999px',
                        'pill': '9999px',
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        body {
            background-color: #FAF8F5;
            color: #1A2E26;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        h1, h2, h3, h4 {
            font-family: 'Fraunces', 'Playfair Display', Georgia, serif;
            font-weight: 500;
            color: #0D5C46;
        }

        /* Maven Clinic Pill Button Motion */
        .btn-maven {
            transition: all 200ms cubic-bezier(0.16, 1, 0.3, 1);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-maven:hover {
            transform: translateY(-1.5px);
        }
        .btn-maven:active {
            transform: scale(0.98);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-cappuccino-light text-secondary font-sans antialiased flex flex-col min-h-screen selection:bg-mint selection:text-primary">

    <!-- Top Announcement Bar (Maven Clinic: Emerald Green Tone with Mint Pill Indicator) -->
    <div class="bg-primary text-cappuccino text-xs py-2.5 px-4 sm:px-6 lg:px-8 border-b border-primary-dark">
        <div class="max-w-[1360px] mx-auto flex justify-between items-center">
            <!-- Left Info -->
            <div class="flex items-center space-x-6 text-cappuccino/90 font-medium">
                <span class="flex items-center gap-2 text-white font-medium">
                    <span class="w-2 h-2 rounded-full bg-terracotta animate-pulse"></span>
                    <span>Pelayanan Ortotik & Prostetik Berstandar Kemenkes RI</span>
                </span>
                <span class="hidden md:inline text-cappuccino/70">Cabang Praktek: Jakarta Pusat & Surabaya</span>
            </div>

            <!-- Right Links -->
            <div class="flex items-center space-x-5 text-xs font-medium text-cappuccino/90">
                <a href="{{ route('contact') }}" class="hover:text-terracotta transition">Lokasi Cabang</a>
                <span class="text-cappuccino/30">|</span>
                <a href="{{ route('consultation.create') }}" class="hover:text-white transition font-semibold text-mint">Jadwal Janji Temu</a>
                <span class="text-cappuccino/30">|</span>
                <a href="/progress.html" class="hover:text-white transition">Dashboard Project</a>
                <span class="text-cappuccino/30">|</span>
                <a href="/admin/login" class="text-cappuccino/70 hover:text-white transition">Portal Staf</a>
            </div>
        </div>
    </div>

    <!-- Primary Navigation Bar (Maven Clinic: Warm Linen Header, Emerald Brand, Terra Cotta CTAs) -->
    <header class="bg-cappuccino-light/95 backdrop-blur-md sticky top-0 z-50 border-b border-border" x-data="{ mobileOpen: false }">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <!-- Brand Logo Cluster -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-full bg-primary text-cappuccino flex items-center justify-center font-serif text-lg font-bold shadow-xs group-hover:scale-105 transition">
                        OP
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-2xl font-serif font-semibold tracking-tight text-primary">ORTOTIK<span class="text-terracotta font-normal">.ID</span></span>
                            <span class="text-[10px] uppercase font-semibold tracking-wider px-2.5 py-0.5 rounded-full bg-mint text-primary border border-primary/20">Kemenkes RI</span>
                        </div>
                        <span class="text-xs text-tertiary block font-light tracking-wide">Pusat Mobilitas & Ortopedi Modern</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links (Single-Word Menu Items) -->
                <nav class="hidden lg:flex items-center space-x-7 text-[15px] font-medium text-secondary">
                    <a href="{{ route('home') }}" class="hover:text-primary transition py-2 {{ request()->routeIs('home') ? 'text-primary font-semibold border-b-2 border-primary' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('services.index') }}" class="hover:text-primary transition py-2 {{ request()->routeIs('services.*') ? 'text-primary font-semibold border-b-2 border-primary' : '' }}">
                        Layanan
                    </a>
                    <a href="{{ route('products.index') }}" class="hover:text-primary transition py-2 {{ request()->routeIs('products.*') ? 'text-primary font-semibold border-b-2 border-primary' : '' }}">
                        Katalog
                    </a>
                    <a href="{{ route('custom-products.index') }}" class="hover:text-primary transition py-2 {{ request()->routeIs('custom-products.*') ? 'text-primary font-semibold border-b-2 border-primary' : '' }}">
                        Kustom
                    </a>
                    <a href="{{ route('articles.index') }}" class="hover:text-primary transition py-2 {{ request()->routeIs('articles.*') ? 'text-primary font-semibold border-b-2 border-primary' : '' }}">
                        Artikel
                    </a>
                    <a href="{{ route('about') }}" class="hover:text-primary transition py-2 {{ request()->routeIs('about*') ? 'text-primary font-semibold border-b-2 border-primary' : '' }}">
                        Tentang
                    </a>
                    <a href="{{ route('contact') }}" class="hover:text-primary transition py-2 {{ request()->routeIs('contact') ? 'text-primary font-semibold border-b-2 border-primary' : '' }}">
                        Cabang
                    </a>
                </nav>

                <!-- Search & Maven Clinic Signature Emerald/Terra Cotta Pill Button -->
                <div class="hidden sm:flex items-center gap-3">
                    <!-- Search Pill -->
                    <form action="{{ route('products.index') }}" method="GET" class="relative">
                        <div class="flex items-center bg-white rounded-full px-4 h-11 w-44 lg:w-48 transition border border-border focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20">
                            <i data-lucide="search" class="w-4 h-4 text-tertiary mr-2 shrink-0"></i>
                            <input type="text" name="search" placeholder="Cari Alat Medis..." class="bg-transparent text-xs text-secondary placeholder-tertiary focus:outline-none w-full font-normal">
                        </div>
                    </form>

                    <!-- Maven Clinic button-primary: Emerald Green with Pill Shape -->
                    <a href="{{ route('consultation.create') }}" class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white text-sm font-semibold px-7 h-11 rounded-full btn-maven shadow-xs transition">
                        <span>Janji Temu Medis</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center gap-2 lg:hidden">
                    <button @click="mobileOpen = !mobileOpen" class="p-2 text-secondary hover:text-primary" aria-label="Menu">
                        <i data-lucide="menu" class="w-6 h-6" x-show="!mobileOpen"></i>
                        <i data-lucide="x" class="w-6 h-6" x-show="mobileOpen" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileOpen" x-cloak class="lg:hidden border-t border-border bg-cappuccino-light px-6 py-6 space-y-3">
            <nav class="space-y-2 text-base font-medium text-secondary">
                <a href="{{ route('home') }}" class="block py-2 border-b border-border">Beranda</a>
                <a href="{{ route('services.index') }}" class="block py-2 border-b border-border">Layanan</a>
                <a href="{{ route('products.index') }}" class="block py-2 border-b border-border">Katalog</a>
                <a href="{{ route('custom-products.index') }}" class="block py-2 border-b border-border">Kustom</a>
                <a href="{{ route('articles.index') }}" class="block py-2 border-b border-border">Artikel</a>
                <a href="{{ route('about') }}" class="block py-2 border-b border-border">Tentang</a>
                <a href="{{ route('contact') }}" class="block py-2 border-b border-border">Cabang</a>
            </nav>
            <div class="pt-4">
                <a href="{{ route('consultation.create') }}" class="w-full flex justify-center items-center h-12 bg-primary text-white rounded-full font-semibold text-sm btn-maven">
                    Buat Janji Temu Medis
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Floating Action WhatsApp Button -->
    <aside aria-label="WhatsApp Quick Contact">
        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Klinik%20Ortotik,%20saya%20ingin%20konsultasi%20mengenai%20alat%20medis%20dan%20jadwal%20klinik." target="_blank" rel="noopener noreferrer"
            class="fixed bottom-6 right-6 z-50 bg-primary hover:bg-primary-dark text-white px-6 py-3.5 rounded-full shadow-lg flex items-center gap-3 btn-maven transition group border border-mint/40">
            <span class="w-2.5 h-2.5 rounded-full bg-whatsapp animate-pulse"></span>
            <i data-lucide="message-circle" class="w-5 h-5 text-mint"></i>
            <span class="font-semibold text-xs tracking-tight text-white">Konsultasi WhatsApp</span>
        </a>
    </aside>

    <!-- Footer (Maven Clinic: Emerald Green Footer with Warm Linen Accents & Editorial Serif) -->
    <footer class="bg-primary text-cappuccino pt-20 pb-12 border-t border-primary-dark mt-20">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 pb-16 border-b border-white/15">
                <!-- Column 1: Brand Directory -->
                <div class="lg:col-span-2 space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full bg-terracotta text-white flex items-center justify-center font-serif text-lg font-bold">
                            OP
                        </div>
                        <div>
                            <span class="text-xl font-serif font-semibold tracking-tight text-white block">KLINIK ORTOTIK & PROSTETIK</span>
                            <span class="text-xs text-mint/90">Pelayanan Medis Presisi & Holistik</span>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-cappuccino/80 max-w-sm font-light">
                        Pusat pembuatan alat bantu ortopedi presisi, kaki palsu bionik carbon fiber, korset skoliosis 3D non-bedah, dan insole medis cetak sesuai standar Kementerian Kesehatan RI.
                    </p>
                    <div class="flex flex-wrap items-center gap-2 pt-2">
                        <span class="inline-flex items-center px-3.5 py-1 rounded-full bg-white/10 text-white text-xs font-medium border border-white/20">
                            Izin Kemenkes RI
                        </span>
                        <span class="inline-flex items-center px-3.5 py-1 rounded-full bg-white/10 text-white text-xs font-medium border border-white/20">
                            Garansi Fitting 100%
                        </span>
                    </div>
                </div>

                <!-- Column 2: 5 Layanan Medis -->
                <div>
                    <h3 class="text-mint text-sm font-serif font-semibold uppercase tracking-wider mb-5">5 Layanan Medis</h3>
                    <ul class="space-y-3 text-sm text-cappuccino/80 font-normal">
                        <li><a href="{{ route('services.index') }}" class="hover:text-terracotta transition">Kaki & Tangan Palsu (Prostetik)</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-terracotta transition">Brace Ortopedi (AFO & KAFO)</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-terracotta transition">Pusat Skoliosis 3D Cheneau</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-terracotta transition">Insole Medis 3D Flat Foot</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-terracotta transition">Home Visit & Casting Medis</a></li>
                    </ul>
                </div>

                <!-- Column 3: E-Katalog & Navigasi -->
                <div>
                    <h3 class="text-mint text-sm font-serif font-semibold uppercase tracking-wider mb-5">Navigasi Pasien</h3>
                    <ul class="space-y-3 text-sm text-cappuccino/80 font-normal">
                        <li><a href="{{ route('products.index') }}" class="hover:text-terracotta transition">E-Katalog Produk Medis</a></li>
                        <li><a href="{{ route('custom-products.index') }}" class="hover:text-terracotta transition">Alur Produk Custom-Made</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-terracotta transition">Artikel & Edukasi Medis</a></li>
                        <li><a href="{{ route('consultation.create') }}" class="hover:text-terracotta transition">Buat Janji Konsultasi</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-terracotta transition">Profil Tim Ortotis-Prostetis</a></li>
                    </ul>
                </div>

                <!-- Column 4: Lokasi Cabang -->
                <div>
                    <h3 class="text-mint text-sm font-serif font-semibold uppercase tracking-wider mb-5">Cabang Klinik</h3>
                    <div class="space-y-3.5 text-sm text-cappuccino/80 font-light leading-relaxed">
                        <p><strong class="text-white font-medium font-serif">Jakarta Pusat:</strong><br>Jl. Salemba Raya No. 45, Senen, Jakarta Pusat 10440</p>
                        <p><strong class="text-white font-medium font-serif">Surabaya:</strong><br>Jl. Dharmahusada No. 88, Gubeng, Surabaya 60285</p>
                        <p class="pt-2 text-white font-medium">Hotline: 0812-3456-7890<br>Email: info@ortotik.co.id</p>
                    </div>
                </div>
            </div>

            <!-- Fine-Print Legal Row -->
            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-cappuccino/60 font-light">
                <p>&copy; {{ date('Y') }} PT Ortotik & Prostetik Medika Indonesia. All rights reserved.</p>
                <div class="flex space-x-6 font-normal">
                    <a href="{{ route('about') }}" class="hover:text-white transition">Tentang Kami</a>
                    <a href="{{ route('contact') }}" class="hover:text-white transition">Hubungi Kami</a>
                    <a href="/progress.html" class="text-mint hover:underline transition font-medium">Executive Dashboard</a>
                    <a href="/admin/login" class="text-cappuccino/60 hover:text-white transition">Portal Staf</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
