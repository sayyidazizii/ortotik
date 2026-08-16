@extends('layouts.app')

@section('title', 'Tentang Kami - Klinik Ortotik & Prostetik Indonesia')
@section('meta_description', 'Profil dan komitmen Klinik Ortotik & Prostetik Indonesia dalam memberikan pelayanan alat bantu ortopedi presisi berstandar Kemenkes RI.')

@section('content')

<!-- Header Banner -->
<div class="bg-hero-soft py-14 lg:py-18 border-b border-sky-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
        <span class="text-medical-600 font-extrabold text-xs uppercase tracking-widest block">PROFIL KLINIK</span>
        <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight">Tentang Orthocare Indonesia</h1>
        <p class="text-slate-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            Mendedikasikan keahlian ortotik dan prostetik medis presisi untuk memulihkan fungsi mobilitas mandiri dan kualitas hidup setiap pasien.
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
    <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200/80 shadow-card space-y-6 text-xs sm:text-sm text-slate-700 leading-relaxed">
        <h2 class="text-2xl font-black text-slate-900">Visi & Komitmen Pelayanan Medis</h2>
        <p>
            Klinik Ortotik & Prostetik Indonesia berdiri dengan komitmen memberikan pelayanan rehabilitasi muskuloskeletal dan pembuatan alat bantu gerak berstandar global. Didukung oleh tim Ortotis-Prostetis berlisensi resmi Kementerian Kesehatan RI, kami mengintegrasikan teknologi pemindaian 3D dan workshop fabrikasi presisi.
        </p>
        <p>
            Fokus kami meliputi penanganan non-operatif kelainan tulang belakang (skoliosis), koreksi kaki O/X anak, penyangga sendi lutut, hingga prostesis kaki dan tangan carbon fiber yang ringan, ergonomis, dan tahan lama.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6 border-t border-slate-100">
            <div class="p-6 rounded-2xl bg-sky-50/60 border border-sky-100 space-y-2">
                <h3 class="font-extrabold text-base text-medical-800">Izin Kemenkes RI</h3>
                <p class="text-xs text-slate-600">Legalitas izin praktek klinis dan sertifikasi mutu alat medis sesuai regulasi kesehatan Republik Indonesia.</p>
            </div>
            <div class="p-6 rounded-2xl bg-sky-50/60 border border-sky-100 space-y-2">
                <h3 class="font-extrabold text-base text-emerald-700">Garansi Fitting Pas 100%</h3>
                <p class="text-xs text-slate-600">Setiap alat yang dibuat disertai pemantauan berkala dan penyesuaian gratis hingga pasien nyaman beraktivitas.</p>
            </div>
        </div>
    </div>
</div>

@endsection
