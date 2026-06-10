@extends('layouts.app')

@section('title', 'Saraga Booking - Admin Portal')

@section('content')
<section class="min-h-[calc(100vh-80px)] flex items-center justify-center relative px-4 bg-background">
    <!-- Dark decorative elements for admin feel -->
    <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
    <div class="absolute bottom-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-secondary/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-primary-container/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="glass-panel w-full max-w-md rounded-2xl p-8 md:p-12 flex flex-col gap-8 my-10 border border-white/10 shadow-[0_0_50px_rgba(0,0,0,0.5)] relative overflow-hidden backdrop-blur-2xl">
        
        <div class="text-center space-y-3 relative z-10">
            <div class="w-16 h-16 mx-auto bg-surface-container-high rounded-2xl flex items-center justify-center mb-6 shadow-inner border border-white/5">
                <span class="material-symbols-outlined text-4xl text-white opacity-80">shield_person</span>
            </div>
            <h1 class="text-3xl font-headline font-black tracking-tighter text-white uppercase italic">
                Portal Admin
            </h1>
            <p class="text-on-surface-variant font-label text-xs tracking-widest uppercase opacity-60">
                Akses Khusus Staf Pengelola
            </p>
        </div>

        @if(session('error'))
            <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-label text-center relative z-10">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-label text-center relative z-10">
                {{ $errors->first() }}
            </div>
        @endif

        <form class="flex flex-col gap-6 relative z-10" action="{{ route('admin.login') }}" method="POST">
            @csrf
            <!-- Email Field -->
            <div class="space-y-2">
                <label class="font-label text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface-variant" for="email">Email Admin</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">mail</span>
                    <input 
                        class="w-full bg-black/40 border border-white/10 rounded-xl focus:border-white focus:ring-0 text-white py-4 pl-12 pr-4 transition-all duration-300 placeholder:text-white/20 font-headline tracking-wide" 
                        id="email" 
                        name="email"
                        placeholder="admin@saraga.com" 
                        type="email" 
                        required
                    />
                </div>
            </div>

            <!-- Password Field -->
            <div class="space-y-2">
                <label class="font-label text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface-variant" for="password">Kata Sandi</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">lock</span>
                    <input 
                        class="w-full bg-black/40 border border-white/10 rounded-xl focus:border-white focus:ring-0 text-white py-4 pl-12 pr-4 transition-all duration-300 placeholder:text-white/20 font-headline tracking-widest" 
                        id="password" 
                        name="password"
                        placeholder="••••••••" 
                        type="password" 
                        required
                    />
                </div>
            </div>

            <!-- Utilities -->
            <div class="flex items-center justify-between font-label text-xs mt-2">
                <label class="flex items-center gap-3 cursor-pointer text-on-surface-variant hover:text-white transition-colors group">
                    <input name="remember" class="rounded border-white/20 bg-black/50 text-white focus:ring-0 focus:ring-offset-0 transition-all cursor-pointer" type="checkbox"/>
                    <span class="uppercase tracking-widest text-[10px] font-bold group-hover:opacity-100 opacity-60 transition-opacity">Ingat sesi ini</span>
                </label>
            </div>

            <!-- Primary Action -->
            <button class="mt-4 bg-white text-black py-4 rounded-xl font-headline font-black uppercase tracking-[0.2em] text-sm hover:bg-zinc-200 active:scale-95 transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.2)] flex items-center justify-center gap-3" type="submit">
                OTORISASI MASUK
                <span class="material-symbols-outlined text-lg">login</span>
            </button>
        </form>

        <div class="text-center font-label text-[9px] uppercase tracking-[0.2em] text-on-surface-variant opacity-40 mt-6 relative z-10">
            SARAGA BOOKING SYSTEM &copy; {{ date('Y') }}<br>Secure Gateway
        </div>
    </div>
</section>
@endsection
