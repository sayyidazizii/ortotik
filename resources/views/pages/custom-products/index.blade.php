@extends('layouts.app')

@section('title', 'Alur & Katalog Produk Custom-Made P&O - Precision Orthotics & Prosthetics')
@section('meta_description', 'Dirancang dan diproduksi secara individual mengikuti anatomi dan kebutuhan biomekanik setiap pasien.')

@section('content')

<!-- Header Banner -->
<div class="bg-cappuccino border-b border-border py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1360px] mx-auto text-center space-y-3">
        <span class="text-xs text-terracotta font-semibold uppercase tracking-wider block font-sans">INDIVIDUAL CUSTOM FABRICATION</span>
        <h1 class="text-3xl sm:text-4xl lg:text-[46px] font-serif font-medium tracking-tight text-primary leading-tight">
            Produk Custom-Made Ortotik & Prostetik
        </h1>
        <p class="text-secondary/80 text-base sm:text-lg max-w-xl mx-auto leading-relaxed font-light">
            Dirancang dan diproduksi secara individual mengikuti anatomi dan kebutuhan biomekanik setiap pasien dengan garansi fitting 100%.
        </p>
    </div>
</div>

<!-- Workflow Steps Section -->
<section class="py-16 bg-cappuccino-light border-b border-border">
    <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-12">
            <h2 class="text-2xl sm:text-3xl font-serif font-medium tracking-tight text-primary">
                4 Tahapan Pembuatan Produk Custom-Made
            </h2>
            <p class="text-tertiary text-sm mt-1.5 font-light">Standar fabrikasi presisi untuk memastikan fitting pas, tanpa rasa nyeri tekan, dan kenyamanan optimal.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-7 rounded-3xl border border-border flex flex-col justify-between shadow-2xs">
                <div>
                    <span class="w-12 h-12 rounded-full bg-mint text-primary font-serif font-bold text-base flex items-center justify-center mb-5">01</span>
                    <h3 class="text-base font-serif font-medium text-primary mb-1.5">Konsultasi & Scan 3D</h3>
                    <p class="text-xs text-tertiary font-light leading-relaxed">Evaluasi biomekanik dan pengukuran non-invasif dengan pemindai 3D optik presisi.</p>
                </div>
            </div>
            <div class="bg-white p-7 rounded-3xl border border-border flex flex-col justify-between shadow-2xs">
                <div>
                    <span class="w-12 h-12 rounded-full bg-mint text-primary font-serif font-bold text-base flex items-center justify-center mb-5">02</span>
                    <h3 class="text-base font-serif font-medium text-primary mb-1.5">Desain CAD & Cetak</h3>
                    <p class="text-xs text-tertiary font-light leading-relaxed">Pemodelan digital komputerisasi dan fabrikasi soket berbahan carbon fiber.</p>
                </div>
            </div>
            <div class="bg-white p-7 rounded-3xl border border-border flex flex-col justify-between shadow-2xs">
                <div>
                    <span class="w-12 h-12 rounded-full bg-mint text-primary font-serif font-bold text-base flex items-center justify-center mb-5">03</span>
                    <h3 class="text-base font-serif font-medium text-primary mb-1.5">Dynamic Fitting</h3>
                    <p class="text-xs text-tertiary font-light leading-relaxed">Pemasangan alat, uji jalan dinamis, dan penyetelan titik tekan sudut anatomi.</p>
                </div>
            </div>
            <div class="bg-white p-7 rounded-3xl border border-border flex flex-col justify-between shadow-2xs">
                <div>
                    <span class="w-12 h-12 rounded-full bg-mint text-primary font-serif font-bold text-base flex items-center justify-center mb-5">04</span>
                    <h3 class="text-base font-serif font-medium text-primary mb-1.5">Gait Training & Garansi</h3>
                    <p class="text-xs text-tertiary font-light leading-relaxed">Latihan mandiri bersama fisioterapis dan garansi penyesuaian berkala.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom Products Grid -->
<div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($customProducts as $cp)
        <div class="bg-white rounded-3xl border border-border p-8 flex flex-col justify-between hover:border-primary/40 hover:shadow-md transition duration-300 group">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase px-3.5 py-1 bg-mint text-primary rounded-full border border-primary/20">Custom-Made</span>
                    <span class="text-xs text-tertiary font-medium">Garansi Fitting 100%</span>
                </div>
                
                <h3 class="text-2xl font-serif font-medium text-primary group-hover:text-terracotta transition leading-snug">
                    <a href="{{ route('custom-products.show', $cp->slug) }}">{{ $cp->name }}</a>
                </h3>

                <p class="text-sm text-secondary/80 font-light leading-relaxed">{{ $cp->summary }}</p>

                @if($cp->features && count($cp->features) > 0)
                <div class="p-5 bg-cappuccino rounded-2xl border border-border space-y-2.5">
                    <span class="text-xs font-serif font-semibold text-primary uppercase tracking-wider block">Fitur & Keunggulan Desain:</span>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-secondary/80 font-normal">
                        @foreach($cp->features as $f)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-terracotta shrink-0"></span>
                            <span>{{ $f }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="mt-8 pt-5 border-t border-border grid grid-cols-2 gap-3">
                <a href="{{ route('custom-products.show', $cp->slug) }}" class="flex items-center justify-center bg-cappuccino hover:bg-cappuccino-deep text-secondary text-xs font-semibold h-11 rounded-full btn-maven border border-border transition">
                    Lihat Tahapan
                </a>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20ingin%20konsultasi%20pembuatan%20custom%20{{ urlencode($cp->name) }}" target="_blank"
                    class="flex items-center justify-center bg-terracotta hover:bg-terracotta-dark text-white text-xs font-semibold h-11 rounded-full btn-maven transition">
                    Konsultasi WA
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
