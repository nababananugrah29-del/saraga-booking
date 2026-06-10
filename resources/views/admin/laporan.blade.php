@extends('layouts.admin')

@section('title', 'Laporan Platform — Super Admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <header class="flex justify-between items-end mb-16">
        <div>
            <h1 class="text-4xl font-headline font-black tracking-tighter text-on-surface uppercase italic">Analitik <span class="text-primary-container">Platform</span></h1>
            <p class="text-on-surface-variant font-label mt-3 opacity-60 tracking-wider uppercase text-[10px] font-bold">Wawasan makro mengenai performa ekonomi dan pertumbuhan ekosistem Saraga.</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.export') }}" class="bg-primary-container/10 border border-primary-container/20 text-primary-container px-8 py-3 rounded-xl font-headline font-black text-[10px] uppercase tracking-widest italic hover:bg-primary-container/20 transition-all inline-block">Ekspor CSV Pendapatan</a>
        </div>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <!-- Monthly Growth placeholder -->
        <div class="glass-card p-10 rounded-[3rem] border-white/5 space-y-10">
            <h3 class="text-sm font-headline font-black uppercase tracking-widest italic flex items-center justify-between">
                Pertumbuhan Bulanan
                <span class="text-green-400 text-xs font-black">+24%</span>
            </h3>
            <div class="relative h-64 flex items-end">
                <div class="absolute inset-0 border-b border-white/5 flex items-end justify-between px-4 pb-4">
                    @foreach($growthData as $i)
                        <div class="w-12 bg-primary-container/20 border-t-2 border-primary-container/40 rounded-t-lg transition-all hover:bg-primary-container/40" 
                             style="height: {{ $i }}%"></div>
                    @endforeach
                </div>
            </div>
            <p class="text-on-surface-variant font-label text-[10px] uppercase tracking-[0.2em] opacity-40 font-bold">Periode Data: Jan 2026 - Jun 2026</p>
        </div>

        <div class="space-y-8">
            <div class="glass-card p-10 rounded-[3rem] border-white/5 flex justify-between items-center group hover:bg-primary-container hover:text-on-primary transition-all duration-500 cursor-default">
                <div class="space-y-2">
                    <p class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant group-hover:text-primary transition-colors italic">Total Nilai Transaksi Bruto (GMV)</p>
                    <h2 class="text-4xl font-headline font-black italic tracking-tighter">Rp {{ number_format($gmv, 0, ',', '.') }}</h2>
                </div>
                <span class="material-symbols-outlined text-4xl opacity-30 group-hover:opacity-100 group-hover:scale-125 transition-all">trending_up</span>
            </div>
            <div class="glass-card p-10 rounded-[3rem] border-white/5 flex justify-between items-center group hover:brightness-110 transition-all">
                <div class="space-y-2">
                    <p class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant italic">Pendapatan Platform (10%)</p>
                    <h2 class="text-4xl font-headline font-black italic tracking-tighter">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                </div>
                <span class="material-symbols-outlined text-4xl text-secondary opacity-30 group-hover:opacity-100 transition-all">payments</span>
            </div>
        </div>
    </div>
</div>
@endsection
