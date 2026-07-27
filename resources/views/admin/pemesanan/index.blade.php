@extends('admin.layouts.app')

@section('title', 'Pemesanan')
@section('page_title', 'Pemesanan')

@section('content')
@php
    use Illuminate\Support\Carbon;

    $items = collect();
    $paginator = null;

    $total = 0;
    $today = 0;

    try {
        if (class_exists(\App\Models\Booking::class)) {
            $paginator = \App\Models\Booking::latest()->paginate(10);
            $items = $paginator;

            $total = \App\Models\Booking::count();
            $today = \App\Models\Booking::whereDate('created_at', Carbon::today())->count();
        }
    } catch (\Throwable $e) {
        // aman kalau model/tabel belum siap
    }
@endphp

<div class="flex flex-col gap-6">

    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
            <div class="text-white/60 text-sm">Transaksi</div>
            <h1 class="text-2xl font-bold">Pemesanan</h1>
            <p class="text-white/60 mt-1">Daftar pemesanan terbaru dan statusnya.</p>
        </div>

        <div class="flex gap-3">
            <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2">
                <div class="text-xs text-white/50">Total</div>
                <div class="text-lg font-bold">{{ $total }}</div>
            </div>
            <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2">
                <div class="text-xs text-white/50">Hari ini</div>
                <div class="text-lg font-bold">{{ $today }}</div>
            </div>
        </div>
    </div>

    <div class="rounded-3xl border border-white/10 bg-white/5 overflow-hidden">
        <div class="p-5 border-b border-white/10 flex items-center justify-between">
            <div class="font-semibold">Pemesanan Terbaru</div>
            <div class="text-sm text-white/60">
                @if($paginator) Menampilkan {{ $paginator->count() }} data @else - @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-white/60">
                    <tr class="border-b border-white/10">
                        <th class="text-left font-medium px-5 py-4">Kode</th>
                        <th class="text-left font-medium px-5 py-4">Nama</th>
                        <th class="text-left font-medium px-5 py-4">Tanggal</th>
                        <th class="text-left font-medium px-5 py-4">Status</th>
                        <th class="text-right font-medium px-5 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-white/90">
                    @forelse($items as $b)
                        @php
                            // aman walau kolom beda-beda
                            $code   = data_get($b, 'code') ?? data_get($b, 'booking_code') ?? data_get($b, 'id');
                            $name   = data_get($b, 'name') ?? data_get($b, 'customer_name') ?? '-';
                            $date   = data_get($b, 'visit_date') ?? data_get($b, 'date') ?? data_get($b, 'created_at');
                            $status = data_get($b, 'status') ?? data_get($b, 'payment_status') ?? (data_get($b,'is_paid') ? 'paid' : 'pending');
                            $statusLower = strtolower((string)$status);
                        @endphp

                        <tr class="border-b border-white/5 hover:bg-white/5 transition">
                            <td class="px-5 py-4 font-semibold">{{ $code }}</td>
                            <td class="px-5 py-4">
                                <div class="font-semibold text-white">{{ $name }}</div>
                                <div class="text-xs text-white/50">ID: {{ data_get($b,'id') }}</div>
                            </td>
                            <td class="px-5 py-4 text-white/80">
                                {{ $date ? \Illuminate\Support\Carbon::parse($date)->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="px-5 py-4">
                                @if(str_contains($statusLower,'paid') || str_contains($statusLower,'success') || str_contains($statusLower,'lunas'))
                                    <span class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1 text-xs text-emerald-200">
                                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                                        {{ $status }}
                                    </span>
                                @elseif(str_contains($statusLower,'cancel') || str_contains($statusLower,'batal'))
                                    <span class="inline-flex items-center gap-2 rounded-full border border-rose-500/20 bg-rose-500/10 px-3 py-1 text-xs text-rose-200">
                                        <span class="h-2 w-2 rounded-full bg-rose-400"></span>
                                        {{ $status }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-white/70">
                                        <span class="h-2 w-2 rounded-full bg-white/40"></span>
                                        {{ $status }}
                                    </span>
                                @endif
                            </td>
                           <td class="px-5 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.pemesanan.show', $b->id) }}"
                                    class="px-3 py-2 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 transition text-sm">
                                    Detail
                                </a>
                            </div>
                         </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-white/60">
                                Belum ada data pemesanan (atau model Booking belum dibuat).
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($paginator)
            <div class="p-5 border-t border-white/10 text-white/80">
                {{ $paginator->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
