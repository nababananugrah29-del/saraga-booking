<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Super Admin Dashboard — Saraga Booking')</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    {{-- Google Fonts: Inter, Manrope --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;600;700;800&family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />

    {{-- Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary-container": "#00f0ff",
                        "on-primary": "#00363a",
                        "secondary": "#e9c176",
                        "surface": "#121317",
                        "on-surface": "#e3e2e7",
                        "on-surface-variant": "#b9cacb",
                        "background": "#121317",
                        "surface-container-high": "#292a2e",
                        "surface-container-highest": "#343439",
                        "outline-variant": "#3b494b",
                    },
                    fontFamily: {
                        headline: ["Manrope", "sans-serif"],
                        body: ["Manrope", "sans-serif"],
                        label: ["Inter", "sans-serif"]
                    }
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .glass-card {
            background: rgba(52, 52, 57, 0.4);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        body {
            background-color: #121317;
            color: #e3e2e7;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-background text-on-surface font-body min-h-screen flex">
    <!-- Sidebar -->
    <aside class="h-screen w-72 sticky left-0 top-0 bg-zinc-900/60 backdrop-blur-2xl shadow-2xl z-40 flex flex-col py-8 border-r border-white/5">
        <div class="px-8 py-4 mb-10 flex flex-col items-start gap-1">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-black text-primary-container tracking-tighter uppercase font-headline italic hover:text-white transition-colors">Saraga Booking</a>
            <span class="font-label font-bold uppercase tracking-[0.3em] text-[10px] text-zinc-500">Super Admin Portal</span>
        </div>

        <nav class="flex-1 space-y-2 px-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-6 py-3 transition-all duration-300 rounded-2xl {{ Request::is('admin/dashboard*') ? 'bg-primary-container/10 text-primary-container border-l-4 border-primary-container font-black italic shadow-[0_0_20px_rgba(0,240,255,0.1)]' : 'text-zinc-500 hover:text-zinc-200 hover:bg-white/5' }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Request::is('admin/dashboard*') ? '1' : '0' }}">dashboard</span>
                <span class="font-label font-bold uppercase tracking-widest text-[10px]">Ringkasan</span>
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center gap-4 px-6 py-3 transition-all duration-300 rounded-2xl {{ Request::is('admin/users*') ? 'bg-primary-container/10 text-primary-container border-l-4 border-primary-container font-black italic shadow-[0_0_20px_rgba(0,240,255,0.1)]' : 'text-zinc-500 hover:text-zinc-200 hover:bg-white/5' }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Request::is('admin/users*') ? '1' : '0' }}">group</span>
                <span class="font-label font-bold uppercase tracking-widest text-[10px]">Daftar Pengguna</span>
            </a>
            <a href="{{ route('admin.venues') }}" class="flex items-center gap-4 px-6 py-3 transition-all duration-300 rounded-2xl {{ Request::is('admin/venues*') ? 'bg-primary-container/10 text-primary-container border-l-4 border-primary-container font-black italic shadow-[0_0_20px_rgba(0,240,255,0.1)]' : 'text-zinc-500 hover:text-zinc-200 hover:bg-white/5' }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Request::is('admin/venues*') ? '1' : '0' }}">storefront</span>
                <span class="font-label font-bold uppercase tracking-widest text-[10px]">Katalog Venue</span>
            </a>
            <a href="{{ route('admin.laporan') }}" class="flex items-center gap-4 px-6 py-3 transition-all duration-300 rounded-2xl {{ Request::is('admin/laporan*') ? 'bg-primary-container/10 text-primary-container border-l-4 border-primary-container font-black italic shadow-[0_0_20px_rgba(0,240,255,0.1)]' : 'text-zinc-500 hover:text-zinc-200 hover:bg-white/5' }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Request::is('admin/laporan*') ? '1' : '0' }}">analytics</span>
                <span class="font-label font-bold uppercase tracking-widest text-[10px]">Laporan</span>
            </a>
        </nav>

        <div class="px-6 mt-auto pb-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-4 px-6 py-3 text-zinc-500 hover:text-red-400 hover:bg-red-400/5 transition-all duration-300 rounded-2xl">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-label font-bold uppercase tracking-widest text-[10px]">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 min-h-screen relative overflow-y-auto">
        <!-- Decorative Accent -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-container/5 blur-[120px] rounded-full -z-10"></div>
        
        <div class="p-10 max-w-7xl mx-auto w-full">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
