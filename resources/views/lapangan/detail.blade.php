@extends('layouts.app')

@section('title', 'Elite Badminton Arena — SARAGA Booking')

@section('content')
<main class="max-w-7xl mx-auto px-8 py-12" x-data="{ 
    selectedDate: '{{ $dates[0]['full'] }}',
    selectedSlots: [],
    basePrice: {{ $court->harga_per_jam }},
    venueName: '{{ $venue->nama_venue }}',
    courtName: '{{ $court->nama_lapangan }}',
    isWeekend: {{ $dates[0]['is_weekend'] ? 'true' : 'false' }},

    getPrice() {
        if (this.selectedSlots.length === 0) return this.basePrice;
        let totalPrice = 0;
        
        this.selectedSlots.forEach(slot => {
            let price = this.basePrice;
            // Dynamic Pricing Logic (Peak Hours: 18:00 - 22:00)
            let hour = parseInt(slot.split(':')[0]);
            if (hour >= 18 && hour <= 22) {
                price *= 1.2; // +20% for peak hours
            }

            // Weekend Surcharge
            if (this.isWeekend) {
                price *= 1.15; // +15% for weekend
            }
            totalPrice += Math.round(price);
        });

        return totalPrice;
    },

    updateDate(dateObj) {
        this.selectedDate = dateObj.full;
        this.isWeekend = dateObj.is_weekend;
        this.selectedSlots = [];
    },

    toggleSlot(time) {
        if (this.selectedSlots.includes(time)) {
            // Remove this slot and all slots after it
            let index = this.selectedSlots.indexOf(time);
            this.selectedSlots = this.selectedSlots.slice(0, index);
        } else {
            if (this.selectedSlots.length === 0) {
                this.selectedSlots.push(time);
            } else {
                // Ensure it's contiguous
                let lastSlot = this.selectedSlots[this.selectedSlots.length - 1];
                let expectedNextHour = parseInt(lastSlot.split(':')[0]) + 1;
                let clickedHour = parseInt(time.split(':')[0]);
                
                if (clickedHour === expectedNextHour) {
                    this.selectedSlots.push(time);
                } else {
                    // Reset if not contiguous
                    this.selectedSlots = [time];
                }
            }
        }
    }
}">
    <!-- Hero Section -->
    <section class="relative w-full aspect-[16/7] rounded-[2rem] overflow-hidden mb-16 shadow-2xl group">
        <img src="{{ $court->foto ? asset('storage/' . str_replace('/storage/', '', $court->foto)) : ($venue->foto_venue ? asset('storage/' . str_replace('/storage/', '', $venue->foto_venue)) : 'https://images.unsplash.com/photo-1541534741688-6078c64b52d3?auto=format&fit=crop&q=80&w=800') }}" 
             alt="{{ $court->nama_lapangan }}" 
             class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
        
        <div class="absolute inset-0 bg-gradient-to-t from-background via-background/20 to-transparent flex flex-col justify-end p-12">
            <div class="flex items-center gap-4 mb-4">
                <span class="bg-secondary-container/80 backdrop-blur-md text-secondary px-4 py-1.5 rounded-full text-[10px] font-bold tracking-widest uppercase">Premium Venue</span>
                <div class="flex items-center gap-1.5 text-secondary">
                    <span class="material-symbols-outlined text-sm fill-current">star</span>
                    <span class="font-label font-bold text-sm">4.9 <span class="text-on-surface-variant font-normal opacity-60 ml-1">(50 ulasan)</span></span>
                </div>
            </div>
            <h1 class="text-6xl md:text-7xl font-black font-headline tracking-tighter text-white mb-4 italic uppercase">{{ $venue->nama_venue }}</h1>
            <div class="flex items-center gap-3 text-on-surface-variant">
                <span class="material-symbols-outlined text-xl text-primary-container">location_on</span>
                <p class="font-label tracking-wide uppercase text-sm font-semibold">{{ $venue->regency->name ?? 'Lokasi' }}, Indonesia</p>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-[1fr_400px] gap-16 items-start">
        <!-- Left Column: Details & Schedule -->
        <div class="space-y-20">
            
            {{-- Deskripsi Section --}}
            <section>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-2.5 h-8 bg-primary-container rounded-full shadow-[0_0_15px_rgba(0,240,255,0.4)]"></div>
                    <h2 class="text-2xl font-bold font-headline tracking-tight uppercase">Tentang Venue</h2>
                </div>
                <p class="text-on-surface-variant leading-relaxed text-lg font-label opacity-80 mb-8">
                    {{ $venue->description }}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="glass-card p-4 rounded-2xl border-white/5 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-primary-container/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary-container text-xl">sports</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-label font-bold uppercase tracking-widest text-on-surface-variant opacity-60">Olahraga</p>
                            <p class="font-headline font-bold text-white uppercase italic">{{ $court->tipe_olahraga ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="glass-card p-4 rounded-2xl border-white/5 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-secondary/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-secondary text-xl">location_city</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-label font-bold uppercase tracking-widest text-on-surface-variant opacity-60">Lokasi</p>
                            <p class="font-headline font-bold text-white uppercase italic">{{ $court->kategori_lokasi ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="glass-card p-4 rounded-2xl border-white/5 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-xl">grid_on</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-label font-bold uppercase tracking-widest text-on-surface-variant opacity-60">Tipe Lantai</p>
                            <p class="font-headline font-bold text-white uppercase italic">{{ $court->tipe_lantai ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Pilih Jadwal Section --}}
            <section>
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-2.5 h-8 bg-primary-container rounded-full shadow-[0_0_15px_rgba(0,240,255,0.4)]"></div>
                    <h2 class="text-2xl font-bold font-headline tracking-tight">PILIH JADWAL - {{ strtoupper($court->nama_lapangan) }}</h2>
                </div>

                <!-- Date Selector -->
                <div class="flex gap-4 mb-12 overflow-x-auto pb-4 no-scrollbar">
                    @foreach($dates as $d)
                    <button @click="updateDate(@js($d))" 
                            :class="selectedDate === '{{ $d['full'] }}' ? 'bg-primary-container text-on-primary shadow-[0_10px_30px_rgba(0,240,255,0.3)]' : 'glass-card border-white/5 text-on-surface-variant hover:bg-white/5'"
                            class="flex-shrink-0 w-28 h-32 rounded-2xl flex flex-col items-center justify-center gap-2 transition-all duration-300">
                        <span class="font-label text-xs font-bold uppercase opacity-60 tracking-widest">{{ $d['day'] }}</span>
                        <span class="text-3xl font-black font-headline tracking-tighter">{{ $d['date'] }}</span>
                        <span class="font-label text-xs font-bold uppercase opacity-60 tracking-widest">{{ $d['month'] }}</span>
                    </button>
                    @endforeach
                </div>

                <!-- Time Grid -->
                @php
                    // Pre-calculate booked slots (termasuk perhitungan durasi)
                    $availabilityMap = [];
                    foreach($dates as $d) {
                        $bookedSlots = [];
                        foreach($existingBookings->get($d['full'], collect()) as $b) {
                            $startHour = (int) substr($b->jam_mulai, 0, 2);
                            for ($i = 0; $i < $b->durasi; $i++) {
                                $bookedSlots[] = str_pad($startHour + $i, 2, '0', STR_PAD_LEFT) . ':00';
                            }
                        }
                        $availabilityMap[$d['full']] = $bookedSlots;
                    }
                @endphp
                <script>
                    window.availabilityMap = @json($availabilityMap);
                </script>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($timeSlots as $time)
                        <template x-if="window.availabilityMap[selectedDate] && window.availabilityMap[selectedDate].includes('{{ $time }}')">
                            <div class="h-20 flex items-center justify-center rounded-2xl bg-surface-container-highest/20 border border-white/5 opacity-30 cursor-not-allowed">
                                <span class="font-headline font-bold text-xl text-outline italic strike-through">{{ $time }}</span>
                            </div>
                        </template>

                        <template x-if="!window.availabilityMap[selectedDate] || !window.availabilityMap[selectedDate].includes('{{ $time }}')">
                            <button @click="toggleSlot('{{ $time }}')"
                                    :class="selectedSlots.includes('{{ $time }}') ? 'bg-primary-container text-on-primary shadow-[0_0_20px_rgba(0,240,255,0.4)] border-transparent' : 'glass-card border-white/10 text-primary-container hover:bg-primary-container/10'"
                                    class="h-20 flex items-center justify-center rounded-2xl border font-headline font-bold text-xl transition-all duration-300 group">
                                <span class="transition-transform group-active:scale-95 italic">{{ $time }}</span>
                            </button>
                        </template>
                    @endforeach
                </div>
            </section>
        </div>

        <!-- Right Column: Booking Summary (Sticky) -->
        <aside class="sticky top-28">
            <div class="glass-card p-10 rounded-[2.5rem] border-white/10 space-y-10 relative overflow-hidden backdrop-blur-2xl">
                {{-- Decorative inner glow --}}
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-container/5 blur-3xl pointer-events-none"></div>

                <div class="relative">
                    <h3 class="text-2xl font-black font-headline tracking-tighter uppercase italic text-white mb-2">Ringkasan Pesanan</h3>
                    <div class="w-12 h-1 bg-primary-container rounded-full"></div>
                </div>

                <div class="space-y-6">
                    <div class="flex justify-between items-center py-4 border-b border-white/5">
                        <span class="font-label text-xs uppercase tracking-widest text-on-surface-variant">Tanggal</span>
                        <span class="font-label text-sm font-bold text-white uppercase" x-text="selectedDate"></span>
                    </div>
                    <div class="flex justify-between items-center py-4 border-b border-white/5">
                        <span class="font-label text-xs uppercase tracking-widest text-on-surface-variant">Waktu</span>
                        <span class="font-label text-sm font-bold text-primary-container uppercase" x-text="selectedSlots.length > 0 ? selectedSlots[0] + ' - ' + (parseInt(selectedSlots[selectedSlots.length - 1]) + 1).toString().padStart(2, '0') + ':00 (' + selectedSlots.length + ' Jam)' : 'Pilih Jam'"></span>
                    </div>
                    <div class="flex justify-between items-center py-4 border-b border-white/5">
                        <span class="font-label text-xs uppercase tracking-widest text-on-surface-variant">Lapangan</span>
                        <span class="font-label text-sm font-bold text-white uppercase" x-text="courtName"></span>
                    </div>
                </div>

                <div class="pt-8">
                    <div class="flex justify-between items-end mb-10">
                        <span class="font-label text-xs uppercase tracking-widest text-on-surface-variant pb-1">Total Bayar</span>
                        <div class="text-right">
                            <span class="block text-[10px] font-bold text-secondary uppercase tracking-[0.2em] mb-2 leading-none" x-show="isWeekend || selectedSlots.some(slot => parseInt(slot) >= 18)">Dynamic Pricing Active</span>
                            <span class="text-4xl font-black font-headline text-white italic tracking-tighter" x-text="'Rp ' + getPrice().toLocaleString('id-ID')"></span>
                        </div>
                    </div>

                    @if(session('error'))
                        <div class="mb-6 p-4 rounded-xl bg-red-500/20 border border-red-500/50 flex items-start gap-3">
                            <span class="material-symbols-outlined text-red-500 text-xl">error</span>
                            <p class="text-sm font-label text-red-200">{{ session('error') }}</p>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-red-500/20 border border-red-500/50 flex items-start gap-3">
                            <span class="material-symbols-outlined text-red-500 text-xl">warning</span>
                            <ul class="text-sm font-label text-red-200 list-disc list-inside">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('booking.reserve') }}" method="POST">
                        @csrf
                        <input type="hidden" name="court_id" value="{{ $court->id }}">
                        <input type="hidden" name="date" x-model="selectedDate">
                        <input type="hidden" name="time" :value="selectedSlots.length > 0 ? selectedSlots[0] : ''">
                        <input type="hidden" name="durasi" :value="selectedSlots.length">
                        <input type="hidden" name="total_price" x-model="getPrice()">

                        <button type="submit" :disabled="selectedSlots.length === 0"
                                :class="selectedSlots.length === 0 ? 'opacity-50 cursor-not-allowed grayscale' : ''"
                                class="w-full bg-primary-container text-on-primary font-headline font-black text-xl tracking-tighter py-5 rounded-2xl shadow-[0_15px_40px_rgba(0,240,255,0.3)] hover:shadow-[0_20px_50px_rgba(0,240,255,0.4)] hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center uppercase italic">
                            PESAN SEKARANG
                        </button>
                    </form>
                    
                    <p class="text-center mt-6 font-label text-[10px] text-on-surface-variant uppercase tracking-[0.2em] opacity-40">
                        Konfirmasi Instan • Batalkan Kapan Saja*
                    </p>
                </div>
            </div>

            {{-- Promo Banner --}}
            <div class="mt-8 p-8 glass-card border-l-4 border-secondary rounded-2xl flex gap-5 bg-secondary/5">
                <span class="material-symbols-outlined text-secondary text-3xl">info</span>
                <div>
                    <p class="font-headline font-bold text-sm text-secondary uppercase tracking-widest">Promo Spesial</p>
                    <p class="font-label text-xs text-on-surface-variant mt-2 leading-relaxed opacity-80">Diskon 20% untuk penyewaan di atas 3 jam berturut-turut pada hari kerja.</p>
                </div>
            </div>
        </aside>
    </div>
</main>
@endsection
