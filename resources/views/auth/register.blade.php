<x-guest-layout>
    <div class="w-full sm:max-w-md mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6">
            <h1 class="text-2xl font-bold text-center text-gray-900 dark:text-gray-100">
                Daftar Akun
            </h1>
            <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-1">
                Buat akun untuk lanjut pemesanan tiket
            </p>

            <x-auth-session-status class="mt-4" :status="session('status')" />

            <form class="mt-6" method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nama --}}
                <div>
                    <x-input-label for="name" value="Nama" />
                    <x-text-input
                        id="name"
                        class="block mt-1 w-full"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- Email --}}
                <div class="mt-4">
                    <x-input-label for="email" value="Email" />
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Password --}}
                <div class="mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input
                        id="password"
                        class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mt-4">
                    <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                    <x-text-input
                        id="password_confirmation"
                        class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-primary-button class="w-full justify-center">
                        DAFTAR
                    </x-primary-button>
                </div>

                <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:underline dark:text-indigo-400">
                        Login di sini
                    </a>
                </p>

                <div class="mt-4 text-center">
                    <a href="{{ route('home') }}" class="text-xs text-gray-500 hover:underline">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
