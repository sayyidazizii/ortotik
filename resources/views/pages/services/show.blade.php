@extends('layouts.app')

@section('title', $service->title . ' - Precision Orthotics & Prosthetics')
@section('meta_description', $service->summary)

@section('content')

<!-- Sub-Nav Breadcrumb -->
<div class="bg-cappuccino border-b border-border py-3 px-4 sm:px-6 lg:px-8 text-xs text-tertiary font-medium font-sans">
    <div class="max-w-[1360px] mx-auto flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
        <span>/</span>
        <a href="{{ route('services.index') }}" class="hover:text-primary">5 Layanan Medis</a>
        <span>/</span>
        <span class="text-primary font-semibold">{{ $service->title }}</span>
    </div>
</div>

<!-- Header Banner -->
<div class="bg-cappuccino border-b border-border py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1360px] mx-auto">
        <span class="text-xs text-terracotta font-semibold uppercase tracking-wider block mb-2 font-sans">CLINICAL PROCEDURE & EXPERTISE</span>
        <h1 class="text-3xl sm:text-4xl lg:text-[46px] font-serif font-medium tracking-tight text-primary leading-tight max-w-4xl">
            {{ $service->title }}
        </h1>
        <p class="text-secondary/80 text-base sm:text-lg mt-3 max-w-2xl leading-relaxed font-light">
            {{ $service->summary }}
        </p>
    </div>
</div>

<div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- Main Content (Left) -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bg-white rounded-3xl border border-border p-8 sm:p-10 space-y-6 shadow-2xs">
                <div class="prose prose-slate max-w-none text-base text-secondary/85 leading-relaxed space-y-4 font-light">
                    {!! $service->content !!}
                </div>

                @if($service->indications && count($service->indications) > 0)
                <div class="p-6 bg-cappuccino rounded-2xl border border-border space-y-3">
                    <h3 class="font-serif font-medium text-primary text-base uppercase tracking-wider flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-5 h-5 text-terracotta"></i>
                        <span>Indikasi Klinis Penanganan:</span>
                    </h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs text-secondary/80 font-normal">
                        @foreach($service->indications as $ind)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-terracotta shrink-0"></span>
                            <span>{{ $ind }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Consultation Banner -->
            <div class="bg-primary text-cappuccino p-8 sm:p-10 rounded-3xl flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xs">
                <div class="space-y-2 text-center sm:text-left">
                    <span class="text-xs text-mint font-semibold uppercase tracking-wider block font-sans">Janji Temu Klinis</span>
                    <h3 class="text-2xl sm:text-3xl font-serif font-medium text-white">Jadwalkan Konsultasi & Pengukuran</h3>
                    <p class="text-xs text-cappuccino/80 max-w-md leading-relaxed font-light">Pemeriksaan biomekanik, evaluasi pola jalan, dan konsultasi fitting bersama tim Ortotis-Prostetis resmi.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto shrink-0">
                    <a href="{{ route('consultation.create') }}?service_id={{ $service->id }}"
                        class="inline-flex items-center justify-center bg-terracotta hover:bg-terracotta-dark text-white text-sm font-semibold px-7 h-12 rounded-full btn-maven transition">
                        <span>Janji Temu Medis</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar Navigation (Right) -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-3xl border border-border p-6 space-y-4 shadow-2xs">
                <h3 class="text-xs font-serif font-semibold uppercase tracking-wider text-primary">5 Layanan Medis</h3>
                <div class="space-y-1.5 font-sans">
                    @foreach($allServices as $s)
                    <a href="{{ route('services.show', $s->slug) }}"
                        class="flex items-center justify-between px-4 py-3 rounded-full text-xs font-semibold transition {{ $s->id === $service->id ? 'bg-primary text-white font-semibold' : 'text-secondary hover:bg-cappuccino' }}">
                        <span>{{ $s->title }}</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Direct WA Card -->
            <div class="bg-white rounded-3xl border border-border p-6 space-y-3 shadow-2xs">
                <span class="text-[10px] font-semibold text-terracotta uppercase tracking-widest block font-sans">Konsultasi Cepat</span>
                <h4 class="text-lg font-serif font-medium text-primary">Tanya Spesialis via WhatsApp</h4>
                <p class="text-xs text-tertiary leading-relaxed font-light">Hubungi admin hotline resmi untuk informasi estimasi biaya, jadwal dokter, dan panduan Home Visit.</p>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20ingin%20tanya%20layanan%20{{ urlencode($service->title) }}" target="_blank"
                    class="inline-flex items-center justify-center w-full bg-primary hover:bg-primary-dark text-white text-xs font-semibold h-11 rounded-full btn-maven transition">
                    <span>Chat WhatsApp Sekarang</span>
                </a>
            </div>
        </div>

    </div>
</div>

@endsection
