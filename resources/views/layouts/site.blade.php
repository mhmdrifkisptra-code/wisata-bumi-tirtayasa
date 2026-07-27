<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Wisata Bumi Tirtayasa')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<header class="border-bottom bg-white">
    <div class="container py-3 d-flex align-items-center justify-content-between gap-3">
        <a href="{{ route('home') }}" class="text-decoration-none text-dark fw-bold">
            Wisata Bumi Tirtayasa
        </a>

        {{--
        <nav class="d-flex gap-3 align-items-center flex-wrap">
            <a class="text-decoration-none" href="{{ route('home') }}">Beranda</a>
            <a class="text-decoration-none" href="{{ route('profil') }}">Profil</a>
            <a class="text-decoration-none" href="{{ route('galeri') }}">Galeri</a>
            <a class="text-decoration-none" href="{{ route('kontak') }}">Kontak</a>
            <a class="text-decoration-none" href="{{ route('aturan') }}">Aturan</a>
        </nav>
        --}}

   {{-- Tombol Login/Register / Dashboard --}}
@if (request()->is('/'))
    <div class="d-flex align-items-center gap-2">
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-success">Dashboard</a>

            <form method="POST" action="{{ route('logout') }}" class="d-inline m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-success">Daftar</a>
        @endauth
    </div>
@endif



        </div>
    </div>
</header>

<main class="container py-4">
    @yield('content')
</main>

<footer class="border-top mt-5 py-4">
    <div class="container">
        <p class="mb-0 text-center">© 2026 Wisata Bumi Tirtayasa</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
