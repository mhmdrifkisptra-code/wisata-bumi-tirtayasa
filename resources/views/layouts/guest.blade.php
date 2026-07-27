<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- ✅ Pakai Vite hanya kalau kamu memang jalanin npm run dev / build --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    {{-- ✅ Fallback biar gak polos total (tanpa Tailwind) --}}
    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; background:#0b1220; }
        .wrap { min-height:100vh; display:flex; align-items:center; justify-content:center; padding:24px; }
        .card { width:100%; max-width:420px; background:rgba(255,255,255,.08); color:#fff; border-radius:16px; padding:24px; box-shadow:0 12px 40px rgba(0,0,0,.35); }
        a { color:#93c5fd; }
        .row { display:flex; align-items:center; justify-content:space-between; gap:12px; }
        .check { display:flex; align-items:center; gap:8px; }
        .check input { width:auto; }
        .small { font-size: 13px; opacity: .9; }
        .link { text-decoration: underline; }
        .mt-4{ margin-top:16px; }
        .mt-6{ margin-top:24px; }
        input { width:100%; padding:10px 12px; border-radius:10px; border:1px solid rgba(255,255,255,.2); background:rgba(0,0,0,.25); color:#fff; }
        label { display:block; margin-bottom:6px; opacity:.9; }
        button { width:100%; padding:10px 12px; border-radius:10px; border:0; background:#fff; color:#111827; font-weight:600; cursor:pointer; }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="card">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
