@extends('layouts.app')

@section('title', 'Alur Pasien & Produk Custom-Made - pediOcare')
@section('meta_description', 'Dirancang dan diproduksi secara individual mengikuti anatomi dan kebutuhan biomekanik setiap pasien dengan garansi fitting 100%.')

@section('content')

@php
    $heroCustomBg = $settings['hero_about_image'] ?? asset('images/client_update/image4.png');
    if (!str_starts_with($heroCustomBg, 'http') && !str_starts_with($heroCustomBg, '/')) {
        $heroCustomBg = asset($heroCustomBg);
    }

    $rawSteps = $settings['patient_flow_steps']->value ?? null;
    $flowSteps = [];
    if (!empty($rawSteps)) {
        $decoded = is_array($rawSteps) ? $rawSteps : json_decode($rawSteps, true);
        if (is_array($decoded) && count($decoded) > 0) {
            $flowSteps = $decoded;
        }
    }
    if (empty($flowSteps)) {
        $flowSteps = [
            ['step' => '01', 'title' => 'Pemeriksaan', 'sub' => 'assessment', 'icon' => 'clinical_notes', 'desc' => 'Pemeriksaan fisik komprehensif oleh tim Ortotis-Prostetis tersertifikasi, anamnesis riwayat medis, serta evaluasi kondisi ekstremitas/stump dan kebutuhan fungsional pasien.'],
            ['step' => '02', 'title' => 'Diagnosis, preskripsi', 'sub' => 'prescription', 'icon' => 'prescriptions', 'desc' => 'Penetapan diagnosis klinis ortotik-prostetik dan penentuan rekomendasi spesifikasi desain alat bantu, jenis soket, serta pemilihan komponen yang tepat.'],
            ['step' => '03', 'title' => 'Pengukuran', 'sub' => 'measurement', 'icon' => 'straighten', 'desc' => 'Pengambilan ukuran dan parameter anatomis secara mendalam, presisi, dan teliti guna menjamin kesesuaian dimensi alat bantu dengan proporsi tubuh pasien.'],
            ['step' => '04', 'title' => 'Pencetakan', 'sub' => 'casting', 'icon' => 'view_in_ar', 'desc' => 'Pengambilan cetakan negatif anatomi tubuh pasien menggunakan gips medis (Plaster of Paris) atau pemindaian optik 3D scanner berakurasi sub-milimeter.'],
            ['step' => '05', 'title' => 'Rektifikasi', 'sub' => 'rectification', 'icon' => 'tune', 'desc' => 'Modifikasi dan penyesuaian model cetakan positif (gips positif atau digital CAD 3D) untuk distribusi tumpuan beban (weight-bearing) dan koreksi biomekanik.'],
            ['step' => '06', 'title' => 'Fabrikasi', 'sub' => 'fabrication', 'icon' => 'precision_manufacturing', 'desc' => 'Proses pengerjaan, pembentukan soket, dan perakitan komponen alat bantu di workshop khusus menggunakan material berkualitas medis standar internasional.'],
            ['step' => '07', 'title' => 'Pengepasan', 'sub' => 'fitting', 'icon' => 'accessibility_new', 'desc' => 'Uji coba langsung pada pasien, evaluasi kenyamanan soket, penyesuaian kelurusan statis & dinamis (alignment), serta evaluasi fungsi gerak tubuh.'],
            ['step' => '08', 'title' => 'Penyerahan', 'sub' => 'delivery & check out', 'icon' => 'inventory_2', 'desc' => 'Pemeriksaan akhir mutu alat bantu, penyerahan resmi kepada pasien, serta edukasi intensif tata cara pemakaian dan pemeliharaan mandiri.'],
            ['step' => '09', 'title' => 'Evaluasi & tindak lanjut', 'sub' => 'follow up', 'icon' => 'published_with_changes', 'desc' => 'Pemantauan rutin dan evaluasi berkala untuk memastikan kenyamanan jangka panjang, adaptasi fungsi, serta jaminan garansi fitting 100% dari pediOcare.']
        ];
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
                {{ count($flowSteps) }} Tahapan Alur Pasien
            </h2>
            <p class="text-on-surface-variant text-xs sm:text-sm max-w-xl mx-auto leading-relaxed">
                Alur prosedur pelayanan klinis terstandar dari asesmen awal hingga tindak lanjut berkala untuk menjamin akurasi biomekanik, kenyamanan, dan mobilitas mandiri.
            </p>
        </div>

        <!-- Zig-Zag Flow Container (Mobile & Desktop) -->
        <div class="relative space-y-1 sm:space-y-0">
            @foreach($flowSteps as $sIdx => $st)
                @php
                    $isEven = ($sIdx % 2 === 0); // 0 (step 1), 2 (step 3), etc. -> Left
                    $isLast = ($sIdx === count($flowSteps) - 1);
                    $stepNum = $st['step'] ?? ($sIdx + 1 < 10 ? '0' . ($sIdx + 1) : ($sIdx + 1));
                    $icon = !empty($st['icon']) ? $st['icon'] : 'check_circle';
                @endphp

                <!-- Step {{ $sIdx + 1 }} ({{ $isEven ? 'Left' : 'Right' }}) -->
                <div class="flex {{ $isEven ? 'justify-start' : 'justify-end' }} w-full">
                    <div class="w-[92%] sm:w-[84%] md:w-[48%] bg-surface-white p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-outline-variant/30 shadow-1 hover:shadow-hover hover:-translate-y-0.5 transition-all duration-300 relative group overflow-hidden">
                        <div class="absolute top-0 {{ $isEven ? 'left-0' : 'right-0' }} w-1 h-full {{ $isLast ? 'bg-[#E5A500]' : 'bg-primary' }}"></div>
                        <div class="flex items-start gap-2.5 sm:gap-3.5">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg sm:rounded-xl {{ $isLast ? 'bg-[#E5A500]/15 text-[#B38000] group-hover:bg-[#E5A500]' : 'bg-primary/10 text-primary group-hover:bg-primary' }} font-bold text-xs sm:text-sm flex items-center justify-center shrink-0 group-hover:text-white transition-colors duration-300 shadow-2xs">
                                {{ $stepNum }}
                            </div>
                            <div class="space-y-0.5 sm:space-y-1">
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined {{ $isLast ? 'text-[#B38000]' : 'text-primary' }} text-sm sm:text-base">{{ $icon }}</span>
                                    <h3 class="text-xs sm:text-sm font-bold text-on-background leading-tight">
                                        {{ $st['title'] ?? '' }}
                                        @if(!empty($st['sub']))
                                        <span class="text-[10px] sm:text-xs {{ $isLast ? 'text-[#B38000]' : 'text-primary' }} font-normal italic">({{ $st['sub'] }})</span>
                                        @endif
                                    </h3>
                                </div>
                                <p class="text-[11px] sm:text-xs text-on-surface-variant leading-snug sm:leading-relaxed">
                                    {{ $st['desc'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!$isLast)
                <!-- Connector: {{ $isEven ? 'Left to Right' : 'Right to Left' }} Curved Dashed Arrow -->
                <div class="flex justify-center items-center -my-2.5 sm:-my-3.5 relative z-0 pointer-events-none">
                    <svg class="w-36 sm:w-48 h-6 sm:h-7 text-primary/50" viewBox="0 0 200 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        @if($isEven)
                        <path d="M 35 4 C 115 4, 85 26, 165 26" stroke="currentColor" stroke-width="1.8" stroke-dasharray="4 4" stroke-linecap="round"/>
                        <polygon points="165,22 175,26 165,30" fill="currentColor"/>
                        <circle cx="35" cy="4" r="2.5" fill="currentColor"/>
                        @else
                        <path d="M 165 4 C 85 4, 115 26, 35 26" stroke="currentColor" stroke-width="1.8" stroke-dasharray="4 4" stroke-linecap="round"/>
                        <polygon points="35,22 25,26 35,30" fill="currentColor"/>
                        <circle cx="165" cy="4" r="2.5" fill="currentColor"/>
                        @endif
                    </svg>
                </div>
                @endif
            @endforeach
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
