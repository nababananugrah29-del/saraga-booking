@extends('layouts.app')

@section('title', 'Saraga Booking - Program Kemitraan Eksklusif')

@section('content')
<main class="relative overflow-hidden min-h-screen flex flex-col items-center justify-center">
    <!-- Ambient Background Glows -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-container/10 rounded-full blur-[120px] -z-10 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-primary-container/5 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

    @if($status === 'guest' || $status === 'unregistered')
        <!-- Hero Section -->
        <section class="pt-24 pb-20 px-8 max-w-screen-2xl mx-auto flex flex-col items-center text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-container-highest/50 border border-outline-variant/30 text-primary-fixed-dim text-sm font-label uppercase tracking-widest mb-8">
                <span class="w-2 h-2 rounded-full bg-primary-container animate-pulse"></span>
                Program Kemitraan Eksklusif
            </div>
            <h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tight text-on-surface max-w-4xl leading-[1.1] mb-8 uppercase italic">
                Jadilah Mitra <span class="text-primary-container">Saraga Booking</span>
            </h1>
            <p class="text-on-surface-variant text-lg md:text-xl max-w-2xl font-light leading-relaxed">
                Tingkatkan okupansi lapangan Anda dan kelola jadwal dengan sistem otomatis kami. Bergabunglah dengan jaringan venue olahraga terbesar.
            </p>
        </section>

        <!-- Registration Form Section -->
        <section class="py-12 px-8 relative w-full">
            <div class="max-w-4xl mx-auto">
                <div class="glass-card p-10 md:p-16 rounded-[3rem] relative overflow-hidden border-white/5 shadow-2xl">
                    <div class="absolute top-0 left-0 w-2 h-full bg-primary-container shadow-[0_0_20px_rgba(0,240,255,0.5)]"></div>
                    <div class="mb-12">
                        <h2 class="font-headline text-4xl font-extrabold italic uppercase tracking-tighter text-white mb-4">Formulir Pendaftaran Mitra</h2>
                        <p class="text-on-surface-variant font-label text-sm uppercase tracking-widest opacity-60">Lengkapi data di bawah ini untuk memulai langkah sukses venue Anda.</p>
                    </div>
                    
                    @if(!Auth::check())
                        <div class="bg-primary-container/10 border border-primary-container/20 p-8 rounded-3xl mb-10 flex items-center justify-between">
                            <p class="text-primary-container font-headline font-bold italic">Anda harus login terlebih dahulu untuk mendaftar sebagai mitra.</p>
                            <a href="{{ route('login') }}" class="bg-primary-container text-on-primary px-8 py-3 rounded-xl font-headline font-black uppercase text-xs tracking-widest transition-transform hover:scale-105 active:scale-95">Login Sekarang</a>
                        </div>
                    @endif

                    <form action="{{ route('kemitraan.store') }}" method="POST" class="space-y-10 {{ !Auth::check() ? 'opacity-30 pointer-events-none' : '' }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <!-- Field: Nama Pemilik -->
                            <div class="space-y-3">
                                <label class="block font-label text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500" for="nama_pemilik">Nama Pemilik</label>
                                <input name="nama_pemilik" class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary-container focus:ring-0 text-on-surface font-headline font-bold text-xl py-4 transition-all duration-300" id="nama_pemilik" placeholder="Nama Lengkap Sesuai KTP" type="text" required>
                            </div>
                            <!-- Field: Nama Venue -->
                            <div class="space-y-3">
                                <label class="block font-label text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500" for="nama_gedung">Nama Gedung/Venue</label>
                                <input name="nama_gedung" class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary-container focus:ring-0 text-on-surface font-headline font-bold text-xl py-4 transition-all duration-300" id="nama_gedung" placeholder="Contoh: Saraga Sports Center" type="text" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <!-- Field: Kota/Lokasi -->
                            <div class="space-y-3">
                                <label class="block font-label text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500" for="regency_id">Kota / Kabupaten</label>
                                <select name="regency_id" id="regency_id" class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary-container focus:ring-0 text-on-surface font-headline font-bold text-xl py-4 transition-all duration-300 appearance-none cursor-pointer" required>
                                    <option value="" disabled selected class="bg-[#121317]">Pilih Kota Lokasi Venue...</option>
                                    @foreach($regencies as $regency)
                                        <option value="{{ $regency->id }}" class="bg-[#121317]">{{ $regency->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Field: Alamat -->
                            <div class="space-y-3">
                                <label class="block font-label text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500" for="alamat">Alamat Lengkap</label>
                                <input name="alamat" class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary-container focus:ring-0 text-on-surface font-headline font-bold text-xl py-4 transition-all duration-300" id="alamat" placeholder="Jl. Raya Utama No. 123" type="text" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <!-- Field: WhatsApp -->
                            <div class="space-y-3">
                                <label class="block font-label text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500" for="whatsapp">Nomor WhatsApp</label>
                                <div class="relative">
                                    <span class="absolute left-0 top-1/2 -translate-y-1/2 text-zinc-400 font-headline font-bold text-xl">+62</span>
                                    <input name="whatsapp" class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary-container focus:ring-0 text-on-surface font-headline font-bold text-xl py-4 pl-12 transition-all duration-300" id="whatsapp" placeholder="812-3456-7890" type="tel" required>
                                </div>
                            </div>
                            <!-- Field: Submit -->
                            <div class="flex items-end">
                                <button class="w-full bg-primary-container text-on-primary font-headline font-black px-12 py-5 rounded-2xl hover:scale-[1.02] active:scale-[0.98] transition-all shadow-[0_15px_40px_rgba(0,240,255,0.3)] uppercase tracking-[0.2em] italic text-sm" type="submit">
                                    Daftar Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    @elseif($status === 'pending_audit')
        <div class="max-w-2xl text-center space-y-10 py-32">
            <div class="w-32 h-32 bg-primary-container/10 rounded-[2rem] border border-primary-container/20 flex items-center justify-center mx-auto animate-bounce">
                <span class="material-symbols-outlined text-6xl text-primary-container" style="font-variation-settings: 'FILL' 1;">manage_accounts</span>
            </div>
            <div>
                <h2 class="text-4xl font-headline font-black italic uppercase tracking-tighter text-white mb-4">Pendaftaran Sedang Diaudit</h2>
                <p class="text-lg text-on-surface-variant font-label leading-relaxed px-10">Tim Saraga sedang meninjau data venue <strong>{{ $venue->nama_venue }}</strong>. Kami akan segera menghubungi Anda melalui WhatsApp setelah audit selesai.</p>
            </div>
            <div class="pt-6">
                <span class="px-6 py-2 rounded-full bg-white/5 border border-white/10 text-zinc-500 text-[10px] font-black tracking-widest uppercase italic">Status: PENDING AUDIT</span>
            </div>
        </div>

    @elseif($status === 'approved_waiting_payment')
        <div class="max-w-4xl w-full px-8 py-32 text-center space-y-12">
            <div class="w-32 h-32 bg-green-500/10 rounded-[2rem] border border-green-500/20 flex items-center justify-center mx-auto shadow-[0_0_50px_rgba(34,197,94,0.1)]">
                <span class="material-symbols-outlined text-6xl text-green-400" style="font-variation-settings: 'FILL' 1;">verified</span>
            </div>
            <div>
                <h2 class="text-5xl font-headline font-black italic uppercase tracking-tighter text-white mb-6 animate-pulse">Audit Disetujui!</h2>
                <p class="text-xl text-on-surface-variant font-label max-w-2xl mx-auto leading-relaxed">Selamat! Venue <strong>{{ $venue->nama_venue }}</strong> telah lolos audit. Langkah terakhir adalah memilih paket langganan untuk mengaktifkan dashboard vendor Anda.</p>
            </div>
            
            <div class="pt-10 flex justify-center">
                <a href="{{ route('mitra.pembayaran') }}" class="group relative px-12 py-6 bg-primary-container text-on-primary rounded-2xl font-headline font-black uppercase text-sm tracking-[0.2em] italic shadow-[0_20px_50px_rgba(0,240,255,0.4)] hover:scale-105 transition-all">
                    Lanjut ke Pembayaran
                    <span class="material-symbols-outlined absolute -right-4 -top-4 bg-white text-on-primary p-2 rounded-full scale-0 group-hover:scale-100 transition-all shadow-xl">arrow_forward</span>
                </a>
            </div>
        </div>

    @elseif($status === 'payment_pending')
        <div class="max-w-2xl text-center space-y-12 py-32">
            <div class="w-32 h-32 bg-secondary/10 rounded-[2rem] border border-secondary/20 flex items-center justify-center mx-auto animate-pulse">
                <span class="material-symbols-outlined text-6xl text-secondary" style="font-variation-settings: 'FILL' 1;">payments</span>
            </div>
            <div>
                <h2 class="text-4xl font-headline font-black italic uppercase tracking-tighter text-white mb-4">Menunggu Verifikasi Pembayaran</h2>
                <p class="text-lg text-on-surface-variant font-label leading-relaxed px-10">Terima kasih! Kami telah menerima bukti pembayaran Anda. Admin sedang memverifikasi transaksi Anda dalam <strong class="text-secondary">24 jam</strong> ke depan.</p>
            </div>
            <div class="flex flex-col gap-4 items-center">
                <span class="px-6 py-2 rounded-full bg-secondary/10 border border-secondary/20 text-secondary text-[10px] font-black tracking-widest uppercase italic">Status: AWITING VERIFICATION</span>
                <p class="text-xs text-zinc-600 font-label italic uppercase tracking-wider">Akses vendor Anda akan terbuka secara otomatis setelah disetujui.</p>
            </div>
        </div>
    @endif
</main>
@endsection
