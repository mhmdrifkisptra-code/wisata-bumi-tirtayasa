@extends('admin.layouts.app')
@section('title','Edit Foto')
@section('page_title','Edit Foto')

@section('content')
<div class="max-w-2xl">
  <form method="POST" action="{{ route('admin.galeri.update', $galeri) }}" enctype="multipart/form-data"
        class="rounded-3xl border border-white/10 bg-white/5 p-6 space-y-4">
    @csrf
    @method('PATCH')

    <div>
      <label class="text-sm text-white/70">Judul (opsional)</label>
      <input name="title" value="{{ old('title', $galeri->title) }}"
             class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white">
    </div>

    <div>
      <label class="text-sm text-white/70">Caption (opsional)</label>
      <textarea name="caption" rows="4"
                class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white">{{ old('caption', $galeri->caption) }}</textarea>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="text-sm text-white/70">Urutan</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $galeri->sort_order) }}"
               class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white">
      </div>

      <label class="flex items-center gap-2 text-sm text-white/80 mt-7">
        <input type="checkbox" name="is_active" {{ old('is_active', $galeri->is_active) ? 'checked' : '' }}>
        Aktifkan
      </label>
    </div>

    <div>
      <label class="text-sm text-white/70">Gambar Baru (opsional)</label>
      <input type="file" name="image"
             class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white">
      @if($galeri->image)
        <p class="mt-2 text-sm text-white/70">Gambar saat ini: <span class="font-semibold">{{ $galeri->image }}</span></p>
      @endif
    </div>

    <div class="flex gap-3">
      <button class="px-4 py-2 rounded-2xl bg-white text-slate-950 font-semibold hover:bg-white/90">Simpan</button>
      <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10">
        Kembali
      </a>
    </div>
  </form>
</div>
@endsection
