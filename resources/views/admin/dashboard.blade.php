@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl sm:text-3xl font-bold">
            Home
        </h1>
        <p class="text-white/60 mt-1">
            Selamat datang, Admin.
        </p>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
            <p class="text-sm text-white/60">Total Tiket</p>
            <h2 class="text-3xl font-bold mt-2">25</h2>
        </div>

        <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
            <p class="text-sm text-white/60">Total Pemesanan</p>
            <h2 class="text-3xl font-bold mt-2">128</h2>
        </div>

        <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
            <p class="text-sm text-white/60">Pendapatan</p>
            <h2 class="text-2xl font-bold mt-2">
                Rp 12.500.000
            </h2>
        </div>

        <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
            <p class="text-sm text-white/60">Pembayaran Sukses</p>
            <h2 class="text-3xl font-bold mt-2">85</h2>
        </div>

    </div>

</div>
@endsection
