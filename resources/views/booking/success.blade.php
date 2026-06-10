@extends('layouts.app')

@section('title', 'Pembayaran Berhasil — SARAGA Booking')

@section('content')
<style>
    .ticket-cutout {
        position: relative;
    }
    .ticket-cutout::before, .ticket-cutout::after {
        content: '';
        position: absolute;
        width: 32px;
        height: 32px;
        background: #121317; {{-- Same as background --}}
        border-radius: 50%;
        top: 68%;
        transform: translateY(-50%);
        z-index: 10;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .ticket-cutout::before { left: -17px; }
    .ticket-cutout::after { right: -17px; }
    
    @media print {
        header, footer, .no-print {
            display: none !important;
        }
        .main-container {
            padding: 0 !important;
            margin: 0 !important;
        }
    }
</style>

<main class="min-h-screen flex flex-col items-center justify-center pt-32 pb-24 px-6 relative overflow-hidden">
    <!-- Background Ambient Glow -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-primary-container/5 rounded-full blur-[150px] pointer-events-none -z-10"></div>
    
    <!-- Success Animation/Icon -->
    <div class="flex flex-col items-center mb-16 no-print">
        <div class="w-32 h-32 rounded-full @if($booking->status == 'lunas') bg-primary-container/10 border-primary-container/20 shadow-[0_0_80px_rgba(0,240,255,0.2)] @else bg-secondary/10 border-secondary/20 shadow-[0_0_80px_rgba(233,193,118,0.2)] @endif border flex items-center justify-center mb-8">
            <span class="material-symbols-outlined text-7xl @if($booking->status == 'lunas') text-primary-container shadow-[0_0_20px_rgba(0,240,255,0.6)] @else text-secondary shadow-[0_0_20px_rgba(233,193,118,0.6)] @endif" style="font-variation-settings: 'FILL' 1;">
                {{ $booking->status == 'lunas' ? 'check_circle' : 'hourglass_empty' }}
            </span>
        </div>
        <h1 class="text-5xl md:text-6xl font-black font-headline text-center tracking-tighter uppercase text-white mb-4">
            {{ $booking->status == 'lunas' ? 'Pembayaran Berhasil!' : 'Pesanan Sedang Diverifikasi' }}
        </h1>
        <p class="text-on-surface-variant font-label tracking-[0.3em] uppercase text-xs font-bold opacity-60">
            {{ $booking->status == 'lunas' ? 'Transaksi Anda Telah Dikonfirmasi' : 'Mitra Kami Sedang Memeriksa Pembayaran Anda' }}
        </p>
    </div>

    <!-- E-Ticket Card -->
    <div class="glass-card ticket-cutout w-full max-w-lg rounded-[2.5rem] p-10 relative bg-white/5 backdrop-blur-3xl shadow-2xl border-white/10 mb-16">
        
        <!-- Ticket Top -->
        <div class="flex justify-between items-start mb-12">
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-label font-bold text-primary-container tracking-[0.3em] uppercase">E-Ticket Pas</span>
                <span class="font-headline font-black text-2xl tracking-tighter text-white uppercase italic">SARAGA <span class="text-primary-container">BOOKING</span></span>
            </div>
            <div class="p-3 bg-white/5 rounded-2xl border border-white/10">
                <span class="material-symbols-outlined text-secondary text-3xl">qr_code_2</span>
            </div>
        </div>

        <!-- QR Code Section (Only if Paid) -->
        <div class="flex flex-col items-center justify-center bg-white p-8 rounded-3xl mb-12 shadow-inner">
            <div class="relative group">
                @if($booking->status == 'lunas')
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBZMWKD-7ksWXvTKj7OEsjudOqBl0XsxB71r_u3lXWneLpdu5jraSHyBCtGDpmbHF6ZnuHGp2fJFOu-lhKiDyP7aLmUj3bQb_ZaA5HGqCAsz1XASYREnriB2tK5oDgaTadpJGzohakYG7Lqo5HlF4ActolYoY9nC4uhdVbhSl7WznFKojB-7Dh2T9BbM6zhT02nGDcQZZ43zMXnR1_Dv-PmwqK1SjeB_zMxFEuXr5fLJ7yP07SPLu2YPZbig8MjPiVcd0gdIhxfT90F" 
                     alt="QR Code Ticket" class="w-48 h-48 mix-blend-multiply opacity-90 transition-transform duration-700 group-hover:scale-105">
                @else
                <div class="w-48 h-48 border-4 border-dashed border-zinc-200 rounded-full flex items-center justify-center text-zinc-300">
                    <span class="material-symbols-outlined text-6xl">hourglass_top</span>
                </div>
                @endif
            </div>
            <span class="mt-6 font-headline font-black text-2xl text-background tracking-tighter uppercase italic">{{ $booking->kode_booking }}</span>
        </div>

        <!-- Booking Details -->
        <div class="grid grid-cols-2 gap-y-8 pt-10 border-t-2 border-dashed border-white/10">
            <div class="flex flex-col">
                <span class="text-[9px] font-label font-bold text-on-surface-variant tracking-[0.2em] uppercase mb-2">Unit Lapangan</span>
                <span class="font-headline font-black text-xl text-primary-container leading-tight italic uppercase">{{ $booking->court->nama_lapangan }}</span>
                <span class="text-[10px] font-bold text-on-surface/60 mt-1 uppercase">{{ $booking->court->venue->nama_venue ?? 'N/A' }}</span>
            </div>
            <div class="flex flex-col text-right">
                <span class="text-[9px] font-label font-bold text-on-surface-variant tracking-[0.2em] uppercase mb-2">Tanggal Sesi</span>
                <span class="font-headline font-bold text-lg text-on-surface">{{ $booking->tanggal->translatedFormat('l, d F Y') }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-[9px] font-label font-bold text-on-surface-variant tracking-[0.2em] uppercase mb-2">Jam Main</span>
                <span class="font-headline font-bold text-lg text-on-surface">{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_mulai)->addHours($booking->durasi)->format('H:i') }} WIB</span>
            </div>
            <div class="flex flex-col text-right">
                <span class="text-[9px] font-label font-bold text-on-surface-variant tracking-[0.2em] uppercase mb-2">Status Tiket</span>
                <span class="font-headline font-black text-lg text-primary-container uppercase italic tracking-tighter">
                    {{ $booking->status === 'lunas' ? 'CONFIRMED' : strtoupper($booking->status) }}
                </span>
            </div>
        </div>

        @if(isset($vendorShare) && isset($adminFee))
        <!-- Financial Details -->
        <div class="mt-8 pt-8 border-t-2 border-dashed border-white/10 space-y-3">
            <div class="flex justify-between items-center">
                <span class="text-[9px] font-label font-bold text-on-surface-variant tracking-[0.2em] uppercase">Total Bayar</span>
                <span class="font-headline font-bold text-lg text-white">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>
        @endif
    </div>

    <!-- Action Buttons (no-print) -->
    <div class="flex flex-col sm:flex-row gap-6 w-full max-w-lg no-print">
        <button onclick="window.print()" class="flex-1 bg-primary-container text-on-primary font-headline font-black py-5 px-10 rounded-21xl tracking-tighter uppercase shadow-[0_15px_40px_rgba(0,240,255,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3 italic">
            <span class="material-symbols-outlined text-xl">download</span> 
            DOWNLOAD E-TIKET
        </button>
        <a href="{{ url('/') }}" class="flex-1 border-2 border-primary-container/30 bg-primary-container/5 text-primary-container font-headline font-black py-5 px-10 rounded-21xl tracking-tighter uppercase hover:bg-primary-container/10 transition-all active:scale-[0.98] flex items-center justify-center gap-3 italic text-center">
            <span class="material-symbols-outlined text-xl">home</span> 
            BALIK KE BERANDA
        </a>
    </div>
</main>
@endsection
