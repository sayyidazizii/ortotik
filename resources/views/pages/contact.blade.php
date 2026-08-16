@extends('layouts.app')

@section('title', 'Cabang Klinik & Kontak Resmi - Klinik Ortotik')
@section('meta_description', 'Kunjungi cabang praktek resmi Klinik Ortotik & Prostetik Indonesia di Jakarta Pusat dan Surabaya atau hubungi hotline WhatsApp.')

@section('content')

<!-- Header Banner -->
<div class="bg-hero-soft py-14 lg:py-18 border-b border-sky-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
        <span class="text-medical-600 font-extrabold text-xs uppercase tracking-widest block">LOKASI & KONTAK</span>
        <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight">Hubungi & Kunjungi Klinik Kami</h1>
        <p class="text-slate-600 text-sm max-w-xl mx-auto leading-relaxed">
            Kami siap melayani konsultasi, evaluasi postur 3D, dan pemeriksaan langsung di cabang Jakarta Pusat dan Surabaya.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($branches as $branch)
        <div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-card space-y-6 flex flex-col justify-between">
            <div class="space-y-4">
                <span class="px-3 py-1 bg-sky-50 text-sky-800 font-extrabold text-xs rounded-full uppercase border border-sky-100">{{ $branch->city }}</span>
                <h2 class="text-2xl font-black text-slate-900">{{ $branch->name }}</h2>
                <p class="text-xs text-slate-600 leading-relaxed">{{ $branch->address }}</p>

                <div class="space-y-2 pt-2 text-xs text-slate-700">
                    <p><strong>Telepon:</strong> {{ $branch->phone_number }}</p>
                    <p><strong>WhatsApp:</strong> {{ $branch->whatsapp_number }}</p>
                    <p><strong>Jam Operasional:</strong> {{ $branch->opening_hours ?? 'Senin - Sabtu: 08:30 - 17:00 WIB' }}</p>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex gap-3">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $branch->whatsapp_number) }}?text=Halo%20Admin%20{{ urlencode($branch->name) }},%20saya%20ingin%20konsultasi." target="_blank"
                    class="flex-1 text-center py-3 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white text-xs font-bold shadow-xs transition">
                    Chat WhatsApp
                </a>
                <a href="{{ route('consultation.create') }}?branch_id={{ $branch->id }}"
                    class="flex-1 text-center py-3 rounded-xl bg-medical-600 hover:bg-medical-700 text-white text-xs font-bold shadow-xs transition">
                    Buat Janji Temu
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
