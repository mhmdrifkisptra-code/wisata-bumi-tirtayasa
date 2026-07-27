@php
  $is = fn($name) => request()->routeIs($name);
  $link = fn($active) => $active
      ? 'bg-white/10 text-white border-white/10'
      : 'text-white/70 hover:text-white hover:bg-white/5 border-transparent';
@endphp

<aside
    class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-950 border-r border-white/10 transform transition-transform duration-300 ease-in-out
           -translate-x-full lg:translate-x-0 lg:static lg:inset-auto lg:z-auto lg:w-72 shrink-0"
    :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
>
    <div class="h-full flex flex-col">

        {{-- Header sidebar --}}
        <div class="h-16 px-5 border-b border-white/10 flex items-center justify-between">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 rounded-2xl bg-sky-400 text-slate-950 font-bold flex items-center justify-center shrink-0">
                    A
                </div>
                <div class="min-w-0">
                    <div class="font-bold text-xl leading-tight truncate">ADMIN PANEL</div>
                    <div class="text-sm text-white/60 truncate">Kelola data website</div>
                </div>
            </div>

            {{-- Tombol close mobile --}}
            <button
                type="button"
                class="lg:hidden inline-flex items-center justify-center w-9 h-9 rounded-lg hover:bg-white/10"
                @click="sidebarOpen = false"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Menu --}}
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-2">

            <a href="{{ route('admin.dashboard') }}"
               class="block rounded-2xl px-4 py-3 text-base font-semibold transition
               {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                Dashboard
            </a>

            <div class="pt-4 px-2 text-xs tracking-[0.2em] text-white/40 uppercase">
                Master Data
            </div>

            <a href="{{ route('admin.tiket.index') }}"
               class="block rounded-2xl px-4 py-3 transition
               {{ request()->routeIs('admin.tiket.*') ? 'bg-white/10 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                <div class="font-semibold">Kelola Tiket</div>
                <div class="text-sm text-white/50">Tambah / edit / hapus</div>
            </a>

            <div class="pt-4 px-2 text-xs tracking-[0.2em] text-white/40 uppercase">
                Transaksi
            </div>

            <a href="{{ route('admin.pemesanan.index') }}"
               class="block rounded-2xl px-4 py-3 transition
               {{ request()->routeIs('admin.pemesanan.*') ? 'bg-white/10 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                <div class="font-semibold">Pemesanan</div>
                <div class="text-sm text-white/50">Lihat & verifikasi</div>
            </a>

            <div class="pt-4 px-2 text-xs tracking-[0.2em] text-white/40 uppercase">
                Laporan
            </div>

            <a href="{{ route('admin.laporan.index') }}"
               class="block rounded-2xl px-4 py-3 transition
               {{ request()->routeIs('admin.laporan.*') ? 'bg-white/10 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                <div class="font-semibold">Laporan</div>
                <div class="text-sm text-white/50">Filter & cetak</div>
            </a>

            <div class="pt-4 px-2 text-xs tracking-[0.2em] text-white/40 uppercase">
                Konten
            </div>

            <a href="{{ route('admin.pages.index') }}"
               class="block rounded-2xl px-4 py-3 transition
               {{ request()->routeIs('admin.pages.*') ? 'bg-white/10 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                <div class="font-semibold">Kelola Halaman</div>
                <div class="text-sm text-white/50">Profil / Kontak / Aturan</div>
            </a>

            <a href="{{ route('admin.berita.index') }}"
               class="block rounded-2xl px-4 py-3 transition
               {{ request()->routeIs('admin.berita.*') ? 'bg-white/10 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                <div class="font-semibold">Berita</div>
                <div class="text-sm text-white/50">Kelola berita wisata</div>
            </a>

            <a href="{{ route('admin.galeri.index') }}"
               class="block rounded-2xl px-4 py-3 transition
               {{ request()->routeIs('admin.galeri.*') ? 'bg-white/10 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                <div class="font-semibold">Galeri</div>
                <div class="text-sm text-white/50">Kelola foto & gambar</div>
            </a>
        </nav>
    </div>
</aside>
