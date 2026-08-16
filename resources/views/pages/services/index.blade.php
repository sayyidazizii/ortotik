@extends('layouts.app')

@section('title', '5 Pilar Layanan Medis Kami - Precision Orthotics & Prosthetics')
@section('meta_description', 'Pendekatan klinis holistik mulai dari evaluasi biomekanik 3D, pembuatan kaki palsu bionik, korset skoliosis 3D, hingga home visit & casting.')

@section('content')

<!-- Header Banner -->
<div class="bg-cappuccino border-b border-border py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1360px] mx-auto text-center space-y-3">
        <span class="text-xs text-terracotta font-semibold uppercase tracking-wider block font-sans">COMPREHENSIVE MEDICAL CARE</span>
        <h1 class="text-3xl sm:text-4xl lg:text-[46px] font-serif font-medium tracking-tight text-primary leading-tight">
            5 Pilar Layanan Medis Kami
        </h1>
        <p class="text-secondary/80 text-base sm:text-lg max-w-xl mx-auto leading-relaxed font-light">
            Pendekatan terintegrasi mulai dari evaluasi biomekanik 3D, fabrikasi alat kustom di workshop, hingga terapi adaptasi dan gait training.
        </p>
    </div>
</div>

<div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($services as $svc)
        <div class="bg-white rounded-3xl border border-border p-8 flex flex-col justify-between hover:border-primary/40 hover:shadow-md transition duration-300 group">
            <div>
                <!-- Icon Box -->
                <div class="w-14 h-14 rounded-full bg-mint text-primary flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition duration-300">
                    <i data-lucide="{{ $svc->icon_name ?? 'activity' }}" class="w-7 h-7"></i>
                </div>

                <h2 class="text-2xl font-serif font-medium text-primary tracking-tight leading-snug mb-3 group-hover:text-terracotta transition">
                    <a href="{{ route('services.show', $svc->slug) }}">{{ $svc->title }}</a>
                </h2>

                <p class="text-sm text-secondary/80 font-light leading-relaxed mb-6">{{ $svc->summary }}</p>

                @if($svc->indications && count($svc->indications) > 0)
                <div class="pt-5 border-t border-border space-y-2.5">
                    <span class="text-xs font-semibold text-primary uppercase tracking-wider block font-sans">Indikasi Penanganan:</span>
                    <ul class="space-y-1.5 text-xs text-secondary/80 font-normal">
                        @foreach(array_slice($svc->indications, 0, 4) as $ind)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-terracotta shrink-0"></span>
                            <span>{{ $ind }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="mt-8 pt-5 border-t border-border grid grid-cols-2 gap-3">
                <a href="{{ route('services.show', $svc->slug) }}" class="flex items-center justify-center bg-cappuccino hover:bg-cappuccino-deep text-secondary text-xs font-semibold h-11 rounded-full btn-maven border border-border transition">
                    Detail Prosedur
                </a>
                <a href="{{ route('consultation.create') }}?service_id={{ $svc->id }}" class="flex items-center justify-center bg-primary hover:bg-primary-dark text-white text-xs font-semibold h-11 rounded-full btn-maven transition">
                    Janji Temu
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
