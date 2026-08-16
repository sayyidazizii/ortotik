@extends('layouts.app')

@section('title', 'Alur & Katalog Produk Custom-Made P&O - Precision Orthotics & Prosthetics')
@section('meta_description', 'Dirancang dan diproduksi secara individual mengikuti anatomi dan kebutuhan biomekanik setiap pasien.')

@section('content')

<!-- Header Banner -->
<div class="bg-canvas border-b border-hairline-soft py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1440px] mx-auto text-center space-y-2">
        <span class="text-xs text-mute font-semibold uppercase tracking-widest block">Individual Custom Fabrication</span>
        <h1 class="text-3xl sm:text-5xl font-medium tracking-tight text-ink uppercase font-sans">
            Produk Custom-Made Ortotik & Prostetik
        </h1>
        <p class="text-mute text-sm max-w-xl mx-auto leading-relaxed">
            Dirancang dan diproduksi secara individual mengikuti anatomi dan kebutuhan biomekanik setiap pasien dengan garansi fitting 100%.
        </p>
    </div>
</div>

<!-- Workflow Steps Section -->
<section class="py-12 bg-soft-cloud border-b border-hairline-soft">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-8">
            <h2 class="text-2xl font-medium tracking-tight text-ink uppercase font-sans">
                4 Tahapan Pembuatan Produk Custom-Made
            </h2>
            <p class="text-mute text-xs mt-1">Standar fabrikasi presisi untuk memastikan fitting pas, tanpa rasa nyeri tekan, dan kenyamanan optimal.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-canvas p-6 border border-hairline-soft flex flex-col justify-between">
                <div>
                    <span class="text-2xl font-display text-ink block mb-2">01</span>
                    <h3 class="text-sm font-bold text-ink mb-1">Konsultasi & Scan 3D</h3>
                    <p class="text-xs text-mute leading-relaxed">Evaluasi biomekanik dan pengukuran non-invasif dengan pemindai 3D optik presisi.</p>
                </div>
            </div>
            <div class="bg-canvas p-6 border border-hairline-soft flex flex-col justify-between">
                <div>
                    <span class="text-2xl font-display text-ink block mb-2">02</span>
                    <h3 class="text-sm font-bold text-ink mb-1">Desain CAD & Cetak</h3>
                    <p class="text-xs text-mute leading-relaxed">Pemodelan digital komputerisasi dan fabrikasi soket berbahan carbon fiber.</p>
                </div>
            </div>
            <div class="bg-canvas p-6 border border-hairline-soft flex flex-col justify-between">
                <div>
                    <span class="text-2xl font-display text-ink block mb-2">03</span>
                    <h3 class="text-sm font-bold text-ink mb-1">Dynamic Fitting</h3>
                    <p class="text-xs text-mute leading-relaxed">Pemasangan alat, uji jalan dinamis, dan penyetelan titik tekan sudut anatomi.</p>
                </div>
            </div>
            <div class="bg-canvas p-6 border border-hairline-soft flex flex-col justify-between">
                <div>
                    <span class="text-2xl font-display text-ink block mb-2">04</span>
                    <h3 class="text-sm font-bold text-ink mb-1">Gait Training & Garansi</h3>
                    <p class="text-xs text-mute leading-relaxed">Latihan mandiri bersama fisioterapis dan garansi penyesuaian berkala.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom Products Grid -->
<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($customProducts as $cp)
        <div class="bg-canvas border border-hairline-soft p-8 flex flex-col justify-between group">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold uppercase px-3 py-1 bg-soft-cloud text-ink rounded-full border border-hairline-soft">Custom-Made</span>
                    <span class="text-xs text-mute font-medium">Garansi Fitting 100%</span>
                </div>
                
                <h3 class="text-2xl font-bold text-ink uppercase tracking-tight group-hover:text-mute transition leading-snug">
                    <a href="{{ route('custom-products.show', $cp->slug) }}">{{ $cp->name }}</a>
                </h3>

                <p class="text-xs text-mute leading-relaxed">{{ $cp->summary }}</p>

                @if($cp->features && count($cp->features) > 0)
                <div class="p-4 bg-soft-cloud border border-hairline-soft space-y-2">
                    <span class="text-xs font-semibold text-ink uppercase tracking-wider block">Fitur & Keunggulan Desain:</span>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 text-xs text-mute font-medium">
                        @foreach($cp->features as $f)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-ink shrink-0"></span>
                            <span>{{ $f }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="mt-8 pt-4 border-t border-hairline-soft grid grid-cols-2 gap-2">
                <a href="{{ route('custom-products.show', $cp->slug) }}" class="flex items-center justify-center bg-soft-cloud hover:bg-hairline-soft text-ink text-xs font-medium h-10 rounded-full btn-pill-tap transition">
                    Lihat Tahapan
                </a>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20ingin%20konsultasi%20pembuatan%20custom%20{{ urlencode($cp->name) }}" target="_blank"
                    class="flex items-center justify-center bg-ink hover:bg-charcoal text-canvas text-xs font-medium h-10 rounded-full btn-pill-tap transition">
                    Konsultasi WA
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
