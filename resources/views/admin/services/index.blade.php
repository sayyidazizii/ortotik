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
            class="px-4 py-2.5 bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs rounded-xl shadow-sm inline-flex items-center gap-2 transition">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Tambah Layanan Baru</span>
        </a>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $s)
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col justify-between space-y-4 hover:shadow-md transition">
            <div>
                <div class="flex items-start justify-between">
                    <div class="w-12 h-12 rounded-xl bg-medical-50 border border-medical-100 flex items-center justify-center text-medical-600">
                        <i data-lucide="{{ $s->icon ?? 'activity' }}" class="w-6 h-6"></i>
                    </div>
                    <div>
                        @if($s->is_active)
                            <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px] uppercase border border-emerald-200">Aktif</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-500 font-bold text-[10px] uppercase">Non-Aktif</span>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <h3 class="text-base font-extrabold text-slate-900">{{ $s->name }}</h3>
                    <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $s->short_description }}</p>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] font-mono text-slate-400">Urutan: #{{ $s->order_position }}</span>
                <div class="flex items-center gap-1.5">
                    <a href="{{ route('admin.services.edit', $s->id) }}" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                    </a>
                    <form action="{{ route('admin.services.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus layanan {{ $s->name }}?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition">
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
