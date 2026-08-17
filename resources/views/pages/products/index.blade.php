@extends('layouts.app')

@section('title', 'E-Katalog Produk Medis - PT. Orthocare Indonesia')
@section('meta_description', 'Jelajahi e-katalog alat bantu ortopedi siap pakai, brace sendi, kolar leher, dan korset tulang belakang berstandar klinis Kemenkes RI.')

@section('content')

<!-- Header Banner -->
<div class="bg-surface-white border-b border-outline-variant/30 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-container-max mx-auto flex flex-wrap justify-between items-center gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-on-surface-variant font-medium mb-1">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
                <span class="text-outline-variant">/</span>
                <span class="text-on-surface font-medium">E-Katalog</span>
                @if($selectedCategory)
                <span class="text-outline-variant">/</span>
                <span class="text-primary font-semibold">{{ $selectedCategory->name }}</span>
                @endif
            </div>
            <h1 class="text-2xl sm:text-3xl lg:text-[34px] font-headline-xl font-bold text-on-background tracking-tight">
                E-Katalog Produk Medis Ready Stock ({{ $products->total() }})
            </h1>
        </div>
    </div>
</div>

<main class="max-w-container-max mx-auto w-full px-margin-mobile md:px-margin-desktop py-10 md:py-16 flex flex-col md:flex-row gap-8 relative z-10">
    
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
            
            <div class="space-y-2 relative z-10">
                <a href="{{ route('products.index', array_filter(['search' => request('search'), 'sort' => request('sort')])) }}"
                   class="flex items-center justify-between p-2.5 rounded-xl transition-colors {{ !$selectedCategory ? 'bg-primary/10 text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
                    <span class="text-sm">Semua Kategori</span>
                    <span class="text-xs bg-surface-container-high px-2 py-0.5 rounded-full">{{ $products->total() }}</span>
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('products.index', array_filter(['category' => $cat->slug, 'search' => request('search'), 'sort' => request('sort')])) }}"
                   class="flex items-center justify-between p-2.5 rounded-xl transition-colors {{ $selectedCategory && $selectedCategory->id === $cat->id ? 'bg-primary/10 text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
                    <span class="text-sm">{{ $cat->name }}</span>
                    <span class="text-xs bg-surface-container-high px-2 py-0.5 rounded-full">{{ $cat->products_count }}</span>
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
        <!-- Grid Cards: 3 Columns on Mobile, 2 on Tablet, 3 on Desktop -->
        <div class="grid grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-6 relative z-10">
            @foreach($products as $prod)
            <div class="bg-surface-white border border-outline-variant/30 rounded-2xl sm:rounded-3xl overflow-hidden hover:border-primary/50 transition-all duration-300 group flex flex-col h-full shadow-1 hover:shadow-hover hover:-translate-y-1">
                <!-- Thumbnail -->
                <div class="aspect-square bg-surface-container-low relative overflow-hidden p-2 sm:p-6 flex items-center justify-center border-b border-outline-variant/15">
                    @if($prod->thumbnail)
                    <img src="{{ $prod->thumbnail }}" alt="{{ $prod->name }}" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500"/>
                    @else
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBRX96KTlDSHiomGN3OyOvDA8gmpFo6nH9DuQJ13zV-uwYj0On4T643XIIvI7ZfTgEHlGNMCnzLWygdnoChDtXh3HKQ3iKaxsBs2SXt9HZXR5pM7Qtw8KzFBwh-xAkBI6kBHJNij2YKEAiHE2MhApvaIyUSmfo0V7MtHqYRgFzaU3IRMw5FPuoduXReXEcCNbLjLVDm5pEO5HM2XWxQXW-P6GZ1bJoBKdVpdMOPdViOhKinS3glyd4" 
                         alt="{{ $prod->name }}" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500"/>
                    @endif
                    <div class="hidden sm:block absolute top-3.5 left-3.5 bg-primary text-white font-label-sm text-[11px] uppercase tracking-wider px-3 py-1 rounded-full shadow-2xs">
                        {{ $prod->category->name ?? 'Ortotik' }}
                    </div>
                </div>
                
                <!-- Content -->
                <div class="p-2 sm:p-6 flex flex-col flex-grow relative z-10">
                    <h3 class="font-headline-md text-[11px] sm:text-base leading-tight font-bold text-on-surface mb-1 sm:mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                        <a href="{{ route('products.show', $prod->slug) }}">{{ $prod->name }}</a>
                    </h3>
                    <p class="hidden sm:block text-xs text-on-surface-variant line-clamp-2 leading-relaxed mb-4">
                        {{ $prod->short_description ?? 'Alat bantu ortopedi standar klinis presisi tinggi untuk pemulihan optimal.' }}
                    </p>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mt-auto pt-2 sm:pt-4 border-t border-outline-variant/15 gap-1.5 sm:gap-2">
                        <div>
                            <span class="font-headline-md text-[11px] sm:text-base font-bold text-primary block leading-tight">{{ $prod->formatted_price }}</span>
                            @if($prod->formatted_discount_price)
                            <span class="text-[9px] sm:text-[11px] text-outline line-through">{{ $prod->formatted_discount_price }}</span>
                            @endif
                        </div>
                        <div class="flex gap-1 sm:gap-2 justify-end">
                            <a href="{{ route('products.show', $prod->slug) }}" class="w-6 h-6 sm:w-9 sm:h-9 rounded-full bg-surface-container-low hover:bg-primary hover:text-white border border-outline-variant/30 flex items-center justify-center text-on-surface-variant transition-colors" title="Lihat Detail">
                                <span class="material-symbols-outlined text-[13px] sm:text-[18px]">visibility</span>
                            </a>
                            <a href="https://wa.me/6281234567890?text=Halo%20PT.%20Orthocare%20Indonesia,%20saya%20tertarik%20pesan%20produk%20{{ urlencode($prod->name) }}." target="_blank" rel="noopener noreferrer"
                               class="w-6 h-6 sm:w-9 sm:h-9 rounded-full bg-primary flex items-center justify-center text-white hover:bg-secondary transition-all shadow-sm hover:scale-105" title="Order WhatsApp">
                                <span class="material-symbols-outlined text-[13px] sm:text-[17px]">chat</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
