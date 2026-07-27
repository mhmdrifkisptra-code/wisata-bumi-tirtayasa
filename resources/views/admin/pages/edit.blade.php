@extends('admin.layouts.app')

@section('title', 'Edit Halaman')
@section('page_title', 'Edit Halaman')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <div class="text-white/60 text-sm">Edit Konten</div>
        <h1 class="text-2xl font-bold">{{ $page->title }}</h1>
        <p class="text-white/60 mt-1">Slug: <b>{{ $page->slug }}</b></p>
    </div>

    @if ($errors->any())
        <div class="mb-5 rounded-2xl border border-rose-500/20 bg-rose-500/10 px-4 py-3 text-rose-200">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.pages.update', $page->id) }}"
          class="rounded-3xl border border-white/10 bg-white/5 p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="text-sm text-white/70">Judul</label>
            <input name="title" value="{{ old('title', $page->title) }}"
                   class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/40">
        </div>

        <div>
            <label class="text-sm text-white/70">Konten</label>
            <textarea name="content" rows="10"
                      class="mt-2 w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-2 text-sm text-white placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                      placeholder="Tulis isi halaman...">{{ old('content', $page->content) }}</textarea>
            <div class="text-xs text-white/40 mt-2">Konten ini akan tampil di halaman publik.</div>
        </div>

        <label class="flex items-center gap-2 text-sm text-white/80">
            <input type="checkbox" name="is_active" {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
            Aktifkan halaman
        </label>

        <div class="flex gap-3">
            <button class="px-4 py-2 rounded-2xl bg-white text-slate-950 font-semibold hover:bg-white/90 transition">
                Simpan
            </button>
            <a href="{{ route('admin.pages.index') }}"
               class="px-4 py-2 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 transition">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
