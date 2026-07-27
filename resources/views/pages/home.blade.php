@php
  use Illuminate\Support\Str;
@endphp

@extends('layouts.site')

@section('title', 'Beranda - Wisata Bumi Tirtayasa')

@section('content')

<section class="hero">
  <div class="overlay"></div>
  <div class="hero-content">
    <h1>Selamat Datang di Website<br><span>Wisata Bumi Tirtayasa</span></h1>
    <p>
      Wisata Bumi Tirtayasa merupakan destinasi wisata alam dan edukasi yang menyajikan
      keindahan lingkungan, kearifan lokal, serta pengalaman wisata yang ramah keluarga.
    </p>
    <a href="#tentang" class="btn-hero">JELAJAHI SELENGKAPNYA</a>
  </div>
</section>

<section class="section" id="tentang">
  <div class="section-title">
    <h2>Layanan & Informasi</h2>
    <p>Shortcut informasi penting untuk pengunjung.</p>
  </div>

  <div class="cards">
    <a class="card" href="{{ route('peta') }}">
      <div class="card-icon">🗺️</div>
      <div class="card-title">Peta Lokasi</div>
      <div class="card-desc">Arah & akses menuju lokasi wisata.</div>
    </a>

    <a class="card" href="{{ route('tiket') }}">
      <div class="card-icon">🎟️</div>
      <div class="card-title">Tiket Masuk</div>
      <div class="card-desc">Info harga tiket & jam operasional.</div>
    </a>

    <a class="card" href="{{ route('aturan') }}">
      <div class="card-icon">📌</div>
      <div class="card-title">Aturan Wisata</div>
      <div class="card-desc">Panduan kunjungan & larangan.</div>
    </a>

    <a class="card" href="{{ route('galeri') }}">
      <div class="card-icon">📷</div>
      <div class="card-title">Galeri</div>
      <div class="card-desc">Banyak spot foto terbaik.</div>
    </a>

    <a class="card" href="{{ route('kegiatan') }}">
      <div class="card-icon">📅</div>
      <div class="card-title">Kegiatan</div>
      <div class="card-desc">Event & agenda wisata.</div>
    </a>

    <a class="card" href="{{ route('kontak') }}">
      <div class="card-icon">☎️</div>
      <div class="card-title">Kontak</div>
      <div class="card-desc">Hubungi pengelola.</div>
    </a>
  </div>
</section>

{{-- ===================== BERITA TERBARU ===================== --}}
<section class="section" style="max-width:1100px;margin-top:60px;">

  <div style="text-align:center;margin-bottom:35px;">
    <h2 style="font-size:42px;margin-bottom:10px;font-weight:800;">Berita Terbaru</h2>
    <p style="color:#666;font-size:16px;">
      Informasi kegiatan dan pengumuman terbaru seputar Wisata Bumi Tirtayasa
    </p>
  </div>

  @if($latestPosts->count())
    <div style="
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
      gap:25px;
    ">
      @foreach($latestPosts as $post)
        <a href="{{ route('berita.show', $post->slug) }}"
           style="
            background:#fff;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 8px 25px rgba(0,0,0,.08);
            text-decoration:none;
            color:#111;
            transition:.25s;
            display:block;
           "
           onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 12px 30px rgba(0,0,0,.12)';"
           onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 8px 25px rgba(0,0,0,.08)';"
        >

          {{-- Thumbnail --}}
          <div style="height:190px;background:#f1f1f1;">
            @if($post->thumbnail)
              <img src="{{ asset('storage/'.$post->thumbnail) }}"
                   alt="{{ $post->title }}"
                   style="width:100%;height:100%;object-fit:cover;">
            @else
              <div style="
                width:100%;
                height:100%;
                display:flex;
                align-items:center;
                justify-content:center;
                color:#999;
                font-size:14px;
              ">
                Tidak ada thumbnail
              </div>
            @endif
          </div>

          {{-- Content --}}
          <div style="padding:18px;">
            <div style="font-size:13px;color:#777;margin-bottom:8px;">
              {{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}
            </div>

            <h3 style="margin:0 0 10px;font-size:18px;font-weight:800;line-height:1.3;">
              {{ Str::limit($post->title, 55) }}
            </h3>

            <p style="color:#555;font-size:14px;line-height:1.5;margin:0;">
              {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 90) }}
            </p>

            <div style="margin-top:14px;font-size:14px;font-weight:700;color:#1a7f37;">
              Baca Selengkapnya →
            </div>
          </div>

        </a>
      @endforeach
    </div>

    <div style="text-align:center;margin-top:35px;">
      <a href="{{ route('berita.index') }}" style="
        display:inline-block;
        padding:12px 25px;
        background:#1a7f37;
        color:#fff;
        border-radius:30px;
        font-weight:700;
        text-decoration:none;
        box-shadow:0 8px 20px rgba(26,127,55,.25);
      ">
        Lihat Semua Berita →
      </a>
    </div>

  @else
    <p style="text-align:center;color:#777;font-size:16px;">Belum ada berita.</p>
    <div style="text-align:center;margin-top:20px;">
      <a href="{{ route('berita.index') }}" style="font-weight:700;color:#1a7f37;text-decoration:none;">
        Lihat Semua Berita →
      </a>
    </div>
  @endif
</section>
