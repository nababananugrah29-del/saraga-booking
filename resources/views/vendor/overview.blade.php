@extends('layouts.vendor')

@section('title', 'Ringkasan Dashboard — SARAGA Partner')

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-6 duration-700">
    <header>
        <h2 class="text-3xl font-headline font-black uppercase italic tracking-tighter text-white">Ringkasan <span class="text-primary-container">Performansi</span></h2>
        <p class="text-on-surface-variant font-label text-sm mt-1 uppercase tracking-widest opacity-70">Pantau aktivitas venue Anda secara real-time.</p>
    </header>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Total Pesanan -->
        <div class="glass-card p-8 rounded-[2rem] relative overflow-hidden group hover:border-primary-container/30 transition-all duration-300">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary-container/10 rounded-full blur-3xl group-hover:bg-primary-container/20 transition-all"></div>
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 rounded-xl bg-primary-container/10 border border-primary-container/20 flex items-center justify-center text-primary-container">
                    <span class="material-symbols-outlined">receipt_long</span>
                </div>
                <span class="text-zinc-500 font-label text-[10px] font-bold uppercase tracking-[0.2em]">Total Transaksi</span>
            </div>
            <div>
                <h3 class="text-4xl font-headline font-black text-white italic tracking-tighter">{{ number_format($totalPesanan) }}</h3>
                <p class="text-primary-container text-[10px] mt-2 uppercase tracking-widest font-bold flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">trending_up</span> Pesanan Masuk
                </p>
            </div>
        </div>

        <!-- Card 2: Estimasi Pendapatan -->
        <div class="glass-card p-8 rounded-[2rem] relative overflow-hidden group hover:border-secondary/30 transition-all duration-300">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-secondary/10 rounded-full blur-3xl group-hover:bg-secondary/20 transition-all"></div>
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 rounded-xl bg-secondary/10 border border-secondary/20 flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined">account_balance_wallet</span>
                </div>
                <span class="text-zinc-500 font-label text-[10px] font-bold uppercase tracking-[0.2em]">Bulan Ini</span>
            </div>
            <div>
                <h3 class="text-4xl font-headline font-black text-secondary italic tracking-tighter">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h3>
                <p class="text-secondary text-[10px] mt-2 uppercase tracking-widest font-bold flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">analytics</span> Estimasi Pendapatan
                </p>
            </div>
        </div>

        <!-- Card 3: Persentase Okupansi -->
        <div class="glass-card p-8 rounded-[2rem] relative overflow-hidden group hover:border-green-400/30 transition-all duration-300">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-green-400/10 rounded-full blur-3xl group-hover:bg-green-400/20 transition-all"></div>
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 rounded-xl bg-green-500/10 border border-green-500/20 flex items-center justify-center text-green-400">
                    <span class="material-symbols-outlined">query_stats</span>
                </div>
                <span class="text-zinc-500 font-label text-[10px] font-bold uppercase tracking-[0.2em]">Okupansi</span>
            </div>
            <div>
                <h3 class="text-4xl font-headline font-black text-white italic tracking-tighter">{{ $persentaseOkupansi }}%</h3>
                <div class="w-full bg-white/5 rounded-full h-1.5 mt-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-400 to-primary-container h-1.5 rounded-full" style="width: {{ $persentaseOkupansi }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="glass-card rounded-[2.5rem] p-8 border border-white/5 relative shadow-xl">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-xl font-headline font-black uppercase italic tracking-tighter text-white flex items-center gap-3">
                <span class="material-symbols-outlined text-primary-container">format_list_bulleted</span>
                Aktivitas Terbaru
            </h3>
            <a href="{{ route('mitra.pesanan') }}" class="text-[10px] font-label font-bold uppercase tracking-widest text-primary-container hover:text-white transition-colors">Lihat Semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="py-4 px-4 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Kode / Tanggal</th>
                        <th class="py-4 px-4 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Pelanggan</th>
                        <th class="py-4 px-4 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Lapangan</th>
                        <th class="py-4 px-4 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Waktu</th>
                        <th class="py-4 px-4 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($orders as $order)
                        <tr class="group hover:bg-white/[0.02] transition-colors">
                            <td class="py-5 px-4">
                                <div class="flex flex-col gap-1">
                                    <span class="font-headline font-bold text-sm text-white">{{ $order->kode_booking }}</span>
                                    <span class="text-[10px] text-zinc-500 font-label uppercase tracking-widest">{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}</span>
                                </div>
                            </td>
                            <td class="py-5 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary-container/10 flex items-center justify-center text-primary-container font-bold font-headline uppercase text-xs">
                                        {{ substr($order->user->name ?? 'Guest', 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-zinc-300">{{ $order->user->name ?? 'User Offline' }}</span>
                                </div>
                            </td>
                            <td class="py-5 px-4">
                                <span class="bg-white/5 px-3 py-1 rounded-lg text-xs font-bold text-zinc-400 capitalize">{{ $order->court->nama ?? 'Court' }}</span>
                            </td>
                            <td class="py-5 px-4">
                                <span class="text-xs font-label text-zinc-300 font-bold font-mono bg-black/30 px-2 py-1 rounded-md">{{ \Carbon\Carbon::parse($order->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($order->jam_mulai)->addHours($order->durasi)->format('H:i') }}</span>
                            </td>
                            <td class="py-5 px-4 text-right">
                                @if($order->status == 'lunas')
                                    <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 border border-green-500/20 text-[10px] font-black uppercase tracking-widest inline-flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                                        Lunas
                                    </span>
                                @elseif($order->status == 'pending')
                                    <span class="px-3 py-1 rounded-full bg-secondary/10 text-secondary border border-secondary/20 text-[10px] font-black uppercase tracking-widest">Pending</span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-primary-container/10 text-primary-container border border-primary-container/20 text-[10px] font-black uppercase tracking-widest">{{ str_replace('_', ' ', $order->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center">
                                <div class="flex flex-col items-center opacity-40">
                                    <span class="material-symbols-outlined text-5xl mb-4">inbox</span>
                                    <p class="font-headline font-bold text-lg italic tracking-widest uppercase">Belum ada pesanan terbaru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
