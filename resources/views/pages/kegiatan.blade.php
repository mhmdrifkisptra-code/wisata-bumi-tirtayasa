{{-- resources/views/pages/kegiatan.blade.php --}}
@extends('layouts.site')


@section('title', 'Kegiatan - Wisata Bumi Tirtayasa')

@section('content')
<div class="container py-5">

  {{-- Header --}}
  <div class="mb-4">
    <h1 class="fw-bold display-6 mb-1">Kegiatan</h1>
    <p class="text-muted mb-0">Agenda kegiatan & event di Wisata Bumi Tirtayasa.</p>
  </div>

  {{-- Data contoh (sementara hardcode). Nanti bisa diganti dari database --}}
  @php
    $kegiatan = [
      [
  'judul' => 'Peresmian Wisata Bumi Tirtayasa',
  'tanggal' => '16 Maret 2023',
  'lokasi' => 'Area utama Wisata Bumi Tirtayasa',
  'tipe' => 'pihak_ketiga',
  'deskripsi' => 'Peresmian Wisata Bumi Tirtayasa oleh Bupati Serang.',
  'sumber_nama' => 'Diskominfosatik Kab. Serang',
  'sumber_link' => 'https://diskominfosatik.serangkab.go.id/baca/bupati-serang-resmikan-wisata-bumi-tirtayasa',
     ],

      [
        'judul' => 'Festival Kuliner Lokal',
        'tanggal' => 'Coming Soon',
        'lokasi' => 'Lapangan / area UMKM',
        'tipe' => 'rencana',
        'deskripsi' => 'Rencana event kuliner lokal dengan tenant UMKM (jadwal akan diumumkan).',
        'sumber_nama' => null,
        'sumber_link' => null,
      ],
      [
        'judul' => 'Camping Komunitas X',
        'tanggal' => '10 Jan 2026',
        'lokasi' => 'Camping Ground Bumi Tirtayasa',
        'tipe' => 'pihak_ketiga',
        'deskripsi' => 'Info kegiatan komunitas yang diadakan di Bumi Tirtayasa (cek pengumuman resmi komunitas).',
        'sumber_nama' => 'Instagram @komunitasX',
        'sumber_link' => 'https://instagram.com/komunitasX',
      ],
    ];

    function badge($tipe) {
      return match($tipe) {
        'resmi' => ['text' => 'Resmi', 'class' => 'bg-success'],
        'rencana' => ['text' => 'Rencana', 'class' => 'bg-warning text-dark'],
        'pihak_ketiga' => ['text' => 'Info Pihak Ketiga', 'class' => 'bg-info text-dark'],
        default => ['text' => 'Info', 'class' => 'bg-secondary'],
      };
    }
  @endphp

  {{-- List Kegiatan --}}
  <div class="card shadow-sm border-0">
    <div class="card-body p-4">

      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th style="min-width: 260px;">Kegiatan</th>
              <th style="min-width: 140px;">Tanggal</th>
              <th style="min-width: 180px;">Lokasi</th>
              <th style="min-width: 140px;">Status</th>
              <th style="min-width: 220px;">Sumber</th>
            </tr>
          </thead>
          <tbody>
            @forelse($kegiatan as $item)
              @php $b = badge($item['tipe']); @endphp
              <tr>
                <td>
                  <div class="fw-semibold">{{ $item['judul'] }}</div>
                  <div class="text-muted small">{{ $item['deskripsi'] }}</div>
                </td>

                <td class="fw-semibold">{{ $item['tanggal'] }}</td>

                <td class="text-muted">{{ $item['lokasi'] }}</td>

                <td>
                  <span class="badge {{ $b['class'] }}">{{ $b['text'] }}</span>
                </td>

                <td>
                  @if($item['tipe'] === 'pihak_ketiga' && $item['sumber_link'])
                    <a href="{{ $item['sumber_link'] }}" target="_blank" class="text-decoration-none fw-semibold">
                      {{ $item['sumber_nama'] ?? 'Lihat sumber' }}
                    </a>
                    <div class="text-muted small">Cantumkan sumber untuk info pihak ketiga.</div>
                  @else
                    <span class="text-muted">—</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-muted py-4">
                  Belum ada agenda kegiatan.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Catatan --}}
      <div class="alert alert-light border mt-4 mb-0">
        <div class="fw-semibold mb-1">Catatan</div>
        <ul class="mb-0 text-muted">
          <li><b>Resmi</b>: kegiatan dari pengelola Wisata Bumi Tirtayasa.</li>
          <li><b>Rencana</b>: agenda yang masih “coming soon”.</li>
          <li><b>Info Pihak Ketiga</b>: wajib cantumkan <b>sumber/link</b> dan pastikan event memang diadakan di Bumi Tirtayasa.</li>
        </ul>
      </div>

    </div>
  </div>

</div>
@endsection
