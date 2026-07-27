<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Gallery;

class PageController extends Controller
{
    public function home()
    {
        $latestPosts = Post::where('status','published')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.home', compact('latestPosts'));
    }

    public function profil()
    {
        return view('pages.profil');
    }

    public function galeri()
    {
        $items = Gallery::latest()->paginate(12);
        return view('pages.galeri', compact('items'));
    }

    public function kontak()
    {
        return view('pages.kontak');
    }

    public function peta()
    {
        return view('pages.peta');
    }

    public function tiket()
    {
        return view('pages.tiket');
    }

    public function aturan()
    {
        return view('pages.aturan');
    }

    public function spotFoto()
    {
        return view('pages.spot_foto');
    }

    public function kegiatan()
    {
        return view('pages.kegiatan');
    }
}
