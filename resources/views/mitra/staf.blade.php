@extends('layouts.vendor')

@section('title', 'Manajemen Staf — SARAGA Partner')

@section('content')
<div class="max-w-7xl mx-auto">
    <header class="flex justify-between items-end mb-16">
        <div>
            <h1 class="text-4xl font-headline font-black tracking-tighter text-on-surface uppercase italic">Manajemen <span class="text-primary-container">Staf</span></h1>
            <p class="text-on-surface-variant font-label mt-3 opacity-60 tracking-wider uppercase text-[10px] font-bold">Kelola akses operasional untuk pengelola lapangan Anda.</p>
        </div>
        <button class="bg-primary-container text-on-primary px-8 py-4 rounded-2xl font-headline font-black uppercase text-xs tracking-widest italic shadow-[0_10px_30px_rgba(0,240,255,0.3)] hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
            <span class="material-symbols-outlined text-sm">person_add</span>
            Tambah Staf
        </button>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Staff Card 1 (Owner) -->
        <div class="glass-card p-10 rounded-[3rem] border-primary-container/20 space-y-6 relative overflow-hidden group hover:bg-white/[0.03] transition-all">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary-container/5 blur-3xl"></div>
            
            <div class="flex flex-col items-center text-center space-y-4">
                <div class="relative">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAQOwPPy7YOfcpWaiB3TPaP1ST-ccoBMCs__zcD4mZHpfTDAHx2uuOGmibCoa7JSOtUc8Oo1sMK9n5P7_ZhK0697zlO8D71YcxmHqLI55U3_GLvypdRjb_7iIf94Ol4gI_rW_LheU9z1Hjq30j11g4dSLgja9CsCDLrg3u9RL1uqjDttQQYiIxMZx5mXetS6mNC8Cpbic-I3sKyvVdeeQDlm4UnhjH9GGI3FuRbPRHKZuraTMH-x3k3jrnxYvm998lAZWV9z_nEutFW" class="w-20 h-20 rounded-full border-2 border-primary-container object-cover">
                    <div class="absolute bottom-1 right-1 w-4 h-4 bg-primary-container rounded-full border-2 border-zinc-900"></div>
                </div>
                <div>
                    <h3 class="text-xl font-headline font-black text-white uppercase italic tracking-tight italic">{{ auth()->user()->name }}</h3>
                    <p class="text-zinc-500 font-label text-[10px] uppercase tracking-widest font-bold mt-1">Pemilik Venue</p>
                </div>
            </div>

            <div class="pt-6 border-t border-white/5 space-y-4">
                <div class="flex justify-between items-center text-[10px] uppercase font-bold tracking-widest text-zinc-500 italic">
                    <span>Aksi Terakhir</span>
                    <span class="text-on-surface">Baru saja</span>
                </div>
                <button class="w-full py-3 rounded-xl bg-white/5 border border-white/10 text-on-surface text-[10px] font-black uppercase tracking-widest italic hover:bg-white/10 transition-all opacity-50 cursor-not-allowed">
                    Akun Utama
                </button>
            </div>
        </div>
        
        <!-- Add more placeholders -->
        <div class="glass-card p-10 rounded-[3rem] border-white/5 flex flex-col items-center justify-center text-center opacity-30 border-dashed group cursor-pointer hover:opacity-100 hover:border-primary-container transition-all">
            <span class="material-symbols-outlined text-5xl mb-4 group-hover:scale-110 group-hover:text-primary-container transition-all">add_circle</span>
            <p class="text-sm font-headline font-black uppercase tracking-widest italic">Undang Admin Baru</p>
        </div>
    </div>
</div>
@endsection
