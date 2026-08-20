@extends('admin.layouts.app')

@section('title', 'Tambah Cabang Klinik')
@section('header_title', 'Tambah Cabang Klinik Baru')

@section('content')
<div class="max-w-3xl space-y-6" x-data="{
    imagePreview: '{{ old('image') ?? '' }}',
    handleFileSelect(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (ev) => {
                this.imagePreview = ev.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
}">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.branches.index') }}" class="text-xs font-bold text-slate-500 hover:text-medical-600 inline-flex items-center gap-1.5 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali ke Daftar Cabang</span>
        </a>
    </div>

    @if ($errors->any())
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs space-y-1">
        <strong>Periksa kembali form:</strong>
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.branches.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm space-y-6">
        @csrf

        <!-- SECTION: Foto Cabang Klinik -->
        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
            <div class="flex items-center gap-2 text-medical-600">
                <i data-lucide="image" class="w-5 h-5"></i>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800">Upload Foto Gedung / Ruangan Cabang</h3>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <!-- Preview Box -->
                <div class="w-32 h-24 rounded-2xl bg-white border-2 border-dashed border-slate-300 overflow-hidden flex items-center justify-center relative shrink-0 shadow-xs">
                    <template x-if="imagePreview">
                        <img :src="imagePreview" alt="Preview Cabang" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!imagePreview">
                        <div class="text-center p-2 text-slate-400">
                            <i data-lucide="building" class="w-6 h-6 mx-auto mb-1 stroke-1"></i>
                            <span class="text-[10px] block font-medium">Foto Cabang</span>
                        </div>
                    </template>
                </div>

                <!-- Upload & URL Inputs -->
                <div class="flex-1 space-y-3 w-full">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pilih File Foto (Upload)</label>
                        <input type="file" 
                               name="image_file" 
                               accept="image/*"
                               @change="handleFileSelect($event)"
                               class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-700 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1">
                        <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (Maksimal 5MB).</p>
                    </div>

                    <div class="pt-2 border-t border-slate-200/60">
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Atau Gunakan URL Gambar Eksternal</label>
                        <input type="text" name="image" x-model="imagePreview" placeholder="https://... atau /images/..."
                               class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-medical-500">
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Cabang Klinik <span class="text-rose-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: pediOcare Sleman (Pusat)"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kota / Wilayah <span class="text-rose-500">*</span></label>
                <input type="text" name="city" value="{{ old('city') }}" required placeholder="Sleman, D.I. Yogyakarta"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">No. Telepon / Hotline <span class="text-rose-500">*</span></label>
                <input type="text" name="phone_number" value="{{ old('phone_number') }}" required placeholder="0856 9792 2194"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">No. WhatsApp Konsultasi <span class="text-rose-500">*</span></label>
                <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', '6285697922194') }}" required placeholder="6285697922194"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>
        </div>

        <div class="space-y-1.5">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Alamat Lengkap <span class="text-rose-500">*</span></label>
            <textarea name="address" rows="3" required placeholder="Jl. Kaliurang KM 8.5, Sinduharjo, Ngaglik, Sleman, D.I. Yogyakarta 55581"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('address') }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Jam Operasional</label>
                <input type="text" name="opening_hours" value="{{ old('opening_hours', 'Senin - Sabtu: 08.00 - 17.00 WIB') }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Link Google Maps (Share Link)</label>
                <input type="url" name="google_maps_url" value="{{ old('google_maps_url') }}" placeholder="https://maps.app.goo.gl/..."
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>
        </div>

        <div class="space-y-1.5">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">HTML Iframe Embed Google Maps</label>
            <textarea name="google_maps_embed" rows="2" placeholder='<iframe src="https://www.google.com/maps/embed?..." width="600" height="450"...></iframe>'
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-mono text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('google_maps_embed') }}</textarea>
        </div>

        <div class="flex flex-wrap gap-6 pt-4 border-t border-slate-100 text-xs font-bold text-slate-700">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }} class="w-4 h-4 text-medical-600 rounded">
                <span>Cabang Aktif Beroperasi</span>
            </label>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_main_branch" value="1" {{ old('is_main_branch') ? 'checked' : '' }} class="w-4 h-4 text-medical-600 rounded">
                <span>Jadikan Kantor Pusat Utama</span>
            </label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('admin.branches.index') }}" class="px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs shadow-sm transition">
                Simpan Cabang
            </button>
        </div>
    </form>
</div>
@endsection
