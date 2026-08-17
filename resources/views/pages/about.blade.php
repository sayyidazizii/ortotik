@extends('layouts.app')

@section('title', 'Tentang Kami - PT. Orthocare Indonesia')
@section('meta_description', 'Profil dan komitmen PT. Orthocare Indonesia dalam memberikan pelayanan ortotik dan prostetik berteknologi tinggi berstandar Kemenkes RI.')

@section('content')

<!-- Hero Section -->
<section class="relative py-20 md:py-28 px-margin-mobile md:px-margin-desktop overflow-hidden bg-cover bg-center flex items-center justify-center fade-in-up"
         style="background-image: linear-gradient(rgba(13, 28, 47, 0.75), rgba(13, 28, 47, 0.75)), url('https://lh3.googleusercontent.com/aida/AP1WRLsQeJ73W2vO0_8Vv2_uR_3cT7-T_u-f_Hq0_80K89kL0_QvT12_29Z_w3-F05W4-B97x6H5k_l7k2uL_t2K0fL0wVp3F2Q1M5s7C5A3Q0T8_m9-l2rZ3W50M1Z2qW9M3Q7x91c0');">
    <div class="max-w-container-max mx-auto text-center relative z-10 space-y-4">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-white/10 text-primary-fixed border border-surface-white/20 text-xs font-semibold uppercase tracking-wider backdrop-blur-sm">
            <span class="w-2 h-2 rounded-full bg-primary-fixed animate-pulse"></span>
            High-Tech Orthopedic Care
        </span>
        <h1 class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl font-bold text-surface-white tracking-tight">
            Tentang PT. Orthocare Indonesia
        </h1>
        <p class="font-body-lg text-body-lg text-surface-white/90 max-w-2xl mx-auto leading-relaxed">
            Menghadirkan perawatan ortopedi presisi berbasis teknologi tinggi dengan sentuhan kepedulian yang hangat.
        </p>
    </div>
</section>

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-16 space-y-16">
    
    <!-- Vision & Overview Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
        <div class="lg:col-span-6 space-y-6">
            <span class="text-xs font-semibold uppercase tracking-wider text-primary">Visi & Dedikasi Kami</span>
            <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg font-bold text-on-background tracking-tight">
                Mengembalikan Mobilitas & Kualitas Hidup Anda
            </h2>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                PT. Orthocare Indonesia adalah pusat layanan ortotik dan prostetik modern yang memadukan keahlian klinis bersertifikasi dengan teknologi digital terkini seperti pemindaian optik 3D dan fabrikasi material komposit carbon fiber.
            </p>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                Setiap pasien menerima pendekatan yang dipersonalisasi—mulai dari evaluasi biomekanik mendalam, perancangan soket yang akurat, hingga program latihan adaptasi berjalan (gait training) bersama fisioterapis kami.
            </p>
            <div class="grid grid-cols-2 gap-4 pt-2">
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30">
                    <span class="block text-2xl font-bold text-primary mb-1">100%</span>
                    <span class="text-xs text-on-surface-variant">Garansi Fitting Pas & Nyaman</span>
                </div>
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30">
                    <span class="block text-2xl font-bold text-primary mb-1">Resmi</span>
                    <span class="text-xs text-on-surface-variant">Sertifikasi Kemenkes RI</span>
                </div>
            </div>
        </div>
        <div class="lg:col-span-6 relative rounded-3xl overflow-hidden shadow-2 h-[400px] md:h-[480px] border border-outline-variant/20 group">
            <img src="https://lh3.googleusercontent.com/aida/AP1WRLsQeJ73W2vO0_8Vv2_uR_3cT7-T_u-f_Hq0_80K89kL0_QvT12_29Z_w3-F05W4-B97x6H5k_l7k2uL_t2K0fL0wVp3F2Q1M5s7C5A3Q0T8_m9-l2rZ3W50M1Z2qW9M3Q7x91c0" 
                 alt="Fasilitas Klinik Orthocare" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
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
                Penerapan 3D optical scan dan printer biomedis untuk mencapai akurasi soket tingkat tinggi tanpa prosedur gips konvensional.
            </p>
        </div>

        <div class="bg-surface-white p-8 rounded-3xl border border-outline-variant/30 shadow-1 space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl">verified_user</span>
            </div>
            <h3 class="font-headline-md text-lg font-bold text-on-background">Standar Kemenkes RI</h3>
            <p class="text-xs text-on-surface-variant leading-relaxed">
                Seluruh prosedur klinis dan workshop fabrikasi di bawah pengawasan langsung praktisi Ortotis-Prostetis terdaftar resmi.
            </p>
        </div>

        <div class="bg-surface-white p-8 rounded-3xl border border-outline-variant/30 shadow-1 space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl">favorite</span>
            </div>
            <h3 class="font-headline-md text-lg font-bold text-on-background">Pendampingan Empatik</h3>
            <p class="text-xs text-on-surface-variant leading-relaxed">
                Kami mendampingi setiap tahapan pemulihan Anda dengan sabar dan teliti hingga Anda kembali beraktivitas dengan mandiri.
            </p>
        </div>
    </div>

    <!-- Bottom CTA Card -->
    <div class="bg-primary rounded-3xl p-8 md:p-12 text-surface-white flex flex-col md:flex-row justify-between items-center gap-6 shadow-2">
        <div class="space-y-2 text-center md:text-left">
            <h3 class="font-headline-lg text-2xl font-bold text-white">Siap Berkonsultasi Mengenai Kebutuhan Mobilitas Anda?</h3>
            <p class="text-sm text-white/80 max-w-xl">Kunjungi klinik kami di Sleman, D.I. Yogyakarta atau jadwalkan janji temu daring bersama tim spesialis kami.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('consultation.create') }}" class="bg-[#E5A500] hover:bg-[#CC9200] text-surface-white font-semibold text-xs px-7 py-3.5 rounded-xl transition shadow-md">
                Jadwalkan Konsultasi
            </a>
            <a href="{{ route('contact') }}" class="bg-surface-white/10 hover:bg-surface-white/20 text-white font-semibold text-xs px-6 py-3.5 rounded-xl border border-surface-white/30 transition">
                Kontak & Lokasi
            </a>
        </div>
    </div>

</div>

@endsection
