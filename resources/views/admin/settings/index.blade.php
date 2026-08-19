@extends('admin.layouts.app')

@section('title', 'Pengaturan Website & Visual')
@section('header_title', 'Pengaturan Situs & Visual Beranda')

@section('content')
<div class="max-w-5xl space-y-6" x-data="settingsHeroManager()">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900">Pengaturan Situs & Visual Beranda</h2>
            <p class="text-xs text-slate-500 mt-0.5">Kelola visual banner hero utama (foto dokter/tim medis dengan gradient overlay), identitas klinik, kontak WhatsApp, dan SEO.</p>
        </div>
        <div>
            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition shadow-sm">
                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                <span>Lihat Live Beranda</span>
            </a>
        </div>
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

        <!-- SECTION 1: Visual Hero Beranda & Kartu Tenaga Medis -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <div class="flex items-center gap-2 text-medical-600">
                    <i data-lucide="image" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">Visual Hero Beranda (Banner Utama & Kartu Dokter)</h3>
                </div>
                <p class="text-xs text-slate-500 mt-1">
                    Atur foto tenaga medis/spesialis yang tampil di bagian Hero Beranda dengan kartu gradient overlay <code class="bg-slate-100 text-slate-700 px-1.5 py-0.5 rounded text-[11px]">bg-gradient-to-t from-on-background/75</code>.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left: Form Controls (7 cols) -->
                <div class="lg:col-span-7 space-y-5">
                    
                    <!-- File Upload & URL -->
                    <div class="space-y-3 p-4 rounded-xl bg-slate-50 border border-slate-200">
                        <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                            Upload Foto Dokter / Tim Medis Baru
                        </label>
                        
                        <div class="flex flex-col sm:flex-row gap-3 items-center">
                            <input type="file" 
                                   name="hero_doctor_image_file" 
                                   id="hero_doctor_image_file" 
                                   accept="image/*"
                                   @change="handleFileUpload($event)"
                                   class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-600 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1">
                        </div>
                        <p class="text-[11px] text-slate-400">Format yang didukung: JPG, PNG, WEBP, SVG (Maks. 5MB). Rekomendasi rasio vertikal (portrait).</p>

                        <div class="pt-2 border-t border-slate-200/80">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Atau Gunakan URL Gambar Langsung</label>
                            <input type="text" 
                                   name="hero_doctor_image" 
                                   x-model="heroImage"
                                   @input="handleUrlInput()"
                                   placeholder="https://images.unsplash.com/..."
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-medical-500">
                        </div>
                    </div>

                    <!-- Overlay Texts: Badge & Name -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Badge Card</label>
                            <input type="text" 
                                   name="hero_doctor_badge" 
                                   x-model="heroBadge"
                                   placeholder="Tim Klinis Spesialis"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Dokter / Praktisi</label>
                            <input type="text" 
                                   name="hero_doctor_name" 
                                   x-model="heroName"
                                   placeholder="dr. Hendra Pratama, Sp.OT"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
                        </div>
                    </div>

                    <!-- Title / Subtitle & Alt Text -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Jabatan / Spesialisasi</label>
                            <input type="text" 
                                   name="hero_doctor_title" 
                                   x-model="heroTitle"
                                   placeholder="Praktisi Ortotik & Prostetik Bionik"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Alt Text (Aksesibilitas)</label>
                            <input type="text" 
                                   name="hero_doctor_alt" 
                                   value="{{ $settings['hero_doctor_alt']->value ?? 'Dokter Spesialis Ortotik Prostetik PT. Orthocare Indonesia' }}"
                                   placeholder="Dokter Spesialis Ortotik Prostetik"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
                        </div>
                    </div>

                    <!-- Floating Badges Config -->
                    <div class="pt-3 border-t border-slate-100">
                        <label class="block text-xs font-extrabold text-slate-900 mb-3 flex items-center gap-1.5">
                            <i data-lucide="layers" class="w-4 h-4 text-medical-600"></i>
                            <span>Floating Badges Pendukung di Beranda</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Badge 1 -->
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Badge 1 (Kiri Atas)</span>
                                <input type="text" name="hero_badge_1_title" x-model="badge1Title" placeholder="Kemenkes RI" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white">
                                <input type="text" name="hero_badge_1_subtitle" x-model="badge1Subtitle" placeholder="Tersertifikasi Resmi" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white text-emerald-700 font-medium">
                            </div>

                            <!-- Badge 2 -->
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                                <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Badge 2 (Kanan Bawah)</span>
                                <input type="text" name="hero_badge_2_title" x-model="badge2Title" placeholder="3D CAD/CAM" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white">
                                <input type="text" name="hero_badge_2_subtitle" x-model="badge2Subtitle" placeholder="Akurasi Milimeter" class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs bg-white text-amber-700 font-medium">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right: Live Card Preview (5 cols) -->
                <div class="lg:col-span-5 flex flex-col items-center justify-center p-4 sm:p-6 bg-slate-900 rounded-2xl text-white">
                    <div class="w-full flex items-center justify-between mb-4 border-b border-slate-800 pb-2">
                        <span class="text-xs font-bold text-emerald-400 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Live Card Preview di Beranda
                        </span>
                        <span class="text-[10px] text-slate-400">Gradient Overlay</span>
                    </div>

                    <!-- Live Card Mockup matching home.blade.php -->
                    <div class="relative w-full max-w-[280px] sm:max-w-[320px] my-4">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white/20 bg-slate-800 backdrop-blur-sm">
                            <img :src="previewImageSrc" 
                                 alt="Preview Dokter" 
                                 class="w-full h-[360px] object-cover object-top filter contrast-105 brightness-105"
                                 x-on:error="$el.src = 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=800&q=80'"/>
                            
                            <!-- Exact requested gradient overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0d1c2f]/85 via-[#0d1c2f]/20 to-transparent flex items-end p-6">
                                <div class="text-white">
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-teal-300 bg-white/20 px-2.5 py-0.5 rounded-full backdrop-blur-md inline-block mb-1.5"
                                          x-text="heroBadge || 'Tim Klinis Spesialis'">
                                    </span>
                                    <h3 class="text-base font-bold text-white leading-tight" x-text="heroName || 'dr. Hendra Pratama, Sp.OT'"></h3>
                                    <p class="text-[11px] text-slate-200 mt-0.5" x-text="heroTitle || 'Praktisi Ortotik & Prostetik Bionik'"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Mock Floating Badge 1 (Top Left) -->
                        <div class="absolute -top-3 -left-3 bg-white text-slate-900 p-2.5 rounded-xl shadow-xl border border-slate-200/50 flex items-center gap-2 scale-90 sm:scale-100">
                            <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                                <i data-lucide="shield-check" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-slate-900 block leading-none" x-text="badge1Title || 'Kemenkes RI'"></span>
                                <span class="text-[9px] text-emerald-700 font-semibold" x-text="badge1Subtitle || 'Tersertifikasi Resmi'"></span>
                            </div>
                        </div>

                        <!-- Mock Floating Badge 2 (Bottom Right) -->
                        <div class="absolute -bottom-3 -right-3 bg-white text-slate-900 p-2.5 rounded-xl shadow-xl border border-slate-200/50 flex items-center gap-2 scale-90 sm:scale-100">
                            <div class="w-7 h-7 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center">
                                <i data-lucide="cpu" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-slate-900 block leading-none" x-text="badge2Title || '3D CAD/CAM'"></span>
                                <span class="text-[9px] text-amber-700 font-semibold" x-text="badge2Subtitle || 'Akurasi Milimeter'"></span>
                            </div>
                        </div>
                    </div>

                    <p class="text-[11px] text-slate-400 text-center mt-3">
                        Tampilan ini merepresentasikan persis kartu visual dokter pada halaman Beranda utama.
                    </p>
                </div>

            </div>
        </div>

        <!-- SECTION 2: Clinic Identity & Contact -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <div class="flex items-center gap-2 text-medical-600">
                    <i data-lucide="building" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">Identitas & Kontak Utama Klinik</h3>
                </div>
                <p class="text-xs text-slate-500 mt-1">Nama resmi klinik, tagline branding, nomor WhatsApp konsultasi pusat, dan email kontak.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Klinik</label>
                    <input type="text" name="clinic_name" value="{{ $settings['clinic_name']->value ?? ($settings['site_name']->value ?? 'PT. Orthocare Indonesia') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Tagline Klinik</label>
                    <input type="text" name="clinic_tagline" value="{{ $settings['clinic_tagline']->value ?? ($settings['site_tagline']->value ?? 'High-Tech Orthopedic Care & Precision Prosthetics') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">No. WhatsApp Hotline Pusat</label>
                    <input type="text" name="hotline_whatsapp" value="{{ $settings['hotline_whatsapp']->value ?? ($settings['whatsapp_global']->value ?? '6281234567890') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Email Kontak Resmi</label>
                    <input type="email" name="contact_email" value="{{ $settings['contact_email']->value ?? ($settings['company_email']->value ?? 'info@orthocare.co.id') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>
            </div>
        </div>

        <!-- SECTION 3: Social Links & Address -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <div class="flex items-center gap-2 text-medical-600">
                    <i data-lucide="share-2" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">Media Sosial & Alamat Kantor Pusat</h3>
                </div>
                <p class="text-xs text-slate-500 mt-1">Tautan akun sosial media dan alamat lengkap klinik untuk footer.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Instagram URL</label>
                    <input type="text" name="instagram_url" value="{{ $settings['instagram_url']->value ?? 'https://instagram.com/ortotikindonesia' }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">YouTube Channel URL</label>
                    <input type="text" name="youtube_url" value="{{ $settings['youtube_url']->value ?? 'https://youtube.com/@ortotikindonesia' }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Alamat Pusat Singkat (Footer)</label>
                    <input type="text" name="footer_address" value="{{ $settings['footer_address']->value ?? ($settings['company_address']->value ?? 'Jl. Kaliurang KM 8.5, Sinduharjo, Ngaglik, Sleman, D.I. Yogyakarta 55581') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>
            </div>
        </div>

        <!-- SECTION 4: SEO Meta -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <div class="flex items-center gap-2 text-medical-600">
                    <i data-lucide="search" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">SEO & Meta Description</h3>
                </div>
                <p class="text-xs text-slate-500 mt-1">Ringkasan website default yang terbaca oleh mesin pencari Google.</p>
            </div>
            
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Meta Deskripsi Default (Google Search)</label>
                <textarea name="meta_description" rows="3"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ $settings['meta_description']->value ?? 'Klinik spesialis ortotik prostetik terpercaya di Indonesia. Melayani pembuatan kaki palsu, tangan palsu, korset skoliosis, AFO, dan KAFO berstandar medis dengan garansi fitting presisi.' }}</textarea>
            </div>
        </div>

        <!-- Sticky Submit Footer -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 shadow-sm flex items-center justify-between">
            <span class="text-xs text-slate-500 hidden sm:inline">Pastikan data yang diinput sudah sesuai sebelum menyimpan.</span>
            <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                <span>Simpan Seluruh Pengaturan</span>
            </button>
        </div>

    </form>

</div>

@php
    $currentHeroImageVal = $settings['hero_doctor_image']->value ?? 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=800&q=80';
    if (!str_starts_with($currentHeroImageVal, 'http') && !str_starts_with($currentHeroImageVal, '/')) {
        $currentHeroImageSrc = asset('storage/' . $currentHeroImageVal);
    } else {
        $currentHeroImageSrc = $currentHeroImageVal;
    }
@endphp

<script>
function settingsHeroManager() {
    return {
        heroImage: '{{ $settings['hero_doctor_image']->value ?? '' }}',
        previewImageSrc: '{{ $currentHeroImageSrc }}',
        heroBadge: '{{ $settings['hero_doctor_badge']->value ?? 'Tim Klinis Spesialis' }}',
        heroName: '{{ $settings['hero_doctor_name']->value ?? 'dr. Hendra Pratama, Sp.OT' }}',
        heroTitle: '{{ $settings['hero_doctor_title']->value ?? 'Praktisi Ortotik & Prostetik Bionik' }}',
        badge1Title: '{{ $settings['hero_badge_1_title']->value ?? 'Kemenkes RI' }}',
        badge1Subtitle: '{{ $settings['hero_badge_1_subtitle']->value ?? 'Tersertifikasi Resmi' }}',
        badge2Title: '{{ $settings['hero_badge_2_title']->value ?? '3D CAD/CAM' }}',
        badge2Subtitle: '{{ $settings['hero_badge_2_subtitle']->value ?? 'Akurasi Milimeter' }}',

        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.previewImageSrc = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        handleUrlInput() {
            if (this.heroImage && this.heroImage.trim() !== '') {
                this.previewImageSrc = this.heroImage;
            } else {
                this.previewImageSrc = '{{ $currentHeroImageSrc }}';
            }
        }
    };
}
</script>
@endsection


