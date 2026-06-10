@extends('layouts.dashboard')

@section('title', 'Riwayat Pesanan — Saraga Booking')

@section('content')
<div class="max-w-7xl mx-auto">
    <header class="flex justify-between items-center mb-16">
        <div>
            <h1 class="text-4xl font-headline font-black tracking-tighter text-on-surface uppercase italic">Riwayat <span class="text-primary-container">Pesanan</span></h1>
            <p class="text-on-surface-variant font-label mt-3 opacity-60 tracking-wider uppercase text-[10px] font-bold">Pantau semua jadwal dan statistik bermain Anda.</p>
        </div>
    </header>

    @if($bookings->isEmpty())
    <div class="glass-card p-24 rounded-[3rem] border-white/5 flex flex-col items-center justify-center text-center gap-8">
        <div class="w-24 h-24 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group">
            <span class="material-symbols-outlined text-5xl text-zinc-600 group-hover:text-primary-container transition-colors">history</span>
        </div>
        <div>
            <h2 class="text-2xl font-headline font-black text-on-surface uppercase italic tracking-tighter">Belum ada riwayat pesanan</h2>
            <p class="text-on-surface-variant font-label text-sm mt-3 opacity-50">Mulailah petualangan olahraga Anda dengan memesan lapangan hari ini.</p>
        </div>
        <a href="{{ url('/') }}" class="bg-primary-container text-on-primary px-10 py-4 rounded-2xl font-headline font-black uppercase text-xs tracking-widest italic shadow-[0_10px_30px_rgba(0,240,255,0.3)] hover:scale-105 active:scale-95 transition-all">Cari Lapangan</a>
    </div>
    @else
    <div class="space-y-6">
        @foreach($bookings as $booking)
        <div class="glass-card p-8 rounded-[2.5rem] border-white/5 flex flex-col md:flex-row items-center gap-8 hover:bg-white/[0.03] transition-all group">
            {{-- Venue Image --}}
            <div class="w-full md:w-40 h-28 rounded-2xl overflow-hidden shadow-xl shrink-0 group-hover:scale-[1.02] transition-transform duration-500">
                <img src="{{ $booking->court->foto ? asset('storage/' . str_replace('/storage/', '', $booking->court->foto)) : ($booking->court->venue->foto_venue ? asset('storage/' . str_replace('/storage/', '', $booking->court->venue->foto_venue)) : 'https://images.unsplash.com/photo-1541534741688-6078c64b52d3?auto=format&fit=crop&q=80&w=800') }}" 
                     class="w-full h-full object-cover">
            </div>

            {{-- Booking Details --}}
            <div class="flex-1 space-y-4">
                <div class="flex items-center gap-3">
                    <h4 class="text-2xl font-headline font-black text-white uppercase italic tracking-tight leading-none">{{ $booking->court->nama_lapangan }}</h4>
                    <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10 text-[9px] font-black text-outline uppercase tracking-widest italic">{{ $booking->kode_booking }}</span>
                </div>
                <div class="flex flex-wrap gap-x-8 gap-y-3 text-[11px] font-bold text-on-surface-variant uppercase tracking-widest opacity-80 italic">
                    <span class="flex items-center gap-2"><span class="material-symbols-outlined text-lg text-primary-container leading-none">calendar_today</span> {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d M Y') }}</span>
                    <span class="flex items-center gap-2"><span class="material-symbols-outlined text-lg text-primary-container leading-none">schedule</span> {{ substr($booking->jam_mulai, 0, 5) }} WIB</span>
                    <span class="flex items-center gap-2"><span class="material-symbols-outlined text-lg text-primary-container leading-none">location_on</span> {{ $booking->court->venue->nama_venue }}</span>
                </div>
                <div class="pt-2">
                    <span class="text-[10px] font-headline font-black text-secondary tracking-widest italic uppercase">Estimasi Main: {{ $booking->durasi }} Jam</span>
                </div>
            </div>

            {{-- Status & Actions --}}
            <div class="flex flex-col items-center md:items-end gap-5 w-full md:w-auto">
                <div class="text-right">
                    <p class="text-[10px] font-label font-bold text-outline uppercase tracking-widest mb-1 opacity-60">Total Bayar</p>
                    <p class="text-2xl font-headline font-black text-white italic tracking-tighter">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                </div>

                <div class="flex gap-4 items-center">
                    @php
                        $statusConfig = [
                            'pending' => ['label' => 'MENUNGGU PEMBAYARAN', 'class' => 'bg-secondary/10 text-secondary border-secondary/20'],
                            'lunas' => ['label' => 'PEMBAYARAN BERHASIL', 'class' => 'bg-primary-container/10 text-primary-container border-primary-container/20'],
                            'batal' => ['label' => 'DIBATALKAN', 'class' => 'bg-red-500/10 text-red-400 border-red-500/20'],
                            'selesai' => ['label' => 'SELESAI', 'class' => 'bg-white/10 text-zinc-400 border-white/20'],
                            'sedang_main' => ['label' => 'SEDANG BERMAIN', 'class' => 'bg-cyan-500/10 text-cyan-400 border-cyan-500/20 shadow-[0_0_15px_rgba(0,240,255,0.2)]'],
                        ];
                        $config = $statusConfig[$booking->status] ?? ['label' => strtoupper($booking->status), 'class' => 'bg-white/5 text-zinc-500 border-white/10'];
                    @endphp

                    <span class="px-6 py-2 rounded-full border {{ $config['class'] }} text-[10px] font-black uppercase tracking-widest italic whitespace-nowrap">
                        {{ $config['label'] }}
                    </span>

                    @if($booking->status === 'pending')
                        <a href="{{ route('checkout', $booking->kode_booking) }}" class="bg-primary-container text-on-primary px-8 py-3 rounded-xl font-headline font-black uppercase text-[10px] tracking-widest italic shadow-[0_5px_20px_rgba(0,240,255,0.3)] hover:scale-105 transition-all">BAYAR SEKARANG</a>
                    @elseif($booking->status === 'lunas')
                        <a href="{{ route('booking.success', $booking->kode_booking) }}" class="text-[10px] font-headline font-black text-primary-container hover:text-white transition-colors uppercase tracking-[0.2em] italic border-b border-primary-container/30 pb-1">LIHAT TIKET →</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
