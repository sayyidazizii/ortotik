@extends('admin.layouts.app')

@section('title', 'Pengaturan Website & Visual')
@section('header_title', 'Pengaturan Situs & Visual')

@section('content')
@php
    $heroDoctorsRaw = $settings['hero_doctors']->value ?? null;
    $initialDoctors = [];
    if (!empty($heroDoctorsRaw)) {
        $decoded = is_array($heroDoctorsRaw) ? $heroDoctorsRaw : json_decode($heroDoctorsRaw, true);
        if (is_array($decoded) && count($decoded) > 0) {
            $initialDoctors = $decoded;
        }
    }
    
    if (empty($initialDoctors)) {
        $initialDoctors = [
            [
                'image' => asset('images/client_update/image5.png'),
                'name'  => 'Muhammad Antas Salam., S.Tr.Kes',
                'title' => 'Praktisi Ortotik & Prostetik Medis',
                'badge' => 'Tim Klinis Spesialis'
            ],
            [
                'image' => asset('images/client_update/image4.png'),
                'name'  => 'Muhammad Antas Salam., S.Tr.Kes',
                'title' => 'Spesialis Ortotik & Prostetik',
                'badge' => 'Tim Klinis Spesialis'
            ],
            [
                'image' => asset('images/client_update/image2.png'),
                'name'  => 'Tim Ortotik Prostetik pediOcare',
                'title' => 'Praktisi Berlisensi STR & SIP Kemenkes',
                'badge' => 'Tim Klinis Spesialis'
            ]
        ];
    }

    foreach ($initialDoctors as &$docItem) {
        $img = $docItem['image'] ?? '';
        if (empty($img)) {
            $docItem['image'] = asset('images/client_update/image5.png');
        } else {
            if (preg_match('#(?:https?:)?//[^/]+/(images/.+|storage/.+)#i', $img, $m)) {
                $img = $m[1];
            }

            if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://') || str_starts_with($img, '//') || str_starts_with($img, 'data:image/')) {
                $docItem['image'] = $img;
            } elseif (str_starts_with($img, 'images/') || str_starts_with($img, '/images/')) {
                $docItem['image'] = asset(ltrim($img, '/'));
            } elseif (str_starts_with($img, 'storage/') || str_starts_with($img, '/storage/')) {
                $docItem['image'] = asset(ltrim($img, '/'));
            } else {
                $docItem['image'] = asset('storage/' . $img);
            }
        }
    }
    unset($docItem);

    $currentTab = request('tab', 'hero_home');
    $currentHeroMedia = $settings['hero_home_media']->value ?? 'https://lh3.googleusercontent.com/aida/AP1WRLu-cYuotNRMpQoNz8xiNuno33F9xSgeFfAKDWqxDogo2VSMvAuCS4QUt2jbop_cQ4e18T36Uqa6an8ezvVtDtXtwih7tYUxTzRHyWrqiqVAcV-b3G6wS_YbGIeB9Bl7tYBFGY4K81YU6TE_o1OvhLPzQstL7r4XrQEGsJ3mWxHjfxXavdzURFHoctGm1HxnTSA9wW180ytfdljOX3A9UWVLpKx5mwhgV3xHx-gbLfAcVFwk-s2AOYLy';
    $currentMediaType = $settings['hero_home_media_type']->value ?? (preg_match('/\.(mp4|webm|ogg|mov)$/i', $currentHeroMedia) ? 'video' : 'image');
@endphp

<div class="max-w-5xl space-y-6" x-data="settingsManager(@js($initialDoctors), '{{ $currentTab }}', '{{ $currentHeroMedia }}', '{{ $currentMediaType }}')">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900">Pengaturan Situs & Visual</h2>
            <p class="text-xs text-slate-500 mt-0.5">Kelola teks narasi beranda, profil perusahaan, media video/gambar, alamat Google Maps, kontak email, footer, dan SEO.</p>
        </div>
        <div>
            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition shadow-sm">
                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                <span>Lihat Live Beranda</span>
            </a>
        </div>
    </div>

    <!-- Navigation Tabs / Sub-Menus -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 border-b border-slate-200 no-scrollbar">
        <button type="button" @click="setTab('hero_home')"
                :class="activeTab === 'hero_home' ? 'bg-medical-600 text-white shadow-sm font-bold' : 'bg-white text-slate-600 hover:bg-slate-100 font-semibold'"
                class="px-4 py-2.5 rounded-xl text-xs flex items-center gap-2 shrink-0 transition">
            <i data-lucide="sparkles" class="w-4 h-4"></i>
            <span>Visual & Teks Beranda</span>
        </button>

        <button type="button" @click="setTab('hero_pages')"
                :class="activeTab === 'hero_pages' ? 'bg-medical-600 text-white shadow-sm font-bold' : 'bg-white text-slate-600 hover:bg-slate-100 font-semibold'"
                class="px-4 py-2.5 rounded-xl text-xs flex items-center gap-2 shrink-0 transition">
            <i data-lucide="image" class="w-4 h-4"></i>
            <span>Banner Halaman & Narasi Profil</span>
        </button>

        <button type="button" @click="setTab('location_maps')"
                :class="activeTab === 'location_maps' ? 'bg-medical-600 text-white shadow-sm font-bold' : 'bg-white text-slate-600 hover:bg-slate-100 font-semibold'"
                class="px-4 py-2.5 rounded-xl text-xs flex items-center gap-2 shrink-0 transition">
            <i data-lucide="map" class="w-4 h-4"></i>
            <span>Alamat & Google Maps</span>
        </button>

        <button type="button" @click="setTab('footer_branding')"
                :class="activeTab === 'footer_branding' ? 'bg-medical-600 text-white shadow-sm font-bold' : 'bg-white text-slate-600 hover:bg-slate-100 font-semibold'"
                class="px-4 py-2.5 rounded-xl text-xs flex items-center gap-2 shrink-0 transition">
            <i data-lucide="layout-template" class="w-4 h-4"></i>
            <span>Footer, Email & Kontak</span>
        </button>

        <button type="button" @click="setTab('seo_meta')"
                :class="activeTab === 'seo_meta' ? 'bg-medical-600 text-white shadow-sm font-bold' : 'bg-white text-slate-600 hover:bg-slate-100 font-semibold'"
                class="px-4 py-2.5 rounded-xl text-xs flex items-center gap-2 shrink-0 transition">
            <i data-lucide="search" class="w-4 h-4"></i>
            <span>SEO & Metadata</span>
        </button>
    </div>

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

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <input type="hidden" name="current_tab" :value="activeTab">
        <input type="hidden" name="hero_doctors_json" :value="JSON.stringify(doctors)">

        <!-- ====================================================================== -->
        <!-- TAB 1: VISUAL & TEKS HERO BERANDA -->
        <!-- ====================================================================== -->
        <div x-show="activeTab === 'hero_home'" class="space-y-6">
            
            <!-- Teks Narasi Utama Hero Beranda -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-4">
                <div class="border-b border-slate-100 pb-3 flex items-center gap-2 text-medical-600">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">Teks Narasi & Nilai Utama Hero Beranda</h3>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Teks Deskripsi / Narasi Utama di Bawah Judul Hero</label>
                    <textarea name="hero_home_description" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500 leading-relaxed">{{ $settings['hero_home_description']->value ?? 'Sebaik-baik manusia adalah yang bermanfaat untuk orang lain. Kami memandang manusia sebagai makhluk ciptaan yang sempurna. Sudah lebih dari satu dekade pediOcare melayani, membantu dan memberi solusi bagi masyarakat yang membutuhkan layanan alat bantu Ortosis Prostesis. Suatu kebahagiaan bagi Kami ketika dapat melihat klien/pasien yang mengalami amputasi kaki namun dapat kembali berjalan penuhi harapan, anak lahir yang ditakdirkan memiliki keistimewaan dapat tumbuh dan berkembang sesuai capaian (milestone).' }}</textarea>
                    <p class="text-[11px] text-slate-400">Teks ini tampil di samping slider dokter pada bagian utama beranda website.</p>
                </div>
            </div>

            <!-- Hero Medical Background (Image / Video) -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-5">
                <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                    <div class="flex items-center gap-2 text-medical-600">
                        <i data-lucide="clapperboard" class="w-5 h-5"></i>
                        <h3 class="text-base font-extrabold text-slate-900">Background Hero Beranda (Gambar / Video)</h3>
                    </div>
                    <span class="text-xs text-slate-500 font-medium">Bisa upload gambar statis atau video animasi/loop (MP4/WebM)</span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                    <div class="lg:col-span-7 space-y-4">
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase">Pilih File Foto atau Video MP4 Baru (Upload)</label>
                            <input type="file" name="hero_home_media_file" accept="image/*,video/mp4,video/webm,video/ogg"
                                   @change="handleHeroMediaUpload($event)"
                                   class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-700 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1">
                            <p class="text-[11px] text-slate-400 mt-1">Format gambar (JPG, PNG, WEBP) atau video (MP4, WebM, MOV) maksimal 50MB.</p>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase">Atau URL Link Gambar / Video</label>
                            <input type="text" name="hero_home_media" x-model="heroHomeMedia" @input="detectMediaType()"
                                   placeholder="https://... atau /images/..." 
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase">Tipe Format Media</label>
                            <select name="hero_home_media_type" x-model="heroHomeMediaType" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-semibold">
                                <option value="image">Gambar Statis (Image)</option>
                                <option value="video">Video Loop Animasi (Video MP4/WebM)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Live Preview Box -->
                    <div class="lg:col-span-5 space-y-2">
                        <span class="text-xs font-bold text-slate-700 block">Preview Background Hero:</span>
                        <div class="w-full h-48 rounded-2xl overflow-hidden bg-slate-900 border-2 border-slate-200 shadow-sm relative flex items-center justify-center">
                            <template x-if="heroHomeMediaType === 'video'">
                                <video :src="heroHomeMedia" autoplay muted loop playsinline class="w-full h-full object-cover opacity-70"></video>
                            </template>
                            <template x-if="heroHomeMediaType !== 'video'">
                                <img :src="heroHomeMedia" alt="Preview Background" class="w-full h-full object-cover opacity-70" x-on:error="$el.src = '{{ asset('images/client_update/image4.png') }}'">
                            </template>
                            <div class="absolute bottom-2 left-2 px-2.5 py-1 rounded-lg bg-black/70 backdrop-blur-xs text-white text-[10px] font-bold uppercase tracking-wider flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span x-text="heroHomeMediaType === 'video' ? 'Video Player' : 'Image Background'"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Doctor Slider Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
                <div class="border-b border-slate-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2 text-medical-600">
                            <i data-lucide="users" class="w-5 h-5"></i>
                            <h3 class="text-base font-extrabold text-slate-900">Slider Hero Dokter / Praktisi Medis</h3>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">
                            Dapat menambah, mengedit data & foto, mengatur urutan, atau menghapus dokter/praktisi di slider hero beranda.
                        </p>
                    </div>
                    <button type="button" @click="openAddModal()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-medical-600 hover:bg-medical-700 text-white text-xs font-bold transition shadow-sm shrink-0">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span>Tambah Dokter Baru</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left: Doctors List & Actions (7 cols) -->
                    <div class="lg:col-span-7 space-y-3">
                        <div class="flex items-center justify-between text-xs text-slate-500 px-1 font-semibold">
                            <span>Daftar Slide Dokter (<span x-text="doctors.length"></span> Dokter Terdaftar)</span>
                            <span>Klik "Edit" untuk mengubah data atau foto</span>
                        </div>

                        <!-- Doctors Cards Loop -->
                        <div class="space-y-3">
                            <template x-for="(doc, idx) in doctors" :key="idx">
                                <div class="p-4 rounded-2xl border transition-all duration-200 bg-white shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4"
                                     :class="currentSlide === idx ? 'border-medical-400 ring-2 ring-medical-400/20 bg-medical-50/20' : 'border-slate-200 hover:border-slate-300'">
                                    
                                    <!-- Left Info: Avatar + Details -->
                                    <div class="flex items-center gap-3.5 min-w-0">
                                        <div class="relative w-14 h-16 rounded-xl overflow-hidden bg-slate-100 border border-slate-200 shrink-0 shadow-2xs">
                                            <img :src="doc.image || '{{ asset('images/client_update/image5.png') }}'" 
                                                 :alt="doc.name"
                                                 class="w-full h-full object-cover object-top"
                                                 x-on:error="$el.src = '{{ asset('images/client_update/image5.png') }}'">
                                            <span class="absolute top-1 left-1 w-5 h-5 rounded-full bg-slate-900/80 text-white text-[10px] font-bold flex items-center justify-center" x-text="idx + 1"></span>
                                        </div>

                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] font-bold uppercase tracking-wider text-medical-700 bg-medical-50 px-2 py-0.5 rounded-full" x-text="doc.badge || 'Spesialis'"></span>
                                                <span x-show="currentSlide === idx" class="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full flex items-center gap-1">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                    Aktif di Preview
                                                </span>
                                            </div>
                                            <h4 class="text-sm font-bold text-slate-900 truncate mt-0.5" x-text="doc.name || 'Nama Dokter'"></h4>
                                            <p class="text-xs text-slate-500 truncate" x-text="doc.title || 'Praktisi Medis'"></p>
                                        </div>
                                    </div>

                                    <!-- Right Actions -->
                                    <div class="flex items-center gap-1.5 self-end sm:self-center shrink-0">
                                        <button type="button" @click="moveDoctor(idx, -1)" :disabled="idx === 0" :class="idx === 0 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-slate-100 text-slate-600'" class="p-1.5 rounded-lg border border-slate-200 transition" title="Pindah ke Atas">
                                            <i data-lucide="arrow-up" class="w-3.5 h-3.5"></i>
                                        </button>
                                        <button type="button" @click="moveDoctor(idx, 1)" :disabled="idx === doctors.length - 1" :class="idx === doctors.length - 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-slate-100 text-slate-600'" class="p-1.5 rounded-lg border border-slate-200 transition" title="Pindah ke Bawah">
                                            <i data-lucide="arrow-down" class="w-3.5 h-3.5"></i>
                                        </button>
                                        <button type="button" @click="currentSlide = idx" class="px-2.5 py-1.5 rounded-lg text-xs font-bold transition border" :class="currentSlide === idx ? 'bg-medical-600 text-white border-medical-600' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'" title="Lihat di Preview">
                                            <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        </button>
                                        <button type="button" @click="openEditModal(idx)" class="px-3 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 text-xs font-bold transition flex items-center gap-1 shadow-2xs" title="Edit Dokter Ini">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                            <span>Edit</span>
                                        </button>
                                        <button type="button" x-show="doctors.length > 1" @click="removeDoctor(idx)" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 hover:border-rose-200 transition" title="Hapus Slide">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Floating Badges Config -->
                        <div class="pt-4 border-t border-slate-200 space-y-3">
                            <label class="block text-xs font-extrabold text-slate-900 flex items-center gap-1.5">
                                <i data-lucide="layers" class="w-4 h-4 text-medical-600"></i>
                                <span>Floating Badges Pendukung di Beranda</span>
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Badge 1 (Kiri Atas)</span>
                                    <input type="text" name="hero_badge_1_title" x-model="badge1Title" placeholder="Kemenkes" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white font-bold">
                                    <input type="text" name="hero_badge_1_subtitle" x-model="badge1Subtitle" placeholder="memiliki STR & SIP Resmi" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white text-emerald-700 font-medium">
                                </div>
                                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Badge 2 (Kanan Bawah)</span>
                                    <input type="text" name="hero_badge_2_title" x-model="badge2Title" placeholder="100% Garansi Fitting" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white font-bold">
                                    <input type="text" name="hero_badge_2_subtitle" x-model="badge2Subtitle" placeholder="Akurasi & Kenyamanan" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white text-amber-700 font-medium">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Live Card Slider Preview (5 cols) -->
                    <div class="lg:col-span-5 flex flex-col items-center justify-center p-4 sm:p-6 bg-slate-900 rounded-2xl text-white sticky top-6">
                        <div class="w-full flex items-center justify-between mb-2 border-b border-slate-800 pb-2">
                            <span class="text-xs font-bold text-emerald-400 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                Live Slider Preview
                            </span>
                            <div class="flex items-center gap-1">
                                <button type="button" @click="prevSlide()" class="p-1 rounded bg-slate-800 hover:bg-slate-700 text-white" title="Slide Sebelumnya">
                                    <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                                </button>
                                <span class="text-[10px] font-mono text-slate-400" x-text="(currentSlide + 1) + '/' + doctors.length"></span>
                                <button type="button" @click="nextSlide()" class="p-1 rounded bg-slate-800 hover:bg-slate-700 text-white" title="Slide Selanjutnya">
                                    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Mockup Card -->
                        <div class="relative w-full max-w-[280px] sm:max-w-[320px] my-4">
                            <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white/20 bg-slate-800 backdrop-blur-sm min-h-[360px]">
                                <template x-for="(doc, sIdx) in doctors" :key="sIdx">
                                    <div x-show="currentSlide === sIdx" class="absolute inset-0 transition-opacity duration-300">
                                        <img :src="doc.image || '{{ asset('images/client_update/image5.png') }}'" 
                                             alt="Preview Dokter" 
                                             class="w-full h-[360px] object-cover object-top filter contrast-105 brightness-105"
                                             x-on:error="$el.src = '{{ asset('images/client_update/image5.png') }}'"/>
                                        <div class="absolute inset-0 bg-gradient-to-t from-[#0d1c2f]/90 via-[#0d1c2f]/25 to-transparent flex items-end p-6">
                                            <div class="text-white w-full pr-8">
                                                <span class="text-[10px] uppercase tracking-wider font-bold text-teal-300 bg-white/20 px-2.5 py-0.5 rounded-full backdrop-blur-md inline-block mb-1" x-text="doc.badge || 'Tim Klinis Spesialis'"></span>
                                                <h3 class="text-base font-black text-white leading-tight" x-text="doc.name || 'Nama Dokter'"></h3>
                                                <p class="text-[11px] text-slate-200 mt-0.5 leading-tight" x-text="doc.title || 'Praktisi Ortotik & Prostetik'"></p>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <button type="button" @click="prevSlide()" class="absolute left-2 top-1/2 -translate-y-1/2 w-7 h-7 rounded-full bg-black/40 text-white flex items-center justify-center hover:bg-black/70"><i data-lucide="chevron-left" class="w-4 h-4"></i></button>
                                <button type="button" @click="nextSlide()" class="absolute right-2 top-1/2 -translate-y-1/2 w-7 h-7 rounded-full bg-black/40 text-white flex items-center justify-center hover:bg-black/70"><i data-lucide="chevron-right" class="w-4 h-4"></i></button>
                            </div>
                            <div class="absolute -top-3 -left-3 bg-white text-slate-900 p-2.5 rounded-xl shadow-xl border border-slate-200/50 flex items-center gap-2 scale-90 sm:scale-100 z-10">
                                <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center"><i data-lucide="shield-check" class="w-4 h-4"></i></div>
                                <div><span class="text-[10px] font-bold text-slate-900 block leading-none" x-text="badge1Title || 'Kemenkes'"></span><span class="text-[9px] text-emerald-700 font-semibold" x-text="badge1Subtitle || 'memiliki STR & SIP Resmi'"></span></div>
                            </div>
                            <div class="absolute -bottom-3 -right-3 bg-white text-slate-900 p-2.5 rounded-xl shadow-xl border border-slate-200/50 flex items-center gap-2 scale-90 sm:scale-100 z-10">
                                <div class="w-7 h-7 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center"><i data-lucide="cpu" class="w-4 h-4"></i></div>
                                <div><span class="text-[10px] font-bold text-slate-900 block leading-none" x-text="badge2Title || '100% Garansi Fitting'"></span><span class="text-[9px] text-amber-700 font-semibold" x-text="badge2Subtitle || 'Akurasi & Kenyamanan'"></span></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- ====================================================================== -->
        <!-- TAB 2: BANNER HERO HALAMAN & NARASI PROFIL -->
        <!-- ====================================================================== -->
        <div x-show="activeTab === 'hero_pages'" class="space-y-6" style="display: none;">
            
            <!-- Hero Halaman Tentang Kami & Narasi Profil -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-5">
                <div class="border-b border-slate-100 pb-3 flex items-center gap-2 text-medical-600">
                    <i data-lucide="info" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">Halaman Profil & Narasi Tentang Kami</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Badge Header</label>
                        <input type="text" name="hero_about_badge" value="{{ $settings['hero_about_badge']->value ?? 'Profil & Integritas Medis' }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Judul Utama Halaman</label>
                        <input type="text" name="hero_about_title" value="{{ $settings['hero_about_title']->value ?? 'Tentang pediOcare' }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>
                    <div class="sm:col-span-2 space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Deskripsi Subtitle Header Banner</label>
                        <textarea name="hero_about_subtitle" rows="2" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">{{ $settings['hero_about_subtitle']->value ?? 'Pusat pelayanan ortotik prostetik profesional dengan semangat bermanfaat untuk menunjang fungsi gerak dan kualitas hidup Anda.' }}</textarea>
                    </div>

                    <!-- Full Profile & History Text -->
                    <div class="sm:col-span-2 space-y-1.5 pt-2 border-t border-slate-100">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Teks Narasi Profil Dedikasi & Pengalaman Klinik</label>
                        <textarea name="about_company_description" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500 leading-relaxed">{{ $settings['about_company_description']->value ?? 'Pediocare Berdedikasi melakukan Pelayanan Ortotik Prostetik untuk membantu menunjang fungsi gerak, kenyamanan, serta kualitas hidup pengguna. Sejak 2012 Pediocare telah melayani dengan menghadirkan produk custom maupun readymade dengan mengutamakan kualitas bahan, kerapian pengerjaan, serta memperhatikan kebutuhan setiap pengguna. Dengan 14 tahun pengalaman di dunia alat bantu, Pediocare akan selalu berkomitmen memberi solusi yang terbaik dan dapat diandalkan.' }}</textarea>
                        <p class="text-[11px] text-slate-400">Teks ini tampil pada bagian Tentang Kami di Beranda dan Halaman Profil Tentang Kami.</p>
                    </div>

                    <div class="sm:col-span-2 p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Upload Foto Background Banner Tentang Kami</label>
                        <input type="file" name="hero_about_image_file" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-700 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1">
                        <input type="text" name="hero_about_image" value="{{ $settings['hero_about_image']->value ?? '' }}" placeholder="Atau link URL gambar..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white mt-1">
                    </div>
                </div>
            </div>

            <!-- Hero Halaman Layanan -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-5">
                <div class="border-b border-slate-100 pb-3 flex items-center gap-2 text-medical-600">
                    <i data-lucide="stethoscope" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">Hero Banner Halaman Layanan</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Badge Header</label>
                        <input type="text" name="hero_services_badge" value="{{ $settings['hero_services_badge']->value ?? 'Pelayanan profesional dengan semangat bermanfaat' }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Judul Utama Halaman</label>
                        <input type="text" name="hero_services_title" value="{{ $settings['hero_services_title']->value ?? 'Layanan Orthosis Prosthesis & Alat Bantu Ortopedi' }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>
                    <div class="sm:col-span-2 space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Deskripsi / Subtitle</label>
                        <textarea name="hero_services_subtitle" rows="2" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">{{ $settings['hero_services_subtitle']->value ?? 'Perawatan komprehensif dari evaluasi klinis, perancangan presisi, hingga rehabilitasi gait training berstandar medis.' }}</textarea>
                    </div>
                    <div class="sm:col-span-2 p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Upload Foto Background Banner Layanan</label>
                        <input type="file" name="hero_services_image_file" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-700 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1">
                        <input type="text" name="hero_services_image" value="{{ $settings['hero_services_image']->value ?? '' }}" placeholder="Atau link URL gambar..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white mt-1">
                    </div>
                </div>
            </div>

            <!-- Hero Halaman Kontak -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-5">
                <div class="border-b border-slate-100 pb-3 flex items-center gap-2 text-medical-600">
                    <i data-lucide="phone-call" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">Hero Banner Halaman Kontak & Cabang</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Badge Header</label>
                        <input type="text" name="hero_contact_badge" value="{{ $settings['hero_contact_badge']->value ?? 'Pelayanan & Lokasi Klinik' }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Judul Utama Halaman</label>
                        <input type="text" name="hero_contact_title" value="{{ $settings['hero_contact_title']->value ?? 'Hubungi Kami' }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>
                    <div class="sm:col-span-2 space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Deskripsi / Subtitle</label>
                        <textarea name="hero_contact_subtitle" rows="2" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">{{ $settings['hero_contact_subtitle']->value ?? 'Kami siap melayani Anda dengan teknologi ortopedi mutakhir dan perawatan profesional yang mengutamakan kenyamanan pasien. Care your milestone.' }}</textarea>
                    </div>
                    <div class="sm:col-span-2 p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Upload Foto Background Banner Kontak</label>
                        <input type="file" name="hero_contact_image_file" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-700 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1">
                        <input type="text" name="hero_contact_image" value="{{ $settings['hero_contact_image']->value ?? '' }}" placeholder="Atau link URL gambar..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white mt-1">
                    </div>
                </div>
            </div>

        </div>

        <!-- ====================================================================== -->
        <!-- TAB 3: ALAMAT, KONTAK & GOOGLE MAPS -->
        <!-- ====================================================================== -->
        <div x-show="activeTab === 'location_maps'" class="space-y-6" style="display: none;">
            
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2 text-medical-600">
                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                        <h3 class="text-base font-extrabold text-slate-900">Alamat Pusat & Peta Google Maps</h3>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">
                        Pengaturan ini langsung tampil secara dinamis di Beranda, Kontak, dan Footer. Peta Google Maps dapat diatur dengan mudah melalui alamat atau URL embed.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Kota / Wilayah</label>
                        <input type="text" name="clinic_city" x-model="clinicCity" value="{{ $settings['clinic_city']->value ?? 'Sleman, D.I. Yogyakarta' }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Jam Operasional</label>
                        <input type="text" name="opening_hours" value="{{ $settings['opening_hours']->value ?? 'Senin - Sabtu: 08.00 - 17.00 WIB' }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>

                    <div class="sm:col-span-2 space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Alamat Lengkap Klinik</label>
                        <textarea name="clinic_address" rows="2" x-model="clinicAddress" @input="updateMapPreview()"
                                  class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">{{ $settings['clinic_address']->value ?? ($settings['footer_address']->value ?? 'Jl. Kaliurang KM 8.5, Sinduharjo, Ngaglik, Sleman, D.I. Yogyakarta 55581') }}</textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">No. WhatsApp Konsultasi</label>
                        <input type="text" name="hotline_whatsapp" value="{{ $settings['hotline_whatsapp']->value ?? '6285697922194' }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Email Resmi Klinik</label>
                        <input type="email" name="contact_email" value="{{ $settings['contact_email']->value ?? 'info@pediocare.id' }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>

                </div>

                <!-- Google Maps Embed & Live Map Preview -->
                <div class="pt-6 border-t border-slate-200 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <label class="block text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                            <i data-lucide="map" class="w-4 h-4 text-medical-600"></i>
                            <span>Pengaturan Peta Google Maps</span>
                        </label>
                        <div class="flex items-center gap-1.5">
                            <span class="text-[11px] text-slate-500">Pilih Cepat:</span>
                            <button type="button" @click="setMapPreset('Jl. Kaliurang KM 8.5, Sinduharjo, Ngaglik, Sleman, Yogyakarta')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-[11px] font-bold text-slate-700 transition">
                                Sleman (Pusat)
                            </button>
                            <button type="button" @click="setMapPreset('Jakarta Selatan, Indonesia')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-[11px] font-bold text-slate-700 transition">
                                Jakarta
                            </button>
                            <button type="button" @click="setMapPreset('Bandung, Indonesia')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-[11px] font-bold text-slate-700 transition">
                                Bandung
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                        
                        <div class="space-y-3">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">HTML Iframe Embed Google Maps (Opsional)</label>
                                <textarea name="google_maps_embed" rows="3" x-model="mapEmbed" @input="updateMapPreview()" placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'
                                          class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-mono bg-slate-50 focus:ring-2 focus:ring-medical-500"></textarea>
                                <p class="text-[10px] text-slate-400 mt-1">Jika dikosongkan, peta akan otomatis dibuat dari alamat di atas.</p>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Link Share Google Maps (Untuk Tombol Buka di Maps)</label>
                                <input type="url" name="google_maps_url" value="{{ $settings['google_maps_url']->value ?? 'https://maps.google.com/?q=pediOcare+Sleman' }}" placeholder="https://maps.app.goo.gl/..."
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500">
                            </div>
                        </div>

                        <!-- Live Interactive Map Preview -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs font-bold text-slate-700">
                                <span>Preview Peta di Website:</span>
                                <span class="text-[10px] text-emerald-600 font-semibold flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Live Interactive
                                </span>
                            </div>
                            <div class="w-full h-56 rounded-2xl overflow-hidden border-2 border-slate-300 shadow-sm bg-slate-100">
                                <iframe :src="mapPreviewSrc" class="w-full h-full border-0" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <!-- ====================================================================== -->
        <!-- TAB 4: IDENTITAS KLINIK & FOOTER -->
        <!-- ====================================================================== -->
        <div x-show="activeTab === 'footer_branding'" class="space-y-6" style="display: none;">
            
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2 text-medical-600">
                        <i data-lucide="building" class="w-5 h-5"></i>
                        <h3 class="text-base font-extrabold text-slate-900">Identitas Branding Klinik</h3>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Nama klinik akan otomatis diterapkan di seluruh header, navbar, footer, dan tombol konsultasi.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Nama Resmi Klinik <span class="text-rose-500">*</span></label>
                        <input type="text" name="clinic_name" value="{{ $settings['clinic_name']->value ?? 'pediOcare' }}" required
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-bold focus:ring-2 focus:ring-medical-500">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Tagline / Slogan Klinik</label>
                        <input type="text" name="clinic_tagline" value="{{ $settings['clinic_tagline']->value ?? 'Care your milestone' }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2 text-medical-600">
                        <i data-lucide="layout-template" class="w-5 h-5"></i>
                        <h3 class="text-base font-extrabold text-slate-900">Pengaturan Tampilan & Kontak Footer</h3>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Kelola email resmi, teks deskripsi pengantar, nomor kontak, dan alamat singkat pada bagian footer bawah.</p>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase">Email Footer / Resmi</label>
                            <input type="email" name="contact_email" value="{{ $settings['contact_email']->value ?? 'info@pediocare.id' }}"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                            <p class="text-[10px] text-slate-400">Email ini langsung tampil di baris kontak footer website.</p>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase">No. Telepon / Hotline</label>
                            <input type="text" name="phone_number" value="{{ $settings['phone_number']->value ?? '0856 9792 2194' }}"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Deskripsi Profil di Footer</label>
                        <textarea name="footer_description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">{{ $settings['footer_description']->value ?? 'Pusat pelayanan Ortotik Prostetik profesional dengan semangat bermanfaat untuk menunjang fungsi gerak dan kualitas hidup Anda.' }}</textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Alamat Footer</label>
                        <input type="text" name="footer_address" value="{{ $settings['footer_address']->value ?? 'Jl. Kaliurang KM 8.5, Sinduharjo, Ngaglik, Sleman, D.I. Yogyakarta 55581' }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase">Instagram URL</label>
                            <input type="text" name="instagram_url" value="{{ $settings['instagram_url']->value ?? 'https://instagram.com/pediocare' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase">YouTube URL</label>
                            <input type="text" name="youtube_url" value="{{ $settings['youtube_url']->value ?? 'https://youtube.com/@pediocare' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase">Facebook URL</label>
                            <input type="text" name="facebook_url" value="{{ $settings['facebook_url']->value ?? '' }}" placeholder="https://facebook.com/pediocare" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase">TikTok URL</label>
                            <input type="text" name="tiktok_url" value="{{ $settings['tiktok_url']->value ?? '' }}" placeholder="https://tiktok.com/@pediocare" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ====================================================================== -->
        <!-- TAB 5: SEO & METADATA -->
        <!-- ====================================================================== -->
        <div x-show="activeTab === 'seo_meta'" class="space-y-6" style="display: none;">
            
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2 text-medical-600">
                        <i data-lucide="search" class="w-5 h-5"></i>
                        <h3 class="text-base font-extrabold text-slate-900">SEO & Metadata Website</h3>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Konfigurasi optimasi mesin pencari Google untuk halaman utama.</p>
                </div>

                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Default Meta Title</label>
                        <input type="text" name="meta_title" value="{{ $settings['meta_title']->value ?? 'pediOcare - Care your milestone' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Meta Deskripsi (Google Search Summary)</label>
                        <textarea name="meta_description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">{{ $settings['meta_description']->value ?? 'Pusat pelayanan Ortotik Prostetik berstandar Kemenkes RI. Care your milestone.' }}</textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Meta Keywords (Kata Kunci)</label>
                        <input type="text" name="meta_keywords" value="{{ $settings['meta_keywords']->value ?? 'kaki palsu, tangan palsu, ortotik prostetik, AFO, korset skoliosis' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500">
                    </div>
                </div>
            </div>

        </div>

        <!-- Sticky Submit Footer -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 shadow-sm flex items-center justify-between sticky bottom-4 z-30">
            <span class="text-xs text-slate-500 hidden sm:inline">Perubahan yang Anda simpan akan langsung aktif di seluruh website.</span>
            <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                <span>Simpan Seluruh Pengaturan</span>
            </button>
        </div>

    </form>

    <!-- MODAL: EDIT / ADD DOCTOR DIALOG -->
    <div x-show="isModalOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4"
         style="display: none;">
        
        <div @click.away="closeModal()" 
             class="bg-white rounded-3xl shadow-2xl border border-slate-200 w-full max-w-lg overflow-hidden transform transition-all space-y-5 p-6 sm:p-7 animate-in fade-in zoom-in-95 duration-200">
            
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2 text-medical-600">
                    <i data-lucide="edit-3" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900" x-text="editIndex === -1 ? 'Tambah Dokter / Praktisi Baru' : 'Edit Data Dokter (Slide ' + (editIndex + 1) + ')'"></h3>
                </div>
                <button type="button" @click="closeModal()" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-xl hover:bg-slate-100 transition">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="space-y-4">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-center gap-4">
                    <div class="w-16 h-20 rounded-xl overflow-hidden bg-white border border-slate-300 shrink-0 shadow-xs">
                        <img :src="editData.image || '{{ asset('images/client_update/image5.png') }}'" alt="Preview" class="w-full h-full object-cover object-top" x-on:error="$el.src = '{{ asset('images/client_update/image5.png') }}'">
                    </div>
                    <div class="space-y-2 flex-1">
                        <label class="block text-[11px] font-bold text-slate-700 uppercase">Upload Foto Dokter Baru</label>
                        <input type="file" accept="image/*" @change="handleModalFileUpload($event)" class="w-full text-xs text-slate-600 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-medical-50 file:text-medical-600 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-lg bg-white p-1">
                        <p class="text-[10px] text-slate-400">Rasio potret vertikal direkomendasikan.</p>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Atau URL / Path Foto Gambar</label>
                    <input type="text" x-model="editData.image" placeholder="https://... atau /images/client_update/image5.png" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-medical-500 focus:outline-none">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Nama Lengkap & Gelar *</label>
                    <input type="text" x-model="editData.name" placeholder="Muhammad Antas Salam., S.Tr.Kes" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-medical-500 focus:outline-none font-bold">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Jabatan / Spesialisasi Medis</label>
                    <input type="text" x-model="editData.title" placeholder="Praktisi Ortotik & Prostetik Medis" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-medical-500 focus:outline-none">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Label Badge Kategori</label>
                    <input type="text" x-model="editData.badge" placeholder="Tim Klinis Spesialis" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-medical-500 focus:outline-none">
                </div>
            </div>

            <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-slate-100">
                <button type="button" @click="closeModal()" class="px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-100 text-xs font-bold text-slate-600 transition">Batal</button>
                <button type="button" @click="saveModalData()" class="px-5 py-2.5 rounded-xl bg-medical-600 hover:bg-medical-700 text-white text-xs font-bold shadow-sm transition flex items-center gap-1.5">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span>Terapkan Perubahan</span>
                </button>
            </div>

        </div>
    </div>

</div>

<script>
function settingsManager(initialDoctors, initialTab, initialHeroMedia, initialHeroMediaType) {
    return {
        activeTab: initialTab || 'hero_home',
        doctors: initialDoctors || [],
        currentSlide: 0,
        badge1Title: '{{ $settings['hero_badge_1_title']->value ?? 'Kemenkes' }}',
        badge1Subtitle: '{{ $settings['hero_badge_1_subtitle']->value ?? 'memiliki STR & SIP Resmi' }}',
        badge2Title: '{{ $settings['hero_badge_2_title']->value ?? '100% Garansi Fitting' }}',
        badge2Subtitle: '{{ $settings['hero_badge_2_subtitle']->value ?? 'Akurasi & Kenyamanan' }}',

        // Hero Background Media (Image or Video)
        heroHomeMedia: initialHeroMedia || 'https://lh3.googleusercontent.com/aida/AP1WRLu-cYuotNRMpQoNz8xiNuno33F9xSgeFfAKDWqxDogo2VSMvAuCS4QUt2jbop_cQ4e18T36Uqa6an8ezvVtDtXtwih7tYUxTzRHyWrqiqVAcV-b3G6wS_YbGIeB9Bl7tYBFGY4K81YU6TE_o1OvhLPzQstL7r4XrQEGsJ3mWxHjfxXavdzURFHoctGm1HxnTSA9wW180ytfdljOX3A9UWVLpKx5mwhgV3xHx-gbLfAcVFwk-s2AOYLy',
        heroHomeMediaType: initialHeroMediaType || 'image',

        // Maps & Address
        clinicCity: '{{ $settings['clinic_city']->value ?? 'Sleman, D.I. Yogyakarta' }}',
        clinicAddress: '{{ $settings['clinic_address']->value ?? ($settings['footer_address']->value ?? 'Jl. Kaliurang KM 8.5, Sinduharjo, Ngaglik, Sleman, D.I. Yogyakarta 55581') }}',
        mapEmbed: '{{ $settings['google_maps_embed']->value ?? '' }}',
        mapPreviewSrc: '',

        init() {
            this.updateMapPreview();
        },

        setTab(tabName) {
            this.activeTab = tabName;
            this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
        },

        handleHeroMediaUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const isVid = file.type.startsWith('video/') || file.name.match(/\.(mp4|webm|ogg|mov)$/i);
                this.heroHomeMediaType = isVid ? 'video' : 'image';
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.heroHomeMedia = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        detectMediaType() {
            if (this.heroHomeMedia && this.heroHomeMedia.match(/\.(mp4|webm|ogg|mov)$/i)) {
                this.heroHomeMediaType = 'video';
            }
        },

        updateMapPreview() {
            if (this.mapEmbed && this.mapEmbed.trim() !== '') {
                const match = this.mapEmbed.match(/src="([^"]+)"/);
                if (match) {
                    this.mapPreviewSrc = match[1];
                } else if (this.mapEmbed.startsWith('http')) {
                    this.mapPreviewSrc = this.mapEmbed;
                } else {
                    this.mapPreviewSrc = 'https://maps.google.com/maps?q=' + encodeURIComponent(this.clinicAddress || 'Sleman Yogyakarta') + '&t=&z=15&ie=UTF8&iwloc=&output=embed';
                }
            } else {
                this.mapPreviewSrc = 'https://maps.google.com/maps?q=' + encodeURIComponent(this.clinicAddress || 'Sleman Yogyakarta') + '&t=&z=15&ie=UTF8&iwloc=&output=embed';
            }
        },

        setMapPreset(addressText) {
            this.clinicAddress = addressText;
            this.mapEmbed = '';
            this.updateMapPreview();
        },

        // Modal Edit States
        isModalOpen: false,
        editIndex: -1,
        editData: { name: '', title: '', badge: '', image: '' },

        openAddModal() {
            this.editIndex = -1;
            this.editData = {
                name: 'Praktisi Medis Baru',
                title: 'Spesialis Ortotik & Prostetik',
                badge: 'Tim Klinis Spesialis',
                image: '{{ asset('images/client_update/image5.png') }}'
            };
            this.isModalOpen = true;
            this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
        },

        openEditModal(index) {
            this.editIndex = index;
            this.editData = {
                name: this.doctors[index].name || '',
                title: this.doctors[index].title || '',
                badge: this.doctors[index].badge || '',
                image: this.doctors[index].image || ''
            };
            this.isModalOpen = true;
            this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
        },

        closeModal() {
            this.isModalOpen = false;
            this.editIndex = -1;
        },

        saveModalData() {
            if (this.editIndex === -1) {
                this.doctors.push({
                    name: this.editData.name || 'Tenaga Medis',
                    title: this.editData.title || 'Praktisi Ortotik Prostetik',
                    badge: this.editData.badge || 'Tim Klinis Spesialis',
                    image: this.editData.image || '{{ asset('images/client_update/image5.png') }}'
                });
                this.currentSlide = this.doctors.length - 1;
            } else if (this.doctors[this.editIndex]) {
                this.doctors[this.editIndex].name = this.editData.name;
                this.doctors[this.editIndex].title = this.editData.title;
                this.doctors[this.editIndex].badge = this.editData.badge;
                this.doctors[this.editIndex].image = this.editData.image;
                this.currentSlide = this.editIndex;
            }
            this.closeModal();
            this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
        },

        handleModalFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.editData.image = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        moveDoctor(index, direction) {
            const targetIndex = index + direction;
            if (targetIndex >= 0 && targetIndex < this.doctors.length) {
                const temp = this.doctors[index];
                this.doctors[index] = this.doctors[targetIndex];
                this.doctors[targetIndex] = temp;
                this.currentSlide = targetIndex;
                this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
            }
        },

        removeDoctor(index) {
            if (this.doctors.length > 1) {
                if (confirm('Yakin ingin menghapus slide dokter ini?')) {
                    this.doctors.splice(index, 1);
                    if (this.currentSlide >= this.doctors.length) {
                        this.currentSlide = this.doctors.length - 1;
                    }
                    this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
                }
            }
        },

        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.doctors.length;
        },

        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.doctors.length) % this.doctors.length;
        }
    };
}
</script>
@endsection
