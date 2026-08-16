<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Klinik Ortotik & Prostetik Indonesia - Layanan Kaki Palsu & Brace Ortopedi')</title>
    <meta name="description" content="@yield('meta_description', 'Klinik spesialis ortotik & prostetik terpercaya di Indonesia. Melayani pembuatan kaki palsu bionik, korset skoliosis 3D, insole medis flatfoot, dan brace ortopedi presisi.')">
    
    <!-- Google Fonts: Plus Jakarta Sans (Modern & Clean Medical Typography) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        medical: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49',
                        },
                        navy: {
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617',
                        },
                        tealmed: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                        },
                        whatsapp: '#25D366',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.03)',
                        'card': '0 4px 20px -2px rgba(2, 132, 199, 0.06), 0 2px 6px -1px rgba(0, 0, 0, 0.04)',
                        'card-hover': '0 20px 30px -10px rgba(2, 132, 199, 0.12), 0 8px 10px -6px rgba(0, 0, 0, 0.04)',
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
        
        /* Soft Medical Backgrounds */
        .bg-soft-gradient {
            background: linear-gradient(180deg, #f0f9ff 0%, #ffffff 100%);
        }
        .bg-hero-soft {
            background: radial-gradient(circle at 80% 20%, rgba(186, 230, 253, 0.45) 0%, rgba(240, 249, 255, 0.7) 50%, #ffffff 100%);
        }
        .bg-radial-subtle {
            background: radial-gradient(circle at 50% 0%, rgba(224, 242, 254, 0.6) 0%, rgba(255, 255, 255, 0) 70%);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-white text-slate-700 font-sans antialiased flex flex-col min-h-screen selection:bg-medical-100 selection:text-medical-900">

    <!-- Top Bar Hotline (Inspirasi Orthocare Indonesia) -->
    <div class="bg-navy-900 text-slate-300 text-xs py-2.5 px-4 border-b border-navy-800">
        <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center gap-3">
            <div class="flex items-center space-x-6">
                <span class="flex items-center gap-2">
                    <i data-lucide="clock" class="w-3.5 h-3.5 text-medical-400"></i>
                    <span>Senin - Sabtu: <strong>08:30 - 17:00 WIB</strong></span>
                </span>
                <span class="hidden md:flex items-center gap-2">
                    <i data-lucide="phone-call" class="w-3.5 h-3.5 text-medical-400"></i>
                    <span>Hotline Konsultasi: <strong>0812-3456-7890</strong></span>
                </span>
            </div>
            
            <div class="flex items-center space-x-5 text-[11px]">
                <span class="hidden sm:inline-flex items-center gap-1.5 text-slate-400">
                    <i data-lucide="map-pin" class="w-3 h-3 text-medical-400"></i>
                    <span>Cabang: Jakarta Pusat & Surabaya</span>
                </span>
                <a href="{{ route('consultation.create') }}" class="text-medical-300 hover:text-white font-bold inline-flex items-center gap-1 transition">
                    <span>Jadwalkan Janji Temu Medis</span>
                    <i data-lucide="arrow-right" class="w-3 h-3"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header (Clean & Professional Medical Navbar) -->
    <header class="bg-white/95 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/80 shadow-soft" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo Klinik Ortotik & Prostetik (Orthocare Indonesia Inspired) -->
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-medical-600 to-medical-500 flex items-center justify-center text-white font-extrabold text-xl shadow-md group-hover:scale-105 transition-transform duration-200 border border-medical-400/30">
                        <i data-lucide="activity" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-1">
                            <span class="text-lg font-black tracking-tight text-slate-900 block leading-tight">ORTOTIK<span class="text-medical-600">.ID</span></span>
                            <span class="text-[10px] font-extrabold text-medical-600 px-1.5 py-0.5 rounded bg-medical-50 border border-medical-200 uppercase">Orthocare</span>
                        </div>
                        <span class="text-[11px] font-semibold text-slate-500 tracking-wider uppercase block mt-0.5">Klinik Ortotik & Prostetik Medis</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center space-x-7 text-[13.5px] font-bold text-slate-600">
                    <a href="{{ route('home') }}" class="hover:text-medical-600 transition py-2 {{ request()->routeIs('home') ? 'text-medical-600 border-b-2 border-medical-600' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('services.index') }}" class="hover:text-medical-600 transition py-2 {{ request()->routeIs('services.*') ? 'text-medical-600 border-b-2 border-medical-600' : '' }}">
                        5 Layanan Medis
                    </a>
                    <a href="{{ route('products.index') }}" class="hover:text-medical-600 transition py-2 {{ request()->routeIs('products.*') ? 'text-medical-600 border-b-2 border-medical-600' : '' }}">
                        E-Katalog Produk
                    </a>
                    <a href="{{ route('custom-products.index') }}" class="hover:text-medical-600 transition py-2 {{ request()->routeIs('custom-products.*') ? 'text-medical-600 border-b-2 border-medical-600' : '' }}">
                        Produk Custom P&O
                    </a>
                    <a href="{{ route('articles.index') }}" class="hover:text-medical-600 transition py-2 {{ request()->routeIs('articles.*') || request()->routeIs('news.*') ? 'text-medical-600 border-b-2 border-medical-600' : '' }}">
                        Artikel Edukasi
                    </a>
                    <a href="{{ route('about') }}" class="hover:text-medical-600 transition py-2 {{ request()->routeIs('about*') ? 'text-medical-600 border-b-2 border-medical-600' : '' }}">
                        Tentang Kami
                    </a>
                    <a href="{{ route('contact') }}" class="hover:text-medical-600 transition py-2 {{ request()->routeIs('contact') ? 'text-medical-600 border-b-2 border-medical-600' : '' }}">
                        Cabang Klinik
                    </a>
                </nav>

                <!-- Action Button -->
                <div class="hidden sm:flex items-center gap-3">
                    <a href="{{ route('consultation.create') }}" class="inline-flex items-center gap-2 bg-medical-600 hover:bg-medical-700 text-white text-xs font-bold px-5 py-3 rounded-xl shadow-sm hover:shadow-md transition-all transform hover:-translate-y-0.5">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>Konsultasi Spesialis</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none" aria-label="Toggle menu">
                    <i data-lucide="menu" class="w-6 h-6" x-show="!mobileOpen"></i>
                    <i data-lucide="x" class="w-6 h-6" x-show="mobileOpen" x-cloak></i>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="mobileOpen" x-cloak class="lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-1.5 shadow-xl">
            <a href="{{ route('home') }}" class="block px-3.5 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-medical-600">Beranda</a>
            <a href="{{ route('services.index') }}" class="block px-3.5 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-medical-600">5 Layanan Medis</a>
            <a href="{{ route('products.index') }}" class="block px-3.5 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-medical-600">E-Katalog Produk</a>
            <a href="{{ route('custom-products.index') }}" class="block px-3.5 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-medical-600">Produk Custom P&O</a>
            <a href="{{ route('articles.index') }}" class="block px-3.5 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-medical-600">Artikel Edukasi</a>
            <a href="{{ route('about') }}" class="block px-3.5 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-medical-600">Tentang Kami</a>
            <a href="{{ route('contact') }}" class="block px-3.5 py-2.5 rounded-xl font-bold text-sm text-slate-800 hover:bg-sky-50 hover:text-medical-600">Cabang & Kontak</a>
            <div class="pt-3 border-t border-slate-100">
                <a href="{{ route('consultation.create') }}" class="w-full flex justify-center items-center gap-2 bg-medical-600 text-white font-bold py-3 rounded-xl shadow-sm">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <span>Buat Janji Konsultasi</span>
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
        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Klinik%20Ortotik,%20saya%20ingin%20konsultasi%20mengenai%20alat%20bantu%20medis%20dan%20jadwal%20klinik." target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 z-50 bg-[#25D366] hover:bg-[#20ba5a] text-white p-3.5 sm:px-5 sm:py-3.5 rounded-full shadow-2xl flex items-center gap-2.5 hover:scale-105 transition-all duration-300 group">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
            </span>
            <i data-lucide="message-circle" class="w-5 h-5 fill-white text-[#25D366]"></i>
            <span class="hidden sm:inline font-bold text-xs">Konsultasi WhatsApp</span>
        </a>
    </aside>

    <!-- Footer (Inspirasi Orthocare Indonesia) -->
    <footer class="bg-navy-950 text-slate-400 pt-16 pb-12 border-t border-navy-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-navy-900">
                <!-- Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-medical-600 flex items-center justify-center text-white font-extrabold text-lg">
                            <i data-lucide="activity" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-lg font-black tracking-tight text-white block leading-tight">ORTHOCARE INDONESIA</span>
                            <span class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Klinik Ortotik & Prostetik Medis</span>
                        </div>
                    </div>
                    <p class="text-xs leading-relaxed text-slate-400 max-w-sm">
                        Pusat rujukan pembuatan alat bantu ortopedi presisi, kaki palsu bionik carbon fiber, korset skoliosis 3D non-operasi, dan insole medis cetak sesuai standar Kementerian Kesehatan RI.
                    </p>
                    <div class="flex flex-wrap items-center gap-2 pt-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-navy-900 text-sky-300 text-[11px] font-bold border border-navy-800">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-medical-400"></i>
                            <span>Izin Kemenkes RI</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-navy-900 text-slate-300 text-[11px] font-bold border border-navy-800">
                            <span>Garansi Fitting 100% Presisi</span>
                        </span>
                    </div>
                </div>

                <!-- 5 Layanan -->
                <div>
                    <h3 class="text-white text-xs font-bold tracking-wider uppercase mb-4">5 Pilar Layanan</h3>
                    <ul class="space-y-2.5 text-xs">
                        <li><a href="{{ route('services.index') }}" class="hover:text-medical-300 transition">Kaki & Tangan Palsu (Prostetik)</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-medical-300 transition">Brace Ortopedi (AFO & KAFO)</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-medical-300 transition">Pusat Skoliosis 3D Non-Operasi</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-medical-300 transition">Insole Medis & Flat Foot</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-medical-300 transition">Home Visit & Casting Medis</a></li>
                    </ul>
                </div>

                <!-- Navigasi -->
                <div>
                    <h3 class="text-white text-xs font-bold tracking-wider uppercase mb-4">Informasi & Menu</h3>
                    <ul class="space-y-2.5 text-xs">
                        <li><a href="{{ route('products.index') }}" class="hover:text-medical-300 transition">E-Katalog Produk Medis</a></li>
                        <li><a href="{{ route('custom-products.index') }}" class="hover:text-medical-300 transition">Tahapan Produk Custom</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-medical-300 transition">Artikel & Edukasi Klinis</a></li>
                        <li><a href="{{ route('consultation.create') }}" class="hover:text-medical-300 transition">Formulir Janji Temu</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-medical-300 transition">Profil Tim & Spesialis</a></li>
                    </ul>
                </div>

                <!-- Kontak Cabang -->
                <div>
                    <h3 class="text-white text-xs font-bold tracking-wider uppercase mb-4">Cabang Klinik</h3>
                    <div class="space-y-3 text-xs leading-relaxed">
                        <p class="text-slate-300">
                            <strong>Jakarta:</strong> Jl. Salemba Raya No. 45, Senen, Jakarta Pusat
                        </p>
                        <p class="text-slate-300">
                            <strong>Surabaya:</strong> Jl. Dharmahusada No. 88, Gubeng, Surabaya
                        </p>
                        <p class="pt-1 text-slate-400">
                            WhatsApp: 0812-3456-7890<br>
                            Email: info@ortotik.co.id
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} PT Orthocare Medika Indonesia. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="{{ route('about') }}" class="hover:text-slate-400 transition">Tentang Kami</a>
                    <a href="{{ route('contact') }}" class="hover:text-slate-400 transition">Hubungi Kami</a>
                    <a href="/progress.html" class="text-medical-400 hover:text-medical-300 transition font-bold">Progress Dashboard</a>
                    <a href="/admin/login" class="text-slate-600 hover:text-slate-400 transition">Portal Staf</a>
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
