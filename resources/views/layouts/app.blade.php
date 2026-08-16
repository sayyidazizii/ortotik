<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Klinik Ortotik & Prostetik Indonesia - Solusi Kaki Palsu & Brace Ortopedi')</title>
    <meta name="description" content="@yield('meta_description', 'Klinik spesialis ortotik & prostetik terpercaya di Indonesia. Melayani pembuatan kaki palsu bionik, korset skoliosis 3D, insole medis flatfoot, dan brace ortopedi.')">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN for instant rendering -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        medical: {
                            50: '#f0f7ff',
                            100: '#e0effe',
                            200: '#bae0fd',
                            500: '#0284c7',
                            600: '#0369a1',
                            700: '#0f4c81',
                            800: '#075985',
                            900: '#0c4a6e',
                            dark: '#092e50'
                        },
                        tealmed: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                        },
                        emeraldwa: '#25d366'
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
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
        .gradient-medical {
            background: linear-gradient(135deg, #0f4c81 0%, #0d9488 100%);
        }
        .hero-pattern {
            background-color: #0f4c81;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-700 font-sans antialiased flex flex-col min-h-screen">

    <!-- Top Bar -->
    <div class="bg-slate-900 text-slate-300 text-xs py-2 px-4 border-b border-slate-800">
        <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center gap-2">
            <div class="flex items-center space-x-6">
                <span class="flex items-center gap-1.5">
                    <i data-lucide="clock" class="w-3.5 h-3.5 text-tealmed-500"></i>
                    <span>Senin - Sabtu: 08:30 - 17:00 WIB</span>
                </span>
                <span class="hidden md:flex items-center gap-1.5">
                    <i data-lucide="phone" class="w-3.5 h-3.5 text-tealmed-500"></i>
                    <span>Emergency Hotline: (021) 390-1234</span>
                </span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="hidden sm:inline text-slate-400">Pusat Klinik: Jakarta & Surabaya</span>
                <a href="{{ route('consultation.create') }}" class="text-tealmed-500 hover:text-white font-medium transition">Jadwal Janji Temu &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="bg-white/95 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100 shadow-sm" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-medical-700 to-tealmed-600 flex items-center justify-center text-white font-black text-xl shadow-md group-hover:scale-105 transition-transform duration-200">
                        OP
                    </div>
                    <div>
                        <span class="text-xl font-extrabold tracking-tight text-slate-900 block leading-tight">ORTOTIK<span class="text-tealmed-600">.ID</span></span>
                        <span class="text-[11px] font-semibold text-slate-400 tracking-wider uppercase block">Klinik Ortotik & Prostetik</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center space-x-8 text-[14px] font-semibold text-slate-700">
                    <a href="{{ route('home') }}" class="hover:text-medical-700 transition {{ request()->routeIs('home') ? 'text-medical-700' : '' }}">Beranda</a>
                    <a href="{{ route('services.index') }}" class="hover:text-medical-700 transition {{ request()->routeIs('services.*') ? 'text-medical-700' : '' }}">5 Layanan Medis</a>
                    <a href="{{ route('products.index') }}" class="hover:text-medical-700 transition {{ request()->routeIs('products.*') ? 'text-medical-700' : '' }}">E-Katalog Produk</a>
                    <a href="{{ route('custom-products.index') }}" class="hover:text-medical-700 transition {{ request()->routeIs('custom-products.*') ? 'text-medical-700' : '' }}">Produk Custom P&O</a>
                    <a href="{{ route('articles.index') }}" class="hover:text-medical-700 transition {{ request()->routeIs('articles.*') || request()->routeIs('news.*') ? 'text-medical-700' : '' }}">Artikel & Edukasi</a>
                    <a href="{{ route('contact') }}" class="hover:text-medical-700 transition {{ request()->routeIs('contact') ? 'text-medical-700' : '' }}">Cabang Klinik</a>
                </nav>

                <!-- Action Button -->
                <div class="hidden sm:flex items-center gap-3">
                    <a href="{{ route('consultation.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-medical-700 to-medical-800 hover:from-medical-800 hover:to-medical-900 text-white text-sm font-bold px-5 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                        <i data-lucide="calendar" class="w-4 h-4 text-tealmed-500"></i>
                        <span>Konsultasi Spesialis</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none" aria-label="Toggle menu">
                    <i data-lucide="menu" class="w-6 h-6" x-show="!mobileOpen"></i>
                    <i data-lucide="x" class="w-6 h-6" x-show="mobileOpen" x-cloak></i>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileOpen" x-cloak class="lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-2 shadow-xl">
            <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg font-semibold text-slate-800 hover:bg-slate-50">Beranda</a>
            <a href="{{ route('services.index') }}" class="block px-3 py-2.5 rounded-lg font-semibold text-slate-800 hover:bg-slate-50">5 Layanan Medis</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2.5 rounded-lg font-semibold text-slate-800 hover:bg-slate-50">E-Katalog Produk</a>
            <a href="{{ route('custom-products.index') }}" class="block px-3 py-2.5 rounded-lg font-semibold text-slate-800 hover:bg-slate-50">Produk Custom P&O</a>
            <a href="{{ route('articles.index') }}" class="block px-3 py-2.5 rounded-lg font-semibold text-slate-800 hover:bg-slate-50">Artikel Edukasi</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2.5 rounded-lg font-semibold text-slate-800 hover:bg-slate-50">Cabang & Kontak</a>
            <div class="pt-3 border-t border-slate-100">
                <a href="{{ route('consultation.create') }}" class="w-full flex justify-center items-center gap-2 bg-medical-700 text-white font-bold py-3 rounded-xl shadow">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <span>Formulir Konsultasi Pasien</span>
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
        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Klinik%20Ortotik,%20saya%20ingin%20konsultasi%20mengenai%20alat%20medis%20dan%20jadwal%20klinik." target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 z-50 bg-[#25D366] hover:bg-[#20ba5a] text-white p-3.5 sm:px-5 sm:py-3.5 rounded-full shadow-2xl flex items-center gap-2.5 hover:scale-105 transition-all duration-300 group">
            <span class="relative flex h-3.5 w-3.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-white"></span>
            </span>
            <i data-lucide="message-circle" class="w-6 h-6 fill-white text-[#25D366]"></i>
            <span class="hidden sm:inline font-bold text-sm">Konsultasi WhatsApp</span>
        </a>
    </aside>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 pt-16 pb-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
                <!-- Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-tr from-medical-700 to-tealmed-600 flex items-center justify-center text-white font-black text-lg">
                            OP
                        </div>
                        <span class="text-xl font-bold tracking-tight text-white">KLINIK ORTOTIK & PROSTETIK</span>
                    </div>
                    <p class="text-sm leading-relaxed text-slate-400 max-w-sm">
                        Pusat pembuatan alat bantu ortopedi presisi, kaki palsu bionik carbon fiber, korset skoliosis 3D, dan custom insole medis berstandar internasional.
                    </p>
                    <div class="flex items-center space-x-3 pt-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-800 text-tealmed-400 text-xs font-semibold border border-slate-700">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                            <span>Kemenkes Certified</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-800 text-slate-300 text-xs font-semibold border border-slate-700">
                            <span>Garansi Fitting 100%</span>
                        </span>
                    </div>
                </div>

                <!-- 5 Layanan -->
                <div>
                    <h3 class="text-white text-sm font-bold tracking-wider uppercase mb-4">5 Pilar Layanan</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ url('/services/prosthetics') }}" class="hover:text-tealmed-400 transition">Prosthetics (Kaki & Tangan)</a></li>
                        <li><a href="{{ url('/services/bracing-supports') }}" class="hover:text-tealmed-400 transition">Bracing & Supports</a></li>
                        <li><a href="{{ url('/services/scoliosis-center') }}" class="hover:text-tealmed-400 transition">Scoliosis Center 3D</a></li>
                        <li><a href="{{ url('/services/physiotherapy') }}" class="hover:text-tealmed-400 transition">Gait Physiotherapy</a></li>
                        <li><a href="{{ url('/services/neuro-robotic') }}" class="hover:text-tealmed-400 transition">Neuro Robotic Rehab</a></li>
                    </ul>
                </div>

                <!-- Menu Cepat -->
                <div>
                    <h3 class="text-white text-sm font-bold tracking-wider uppercase mb-4">Navigasi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('products.index') }}" class="hover:text-tealmed-400 transition">E-Katalog Produk</a></li>
                        <li><a href="{{ route('custom-products.index') }}" class="hover:text-tealmed-400 transition">Alur Produk Custom</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-tealmed-400 transition">Artikel & Edukasi Medis</a></li>
                        <li><a href="{{ route('consultation.create') }}" class="hover:text-tealmed-400 transition">Buat Janji Temu</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-tealmed-400 transition">Alamat Cabang</a></li>
                    </ul>
                </div>

                <!-- Kontak Cabang -->
                <div>
                    <h3 class="text-white text-sm font-bold tracking-wider uppercase mb-4">Klinik Pusat</h3>
                    <div class="space-y-3 text-xs leading-relaxed">
                        <p class="text-slate-300">
                            <strong>Jakarta:</strong> Jl. Salemba Raya No. 45, Paseban, Senen, Jakarta Pusat 10440
                        </p>
                        <p class="text-slate-300">
                            <strong>Surabaya:</strong> Jl. Dharmahusada No. 88, Gubeng, Surabaya 60285
                        </p>
                        <p class="pt-1 text-slate-400">
                            WhatsApp: +62 812-3456-7890<br>
                            Email: info@ortotik.co.id
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} PT Ortotik & Prostetik Indonesia. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="{{ route('about') }}" class="hover:text-slate-400 transition">Tentang Kami</a>
                    <a href="{{ route('contact') }}" class="hover:text-slate-400 transition">Hubungi Kami</a>
                    <a href="/progress.html" class="text-tealmed-500 hover:text-tealmed-400 transition font-medium">Progress Roadmap</a>
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
