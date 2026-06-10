@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran — SARAGA Booking')

@section('content')
<main class="pt-32 pb-24 px-6 max-w-5xl mx-auto" x-data="{ 
    previewImage: null,
    fileName: '',
    handleFile(event) {
        const file = event.target.files[0];
        if (file) {
            this.fileName = file.name;
            const reader = new FileReader();
            reader.onload = (e) => { this.previewImage = e.target.result; };
            reader.readAsDataURL(file);
        }
    }
}">
    <!-- Visual Background -->
    <div class="fixed top-0 right-0 -z-10 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] right-[-10%] w-[60%] h-[60%] bg-primary-container/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-secondary/5 rounded-full blur-[100px]"></div>
    </div>

    <!-- Back Button -->
    <a href="{{ route('mitra.pembayaran') }}" class="inline-flex items-center gap-3 text-on-surface-variant hover:text-primary-container transition-colors mb-10 group">
        <span class="material-symbols-outlined text-xl group-hover:-translate-x-1 transition-transform">arrow_back</span>
        <span class="font-label text-xs font-bold uppercase tracking-widest">Kembali ke Pilihan Paket</span>
    </a>

    <!-- Header -->
    <header class="mb-16">
        <h1 class="text-4xl md:text-5xl font-extrabold font-headline tracking-tighter text-on-surface leading-[1.1] uppercase italic">
            Konfirmasi <span class="text-primary-container">Pembayaran</span>
        </h1>
        <p class="text-on-surface-variant font-label text-lg mt-4 opacity-70">
            Selesaikan pembayaran dan upload bukti transfer untuk verifikasi admin.
        </p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Main: Payment Details based on Method -->
        <div class="lg:col-span-7 space-y-10">

            {{-- ==================== QRIS ==================== --}}
            @if($metode === 'qris')
            <div class="glass-card rounded-[2.5rem] p-10 border border-white/10 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-container/5 blur-3xl rounded-full"></div>
                <div class="relative">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 rounded-2xl bg-primary-container/10 border border-primary-container/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-3xl text-primary-container">qr_code_2</span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black font-headline tracking-tighter uppercase italic text-white">Scan QRIS</h2>
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Gunakan e-wallet atau mobile banking</p>
                        </div>
                    </div>

                    <!-- Dummy QRIS Code -->
                    <div class="flex flex-col items-center bg-white p-10 rounded-3xl mb-8 shadow-inner">
                        <div class="relative mb-6">
                            <!-- SVG QRIS Pattern -->
                            <div class="w-64 h-64 bg-[#1a1a2e] rounded-2xl p-4 flex items-center justify-center relative overflow-hidden">
                                <div class="absolute inset-0 bg-white m-2 rounded-xl"></div>
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=SARAGA-BOOKING-PAYMENT-{{ strtoupper(Str::random(10)) }}&color=1a1a2e" 
                                     alt="QRIS Payment"
                                     class="w-full h-full relative z-10 rounded-lg">
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="text-[#1a1a2e] font-headline font-black text-lg uppercase tracking-tight italic">SARAGA BOOKING</p>
                            <p class="text-gray-500 font-label text-xs uppercase tracking-widest mt-1">NMID: ID10{{ rand(10000000, 99999999) }}</p>
                        </div>
                    </div>

                    <div class="bg-primary-container/5 border border-primary-container/20 rounded-2xl p-6 flex items-start gap-4">
                        <span class="material-symbols-outlined text-primary-container text-xl mt-0.5">info</span>
                        <div>
                            <p class="text-sm font-label text-on-surface-variant leading-relaxed">
                                Scan QR code di atas menggunakan aplikasi <strong class="text-white">GoPay, OVO, DANA, ShopeePay, LinkAja</strong>, atau mobile banking Anda. Pembayaran otomatis terverifikasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- ==================== BANK TRANSFER ==================== --}}
            @if($metode === 'bank')
            <div class="glass-card rounded-[2.5rem] p-10 border border-white/10 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-container/5 blur-3xl rounded-full"></div>
                <div class="relative">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 rounded-2xl bg-primary-container/10 border border-primary-container/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-3xl text-primary-container">account_balance</span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black font-headline tracking-tighter uppercase italic text-white">Transfer Bank</h2>
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Transfer sesuai nominal di bawah</p>
                        </div>
                    </div>

                    <!-- Bank Account Cards -->
                    <div class="space-y-6">
                        <!-- BCA -->
                        <div class="bg-surface-container-high rounded-2xl p-8 border border-white/5 hover:border-primary-container/20 transition-all group">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-8 bg-white rounded-lg flex items-center justify-center">
                                        <span class="text-[#003399] font-black text-xs font-headline">BCA</span>
                                    </div>
                                    <div>
                                        <p class="text-xs text-on-surface-variant font-label uppercase tracking-widest">Bank Central Asia</p>
                                    </div>
                                </div>
                                <button onclick="navigator.clipboard.writeText('7820581024'); this.innerText='Tersalin!'; setTimeout(() => this.innerText='Salin', 2000)" 
                                        class="px-4 py-2 rounded-xl bg-primary-container/10 text-primary-container text-[10px] font-black uppercase tracking-widest border border-primary-container/20 hover:bg-primary-container/20 transition-all">
                                    Salin
                                </button>
                            </div>
                            <p class="text-3xl font-black font-headline text-white tracking-widest italic">7820 5810 24</p>
                            <p class="text-xs text-on-surface-variant font-label mt-2 uppercase tracking-widest">a.n. PT SARAGA DIGITAL INDONESIA</p>
                        </div>

                        <!-- Mandiri -->
                        <div class="bg-surface-container-high rounded-2xl p-8 border border-white/5 hover:border-primary-container/20 transition-all group">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-8 bg-white rounded-lg flex items-center justify-center">
                                        <span class="text-[#003087] font-black text-[9px] font-headline">MANDIRI</span>
                                    </div>
                                    <div>
                                        <p class="text-xs text-on-surface-variant font-label uppercase tracking-widest">Bank Mandiri</p>
                                    </div>
                                </div>
                                <button onclick="navigator.clipboard.writeText('1300019405832'); this.innerText='Tersalin!'; setTimeout(() => this.innerText='Salin', 2000)" 
                                        class="px-4 py-2 rounded-xl bg-primary-container/10 text-primary-container text-[10px] font-black uppercase tracking-widest border border-primary-container/20 hover:bg-primary-container/20 transition-all">
                                    Salin
                                </button>
                            </div>
                            <p class="text-3xl font-black font-headline text-white tracking-widest italic">1300 0194 0583 2</p>
                            <p class="text-xs text-on-surface-variant font-label mt-2 uppercase tracking-widest">a.n. PT SARAGA DIGITAL INDONESIA</p>
                        </div>
                    </div>

                    <div class="bg-secondary/5 border border-secondary/20 rounded-2xl p-6 flex items-start gap-4 mt-8">
                        <span class="material-symbols-outlined text-secondary text-xl mt-0.5">warning</span>
                        <div>
                            <p class="text-sm font-label text-on-surface-variant leading-relaxed">
                                Transfer <strong class="text-secondary">tepat sesuai nominal</strong> yang tertera. Pembayaran akan diverifikasi admin dalam <strong class="text-white">1x24 jam</strong> setelah bukti transfer diunggah.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- ==================== KARTU KREDIT ==================== --}}
            @if($metode === 'credit')
            <div class="glass-card rounded-[2.5rem] p-10 border border-white/10 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-container/5 blur-3xl rounded-full"></div>
                <div class="relative">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 rounded-2xl bg-primary-container/10 border border-primary-container/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-3xl text-primary-container">credit_card</span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black font-headline tracking-tighter uppercase italic text-white">Kartu Kredit / Debit</h2>
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Visa, Mastercard, JCB</p>
                        </div>
                    </div>

                    <!-- Dummy Credit Card Form -->
                    <div class="space-y-8">
                        <div class="bg-gradient-to-br from-[#1a1b20] to-[#292a2e] rounded-3xl p-8 border border-white/10 shadow-2xl">
                            <!-- Card Visual -->
                            <div class="flex justify-between items-start mb-10">
                                <span class="material-symbols-outlined text-4xl text-primary-container/60">contactless</span>
                                <div class="flex gap-3">
                                    <div class="w-10 h-7 rounded bg-[#EB001B]/80"></div>
                                    <div class="w-10 h-7 rounded bg-[#F79E1B]/80 -ml-5"></div>
                                </div>
                            </div>
                            <div class="mb-6">
                                <p class="text-2xl font-headline font-black text-white tracking-[0.3em] italic">•••• •••• •••• ••••</p>
                            </div>
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-[9px] font-label text-zinc-500 uppercase tracking-widest mb-1">Card Holder</p>
                                    <p class="text-sm font-headline font-bold text-white uppercase tracking-wide">{{ auth()->user()->name }}</p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-label text-zinc-500 uppercase tracking-widest mb-1">Expires</p>
                                    <p class="text-sm font-headline font-bold text-white tracking-wide">MM/YY</p>
                                </div>
                            </div>
                        </div>

                        <!-- Input Fields (Dummy - for display) -->
                        <div class="space-y-5">
                            <div>
                                <label class="block font-label text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500 mb-3">Nomor Kartu</label>
                                <input type="text" placeholder="1234 5678 9012 3456" maxlength="19"
                                       class="w-full bg-surface-container-high border border-white/10 rounded-2xl px-6 py-5 text-white font-headline font-bold text-lg tracking-widest focus:border-primary-container focus:ring-0 transition-all placeholder:text-zinc-600">
                            </div>
                            <div class="grid grid-cols-2 gap-5">
                                <div>
                                    <label class="block font-label text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500 mb-3">Expired</label>
                                    <input type="text" placeholder="MM / YY" maxlength="7"
                                           class="w-full bg-surface-container-high border border-white/10 rounded-2xl px-6 py-5 text-white font-headline font-bold text-lg tracking-widest focus:border-primary-container focus:ring-0 transition-all placeholder:text-zinc-600">
                                </div>
                                <div>
                                    <label class="block font-label text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500 mb-3">CVV</label>
                                    <input type="password" placeholder="•••" maxlength="4"
                                           class="w-full bg-surface-container-high border border-white/10 rounded-2xl px-6 py-5 text-white font-headline font-bold text-lg tracking-widest focus:border-primary-container focus:ring-0 transition-all placeholder:text-zinc-600">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-primary-container/5 border border-primary-container/20 rounded-2xl p-6 flex items-start gap-4 mt-8">
                        <span class="material-symbols-outlined text-primary-container text-xl mt-0.5">lock</span>
                        <div>
                            <p class="text-sm font-label text-on-surface-variant leading-relaxed">
                                Pembayaran diproses melalui <strong class="text-white">payment gateway terenkripsi</strong>. Data kartu Anda aman dan tidak disimpan di server kami. Upload screenshot konfirmasi pembayaran sebagai bukti.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

        <!-- Right Sidebar: Summary + Upload -->
        <aside class="lg:col-span-5">
            <div class="sticky top-32 space-y-8">
                <!-- Order Summary -->
                <div class="glass-card rounded-[2.5rem] p-10 border border-white/10 shadow-2xl relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-container/5 blur-3xl rounded-full"></div>

                    <h3 class="text-xl font-black font-headline tracking-tighter uppercase italic text-white border-b border-white/5 pb-6 mb-8">Ringkasan Pesanan</h3>
                    
                    <div class="space-y-5 mb-8">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Paket</span>
                            <span class="font-headline font-black text-sm text-white uppercase italic">{{ $paket === 'tahunan' ? 'Paket Tahunan' : 'Paket Bulanan' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Metode</span>
                            <span class="font-headline font-black text-sm text-primary-container uppercase italic">
                                @if($metode === 'qris') QRIS @elseif($metode === 'bank') Transfer Bank @else Kartu Kredit @endif
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Venue</span>
                            <span class="font-label text-sm text-white font-bold">{{ $venue->nama_venue }}</span>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-white/5">
                        <div class="flex justify-between items-end">
                            <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Total Bayar</span>
                            <span class="text-3xl font-black font-headline text-primary-container tracking-tighter italic">Rp {{ number_format($harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Upload Bukti Bayar -->
                <form action="{{ route('mitra.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="paket" value="{{ $paket }}">
                    <input type="hidden" name="metode" value="{{ $metode }}">

                    <div class="glass-card rounded-[2.5rem] p-10 border border-white/10 shadow-2xl space-y-8">
                        <div>
                            <h3 class="text-xl font-black font-headline tracking-tighter uppercase italic text-white mb-2">Upload Bukti Bayar</h3>
                            <p class="text-xs font-label text-on-surface-variant opacity-60 uppercase tracking-widest">Format: JPG, PNG, WEBP (maks 2MB)</p>
                        </div>

                        <!-- Upload Area -->
                        <div class="relative">
                            <input type="file" name="bukti_bayar" id="bukti_bayar" accept="image/*" required
                                   @change="handleFile($event)"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <!-- Default State -->
                            <div x-show="!previewImage" class="border-2 border-dashed border-white/10 rounded-3xl p-12 text-center hover:border-primary-container/40 hover:bg-primary-container/5 transition-all duration-300">
                                <div class="w-20 h-20 rounded-2xl bg-primary-container/10 border border-primary-container/20 flex items-center justify-center mx-auto mb-6">
                                    <span class="material-symbols-outlined text-4xl text-primary-container">cloud_upload</span>
                                </div>
                                <p class="font-headline font-bold text-sm text-white uppercase italic tracking-tight mb-2">Klik atau Seret Gambar Kesini</p>
                                <p class="text-[10px] font-label text-on-surface-variant uppercase tracking-widest opacity-50">Screenshot bukti pembayaran Anda</p>
                            </div>

                            <!-- Preview State -->
                            <div x-show="previewImage" x-cloak class="relative rounded-3xl overflow-hidden border-2 border-primary-container/30">
                                <img :src="previewImage" class="w-full h-64 object-cover" alt="Preview">
                                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-primary-container">image</span>
                                        <span class="text-xs font-label font-bold text-white truncate" x-text="fileName"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @error('bukti_bayar')
                            <p class="text-red-400 text-xs font-label uppercase tracking-widest">{{ $message }}</p>
                        @enderror

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full py-6 rounded-2xl font-black font-headline text-sm tracking-[0.2em] bg-primary-container text-on-primary shadow-[0_15px_40px_rgba(0,240,255,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all uppercase italic flex items-center justify-center gap-3">
                            <span class="material-symbols-outlined">send</span>
                            KIRIM BUKTI PEMBAYARAN
                        </button>
                    </div>
                </form>

                <!-- Security Badge -->
                <div class="flex items-center justify-center gap-6 pt-2 grayscale opacity-20">
                    <span class="material-symbols-outlined text-2xl">verified_user</span>
                    <span class="material-symbols-outlined text-2xl">lock</span>
                    <span class="material-symbols-outlined text-2xl">payments</span>
                </div>
            </div>
        </aside>
    </div>
</main>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
