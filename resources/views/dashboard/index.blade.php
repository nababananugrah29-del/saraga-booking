@extends('layouts.dashboard')

@section('title', 'Dashboard — Anugrah Nababan')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header Greeting -->
    <header class="flex justify-between items-center mb-16">
        <div>
            <h1 class="text-5xl font-headline font-black tracking-tighter text-on-surface">
                Selamat Datang Kembali, <span class="kinetic-gradient-text italic">Anugrah!</span>
            </h1>
            <p class="text-on-surface-variant font-label mt-3 opacity-60 tracking-wider">Kelola jadwal olahraga dan statistik Anda hari ini.</p>
        </div>
        <div class="flex items-center gap-6">
            <button class="relative w-14 h-14 flex items-center justify-center rounded-2xl glass-card hover:bg-white/5 transition-all group">
                <span class="material-symbols-outlined text-primary-container group-hover:scale-110 transition-transform">notifications</span>
                <span class="absolute top-4 right-4 w-2.5 h-2.5 bg-secondary rounded-full border-2 border-surface"></span>
            </button>
            <button class="w-14 h-14 flex items-center justify-center rounded-2xl glass-card hover:bg-white/5 transition-all group">
                <span class="material-symbols-outlined text-primary-container group-hover:rotate-12 transition-transform">bolt</span>
            </button>
        </div>
    </header>

    <!-- Stats Grid -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <!-- Card 1: Total Main -->
        <div class="glass-card p-10 rounded-[2.5rem] transition-all hover:translate-y-[-8px] hover:shadow-[0_20px_40px_rgba(0,0,0,0.4)] group cursor-default">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-primary-container/10 flex items-center justify-center border border-primary-container/20">
                    <span class="material-symbols-outlined text-primary-container text-3xl">sports_tennis</span>
                </div>
                <div>
                    <p class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Total Main</p>
                    <h2 class="text-6xl font-headline font-black text-on-surface mt-2 tracking-tighter italic">24</h2>
                </div>
            </div>
        </div>

        <!-- Card 2: Tiket Aktif -->
        <div class="glass-card p-10 rounded-[2.5rem] transition-all hover:translate-y-[-8px] hover:shadow-[0_20px_40px_rgba(0,0,0,0.4)] group cursor-default">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-primary-container/10 flex items-center justify-center border border-primary-container/20">
                    <span class="material-symbols-outlined text-primary-container text-3xl">confirmation_number</span>
                </div>
                <div>
                    <p class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Tiket Aktif</p>
                    <h2 class="text-6xl font-headline font-black text-on-surface mt-2 tracking-tighter italic">3</h2>
                </div>
            </div>
        </div>

        <!-- Card 3: Poin Reward -->
        <div class="glass-card p-10 rounded-[2.5rem] transition-all hover:translate-y-[-8px] hover:shadow-[0_20px_40px_rgba(0,0,0,0.4)] group cursor-default">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-secondary/10 flex items-center justify-center border border-secondary/20">
                    <span class="material-symbols-outlined text-secondary text-3xl">military_tech</span>
                </div>
                <div>
                    <p class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Poin Reward</p>
                    <h2 class="text-6xl font-headline font-black text-secondary mt-2 tracking-tighter italic">{{ number_format(auth()->user()->points_balance, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- Active Booking Section -->
    <section>
        <div class="flex items-center justify-between mb-10">
            <div class="flex items-center gap-3">
                <div class="w-2.5 h-8 bg-primary-container rounded-full shadow-[0_0_15px_rgba(0,240,255,0.4)]"></div>
                <h3 class="text-2xl font-headline font-black tracking-tighter uppercase italic">Pesanan Aktif</h3>
            </div>
            <a href="#" class="text-xs font-label font-bold text-primary-container hover:underline tracking-widest uppercase">Lihat Semua Riwayat</a>
        </div>

        <!-- Main Booking Card -->
        @if($latestBooking)
        <div class="relative group">
            <div class="glass-card p-8 rounded-[3rem] border-white/10 flex flex-col lg:flex-row items-center gap-12 transition-all hover:bg-white/5 overflow-hidden">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-primary-container/5 blur-[100px] pointer-events-none"></div>

                <!-- Venue Highlight -->
                <div class="w-full lg:w-72 h-44 rounded-3xl overflow-hidden shrink-0 shadow-2xl">
                    <img src="{{ $latestBooking->court->foto ? asset('storage/' . str_replace('/storage/', '', $latestBooking->court->foto)) : ($latestBooking->court->venue->foto_venue ? asset('storage/' . str_replace('/storage/', '', $latestBooking->court->venue->foto_venue)) : 'https://images.unsplash.com/photo-1541534741688-6078c64b52d3?auto=format&fit=crop&q=80&w=800') }}" 
                         alt="{{ $latestBooking->court->venue->nama_venue }}" 
                         class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                </div>

                <!-- Content Details -->
                <div class="flex-1 space-y-6">
                    <div>
                        <h4 class="text-3xl font-headline font-black tracking-tighter text-white uppercase italic">{{ $latestBooking->court->nama_lapangan }}</h4>
                        <div class="flex items-center gap-2 text-on-surface-variant mt-1 opacity-70">
                            <span class="material-symbols-outlined text-sm text-primary-container">location_on</span>
                            <span class="font-label text-xs font-bold uppercase tracking-widest">{{ $latestBooking->court->venue->nama_venue }} &bull; {{ $latestBooking->court->venue->regency->name ?? 'Lokasi' }}</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-10 py-6 border-y border-white/5">
                        <div class="flex items-center gap-4">
                            <div class="p-2 bg-secondary/10 rounded-lg">
                                <span class="material-symbols-outlined text-secondary">calendar_today</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[9px] text-on-surface-variant uppercase font-label font-bold tracking-[0.2em] opacity-50">Hari & Tanggal</span>
                                <span class="text-sm font-bold tracking-tight">{{ $latestBooking->tanggal->translatedFormat('l, d F Y') }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="p-2 bg-secondary/10 rounded-lg">
                                <span class="material-symbols-outlined text-secondary">schedule</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[9px] text-on-surface-variant uppercase font-label font-bold tracking-[0.2em] opacity-50">Jam Main</span>
                                <span class="text-sm font-bold tracking-tight">{{ substr($latestBooking->jam_mulai, 0, 5) }} ({{ $latestBooking->durasi }} Jam)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Actions -->
                <div class="flex flex-col items-center lg:items-end gap-6 shrink-0 pr-4">
                    @php
                        $statusLabel = $latestBooking->status === 'pending' ? 'MENUNGGU BAYAR' : 'SIAP MAIN';
                    @endphp
                    <div class="px-8 py-3 bg-primary-container text-on-primary font-headline font-black text-[10px] tracking-[0.2em] rounded-full shadow-[0_0_20px_rgba(0,240,255,0.4)] uppercase italic">
                        {{ $statusLabel }}
                    </div>
                    @php
                        $targetRoute = $latestBooking->status === 'pending' ? route('checkout', $latestBooking->kode_booking) : route('booking.success', $latestBooking->kode_booking);
                    @endphp
                    <a href="{{ $targetRoute }}" class="group flex items-center gap-3 text-on-surface hover:text-primary-container transition-all font-headline font-black text-xs uppercase tracking-[0.2em] italic pr-2">
                        {{ $latestBooking->status === 'pending' ? 'Bayar Sekarang' : 'Detail Tiket' }}
                        <span class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="glass-card p-16 rounded-[3rem] border-white/5 flex flex-col items-center justify-center text-center gap-6">
            <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group">
                <span class="material-symbols-outlined text-4xl text-zinc-600 group-hover:text-primary-container transition-colors">history</span>
            </div>
            <div>
                <h2 class="text-xl font-headline font-black text-on-surface uppercase italic tracking-tighter">Belum ada pesanan aktif</h2>
                <p class="text-on-surface-variant font-label text-xs mt-2 opacity-50">Ayo cari lapangan favoritmu dan mulai berolahraga!</p>
            </div>
            <a href="{{ url('/') }}" class="text-primary-container font-headline font-black uppercase text-[10px] tracking-widest italic border-b border-primary-container/30 pb-1 hover:text-white transition-colors">Cari Lapangan Sekarang →</a>
        </div>
        @endif

    </section>
</div>
@endsection
