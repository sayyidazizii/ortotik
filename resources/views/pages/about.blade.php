@extends('layouts.app')

@section('title', 'Tentang Kami - Precision Orthotics & Prosthetics')
@section('meta_description', 'Profil dan komitmen Klinik Ortotik & Prostetik Indonesia dalam memberikan pelayanan alat bantu ortopedi presisi berstandar Kemenkes RI.')

@section('content')

<!-- Header Banner with Editorial Typography -->
<div class="bg-canvas border-b border-hairline-soft py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1440px] mx-auto text-center space-y-2">
        <span class="text-xs text-mute font-semibold uppercase tracking-widest block">Clinical Excellence & Legacy</span>
        <h1 class="text-3xl sm:text-5xl font-medium tracking-tight text-ink uppercase font-sans">
            Tentang Klinik Ortotik & Prostetik
        </h1>
        <p class="text-mute text-sm max-w-xl mx-auto leading-relaxed">
            Mendedikasikan keahlian teknologi medis presisi untuk memulihkan fungsi mobilitas mandiri dan kualitas hidup setiap pasien.
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-8">
    <div class="bg-canvas border border-hairline-soft p-8 sm:p-12 space-y-6 text-xs sm:text-sm text-mute leading-relaxed">
        <h2 class="text-2xl font-bold tracking-tight text-ink uppercase font-sans">Visi & Komitmen Pelayanan Medis</h2>
        <p>
            Klinik Ortotik & Prostetik Indonesia berdiri dengan komitmen memberikan pelayanan rehabilitasi muskuloskeletal dan pembuatan alat bantu gerak berstandar global. Didukung oleh tim Ortotis-Prostetis berlisensi resmi Kementerian Kesehatan RI, kami mengintegrasikan teknologi pemindaian 3D dan workshop fabrikasi presisi.
        </p>
        <p>
            Fokus kami meliputi penanganan non-operatif kelainan tulang belakang (skoliosis), koreksi kaki O/X anak, penyangga sendi lutut, hingga prostesis kaki dan tangan carbon fiber yang ringan, ergonomis, dan tahan lama.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-6 border-t border-hairline-soft">
            <div class="p-6 bg-soft-cloud border border-hairline-soft space-y-2">
                <h3 class="font-bold text-sm text-ink uppercase">Izin Kemenkes RI</h3>
                <p class="text-xs text-mute">Legalitas izin praktek klinis dan sertifikasi mutu alat medis sesuai regulasi kesehatan Republik Indonesia.</p>
            </div>
            <div class="p-6 bg-soft-cloud border border-hairline-soft space-y-2">
                <h3 class="font-bold text-sm text-ink uppercase">Garansi Fitting Pas 100%</h3>
                <p class="text-xs text-mute">Setiap alat yang dibuat disertai pemantauan berkala dan penyesuaian gratis hingga pasien nyaman beraktivitas.</p>
            </div>
        </div>
    </div>
</div>

@endsection
