@extends('admin.layouts.app')
@section('title','Tambah Foto')
@section('page_title','Tambah Foto')

@section('content')
<div class="max-w-2xl">
  <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data"
        class="rounded-3xl border border-white/10 bg-white/5 p-6 space-y-4">
    @csrf

    <div>
      <label class="text-sm text-white/70">Judul (opsional)</label>
      <input name="title" value="{{ old('title') }}"
             class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white">
    </div>

    <div>
      <label class="text-sm text-white/70">Caption (opsional)</label>
      <textarea name="caption" rows="4"
                class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white">{{ old('caption') }}</textarea>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="text-sm text-white/70">Urutan</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
               class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white">
      </div>

      <label class="flex items-center gap-2 text-sm text-white/80 mt-7">
        <input type="checkbox" name="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
        Aktifkan
      </label>
    </div>

    <div>
      <label class="text-sm text-white/70">Foto (jpg/png/webp)</label>
      <input type="file" name="image" required
             class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white">
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
