@extends('layouts.app')

@section('title', 'Saraga Booking - Daftar Akun Baru')

@section('content')
<section class="min-h-[calc(100vh-80px)] flex items-center justify-center relative px-6 py-20 overflow-hidden">
    <!-- Background Layer -->
    <div class="bg-basketball"></div>

    <div class="w-full max-w-md">
        <div class="glass-card p-10 rounded-xl flex flex-col gap-8 shadow-2xl relative">
            <!-- Header Section -->
            <div class="space-y-2">
                <h1 class="text-3xl font-extrabold tracking-tight font-headline text-on-surface">Daftar Akun Baru</h1>
                <p class="font-label text-sm text-outline tracking-wide">Mulai perjalanan atletik Anda sekarang.</p>
            </div>

            <!-- Registration Form -->
            <form class="flex flex-col gap-6" action="{{ route('register') }}" method="POST">
                @csrf
                <!-- Nama Lengkap -->
                <div class="space-y-1.5">
                    <label class="font-label text-xs uppercase tracking-widest text-outline ml-1">Nama Lengkap</label>
                    <div class="relative group">
                        <input 
                            name="name"
                            class="w-full input-glass border-b border-outline-variant focus:border-primary-container outline-none px-4 py-3 text-on-surface font-label transition-all duration-300 placeholder:text-outline-variant" 
                            placeholder="John Doe" 
                            type="text"
                            required
                        />
                    </div>
                </div>

                <!-- Email -->
                <div class="space-y-1.5">
                    <label class="font-label text-xs uppercase tracking-widest text-outline ml-1">Email</label>
                    <div class="relative group">
                        <input 
                            name="email"
                            class="w-full input-glass border-b border-outline-variant focus:border-primary-container outline-none px-4 py-3 text-on-surface font-label transition-all duration-300 placeholder:text-outline-variant" 
                            placeholder="john@example.com" 
                            type="email"
                            required
                        />
                    </div>
                </div>

                <!-- Kata Sandi -->
                <div class="space-y-1.5">
                    <label class="font-label text-xs uppercase tracking-widest text-outline ml-1">Kata Sandi</label>
                    <div class="relative group">
                        <input 
                            name="password"
                            class="w-full input-glass border-b border-outline-variant focus:border-primary-container outline-none px-4 py-3 text-on-surface font-label transition-all duration-300 placeholder:text-outline-variant" 
                            placeholder="••••••••" 
                            type="password"
                            required
                        />
                    </div>
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div class="space-y-1.5">
                    <label class="font-label text-xs uppercase tracking-widest text-outline ml-1">Konfirmasi Kata Sandi</label>
                    <div class="relative group">
                        <input 
                            name="password_confirmation"
                            class="w-full input-glass border-b border-outline-variant focus:border-primary-container outline-none px-4 py-3 text-on-surface font-label transition-all duration-300 placeholder:text-outline-variant" 
                            placeholder="••••••••" 
                            type="password"
                            required
                        />
                    </div>
                </div>

                <!-- Action Button -->
                <button class="mt-4 w-full bg-primary-container text-on-primary font-headline font-bold py-4 rounded-xl shadow-[0_0_20px_rgba(0,240,255,0.3)] hover:shadow-[0_0_30px_rgba(0,240,255,0.5)] transform transition-all duration-300 active:scale-95 uppercase tracking-wider" type="submit">
                    Daftar Sekarang
                </button>
            </form>

            <!-- Divider -->
            <div class="relative flex items-center justify-center py-2">
                <div class="w-full h-px bg-outline-variant/30"></div>
                <span class="absolute bg-surface-container-high px-4 font-label text-[10px] text-outline uppercase tracking-widest">Atau daftar dengan</span>
            </div>

            <!-- Social Login -->
            <button class="w-full flex items-center justify-center gap-3 bg-surface-container-highest/40 hover:bg-surface-container-highest/60 border border-outline-variant/20 py-4 rounded-xl transition-all duration-300 transform active:scale-95 group">
                <svg class="w-5 h-5" viewbox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                </svg>
                <span class="font-label text-sm font-semibold text-on-surface group-hover:text-primary-fixed-dim transition-colors">Daftar dengan Google</span>
            </button>

            <!-- Footer Toggle -->
            <div class="text-center">
                <p class="font-label text-xs text-outline">
                    Sudah punya akun? 
                    <a class="text-secondary font-bold hover:text-secondary-fixed transition-colors ml-1 uppercase tracking-tighter" href="{{ url('/login') }}">Masuk</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
