@extends('layouts.app')

@section('title', 'Tentang Kami - Klinik Ortotik & Prostetik Indonesia')

@section('content')
<div class="bg-medical-700 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="text-tealmed-400 font-bold text-xs uppercase tracking-widest block">PROFIL KLINIK</span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">Tentang Klinik Ortotik & Prostetik</h1>
        <p class="text-slate-200 text-base max-w-2xl mx-auto">Mendedikasikan keahlian teknologi medis untuk memulihkan fungsi gerak mandiri dan kualitas hidup setiap pasien.</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
    <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-sm space-y-6 text-sm text-slate-700 leading-relaxed">
        <h2 class="text-2xl font-extrabold text-slate-900">Visi & Komitmen Kami</h2>
        <p>
            Klinik Ortotik & Prostetik Indonesia berdiri dengan komitmen memberikan pelayanan rehabilitasi muskuloskeletal dan pembuatan alat bantu gerak berstandar global. Didukung oleh tim Ortotis-Prostetis berlisensi resmi Kementerian Kesehatan RI, kami mengintegrasikan teknologi pemindaian 3D dan workshop fabrikasi presisi.
        </p>
        <p>
            Fokus kami meliputi penanganan non-operatif kelainan tulang belakang (skoliosis), koreksi kaki O/X anak, penyangga sendi lutut, hingga prostesis kaki dan tangan bionik yang ringan, ergonomis, dan tahan lama.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6 border-t border-slate-100">
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="font-extrabold text-base text-medical-800">Standar Kemenkes RI</h3>
                <p class="text-xs text-slate-500">Legalitas izin praktek klinis dan sertifikasi mutu alat medis sesuai regulasi kesehatan Indonesia.</p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="font-extrabold text-base text-tealmed-700">Garansi Fitting Pas</h3>
                <p class="text-xs text-slate-500">Setiap alat yang dibuat disertai pemantauan berkala dan penyesuaian gratis hingga pasien nyaman berjalan.</p>
            </div>
        </div>
    </div>
</div>
@endsection
