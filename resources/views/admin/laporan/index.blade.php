@extends('admin.layouts.app')

@section('title', 'Laporan')
@section('page_title', 'Laporan')

@section('content')
@php
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Schema;

    $from = request('from') ? Carbon::parse(request('from'))->startOfDay() : Carbon::now()->subDays(7)->startOfDay();
    $to   = request('to') ? Carbon::parse(request('to'))->endOfDay() : Carbon::now()->endOfDay();

    $count = 0;
    $sum = 0;
    $sumCol = null;

    try {
        if (class_exists(\App\Models\Booking::class)) {
            $model = new \App\Models\Booking();
            $table = $model->getTable();

            $candidates = ['total', 'total_price', 'grand_total', 'amount', 'price_total'];
            foreach ($candidates as $col) {
                if (Schema::hasColumn($table, $col)) { $sumCol = $col; break; }
            }

            $q = \App\Models\Booking::whereBetween('created_at', [$from, $to]);
            $count = $q->count();
            if ($sumCol) $sum = (float) $q->sum($sumCol);
        }
    } catch (\Throwable $e) {}
@endphp

<div class="flex flex-col gap-6">

    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
            <div class="text-white/60 text-sm">Rekap</div>
            <h1 class="text-2xl font-bold">Laporan</h1>
            <p class="text-white/60 mt-1">Filter periode dan lihat ringkasan.</p>
        </div>

        <form class="flex flex-col sm:flex-row gap-3" method="GET">
            <input type="date" name="from" value="{{ $from->toDateString() }}"
                   class="rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/40">
            <input type="date" name="to" value="{{ $to->toDateString() }}"
                   class="rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/40">

            <button class="px-4 py-2 rounded-2xl bg-white text-slate-950 font-semibold hover:bg-white/90 transition">
                Terapkan
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
            <div class="text-xs text-white/50">Periode</div>
            <div class="mt-1 font-semibold">{{ $from->format('d M Y') }} — {{ $to->format('d M Y') }}</div>
        </div>

        <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
            <div class="text-xs text-white/50">Total Pemesanan</div>
            <div class="mt-1 text-2xl font-bold">{{ $count }}</div>
        </div>

        <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
            <div class="text-xs text-white/50">Total Pendapatan</div>
            <div class="mt-1 text-2xl font-bold">
                Rp {{ number_format($sum, 0, ',', '.') }}
            </div>
            <div class="text-xs text-white/40 mt-1">
                @if($sumCol) dihitung dari kolom <b>{{ $sumCol }}</b> @else (kolom total belum terdeteksi) @endif
            </div>
        </div>
    </div>

    <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
        <div class="flex items-center justify-between gap-3">
            <div>
                <div class="font-semibold">Aksi Laporan</div>
                <div class="text-sm text-white/60">Nanti bisa kita tambahin fitur cetak PDF / export Excel.</div>
            </div>
            <button disabled class="px-4 py-2 rounded-2xl border border-white/10 bg-white/5 text-white/50 cursor-not-allowed">
                Cetak (Coming soon)
            </button>
        </div>
    </div>
</div>
@endsection
