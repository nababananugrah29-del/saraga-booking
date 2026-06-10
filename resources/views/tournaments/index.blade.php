@extends('layouts.app')

@section('title', 'Turnamen & Kompetisi — SARAGA Booking')

@section('content')
<main class="min-h-screen bg-background pb-32">
    <!-- Hero Section -->
    <section class="relative pt-32 pb-24 px-8 overflow-hidden">
        {{-- Decorative Glow --}}
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-primary-container/10 blur-[150px] rounded-full -z-10"></div>
        
        <div class="max-w-screen-2xl mx-auto text-center">
            <h1 class="font-headline text-6xl md:text-8xl font-extrabold tracking-tighter text-on-surface mb-8 leading-tight">
                Turnamen & Kompetisi <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-fixed to-primary-container">Terdekat</span>
            </h1>
            <p class="font-body text-xl text-on-surface-variant max-w-3xl mx-auto leading-relaxed opacity-80">
                Asah kemampuanmu dan jadilah juara di berbagai kompetisi olahraga terbaik. Terhubung dengan ribuan atlet di ekosistem Saraga.
            </p>
        </div>
    </section>

    <!-- Tournament Grid -->
    <section class="px-8 max-w-screen-2xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            
            @php
                $tournaments = [
                    [
                        'title' => 'National Futsal League 2024',
                        'location' => 'Istora Senayan, Jakarta',
                        'date' => '15 - 20 Agustus 2024',
                        'price' => 'Rp 1.500.000',
                        'status' => 'Pendaftaran Dibuka',
                        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCu03eb-EEBZRdlIjxhwXlinnMw7LcUB3vlYtpPfL41OW_fGldSIkacHgxDjs27h0pn8YHiThnLuk3GuQcVy4GVoB1VseSMLgYpgthIpFnTJOylQbHmzd9XW7X5ncrhWP1RVbvV_61sN2gAj7APbisQo_ssFElrOcbxkI8Q7G8EwBMBxD2qthPWMT_t4iKeAMU-3qhBiC5-1-LQ4hT11y93HijzCtPHXHqtVsGdoNgUDP_FNOvRqW96CuThTaFTjhEpWHMw13nXVhbg'
                    ],
                    [
                        'title' => 'Badminton Elite Cup',
                        'location' => 'GBK Arena, Jakarta',
                        'date' => '02 - 05 September 2024',
                        'price' => 'Rp 500.000',
                        'status' => 'Pendaftaran Dibuka',
                        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCZ70JdxPaxuu8sBoIYkD7gj7FJAMI_A3BNeAIagQBtHOiC4y5uqvHQj7sTwdFFk98aGnh_V0MqF1Wwg6Tztbn60CxQm0TezAj0diIdZ9PPYLK0iq1IOZ_sujk0R8MOR0Q0fgaRyLdseUBFkX0vTRIid8QT1O9MN3uXWRPu1bhejUSYckGPtLpsAYbkYzQ91Nb0XnTbHPhb1VMV6CU4PZa4jYOjC1FAt2Hxj7c2oSpoEvqDp5OnMU4TmYsCIMl_AlATQfLQkQmEg574'
                    ],
                    [
                        'title' => 'Urban Basketball 3x3',
                        'location' => 'SCBD Park, Jakarta',
                        'date' => '20 September 2024',
                        'price' => 'Rp 750.000',
                        'status' => 'Pendaftaran Dibuka',
                        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAwllpxxLREwtQ8ZL2RJEoJA6yAWk2Z4PyWuMdoxmx8CyT-KYQsYae04LSAfqTnXBq6xps-vaUYwtmg0nfUQLwmO6HJL9ZCRZQ9AzVHWlSjzRq5HIu5K88uF7U4CW4h-D4KnRRokfl54E1AduwK623SN-Tann1NcTLuWah_jC3EbXCfrOy4V9eEp4dDfEm605kguDm7VXUSJbRMu8UrRfRnwZeYqGR3gHyD4DeuU44QFIMW1PTNroYocKGOSLVvq6LHfp23Oqu8kV6T'
                    ],
                    [
                        'title' => 'Saraga Tennis Open',
                        'location' => 'Dharmawangsa Court, Jakarta',
                        'date' => '10 - 12 Oktober 2024',
                        'price' => 'Rp 2.000.000',
                        'status' => 'Pendaftaran Dibuka',
                        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDnwk5eEKnx67w2hAvDYUmQZuVCYOUxkbcncJxwF4jBCDTcEmmoWFTQzkSt61l_l2sTepwWUnlGfC8xq9BGfnsYzYV7x135mKiZb59sg4-mnwVbJ4yQGTGafX8m72z1BKF_v58ke3zrtG-QHywRvx1VF0PXU6TinGQVZ6seX3ZqMpwA3dNTvKqLwhdNIuJu0LsoV6JtaRw4NlWDnZhu1GzZy3sWlSvXqf7d3Q7hV0Ea8MHTLYqvBT_fVcXlt2aChzIMdUoB7r-vnkRg'
                    ],
                    [
                        'title' => 'Jakarta Community Futsal',
                        'location' => 'Kuningan Village, Jakarta',
                        'date' => '05 November 2024',
                        'price' => 'Rp 1.000.000',
                        'status' => 'Pendaftaran Dibuka',
                        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC_mJ_UtNNhcKPbvbf3Fj-WNcE3Na9cu6dN9CfqrEAt6SALal5s3-_CWWgdQ4ufmkX3dpyAZXbKtNzJafeYUOUeYU5pNi9fVa4xTkBn3MvQ8uyoe7iLxiB61GTg0D56VpyvE8Ie7Zl5CCh-06bjq9hATEK62DUdFzSYKO3AqLp2MhnIAScO6A00sMNcMUxYd1mc_4FR8V0HZP4HyYmqGAHfk5tTeVTZcW3qecf0Zax2nejb6apmD8NkMJZnrEu8Bn_UE3-0RM6uQWru'
                    ],
                    [
                        'title' => 'Indonesian Masters 2024',
                        'location' => 'Senayan City, Jakarta',
                        'date' => '12 - 18 Desember 2024',
                        'price' => 'Rp 1.250.000',
                        'status' => 'Pendaftaran Dibuka',
                        'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC1K8wPfZSWdmF7FqKqFkAeY6zd8W_imZ9VoXBb7h-RaOoqrusf972AHtFmlZgvicj7eDjD6jteiS4Olqr11KKAcWU1v-huHP2mbtkTAYDeMVI13VTENFHVlo5Jtr7L4QIQaTT8j0WBwhmQLxukb-6b5efO4n5VbQMlJYhlt7onCuZilo_tVbvJf9j2PzBriuE4aO6AMHB_UR-Hm1055c78qkzIsAj3Ej4ZoVmWuvRILSrOjtBT3D6cSs6DngHCtGPBMMPm6JdpZFDg'
                    ]
                ];
            @endphp

            @foreach($tournaments as $tournament)
                {{-- Tournament Card --}}
                <div class="h-full flex flex-col group glass-card p-8 rounded-[2rem] border border-white/5 backdrop-blur-md transition-all duration-500 hover:translate-y-[-8px] hover:shadow-[0_20px_40px_rgba(0,0,0,0.3)]">
                    {{-- Image Section --}}
                    <div class="relative aspect-video rounded-2xl overflow-hidden mb-8">
                        <img src="{{ $tournament['img'] }}" alt="{{ $tournament['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-background/60 to-transparent"></div>
                        
                        {{-- Status Badge --}}
                        <div class="absolute top-4 right-4 bg-primary-container/90 backdrop-blur-md text-on-primary px-4 py-1.5 rounded-full shadow-lg shadow-primary-container/20">
                            <span class="font-label text-[10px] font-bold uppercase tracking-widest">{{ $tournament['status'] }}</span>
                        </div>
                    </div>

                    {{-- Content Section --}}
                    <div class="flex-1 flex flex-col">
                        <h3 class="font-headline font-bold text-2xl text-on-surface mb-6 group-hover:text-primary-container transition-colors leading-tight">{{ $tournament['title'] }}</h3>
                        
                        <div class="space-y-3 mb-10">
                            <div class="flex items-center gap-3 text-on-surface-variant/80">
                                <span class="material-symbols-outlined text-[18px]">location_on</span>
                                <span class="font-label text-sm">{{ $tournament['location'] }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-on-surface-variant/80">
                                <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                                <span class="font-label text-sm">{{ $tournament['date'] }}</span>
                            </div>
                        </div>

                        {{-- Footer Section with mt-auto --}}
                        <div class="mt-auto pt-8 border-t border-white/5">
                            <div class="flex justify-between items-center">
                                <div class="flex flex-col">
                                    <span class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant/60 mb-1">Pendaftaran</span>
                                    <span class="font-headline font-bold text-lg text-secondary-fixed-dim">{{ $tournament['price'] }}</span>
                                </div>
                                <button class="bg-primary-container/10 border border-primary-container/30 text-primary-container px-8 py-3 rounded-xl font-headline font-bold text-sm tracking-tight hover:bg-primary-container hover:text-on-primary transition-all shadow-[0_0_20px_rgba(37,211,102,0.1)]">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
</main>
@endsection
