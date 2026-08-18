<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Klinik Ortotik & Prostetik</title>
    
    <!-- Google Fonts -->
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
                            50: '#e6f0fa',
                            100: '#cce1f5',
                            500: '#0f4c81',
                            600: '#0c3d67',
                            700: '#092e50',
                            800: '#061f36',
                            900: '#0f172a',
                        },
                        tealmed: {
                            50: '#f0fdfa',
                            500: '#0d9488',
                            600: '#0f766e',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body x-data="{ sidebarOpen: false }" class="bg-slate-100 font-sans text-slate-700 antialiased min-h-screen flex flex-col lg:flex-row">

    <!-- Mobile Sidebar Overlay Backdrop -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-40 lg:hidden"
         style="display: none;"></div>

    <!-- Sidebar Navigation -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="w-64 bg-slate-900 text-white flex flex-col justify-between shrink-0 fixed inset-y-0 left-0 z-50 shadow-2xl transition-transform duration-300 ease-in-out">
        <div>
            <!-- Sidebar Brand Header -->
            <div class="h-16 px-5 sm:px-6 flex items-center justify-between border-b border-slate-800 bg-slate-950/50">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-medical-500 to-tealmed-500 flex items-center justify-center font-extrabold text-base shadow">
                        OP
                    </div>
                    <div>
                        <h2 class="font-extrabold text-sm tracking-tight text-white leading-tight">KLINIK ORTOTIK</h2>
                        <span class="text-[10px] text-teal-400 font-semibold tracking-wider uppercase">Medical Panel</span>
                    </div>
                </div>

                <!-- Close button for mobile -->
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white p-1 rounded-lg transition focus:outline-none" aria-label="Tutup Menu">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5 text-xs font-semibold overflow-y-auto max-h-[calc(100vh-8rem)]">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-medical-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard Overview</span>
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                    CRM & Konsultasi
                </div>

                <a href="{{ route('admin.leads.index') }}"
                    class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.leads.*') ? 'bg-medical-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <span>Leads Konsultasi</span>
                    </div>
                    @php
                        $unreadLeads = \App\Models\ConsultationLead::where('status', 'new')->count();
                    @endphp
                    @if($unreadLeads > 0)
                    <span class="bg-rose-500 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full">{{ $unreadLeads }}</span>
                    @endif
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                    Manajemen Konten
                </div>

                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.products.*') ? 'bg-medical-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i data-lucide="box" class="w-4 h-4"></i>
                    <span>E-Katalog Produk</span>
                </a>

                <a href="{{ route('admin.services.index') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.services.*') ? 'bg-medical-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i data-lucide="stethoscope" class="w-4 h-4"></i>
                    <span>Layanan Medis</span>
                </a>

                <a href="{{ route('admin.articles.index') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.articles.*') ? 'bg-medical-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i data-lucide="newspaper" class="w-4 h-4"></i>
                    <span>Artikel & Edukasi</span>
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                    Sistem & Klinik
                </div>

                <a href="{{ route('admin.branches.index') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.branches.*') ? 'bg-medical-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                    <span>Cabang Klinik</span>
                </a>

                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.settings.*') ? 'bg-medical-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i data-lucide="settings" class="w-4 h-4"></i>
                    <span>Pengaturan Situs</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar User Footer -->
        <div class="p-4 border-t border-slate-800 bg-slate-950/40">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center text-xs font-bold text-teal-400 shrink-0">
                        {{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}
                    </div>
                    <div class="truncate text-left">
                        <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <span class="text-[10px] text-slate-400 font-medium capitalize">{{ Auth::user()->role ?? 'admin' }}</span>
                    </div>
                </div>

                <!-- Logout Form -->
                <form action="{{ route('admin.logout') }}" method="POST" class="shrink-0">
                    @csrf
                    <button type="submit" title="Keluar" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-400 hover:bg-slate-800 transition">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 lg:ml-64 flex flex-col min-h-screen w-full min-w-0">
        
        <!-- Top Navbar -->
        <header class="h-16 bg-white border-b border-slate-200 px-4 sm:px-6 lg:px-8 flex items-center justify-between sticky top-0 z-20 shadow-sm">
            <!-- Left: Mobile Toggle & Page Title -->
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition focus:outline-none" aria-label="Buka Menu Sidebar">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <h1 class="text-sm sm:text-base font-extrabold text-slate-900 truncate">@yield('header_title', 'Dashboard')</h1>
            </div>

            <!-- Top Header Actions -->
            <div class="flex items-center gap-2 sm:gap-4">
                <a href="{{ route('home') }}" target="_blank" class="text-xs font-bold text-medical-600 hover:text-tealmed-600 bg-medical-50 hover:bg-medical-100 p-2 sm:px-3.5 sm:py-2 rounded-xl transition inline-flex items-center gap-1.5" title="Lihat Website Publik">
                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                    <span class="hidden sm:inline">Lihat Website</span>
                </a>

                <a href="/progress.html" target="_blank" class="text-xs font-bold text-tealmed-600 hover:text-tealmed-700 bg-tealmed-50 p-2 sm:px-3.5 sm:py-2 rounded-xl transition inline-flex items-center gap-1.5" title="Roadmap Progress">
                    <i data-lucide="activity" class="w-3.5 h-3.5"></i>
                    <span class="hidden sm:inline">Roadmap</span>
                </a>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6 max-w-full overflow-x-hidden">
            
            <!-- Global Flash Alerts -->
            @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600 shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 px-4 sm:px-8 border-t border-slate-200 bg-white text-center text-xs text-slate-400">
            &copy; 2026 PT Ortotik & Prostetik Indonesia &bull; Custom Blade Admin Dashboard
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>
