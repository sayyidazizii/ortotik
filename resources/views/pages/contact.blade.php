@extends('layouts.app')

@section('title', 'Cabang Klinik & Kontak Resmi - Klinik Ortotik')

@section('content')
<div class="bg-medical-700 text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
        <span class="text-tealmed-400 font-bold text-xs uppercase tracking-widest block">LOKASI & KONTAK</span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">Hubungi & Kunjungi Klinik Kami</h1>
        <p class="text-slate-200 text-sm max-w-xl mx-auto">Kami siap melayani konsultasi dan pemeriksaan langsung di cabang Jakarta Pusat dan Surabaya.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($branches as $branch)
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6 flex flex-col justify-between">
            <div class="space-y-4">
                <span class="px-3 py-1 bg-tealmed-50 text-tealmed-700 font-extrabold text-xs rounded-full uppercase">{{ $branch->city }}</span>
                <h2 class="text-2xl font-extrabold text-slate-900">{{ $branch->name }}</h2>
                <p class="text-sm text-slate-600 leading-relaxed">{{ $branch->address }}</p>

                <div class="space-y-2 pt-2 text-xs text-slate-700">
                    <p><strong>Telepon:</strong> {{ $branch->phone_number }}</p>
                    <p><strong>WhatsApp:</strong> +{{ $branch->whatsapp_number }}</p>
                    <p><strong>Jam Operasional:</strong> {{ $branch->opening_hours }}</p>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex gap-3">
                <a href="https://wa.me/{{ $branch->whatsapp_number }}?text=Halo%20Admin%20{{ urlencode($branch->name) }},%20saya%20ingin%20konsultasi." target="_blank" class="flex-1 text-center py-3 rounded-xl bg-[#25D366] text-white text-xs font-bold shadow hover:bg-[#20ba5a] transition">
                    Chat WhatsApp
                </a>
                <a href="{{ route('consultation.create') }}?branch_id={{ $branch->id }}" class="flex-1 text-center py-3 rounded-xl bg-medical-700 text-white text-xs font-bold shadow hover:bg-medical-800 transition">
                    Buat Janji Temu
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
