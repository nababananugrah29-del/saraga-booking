<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Vendor Dashboard — SARAGA Partner')</title>

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
            border: 1px solid rgba(255, 255, 255, 0.08);
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
    <aside class="h-screen w-64 sticky left-0 bg-[#1c1e26] flex flex-col py-6 shadow-2xl shadow-black/40 font-label text-sm font-medium z-50">
        <div class="px-6 mb-10 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center overflow-hidden">
                <img src="{{ auth()->user()->venues->first()->foto_venue ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuDm8LRPy5kBTNtypAdHvPVOfJh_g_IbMksTjlPBCm7G18D7tdAz0Rv9-9WXT7fkdsY5X_eX2qJ4FN_dyHmhxIAx73bVymHL_a2hb7deR5kJCPMxe6vNcnpFoOtIB7kGGeI6BIUG5X7ye80G4JV-cJOnPU1S0-uMR5cT2U1-zUOaOsJAlTB2O011-DmPVhVKfE3kDlWJ-A_LQwONg_bBwRc8N4H7dXNq9apn_dtN4kWXa0M0WqkL6sXnpJUg4NEIPUEJCbzTmQZ19RFz' }}" alt="Venue Logo" class="w-full h-full object-cover">
            </div>
            <div>
                <h1 class="text-[#e3e2e7] font-headline font-black tracking-tight leading-none uppercase">{{ auth()->user()->venues->first()->nama_venue ?? 'SARAGA PARTNER' }}</h1>
                <p class="text-on-surface-variant text-[10px] uppercase tracking-widest mt-1">ID MITRA: {{ auth()->user()->id }}</p>
            </div>
        </div>

        <nav class="flex-1 space-y-1">
            <a href="{{ route('mitra.pesanan') }}" class="flex items-center gap-4 py-3 px-6 transition-all duration-200 {{ Request::is('mitra/pesanan*') ? 'bg-primary-container/10 text-primary-container border-l-4 border-primary-container' : 'text-[#9ba1a6] hover:bg-[#252833] hover:text-[#e3e2e7]' }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Request::is('mitra/pesanan*') ? '1' : '0' }}">receipt_long</span>
                <span>Pesanan</span>
            </a>
            <a href="{{ route('mitra.inventaris') }}" class="flex items-center gap-4 py-3 px-6 transition-all duration-200 {{ Request::is('mitra/inventaris*') ? 'bg-primary-container/10 text-primary-container border-l-4 border-primary-container' : 'text-[#9ba1a6] hover:bg-[#252833] hover:text-[#e3e2e7]' }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Request::is('mitra/inventaris*') ? '1' : '0' }}">inventory_2</span>
                <span>Inventaris</span>
            </a>
            <a href="{{ route('mitra.keuangan') }}" class="flex items-center gap-4 py-3 px-6 transition-all duration-200 {{ Request::is('mitra/keuangan*') ? 'bg-primary-container/10 text-primary-container border-l-4 border-primary-container' : 'text-[#9ba1a6] hover:bg-[#252833] hover:text-[#e3e2e7]' }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Request::is('mitra/keuangan*') ? '1' : '0' }}">payments</span>
                <span>Keuangan</span>
            </a>
            <a href="{{ route('mitra.staf') }}" class="flex items-center gap-4 py-3 px-6 transition-all duration-200 {{ Request::is('mitra/staf*') ? 'bg-primary-container/10 text-primary-container border-l-4 border-primary-container' : 'text-[#9ba1a6] hover:bg-[#252833] hover:text-[#e3e2e7]' }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Request::is('mitra/staf*') ? '1' : '0' }}">groups</span>
                <span>Manajemen Staf</span>
            </a>
            <a href="{{ route('mitra.laporan') }}" class="flex items-center gap-4 py-3 px-6 transition-all duration-200 {{ Request::is('mitra/laporan*') ? 'bg-primary-container/10 text-primary-container border-l-4 border-primary-container' : 'text-[#9ba1a6] hover:bg-[#252833] hover:text-[#e3e2e7]' }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Request::is('mitra/laporan*') ? '1' : '0' }}">assessment</span>
                <span>Laporan Analitik</span>
            </a>
        </nav>

        <div class="px-6 mb-6">
            <button @click="$dispatch('open-create-order')" class="w-full bg-primary-container text-on-primary py-3 rounded-xl font-headline font-black uppercase text-xs tracking-widest flex items-center justify-center gap-2 hover:brightness-110 transition-all active:scale-95 shadow-[0_0_20px_rgba(0,240,255,0.3)]">
                <span class="material-symbols-outlined text-sm">add</span>
                TAMBAH PESANAN
            </button>
        </div>

        <div class="pt-6 border-t border-white/5">
            <a href="{{ route('home') }}" class="flex items-center gap-4 text-[#9ba1a6] py-3 px-6 hover:bg-primary-container/10 hover:text-primary-container transition-all group overflow-hidden relative border-l-2 border-transparent hover:border-primary-container">
                <div class="absolute inset-0 bg-primary-container/5 -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                <span class="material-symbols-outlined relative z-10 group-hover:-translate-x-1 transition-transform">arrow_left_alt</span>
                <span class="relative z-10 font-bold uppercase text-[10px] tracking-widest">Ke Halaman Utama</span>
            </a>
            <a href="#" class="flex items-center gap-4 text-[#9ba1a6] py-3 px-6 hover:bg-[#252833] hover:text-[#e3e2e7] transition-all mt-4">
                <span class="material-symbols-outlined">help_outline</span>
                <span>Bantuan</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-4 text-[#9ba1a6] py-3 px-6 hover:bg-[#252833] hover:text-[#e3e2e7] transition-all">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0" x-data="{ createOrderModal: false }" @open-create-order.window="createOrderModal = true">
        <!-- TopNavBar -->
        <header class="w-full sticky top-0 z-30 bg-[#121317] flex justify-between items-center px-8 h-16 border-b border-white/5">
            <div class="flex items-center gap-8">
                <span class="text-xl font-headline font-black tracking-tighter text-[#e3e2e7] uppercase italic">{{ auth()->user()->venues->first()->nama_venue ?? 'SARAGA PARTNER' }}</span>
                <nav class="hidden md:flex gap-6">
                    <a class="font-label text-xs uppercase tracking-widest transition-colors {{ Request::routeIs('vendor.overview') ? 'font-black drop-shadow-[0_0_8px_rgba(0,240,255,0.8)] text-primary-container' : 'text-[#9ba1a6] hover:text-primary-container' }}" href="{{ route('vendor.overview') }}">Ringkasan</a>
                    <a class="font-label text-xs uppercase tracking-widest transition-colors {{ Request::routeIs('vendor.analytics') ? 'text-primary-container font-black drop-shadow-[0_0_8px_rgba(0,240,255,0.8)]' : 'text-[#9ba1a6] hover:text-primary-container' }}" href="{{ route('vendor.analytics') }}">Analitik</a>
                    <a class="font-label text-xs uppercase tracking-widest transition-colors {{ Request::routeIs('vendor.schedule') ? 'text-primary-container font-black drop-shadow-[0_0_8px_rgba(0,240,255,0.8)]' : 'text-[#9ba1a6] hover:text-primary-container' }}" href="{{ route('vendor.schedule') }}">Jadwal</a>
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <button class="relative w-10 h-10 flex items-center justify-center rounded-full hover:bg-white/5 text-[#9ba1a6] transition-all">
                    <span class="material-symbols-outlined text-xl">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-primary-container rounded-full ring-2 ring-[#121317]"></span>
                </button>
                <div class="w-8 h-8 rounded-full overflow-hidden border border-white/10">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBl2yhIJ7XVFGrKkQBnZZ9Y-CSzoOVd_DVTbKq1TsG55Dg7nVE1aUVZdOTktQ6QXb3Vz0DlOvdIU7pvR3TbVCMW9o64stI9qJCqysNaXcN392p7fEkOMC8nU9vzkvf-txDo2EdWcen9-kV3Ylv9nYmk-nhWg-JeWpF-DoIMM8ytZy0Lz9jfIO4iB9MCDCyHQjR0-aqhzbch8VolDZftv6rdX9zs-x-lqnTmVb48_a0xrUsoQSV6AcjoQze-_GHo1H4xbL6qloQP6dlW" alt="Partner Profile" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        <div class="p-8 max-w-7xl mx-auto w-full">
            @yield('content')
        </div>

        {{-- ==================== CREATE ORDER MODAL ==================== --}}
        <div x-show="createOrderModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 z-[100] flex items-center justify-center p-6" x-cloak>
            
            <div @click="createOrderModal = false" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            
            <div class="glass-card w-full max-w-lg p-10 rounded-[2.5rem] relative space-y-10 border-white/10 shadow-[0_0_50px_rgba(0,0,0,0.5)]">
                <header class="flex justify-between items-center">
                    <h2 class="text-3xl font-headline font-black tracking-tighter uppercase italic text-white flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary-container">add_circle</span>
                        Tambah Booking
                    </h2>
                    <button @click="createOrderModal = false" class="text-on-surface-variant hover:text-white transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </header>

                <form action="{{ route('mitra.pesanan.manual') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="space-y-6">
                        <div class="space-y-3">
                            <label class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Nama Penyewa</label>
                            <input type="text" placeholder="Masukkan nama..." class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container transition-all">
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <label class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Pilihan Lapangan</label>
                                <select class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container transition-all appearance-none cursor-pointer">
                                    <option>Court 01</option>
                                    <option>Court 02</option>
                                    <option>Court 03</option>
                                </select>
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Durasi</label>
                                <select class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container transition-all appearance-none cursor-pointer">
                                    <option>1 Jam</option>
                                    <option>2 Jam</option>
                                    <option>3 Jam</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Pilihan Jam</label>
                            <div class="grid grid-cols-3 gap-3">
                                <template x-for="jam in ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00']">
                                    <button type="button" class="py-3 rounded-xl border border-white/5 bg-white/5 text-xs font-bold font-headline hover:border-primary-container hover:text-primary-container transition-all" x-text="jam"></button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary-container text-on-primary py-5 rounded-2xl font-headline font-black uppercase tracking-[0.2em] text-sm shadow-[0_15px_40px_rgba(0,240,255,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all italic">
                        SIMPAN PESANAN
                    </button>
                </form>
            </div>
        </div>
    </main>

    @stack('scripts')
</body>
</html>
