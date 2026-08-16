@extends('layouts.app')

@section('title', 'Artikel & Edukasi Medis Ortotik Prostetik - Klinik Ortotik')
@section('meta_description', 'Panduan klinis terpercaya seputar kesehatan tulang, sendi, perawatan prostesis bionik, dan tips terapi postur skoliosis.')

@section('content')

<!-- Header Banner -->
<div class="bg-hero-soft py-14 lg:py-18 border-b border-sky-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
        <span class="text-medical-600 font-extrabold text-xs uppercase tracking-widest block">EDUKASI KESEHATAN KLINIS</span>
        <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight">Artikel & Tips Pemulihan Gerak</h1>
        <p class="text-slate-600 text-sm max-w-xl mx-auto leading-relaxed">
            Informasi medis terpercaya seputar kesehatan muskuloskeletal, penanganan skoliosis, dan perawatan kaki palsu.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Main Article List -->
        <main class="lg:col-span-8 space-y-6">
            @if($articles->isEmpty())
            <div class="bg-white p-12 rounded-2xl border border-slate-200/80 text-center shadow-card">
                <p class="text-slate-500 text-sm">Belum ada artikel pada kategori ini.</p>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach($articles as $art)
                <article class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-card hover:shadow-card-hover hover:border-sky-300 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="h-48 bg-slate-100 overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&q=80" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <span class="absolute top-3 left-3 bg-white/95 backdrop-blur-md text-slate-800 text-[10px] font-extrabold px-2.5 py-0.5 rounded-md shadow-xs border border-slate-200/60">{{ $art->category->name ?? 'Edukasi' }}</span>
                        </div>
                        <div class="p-5">
                            <span class="text-[11px] text-slate-400 font-semibold block mb-2">{{ $art->published_at ? $art->published_at->format('d M Y') : 'Terbaru' }} &bull; {{ $art->read_time }} menit baca</span>
                            <h3 class="font-extrabold text-sm text-slate-900 group-hover:text-medical-600 transition leading-snug">
                                <a href="{{ route('articles.show', $art->slug) }}">{{ $art->title }}</a>
                            </h3>
                            <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">{{ $art->summary }}</p>
                        </div>
                    </div>
                    <div class="px-5 pb-5 pt-0">
                        <a href="{{ route('articles.show', $art->slug) }}" class="text-xs font-bold text-medical-600 hover:text-medical-700 inline-flex items-center gap-1">
                            <span>Baca Selengkapnya</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pt-6">
                {{ $articles->links() }}
            </div>
            @endif
        </main>

        <!-- Sidebar -->
        <aside class="lg:col-span-4 space-y-6">
            <!-- Search Widget -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-card space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Pencarian Topik</h3>
                <form action="{{ route('articles.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Ketik topik medis..." class="w-full pl-9 pr-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-3"></i>
                </form>
            </div>

            <!-- Category List -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-card space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Kategori Artikel</h3>
                <div class="space-y-1 text-xs font-bold">
                    <a href="{{ route('articles.index') }}" class="block px-3.5 py-2.5 rounded-xl transition {{ empty($selectedCategory) ? 'bg-medical-50 text-medical-700 border border-medical-200/60' : 'text-slate-600 hover:bg-slate-50' }}">Semua Kategori</a>
                    @foreach($categories as $c)
                    <a href="{{ route('articles.index', ['category' => $c->slug]) }}" class="block px-3.5 py-2.5 rounded-xl transition {{ optional($selectedCategory)->id === $c->id ? 'bg-medical-50 text-medical-700 border border-medical-200/60' : 'text-slate-600 hover:bg-slate-50' }}">{{ $c->name }}</a>
                    @endforeach
                </div>
            </div>
        </aside>

    </div>
</div>

@endsection
