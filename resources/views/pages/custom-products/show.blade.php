@extends('layouts.app')

@section('title', $product->name . ' - Custom-Made P&O - Precision Orthotics & Prosthetics')
@section('meta_description', $product->summary)

@section('content')

<!-- Sub-Nav Breadcrumb -->
<div class="bg-cappuccino border-b border-border py-3 px-4 sm:px-6 lg:px-8 text-xs text-tertiary font-medium font-sans">
    <div class="max-w-[1360px] mx-auto flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
        <span>/</span>
        <a href="{{ route('custom-products.index') }}" class="hover:text-primary">Custom-Made</a>
        <span>/</span>
        <span class="text-primary font-semibold">{{ $product->name }}</span>
    </div>
</div>

<!-- Header Banner -->
<div class="bg-cappuccino border-b border-border py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1360px] mx-auto">
        <span class="text-xs text-terracotta font-semibold uppercase tracking-wider block mb-2 font-sans">CUSTOM FABRICATION ARCHITECTURE</span>
        <h1 class="text-3xl sm:text-4xl lg:text-[46px] font-serif font-medium tracking-tight text-primary leading-tight max-w-4xl">
            {{ $product->name }}
        </h1>
        <p class="text-secondary/80 text-base sm:text-lg mt-3 max-w-2xl leading-relaxed font-light">
            {{ $product->summary }}
        </p>
    </div>
</div>

<div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- Left Main Content -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bg-white rounded-3xl border border-border p-8 sm:p-10 space-y-6 shadow-2xs">
                <div class="prose prose-slate max-w-none text-base text-secondary/85 leading-relaxed space-y-4 font-light">
                    {!! $product->description !!}
                </div>

                @if($product->features && count($product->features) > 0)
                <div class="p-6 bg-cappuccino rounded-2xl border border-border space-y-3">
                    <h3 class="font-serif font-medium text-primary text-base uppercase tracking-wider">Spesifikasi Material & Komponen Khusus:</h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs text-secondary/80 font-normal">
                        @foreach($product->features as $feat)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-terracotta shrink-0"></span>
                            <span>{{ $feat }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Workflow Timeline -->
            @if($product->workflow_steps && count($product->workflow_steps) > 0)
            <div class="bg-white rounded-3xl border border-border p-8 sm:p-10 space-y-6 shadow-2xs">
                <div class="border-b border-border pb-4">
                    <span class="text-xs text-terracotta font-semibold uppercase tracking-wider block font-sans">PROSES FABRIKASI WORKSHOP</span>
                    <h3 class="text-2xl font-serif font-medium text-primary">Alur Pembuatan & Fitting Alat</h3>
                </div>
                <div class="space-y-4">
                    @foreach($product->workflow_steps as $step)
                    <div class="p-6 bg-cappuccino rounded-2xl border border-border flex items-start gap-4">
                        <span class="w-10 h-10 rounded-full bg-mint text-primary font-serif font-bold text-base flex items-center justify-center shrink-0">
                            {{ $step['step'] ?? $loop->iteration }}
                        </span>
                        <div>
                            <h4 class="font-serif font-medium text-base text-primary mb-1">{{ $step['title'] }}</h4>
                            <p class="text-xs text-tertiary font-light leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Right Sidebar -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-primary text-cappuccino p-8 rounded-3xl space-y-4 text-center shadow-xs">
                <span class="text-xs text-mint font-semibold uppercase tracking-wider block font-sans">Layanan Kustom</span>
                <h3 class="text-2xl font-serif font-medium text-white">Jadwal Pengukuran & 3D Scanning</h3>
                <p class="text-xs text-cappuccino/80 leading-relaxed font-light">Pemeriksaan fisik dan scanning 3D awal dapat dilakukan di klinik cabang Jakarta atau Surabaya.</p>
                <div class="pt-2 space-y-2.5">
                    <a href="{{ route('consultation.create') }}"
                        class="flex items-center justify-center w-full bg-terracotta hover:bg-terracotta-dark text-white text-xs font-semibold h-12 rounded-full btn-maven transition">
                        <span>Isi Formulir Janji Temu</span>
                    </a>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20tertarik%20pembuatan%20{{ urlencode($product->name) }}" target="_blank"
                        class="flex items-center justify-center w-full bg-white/10 hover:bg-white/20 text-white border border-white/30 text-xs font-semibold h-12 rounded-full btn-maven transition">
                        <span>Tanya Estimasi via WA</span>
                    </a>
                </div>
            </div>

            <!-- Other Custom Products -->
            <div class="bg-white rounded-3xl border border-border p-6 space-y-3 shadow-2xs">
                <h4 class="text-xs font-serif font-semibold uppercase tracking-wider text-primary">Produk Custom Lainnya</h4>
                <div class="space-y-1.5 font-sans">
                    @foreach($allCustomProducts as $acp)
                    <a href="{{ route('custom-products.show', $acp->slug) }}"
                        class="block px-4 py-2.5 rounded-full text-xs font-semibold transition {{ $acp->id === $product->id ? 'bg-primary text-white font-semibold' : 'text-secondary hover:bg-cappuccino' }}">
                        {{ $acp->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
