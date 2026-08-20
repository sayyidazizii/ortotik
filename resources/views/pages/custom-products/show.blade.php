@extends('layouts.app')

@section('title', $product->name . ' - pediOcare')
@section('meta_description', $product->summary)

@section('content')

<!-- Sub-Nav Breadcrumb -->
<div class="bg-surface-white border-b border-outline-variant/30 py-3.5 px-4 sm:px-6 lg:px-8 text-xs text-on-surface-variant font-medium">
    <div class="max-w-container-max mx-auto flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <span class="text-outline-variant">/</span>
        <a href="{{ route('custom-products.index') }}" class="hover:text-primary transition-colors">Alur Pasien</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-semibold">{{ $product->name }}</span>
    </div>
</div>

<!-- Header Banner -->
<div class="bg-surface-container-low border-b border-outline-variant/30 py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-container-max mx-auto space-y-3">
        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-primary"></span>
            Fabrikasi Khusus Individual
        </span>
        <h1 class="text-2xl sm:text-3xl lg:text-[40px] font-headline-xl font-bold tracking-tight text-on-background leading-tight max-w-4xl">
            {{ $product->name }}
        </h1>
        <p class="text-on-surface-variant text-base sm:text-lg max-w-2xl leading-relaxed">
            {{ $product->summary }}
        </p>
    </div>
</div>

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 md:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- Left Main Content -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bg-surface-white rounded-3xl border border-outline-variant/30 p-8 sm:p-10 space-y-6 shadow-1">
                <div class="prose prose-slate max-w-none text-base text-on-surface-variant leading-relaxed space-y-4">
                    {!! $product->description !!}
                </div>

                @if($product->features && count($product->features) > 0)
                <div class="p-6 bg-surface-container-low rounded-2xl border border-outline-variant/30 space-y-3 mt-6">
                    <h3 class="font-headline-md font-semibold text-primary text-base uppercase tracking-wider">Spesifikasi Material & Komponen:</h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-sm text-on-surface">
                        @foreach($product->features as $feat)
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-base">check_circle</span>
                            <span>{{ $feat }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Workflow Timeline -->
            @if($product->workflow_steps && count($product->workflow_steps) > 0)
            <div class="bg-surface-white rounded-3xl border border-outline-variant/30 p-8 sm:p-10 space-y-6 shadow-1">
                <div class="border-b border-outline-variant/20 pb-4">
                    <span class="text-xs font-semibold text-primary uppercase tracking-wider block">Proses Fabrikasi Workshop</span>
                    <h3 class="text-xl font-bold text-on-background">Alur Pembuatan & Fitting Pasien</h3>
                </div>
                <div class="space-y-4">
                    @foreach($product->workflow_steps as $step)
                    <div class="p-6 bg-surface-container-low rounded-2xl border border-outline-variant/30 flex items-start gap-4">
                        <span class="w-10 h-10 rounded-2xl bg-primary text-surface-white font-bold text-base flex items-center justify-center shrink-0">
                            {{ $step['step'] ?? $loop->iteration }}
                        </span>
                        <div>
                            <h4 class="font-bold text-base text-on-background mb-1">{{ $step['title'] }}</h4>
                            <p class="text-xs text-on-surface-variant leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Right Sidebar -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-primary text-surface-white p-8 rounded-3xl space-y-4 text-center shadow-2">
                <span class="text-xs text-primary-fixed font-semibold uppercase tracking-wider block">Layanan Kustom</span>
                <h3 class="text-xl font-bold text-white">Jadwal Pengukuran & 3D Scanning</h3>
                <p class="text-xs text-white/80 leading-relaxed">Pemeriksaan fisik dan scanning 3D awal dapat dilakukan di klinik kami di Sleman, D.I. Yogyakarta.</p>
                <div class="pt-2 space-y-2.5">
                    <a href="{{ route('consultation.create') }}"
                        class="flex items-center justify-center w-full bg-[#E5A500] hover:bg-[#CC9200] text-surface-white text-xs font-semibold h-12 rounded-xl transition shadow-md">
                        <span>Isi Formulir Janji Temu</span>
                    </a>
                    <a href="https://wa.me/6285697922194?text=Halo%20pediOcare,%20saya%20tertarik%20pembuatan%20{{ urlencode($product->name) }}" target="_blank" rel="noopener noreferrer"
                        class="flex items-center justify-center w-full bg-surface-white/10 hover:bg-surface-white/20 text-white border border-surface-white/30 text-xs font-semibold h-12 rounded-xl transition">
                        <span>Tanya Estimasi via WA</span>
                    </a>
                </div>
            </div>

            <!-- Other Custom Products -->
            <div class="bg-surface-white rounded-3xl border border-outline-variant/30 p-6 space-y-3 shadow-1">
                <h4 class="text-xs font-bold uppercase tracking-wider text-primary">Produk Custom Lainnya</h4>
                <div class="space-y-1.5">
                    @foreach($allCustomProducts as $acp)
                    <a href="{{ route('custom-products.show', $acp->slug) }}"
                        class="block px-4 py-2.5 rounded-xl text-xs font-semibold transition {{ $acp->id === $product->id ? 'bg-primary text-white' : 'text-on-surface hover:bg-surface-container-low' }}">
                        {{ $acp->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
