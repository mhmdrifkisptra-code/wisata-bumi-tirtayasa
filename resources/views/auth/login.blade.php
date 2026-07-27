<x-guest-layout>
    <div class="w-full sm:max-w-md mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6">
           <h1 class="text-2xl font-bold text-center text-gray-900 dark:text-gray-100">
              Masuk Akun
            </h1>
            <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-1">
                Silakan login untuk lanjut pemesanan tiket
            </p>

            <x-auth-session-status class="mt-4" :status="session('status')" />

            <form class="mt-6" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input
                        id="password"
                        class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="row mt-4 small">
                <label class="check">
                    <input type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="link" href="{{ route('password.request') }}">Lupa password?</a>
                @endif
            </div>


                <div class="mt-6">
                    <x-primary-button class="w-full justify-center">
                        LOGIN
                    </x-primary-button>
                </div>

                <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:underline dark:text-indigo-400">
                        Daftar di sini
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
