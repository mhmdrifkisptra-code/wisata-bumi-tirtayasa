<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index()
    {
        // supaya home.blade.php tidak error walau berita belum dipasang
        $latestPosts = collect();

        return view('pages.home', compact('latestPosts'));
    }
}
