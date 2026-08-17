@extends('layouts.app')

@section('title', $article->title . ' - PT. Orthocare Indonesia')
@section('meta_description', $article->summary)

@section('content')

<!-- Sub-Nav Breadcrumb -->
<div class="bg-surface-white border-b border-outline-variant/30 py-3.5 px-4 sm:px-6 lg:px-8 text-xs text-on-surface-variant font-medium">
    <div class="max-w-container-max mx-auto flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <span class="text-outline-variant">/</span>
        <a href="{{ route('articles.index') }}" class="hover:text-primary transition-colors">Artikel Medis</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-semibold truncate">{{ $article->title }}</span>
    </div>
</div>

<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="space-y-8">
        
        <!-- Header Metadata -->
        <div class="space-y-4">
            <span class="inline-flex items-center px-3.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider">
                {{ $article->category->name ?? 'Edukasi Medis' }}
            </span>

            <h1 class="text-2xl sm:text-3xl lg:text-[40px] font-headline-xl font-bold text-on-background tracking-tight leading-tight">
                {{ $article->title }}
            </h1>

            <div class="flex items-center gap-4 text-xs text-on-surface-variant pt-1">
                <span>Ditulis oleh: <strong class="text-on-background font-semibold">{{ $article->user->name ?? 'Tim Medis PT. Orthocare Indonesia' }}</strong></span>
                <span>&bull;</span>
                <span>{{ $article->published_at ? $article->published_at->format('d F Y') : 'Terbaru' }}</span>
                <span>&bull;</span>
                <span>{{ $article->read_time }} menit baca</span>
            </div>
        </div>

        <!-- Main Featured Image -->
        <div class="relative bg-surface-container-low rounded-3xl border border-outline-variant/30 overflow-hidden aspect-[16/9] shadow-1">
            @if($article->thumbnail)
            <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            @else
            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=85" alt="{{ $article->title }}" class="w-full h-full object-cover">
            @endif
        </div>

        <!-- Article Body -->
        <div class="prose prose-slate max-w-none text-base text-on-surface-variant leading-relaxed space-y-4 pt-4 border-t border-outline-variant/20">
            {!! $article->content !!}
        </div>

        <!-- Bottom Consultation Box -->
        <div class="p-8 bg-surface-white rounded-3xl border border-outline-variant/30 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-1">
            <div class="space-y-1 text-center sm:text-left">
                <h3 class="text-lg font-bold text-on-background">Butuh Konsultasi Mengenai Kondisi Anda?</h3>
                <p class="text-xs text-on-surface-variant">Konsultasikan keluhan gerak tubuh Anda langsung bersama tim klinisi kami.</p>
            </div>
            <a href="{{ route('consultation.create') }}" class="inline-flex items-center justify-center bg-[#E5A500] hover:bg-[#CC9200] text-surface-white text-xs font-semibold px-7 py-3.5 rounded-xl transition shrink-0 shadow-md">
                <span>Jadwalkan Konsultasi</span>
            </a>
        </div>

    </div>
</article>

@endsection
