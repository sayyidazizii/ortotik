@extends('layouts.app')

@section('title', $article->title . ' - Precision Orthotics & Prosthetics')
@section('meta_description', $article->summary)

@section('content')

<!-- Sub-Nav Breadcrumb -->
<div class="bg-cappuccino border-b border-border py-3 px-4 sm:px-6 lg:px-8 text-xs text-tertiary font-medium font-sans">
    <div class="max-w-[1360px] mx-auto flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
        <span>/</span>
        <a href="{{ route('articles.index') }}" class="hover:text-primary">Artikel Medis</a>
        <span>/</span>
        <span class="text-primary font-semibold truncate">{{ $article->title }}</span>
    </div>
</div>

<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="space-y-8">
        
        <!-- Header Metadata -->
        <div class="space-y-4">
            <span class="inline-flex items-center px-4 py-1 rounded-full bg-mint text-primary text-xs font-semibold border border-primary/20 uppercase tracking-wider font-sans">
                {{ $article->category->name ?? 'Edukasi Medis' }}
            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-[46px] font-serif font-medium text-primary tracking-tight leading-tight">
                {{ $article->title }}
            </h1>

            <div class="flex items-center gap-4 text-xs text-tertiary font-light pt-1">
                <span>Ditulis oleh: <strong class="text-secondary font-medium">{{ $article->user->name ?? 'Tim Medis Ortotik' }}</strong></span>
                <span>&bull;</span>
                <span>{{ $article->published_at ? $article->published_at->format('d F Y') : 'Terbaru' }}</span>
                <span>&bull;</span>
                <span>{{ $article->read_time }} menit baca</span>
            </div>
        </div>

        <!-- Main Featured Image -->
        <div class="relative bg-cappuccino rounded-3xl border border-border overflow-hidden aspect-[16/9] shadow-2xs">
            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=85" alt="{{ $article->title }}" class="w-full h-full object-cover">
        </div>

        <!-- Article Body -->
        <div class="prose prose-slate max-w-none text-base sm:text-lg text-secondary/85 leading-relaxed space-y-5 pt-4 border-t border-border font-light">
            {!! $article->content !!}
        </div>

        <!-- Bottom Consultation Box -->
        <div class="p-8 sm:p-10 bg-white rounded-3xl border border-border flex flex-col sm:flex-row items-center justify-between gap-6 shadow-2xs">
            <div>
                <h3 class="text-xl font-serif font-medium text-primary">Butuh Konsultasi Mengenai Kondisi Anda?</h3>
                <p class="text-xs text-tertiary mt-1 font-light">Konsultasikan keluhan gerak tubuh Anda langsung bersama tim Ortotis-Prostetis resmi kami.</p>
            </div>
            <a href="{{ route('consultation.create') }}" class="inline-flex items-center justify-center bg-terracotta hover:bg-terracotta-dark text-white text-xs font-semibold px-7 h-12 rounded-full btn-maven transition shrink-0">
                <span>Jadwalkan Konsultasi</span>
            </a>
        </div>

    </div>
</article>

@endsection
