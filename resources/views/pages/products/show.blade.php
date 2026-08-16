@extends('layouts.app')

@section('title', $product->name . ' - E-Katalog Klinik Ortotik')
@section('meta_description', strip_tags($product->excerpt ?? $product->description))

@section('content')

<!-- Breadcrumbs -->
<div class="bg-sky-50/50 py-3.5 border-b border-sky-100 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-2 text-slate-500">
        <a href="{{ route('home') }}" class="hover:text-medical-600">Beranda</a>
        <span>/</span>
        <a href="{{ route('products.index') }}" class="hover:text-medical-600">E-Katalog</a>
        <span>/</span>
        <span class="text-slate-800 font-bold">{{ $product->name }}</span>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Image Gallery (Left) -->
        <div class="lg:col-span-6 space-y-4" x-data="{ mainImage: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=800&q=80' }">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-4 shadow-card overflow-hidden h-[420px] flex items-center justify-center">
                <img :src="mainImage" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain rounded-2xl">
            </div>
            
            <div class="flex items-center gap-3">
                <button @click="mainImage = 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=800&q=80'" class="w-20 h-20 rounded-xl border-2 border-medical-600 p-1 bg-white overflow-hidden shadow-xs">
                    <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=200&q=80" class="w-full h-full object-cover rounded-lg">
                </button>
                <button @click="mainImage = 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=800&q=80'" class="w-20 h-20 rounded-xl border border-slate-200 hover:border-medical-600 p-1 bg-white overflow-hidden shadow-xs transition">
                    <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=200&q=80" class="w-full h-full object-cover rounded-lg">
                </button>
            </div>
        </div>

        <!-- Product Information (Right) -->
        <div class="lg:col-span-6 space-y-6">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-sky-50 text-sky-800 text-xs font-extrabold px-3 py-1 rounded-full uppercase tracking-wider border border-sky-100">{{ $product->category->name ?? 'Medis' }}</span>
                    <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1 border border-emerald-200">
                        <i data-lucide="check-circle" class="w-3.5 h-3.5"></i>
                        <span>Ready Stock / Medis Terdaftar</span>
                    </span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 leading-tight">{{ $product->name }}</h1>
                @if($product->sku)
                <p class="text-xs text-slate-400 mt-1">SKU Produk: <span class="font-mono font-bold text-slate-600">{{ $product->sku }}</span></p>
                @endif
            </div>

            <!-- Price Card -->
            <div class="p-6 rounded-2xl bg-sky-50/50 border border-sky-100 flex items-baseline gap-4">
                <span class="text-3xl font-black text-slate-900">{{ $product->formatted_price }}</span>
                @if($product->formatted_discount_price)
                <span class="text-base text-slate-400 line-through">{{ $product->formatted_discount_price }}</span>
                <span class="text-xs font-bold text-red-600 bg-red-50 px-2.5 py-1 rounded-md border border-red-100">Promo</span>
                @endif
            </div>

            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">{{ $product->excerpt }}</p>

            <!-- Call to Action Buttons -->
            <div class="space-y-3 pt-2">
                <a href="{{ $waUrl }}" target="_blank"
                    class="w-full inline-flex justify-center items-center gap-2.5 py-4 px-6 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white text-sm font-extrabold shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                    <span>Order / Konsultasi Ukuran via WhatsApp</span>
                </a>
                <a href="{{ route('consultation.create') }}?medical_service_id={{ $product->medical_service_id }}"
                    class="w-full inline-flex justify-center items-center gap-2 py-3.5 px-6 rounded-xl bg-medical-600 hover:bg-medical-700 text-white text-xs font-bold shadow-xs transition">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <span>Jadwalkan Fitting di Klinik</span>
                </a>
            </div>

            <!-- Benefits Guarantee -->
            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-200 text-xs text-slate-600">
                <div class="flex items-center gap-2">
                    <i data-lucide="truck" class="w-4 h-4 text-medical-600"></i>
                    <span>Pengiriman Aman Seluruh Indonesia</span>
                </div>
                <div class="flex items-center gap-2">
                    <i data-lucide="shield-check" class="w-4 h-4 text-medical-600"></i>
                    <span>100% Original Standar Medis</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Tab Details -->
    <div class="mt-16 bg-white rounded-3xl border border-slate-200/80 p-8 shadow-card" x-data="{ tab: 'desc' }">
        <div class="flex border-b border-slate-200 gap-8 mb-6">
            <button @click="tab = 'desc'" :class="tab === 'desc' ? 'border-b-2 border-medical-600 text-medical-600 font-extrabold' : 'text-slate-500 font-semibold'" class="pb-3 text-xs uppercase tracking-wider transition">Deskripsi Lengkap</button>
            <button @click="tab = 'indications'" :class="tab === 'indications' ? 'border-b-2 border-medical-600 text-medical-600 font-extrabold' : 'text-slate-500 font-semibold'" class="pb-3 text-xs uppercase tracking-wider transition">Indikasi Medis</button>
            <button @click="tab = 'specs'" :class="tab === 'specs' ? 'border-b-2 border-medical-600 text-medical-600 font-extrabold' : 'text-slate-500 font-semibold'" class="pb-3 text-xs uppercase tracking-wider transition">Spesifikasi & Material</button>
        </div>

        <div x-show="tab === 'desc'" class="prose prose-slate max-w-none text-xs leading-relaxed text-slate-600">
            {!! $product->description !!}
        </div>

        <div x-show="tab === 'indications'" x-cloak class="text-xs text-slate-600 space-y-3">
            <h4 class="font-bold text-slate-900">Alat ini direkomendasikan dokter untuk penanganan:</h4>
            <p class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-xl text-amber-900 font-medium leading-relaxed">
                {{ $product->medical_indications ?? 'Indikasi cedera sendi, immobilisasi ortopedi, atau pasca operasi bedah tulang.' }}
            </p>
        </div>

        <div x-show="tab === 'specs'" x-cloak class="text-xs text-slate-600">
            @if($product->specifications && is_array($product->specifications))
            <div class="divide-y divide-slate-100 border border-slate-200 rounded-xl overflow-hidden">
                @foreach($product->specifications as $key => $val)
                <div class="grid grid-cols-3 p-3 text-xs">
                    <span class="font-bold text-slate-700">{{ $key }}</span>
                    <span class="col-span-2 text-slate-600">{{ $val }}</span>
                </div>
                @endforeach
            </div>
            @else
            <p>Material medis berkualifikasi internasional, non-alergenik, ringan, dan dapat disesuaikan (adjustable).</p>
            @endif
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->isNotEmpty())
    <div class="mt-16">
        <h3 class="text-xl font-black text-slate-900 mb-6">Produk Terkait Lainnya</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $rel)
            <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-card hover:shadow-card-hover hover:border-sky-300 transition flex flex-col justify-between">
                <div>
                    <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=400&q=80" alt="{{ $rel->name }}" class="w-full h-36 object-cover rounded-xl mb-3">
                    <h4 class="font-bold text-xs text-slate-900 line-clamp-2">{{ $rel->name }}</h4>
                    <span class="text-sm font-black text-slate-900 block mt-2">{{ $rel->formatted_price }}</span>
                </div>
                <a href="{{ route('products.show', $rel->slug) }}" class="mt-3 block text-center py-2 rounded-xl bg-sky-50 hover:bg-medical-600 hover:text-white text-medical-700 text-xs font-bold transition">Lihat Detail</a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection
