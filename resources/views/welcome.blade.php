<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Wisata Bumi Tirtayasa')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<header class="navbar">
  <a href="{{ route('home') }}" class="brand">
    <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
    <div>
      <div class="brand-title">Wisata Bumi</div>
      <div class="brand-subtitle">Tirtayasa</div>
    </div>
  </a>

  <nav class="nav-links">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
    <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profil</a>
    <a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'active' : '' }}">Galeri</a>
    <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
  </nav>
</header>

<main class="content">
  @yield('content')
</main>

<footer class="footer">
  <p>© {{ date('Y') }} Wisata Bumi Tirtayasa</p>
</footer>

</body>
</html>
