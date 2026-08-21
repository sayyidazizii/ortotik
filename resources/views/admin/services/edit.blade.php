@extends('admin.layouts.app')

@section('title', 'Edit Layanan - ' . $service->name)
@section('header_title', 'Edit Layanan Medis')

@section('content')
@php
    $currentThumb = $service->thumbnail ?? '';
    if (!empty($currentThumb)) {
        if (!str_starts_with($currentThumb, 'http') && !str_starts_with($currentThumb, '/')) {
            $currentThumbSrc = asset($currentThumb);
        } else {
            $currentThumbSrc = $currentThumb;
        }
    } else {
        $currentThumbSrc = '';
    }

    $existingSliderImages = is_array($service->gallery_images) ? $service->gallery_images : [];
@endphp

<div class="max-w-4xl space-y-6" x-data="serviceEditManager()">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-slate-500 hover:text-medical-600 inline-flex items-center gap-1.5 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali ke Daftar Layanan</span>
        </a>
        <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 inline-flex items-center gap-1.5 transition">
            <span>Lihat di Website</span>
            <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
        </a>
    </div>

    @if ($errors->any())
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs space-y-1">
        <strong class="font-bold flex items-center gap-1.5">
            <i data-lucide="alert-circle" class="w-4 h-4"></i>
            <span>Periksa kembali form:</span>
        </strong>
        <ul class="list-disc list-inside space-y-0.5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-8">
        @csrf
        @method('PUT')

        <!-- SECTION 1: FOTO UTAMA & SLIDER / GALERI -->
        <div class="space-y-6">
            <div class="border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <i data-lucide="images" class="w-4 h-4 text-medical-600"></i>
                    <span>Foto Utama & Foto Slider Layanan</span>
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Kelola foto utama (sampul) serta kumpulan foto slide untuk galeri slider di halaman website.</p>
            </div>

            <!-- FOTO UTAMA (THUMBNAIL) -->
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-medical-600">
                        <i data-lucide="image" class="w-4 h-4"></i>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">1. Foto Utama / Sampul (Thumbnail)</h4>
                    </div>
                    <span class="text-[11px] text-slate-400 font-medium">Tampil di Card & Slide Pertama</span>
                </div>

                <div class="flex flex-col sm:flex-row items-start gap-5">
                    <!-- Preview Box -->
                    <div class="w-36 h-28 rounded-2xl bg-white border-2 border-dashed border-slate-300 overflow-hidden flex items-center justify-center relative shrink-0 shadow-xs group">
                        <template x-if="thumbPreview">
                            <div class="relative w-full h-full">
                                <img :src="thumbPreview" alt="Preview Thumbnail" class="w-full h-full object-cover">
                                <button type="button" @click="clearThumbPreview()" class="absolute top-1.5 right-1.5 p-1 rounded-lg bg-black/60 text-white hover:bg-rose-600 transition shadow-sm" title="Hapus foto utama">
                                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </template>
                        <template x-if="!thumbPreview">
                            <div class="text-center p-2 text-slate-400">
                                <i data-lucide="image" class="w-7 h-7 mx-auto mb-1 stroke-1"></i>
                                <span class="text-[10px] block font-medium">Belum ada foto</span>
                            </div>
                        </template>
                    </div>

                    <!-- Upload & URL Inputs -->
                    <div class="flex-1 space-y-3 w-full">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Ganti File Foto Utama (Upload Baru)</label>
                            <input type="file" 
                                   name="image_file" 
                                   accept="image/jpeg,image/png,image/webp,image/svg+xml"
                                   @change="handleThumbFile($event)"
                                   class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-medical-50 file:text-medical-700 hover:file:bg-medical-100 cursor-pointer border border-slate-200 rounded-xl bg-white p-1.5">
                            <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (Maksimal 5MB). Kosongkan jika tidak ingin mengubah foto.</p>
                        </div>

                        <div class="pt-2 border-t border-slate-200/60 space-y-2">
                            <label class="block text-[11px] font-bold text-slate-600">Atau Ubah Link / Path Gambar</label>
                            <input type="text" name="thumbnail" x-model="thumbnailUrl" placeholder="images/client_update/image3.png atau https://..."
                                   class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-medical-500 font-mono">
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOTO SLIDER / GALERI MULTI-IMAGE -->
            <div class="p-5 rounded-2xl bg-indigo-50/50 border border-indigo-100 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div class="flex items-center gap-2 text-indigo-700">
                        <i data-lucide="sliders" class="w-4 h-4"></i>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800">2. Foto Slider / Galeri Tambahan (Multi-Foto)</h4>
                    </div>
                    <span class="text-[11px] text-indigo-600 font-medium">Bisa upload foto baru atau hapus foto slide yang ada</span>
                </div>

                <!-- DAFTAR FOTO SLIDER TERSIMPAN SAAT INI -->
                <div class="space-y-2" x-show="retainedImages.length > 0">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-700">Foto Slider Tersimpan (<span x-text="retainedImages.length"></span> Foto):</span>
                        <span class="text-[10px] text-slate-400">Klik ikon sampah merah untuk menghapus foto slide</span>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
                        <template x-for="(img, idx) in retainedImages" :key="idx">
                            <div class="relative group rounded-xl overflow-hidden border border-slate-200 bg-white aspect-4/3 shadow-xs">
                                <img :src="resolveSrc(img)" class="w-full h-full object-cover">
                                <button type="button" @click="removeRetainedImage(idx)" 
                                        class="absolute top-1.5 right-1.5 p-1.5 rounded-lg bg-black/60 text-white hover:bg-rose-600 transition shadow-sm" title="Hapus foto slide ini">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                </button>
                                <div class="absolute bottom-1 left-1 bg-black/60 text-white text-[9px] px-1.5 py-0.5 rounded font-mono" x-text="'Slide ' + (idx + 2)"></div>
                                <!-- Hidden input to retain this image -->
                                <input type="hidden" name="retained_slider_images[]" :value="img">
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Multi-File Upload Input for Adding More Slider Photos -->
                <div class="space-y-3 pt-3 border-t border-indigo-100">
                    <label class="block text-xs font-bold text-slate-700">Tambah Foto Slider Baru (Upload dari Komputer / HP)</label>
                    <input type="file" 
                           name="slider_files[]" 
                           multiple 
                           accept="image/jpeg,image/png,image/webp,image/svg+xml"
                           @change="handleNewSliderFiles($event)"
                           class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border border-indigo-200 rounded-xl bg-white p-1.5">
                    <p class="text-[11px] text-slate-400">Pilih satu atau banyak file sekaligus untuk ditambahkan ke galeri slider.</p>
                </div>

                <!-- Preview of Newly Selected Slider Files -->
                <template x-if="newSliderPreviews.length > 0">
                    <div class="space-y-2 pt-2 border-t border-indigo-100">
                        <span class="text-xs font-bold text-slate-700 block">Foto Baru yang Akan Ditambahkan (<span x-text="newSliderPreviews.length"></span> Foto):</span>
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
                            <template x-for="(preview, nIdx) in newSliderPreviews" :key="nIdx">
                                <div class="relative group rounded-xl overflow-hidden border border-emerald-300 bg-white aspect-4/3 shadow-xs ring-2 ring-emerald-400/40">
                                    <img :src="preview.src" class="w-full h-full object-cover">
                                    <button type="button" @click="removeNewSliderPreview(nIdx)" class="absolute top-1.5 right-1.5 p-1 rounded-lg bg-black/60 text-white hover:bg-rose-600 transition" title="Batal tambah foto ini">
                                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                    </button>
                                    <div class="absolute bottom-1 left-1 bg-emerald-600 text-white text-[9px] px-1.5 py-0.5 rounded font-mono">Baru</div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- SECTION 2: INFORMASI UTAMA LAYANAN -->
        <div class="space-y-6 pt-4 border-t border-slate-100">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Layanan Medis <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $service->name) }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kategori Layanan</label>
                    <select name="category_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500 bg-white">
                        <option value="">-- Tanpa Kategori (Umum) --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $service->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Icon Lucide</label>
                    <input type="text" name="icon" value="{{ old('icon', $service->icon) }}" placeholder="activity, shield, layers, heart-pulse, cpu, footprints..."
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500 font-mono">
                    <p class="text-[11px] text-slate-400">Pilihan populer: <code class="text-medical-600">activity</code>, <code class="text-medical-600">shield</code>, <code class="text-medical-600">layers</code>, <code class="text-medical-600">heart-pulse</code>, <code class="text-medical-600">cpu</code></p>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Urutan Tampil (Sort Order)</label>
                    <input type="number" name="order_position" value="{{ old('order_position', $service->order_position) }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Deskripsi Singkat (Tampil di Kartu Layanan) <span class="text-rose-500">*</span></label>
                <textarea name="short_description" rows="2" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('short_description', $service->short_description) }}</textarea>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Deskripsi Lengkap (Detail Prosedur & Manfaat) <span class="text-rose-500">*</span></label>
                <textarea name="description" rows="6" required
                    class="wysiwyg-editor w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Alur Tahapan Konsultasi (Opsional)</label>
                <textarea name="consultation_process" rows="4"
                    class="wysiwyg-editor w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('consultation_process', $service->consultation_process) }}</textarea>
            </div>

            <div class="pt-2 border-t border-slate-100 flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }} class="w-4 h-4 text-medical-600 rounded">
                <span class="text-xs font-bold text-slate-700">Tampilkan layanan di website (Aktif)</span>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('admin.services.index') }}" class="px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs shadow-sm hover:shadow transition">
                <i data-lucide="check" class="w-4 h-4"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </form>
</div>

<script>
    function serviceEditManager() {
        return {
            thumbPreview: '{{ $currentThumbSrc }}',
            thumbnailUrl: '{{ old('thumbnail', $service->thumbnail ?? '') }}',
            retainedImages: @json($existingSliderImages),
            newSliderPreviews: [],

            resolveSrc(img) {
                if (!img) return '';
                if (img.startsWith('http://') || img.startsWith('https://')) return img;
                return '{{ asset('') }}' + img.replace(/^\/+/, '');
            },

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
            },

            removeRetainedImage(idx) {
                this.retainedImages.splice(idx, 1);
            },

            addSliderPreset(path) {
                if (!this.retainedImages.includes(path)) {
                    this.retainedImages.push(path);
                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                    });
                }
            },

            handleNewSliderFiles(e) {
                const files = e.target.files;
                if (!files || files.length === 0) return;

                Array.from(files).forEach((file) => {
                    const reader = new FileReader();
                    reader.onload = (ev) => {
                        this.newSliderPreviews.push({
                            src: ev.target.result,
                            name: file.name
                        });
                        this.$nextTick(() => {
                            if (window.lucide) window.lucide.createIcons();
                        });
                    };
                    reader.readAsDataURL(file);
                });
            },

            removeNewSliderPreview(idx) {
                this.newSliderPreviews.splice(idx, 1);
            }
        }
    }
</script>
@endsection
