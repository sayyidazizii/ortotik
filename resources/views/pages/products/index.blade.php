@extends('layouts.app')

@section('title', 'E-Katalog Produk Medis - Precision Orthotics & Prosthetics')
@section('meta_description', 'Jelajahi e-katalog alat bantu ortopedi siap pakai, brace sendi, kolar leher, dan korset tulang belakang berstandar klinis.')

@section('content')

<!-- Sub-Nav Strip (PLP Header: Breadcrumb + Total Count + Sort Controls) -->
<div class="bg-canvas border-b border-hairline-soft py-4 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1440px] mx-auto flex flex-wrap justify-between items-center gap-4">
        <!-- Left: Breadcrumb & Title -->
        <div>
            <div class="flex items-center gap-2 text-xs text-mute font-medium mb-1">
                <a href="{{ route('home') }}" class="hover:text-ink">Beranda</a>
                <span>/</span>
                <span class="text-ink font-semibold">E-Katalog</span>
                @if($selectedCategory)
                <span>/</span>
                <span class="text-ink font-semibold">{{ $selectedCategory->name }}</span>
                @endif
            </div>
            <h1 class="text-2xl sm:text-3xl font-medium tracking-tight text-ink uppercase font-sans">
                E-Katalog Produk Medis ({{ $products->total() }})
            </h1>
        </div>

        <!-- Right: Sort & Filter Controls -->
        <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-3">
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
            
            <label class="text-xs text-mute font-medium hidden sm:inline">Urutkan Berdasarkan:</label>
            <select name="sort" onchange="this.form.submit()"
                class="bg-soft-cloud hover:bg-hairline-soft text-ink text-xs font-semibold px-4 py-2 rounded-full border-none focus:outline-none focus:ring-1 focus:ring-ink">
                <option value="latest" {{ $currentSort === 'latest' ? 'selected' : '' }}>Terbaru</option>
                <option value="price_asc" {{ $currentSort === 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                <option value="price_desc" {{ $currentSort === 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                <option value="name_asc" {{ $currentSort === 'name_asc' ? 'selected' : '' }}>Nama A - Z</option>
            </select>
        </form>
    </div>
</div>

<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Filter Sidebar ({component.filter-sidebar}: 220px fixed left rail) -->
        <aside class="lg:col-span-3 space-y-6">
            <!-- Search Widget -->
            <div class="space-y-2 pb-6 border-b border-hairline-soft">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-ink">Pencarian Produk</h3>
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="flex items-center bg-soft-cloud rounded-full px-3.5 py-2">
                        <i data-lucide="search" class="w-4 h-4 text-mute mr-2 shrink-0"></i>
                        <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Ketik nama atau indikasi..."
                            class="bg-transparent text-xs text-ink placeholder-mute focus:outline-none w-full font-medium">
                    </div>
                </form>
            </div>

            <!-- Anatomy Categories Filter Chips -->
            <div class="space-y-3 pb-6 border-b border-hairline-soft">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-ink">Kategori Bagian Tubuh</h3>
                <div class="flex flex-wrap gap-2">
                    <!-- All -->
                    <a href="{{ route('products.index') }}"
                        class="text-xs font-medium px-4 py-2 rounded-full transition {{ empty($selectedCategory) ? 'bg-ink text-canvas' : 'bg-canvas text-ink border border-hairline hover:bg-soft-cloud' }}">
                        Semua Kategori
                    </a>

                    @foreach($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                        class="text-xs font-medium px-4 py-2 rounded-full transition {{ optional($selectedCategory)->id === $cat->id ? 'bg-ink text-canvas' : 'bg-canvas text-ink border border-hairline hover:bg-soft-cloud' }}">
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- WhatsApp Specialist Reassurance Tile -->
            <div class="p-6 bg-soft-cloud border border-hairline-soft space-y-3">
                <span class="text-[10px] font-bold text-mute uppercase tracking-widest block">Butuh Rekomendasi?</span>
                <h4 class="text-sm font-bold text-ink leading-tight">Konsultasi Ukuran & Indikasi Medis</h4>
                <p class="text-xs text-mute leading-relaxed">Tim klinisi Ortotis-Prostetis siap merekomendasikan alat ortopedi yang tepat via WhatsApp gratis.</p>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20butuh%20rekomendasi%20alat%20medis." target="_blank"
                    class="inline-flex items-center justify-center w-full bg-ink hover:bg-charcoal text-canvas text-xs font-medium h-10 rounded-full btn-pill-tap transition">
                    <span>Chat WhatsApp Spesialis</span>
                </a>
            </div>
        </aside>

        <!-- Product Grid Main Area (3-up on desktop, 8px gutters) -->
        <main class="lg:col-span-9">
            @if($products->isEmpty())
            <div class="p-16 border border-hairline-soft text-center space-y-3">
                <i data-lucide="package-search" class="w-12 h-12 text-mute mx-auto"></i>
                <h3 class="text-base font-bold text-ink">Tidak ada produk yang cocok dengan kriteria pencarian</h3>
                <p class="text-xs text-mute">Coba ubah kata kunci pencarian atau pilih kategori anatomi tubuh yang lain.</p>
                <div class="pt-2">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center bg-ink text-canvas text-xs font-medium px-6 h-10 rounded-full btn-pill-tap transition">
                        Reset Filter
                    </a>
                </div>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                @foreach($products as $prod)
                <!-- {component.product-card} -->
                <div class="bg-canvas border border-hairline-soft p-0 flex flex-col justify-between group">
                    <div>
                        <!-- Image studio 1:1 square on soft-cloud -->
                        <div class="relative bg-soft-cloud aspect-square flex items-center justify-center overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=600&q=80" alt="{{ $prod->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            <!-- Promo Badges -->
                            <span class="absolute top-3 left-3 bg-canvas border border-hairline text-ink text-[11px] font-medium px-3 py-1 rounded-full shadow-xs">
                                {{ $prod->category->name ?? 'Ortotik' }}
                            </span>
                            
                            <span class="absolute top-3 right-3 bg-canvas border border-hairline text-ink text-[11px] font-medium px-3 py-1 rounded-full shadow-xs">
                                Ready Stock
                            </span>
                        </div>

                        <!-- Metadata rows with 8px rhythm -->
                        <div class="p-4 space-y-2">
                            <!-- Swatch Dots -->
                            <div class="flex items-center gap-1.5 pt-1">
                                <span class="w-3 h-3 rounded-full bg-ink ring-2 ring-ink ring-offset-2"></span>
                                <span class="w-3 h-3 rounded-full bg-mute"></span>
                                <span class="w-3 h-3 rounded-full bg-hairline"></span>
                            </div>

                            <!-- Product Name -->
                            <h3 class="text-base font-medium text-ink leading-snug group-hover:text-mute transition">
                                <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                            </h3>

                            <!-- Subtitle -->
                            <p class="text-xs text-mute font-medium line-clamp-1">
                                {{ $prod->short_description ?? 'Alat bantu ortopedi standar klinis presisi tinggi' }}
                            </p>

                            <!-- Price Row -->
                            <div class="pt-1 flex items-baseline gap-2">
                                <span class="text-base font-bold text-ink">{{ $prod->formatted_price }}</span>
                                @if($prod->formatted_discount_price)
                                <span class="text-xs text-mute line-through">{{ $prod->formatted_discount_price }}</span>
                                <span class="text-xs font-semibold text-sale">Diskon Promo</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Pill Actions -->
                    <div class="p-4 pt-0 grid grid-cols-2 gap-2">
                        <a href="{{ route('products.show', $prod->slug) }}" class="flex items-center justify-center bg-soft-cloud hover:bg-hairline-soft text-ink text-xs font-medium h-10 rounded-full btn-pill-tap transition">
                            Detail Produk
                        </a>
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($prod->name) }}" target="_blank"
                            class="flex items-center justify-center bg-ink hover:bg-charcoal text-canvas text-xs font-medium h-10 rounded-full btn-pill-tap transition">
                            Order WA
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pt-8">
                {{ $products->withQueryString()->links() }}
            </div>
            @endif
        </main>

    </div>
</div>

@endsection
