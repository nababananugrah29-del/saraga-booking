<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard — SARAGA Booking')</title>

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
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .kinetic-gradient-text {
            background: linear-gradient(to right, #7df4ff, #00dbe9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        body {
            background-color: #121317;
            color: #e3e2e7;
        }
    </style>
    @stack('styles')
</head>
<body class="font-body selection:bg-primary-container selection:text-on-primary">
    <div class="flex min-h-screen">
        {{-- ==================== SIDEBAR ==================== --}}
        <aside class="fixed left-0 top-0 h-full w-72 bg-zinc-900/40 backdrop-blur-xl border-r border-white/10 flex flex-col p-6 z-50">
            <!-- Brand Logo -->
            <div class="mb-12 px-4">
                <a href="{{ url('/') }}" class="text-2xl font-black tracking-tighter hover:opacity-80 transition-opacity">
                    <span class="text-primary-container">SARAGA</span>
                    <span class="text-white">BOOKING</span>
                </a>
            </div>

            <!-- Profile Section -->
            <div class="flex items-center gap-4 px-4 mb-12">
                <div class="relative">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDmUEHx6gcvWImUOyCH-p8x4bVn8ZdyJAMXzqF-AorMcVSKaFTZohxyB0nzr8cHr1K_3A-GrMu1y5qgn_GWDIDY6SYiOyd0smy-xrd_EbWjbWp0JSeawyonPpHz5eXgcDtxp23ieYasKTcA-mMS1Um75I_rcE8uKo0C9qKCGwMKXH1fN4M9ZDrqvldtgLDXZyDE87K1lKAbM6Cf8v8IlZQdyDf7dv3Ld-nEdLCsqcrN_IB_MIs7XTMw0VQFEvrTkgPSZ5AWBColFPP6" 
                         alt="Anugrah Nababan" 
                         class="w-12 h-12 rounded-full border-2 border-primary-container object-cover">
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-primary-container rounded-full border-2 border-zinc-900"></div>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-on-surface text-sm">{{ auth()->user()->name }}</span>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="px-2 py-0.5 rounded-full bg-secondary/10 text-secondary text-[8px] font-black tracking-widest uppercase border border-secondary/20">ANGGOTA PRO</span>
                        <span class="text-[9px] text-primary-container font-black tracking-widest uppercase">★ {{ number_format(auth()->user()->points_balance) }} PTS</span>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 space-y-2">
                <a href="{{ url('/') }}" 
                   class="flex items-center gap-4 p-4 rounded-xl transition-all duration-300 text-zinc-500 hover:text-white hover:bg-white/5 group mb-4">
                    <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1" style="font-variation-settings: 'FILL' 0">arrow_back</span>
                    <span class="text-sm font-semibold">Kembali ke Beranda</span>
                </a>
                <div class="h-px bg-white/5 mx-4 mb-4"></div>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-4 p-4 rounded-xl transition-all duration-300 {{ Request::is('dashboard') ? 'text-primary-container font-bold bg-white/5 border-l-4 border-primary-container shadow-[0_0_20px_rgba(0,240,255,0.1)]' : 'text-zinc-500 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Request::is('dashboard') ? '1' : '0' }}">grid_view</span>
                    <span class="text-sm">Dashboard</span>
                </a>
                <a href="{{ route('dashboard.pesanan') }}" 
                   class="flex items-center gap-4 p-4 rounded-xl transition-all duration-300 {{ Request::is('dashboard/pesanan*') ? 'text-primary-container font-bold bg-white/5 border-l-4 border-primary-container' : 'text-zinc-500 hover:text-white hover:bg-white/5' }} group">
                    <span class="material-symbols-outlined transition-transform group-hover:scale-110" style="font-variation-settings: 'FILL' {{ Request::is('dashboard/pesanan*') ? '1' : '0' }}">calendar_today</span>
                    <span class="text-sm">Pesanan Saya</span>
                </a>
                <a href="{{ route('dashboard.favorit') }}" 
                   class="flex items-center gap-4 p-4 rounded-xl transition-all duration-300 {{ Request::is('dashboard/favorit*') ? 'text-primary-container font-bold bg-white/5 border-l-4 border-primary-container' : 'text-zinc-500 hover:text-white hover:bg-white/5' }} group">
                    <span class="material-symbols-outlined transition-transform group-hover:scale-110" style="font-variation-settings: 'FILL' {{ Request::is('dashboard/favorit*') ? '1' : '0' }}">favorite</span>
                    <span class="text-sm">Favorit</span>
                </a>
                <a href="{{ route('dashboard.pengaturan') }}" 
                   class="flex items-center gap-4 p-4 rounded-xl transition-all duration-300 {{ Request::is('dashboard/pengaturan*') ? 'text-primary-container font-bold bg-white/5 border-l-4 border-primary-container' : 'text-zinc-500 hover:text-white hover:bg-white/5' }} group">
                    <span class="material-symbols-outlined transition-transform group-hover:scale-110" style="font-variation-settings: 'FILL' {{ Request::is('dashboard/pengaturan*') ? '1' : '0' }}">settings</span>
                    <span class="text-sm">Pengaturan</span>
                </a>
            </nav>

            <!-- Footer Sidebar -->
            <div class="mt-auto space-y-2 pt-6 border-t border-white/5">
                <a href="#" class="flex items-center gap-4 p-4 text-zinc-500 hover:text-white transition-all duration-300">
                    <span class="material-symbols-outlined">help_outline</span>
                    <span class="text-sm">Bantuan</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-4 p-4 text-zinc-500 hover:text-red-400 transition-all duration-300">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="text-sm">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- ==================== CONTENT ==================== --}}
        <main class="ml-72 flex-1 p-12 bg-surface min-h-screen">
            @yield('content')
        </main>
    </div>
</body>
</html>
