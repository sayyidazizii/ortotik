@extends('admin.layouts.app')

@section('title', 'Manajemen Testimoni Pasien')
@section('header_title', 'Testimoni Pasien')

@section('content')
<div class="space-y-6">

    <!-- Top Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900">Ulasan & Testimoni Pasien</h2>
            <p class="text-xs text-slate-500 mt-0.5">Kelola testimoni dan ulasan pasien yang tampil di bagian "Apa Kata Pasien Kami" pada halaman Beranda website.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}#testimoni" target="_blank" class="px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-100 text-slate-700 text-xs font-bold transition flex items-center gap-1.5">
                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                <span>Lihat di Beranda</span>
            </a>
            <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-medical-600 hover:bg-medical-700 text-white text-xs font-bold transition shadow-sm">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Tambah Testimoni Baru</span>
            </a>
        </div>
    </div>

    <!-- 3 Stat Widgets -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Testimoni</span>
                <h3 class="text-2xl font-black text-slate-900 mt-1">{{ $totalTestimonials }}</h3>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-medical-50 text-medical-600 flex items-center justify-center">
                <i data-lucide="message-square-quote" class="w-5 h-5"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Aktif Tampil di Web</span>
                <h3 class="text-2xl font-black text-emerald-600 mt-1">{{ $activeTestimonials }}</h3>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Unggulan Beranda (Featured)</span>
                <h3 class="text-2xl font-black text-amber-500 mt-1">{{ $featuredTestimonials }}</h3>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <i data-lucide="star" class="w-5 h-5"></i>
            </div>
        </div>
    </div>

    <!-- Filter & Content Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        <!-- Filter Header -->
        <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <form action="{{ route('admin.testimonials.index') }}" method="GET" class="w-full sm:w-80 relative">
                @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama atau ulasan..."
                       class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-medical-500 focus:bg-white transition">
            </form>

            <div class="flex items-center gap-1.5 self-stretch sm:self-auto overflow-x-auto no-scrollbar">
                <a href="{{ route('admin.testimonials.index', array_filter(['search' => $search])) }}"
                   class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ !$status ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Semua ({{ $totalTestimonials }})
                </a>
                <a href="{{ route('admin.testimonials.index', array_filter(['status' => 'featured', 'search' => $search])) }}"
                   class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ $status === 'featured' ? 'bg-amber-500 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Unggulan ({{ $featuredTestimonials }})
                </a>
                <a href="{{ route('admin.testimonials.index', array_filter(['status' => 'active', 'search' => $search])) }}"
                   class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ $status === 'active' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Aktif ({{ $activeTestimonials }})
                </a>
            </div>
        </div>

        <!-- Cards / Table of Testimonials -->
        @if($testimonials->isEmpty())
        <div class="p-12 text-center text-slate-400 text-xs">
            <i data-lucide="message-square" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
            <span>Belum ada testimoni pasien yang ditemukan.</span>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 p-5">
            @foreach($testimonials as $item)
            <div class="bg-white rounded-2xl border p-5 flex flex-col justify-between shadow-xs transition-all duration-200 {{ $item->is_active ? 'border-slate-200 hover:border-medical-300' : 'border-slate-200/60 bg-slate-50/50 opacity-75' }}">
                <div class="space-y-3">
                    
                    <!-- Top Status & Stars -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-0.5 text-amber-400">
                            @for($s = 1; $s <= 5; $s++)
                                <i data-lucide="star" class="w-4 h-4 {{ $s <= $item->rating ? 'fill-amber-400 text-amber-400' : 'text-slate-200' }}"></i>
                            @endfor
                        </div>
                        <div class="flex items-center gap-1.5">
                            @if($item->is_featured)
                            <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 text-[10px] font-bold uppercase border border-amber-200">
                                Unggulan
                            </span>
                            @endif
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border {{ $item->is_active ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-100 text-slate-500 border-slate-200' }}">
                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                    </div>

                    <!-- Testimony Quote -->
                    <p class="text-xs text-slate-700 italic line-clamp-4 leading-relaxed bg-slate-50/80 p-3 rounded-xl border border-slate-100">
                        "{{ $item->testimony }}"
                    </p>

                    <!-- Patient Info -->
                    <div class="flex items-center gap-3 pt-2">
                        @if($item->photo)
                        <img src="{{ asset($item->photo) }}" alt="{{ $item->patient_name }}" class="w-10 h-10 rounded-full object-cover border border-slate-200 shrink-0">
                        @else
                        <div class="w-10 h-10 rounded-full bg-medical-50 text-medical-700 font-bold text-sm flex items-center justify-center shrink-0 border border-medical-200">
                            {{ strtoupper(substr($item->patient_name, 0, 1)) }}
                        </div>
                        @endif
                        <div class="min-w-0">
                            <h4 class="text-xs font-bold text-slate-900 truncate">{{ $item->patient_name }}</h4>
                            <p class="text-[11px] text-medical-700 font-semibold truncate">{{ $item->service_used }}</p>
                            @if($item->patient_info)
                            <p class="text-[10px] text-slate-400 truncate">{{ $item->patient_info }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Card Actions -->
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                    <div class="flex items-center gap-1">
                        <!-- Toggle Featured -->
                        <form action="{{ route('admin.testimonials.toggle-featured', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="p-1.5 rounded-lg border transition {{ $item->is_featured ? 'bg-amber-50 text-amber-600 border-amber-200' : 'bg-slate-50 text-slate-400 hover:text-slate-600 border-slate-200' }}" title="{{ $item->is_featured ? 'Lepas Unggulan' : 'Jadikan Unggulan' }}">
                                <i data-lucide="star" class="w-3.5 h-3.5 {{ $item->is_featured ? 'fill-current' : '' }}"></i>
                            </button>
                        </form>

                        <!-- Toggle Active -->
                        <form action="{{ route('admin.testimonials.toggle-active', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="p-1.5 rounded-lg border transition {{ $item->is_active ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-slate-50 text-slate-400 hover:text-slate-600 border-slate-200' }}" title="{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                <i data-lucide="{{ $item->is_active ? 'eye' : 'eye-off' }}" class="w-3.5 h-3.5"></i>
                            </button>
                        </form>
                    </div>

                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('admin.testimonials.edit', $item->id) }}" class="px-2.5 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 text-xs font-bold transition flex items-center gap-1">
                            <i data-lucide="edit-3" class="w-3 h-3"></i>
                            <span>Edit</span>
                        </a>

                        <form action="{{ route('admin.testimonials.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus testimoni dari {{ $item->patient_name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-bold transition" title="Hapus">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($testimonials->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $testimonials->links() }}
        </div>
        @endif
        @endif

    </div>

</div>
@endsection
