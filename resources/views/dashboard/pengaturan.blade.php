@extends('layouts.dashboard')

@section('title', 'Pengaturan — Saraga Booking')

@section('content')
<div class="max-w-4xl mx-auto">
    <header class="mb-16">
        <h1 class="text-4xl font-headline font-black tracking-tighter text-on-surface uppercase italic">Pengaturan <span class="text-primary-container">Profil</span></h1>
        <p class="text-on-surface-variant font-label mt-3 opacity-60 tracking-wider uppercase text-[10px] font-bold">Kelola informasi pribadi dan keamanan akun Anda.</p>
    </header>

    <div class="space-y-10">
        <!-- Profile Info Card -->
        <div class="glass-card p-10 rounded-[2.5rem] border-white/5 space-y-10">
            <div class="flex items-center gap-8 pb-10 border-b border-white/5">
                <div class="relative group cursor-pointer">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDmUEHx6gcvWImUOyCH-p8x4bVn8ZdyJAMXzqF-AorMcVSKaFTZohxyB0nzr8cHr1K_3A-GrMu1y5qgn_GWDIDY6SYiOyd0smy-xrd_EbWjbWp0JSeawyonPpHz5eXgcDtxp23ieYasKTcA-mMS1Um75I_rcE8uKo0C9qKCGwMKXH1fN4M9ZDrqvldtgLDXZyDE87K1lKAbM6Cf8v8IlZQdyDf7dv3Ld-nEdLCsqcrN_IB_MIs7XTMw0VQFEvrTkgPSZ5AWBColFPP6" 
                         class="w-24 h-24 rounded-full border-4 border-primary-container object-cover transition-all group-hover:brightness-50">
                    <span class="material-symbols-outlined absolute inset-0 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all">photo_camera</span>
                </div>
                <div>
                    <h3 class="text-2xl font-headline font-black text-on-surface italic tracking-tight">{{ auth()->user()->name }}</h3>
                    <p class="text-zinc-500 font-label text-sm mt-1">{{ auth()->user()->email }}</p>
                    <span class="inline-block mt-3 px-4 py-1 rounded-full bg-secondary/10 text-secondary text-[9px] font-black tracking-widest uppercase italic border border-secondary/20">Anggota Pro</span>
                </div>
            </div>

            <form action="{{ url('/dashboard/pengaturan') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Nama Lengkap</label>
                        <input type="text" value="{{ auth()->user()->name }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container transition-all">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Alamat Email</label>
                        <input type="email" value="{{ auth()->user()->email }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container transition-all opacity-50 cursor-not-allowed" readonly>
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Nomor WhatsApp</label>
                        <input type="text" placeholder="+62 812..." class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container transition-all">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Ganti Password</label>
                        <button type="button" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface transition-all text-left hover:bg-white/10 italic">Ubah Kata Sandi...</button>
                    </div>
                </div>

                <div class="flex justify-end pt-6">
                    <button type="submit" class="bg-primary-container text-on-primary px-12 py-4 rounded-2xl font-headline font-black uppercase text-xs tracking-[0.2em] italic shadow-[0_10px_30px_rgba(0,240,255,0.3)] hover:scale-105 active:scale-95 transition-all">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
