@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold mb-6">Edit Postingan</h1>

  <x-card>
    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" class="space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label class="block text-sm font-medium mb-1">Judul</label>
        <input type="text" name="judul" value="{{ old('judul', $post->judul) }}"
               class="w-full border rounded-lg px-3 py-2 text-sm @error('judul') border-red-400 @else border-slate-300 @enderror">
        @error('judul')
          <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Konten</label>
        <textarea name="konten" rows="6"
                  class="w-full border rounded-lg px-3 py-2 text-sm @error('konten') border-red-400 @else border-slate-300 @enderror">{{ old('konten', $post->konten) }}</textarea>
        @error('konten')
          <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      @if ($post->gambar)
        <img src="{{ asset('storage/' . $post->gambar) }}" class="w-32 h-32 object-cover rounded-lg">
      @endif

      <div>
        <label class="block text-sm font-medium mb-1">Ganti Gambar (opsional)</label>
        <input type="file" name="gambar" accept="image/*"
               class="w-full border rounded-lg px-3 py-2 text-sm @error('gambar') border-red-400 @else border-slate-300 @enderror">
        @error('gambar')
          <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex gap-3 pt-2">
        <button type="submit" class="bg-emerald-600 text-white px-5 py-2 rounded-lg text-sm font-medium">
          Update
        </button>
        <a href="{{ route('posts.index') }}" class="px-5 py-2 rounded-lg text-sm text-slate-500 border border-slate-300">
          Batal
        </a>
      </div>
    </form>
  </x-card>
@endsection
