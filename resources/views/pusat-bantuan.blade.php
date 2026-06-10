@extends('layouts.app')

@section('title', 'Pusat Bantuan — SARAGA Booking')

@section('content')
<main class="min-h-screen pt-32 pb-24 relative overflow-hidden">
    {{-- Background Hero Gradient --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[600px] bg-[radial-gradient(circle_at_top_center,rgba(0,240,255,0.08)_0%,rgba(18,19,23,0)_70%)] pointer-events-none -z-10"></div>

    {{-- Hero Section --}}
    <section class="max-w-4xl mx-auto px-6 text-center mb-24">
        <h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter mb-10 leading-tight text-on-surface">
            Ada yang bisa kami bantu?
        </h1>
        <div class="relative max-w-2xl mx-auto group">
            <div class="absolute inset-0 bg-primary-container/10 blur-3xl rounded-full opacity-0 group-focus-within:opacity-100 transition-opacity duration-500"></div>
            <div class="relative glass-card flex items-center px-8 py-5 rounded-full border-white/10 group-focus-within:border-primary-container/40 transition-all duration-300">
                <span class="material-symbols-outlined text-primary-container mr-4" style="font-variation-settings: 'FILL' 1;">search</span>
                <input type="text" class="bg-transparent border-none focus:ring-0 w-full text-on-surface placeholder:text-outline text-lg font-label" placeholder="Cari topik atau pertanyaan...">
            </div>
        </div>
    </section>

    {{-- Help Categories --}}
    <section class="max-w-7xl mx-auto px-8 mb-32">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            {{-- Category: Akun & Profil --}}
            <div class="glass-card p-10 rounded-[2rem] border-white/5 hover:border-primary-container/30 transition-all duration-500 group cursor-pointer">
                <div class="w-16 h-16 bg-surface-container-high rounded-2xl flex items-center justify-center mb-8 group-hover:bg-primary-container/20 transition-colors duration-500">
                    <span class="material-symbols-outlined text-primary-container text-3xl" style="font-variation-settings: 'FILL' 1;">account_circle</span>
                </div>
                <h3 class="font-headline text-2xl font-bold mb-4">Akun & Profil</h3>
                <p class="font-label text-on-surface-variant leading-relaxed opacity-80">
                    Masalah login, lupa kata sandi, atau ingin mengubah data diri Anda dengan aman.
                </p>
            </div>

            {{-- Category: Pemesanan & Pembayaran --}}
            <div class="glass-card p-10 rounded-[2rem] border-white/5 hover:border-primary-container/30 transition-all duration-500 group cursor-pointer">
                <div class="w-16 h-16 bg-surface-container-high rounded-2xl flex items-center justify-center mb-8 group-hover:bg-primary-container/20 transition-colors duration-500">
                    <span class="material-symbols-outlined text-primary-container text-3xl" style="font-variation-settings: 'FILL' 1;">payments</span>
                </div>
                <h3 class="font-headline text-2xl font-bold mb-4">Pemesanan & Pembayaran</h3>
                <p class="font-label text-on-surface-variant leading-relaxed opacity-80">
                    Panduan cara booking lapangan, konfirmasi pembayaran, dan informasi kebijakan refund.
                </p>
            </div>

            {{-- Category: Kemitraan --}}
            <div class="glass-card p-10 rounded-[2rem] border-white/5 hover:border-primary-container/30 transition-all duration-500 group cursor-pointer">
                <div class="w-16 h-16 bg-surface-container-high rounded-2xl flex items-center justify-center mb-8 group-hover:bg-primary-container/20 transition-colors duration-500">
                    <span class="material-symbols-outlined text-primary-container text-3xl" style="font-variation-settings: 'FILL' 1;">stadium</span>
                </div>
                <h3 class="font-headline text-2xl font-bold mb-4">Kemitraan</h3>
                <p class="font-label text-on-surface-variant leading-relaxed opacity-80">
                    Pertanyaan seputar pendaftaran pemilik lapangan, manajemen jadwal, dan bagi hasil.
                </p>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="max-w-4xl mx-auto px-8 mb-32" x-data="{ active: null }">
        <div class="text-center mb-16">
            <span class="font-label text-secondary-fixed-dim font-bold uppercase tracking-[0.3em] text-[10px]">Pertanyaan Populer</span>
            <h2 class="font-headline text-4xl font-extrabold tracking-tight mt-4 text-on-surface">Paling Sering Ditanyakan</h2>
        </div>

        <div class="space-y-4">
            {{-- FAQ Item 1 --}}
            <div class="glass-card border border-white/5 rounded-2xl overflow-hidden">
                <button @click="active !== 1 ? active = 1 : active = null" class="w-full flex justify-between items-center p-8 text-left hover:bg-white/5 transition-colors duration-300">
                    <span class="font-headline font-bold text-lg">Bagaimana cara membatalkan pesanan saya?</span>
                    <span class="material-symbols-outlined text-outline transition-transform duration-300" :class="active === 1 ? 'rotate-180 text-primary-container' : ''">expand_more</span>
                </button>
                <div x-show="active === 1" x-collapse x-cloak>
                    <div class="p-8 pt-2 font-label text-on-surface-variant leading-relaxed opacity-80 border-t border-white/5">
                        Anda dapat membatalkan pesanan melalui menu 'Riwayat Pesanan' di profil Anda maksimal 24 jam sebelum jadwal pertandingan dimulai. Refund akan diproses sesuai metode pembayaran awal.
                    </div>
                </div>
            </div>

            {{-- FAQ Item 2 --}}
            <div class="glass-card border border-white/5 rounded-2xl overflow-hidden">
                <button @click="active !== 2 ? active = 2 : active = null" class="w-full flex justify-between items-center p-8 text-left hover:bg-white/5 transition-colors duration-300">
                    <span class="font-headline font-bold text-lg">Metode pembayaran apa saja yang tersedia?</span>
                    <span class="material-symbols-outlined text-outline transition-transform duration-300" :class="active === 2 ? 'rotate-180 text-primary-container' : ''">expand_more</span>
                </button>
                <div x-show="active === 2" x-collapse x-cloak>
                    <div class="p-8 pt-2 font-label text-on-surface-variant leading-relaxed opacity-80 border-t border-white/5">
                        Kami menerima berbagai metode pembayaran digital mulai dari Virtual Account (Bank Mandiri, BCA, BRI, BNI), QRIS (OVO, GoPay, Dana), hingga kartu kredit ternama.
                    </div>
                </div>
            </div>

            {{-- FAQ Item 3 --}}
            <div class="glass-card border border-white/5 rounded-2xl overflow-hidden">
                <button @click="active !== 3 ? active = 3 : active = null" class="w-full flex justify-between items-center p-8 text-left hover:bg-white/5 transition-colors duration-300">
                    <span class="font-headline font-bold text-lg">Apakah saya bisa mengubah jadwal yang sudah dibooking?</span>
                    <span class="material-symbols-outlined text-outline transition-transform duration-300" :class="active === 3 ? 'rotate-180 text-primary-container' : ''">expand_more</span>
                </button>
                <div x-show="active === 3" x-collapse x-cloak>
                    <div class="p-8 pt-2 font-label text-on-surface-variant leading-relaxed opacity-80 border-t border-white/5">
                        Perubahan jadwal dapat dilakukan jika lapangan masih tersedia di jam yang baru. Silakan hubungi dukungan pelanggan kami atau batalkan pesanan lama dan buat pesanan baru.
                    </div>
                </div>
            </div>

            {{-- FAQ Item 4 --}}
            <div class="glass-card border border-white/5 rounded-2xl overflow-hidden">
                <button @click="active !== 4 ? active = 4 : active = null" class="w-full flex justify-between items-center p-8 text-left hover:bg-white/5 transition-colors duration-300">
                    <span class="font-headline font-bold text-lg">Bagaimana cara mendaftarkan lapangan saya?</span>
                    <span class="material-symbols-outlined text-outline transition-transform duration-300" :class="active === 4 ? 'rotate-180 text-primary-container' : ''">expand_more</span>
                </button>
                <div x-show="active === 4" x-collapse x-cloak>
                    <div class="p-8 pt-2 font-label text-on-surface-variant leading-relaxed opacity-80 border-t border-white/5">
                        Buka halaman 'Kemitraan', isi formulir pendaftaran, dan tim kami akan menghubungi Anda untuk verifikasi data dan tinjauan lokasi.
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Support Section --}}
    <section class="max-w-5xl mx-auto px-8 text-center child-glow">
        <div class="glass-card py-20 px-12 rounded-[3rem] border border-primary-container/10 relative overflow-hidden">
            {{-- Decorative Background --}}
            <div class="absolute -top-32 -right-32 w-80 h-80 bg-primary-container/5 blur-[120px] rounded-full"></div>
            <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-secondary/5 blur-[120px] rounded-full"></div>

            <h2 class="font-headline text-5xl font-extrabold tracking-tight mb-6 text-on-surface">Masih butuh bantuan?</h2>
            <p class="font-label text-lg text-on-surface-variant mb-14 max-w-2xl mx-auto leading-relaxed opacity-70">
                Tim dukungan kami siap membantu Anda 24/7. Hubungi kami melalui saluran di bawah ini untuk respon yang lebih cepat.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
                {{-- WhatsApp Button --}}
                <a href="https://wa.me/628123456789" class="w-full sm:w-auto flex items-center justify-center gap-4 bg-[#25D366] text-[#0d0e12] font-headline font-black px-12 py-6 rounded-2xl transition-all duration-300 hover:shadow-[0_0_30px_rgba(37,211,102,0.4)] hover:scale-105 active:scale-95">
                    <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">chat</span>
                    Hubungi WhatsApp
                </a>
                {{-- Email Button --}}
                <a href="mailto:support@saragabooking.com" class="w-full sm:w-auto flex items-center justify-center gap-4 glass-card bg-surface-container-highest/60 text-on-surface font-headline font-black px-12 py-6 rounded-2xl border border-white/10 transition-all duration-300 hover:bg-surface-container-high hover:scale-105 active:scale-95">
                    <span class="material-symbols-outlined text-2xl">mail</span>
                    Kirim Email
                </a>
            </div>
        </div>
    </section>
</main>
@endsection
