@extends('layouts.app')

@section('title', 'E-Katalog Produk Ortotik & Penyangga Medis - Klinik Ortotik')

@section('content')
<!-- Header Banner -->
<div class="bg-medical-700 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">E-Katalog Produk Medis</h1>
        <p class="text-slate-200 mt-2 text-sm max-w-2xl">Penyangga sendi, kolar leher, korset tulang belakang, dan alat ortopedi siap pakai berstandar medis.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Sidebar Filter -->
        <aside class="lg:col-span-3 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-6">
                <!-- Search Form -->
                <form action="{{ route('products.index') }}" method="GET">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Cari Produk</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Nama / Indikasi..." class="w-full pl-9 pr-3 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-700 focus:border-transparent">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-3.5"></i>
                    </div>
                </form>

                <!-- Anatomy Categories -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">Kategori Anatomi Tubuh</h3>
                    <div class="space-y-1">
                        <a href="{{ route('products.index') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm font-semibold transition {{ empty($selectedCategory) ? 'bg-medical-50 text-medical-700' : 'text-slate-600 hover:bg-slate-50' }}">
                            <span>Semua Bagian Tubuh</span>
                        </a>
                        @foreach($categories as $cat)
                        <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm font-semibold transition {{ optional($selectedCategory)->id === $cat->id ? 'bg-medical-50 text-medical-700' : 'text-slate-600 hover:bg-slate-50' }}">
                            <span>{{ $cat->name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Fast WhatsApp consultation card -->
                <div class="p-4 rounded-xl bg-tealmed-50 border border-tealmed-100 text-center space-y-2">
                    <i data-lucide="help-circle" class="w-6 h-6 text-tealmed-600 mx-auto"></i>
                    <h4 class="font-bold text-xs text-slate-800">Bingung Pilih Ukuran / Tipe?</h4>
                    <p class="text-[11px] text-slate-500">Konsultasikan keluhan medis Anda dengan tim fisioterapis kami gratis.</p>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20butuh%20rekomendasi%20alat%20medis%20yang%20sesuai%20keluhan%20saya." target="_blank" class="block w-full py-2 px-3 rounded-lg bg-[#25D366] text-white text-xs font-bold shadow hover:bg-[#20ba5a] transition">
                        Chat Spesialis WA
                    </a>
                </div>
            </div>
        </aside>

        <!-- Product Grid -->
        <main class="lg:col-span-9 space-y-6">
            <!-- Top Controls -->
            <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row justify-between items-center gap-4">
                <span class="text-xs text-slate-500 font-medium">Menampilkan <strong>{{ $products->count() }}</strong> dari <strong>{{ $products->total() }}</strong> produk</span>
                
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-2">
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                    <label class="text-xs text-slate-500 font-medium">Urutkan:</label>
                    <select name="sort" onchange="this.form.submit()" class="border border-slate-200 rounded-lg text-xs font-semibold py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-medical-700">
                        <option value="latest" {{ $currentSort === 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ $currentSort === 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ $currentSort === 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="name_asc" {{ $currentSort === 'name_asc' ? 'selected' : '' }}>Nama A - Z</option>
                    </select>
                </form>
            </div>

            <!-- Grid Items -->
            @if($products->isEmpty())
            <div class="bg-white p-12 rounded-2xl border border-slate-200 text-center space-y-3">
                <i data-lucide="package-search" class="w-12 h-12 text-slate-300 mx-auto"></i>
                <h3 class="font-bold text-slate-800 text-base">Tidak ada produk yang ditemukan</h3>
                <p class="text-xs text-slate-500">Coba ubah kata kunci pencarian atau pilih kategori anatomi tubuh yang lain.</p>
                <a href="{{ route('products.index') }}" class="inline-block mt-2 text-xs font-bold text-medical-700 hover:underline">Reset Filter &rarr;</a>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $prod)
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="relative bg-slate-100 h-48 flex items-center justify-center overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80" alt="{{ $prod->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @if($prod->discount_price)
                            <span class="absolute top-2.5 left-2.5 bg-red-600 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase shadow">Diskon</span>
                            @endif
                            <span class="absolute top-2.5 right-2.5 bg-white/90 backdrop-blur-sm text-slate-800 text-[10px] font-bold px-2 py-0.5 rounded-md shadow-sm">{{ $prod->category->name ?? 'Anatomi' }}</span>
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-sm text-slate-900 leading-snug group-hover:text-medical-700 transition line-clamp-2">
                                <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                            </h3>
                            <p class="text-[11px] text-slate-500 mt-1.5 line-clamp-2">{{ $prod->excerpt ?? strip_tags($prod->description) }}</p>
                            
                            <div class="mt-3 pt-3 border-t border-slate-100 flex items-baseline gap-2">
                                <span class="text-base font-extrabold text-medical-800">{{ $prod->formatted_price }}</span>
                                @if($prod->formatted_discount_price)
                                <span class="text-[11px] text-slate-400 line-through">{{ $prod->formatted_discount_price }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="px-5 pb-5 pt-0 flex gap-2">
                        <a href="{{ route('products.show', $prod->slug) }}" class="flex-1 text-center py-2 px-3 rounded-xl border border-slate-300 hover:border-medical-700 text-slate-700 hover:text-medical-700 text-xs font-bold transition">
                            Detail
                        </a>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20ingin%20memesan%20produk%20{{ urlencode($prod->name) }}" target="_blank" class="flex-1 inline-flex justify-center items-center gap-1.5 py-2 px-3 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white text-xs font-bold shadow transition">
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
