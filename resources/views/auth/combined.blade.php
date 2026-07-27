<div class="w-full max-w-md mx-auto">

    {{-- TAB BUTTONS --}}
    <div class="flex justify-center mb-6">
        <div class="inline-flex rounded-lg bg-gray-100 dark:bg-gray-800 p-1">
            <button
                type="button"
                id="tabLogin"
                onclick="showTab('login')"
                class="px-4 py-2 text-sm font-semibold rounded-md transition
                       bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow"
            >
                Login
            </button>

            <button
                type="button"
                id="tabRegister"
                onclick="showTab('register')"
                class="px-4 py-2 text-sm font-semibold rounded-md transition
                       text-gray-600 dark:text-gray-300"
            >
                Register
            </button>
        </div>
    </div>

    {{-- LOGIN --}}
    <div id="panelLogin">
        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4 text-center">
            Masuk Akun
        </h2>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label for="email_login" value="Email" />
                <x-text-input id="email_login" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_login" value="Password" />
                <x-text-input id="password_login" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                        Remember me
                    </span>
                </label>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100"
                       href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <div class="mt-6">
                <x-primary-button class="w-full justify-center">
                    LOG IN
                </x-primary-button>
            </div>

            <p class="mt-5 text-center text-sm text-gray-600 dark:text-gray-400">
                Belum punya akun?
                <button type="button" onclick="showTab('register')"
                    class="underline font-semibold text-indigo-600 dark:text-indigo-400">
                    Daftar di sini
                </button>
            </p>
        </form>
    </div>

    {{-- REGISTER --}}
    <div id="panelRegister" style="display:none;">
        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4 text-center">
            Buat Akun Baru
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-input-label for="name" value="Nama" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    :value="old('name')" required autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email_register" value="Email" />
                <x-text-input id="email_register" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_register" value="Password" />
                <x-text-input id="password_register" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-6">
                <x-primary-button class="w-full justify-center">
                    REGISTER
                </x-primary-button>
            </div>

            <p class="mt-5 text-center text-sm text-gray-600 dark:text-gray-400">
                Sudah punya akun?
                <button type="button" onclick="showTab('login')"
                    class="underline font-semibold text-indigo-600 dark:text-indigo-400">
                    Login di sini
                </button>
            </p>
        </form>
    </div>

</div>

<script>
    function setActiveTab(active) {
        const tabLogin = document.getElementById('tabLogin');
        const tabRegister = document.getElementById('tabRegister');

        tabLogin.className = "px-4 py-2 text-sm font-semibold rounded-md transition text-gray-600 dark:text-gray-300";
        tabRegister.className = "px-4 py-2 text-sm font-semibold rounded-md transition text-gray-600 dark:text-gray-300";

        if (active === 'login') {
            tabLogin.className = "px-4 py-2 text-sm font-semibold rounded-md transition bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow";
        } else {
            tabRegister.className = "px-4 py-2 text-sm font-semibold rounded-md transition bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow";
        }
    }

    function showTab(type) {
        const login = document.getElementById('panelLogin');
        const register = document.getElementById('panelRegister');

        if (type === 'login') {
            login.style.display = 'block';
            register.style.display = 'none';
        } else {
            login.style.display = 'none';
            register.style.display = 'block';
        }
        setActiveTab(type);
    }

    if (window.location.pathname.includes('/register')) {
        showTab('register');
    } else {
        showTab('login');
    }
</script>
