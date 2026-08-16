@extends('layouts.app')

@section('title', '5 Pilar Layanan Medis Ortotik & Prostetik - Klinik Ortotik')
@section('meta_description', 'Pendekatan pelayanan medis terpadu mulai dari evaluasi biomekanik 3D, pembuatan kaki palsu bionik, korset skoliosis 3D, hingga home visit & casting.')

@section('content')

<!-- Header Banner -->
<div class="bg-hero-soft py-14 lg:py-20 border-b border-sky-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
        <span class="text-medical-600 font-extrabold text-xs uppercase tracking-widest block">KOMPREHENSIF & BERSTANDAR MEDIS</span>
        <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight">5 Pilar Layanan Medis Kami</h1>
        <p class="text-slate-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            Pendekatan klinis holistik mulai dari evaluasi biomekanik 3D, fabrikasi alat kustom di workshop, hingga terapi adaptasi dan gait training.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($services as $svc)
        <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-card hover:shadow-card-hover hover:border-sky-300 transition-all duration-300 flex flex-col justify-between group">
            <div>
                <div class="w-16 h-16 rounded-2xl bg-sky-50 text-medical-600 border border-sky-100 flex items-center justify-center mb-6 group-hover:bg-medical-600 group-hover:text-white transition-all duration-300">
                    <i data-lucide="{{ $svc->icon_name ?? 'activity' }}" class="w-8 h-8"></i>
                </div>

                <h2 class="text-xl font-extrabold text-slate-900 group-hover:text-medical-600 transition leading-snug">
                    <a href="{{ route('services.show', $svc->slug) }}">{{ $svc->title }}</a>
                </h2>

                <p class="text-xs text-slate-600 mt-3 leading-relaxed">{{ $svc->summary }}</p>

                @if($svc->indications && count($svc->indications) > 0)
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2.5">Indikasi Penanganan Medis:</span>
                    <ul class="space-y-2 text-xs text-slate-700">
                        @foreach(array_slice($svc->indications, 0, 4) as $ind)
                        <li class="flex items-center gap-2">
                            <i data-lucide="check-circle" class="w-3.5 h-3.5 text-medical-600 shrink-0"></i>
                            <span>{{ $ind }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="mt-8 pt-4 border-t border-slate-100 flex gap-2">
                <a href="{{ route('services.show', $svc->slug) }}" class="flex-1 text-center py-3 rounded-xl bg-sky-50 hover:bg-medical-600 text-medical-700 hover:text-white font-bold text-xs transition">
                    Pelajari Prosedur &rarr;
                </a>
                <a href="{{ route('consultation.create') }}?service_id={{ $svc->id }}" class="py-3 px-4 rounded-xl border border-slate-200 hover:border-medical-600 text-slate-700 hover:text-medical-600 font-bold text-xs transition">
                    Jadwal Janji
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
