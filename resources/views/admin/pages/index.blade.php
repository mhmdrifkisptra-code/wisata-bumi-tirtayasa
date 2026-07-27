@extends('admin.layouts.app')

@section('title', 'Kelola Halaman')
@section('page_title', 'Kelola Halaman')

@section('content')
<div class="flex flex-col gap-6">
    <div>
        <div class="text-white/60 text-sm">CMS Mini</div>
        <h1 class="text-2xl font-bold">Kelola Halaman Website</h1>
        <p class="text-white/60 mt-1">Admin bisa ubah isi Profil/Kontak/Aturan/Peta dari sini.</p>
    </div>

    @if(session('success'))
        <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-3xl border border-white/10 bg-white/5 overflow-hidden">
        <div class="p-5 border-b border-white/10 font-semibold">Daftar Halaman</div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-white/60">
                    <tr class="border-b border-white/10">
                        <th class="text-left font-medium px-5 py-4">Slug</th>
                        <th class="text-left font-medium px-5 py-4">Judul</th>
                        <th class="text-left font-medium px-5 py-4">Status</th>
                        <th class="text-right font-medium px-5 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-white/90">
                    @forelse($pages as $p)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition">
                            <td class="px-5 py-4 font-semibold">{{ $p->slug }}</td>
                            <td class="px-5 py-4">{{ $p->title }}</td>
                            <td class="px-5 py-4">
                                @if($p->is_active)
                                    <span class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1 text-xs text-emerald-200">
                                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-white/70">
                                        <span class="h-2 w-2 rounded-full bg-white/40"></span> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('admin.pages.edit', $p->id) }}"
                                   class="px-3 py-2 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 transition text-sm">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-5 py-10 text-center text-white/60">Belum ada halaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
