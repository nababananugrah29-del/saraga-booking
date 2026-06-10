@extends('layouts.app')

@section('title', 'Saraga Partner - Pembayaran Langganan')

@section('content')
<main class="pt-32 pb-24 px-6 max-w-7xl mx-auto" x-data="{ 
    selectedPackage: 'tahunan',
    selectedMethod: 'bank',
    getPrice() {
        return this.selectedPackage === 'tahunan' ? 1500000 : 150000;
    },
    formatCurrency(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID');
    }
}">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Main Content Area -->
        <div class="lg:col-span-8 space-y-16">
            <!-- Header Section -->
            <header class="space-y-6">
                <h1 class="text-5xl md:text-7xl font-extrabold font-headline tracking-tighter text-on-surface leading-[1.1]">
                    Satu Langkah Lagi <br>
                    <span class="text-primary-container italic">Memulai Bisnis Digital</span>
                </h1>
                <p class="text-on-surface-variant font-label text-lg max-w-2xl opacity-70">
                    Pilih paket yang sesuai dengan skala bisnis lapangan Anda dan nikmati kemudahan manajemen secara real-time.
                </p>
            </header>

            <!-- Pricing Grid -->
            <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Paket Bulanan -->
                <div @click="selectedPackage = 'bulanan'" 
                     :class="selectedPackage === 'bulanan' ? 'neon-border bg-surface-container-high' : 'ghost-border hover:bg-surface-container-high'"
                     class="glass-card rounded-3xl p-10 flex flex-col justify-between transition-all duration-500 group cursor-pointer relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/5 blur-3xl rounded-full"></div>
                    <div>
                        <div class="flex justify-between items-start mb-8">
                            <span class="font-label text-[10px] font-bold tracking-[0.2em] uppercase" :class="selectedPackage === 'bulanan' ? 'text-primary-container' : 'text-on-surface-variant'">Paket Bulanan</span>
                            <span class="material-symbols-outlined" :class="selectedPackage === 'bulanan' ? 'text-primary-container' : 'text-on-surface-variant'">calendar_today</span>
                        </div>
                        <div class="mb-10">
                            <span class="text-4xl font-black font-headline italic tracking-tighter" :class="selectedPackage === 'bulanan' ? 'text-white' : 'text-on-surface/60'">Rp 150.000</span>
                            <span class="text-on-surface-variant font-label text-sm">/bulan</span>
                        </div>
                        <ul class="space-y-5 mb-10">
                            <li class="flex items-center gap-4 text-on-surface-variant font-label text-sm">
                                <span class="material-symbols-outlined text-primary-container text-lg">check_circle</span>
                                Kelola 1-2 Lapangan
                            </li>
                            <li class="flex items-center gap-4 text-on-surface-variant font-label text-sm">
                                <span class="material-symbols-outlined text-primary-container text-lg">check_circle</span>
                                Laporan Dasar
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Paket Tahunan (Recommended) -->
                <div @click="selectedPackage = 'tahunan'" 
                     :class="selectedPackage === 'tahunan' ? 'neon-border bg-surface-container-high' : 'ghost-border hover:bg-surface-container-high'"
                     class="glass-card rounded-3xl p-10 flex flex-col justify-between transition-all duration-500 group cursor-pointer relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-primary-container/10 blur-3xl rounded-full"></div>
                    <div>
                        <div class="flex justify-between items-start mb-8">
                            <span class="font-label text-[10px] font-bold tracking-[0.2em] uppercase" :class="selectedPackage === 'tahunan' ? 'text-primary-container' : 'text-on-surface-variant'">Paket Tahunan</span>
                            <div class="bg-secondary/10 px-3 py-1 rounded-full flex items-center gap-2">
                                <span class="material-symbols-outlined text-secondary text-xs" style="font-variation-settings: 'FILL' 1;">military_tech</span>
                                <span class="text-[9px] font-bold text-secondary uppercase tracking-[0.1em]">Verified Partner</span>
                            </div>
                        </div>
                        <div class="mb-10">
                            <span class="text-4xl font-black font-headline italic tracking-tighter" :class="selectedPackage === 'tahunan' ? 'text-white' : 'text-on-surface/60'">Rp 1.500.000</span>
                            <span class="text-on-surface-variant font-label text-sm">/tahun</span>
                            <div class="mt-4 text-secondary font-bold font-label text-[10px] uppercase tracking-widest flex items-center gap-2 bg-secondary/5 w-fit px-3 py-1 rounded-lg">
                                <span class="material-symbols-outlined text-xs">savings</span>
                                Hemat 2 bulan
                            </div>
                        </div>
                        <ul class="space-y-5 mb-10">
                            <li class="flex items-center gap-4 text-on-surface-variant font-label text-sm">
                                <span class="material-symbols-outlined text-primary-container text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                Lapangan Tak Terbatas
                            </li>
                            <li class="flex items-center gap-4 text-on-surface-variant font-label text-sm">
                                <span class="material-symbols-outlined text-primary-container text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                Laporan Pro & Analytics
                            </li>
                            <li class="flex items-center gap-4 text-on-surface-variant font-label text-sm">
                                <span class="material-symbols-outlined text-primary-container text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                Prioritas Support 24/7
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Payment Methods -->
            <section class="space-y-8">
                <h3 class="text-xl font-black font-headline tracking-tighter uppercase italic text-on-surface" style="">Metode Pembayaran</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
                    <div @click="selectedMethod = 'qris'" 
                         :class="selectedMethod === 'qris' ? 'border-primary-container bg-primary-container/5 shadow-[0_0_20px_rgba(0,240,255,0.1)]' : 'border-white/5 bg-surface-container-high'"
                         class="p-8 rounded-[2rem] border-2 flex flex-col items-center gap-4 cursor-pointer transition-all duration-300">
                        <span class="material-symbols-outlined text-3xl" :class="selectedMethod === 'qris' ? 'text-primary-container' : 'text-on-surface-variant'">qr_code_2</span>
                        <span class="font-headline font-black text-xs uppercase tracking-widest italic" :class="selectedMethod === 'qris' ? 'text-primary-container' : 'text-on-surface-variant'">QRIS</span>
                    </div>
                    <div @click="selectedMethod = 'bank'"
                         :class="selectedMethod === 'bank' ? 'border-primary-container bg-primary-container/5 shadow-[0_0_20px_rgba(0,240,255,0.1)]' : 'border-white/5 bg-surface-container-high'"
                         class="p-8 rounded-[2rem] border-2 flex flex-col items-center gap-4 cursor-pointer transition-all duration-300">
                        <span class="material-symbols-outlined text-3xl" :class="selectedMethod === 'bank' ? 'text-primary-container' : 'text-on-surface-variant'">account_balance</span>
                        <span class="font-headline font-black text-xs uppercase tracking-widest italic" :class="selectedMethod === 'bank' ? 'text-primary-container' : 'text-on-surface-variant'">Transfer Bank</span>
                    </div>
                    <div @click="selectedMethod = 'credit'"
                         :class="selectedMethod === 'credit' ? 'border-primary-container bg-primary-container/5 shadow-[0_0_20px_rgba(0,240,255,0.1)]' : 'border-white/5 bg-surface-container-high'"
                         class="p-8 rounded-[2rem] border-2 flex flex-col items-center gap-4 cursor-pointer transition-all duration-300">
                        <span class="material-symbols-outlined text-3xl" :class="selectedMethod === 'credit' ? 'text-primary-container' : 'text-on-surface-variant'">credit_card</span>
                        <span class="font-headline font-black text-xs uppercase tracking-widest italic" :class="selectedMethod === 'credit' ? 'text-primary-container' : 'text-on-surface-variant'">Kartu Kredit</span>
                    </div>
                </div>
            </section>
        </div>

        <!-- Summary Sidebar -->
        <aside class="lg:col-span-4">
            <div class="glass-card rounded-[2.5rem] p-10 sticky top-32 space-y-10 border border-white/10 shadow-2xl relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-container/5 blur-3xl rounded-full"></div>
                
                <h3 class="text-2xl font-black font-headline tracking-tighter uppercase italic border-b border-white/5 pb-6">Ringkasan Pesanan</h3>
                
                <div class="space-y-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Paket Terpilih</p>
                            <p class="text-xl font-headline font-extrabold uppercase italic leading-tight" x-text="selectedPackage === 'tahunan' ? 'Paket Tahunan' : 'Paket Bulanan'"></p>
                        </div>
                        <span class="text-secondary font-black font-headline text-lg italic" x-text="formatCurrency(getPrice())"></span>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between text-sm font-label text-on-surface-variant opacity-60">
                            <span>Subtotal</span>
                            <span x-text="formatCurrency(getPrice())"></span>
                        </div>
                        <div class="flex justify-between text-sm font-label text-on-surface-variant opacity-60">
                            <span>Biaya Layanan</span>
                            <span>Rp 0</span>
                        </div>
                        <div class="flex justify-between text-sm font-label text-primary-container font-black uppercase italic tracking-tighter">
                            <span>Promo Partner</span>
                            <span>-Rp 0</span>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-white/5">
                        <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-2">Total Bayar</p>
                        <p class="text-4xl font-black font-headline text-primary-container tracking-tighter italic" x-text="formatCurrency(getPrice())"></p>
                    </div>
                </div>

                <div class="space-y-6">
                    <form action="{{ route('mitra.pembayaran.konfirmasi') }}" method="POST">
                        @csrf
                        <input type="hidden" name="paket" x-model="selectedPackage">
                        <input type="hidden" name="metode" x-model="selectedMethod">
                        <button type="submit" class="w-full py-6 rounded-2xl font-black font-headline text-sm tracking-[0.2em] premium-gradient text-on-primary shadow-[0_0_30px_rgba(0,240,255,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all uppercase italic">
                            BAYAR SEKARANG
                        </button>
                    </form>
                    <p class="text-[9px] text-center text-on-surface-variant font-label leading-relaxed px-4 opacity-40 uppercase tracking-widest">
                        Dengan melanjutkan, Anda menyetujui Syarat & Ketentuan serta Kebijakan Privasi Saraga Booking.
                    </p>
                </div>

                <!-- Trusted Badge -->
                <div class="flex items-center justify-center gap-6 pt-6 grayscale opacity-20">
                    <span class="material-symbols-outlined text-3xl">verified_user</span>
                    <span class="material-symbols-outlined text-3xl">lock</span>
                    <span class="material-symbols-outlined text-3xl">payments</span>
                </div>
            </div>
        </aside>
    </div>
</main>

<style>
    .ghost-border {
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .neon-border {
        box-shadow: 0 0 20px rgba(0, 240, 255, 0.2);
        border: 2px solid rgba(0, 240, 255, 0.6);
    }
    .premium-gradient {
        background: linear-gradient(135deg, #00f0ff 0%, #00dbe9 100%);
    }
</style>
@endsection
