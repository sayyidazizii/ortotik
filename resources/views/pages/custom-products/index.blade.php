@extends('layouts.app')

@section('title', 'Alur & Katalog Produk Custom-Made P&O - Klinik Ortotik')

@section('content')
<div class="bg-slate-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="text-tealmed-400 font-bold text-xs uppercase tracking-widest block">CUSTOM FABRICATION EXCELLENCE</span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">Produk Custom-Made Ortotik & Prostetik</h1>
        <p class="text-slate-300 text-base max-w-2xl mx-auto">Dirancang dan diproduksi secara individual mengikuti anatomi dan kebutuhan biomekanik setiap pasien.</p>
    </div>
</div>

<!-- Workflow Steps Section -->
<section class="py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">4 Tahapan Pembuatan Produk Custom</h2>
            <p class="text-xs text-slate-500 mt-2">Standar fabrikasi presisi untuk memastikan fitting sempurna dan kenyamanan maksimal.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 text-center space-y-3 relative">
                <div class="w-10 h-10 rounded-full bg-medical-700 text-white font-black mx-auto flex items-center justify-center text-sm shadow">1</div>
                <h3 class="font-bold text-sm text-slate-900">Konsultasi & Scan 3D</h3>
                <p class="text-xs text-slate-500">Evaluasi biomekanik dan pengukuran non-invasif dengan pemindai 3D modern.</p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 text-center space-y-3 relative">
                <div class="w-10 h-10 rounded-full bg-medical-700 text-white font-black mx-auto flex items-center justify-center text-sm shadow">2</div>
                <h3 class="font-bold text-sm text-slate-900">Desain CAD & Cetak</h3>
                <p class="text-xs text-slate-500">Pemodelan digital komputerisasi dan fabrikasi soket berbahan carbon fiber.</p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 text-center space-y-3 relative">
                <div class="w-10 h-10 rounded-full bg-medical-700 text-white font-black mx-auto flex items-center justify-center text-sm shadow">3</div>
                <h3 class="font-bold text-sm text-slate-900">Dynamic Fitting</h3>
                <p class="text-xs text-slate-500">Pemasangan alat, uji jalan dinamis, dan penyetelan titik tekan sudut anatomi.</p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 text-center space-y-3 relative">
                <div class="w-10 h-10 rounded-full bg-medical-700 text-white font-black mx-auto flex items-center justify-center text-sm shadow">4</div>
                <h3 class="font-bold text-sm text-slate-900">Gait Training & Garansi</h3>
                <p class="text-xs text-slate-500">Latihan mandiri bersama fisioterapis dan garansi penyesuaian berkala.</p>
            </div>
        </div>
    </div>
</section>

<!-- Custom Products Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($customProducts as $cp)
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-xl transition flex flex-col justify-between group">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-extrabold uppercase px-3 py-1 bg-tealmed-50 text-tealmed-700 rounded-full">Custom Made</span>
                    <span class="text-xs text-slate-400 font-bold">100% Garansi Fitting</span>
                </div>
                <h3 class="text-2xl font-extrabold text-slate-900 group-hover:text-medical-700 transition">
                    <a href="{{ route('custom-products.show', $cp->slug) }}">{{ $cp->name }}</a>
                </h3>
                <p class="text-sm text-slate-600 leading-relaxed">{{ $cp->summary }}</p>

                @if($cp->features && count($cp->features) > 0)
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
                    <span class="text-xs font-bold text-slate-700 block">Fitur & Material Unggulan:</span>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 text-xs text-slate-600">
                        @foreach($cp->features as $f)
                        <li class="flex items-center gap-1.5">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-tealmed-600 flex-shrink-0"></i>
                            <span>{{ $f }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="mt-8 pt-4 border-t border-slate-100 flex gap-3">
                <a href="{{ route('custom-products.show', $cp->slug) }}" class="flex-1 text-center py-3 rounded-xl bg-medical-700 hover:bg-medical-800 text-white font-bold text-xs shadow transition">
                    Lihat Detail & Tahapan &rarr;
                </a>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20ingin%20konsultasi%20pembuatan%20custom%20{{ urlencode($cp->name) }}" target="_blank" class="px-5 py-3 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white font-bold text-xs flex items-center gap-1.5 shadow transition">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Tanya Spesialis</span>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
