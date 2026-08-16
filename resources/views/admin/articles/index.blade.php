@extends('admin.layouts.app')

@section('title', 'Manajemen Artikel Edukasi')
@section('header_title', 'Kelola Artikel Edukasi & Blog')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-lg font-black text-slate-900">Daftar Artikel & Panduan Medis</h2>
            <p class="text-xs text-slate-500">Tingkatkan SEO klinik dan kepercayaan pasien melalui edukasi ortotik prostetik.</p>
        </div>

        <a href="{{ route('admin.articles.create') }}"
            class="px-4 py-2.5 bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs rounded-xl shadow-sm inline-flex items-center gap-2 transition">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Tulis Artikel Baru</span>
        </a>
    </div>

    <!-- Search & Filter Controls -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
        <form action="{{ route('admin.articles.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
            <div class="sm:col-span-8 relative">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul artikel atau konten..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <div class="sm:col-span-3">
                <select name="category_id" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
                    <option value="">-- Semua Kategori Artikel --</option>
                    @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ $categoryId == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-1">
                <button type="submit" class="w-full py-2.5 px-3 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs shadow-sm transition">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Articles Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if($articles->isEmpty())
        <div class="p-16 text-center text-slate-400 text-xs space-y-2">
            <i data-lucide="file-text" class="w-10 h-10 mx-auto text-slate-300"></i>
            <p class="font-semibold text-slate-600">Belum ada artikel yang cocok dengan pencarian.</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="py-3.5 px-6">Judul Artikel</th>
                        <th class="py-3.5 px-6">Kategori & Estimasi Baca</th>
                        <th class="py-3.5 px-6">Penulis</th>
                        <th class="py-3.5 px-6">Status Publikasi</th>
                        <th class="py-3.5 px-6">Pembaca</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($articles as $a)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6 max-w-sm">
                            <a href="{{ route('admin.articles.edit', $a->id) }}" class="font-bold text-slate-900 hover:text-medical-600 text-sm block line-clamp-1">
                                {{ $a->title }}
                            </a>
                            <p class="text-[11px] text-slate-400 line-clamp-1 mt-0.5">{{ $a->summary }}</p>
                        </td>

                        <td class="py-4 px-6">
                            <span class="font-semibold text-slate-700">{{ $a->category->name ?? 'Edukasi' }}</span>
                            <p class="text-[10px] text-slate-400">{{ $a->read_time ?? '5 menit baca' }}</p>
                        </td>

                        <td class="py-4 px-6 text-slate-600 font-medium">
                            {{ $a->user->name ?? 'Spesialis Medis' }}
                        </td>

                        <td class="py-4 px-6">
                            @if($a->is_published)
                                <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px] uppercase border border-emerald-200">Published</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-500 font-bold text-[10px] uppercase">Draft</span>
                            @endif
                            @if($a->is_featured)
                                <span class="block text-[10px] text-amber-600 font-bold mt-0.5">★ Featured</span>
                            @endif
                        </td>

                        <td class="py-4 px-6 font-mono text-slate-600">
                            {{ number_format($a->views_count) }} views
                        </td>

                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ route('articles.show', $a->slug) }}" target="_blank" title="Lihat di Web" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition">
                                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                </a>
                                <a href="{{ route('admin.articles.edit', $a->id) }}" title="Edit Artikel" class="p-2 rounded-xl bg-medical-50 hover:bg-medical-100 text-medical-600 transition">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Hapus artikel {{ $a->title }}?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-5 border-t border-slate-100">
            {{ $articles->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
