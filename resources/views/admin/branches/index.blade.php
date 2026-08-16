@extends('admin.layouts.app')

@section('title', 'Manajemen Cabang Klinik')
@section('header_title', 'Kelola Cabang Klinik & Kontak')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-lg font-black text-slate-900">Daftar Cabang Klinik Ortotik</h2>
            <p class="text-xs text-slate-500">Kelola nomor WhatsApp hotline, alamat fisik, embed peta, dan jam operasional tiap cabang.</p>
        </div>

        <a href="{{ route('admin.branches.create') }}"
            class="px-4 py-2.5 bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs rounded-xl shadow-sm inline-flex items-center gap-2 transition">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Tambah Cabang Baru</span>
        </a>
    </div>

    <!-- Branch Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($branches as $b)
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col justify-between space-y-4">
            <div>
                <div class="flex items-start justify-between">
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="text-base font-extrabold text-slate-900">{{ $b->name }}</h3>
                            @if($b->is_main_branch)
                                <span class="px-2 py-0.5 rounded-full bg-medical-50 text-medical-700 font-extrabold text-[10px] uppercase border border-medical-200">Kantor Pusat</span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $b->city }}</p>
                    </div>

                    <div>
                        @if($b->is_active)
                            <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px] uppercase border border-emerald-200">Buka / Aktif</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-500 font-bold text-[10px] uppercase">Non-Aktif</span>
                        @endif
                    </div>
                </div>

                <div class="mt-4 space-y-2 text-xs">
                    <p class="text-slate-600 flex items-start gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-slate-400 shrink-0 mt-0.5"></i>
                        <span>{{ $b->address }}</span>
                    </p>

                    <p class="text-slate-600 flex items-center gap-2">
                        <i data-lucide="phone" class="w-4 h-4 text-slate-400 shrink-0"></i>
                        <span>{{ $b->phone_number }}</span>
                    </p>

                    <p class="text-slate-600 flex items-center gap-2">
                        <i data-lucide="message-circle" class="w-4 h-4 text-[#25D366] shrink-0"></i>
                        <span class="font-mono font-bold text-slate-800">{{ $b->whatsapp_number }}</span>
                    </p>

                    <p class="text-slate-600 flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4 text-slate-400 shrink-0"></i>
                        <span>{{ $b->opening_hours ?? 'Senin - Sabtu: 08.00 - 17.00 WIB' }}</span>
                    </p>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                @if($b->google_maps_url)
                <a href="{{ $b->google_maps_url }}" target="_blank" class="text-xs font-bold text-medical-600 hover:underline inline-flex items-center gap-1">
                    <i data-lucide="map" class="w-3.5 h-3.5"></i>
                    <span>Buka Google Maps</span>
                </a>
                @else
                <span></span>
                @endif

                <div class="flex items-center gap-1.5">
                    <a href="{{ route('admin.branches.edit', $b->id) }}" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                    </a>
                    @if(!$b->is_main_branch)
                    <form action="{{ route('admin.branches.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Hapus cabang {{ $b->name }}?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition">
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
