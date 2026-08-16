@extends('layouts.app')

@section('title', 'Artikel & Edukasi Medis - Precision Orthotics & Prosthetics')
@section('meta_description', 'Panduan klinis terpercaya seputar kesehatan tulang, sendi, perawatan prostesis bionik, dan tips terapi postur skoliosis.')

@section('content')

<!-- Header Banner -->
<div class="bg-cappuccino border-b border-border py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1360px] mx-auto text-center space-y-3">
        <span class="text-xs text-terracotta font-semibold uppercase tracking-wider block font-sans">CLINICAL KNOWLEDGE & CARE</span>
        <h1 class="text-3xl sm:text-4xl lg:text-[46px] font-serif font-medium tracking-tight text-primary leading-tight">
            Artikel & Edukasi Medis
        </h1>
        <p class="text-secondary/80 text-base sm:text-lg max-w-xl mx-auto leading-relaxed font-light">
            Informasi medis terpercaya seputar kesehatan muskuloskeletal, penanganan skoliosis, dan perawatan kaki palsu.
        </p>
    </div>
</div>

<div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- Main Article List -->
        <main class="lg:col-span-8 space-y-8">
            @if($articles->isEmpty())
            <div class="p-16 bg-white rounded-3xl border border-border text-center space-y-2 shadow-2xs">
                <p class="text-tertiary text-sm">Belum ada artikel pada kategori ini.</p>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                @foreach($articles as $art)
                <article class="bg-white rounded-3xl border border-border overflow-hidden flex flex-col justify-between hover:border-primary/40 hover:shadow-md transition duration-300 group">
                    <div>
                        <!-- Image Container -->
                        <div class="relative bg-cappuccino aspect-[16/10] overflow-hidden border-b border-border">
                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&q=80" alt="{{ $art->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <span class="absolute top-4 left-4 bg-white/95 text-secondary text-xs font-semibold px-3.5 py-1 rounded-full border border-border shadow-2xs">
                                {{ $art->category->name ?? 'Edukasi' }}
                            </span>
                        </div>

                        <!-- Content Metadata -->
                        <div class="p-7 space-y-2.5">
                            <span class="text-xs text-tertiary font-light block">
                                {{ $art->published_at ? $art->published_at->format('d M Y') : 'Terbaru' }} &bull; {{ $art->read_time }} menit baca
                            </span>
                            
                            <h3 class="text-xl font-serif font-medium text-primary leading-snug group-hover:text-terracotta transition">
                                <a href="{{ route('articles.show', $art->slug) }}">{{ $art->title }}</a>
                            </h3>
                            
                            <p class="text-xs text-tertiary font-light line-clamp-2 leading-relaxed">
                                {{ $art->summary }}
                            </p>
                        </div>
                    </div>

                    <div class="p-7 pt-0">
                        <a href="{{ route('articles.show', $art->slug) }}" class="text-xs font-semibold text-primary hover:text-terracotta transition inline-flex items-center gap-1.5">
                            <span>Baca Artikel Lengkap</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pt-10">
                {{ $articles->links() }}
            </div>
            @endif
        </main>

        <!-- Sidebar -->
        <aside class="lg:col-span-4 space-y-6">
            <!-- Search Widget -->
            <div class="p-6 bg-white rounded-3xl border border-border space-y-3 shadow-2xs">
                <h3 class="text-xs font-serif font-semibold uppercase tracking-wider text-primary">Pencarian Topik</h3>
                <form action="{{ route('articles.index') }}" method="GET">
                    <div class="flex items-center bg-cappuccino-light rounded-full px-4 py-2.5 border border-border focus-within:border-primary focus-within:bg-white">
                        <i data-lucide="search" class="w-4 h-4 text-tertiary mr-2 shrink-0"></i>
                        <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Ketik kata kunci..."
                            class="bg-transparent text-xs text-secondary placeholder-tertiary focus:outline-none w-full font-normal">
                    </div>
                </form>
            </div>

            <!-- Category List -->
            <div class="p-6 bg-white rounded-3xl border border-border space-y-3 shadow-2xs">
                <h3 class="text-xs font-serif font-semibold uppercase tracking-wider text-primary">Kategori Artikel</h3>
                <div class="space-y-1.5 text-xs font-medium font-sans">
                    <a href="{{ route('articles.index') }}"
                        class="block px-4 py-2.5 rounded-full transition {{ empty($selectedCategory) ? 'bg-primary text-white font-semibold' : 'text-secondary hover:bg-cappuccino' }}">
                        Semua Kategori
                    </a>
                    @foreach($categories as $c)
                    <a href="{{ route('articles.index', ['category' => $c->slug]) }}"
                        class="block px-4 py-2.5 rounded-full transition {{ optional($selectedCategory)->id === $c->id ? 'bg-primary text-white font-semibold' : 'text-secondary hover:bg-cappuccino' }}">
                        {{ $c->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </aside>

    </div>
</div>

@endsection
