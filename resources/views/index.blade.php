{{--
|--------------------------------------------------------------------------
| Halaman Utama — SARAGA Booking (Corrected Version)
|--------------------------------------------------------------------------
--}}

@extends('layouts.app')

@section('title', 'SARAGA — Sewa Lapangan Jadi Lebih Mudah')
@section('meta_description', 'Platform sewa lapangan olahraga terbaik. Temukan venue badminton, futsal, basketball, dan lainnya di kotamu.')

@push('styles')
<style>
    #select-city option, #select-sport option {
        color: #000000 !important;
        background-color: #ffffff !important;
    }
</style>
@endpush

@section('content')

    {{-- ==================== HERO SECTION ==================== --}}
    <section class="relative h-[819px] flex flex-col items-center justify-center px-6 overflow-hidden">
        {{-- Background Image with Overlay --}}
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-background"></div>
            <img
                class="w-full h-full object-cover opacity-30 grayscale"
                alt="Cinematic wide shot of a modern dark indoor basketball court"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCEic5MjwlxWseGED5VQwUSpKIZ9ZolsVxhOaCU9uM4vvRmhkNH7KNclVc1a_3cMup5sASXWZkP5NA1iyW2K09G4D9w6vTIXuaYaTDsXWRqhZ5ELfazaIeFBK7ZmOI6DzVJjtUoKJt6wJV9_1BUxpYYO6EkNAqsaFiA76sWCdI2rz8w8dzyypy8E8B2huhBkvFwMS3VQKq_sF9ZTIZx_B8f6kPvy9VgRGHTfBH8CK6jB3rW4H6OtuHYY8oSOujq2DHOY2JKOX4GPupu"
            />
        </div>

        {{-- Hero Content --}}
        <div class="relative z-10 text-center max-w-5xl mx-auto">
            <h1 class="text-6xl md:text-8xl font-headline font-extrabold tracking-[-3%] text-on-surface mb-12 uppercase leading-tight">
                SEWA LAPANGAN <br/>
                <span class="text-primary-container">JADI LEBIH MUDAH</span>
            </h1>

            {{-- Glassmorphic Search Console --}}
            <form action="{{ route('venues.search') }}" method="GET" class="glass-card w-full p-2 rounded-full flex flex-col md:flex-row items-center gap-2 max-w-5xl shadow-2xl">
                {{-- Search Input --}}
                <div class="flex-1 flex items-center px-6 gap-3 min-w-[200px]">
                    <span class="material-symbols-outlined text-outline">search</span>
                    <input
                        name="q"
                        id="search-venue"
                        class="bg-transparent border-none focus:ring-0 text-on-surface placeholder:text-outline w-full font-label"
                        placeholder="Cari Nama Venue"
                        type="text"
                    />
                </div>

                <div class="w-px h-8 bg-outline-variant/30 hidden md:block"></div>

                {{-- City Selector --}}
                <div class="flex-1 flex items-center px-6 gap-3 relative group cursor-pointer">
                    <span class="material-symbols-outlined text-outline">location_on</span>
                    <select name="regency_id" id="select-city" class="bg-transparent border-none focus:ring-0 text-on-surface font-label w-full appearance-none cursor-pointer">
                        <option value="" class="text-black">Seluruh Indonesia</option>
                        @foreach($regencies as $regency)
                            <option value="{{ $regency->id }}" class="text-black">{{ $regency->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-px h-8 bg-outline-variant/30 hidden md:block"></div>

                {{-- Sport Selector --}}
                <div class="flex-1 flex items-center px-6 gap-3 relative group cursor-pointer">
                    <span class="material-symbols-outlined text-outline">sports_tennis</span>
                    <select name="sport" id="select-sport" class="bg-transparent border-none focus:ring-0 text-on-surface font-label w-full appearance-none cursor-pointer">
                        <option value="" class="text-black">Semua Olahraga</option>
                        @foreach($sports as $sport)
                            <option value="{{ $sport }}" class="text-black">{{ $sport }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" id="btn-search" class="bg-primary-container text-on-primary h-14 px-10 rounded-full font-headline font-black uppercase text-sm tracking-wider hover:brightness-110 active:scale-95 transition-all">
                    Cari Sekarang
                </button>
            </form>
        </div>
    </section>

    {{-- ==================== VENUE SECTION ==================== --}}
    <section class="bg-surface-container-low py-24 px-8 md:px-16">
        <div class="max-w-screen-2xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-8">
                <div>
                    <h2 class="text-primary-container font-label font-semibold tracking-widest uppercase text-sm mb-4">SARAGA BOOKING</h2>
                    <h3 class="text-4xl md:text-5xl font-headline font-extrabold text-on-surface uppercase tracking-tight">
                        Tempat Bertanding <br/>Para Juara
                    </h3>
                </div>
                <div class="flex gap-4">
                    <button class="bg-primary-fixed text-on-primary-fixed px-6 py-2.5 rounded-full font-label font-bold text-sm tracking-tight hover:scale-105 transition-transform">Terbaru</button>
                    <button class="bg-surface-container-highest text-on-surface px-6 py-2.5 rounded-full font-label font-bold text-sm tracking-tight hover:bg-surface-variant transition-colors">Jabodetabek</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                @foreach($courts as $court)
                {{-- Court Card --}}
                <div class="group relative bg-surface-container-lowest rounded-xl overflow-hidden hover:translate-y-[-8px] transition-all duration-500 shadow-lg">
                    <div class="aspect-[4/5] relative">
                        <img
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="{{ $court->nama_lapangan }}"
                            src="{{ $court->foto ? asset('storage/' . str_replace('/storage/', '', $court->foto)) : ($court->venue->foto_venue ? asset('storage/' . str_replace('/storage/', '', $court->venue->foto_venue)) : 'https://images.unsplash.com/photo-1541534741688-6078c64b52d3?auto=format&fit=crop&q=80&w=800') }}"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-surface-container-lowest via-transparent to-transparent"></div>
                        
                        <div class="absolute top-4 left-4 bg-surface-container-highest/80 backdrop-blur-md text-on-surface px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">{{ $court->tipe_olahraga }}</div>
                        
                        @if($court->is_active)
                        <div class="absolute top-4 right-4 bg-primary-container/90 backdrop-blur-md text-on-primary px-3 py-1 rounded-full text-xs font-black uppercase tracking-tighter">Aktif</div>
                        @endif
                    </div>
                    <div class="p-8 relative -mt-20">
                        <div class="glass-card p-6 rounded-xl border border-white/10">
                            <h4 class="text-xl font-headline font-extrabold text-on-surface mb-2 uppercase truncate">{{ $court->nama_lapangan }}</h4>
                            <div class="flex items-center gap-2 text-outline text-sm font-label mb-4 truncate">
                                <span class="material-symbols-outlined text-sm shrink-0">location_on</span>
                                <span class="truncate">{{ $court->venue->nama_venue }} &bull; {{ $court->venue->regency->name ?? 'Lokasi Tidak Tersedia' }}</span>
                            </div>
                            <div class="flex justify-between items-center border-t border-white/5 pt-4">
                                <div>
                                    <p class="text-[10px] text-outline uppercase tracking-widest mb-1 font-label">Harga per Jam</p>
                                    <p class="text-xl font-headline font-bold text-secondary">
                                        Rp {{ number_format($court->harga_per_jam, 0, ',', '.') }}<span class="text-xs text-outline font-normal">/jam</span>
                                    </p>
                                </div>
                                <a href="{{ route('venue.show', ['slug' => $court->venue->slug, 'court_id' => $court->id]) }}" class="w-12 h-12 rounded-full border border-primary-container flex items-center justify-center text-primary-container hover:bg-primary-container hover:text-on-primary transition-all">
                                    <span class="material-symbols-outlined">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            {{-- Pagination --}}
            <div class="mt-16 flex justify-center">
                {{ $courts->links() }}
            </div>

            </div>
        </div>
    </section>

@endsection
