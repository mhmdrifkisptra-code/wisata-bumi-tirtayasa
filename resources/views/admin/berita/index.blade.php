@extends('admin.layouts.app')
@section('title','Berita')
@section('page_title','Berita')

@section('content')
<div class="flex flex-col gap-6">
  <div class="flex items-end justify-between gap-4">
    <div>
      <div class="text-white/60 text-sm">Konten</div>
      <h1 class="text-2xl font-bold">Berita</h1>
      <p class="text-white/60 mt-1">Tambah & kelola berita website.</p>
    </div>
    <a href="{{ route('admin.berita.create') }}"
       class="px-4 py-2 rounded-2xl bg-white text-slate-950 font-semibold hover:bg-white/90">+ Tambah Berita</a>
  </div>

  @if(session('success'))
    <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-emerald-200">
      {{ session('success') }}
    </div>
  @endif

  <div class="rounded-3xl border border-white/10 bg-white/5 overflow-hidden">
    <div class="p-5 border-b border-white/10 font-semibold">Daftar Berita</div>

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="text-white/60">
          <tr class="border-b border-white/10">
            <th class="px-5 py-4 text-left font-medium">Judul</th>
            <th class="px-5 py-4 text-left font-medium">Status</th>
            <th class="px-5 py-4 text-left font-medium">Tanggal</th>
            <th class="px-5 py-4 text-right font-medium">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-white/90">
          @forelse($posts as $p)
            <tr class="border-b border-white/5 hover:bg-white/5 transition">
              <td class="px-5 py-4">
                <div class="font-semibold text-white">{{ $p->title }}</div>
                <div class="text-xs text-white/50">{{ $p->slug }}</div>
              </td>
              <td class="px-5 py-4">
                @if($p->is_published)
                  <span class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1 text-xs text-emerald-200">
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span> Publish
                  </span>
                @else
                  <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-white/70">
                    <span class="h-2 w-2 rounded-full bg-white/40"></span> Draft
                  </span>
                @endif
              </td>
              <td class="px-5 py-4 text-white/80">
                {{ optional($p->published_at)->format('d M Y') ?? '-' }}
              </td>
              <td class="px-5 py-4">
                <div class="flex justify-end gap-2">
                  <a href="{{ route('admin.berita.edit', $p->id) }}"
                     class="px-3 py-2 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10">Edit</a>
                  <form method="POST" action="{{ route('admin.berita.destroy', $p->id) }}"
                        onsubmit="return confirm('Hapus berita ini?')">
                    @csrf @method('DELETE')
                    <button class="px-3 py-2 rounded-xl border border-rose-500/30 bg-rose-500/10 text-rose-200 hover:bg-rose-500/20">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="4" class="px-5 py-10 text-center text-white/60">Belum ada berita.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="p-5 border-t border-white/10 text-white/80">
      {{ $posts->links() }}
    </div>
  </div>
</div>
@endsection
