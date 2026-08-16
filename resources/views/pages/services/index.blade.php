@extends('layouts.app')

@section('title', '5 Pilar Layanan Medis Ortotik & Prostetik - Klinik Ortotik')

@section('content')
<div class="bg-medical-700 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="text-tealmed-400 font-bold text-xs uppercase tracking-widest block">KOMPREHENSIF & BERSTANDAR GLOBAL</span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">5 Pilar Layanan Medis Kami</h1>
        <p class="text-slate-200 text-base max-w-2xl mx-auto">Pendekatan holistik mulai dari evaluasi biomekanik 3D, fabrikasi alat kustom, hingga terapi adaptasi dan fisioterapi pola jalan.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($services as $svc)
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm hover:shadow-xl hover:border-medical-300 transition duration-300 flex flex-col justify-between group">
            <div>
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-medical-50 to-tealmed-50 text-medical-700 flex items-center justify-center mb-6 group-hover:bg-medical-700 group-hover:text-white transition duration-300 shadow-sm">
                    <i data-lucide="{{ $svc->icon_name ?? 'activity' }}" class="w-8 h-8"></i>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-900 group-hover:text-medical-700 transition">
                    <a href="{{ route('services.show', $svc->slug) }}">{{ $svc->title }}</a>
                </h2>
                <p class="text-sm text-slate-600 mt-3 leading-relaxed">{{ $svc->summary }}</p>

                @if($svc->indications && count($svc->indications) > 0)
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-2">Indikasi Klinis:</span>
                    <ul class="space-y-1.5 text-xs text-slate-600">
                        @foreach(array_slice($svc->indications, 0, 4) as $ind)
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-tealmed-600"></i>
                            <span>{{ $ind }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="mt-8 pt-4 border-t border-slate-100 flex gap-3">
                <a href="{{ route('services.show', $svc->slug) }}" class="flex-1 text-center py-3 rounded-xl bg-medical-50 hover:bg-medical-700 text-medical-700 hover:text-white font-bold text-xs transition">
                    Pelajari Layanan &rarr;
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
