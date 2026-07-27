@extends('layouts.site')
@section('title','Tiket Masuk')

@section('content')

{{-- HERO --}}
<div class="page-hero page-hero--tiket">
  <div class="page-hero__overlay"></div>
  <div class="page-hero__content section">
    <h1>Tiket Masuk</h1>
    <p>Informasi harga tiket & jam operasional.</p>
  </div>
</div>

{{-- CONTENT --}}
<div class="section" style="max-width:1000px;">

  {{-- GRID HARGA --}}
  <div class="tiket-grid">

    <div class="tiket-card">
      <h3>Harga Tiket Wisata</h3>
      <ul class="tiket-list">
        <li><span>Dewasa</span><strong>Rp 5.000</strong></li>
        <li><span>Anak-anak</span><strong>Rp 5.000</strong></li>
        <li><span>Anak di bawah 3 th</span><strong>Gratis</strong></li>
      </ul>
    </div>

    <div class="tiket-card">
      <h3>Harga Tiket Kolam Renang</h3>
      <ul class="tiket-list">
        <li><span>Dewasa & Anak-Anak</span><strong>Rp 15.000</strong></li>
      </ul>
      <p class="tiket-note">*Harga bisa berubah sewaktu-waktu.</p>
    </div>

    <div class="tiket-card">
      <h3>Jam Operasional</h3>
      <ul class="tiket-list">
        <li><span>Senin–Jumat</span><strong>08:35 - 17:00</strong></li>
        <li><span>Sabtu–Minggu</span><strong>09:00 - 17:00</strong></li>
      </ul>
    </div>

  </div>

  {{-- CTA PESAN TIKET --}}
  <div class="tiket-action"
       style="text-align:center;margin-top:48px;padding:32px;border-radius:16px;
              background:linear-gradient(135deg,#f7f9fc,#eef2f7);">

    <h2 style="margin-bottom:10px;">Siap Berkunjung?</h2>
    <p style="color:#666;margin-bottom:20px;">
      Pesan tiket sekarang dan nikmati wisata di Bumi Tirtayasa.
    </p>

   <a href="{{ route('booking.create') }}" class="btn-primary">
  🎟️ Pesan Tiket Sekarang
</a>

  </div>

</div>

@endsection
