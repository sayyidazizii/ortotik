@extends('layouts.app')

@section('title', 'Hubungi Kami - pediOcare')
@section('meta_description', 'Kunjungi klinik resmi pediOcare di Sleman, Yogyakarta atau hubungi WhatsApp 0856 9792 2194 untuk konsultasi langsung.')

@section('content')

@php
    $heroContactBg = $settings['hero_contact_image'] ?? asset('images/client_update/image4.png');
    if (!str_starts_with($heroContactBg, 'http') && !str_starts_with($heroContactBg, '/')) {
        $heroContactBg = asset($heroContactBg);
    }
    $mapsEmbed = $settings['google_maps_embed'] ?? null;
    $clinicAddr = $settings['clinic_address'] ?? ($settings['footer_address'] ?? 'Jl. Kaliurang KM 8.5, Sinduharjo, Ngaglik, Sleman, D.I. Yogyakarta 55581, Indonesia');
    if (empty($mapsEmbed)) {
        $mapsSrc = "https://maps.google.com/maps?q=" . urlencode($clinicAddr) . "&t=&z=15&ie=UTF8&iwloc=&output=embed";
    } else {
        if (preg_match('/src="([^"]+)"/', $mapsEmbed, $matches)) {
            $mapsSrc = $matches[1];
        } else {
            $mapsSrc = $mapsEmbed;
        }
    }
    $clinicCity = $settings['clinic_city'] ?? 'Sleman, D.I. Yogyakarta';
@endphp

<!-- Hero Section -->
<section class="relative py-10 md:py-14 px-margin-mobile md:px-margin-desktop overflow-hidden bg-cover bg-center flex items-center justify-center fade-in-up" 
         style="background-image: linear-gradient(rgba(13, 28, 47, 0.75), rgba(13, 28, 47, 0.75)), url('{{ $heroContactBg }}');">
    <div class="max-w-container-max mx-auto text-center relative z-10 space-y-2.5 sm:space-y-3">
        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-surface-white/10 text-primary-fixed border border-surface-white/20 text-[11px] font-semibold uppercase tracking-wider backdrop-blur-sm">
            <span class="w-1.5 h-1.5 rounded-full bg-primary-fixed animate-pulse"></span>
            {{ $settings['hero_contact_badge'] ?? 'Pelayanan & Lokasi Klinik' }}
        </span>
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-surface-white tracking-tight leading-tight">
            {{ $settings['hero_contact_title'] ?? 'Hubungi Kami' }}
        </h1>
        <p class="font-body-md text-body-md text-surface-white/90 max-w-2xl mx-auto leading-relaxed text-xs sm:text-sm">
            {{ $settings['hero_contact_subtitle'] ?? 'Kami siap melayani Anda dengan teknologi ortopedi mutakhir dan perawatan profesional yang mengutamakan kenyamanan pasien. Care your milestone.' }}
        </p>
    </div>
</section>

<!-- Main Contact Section -->
<section class="py-12 md:py-20 px-margin-mobile md:px-margin-desktop bg-surface-container-low relative overflow-hidden">
    <div class="max-w-container-max mx-auto grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 relative z-10">
        
        <!-- Left Column: Contact Info & Branches -->
        <div class="lg:col-span-5 flex flex-col gap-6">
            <!-- Contact Card -->
            <div class="bg-surface-white rounded-3xl p-6 sm:p-8 shadow-1 border border-outline-variant/30 flex flex-col gap-6">
                <div class="flex items-start gap-4">
                    <div class="bg-primary/10 p-3.5 rounded-2xl text-primary shrink-0">
                        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">location_on</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md text-base font-bold text-on-surface mb-1">Klinik {{ $settings['clinic_name'] ?? 'pediOcare' }} ({{ $clinicCity }})</h3>
                        <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                            {{ $clinicAddr }}
                        </p>
                    </div>
                </div>
                <div class="flex items-start gap-4 pt-4 border-t border-outline-variant/15">
                    <div class="bg-primary/10 p-3.5 rounded-2xl text-primary shrink-0">
                        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">call</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md text-base font-bold text-on-surface mb-1">Kontak Hotline</h3>
                        <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                            {{ $settings['hotline_whatsapp'] ?? '0856 9792 2194' }}<br/>{{ $settings['contact_email'] ?? 'info@pediocare.id' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Map Card -->
            <div class="bg-surface-white rounded-3xl shadow-1 border border-outline-variant/30 overflow-hidden h-64 sm:h-72 relative">
                <iframe 
                    title="Peta Lokasi {{ $settings['clinic_name'] ?? 'pediOcare' }} - {{ $clinicCity }}"
                    src="{{ $mapsSrc }}" 
                    class="w-full h-full border-0" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <!-- Branch List -->
            @foreach($branches as $branch)
            <div class="bg-surface-white rounded-3xl p-6 shadow-1 border border-outline-variant/30 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-primary uppercase tracking-wider bg-primary/10 px-3 py-1 rounded-full">
                        Cabang {{ $branch->city }}
                    </span>
                    @if($branch->is_main_branch)
                    <span class="text-[11px] font-semibold text-white bg-primary px-2.5 py-0.5 rounded-full">Pusat</span>
                    @endif
                </div>
                <h4 class="font-headline-md text-base font-bold text-on-surface">{{ $branch->name }}</h4>
                <p class="text-xs text-on-surface-variant leading-relaxed">{{ $branch->address }}</p>
                <div class="pt-2 flex items-center justify-between text-xs font-semibold">
                    <span class="text-primary">{{ $branch->phone_number }}</span>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $branch->whatsapp_number) }}" target="_blank" class="text-primary hover:text-secondary flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">chat</span> WhatsApp
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Right Column: Appointment Form -->
        <div class="lg:col-span-7">
            <div class="bg-surface-white rounded-3xl p-8 md:p-10 shadow-2 border border-outline-variant/30 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-primary"></div>
                <h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary font-bold mb-2">
                    Buat Janji Temu
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-8">
                    Isi formulir di bawah ini untuk menjadwalkan konsultasi langsung dengan klinisi spesialis kami.
                </p>

                @if ($errors->any())
                <div class="p-4 mb-6 bg-red-50 border-l-4 border-error text-sm text-red-700 rounded-xl">
                    <p class="font-semibold mb-1">Mohon periksa formulir:</p>
                    <ul class="list-disc list-inside text-xs">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('consultation.store') }}" method="POST" class="flex flex-col gap-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2 font-medium">Nama Lengkap *</label>
                            <input class="w-full rounded-xl border border-outline-variant/60 bg-surface-white focus:border-primary focus:ring-1 focus:ring-primary px-4 py-3 font-body-sm transition" 
                                   placeholder="Masukkan nama lengkap" type="text" name="full_name" value="{{ old('full_name') }}" required/>
                        </div>
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2 font-medium">Nomor Telepon / WA *</label>
                            <input class="w-full rounded-xl border border-outline-variant/60 bg-surface-white focus:border-primary focus:ring-1 focus:ring-primary px-4 py-3 font-body-sm transition" 
                                   placeholder="Contoh: 08123456789" type="tel" name="phone_number" value="{{ old('phone_number') }}" required/>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2 font-medium">Layanan yang Dibutuhkan *</label>
                            <select class="w-full rounded-xl border border-outline-variant/60 bg-surface-white focus:border-primary focus:ring-1 focus:ring-primary px-4 py-3 font-body-sm text-on-surface-variant transition" 
                                    name="complaint_type" required>
                                <option value="" disabled selected>Pilih layanan...</option>
                                <option value="Prostetik" {{ old('complaint_type') == 'Prostetik' ? 'selected' : '' }}>Pembuatan Kaki/Tangan Palsu (Prostetik)</option>
                                <option value="Ortotik" {{ old('complaint_type') == 'Ortotik' ? 'selected' : '' }}>Alat Bantu Ortopedi / Brace (Ortotik)</option>
                                <option value="Scoliosis" {{ old('complaint_type') == 'Scoliosis' ? 'selected' : '' }}>Pusat Koreksi Skoliosis 3D</option>
                                <option value="Fisioterapi" {{ old('complaint_type') == 'Fisioterapi' ? 'selected' : '' }}>Fisioterapi & Gait Training</option>
                                <option value="Konsultasi" {{ old('complaint_type') == 'Konsultasi' ? 'selected' : '' }}>Konsultasi & Evaluasi Medis</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-2 font-medium">Tanggal Rencana</label>
                            <input class="w-full rounded-xl border border-outline-variant/60 bg-surface-white focus:border-primary focus:ring-1 focus:ring-primary px-4 py-3 font-body-sm transition" 
                                   type="date" name="preferred_date" value="{{ old('preferred_date', date('Y-m-d')) }}"/>
                        </div>
                    </div>

                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-2 font-medium">Cabang Klinik Pilihan</label>
                        <select class="w-full rounded-xl border border-outline-variant/60 bg-surface-white focus:border-primary focus:ring-1 focus:ring-primary px-4 py-3 font-body-sm text-on-surface-variant transition" 
                                name="branch_id">
                            @foreach($branches as $b)
                            <option value="{{ $b->id }}" {{ old('branch_id', request('branch_id')) == $b->id ? 'selected' : '' }}>
                                {{ $b->name }} ({{ $b->city }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-2 font-medium">Pesan / Keluhan Medis</label>
                        <textarea class="w-full rounded-xl border border-outline-variant/60 bg-surface-white focus:border-primary focus:ring-1 focus:ring-primary px-4 py-3 font-body-sm h-28 transition" 
                                  placeholder="Ceritakan keluhan atau kebutuhan alat bantu Anda" name="notes">{{ old('notes') }}</textarea>
                    </div>

                    <button class="w-full bg-[#E5A500] hover:bg-[#CC9200] text-surface-white px-8 py-4 rounded-xl font-label-md font-semibold transition-colors flex items-center justify-center gap-2 mt-2 shadow-lg hover:shadow-xl cursor-pointer" type="submit">
                        <span class="material-symbols-outlined">calendar_month</span> Jadwalkan Konsultasi
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection
