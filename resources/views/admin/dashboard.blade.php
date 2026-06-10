@extends('layouts.admin')

@section('title', 'Super Admin Dashboard — Saraga Booking')

@section('content')
<main x-data="{
    pendingVendors: @js($pendingVendors ?? []),
    pendingPayouts: @js($pendingPayouts ?? []),
    unverifiedVenues: @js($unverifiedVenues ?? []),
    approveVendor(sub) {
        if (confirm(`Setujui pendaftaran vendor ini?`)) {
            fetch(`/admin/approve-vendor/${sub.id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.pendingVendors = this.pendingVendors.filter(v => v.id !== sub.id);
                    alert(data.message);
                }
            });
        }
    },
    verifyVenue(venue) {
        if (confirm(`Verifikasi venue '${venue.nama_venue}'? Ini akan membuatnya muncul di pencarian nasional.`)) {
            fetch(`/admin/verify-venue/${venue.id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.unverifiedVenues = this.unverifiedVenues.filter(v => v.id !== venue.id);
                    alert(data.message);
                }
            });
        }
    },
    approvePayout(p) {
        if (confirm(`Transfer dana sebesar Rp ${p.amount.toLocaleString('id-ID')} telah diproses?`)) {
            fetch(`/admin/approve-payout/${p.id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.pendingPayouts = this.pendingPayouts.filter(item => item.id !== p.id);
                    alert(data.message);
                }
            });
        }
    },
    formatCurrency(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID');
    }
}">
    <!-- Top Header -->
    <header class="flex justify-between items-center mb-12">
        <div>
            <h1 class="text-4xl font-extrabold font-headline tracking-tighter text-on-surface mb-2 uppercase italic">Verifikasi & Monitoring Global</h1>
            <p class="text-on-surface-variant font-label tracking-wide text-sm opacity-80 uppercase tracking-widest">Dashboard kendali pusat manajemen infrastruktur Saraga.</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex -space-x-3">
                <img class="w-10 h-10 rounded-full border-2 border-background object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB9RuFKwDO2HDL-y_8HgTe0sVsQMqXuLGZS10YlbIlZd9XAlgkI0uIQC8-croA7xrAePCEgvfqLalZvcDgg9bGXMWoW5iS6izNJQmahZwmmzqzmxzAqhWNzPBCttKDCXSHJDmDRohNEnwkyI_QTsOl52rY4OmuXdUnbTa1LpOXngYdLPHv3CNySXz2v2NNCcisoXeEywYBIiz4sSTjFAKGxHHim3sMIpD9kzmZWyXscyrSb6S4QFAnYkkbP49VPpnmtD4c3t_Koj4DW" />
                <img class="w-10 h-10 rounded-full border-2 border-background object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAQOwPPy7YOfcpWaiB3TPaP1ST-ccoBMCs__zcD4mZHpfTDAHx2uuOGmibCoa7JSOtUc8Oo1sMK9n5P7_ZhK0697zlO8D71YcxmHqLI55U3_GLvypdRjb_7iIf94Ol4gI_rW_LheU9z1Hjq30j11g4dSLgja9CsCDLrg3u9RL1uqjDttQQYiIxMZx5mXetS6mNC8Cpbic-I3sKyvVdeeQDlm4UnhjH9GGI3FuRbPRHKZuraTMH-x3k3jrnxYvm998lAZWV9z_nEutFW" />
            </div>
        </div>
    </header>

    <!-- Global Stats Grid -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
        <div class="glass-card p-10 rounded-3xl flex flex-col justify-between group hover:bg-surface-container-high transition-all">
            <div class="flex justify-between items-start mb-6">
                <span class="text-zinc-500 font-label text-[10px] font-bold uppercase tracking-[0.2em]">Total Pendapatan</span>
                <span class="material-symbols-outlined text-secondary">payments</span>
            </div>
            <div>
                <h3 class="text-3xl font-black text-secondary font-headline italic tracking-tighter" x-text="formatCurrency({{ $revenue ?? 0 }})"></h3>
                <p class="text-zinc-600 text-[10px] mt-2 uppercase tracking-widest font-bold">Total Platform</p>
            </div>
        </div>

        <div class="glass-card p-10 rounded-3xl flex flex-col justify-between group hover:bg-surface-container-high transition-all">
            <div class="flex justify-between items-start mb-6">
                <span class="text-zinc-500 font-label text-[10px] font-bold uppercase tracking-[0.2em]">Vendor Aktif</span>
                <span class="material-symbols-outlined text-cyan-400">store</span>
            </div>
            <div>
                <h3 class="text-3xl font-black text-on-surface font-headline italic tracking-tighter">{{ $vendorsCount ?? 0 }}</h3>
                <p class="text-zinc-600 text-[10px] mt-2 uppercase tracking-widest font-bold">Mitra Terverifikasi</p>
            </div>
        </div>

        <div class="glass-card p-10 rounded-3xl flex flex-col justify-between group hover:bg-surface-container-high transition-all">
            <div class="flex justify-between items-start mb-6">
                <span class="text-zinc-500 font-label text-[10px] font-bold uppercase tracking-[0.2em]">User Terdaftar</span>
                <span class="material-symbols-outlined text-cyan-400">person_add</span>
            </div>
            <div>
                <h3 class="text-3xl font-black text-on-surface font-headline italic tracking-tighter">{{ $usersCount ?? 0 }}</h3>
                <p class="text-zinc-600 text-[10px] mt-2 uppercase tracking-widest font-bold">Anggota Aktif</p>
            </div>
        </div>

        <div class="glass-card p-10 rounded-3xl flex flex-col justify-between border-cyan-400/20 group hover:bg-surface-container-high transition-all">
            <div class="flex justify-between items-start mb-6">
                <span class="text-zinc-500 font-label text-[10px] font-bold uppercase tracking-[0.2em]">Queue Verifikasi</span>
                <span class="material-symbols-outlined text-cyan-400" style="font-variation-settings: 'FILL' 1;">pending_actions</span>
            </div>
            <div>
                <h3 class="text-3xl font-black text-primary-container font-headline italic tracking-tighter shadow-cyan-400/20" x-text="pendingVendors.length"></h3>
                <p class="text-zinc-600 text-[10px] mt-2 uppercase tracking-widest font-bold">Butuh Tindakan</p>
            </div>
        </div>
    </section>

    <!-- Venue Verification Section -->
    <section class="mb-16">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-6">
                <h2 class="text-2xl font-black font-headline tracking-tighter text-on-surface uppercase italic">Verifikasi Venue Baru</h2>
                <span class="px-4 py-1.5 rounded-full bg-primary-container/10 text-primary-container text-[10px] font-black tracking-[0.2em] uppercase border border-primary-container/20 font-label">NATIONAL ONBOARDING</span>
            </div>
        </div>

        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border-white/5">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white/5">
                    <tr>
                        <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Nama Venue</th>
                        <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Vendor</th>
                        <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Lokasi</th>
                        <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <template x-if="unverifiedVenues.length === 0">
                        <tr>
                            <td colspan="4" class="py-24 text-center">
                                <div class="flex flex-col items-center gap-6 opacity-30">
                                    <span class="material-symbols-outlined text-6xl">travel_explore</span>
                                    <p class="font-headline font-black text-xl uppercase italic tracking-widest">Semua venue telah diverifikasi</p>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template x-for="v in unverifiedVenues" :key="v.id">
                        <tr class="group hover:bg-white/[0.02] transition-colors">
                            <td class="px-10 py-10">
                                <div class="flex items-center gap-5">
                                    <div class="w-12 h-12 rounded-2xl bg-zinc-900 border border-white/5 overflow-hidden">
                                        <img :src="v.foto_venue" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity">
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-black text-sm text-on-surface uppercase tracking-tight italic" x-text="v.nama_venue"></span>
                                        <span class="text-[9px] text-zinc-600 font-bold tracking-widest uppercase" x-text="v.slug"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-10">
                                <span class="text-xs font-bold text-zinc-400 font-label tracking-wide" x-text="v.vendor.name"></span>
                            </td>
                            <td class="px-10 py-10">
                                <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest" x-text="v.alamat"></span>
                            </td>
                            <td class="px-10 py-10 text-right">
                                <button @click="verifyVenue(v)" class="px-10 py-4 rounded-2xl bg-on-surface-variant text-background text-[10px] font-black uppercase tracking-widest italic hover:bg-on-surface active:scale-95 transition-all">VERIFIKASI VENUE</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Admin Verification Queue -->
    <section class="mb-16" x-data="{ selectedBukti: null }">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-6">
                <h2 class="text-2xl font-black font-headline tracking-tighter text-on-surface uppercase italic">Tabel Verifikasi Pembayaran Langganan</h2>
                <span class="px-4 py-1.5 rounded-full bg-cyan-400/10 text-cyan-400 text-[10px] font-black tracking-[0.2em] uppercase border border-cyan-400/20">PAYMENT QUEUE</span>
            </div>
        </div>

        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border-white/5">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white/5">
                    <tr>
                        <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Nama Vendor</th>
                        <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Paket</th>
                        <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label text-center">Bukti Bayar</th>
                        <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <template x-if="pendingVendors.length === 0">
                        <tr>
                            <td colspan="4" class="py-24 text-center">
                                <div class="flex flex-col items-center gap-6 opacity-30">
                                    <span class="material-symbols-outlined text-6xl">verified</span>
                                    <p class="font-headline font-black text-xl uppercase italic tracking-widest">Antrean Kosong</p>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template x-for="sub in pendingVendors" :key="sub.id">
                        <tr class="group hover:bg-white/[0.02] transition-colors">
                            <td class="px-10 py-10">
                                <div class="flex items-center gap-5">
                                    <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 flex items-center justify-center font-black text-cyan-400 font-headline italic border border-cyan-400/20" x-text="sub.vendor.name.substring(0, 2).toUpperCase()"></div>
                                    <div class="flex flex-col">
                                        <span class="font-black text-sm text-zinc-200 uppercase tracking-tight italic" x-text="sub.vendor.name"></span>
                                        <span class="text-[9px] text-zinc-600 font-bold tracking-widest" x-text="'ID: #VND-' + sub.vendor.id"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-10">
                                <div class="flex flex-col gap-2">
                                    <span class="px-4 py-1.5 rounded-xl bg-zinc-900 border border-white/5 text-zinc-400 text-[10px] font-black tracking-widest uppercase italic inline-block w-max" x-text="sub.paket"></span>
                                    <span class="text-[9px] text-zinc-500 font-bold uppercase tracking-widest" x-text="'Metode: ' + (sub.metode_pembayaran ? sub.metode_pembayaran : 'TRANSFER')"></span>
                                </div>
                            </td>
                            <td class="px-10 py-10 text-center">
                                <button @click="selectedBukti = sub.bukti_bayar" class="w-10 h-10 rounded-xl bg-cyan-400/10 text-cyan-400 hover:bg-cyan-400/20 border border-cyan-400/20 transition-all flex items-center justify-center mx-auto" title="Lihat Bukti">
                                    <span class="material-symbols-outlined text-xl">visibility</span>
                                </button>
                            </td>
                            <td class="px-10 py-10 text-right">
                                <div class="flex justify-end gap-4">
                                    <button @click="approveVendor(sub)" class="px-8 py-3 rounded-2xl bg-primary-container text-on-primary text-[10px] font-black uppercase tracking-widest italic hover:scale-105 active:scale-95 transition-all shadow-[0_10px_20px_rgba(0,240,255,0.2)]">VERIFIKASI & AKTIFKAN</button>
                                    <button class="px-8 py-3 rounded-2xl border border-red-500/30 text-red-500 text-[10px] font-black uppercase tracking-widest italic hover:bg-red-500/10 active:scale-95 transition-all">TOLAK</button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Pop-up Modal for Bukti Bayar -->
        <div x-show="selectedBukti" class="fixed inset-0 z-[100] flex items-center justify-center p-8 bg-background/90 backdrop-blur-xl" x-cloak>
            <div class="relative max-w-4xl w-full glass-card rounded-[3rem] overflow-hidden border-white/10" @click.away="selectedBukti = null">
                <div class="absolute top-8 right-8">
                    <button @click="selectedBukti = null" class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-white/10">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <div class="p-4" style="max-height: 70vh; overflow-y: auto;">
                    <img :src="selectedBukti ? (selectedBukti.startsWith('http') ? selectedBukti : '/storage/' + selectedBukti) : ''" class="w-full h-auto rounded-[2rem] shadow-2xl" alt="Bukti Pembayaran Langganan">
                </div>
                <div class="p-10 text-center bg-white/5">
                    <p class="font-headline font-black text-xl text-white uppercase italic tracking-widest">Bukti Pembayaran Calon Vendor</p>
                    <p class="text-zinc-500 text-xs mt-2 font-label uppercase tracking-widest">Pastikan nominal dan tanggal transfer sesuai sebelum verifikasi.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Payout Table Section -->
    <section class="mb-20">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-6">
                <h2 class="text-2xl font-black font-headline tracking-tighter text-on-surface uppercase italic">Daftar Penarikan Dana</h2>
                <span class="px-4 py-1.5 rounded-full bg-secondary/10 text-secondary text-[10px] font-black tracking-[0.2em] uppercase border border-secondary/20 font-label">PAYOUT QUEUE</span>
            </div>
        </div>

        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border-white/5">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white/5">
                    <tr>
                        <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Vendor</th>
                        <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Nominal</th>
                        <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Detail Penerima</th>
                        <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <template x-if="pendingPayouts.length === 0">
                        <tr>
                            <td colspan="4" class="py-24 text-center">
                                <div class="flex flex-col items-center gap-6 opacity-30">
                                    <span class="material-symbols-outlined text-6xl">payments</span>
                                    <p class="font-headline font-black text-xl uppercase italic tracking-widest">Tidak ada penarikan tertunda</p>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template x-for="p in pendingPayouts" :key="p.id">
                        <tr class="group hover:bg-white/[0.02] transition-colors">
                            <td class="px-10 py-10">
                                <div class="flex items-center gap-5">
                                    <div class="w-12 h-12 rounded-2xl bg-secondary/10 flex items-center justify-center font-black text-secondary font-headline italic border border-secondary/20" x-text="p.vendor.name.substring(0, 2).toUpperCase()"></div>
                                    <div class="flex flex-col">
                                        <span class="font-black text-sm text-zinc-200 uppercase tracking-tight italic" x-text="p.vendor.name"></span>
                                        <span class="text-[9px] text-zinc-600 font-bold tracking-widest uppercase" x-text="'Vendor ID: #' + p.vendor_id"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-10">
                                <span class="text-lg font-black font-headline text-secondary italic tracking-tighter" x-text="formatCurrency(p.amount)"></span>
                            </td>
                            <td class="px-10 py-10">
                                <div class="flex flex-col gap-1">
                                    <p class="text-[10px] font-bold text-white uppercase tracking-wider">
                                        <span class="text-secondary" x-text="p.metode_penarikan || 'BANK'"></span> - <span x-text="p.bank_account"></span>
                                    </p>
                                    <p class="text-[9px] font-bold text-zinc-400 uppercase tracking-widest" x-text="'A/N: ' + (p.nama_penerima || 'Tidak Terdaftar')"></p>
                                    <p class="text-[9px] font-bold text-zinc-500 tracking-widest" x-text="'HP: ' + (p.no_hp || '-')"></p>
                                </div>
                            </td>
                            <td class="px-10 py-10 text-right">
                                <button @click="approvePayout(p)" class="px-10 py-4 rounded-2xl bg-secondary text-on-secondary text-[10px] font-black uppercase tracking-widest italic hover:scale-105 active:scale-95 transition-all shadow-[0_15px_30px_rgba(233,193,118,0.2)]">PROSES TRANSFER</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection
