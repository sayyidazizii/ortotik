@extends('admin.layouts.app')

@section('title', 'Tambah Produk Medis')
@section('header_title', 'Tambah Produk E-Katalog Baru')

@section('content')
<div class="max-w-4xl space-y-6" x-data="productFormManager()">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-slate-500 hover:text-medical-600 inline-flex items-center gap-1.5 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali ke Katalog</span>
        </a>
    </div>

    @if ($errors->any())
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs space-y-1">
        <strong>Mohon lengkapi data berikut:</strong>
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm space-y-8">
        @csrf

        <!-- SECTION: Foto Utama & Galeri Produk Multi-Image -->
        <div class="space-y-6">
            <div class="border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <i data-lucide="images" class="w-4 h-4 text-medical-600"></i>
                    <span>Foto Utama & Galeri Foto Produk (Bisa Lebih Dari Satu)</span>
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Upload foto utama (sampul) serta kumpulan foto galeri untuk detail produk di halaman website e-katalog.</p>
            </div>

            <!-- FOTO UTAMA (THUMBNAIL) -->
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-medical-600">
                        <i data-lucide="image" class="w-4 h-4"></i>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">1. Foto Utama / Sampul (Thumbnail)</h4>
                    </div>
                    <span class="text-[11px] text-slate-400 font-medium">Tampil di Katalog & Foto Slide Pertama</span>
                </div>

                <div class="flex flex-col sm:flex-row items-start gap-5">
                    <!-- Preview Thumbnail Box -->
                    <div class="w-32 h-28 rounded-2xl bg-white border-2 border-dashed border-slate-300 overflow-hidden flex items-center justify-center relative shrink-0 shadow-xs group">
                        <template x-if="thumbPreview">
                            <div class="relative w-full h-full p-2 flex items-center justify-center">
                                <img :src="thumbPreview" alt="Preview Produk" class="w-full h-full object-contain">
                                <button type="button" @click="clearThumbPreview()" class="absolute top-1.5 right-1.5 p-1 rounded-lg bg-black/60 text-white hover:bg-rose-600 transition shadow-sm" title="Hapus foto utama">
                                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </template>
                        <template x-if="!thumbPreview">
                            <div class="text-center p-3 text-slate-400">
                                <i data-lucide="image" class="w-8 h-8 mx-auto mb-1 stroke-1"></i>
                                <span class="text-[10px] block font-medium">Foto Sampul</span>
                            </div>
                        </template>
                    </div>

                    <!-- Upload & URL Inputs -->
                    <div class="flex-1 space-y-3 w-full">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Pilih File Foto Utama (Upload)</label>
                            <input type="file" 
                                   name="image_file" 
                                   accept="image/jpeg,image/png,image/webp,image/svg+xml"
                                   @change="handleThumbFile($event)"
                                   class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-700 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1.5">
                            <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (Maksimal 5MB). Latar transparan atau putih direkomendasikan.</p>
                        </div>

                        <div class="pt-2 border-t border-slate-200/60 space-y-2">
                            <label class="block text-[11px] font-bold text-slate-600">Atau Gunakan Link / Path Gambar</label>
                            <input type="text" name="thumbnail" x-model="thumbnailUrl" placeholder="images/client_update/image7.png atau https://..."
                                   class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-medical-500 font-mono">
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOTO GALERI TAMBAHAN (MULTI-IMAGE) -->
            <div class="p-5 rounded-2xl bg-indigo-50/50 border border-indigo-100 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div class="flex items-center gap-2 text-indigo-700">
                        <i data-lucide="sliders" class="w-4 h-4"></i>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">2. Foto Galeri Tambahan (Bisa Pilih Banyak Foto Sekaligus)</h4>
                    </div>
                    <span class="text-[11px] text-indigo-600 font-medium">Bisa upload beberapa sudut foto produk</span>
                </div>

                <!-- Multi-File Upload Input -->
                <div class="space-y-3">
                    <label class="block text-xs font-bold text-slate-700">Upload Foto-Foto Galeri Tambahan</label>
                    <input type="file" 
                           name="gallery_files[]" 
                           multiple 
                           accept="image/jpeg,image/png,image/webp,image/svg+xml"
                           @change="handleGalleryFiles($event)"
                           class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border border-indigo-200 rounded-xl bg-white p-1.5">
                    <p class="text-[11px] text-slate-400">Pilih beberapa foto sekaligus dengan menahan tombol <kbd class="px-1.5 py-0.5 bg-slate-200 rounded text-[10px] font-mono">Ctrl</kbd> atau <kbd class="px-1.5 py-0.5 bg-slate-200 rounded text-[10px] font-mono">Shift</kbd>.</p>
                </div>

                <!-- Preview of Selected Gallery Files -->
                <template x-if="galleryPreviews.length > 0">
                    <div class="space-y-2 pt-2 border-t border-indigo-100">
                        <span class="text-xs font-bold text-slate-700 block">Preview Foto Galeri yang Dipilih (<span x-text="galleryPreviews.length"></span> Foto):</span>
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
                            <template x-for="(preview, idx) in galleryPreviews" :key="idx">
                                <div class="relative group rounded-xl overflow-hidden border border-slate-200 bg-white aspect-square shadow-xs p-2 flex items-center justify-center">
                                    <img :src="preview.src" class="w-full h-full object-contain">
                                    <button type="button" @click="removeGalleryPreview(idx)" class="absolute top-1 right-1 p-1 rounded-md bg-black/60 text-white hover:bg-rose-600 transition" title="Hapus foto ini">
                                        <i data-lucide="trash-2" class="w-3 h-3"></i>
                                    </button>
                                    <div class="absolute bottom-1 left-1 bg-black/60 text-white text-[9px] px-1.5 py-0.5 rounded font-mono" x-text="'Foto ' + (idx + 2)"></div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Name -->
            <div class="sm:col-span-2 space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Produk Medis <span class="text-rose-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Advanced Articulating Knee Orthosis"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <!-- Category -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kategori Bagian Tubuh <span class="text-rose-500">*</span></label>
                <select name="category_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                    <option value="">-- Pilih Kategori Anatomi --</option>
                    @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- SKU -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">SKU / Kode Produk</label>
                <input type="text" name="sku" value="{{ old('sku') }}" placeholder="Contoh: PDC-AKO-01"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <!-- Price -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Estimasi Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price') }}" placeholder="Contoh: 4500000"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <!-- Discount Price -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Harga Diskon (Opsional)</label>
                <input type="number" name="discount_price" value="{{ old('discount_price') }}" placeholder="Kosongkan jika tidak diskon"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <!-- Stock Status -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Status Ketersediaan <span class="text-rose-500">*</span></label>
                <select name="stock_status" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                    <option value="ready_stock" {{ old('stock_status') === 'ready_stock' ? 'selected' : '' }}>Ready Stock</option>
                    <option value="pre_order" {{ old('stock_status') === 'pre_order' ? 'selected' : '' }}>Pre Order</option>
                    <option value="custom_only" {{ old('stock_status') === 'custom_only' ? 'selected' : '' }}>Custom Made Only</option>
                </select>
            </div>

            <!-- Warranty -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Masa Garansi</label>
                <input type="text" name="warranty_period" value="{{ old('warranty_period', '1 Tahun Garansi Fitting & Frame') }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>
        </div>

        <!-- Short Description / Excerpt -->
        <div class="space-y-1.5">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Deskripsi Singkat <span class="text-rose-500">*</span></label>
            <textarea name="short_description" rows="2" required placeholder="Ringkasan 1-2 kalimat untuk kartu produk e-katalog..."
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('short_description') }}</textarea>
        </div>

        <!-- Full Description -->
        <div class="space-y-1.5">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Deskripsi Lengkap & Cara Kerja <span class="text-rose-500">*</span></label>
            <textarea name="description" rows="5" required placeholder="Detail teknis produk, material, dan manfaat klinis..."
                class="wysiwyg-editor w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('description') }}</textarea>
        </div>

        <!-- SECTION: Detail Klinis, Spesifikasi & Panduan Ukuran -->
        <div class="mt-8 p-6 rounded-2xl bg-slate-50/80 border border-slate-200 space-y-6">
            <div class="border-b border-slate-200 pb-3.5">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800 flex items-center gap-2">
                    <i data-lucide="file-text" class="w-4 h-4 text-medical-600"></i>
                    <span>Informasi Medis, Spesifikasi & Panduan Ukuran (Tab Front-End)</span>
                </h4>
                <p class="text-[11px] text-slate-500 mt-1">Ketiga input di bawah ini akan menjadi tab navigasi pada halaman detail produk di website publik.</p>
            </div>

            <!-- Row 1: Indikasi Medis & Spesifikasi Material -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                <!-- Medical Indications -->
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Indikasi Medis Klinis (Tab 2)
                    </label>
                    <div class="mt-1.5">
                        <textarea name="medical_indication" rows="4" placeholder="Cedera ACL / PCL&#10;Instabilitas Sendi Lutut Berat&#10;Pasca Operasi Rekonstruksi"
                            class="wysiwyg-editor w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500 bg-white">{{ old('medical_indication') }}</textarea>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1">Daftar diagnosis medis atau keluhan klinis yang dianjurkan memakai alat ini.</p>
                </div>

                <!-- Material Specifications -->
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Spesifikasi Material & Rangka (Tab 3)
                    </label>
                    <div class="mt-1.5">
                        <textarea name="material_spec" rows="4" placeholder="Carbon Composite & Aluminium Aircraft Grade&#10;Busa Antimikroba Breathable&#10;Engsel Polycentric Adjustable"
                            class="wysiwyg-editor w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500 bg-white">{{ old('material_spec') }}</textarea>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1">Rincian teknis bahan, rangka, pelapis busa, dan sistem engsel alat.</p>
                </div>
            </div>

            <!-- Row 2: Size Chart / Sizing Guide -->
            <div class="space-y-2 pt-6 border-t border-slate-200">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Panduan Ukuran / Sizing Chart (Tab 4 - Opsional)
                    </label>
                    <span class="text-[10px] text-slate-400 font-medium">Kosongkan jika produk custom-made / tanpa ukuran</span>
                </div>
                <div class="mt-1.5">
                    <textarea name="size_chart" rows="3" placeholder="S: Lingkar lutut 30 - 35 cm&#10;M: Lingkar lutut 35 - 40 cm&#10;L: Lingkar lutut 40 - 45 cm&#10;XL: Lingkar lutut 45 - 50 cm"
                        class="wysiwyg-editor w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500 bg-white">{{ old('size_chart') }}</textarea>
                </div>
                <p class="text-[10px] text-slate-400 mt-1">Panduan pengukuran lingkar tubuh agar pasien dapat memilih ukuran yang pas.</p>
            </div>
        </div>

        <!-- Checkboxes: Active & Featured -->
        <div class="mt-8 flex flex-wrap gap-6 pt-6 border-t border-slate-200 text-xs font-bold text-slate-700">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }} class="w-4 h-4 text-medical-600 rounded">
                <span>Tampilkan di Katalog Publik (Aktif)</span>
            </label>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 text-medical-600 rounded">
                <span>Jadikan Produk Unggulan di Beranda</span>
            </label>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_custom_order" value="1" {{ old('is_custom_order') ? 'checked' : '' }} class="w-4 h-4 text-medical-600 rounded">
                <span>Perlu Penyesuaian Ukuran / Casting</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs shadow-sm transition">
                Simpan Produk
            </button>
        </div>
    </form>
</div>

<script>
function productFormManager() {
    return {
        thumbPreview: '{{ old('thumbnail') ? (str_starts_with(old('thumbnail'), 'http') ? old('thumbnail') : asset(ltrim(old('thumbnail'), '/'))) : '' }}',
        thumbnailUrl: '{{ old('thumbnail', '') }}',
        galleryPreviews: [],
        selectedPresetUrls: [],

        handleThumbFile(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    this.thumbPreview = ev.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        clearThumbPreview() {
            this.thumbPreview = '';
            this.thumbnailUrl = '';
            const input = document.querySelector('input[name="image_file"]');
            if (input) input.value = '';
        },

        setThumbPreset(path, fullUrl) {
            this.thumbnailUrl = path;
            this.thumbPreview = fullUrl;
            const input = document.querySelector('input[name="image_file"]');
            if (input) input.value = '';
        },

        handleGalleryFiles(e) {
            const files = Array.from(e.target.files || []);
            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    this.galleryPreviews.push({
                        src: ev.target.result,
                        name: file.name
                    });
                };
                reader.readAsDataURL(file);
            });
        },

        removeGalleryPreview(idx) {
            this.galleryPreviews.splice(idx, 1);
        },

        addGalleryPreset(path, fullUrl) {
            if (!this.selectedPresetUrls.includes(path)) {
                this.selectedPresetUrls.push(path);
                this.galleryPreviews.push({
                    src: fullUrl,
                    name: path
                });
            }
        }
    };
}
</script>
@endsection
