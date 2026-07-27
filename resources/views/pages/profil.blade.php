{{-- resources/views/profil.blade.php --}}
@extends('layouts.app')

@section('title', 'Profil - Wisata Bumi Tirtayasa')

@section('content')
<div class="container py-5">

  {{-- Header --}}
  <div class="text-center mb-5">
    <h1 class="fw-bold display-5">Profil</h1>
    <p class="fw-bold display-7">Wisata Bumi Tirtayasa.</p>
  </div>

  <div class="row g-4">
    {{-- Kolom kiri (Konten utama) --}}
    <div class="col-lg-8">

      {{-- Tentang Kami --}}
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
          <h4 class="fw-bold mb-3">Tentang Wisata Bumi Tirtayasa</h4>
          <p class="mb-0 text-muted">
           Desa Tirtayasa terletak di sebelah utara Provinsi Banten, jaraknya dengan Ibu Kota / Pusat Pemerintahan Kabupaten Serang sekitar 31 km. Dengan luas wilayah sekitar 251 Ha terdiri dari 67 ha Areal Pemukiman dan 184 ha Areal Persawahan. Mayoritas penduduknya bermata pencaharian sebagai petani, terdiri dari petani pemilik, petani penggarap dan buruh tani.   Seperti halnya kebanyakan desa – desa di wilayah utara, topografi lahannya berupa dataran, yang terdiri dari tegalan dan persawahan.
Desa Tirtayasa merupakan tempat berdirinya keraton kesultanan Banten yang dipimpin oleh seorang sultan dengan julukannya yang terkenal yaitu Sultan Ageng Tirtayasa (1651 – 1683). Atas kegigihannya melawan penjajah Belanda, pada masa Pemerintahan Presiden Soeharto Sultan Ageng Tirtayasa ditetapkan menjadi Pahlawan Nasional.



Banten yang pada tahun 2000 lalu memisahkan diri dari Provinsi Jawa Barat, dahulu mencapai puncak kejayaannya pada masa Pemerintahan Sultan Ageng Tirtayasa.  Ketika itu, sawah – sawah baru dicetak, kanal – kanal irigasi pertanian dengan teknologi hidrolik dibuat, sehingga areal pertanian menjadi subur dan wilayah Kesultanan Tirtayasa pada saat itu menjadi lumbung padi wilayah Banten.
          </p>
        </div>
      </div>

      {{-- Sejarah --}}
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
          <h4 class="fw-bold mb-3">Sejarah Singkat</h4>
          <p class="text-muted mb-0">
            Wisata Bumi Tirtayasa dibangun sebagai upaya pengembangan potensi lokal dan pemberdayaan masyarakat sekitar.
            Berawal dari pengelolaan area alam yang memiliki panorama menarik, tempat ini kemudian dikembangkan menjadi
            lokasi wisata dengan fasilitas pendukung agar pengunjung bisa menikmati pengalaman yang lebih lengkap.
          </p>
        </div>
      </div>

      {{-- Visi & Misi --}}
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
          <h4 class="fw-bold mb-3">Visi &amp; Misi</h4>

          <div class="mb-3">
            <h6 class="fw-semibold mb-2">Visi</h6>
            <p class="text-muted mb-0">
              Menjadi destinasi wisata unggulan yang ramah lingkungan, berdaya saing, dan memberi manfaat bagi masyarakat sekitar.
            </p>
          </div>

          <h6 class="fw-semibold mb-2">Misi</h6>
          <ul class="text-muted mb-0">
            <li>Menjaga kelestarian alam dan kebersihan area wisata.</li>
            <li>Meningkatkan kualitas layanan, fasilitas, dan keamanan pengunjung.</li>
            <li>Mengembangkan atraksi wisata yang edukatif dan menarik.</li>
            <li>Memberdayakan masyarakat lokal melalui peluang usaha dan kerja.</li>
          </ul>
        </div>
      </div>

      {{-- Daya Tarik --}}
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
          <h4 class="fw-bold mb-3">Daya Tarik Utama</h4>
          <div class="row g-3">
            <div class="col-md-6">
              <div class="p-3 bg-light rounded-3 h-100">
                <h6 class="fw-semibold mb-1">Panorama Alam</h6>
                <p class="text-muted mb-0">Pemandangan indah dan udara sejuk untuk healing.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 bg-light rounded-3 h-100">
                <h6 class="fw-semibold mb-1">Spot Foto</h6>
                <p class="text-muted mb-0">Berbagai sudut menarik untuk dokumentasi.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 bg-light rounded-3 h-100">
                <h6 class="fw-semibold mb-1">Area Santai</h6>
                <p class="text-muted mb-0">Cocok untuk keluarga dan kumpul komunitas.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 bg-light rounded-3 h-100">
                <h6 class="fw-semibold mb-1">Wahana &amp; Aktivitas</h6>
                <p class="text-muted mb-0">Aktivitas seru (sesuaikan dengan yang ada).</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    {{-- Kolom kanan (Info cepat) --}}
    <div class="col-lg-4">
      {{-- Info Lokasi --}}
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
          <h5 class="fw-bold mb-3">Informasi</h5>

          <div class="mb-3">
            <div class="text-muted small">Alamat</div>
            <div class="fw-semibold">Desa Tirtayasa, Kecamatan Tirtayasa, Kabupaten Serang.</div>
          </div>

          <div class="mb-3">
            <div class="text-muted small">Jam Operasional</div>
            <div class="fw-semibold">Setiap hari, 08.00 – 17.00</div>
          </div>

          <div class="mb-3">
            <div class="text-muted small">Harga Tiket</div>
            <div class="fw-semibold">Rp 5000 / orang</div>
          </div>

          <hr class="my-3">

          <h6 class="fw-semibold mb-2">Fasilitas</h6>
          <ul class="text-muted mb-0">
            <li>Area parkir</li>
            <li>Toilet</li>
            <li>Mushola</li>
            <li>Warung / Kafe</li>
            <li>Gazebo / Tempat duduk</li>
          </ul>
        </div>
      </div>

      {{-- Kontak --}}
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
          <h5 class="fw-bold mb-3">Kontak</h5>

          <div class="mb-2">
            <div class="text-muted small">WhatsApp</div>
            <a class="fw-semibold text-decoration-none" href="https://wa.me/62XXXXXXXXXXX" target="_blank">
              +62 858-9332-5848
            </a>
          </div>

          <div class="mb-2">
            <div class="text-muted small">Email</div>
            <a class="fw-semibold text-decoration-none" href="mailto:email@domain.com">
              Bumitirtayasa@gmail.com
            </a>
          </div>

          <div>
            <div class="text-muted small">Instagram</div>
            <a class="fw-semibold text-decoration-none" href="https://instagram.com/username" target="_blank">
             https://www.instagram.com/bumitirtayasa?igsh=MTk0MDFzdGF2ejJxeQ==
            </a>
          </div>
        </div>
      </div>

      {{-- Maps --}}
      <div class="card shadow-sm border-0">
        <div class="card-body p-4">
          <h5 class="fw-bold mb-3">Lokasi</h5>

          {{-- Ganti src iframe ini dengan embed Google Maps lokasi kamu --}}
          <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
            <iframe
              src="https://www.google.com/maps?q=Indonesia&output=embed"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          <a class="btn btn-outline-dark w-100 mt-3"
             href="https://www.google.com/maps"
             target="https://maps.app.goo.gl/QQAH94AA5fDmtSqV9">
            Buka di Google Maps
          </a>
        </div>
      </div>

    </div>
  </div>

</div>
@endsection
