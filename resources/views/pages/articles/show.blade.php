@extends('layouts.app')

@section('title', $article->title . ' - Artikel Klinik Ortotik')
@section('meta_description', $article->summary)

@section('content')
<div class="bg-slate-100 py-4 border-b border-slate-200 text-xs">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-2 text-slate-500">
        <a href="{{ route('home') }}" class="hover:text-medical-700">Beranda</a>
        <span>/</span>
        <a href="{{ route('articles.index') }}" class="hover:text-medical-700">Artikel</a>
        <span>/</span>
        <span class="text-slate-800 font-semibold truncate">{{ $article->title }}</span>
    </div>
</div>

<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="space-y-6">
        <div class="space-y-3 text-center sm:text-left">
            <span class="bg-medical-50 text-medical-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">{{ $article->category->name ?? 'Edukasi' }}</span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 leading-tight">{{ $article->title }}</h1>
            <div class="flex items-center gap-4 text-xs text-slate-400">
                <span>Ditulis oleh: <strong>{{ $article->user->name ?? 'Tim Medis Ortotik' }}</strong></span>
                <span>&bull;</span>
                <span>{{ $article->published_at ? $article->published_at->format('d F Y') : 'Terbaru' }}</span>
                <span>&bull;</span>
                <span>{{ $article->read_time }} menit baca</span>
            </div>
        </div>

        <div class="rounded-3xl overflow-hidden shadow-lg h-[400px] bg-slate-100">
            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=80" alt="{{ $article->title }}" class="w-full h-full object-cover">
        </div>

        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-sm prose prose-slate max-w-none text-base text-slate-700 leading-relaxed space-y-4">
            {!! $article->content !!}
        </div>
    </div>
</article>
@endsection
