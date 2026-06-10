@extends('layouts.vendor')

@section('title', 'Analitik Performa — SARAGA Partner')

@section('content')
<div class="max-w-7xl mx-auto">
    <header class="flex justify-between items-end mb-16">
        <div>
            <h1 class="text-4xl font-headline font-black tracking-tighter text-on-surface uppercase italic">Analitik <span class="text-primary-container">Performa</span></h1>
            <p class="text-on-surface-variant font-label mt-3 opacity-60 tracking-wider uppercase text-[10px] font-bold">Wawasan mendalam tentang tingkat keterisian dan tren pengunjung.</p>
        </div>
        <div class="flex gap-4">
            <select class="bg-white/5 border border-white/10 text-on-surface px-6 py-3 rounded-xl font-headline font-black text-[10px] uppercase tracking-widest italic appearance-none cursor-pointer">
                <option>Minggu Ini</option>
                <option>Bulan Ini</option>
                <option>Tahun Ini</option>
            </select>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
        <!-- Occpancy Rate Chart placeholder -->
        <div class="glass-card p-10 rounded-[3rem] border-white/5 space-y-8">
            <div class="flex justify-between items-center">
                <h3 class="text-sm font-headline font-black uppercase tracking-widest italic">Tingkat Okupansi</h3>
                <span class="text-primary-container text-xs font-black italic">68% RATA-RATA</span>
            </div>
            <div class="h-64 flex items-end gap-3 px-4">
                <template x-for="h in [40, 60, 45, 90, 85, 40, 30]">
                    <div class="flex-1 bg-primary-container/20 border-t-2 border-primary-container rounded-t-lg transition-all hover:bg-primary-container/40" 
                         :style="'height: ' + h + '%'"></div>
                </template>
            </div>
            <div class="flex justify-between text-[10px] font-bold text-zinc-500 uppercase tracking-widest italic px-2">
                <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="glass-card p-10 rounded-[3rem] border-white/5 flex flex-col justify-between">
                <p class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant italic">Waktu Puncak</p>
                <h2 class="text-4xl font-headline font-black text-on-surface italic tracking-tighter mt-4">19:00 - 21:00</h2>
                <span class="text-primary-container text-[10px] font-black uppercase mt-2 tracking-widest">Waktu Terlaris</span>
            </div>
            <div class="glass-card p-10 rounded-[3rem] border-white/5 flex flex-col justify-between">
                <p class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant italic">Retensi Pengguna</p>
                <h2 class="text-4xl font-headline font-black text-on-surface italic tracking-tighter mt-4">72%</h2>
                <span class="text-secondary text-[10px] font-black uppercase mt-2 tracking-widest">Pelanggan Berulang</span>
            </div>
            <div class="glass-card p-10 rounded-[3rem] border-white/5 flex flex-col justify-between">
                <p class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant italic">Pesanan Dibatalkan</p>
                <h2 class="text-4xl font-headline font-black text-red-400 italic tracking-tighter mt-4">2.4%</h2>
                <span class="text-zinc-600 text-[10px] font-black uppercase mt-2 tracking-widest">Bulan Ini</span>
            </div>
            <div class="glass-card p-10 rounded-[3rem] border-white/5 flex flex-col justify-between">
                <p class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant italic">Target Bulanan</p>
                <h2 class="text-4xl font-headline font-black text-white italic tracking-tighter mt-4">92%</h2>
                <div class="w-full h-1.5 bg-white/5 rounded-full mt-4 overflow-hidden border border-white/10">
                    <div class="h-full bg-primary-container shadow-[0_0_10px_rgba(0,240,255,0.4)]" style="width: 92%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
