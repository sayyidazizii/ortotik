<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Klinik Ortotik & Prostetik Indonesia - Precision Orthotics & Prosthetics')</title>
    <meta name="description" content="@yield('meta_description', 'Pusat pembuatan alat bantu ortopedi presisi, kaki palsu bionik carbon fiber, korset skoliosis 3D non-bedah, dan insole medis cetak sesuai standar Kemenkes RI.')">
    
    <!-- Google Fonts: Bebas Neue (Editorial Display) & Plus Jakarta Sans / Inter (Clean Modern Helvetica/Workhorse) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: '#111111',
                        canvas: '#ffffff',
                        'soft-cloud': '#f5f5f5',
                        charcoal: '#39393b',
                        ash: '#4b4b4d',
                        mute: '#707072',
                        stone: '#9e9ea0',
                        hairline: '#cacacb',
                        'hairline-soft': '#e5e5e5',
                        sale: '#d30005',
                        'sale-deep': '#780700',
                        success: '#007d48',
                        'success-bright': '#1eaa52',
                        info: '#1151ff',
                        'accent-teal': '#0a7281',
                        whatsapp: '#25D366',
                        // Backward compatibility for components
                        medical: {
                            50: '#f5f5f5',
                            100: '#e5e5e5',
                            600: '#111111',
                            700: '#111111',
                            800: '#111111',
                            900: '#111111',
                        }
                    },
                    fontFamily: {
                        display: ['"Bebas Neue"', 'Impact', 'sans-serif'],
                        sans: ['"Plus Jakarta Sans"', 'Helvetica', 'Arial', 'sans-serif'],
                    },
                    spacing: {
                        'xxs': '2px',
                        'xs': '4px',
                        'sm': '8px',
                        'md': '12px',
                        'lg': '18px',
                        'xl': '24px',
                        'xxl': '30px',
                        'section': '48px',
                    },
                    borderRadius: {
                        'none': '0px',
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
        
        /* Design.md Specification Styles */
        .font-display-campaign {
            font-family: 'Bebas Neue', Impact, sans-serif;
            font-size: clamp(48px, 8vw, 96px);
            line-height: 0.9;
            letter-spacing: 0;
            text-transform: uppercase;
        }

        /* Pill CTA scale feedback */
        .btn-pill-tap:active {
            transform: scale(0.96);
            opacity: 0.9;
        }

        /* Inset hairline under sticky bars */
        .border-hairline-inset {
            box-shadow: inset 0 -1px 0 #e5e5e5;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-canvas text-ink font-sans antialiased flex flex-col min-h-screen selection:bg-ink selection:text-canvas">

    <!-- Utility Bar ({component.utility-bar}: 36px, soft-cloud, text-ink, caption-sm) -->
    <div class="bg-soft-cloud text-ink text-[12px] font-medium h-9 border-b border-hairline-soft px-4 flex items-center">
        <div class="max-w-[1440px] w-full mx-auto flex justify-between items-center">
            <!-- Left Info -->
            <div class="flex items-center space-x-6 text-mute">
                <span class="flex items-center gap-1.5 text-ink font-medium">
                    <span class="w-2 h-2 rounded-full bg-success"></span>
                    <span>Klinik Pusat: Jakarta & Surabaya</span>
                </span>
                <span class="hidden md:inline text-mute">Buka Senin - Sabtu: 08:30 - 17:00 WIB</span>
            </div>

            <!-- Right Links Cluster -->
            <div class="flex items-center space-x-5 text-xs text-ink font-medium">
                <a href="{{ route('contact') }}" class="hover:text-mute transition">Lokasi Cabang</a>
                <span class="text-hairline">|</span>
                <a href="{{ route('consultation.create') }}" class="hover:text-mute transition">Jadwal Janji Temu</a>
                <span class="text-hairline">|</span>
                <a href="/progress.html" class="hover:text-mute transition font-semibold">Project Roadmap</a>
                <span class="text-hairline">|</span>
                <a href="/admin/login" class="text-mute hover:text-ink transition">Staff Portal</a>
            </div>
        </div>
    </div>

    <!-- Primary Navigation ({component.primary-nav}: 60px, canvas, text-ink, body-strong) -->
    <header class="bg-canvas sticky top-0 z-50 border-b border-hairline-soft" x-data="{ mobileOpen: false, searchOpen: false }">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo Cluster -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-8 h-8 bg-ink text-canvas flex items-center justify-center font-black text-sm tracking-tighter">
                        OP
                    </div>
                    <div class="leading-none">
                        <span class="text-lg font-extrabold tracking-tighter text-ink uppercase block">ORTOTIK<span class="text-mute">.ID</span></span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center space-x-8 text-[15px] font-medium text-ink">
                    <a href="{{ route('home') }}" class="hover:text-mute transition py-5 relative {{ request()->routeIs('home') ? 'border-b-2 border-ink' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('services.index') }}" class="hover:text-mute transition py-5 relative {{ request()->routeIs('services.*') ? 'border-b-2 border-ink' : '' }}">
                        5 Layanan Medis
                    </a>
                    <a href="{{ route('products.index') }}" class="hover:text-mute transition py-5 relative {{ request()->routeIs('products.*') ? 'border-b-2 border-ink' : '' }}">
                        E-Katalog Produk
                    </a>
                    <a href="{{ route('custom-products.index') }}" class="hover:text-mute transition py-5 relative {{ request()->routeIs('custom-products.*') ? 'border-b-2 border-ink' : '' }}">
                        Produk Custom-Made
                    </a>
                    <a href="{{ route('articles.index') }}" class="hover:text-mute transition py-5 relative {{ request()->routeIs('articles.*') || request()->routeIs('news.*') ? 'border-b-2 border-ink' : '' }}">
                        Artikel Medis
                    </a>
                    <a href="{{ route('about') }}" class="hover:text-mute transition py-5 relative {{ request()->routeIs('about*') ? 'border-b-2 border-ink' : '' }}">
                        Tentang Kami
                    </a>
                    <a href="{{ route('contact') }}" class="hover:text-mute transition py-5 relative {{ request()->routeIs('contact') ? 'border-b-2 border-ink' : '' }}">
                        Cabang Klinik
                    </a>
                </nav>

                <!-- Search Pill & CTA Cluster -->
                <div class="hidden sm:flex items-center gap-3">
                    <!-- Search Pill ({component.search-pill}) -->
                    <form action="{{ route('products.index') }}" method="GET" class="relative">
                        <div class="flex items-center bg-soft-cloud hover:bg-hairline-soft rounded-full px-3.5 py-1.5 h-10 w-44 lg:w-52 transition">
                            <i data-lucide="search" class="w-4 h-4 text-mute mr-2 shrink-0"></i>
                            <input type="text" name="search" placeholder="Cari Alat Medis..." class="bg-transparent text-xs text-ink placeholder-mute focus:outline-none w-full font-medium">
                        </div>
                    </form>

                    <!-- Primary Pill Button ({component.button-primary}) -->
                    <a href="{{ route('consultation.create') }}" class="inline-flex items-center justify-center bg-ink hover:bg-charcoal text-canvas text-xs font-medium px-6 h-10 rounded-full btn-pill-tap transition">
                        <span>Konsultasi</span>
                    </a>
                </div>

                <!-- Mobile Hamburger & Search -->
                <div class="flex items-center gap-2 lg:hidden">
                    <button @click="mobileOpen = !mobileOpen" class="p-2 text-ink hover:text-mute" aria-label="Menu">
                        <i data-lucide="menu" class="w-6 h-6" x-show="!mobileOpen"></i>
                        <i data-lucide="x" class="w-6 h-6" x-show="mobileOpen" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Full-Height Drawer -->
        <div x-show="mobileOpen" x-cloak class="lg:hidden border-t border-hairline bg-canvas px-6 py-8 space-y-4 shadow-xl">
            <nav class="space-y-4 text-lg font-medium text-ink">
                <a href="{{ route('home') }}" class="block py-2 border-b border-hairline-soft">Beranda</a>
                <a href="{{ route('services.index') }}" class="block py-2 border-b border-hairline-soft">5 Layanan Medis</a>
                <a href="{{ route('products.index') }}" class="block py-2 border-b border-hairline-soft">E-Katalog Produk</a>
                <a href="{{ route('custom-products.index') }}" class="block py-2 border-b border-hairline-soft">Produk Custom-Made</a>
                <a href="{{ route('articles.index') }}" class="block py-2 border-b border-hairline-soft">Artikel Medis</a>
                <a href="{{ route('about') }}" class="block py-2 border-b border-hairline-soft">Tentang Kami</a>
                <a href="{{ route('contact') }}" class="block py-2 border-b border-hairline-soft">Cabang & Kontak</a>
            </nav>
            <div class="pt-4 space-y-2">
                <a href="{{ route('consultation.create') }}" class="w-full flex justify-center items-center h-12 bg-ink text-canvas rounded-full font-medium text-sm">
                    Buat Janji Konsultasi
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Floating Action WhatsApp Pill ({component.button-primary} variant) -->
    <aside aria-label="WhatsApp Quick Contact">
        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Klinik%20Ortotik,%20saya%20ingin%20konsultasi%20mengenai%20alat%20medis%20dan%20jadwal%20klinik." target="_blank" rel="noopener noreferrer"
            class="fixed bottom-6 right-6 z-50 bg-ink hover:bg-charcoal text-canvas px-5 py-3 rounded-full shadow-2xl flex items-center gap-2.5 btn-pill-tap transition group border border-charcoal">
            <span class="w-2.5 h-2.5 rounded-full bg-whatsapp animate-pulse"></span>
            <i data-lucide="message-circle" class="w-4 h-4 text-canvas"></i>
            <span class="font-medium text-xs tracking-tight">Chat WhatsApp</span>
        </a>
    </aside>

    <!-- Footer ({component.footer}: canvas, 1px hairline divider, 4-column directory, caption-md text-mute) -->
    <footer class="bg-canvas text-ink pt-16 pb-12 border-t border-hairline">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-hairline">
                <!-- Column 1: Brand Directory -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-ink text-canvas flex items-center justify-center font-black text-sm">
                            OP
                        </div>
                        <span class="text-base font-extrabold tracking-tight text-ink uppercase">KLINIK ORTOTIK & PROSTETIK</span>
                    </div>
                    <p class="text-xs leading-relaxed text-mute max-w-sm">
                        Pusat pembuatan alat bantu ortopedi presisi, kaki palsu bionik carbon fiber, korset skoliosis 3D non-bedah, dan insole medis cetak sesuai standar Kementerian Kesehatan RI.
                    </p>
                    <div class="flex items-center gap-2 pt-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-soft-cloud text-ink text-[11px] font-medium border border-hairline-soft">
                            Kemenkes RI Certified
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-soft-cloud text-ink text-[11px] font-medium border border-hairline-soft">
                            Garansi Fitting 100%
                        </span>
                    </div>
                </div>

                <!-- Column 2: 5 Layanan Medis -->
                <div>
                    <h3 class="text-ink text-xs font-semibold uppercase tracking-wider mb-4">5 Pilar Layanan</h3>
                    <ul class="space-y-2.5 text-xs text-mute font-medium">
                        <li><a href="{{ route('services.index') }}" class="hover:text-ink transition">Kaki & Tangan Palsu (Prostetik)</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-ink transition">Brace Ortopedi (AFO & KAFO)</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-ink transition">Pusat Skoliosis 3D Cheneau</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-ink transition">Insole Medis 3D Flat Foot</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-ink transition">Home Visit & Casting Medis</a></li>
                    </ul>
                </div>

                <!-- Column 3: E-Katalog & Navigasi -->
                <div>
                    <h3 class="text-ink text-xs font-semibold uppercase tracking-wider mb-4">Navigasi Katalog</h3>
                    <ul class="space-y-2.5 text-xs text-mute font-medium">
                        <li><a href="{{ route('products.index') }}" class="hover:text-ink transition">E-Katalog Produk Medis</a></li>
                        <li><a href="{{ route('custom-products.index') }}" class="hover:text-ink transition">Alur Produk Custom-Made</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-ink transition">Artikel & Edukasi Klinis</a></li>
                        <li><a href="{{ route('consultation.create') }}" class="hover:text-ink transition">Buat Janji Konsultasi</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-ink transition">Profil Klinisi & Tim Ahli</a></li>
                    </ul>
                </div>

                <!-- Column 4: Lokasi Cabang -->
                <div>
                    <h3 class="text-ink text-xs font-semibold uppercase tracking-wider mb-4">Cabang Klinik</h3>
                    <div class="space-y-3 text-xs text-mute font-medium leading-relaxed">
                        <p><strong class="text-ink">Jakarta Pusat:</strong><br>Jl. Salemba Raya No. 45, Senen, Jakarta Pusat 10440</p>
                        <p><strong class="text-ink">Surabaya:</strong><br>Jl. Dharmahusada No. 88, Gubeng, Surabaya 60285</p>
                        <p class="pt-1 text-ink">Hotline: 0812-3456-7890<br>Email: info@ortotik.co.id</p>
                    </div>
                </div>
            </div>

            <!-- Fine-Print Legal Row ({typography.utility-xs} text-mute) -->
            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-[11px] text-mute font-medium">
                <p>&copy; {{ date('Y') }} PT Ortotik & Prostetik Medika Indonesia. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="{{ route('about') }}" class="hover:text-ink transition">Tentang Kami</a>
                    <a href="{{ route('contact') }}" class="hover:text-ink transition">Hubungi Kami</a>
                    <a href="/progress.html" class="text-ink hover:text-mute transition font-semibold">Executive Dashboard</a>
                    <a href="/admin/login" class="text-mute hover:text-ink transition">Portal Staf</a>
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
