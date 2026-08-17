@extends('layouts.app')

@section('title', $product->name . ' - PT. Orthocare Indonesia')
@section('meta_description', strip_tags($product->excerpt ?? $product->description))

@section('content')

<!-- Sub-Nav Breadcrumb -->
<div class="bg-surface-white border-b border-outline-variant/30 py-3.5 px-4 sm:px-6 lg:px-8 text-xs text-on-surface-variant font-medium">
    <div class="max-w-container-max mx-auto flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <span class="text-outline-variant">/</span>
        <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors">E-Katalog</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-semibold">{{ $product->name }}</span>
    </div>
</div>

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 md:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14">
        
        <!-- Left: Product Image -->
        <div class="lg:col-span-6 space-y-4">
            <div class="relative bg-surface-container-low aspect-square w-full rounded-3xl border border-outline-variant/30 flex items-center justify-center overflow-hidden shadow-1 p-8">
                @if($product->thumbnail)
                <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" class="w-full h-full object-contain mix-blend-multiply drop-shadow-md">
                @else
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBRX96KTlDSHiomGN3OyOvDA8gmpFo6nH9DuQJ13zV-uwYj0On4T643XIIvI7ZfTgEHlGNMCnzLWygdnoChDtXh3HKQ3iKaxsBs2SXt9HZXR5pM7Qtw8KzFBwh-xAkBI6kBHJNij2YKEAiHE2MhApvaIyUSmfo0V7MtHqYRgFzaU3IRMw5FPuoduXReXEcCNbLjLVDm5pEO5HM2XWxQXW-P6GZ1bJoBKdVpdMOPdViOhKinS3glyd4" 
                     alt="{{ $product->name }}" class="w-full h-full object-contain mix-blend-multiply drop-shadow-md">
                @endif
                <span class="absolute top-4 left-4 bg-surface-white text-primary text-xs font-semibold px-4 py-1.5 rounded-full border border-outline-variant/30 shadow-2xs">
                    {{ $product->category->name ?? 'Ortotik Medis' }}
                </span>
            </div>
        </div>

        <!-- Right: Product Information Details -->
        <div class="lg:col-span-6 space-y-6">
            <div>
                <span class="text-xs font-semibold text-primary uppercase tracking-wider block mb-2">
                    {{ $product->category->name ?? 'Alat Bantu Ortopedi' }} &bull; Ready Stock
                </span>

                <h1 class="text-2xl sm:text-3xl font-headline-xl font-bold tracking-tight text-on-background leading-tight mb-3">
                    {{ $product->name }}
                </h1>

                @if($product->sku)
                <span class="text-xs text-on-surface-variant block mb-4">SKU: {{ $product->sku }}</span>
                @endif

                <!-- Price Row -->
                <div class="p-4 bg-surface-container-low rounded-2xl border border-outline-variant/20 flex items-baseline gap-4 mb-6">
                    <span class="text-2xl sm:text-3xl font-bold text-primary">{{ $product->formatted_price }}</span>
                    @if($product->formatted_discount_price)
                    <span class="text-sm text-outline line-through">{{ $product->formatted_discount_price }}</span>
                    <span class="text-xs font-bold text-[#E5A500] bg-[#E5A500]/10 px-2 py-0.5 rounded">Diskon Khusus</span>
                    @endif
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-3">
                <h3 class="text-sm font-semibold text-on-background">Deskripsi Produk</h3>
                <div class="prose text-sm text-on-surface-variant leading-relaxed">
                    {!! $product->description !!}
                </div>
            </div>

            <!-- Specifications / Features if any -->
            @if($product->features && is_array($product->features))
            <div class="space-y-3 pt-2">
                <h3 class="text-sm font-semibold text-on-background">Fitur Utama:</h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-on-surface-variant">
                    @foreach($product->features as $feature)
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-base">check_circle</span>
                        <span>{{ $feature }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- CTAs -->
            <div class="pt-6 border-t border-outline-variant/20 flex flex-col sm:flex-row gap-4">
                <a href="https://wa.me/6281234567890?text=Halo%20PT.%20Orthocare%20Indonesia,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}." target="_blank" rel="noopener noreferrer"
                   class="flex-1 inline-flex items-center justify-center bg-primary hover:bg-secondary text-surface-white text-sm font-semibold h-13 py-3.5 rounded-xl shadow-md transition gap-2">
                    <span class="material-symbols-outlined text-lg">chat</span> Pesan via WhatsApp
                </a>
                <a href="{{ route('consultation.create') }}" 
                   class="flex-1 inline-flex items-center justify-center bg-surface-container-low hover:bg-surface-container-high text-primary border border-outline-variant/30 text-sm font-semibold h-13 py-3.5 rounded-xl transition">
                    Konsultasi Ukuran
                </a>
            </div>

            <!-- Trust Badge Box -->
            <div class="p-4 rounded-2xl bg-surface-white border border-outline-variant/30 flex items-center gap-4 text-xs text-on-surface-variant">
                <span class="material-symbols-outlined text-primary text-2xl">verified</span>
                <div>
                    <strong class="text-on-background block font-semibold">100% Produk Original Medis</strong>
                    <span>Material hypo-allergenic berstandar internasional dengan garansi fitting.</span>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
