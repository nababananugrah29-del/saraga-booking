@extends('layouts.vendor')

@section('title', 'Kelola Inventaris — SARAGA Partner')

@section('content')
    <div class="max-w-7xl mx-auto" x-data="{ 
            showAddCourtModal: false,
            previewImage: null,
            fileName: '',
            handleFile(event) {
                const file = event.target.files[0];
                if (file) {
                    this.fileName = file.name;
                    const reader = new FileReader();
                    reader.onload = (e) => { this.previewImage = e.target.result; };
                    reader.readAsDataURL(file);
                }
            }
        }">
        @if(session('success'))
            <div
                class="mb-8 p-4 rounded-2xl bg-green-500/10 border border-green-500/20 text-green-400 font-label text-sm font-bold flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div
                class="mb-8 p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-500 font-label text-sm font-bold flex items-center gap-3">
                <span class="material-symbols-outlined">error</span>
                {{ session('error') }}
            </div>
        @endif

        <header class="flex justify-between items-end mb-16">
            <div>
                <h1 class="text-4xl font-headline font-black tracking-tighter text-on-surface uppercase italic">Manajemen
                    <span class="text-primary-container">Inventaris</span>
                </h1>
                <p
                    class="text-on-surface-variant font-label mt-3 opacity-60 tracking-wider uppercase text-[10px] font-bold">
                    Kelola ketersediaan lapangan dan harga sewa secara real-time.</p>
            </div>
            <button @click="showAddCourtModal = true"
                class="bg-primary-container text-on-primary px-8 py-4 rounded-2xl font-headline font-black uppercase text-xs tracking-widest italic shadow-[0_10px_30px_rgba(0,240,255,0.3)] hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
                <span class="material-symbols-outlined text-sm">add_box</span>
                Tambah Lapangan
            </button>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($courts as $court)
                <!-- Court Card -->
                <div x-data="{ 
                            showEditCourtModal: false,
                            editPreviewImage: '{{ $court->foto ? asset("storage/" . str_replace("/storage/", "", $court->foto)) : "https://lh3.googleusercontent.com/aida-public/AB6AXuCbgt5saAzlKqS7ZKib-yfI72Qq8a3Voir3JseUuJZxM6Bl6HgoRd3euX07mWkf3rLt82iF9T4w_ukvE45RpWmjV7Pscwe1aEc0g6OXGTkov86Lcf8MjSg7-E1_Yqmd4NTnXKq7ughzIE1KyvLmgQ4UwmmYyOi59AyJeEDGZZHA5q4Xy085W0VN1HQNcLMH9mlz0CbCZfjtLtaMYvSFYq3eac3cUajVToZLmTzOM35NhmUHoHz7Og_LhDkA9Np37ACnWdYlxA1Fyduv" }}',
                            editFileName: '',
                            handleEditFile(event) {
                                const file = event.target.files[0];
                                if (file) {
                                    this.editFileName = file.name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => { this.editPreviewImage = e.target.result; };
                                    reader.readAsDataURL(file);
                                }
                            }
                        }"
                    class="glass-card p-8 rounded-[2.5rem] border-white/5 space-y-6 group hover:translate-y-[-8px] transition-all relative overflow-hidden">
                    @if(!$court->is_active)
                        <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px] z-10 flex items-center justify-center">
                            <span
                                class="bg-red-500/20 border border-red-500/30 text-red-500 px-4 py-2 rounded-xl font-black uppercase tracking-[0.2em] text-xs italic transform -rotate-12">Nonaktif</span>
                        </div>
                    @endif

                    <div
                        class="relative w-full h-48 rounded-2xl overflow-hidden border border-white/5 shadow-2xl bg-surface-container-high">
                        <img src="{{ $court->foto ? asset('storage/' . str_replace('/storage/', '', $court->foto)) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuCbgt5saAzlKqS7ZKib-yfI72Qq8a3Voir3JseUuJZxM6Bl6HgoRd3euX07mWkf3rLt82iF9T4w_ukvE45RpWmjV7Pscwe1aEc0g6OXGTkov86Lcf8MjSg7-E1_Yqmd4NTnXKq7ughzIE1KyvLmgQ4UwmmYyOi59AyJeEDGZZHA5q4Xy085W0VN1HQNcLMH9mlz0CbCZfjtLtaMYvSFYq3eac3cUajVToZLmTzOM35NhmUHoHz7Og_LhDkA9Np37ACnWdYlxA1Fyduv' }}"
                            class="w-full h-full object-cover">
                        @if($court->is_active)
                            <div
                                class="absolute top-4 right-4 bg-green-500/20 backdrop-blur-md border border-green-500/20 text-green-400 text-[8px] font-black tracking-[0.2em] px-4 py-1.5 rounded-full uppercase">
                                Aktif</div>
                        @endif
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-headline font-black text-on-surface uppercase italic tracking-tight truncate w-32"
                                title="{{ $court->nama_lapangan }}">{{ $court->nama_lapangan }}</h3>
                            <p class="text-zinc-500 text-[10px] font-bold uppercase tracking-widest mt-1 italic">
                                {{ $court->tipe_olahraga }} • {{ $court->kategori_lokasi ?? 'Indoor' }} •
                                {{ $court->tipe_lantai ?? 'Standar' }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-primary-container text-lg font-black font-headline italic tracking-tighter">Rp
                                {{ number_format($court->harga_per_jam / 1000, 0, ',', '.') }}rb
                            </p>
                            <p class="text-zinc-600 text-[9px] uppercase font-bold tracking-widest mt-1">per jam</p>
                        </div>
                    </div>
                    <div class="flex gap-4 pt-4 border-t border-white/5 relative z-20">
                        <button @click="showEditCourtModal = true"
                            class="flex-1 bg-white/5 border border-white/10 text-on-surface py-3 rounded-xl font-headline font-black text-[10px] uppercase tracking-widest italic hover:bg-white/10 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">edit</span> UBAH
                        </button>
                        <form action="{{ route('mitra.inventaris.delete', $court->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-5 bg-red-500/10 border border-red-500/20 text-red-500 py-3 rounded-xl italic hover:bg-red-500/20 transition-all flex items-center justify-center">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                        </form>
                    </div>

                    {{-- ==================== EDIT COURT MODAL ==================== --}}
                    <div x-show="showEditCourtModal" style="display: none;"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-background/90 backdrop-blur-md overflow-y-auto">

                        <div class="my-auto w-full max-w-2xl">
                            <div @click.away="showEditCourtModal = false"
                                class="glass-card w-full p-8 md:p-10 rounded-[3rem] relative space-y-8 border-white/10 shadow-[0_0_50px_rgba(0,0,0,0.5)] text-left">
                                <!-- Close Button -->
                                <button @click="showEditCourtModal = false" type="button"
                                    class="absolute top-8 right-8 w-10 h-10 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center text-white transition-colors border border-white/5">
                                    <span class="material-symbols-outlined">close</span>
                                </button>

                                <header>
                                    <h2
                                        class="text-3xl font-headline font-black tracking-tighter uppercase italic text-white flex items-center gap-3">
                                        <span class="material-symbols-outlined text-primary-container text-4xl">edit</span>
                                        Ubah <span class="text-primary-container">Lapangan</span>
                                    </h2>
                                </header>

                                <form action="{{ route('mitra.inventaris.update', $court->id) }}" method="POST"
                                    enctype="multipart/form-data" class="space-y-6">
                                    @csrf
                                    @method('PUT')

                                    <!-- Upload Foto Area -->
                                    <div class="space-y-3">
                                        <label
                                            class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Foto
                                            Lapangan</label>
                                        <div :class="{'border-primary-container shadow-[0_0_20px_rgba(0,240,255,0.2)]': editPreviewImage, 'border-white/10 hover:border-primary-container/50': !editPreviewImage}"
                                            class="relative w-full h-48 rounded-3xl border-2 border-dashed bg-white/5 transition-all duration-300 overflow-hidden flex flex-col items-center justify-center cursor-pointer group">
                                            <input type="file" name="foto" accept="image/*" @change="handleEditFile($event)"
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">

                                            <div x-show="!editPreviewImage"
                                                class="flex flex-col items-center pointer-events-none">
                                                <div
                                                    class="w-12 h-12 rounded-xl bg-primary-container/10 text-primary-container flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                                    <span class="material-symbols-outlined">add_a_photo</span>
                                                </div>
                                                <span
                                                    class="font-headline font-bold text-xs uppercase tracking-widest text-white">Ubah
                                                    Gambar</span>
                                                <span
                                                    class="text-[9px] font-label text-zinc-500 uppercase tracking-widest mt-1">PNG,
                                                    JPG up to 2MB</span>
                                            </div>

                                            <img x-show="editPreviewImage" :src="editPreviewImage"
                                                class="absolute inset-0 w-full h-full object-cover z-10" alt="Preview">
                                            <div x-show="editPreviewImage"
                                                class="absolute inset-x-0 bottom-0 p-4 bg-gradient-to-t from-black/80 to-transparent z-10">
                                                <span
                                                    class="text-[10px] font-bold text-white tracking-widest truncate max-w-full block"
                                                    x-text="editFileName || 'Gambar Saat Ini'"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Input Grid -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="space-y-3">
                                            <label
                                                class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Nama
                                                Lapangan</label>
                                            <input type="text" name="nama_lapangan" value="{{ $court->nama_lapangan }}" required
                                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container focus:border-primary-container transition-all">
                                        </div>
                                        <div class="space-y-3">
                                            <label
                                                class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Jenis
                                                Olahraga</label>
                                            <select name="tipe_olahraga" required
                                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container focus:border-primary-container transition-all appearance-none cursor-pointer">
                                                <option value="" disabled class="bg-[#121317]">Pilih Olahraga...</option>
                                                @foreach(['Badminton', 'Futsal', 'Basketball', 'Tennis', 'Mini Soccer', 'Volley', 'Swimming', 'Table Tennis', 'Gym', 'Billiards', 'Yoga', 'Zumba'] as $sport)
                                                    <option value="{{ $sport }}" class="bg-[#121317]" {{ $court->tipe_olahraga == $sport ? 'selected' : '' }}>{{ $sport }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="space-y-3">
                                            <label
                                                class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Kategori
                                                Lokasi</label>
                                            <select name="kategori_lokasi" required
                                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container focus:border-primary-container transition-all appearance-none cursor-pointer">
                                                <option value="" disabled class="bg-[#121317]" {{ !$court->kategori_lokasi ? 'selected' : '' }}>Pilih Kategori...</option>
                                                <option value="Indoor" class="bg-[#121317]" {{ $court->kategori_lokasi == 'Indoor' ? 'selected' : '' }}>Indoor</option>
                                                <option value="Outdoor" class="bg-[#121317]" {{ $court->kategori_lokasi == 'Outdoor' ? 'selected' : '' }}>Outdoor</option>
                                            </select>
                                        </div>
                                        <div class="space-y-3">
                                            <label
                                                class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Jenis
                                                Lantai</label>
                                            <input type="text" name="tipe_lantai" value="{{ $court->tipe_lantai }}" required
                                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container focus:border-primary-container transition-all">
                                        </div>
                                        <div class="space-y-3">
                                            <label
                                                class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Harga
                                                Sewa / Jam (Rp)</label>
                                            <input type="number" name="harga_per_jam" value="{{ $court->harga_per_jam }}"
                                                required min="10000"
                                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container focus:border-primary-container transition-all">
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <label
                                            class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Status
                                            Tersedia</label>
                                        <select name="status"
                                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container focus:border-primary-container transition-all appearance-none cursor-pointer">
                                            <option value="1" class="bg-[#121317]" {{ $court->is_active ? 'selected' : '' }}>
                                                Aktif (Bisa dibooking)</option>
                                            <option value="0" class="bg-[#121317]" {{ !$court->is_active ? 'selected' : '' }}>
                                                Nonaktif (Tutup/Maintenance)</option>
                                        </select>
                                    </div>

                                    <div class="pt-6">
                                        <button type="submit"
                                            class="w-full bg-primary-container text-on-primary py-5 rounded-2xl font-headline font-black uppercase tracking-[0.2em] text-sm shadow-[0_15px_40px_rgba(0,240,255,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all italic flex items-center justify-center gap-3">
                                            <span class="material-symbols-outlined">save</span>
                                            SIMPAN PERUBAHAN
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 flex flex-col items-center justify-center opacity-40">
                    <span class="material-symbols-outlined text-6xl mb-6">inventory_2</span>
                    <p class="font-headline font-black text-xl italic uppercase tracking-widest text-center">Belum Ada Lapangan
                    </p>
                    <p class="font-label text-xs tracking-widest uppercase mt-2">Daftarkan lapangan pertama Anda sekarang.</p>
                </div>
            @endforelse
        </div>

        {{-- ==================== ADD COURT MODAL ==================== --}}
        <div x-show="showAddCourtModal" style="display: none;" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-background/90 backdrop-blur-md overflow-y-auto">

            <div class="my-auto w-full max-w-2xl">
                <div @click.away="showAddCourtModal = false"
                    class="glass-card w-full p-8 md:p-10 rounded-[3rem] relative space-y-8 border-white/10 shadow-[0_0_50px_rgba(0,0,0,0.5)]">
                    <!-- Close Button -->
                    <button @click="showAddCourtModal = false"
                        class="absolute top-8 right-8 w-10 h-10 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center text-white transition-colors border border-white/5">
                        <span class="material-symbols-outlined">close</span>
                    </button>

                    <header>
                        <h2
                            class="text-3xl font-headline font-black tracking-tighter uppercase italic text-white flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary-container text-4xl">add_box</span>
                            Tambah <span class="text-primary-container">Lapangan</span>
                        </h2>
                        <p class="text-[10px] font-label font-bold text-zinc-500 uppercase tracking-widest mt-2 ml-12">
                            Lengkapi detail untuk menambahkan court baru ke inventaris.</p>
                    </header>

                    <form action="{{ route('mitra.inventaris.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <!-- Upload Foto Area -->
                        <div class="space-y-3">
                            <label
                                class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Foto
                                Lapangan</label>
                            <div :class="{'border-primary-container shadow-[0_0_20px_rgba(0,240,255,0.2)]': previewImage, 'border-white/10 hover:border-primary-container/50': !previewImage}"
                                class="relative w-full h-48 rounded-3xl border-2 border-dashed bg-white/5 transition-all duration-300 overflow-hidden flex flex-col items-center justify-center cursor-pointer group">
                                <!-- Input File (Hidden but clickable) -->
                                <input type="file" name="foto" required accept="image/*" @change="handleFile($event)"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">

                                <!-- Placeholder UI -->
                                <div x-show="!previewImage" class="flex flex-col items-center pointer-events-none">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-primary-container/10 text-primary-container flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined">add_a_photo</span>
                                    </div>
                                    <span
                                        class="font-headline font-bold text-xs uppercase tracking-widest text-white">Upload
                                        Gambar</span>
                                    <span class="text-[9px] font-label text-zinc-500 uppercase tracking-widest mt-1">PNG,
                                        JPG up to 2MB</span>
                                </div>

                                <!-- Preview UI -->
                                <img x-show="previewImage" :src="previewImage"
                                    class="absolute inset-0 w-full h-full object-cover z-10" alt="Preview">
                                <div x-show="previewImage"
                                    class="absolute inset-x-0 bottom-0 p-4 bg-gradient-to-t from-black/80 to-transparent z-10">
                                    <span class="text-[10px] font-bold text-white tracking-widest truncate max-w-full block"
                                        x-text="fileName"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Input Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <label
                                    class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Nama
                                    Lapangan</label>
                                <input type="text" name="nama_lapangan" required placeholder="Cth: Main Court 01"
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container focus:border-primary-container transition-all placeholder:text-zinc-600">
                            </div>
                            <div class="space-y-3">
                                <label
                                    class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Jenis
                                    Olahraga</label>
                                <select name="tipe_olahraga" required
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container focus:border-primary-container transition-all appearance-none cursor-pointer">
                                    <option value="" selected disabled class="bg-[#121317]">Pilih Olahraga...</option>
                                    @foreach(['Badminton', 'Futsal', 'Basketball', 'Tennis', 'Mini Soccer', 'Volley', 'Swimming', 'Table Tennis', 'Gym', 'Billiards', 'Yoga', 'Zumba'] as $sport)
                                        <option value="{{ $sport }}" class="bg-[#121317]">{{ $sport }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-3">
                                <label
                                    class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Kategori
                                    Lokasi</label>
                                <select name="kategori_lokasi" required
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container focus:border-primary-container transition-all appearance-none cursor-pointer">
                                    <option value="" selected disabled class="bg-[#121317]">Pilih Kategori...</option>
                                    <option value="Indoor" class="bg-[#121317]">Indoor</option>
                                    <option value="Outdoor" class="bg-[#121317]">Outdoor</option>
                                </select>
                            </div>
                            <div class="space-y-3">
                                <label
                                    class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Jenis
                                    Lantai</label>
                                <input type="text" name="tipe_lantai" required placeholder="Cth: Vinyl Premium"
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container focus:border-primary-container transition-all placeholder:text-zinc-600">
                            </div>
                            <div class="space-y-3">
                                <label
                                    class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Harga
                                    Sewa / Jam (Rp)</label>
                                <input type="number" name="harga_per_jam" required min="10000" placeholder="150000"
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container focus:border-primary-container transition-all placeholder:text-zinc-600">
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label
                                class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-on-surface-variant">Status
                                Tersedia</label>
                            <select name="status"
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 font-headline font-bold text-on-surface focus:ring-1 focus:ring-primary-container focus:border-primary-container transition-all appearance-none cursor-pointer">
                                <option value="1" class="bg-[#121317]">Aktif (Bisa dibooking)</option>
                                <option value="0" class="bg-[#121317]">Nonaktif (Tutup/Maintenance)</option>
                            </select>
                        </div>

                        <div class="pt-6">
                            <button type="submit"
                                class="w-full bg-primary-container text-on-primary py-5 rounded-2xl font-headline font-black uppercase tracking-[0.2em] text-sm shadow-[0_15px_40px_rgba(0,240,255,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all italic flex items-center justify-center gap-3">
                                <span class="material-symbols-outlined">save</span>
                                SIMPAN LAPANGAN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection