@extends('admin.layouts.app')

@section('title', 'Manajemen Kategori Produk')
@section('header_title', 'Kategori Produk')

@section('content')
<div class="space-y-6">

    <!-- Top Action & Stats Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900">Kategori Produk & Anatomi</h2>
            <p class="text-xs text-slate-500 mt-0.5">Kelola kategori pengelompokan produk medis berdasarkan anatomi tubuh atau tipe alat bantu.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-100 text-slate-700 text-xs font-bold transition">
                &larr; Kembali ke Produk
            </a>
            <a href="{{ route('admin.product-categories.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-medical-600 hover:bg-medical-700 text-white text-xs font-bold transition shadow-sm">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Tambah Kategori Baru</span>
            </a>
        </div>
    </div>

    <!-- 2 Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Kategori Produk</span>
                <h3 class="text-2xl font-black text-slate-900 mt-1">{{ $totalCategories }}</h3>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-medical-50 text-medical-600 flex items-center justify-center">
                <i data-lucide="folder-tree" class="w-5 h-5"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Produk Terdaftar</span>
                <h3 class="text-2xl font-black text-slate-900 mt-1">{{ $totalProducts }}</h3>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i data-lucide="package" class="w-5 h-5"></i>
            </div>
        </div>
    </div>

    <!-- Filter & Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        <!-- Search Header -->
        <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <form action="{{ route('admin.product-categories.index') }}" method="GET" class="w-full sm:w-80 relative">
                <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama kategori..."
                       class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-medical-500 focus:bg-white transition">
            </form>
            @if($search)
            <a href="{{ route('admin.product-categories.index') }}" class="text-xs text-slate-500 hover:text-medical-600 font-semibold underline">Reset Pencarian</a>
            @endif
        </div>

        <!-- Table -->
        @if($categories->isEmpty())
        <div class="p-12 text-center text-slate-400 text-xs">
            <i data-lucide="folder-open" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
            <span>Belum ada kategori produk yang ditemukan.</span>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="py-3.5 px-6">Nama Kategori</th>
                        <th class="py-3.5 px-6">Slug URL</th>
                        <th class="py-3.5 px-6">Urutan</th>
                        <th class="py-3.5 px-6">Jumlah Produk</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($categories as $category)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900 text-sm">{{ $category->name }}</div>
                            @if($category->description)
                            <div class="text-[11px] text-slate-400 mt-0.5 max-w-md truncate">{{ $category->description }}</div>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <code class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 font-mono text-[11px]">{{ $category->slug }}</code>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-bold text-slate-700">{{ $category->order_position }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold {{ $category->products_count > 0 ? 'bg-medical-50 text-medical-700' : 'bg-slate-100 text-slate-500' }}">
                                <i data-lucide="package" class="w-3 h-3"></i>
                                <span>{{ $category->products_count }} Produk</span>
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right space-x-1.5">
                            <a href="{{ route('admin.product-categories.edit', $category->id) }}" 
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 text-xs font-bold transition">
                                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.product-categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kategori {{ $category->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-bold transition">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $categories->links() }}
        </div>
        @endif
        @endif

    </div>

</div>
@endsection
