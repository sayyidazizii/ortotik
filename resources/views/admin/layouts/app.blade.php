<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - {{ \App\Models\SiteSetting::get('clinic_name', 'pediOcare') }}</title>
    
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

    <!-- Quill WYSIWYG Editor CDN -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <style>
        .ql-container {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            border-bottom-left-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
            background-color: #ffffff;
        }
        .ql-toolbar {
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            background-color: #f8fafc;
            border-color: #e2e8f0 !important;
        }
        .ql-container.ql-snow {
            border-color: #e2e8f0 !important;
        }
        .ql-editor {
            min-height: 180px;
            line-height: 1.6;
        }
        .ql-editor p {
            margin-bottom: 0.75em;
        }
    </style>
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
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-medical-500 to-tealmed-500 flex items-center justify-center font-extrabold text-base shadow text-white">
                        {{ strtoupper(substr(\App\Models\SiteSetting::get('clinic_name', 'pediOcare'), 0, 2)) }}
                    </div>
                    <div>
                        <h2 class="font-extrabold text-sm tracking-tight text-white leading-tight uppercase">{{ \App\Models\SiteSetting::get('clinic_name', 'pediOcare') }}</h2>
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

                <!-- Products & Categories Dropdown -->
                <div x-data="{ openProducts: {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.product-categories.*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button type="button" @click="openProducts = !openProducts" 
                            class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.product-categories.*') ? 'bg-medical-600/90 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                        <div class="flex items-center gap-3">
                            <i data-lucide="box" class="w-4 h-4"></i>
                            <span>E-Katalog Produk</span>
                        </div>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" :class="openProducts ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="openProducts" x-collapse class="pl-7 pr-2 py-1 space-y-1 text-[11px]">
                        <a href="{{ route('admin.products.index') }}" 
                           class="flex items-center gap-2 px-3 py-1.5 rounded-lg transition {{ request()->routeIs('admin.products.*') ? 'text-teal-300 font-bold bg-slate-800' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            <i data-lucide="package" class="w-3.5 h-3.5"></i>
                            <span>Daftar Produk</span>
                        </a>

                        <a href="{{ route('admin.product-categories.index') }}" 
                           class="flex items-center gap-2 px-3 py-1.5 rounded-lg transition {{ request()->routeIs('admin.product-categories.*') ? 'text-teal-300 font-bold bg-slate-800' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            <i data-lucide="folder-tree" class="w-3.5 h-3.5"></i>
                            <span>Kategori Produk</span>
                        </a>
                    </div>
                </div>

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

                <a href="{{ route('admin.testimonials.index') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-medical-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i data-lucide="message-square-quote" class="w-4 h-4"></i>
                    <span>Testimoni Pasien</span>
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                    Sistem & Pengaturan
                </div>

                <a href="{{ route('admin.branches.index') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.branches.*') ? 'bg-medical-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                    <span>Cabang Klinik</span>
                </a>

                <!-- Pengaturan Menu with Sub-Items -->
                <div x-data="{ openSettings: {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button type="button" @click="openSettings = !openSettings" 
                            class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.settings.*') ? 'bg-medical-600/90 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                        <div class="flex items-center gap-3">
                            <i data-lucide="settings" class="w-4 h-4"></i>
                            <span>Pengaturan Situs</span>
                        </div>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" :class="openSettings ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="openSettings" x-collapse class="pl-7 pr-2 py-1 space-y-1 text-[11px]">
                        <a href="{{ route('admin.settings.index', ['tab' => 'hero_home']) }}" 
                           class="flex items-center gap-2 px-3 py-1.5 rounded-lg transition {{ request('tab', 'hero_home') === 'hero_home' && request()->routeIs('admin.settings.*') ? 'text-teal-300 font-bold bg-slate-800' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            <span>Visual Beranda (Hero)</span>
                        </a>

                        <a href="{{ route('admin.settings.index', ['tab' => 'hero_pages']) }}" 
                           class="flex items-center gap-2 px-3 py-1.5 rounded-lg transition {{ request('tab') === 'hero_pages' && request()->routeIs('admin.settings.*') ? 'text-teal-300 font-bold bg-slate-800' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            <i data-lucide="image" class="w-3.5 h-3.5"></i>
                            <span>Banner Hero Halaman</span>
                        </a>

                        <a href="{{ route('admin.settings.index', ['tab' => 'location_maps']) }}" 
                           class="flex items-center gap-2 px-3 py-1.5 rounded-lg transition {{ request('tab') === 'location_maps' && request()->routeIs('admin.settings.*') ? 'text-teal-300 font-bold bg-slate-800' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            <i data-lucide="map" class="w-3.5 h-3.5"></i>
                            <span>Alamat & Google Maps</span>
                        </a>

                        <a href="{{ route('admin.settings.index', ['tab' => 'footer_branding']) }}" 
                           class="flex items-center gap-2 px-3 py-1.5 rounded-lg transition {{ request('tab') === 'footer_branding' && request()->routeIs('admin.settings.*') ? 'text-teal-300 font-bold bg-slate-800' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            <i data-lucide="layout-template" class="w-3.5 h-3.5"></i>
                            <span>Footer & Identitas</span>
                        </a>

                        <a href="{{ route('admin.settings.index', ['tab' => 'seo_meta']) }}" 
                           class="flex items-center gap-2 px-3 py-1.5 rounded-lg transition {{ request('tab') === 'seo_meta' && request()->routeIs('admin.settings.*') ? 'text-teal-300 font-bold bg-slate-800' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            <i data-lucide="search" class="w-3.5 h-3.5"></i>
                            <span>SEO & Metadata</span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('admin.backup.index') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.backup.*') ? 'bg-medical-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i data-lucide="database-backup" class="w-4 h-4"></i>
                    <span>Backup Database</span>
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

            @if($errors->any())
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold shadow-sm space-y-2">
                <div class="flex items-center gap-2 font-bold text-rose-900">
                    <i data-lucide="alert-octagon" class="w-4 h-4 text-rose-600 shrink-0"></i>
                    <span>Terdapat beberapa kesalahan validasi:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-[11px] text-rose-700 font-normal pl-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 px-4 sm:px-8 border-t border-slate-200 bg-white text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} {{ \App\Models\SiteSetting::get('clinic_name', 'pediOcare') }} &bull; Custom Blade Admin Dashboard
        </footer>
    </div>

    <!-- WYSIWYG & Lucide Auto Initializer -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }

            // Auto initialize WYSIWYG on any textarea with class wysiwyg-editor
            document.querySelectorAll('textarea.wysiwyg-editor').forEach(textarea => {
                if (textarea.dataset.wysiwygInitialized) return;
                textarea.dataset.wysiwygInitialized = 'true';

                const container = document.createElement('div');
                container.className = 'bg-white rounded-xl shadow-xs';
                textarea.parentNode.insertBefore(container, textarea);
                textarea.style.display = 'none';

                const quill = new Quill(container, {
                    theme: 'snow',
                    placeholder: textarea.getAttribute('placeholder') || 'Tulis deskripsi lengkap di sini...',
                    modules: {
                        toolbar: [
                            [{ 'header': [2, 3, 4, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            ['blockquote', 'link'],
                            ['clean']
                        ]
                    }
                });

                // Set initial content
                quill.root.innerHTML = textarea.value || '';

                // Sync on content change
                quill.on('text-change', () => {
                    textarea.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
                });

                // Sync on submit
                const form = textarea.closest('form');
                if (form) {
                    form.addEventListener('submit', () => {
                        textarea.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
                    });
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
