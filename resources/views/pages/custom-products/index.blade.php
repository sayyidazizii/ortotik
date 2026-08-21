@extends('layouts.app')

@section('title', 'Alur Pasien & Produk Custom-Made - pediOcare')
@section('meta_description', 'Dirancang dan diproduksi secara individual mengikuti anatomi dan kebutuhan biomekanik setiap pasien dengan garansi fitting 100%.')

@section('content')

@php
    $heroCustomBg = $settings['hero_about_image'] ?? asset('images/client_update/image4.png');
    if (!str_starts_with($heroCustomBg, 'http') && !str_starts_with($heroCustomBg, '/')) {
        $heroCustomBg = asset($heroCustomBg);
    }
@endphp

<!-- Hero Section -->
<section class="relative text-center mx-auto py-10 md:py-14 px-margin-mobile md:px-margin-desktop text-white w-full overflow-hidden fade-in-up" 
         style='background-image: linear-gradient(rgba(13, 28, 47, 0.82), rgba(13, 28, 47, 0.82)), url("{{ $heroCustomBg }}"); background-size: cover; background-position: center;'>
    <div class="max-w-container-max mx-auto relative z-10 space-y-2.5 sm:space-y-3">
        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-surface-white/15 text-primary-fixed border border-surface-white/25 text-[11px] font-bold uppercase tracking-wider backdrop-blur-sm">
            <span class="w-1.5 h-1.5 rounded-full bg-primary-fixed animate-pulse"></span>
            Individual Custom Fabrication
        </span>
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight text-white max-w-3xl mx-auto leading-tight">
            Alur Pasien & Produk Custom
        </h1>
        <p class="font-body-md text-body-md leading-relaxed text-slate-200 max-w-2xl mx-auto text-xs sm:text-sm">
            Dirancang dan diproduksi secara individual mengikuti anatomi dan kebutuhan biomekanik setiap pasien dengan garansi fitting 100%.
        </p>
    </div>
</section>

<!-- Zig-Zag Workflow Stepper Section -->
<section class="py-16 md:py-24 bg-surface-container-low border-b border-outline-variant/30 relative overflow-hidden">
    <!-- Background subtle ambient circles -->
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary/5 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-primary/5 blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-margin-mobile md:px-margin-desktop relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-14 space-y-2">
            <span class="text-xs font-bold text-primary uppercase tracking-wider inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary/10">
                <span class="material-symbols-outlined text-sm">route</span> Standard Operating Procedure
            </span>
            <h2 class="font-headline-lg text-2xl sm:text-3xl md:text-4xl font-bold text-on-background tracking-tight">
                4 Tahapan Alur Pasien
            </h2>
            <p class="text-on-surface-variant text-xs sm:text-sm max-w-xl mx-auto leading-relaxed">
                Setiap tahapan dirancang sistematis untuk menjamin akurasi biomekanik, kenyamanan soket, dan mobilitas mandiri.
            </p>
        </div>

        <!-- Zig-Zag Flow Container (Mobile & Desktop) -->
        <div class="relative space-y-2 sm:space-y-0">
            
            <!-- Step 1 (Left) -->
            <div class="flex justify-start w-full">
                <div class="w-[88%] sm:w-[78%] md:w-[48%] bg-surface-white p-4 sm:p-6 rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-primary"></div>
                    <div class="flex items-start gap-3 sm:gap-4">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-primary/10 text-primary font-bold text-sm sm:text-base flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors duration-300 shadow-2xs">
                            01
                        </div>
                        <div class="space-y-1 sm:space-y-1.5">
                            <div class="flex items-center gap-1.5 sm:gap-2">
                                <span class="material-symbols-outlined text-primary text-base sm:text-lg">clinical_notes</span>
                                <h3 class="text-xs sm:text-base font-bold text-on-background leading-tight">Konsultasi & Gait Analysis</h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-relaxed">
                                Pemeriksaan fisik komprehensif oleh tim Ortotis-Prostetis tersertifikasi dan evaluasi biomekanik pola gerak tubuh pasien.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connector 1: Left to Right Curved Dashed Spiral Arrow (Mobile & Desktop) -->
            <div class="flex justify-center items-center -my-2 sm:-my-4 relative z-0 pointer-events-none py-1">
                <svg class="w-48 sm:w-60 h-14 sm:h-16 text-primary/60" viewBox="0 0 220 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Spiral Curved Dashed Flow Path -->
                    <path d="M 40 10 C 140 5, 80 65, 175 62" stroke="currentColor" stroke-width="2.5" stroke-dasharray="6 6" stroke-linecap="round"/>
                    <!-- Arrow Head -->
                    <polygon points="175,55 192,62 175,69" fill="currentColor"/>
                    <!-- Decorative Spiral Loop Dot -->
                    <circle cx="40" cy="10" r="4" fill="currentColor"/>
                </svg>
            </div>

            <!-- Step 2 (Right) -->
            <div class="flex justify-end w-full">
                <div class="w-[88%] sm:w-[78%] md:w-[48%] bg-surface-white p-4 sm:p-6 rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 right-0 w-1.5 h-full bg-primary"></div>
                    <div class="flex items-start gap-3 sm:gap-4">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-primary/10 text-primary font-bold text-sm sm:text-base flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors duration-300 shadow-2xs">
                            02
                        </div>
                        <div class="space-y-1 sm:space-y-1.5">
                            <div class="flex items-center gap-1.5 sm:gap-2">
                                <span class="material-symbols-outlined text-primary text-base sm:text-lg">document_scanner</span>
                                <h3 class="text-xs sm:text-base font-bold text-on-background leading-tight">3D Scanning & Modifikasi</h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-relaxed">
                                Pengambilan data kontur anatomi akurasi sub-milimeter menggunakan optical 3D scanner dan perancangan digital CAD/CAM.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connector 2: Right to Left Curved Dashed Spiral Arrow (Mobile & Desktop) -->
            <div class="flex justify-center items-center -my-2 sm:-my-4 relative z-0 pointer-events-none py-1">
                <svg class="w-48 sm:w-60 h-14 sm:h-16 text-primary/60" viewBox="0 0 220 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Spiral Curved Dashed Flow Path -->
                    <path d="M 180 10 C 80 5, 140 65, 45 62" stroke="currentColor" stroke-width="2.5" stroke-dasharray="6 6" stroke-linecap="round"/>
                    <!-- Arrow Head -->
                    <polygon points="45,55 28,62 45,69" fill="currentColor"/>
                    <!-- Decorative Spiral Loop Dot -->
                    <circle cx="180" cy="10" r="4" fill="currentColor"/>
                </svg>
            </div>

            <!-- Step 3 (Left) -->
            <div class="flex justify-start w-full">
                <div class="w-[88%] sm:w-[78%] md:w-[48%] bg-surface-white p-4 sm:p-6 rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-primary"></div>
                    <div class="flex items-start gap-3 sm:gap-4">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-primary/10 text-primary font-bold text-sm sm:text-base flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors duration-300 shadow-2xs">
                            03
                        </div>
                        <div class="space-y-1 sm:space-y-1.5">
                            <div class="flex items-center gap-1.5 sm:gap-2">
                                <span class="material-symbols-outlined text-primary text-base sm:text-lg">precision_manufacturing</span>
                                <h3 class="text-xs sm:text-base font-bold text-on-background leading-tight">Fabrikasi Carbon Composite</h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-relaxed">
                                Pengerjaan mandiri di workshop tersertifikasi menggunakan rajutan serat karbon ringan berkekuatan tinggi berstandar medis.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connector 3: Left to Right Curved Dashed Spiral Arrow (Mobile & Desktop) -->
            <div class="flex justify-center items-center -my-2 sm:-my-4 relative z-0 pointer-events-none py-1">
                <svg class="w-48 sm:w-60 h-14 sm:h-16 text-primary/60" viewBox="0 0 220 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Spiral Curved Dashed Flow Path -->
                    <path d="M 40 10 C 140 5, 80 65, 175 62" stroke="currentColor" stroke-width="2.5" stroke-dasharray="6 6" stroke-linecap="round"/>
                    <!-- Arrow Head -->
                    <polygon points="175,55 192,62 175,69" fill="currentColor"/>
                    <!-- Decorative Spiral Loop Dot -->
                    <circle cx="40" cy="10" r="4" fill="currentColor"/>
                </svg>
            </div>

            <!-- Step 4 (Right) -->
            <div class="flex justify-end w-full">
                <div class="w-[88%] sm:w-[78%] md:w-[48%] bg-surface-white p-4 sm:p-6 rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-1 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 right-0 w-1.5 h-full bg-[#E5A500]"></div>
                    <div class="flex items-start gap-3 sm:gap-4">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-[#E5A500]/15 text-[#B38000] font-bold text-sm sm:text-base flex items-center justify-center shrink-0 group-hover:bg-[#E5A500] group-hover:text-white transition-colors duration-300 shadow-2xs">
                            04
                        </div>
                        <div class="space-y-1 sm:space-y-1.5">
                            <div class="flex items-center gap-1.5 sm:gap-2">
                                <span class="material-symbols-outlined text-[#B38000] text-base sm:text-lg">directions_walk</span>
                                <h3 class="text-xs sm:text-base font-bold text-on-background leading-tight">Fitting & Gait Training</h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-relaxed">
                                Penyetelan dinamis soket, evaluasi beban tumpuan, serta bimbingan rehabilitasi berjalan hingga pasien nyaman dan mandiri.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Custom Products Grid -->
<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($customProducts as $cp)
        <div class="bg-surface-white rounded-3xl border border-outline-variant/30 p-8 flex flex-col justify-between shadow-1 hover:shadow-hover transition-all duration-300 group hover:-translate-y-1">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase px-3 py-1 bg-primary/10 text-primary rounded-full">Custom-Made</span>
                    <span class="text-xs text-on-surface-variant font-medium flex items-center gap-1">
                        <span class="material-symbols-outlined text-primary text-sm">verified</span> Garansi Fitting 100%
                    </span>
                </div>
                
                <h3 class="font-headline-md text-xl font-bold text-on-background group-hover:text-primary transition-colors leading-snug">
                    <a href="{{ route('custom-products.show', $cp->slug) }}">{{ $cp->name }}</a>
                </h3>

                <p class="text-sm text-on-surface-variant leading-relaxed">{{ $cp->summary }}</p>

                @if($cp->features && count($cp->features) > 0)
                <div class="p-5 bg-surface-container-low rounded-2xl border border-outline-variant/20 space-y-2.5">
                    <span class="text-xs font-bold text-primary uppercase tracking-wider block">Fitur & Keunggulan:</span>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-on-surface-variant">
                        @foreach($cp->features as $f)
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-xs">check_circle</span>
                            <span>{{ $f }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="mt-8 pt-5 border-t border-outline-variant/15 grid grid-cols-2 gap-3">
                <a href="{{ route('custom-products.show', $cp->slug) }}" class="flex items-center justify-center bg-surface-container-low hover:bg-surface-container-high text-on-surface text-xs font-semibold h-11 rounded-xl border border-outline-variant/30 transition">
                    Lihat Tahapan
                </a>
                <a href="https://wa.me/6285697922194?text=Halo%20pediOcare,%20saya%20ingin%20konsultasi%20pembuatan%20custom%20{{ urlencode($cp->name) }}." target="_blank"
                    class="flex items-center justify-center bg-primary hover:bg-secondary text-surface-white text-xs font-semibold h-11 rounded-xl transition shadow-sm">
                    Konsultasi WA
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
