@extends('layouts.app')

@section('title', $service->title . ' - Layanan Medis Klinik Ortotik')
@section('meta_description', $service->summary)

@section('content')
<div class="bg-medical-700 text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-tealmed-400 font-bold text-xs uppercase tracking-widest block mb-2">LAYANAN KLINIS SPESIALIS</span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight max-w-4xl">{{ $service->title }}</h1>
        <p class="text-slate-200 mt-4 text-base max-w-2xl">{{ $service->summary }}</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Main Content (Left) -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm space-y-6">
                <div class="prose prose-slate max-w-none text-base text-slate-600 leading-relaxed">
                    {!! $service->content !!}
                </div>

                @if($service->indications && count($service->indications) > 0)
                <div class="p-6 rounded-2xl bg-tealmed-50 border border-tealmed-100 space-y-3">
                    <h3 class="font-bold text-slate-900 text-base flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-5 h-5 text-tealmed-600"></i>
                        <span>Kondisi & Indikasi Medis yang Ditangani:</span>
                    </h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm text-slate-700">
                        @foreach($service->indications as $ind)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-tealmed-600"></span>
                            <span>{{ $ind }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Consultation Banner -->
            <div class="bg-gradient-to-r from-medical-700 to-medical-900 text-white rounded-3xl p-8 shadow-xl flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="space-y-2 text-center sm:text-left">
                    <h3 class="text-xl font-bold">Ingin Berkonsultasi Mengenai Layanan Ini?</h3>
                    <p class="text-xs text-slate-300">Jadwalkan pemeriksaan biomekanik dan fitting dengan ortotis klinis kami.</p>
                </div>
                <a href="{{ route('consultation.create') }}?medical_service_id={{ $service->id }}" class="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white text-sm font-extrabold px-6 py-3.5 rounded-full shadow transition whitespace-nowrap">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <span>Daftar Konsultasi</span>
                </a>
            </div>
        </div>

        <!-- Sidebar Navigation (Right) -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Layanan Lainnya</h3>
                <div class="space-y-2">
                    @foreach($allServices as $s)
                    <a href="{{ route('services.show', $s->slug) }}" class="flex items-center justify-between p-3 rounded-xl text-xs font-bold transition {{ $s->id === $service->id ? 'bg-medical-700 text-white' : 'bg-slate-50 text-slate-700 hover:bg-slate-100' }}">
                        <span>{{ $s->title }}</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Direct WA Card -->
            <div class="bg-slate-900 text-white rounded-2xl p-6 shadow-sm space-y-4 text-center">
                <i data-lucide="message-circle" class="w-10 h-10 text-[#25D366] mx-auto"></i>
                <h4 class="font-bold text-base">Tanya Tim Dokter / Ortotis</h4>
                <p class="text-xs text-slate-400">Hubungi WhatsApp resmi untuk info estimasi biaya dan persiapan rontgen.</p>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ortotik,%20saya%20ingin%20tanya%20layanan%20{{ urlencode($service->title) }}" target="_blank" class="block w-full py-3 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white text-xs font-bold shadow transition">
                    Chat WhatsApp Langsung
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
