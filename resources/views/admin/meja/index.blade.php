@extends('admin.layout')
@section('title', 'Manajemen Meja')
@section('breadcrumb')
    <span class="text-gray-700 font-medium">Meja</span>
@endsection

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2.5 py-1 rounded-lg">Workspace</span>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight mt-1.5">Manajemen Meja</h1>
            <p class="text-xs text-slate-400">Kelola tata letak, kapasitas, status, dan tarif meja restoran.</p>
        </div>
        <a href="{{ route('admin.meja.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl shadow-sm transition text-xs cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            Tambah Meja
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nomor Meja</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kapasitas</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tarif Reservasi</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Status Meja</th>
                        <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($meja as $m)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-2 font-extrabold text-slate-800 text-[13px] bg-slate-50 px-2.5 py-1.5 border border-slate-100 rounded-xl">
                                    Meja {{ $m->nomor_meja }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-600">{{ $m->kapasitas }} orang</td>
                            <td class="px-6 py-4 font-bold text-slate-800">
                                @if($m->harga)
                                    Rp {{ number_format($m->harga, 0, ',', '.') }}
                                @else
                                    <span class="text-slate-400 font-medium">Gratis / Tanpa Biaya</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($m->status === 'tersedia')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Tersedia
                                    </span>
                                @elseif($m->status === 'terisi')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-100 uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Terisi
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-rose-50 text-rose-700 border-rose-100 uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        Maintenance
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.meja.edit', $m->id) }}" class="px-2.5 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-200/60 rounded-lg font-bold text-slate-600 transition">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.meja.destroy', $m->id) }}" class="inline" onsubmit="event.preventDefault(); confirmDelete(this, 'Hapus Meja {{ $m->nomor_meja }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-lg font-bold transition cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-slate-400">
                                <svg class="w-12 h-12 stroke-current mx-auto mb-3 opacity-60" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" /></svg>
                                <p class="text-slate-800 font-bold text-sm mb-1">Belum ada data meja</p>
                                <p class="text-xs text-slate-400 mb-4">Mulai tambahkan meja restoran Anda</p>
                                <a href="{{ route('admin.meja.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition cursor-pointer">
                                    Tambah Meja Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($meja->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $meja->links() }}
            </div>
        @endif
    </div>
@endsection
