@extends('layouts.app')

@section('title', 'Kunjungi Klinik Kami - Cabang & Kontak Resmi')
@section('meta_description', 'Kunjungi cabang praktek resmi Klinik Ortotik & Prostetik Indonesia di Jakarta Pusat dan Surabaya atau hubungi hotline WhatsApp.')

@section('content')

<!-- Header Banner -->
<div class="bg-cappuccino border-b border-border py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1360px] mx-auto text-center space-y-3">
        <span class="text-xs text-terracotta font-semibold uppercase tracking-wider block font-sans">CLINIC LOCATIONS</span>
        <h1 class="text-3xl sm:text-4xl lg:text-[46px] font-serif font-medium tracking-tight text-primary leading-tight">
            Kunjungi Klinik Kami
        </h1>
        <p class="text-secondary/80 text-base sm:text-lg max-w-xl mx-auto leading-relaxed font-light">
            Kami siap melayani konsultasi, evaluasi postur 3D, dan pemeriksaan langsung di cabang Jakarta Pusat dan Surabaya.
        </p>
    </div>
</div>

<div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($branches as $branch)
        <div class="bg-white rounded-3xl border border-border p-8 sm:p-10 flex flex-col justify-between hover:border-primary/40 hover:shadow-md transition duration-300 group">
            <div class="space-y-4">
                <span class="inline-flex px-4 py-1 bg-mint text-primary font-semibold text-xs rounded-full border border-primary/20 uppercase font-sans">
                    Wilayah {{ $branch->city }}
                </span>
                
                <h2 class="text-2xl sm:text-3xl font-serif font-medium tracking-tight text-primary">{{ $branch->name }}</h2>
                <p class="text-sm text-secondary/80 leading-relaxed font-light">{{ $branch->address }}</p>

                <div class="space-y-2 pt-2 text-xs text-tertiary">
                    <p><strong class="text-primary font-medium">Telepon:</strong> {{ $branch->phone_number }}</p>
                    <p><strong class="text-primary font-medium">WhatsApp:</strong> {{ $branch->whatsapp_number }}</p>
                    <p><strong class="text-primary font-medium">Jam Operasional:</strong> {{ $branch->opening_hours ?? 'Senin - Sabtu: 08:30 - 17:00 WIB' }}</p>
                </div>
            </div>

            <div class="pt-6 border-t border-border grid grid-cols-2 gap-3 mt-8">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $branch->whatsapp_number) }}?text=Halo%20Admin%20{{ urlencode($branch->name) }},%20saya%20ingin%20konsultasi." target="_blank"
                    class="flex items-center justify-center bg-cappuccino hover:bg-cappuccino-deep text-secondary text-xs font-semibold h-11 rounded-full btn-maven border border-border transition">
                    Chat WhatsApp
                </a>
                <a href="{{ route('consultation.create') }}?branch_id={{ $branch->id }}"
                    class="flex items-center justify-center bg-primary hover:bg-primary-dark text-white text-xs font-semibold h-11 rounded-full btn-maven transition">
                    Buat Janji Temu
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
