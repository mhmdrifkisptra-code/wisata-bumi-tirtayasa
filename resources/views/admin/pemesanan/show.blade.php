@extends('admin.layouts.app')

@section('title', 'Detail Pemesanan')
@section('page_title', 'Pemesanan')

@section('content')
@php
    $status = $booking->status ?? 'pending';

    $statusMap = [
        'pending'   => 'bg-white/10 text-white/80 border-white/10',
        'confirmed' => 'bg-sky-500/10 text-sky-200 border-sky-500/20',
        'paid'      => 'bg-emerald-500/10 text-emerald-200 border-emerald-500/20',
        'cancelled' => 'bg-rose-500/10 text-rose-200 border-rose-500/20',
    ];
    $badgeClass = $statusMap[$status] ?? $statusMap['pending'];

    $items = $booking->items ?? collect();

    // total pakai kolom booking->total kalau ada
    $grandTotal = $booking->total ?? $items->sum(fn($it) => ($it->subtotal ?? ($it->qty * $it->price)));
@endphp

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div>
            <div class="text-white/50 text-sm">Transaksi</div>
            <div class="mt-1 flex items-center gap-3">
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">Detail Pemesanan</h1>
                <span class="px-3 py-1 rounded-full border text-xs font-semibold {{ $badgeClass }}">
                    {{ strtoupper($status) }}
                </span>
            </div>
            <div class="mt-2 text-white/70 text-sm">
                Kode: <span class="font-semibold text-white">{{ $booking->code }}</span>
                <span class="text-white/30">•</span>
                Kunjungan: {{ optional($booking->visit_date)->format('d M Y') ?? '-' }}
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.pemesanan.index') }}"
               class="px-4 py-2 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 transition">
                ← Kembali
            </a>

            {{-- Update status --}}
            <form method="POST" action="{{ route('admin.pemesanan.status', $booking->id) }}" class="flex items-center gap-2">
                @csrf
                @method('PATCH')

                <select name="status"
                        class="rounded-2xl border border-white/10 bg-slate-950/60 px-3 py-2 text-sm text-white/90">
                    <option value="pending"   @selected($status==='pending')>pending</option>
                    <option value="confirmed" @selected($status==='confirmed')>confirmed</option>
                    <option value="paid"      @selected($status==='paid')>paid</option>
                    <option value="cancelled" @selected($status==='cancelled')>cancelled</option>
                </select>

                <button class="px-4 py-2 rounded-2xl bg-white text-slate-950 font-semibold hover:bg-white/90 transition">
                    Simpan
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- Cards --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Pemesan --}}
        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
            <div class="text-white/60 text-sm">Data Pemesan</div>
            <div class="mt-3 space-y-2 text-sm">
                <div>
                    <div class="text-white/50">Nama</div>
                    <div class="font-semibold text-white">{{ optional($booking->user)->name ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-white/50">Email</div>
                    <div class="text-white/90">{{ optional($booking->user)->email ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-white/50">User ID</div>
                    <div class="text-white/90">{{ $booking->user_id ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- Pembayaran --}}
        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
            <div class="text-white/60 text-sm">Pembayaran</div>
            <div class="mt-3 space-y-2 text-sm">
                <div>
                    <div class="text-white/50">Payment Type</div>
                    <div class="text-white/90 font-semibold">{{ $booking->payment_type ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-white/50">Payment Status</div>
                    <div class="text-white/90">{{ $booking->payment_status ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-white/50">Snap Token</div>
                    <div class="text-white/90 break-all">{{ $booking->snap_token ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- Ringkasan --}}
        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
            <div class="text-white/60 text-sm">Ringkasan</div>
            <div class="mt-3 space-y-3">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-white/60">Item</span>
                    <span class="text-white/90">{{ $items->count() }}</span>
                </div>

                <div class="h-px bg-white/10"></div>

                <div class="flex items-center justify-between">
                    <span class="text-white/70 font-semibold">Total</span>
                    <span class="text-white font-extrabold text-xl">
                        Rp {{ number_format($grandTotal,0,',','.') }}
                    </span>
                </div>
            </div>
        </div>

    </div>

    {{-- Items table --}}
    <div class="rounded-3xl border border-white/10 bg-white/5 overflow-hidden">
        <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
            <div>
                <div class="text-white font-semibold">Item Tiket</div>
                <div class="text-white/50 text-sm">Detail tiket yang dipesan.</div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-white/60">
                    <tr class="border-b border-white/10">
                        <th class="text-left px-6 py-3">Tiket</th>
                        <th class="text-left px-6 py-3">Harga</th>
                        <th class="text-left px-6 py-3">Qty</th>
                        <th class="text-left px-6 py-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($items as $it)
                    <tr class="border-b border-white/10">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-white">{{ optional($it->ticketType)->name ?? '-' }}</div>
                            <div class="text-white/40 text-xs">Item ID: {{ $it->id }}</div>
                        </td>
                        <td class="px-6 py-4 text-white/90">
                            Rp {{ number_format($it->price ?? 0,0,',','.') }}
                        </td>
                        <td class="px-6 py-4 text-white/90">
                            {{ $it->qty ?? 0 }}
                        </td>
                        <td class="px-6 py-4 text-white/90 font-semibold">
                            Rp {{ number_format($it->subtotal ?? (($it->qty ?? 0) * ($it->price ?? 0)),0,',','.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-6 text-white/60">
                            Belum ada item pada pemesanan ini.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
