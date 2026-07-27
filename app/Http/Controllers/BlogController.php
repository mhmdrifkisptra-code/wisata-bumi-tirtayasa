<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        return view('pages.berita', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::with('category')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('pages.berita_show', compact('post'));
    }
}
