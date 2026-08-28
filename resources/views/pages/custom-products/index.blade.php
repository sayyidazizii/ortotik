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
<section class="py-12 md:py-16 bg-surface-container-low border-b border-outline-variant/30 relative overflow-hidden">
    <!-- Background subtle ambient circles -->
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary/5 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-primary/5 blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-margin-mobile md:px-margin-desktop relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-10 space-y-2">
            <span class="text-xs font-bold text-primary uppercase tracking-wider inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary/10">
                <span class="material-symbols-outlined text-sm">route</span> Standar Pelayanan Kemenkes RI
            </span>
            <h2 class="font-headline-lg text-2xl sm:text-3xl md:text-4xl font-bold text-on-background tracking-tight">
                9 Tahapan Alur Pasien
            </h2>
            <p class="text-on-surface-variant text-xs sm:text-sm max-w-xl mx-auto leading-relaxed">
                Alur prosedur pelayanan klinis terstandar dari asesmen awal hingga tindak lanjut berkala untuk menjamin akurasi biomekanik, kenyamanan, dan mobilitas mandiri.
            </p>
        </div>

        <!-- Zig-Zag Flow Container (Mobile & Desktop) -->
        <div class="relative space-y-1 sm:space-y-0">
            
            <!-- Step 1 (Left) -->
            <div class="flex justify-start w-full">
                <div class="w-[92%] sm:w-[84%] md:w-[48%] bg-surface-white p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-0.5 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                    <div class="flex items-start gap-2.5 sm:gap-3.5">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl bg-primary/10 text-primary font-bold text-xs sm:text-sm flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors duration-300 shadow-2xs">
                            01
                        </div>
                        <div class="space-y-0.5 sm:space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-primary text-sm sm:text-base">clinical_notes</span>
                                <h3 class="text-xs sm:text-sm font-bold text-on-background leading-tight">Pemeriksaan <span class="text-[10px] sm:text-xs text-primary font-normal italic">(assessment)</span></h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-snug sm:leading-relaxed">
                                Pemeriksaan fisik komprehensif oleh tim Ortotis-Prostetis tersertifikasi, anamnesis riwayat medis, serta evaluasi kondisi ekstremitas/stump dan kebutuhan fungsional pasien.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connector 1: Left to Right Curved Dashed Spiral Arrow -->
            <div class="flex justify-center items-center -my-2.5 sm:-my-3.5 relative z-0 pointer-events-none">
                <svg class="w-36 sm:w-48 h-6 sm:h-7 text-primary/50" viewBox="0 0 200 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 35 4 C 115 4, 85 26, 165 26" stroke="currentColor" stroke-width="1.8" stroke-dasharray="4 4" stroke-linecap="round"/>
                    <polygon points="165,22 175,26 165,30" fill="currentColor"/>
                    <circle cx="35" cy="4" r="2.5" fill="currentColor"/>
                </svg>
            </div>

            <!-- Step 2 (Right) -->
            <div class="flex justify-end w-full">
                <div class="w-[92%] sm:w-[84%] md:w-[48%] bg-surface-white p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-0.5 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 right-0 w-1 h-full bg-primary"></div>
                    <div class="flex items-start gap-2.5 sm:gap-3.5">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl bg-primary/10 text-primary font-bold text-xs sm:text-sm flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors duration-300 shadow-2xs">
                            02
                        </div>
                        <div class="space-y-0.5 sm:space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-primary text-sm sm:text-base">prescriptions</span>
                                <h3 class="text-xs sm:text-sm font-bold text-on-background leading-tight">Diagnosis, preskripsi <span class="text-[10px] sm:text-xs text-primary font-normal italic">(prescription)</span></h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-snug sm:leading-relaxed">
                                Penetapan diagnosis klinis ortotik-prostetik dan penentuan rekomendasi spesifikasi desain alat bantu, jenis soket, serta pemilihan komponen yang tepat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connector 2: Right to Left Curved Dashed Spiral Arrow -->
            <div class="flex justify-center items-center -my-2.5 sm:-my-3.5 relative z-0 pointer-events-none">
                <svg class="w-36 sm:w-48 h-6 sm:h-7 text-primary/50" viewBox="0 0 200 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 165 4 C 85 4, 115 26, 35 26" stroke="currentColor" stroke-width="1.8" stroke-dasharray="4 4" stroke-linecap="round"/>
                    <polygon points="35,22 25,26 35,30" fill="currentColor"/>
                    <circle cx="165" cy="4" r="2.5" fill="currentColor"/>
                </svg>
            </div>

            <!-- Step 3 (Left) -->
            <div class="flex justify-start w-full">
                <div class="w-[92%] sm:w-[84%] md:w-[48%] bg-surface-white p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-0.5 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                    <div class="flex items-start gap-2.5 sm:gap-3.5">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl bg-primary/10 text-primary font-bold text-xs sm:text-sm flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors duration-300 shadow-2xs">
                            03
                        </div>
                        <div class="space-y-0.5 sm:space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-primary text-sm sm:text-base">straighten</span>
                                <h3 class="text-xs sm:text-sm font-bold text-on-background leading-tight">Pengukuran <span class="text-[10px] sm:text-xs text-primary font-normal italic">(measurement)</span></h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-snug sm:leading-relaxed">
                                Pengambilan ukuran dan parameter anatomis secara mendalam, presisi, dan teliti guna menjamin kesesuaian dimensi alat bantu dengan proporsi tubuh pasien.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connector 3: Left to Right Curved Dashed Spiral Arrow -->
            <div class="flex justify-center items-center -my-2.5 sm:-my-3.5 relative z-0 pointer-events-none">
                <svg class="w-36 sm:w-48 h-6 sm:h-7 text-primary/50" viewBox="0 0 200 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 35 4 C 115 4, 85 26, 165 26" stroke="currentColor" stroke-width="1.8" stroke-dasharray="4 4" stroke-linecap="round"/>
                    <polygon points="165,22 175,26 165,30" fill="currentColor"/>
                    <circle cx="35" cy="4" r="2.5" fill="currentColor"/>
                </svg>
            </div>

            <!-- Step 4 (Right) -->
            <div class="flex justify-end w-full">
                <div class="w-[92%] sm:w-[84%] md:w-[48%] bg-surface-white p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-0.5 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 right-0 w-1 h-full bg-primary"></div>
                    <div class="flex items-start gap-2.5 sm:gap-3.5">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl bg-primary/10 text-primary font-bold text-xs sm:text-sm flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors duration-300 shadow-2xs">
                            04
                        </div>
                        <div class="space-y-0.5 sm:space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-primary text-sm sm:text-base">view_in_ar</span>
                                <h3 class="text-xs sm:text-sm font-bold text-on-background leading-tight">Pencetakan <span class="text-[10px] sm:text-xs text-primary font-normal italic">(casting)</span></h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-snug sm:leading-relaxed">
                                Pengambilan cetakan negatif anatomi tubuh pasien menggunakan gips medis (Plaster of Paris) atau pemindaian optik 3D scanner berakurasi sub-milimeter.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connector 4: Right to Left Curved Dashed Spiral Arrow -->
            <div class="flex justify-center items-center -my-2.5 sm:-my-3.5 relative z-0 pointer-events-none">
                <svg class="w-36 sm:w-48 h-6 sm:h-7 text-primary/50" viewBox="0 0 200 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 165 4 C 85 4, 115 26, 35 26" stroke="currentColor" stroke-width="1.8" stroke-dasharray="4 4" stroke-linecap="round"/>
                    <polygon points="35,22 25,26 35,30" fill="currentColor"/>
                    <circle cx="165" cy="4" r="2.5" fill="currentColor"/>
                </svg>
            </div>

            <!-- Step 5 (Left) -->
            <div class="flex justify-start w-full">
                <div class="w-[92%] sm:w-[84%] md:w-[48%] bg-surface-white p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-0.5 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                    <div class="flex items-start gap-2.5 sm:gap-3.5">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl bg-primary/10 text-primary font-bold text-xs sm:text-sm flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors duration-300 shadow-2xs">
                            05
                        </div>
                        <div class="space-y-0.5 sm:space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-primary text-sm sm:text-base">tune</span>
                                <h3 class="text-xs sm:text-sm font-bold text-on-background leading-tight">Rektifikasi <span class="text-[10px] sm:text-xs text-primary font-normal italic">(rectification)</span></h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-snug sm:leading-relaxed">
                                Modifikasi dan penyesuaian model cetakan positif (gips positif atau digital CAD 3D) untuk distribusi tumpuan beban (weight-bearing) dan koreksi biomekanik.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connector 5: Left to Right Curved Dashed Spiral Arrow -->
            <div class="flex justify-center items-center -my-2.5 sm:-my-3.5 relative z-0 pointer-events-none">
                <svg class="w-36 sm:w-48 h-6 sm:h-7 text-primary/50" viewBox="0 0 200 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 35 4 C 115 4, 85 26, 165 26" stroke="currentColor" stroke-width="1.8" stroke-dasharray="4 4" stroke-linecap="round"/>
                    <polygon points="165,22 175,26 165,30" fill="currentColor"/>
                    <circle cx="35" cy="4" r="2.5" fill="currentColor"/>
                </svg>
            </div>

            <!-- Step 6 (Right) -->
            <div class="flex justify-end w-full">
                <div class="w-[92%] sm:w-[84%] md:w-[48%] bg-surface-white p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-0.5 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 right-0 w-1 h-full bg-primary"></div>
                    <div class="flex items-start gap-2.5 sm:gap-3.5">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl bg-primary/10 text-primary font-bold text-xs sm:text-sm flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors duration-300 shadow-2xs">
                            06
                        </div>
                        <div class="space-y-0.5 sm:space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-primary text-sm sm:text-base">precision_manufacturing</span>
                                <h3 class="text-xs sm:text-sm font-bold text-on-background leading-tight">Fabrikasi <span class="text-[10px] sm:text-xs text-primary font-normal italic">(fabrication)</span></h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-snug sm:leading-relaxed">
                                Proses pengerjaan, pembentukan soket, dan perakitan komponen alat bantu di workshop khusus menggunakan material berkualitas medis standar internasional.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connector 6: Right to Left Curved Dashed Spiral Arrow -->
            <div class="flex justify-center items-center -my-2.5 sm:-my-3.5 relative z-0 pointer-events-none">
                <svg class="w-36 sm:w-48 h-6 sm:h-7 text-primary/50" viewBox="0 0 200 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 165 4 C 85 4, 115 26, 35 26" stroke="currentColor" stroke-width="1.8" stroke-dasharray="4 4" stroke-linecap="round"/>
                    <polygon points="35,22 25,26 35,30" fill="currentColor"/>
                    <circle cx="165" cy="4" r="2.5" fill="currentColor"/>
                </svg>
            </div>

            <!-- Step 7 (Left) -->
            <div class="flex justify-start w-full">
                <div class="w-[92%] sm:w-[84%] md:w-[48%] bg-surface-white p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-0.5 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                    <div class="flex items-start gap-2.5 sm:gap-3.5">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl bg-primary/10 text-primary font-bold text-xs sm:text-sm flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors duration-300 shadow-2xs">
                            07
                        </div>
                        <div class="space-y-0.5 sm:space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-primary text-sm sm:text-base">accessibility_new</span>
                                <h3 class="text-xs sm:text-sm font-bold text-on-background leading-tight">Pengepasan <span class="text-[10px] sm:text-xs text-primary font-normal italic">(fitting)</span></h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-snug sm:leading-relaxed">
                                Uji coba langsung pada pasien, evaluasi kenyamanan soket, penyesuaian kelurusan statis & dinamis (alignment), serta evaluasi fungsi gerak tubuh.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connector 7: Left to Right Curved Dashed Spiral Arrow -->
            <div class="flex justify-center items-center -my-2.5 sm:-my-3.5 relative z-0 pointer-events-none">
                <svg class="w-36 sm:w-48 h-6 sm:h-7 text-primary/50" viewBox="0 0 200 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 35 4 C 115 4, 85 26, 165 26" stroke="currentColor" stroke-width="1.8" stroke-dasharray="4 4" stroke-linecap="round"/>
                    <polygon points="165,22 175,26 165,30" fill="currentColor"/>
                    <circle cx="35" cy="4" r="2.5" fill="currentColor"/>
                </svg>
            </div>

            <!-- Step 8 (Right) -->
            <div class="flex justify-end w-full">
                <div class="w-[92%] sm:w-[84%] md:w-[48%] bg-surface-white p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-0.5 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 right-0 w-1 h-full bg-primary"></div>
                    <div class="flex items-start gap-2.5 sm:gap-3.5">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl bg-primary/10 text-primary font-bold text-xs sm:text-sm flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-colors duration-300 shadow-2xs">
                            08
                        </div>
                        <div class="space-y-0.5 sm:space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-primary text-sm sm:text-base">inventory_2</span>
                                <h3 class="text-xs sm:text-sm font-bold text-on-background leading-tight">Penyerahan <span class="text-[10px] sm:text-xs text-primary font-normal italic">(delivery & check out)</span></h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-snug sm:leading-relaxed">
                                Pemeriksaan akhir mutu alat bantu, penyerahan resmi kepada pasien, serta edukasi intensif tata cara pemakaian dan pemeliharaan mandiri.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connector 8: Right to Left Curved Dashed Spiral Arrow -->
            <div class="flex justify-center items-center -my-2.5 sm:-my-3.5 relative z-0 pointer-events-none">
                <svg class="w-36 sm:w-48 h-6 sm:h-7 text-primary/50" viewBox="0 0 200 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 165 4 C 85 4, 115 26, 35 26" stroke="currentColor" stroke-width="1.8" stroke-dasharray="4 4" stroke-linecap="round"/>
                    <polygon points="35,22 25,26 35,30" fill="currentColor"/>
                    <circle cx="165" cy="4" r="2.5" fill="currentColor"/>
                </svg>
            </div>

            <!-- Step 9 (Left - Finish Milestone) -->
            <div class="flex justify-start w-full">
                <div class="w-[92%] sm:w-[84%] md:w-[48%] bg-surface-white p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-0.5 transition-all duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-[#E5A500]"></div>
                    <div class="flex items-start gap-2.5 sm:gap-3.5">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl bg-[#E5A500]/15 text-[#B38000] font-bold text-xs sm:text-sm flex items-center justify-center shrink-0 group-hover:bg-[#E5A500] group-hover:text-white transition-colors duration-300 shadow-2xs">
                            09
                        </div>
                        <div class="space-y-0.5 sm:space-y-1">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[#B38000] text-sm sm:text-base">published_with_changes</span>
                                <h3 class="text-xs sm:text-sm font-bold text-on-background leading-tight">Evaluasi & tindak lanjut <span class="text-[10px] sm:text-xs text-[#B38000] font-normal italic">(follow up)</span></h3>
                            </div>
                            <p class="text-[11px] sm:text-xs text-on-surface-variant leading-snug sm:leading-relaxed">
                                Pemantauan rutin dan evaluasi berkala untuk memastikan kenyamanan jangka panjang, adaptasi fungsi, serta jaminan garansi fitting 100% dari pediOcare.
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
