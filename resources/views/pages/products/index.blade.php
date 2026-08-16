@extends('layouts.app')

@section('title', 'E-Katalog Produk Medis - Precision Orthotics & Prosthetics')
@section('meta_description', 'Jelajahi e-katalog alat bantu ortopedi siap pakai, brace sendi, kolar leher, dan korset tulang belakang berstandar klinis.')

@section('content')

<!-- Header Banner -->
<div class="bg-cappuccino border-b border-border py-14 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1360px] mx-auto flex flex-wrap justify-between items-center gap-4">
        <!-- Left: Title & Breadcrumbs -->
        <div>
            <div class="flex items-center gap-2 text-xs text-tertiary font-medium mb-1 font-sans">
                <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
                <span>/</span>
                <span class="text-secondary font-medium">E-Katalog</span>
                @if($selectedCategory)
                <span>/</span>
                <span class="text-primary font-semibold">{{ $selectedCategory->name }}</span>
                @endif
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-[38px] font-serif font-medium text-primary tracking-tight">
                E-Katalog Produk Medis ({{ $products->total() }})
            </h1>
        </div>

        <!-- Right: Sort Dropdown -->
        <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-3 font-sans">
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
            
            <label class="text-xs text-tertiary font-medium hidden sm:inline">Urutkan:</label>
            <select name="sort" onchange="this.form.submit()"
                class="bg-white hover:bg-cappuccino text-secondary text-xs font-semibold px-4 py-2.5 rounded-full border border-border focus:outline-none focus:border-primary">
                <option value="latest" {{ $currentSort === 'latest' ? 'selected' : '' }}>Terbaru</option>
                <option value="price_asc" {{ $currentSort === 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                <option value="price_desc" {{ $currentSort === 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                <option value="name_asc" {{ $currentSort === 'name_asc' ? 'selected' : '' }}>Nama A - Z</option>
            </select>
        </form>
    </div>
</div>

<div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- Filter Sidebar -->
        <aside class="lg:col-span-3 space-y-6">
            <!-- Search Widget -->
            <div class="bg-white p-6 rounded-3xl border border-border space-y-3 shadow-2xs">
                <h3 class="text-xs font-serif font-semibold uppercase tracking-wider text-primary">Pencarian Alat Medis</h3>
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="flex items-center bg-cappuccino-light rounded-full px-4 py-2.5 border border-border focus-within:border-primary focus-within:bg-white">
                        <i data-lucide="search" class="w-4 h-4 text-tertiary mr-2 shrink-0"></i>
                        <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Nama / indikasi..."
                            class="bg-transparent text-xs text-secondary placeholder-tertiary focus:outline-none w-full font-normal">
                    </div>
                </form>
            </div>

            <!-- Categories Filter Chips -->
            <div class="bg-white p-6 rounded-3xl border border-border space-y-3 shadow-2xs">
                <h3 class="text-xs font-serif font-semibold uppercase tracking-wider text-primary">Kategori Anatomi</h3>
                <div class="space-y-1.5 text-xs font-medium font-sans">
                    <a href="{{ route('products.index') }}"
                        class="block px-4 py-2.5 rounded-full transition {{ empty($selectedCategory) ? 'bg-primary text-white font-semibold' : 'text-secondary hover:bg-cappuccino' }}">
                        Semua Kategori
                    </a>

                    @foreach($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                        class="block px-4 py-2.5 rounded-full transition {{ optional($selectedCategory)->id === $cat->id ? 'bg-primary text-white font-semibold' : 'text-secondary hover:bg-cappuccino' }}">
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Specialist WA Reassurance Tile (Maven Clinic Emerald) -->
            <div class="p-7 bg-primary text-cappuccino rounded-3xl space-y-3 shadow-xs">
                <span class="text-[10px] font-semibold text-mint uppercase tracking-widest block font-sans">Konsultasi Ukuran</span>
                <h4 class="text-lg font-serif font-medium leading-tight text-white">Butuh Rekomendasi Dokter / Ortotis?</h4>
                <p class="text-xs text-cappuccino/80 leading-relaxed font-light">Tim klinisi kami siap merekomendasikan ukuran dan jenis brace yang sesuai indikasi medis Anda.</p>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20butuh%20rekomendasi%20alat%20medis." target="_blank"
                    class="inline-flex items-center justify-center w-full bg-terracotta hover:bg-terracotta-dark text-white text-xs font-semibold h-11 rounded-full btn-maven transition">
                    <span>Chat WhatsApp Spesialis</span>
                </a>
            </div>
        </aside>

        <!-- Product Grid Main Area -->
        <main class="lg:col-span-9">
            @if($products->isEmpty())
            <div class="p-16 bg-white rounded-3xl border border-border text-center space-y-3 shadow-2xs">
                <i data-lucide="package-search" class="w-12 h-12 text-tertiary mx-auto"></i>
                <h3 class="text-xl font-serif font-medium text-primary">Tidak ada produk yang cocok dengan pencarian</h3>
                <p class="text-xs text-tertiary font-light">Coba ubah kata kunci pencarian atau pilih kategori anatomi tubuh yang lain.</p>
                <div class="pt-2">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center bg-primary text-white text-xs font-semibold px-6 h-10 rounded-full btn-maven transition">
                        Reset Filter
                    </a>
                </div>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $prod)
                <div class="bg-white rounded-3xl border border-border overflow-hidden flex flex-col justify-between hover:border-primary/40 hover:shadow-md transition duration-300 group">
                    <div>
                        <!-- Product Image -->
                        <div class="relative bg-cappuccino aspect-square flex items-center justify-center overflow-hidden border-b border-border">
                            <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80" alt="{{ $prod->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            <!-- Badges -->
                            <span class="absolute top-4 left-4 bg-white/95 text-secondary text-xs font-semibold px-3.5 py-1 rounded-full border border-border shadow-2xs">
                                {{ $prod->category->name ?? 'Ortotik' }}
                            </span>
                            
                            <span class="absolute top-4 right-4 bg-mint text-primary text-xs font-semibold px-3.5 py-1 rounded-full border border-primary/20">
                                Ready Stock
                            </span>
                        </div>

                        <!-- Metadata -->
                        <div class="p-7 space-y-2.5">
                            <h3 class="text-lg font-serif font-medium text-primary leading-snug group-hover:text-terracotta transition line-clamp-1">
                                <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                            </h3>

                            <p class="text-xs text-tertiary font-light line-clamp-2 leading-relaxed">
                                {{ $prod->short_description ?? 'Alat bantu ortopedi standar klinis presisi tinggi untuk pemulihan optimal.' }}
                            </p>

                            <!-- Price Row -->
                            <div class="pt-2 flex items-baseline gap-2.5">
                                <span class="text-lg font-serif font-semibold text-primary">{{ $prod->formatted_price }}</span>
                                @if($prod->formatted_discount_price)
                                <span class="text-xs text-tertiary line-through">{{ $prod->formatted_discount_price }}</span>
                                <span class="text-xs font-semibold text-terracotta">Diskon Promo</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="p-7 pt-0 grid grid-cols-2 gap-3">
                        <a href="{{ route('products.show', $prod->slug) }}" class="flex items-center justify-center bg-cappuccino hover:bg-cappuccino-deep text-secondary text-xs font-semibold h-11 rounded-full btn-maven border border-border transition">
                            Detail
                        </a>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($prod->name) }}" target="_blank"
                            class="flex items-center justify-center bg-terracotta hover:bg-terracotta-dark text-white text-xs font-semibold h-11 rounded-full btn-maven transition">
                            Order WA
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pt-12">
                {{ $products->withQueryString()->links() }}
            </div>
            @endif
        </main>

    </div>
</div>

@endsection
