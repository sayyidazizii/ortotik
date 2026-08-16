@extends('layouts.app')

@section('title', 'Artikel & Edukasi Medis - Precision Orthotics & Prosthetics')
@section('meta_description', 'Panduan klinis terpercaya seputar kesehatan tulang, sendi, perawatan prostesis bionik, dan tips terapi postur skoliosis.')

@section('content')

<!-- Header Banner with Editorial Typography -->
<div class="bg-canvas border-b border-hairline-soft py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1440px] mx-auto text-center space-y-2">
        <span class="text-xs text-mute font-semibold uppercase tracking-widest block">Clinical Knowledge & Care</span>
        <h1 class="text-3xl sm:text-5xl font-medium tracking-tight text-ink uppercase font-sans">
            Artikel & Edukasi Medis
        </h1>
        <p class="text-mute text-sm max-w-xl mx-auto leading-relaxed">
            Informasi medis terpercaya seputar kesehatan muskuloskeletal, penanganan skoliosis, dan perawatan kaki palsu.
        </p>
    </div>
</div>

<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Main Article List (2-up Grid on Desktop) -->
        <main class="lg:col-span-8 space-y-6">
            @if($articles->isEmpty())
            <div class="p-16 border border-hairline-soft text-center space-y-2">
                <p class="text-mute text-sm">Belum ada artikel pada kategori ini.</p>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($articles as $art)
                <article class="bg-canvas border border-hairline-soft p-0 flex flex-col justify-between group">
                    <div>
                        <!-- Image Container with soft-cloud backdrop -->
                        <div class="relative bg-soft-cloud aspect-[16/10] overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&q=80" alt="{{ $art->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <span class="absolute top-3 left-3 bg-canvas border border-hairline text-ink text-[11px] font-medium px-3 py-1 rounded-full shadow-xs">
                                {{ $art->category->name ?? 'Edukasi' }}
                            </span>
                        </div>

                        <!-- Content Metadata -->
                        <div class="p-4 space-y-2">
                            <span class="text-[11px] text-mute font-medium block">
                                {{ $art->published_at ? $art->published_at->format('d M Y') : 'Terbaru' }} &bull; {{ $art->read_time }} menit baca
                            </span>
                            
                            <h3 class="text-base font-bold text-ink leading-snug group-hover:text-mute transition">
                                <a href="{{ route('articles.show', $art->slug) }}">{{ $art->title }}</a>
                            </h3>
                            
                            <p class="text-xs text-mute font-normal line-clamp-2 leading-relaxed">
                                {{ $art->summary }}
                            </p>
                        </div>
                    </div>

                    <div class="p-4 pt-0">
                        <a href="{{ route('articles.show', $art->slug) }}" class="text-xs font-semibold text-ink underline hover:text-mute transition inline-flex items-center gap-1">
                            <span>Baca Artikel</span>
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
            <div class="p-6 bg-canvas border border-hairline-soft space-y-3">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-ink">Pencarian Topik</h3>
                <form action="{{ route('articles.index') }}" method="GET">
                    <div class="flex items-center bg-soft-cloud rounded-full px-3.5 py-2">
                        <i data-lucide="search" class="w-4 h-4 text-mute mr-2 shrink-0"></i>
                        <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Ketik kata kunci..."
                            class="bg-transparent text-xs text-ink placeholder-mute focus:outline-none w-full font-medium">
                    </div>
                </form>
            </div>

            <!-- Category List -->
            <div class="p-6 bg-canvas border border-hairline-soft space-y-3">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-ink">Kategori Artikel</h3>
                <div class="space-y-1 text-xs font-medium">
                    <a href="{{ route('articles.index') }}"
                        class="block px-3.5 py-2 rounded-full transition {{ empty($selectedCategory) ? 'bg-ink text-canvas' : 'text-ink hover:bg-soft-cloud' }}">
                        Semua Kategori
                    </a>
                    @foreach($categories as $c)
                    <a href="{{ route('articles.index', ['category' => $c->slug]) }}"
                        class="block px-3.5 py-2 rounded-full transition {{ optional($selectedCategory)->id === $c->id ? 'bg-ink text-canvas' : 'text-ink hover:bg-soft-cloud' }}">
                        {{ $c->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </aside>

    </div>
</div>

@endsection
