@extends('layouts.app')

@section('title', 'Tentang Kami - pediOcare')
@section('meta_description', 'Pediocare Berdedikasi melakukan Pelayanan Ortotik Prostetik untuk membantu menunjang fungsi gerak, kenyamanan, serta kualitas hidup pengguna. Care your milestone.')

@section('content')

@php
    $heroAboutBg = $settings['hero_about_image']->value ?? ($settings['hero_about_image'] ?? asset('images/client_update/image4.png'));
    if (!str_starts_with($heroAboutBg, 'http') && !str_starts_with($heroAboutBg, '/')) {
        $heroAboutBg = asset($heroAboutBg);
    }

    $clinicName = $settings['clinic_name']->value ?? ($settings['clinic_name'] ?? 'pediOcare');
    $clinicTagline = $settings['clinic_tagline']->value ?? ($settings['clinic_tagline'] ?? 'Care your milestone');
    $companyDesc = $settings['about_company_description']->value ?? ($settings['about_company_description'] ?? 'Pediocare Berdedikasi melakukan Pelayanan Ortotik Prostetik untuk membantu menunjang fungsi gerak, kenyamanan, serta kualitas hidup pengguna. Sejak 2012 Pediocare telah melayani dengan menghadirkan produk custom maupun readymade dengan mengutamakan kualitas bahan, kerapian pengerjaan, serta memperhatikan kebutuhan setiap pengguna. Dengan 14 tahun pengalaman di dunia alat bantu, Pediocare akan selalu berkomitmen memberi solusi yang terbaik dan dapat diandalkan.');

    $usp1 = $settings['about_usp_1']->value ?? 'Teknologi terkini dengan standar pelayanan & alat customize yang presisi.';
    $usp2 = $settings['about_usp_2']->value ?? 'Praktisi Ortotis Prostetis legal memiliki STR & Surat Ijin Praktik Dinas Kesehatan.';
    $usp3 = $settings['about_usp_3']->value ?? 'Pelayanan komprehensif dan paripurna (konsultasi gratis).';

    $badge1Val = $settings['about_badge_1_value']->value ?? '100%';
    $badge1Lbl = $settings['about_badge_1_label']->value ?? 'Garansi Fitting Pas & Nyaman';
    $badge2Val = $settings['about_badge_2_value']->value ?? 'Resmi';
    $badge2Lbl = $settings['about_badge_2_label']->value ?? 'Berlisensi STR & SIP Kemenkes';

    $actSetting = $settings['about_activity_images']->value ?? ($settings['about_activity_images'] ?? null);
    $activityImgs = [];
    if (!empty($actSetting)) {
        $decoded = is_array($actSetting) ? $actSetting : json_decode($actSetting, true);
        if (is_array($decoded) && count($decoded) > 0) {
            $activityImgs = array_values(array_filter($decoded));
        }
    }
    if (empty($activityImgs)) {
        $activityImgs = [
            asset('images/client_update/image2.png'),
            asset('images/client_update/image5.png'),
            asset('images/client_update/image3.png')
        ];
    }
    foreach ($activityImgs as &$aimg) {
        if (!str_starts_with($aimg, 'http') && !str_starts_with($aimg, '/')) {
            $aimg = asset($aimg);
        }
    }
    unset($aimg);

    $valuesSetting = $settings['about_values']->value ?? ($settings['about_values'] ?? null);
    $coreValues = [];
    if (!empty($valuesSetting)) {
        $decoded = is_array($valuesSetting) ? $valuesSetting : json_decode($valuesSetting, true);
        if (is_array($decoded) && count($decoded) > 0) {
            $coreValues = $decoded;
        }
    }
    if (empty($coreValues)) {
        $coreValues = [
            ['title' => 'Teknologi Mutakhir', 'icon' => 'science', 'desc' => 'Penerapan 3D optical scan dan modifikasi biomedis presisi untuk mencapai akurasi soket dan brace tingkat tinggi yang nyaman digunakan.'],
            ['title' => 'Standar Kemenkes RI', 'icon' => 'verified_user', 'desc' => 'Seluruh prosedur klinis dan workshop fabrikasi ditangani langsung oleh praktisi Ortotis-Prostetis yang memiliki Surat Tanda Registrasi dan Surat Izin Praktik.'],
            ['title' => 'Pendampingan Empatik', 'icon' => 'favorite', 'desc' => 'Kami mendampingi setiap tahapan pemulihan Anda dengan sabar dan teliti hingga Anda kembali beraktivitas dengan mandiri dan percaya diri.']
        ];
    }

    $fabBadge = $settings['about_fabrication_badge']->value ?? 'pediOcare akan terus berkembang menuju inovasi fabrikasi modern';
    $fabTitle = $settings['about_fabrication_title']->value ?? 'Inovasi Fabrikasi Modern';
    $fabDesc = $settings['about_fabrication_desc']->value ?? 'Dengan memadukan ketelitian pengrajin ortotik prostetik berpengalaman dan peralatan modern, kami menghasilkan soket dan alat bantu yang memiliki tingkat presisi tinggi, distribusi tumpuan beban yang merata, serta estetika anatomi yang optimal.';
    $fabImage = $settings['about_fabrication_image']->value ?? 'images/client_update_rev2/image12.png';
    if (!str_starts_with($fabImage, 'http') && !str_starts_with($fabImage, '/')) {
        $fabImage = asset($fabImage);
    }
    $fabFeat1Icon = $settings['about_fab_feature_1_icon']->value ?? 'precision_manufacturing';
    $fabFeat1Text = $settings['about_fab_feature_1_text']->value ?? 'Mesin Fabrikasi Presisi';
    $fabFeat2Icon = $settings['about_fab_feature_2_icon']->value ?? 'verified';
    $fabFeat2Text = $settings['about_fab_feature_2_text']->value ?? 'Material Medis Standar Kemenkes';

    $ctaTitle = $settings['about_cta_title']->value ?? 'Siap Berkonsultasi Mengenai Kebutuhan Mobilitas Anda?';
    $ctaDesc = $settings['about_cta_desc']->value ?? 'Kunjungi klinik kami di Sleman, D.I. Yogyakarta atau jadwalkan janji temu konsultasi WhatsApp di 0856 9792 2194.';
    $ctaBtnText = $settings['about_cta_btn_text']->value ?? 'Kontak & Janji Temu';
    $ctaWaText = $settings['about_cta_wa_text']->value ?? 'Chat WhatsApp';
@endphp

<!-- Hero Section -->
<section class="relative py-10 md:py-14 px-margin-mobile md:px-margin-desktop overflow-hidden bg-cover bg-center flex items-center justify-center fade-in-up"
         style="background-image: linear-gradient(rgba(13, 28, 47, 0.82), rgba(13, 28, 47, 0.82)), url('{{ $heroAboutBg }}');">
    <div class="max-w-container-max mx-auto text-center relative z-10 space-y-2.5 sm:space-y-3">
        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-surface-white/15 text-primary-fixed border border-surface-white/25 text-[11px] font-bold uppercase tracking-wider backdrop-blur-sm">
            {{ $settings['hero_about_badge']->value ?? ($settings['hero_about_badge'] ?? $clinicTagline) }}
        </span>
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-surface-white tracking-tight leading-tight">
            {{ $settings['hero_about_title']->value ?? ($settings['hero_about_title'] ?? ('Tentang ' . $clinicName)) }}
        </h1>
        <p class="font-body-md text-body-md text-surface-white/90 max-w-2xl mx-auto leading-relaxed text-xs sm:text-sm">
            {{ $settings['hero_about_subtitle']->value ?? ($settings['hero_about_subtitle'] ?? 'Pelayanan Ortotik Prostetik profesional dengan semangat bermanfaat untuk menunjang fungsi gerak, kenyamanan, serta kualitas hidup pengguna.') }}
        </p>
    </div>
</section>

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-16 space-y-16">
    
    <!-- Vision & Overview Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
        <div class="lg:col-span-6 space-y-6">
            <div class="space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-primary">{{ $clinicName }}</span>
                <h2 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg font-black text-on-background tracking-tight">
                    {{ $clinicTagline }}
                </h2>
            </div>
            
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                {{ $companyDesc }}
            </p>

            <!-- 3 USP Points Checklist -->
            <div class="space-y-3 pt-2">
                <div class="flex items-start gap-2.5">
                    <span class="material-symbols-outlined text-primary text-xl shrink-0 mt-0.5">check_circle</span>
                    <span class="text-xs sm:text-sm text-slate-700 font-medium leading-snug">{{ $usp1 }}</span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="material-symbols-outlined text-primary text-xl shrink-0 mt-0.5">check_circle</span>
                    <span class="text-xs sm:text-sm text-slate-700 font-medium leading-snug">{{ $usp2 }}</span>
                </div>
                <div class="flex items-start gap-2.5">
                    <span class="material-symbols-outlined text-primary text-xl shrink-0 mt-0.5">check_circle</span>
                    <span class="text-xs sm:text-sm text-slate-700 font-medium leading-snug">{{ $usp3 }}</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 pt-2">
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30">
                    <span class="block text-2xl font-bold text-primary mb-1">{{ $badge1Val }}</span>
                    <span class="text-xs text-on-surface-variant font-semibold">{{ $badge1Lbl }}</span>
                </div>
                <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30">
                    <span class="block text-2xl font-bold text-primary mb-1">{{ $badge2Val }}</span>
                    <span class="text-xs text-on-surface-variant font-semibold">{{ $badge2Lbl }}</span>
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-6 relative rounded-3xl overflow-hidden shadow-2 h-[400px] md:h-[480px] border border-outline-variant/20 group"
             x-data="{ currentImg: 0, imgs: @js($activityImgs) }"
             x-init="setInterval(() => { if (imgs.length > 1) currentImg = (currentImg + 1) % imgs.length }, 3500)">
            <template x-for="(imgSrc, i) in imgs" :key="i">
                <img :src="imgSrc" alt="Fasilitas & Pelayanan Klinik pediOcare" 
                     x-show="currentImg === i"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/>
            </template>
            <!-- Badge Counter -->
            <div class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-sm text-white text-[10px] px-2.5 py-1 rounded-full font-mono flex items-center gap-1.5 shadow-sm">
                <span class="material-symbols-outlined text-xs">photo_camera</span>
                <span x-text="(currentImg + 1) + ' / ' + imgs.length"></span>
            </div>
        </div>
    </div>

    <!-- Inovasi Fabrikasi Modern Section -->
    <div class="bg-gradient-to-br from-slate-900 via-primary to-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-xl overflow-hidden relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
            <div class="lg:col-span-7 space-y-4">
                <span class="text-xs font-bold uppercase tracking-wider text-sky-300 inline-block">
                    {{ $fabBadge }}
                </span>
                <h3 class="font-headline-lg text-2xl sm:text-3xl font-black text-white tracking-tight">
                    {{ $fabTitle }}
                </h3>
                <p class="text-xs sm:text-sm text-slate-200 leading-relaxed max-w-xl">
                    {{ $fabDesc }}
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 text-white text-xs font-semibold backdrop-blur-sm border border-white/15">
                        <span class="material-symbols-outlined text-sm text-sky-300">{{ $fabFeat1Icon }}</span> {{ $fabFeat1Text }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 text-white text-xs font-semibold backdrop-blur-sm border border-white/15">
                        <span class="material-symbols-outlined text-sm text-sky-300">{{ $fabFeat2Icon }}</span> {{ $fabFeat2Text }}
                    </span>
                </div>
            </div>
            <div class="lg:col-span-5">
                <div class="rounded-2xl overflow-hidden border-2 border-white/20 shadow-2xl group">
                    <img src="{{ $fabImage }}" alt="Inovasi Fabrikasi Modern pediOcare" class="w-full h-64 sm:h-72 object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
            </div>
        </div>
    </div>

    <!-- 3 Core Values -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($coreValues as $cv)
        <div class="bg-surface-white p-8 rounded-3xl border border-outline-variant/30 shadow-1 space-y-4 hover:shadow-hover transition duration-300">
            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl">{{ $cv['icon'] ?? 'check_circle' }}</span>
            </div>
            <h3 class="font-headline-md text-lg font-bold text-on-background">{{ $cv['title'] ?? '' }}</h3>
            <p class="text-xs text-on-surface-variant leading-relaxed">
                {{ $cv['desc'] ?? '' }}
            </p>
        </div>
        @endforeach
    </div>

    <!-- Bottom CTA Card -->
    <div class="bg-primary rounded-3xl p-8 md:p-12 text-surface-white flex flex-col md:flex-row justify-between items-center gap-6 shadow-2">
        <div class="space-y-2 text-center md:text-left">
            <h3 class="font-headline-lg text-2xl font-bold text-white">{{ $ctaTitle }}</h3>
            <p class="text-sm text-white/80 max-w-xl">{{ $ctaDesc }}</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('contact') }}" class="bg-[#E5A500] hover:bg-[#CC9200] text-surface-white font-bold text-xs px-7 py-3.5 rounded-xl transition shadow-md">
                {{ $ctaBtnText }}
            </a>
            <a href="https://wa.me/6285697922194" target="_blank" rel="noopener noreferrer" class="bg-surface-white/10 hover:bg-surface-white/20 text-white font-bold text-xs px-6 py-3.5 rounded-xl border border-surface-white/30 transition">
                {{ $ctaWaText }}
            </a>
        </div>
    </div>

</div>

@endsection
