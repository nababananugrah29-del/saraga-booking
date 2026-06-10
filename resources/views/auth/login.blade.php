@extends('layouts.app')

@section('title', 'Saraga Booking - Login')

@section('content')
<section class="min-h-[calc(100vh-80px)] flex items-center justify-center relative px-4 bg-hero">
    <div class="glass-panel w-full max-w-md rounded-xl p-8 md:p-10 flex flex-col gap-8 my-10 shadow-2xl">
        <div class="space-y-2">
            <h1 class="text-3xl md:text-4xl font-headline font-extrabold tracking-tight text-on-surface leading-tight">
                Masuk ke Akun Anda
            </h1>
            <p class="text-on-surface-variant font-label text-sm tracking-wide">
                Akses dashboard performa atletik Anda
            </p>
        </div>

        <form class="flex flex-col gap-6" action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Email Field -->
            <div class="space-y-1">
                <label class="font-label text-xs uppercase tracking-widest text-slate-400" for="email">Email</label>
                <input 
                    class="w-full bg-surface-container-highest bg-opacity-50 border-0 border-b border-outline-variant focus:border-primary-container focus:ring-0 text-on-surface py-3 transition-colors duration-300" 
                    id="email" 
                    name="email"
                    placeholder="nama@email.com" 
                    type="email" 
                    required
                />
            </div>

            <!-- Password Field -->
            <div class="space-y-1">
                <label class="font-label text-xs uppercase tracking-widest text-slate-400" for="password">Kata Sandi</label>
                <input 
                    class="w-full bg-surface-container-highest bg-opacity-50 border-0 border-b border-outline-variant focus:border-primary-container focus:ring-0 text-on-surface py-3 transition-colors duration-300" 
                    id="password" 
                    name="password"
                    placeholder="••••••••" 
                    type="password" 
                    required
                />
            </div>

            <!-- Utilities -->
            <div class="flex items-center justify-between font-label text-xs">
                <label class="flex items-center gap-2 cursor-pointer text-on-surface-variant hover:text-on-surface transition-colors">
                    <input name="remember" class="rounded-sm bg-surface-container-highest border-outline-variant text-primary-container focus:ring-0 focus:ring-offset-0" type="checkbox"/>
                    <span>Ingat saya</span>
                </label>
                <a class="text-secondary-fixed-dim hover:text-secondary transition-colors font-semibold" href="#">Lupa Kata Sandi?</a>
            </div>

            <!-- Primary Action -->
            <button class="neon-glow bg-primary-container text-on-primary py-4 rounded-xl font-headline font-bold uppercase tracking-widest text-sm hover:brightness-110 active:scale-95 transition-all duration-300" type="submit">
                Masuk
            </button>

            <!-- Divider -->
            <div class="relative flex items-center py-2">
                <div class="flex-grow border-t border-outline-variant opacity-30"></div>
                <span class="flex-shrink mx-4 text-[10px] font-label uppercase tracking-widest text-slate-500">Atau</span>
                <div class="flex-grow border-t border-outline-variant opacity-30"></div>
            </div>

            <!-- Social Login -->
            <button class="flex items-center justify-center gap-3 bg-surface-container-high bg-opacity-40 border border-outline-variant border-opacity-20 py-4 rounded-xl font-headline font-semibold text-sm text-on-surface hover:bg-surface-container-highest transition-colors active:scale-95 duration-300" type="button">
                <svg class="w-5 h-5" viewbox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="currentColor"></path>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="currentColor"></path>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="currentColor"></path>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.66l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="currentColor"></path>
                </svg>
                <span>Masuk dengan Google</span>
            </button>
        </form>

        <div class="text-center font-label text-xs">
            <span class="text-slate-400">Belum punya akun?</span>
            <a class="ml-1 text-cyan-400 font-bold hover:underline" href="{{ url('/register') }}">Daftar Sekarang</a>
        </div>
    </div>
</section>
@endsection
