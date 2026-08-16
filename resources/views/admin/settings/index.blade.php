@extends('admin.layouts.app')

@section('title', 'Pengaturan Website & Klinik')
@section('header_title', 'Pengaturan Profil Klinik & Kontak')

@section('content')
<div class="max-w-4xl space-y-6">

    <div>
        <h2 class="text-lg font-black text-slate-900">Pengaturan Umum & SEO</h2>
        <p class="text-xs text-slate-500">Kelola identitas klinik, kontak darurat, WhatsApp center, dan deskripsi SEO mesin pencari.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm space-y-6">
        @csrf
        @method('PUT')

        <!-- Clinic Identity -->
        <div>
            <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4">Identitas & Kontak Utama Klinik</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Klinik</label>
                    <input type="text" name="clinic_name" value="{{ $settings['clinic_name']->value ?? 'Klinik Ortotik & Prostetik Indonesia' }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Tagline Klinik</label>
                    <input type="text" name="clinic_tagline" value="{{ $settings['clinic_tagline']->value ?? 'Pusat Ortotik & Prostetik Medis Presisi & Terpercaya' }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">No. WhatsApp Hotline Pusat</label>
                    <input type="text" name="hotline_whatsapp" value="{{ $settings['hotline_whatsapp']->value ?? '081234567890' }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Email Kontak Resmi</label>
                    <input type="email" name="contact_email" value="{{ $settings['contact_email']->value ?? 'info@ortotik.co.id' }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>
            </div>
        </div>

        <!-- Social Links -->
        <div>
            <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4">Media Sosial & Alamat</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Instagram URL</label>
                    <input type="text" name="instagram_url" value="{{ $settings['instagram_url']->value ?? 'https://instagram.com/ortotik.id' }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">YouTube / Edukasi Video</label>
                    <input type="text" name="youtube_url" value="{{ $settings['youtube_url']->value ?? 'https://youtube.com/@ortotik' }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Alamat Pusat Singkat (Footer)</label>
                    <input type="text" name="footer_address" value="{{ $settings['footer_address']->value ?? 'Jl. RS Fatmawati Raya No. 88, Cilandak, Jakarta Selatan 12430' }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>
            </div>
        </div>

        <!-- SEO Meta -->
        <div>
            <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4">SEO & Meta Description</h3>
            
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Meta Deskripsi Default (Google Search)</label>
                    <textarea name="meta_description" rows="3"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ $settings['meta_description']->value ?? 'Klinik spesialis ortotik prostetik terpercaya di Indonesia. Melayani pembuatan kaki palsu, tangan palsu, korset skoliosis, AFO, dan KAFO berstandar medis dengan garansi fitting presisi.' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-6 py-3 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs shadow-sm transition">
                Simpan Pengaturan
            </button>
        </div>
    </form>

</div>
@endsection
