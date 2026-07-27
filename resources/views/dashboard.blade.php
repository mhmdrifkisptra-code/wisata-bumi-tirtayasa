<x-app-layout>
    <div class="min-h-screen bg-slate-950 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">

            <div class="mb-6 sm:mb-10">
                <p class="text-slate-400 text-xs sm:text-sm">Wisata Bumi Tirtayasa</p>
                <h1 class="text-2xl sm:text-4xl font-bold mt-1">Dashboard User</h1>
                <p class="text-slate-400 mt-2 text-sm sm:text-lg leading-relaxed">
                    Selamat datang, {{ Auth::user()->name }}. Kelola aktivitas pemesanan wisata Anda di sini.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 sm:p-6">
                    <p class="text-slate-400 text-sm">Status Akun</p>
                    <h2 class="text-xl sm:text-2xl font-bold mt-2">Aktif</h2>
                    <p class="text-green-400 text-sm mt-2">Anda sudah login</p>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 sm:p-6">
                    <p class="text-slate-400 text-sm">Riwayat</p>
                    <h2 class="text-xl sm:text-2xl font-bold mt-2">Pemesanan</h2>
                    <p class="text-slate-400 text-sm mt-2">Lihat daftar pemesanan Anda</p>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 sm:p-6">
                    <p class="text-slate-400 text-sm">Notifikasi</p>
                    <h2 class="text-xl sm:text-2xl font-bold mt-2">Admin</h2>
                    <p class="text-slate-400 text-sm mt-2">Cek status berhasil/gagal</p>
                </div>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 sm:p-8">
                <h2 class="text-lg sm:text-2xl font-bold mb-3">Menu Pengguna</h2>
                <p class="text-slate-400 mb-5 text-sm sm:text-base leading-relaxed">
                    Gunakan menu berikut untuk melihat riwayat pemesanan dan status dari admin.
                </p>

                <a href="{{ route('user.bookings.index') }}"
                   class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-3 bg-indigo-600 rounded-xl font-bold text-xs sm:text-sm text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                    Riwayat Pemesanan
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
