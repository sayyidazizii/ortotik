@extends('admin.layouts.app')

@section('title', 'Tambah Layanan Medis')
@section('header_title', 'Tambah Layanan Medis Baru')

@section('content')
<div class="max-w-3xl space-y-6" x-data="{
    imagePreview: '{{ old('thumbnail') ?? '' }}',
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
        <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-slate-500 hover:text-medical-600 inline-flex items-center gap-1.5 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali ke Daftar Layanan</span>
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

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm space-y-6">
        @csrf

        <!-- SECTION: Foto Banner / Sampul Layanan -->
        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
            <div class="flex items-center gap-2 text-medical-600">
                <i data-lucide="image" class="w-5 h-5"></i>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800">Upload Foto Layanan Medis</h3>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <!-- Preview Box -->
                <div class="w-32 h-24 rounded-2xl bg-white border-2 border-dashed border-slate-300 overflow-hidden flex items-center justify-center relative shrink-0 shadow-xs">
                    <template x-if="imagePreview">
                        <img :src="imagePreview" alt="Preview Layanan" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!imagePreview">
                        <div class="text-center p-2 text-slate-400">
                            <i data-lucide="image" class="w-6 h-6 mx-auto mb-1 stroke-1"></i>
                            <span class="text-[10px] block font-medium">Foto Layanan</span>
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
                        <input type="text" name="thumbnail" x-model="imagePreview" placeholder="https://... atau /images/..."
                               class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-medical-500">
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-1.5">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Layanan Medis <span class="text-rose-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Pembuatan Kaki Palsu (Prostesis Bawah Lutut)"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Icon Lucide</label>
                <input type="text" name="icon" value="{{ old('icon', 'activity') }}" placeholder="activity, foot, user-check, home..."
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Urutan Tampil (Sort Order)</label>
                <input type="number" name="order_position" value="{{ old('order_position', 0) }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>
        </div>

        <div class="space-y-1.5">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Deskripsi Singkat (Kartu) <span class="text-rose-500">*</span></label>
            <textarea name="short_description" rows="2" required placeholder="Ringkasan 1-2 kalimat..."
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('short_description') }}</textarea>
        </div>

        <div class="space-y-1.5">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Deskripsi Lengkap <span class="text-rose-500">*</span></label>
            <textarea name="description" rows="5" required placeholder="Penjelasan lengkap tentang prosedur dan manfaat layanan..."
                class="wysiwyg-editor w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('description') }}</textarea>
        </div>

        <div class="space-y-1.5">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Alur Tahapan Konsultasi (Pisahkan Baris / List)</label>
            <textarea name="consultation_process" rows="4" placeholder="1. Pemeriksaan fisik & alignment&#10;2. Pengambilan cetakan gips / 3D scan&#10;3. Fitting dan penyesuaian gait"
                class="wysiwyg-editor w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('consultation_process') }}</textarea>
        </div>

        <div class="pt-2 border-t border-slate-100 flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }} class="w-4 h-4 text-medical-600 rounded">
            <span class="text-xs font-bold text-slate-700">Tampilkan layanan di website (Aktif)</span>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('admin.services.index') }}" class="px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs shadow-sm transition">
                Simpan Layanan
            </button>
        </div>
    </form>
</div>
@endsection
