@extends('layouts.app')

@section('title', 'Kunjungi Klinik Kami - Cabang & Kontak Resmi')
@section('meta_description', 'Kunjungi cabang praktek resmi Klinik Ortotik & Prostetik Indonesia di Jakarta Pusat dan Surabaya atau hubungi hotline WhatsApp.')

@section('content')

<!-- Header Banner with Editorial Typography -->
<div class="bg-canvas border-b border-hairline-soft py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1440px] mx-auto text-center space-y-2">
        <span class="text-xs text-mute font-semibold uppercase tracking-widest block">Clinic Locations</span>
        <h1 class="text-3xl sm:text-5xl font-medium tracking-tight text-ink uppercase font-sans">
            Kunjungi Klinik Kami
        </h1>
        <p class="text-mute text-sm max-w-xl mx-auto leading-relaxed">
            Kami siap melayani konsultasi, evaluasi postur 3D, dan pemeriksaan langsung di cabang Jakarta Pusat dan Surabaya.
        </p>
    </div>
</div>

<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($branches as $branch)
        <div class="bg-canvas border border-hairline-soft p-8 flex flex-col justify-between group">
            <div class="space-y-4">
                <span class="inline-flex px-3 py-1 bg-soft-cloud text-ink font-semibold text-xs rounded-full border border-hairline-soft uppercase">
                    Wilayah {{ $branch->city }}
                </span>
                
                <h2 class="text-2xl font-bold tracking-tight text-ink uppercase font-sans">{{ $branch->name }}</h2>
                <p class="text-xs text-mute leading-relaxed">{{ $branch->address }}</p>

                <div class="space-y-2 pt-2 text-xs text-mute">
                    <p><strong class="text-ink">Telepon:</strong> {{ $branch->phone_number }}</p>
                    <p><strong class="text-ink">WhatsApp:</strong> {{ $branch->whatsapp_number }}</p>
                    <p><strong class="text-ink">Jam Operasional:</strong> {{ $branch->opening_hours ?? 'Senin - Sabtu: 08:30 - 17:00 WIB' }}</p>
                </div>
            </div>

            <div class="pt-6 border-t border-hairline-soft grid grid-cols-2 gap-2 mt-6">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $branch->whatsapp_number) }}?text=Halo%20Admin%20{{ urlencode($branch->name) }},%20saya%20ingin%20konsultasi." target="_blank"
                    class="flex items-center justify-center bg-soft-cloud hover:bg-hairline-soft text-ink text-xs font-medium h-10 rounded-full btn-pill-tap transition">
                    Chat WhatsApp
                </a>
                <a href="{{ route('consultation.create') }}?branch_id={{ $branch->id }}"
                    class="flex items-center justify-center bg-ink hover:bg-charcoal text-canvas text-xs font-medium h-10 rounded-full btn-pill-tap transition">
                    Buat Janji Temu
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
