@extends('layouts.site')

@section('title', 'Kegiatan - Wisata Bumi Tirtayasa')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h1 class="fw-bold mb-1">Kegiatan</h1>
        <p class="text-muted">Agenda kegiatan & event di Wisata Bumi Tirtayasa.</p>
    </div>

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
            'deskripsi' => 'Info kegiatan komunitas yang diadakan di Bumi Tirtayasa.',
            'sumber_nama' => 'Instagram @komunitasX',
            'sumber_link' => 'https://instagram.com/komunitasX',
        ],
    ];
    @endphp

    <div class="d-flex flex-column gap-3">
        @foreach($kegiatan as $item)
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                    <h5 class="fw-bold mb-0">{{ $item['judul'] }}</h5>
                    @php
                        $badge = match($item['tipe']) {
                            'resmi' => ['text' => 'Resmi', 'class' => 'bg-success'],
                            'rencana' => ['text' => 'Rencana', 'class' => 'bg-warning text-dark'],
                            'pihak_ketiga' => ['text' => 'Info Pihak Ketiga', 'class' => 'bg-info text-dark'],
                            default => ['text' => 'Info', 'class' => 'bg-secondary'],
                        };
                    @endphp
                    <span class="badge {{ $badge['class'] }}">{{ $badge['text'] }}</span>
                </div>

                <p class="text-muted small mb-2">{{ $item['deskripsi'] }}</p>

                <div class="d-flex flex-wrap gap-3 small text-muted">
                    <span>📅 {{ $item['tanggal'] }}</span>
                    <span>📍 {{ $item['lokasi'] }}</span>
                </div>

                @if($item['sumber_link'])
                <div class="mt-2">
                    <a href="{{ $item['sumber_link'] }}" target="_blank" class="small fw-semibold text-success text-decoration-none">
                        🔗 {{ $item['sumber_nama'] ?? 'Lihat sumber' }}
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="alert alert-light border mt-4">
        <div class="fw-semibold mb-1">Catatan</div>
        <ul class="mb-0 text-muted small">
            <li><b>Resmi</b>: kegiatan dari pengelola Wisata Bumi Tirtayasa.</li>
            <li><b>Rencana</b>: agenda yang masih "coming soon".</li>
            <li><b>Info Pihak Ketiga</b>: cantumkan sumber dan pastikan event diadakan di Bumi Tirtayasa.</li>
        </ul>
    </div>

</div>
@endsection