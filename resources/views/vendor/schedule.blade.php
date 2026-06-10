@extends('layouts.vendor')

@section('title', 'Jadwal Harian — SARAGA Partner')

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-6 duration-700">
    <header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <h2 class="text-3xl font-headline font-black uppercase italic tracking-tighter text-white">Jadwal <span class="text-primary-container">Harian</span></h2>
            <p class="text-on-surface-variant font-label text-sm mt-1 uppercase tracking-widest opacity-70">Manajemen ketersediaan lapangan real-time.</p>
        </div>
        <div class="flex items-center gap-4 bg-white/5 p-2 rounded-2xl border border-white/10">
            <button class="p-2 hover:bg-white/10 rounded-xl transition-colors text-zinc-400">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <div class="px-4 text-center">
                <span class="block font-headline font-black text-white italic tracking-widest">{{ now()->translatedFormat('d F Y') }}</span>
                <span class="block text-[10px] font-label uppercase text-zinc-500 tracking-widest">{{ now()->translatedFormat('l') }}</span>
            </div>
            <button class="p-2 hover:bg-white/10 rounded-xl transition-colors text-zinc-400">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
    </header>

    <div class="glass-card rounded-[2.5rem] border border-white/5 shadow-2xl relative overflow-hidden flex flex-col">
        <!-- Visual Glow -->
        <div class="absolute -bottom-32 -left-32 w-64 h-64 bg-primary-container/5 rounded-full blur-[100px] pointer-events-none"></div>

        <!-- Legend -->
        <div class="p-6 md:px-10 border-b border-white/5 flex items-center gap-6 overflow-x-auto relative z-10">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full border border-dashed border-zinc-600"></div>
                <span class="text-[10px] font-label font-bold uppercase tracking-widest text-zinc-400">Tersedia</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-primary-container"></div>
                <span class="text-[10px] font-label font-bold uppercase tracking-widest text-zinc-400">Terpesan</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-secondary"></div>
                <span class="text-[10px] font-label font-bold uppercase tracking-widest text-zinc-400">Sedang Main</span>
            </div>
        </div>

        <!-- Timetable -->
        <div class="overflow-x-auto relative z-10 p-6 md:p-10">
            <div class="min-w-[800px]">
                @php
                    $hours = range(8, 23);
                @endphp

                <div class="flex">
                    <!-- Y-Axis (Courts) Header Space -->
                    <div class="w-40 shrink-0"></div>
                    <!-- X-Axis (Hours) -->
                    <div class="flex-1 flex border-b border-white/10 pb-4">
                        @foreach($hours as $h)
                            <div class="flex-1 text-center border-l border-white/5 first:border-0 relative">
                                <span class="text-[10px] font-label font-black text-zinc-500 uppercase tracking-widest">{{ sprintf('%02d', $h) }}:00</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 space-y-4">
                    @forelse($courts as $court)
                        <div class="flex items-center group">
                            <!-- Court Name -->
                            <div class="w-40 shrink-0 flex items-center gap-3 pr-4">
                                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-zinc-400 group-hover:bg-primary-container/10 group-hover:text-primary-container transition-colors">
                                    <span class="material-symbols-outlined text-sm">sports_tennis</span>
                                </div>
                                <span class="font-headline font-bold text-white text-sm group-hover:text-primary-container transition-colors truncate">{{ $court->nama }}</span>
                            </div>
                            
                            <!-- Timeline Slots -->
                            <div class="flex-1 flex h-16 bg-surface-container-highest/30 rounded-2xl border border-white/5">
                                @foreach($hours as $h)
                                    @php
                                        $isBooked = false;
                                        $bookingObj = null;
                                        // Check if this hour falls within any booking for this court
                                        foreach($bookings as $b) {
                                            if($b->court_id == $court->id) {
                                                $startHour = (int) \Carbon\Carbon::parse($b->jam_mulai)->format('H');
                                                $endHour = $startHour + $b->durasi;
                                                if($h >= $startHour && $h < $endHour) {
                                                    $isBooked = true;
                                                    $bookingObj = $b;
                                                    break;
                                                }
                                            }
                                        }
                                        
                                        // Determine styling
                                        $slotClass = "flex-1 border-r border-white/5 last:border-0 group/slot cursor-pointer transition-all relative";
                                        $innerClass = "absolute inset-1 rounded-xl flex flex-col items-center justify-center transition-all";
                                        
                                        if($isBooked) {
                                            if($bookingObj->status == 'sedang_main') {
                                                $innerClass .= " bg-secondary shadow-[0_0_15px_rgba(233,193,118,0.4)] z-10 hover:scale-105 hover:z-20";
                                                $textClass = "text-on-secondary";
                                            } else {
                                                $innerClass .= " bg-primary-container shadow-[0_0_15px_rgba(0,240,255,0.4)] z-10 hover:scale-105 hover:z-20";
                                                $textClass = "text-on-primary";
                                            }
                                        } else {
                                            $innerClass .= " border border-dashed border-white/10 hover:border-primary-container/50 hover:bg-primary-container/5 group-hover/slot:border-white/20";
                                        }
                                    @endphp

                                    <div class="{{ $slotClass }}">
                                        <div class="{{ $innerClass }}">
                                            @if($isBooked && $h == (int)\Carbon\Carbon::parse($bookingObj->jam_mulai)->format('H'))
                                                <span class="font-headline font-black text-[10px] {{ $textClass }} uppercase italic tracking-tighter truncate w-full text-center px-1">
                                                    {{ current(explode('-', $bookingObj->kode_booking)) }}
                                                </span>
                                            @endif
                                            
                                            <!-- Tooltip on Hover for booked slots -->
                                            @if($isBooked)
                                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 w-max max-w-[200px] p-3 rounded-xl bg-[#1f1f24] border border-white/10 shadow-xl opacity-0 invisible group-hover/slot:opacity-100 group-hover/slot:visible transition-all z-50 pointer-events-none">
                                                    <p class="font-headline font-bold text-white text-xs mb-1">{{ $bookingObj->user->name ?? 'Offline Booking' }}</p>
                                                    <p class="font-label text-[10px] text-zinc-400 capitalize">{{ $bookingObj->status }} • {{ $bookingObj->durasi }} Jam</p>
                                                </div>
                                            @else
                                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/slot:opacity-100 transition-opacity">
                                                    <span class="material-symbols-outlined text-zinc-600 text-sm">add</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <span class="material-symbols-outlined text-4xl text-zinc-600 mb-3">error</span>
                            <p class="text-zinc-500 font-label text-sm uppercase tracking-widest">Belum ada data lapangan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
