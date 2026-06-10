@extends('layouts.vendor')

@section('title', 'Manajemen Pesanan — Elite Arena')

@section('content')
<div x-data="{
    orders: @js($orders),
    showCheckInModal: false,
    showVerifyModal: false,
    selectedOrder: null,
    checkInCode: '',
    alasanTolak: '',
    
    openCheckIn(order) {
        if (order.status !== 'lunas' || order.is_checked_in) return;
        this.selectedOrder = order;
        this.checkInCode = '';
        this.showCheckInModal = true;
    },
    
    openVerify(order) {
        this.selectedOrder = order;
        this.alasanTolak = '';
        this.showVerifyModal = true;
    },

    confirmPayment(action) {
        if (action === 'reject' && !this.alasanTolak) {
            alert('Catatan penolakan harus diisi!');
            return;
        }

        fetch(`/mitra/pesanan/verifikasi`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                booking_id: this.selectedOrder.id,
                action: action,
                alasan_penolakan: this.alasanTolak
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                this.selectedOrder.status = action === 'approve' ? 'lunas' : 'batal';
                this.showVerifyModal = false;
                alert(data.message);
            } else {
                alert(data.message || 'Gagal memproses.');
            }
        });
    },

    confirmCheckIn() {
        if (!this.checkInCode) {
            alert('Silakan masukkan Kode Booking!');
            return;
        }

        fetch(`/mitra/pesanan/checkin`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                booking_id: this.selectedOrder.id,
                kode_booking: this.checkInCode
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                this.selectedOrder.status = 'sedang_main';
                this.selectedOrder.is_checked_in = true;
                this.showCheckInModal = false;
                alert(data.message);
            } else {
                alert(data.message || 'Gagal melakukan check-in.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan koneksi.');
        });
    },
    getStatusLabel(status) {
        const labels = {
            'lunas': 'Lunas',
            'pending': 'Menunggu Bayar',
            'menunggu_verifikasi': 'Perlu Verifikasi',
            'sedang_main': 'Sedang Main',
            'dibatalkan': 'Dibatalkan',
            'batal': 'Dibatalkan'
        };
        return labels[status] || status;
    },
    getStatusClass(status) {
        switch(status) {
            case 'lunas': return 'bg-primary-container/10 text-primary-container';
            case 'pending': return 'bg-secondary/10 text-secondary';
            case 'menunggu_verifikasi': return 'bg-orange-500/10 text-orange-400 border border-orange-500/20 shadow-[0_0_15px_rgba(249,115,22,0.2)]';
            case 'sedang_main': return 'bg-green-500/10 text-green-400 border border-green-500/20 shadow-[0_0_15px_rgba(34,197,94,0.2)]';
            case 'batal':
            case 'dibatalkan': return 'bg-red-500/10 text-red-400';
            default: return 'bg-white/5 text-on-surface-variant';
        }
    },
    getDotClass(status) {
        switch(status) {
            case 'lunas': return 'bg-primary-container';
            case 'pending': return 'bg-secondary';
            case 'menunggu_verifikasi': return 'bg-orange-400';
            case 'sedang_main': return 'bg-green-400';
            case 'batal':
            case 'dibatalkan': return 'bg-red-400';
            default: return 'bg-white/40';
        }
    }
}">
    <!-- Header Section -->
    <div class="mb-12">
        <h2 class="text-4xl font-headline font-black tracking-tighter text-on-surface mb-3 uppercase italic">Manajemen Pesanan</h2>
        <p class="text-on-surface-variant font-medium tracking-wide opacity-70">Kelola jadwal dan pesanan lapangan secara real-time.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="glass-card p-10 rounded-3xl flex flex-col justify-between transition-all hover:translate-y-[-5px]">
            <div class="flex justify-between items-start mb-6">
                <p class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em]">Pesanan Masuk</p>
                <div class="p-2 bg-primary-container/10 rounded-lg">
                    <span class="material-symbols-outlined text-primary-container">event_available</span>
                </div>
            </div>
            <div class="flex items-baseline gap-3">
                <span class="text-6xl font-headline font-black text-on-surface italic">24</span>
                <span class="text-primary-container font-black text-sm tracking-widest">+12%</span>
            </div>
        </div>

        <div class="glass-card p-10 rounded-3xl flex flex-col justify-between transition-all hover:translate-y-[-5px]">
            <div class="flex justify-between items-start mb-6">
                <p class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em]">Pendapatan Booking</p>
                <div class="p-2 bg-secondary/10 rounded-lg">
                    <span class="material-symbols-outlined text-secondary">payments</span>
                </div>
            </div>
            <div class="flex items-baseline gap-3">
                <span class="text-5xl font-headline font-black text-secondary italic tracking-tighter">Rp 4.250k</span>
            </div>
        </div>

        <div class="glass-card p-10 rounded-3xl flex flex-col justify-between transition-all hover:translate-y-[-5px]">
            <div class="flex justify-between items-start mb-6">
                <p class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em]">Okupansi Jadwal</p>
                <div class="p-2 bg-primary-container/10 rounded-lg">
                    <span class="material-symbols-outlined text-primary-container">speed</span>
                </div>
            </div>
            <div>
                <div class="flex justify-between items-end mb-4">
                    <span class="text-5xl font-headline font-black text-on-surface italic">85%</span>
                    <span class="text-on-surface-variant font-bold text-xs opacity-50 uppercase tracking-widest">34/40 Jam</span>
                </div>
                <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-primary-container h-full w-[85%] shadow-[0_0_15px_rgba(0,240,255,0.4)]"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Controls -->
    <div class="flex flex-col md:flex-row gap-6 mb-8">
        <div class="flex-1 relative group">
            <span class="material-symbols-outlined absolute left-6 top-1/2 -translate-y-1/2 text-on-surface-variant/40">search</span>
            <input type="text" placeholder="Cari Nama User atau ID Booking..." class="w-full bg-white/5 border border-white/5 rounded-2xl pl-16 pr-6 py-5 font-headline font-bold text-on-surface placeholder:text-on-surface-variant/30 focus:ring-1 focus:ring-primary-container transition-all">
        </div>
        <div class="flex gap-4">
            <button class="bg-white/5 text-on-surface px-8 py-5 rounded-2xl font-headline font-black text-xs uppercase tracking-widest flex items-center gap-3 border border-white/5 hover:bg-white/10 transition-all italic">
                <span class="material-symbols-outlined text-sm">filter_list</span>
                Filter
            </button>
            <button @click="$dispatch('open-create-order')" class="bg-primary-container text-on-primary px-8 py-5 rounded-2xl font-headline font-black text-xs uppercase tracking-widest flex items-center gap-3 shadow-[0_15px_40px_rgba(0,240,255,0.2)] hover:scale-[1.02] transition-all italic">
                <span class="material-symbols-outlined text-sm">add</span>
                Tambah Booking Manual
            </button>
        </div>
    </div>

    <!-- Table Section -->
    <div class="glass-card rounded-[2.5rem] overflow-hidden mb-16 border-white/5 shadow-2xl">
        <div class="p-10 overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="text-on-surface-variant font-label text-[10px] uppercase tracking-[0.3em] border-b border-white/5">
                        <th class="pb-10 px-4 font-black">ID Booking</th>
                        <th class="pb-10 px-4 font-black">Nama User</th>
                        <th class="pb-10 px-4 font-black text-center">Waktu & Lapangan</th>
                        <th class="pb-10 px-4 font-black text-center">Status Bayar</th>
                        <th class="pb-10 px-4 font-black text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <template x-if="orders.length === 0">
                        <tr>
                            <td colspan="5" class="py-24 text-center">
                                <div class="flex flex-col items-center gap-6 opacity-40">
                                    <span class="material-symbols-outlined text-6xl">receipt_long</span>
                                    <div>
                                        <p class="font-headline font-black text-xl uppercase italic tracking-widest">Belum ada pesanan masuk</p>
                                        <p class="font-label text-xs mt-2">Data pesanan otomatis akan tampil di sini.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template x-for="order in orders" :key="order.id">
                        <tr class="group hover:bg-white/[0.02] transition-all duration-300">
                            <td class="py-10 px-4">
                                <span class="font-headline font-black text-primary-container italic transition-all group-hover:scale-105 inline-block" x-text="order.kode_booking"></span>
                            </td>
                            <td class="py-10 px-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-[10px] font-black font-headline border border-white/10" x-text="order.user.name.substring(0, 2).toUpperCase()"></div>
                                    <span class="font-headline font-black text-on-surface uppercase tracking-tight italic" x-text="order.user.name"></span>
                                </div>
                            </td>
                            <td class="py-10 px-4 text-center">
                                <div class="flex flex-col">
                                    <span class="text-on-surface font-black font-headline text-sm italic" x-text="order.tanggal"></span>
                                    <span class="text-on-surface-variant text-[10px] uppercase font-bold tracking-widest mt-1 opacity-60">
                                        <span x-text="order.jam_mulai.substring(0, 5)"></span> • <span class="text-secondary" x-text="order.court.nama_lapangan"></span>
                                    </span>
                                </div>
                            </td>
                            <td class="py-10 px-4">
                                <div class="flex justify-center">
                                    <span :class="getStatusClass(order.status)" class="inline-flex items-center px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-widest transition-all duration-500">
                                        <span :class="getDotClass(order.status)" class="w-2 h-2 rounded-full mr-3" :class="order.status === 'sedang_main' ? 'animate-pulse' : ''"></span>
                                        <span x-text="getStatusLabel(order.status)"></span>
                                    </span>
                                </div>
                            </td>
                            <td class="py-10 px-4 text-right">
                                <template x-if="order.status === 'menunggu_verifikasi'">
                                    <button @click="openVerify(order)" 
                                            class="px-8 py-3 rounded-2xl font-headline font-black text-xs uppercase tracking-widest italic transition-all active:scale-95 bg-orange-500/20 text-orange-400 border border-orange-500/30 shadow-[0_10px_20px_rgba(249,115,22,0.2)] hover:bg-orange-500/30">
                                        Cek Bayar
                                    </button>
                                </template>
                                <template x-if="order.status !== 'menunggu_verifikasi'">
                                    <button @click="openCheckIn(order)" 
                                            :disabled="order.status !== 'lunas' || order.is_checked_in"
                                            :class="order.status === 'lunas' && !order.is_checked_in ? 'bg-primary-container text-on-primary hover:brightness-110 shadow-[0_10px_20px_rgba(0,240,255,0.2)]' : 'bg-white/5 text-on-surface-variant cursor-not-allowed'"
                                            class="px-8 py-3 rounded-2xl font-headline font-black text-xs uppercase tracking-widest italic transition-all active:scale-95">
                                        <span x-text="order.is_checked_in ? 'Checked In' : 'Check-in'"></span>
                                    </button>
                                </template>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="px-10 py-8 bg-white/[0.02] flex justify-between items-center border-t border-white/5">
            <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-widest opacity-40">Menampilkan 4 dari 48 pesanan</p>
            <div class="flex gap-3">
                <button class="w-12 h-12 flex items-center justify-center rounded-xl border border-white/5 text-on-surface hover:bg-white/10 transition-all">
                    <span class="material-symbols-outlined font-black">chevron_left</span>
                </button>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-primary-container text-on-primary font-black font-headline italic">1</button>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl border border-white/5 text-on-surface hover:bg-white/10 transition-all font-black font-headline italic">2</button>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl border border-white/5 text-on-surface hover:bg-white/10 transition-all">
                    <span class="material-symbols-outlined font-black">chevron_right</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Check-in Modal -->
    <div x-show="showCheckInModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-background/80 backdrop-blur-sm"
         style="display: none;">
        
        <div class="glass-card w-full max-w-md p-10 rounded-[2.5rem] border-white/10 shadow-2xl relative overflow-hidden" @click.away="showCheckInModal = false">
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-primary-container/10 blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10">
                <header class="mb-10 text-center">
                    <div class="w-20 h-20 bg-primary-container/10 rounded-3xl mx-auto flex items-center justify-center mb-6 border border-primary-container/20">
                        <span class="material-symbols-outlined text-primary-container text-4xl">verified_user</span>
                    </div>
                    <h3 class="text-3xl font-headline font-black uppercase italic tracking-tighter text-white">Verifikasi Check-in</h3>
                    <p class="text-on-surface-variant text-xs font-bold uppercase tracking-widest mt-2" x-text="selectedOrder ? selectedOrder.user.name : ''"></p>
                </header>

                <div class="space-y-8">
                    <div class="space-y-4 text-center">
                        <label class="text-[10px] font-label font-black text-on-surface-variant uppercase tracking-[0.3em]">Masukkan Kode Booking</label>
                        <input type="text" 
                               x-model="checkInCode" 
                               placeholder="Contoh: SRG-XXXX" 
                               class="w-full bg-transparent border-0 border-b-2 border-white/10 focus:border-primary-container focus:ring-0 text-center text-3xl font-headline font-black text-primary-container tracking-widest uppercase py-4 transition-all duration-300 placeholder:text-white/5">
                        <p class="text-[9px] text-on-surface-variant font-bold italic opacity-40 uppercase tracking-widest leading-relaxed text-center">
                            Pastikan karakter besar/kecil sesuai (Case-Sensitive).
                        </p>
                    </div>

                    <div class="flex flex-col gap-4">
                        <button @click="confirmCheckIn()" class="w-full bg-primary-container text-on-primary py-5 rounded-2xl font-headline font-black uppercase tracking-[0.2em] text-xs shadow-[0_15px_40px_rgba(0,240,255,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all italic">
                            Validasi & Check-in
                        </button>
                        <button @click="showCheckInModal = false" class="w-full bg-white/5 text-on-surface-variant py-5 rounded-2xl font-headline font-black uppercase tracking-[0.2em] text-[10px] hover:bg-white/10 transition-all italic border border-white/5">
                            Batalkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Verify Payment Modal -->
    <div x-show="showVerifyModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-background/90 backdrop-blur-md overflow-y-auto"
         style="display: none;">
        
        <div class="my-auto w-full max-w-3xl glass-card p-10 rounded-[2.5rem] border-white/10 shadow-2xl relative overflow-hidden" @click.away="showVerifyModal = false">
            <div class="absolute -top-32 -left-32 w-64 h-64 bg-secondary/10 blur-3xl pointer-events-none"></div>
            
            <button @click="showVerifyModal = false" class="absolute top-8 right-8 w-10 h-10 bg-white/5 border border-white/10 rounded-full flex items-center justify-center hover:bg-white/10 transition-colors z-20">
                <span class="material-symbols-outlined text-white">close</span>
            </button>

            <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-10">
                
                <!-- Kiri: Foto Bukti Transfer -->
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-headline font-black uppercase italic tracking-tighter text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary">receipt_long</span> 
                            Bukti Pembayaran
                        </h3>
                        <template x-if="selectedOrder && selectedOrder.bukti_pembayaran">
                            <a :href="selectedOrder.bukti_pembayaran" :download="'Bukti_Pembayaran_' + selectedOrder.kode_booking + (selectedOrder.bukti_pembayaran.match(/\.[0-9a-z]+$/i) ? selectedOrder.bukti_pembayaran.match(/\.[0-9a-z]+$/i)[0] : '')" target="_blank" class="flex items-center gap-2 text-[10px] font-headline font-black uppercase tracking-widest text-secondary hover:text-white transition-all bg-secondary/10 hover:bg-secondary/20 px-4 py-2 rounded-xl border border-secondary/20 hover:scale-105">
                                <span class="material-symbols-outlined text-sm">download</span> Unduh
                            </a>
                        </template>
                    </div>
                    <div class="w-full h-96 bg-surface-container-high rounded-3xl border border-white/5 overflow-hidden flex items-center justify-center">
                        <template x-if="selectedOrder && selectedOrder.bukti_pembayaran">
                            <img :src="selectedOrder.bukti_pembayaran" class="w-full h-full object-cover cursor-zoom-in hover:scale-105 transition-transform duration-500">
                        </template>
                        <template x-if="!selectedOrder || !selectedOrder.bukti_pembayaran">
                            <span class="text-on-surface-variant text-sm font-label uppercase tracking-widest opacity-50">Tidak ada gambar</span>
                        </template>
                    </div>
                </div>

                <!-- Kanan: Detail & Form -->
                <div class="flex flex-col h-full">
                    <h3 class="text-xl font-headline font-black uppercase italic tracking-tighter text-white mb-6">Detail Transaksi</h3>
                    
                    <div class="space-y-4 mb-8">
                        <div>
                            <span class="text-[10px] font-label uppercase tracking-widest text-on-surface-variant">Pemesan</span>
                            <p class="font-headline font-bold text-lg text-white" x-text="selectedOrder ? selectedOrder.user.name : ''"></p>
                        </div>
                        <div>
                            <span class="text-[10px] font-label uppercase tracking-widest text-on-surface-variant">Jadwal Main</span>
                            <p class="font-headline font-bold text-sm text-white" x-text="selectedOrder ? selectedOrder.tanggal + ' • ' + selectedOrder.jam_mulai.substring(0, 5) : ''"></p>
                        </div>
                        <div>
                            <span class="text-[10px] font-label uppercase tracking-widest text-on-surface-variant">Total Transfer Terkonfirmasi</span>
                            <p class="font-headline font-black text-2xl text-primary-container italic tracking-tighter" x-text="selectedOrder ? 'Rp ' + parseInt(selectedOrder.total_harga).toLocaleString('id-ID') : ''"></p>
                        </div>
                    </div>

                    <div class="space-y-4 flex-1">
                        <label class="text-[10px] font-label uppercase tracking-[0.2em] text-on-surface-variant">Catatan Penolakan (Opsional)</label>
                        <textarea x-model="alasanTolak" placeholder="Tulis alasan jika menolak (Misal: Uang tidak masuk, foto kabur, dll)" rows="3" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline text-sm text-on-surface focus:ring-1 focus:ring-red-500 focus:border-red-500 transition-all placeholder:text-zinc-600 resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-8 pt-6 border-t border-white/5">
                        <button @click="confirmPayment('reject')" class="w-full bg-red-500/10 text-red-500 border border-red-500/20 py-4 rounded-xl font-headline font-black uppercase tracking-widest text-xs hover:bg-red-500/20 transition-all italic text-center">
                            Tolak
                        </button>
                        <button @click="confirmPayment('approve')" class="w-full bg-green-500 text-white py-4 rounded-xl font-headline font-black uppercase tracking-[0.2em] text-xs shadow-[0_10px_30px_rgba(34,197,94,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all italic flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">check_circle</span> Valid, Terima
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
