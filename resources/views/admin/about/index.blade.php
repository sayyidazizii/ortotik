@extends('admin.layouts.app')

@section('title', 'Manajemen Halaman Tentang Kami')
@section('header_title', 'Tentang Kami (Profil & Galeri)')

@section('content')
@php
    $heroAboutImg = $settings['hero_about_image']->value ?? 'images/client_update/image4.png';
    if (!str_starts_with($heroAboutImg, 'http') && !str_starts_with($heroAboutImg, '/')) {
        $heroAboutImg = asset($heroAboutImg);
    }

    $fabImg = $settings['about_fabrication_image']->value ?? 'images/client_update_rev2/image12.png';
    if (!str_starts_with($fabImg, 'http') && !str_starts_with($fabImg, '/')) {
        $fabImg = asset($fabImg);
    }

    $actSetting = $settings['about_activity_images']->value ?? null;
    $activityImages = [];
    if (!empty($actSetting)) {
        $decoded = is_array($actSetting) ? $actSetting : json_decode($actSetting, true);
        if (is_array($decoded) && count($decoded) > 0) {
            $activityImages = array_values(array_filter($decoded));
        }
    }
    if (empty($activityImages)) {
        $activityImages = [
            'images/client_update/image2.png',
            'images/client_update/image5.png',
            'images/client_update/image3.png'
        ];
    }

    $valuesSetting = $settings['about_values']->value ?? null;
    $initialValues = [];
    if (!empty($valuesSetting)) {
        $decoded = is_array($valuesSetting) ? $valuesSetting : json_decode($valuesSetting, true);
        if (is_array($decoded) && count($decoded) > 0) {
            $initialValues = $decoded;
        }
    }
    if (empty($initialValues)) {
        $initialValues = [
            ['title' => 'Teknologi Mutakhir', 'icon' => 'science', 'desc' => 'Penerapan 3D optical scan dan modifikasi biomedis presisi untuk mencapai akurasi soket dan brace tingkat tinggi yang nyaman digunakan.'],
            ['title' => 'Standar Kemenkes RI', 'icon' => 'verified_user', 'desc' => 'Seluruh prosedur klinis dan workshop fabrikasi ditangani langsung oleh praktisi Ortotis-Prostetis yang memiliki Surat Tanda Registrasi dan Surat Izin Praktik.'],
            ['title' => 'Pendampingan Empatik', 'icon' => 'favorite', 'desc' => 'Kami mendampingi setiap tahapan pemulihan Anda dengan sabar dan teliti hingga Anda kembali beraktivitas dengan mandiri dan percaya diri.']
        ];
    }
@endphp

<div class="max-w-5xl space-y-6" x-data="aboutPageManager(@js($activityImages), @js($initialValues), @js($heroAboutImg), @js($fabImg))">

    <!-- Page Header & Live Link -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900">Manajemen Halaman Tentang Kami</h2>
            <p class="text-xs text-slate-500 mt-0.5">Kelola seluruh gambar hero banner, narasi profil dedikasi, keunggulan, galeri aktivitas foto, foto inovasi fabrikasi, dan nilai inti klinik.</p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('about') }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition shadow-sm">
                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                <span>Lihat Live Halaman</span>
            </a>
        </div>
    </div>

    @if (session('success'))
    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2.5 shadow-sm">
        <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0"></i>
        <span class="font-semibold">{{ session('success') }}</span>
    </div>
    @endif

    @if ($errors->any())
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
        <strong class="font-bold">Mohon perbaiki kesalahan berikut:</strong>
        <ul class="list-disc list-inside mt-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <input type="hidden" name="about_values_json" :value="JSON.stringify(coreValues)">

        <!-- ====================================================================== -->
        <!-- 1. HERO BANNER HEADER & BACKGROUND -->
        <!-- ====================================================================== -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div class="flex items-center gap-2 text-medical-600">
                    <i data-lucide="image" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">1. Hero Header & Foto Banner Halaman</h3>
                </div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Bagian Atas</span>
            </div>

            <!-- Preview & Banner Image Upload -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                <div class="lg:col-span-5">
                    <div class="relative rounded-2xl overflow-hidden bg-slate-900 border border-slate-300 shadow-sm aspect-16/9 group">
                        <img :src="heroPreview" alt="Preview Banner" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-slate-950/40 flex items-center justify-center p-3 text-center">
                            <span class="text-[11px] text-white/90 font-bold bg-black/60 px-3 py-1 rounded-full backdrop-blur-xs">
                                Preview Banner Hero
                            </span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 space-y-3.5">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Upload Foto Banner Hero Baru</label>
                        <input type="file" name="hero_about_image_file" accept="image/*"
                               @change="handleHeroUpload($event)"
                               class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-600 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1">
                        <p class="text-[10px] text-slate-400">Rekomendasi rasio 16:9 atau landscape (minimal 1920x800 px).</p>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-slate-600 uppercase">Atau URL Gambar / Path Manual</label>
                        <input type="text" name="hero_about_image" x-model="heroImage" @input="heroPreview = heroImage" placeholder="https://... atau /images/..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-mono">
                    </div>
                </div>
            </div>

            <!-- Header Text Elements -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-100">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Badge Label Header</label>
                    <input type="text" name="hero_about_badge" value="{{ $settings['hero_about_badge']->value ?? 'Care your milestone' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-semibold" placeholder="Care your milestone">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Judul Utama Halaman</label>
                    <input type="text" name="hero_about_title" value="{{ $settings['hero_about_title']->value ?? 'Tentang pediOcare' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-bold" placeholder="Tentang pediOcare">
                </div>
                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Subtitle Narasi Header</label>
                    <textarea name="hero_about_subtitle" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 leading-relaxed">{{ $settings['hero_about_subtitle']->value ?? 'Pelayanan Ortotik Prostetik profesional dengan semangat bermanfaat untuk menunjang fungsi gerak, kenyamanan, serta kualitas hidup pengguna.' }}</textarea>
                </div>
            </div>
        </div>

        <!-- ====================================================================== -->
        <!-- 2. VISI, DEDIKASI & NARASI SEJARAH KLINIK -->
        <!-- ====================================================================== -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-5">
            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div class="flex items-center gap-2 text-medical-600">
                    <i data-lucide="building-2" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">2. Visi, Dedikasi & Narasi Sejarah Klinik</h3>
                </div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Profil Inti</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Nama Brand / Klinik *</label>
                    <input type="text" name="clinic_name" value="{{ $settings['clinic_name']->value ?? 'pediOcare' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-bold">
                    <p class="text-[10px] text-slate-400">Contoh: pediOcare (dengan huruf O kapital).</p>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Tagline Klinik *</label>
                    <input type="text" name="clinic_tagline" value="{{ $settings['clinic_tagline']->value ?? 'Care your milestone' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-semibold">
                    <p class="text-[10px] text-slate-400">Contoh: Care your milestone (tanpa koma).</p>
                </div>

                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Teks Narasi Dedikasi & 14 Tahun Pengalaman</label>
                    <textarea name="about_company_description" rows="5" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs sm:text-sm bg-white focus:ring-2 focus:ring-medical-500 leading-relaxed">{{ $settings['about_company_description']->value ?? 'Pediocare Berdedikasi melakukan Pelayanan Ortotik Prostetik untuk membantu menunjang fungsi gerak, kenyamanan, serta kualitas hidup pengguna. Sejak 2012 Pediocare telah melayani dengan menghadirkan produk custom maupun readymade dengan mengutamakan kualitas bahan, kerapian pengerjaan, serta memperhatikan kebutuhan setiap pengguna. Dengan 14 tahun pengalaman di dunia alat bantu, Pediocare akan selalu berkomitmen memberi solusi yang terbaik dan dapat diandalkan.' }}</textarea>
                </div>
            </div>
        </div>

        <!-- ====================================================================== -->
        <!-- 3. 3 POIN KEUNGGULAN UTAMA (V-CHECKLIST) & 2 BADGE -->
        <!-- ====================================================================== -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div class="flex items-center gap-2 text-medical-600">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">3. 3 Poin Keunggulan Utama & 2 Badge Garansi</h3>
                </div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">USP & Trust</span>
            </div>

            <!-- 3 USP Points -->
            <div class="space-y-3">
                <span class="text-xs font-bold text-slate-700 uppercase block">3 Poin Keunggulan (V-Checklist):</span>
                
                <div class="space-y-1">
                    <label class="block text-[11px] font-semibold text-slate-500">Poin 1: Teknologi & Alat Customize</label>
                    <input type="text" name="about_usp_1" value="{{ $settings['about_usp_1']->value ?? 'Teknologi terkini dengan standar pelayanan & alat customize yang presisi.' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="space-y-1">
                    <label class="block text-[11px] font-semibold text-slate-500">Poin 2: Legalitas STR & SIP Dinas Kesehatan</label>
                    <input type="text" name="about_usp_2" value="{{ $settings['about_usp_2']->value ?? 'Praktisi Ortotis Prostetis legal memiliki STR & Surat Ijin Praktik Dinas Kesehatan.' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="space-y-1">
                    <label class="block text-[11px] font-semibold text-slate-500">Poin 3: Pelayanan Komprehensif & Konsultasi Gratis</label>
                    <input type="text" name="about_usp_3" value="{{ $settings['about_usp_3']->value ?? 'Pelayanan komprehensif dan paripurna (konsultasi gratis).' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500">
                </div>
            </div>

            <!-- 2 Trust / Guarantee Badges -->
            <div class="pt-4 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 space-y-2">
                    <span class="text-xs font-bold text-slate-700 uppercase block">Badge Garansi 1:</span>
                    <div class="grid grid-cols-3 gap-2">
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-slate-500 uppercase">Nilai/Angka</label>
                            <input type="text" name="about_badge_1_value" value="{{ $settings['about_badge_1_value']->value ?? '100%' }}" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white font-bold text-primary">
                        </div>
                        <div class="col-span-2 space-y-1">
                            <label class="block text-[10px] font-bold text-slate-500 uppercase">Label Keterangan</label>
                            <input type="text" name="about_badge_1_label" value="{{ $settings['about_badge_1_label']->value ?? 'Garansi Fitting Pas & Nyaman' }}" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white">
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 space-y-2">
                    <span class="text-xs font-bold text-slate-700 uppercase block">Badge Garansi 2:</span>
                    <div class="grid grid-cols-3 gap-2">
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-slate-500 uppercase">Nilai/Status</label>
                            <input type="text" name="about_badge_2_value" value="{{ $settings['about_badge_2_value']->value ?? 'Resmi' }}" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white font-bold text-primary">
                        </div>
                        <div class="col-span-2 space-y-1">
                            <label class="block text-[10px] font-bold text-slate-500 uppercase">Label Keterangan</label>
                            <input type="text" name="about_badge_2_label" value="{{ $settings['about_badge_2_label']->value ?? 'Berlisensi STR & SIP Kemenkes' }}" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ====================================================================== -->
        <!-- 4. GALERI SLIDER FOTO AKTIVITAS KLINIK -->
        <!-- ====================================================================== -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <div class="flex items-center gap-2 text-medical-600">
                        <i data-lucide="images" class="w-5 h-5"></i>
                        <h3 class="text-base font-extrabold text-slate-900">4. Galeri Foto Aktivitas & Pelayanan Medis</h3>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Foto-foto ini berganti otomatis (auto-slide) pada kotak galeri halaman Tentang Kami.</p>
                </div>
                <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-xl self-start sm:self-auto">
                    <span x-text="activityImgs.length"></span> Foto Terpasang
                </span>
            </div>

            <!-- Existing Photos Grid with Delete -->
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-700 uppercase">Daftar Foto Galeri Aktif (Hover untuk menghapus):</label>
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
                    <template x-for="(img, idx) in activityImgs" :key="idx">
                        <div class="relative group rounded-xl overflow-hidden border border-slate-200 bg-slate-900 aspect-square shadow-xs">
                            <img :src="img.startsWith('http') || img.startsWith('/') ? img : '/' + img" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            
                            <input type="hidden" name="retained_about_activity_images[]" :value="img">
                            
                            <div class="absolute inset-0 bg-slate-950/70 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center p-2">
                                <button type="button" @click="removeActivityImage(idx)" 
                                        class="p-2 rounded-lg bg-rose-600 text-white text-xs font-bold hover:bg-rose-700 transition flex items-center gap-1 shadow-sm cursor-pointer">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    <span>Hapus</span>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Multi Upload New Photos -->
            <div class="pt-3 border-t border-slate-100 space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase">Tambah Foto Galeri Baru (Dapat Pilih Banyak File Sekaligus):</label>
                <input type="file" name="about_activity_files[]" multiple accept="image/*" 
                       class="w-full text-xs text-slate-600 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-600 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1">
                <p class="text-[10px] text-slate-400">Format: JPG, PNG, WEBP (Maksimal 5MB per file).</p>
            </div>
        </div>

        <!-- ====================================================================== -->
        <!-- 5. INOVASI FABRIKASI MODERN SECTION -->
        <!-- ====================================================================== -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div class="flex items-center gap-2 text-medical-600">
                    <i data-lucide="cpu" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">5. Section Inovasi Fabrikasi Modern</h3>
                </div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Workshop & Standar</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                <!-- Preview & Upload Foto Fabrikasi -->
                <div class="lg:col-span-5 space-y-2">
                    <div class="relative rounded-2xl overflow-hidden bg-slate-900 border border-slate-300 shadow-sm aspect-4/3 group">
                        <img :src="fabPreview" alt="Preview Fabrikasi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute bottom-2 left-2 px-2.5 py-1 rounded-lg bg-black/70 backdrop-blur-xs text-white text-[10px] font-bold uppercase tracking-wider">
                            Foto Workshop
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 space-y-3.5">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Ganti Foto Workshop Fabrikasi Modern</label>
                        <input type="file" name="about_fabrication_file" accept="image/*"
                               @change="handleFabUpload($event)"
                               class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-600 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1">
                        <p class="text-[10px] text-slate-400">Rasio landscape atau 4:3 direkomendasikan.</p>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-[11px] font-bold text-slate-600 uppercase">Atau URL Gambar / Path Manual</label>
                        <input type="text" name="about_fabrication_image" x-model="fabImage" @input="fabPreview = fabImage" placeholder="https://... atau /images/..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-mono">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-100">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Teks Pengantar Sebelum Judul</label>
                    <input type="text" name="about_fabrication_badge" value="{{ $settings['about_fabrication_badge']->value ?? 'pediOcare akan terus berkembang menuju inovasi fabrikasi modern' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-semibold">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Judul Section</label>
                    <input type="text" name="about_fabrication_title" value="{{ $settings['about_fabrication_title']->value ?? 'Inovasi Fabrikasi Modern' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-bold">
                </div>
                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Deskripsi Penjelasan Fabrikasi</label>
                    <textarea name="about_fabrication_desc" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 leading-relaxed">{{ $settings['about_fabrication_desc']->value ?? 'Dengan memadukan ketelitian pengrajin ortotik prostetik berpengalaman dan peralatan modern, kami menghasilkan soket dan alat bantu yang memiliki tingkat presisi tinggi, distribusi tumpuan beban yang merata, serta estetika anatomi yang optimal.' }}</textarea>
                </div>
            </div>
        </div>

        <!-- ====================================================================== -->
        <!-- 6. 3 NILAI INTI PELAYANAN MEDIS (CORE VALUES) -->
        <!-- ====================================================================== -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div class="flex items-center gap-2 text-medical-600">
                    <i data-lucide="shield" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">6. 3 Nilai Inti Pelayanan Medis (Core Values)</h3>
                </div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Prinsip Layanan</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <template x-for="(val, vIdx) in coreValues" :key="vIdx">
                    <div class="p-5 rounded-2xl border border-slate-200 bg-slate-50/80 space-y-3.5">
                        <div class="flex items-center justify-between border-b border-slate-200/60 pb-2">
                            <span class="text-xs font-black text-slate-400" x-text="'Nilai ' + (vIdx + 1)"></span>
                            <span class="material-symbols-outlined text-primary text-xl" x-text="val.icon || 'check_circle'"></span>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[11px] font-bold text-slate-600 uppercase">Judul Nilai *</label>
                            <input type="text" x-model="val.title" class="w-full px-3 py-1.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-bold">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[11px] font-bold text-slate-600 uppercase">Ikon Material Symbol</label>
                            <input type="text" x-model="val.icon" class="w-full px-3 py-1.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-mono" placeholder="science">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[11px] font-bold text-slate-600 uppercase">Deskripsi Penjelasan</label>
                            <textarea x-model="val.desc" rows="3" class="w-full px-3 py-1.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 leading-relaxed"></textarea>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- ====================================================================== -->
        <!-- 7. BANNER AJAKAN KONSULTASI (BOTTOM CTA) -->
        <!-- ====================================================================== -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-5">
            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <div class="flex items-center gap-2 text-medical-600">
                    <i data-lucide="message-square" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">7. Banner Ajakan Konsultasi Medis (Bagian Bawah)</h3>
                </div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">CTA Banner</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Judul Banner CTA</label>
                    <input type="text" name="about_cta_title" value="{{ $settings['about_cta_title']->value ?? 'Siap Berkonsultasi Mengenai Kebutuhan Mobilitas Anda?' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-bold">
                </div>
                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Deskripsi / Lokasi & Kontak</label>
                    <input type="text" name="about_cta_desc" value="{{ $settings['about_cta_desc']->value ?? 'Kunjungi klinik kami di Sleman, D.I. Yogyakarta atau jadwalkan janji temu konsultasi WhatsApp di 0856 9792 2194.' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Teks Tombol Kontak</label>
                    <input type="text" name="about_cta_btn_text" value="{{ $settings['about_cta_btn_text']->value ?? 'Kontak & Janji Temu' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-semibold">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Teks Tombol WhatsApp</label>
                    <input type="text" name="about_cta_wa_text" value="{{ $settings['about_cta_wa_text']->value ?? 'Chat WhatsApp' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-semibold">
                </div>
            </div>
        </div>

        <!-- Sticky Submit Footer -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 shadow-sm flex items-center justify-between sticky bottom-4 z-30">
            <span class="text-xs text-slate-500 hidden sm:inline">Perubahan foto dan seluruh elemen teks akan langsung diperbarui di Halaman Tentang Kami.</span>
            <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                <span>Simpan Perubahan Tentang Kami</span>
            </button>
        </div>

    </form>
</div>

<script>
function aboutPageManager(initialActivityImgs, initialValues, initialHero, initialFab) {
    return {
        activityImgs: initialActivityImgs || [],
        coreValues: initialValues || [],
        heroImage: initialHero || '',
        heroPreview: initialHero || '{{ asset('images/client_update/image4.png') }}',
        fabImage: initialFab || '',
        fabPreview: initialFab || '{{ asset('images/client_update_rev2/image12.png') }}',

        init() {
            this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
        },

        handleHeroUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.heroPreview = URL.createObjectURL(file);
                this.heroImage = '';
            }
        },

        handleFabUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.fabPreview = URL.createObjectURL(file);
                this.fabImage = '';
            }
        },

        removeActivityImage(index) {
            if (confirm('Hapus foto ini dari galeri aktivitas?')) {
                this.activityImgs.splice(index, 1);
                this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
            }
        }
    };
}
</script>
@endsection