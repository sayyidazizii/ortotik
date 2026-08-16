@extends('layouts.app')

@section('title', $product->name . ' - Precision Orthotics & Prosthetics')
@section('meta_description', strip_tags($product->excerpt ?? $product->description))

@section('content')

<!-- Sub-Nav Breadcrumb -->
<div class="bg-cappuccino border-b border-border py-3 px-4 sm:px-6 lg:px-8 text-xs text-tertiary font-medium font-sans">
    <div class="max-w-[1360px] mx-auto flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
        <span>/</span>
        <a href="{{ route('products.index') }}" class="hover:text-primary">E-Katalog</a>
        <span>/</span>
        <span class="text-primary font-semibold">{{ $product->name }}</span>
    </div>
</div>

<div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
        
        <!-- Left: PDP Gallery -->
        <div class="lg:col-span-7 flex flex-col-reverse sm:flex-row gap-4" x-data="{ mainImage: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=1000&q=85' }">
            <!-- Vertical Thumbnail Rail -->
            <div class="flex sm:flex-col gap-2 shrink-0 overflow-x-auto sm:overflow-visible">
                <button @click="mainImage = 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=1000&q=85'"
                    class="w-20 h-20 bg-cappuccino border-2 border-primary rounded-2xl overflow-hidden shrink-0 shadow-2xs">
                    <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=200&q=80" class="w-full h-full object-cover">
                </button>
                <button @click="mainImage = 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=1000&q=85'"
                    class="w-20 h-20 bg-cappuccino border border-border hover:border-primary rounded-2xl overflow-hidden shrink-0 transition">
                    <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=200&q=80" class="w-full h-full object-cover">
                </button>
                <button @click="mainImage = 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1000&q=85'"
                    class="w-20 h-20 bg-cappuccino border border-border hover:border-primary rounded-2xl overflow-hidden shrink-0 transition">
                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=200&q=80" class="w-full h-full object-cover">
                </button>
            </div>

            <!-- Main Product Image -->
            <div class="relative bg-cappuccino aspect-square w-full rounded-3xl border border-border flex items-center justify-center overflow-hidden shadow-2xs">
                <img :src="mainImage" alt="{{ $product->name }}" class="w-full h-full object-cover">
                <span class="absolute top-4 left-4 bg-white/95 text-secondary text-xs font-semibold px-4 py-1.5 rounded-full border border-border shadow-2xs">
                    {{ $product->category->name ?? 'Ortotik Medis' }}
                </span>
            </div>
        </div>

        <!-- Right: Product Information Details -->
        <div class="lg:col-span-5 space-y-7">
            <div class="space-y-4">
                <div>
                    <span class="text-xs font-semibold text-terracotta uppercase tracking-wider block mb-1">
                        {{ $product->category->name ?? 'Alat Bantu Ortopedi' }} &bull; Ready Stock
                    </span>

                    <h1 class="text-3xl sm:text-4xl font-serif font-medium tracking-tight text-primary leading-tight">
                        {{ $product->name }}
                    </h1>

                    @if($product->sku)
                    <p class="text-xs text-tertiary mt-1 font-mono">Kode SKU: {{ $product->sku }}</p>
                    @endif
                </div>

                <!-- Price Row -->
                <div class="flex items-baseline gap-3 pb-4 border-b border-border">
                    <span class="text-3xl font-serif font-semibold text-primary">{{ $product->formatted_price }}</span>
                    @if($product->formatted_discount_price)
                    <span class="text-sm text-tertiary line-through">{{ $product->formatted_discount_price }}</span>
                    <span class="text-xs font-semibold text-terracotta">Diskon Promo</span>
                    @endif
                </div>

                <!-- Excerpt -->
                <p class="text-sm sm:text-base text-secondary/80 font-light leading-relaxed">
                    {{ $product->excerpt ?? strip_tags($product->description) }}
                </p>

                <!-- Two-Tone Action Buttons (Maven Clinic Style) -->
                <div class="space-y-3 pt-3">
                    <a href="{{ $waUrl }}" target="_blank"
                        class="w-full flex items-center justify-center bg-terracotta hover:bg-terracotta-dark text-white text-base font-semibold h-14 rounded-full btn-maven shadow-xs transition">
                        <i data-lucide="message-circle" class="w-5 h-5 mr-2.5"></i>
                        <span>Order / Konsultasi via WhatsApp</span>
                    </a>

                    <a href="{{ route('consultation.create') }}?medical_service_id={{ $product->medical_service_id }}"
                        class="w-full flex items-center justify-center bg-white hover:bg-cappuccino text-primary text-sm font-semibold h-14 rounded-full btn-maven border border-border transition">
                        <i data-lucide="calendar" class="w-4 h-4 mr-2 text-primary"></i>
                        <span>Jadwalkan Fitting di Klinik</span>
                    </a>
                </div>

                <!-- Guarantees -->
                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-border text-xs text-tertiary font-medium">
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="shield-check" class="w-4 h-4 text-primary shrink-0"></i>
                        <span>100% Standar Medis Kemenkes</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <i data-lucide="refresh-cw" class="w-4 h-4 text-primary shrink-0"></i>
                        <span>Garansi Penyetelan Pas</span>
                    </div>
                </div>
            </div>

            <!-- Disclosure Accordions -->
            <div class="border-t border-b border-border divide-y divide-border bg-white rounded-3xl p-6 shadow-2xs">
                <!-- Disclosure 1 -->
                <div class="py-4 first:pt-0 last:pb-0" x-data="{ open: true }">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-base font-serif font-medium text-primary">Deskripsi & Fitur Medis</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-terracotta transition transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" class="text-sm text-secondary/80 font-light leading-relaxed pt-3">
                        {!! $product->description !!}
                    </div>
                </div>

                <!-- Disclosure 2 -->
                <div class="py-4 first:pt-0 last:pb-0" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-base font-serif font-medium text-primary">Indikasi Penanganan Medis</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-terracotta transition transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="text-sm text-secondary/80 font-light leading-relaxed pt-3">
                        {{ $product->medical_indications ?? 'Indikasi cedera sendi, immobilisasi ortopedi, pasca operasi bedah tulang, atau pemulihan kelainan postur.' }}
                    </div>
                </div>

                <!-- Disclosure 3 -->
                <div class="py-4 first:pt-0 last:pb-0" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                        <span class="text-base font-serif font-medium text-primary">Spesifikasi Material & Komponen</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-terracotta transition transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="text-sm text-secondary/80 font-light leading-relaxed pt-3">
                        @if($product->specifications && is_array($product->specifications))
                        <div class="space-y-2">
                            @foreach($product->specifications as $key => $val)
                            <div class="flex justify-between py-1.5 border-b border-border">
                                <span class="font-medium text-primary">{{ $key }}:</span>
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

    <!-- Related Products Grid -->
    @if($relatedProducts->isNotEmpty())
    <div class="mt-20 pt-12 border-t border-border">
        <h3 class="text-2xl sm:text-3xl font-serif font-medium tracking-tight text-primary mb-8">
            Produk Terkait Lainnya
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $rel)
            <div class="bg-white rounded-3xl border border-border overflow-hidden flex flex-col justify-between hover:border-primary/40 hover:shadow-md transition duration-300 group">
                <div>
                    <div class="relative bg-cappuccino aspect-square flex items-center justify-center overflow-hidden border-b border-border">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=400&q=80" alt="{{ $rel->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 space-y-1">
                        <h4 class="text-base font-serif font-medium text-primary leading-snug line-clamp-1 group-hover:text-terracotta">
                            <a href="{{ route('products.show', $rel->slug) }}">{{ $rel->name }}</a>
                        </h4>
                        <span class="text-base font-serif font-semibold text-primary block">{{ $rel->formatted_price }}</span>
                    </div>
                </div>
                <div class="p-5 pt-0">
                    <a href="{{ route('products.show', $rel->slug) }}" class="flex items-center justify-center bg-cappuccino hover:bg-cappuccino-deep text-secondary text-xs font-semibold h-10 rounded-full btn-maven border border-border transition">
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
