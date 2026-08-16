@extends('layouts.app')

@section('title', $product->name . ' - Precision Orthotics & Prosthetics')
@section('meta_description', strip_tags($product->excerpt ?? $product->description))

@section('content')

<!-- Sub-Nav Breadcrumb -->
<div class="bg-canvas border-b border-hairline-soft py-3 px-4 sm:px-6 lg:px-8 text-xs text-mute font-medium">
    <div class="max-w-[1440px] mx-auto flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-ink">Beranda</a>
        <span>/</span>
        <a href="{{ route('products.index') }}" class="hover:text-ink">E-Katalog</a>
        <span>/</span>
        <span class="text-ink font-semibold">{{ $product->name }}</span>
    </div>
</div>

<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Left: PDP Gallery (Vertical Thumbnail Rail + Main 1:1 Image on soft-cloud) -->
        <div class="lg:col-span-7 flex flex-col-reverse sm:flex-row gap-4" x-data="{ mainImage: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=1000&q=85' }">
            <!-- Vertical Thumbnail Rail -->
            <div class="flex sm:flex-col gap-2 shrink-0 overflow-x-auto sm:overflow-visible">
                <button @click="mainImage = 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=1000&q=85'"
                    class="w-16 h-16 bg-soft-cloud border border-ink p-0.5 overflow-hidden shrink-0">
                    <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=200&q=80" class="w-full h-full object-cover">
                </button>
                <button @click="mainImage = 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=1000&q=85'"
                    class="w-16 h-16 bg-soft-cloud border border-hairline hover:border-ink p-0.5 overflow-hidden shrink-0 transition">
                    <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=200&q=80" class="w-full h-full object-cover">
                </button>
                <button @click="mainImage = 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1000&q=85'"
                    class="w-16 h-16 bg-soft-cloud border border-hairline hover:border-ink p-0.5 overflow-hidden shrink-0 transition">
                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=200&q=80" class="w-full h-full object-cover">
                </button>
            </div>

            <!-- Main Product Image (1:1 aspect ratio on soft-cloud) -->
            <div class="relative bg-soft-cloud aspect-square w-full flex items-center justify-center overflow-hidden">
                <img :src="mainImage" alt="{{ $product->name }}" class="w-full h-full object-cover">
                <span class="absolute top-4 left-4 bg-canvas border border-hairline text-ink text-xs font-semibold px-3 py-1 rounded-full shadow-xs">
                    {{ $product->category->name ?? 'Ortotik Medis' }}
                </span>
            </div>
        </div>

        <!-- Right: Product Purchase & Information Details -->
        <div class="lg:col-span-5 space-y-6">
            <div>
                <!-- Category Subtitle ({typography.caption-md} mute) -->
                <span class="text-xs font-semibold text-mute uppercase tracking-widest block mb-1">
                    {{ $product->category->name ?? 'Alat Bantu Ortopedi' }} &bull; Ready Stock
                </span>

                <!-- Product Name ({typography.heading-xl}: 32px 500) -->
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-ink uppercase font-sans leading-tight">
                    {{ $product->name }}
                </h1>

                <!-- SKU & Rating Snippet -->
                @if($product->sku)
                <p class="text-xs text-mute mt-1 font-mono">Kode SKU: {{ $product->sku }}</p>
                @endif
            </div>

            <!-- Price Row ({typography.heading-lg}: 24px 500) -->
            <div class="flex items-baseline gap-3 pb-4 border-b border-hairline-soft">
                <span class="text-2xl font-bold text-ink">{{ $product->formatted_price }}</span>
                @if($product->formatted_discount_price)
                <span class="text-sm text-mute line-through">{{ $product->formatted_discount_price }}</span>
                <span class="text-xs font-bold text-sale">Diskon Promo</span>
                @endif
            </div>

            <!-- Swatch Picker (Concentric active ring) -->
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase text-ink tracking-wider block">Pilihan Varian / Ukuran:</label>
                <div class="flex items-center gap-2">
                    <span class="w-5 h-5 rounded-full bg-ink ring-2 ring-ink ring-offset-2 cursor-pointer"></span>
                    <span class="w-5 h-5 rounded-full bg-mute ring-1 ring-hairline cursor-pointer"></span>
                    <span class="w-5 h-5 rounded-full bg-hairline-soft ring-1 ring-hairline cursor-pointer"></span>
                </div>
            </div>

            <!-- Excerpt -->
            <p class="text-xs text-mute font-normal leading-relaxed">
                {{ $product->excerpt ?? strip_tags($product->description) }}
            </p>

            <!-- Two-Tone CTA Hierarchy ({component.button-primary} vs {component.button-secondary}) -->
            <div class="space-y-3 pt-2">
                <!-- Primary Action: Black Pill -->
                <a href="{{ $waUrl }}" target="_blank"
                    class="w-full flex items-center justify-center bg-ink hover:bg-charcoal text-canvas text-sm font-medium h-12 rounded-full btn-pill-tap shadow-lg transition">
                    <i data-lucide="message-circle" class="w-4 h-4 mr-2"></i>
                    <span>Order / Konsultasi via WhatsApp</span>
                </a>

                <!-- Secondary Action: Soft Cloud Pill -->
                <a href="{{ route('consultation.create') }}?medical_service_id={{ $product->medical_service_id }}"
                    class="w-full flex items-center justify-center bg-soft-cloud hover:bg-hairline-soft text-ink text-sm font-medium h-12 rounded-full btn-pill-tap transition">
                    <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                    <span>Jadwalkan Fitting di Klinik</span>
                </a>
            </div>

            <!-- Service Guarantee Icons -->
            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-hairline-soft text-xs text-mute font-medium">
                <div class="flex items-center gap-2">
                    <i data-lucide="shield-check" class="w-4 h-4 text-ink shrink-0"></i>
                    <span>100% Standar Medis Kemenkes</span>
                </div>
                <div class="flex items-center gap-2">
                    <i data-lucide="refresh-cw" class="w-4 h-4 text-ink shrink-0"></i>
                    <span>Garansi Penyetelan Pas</span>
                </div>
            </div>

            <!-- Stacked PDP Disclosure Accordions ({component.pdp-disclosure-row}) -->
            <div class="divide-y divide-hairline pt-4">
                <!-- Disclosure 1 -->
                <div class="py-4" x-data="{ open: true }">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-sm font-bold text-ink uppercase tracking-wider">Deskripsi & Fitur Medis</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-ink transition transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" class="text-xs text-mute leading-relaxed pt-3">
                        {!! $product->description !!}
                    </div>
                </div>

                <!-- Disclosure 2 -->
                <div class="py-4" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-sm font-bold text-ink uppercase tracking-wider">Indikasi Penanganan Medis</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-ink transition transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="text-xs text-mute leading-relaxed pt-3">
                        {{ $product->medical_indications ?? 'Indikasi cedera sendi, immobilisasi ortopedi, pasca operasi bedah tulang, atau pemulihan kelainan postur.' }}
                    </div>
                </div>

                <!-- Disclosure 3 -->
                <div class="py-4" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-sm font-bold text-ink uppercase tracking-wider">Spesifikasi Material & Komponen</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-ink transition transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="text-xs text-mute leading-relaxed pt-3">
                        @if($product->specifications && is_array($product->specifications))
                        <div class="space-y-1.5">
                            @foreach($product->specifications as $key => $val)
                            <div class="flex justify-between py-1 border-b border-hairline-soft">
                                <span class="font-semibold text-ink">{{ $key }}:</span>
                                <span>{{ $val }}</span>
                            </div>
                            @endforeach
                        </div>
                        @else
                        Material medis komposit berkualitas tinggi, breathable, ergonomis, dan tahan lama untuk aktivitas harian.
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Related Products 4-up Grid -->
    @if($relatedProducts->isNotEmpty())
    <div class="mt-16 pt-12 border-t border-hairline-soft">
        <h3 class="text-2xl font-medium tracking-tight text-ink uppercase font-sans mb-6">
            Produk Terkait Lainnya
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
            @foreach($relatedProducts as $rel)
            <div class="bg-canvas border border-hairline-soft p-0 flex flex-col justify-between group">
                <div>
                    <div class="relative bg-soft-cloud aspect-square flex items-center justify-center overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=400&q=80" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-4 space-y-1">
                        <h4 class="text-sm font-medium text-ink leading-snug line-clamp-1">
                            <a href="{{ route('products.show', $rel->slug) }}">{{ $rel->name }}</a>
                        </h4>
                        <span class="text-sm font-bold text-ink block">{{ $rel->formatted_price }}</span>
                    </div>
                </div>
                <div class="p-4 pt-0">
                    <a href="{{ route('products.show', $rel->slug) }}" class="flex items-center justify-center bg-soft-cloud hover:bg-hairline-soft text-ink text-xs font-medium h-9 rounded-full btn-pill-tap transition">
                        Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

@endsection
