@extends('layouts.app')

@section('title', 'Cari Lapangan — SARAGA Booking')

@section('content')
<div class="min-h-screen bg-background pt-10 px-6 md:px-12">
    <div class="max-w-screen-2xl mx-auto flex flex-col md:flex-row gap-8">
        
        {{-- ==================== MAIN CONTENT GRID (100%) ==================== --}}
        <main class="w-full pb-20">
            {{-- Header --}}
            <div class="flex flex-col md:flex-row justify-between items-baseline mb-12 gap-6">
                <div>
                    <h1 class="font-headline font-bold text-3xl md:text-4xl text-on-surface tracking-tight capitalize">
                        @if(request()->filled('q') && $courts->isNotEmpty())
                            {{ request('q') }}
                        @else
                            Menampilkan 12 Lapangan Terbaik
                        @endif
                    </h1>
                    <div class="w-16 h-1.5 bg-[#00f2ff] mt-4 rounded-full"></div>
                </div>
                
                <div class="relative">
                    <button class="flex items-center gap-10 px-6 py-3 rounded-lg glass-card border border-white/5 bg-surface-container-high/50 group">
                        <span class="font-label text-[10px] uppercase tracking-[2px] text-outline">Urutkan:</span>
                        <div class="flex items-center gap-2">
                            <span class="font-label font-bold text-sm text-on-surface">Terpopuler</span>
                            <span class="material-symbols-outlined text-on-surface transition-transform group-focus:rotate-180">expand_more</span>
                        </div>
                    </button>
                </div>
            </div>

            {{-- Grid Lapangan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                
                @if($courts->isEmpty())
                    <div class="col-span-full flex flex-col items-center justify-center py-20 text-center glass-card rounded-xl border border-white/5 backdrop-blur-[20px]">
                        <span class="material-symbols-outlined text-6xl text-outline mb-4">search_off</span>
                        <h3 class="font-headline font-bold text-2xl text-on-surface mb-2">Lapangan Tidak Ditemukan</h3>
                        <p class="font-label text-outline text-sm mb-8">Maaf, tidak ada lapangan yang sesuai dengan kriteria pencarian Anda.</p>
                        <a href="{{ route('home') }}" class="px-6 py-3 bg-[#00f2ff] text-on-primary rounded-lg font-label font-bold text-xs uppercase tracking-wider hover:brightness-110 transition-all shadow-[0_0_15px_rgba(0,242,255,0.4)]">Reset Pencarian</a>
                    </div>

                    @if($recommendations && $recommendations->isNotEmpty())
                        <div class="col-span-full mt-12 mb-4">
                            <h2 class="font-headline font-bold text-2xl text-on-surface tracking-tight">Rekomendasi Lapangan Lainnya</h2>
                            <div class="w-16 h-1 bg-[#00f2ff] mt-3 rounded-full"></div>
                        </div>
                        
                        @foreach($recommendations as $court)
                            {{-- REAL COURT CARD (Recommendation) --}}
                            <div class="h-full flex flex-col group glass-card border border-white/10 rounded-xl overflow-hidden backdrop-blur-[20px] transition-all duration-500 hover:translate-y-[-8px] hover:shadow-[0_20px_40px_rgba(0,0,0,0.4)]">
                                {{-- Image Section --}}
                                <div class="relative aspect-video overflow-hidden">
                                    <img src="{{ $court->foto ? asset('storage/' . str_replace('/storage/', '', $court->foto)) : ($court->venue->foto_venue ? asset('storage/' . str_replace('/storage/', '', $court->venue->foto_venue)) : 'https://images.unsplash.com/photo-1541534741688-6078c64b52d3?auto=format&fit=crop&q=80&w=800') }}" 
                                         alt="{{ $court->nama_lapangan }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-background/80 via-transparent to-transparent opacity-60"></div>
                                    
                                    {{-- Badge Rekomendasi --}}
                                    <div class="absolute top-4 right-4 bg-primary-container text-on-primary px-3 py-1 rounded-[2px] shadow-[0_0_25px_rgba(0,242,255,0.5)]">
                                        <span class="font-label text-[9px] font-bold uppercase tracking-wider text-[#000000]">Rekomendasi</span>
                                    </div>

                                    {{-- Badge Sport --}}
                                    <div class="absolute top-4 left-4 bg-surface-container-high/80 backdrop-blur-md border border-white/10 text-on-surface px-3 py-1 rounded-[2px]">
                                        <span class="font-label text-[9px] font-bold uppercase tracking-wider">{{ $court->tipe_olahraga }}</span>
                                    </div>
                                </div>

                                {{-- Card Content --}}
                                <div class="flex-1 flex flex-col p-6">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="font-headline font-bold text-lg text-on-surface leading-tight">{{ $court->nama_lapangan }}</h3>
                                    </div>
                                    
                                    <div class="flex items-center gap-2 text-outline mb-6">
                                        <span class="material-symbols-outlined text-[16px] text-outline" translate="no">location_on</span>
                                        <span class="font-label text-[10px] uppercase font-medium tracking-[1px] pt-[1px] truncate">{{ $court->venue->nama_venue }} &bull; {{ $court->venue->regency->name ?? 'Lokasi Tidak Diketahui' }}</span>
                                    </div>

                                    <div class="mt-auto pt-6 border-t border-white/5">
                                        <div class="flex justify-between items-baseline">
                                            <div>
                                                <p class="font-label text-[10px] font-bold text-outline uppercase tracking-[1px] mb-1">Harga per Jam</p>
                                                <p class="font-label font-bold text-2xl text-[#00f2ff]">Rp {{ number_format($court->harga_per_jam, 0, ',', '.') }}</p>
                                            </div>

                                            <a href="{{ route('venue.show', ['slug' => $court->venue->slug, 'court_id' => $court->id]) }}" class="bg-[#00f2ff]/5 border border-[#00f2ff]/40 text-[#00f2ff] px-6 py-3 rounded-lg font-label font-bold text-[11px] uppercase tracking-[1.1px] shadow-[0_0_10px_rgba(0,242,255,0.1)] hover:bg-[#00f2ff] hover:text-[#000000] transition-all duration-300">
                                                Booking
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @else

                @foreach($courts as $court)
                    {{-- REAL COURT CARD --}}
                    <div class="h-full flex flex-col group glass-card border border-white/10 rounded-xl overflow-hidden backdrop-blur-[20px] transition-all duration-500 hover:translate-y-[-8px] hover:shadow-[0_20px_40px_rgba(0,0,0,0.4)]">
                        {{-- Image Section --}}
                        <div class="relative aspect-video overflow-hidden">
                            <img src="{{ $court->foto ? asset('storage/' . str_replace('/storage/', '', $court->foto)) : ($court->venue->foto_venue ? asset('storage/' . str_replace('/storage/', '', $court->venue->foto_venue)) : 'https://images.unsplash.com/photo-1541534741688-6078c64b52d3?auto=format&fit=crop&q=80&w=800') }}" 
                                 alt="{{ $court->nama_lapangan }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-background/80 via-transparent to-transparent opacity-60"></div>
                            
                            {{-- Badge Tersedia --}}
                            <div class="absolute top-4 right-4 bg-[#00f2ff] text-on-primary px-3 py-1 rounded-[2px] shadow-[0_0_25px_rgba(0,242,255,0.5)]">
                                <span class="font-label text-[9px] font-bold uppercase tracking-wider">Tersedia</span>
                            </div>

                            {{-- Badge Sport --}}
                            <div class="absolute top-4 left-4 bg-surface-container-high/80 backdrop-blur-md border border-white/10 text-on-surface px-3 py-1 rounded-[2px]">
                                <span class="font-label text-[9px] font-bold uppercase tracking-wider">{{ $court->tipe_olahraga }}</span>
                            </div>
                        </div>

                        {{-- Card Content --}}
                        <div class="flex-1 flex flex-col p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-headline font-bold text-lg text-on-surface leading-tight">{{ $court->nama_lapangan }}</h3>
                                <div class="flex items-center gap-1.5 px-2 py-1 glass-card border border-white/10 rounded-[2px] bg-white/5">
                                    <span class="material-symbols-outlined text-[#00f2ff] text-[14px] fill-current" translate="no">star</span>
                                    <span class="font-label font-bold text-[11px] text-on-surface pt-[1px]">4.8</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-2 text-outline mb-6">
                                <span class="material-symbols-outlined text-[16px] text-outline" translate="no">location_on</span>
                                <span class="font-label text-[10px] uppercase font-medium tracking-[1px] pt-[1px] truncate">{{ $court->venue->nama_venue }} &bull; {{ $court->venue->regency->name ?? 'Lokasi Tidak Diketahui' }}</span>
                            </div>

                            {{-- Bottom Section --}}
                            <div class="mt-auto pt-6 border-t border-white/5">
                                <div class="flex justify-between items-baseline">
                                    {{-- Sisi Kiri: Harga --}}
                                    <div>
                                        <p class="font-label text-[10px] font-bold text-outline uppercase tracking-[1px] mb-1">Harga per Jam</p>
                                        <p class="font-label font-bold text-2xl text-[#00f2ff]">Rp {{ number_format($court->harga_per_jam, 0, ',', '.') }}</p>
                                    </div>

                                    {{-- Sisi Kanan: Tombol --}}
                                    <a href="{{ route('venue.show', ['slug' => $court->venue->slug, 'court_id' => $court->id]) }}" class="bg-[#00f2ff]/5 border border-[#00f2ff]/40 text-[#00f2ff] px-6 py-3 rounded-lg font-label font-bold text-[11px] uppercase tracking-[1.1px] shadow-[0_0_10px_rgba(0,242,255,0.1)] hover:bg-[#00f2ff] hover:text-on-primary transition-all duration-300">
                                        Booking
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>

            {{-- Pagination --}}
            <div class="mt-16">
                {{ $courts->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
