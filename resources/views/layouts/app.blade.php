<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SARAGA — Sewa Lapangan Jadi Lebih Mudah')</title>
    <meta name="description" content="@yield('meta_description', 'SARAGA Booking — Platform sewa lapangan olahraga terbaik di Indonesia. Cari lapangan, ikuti turnamen, dan kelola kemitraan.')">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    {{-- Google Fonts: Inter, Manrope --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;700;800&family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />

    {{-- Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Alpine.js for Interactivity --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Tailwind Custom Config --}}
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-error-container": "#ffdad6",
                        "on-tertiary-fixed": "#131d23",
                        "on-secondary-fixed-variant": "#5d4201",
                        "surface-container-high": "#292a2e",
                        "on-secondary": "#412d00",
                        "tertiary-container": "#d1dbe3",
                        "inverse-primary": "#006970",
                        "inverse-on-surface": "#2f3035",
                        "secondary": "#e9c176",
                        "primary-fixed": "#7df4ff",
                        "on-secondary-fixed": "#261900",
                        "surface-bright": "#38393d",
                        "secondary-fixed": "#ffdea5",
                        "surface-container-lowest": "#0d0e12",
                        "surface": "#121317",
                        "on-secondary-container": "#dab36a",
                        "tertiary-fixed-dim": "#bec8d0",
                        "tertiary": "#eff7ff",
                        "secondary-fixed-dim": "#e9c176",
                        "on-primary-fixed": "#002022",
                        "tertiary-fixed": "#dae4ec",
                        "surface-container-low": "#1a1b20",
                        "on-surface-variant": "#b9cacb",
                        "primary-fixed-dim": "#00dbe9",
                        "surface-dim": "#121317",
                        "on-primary-fixed-variant": "#004f54",
                        "on-primary": "#00363a",
                        "on-surface": "#e3e2e7",
                        "on-error": "#690005",
                        "surface-container": "#1f1f24",
                        "on-tertiary": "#283238",
                        "background": "#121317",
                        "on-tertiary-container": "#566067",
                        "on-primary-container": "#006970",
                        "error": "#ffb4ab",
                        "on-background": "#e3e2e7",
                        "surface-tint": "#00dbe9",
                        "on-tertiary-fixed-variant": "#3e484f",
                        "error-container": "#93000a",
                        "primary-container": "#00f0ff",
                        "surface-variant": "#343439",
                        "primary": "#dbfcff",
                        "secondary-container": "#604403",
                        "outline-variant": "#3b494b",
                        "outline": "#849495",
                        "inverse-surface": "#e3e2e7",
                        "surface-container-highest": "#343439"
                    },
                    borderRadius: {
                        DEFAULT: "0.125rem",
                        lg: "0.25rem",
                        xl: "0.5rem",
                        full: "0.75rem"
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

    {{-- Custom Styles --}}
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }

        .glass-card {
            background: rgba(52, 52, 57, 0.4);
            backdrop-filter: blur(16px);
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            border-bottom: 1px solid rgba(255, 255, 255, 0.02);
        }

        .glass-panel {
            background: rgba(18, 19, 23, 0.6);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .input-glass {
            background-color: rgba(26, 27, 32, 0.6) !important;
            backdrop-filter: blur(8px);
            color: #e3e2e7 !important;
        }

        /* Fix Browser Autofill White Background on Dark Theme */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 50px #1a1b20 inset !important;
            -webkit-text-fill-color: #e3e2e7 !important;
            caret-color: #00f0ff !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .neon-glow {
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.4), 0 0 30px rgba(0, 240, 255, 0.2);
        }

        .bg-hero {
            background-image: linear-gradient(to bottom, rgba(18, 19, 23, 0.4), rgba(18, 19, 23, 0.8)), url(https://lh3.googleusercontent.com/aida/ADBb0ujTsZB5v8A7P4H0ch8KCwOTTKNHs2pG6_he_s8rCsRWf-Mx9GSw0Kwl6fjmAliAgMYVZcQxYFZheWhXPraK67kEMWF3YCM3IJ8RZxC1D-v_xmZfD5l6n07EumIyhURBRVqMxrC1K72Qmlq4mVa99h1Zrl4VQw7xiLdOBCWXhlORnYK_wOmK6er_l0-T_cXRrKUi_9IoE1_0qD0c1gKcY7MZpuTw7o0nNgKMbM5EML742A-98pgaXMOUeKhMUYmVIrFHOKDUk4-P9Zs);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .bg-basketball {
            background-image: linear-gradient(rgba(18, 19, 23, 0.85), rgba(18, 19, 23, 0.95)), url(https://lh3.googleusercontent.com/aida/ADBb0uhkeB5ijiY7IYQTDh241HDU33x1IpxEbzAQN0J2IuaCF3lie3BYZN7YVrjeEgwMNRyonzjzk0JzsKedTV-kITFAWfXtesiNhgdwrzyPJ1IsN4jiBVTkf75RaAH7M_ASIz6D_IgzU6PGd_NprECX5tvF0WBJwT4-73aVZRFJHdG1eGetplzV6XFBrzeRCl1aEk--PD1YVO-5ymbN62mn_Gslwra_11UnjsyirO8zH6TUBnGxC8mc-LEbN4N8pMjdDHge9rzbnJfwBZs);
            background-size: cover;
            background-position: center;
            filter: blur(4px);
            position: absolute;
            inset: 0;
            z-index: -1;
        }

        .glass-panel {
            background: rgba(18, 19, 23, 0.6);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .neon-glow {
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.4), 0 0 30px rgba(0, 240, 255, 0.2);
        }

        .bg-hero {
            background-image: linear-gradient(to bottom, rgba(18, 19, 23, 0.4), rgba(18, 19, 23, 0.8)), url(https://lh3.googleusercontent.com/aida/ADBb0ujTsZB5v8A7P4H0ch8KCwOTTKNHs2pG6_he_s8rCsRWf-Mx9GSw0Kwl6fjmAliAgMYVZcQxYFZheWhXPraK67kEMWF3YCM3IJ8RZxC1D-v_xmZfD5l6n07EumIyhURBRVqMxrC1K72Qmlq4mVa99h1Zrl4VQw7xiLdOBCWXhlORnYK_wOmK6er_l0-T_cXRrKUi_9IoE1_0qD0c1gKcY7MZpuTw7o0nNgKMbM5EML742A-98pgaXMOUeKhMUYmVIrFHOKDUk4-P9Zs);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-background text-on-surface font-body selection:bg-primary-container selection:text-on-primary">

    {{-- ==================== TOP NAVIGATION BAR ==================== --}}
    <nav class="fixed top-0 w-full z-50 bg-[#121317]/40 backdrop-blur-[16px] shadow-[0_20px_40px_rgba(0,0,0,0.4)]">
        <div class="flex justify-between items-center px-8 h-20 w-full max-w-screen-2xl mx-auto">
            {{-- Logo --}}
            <a href="{{ Request::is('login') ? url('/login') : url('/') }}" class="flex items-center gap-3">
                <span class="text-2xl font-extrabold tracking-tighter text-white font-headline uppercase hover:text-primary-container transition-colors">SARAGA BOOKING</span>
            </a>

            {{-- Navigation Links --}}
            <div class="hidden md:flex items-center gap-8 font-headline font-bold tracking-[-2%] uppercase text-sm">
                <a class="{{ Request::is('cari-lapangan') ? 'text-[#00f0ff] font-bold border-b-2 border-[#00f0ff] pb-1' : 'text-[#e3e2e7] opacity-70 hover:text-[#00f0ff] hover:opacity-100' }} transition-all duration-300" href="{{ url('/cari-lapangan') }}">Cari Lapangan</a>
                <a class="{{ Request::is('turnamen') ? 'text-[#00f0ff] font-bold border-b-2 border-[#00f0ff] pb-1' : 'text-[#e3e2e7] opacity-70 hover:text-[#00f0ff] hover:opacity-100' }} transition-all duration-300" href="{{ url('/turnamen') }}">Turnamen & Liga</a>
                <a class="{{ Request::is('kemitraan') ? 'text-[#00f0ff] font-bold border-b-2 border-[#00f0ff] pb-1' : 'text-[#e3e2e7] opacity-70 hover:text-[#00f0ff] hover:opacity-100' }} transition-all duration-300" href="{{ url('/kemitraan') }}">Kemitraan</a>
                <a class="{{ Request::routeIs('pusat-bantuan') ? 'text-[#00f0ff] font-bold border-b-2 border-[#00f0ff] pb-1' : 'text-[#e3e2e7] opacity-70 hover:text-[#00f0ff] hover:opacity-100' }} transition-all duration-300" href="{{ route('pusat-bantuan') }}">Pusat Bantuan</a>
            </div>

            {{-- Auth Buttons --}}
            <div class="flex items-center gap-6">
                @auth
                    <div class="flex items-center gap-6">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-[#e3e2e7] font-headline font-bold uppercase text-xs tracking-widest hover:text-[#00f0ff] transition-colors">Admin</a>
                        @endif

                        @if(auth()->user()->isVendor())
                            <a href="{{ route('dashboard') }}" class="text-[#e3e2e7] font-headline font-bold uppercase text-xs tracking-widest hover:text-[#00f0ff] transition-colors">Profil User</a>
                            <a href="{{ route('mitra.pesanan') }}" class="px-6 py-2 rounded-xl bg-primary-container/10 border border-primary-container/30 text-primary-container font-headline font-black uppercase text-[10px] tracking-widest hover:bg-primary-container hover:text-on-primary transition-all">Profil Mitra</a>
                        @elseif(!auth()->user()->isAdmin())
                            <a href="{{ route('dashboard') }}" class="text-[#e3e2e7] font-headline font-bold uppercase text-xs tracking-widest hover:text-[#00f0ff] transition-colors">Profil User</a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-white/5 border border-white/10 text-on-surface px-6 py-2.5 rounded-full font-headline font-extrabold uppercase text-xs tracking-widest hover:bg-white/10 transition-all">Keluar</button>
                        </form>
                    </div>
                @else
                    <a href="{{ url('/login') }}" class="text-[#e3e2e7] font-headline font-bold uppercase text-xs tracking-widest hover:text-[#00f0ff] transition-colors scale-95 active:scale-90 transition-transform">Masuk</a>
                    <a href="{{ url('/register') }}" class="bg-primary-container text-on-primary px-6 py-2.5 rounded-full font-headline font-extrabold uppercase text-xs tracking-widest shadow-[0_0_20px_rgba(0,240,255,0.3)] hover:scale-105 active:scale-95 transition-transform">Daftar Sekarang</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ==================== MAIN CONTENT ==================== --}}
    <main class="pt-20">
        @yield('content')
    </main>

    {{-- ==================== FOOTER ==================== --}}
    <footer class="bg-[#121317] w-full py-12 border-t border-white/5">
        <div class="flex flex-col md:flex-row justify-between items-center px-12 gap-8 max-w-screen-2xl mx-auto">
            <div class="flex items-center gap-4">
                <a href="{{ Request::is('login') ? url('/login') : url('/') }}" class="text-lg font-bold text-[#e9c176] font-headline uppercase tracking-widest hover:text-white transition-colors">SARAGA BOOKING</a>
            </div>
            <div class="flex gap-10">
                <a class="font-label text-[10px] uppercase tracking-widest text-[#e3e2e7]/50 hover:text-[#00f0ff] transition-colors" href="#">Privasi</a>
                <a class="font-label text-[10px] uppercase tracking-widest text-[#e3e2e7]/50 hover:text-[#00f0ff] transition-colors" href="#">Ketentuan</a>
                <a class="font-label text-[10px] uppercase tracking-widest text-[#e3e2e7]/50 hover:text-[#00f0ff] transition-colors" href="#">Mitra</a>
                <a class="font-label text-[10px] uppercase tracking-widest text-[#e3e2e7]/50 hover:text-[#00f0ff] transition-colors" href="#">Karir</a>
            </div>
            <p class="font-label text-[10px] uppercase tracking-widest text-[#e3e2e7] opacity-60">
                © {{ date('Y') }} SARAGA BOOKING. DIRANCANG UNTUK KEMENANGAN.
            </p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
