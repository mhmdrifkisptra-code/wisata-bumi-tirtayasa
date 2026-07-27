<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private function makeUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 2;

        while (
            Post::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.berita.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'excerpt' => ['nullable','string','max:255'],
            'content' => ['nullable','string'],
            'thumbnail' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'is_published' => ['nullable'],
        ]);

        $data['slug'] = $this->makeUniqueSlug($data['title']);
        $data['is_published'] = $request->has('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        Post::create($data);

        return redirect()->route('admin.berita.index')->with('success','Berita berhasil dibuat.');
    }

    public function edit(Post $beritum) // Laravel resource kadang namanya aneh; biar aman pakai param manual di route nanti
    {
        // NOTE: kalau route resource pakai {berita}, ubah signature jadi edit(Post $berita)
        return view('admin.berita.edit', ['post' => $beritum]);
    }

    public function update(Request $request, Post $beritum)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'excerpt' => ['nullable','string','max:255'],
            'content' => ['nullable','string'],
            'thumbnail' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'is_published' => ['nullable'],
        ]);

        $data['slug'] = $this->makeUniqueSlug($data['title'], $beritum->id);
        $data['is_published'] = $request->has('is_published');
        $data['published_at'] = $data['is_published'] ? ($beritum->published_at ?? now()) : null;

        if ($request->hasFile('thumbnail')) {
            if ($beritum->thumbnail) Storage::disk('public')->delete($beritum->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        $beritum->update($data);

        return redirect()->route('admin.berita.index')->with('success','Berita berhasil diupdate.');
    }

    public function destroy(Post $beritum)
    {
        if ($beritum->thumbnail) Storage::disk('public')->delete($beritum->thumbnail);
        $beritum->delete();

        return redirect()->route('admin.berita.index')->with('success','Berita berhasil dihapus.');
    }
}
