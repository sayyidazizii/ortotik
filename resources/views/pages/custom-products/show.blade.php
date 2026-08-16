@extends('layouts.app')

@section('title', $product->name . ' - Produk Custom P&O - Klinik Ortotik')

@section('content')
<div class="bg-slate-900 text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-tealmed-400 font-bold text-xs uppercase tracking-widest block mb-2">CUSTOM FABRICATION DETAIL</span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight max-w-4xl">{{ $product->name }}</h1>
        <p class="text-slate-300 mt-4 text-base max-w-2xl">{{ $product->summary }}</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Left Content -->
        <div class="lg:col-span-8 space-y-10">
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
                <div class="prose prose-slate max-w-none text-base text-slate-600 leading-relaxed">
                    {!! $product->description !!}
                </div>

                @if($product->features && count($product->features) > 0)
                <div class="p-6 rounded-2xl bg-tealmed-50 border border-tealmed-100 space-y-3">
                    <h3 class="font-bold text-slate-900 text-base">Spesifikasi Material & Komponen Khusus:</h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm text-slate-700">
                        @foreach($product->features as $feat)
                        <li class="flex items-center gap-2">
                            <i data-lucide="check-circle" class="w-4 h-4 text-tealmed-600 flex-shrink-0"></i>
                            <span>{{ $feat }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Workflow Timeline -->
            @if($product->workflow_steps && count($product->workflow_steps) > 0)
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
                <h3 class="text-xl font-extrabold text-slate-900">Alur Fabrikasi & Pembuatan Alat Ini</h3>
                <div class="space-y-6 relative border-l-2 border-medical-200 pl-6 ml-3">
                    @foreach($product->workflow_steps as $step)
                    <div class="relative">
                        <span class="absolute -left-[35px] top-0 w-8 h-8 rounded-full bg-medical-700 text-white font-bold text-xs flex items-center justify-center shadow">
                            {{ $step['step'] ?? $loop->iteration }}
                        </span>
                        <h4 class="font-bold text-base text-slate-900">{{ $step['title'] }}</h4>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Right Sidebar -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-gradient-to-br from-medical-700 to-medical-900 text-white rounded-3xl p-8 shadow-xl space-y-4 text-center">
                <i data-lucide="calendar" class="w-10 h-10 text-tealmed-400 mx-auto"></i>
                <h3 class="text-xl font-bold">Jadwalkan Konsultasi & Pengukuran</h3>
                <p class="text-xs text-slate-300 leading-relaxed">Pemeriksaan fisik dan scanning 3D awal dapat dilakukan di klinik cabang Jakarta atau Surabaya.</p>
                <a href="{{ route('consultation.create') }}" class="block w-full py-3.5 rounded-full bg-tealmed-500 hover:bg-tealmed-600 text-slate-950 font-extrabold text-sm shadow transition">
                    Isi Formulir Jadwal Medis
                </a>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20tertarik%20pembuatan%20{{ urlencode($product->name) }}" target="_blank" class="block w-full py-3.5 rounded-full bg-[#25D366] hover:bg-[#20ba5a] text-white font-bold text-sm shadow transition">
                    Tanya Estimasi via WA
                </a>
            </div>

            <!-- Other Custom Products -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Produk Custom Lainnya</h4>
                <div class="space-y-2">
                    @foreach($allCustomProducts as $acp)
                    <a href="{{ route('custom-products.show', $acp->slug) }}" class="block p-3 rounded-xl text-xs font-bold transition {{ $acp->id === $product->id ? 'bg-slate-100 text-medical-700' : 'text-slate-700 hover:bg-slate-50' }}">
                        {{ $acp->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
