@extends('layouts.app')

@section('title', $product->name . ' - E-Katalog pediOcare')
@section('meta_description', strip_tags($product->excerpt ?? $product->description))

@section('content')

<!-- Sub-Nav Breadcrumb -->
<div class="bg-surface-white border-b border-outline-variant/30 py-3.5 px-4 sm:px-6 lg:px-8 text-xs text-on-surface-variant font-medium">
    <div class="max-w-container-max mx-auto flex items-center gap-2 flex-wrap">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <span class="text-outline-variant">/</span>
        <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors">E-Katalog</a>
        @if($product->category)
        <span class="text-outline-variant">/</span>
        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-primary transition-colors">{{ $product->category->name }}</a>
        @endif
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-semibold truncate max-w-xs">{{ $product->name }}</span>
    </div>
</div>

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-10 md:py-14 space-y-12">
    
    @php
        $galleryList = $product->gallery_images;
    @endphp

    <!-- Top Hero: Product Image Slider + Overview & Order Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
        
        <!-- Left: Product Image Slider & Gallery (5 Cols) -->
        <div class="lg:col-span-5 space-y-4" x-data="productImageGallery()">
            
            <!-- Main Image Frame with Smooth Slide Transitions -->
            <div class="relative bg-surface-container-low aspect-square w-full rounded-3xl border border-outline-variant/30 flex items-center justify-center overflow-hidden shadow-1 p-6 sm:p-8 group">
                
                <!-- Active Slide Image -->
                <template x-for="(img, idx) in images" :key="idx">
                    <div x-show="currentIndex === idx"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute inset-0 p-6 sm:p-8 flex items-center justify-center">
                        <img :src="img" alt="{{ $product->name }}" 
                             class="w-full h-full object-contain mix-blend-multiply drop-shadow-md group-hover:scale-105 transition-transform duration-500">
                    </div>
                </template>
                
                <!-- Fallback Image if Alpine is loading -->
                <div x-show="images.length === 0" class="w-full h-full flex items-center justify-center">
                    <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain mix-blend-multiply drop-shadow-md">
                </div>
                
                <!-- Category Badge at Bottom-Left of Image -->
                <div class="absolute bottom-4 left-4 z-10">
                    @if($product->category)
                    <span class="bg-primary/95 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-sm">
                        {{ $product->category->name }}
                    </span>
                    @endif
                </div>

                <!-- Stock Status Badge at Top-Right -->
                <div class="absolute top-4 right-4 z-10">
                    <span class="bg-surface-white/90 backdrop-blur-sm text-primary text-[11px] font-bold px-3 py-1 rounded-full border border-outline-variant/30 shadow-2xs">
                        {{ $product->stock_status_label }}
                    </span>
                </div>

                <!-- Photo Counter (e.g. 1 / 3) -->
                <template x-if="images.length > 1">
                    <div class="absolute top-4 left-4 z-10 bg-black/60 backdrop-blur-xs text-white text-[10px] font-bold font-mono px-2.5 py-0.5 rounded-full">
                        <span x-text="(currentIndex + 1) + ' / ' + images.length"></span>
                    </div>
                </template>

                <!-- Slider Navigation Arrows (Shown on hover if > 1 images) -->
                <template x-if="images.length > 1">
                    <div class="absolute inset-x-3 top-1/2 -translate-y-1/2 flex justify-between pointer-events-none z-10">
                        <button type="button" @click="prev()" class="pointer-events-auto w-9 h-9 rounded-full bg-surface-white/90 hover:bg-primary hover:text-white text-slate-700 shadow-md border border-slate-200 flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 cursor-pointer" title="Foto Sebelumnya">
                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                        </button>
                        <button type="button" @click="next()" class="pointer-events-auto w-9 h-9 rounded-full bg-surface-white/90 hover:bg-primary hover:text-white text-slate-700 shadow-md border border-slate-200 flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 translate-x-2 group-hover:translate-x-0 cursor-pointer" title="Foto Selanjutnya">
                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                        </button>
                    </div>
                </template>
            </div>

            <!-- Interactive Thumbnail Strip Below Main Image -->
            <template x-if="images.length > 1">
                <div class="flex items-center gap-2.5 overflow-x-auto pb-1.5 scrollbar-thin">
                    <template x-for="(img, idx) in images" :key="idx">
                        <button type="button" @click="setIndex(idx)"
                                class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-surface-container-low border-2 p-1.5 flex items-center justify-center transition-all shrink-0 overflow-hidden shadow-2xs cursor-pointer"
                                :class="currentIndex === idx ? 'border-primary ring-2 ring-primary/20 scale-105 bg-white' : 'border-outline-variant/30 hover:border-primary/50 opacity-70 hover:opacity-100'">
                            <img :src="img" alt="Thumbnail" class="w-full h-full object-contain mix-blend-multiply">
                        </button>
                    </template>
                </div>
            </template>

            <!-- Trust Badges Under Image -->
            <div class="grid grid-cols-2 gap-3">
                <div class="p-3.5 rounded-2xl bg-surface-white border border-outline-variant/25 flex items-center gap-2.5 shadow-2xs">
                    <span class="material-symbols-outlined text-primary text-xl shrink-0">verified</span>
                    <div>
                        <strong class="text-xs font-bold text-on-background block">Standar Medis</strong>
                        <span class="text-[10px] text-on-surface-variant">Kemenkes RI Ber-STR</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-2xl bg-surface-white border border-outline-variant/25 flex items-center gap-2.5 shadow-2xs">
                    <span class="material-symbols-outlined text-emerald-600 text-xl shrink-0">published_with_changes</span>
                    <div>
                        <strong class="text-xs font-bold text-on-background block">Garansi Fitting</strong>
                        <span class="text-[10px] text-on-surface-variant">Penyesuaian Anatomi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Product Title, Pricing, Excerpt, CTA (7 Cols) -->
        <div class="lg:col-span-7 space-y-6">
            <div>
                <div class="flex items-center gap-2 text-xs font-bold text-primary uppercase tracking-wider mb-2">
                    <span>{{ $product->category->name ?? 'Alat Bantu Ortopedi' }}</span>
                    <span>&bull;</span>
                    <span class="text-emerald-700">{{ $product->stock_status_label }}</span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-headline-xl font-bold tracking-tight text-on-background leading-tight mb-2">
                    {{ $product->name }}
                </h1>

                @if($product->sku)
                <span class="text-xs text-on-surface-variant font-mono block mb-4">Kode Produk / SKU: <strong class="text-slate-700">{{ $product->sku }}</strong></span>
                @endif

                <!-- Price Box -->
                <div class="p-4 sm:p-5 bg-surface-container-low rounded-2xl border border-outline-variant/25 flex flex-wrap items-baseline gap-4 mb-6">
                    <div>
                        <span class="text-xs text-on-surface-variant block mb-0.5">Estimasi Harga:</span>
                        <span class="text-2xl sm:text-3xl font-bold text-primary">{{ $product->formatted_price }}</span>
                    </div>
                    @if($product->formatted_discount_price)
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-outline line-through">{{ $product->formatted_discount_price }}</span>
                        <span class="text-xs font-bold text-amber-700 bg-amber-100 px-2.5 py-0.5 rounded-full">Diskon Khusus</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Short Excerpt Description -->
            @if($product->excerpt)
            <div class="space-y-2">
                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider block">Ringkasan Produk:</span>
                <p class="text-sm sm:text-base text-on-surface-variant leading-relaxed">
                    {{ $product->excerpt }}
                </p>
            </div>
            @endif

            <!-- Quick Indications Pills (if available) -->
            @if($product->has_medical_indications)
            <div class="p-4 rounded-2xl bg-teal-50/70 border border-teal-200/80 space-y-2">
                <span class="text-xs font-bold text-teal-900 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm text-teal-700">medical_services</span>
                    <span>Indikasi Medis Utama:</span>
                </span>
                <div class="prose prose-sm text-xs sm:text-sm text-teal-950 leading-relaxed">
                    {!! $product->medical_indications !!}
                </div>
            </div>
            @endif

            <!-- CTAs -->
            <div class="pt-4 border-t border-outline-variant/20 flex flex-col sm:flex-row gap-3.5">
                <a href="{{ $waUrl ?? 'https://wa.me/6285697922194?text=Halo%20pediOcare,%20saya%20tertarik%20dengan%20produk%20' . urlencode($product->name) }}" 
                   target="_blank" rel="noopener noreferrer"
                   class="flex-1 inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold h-13 py-3.5 rounded-xl shadow-md hover:shadow-lg transition gap-2">
                    <span class="material-symbols-outlined text-lg">chat</span> Pesan via WhatsApp
                </a>
                <a href="{{ route('contact') }}?product_id={{ $product->id }}" 
                   class="flex-1 inline-flex items-center justify-center bg-primary hover:bg-secondary text-white text-sm font-bold h-13 py-3.5 rounded-xl transition shadow-sm hover:shadow-md gap-2">
                    <span class="material-symbols-outlined text-lg">contacts</span> Konsultasi
                </a>
            </div>
        </div>

    </div>

    <!-- Bottom Detailed Medical Information (Tabs) -->
    <div class="bg-surface-white rounded-3xl border border-outline-variant/30 shadow-1 overflow-hidden" 
         x-data="{ activeTab: 'description' }">
        
        <!-- Tab Navigation Bar -->
        <div class="flex items-center border-b border-outline-variant/20 overflow-x-auto bg-surface-container-low px-4 sm:px-6">
            <button type="button" @click="activeTab = 'description'"
                    :class="activeTab === 'description' ? 'border-primary text-primary font-bold bg-surface-white' : 'border-transparent text-on-surface-variant hover:text-on-background font-medium'"
                    class="py-4 px-5 border-b-2 text-xs sm:text-sm flex items-center gap-2 whitespace-nowrap transition-all">
                <span class="material-symbols-outlined text-base">description</span>
                <span>Deskripsi Lengkap</span>
            </button>

            @if($product->has_medical_indications)
            <button type="button" @click="activeTab = 'indications'"
                    :class="activeTab === 'indications' ? 'border-primary text-primary font-bold bg-surface-white' : 'border-transparent text-on-surface-variant hover:text-on-background font-medium'"
                    class="py-4 px-5 border-b-2 text-xs sm:text-sm flex items-center gap-2 whitespace-nowrap transition-all">
                <span class="material-symbols-outlined text-base">vital_signs</span>
                <span>Indikasi Medis & Klinis</span>
            </button>
            @endif

            @if($product->has_specifications)
            <button type="button" @click="activeTab = 'specifications'"
                    :class="activeTab === 'specifications' ? 'border-primary text-primary font-bold bg-surface-white' : 'border-transparent text-on-surface-variant hover:text-on-background font-medium'"
                    class="py-4 px-5 border-b-2 text-xs sm:text-sm flex items-center gap-2 whitespace-nowrap transition-all">
                <span class="material-symbols-outlined text-base">tune</span>
                <span>Spesifikasi Material & Rangka</span>
            </button>
            @endif

            @if($product->has_size_chart)
            <button type="button" @click="activeTab = 'size_chart'"
                    :class="activeTab === 'size_chart' ? 'border-primary text-primary font-bold bg-surface-white' : 'border-transparent text-on-surface-variant hover:text-on-background font-medium'"
                    class="py-4 px-5 border-b-2 text-xs sm:text-sm flex items-center gap-2 whitespace-nowrap transition-all">
                <span class="material-symbols-outlined text-base">straighten</span>
                <span>Panduan Ukuran (Size Chart)</span>
            </button>
            @endif
        </div>

        <!-- Tab Content Panes -->
        <div class="p-6 sm:p-10">
            
            <!-- TAB 1: DESKRIPSI LENGKAP -->
            <div x-show="activeTab === 'description'" x-transition:enter="transition ease-out duration-300">
                <div class="space-y-4">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">menu_book</span>
                        <span>Penjelasan Detail & Cara Kerja Alat</span>
                    </h3>
                    <div class="prose prose-slate max-w-none text-sm sm:text-base text-on-surface-variant leading-relaxed">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>

            <!-- TAB 2: INDIKASI MEDIS -->
            @if($product->has_medical_indications)
            <div x-show="activeTab === 'indications'" x-transition:enter="transition ease-out duration-300">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-teal-700">medical_services</span>
                            <span>Indikasi Medis & Rekomendasi Penggunaan</span>
                        </h3>
                        <span class="text-xs text-teal-700 font-bold bg-teal-50 px-3 py-1 rounded-full border border-teal-200">Rekomendasi Dokter / Ortotis</span>
                    </div>

                    <div class="p-6 rounded-2xl bg-teal-50/40 border border-teal-100">
                        <div class="prose prose-slate max-w-none text-sm sm:text-base text-slate-800 leading-relaxed">
                            {!! $product->medical_indications !!}
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/20 text-xs text-on-surface-variant flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl shrink-0">info</span>
                        <span>Penggunaan alat medis ortotik & prostetik sebaiknya dikonsultasikan terlebih dahulu dengan dokter spesialis ortopedi, fisioterapis, atau ortotis prostetis berlisensi.</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- TAB 3: SPESIFIKASI MATERIAL -->
            @if($product->has_specifications)
            <div x-show="activeTab === 'specifications'" x-transition:enter="transition ease-out duration-300">
                <div class="space-y-5">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">layers</span>
                        <span>Spesifikasi Material & Komponen Teknis</span>
                    </h3>

                    @php
                        $specData = $product->specifications_data;
                    @endphp

                    @if(is_array($specData))
                    <!-- Key-Value Specifications Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($specData as $specKey => $specVal)
                        <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/20 flex flex-col justify-between">
                            <span class="text-xs font-bold text-primary uppercase tracking-wider mb-1">{{ $specKey }}</span>
                            <span class="text-sm font-semibold text-slate-900">{{ is_array($specVal) ? implode(', ', $specVal) : $specVal }}</span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <!-- Rich Text Specifications -->
                    <div class="prose prose-slate max-w-none text-sm sm:text-base text-on-surface-variant leading-relaxed">
                        {!! $specData !!}
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- TAB 4: PANDUAN UKURAN / SIZE CHART -->
            @if($product->has_size_chart)
            <div x-show="activeTab === 'size_chart'" x-transition:enter="transition ease-out duration-300">
                <div class="space-y-4">
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">straighten</span>
                        <span>Panduan Pengukuran Tubuh & Ukuran Produk</span>
                    </h3>
                    <div class="prose prose-slate max-w-none text-sm sm:text-base text-on-surface-variant leading-relaxed">
                        {!! $product->size_chart !!}
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

    <!-- Related Products -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <div class="space-y-6 pt-6">
        <div class="flex items-center justify-between">
            <h2 class="text-xl sm:text-2xl font-headline-xl font-bold text-on-background tracking-tight">
                Produk Medis Terkait
            </h2>
            <a href="{{ route('products.index', $product->category ? ['category' => $product->category->slug] : []) }}" 
               class="text-xs font-bold text-primary hover:text-secondary inline-flex items-center gap-1">
                <span>Lihat Semua</span>
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-4">
            @foreach($relatedProducts as $rel)
            <a href="{{ route('products.show', $rel->slug) }}" 
               class="bg-surface-white border border-outline-variant/30 hover:border-primary rounded-2xl sm:rounded-3xl p-2.5 sm:p-3 transition-all duration-300 group flex flex-col justify-between h-full shadow-2xs hover:shadow-md hover:-translate-y-1 relative">
                
                <!-- Inner Image Box (Lapakgaming style) -->
                <div class="relative w-full aspect-square rounded-xl sm:rounded-2xl bg-surface-container-low/70 border border-outline-variant/20 overflow-hidden flex items-center justify-center p-3 group-hover:bg-primary/5 transition-colors">
                    <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->name }}" 
                         class="w-full h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-300">
                    
                    @if($rel->category)
                    <div class="absolute bottom-2 left-2 max-w-[calc(100%-16px)]">
                        <span class="bg-primary/95 text-white font-bold text-[9px] sm:text-[10px] px-2 py-0.5 rounded-md shadow-2xs truncate block leading-tight">
                            {{ $rel->category->name }}
                        </span>
                    </div>
                    @endif
                </div>

                <div class="pt-2.5 pb-0.5 flex flex-col justify-between flex-grow space-y-2">
                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 line-clamp-1 group-hover:text-primary transition-colors leading-snug">
                        {{ $rel->name }}
                    </h4>
                    
                    <div class="flex items-center justify-between pt-1.5 border-t border-outline-variant/15 mt-auto gap-1">
                        <span class="text-xs sm:text-sm font-extrabold text-primary">{{ $rel->formatted_price }}</span>
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-lg bg-surface-container-low group-hover:bg-primary group-hover:text-white text-on-surface-variant flex items-center justify-center transition-colors shrink-0">
                            <span class="material-symbols-outlined text-[13px] sm:text-sm">arrow_forward</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>

<script>
const currentProductGallery = @json($galleryList);

function productImageGallery() {
    return {
        images: (Array.isArray(currentProductGallery) && currentProductGallery.length > 0) 
            ? currentProductGallery 
            : ['{{ $product->thumbnail_url }}'],
        currentIndex: 0,
        
        next() {
            if (this.images.length > 1) {
                this.currentIndex = (this.currentIndex + 1) % this.images.length;
            }
        },

        prev() {
            if (this.images.length > 1) {
                this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
            }
        },

        setIndex(idx) {
            this.currentIndex = idx;
        }
    };
}
</script>
@endsection
