@extends('layouts.app')

@section('title', 'Tentang Kami - Precision Orthotics & Prosthetics')
@section('meta_description', 'Profil dan komitmen Klinik Ortotik & Prostetik Indonesia dalam memberikan pelayanan alat bantu ortopedi presisi berstandar Kemenkes RI.')

@section('content')

<!-- Header Banner -->
<div class="bg-cappuccino border-b border-border py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1360px] mx-auto text-center space-y-3">
        <span class="text-xs text-terracotta font-semibold uppercase tracking-wider block font-sans">CLINICAL EXCELLENCE & LEGACY</span>
        <h1 class="text-3xl sm:text-4xl lg:text-[46px] font-serif font-medium tracking-tight text-primary leading-tight">
            Tentang Klinik Ortotik & Prostetik
        </h1>
        <p class="text-secondary/80 text-base sm:text-lg max-w-xl mx-auto leading-relaxed font-light">
            Mendedikasikan keahlian teknologi medis presisi untuk memulihkan fungsi mobilitas mandiri dan kualitas hidup setiap pasien.
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-8">
    <div class="bg-white rounded-3xl border border-border p-8 sm:p-12 space-y-6 text-base text-secondary/85 leading-relaxed font-light shadow-2xs">
        <h2 class="text-3xl font-serif font-medium tracking-tight text-primary">Visi & Komitmen Pelayanan Medis</h2>
        <p>
            Klinik Ortotik & Prostetik Indonesia berdiri dengan komitmen memberikan pelayanan rehabilitasi muskuloskeletal dan pembuatan alat bantu gerak berstandar global. Didukung oleh tim Ortotis-Prostetis berlisensi resmi Kementerian Kesehatan RI, kami mengintegrasikan teknologi pemindaian 3D dan workshop fabrikasi presisi.
        </p>
        <p>
            Fokus kami meliputi penanganan non-operatif kelainan tulang belakang (skoliosis), koreksi kaki O/X anak, penyangga sendi lutut, hingga prostesis kaki dan tangan carbon fiber yang ringan, ergonomis, dan tahan lama.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6 border-t border-border">
            <div class="p-6 bg-cappuccino rounded-2xl border border-border space-y-2">
                <h3 class="font-serif font-medium text-lg text-primary">Izin Kemenkes RI</h3>
                <p class="text-xs text-tertiary">Legalitas izin praktek klinis dan sertifikasi mutu alat medis sesuai regulasi kesehatan Republik Indonesia.</p>
            </div>
            <div class="p-6 bg-cappuccino rounded-2xl border border-border space-y-2">
                <h3 class="font-serif font-medium text-lg text-primary">Garansi Fitting Pas 100%</h3>
                <p class="text-xs text-tertiary">Setiap alat yang dibuat disertai pemantauan berkala dan penyesuaian gratis hingga pasien nyaman beraktivitas.</p>
            </div>
        </div>
    </div>
</div>

@endsection
