@extends('layouts.app')

@section('title', 'Pembayaran QRIS — SARAGA Booking')

@section('content')
<main class="max-w-3xl mx-auto px-6 py-12 md:py-24" x-data="{ 
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
    <header class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-headline font-extrabold tracking-tighter mb-4 text-white uppercase italic">
            Pembayaran <span class="text-primary-container">Reservasi</span>
        </h1>
        <p class="text-on-surface-variant font-label text-sm uppercase tracking-widest font-bold">Kode Booking: <span class="text-white">{{ $booking->kode_booking }}</span></p>
    </header>

    <div class="glass-card p-8 md:p-12 rounded-[3rem] border border-white/10 shadow-2xl relative overflow-hidden">
        <div class="absolute -top-32 -left-32 w-64 h-64 bg-primary-container/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="text-center mb-10">
            <p class="text-[10px] font-label uppercase tracking-widest text-on-surface-variant mb-2">Total Pembayaran</p>
            <h2 class="text-5xl font-headline font-black text-primary-container italic tracking-tighter">Rp {{ number_format($booking->total_harga + 2500, 0, ',', '.') }}</h2>
        </div>

        <div class="flex justify-center mb-10">
            <div class="bg-white p-4 rounded-2xl">
                <!-- Dummy QRIS Placeholder -->
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="QRIS" class="w-48 h-48">
            </div>
        </div>

        <form action="{{ route('booking.payment.store', $booking->kode_booking) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="space-y-4">
                <label class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-white block text-center">Upload Bukti Transfer</label>
                <div class="relative w-full h-48 rounded-3xl border-2 border-dashed border-white/20 hover:border-primary-container/50 bg-white/5 transition-all overflow-hidden flex flex-col items-center justify-center cursor-pointer group">
                    <input type="file" name="bukti_pembayaran" required accept="image/*" @change="handleFile($event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                    
                    <div x-show="!previewImage" class="flex flex-col items-center pointer-events-none text-center px-4">
                        <div class="w-12 h-12 rounded-xl bg-primary-container/10 text-primary-container flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">receipt_long</span>
                        </div>
                        <span class="font-headline font-bold text-xs uppercase tracking-widest text-white">Pilih Bukti Pembayaran</span>
                        <span class="text-[9px] font-label text-zinc-500 uppercase tracking-widest mt-1">Format gambar (JPG, PNG) maksimal 2MB</span>
                    </div>
                    
                    <img x-show="previewImage" :src="previewImage" class="absolute inset-0 w-full h-full object-cover z-10" alt="Preview Bukti">
                    <div x-show="previewImage" class="absolute inset-x-0 bottom-0 p-4 bg-gradient-to-t from-black/80 to-transparent z-10 text-center">
                        <span class="text-[10px] font-bold text-white tracking-widest truncate block" x-text="fileName"></span>
                    </div>
                </div>
                @error('bukti_pembayaran')
                    <p class="text-xs text-red-500 font-bold mt-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-primary-container text-on-primary py-5 rounded-2xl font-headline font-black uppercase tracking-[0.2em] text-sm shadow-[0_15px_40px_rgba(0,240,255,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all italic flex items-center justify-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                SAYA SUDAH BAYAR
            </button>
        </form>
    </div>
</main>
@endsection
