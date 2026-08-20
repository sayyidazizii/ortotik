@extends('layouts.app')

@section('title', 'Artikel & Edukasi Medis - pediOcare')
@section('meta_description', 'Panduan klinis terpercaya seputar kesehatan tulang, sendi, perawatan prostesis bionik, dan tips terapi postur skoliosis.')

@section('content')

<!-- Header Banner -->
<div class="bg-surface-container-low border-b border-outline-variant/30 py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-container-max mx-auto text-center space-y-3">
        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-primary"></span>
            Pusat Pengetahuan & Edukasi
        </span>
        <h1 class="text-3xl sm:text-4xl font-headline-xl font-bold tracking-tight text-on-background leading-tight">
            Artikel & Edukasi Medis
        </h1>
        <p class="text-on-surface-variant text-base sm:text-lg max-w-xl mx-auto leading-relaxed">
            Informasi medis terpercaya seputar kesehatan muskuloskeletal, penanganan skoliosis, dan perawatan kaki palsu.
        </p>
    </div>
</div>

<div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12 md:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- Main Article List -->
        <main class="lg:col-span-8 space-y-8">
            @if($articles->isEmpty())
            <div class="p-16 bg-surface-white rounded-3xl border border-outline-variant/30 text-center space-y-2 shadow-1">
                <span class="material-symbols-outlined text-outline-variant text-4xl">article</span>
                <p class="text-on-surface-variant text-sm">Belum ada artikel pada kategori ini.</p>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach($articles as $art)
                <article class="bg-surface-white rounded-3xl border border-outline-variant/30 overflow-hidden flex flex-col justify-between shadow-1 hover:shadow-hover hover:-translate-y-1 transition duration-300 group">
                    <div>
                        <!-- Image Container -->
                        <div class="relative bg-surface-container-low aspect-[16/10] overflow-hidden border-b border-outline-variant/15">
                            @if($art->thumbnail)
                            <img src="{{ $art->thumbnail }}" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&q=80" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @endif
                            <span class="absolute top-3.5 left-3.5 bg-surface-white/95 text-primary text-xs font-semibold px-3 py-1 rounded-full border border-outline-variant/20 shadow-2xs">
                                {{ $art->category->name ?? 'Edukasi' }}
                            </span>
                        </div>

                        <!-- Content Metadata -->
                        <div class="p-6 space-y-2.5">
                            <span class="text-xs text-on-surface-variant flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm text-primary">calendar_month</span>
                                {{ $art->published_at ? $art->published_at->format('d M Y') : 'Terbaru' }} &bull; {{ $art->read_time }} menit baca
                            </span>
                            
                            <h3 class="font-headline-md text-lg font-bold text-on-background leading-snug group-hover:text-primary transition">
                                <a href="{{ route('articles.show', $art->slug) }}">{{ $art->title }}</a>
                            </h3>
                            
                            <p class="text-xs text-on-surface-variant line-clamp-2 leading-relaxed">
                                {{ $art->summary }}
                            </p>
                        </div>
                    </div>

                    <div class="p-6 pt-0">
                        <a href="{{ route('articles.show', $art->slug) }}" class="text-xs font-semibold text-primary hover:text-secondary transition inline-flex items-center gap-1">
                            <span>Baca Artikel Lengkap</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
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
            <div class="p-6 bg-surface-white rounded-3xl border border-outline-variant/30 space-y-3 shadow-1">
                <h3 class="text-xs font-bold uppercase tracking-wider text-primary">Pencarian Topik</h3>
                <form action="{{ route('articles.index') }}" method="GET">
                    <div class="flex items-center bg-surface-container-low rounded-xl px-3.5 py-2.5 border border-outline-variant/30 focus-within:border-primary focus-within:bg-surface-white focus-within:ring-2 focus-within:ring-primary/20 transition">
                        <span class="material-symbols-outlined text-outline-variant mr-2 text-lg">search</span>
                        <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Ketik kata kunci..."
                            class="bg-transparent border-0 focus:ring-0 shadow-none p-0 text-xs text-on-surface placeholder:text-outline-variant focus:outline-none w-full">
                    </div>
                </form>
            </div>

            <!-- Category List -->
            <div class="p-6 bg-surface-white rounded-3xl border border-outline-variant/30 space-y-3 shadow-1">
                <h3 class="text-xs font-bold uppercase tracking-wider text-primary">Kategori Artikel</h3>
                <div class="space-y-1 text-xs font-medium">
                    <a href="{{ route('articles.index') }}"
                        class="block px-3.5 py-2 rounded-xl transition {{ empty($selectedCategory) ? 'bg-primary text-white font-bold' : 'text-on-surface hover:bg-surface-container-low' }}">
                        Semua Kategori
                    </a>
                    @foreach($categories as $c)
                    <a href="{{ route('articles.index', ['category' => $c->slug]) }}"
                        class="block px-3.5 py-2 rounded-xl transition {{ optional($selectedCategory)->id === $c->id ? 'bg-primary text-white font-bold' : 'text-on-surface hover:bg-surface-container-low' }}">
                        {{ $c->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </aside>

    </div>
</div>

@endsection
