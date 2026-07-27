@extends('layouts.site')
@section('title','Peta Lokasi')

@section('content')
<div class="section" style="max-width:1000px;">
  <h1>Peta Lokasi</h1>
  <p style="color:#666;margin:10px 0 16px;">Arah menuju Wisata Bumi Tirtayasa.</p>

 <div style="border-radius:14px;overflow:hidden;border:1px solid #eee;">
  <iframe
    src="https://www.google.com/maps?q=-6.022476,106.3204239&z=15&output=embed"
    width="100%"
    height="420"
    style="border:0;"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>
</div>


  <div style="margin-top:14px;">
    <a class="btn-hero" target="_blank" href="https://maps.app.goo.gl/QQAH94AA5fDmtSqV9">Buka di Google Maps</a>
  </div>
</div>
@endsection
