@extends('layouts.app')

@section('title', $service->title . ' - PT. Orthocare Indonesia')
@section('meta_description', $service->summary)

@section('content')

<!-- Sub-Nav Breadcrumb -->
<div class="bg-surface-white border-b border-outline-variant/30 py-3.5 px-4 sm:px-6 lg:px-8 text-xs text-on-surface-variant font-medium">
    <div class="max-w-container-max mx-auto flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <span class="text-outline-variant">/</span>
        <a href="{{ route('services.index') }}" class="hover:text-primary transition-colors">Layanan Medis</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-semibold">{{ $service->title }}</span>
    </div>
</div>

<!-- Header Banner -->
<div class="bg-surface-container-low border-b border-outline-variant/30 py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <div class="max-w-container-max mx-auto relative z-10 space-y-4">
        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-primary"></span>
            Prosedur Klinis Spesialis
        </span>
        <h1 class="text-3xl sm:text-4xl lg:text-[42px] font-headline-xl font-bold tracking-tight text-on-background leading-tight max-w-4xl">
            {{ $service->title }}
        </h1>
        <p class="text-on-surface-variant text-base sm:text-lg max-w-3xl leading-relaxed">
            {{ $service->summary }}
        </p>
    </div>
</div>

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- Main Content (Left) -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bg-surface-white rounded-3xl border border-outline-variant/30 p-8 sm:p-10 space-y-6 shadow-1">
                <div class="prose prose-slate max-w-none text-base text-on-surface-variant leading-relaxed space-y-4">
                    {!! $service->content !!}
                </div>

                @if($service->indications && count($service->indications) > 0)
                <div class="p-6 bg-surface-container-low rounded-2xl border border-outline-variant/30 space-y-3 mt-6">
                    <h3 class="font-headline-md font-semibold text-primary text-base uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-xl">fact_check</span>
                        <span>Indikasi Klinis Penanganan:</span>
                    </h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-sm text-on-surface">
                        @foreach($service->indications as $ind)
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-sm">check_circle</span>
                            <span>{{ $ind }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Consultation Banner -->
            <div class="bg-primary text-surface-white p-8 rounded-3xl flex flex-col sm:flex-row justify-between items-center gap-6 shadow-2">
                <div class="space-y-2 text-center sm:text-left">
                    <h3 class="font-headline-md text-xl font-bold text-white">Butuh Penanganan Khusus untuk Kondisi Anda?</h3>
                    <p class="text-xs text-white/85 max-w-md">Konsultasikan keluhan Anda bersama tim ortotis dan prostetis berpengalaman kami hari ini.</p>
                </div>
                <a href="{{ route('consultation.create') }}?service_id={{ $service->id }}" class="shrink-0 bg-white hover:bg-slate-100 text-primary text-xs font-bold px-7 py-3.5 rounded-xl transition-all shadow-md hover:shadow-lg flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm text-primary">calendar_month</span> Buat Janji Temu
                </a>
            </div>
        </div>

        <!-- Sidebar Actions (Right) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Booking Card -->
            <div class="bg-surface-white rounded-3xl border border-outline-variant/30 p-6 space-y-5 shadow-1">
                <h3 class="font-headline-md font-semibold text-lg text-on-background">Konsultasi Medis</h3>
                <p class="text-xs text-on-surface-variant leading-relaxed">
                    Dapatkan evaluasi postur awal dan gait analysis bersama klinisi bersertifikasi.
                </p>
                <div class="space-y-3 pt-2">
                    <a href="{{ route('consultation.create') }}?service_id={{ $service->id }}" 
                       class="w-full flex items-center justify-center bg-primary hover:bg-secondary text-surface-white text-sm font-semibold h-12 rounded-xl transition shadow-sm">
                        Buat Janji Temu
                    </a>
                    <a href="https://wa.me/6281234567890?text=Halo%20PT.%20Orthocare%20Indonesia,%20saya%20ingin%20konsultasi%20layanan%20{{ urlencode($service->title) }}." target="_blank"
                       class="w-full flex items-center justify-center bg-surface-container-low hover:bg-surface-container-high text-primary text-sm font-semibold h-12 rounded-xl border border-outline-variant/30 transition">
                        <span class="material-symbols-outlined text-lg mr-2">chat</span> Chat WhatsApp
                    </a>
                </div>
            </div>

            <!-- Guarantee & Accreditation -->
            <div class="bg-surface-white rounded-3xl border border-outline-variant/30 p-6 space-y-4 shadow-1">
                <h4 class="text-xs font-semibold uppercase tracking-wider text-primary">Jaminan Layanan</h4>
                <div class="space-y-3 text-xs text-on-surface-variant">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-lg mt-0.5">verified</span>
                        <div>
                            <strong class="text-on-background block">Standar Kemenkes RI</strong>
                            <span>Praktisi berlisensi dan tersertifikasi resmi.</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-lg mt-0.5">published_with_changes</span>
                        <div>
                            <strong class="text-on-background block">Garansi Penyesuaian Fitting</strong>
                            <span>Penyesuaian soket gratis selama masa adaptasi pasien.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
