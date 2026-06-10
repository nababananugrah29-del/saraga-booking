@extends('layouts.vendor')

@section('title', 'Analitik Dashboard — SARAGA Partner')

@push('styles')
<style>
    .apexcharts-tooltip {
        background: #1f1f24 !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5) !important;
        color: #fff !important;
        border-radius: 0.5rem !important;
    }
    .apexcharts-tooltip-title {
        background: #292a2e !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        font-family: 'Inter', sans-serif !important;
        font-weight: 700 !important;
        font-size: 10px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
    }
    .apexcharts-text {
        fill: #9ba1a6 !important;
        font-family: 'Inter', sans-serif !important;
        font-size: 10px !important;
        font-weight: 700 !important;
    }
    .apexcharts-gridline {
        stroke: rgba(255, 255, 255, 0.05) !important;
    }
</style>
@endpush

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-6 duration-700">
    <header class="flex justify-between items-end">
        <div>
            <h2 class="text-3xl font-headline font-black uppercase italic tracking-tighter text-white">Analitik <span class="text-secondary">Bisnis</span></h2>
            <p class="text-on-surface-variant font-label text-sm mt-1 uppercase tracking-widest opacity-70">Wawasan berbasis data untuk strategi optimal.</p>
        </div>
        <div class="bg-white/5 border border-white/10 px-4 py-2 rounded-xl flex items-center gap-2">
            <span class="material-symbols-outlined text-sm text-zinc-400">calendar_month</span>
            <span class="font-label text-xs font-bold text-white uppercase tracking-widest">7 Hari Terakhir</span>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Tren Pendapatan Mingguan (Line Chart) -->
        <div class="glass-card p-8 rounded-[2.5rem] border border-white/5 shadow-xl relative overflow-hidden">
            <div class="absolute -top-20 -left-20 w-48 h-48 bg-primary-container/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="mb-6 flex justify-between items-start relative z-10">
                <div>
                    <h3 class="text-lg font-headline font-black uppercase tracking-tighter italic text-white">Tren Pendapatan</h3>
                    <p class="text-[10px] text-zinc-500 font-label uppercase tracking-widest font-bold mt-1">Estimasi Mingguan</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-primary-container/10 flex items-center justify-center text-primary-container">
                    <span class="material-symbols-outlined text-lg">stacked_line_chart</span>
                </div>
            </div>
            <div id="revenueChart" class="relative z-10 -ml-4"></div>
        </div>

        <!-- Jam Teramai (Bar Chart) -->
        <div class="glass-card p-8 rounded-[2.5rem] border border-white/5 shadow-xl relative overflow-hidden">
            <div class="absolute -top-20 -right-20 w-48 h-48 bg-secondary/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="mb-6 flex justify-between items-start relative z-10">
                <div>
                    <h3 class="text-lg font-headline font-black uppercase tracking-tighter italic text-white">Peak Hours</h3>
                    <p class="text-[10px] text-zinc-500 font-label uppercase tracking-widest font-bold mt-1">Tingkat Kepadatan Harian</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-secondary/10 flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined text-lg">bar_chart</span>
                </div>
            </div>
            <div id="peakHoursChart" class="relative z-10 -ml-4"></div>
        </div>
    </div>

    <!-- Court Performance Summary -->
    <div class="glass-card p-8 rounded-[2.5rem] border border-white/5 shadow-xl">
        <div class="flex items-center gap-3 mb-8">
            <span class="material-symbols-outlined text-primary-container text-2xl">sports_tennis</span>
            <h3 class="text-xl font-headline font-black uppercase tracking-tighter italic text-white">Performa Lapangan</h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($courts as $court)
                @php
                    $percentage = min(100, max(10, ($court->bookings_count / 50) * 100)); // Dummy percentage based on bookings
                    $colorClass = $loop->index % 2 == 0 ? 'bg-primary-container' : 'bg-secondary';
                    $textClass = $loop->index % 2 == 0 ? 'text-primary-container' : 'text-secondary';
                @endphp
                <div class="bg-surface-container-high rounded-2xl p-6 border border-white/5 hover:border-white/10 transition-colors">
                    <div class="flex justify-between items-center mb-6">
                        <span class="font-headline font-bold text-white text-lg">{{ $court->nama }}</span>
                        <span class="{{ $textClass }} font-label text-xs font-black bg-white/5 px-3 py-1 rounded-full">{{ $court->bookings_count }} Bookings</span>
                    </div>
                    <div>
                        <div class="flex justify-between text-[10px] font-label text-zinc-400 font-bold uppercase tracking-widest mb-2">
                            <span>Popularitas</span>
                            <span>{{ number_format($percentage) }}%</span>
                        </div>
                        <div class="w-full bg-black/50 rounded-full h-1.5 overflow-hidden">
                            <div class="{{ $colorClass }} h-1.5 rounded-full shadow-[0_0_10px_currentColor]" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-zinc-500">
                    <p class="font-label text-sm uppercase tracking-widest">Belum ada data performa lapangan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Line Chart Configuration (Revenue)
        var revenueOptions = {
            series: [{
                name: 'Pendapatan',
                data: [1200000, 1800000, 1500000, 2200000, 3100000, 2800000, 3500000] // Dummy data
            }],
            chart: {
                height: 300,
                type: 'area',
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#00f0ff'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.05,
                    stops: [0, 100]
                }
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            xaxis: {
                categories: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: '#9ba1a6', fontSize: '10px', fontWeight: 700 }
                }
            },
            yaxis: {
                labels: {
                    style: { colors: '#9ba1a6', fontSize: '10px', fontWeight: 700 },
                    formatter: function (value) {
                        return "Rp " + (value / 1000000).toFixed(1) + "M";
                    }
                }
            },
            grid: {
                borderColor: 'rgba(255,255,255,0.05)',
                strokeDashArray: 4,
            },
            theme: { mode: 'dark' }
        };

        var revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
        revenueChart.render();

        // Bar Chart Configuration (Peak Hours)
        var peakOptions = {
            series: [{
                name: 'Kepadatan',
                data: [10, 15, 35, 20, 50, 85, 95, 75, 40] // Dummy data percentage
            }],
            chart: {
                height: 300,
                type: 'bar',
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#e9c176'],
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    columnWidth: '50%',
                }
            },
            dataLabels: { enabled: false },
            xaxis: {
                categories: ['14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: '#9ba1a6', fontSize: '10px', fontWeight: 700 }
                }
            },
            yaxis: {
                labels: {
                    style: { colors: '#9ba1a6', fontSize: '10px', fontWeight: 700 },
                    formatter: function (value) { return value + "%"; }
                }
            },
            grid: {
                borderColor: 'rgba(255,255,255,0.05)',
                strokeDashArray: 4,
            },
            theme: { mode: 'dark' }
        };

        var peakChart = new ApexCharts(document.querySelector("#peakHoursChart"), peakOptions);
        peakChart.render();
    });
</script>
