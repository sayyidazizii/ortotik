@extends('layouts.app')

@section('title', 'E-Katalog Produk Medis - pediOcare')
@section('meta_description', 'Jelajahi e-katalog alat bantu ortopedi siap pakai, brace sendi, kolar leher, dan korset tulang belakang berstandar klinis Kemenkes RI.')

@section('content')

@php
    $heroProductsBg = $settings['hero_products_image'] ?? ($settings['hero_about_image'] ?? asset('images/client_update/image4.png'));
    if (!str_starts_with($heroProductsBg, 'http') && !str_starts_with($heroProductsBg, '/')) {
        $heroProductsBg = asset($heroProductsBg);
    }
@endphp

<!-- Hero Section -->
<section class="relative text-center mx-auto py-10 md:py-14 px-margin-mobile md:px-margin-desktop text-white w-full overflow-hidden fade-in-up" 
         style='background-image: linear-gradient(rgba(13, 28, 47, 0.82), rgba(13, 28, 47, 0.82)), url("{{ $heroProductsBg }}"); background-size: cover; background-position: center;'>
    <div class="max-w-container-max mx-auto relative z-10 space-y-2.5 sm:space-y-3">
        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-surface-white/15 text-primary-fixed border border-surface-white/25 text-[11px] font-bold uppercase tracking-wider backdrop-blur-sm">
            <span class="w-1.5 h-1.5 rounded-full bg-primary-fixed animate-pulse"></span>
            E-Katalog Ready Stock ({{ $products->total() }} Produk)
        </span>
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight text-white max-w-3xl mx-auto leading-tight">
            {{ $settings['hero_products_title'] ?? 'E-Katalog Produk Medis & Alat Bantu' }}
        </h1>
        <p class="font-body-md text-body-md leading-relaxed text-slate-200 max-w-2xl mx-auto text-xs sm:text-sm">
            {{ $settings['hero_products_subtitle'] ?? 'Pilihan alat bantu ortotik dan ortopedi siap pakai dengan standar mutu dan fitting presisi bergaransi.' }}
        </p>
    </div>
</section>

<main class="max-w-container-max mx-auto w-full px-margin-mobile md:px-margin-desktop py-8 md:py-12 flex flex-col md:flex-row gap-8 relative z-10">
    
<!-- Mobile Anatomy Filter Dropdown (Visible only on mobile/tablet) -->
    <div class="md:hidden w-full bg-surface-white p-4 rounded-2xl border border-outline-variant/30 shadow-1 space-y-2">
        <label for="mobile-anatomy-select" class="flex items-center gap-2 text-xs font-bold text-primary uppercase tracking-wider">
            <span class="material-symbols-outlined text-base">filter_list</span>
            Filter Anatomi / Bagian Tubuh
        </label>
        <div class="relative">
            <select id="mobile-anatomy-select" 
                    onchange="if (this.value) window.location.href=this.value"
                    class="w-full pl-3.5 pr-10 py-2.5 bg-surface-container-low border border-outline-variant/40 rounded-xl text-xs font-semibold text-on-surface focus:outline-none focus:border-primary appearance-none cursor-pointer">
                <option value="{{ route('products.index', array_filter(['search' => request('search'), 'sort' => request('sort')])) }}"
                        {{ !$selectedCategory ? 'selected' : '' }}>
                    Semua Kategori ({{ $products->total() }})
                </option>
                @foreach($categories as $cat)
                <option value="{{ route('products.index', array_filter(['category' => $cat->slug, 'search' => request('search'), 'sort' => request('sort')])) }}"
                        {{ $selectedCategory && $selectedCategory->id === $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }} ({{ $cat->products_count }})
                </option>
                @endforeach
            </select>
            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline-variant pointer-events-none text-lg">
                expand_more
            </span>
        </div>
    </div>

    <!-- Desktop Sidebar Anatomy Filter (Hidden on mobile) -->
    <aside class="hidden md:block w-72 flex-shrink-0 space-y-6">
        <div class="bg-surface-white p-6 sm:p-8 rounded-3xl border border-outline-variant/30 shadow-1 sticky top-28 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-primary"></div>
            <div class="flex items-center gap-2 mb-6 border-b border-outline-variant/20 pb-4 relative z-10">
                <span class="material-symbols-outlined text-primary">filter_list</span>
                <h2 class="font-headline-md text-lg font-semibold text-primary">Filter Anatomi</h2>
            </div>
            
            <div class="space-y-1.5 relative z-10">
                <a href="{{ route('products.index', array_filter(['search' => request('search'), 'sort' => request('sort')])) }}"
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors {{ !$selectedCategory ? 'bg-primary text-white font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface-container-low font-medium' }}">
                    <span class="text-sm">Semua Kategori</span>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ !$selectedCategory ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500' }}">{{ $products->total() }}</span>
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('products.index', array_filter(['category' => $cat->slug, 'search' => request('search'), 'sort' => request('sort')])) }}"
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-colors {{ $selectedCategory && $selectedCategory->id === $cat->id ? 'bg-primary text-white font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface-container-low font-medium' }}">
                    <span class="text-sm">{{ $cat->name }}</span>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $selectedCategory && $selectedCategory->id === $cat->id ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500' }}">{{ $cat->products_count }}</span>
                </a>
                @endforeach
            </div>

            <!-- Need Custom Brace Prompt -->
            <div class="mt-8 pt-6 border-t border-outline-variant/20 space-y-3">
                <h4 class="text-xs font-semibold text-primary uppercase tracking-wider">Butuh Ukuran Custom?</h4>
                <p class="text-xs text-on-surface-variant leading-relaxed">
                    Kami juga memproduksi brace & alat bantu custom sesuai ukuran anatomi Anda.
                </p>
                <a href="{{ route('custom-products.index') }}" class="inline-flex items-center text-xs font-semibold text-primary hover:text-secondary">
                    Lihat Alur Custom &rarr;
                </a>
            </div>
        </div>
    </aside>

    <!-- Product Grid Area -->
    <section class="flex-grow flex flex-col gap-6 bg-surface-white rounded-3xl p-4 sm:p-8 border border-outline-variant/30 shadow-1 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-primary"></div>
        
        <!-- Search & Sort Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-surface-container-low p-4 sm:p-5 rounded-2xl border border-outline-variant/20">
            <!-- Search -->
            <form action="{{ route('products.index') }}" method="GET" class="w-full sm:w-80 relative">
                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-outline-variant text-[20px]">search</span>
                <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Cari nama alat / keluhan..."
                       class="w-full pl-11 pr-4 py-2.5 bg-surface-white border border-outline-variant/40 rounded-xl focus:outline-none focus:border-primary text-sm text-on-surface placeholder:text-outline-variant transition"/>
            </form>

            <!-- Sort dropdown -->
            <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-3 w-full sm:w-auto">
                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                <span class="text-xs text-on-surface-variant font-medium whitespace-nowrap hidden sm:inline">Urutkan:</span>
                <select name="sort" onchange="this.form.submit()"
                        class="w-full sm:w-48 px-3.5 py-2.5 bg-surface-white border border-outline-variant/40 rounded-xl focus:outline-none focus:border-primary text-xs text-on-surface cursor-pointer">
                    <option value="latest" {{ $currentSort === 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="price_asc" {{ $currentSort === 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                    <option value="price_desc" {{ $currentSort === 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                    <option value="name_asc" {{ $currentSort === 'name_asc' ? 'selected' : '' }}>Nama A - Z</option>
                </select>
            </form>
        </div>

        @if($products->count() > 0)
        <!-- Grid Cards: 2 Columns on Mobile, 3 on Tablet/Desktop, 4 on XL -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-2.5 sm:gap-4 relative z-10">
            @foreach($products as $prod)
            <a href="{{ route('products.show', $prod->slug) }}" 
               class="bg-surface-white border border-outline-variant/30 hover:border-primary rounded-2xl sm:rounded-3xl p-2.5 sm:p-3 transition-all duration-300 group flex flex-col justify-between h-full shadow-2xs hover:shadow-md hover:-translate-y-1 relative">
                
                <!-- Inner Image Box (Lapakgaming style with border-radius & padding) -->
                <div class="relative w-full aspect-square rounded-xl sm:rounded-2xl bg-surface-container-low/70 border border-outline-variant/20 overflow-hidden flex items-center justify-center p-3 group-hover:bg-primary/5 transition-colors">
                    <img src="{{ $prod->thumbnail_url }}" alt="{{ $prod->name }}" 
                         class="w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-300"/>
                    
                    <!-- Category Badge (Positioned at Bottom of Image) -->
                    <div class="absolute bottom-2 left-2 max-w-[calc(100%-16px)]">
                        <span class="bg-primary/95 text-white font-bold text-[9px] sm:text-[10px] px-2 py-0.5 rounded-md shadow-2xs truncate block leading-tight">
                            {{ $prod->category->name ?? 'Ortotik' }}
                        </span>
                    </div>

                    @if($prod->stock_status === 'in_stock' || $prod->stock_status === 'ready_stock')
                    <div class="absolute top-2 right-2">
                        <span class="bg-white/90 backdrop-blur-sm text-emerald-700 font-bold text-[8px] sm:text-[9px] px-1.5 py-0.5 rounded-md border border-emerald-200/80 shadow-2xs">
                            Ready
                        </span>
                    </div>
                    @endif
                </div>
                
                <!-- Compact Content Details -->
                <div class="pt-2.5 pb-0.5 flex flex-col justify-between flex-grow space-y-2">
                    <h3 class="text-xs sm:text-sm font-bold text-on-surface line-clamp-1 group-hover:text-primary transition-colors leading-snug">
                        {{ $prod->name }}
                    </h3>
                    
                    <div class="flex items-center justify-between pt-1.5 border-t border-outline-variant/15 mt-auto gap-1">
                        <div>
                            <span class="text-xs sm:text-sm font-extrabold text-primary block leading-tight">{{ $prod->formatted_price }}</span>
                            @if($prod->formatted_discount_price)
                            <span class="text-[9px] sm:text-[10px] text-outline line-through block leading-tight">{{ $prod->formatted_discount_price }}</span>
                            @endif
                        </div>
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-lg bg-surface-container-low group-hover:bg-primary group-hover:text-white text-on-surface-variant flex items-center justify-center transition-colors shrink-0">
                            <span class="material-symbols-outlined text-[13px] sm:text-sm">arrow_forward</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pt-6">
            {{ $products->links() }}
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-16 space-y-4">
            <div class="w-16 h-16 rounded-full bg-surface-container-low text-on-surface-variant flex items-center justify-center mx-auto">
                <span class="material-symbols-outlined text-3xl">inventory_2</span>
            </div>
            <h3 class="font-headline-md text-lg font-semibold text-on-background">Tidak ada produk yang cocok</h3>
            <p class="text-xs text-on-surface-variant max-w-sm mx-auto">Coba cari dengan kata kunci lain atau pilih kategori yang berbeda.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center bg-primary text-white text-xs font-semibold px-6 py-2.5 rounded-xl transition">
                Reset Filter
            </a>
        </div>
        @endif

    </section>

</main>

@endsection
