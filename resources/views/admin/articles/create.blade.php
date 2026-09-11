@extends('admin.layouts.app')

@section('title', 'Tulis Artikel Edukasi')
@section('header_title', 'Tulis Artikel Edukasi Medis Baru')

@section('content')
<div class="max-w-4xl space-y-6" x-data="{
    thumbnailUrl: '{{ old('thumbnail') ?? '' }}',
    filePreview: '',
    get displayPreview() {
        return this.filePreview || this.thumbnailUrl;
    },
    handleFileSelect(e) {
        const file = e.target.files[0];
        if (!file) {
            this.filePreview = '';
            return;
        }

        if (file.size > 10 * 1024 * 1024) {
            alert('Ukuran foto terlalu besar (maksimal 10MB). Silakan pilih foto dengan resolusi atau ukuran lebih kecil.');
            e.target.value = '';
            this.filePreview = '';
            return;
        }

        // Kompres otomatis jika file > 1MB agar upload cepat dan tidak memicu 413
        if (file.size > 1024 * 1024 && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (ev) => {
                const img = new Image();
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    let w = img.width;
                    let h = img.height;
                    const maxDim = 1920;
                    if (w > maxDim || h > maxDim) {
                        if (w > h) {
                            h = Math.round((h * maxDim) / w);
                            w = maxDim;
                        } else {
                            w = Math.round((w * maxDim) / h);
                            h = maxDim;
                        }
                    }
                    canvas.width = w;
                    canvas.height = h;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, w, h);
                    canvas.toBlob((blob) => {
                        if (blob && blob.size < file.size) {
                            try {
                                const newFile = new File([blob], file.name.replace(/\.[^.]+$/, '.webp'), {
                                    type: 'image/webp',
                                    lastModified: Date.now()
                                });
                                const dt = new DataTransfer();
                                dt.items.add(newFile);
                                e.target.files = dt.files;
                            } catch(err) {}
                            this.filePreview = canvas.toDataURL('image/webp', 0.85);
                        } else {
                            this.filePreview = ev.target.result;
                        }
                    }, 'image/webp', 0.85);
                };
                img.src = ev.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            const reader = new FileReader();
            reader.onload = (ev) => {
                this.filePreview = ev.target.result;
            };
            reader.readAsDataURL(file);
        }

        // Kosongkan URL agar tidak dobel/konflik
        this.thumbnailUrl = '';
    },
    clearFile() {
        this.filePreview = '';
        const input = document.getElementById('image_file_input');
        if (input) input.value = '';
    }
}">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-slate-500 hover:text-medical-600 inline-flex items-center gap-1.5 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali ke Daftar Artikel</span>
        </a>
    </div>

    @if ($errors->any())
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs space-y-1">
        <strong>Mohon lengkapi formulir:</strong>
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm space-y-6">
        @csrf

        <!-- SECTION: Foto Utama Artikel -->
        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
            <div class="flex items-center gap-2 text-medical-600">
                <i data-lucide="image" class="w-5 h-5"></i>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800">Upload Foto Utama / Sampul Artikel</h3>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <!-- Preview Thumbnail Box -->
                <div class="w-36 h-24 sm:w-44 sm:h-28 rounded-2xl bg-white border-2 border-dashed border-slate-300 overflow-hidden flex items-center justify-center relative shrink-0 shadow-xs">
                    <template x-if="displayPreview">
                        <img :src="displayPreview" alt="Preview Sampul" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!displayPreview">
                        <div class="text-center p-3 text-slate-400">
                            <i data-lucide="image" class="w-7 h-7 mx-auto mb-1 stroke-1"></i>
                            <span class="text-[10px] block font-medium">Foto Sampul</span>
                        </div>
                    </template>
                </div>

                <!-- Upload & URL Inputs -->
                <div class="flex-1 space-y-3 w-full">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs font-bold text-slate-700">Pilih File Foto Sampul (Upload)</label>
                            <button type="button" x-show="filePreview" @click="clearFile()" class="text-[11px] text-rose-500 hover:underline font-semibold">
                                Batalkan Pilihan File
                            </button>
                        </div>
                        <input type="file" 
                               id="image_file_input"
                               name="image_file" 
                               accept="image/*"
                               @change="handleFileSelect($event)"
                               class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-700 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1">
                        <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (Maks. 10MB). Foto berukuran besar akan dioptimasi otomatis.</p>
                    </div>

                    <div class="pt-2 border-t border-slate-200/60">
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Atau Gunakan URL Gambar Eksternal</label>
                        <input type="text" name="thumbnail" x-model="thumbnailUrl" @input="clearFile()" placeholder="https://images.unsplash.com/... atau /images/..."
                               class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-medical-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- Title -->
        <div class="space-y-1.5">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Judul Artikel Edukasi <span class="text-rose-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Panduan Lengkap Perawatan Kaki Palsu Pasca Amputasi Bawah Lutut"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Category -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kategori Artikel</label>
                <select name="category_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Read time -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Estimasi Waktu Baca (Menit)</label>
                <input type="number" name="read_time" value="{{ old('read_time', 5) }}" placeholder="5"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>
        </div>

        <!-- Summary -->
        <div class="space-y-1.5">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Ringkasan Artikel (Meta Summary) <span class="text-rose-500">*</span></label>
            <textarea name="summary" rows="2" required placeholder="Ringkasan 2-3 kalimat untuk cuplikan blog dan SEO meta description..."
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('summary') }}</textarea>
        </div>

        <!-- Content -->
        <div class="space-y-1.5">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Isi Konten Artikel <span class="text-rose-500">*</span></label>
            <textarea name="content" rows="12" required placeholder="Tuliskan penjelasan edukasi medis secara komprehensif..."
                class="wysiwyg-editor w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('content') }}</textarea>
        </div>

        <!-- Checkboxes -->
        <div class="flex flex-wrap gap-6 pt-4 border-t border-slate-100 text-xs font-bold text-slate-700">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', '1') ? 'checked' : '' }} class="w-4 h-4 text-medical-600 rounded">
                <span>Publikasikan Sekarang</span>
            </label>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 text-medical-600 rounded">
                <span>Jadikan Artikel Utama di Bagian Terpopuler</span>
            </label>
        </div>

        <!-- Submit -->
        <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('admin.articles.index') }}" class="px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs shadow-sm transition">
                Terbitkan Artikel
            </button>
        </div>
    </form>
</div>
@endsection
