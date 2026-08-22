@extends('layouts.app')

@section('title', 'Tentang Kami - pediOcare')
@section('meta_description', 'Pediocare Berdedikasi melakukan Pelayanan Ortotik Prostetik untuk membantu menunjang fungsi gerak, kenyamanan, serta kualitas hidup pengguna. Care your milestone.')

@section('content')

@php
    $heroAboutBg = $settings['hero_about_image'] ?? asset('images/client_update/image4.png');
    if (!str_starts_with($heroAboutBg, 'http') && !str_starts_with($heroAboutBg, '/')) {
        $heroAboutBg = asset($heroAboutBg);
    }
@endphp

<!-- Hero Section -->
<section class="relative py-10 md:py-14 px-margin-mobile md:px-margin-desktop overflow-hidden bg-cover bg-center flex items-center justify-center fade-in-up"
         style="background-image: linear-gradient(rgba(13, 28, 47, 0.82), rgba(13, 28, 47, 0.82)), url('{{ $heroAboutBg }}');">
    <div class="max-w-container-max mx-auto text-center relative z-10 space-y-2.5 sm:space-y-3">
        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-surface-white/15 text-primary-fixed border border-surface-white/25 text-[11px] font-bold uppercase tracking-wider backdrop-blur-sm">
            {{ $settings['hero_about_badge'] ?? ($settings['clinic_tagline'] ?? 'Care your milestone') }}
        </span>
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-surface-white tracking-tight leading-tight">
            {{ $settings['hero_about_title'] ?? ('Tentang ' . ($settings['clinic_name'] ?? 'pediOcare')) }}
        </h1>
        <p class="font-body-md text-body-md text-surface-white/90 max-w-2xl mx-auto leading-relaxed text-xs sm:text-sm">
            {{ $settings['hero_about_subtitle'] ?? 'Pelayanan Ortotik Prostetik profesional dengan semangat bermanfaat untuk menunjang fungsi gerak, kenyamanan, serta kualitas hidup pengguna.' }}
        </p>
    </div>
</section>

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-16 space-y-16">
    
    <!-- Vision & Overview Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
        <div class="lg:col-span-6 space-y-6">
            <span class="text-xs font-bold uppercase tracking-wider text-primary">Visi & Dedikasi Kami</span>
            <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg font-black text-on-background tracking-tight">
                Care your milestone
            </h2>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                {{ $settings['about_company_description'] ?? 'Pediocare Berdedikasi melakukan Pelayanan Ortotik Prostetik untuk membantu menunjang fungsi gerak, kenyamanan, serta kualitas hidup pengguna. Sejak 2012 Pediocare telah melayani dengan menghadirkan produk custom maupun readymade dengan mengutamakan kualitas bahan, kerapian pengerjaan, serta memperhatikan kebutuhan setiap pengguna. Dengan 14 tahun pengalaman di dunia alat bantu, Pediocare akan selalu berkomitmen memberi solusi yang terbaik dan dapat diandalkan.' }}
            </p>
            <div class="grid grid-cols-2 gap-4 pt-2">
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30">
                    <span class="block text-2xl font-bold text-primary mb-1">100%</span>
                    <span class="text-xs text-on-surface-variant font-semibold">Garansi Fitting Pas & Nyaman</span>
                </div>
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30">
                    <span class="block text-2xl font-bold text-primary mb-1">Resmi</span>
                    <span class="text-xs text-on-surface-variant font-semibold">Berlisensi STR & SIP Kemenkes</span>
                </div>
            </div>
        </div>
        <div class="lg:col-span-6 relative rounded-3xl overflow-hidden shadow-2 h-[400px] md:h-[480px] border border-outline-variant/20 group"
             x-data="{ currentImg: 0, imgs: ['{{ asset('images/client_update/image2.png') }}', '{{ asset('images/client_update/image5.png') }}', '{{ asset('images/client_update/image3.png') }}'] }"
             x-init="setInterval(() => { currentImg = (currentImg + 1) % imgs.length }, 3500)">
            <template x-for="(imgSrc, i) in imgs" :key="i">
                <img :src="imgSrc" alt="Fasilitas & Pelayanan Klinik pediOcare" 
                     x-show="currentImg === i"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
            </template>
        </div>
    </div>

    <!-- 3 Core Values -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-surface-white p-8 rounded-3xl border border-outline-variant/30 shadow-1 space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl">science</span>
            </div>
            <h3 class="font-headline-md text-lg font-bold text-on-background">Teknologi Mutakhir</h3>
            <p class="text-xs text-on-surface-variant leading-relaxed">
                Penerapan 3D optical scan dan modifikasi biomedis presisi untuk mencapai akurasi soket dan brace tingkat tinggi yang nyaman digunakan.
            </p>
        </div>

        <div class="bg-surface-white p-8 rounded-3xl border border-outline-variant/30 shadow-1 space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl">verified_user</span>
            </div>
            <h3 class="font-headline-md text-lg font-bold text-on-background">Standar Kemenkes RI</h3>
            <p class="text-xs text-on-surface-variant leading-relaxed">
                Seluruh prosedur klinis dan workshop fabrikasi ditangani langsung oleh praktisi Ortotis-Prostetis yang memiliki Surat Tanda Registrasi dan Surat Izin Praktik.
            </p>
        </div>

        <div class="bg-surface-white p-8 rounded-3xl border border-outline-variant/30 shadow-1 space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl">favorite</span>
            </div>
            <h3 class="font-headline-md text-lg font-bold text-on-background">Pendampingan Empatik</h3>
            <p class="text-xs text-on-surface-variant leading-relaxed">
                Kami mendampingi setiap tahapan pemulihan Anda dengan sabar dan teliti hingga Anda kembali beraktivitas dengan mandiri dan percaya diri.
            </p>
        </div>
    </div>

    <!-- Bottom CTA Card -->
    <div class="bg-primary rounded-3xl p-8 md:p-12 text-surface-white flex flex-col md:flex-row justify-between items-center gap-6 shadow-2">
        <div class="space-y-2 text-center md:text-left">
            <h3 class="font-headline-lg text-2xl font-bold text-white">Siap Berkonsultasi Mengenai Kebutuhan Mobilitas Anda?</h3>
            <p class="text-sm text-white/80 max-w-xl">Kunjungi klinik kami di Sleman, D.I. Yogyakarta atau jadwalkan janji temu konsultasi WhatsApp di 0856 9792 2194.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('contact') }}" class="bg-[#E5A500] hover:bg-[#CC9200] text-surface-white font-bold text-xs px-7 py-3.5 rounded-xl transition shadow-md">
                Kontak & Janji Temu
            </a>
            <a href="https://wa.me/6285697922194" target="_blank" rel="noopener noreferrer" class="bg-surface-white/10 hover:bg-surface-white/20 text-white font-bold text-xs px-6 py-3.5 rounded-xl border border-surface-white/30 transition">
                Chat WhatsApp
            </a>
        </div>
    </div>

</div>

@endsection
