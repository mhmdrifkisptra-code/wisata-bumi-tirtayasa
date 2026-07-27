<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-950 text-slate-100">
<div x-data="{ sidebarOpen: false }" class="min-h-screen flex">

    {{-- Overlay mobile --}}
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        class="fixed inset-0 z-40 bg-black/50 lg:hidden"
        @click="sidebarOpen = false"
    ></div>

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Main --}}
    <div class="flex-1 flex flex-col min-w-0 lg:ml-0">

        {{-- Topbar --}}
        <header class="sticky top-0 z-30 border-b border-white/10 bg-slate-950/70 backdrop-blur">
            <div class="min-h-16 px-4 sm:px-6 flex items-center justify-between gap-4">

                <div class="flex items-center gap-3 min-w-0">
                    {{-- Tombol menu mobile --}}
                    <button
                        type="button"
                        class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10"
                        @click="sidebarOpen = true"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="min-w-0">
                        <div class="text-xs sm:text-sm text-white/60 truncate">Wisata Bumi Tirtayasa</div>
                        <div class="font-semibold leading-tight text-sm sm:text-base truncate">
                            @yield('page_title','Dashboard')
                        </div>
                    </div>
                </div>

                {{-- Nama admin + logout --}}
                <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    <span class="hidden sm:inline text-sm font-medium text-white/90">
                        {{ auth()->user()->name }}
                        <span class="text-white/60">({{ auth()->user()->role }})</span>
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="px-3 sm:px-4 py-2 rounded-xl bg-white/10 border border-white/10 hover:bg-white/15 text-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 px-4 sm:px-6 py-4 sm:py-6">
            @if (session('success'))
                <div class="mb-5 rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-emerald-200">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="px-4 sm:px-6 py-4 text-xs text-white/40 border-t border-white/10">
            © {{ date('Y') }} Wisata Bumi Tirtayasa — Admin Panel
        </footer>
    </div>
</div>
</body>
</html>
