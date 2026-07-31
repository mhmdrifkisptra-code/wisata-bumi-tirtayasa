<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Wisata Bumi Tirtayasa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-success" href="{{ route('home') }}">
            🌿 Wisata Bumi Tirtayasa
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}"><i class="bi bi-house"></i> Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profil') }}"><i class="bi bi-info-circle"></i> Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tiket') }}"><i class="bi bi-ticket-perforated"></i> Tiket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('galeri') }}"><i class="bi bi-images"></i> Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kontak') }}"><i class="bi bi-telephone"></i> Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('aturan') }}"><i class="bi bi-shield-check"></i> Aturan</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-person-circle"></i> Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-success btn-sm">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<main class="container py-4">
    @yield('content')
</main>

<footer class="bg-dark text-white mt-5 py-4">
    <div class="container text-center">
        <p class="mb-0">© 2026 Wisata Bumi Tirtayasa</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>