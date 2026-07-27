@extends('admin.layouts.app')
@section('title','Galeri')
@section('page_title','Galeri')

@section('content')
<div class="flex flex-col gap-6">
  <div class="flex items-end justify-between gap-4">
    <div>
      <div class="text-white/60 text-sm">Konten</div>
      <h1 class="text-2xl font-bold">Galeri</h1>
      <p class="text-white/60 mt-1">Upload & kelola foto galeri.</p>
    </div>
    <a href="{{ route('admin.galeri.create') }}"
       class="px-4 py-2 rounded-2xl bg-white text-slate-950 font-semibold hover:bg-white/90">+ Tambah Foto</a>
  </div>

  @if(session('success'))
    <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-emerald-200">
      {{ session('success') }}
    </div>
  @endif

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($items as $g)
      <div class="rounded-3xl border border-white/10 bg-white/5 overflow-hidden">
        <div class="aspect-[16/10] bg-black/30 overflow-hidden">
          <img class="w-full h-full object-cover"
               src="{{ asset('storage/'.$g->image) }}" alt="">
        </div>

        <div class="p-4">
          <div class="font-semibold text-white">{{ $g->title ?? 'Untitled' }}</div>
          <div class="text-sm text-white/60 mt-1 line-clamp-2">{{ $g->caption }}</div>

          <div class="mt-3 flex items-center justify-between">
            <span class="text-xs text-white/60">Order: {{ $g->sort_order }}</span>
            <div class="flex gap-2">
              <a href="{{ route('admin.galeri.edit', $g->id) }}"
                 class="px-3 py-2 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 text-sm">Edit</a>
              <form method="POST" action="{{ route('admin.galeri.destroy', $g->id) }}"
                    onsubmit="return confirm('Hapus foto ini?')">
                @csrf @method('DELETE')
                <button class="px-3 py-2 rounded-xl border border-rose-500/30 bg-rose-500/10 text-rose-200 hover:bg-rose-500/20 text-sm">
                  Hapus
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="text-white/60">Belum ada foto galeri.</div>
    @endforelse
  </div>

  <div class="text-white/80">
    {{ $items->links() }}
  </div>
</div>
@endsection
