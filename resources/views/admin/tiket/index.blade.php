@extends('admin.layouts.app')

@section('title', 'Kelola Tiket')
@section('page_title', 'Kelola Tiket')

@section('content')
<div class="flex flex-col gap-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
            <div class="text-white/60 text-sm">Master Data</div>
            <h1 class="text-2xl font-bold">Kelola Tiket</h1>
            <p class="text-white/60 mt-1">Tambah, edit, aktif/nonaktif, dan hapus tiket.</p>
        </div>

        <div class="flex items-center gap-3">
            {{-- Search (frontend only, placeholder) --}}
            <div class="hidden md:block">
                <input
                    type="text"
                    placeholder="Cari nama tiket..."
                    class="w-64 rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                />
            </div>

            <a href="{{ route('admin.tiket.create') }}"
               class="px-4 py-2 rounded-2xl bg-white text-slate-950 font-semibold hover:bg-white/90 transition">
                + Tambah Tiket
            </a>
        </div>
    </div>

    {{-- Flash success --}}
    @if(session('success'))
        <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table Card --}}
    <div class="rounded-3xl border border-white/10 bg-white/5 overflow-hidden">
        <div class="p-5 border-b border-white/10 flex items-center justify-between">
            <div class="font-semibold">Daftar Tiket</div>
            <div class="text-sm text-white/60">
                Total: <span class="font-semibold text-white">{{ $tickets->total() ?? count($tickets) }}</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-white/60">
                    <tr class="border-b border-white/10">
                        <th class="text-left font-medium px-5 py-4">Nama</th>
                        <th class="text-left font-medium px-5 py-4">Harga</th>
                        <th class="text-left font-medium px-5 py-4">Status</th>
                        <th class="text-right font-medium px-5 py-4">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-white/90">
                    @forelse($tickets as $t)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition">
                            <td class="px-5 py-4">
                                <div class="font-semibold text-white">{{ $t->name }}</div>
                                <div class="text-xs text-white/50">ID: {{ $t->id }}</div>
                            </td>

                            <td class="px-5 py-4">
                                <div class="font-semibold">Rp {{ number_format($t->price, 0, ',', '.') }}</div>
                                <div class="text-xs text-white/50">per tiket</div>
                            </td>

                            <td class="px-5 py-4">
                                @if($t->is_active)
                                    <span class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1 text-xs text-emerald-200">
                                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-white/70">
                                        <span class="h-2 w-2 rounded-full bg-white/40"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.tiket.edit', $t->id) }}"
                                       class="px-3 py-2 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 transition text-sm">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.tiket.destroy', $t->id) }}"
                                          onsubmit="return confirm('Hapus tiket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-2 rounded-xl border border-rose-500/30 bg-rose-500/10 text-rose-200 hover:bg-rose-500/20 transition text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center text-white/60">
                                Belum ada data tiket.
                                <div class="mt-3">
                                    <a href="{{ route('admin.tiket.create') }}"
                                       class="inline-flex px-4 py-2 rounded-2xl bg-white text-slate-950 font-semibold hover:bg-white/90 transition">
                                        + Tambah Tiket Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($tickets, 'links'))
            <div class="p-5 border-t border-white/10 text-white/80">
                {{ $tickets->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
