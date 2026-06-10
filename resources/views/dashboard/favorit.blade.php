@extends('layouts.dashboard')

@section('title', 'Lapangan Favorit — Saraga Booking')

@section('content')
<div class="max-w-7xl mx-auto">
    <header class="flex justify-between items-center mb-16">
        <div>
            <h1 class="text-4xl font-headline font-black tracking-tighter text-on-surface uppercase italic">Lapangan <span class="text-primary-container">Favorit</span></h1>
            <p class="text-on-surface-variant font-label mt-3 opacity-60 tracking-wider uppercase text-[10px] font-bold">Kumpulan tempat olahraga terbaik pilihan Anda.</p>
        </div>
    </header>

    <div class="glass-card p-24 rounded-[3rem] border-white/5 flex flex-col items-center justify-center text-center gap-8">
        <div class="w-24 h-24 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group">
            <span class="material-symbols-outlined text-5xl text-zinc-600 group-hover:text-primary-container transition-colors" style="font-variation-settings: 'FILL' 1;">favorite</span>
        </div>
        <div>
            <h2 class="text-2xl font-headline font-black text-on-surface uppercase italic tracking-tighter">Belum ada lapangan favorit</h2>
            <p class="text-on-surface-variant font-label text-sm mt-3 opacity-50">Ketuk ikon hati pada halaman detail lapangan untuk menyimpannya di sini.</p>
        </div>
        <a href="{{ url('/cari-lapangan') }}" class="bg-primary-container text-on-primary px-10 py-4 rounded-2xl font-headline font-black uppercase text-xs tracking-widest italic shadow-[0_10px_30px_rgba(0,240,255,0.3)] hover:scale-105 active:scale-95 transition-all">Jelajahi Lapangan</a>
    </div>
</div>
@endsection
