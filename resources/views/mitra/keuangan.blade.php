@extends('layouts.vendor')

@section('title', 'Keuangan & Pendapatan — Saraga Mitra')

@section('content')
<div class="max-w-7xl mx-auto" x-data="{ showWithdrawModal: false }">
    <!-- Header -->
    <header class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-4xl font-headline font-black tracking-tighter text-on-surface uppercase italic leading-none">Keuangan & <span class="text-secondary">Earning</span></h1>
            <p class="text-on-surface-variant font-label mt-4 opacity-60 tracking-wider uppercase text-[10px] font-bold">Pantau arus kas dan tarik pendapatan Anda ke rekening bank.</p>
        </div>
        
        <button @click="showWithdrawModal = true" class="bg-secondary text-on-secondary px-10 py-5 rounded-2xl font-headline font-black uppercase text-xs tracking-[0.2em] italic shadow-[0_15px_40px_rgba(233,193,118,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-3">
            <span class="material-symbols-outlined text-sm">account_balance_wallet</span>
            Tarik Dana (Withdraw)
        </button>
    </header>

    @if(session('success'))
    <div class="mb-8 p-6 bg-primary-container/10 border border-primary-container/20 rounded-2xl text-primary-container font-headline font-black uppercase text-xs tracking-widest italic animate-bounce">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-8 p-6 bg-red-500/10 border border-red-500/20 rounded-2xl text-red-400 font-headline font-black uppercase text-xs tracking-widest italic">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- Left Column: Wallet Card -->
        <div class="lg:col-span-4 space-y-8">
            <div class="glass-card p-10 rounded-[2.5rem] border-white/10 relative overflow-hidden group shadow-2xl">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-secondary/10 blur-[100px] pointer-events-none group-hover:bg-secondary/20 transition-all duration-1000"></div>
                
                <div class="relative z-10 space-y-10">
                    <div class="flex justify-between items-start">
                        <div class="p-3 bg-secondary/10 rounded-2xl text-secondary">
                            <span class="material-symbols-outlined text-3xl">account_balance_wallet</span>
                        </div>
                        <span class="text-[9px] font-headline font-black text-secondary border border-secondary/20 px-3 py-1 rounded-full uppercase italic tracking-widest leading-none">Mitra Wallet</span>
                    </div>

                    <div>
                        <p class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.3em] mb-3 opacity-60">Saldo Tersedia</p>
                        <h2 class="text-5xl font-headline font-black text-white italic tracking-tighter leading-none">
                            Rp {{ number_format($wallet->balance, 0, ',', '.') }}
                        </h2>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                            <p class="text-[8px] font-label font-bold text-on-surface-variant uppercase tracking-widest mb-1 opacity-40">Min. Tarik</p>
                            <p class="text-xs font-headline font-black text-white italic tracking-tight">Rp 100.000</p>
                        </div>
                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-right">
                            <p class="text-[8px] font-label font-bold text-on-surface-variant uppercase tracking-widest mb-1 opacity-40">Status</p>
                            <p class="text-[10px] font-headline font-black text-primary-container italic tracking-tight uppercase">Aktif</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ad/Info Card -->
            <div class="glass-card p-8 rounded-[2rem] border-white/5 bg-gradient-to-br from-primary-container/5 to-transparent">
                <div class="flex items-center gap-4 mb-4">
                    <span class="material-symbols-outlined text-primary-container">info</span>
                    <h4 class="text-sm font-headline font-black uppercase italic text-white tracking-widest leading-none">Kebijakan Penarikan</h4>
                </div>
                <ul class="space-y-4 text-[10px] font-bold text-on-surface-variant uppercase tracking-widest leading-relaxed opacity-60 italic">
                    <li>• Biaya admin platform: 10%</li>
                    <li>• Waktu proses: 1-3 Hari Kerja</li>
                    <li>• Status permohonan dapat dipantau pada tabel riwayat</li>
                </ul>
            </div>
        </div>

        <!-- Right Column: Payout History -->
        <div class="lg:col-span-8 flex flex-col">
            <div class="glass-card rounded-[2.5rem] border-white/5 flex-1 relative overflow-hidden shadow-2xl">
                <div class="p-10">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="p-2 bg-white/5 rounded-xl text-zinc-400">
                            <span class="material-symbols-outlined text-xl">history</span>
                        </div>
                        <h3 class="text-2xl font-headline font-black uppercase italic tracking-tighter text-white leading-none">Riwayat Transaksi & Payout</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[600px]">
                            <thead>
                                <tr class="text-on-surface-variant font-label text-[9px] uppercase tracking-[0.3em] border-b border-white/5">
                                    <th class="pb-8 px-4 font-black">Tanggal</th>
                                    <th class="pb-8 px-4 font-black">Nominal</th>
                                    <th class="pb-8 px-4 font-black text-center">Rekening Tujuan</th>
                                    <th class="pb-8 px-4 font-black text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($payouts as $payout)
                                <tr class="group hover:bg-white/[0.02] transition-all">
                                    <td class="py-8 px-4">
                                        <span class="text-xs font-headline font-black text-white italic tracking-widest uppercase">{{ $payout->created_at->format('d M Y') }}</span>
                                    </td>
                                    <td class="py-8 px-4 text-secondary font-headline font-black italic tracking-tighter text-lg">
                                        Rp {{ number_format($payout->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-8 px-4 text-center">
                                        <span class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider block opacity-60 leading-none mb-1">Target Account</span>
                                        <span class="text-xs font-headline font-bold text-on-surface uppercase">{{ $payout->bank_account }}</span>
                                    </td>
                                    <td class="py-8 px-4 text-right">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-secondary/10 text-secondary border-secondary/20',
                                                'approved' => 'bg-primary-container/10 text-primary-container border-primary-container/20',
                                                'rejected' => 'bg-red-500/10 text-red-400 border-red-500/20'
                                            ];
                                            $labels = [
                                                'pending' => 'MENUNGGU',
                                                'approved' => 'BERHASIL',
                                                'rejected' => 'DITOLAK'
                                            ];
                                        @endphp
                                        <span class="px-4 py-1.5 rounded-full border {{ $statusColors[$payout->status] ?? 'bg-white/5' }} text-[9px] font-black uppercase tracking-widest italic">
                                            {{ $labels[$payout->status] ?? $payout->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-20 text-center opacity-30">
                                        <span class="material-symbols-outlined text-6xl mb-4 text-on-surface-variant/20">account_balance</span>
                                        <p class="font-headline font-black uppercase italic tracking-widest text-lg leading-none">Belum ada riwayat penarikan</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Withdrawal Modal -->
    <div x-show="showWithdrawModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-background/90 backdrop-blur-md"
         style="display: none;">
        
        <div class="glass-card w-full max-w-xl p-12 rounded-[3rem] border-white/10 shadow-2xl relative overflow-hidden" @click.away="showWithdrawModal = false">
            <div class="absolute -top-32 -right-32 w-64 h-64 bg-secondary/10 blur-3xl pointer-events-none"></div>
            
            <header class="mb-12 text-center">
                <div class="w-24 h-24 bg-secondary/10 rounded-3xl mx-auto flex items-center justify-center mb-8 border border-secondary/20">
                    <span class="material-symbols-outlined text-secondary text-5xl">payments</span>
                </div>
                <h3 class="text-4xl font-headline font-black uppercase italic tracking-tighter text-white leading-none">Ajukan Penarikan Dana</h3>
                <p class="text-on-surface-variant text-[10px] font-black uppercase tracking-[0.3em] mt-4 opacity-50">Isi formulir untuk mentransfer saldo ke rekening bank Anda.</p>
            </header>

            <form action="{{ route('mitra.withdraw') }}" method="POST" class="space-y-10">
                @csrf
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-6 relative">
                        <div class="space-y-2">
                            <label class="font-label text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface-variant">Jumlah Penarikan (Rp)</label>
                            <input type="number" name="amount" min="100000" max="{{ $wallet->balance }}" placeholder="Minimal Rp 100.000" class="w-full bg-transparent border-0 border-b-2 border-white/10 focus:border-primary-container focus:ring-0 text-3xl font-headline font-black text-primary-container p-0 pb-2 placeholder:text-white/10 transition-all text-left" required>
                            <div class="text-[9px] text-zinc-500 font-label tracking-widest mt-2 uppercase">Sisa Saldo: Rp {{ number_format($wallet->balance, 0, ',', '.') }}</div>
                        </div>

                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="font-label text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface-variant">Metode Penarikan</label>
                                <select name="metode_penarikan" class="w-full bg-black/40 border border-white/10 rounded-xl focus:border-primary-container focus:ring-0 text-white p-3 font-label text-xs uppercase tracking-widest transition-all" required>
                                    <option value="" disabled selected>PILIH METODE</option>
                                    <option value="DANA">E-Wallet DANA</option>
                                    <option value="BANK">Transfer Bank</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="font-label text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface-variant">Nomor Rekening / No DANA</label>
                                <input type="text" name="bank_account" placeholder="Contoh: BCA - 1234567890" class="w-full bg-transparent border-0 border-b border-white/20 focus:border-primary-container focus:ring-0 text-sm font-label text-white p-0 pb-2 placeholder:text-white/20 transition-all text-left uppercase" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        <div class="space-y-2">
                            <label class="font-label text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface-variant">Nama Lengkap Penerima</label>
                            <input type="text" name="nama_penerima" placeholder="Sesuai buku tabungan / akun" class="w-full bg-transparent border-0 border-b border-white/20 focus:border-primary-container focus:ring-0 text-sm font-label text-white p-0 pb-2 placeholder:text-white/20 transition-all text-left uppercase" required>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface-variant">Nomor WhatsApp / HP</label>
                            <input type="text" name="no_hp" placeholder="08123456xxxx" class="w-full bg-transparent border-0 border-b border-white/20 focus:border-primary-container focus:ring-0 text-sm font-label text-white p-0 pb-2 placeholder:text-white/20 transition-all text-left" required>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-5 pt-6">
                    <button type="submit" class="w-full bg-secondary text-on-secondary py-6 rounded-2xl font-headline font-black uppercase tracking-[0.2em] text-sm shadow-[0_15px_40px_rgba(233,193,118,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all italic flex items-center justify-center gap-3">
                        <span class="material-symbols-outlined text-lg">flight_takeoff</span>
                        Konfirmasi Penarikan
                    </button>
                    <button type="button" @click="showWithdrawModal = false" class="w-full bg-white/5 text-on-surface-variant py-5 rounded-2xl font-headline font-black uppercase tracking-[0.2em] text-[10px] hover:bg-white/10 transition-all italic border border-white/5">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
