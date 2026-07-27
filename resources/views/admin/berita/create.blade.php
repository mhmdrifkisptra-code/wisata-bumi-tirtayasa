@extends('admin.layouts.app')
@section('title','Tambah Berita')
@section('page_title','Tambah Berita')

@section('content')
<div class="max-w-3xl">
  <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data"
        class="rounded-3xl border border-white/10 bg-white/5 p-6 space-y-4">
    @csrf

    <div>
      <label class="text-sm text-white/70">Judul</label>
      <input name="title" value="{{ old('title') }}" required
             class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white">
    </div>

    <div>
      <label class="text-sm text-white/70">Ringkasan (opsional)</label>
      <input name="excerpt" value="{{ old('excerpt') }}"
             class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white">
    </div>

    <div>
      <label class="text-sm text-white/70">Konten</label>
      <textarea name="content" rows="10"
                class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white">{{ old('content') }}</textarea>
    </div>

    <div>
      <label class="text-sm text-white/70">Thumbnail (jpg/png/webp)</label>
      <input type="file" name="thumbnail"
             class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white">
    </div>

    <label class="flex items-center gap-2 text-sm text-white/80">
      <input type="checkbox" name="is_published" {{ old('is_published') ? 'checked' : '' }}>
      Publish sekarang
    </label>

    <div class="flex gap-3">
      <button class="px-4 py-2 rounded-2xl bg-white text-slate-950 font-semibold hover:bg-white/90">Simpan</button>
      <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10">
        Kembali
      </a>
    </div>
  </form>
</div>
@endsection
