@extends('layouts.app')

@section('title', '5 Pilar Layanan Medis Kami - Precision Orthotics & Prosthetics')
@section('meta_description', 'Pendekatan klinis holistik mulai dari evaluasi biomekanik 3D, pembuatan kaki palsu bionik, korset skoliosis 3D, hingga home visit & casting.')

@section('content')

<!-- Header Banner with Editorial Typography -->
<div class="bg-canvas border-b border-hairline-soft py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1440px] mx-auto text-center space-y-2">
        <span class="text-xs text-mute font-semibold uppercase tracking-widest block">Comprehensive Medical Care</span>
        <h1 class="text-3xl sm:text-5xl font-medium tracking-tight text-ink uppercase font-sans">
            5 Pilar Layanan Medis Kami
        </h1>
        <p class="text-mute text-sm max-w-xl mx-auto leading-relaxed">
            Pendekatan terintegrasi mulai dari evaluasi biomekanik 3D, fabrikasi alat kustom di workshop, hingga terapi adaptasi dan gait training.
        </p>
    </div>
</div>

<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $svc)
        <div class="bg-canvas border border-hairline-soft p-8 flex flex-col justify-between group">
            <div>
                <!-- Icon -->
                <div class="w-14 h-14 bg-soft-cloud text-ink flex items-center justify-center mb-6">
                    <i data-lucide="{{ $svc->icon_name ?? 'activity' }}" class="w-7 h-7"></i>
                </div>

                <h2 class="text-xl font-bold text-ink uppercase tracking-tight leading-snug mb-3 group-hover:text-mute transition">
                    <a href="{{ route('services.show', $svc->slug) }}">{{ $svc->title }}</a>
                </h2>

                <p class="text-xs text-mute leading-relaxed mb-6">{{ $svc->summary }}</p>

                @if($svc->indications && count($svc->indications) > 0)
                <div class="pt-4 border-t border-hairline-soft space-y-2">
                    <span class="text-[11px] font-semibold text-ink uppercase tracking-wider block">Indikasi Penanganan:</span>
                    <ul class="space-y-1.5 text-xs text-mute font-medium">
                        @foreach(array_slice($svc->indications, 0, 4) as $ind)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-ink shrink-0"></span>
                            <span>{{ $ind }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="mt-8 pt-4 border-t border-hairline-soft grid grid-cols-2 gap-2">
                <a href="{{ route('services.show', $svc->slug) }}" class="flex items-center justify-center bg-soft-cloud hover:bg-hairline-soft text-ink text-xs font-medium h-10 rounded-full btn-pill-tap transition">
                    Detail Prosedur
                </a>
                <a href="{{ route('consultation.create') }}?service_id={{ $svc->id }}" class="flex items-center justify-center bg-ink hover:bg-charcoal text-canvas text-xs font-medium h-10 rounded-full btn-pill-tap transition">
                    Janji Temu
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
