@extends('admin.layout')
@section('title', 'Manajemen Reservasi')
@section('breadcrumb')
    <span class="text-gray-700 font-medium">Reservasi</span>
@endsection

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2.5 py-1 rounded-lg">Workspace</span>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight mt-1.5">Manajemen Reservasi</h1>
            <p class="text-xs text-slate-400">Kelola, konfirmasi, dan pantau reservasi pelanggan.</p>
        </div>
    </div>

    <!-- Filter Tabs -->
    @php
        $currentStatus = request('status', '');
    @endphp
    <div class="flex flex-wrap gap-2 mb-4 bg-white p-2.5 rounded-2xl border border-slate-100 shadow-sm">
        <a href="{{ route('admin.reservasi.index', request()->only(['q', 'tanggal'])) }}"
           class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-150 {{ $currentStatus === '' ? 'bg-blue-600 text-white shadow-md shadow-blue-500/10' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 border border-slate-200/40' }}">
            Semua
            <span class="ml-1 opacity-75">({{ $counts['total'] }})</span>
        </a>
        <a href="{{ route('admin.reservasi.index', array_merge(request()->only(['q', 'tanggal']), ['status' => 'pending'])) }}"
           class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-150 {{ $currentStatus === 'pending' ? 'bg-amber-500 text-white shadow-md shadow-amber-500/10' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 border border-slate-200/40' }}">
            Pending
            <span class="ml-1 opacity-75">({{ $counts['pending'] }})</span>
        </a>
        <a href="{{ route('admin.reservasi.index', array_merge(request()->only(['q', 'tanggal']), ['status' => 'approved'])) }}"
           class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-150 {{ $currentStatus === 'approved' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/10' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 border border-slate-200/40' }}">
            Disetujui
            <span class="ml-1 opacity-75">({{ $counts['approved'] }})</span>
        </a>
        <a href="{{ route('admin.reservasi.index', array_merge(request()->only(['q', 'tanggal']), ['status' => 'completed'])) }}"
           class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-150 {{ $currentStatus === 'completed' ? 'bg-blue-600 text-white shadow-md shadow-blue-500/10' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 border border-slate-200/40' }}">
            Selesai
            <span class="ml-1 opacity-75">({{ $counts['completed'] }})</span>
        </a>
        <a href="{{ route('admin.reservasi.index', array_merge(request()->only(['q', 'tanggal']), ['status' => 'rejected'])) }}"
           class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-150 {{ $currentStatus === 'rejected' ? 'bg-rose-600 text-white shadow-md shadow-rose-500/10' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 border border-slate-200/40' }}">
            Ditolak
            <span class="ml-1 opacity-75">({{ $counts['rejected'] }})</span>
        </a>
        <a href="{{ route('admin.reservasi.index', array_merge(request()->only(['q', 'tanggal']), ['status' => 'cancelled'])) }}"
           class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-150 {{ $currentStatus === 'cancelled' ? 'bg-slate-500 text-white shadow-md shadow-slate-500/10' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 border border-slate-200/40' }}">
            Batal
            <span class="ml-1 opacity-75">({{ $counts['cancelled'] }})</span>
        </a>
    </div>

    <!-- Search & Date Filter Form -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 mb-6">
        <form method="GET" action="{{ route('admin.reservasi.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-end">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            
            <div class="sm:col-span-5">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Pencarian</label>
                <div class="relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, kontak, nomor meja..." class="w-full pl-9 pr-4 py-2 text-xs border border-slate-200 rounded-xl outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" /></svg>
                </div>
            </div>
            
            <div class="sm:col-span-3">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal Reservasi</label>
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-xl outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50 bg-white">
            </div>
            
            <div class="sm:col-span-4 flex gap-2">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-2.5 px-4 rounded-xl shadow-sm transition cursor-pointer text-center">
                    Cari
                </button>
                @if(request('q') || request('tanggal'))
                    <a href="{{ route('admin.reservasi.index', request('status') ? ['status' => request('status')] : []) }}" class="flex-1 border border-slate-200 hover:bg-slate-50 text-slate-600 text-xs font-bold py-2.5 px-4 rounded-xl transition text-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pemesan</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tanggal & Jam</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Meja</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reservasi as $res)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <!-- Initials Avatar -->
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500/10 to-indigo-500/10 text-indigo-700 border border-indigo-100/20 font-bold text-[11px] flex items-center justify-center shrink-0">
                                        {{ strtoupper(substr($res->nama_pemesan, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-[13px]">{{ $res->nama_pemesan }}</p>
                                        <p class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $res->jumlah_orang }} orang</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-600">{{ $res->kontak_pemesan }}</td>
                            <td class="px-6 py-4">
                                <p class="text-slate-800 font-bold">{{ \Carbon\Carbon::parse($res->tanggal_reservasi)->translatedFormat('d M Y') }}</p>
                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $res->jam_reservasi }} WITA</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-blue-50 border border-blue-100 text-blue-700 rounded-lg font-bold">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" /></svg>
                                    Meja {{ $res->meja?->nomor_meja ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                                        'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                        'rejected' => 'bg-rose-50 text-rose-700 border-rose-100',
                                        'completed' => 'bg-blue-50 text-blue-700 border-blue-100',
                                        'cancelled' => 'bg-slate-50 text-slate-700 border-slate-100',
                                    ];
                                @endphp
                                <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-md border {{ $statusColors[$res->status] ?? 'bg-slate-50 border-slate-100' }} uppercase tracking-wider">
                                    {{ $res->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.reservasi.show', $res->id) }}" class="px-2.5 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-200/60 rounded-lg font-bold text-slate-600 transition" title="Detail">
                                        Detail
                                    </a>
                                    @if($res->status === 'pending')
                                        <form method="POST" action="{{ route('admin.reservasi.approve', $res->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="px-2.5 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg font-bold transition shadow-sm cursor-pointer">
                                                Setuju
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.reservasi.reject', $res->id) }}" class="inline" onsubmit="return confirm('Tolak reservasi ini?')">
                                            @csrf
                                            <button type="submit" class="px-2.5 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-lg font-bold transition cursor-pointer">
                                                Tolak
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                                <svg class="w-12 h-12 stroke-current mx-auto mb-3 opacity-60" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.008 1.24l.885 1.77a2.25 2.25 0 0 0 2.007 1.24h1.98a2.25 2.25 0 0 0 2.007-1.24l.885-1.77a2.25 2.25 0 0 1 2.007-1.24h3.86m-18 0h18" /></svg>
                                <p class="text-slate-800 font-bold text-sm mb-1">Belum ada reservasi</p>
                                <p class="text-xs text-slate-400">Reservasi dari pelanggan akan muncul di sini</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reservasi->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $reservasi->links() }}
            </div>
        @endif
    </div>
@endsection
