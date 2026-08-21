@extends('admin.layouts.app')

@section('title', 'Manajemen Layanan Medis')
@section('header_title', 'Kelola 5 Pilar Layanan Medis')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-lg font-black text-slate-900">Daftar Layanan Medis Klinik</h2>
            <p class="text-xs text-slate-500">Kelola informasi layanan ortotik, prostetik, home visit, casting, dan konsultasi.</p>
        </div>

        <a href="{{ route('admin.services.create') }}"
            class="w-full sm:w-auto justify-center px-4 py-2.5 bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs rounded-xl shadow-sm inline-flex items-center gap-2 transition">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Tambah Layanan Baru</span>
        </a>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $s)
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm flex flex-col justify-between hover:shadow-md transition group">
            <div>
                <!-- Card Image Header -->
                <div class="relative h-40 w-full bg-slate-100 overflow-hidden">
                    <img src="{{ $s->thumbnail_url }}" alt="{{ $s->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>

                    <div class="absolute top-3 left-3 flex items-center gap-2">
                        <div class="w-9 h-9 rounded-xl bg-white/90 backdrop-blur-sm shadow-sm flex items-center justify-center text-medical-700">
                            <i data-lucide="{{ $s->icon ?? 'activity' }}" class="w-4 h-4"></i>
                        </div>
                        @if($s->category)
                        <span class="px-2 py-0.5 rounded-lg bg-black/50 backdrop-blur-sm text-white font-bold text-[10px]">{{ $s->category->name }}</span>
                        @endif
                    </div>

                    <div class="absolute top-3 right-3">
                        @if($s->is_active)
                            <span class="px-2.5 py-1 rounded-full bg-emerald-500 text-white font-bold text-[10px] uppercase shadow-sm">Aktif</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full bg-slate-700 text-slate-200 font-bold text-[10px] uppercase shadow-sm">Non-Aktif</span>
                        @endif
                    </div>

                    <!-- Slider Count Badge -->
                    <div class="absolute bottom-2.5 right-3 bg-black/60 backdrop-blur-sm text-white text-[10px] px-2 py-0.5 rounded-full font-mono flex items-center gap-1">
                        <i data-lucide="images" class="w-3 h-3"></i>
                        <span>{{ count($s->slider_images) }} Foto Slider</span>
                    </div>
                </div>

                <div class="p-5 space-y-2">
                    <h3 class="text-base font-extrabold text-slate-900 line-clamp-1 group-hover:text-medical-600 transition-colors">
                        <a href="{{ route('admin.services.edit', $s->id) }}">{{ $s->title }}</a>
                    </h3>
                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">{{ $s->summary }}</p>
                </div>
            </div>

            <div class="p-5 pt-0 flex items-center justify-between border-t border-slate-100 mt-auto">
                <span class="text-[11px] font-mono text-slate-400">Urutan: #{{ $s->order_position }}</span>
                <div class="flex items-center gap-1.5 pt-3">
                    <a href="{{ route('services.show', $s->slug) }}" target="_blank" class="p-2 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-500 hover:text-indigo-600 transition" title="Lihat di Web">
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                    </a>
                    <a href="{{ route('admin.services.edit', $s->id) }}" class="p-2 rounded-xl bg-medical-50 hover:bg-medical-100 text-medical-700 transition" title="Edit Layanan">
                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                    </a>
                    <form action="{{ route('admin.services.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus layanan {{ $s->name }}?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus Layanan">
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
