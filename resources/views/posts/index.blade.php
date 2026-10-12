@extends('layouts.app')

@section('content')
  <div class="flex items-center justify-between flex-wrap gap-3 mb-6">
    <h1 class="text-2xl font-bold">Semua Postingan</h1>
    <form method="GET" action="{{ route('posts.index') }}" class="flex gap-2">
      <input type="text" name="q" value="{{ $keyword }}" placeholder="Cari postingan..."
             class="border border-slate-300 rounded-lg px-3 py-1.5 text-sm">
      <button class="bg-slate-800 text-white text-sm px-3 py-1.5 rounded-lg">Cari</button>
    </form>
  </div>

  <div class="space-y-4">
    @forelse ($posts as $post)
      <x-card>
        <div class="flex gap-4">
          @if ($post->gambar)
            <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul }}"
                 class="w-24 h-24 object-cover rounded-lg flex-shrink-0">
          @endif
          <div class="flex-1">
            <a href="{{ route('posts.show', $post) }}" class="font-semibold text-lg hover:text-emerald-600">
              {{ $post->judul }}
            </a>
            <p class="text-sm text-slate-500 mt-1">{{ Str::limit(strip_tags($post->konten), 120) }}</p>
            <div class="mt-3 flex gap-3 text-sm">
              <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 font-medium">Edit</a>
              <form method="POST" action="{{ route('posts.destroy', $post) }}"
                    onsubmit="return confirm('Yakin hapus postingan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 font-medium">Hapus</button>
              </form>
            </div>
          </div>
        </div>
      </x-card>
    @empty
      <x-card>
        <p class="text-center text-slate-500">
          @if ($keyword) Tidak ada postingan yang cocok dengan "{{ $keyword }}". @else Belum ada postingan. @endif
        </p>
      </x-card>
    @endforelse
  </div>

  <div class="mt-6">
    {{ $posts->links() }}
  </div>
@endsection
