<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    // 1. index
    public function index(Request $request): View
    {
        $keyword = trim($request->get('q', ''));

        $posts = Post::query()
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where('judul', 'like', "%{$keyword}%")
                      ->orWhere('konten', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(6) // Requirement #8: pagination
            ->withQueryString();

        return view('posts.index', [
            'posts'   => $posts,
            'keyword' => $keyword,
        ]);
    }

    // 2. create
    public function create(): View
    {
        return view('posts.create');
    }

    // 3. store
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'judul'  => ['required', 'string', 'max:150'],
            'konten' => ['required', 'string', 'min:10'],
            'gambar' => ['nullable', 'image', 'max:2048'],
        ], [
            'judul.required'  => 'Judul wajib diisi.',
            'konten.required' => 'Konten wajib diisi.',
            'konten.min'      => 'Konten minimal 10 karakter.',
            'gambar.image'    => 'File harus berupa gambar.',
            'gambar.max'      => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()->route('posts.index')
            ->with('flash_type', 'sukses')
            ->with('flash_message', 'Postingan "' . $data['judul'] . '" berhasil dibuat.');
    }

    // 4. show (Route Model Binding via slug)
    public function show(Post $post): View
    {
        return view('posts.show', ['post' => $post]);
    }

    // 5. edit
    public function edit(Post $post): View
    {
        return view('posts.edit', ['post' => $post]);
    }

    // 6. update
    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $request->validate([
            'judul'  => ['required', 'string', 'max:150'],
            'konten' => ['required', 'string', 'min:10'],
            'gambar' => ['nullable', 'image', 'max:2048'],
        ], [
            'judul.required'  => 'Judul wajib diisi.',
            'konten.required' => 'Konten wajib diisi.',
            'konten.min'      => 'Konten minimal 10 karakter.',
            'gambar.image'    => 'File harus berupa gambar.',
            'gambar.max'      => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            if ($post->gambar) {
                Storage::disk('public')->delete($post->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')
            ->with('flash_type', 'sukses')
            ->with('flash_message', 'Postingan "' . $post->judul . '" berhasil diperbarui.');
    }

    // 7. destroy (soft delete)
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete(); // soft delete, bukan hapus permanen

        return redirect()->route('posts.index')
            ->with('flash_type', 'sukses')
            ->with('flash_message', 'Postingan "' . $post->judul . '" dipindahkan ke sampah.');
    }
}
