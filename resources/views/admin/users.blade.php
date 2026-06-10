@extends('layouts.admin')

@section('title', 'Manajemen Pengguna — Super Admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <header class="flex justify-between items-end mb-16">
        <div>
            <h1 class="text-4xl font-headline font-black tracking-tighter text-on-surface uppercase italic">Daftar <span class="text-primary-container">Pengguna</span></h1>
            <p class="text-on-surface-variant font-label mt-3 opacity-60 tracking-wider uppercase text-[10px] font-bold">Kelola dan monitor seluruh basis pengguna platform Saraga secara terpusat.</p>
        </div>
        <div class="flex gap-4">
            <div class="relative">
                <input type="text" placeholder="Cari nama atau email..." class="bg-white/5 border border-white/10 rounded-xl px-12 py-3 text-xs font-bold font-headline focus:ring-1 focus:ring-primary-container transition-all">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-zinc-500 text-sm">search</span>
            </div>
        </div>
    </header>

    <div class="glass-card rounded-[2.5rem] border-white/5 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-white/5">
                <tr>
                    <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Pengguna / Akun</th>
                    <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label">Role</th>
                    <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label text-center">Status</th>
                    <th class="px-10 py-8 text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] font-label text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5" x-data="{
                toggleUser(userId, currentStatus) {
                    let action = currentStatus ? 'menangguhkan (suspend)' : 'mengaktifkan kembali';
                    if (confirm(`Apakah Anda yakin ingin ${action} pengguna ini?`)) {
                        fetch(`/admin/users/${userId}/toggle-status`, {
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
                                alert(data.message || 'Terjadi kesalahan.');
                            }
                        });
                    }
                }
            }">
                @foreach($users as $user)
                    <tr class="group hover:bg-white/[0.02] transition-colors">
                        <td class="px-10 py-8">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-primary-container/10 border border-primary-container/20 flex items-center justify-center font-black text-primary-container text-[10px] uppercase">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                                <div>
                                    <p class="text-sm font-black text-white italic uppercase tracking-tight">{{ $user->name }}</p>
                                    <p class="text-[9px] text-zinc-600 font-bold tracking-widest mt-0.5">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-8">
                            @if($user->isAdmin())
                                <span class="px-4 py-1.5 rounded-lg bg-red-500/10 border border-red-500/20 text-red-500 text-[9px] font-black tracking-widest uppercase italic">Admin</span>
                            @elseif($user->isVendor())
                                <span class="px-4 py-1.5 rounded-lg bg-cyan-500/10 border border-cyan-500/20 text-cyan-500 text-[9px] font-black tracking-widest uppercase italic">Vendor</span>
                            @else
                                <span class="px-4 py-1.5 rounded-lg bg-zinc-900 border border-white/5 text-zinc-400 text-[9px] font-black tracking-widest uppercase italic">User / Member</span>
                            @endif
                        </td>
                        <td class="px-10 py-8 text-center">
                            @if($user->is_active)
                                <span class="px-3 py-1 bg-green-500/10 text-green-400 border border-green-500/20 rounded-full text-[9px] font-black tracking-widest uppercase">Aktif</span>
                            @else
                                <span class="px-3 py-1 bg-red-500/10 text-red-400 border border-red-500/20 rounded-full text-[9px] font-black tracking-widest uppercase">Suspended</span>
                            @endif
                        </td>
                        <td class="px-10 py-8 text-right">
                            <button @click="toggleUser({{ $user->id }}, {{ $user->is_active ? 'true' : 'false' }})" class="px-6 py-2 {{ $user->is_active ? 'bg-red-500/10 border-red-500/20 text-red-500 hover:bg-red-500/20' : 'bg-green-500/10 border-green-500/20 text-green-400 hover:bg-green-500/20' }} border text-[9px] font-black uppercase tracking-widest italic transition-all rounded-lg">
                                {{ $user->is_active ? 'Suspend' : 'Aktifkan' }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-8 border-t border-white/5">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
