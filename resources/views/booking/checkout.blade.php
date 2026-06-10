@extends('layouts.app')

@section('title', 'Konfirmasi Pesanan — SARAGA Booking')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12 md:py-24" x-data="{ 
    timeLeft: {{ $timeLeft }},
    isProcessing: false,
    selectedMethod: 'va',
    usePoints: false,
    pointsDiscount: {{ auth()->user()->points_balance ?? 0 }},
    basePrice: {{ $booking->total_harga }},
    serviceFee: 2500,
    formatTime(seconds) {
        seconds = Math.floor(seconds);
        const h = Math.floor(seconds / 3600);
        const m = Math.floor((seconds % 3600) / 60);
        const s = seconds % 60;
        return `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
    },
    formatCurrency(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID');
    },
    getTotal() {
        let total = this.basePrice + this.serviceFee;
        if (this.usePoints) total -= this.pointsDiscount;
        return total < 0 ? 0 : total;
    },
    init() {
        setInterval(() => {
            if(this.timeLeft > 0) {
                this.timeLeft--;
            } else {
                window.location.reload(); // Refresh to trigger expiration logic
            }
        }, 1000);
    }
}">
    <!-- Hero Section -->
    <header class="mb-16">
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter mb-6 text-on-surface uppercase">
            Selesaikan <span class="text-primary-container">Reservasi</span>
        </h1>
        <div :class="timeLeft < 300 ? 'border-red-500/50 bg-red-500/10 text-red-400' : 'border-primary-container/20 bg-primary-container/10 text-primary-container'"
             class="flex items-center gap-3 font-label font-bold tracking-widest w-fit px-6 py-3 rounded-2xl border shadow-[0_0_20px_rgba(0,240,255,0.1)] transition-colors duration-500">
            <span class="material-symbols-outlined text-lg animate-pulse" style="font-variation-settings: 'FILL' 1;">schedule</span>
            <span>Selesaikan pembayaran dalam <span x-text="formatTime(timeLeft)">14:59</span></span>
        </div>
    </header>

    <!-- Layout 65/35 -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <!-- Kolom Kiri -->
        <div class="lg:col-span-8 space-y-10">
            
            <!-- Informasi Pemesan -->
            <section class="glass-card p-10 rounded-[2.5rem] border-white/5 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 blur-3xl pointer-events-none"></div>
                
                <div class="flex items-center gap-4 mb-10">
                    <div class="p-3 bg-surface-container-high rounded-xl">
                        <span class="material-symbols-outlined text-primary-container text-2xl" style="font-variation-settings: 'FILL' 1;">person</span>
                    </div>
                    <h2 class="text-2xl font-headline font-black uppercase tracking-tighter italic text-white leading-none">Informasi Pemesan</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-3">
                        <label class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Nama Lengkap</label>
                        <input type="text" value="{{ auth()->user()->name }}" readonly class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary-container focus:ring-0 text-on-surface font-headline font-bold text-xl py-4 transition-all duration-300 cursor-default opacity-80">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Email Konfirmasi</label>
                        <input type="text" value="{{ auth()->user()->email }}" readonly class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary-container focus:ring-0 text-on-surface font-headline font-bold text-xl py-4 transition-all duration-300 cursor-default opacity-80">
                    </div>
                </div>
            </section>

            <!-- Metode Pembayaran -->
            <section class="glass-card p-10 rounded-[2.5rem] border-white/5 relative overflow-hidden">
                <div class="flex items-center gap-4 mb-10">
                    <div class="p-3 bg-surface-container-high rounded-xl">
                        <span class="material-symbols-outlined text-primary-container text-2xl" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
                    </div>
                    <h2 class="text-2xl font-headline font-black uppercase tracking-tighter italic text-white leading-none">Metode Pembayaran</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- QRIS -->
                    <div @click="selectedMethod = 'qris'" 
                         :class="selectedMethod === 'qris' ? 'border-primary-container bg-primary-container/5 shadow-[0_0_30px_rgba(0,240,255,0.15)] scale-[1.02]' : 'border-white/5 bg-surface-container-low hover:bg-white/5'"
                        class="cursor-pointer p-8 rounded-3xl border-2 transition-all duration-500 group flex flex-col items-center gap-6">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center p-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" alt="QRIS" class="w-full">
                        </div>
                        <span class="font-headline font-black text-sm uppercase tracking-widest italic group-hover:text-primary-container transition-colors">QRIS Scan</span>
                    </div>

                    <!-- Virtual Account -->
                    <div @click="selectedMethod = 'va'"
                         :class="selectedMethod === 'va' ? 'border-primary-container bg-primary-container/5 shadow-[0_0_30px_rgba(0,240,255,0.15)] scale-[1.02]' : 'border-white/5 bg-surface-container-low hover:bg-white/5'"
                        class="cursor-pointer p-8 rounded-3xl border-2 transition-all duration-500 group flex flex-col items-center gap-6">
                        <div class="w-16 h-16 bg-primary-container/20 rounded-2xl flex items-center justify-center p-3 text-primary-container">
                            <span class="material-symbols-outlined text-4xl">account_balance</span>
                        </div>
                        <span class="font-headline font-black text-sm uppercase tracking-widest italic group-hover:text-primary-container transition-colors text-center">Transfer VA</span>
                    </div>

                    <!-- Wallet Points -->
                    <div @click="selectedMethod = 'points'"
                         :class="selectedMethod === 'points' ? 'border-secondary bg-secondary/5 shadow-[0_0_30px_rgba(255,193,7,0.15)] scale-[1.02]' : 'border-white/5 bg-surface-container-low hover:bg-white/5'"
                        class="cursor-pointer p-8 rounded-3xl border-2 transition-all duration-500 group flex flex-col items-center gap-6">
                        <div class="w-16 h-16 bg-secondary/20 rounded-2xl flex items-center justify-center p-4 text-secondary">
                            <span class="material-symbols-outlined text-4xl">stars</span>
                        </div>
                        <span class="font-headline font-black text-sm uppercase tracking-widest italic group-hover:text-secondary transition-colors text-center">Saraga Points</span>
                    </div>
                </div>
            </section>
        </div>

        <!-- Kolom Kanan (Sticky Summary) -->
        <div class="lg:col-span-4 sticky top-32">
            <aside class="glass-card p-10 rounded-[2.5rem] border-white/10 shadow-2xl shadow-black/60 relative overflow-hidden backdrop-blur-3xl">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-primary-container/5 blur-[100px] pointer-events-none"></div>
                
                <div class="space-y-8">
                    <div>
                        <span class="text-[10px] font-label uppercase tracking-widest text-on-surface-variant block mb-3">Unit Lapangan</span>
                        <h3 class="text-3xl font-headline font-black tracking-tighter uppercase italic text-white">{{ $booking->court->nama_lapangan }}</h3>
                        <p class="text-primary-container font-headline font-bold text-sm mt-1 uppercase">{{ $booking->court->venue->nama_venue }}</p>
                    </div>

                    <div class="h-px bg-white/5"></div>

                    <div>
                        <span class="text-[10px] font-label uppercase tracking-widest text-on-surface-variant block mb-4">Jadwal Sesi</span>
                        <div class="flex items-center gap-4 bg-white/10 p-5 rounded-2xl border border-white/5">
                            <span class="material-symbols-outlined text-secondary text-3xl">calendar_today</span>
                            <span class="font-headline font-bold text-sm tracking-tight text-white leading-relaxed uppercase">
                                {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('l, d F Y') }}<br>
                                <span class="text-primary-container">{{ substr($booking->jam_mulai, 0, 5) }} - {{ str_pad((int)substr($booking->jam_mulai, 0, 2) + $booking->durasi, 2, '0', STR_PAD_LEFT) }}:00 {{ $booking->court->venue->timezone }}</span>
                            </span>
                        </div>
                    </div>

                    <div class="h-px bg-white/5"></div>

                    <!-- Price Rincian -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-sm font-label">
                            <span class="text-on-surface-variant opacity-60 uppercase">Harga Sewa</span>
                            <span class="text-on-surface font-bold tracking-tight">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm font-label">
                            <span class="text-on-surface-variant opacity-60 uppercase">Biaya Layanan</span>
                            <span class="text-on-surface font-bold tracking-tight">Rp 2.500</span>
                        </div>
                        <template x-if="usePoints">
                            <div class="flex justify-between items-center text-sm font-headline italic" x-transition>
                                <span class="text-secondary font-black uppercase tracking-tighter">Potongan Poin</span>
                                <span class="text-secondary font-black tracking-tight" x-text="'-' + formatCurrency(pointsDiscount)"></span>
                            </div>
                        </template>
                    </div>

                    <div class="h-px bg-white/5"></div>

                    <div class="flex justify-between items-end pt-4">
                        <span class="text-sm font-headline font-black uppercase tracking-widest italic text-white">Total Bayar</span>
                        <div class="text-right">
                            <span class="text-xs font-label text-outline block mb-1 uppercase tracking-tighter">Kode: {{ $booking->kode_booking }}</span>
                            <span class="text-4xl font-headline font-black text-primary-container tracking-tighter italic" x-text="formatCurrency(getTotal())"></span>
                        </div>
                    </div>

                    <a href="{{ route('booking.payment', $booking->kode_booking) }}" 
                       x-on:click="isProcessing = true"
                       class="w-full bg-primary-container text-on-primary py-6 rounded-2xl font-headline font-black uppercase tracking-[0.2em] text-sm shadow-[0_15px_40px_rgba(0,240,255,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all italic flex items-center justify-center group">
                        <span x-show="!isProcessing" class="flex items-center gap-3">
                            BAYAR SEKARANG
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </span>
                        <span x-show="isProcessing" class="flex items-center gap-3" x-transition>
                            <span class="animate-spin h-5 w-5 border-2 border-on-primary border-t-transparent rounded-full"></span>
                            MEMPROSES...
                        </span>
                    </a>

                    <p class="text-[9px] text-center font-label text-on-surface-variant uppercase tracking-[0.2em] leading-relaxed opacity-40">
                        Dengan membayar, Anda menyetujui Syarat & Ketentuan serta Kebijakan Privasi Saraga Booking.
                    </p>
                </div>
            </aside>
        </div>
    </div>
</main>
@endsection
