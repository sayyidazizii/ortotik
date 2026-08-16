@extends('layouts.app')

@section('title', 'E-Katalog Produk Ortotik & Alat Bantu Medis - Klinik Ortotik')
@section('meta_description', 'Jelajahi e-katalog alat bantu ortopedi, korset tulang belakang, knee brace, AFO, dan insole medis siap pakai dengan standar mutu klinis.')

@section('content')

<!-- Header Banner (Soft Light Blue Theme) -->
<div class="bg-hero-soft py-12 lg:py-16 border-b border-sky-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            <span class="text-medical-600 font-extrabold text-xs uppercase tracking-widest block mb-2">E-KATALOG ALAT BANTU</span>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Katalog Produk & Penyangga Medis</h1>
            <p class="text-slate-600 mt-2 text-sm leading-relaxed">Penyangga sendi, korset tulang belakang, brace lutut, dan alat ortopedi siap pakai dengan material impor berstandar klinis.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Sidebar Filter (Clean Medical Card) -->
        <aside class="lg:col-span-3 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-card space-y-6">
                
                <!-- Search Form -->
                <form action="{{ route('products.index') }}" method="GET">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Cari Produk</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Nama / Indikasi..."
                            class="w-full pl-9 pr-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500 focus:border-transparent">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-3"></i>
                    </div>
                </form>

                <!-- Anatomy Categories -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">Bagian Tubuh / Kategori</h3>
                    <div class="space-y-1 text-xs font-bold">
                        <a href="{{ route('products.index') }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ empty($selectedCategory) ? 'bg-medical-50 text-medical-700 font-extrabold border border-medical-200/60' : 'text-slate-600 hover:bg-slate-50' }}">
                            <span>Semua Bagian Tubuh</span>
                            <span class="text-[11px] text-slate-400">&rarr;</span>
                        </a>

                        @foreach($categories as $cat)
                        <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ optional($selectedCategory)->id === $cat->id ? 'bg-medical-50 text-medical-700 font-extrabold border border-medical-200/60' : 'text-slate-600 hover:bg-slate-50' }}">
                            <span>{{ $cat->name }}</span>
                            <span class="text-[11px] text-slate-400">&rarr;</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- WhatsApp Doctor Consultation Card -->
                <div class="p-4 rounded-xl bg-sky-50/70 border border-sky-100 text-center space-y-2.5">
                    <div class="w-10 h-10 rounded-full bg-medical-600 text-white flex items-center justify-center mx-auto">
                        <i data-lucide="help-circle" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-bold text-xs text-slate-900">Perlu Bantuan Memilih Ukuran?</h4>
                    <p class="text-[11px] text-slate-600 leading-relaxed">Klinisi spesialis kami siap membantu rekomendasi alat bantu yang pas via WhatsApp.</p>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20butuh%20rekomendasi%20alat%20medis%20yang%20sesuai%20keluhan%20saya." target="_blank"
                        class="block w-full py-2.5 px-3 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white text-xs font-bold shadow-xs transition">
                        Chat WhatsApp Spesialis
                    </a>
                </div>

            </div>
        </aside>

        <!-- Product Grid Main Area -->
        <main class="lg:col-span-9 space-y-6">
            
            <!-- Top Controls Toolbar -->
            <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-card flex flex-col sm:flex-row justify-between items-center gap-4">
                <span class="text-xs text-slate-500 font-medium">Menampilkan <strong>{{ $products->count() }}</strong> dari <strong>{{ $products->total() }}</strong> produk medis</span>
                
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-2 text-xs">
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                    <label class="text-slate-500 font-bold">Urutkan:</label>
                    <select name="sort" onchange="this.form.submit()" class="border border-slate-200 rounded-xl text-xs font-bold py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-medical-500">
                        <option value="latest" {{ $currentSort === 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ $currentSort === 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ $currentSort === 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="name_asc" {{ $currentSort === 'name_asc' ? 'selected' : '' }}>Nama A - Z</option>
                    </select>
                </form>
            </div>

            <!-- Grid Items -->
            @if($products->isEmpty())
            <div class="bg-white p-12 rounded-2xl border border-slate-200/80 text-center space-y-3 shadow-card">
                <i data-lucide="package-search" class="w-12 h-12 text-slate-300 mx-auto"></i>
                <h3 class="font-black text-slate-900 text-base">Tidak ada produk medis yang cocok</h3>
                <p class="text-xs text-slate-500">Coba ubah kata kunci pencarian atau pilih kategori anatomi tubuh yang lain.</p>
                <a href="{{ route('products.index') }}" class="inline-block mt-2 text-xs font-bold text-medical-600 hover:underline">Reset Filter &rarr;</a>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $prod)
                <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-card hover:shadow-card-hover hover:border-sky-300 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <!-- Product Image Container -->
                        <div class="relative bg-gradient-to-b from-sky-50/60 to-slate-50 h-48 flex items-center justify-center overflow-hidden border-b border-slate-100">
                            <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80" alt="{{ $prod->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            
                            <span class="absolute top-2.5 left-2.5 bg-white/95 backdrop-blur-md text-slate-800 text-[10px] font-extrabold px-2.5 py-0.5 rounded-md shadow-xs border border-slate-200/60">
                                {{ $prod->category->name ?? 'Ortotik' }}
                            </span>
                            
                            <span class="absolute top-2.5 right-2.5 bg-emerald-50 text-emerald-700 text-[10px] font-extrabold px-2.5 py-0.5 rounded-md border border-emerald-200">
                                Ready Stock
                            </span>
                        </div>

                        <div class="p-5">
                            <h3 class="font-extrabold text-sm text-slate-900 leading-snug group-hover:text-medical-600 transition line-clamp-2">
                                <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                            </h3>
                            
                            <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">
                                {{ $prod->short_description ?? strip_tags($prod->description) }}
                            </p>

                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-baseline justify-between">
                                <div>
                                    <span class="text-[10px] text-slate-400 uppercase font-bold block">Harga Estimasi</span>
                                    <span class="text-base font-black text-slate-900">{{ $prod->formatted_price }}</span>
                                </div>
                                <span class="text-[10px] text-slate-400 font-semibold">Garansi Resmi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dual Action Buttons -->
                    <div class="px-5 pb-5 pt-0 grid grid-cols-2 gap-2">
                        <a href="{{ route('products.show', $prod->slug) }}" class="text-center py-2 px-3 rounded-xl border border-slate-200 hover:border-medical-500 text-slate-700 hover:text-medical-600 text-xs font-bold transition">
                            Detail Produk
                        </a>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20ingin%20memesan%20produk%20{{ urlencode($prod->name) }}" target="_blank"
                            class="inline-flex justify-center items-center gap-1.5 py-2 px-3 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white text-xs font-bold shadow-xs transition">
                            <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                            <span>Beli WA</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pt-6">
                {{ $products->withQueryString()->links() }}
            </div>
            @endif

        </main>
    </div>
</div>

@endsection
