@extends('admin.layouts.app')

@section('title', 'Tambah Testimoni Pasien')
@section('header_title', 'Tambah Testimoni Pasien')

@section('content')
<div class="max-w-2xl space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-black text-slate-900">Tambah Testimoni Baru</h2>
            <p class="text-xs text-slate-500 mt-0.5">Testimoni ini dapat ditampilkan pada section "Apa Kata Pasien Kami" di Beranda.</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="px-4 py-2 rounded-xl border border-slate-200 hover:bg-slate-100 text-slate-600 text-xs font-bold transition">
            &larr; Kembali
        </a>
    </div>

    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
        @csrf

        @if ($errors->any())
        <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
            <strong class="font-bold">Mohon perbaiki kesalahan berikut:</strong>
            <ul class="list-disc list-inside mt-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Nama Pasien / Klien <span class="text-rose-500">*</span></label>
                    <input type="text" name="patient_name" value="{{ old('patient_name') }}" placeholder="Contoh: Bapak Budi Santoso" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold focus:ring-2 focus:ring-medical-500 focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Info Pasien (Kota / Usia)</label>
                    <input type="text" name="patient_info" value="{{ old('patient_info') }}" placeholder="Contoh: Sleman • Pasien Kaki Palsu"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Layanan / Alat yang Digunakan <span class="text-rose-500">*</span></label>
                    <input type="text" name="service_used" value="{{ old('service_used') }}" placeholder="Contoh: Kaki Palsu Bawah Lutut (Transtibial)" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500 focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Rating Bintang</label>
                    <select name="rating" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold focus:ring-2 focus:ring-medical-500 focus:outline-none">
                        <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ 5 Bintang (Sangat Puas)</option>
                        <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ 4 Bintang (Puas)</option>
                        <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ 3 Bintang (Cukup)</option>
                    </select>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase">Teks Ulasan / Testimoni Pasien <span class="text-rose-500">*</span></label>
                <textarea name="testimony" rows="4" placeholder="Tuliskan ulasan atau pengalaman pasien saat menggunakan layanan dan alat bantu..." required
                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-medical-500 focus:outline-none leading-relaxed">{{ old('testimony') }}</textarea>
            </div>

            <!-- Upload Photo -->
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                <label class="block text-xs font-bold text-slate-700 uppercase">Foto Pasien / Avatar (Opsional)</label>
                <input type="file" name="photo_file" accept="image/*"
                       class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-700 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1">
                <input type="text" name="photo" value="{{ old('photo') }}" placeholder="Atau link URL foto..."
                       class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white mt-1">
            </div>

            <!-- Switches -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <label class="flex items-center gap-3 p-3.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer transition">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-4 h-4 rounded text-medical-600 focus:ring-medical-500 border-slate-300">
                    <div>
                        <span class="block text-xs font-bold text-slate-900">Status Aktif</span>
                        <span class="text-[11px] text-slate-400">Tampilkan di website</span>
                    </div>
                </label>

                <label class="flex items-center gap-3 p-3.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer transition">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', false) ? 'checked' : '' }}
                           class="w-4 h-4 rounded text-amber-500 focus:ring-amber-400 border-slate-300">
                    <div>
                        <span class="block text-xs font-bold text-slate-900">Jadikan Unggulan (Featured)</span>
                        <span class="text-[11px] text-slate-400">Prioritaskan tampil di slider beranda</span>
                    </div>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.testimonials.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-100 text-xs font-bold text-slate-600 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-medical-600 hover:bg-medical-700 text-white text-xs font-bold shadow-sm transition flex items-center gap-1.5">
                <i data-lucide="check" class="w-4 h-4"></i>
                <span>Simpan Testimoni</span>
            </button>
        </div>
    </form>
</div>
@endsection
