@extends('admin.layouts.app')

@section('title', 'Tambah Produk Medis')
@section('header_title', 'Tambah Produk E-Katalog Baru')

@section('content')
<div class="max-w-4xl space-y-6" x-data="{
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

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm space-y-6">
        @csrf

        <!-- SECTION: Foto Produk -->
        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
            <div class="flex items-center gap-2 text-medical-600">
                <i data-lucide="image" class="w-5 h-5"></i>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-800">Upload Foto Utama Produk</h3>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <!-- Preview Thumbnail Box -->
                <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl bg-white border-2 border-dashed border-slate-300 overflow-hidden flex items-center justify-center relative shrink-0 shadow-xs">
                    <template x-if="imagePreview">
                        <img :src="imagePreview" alt="Preview Produk" class="w-full h-full object-contain p-2">
                    </template>
                    <template x-if="!imagePreview">
                        <div class="text-center p-3 text-slate-400">
                            <i data-lucide="image" class="w-8 h-8 mx-auto mb-1 stroke-1"></i>
                            <span class="text-[10px] block font-medium">Foto Produk</span>
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
                        <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (Maksimal 5MB). Latar transparan atau putih direkomendasikan.</p>
                    </div>

                    <div class="pt-2 border-t border-slate-200/60">
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Atau Gunakan URL Gambar Eksternal</label>
                        <input type="text" name="thumbnail" x-model="imagePreview" placeholder="https://... atau /images/..."
                               class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-medical-500">
                    </div>
                </div>
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

        <!-- Medical Indications & Materials -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Indikasi Medis (Pisahkan per baris / bullet)</label>
                <textarea name="medical_indication" rows="4" placeholder="Cedera ACL / PCL&#10;Instabilitas Sendi Lutut Berat"
                    class="wysiwyg-editor w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('medical_indication') }}</textarea>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Spesifikasi Material</label>
                <textarea name="material_spec" rows="4" placeholder="Carbon Composite & Aluminum Aircraft Grade&#10;Breathable Lining Anti-Bakteri"
                    class="wysiwyg-editor w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('material_spec') }}</textarea>
            </div>
        </div>

        <!-- Checkboxes: Active & Featured -->
        <div class="flex flex-wrap gap-6 pt-4 border-t border-slate-100 text-xs font-bold text-slate-700">
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
@endsection
