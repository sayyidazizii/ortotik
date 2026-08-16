@extends('admin.layouts.app')

@section('title', 'Manajemen E-Katalog Produk')
@section('header_title', 'Manajemen E-Katalog Produk Medis')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-lg font-black text-slate-900">Daftar Produk E-Katalog</h2>
            <p class="text-xs text-slate-500">Kelola spesifikasi teknis, harga estimasi, dan status stok alat bantu medis.</p>
        </div>

        <a href="{{ route('admin.products.create') }}"
            class="px-4 py-2.5 bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs rounded-xl shadow-sm inline-flex items-center gap-2 transition">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Tambah Produk Baru</span>
        </a>
    </div>

    <!-- Search & Filter Controls -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
        <form action="{{ route('admin.products.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
            <!-- Search -->
            <div class="sm:col-span-5 relative">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama produk, SKU, deskripsi..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <!-- Category -->
            <div class="sm:col-span-4">
                <select name="category_id" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
                    <option value="">-- Semua Bagian Tubuh / Kategori --</option>
                    @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ $categoryId == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Stock Status -->
            <div class="sm:col-span-2">
                <select name="stock_status" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
                    <option value="">-- Status Stok --</option>
                    <option value="ready_stock" {{ $stockStatus === 'ready_stock' ? 'selected' : '' }}>Ready Stock</option>
                    <option value="pre_order" {{ $stockStatus === 'pre_order' ? 'selected' : '' }}>Pre Order</option>
                    <option value="custom_only" {{ $stockStatus === 'custom_only' ? 'selected' : '' }}>Custom Only</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="sm:col-span-1 flex gap-2">
                <button type="submit" class="w-full py-2.5 px-3 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs shadow-sm transition">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if($products->isEmpty())
        <div class="p-16 text-center text-slate-400 text-xs space-y-2">
            <i data-lucide="package-open" class="w-10 h-10 mx-auto text-slate-300"></i>
            <p class="font-semibold text-slate-600">Belum ada produk yang cocok dengan pencarian.</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="py-3.5 px-6">Produk Medis</th>
                        <th class="py-3.5 px-6">Kategori</th>
                        <th class="py-3.5 px-6">Estimasi Harga</th>
                        <th class="py-3.5 px-6">Status Stok</th>
                        <th class="py-3.5 px-6">Visibilitas</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($products as $p)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden shrink-0 flex items-center justify-center">
                                    <i data-lucide="package" class="w-6 h-6 text-slate-400"></i>
                                </div>
                                <div>
                                    <a href="{{ route('admin.products.edit', $p->id) }}" class="font-bold text-slate-900 hover:text-medical-600 text-sm">
                                        {{ $p->name }}
                                    </a>
                                    <p class="text-[11px] text-slate-400 font-mono">SKU: {{ $p->sku ?? '-' }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="py-4 px-6 font-semibold text-slate-700">
                            {{ $p->category->name ?? '-' }}
                        </td>

                        <td class="py-4 px-6 font-extrabold text-slate-800">
                            {{ $p->formatted_price }}
                        </td>

                        <td class="py-4 px-6">
                            @if($p->stock_status === 'ready_stock')
                                <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px] uppercase border border-emerald-200">Ready Stock</span>
                            @elseif($p->stock_status === 'pre_order')
                                <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 font-bold text-[10px] uppercase border border-amber-200">Pre Order</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full bg-sky-50 text-sky-700 font-bold text-[10px] uppercase border border-sky-200">Custom Only</span>
                            @endif
                        </td>

                        <td class="py-4 px-6">
                            @if($p->is_active)
                                <span class="inline-flex items-center gap-1 text-emerald-600 font-bold text-[11px]"><i data-lucide="check" class="w-3.5 h-3.5"></i> Aktif</span>
                            @else
                                <span class="inline-flex items-center gap-1 text-slate-400 font-bold text-[11px]"><i data-lucide="x" class="w-3.5 h-3.5"></i> Draft</span>
                            @endif
                            @if($p->is_featured)
                                <span class="block text-[10px] text-amber-600 font-bold">★ Unggulan</span>
                            @endif
                        </td>

                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ route('products.show', $p->slug) }}" target="_blank" title="Lihat di Web" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition">
                                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $p->id) }}" title="Edit Produk" class="p-2 rounded-xl bg-medical-50 hover:bg-medical-100 text-medical-600 transition">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk {{ $p->name }}?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition">
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
            {{ $products->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
