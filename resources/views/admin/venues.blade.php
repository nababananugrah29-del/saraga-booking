@extends('layouts.admin')

@section('title', 'Katalog Venue — Super Admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <header class="flex justify-between items-end mb-16">
        <div>
            <h1 class="text-4xl font-headline font-black tracking-tighter text-on-surface uppercase italic">Katalog <span class="text-primary-container">Venue</span></h1>
            <p class="text-on-surface-variant font-label mt-3 opacity-60 tracking-wider uppercase text-[10px] font-bold">Monitoring seluruh kemitraan lapangan aktif dan tertunda.</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.dashboard') }}" class="bg-primary-container text-on-primary px-8 py-4 rounded-2xl font-headline font-black uppercase text-xs tracking-widest italic shadow-[0_10px_30px_rgba(0,240,255,0.3)] hover:scale-105 active:scale-95 transition-all">Audit Venue Baru</a>
        </div>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{
        toggleVenue(venueId, isVerified, venueName) {
            let action = isVerified ? 'menangguhkan (unverify)' : 'memverifikasi kembali';
            if (confirm(`Apakah Anda yakin ingin ${action} venue '${venueName}'?`)) {
                fetch(`/admin/venues/${venueId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.reload();
                    } else {
                        alert('Terjadi kesalahan.');
                    }
                });
            }
        }
    }">
        <a href="{{ route('kemitraan') }}" class="glass-card p-8 rounded-[3rem] border-white/5 space-y-6 flex flex-col items-center justify-center text-center opacity-30 border-dashed group cursor-pointer hover:opacity-100 hover:border-primary-container transition-all">
            <span class="material-symbols-outlined text-6xl text-zinc-600 transition-all group-hover:scale-110 group-hover:text-primary-container">add_business</span>
            <h3 class="text-xl font-headline font-black text-on-surface uppercase italic tracking-tighter mt-4">Tambah Kemitraan</h3>
        </a>
        
        @foreach($venues as $venue)
            <div class="glass-card p-8 rounded-[3rem] border-white/5 space-y-6 group hover:bg-white/[0.03] transition-all">
                <div class="relative w-full h-40 rounded-2xl overflow-hidden shadow-2xl border border-white/5">
                    <img src="{{ $venue->foto_venue }}" class="w-full h-full object-cover">
                    <div class="absolute top-3 right-3 px-3 py-1 {{ $venue->is_verified ? 'bg-green-500/20 text-green-400 border-green-500/20' : 'bg-red-500/20 text-red-400 border-red-500/20' }} backdrop-blur-md text-[8px] font-black tracking-widest rounded-full uppercase border shadow-lg">
                        {{ $venue->is_verified ? 'Terverifikasi' : 'Belum Verifikasi' }}
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-headline font-black text-on-surface uppercase italic tracking-tight">{{ $venue->nama_venue }}</h3>
                    <div class="flex items-center gap-2 mt-2 opacity-60">
                        <span class="material-symbols-outlined text-primary-container text-xs">location_on</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-zinc-500">
                            {{ $venue->alamat }} • {{ $venue->courts->count() }} Lapangan
                        </span>
                    </div>
                </div>
                <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full border-2 border-background bg-zinc-800 flex items-center justify-center font-black text-[9px] uppercase">
                            {{ substr($venue->vendor->name ?? '?', 0, 2) }}
                        </div>
                        <span class="text-[9px] font-bold text-zinc-500 uppercase tracking-widest">{{ Str::limit($venue->vendor->name ?? 'Unknown', 15) }}</span>
                    </div>
                    <button @click="toggleVenue({{ $venue->id }}, {{ $venue->is_verified ? 'true' : 'false' }}, '{{ addslashes($venue->nama_venue) }}')" class="{{ $venue->is_verified ? 'text-red-400' : 'text-primary-container' }} text-[10px] font-black uppercase tracking-widest italic hover:underline">
                        {{ $venue->is_verified ? 'Tangguhkan Venue' : 'Aktifkan Venue' }}
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-12">
        {{ $venues->links() }}
    </div>
@endsection
