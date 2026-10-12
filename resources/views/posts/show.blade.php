@extends('layouts.app')

@section('content')
  <a href="{{ route('posts.index') }}" class="text-sm text-slate-500">&larr; Kembali</a>

  <x-card class="mt-4">
    @if ($post->gambar)
      <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul }}"
           class="w-full h-56 object-cover rounded-lg mb-5">
    @endif

    <h1 class="text-2xl font-bold">{{ $post->judul }}</h1>
    <p class="text-xs text-slate-400 mt-1">Dipublikasikan {{ $post->created_at->translatedFormat('d F Y') }}</p>

    <div class="mt-5 text-slate-700 leading-relaxed whitespace-pre-line">
      {{ $post->konten }}
    </div>
  </x-card>
@endsection
