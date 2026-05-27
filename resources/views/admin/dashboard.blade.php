@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <!-- Dashboard Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2.5 py-1 rounded-lg">Admin Panel</span>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight mt-1.5">Overview Performa</h1>
            <p class="text-xs text-slate-400">Selamat datang kembali, <span class="font-semibold text-slate-600">{{ auth()->user()?->name }}</span>! Berikut ringkasan aktivitas restoran hari ini.</p>
        </div>
        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-50 border border-slate-200/50 rounded-xl text-xs font-semibold text-slate-600 self-start sm:self-center shadow-sm">
            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
            <span>{{ now()->translatedFormat('d F Y') }}</span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Card 1: Total Reservasi -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 hover-lift">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Reservasi</p>
                    <p class="text-2xl font-extrabold text-slate-800 tracking-tight mt-2">{{ $totalReservasi }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-600 flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                </div>
            </div>
            <div class="mt-3.5 pt-3.5 border-t border-slate-100 flex items-center">
                <a href="{{ route('admin.reservasi.index') }}" class="text-[11px] font-semibold text-blue-600 hover:text-blue-750 inline-flex items-center gap-1 transition-colors">
                    Lihat Detail
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </a>
            </div>
        </div>

        <!-- Card 2: Pending -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 hover-lift">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Reservasi Pending</p>
                    <p class="text-2xl font-extrabold text-slate-800 tracking-tight mt-2">{{ $reservasiPending }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
            </div>
            <div class="mt-3.5 pt-3.5 border-t border-slate-100 flex items-center">
                @if($reservasiPending > 0)
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-amber-50 border border-amber-100 text-[10px] font-bold text-amber-700 uppercase tracking-wide animate-pulse">
                        Perlu Konfirmasi
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-slate-50 border border-slate-100 text-[10px] font-bold text-slate-500 uppercase tracking-wide">
                        Semua Diproses
                    </span>
                @endif
            </div>
        </div>

        <!-- Card 3: Total Menu -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 hover-lift">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Menu</p>
                    <p class="text-2xl font-extrabold text-slate-800 tracking-tight mt-2">{{ $totalMenu }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75-1.5.75a3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0L3 16.5m15-3.379a48.474 48.474 0 0 0-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 0 1 3 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 0 1 6 13.12M12.265 3.11a.375.375 0 1 1-.53 0L12 2.845l.265.265Z" /></svg>
                </div>
            </div>
            <div class="mt-3.5 pt-3.5 border-t border-slate-100 flex items-center">
                <a href="{{ route('admin.menu.index') }}" class="text-[11px] font-semibold text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-1 transition-colors">
                    Kelola Menu
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </a>
            </div>
        </div>

        <!-- Card 4: Total Meja -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 hover-lift">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Meja</p>
                    <p class="text-2xl font-extrabold text-slate-800 tracking-tight mt-2">{{ $totalMeja }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-600 flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" /></svg>
                </div>
            </div>
            <div class="mt-3.5 pt-3.5 border-t border-slate-100 flex items-center">
                <a href="{{ route('admin.meja.index') }}" class="text-[11px] font-semibold text-purple-600 hover:text-purple-750 inline-flex items-center gap-1 transition-colors">
                    Kelola Meja
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
        <!-- Reservasi Per Bulan -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
            <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/30 bg-gradient-to-r from-slate-50/50 to-transparent">
                <div>
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Aktivitas Tren</h2>
                    <h3 class="text-sm font-bold text-slate-800 mt-0.5">Reservasi Per Bulan</h3>
                </div>
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
            </div>
            <div class="p-4 flex-1">
                <div class="h-[200px] relative">
                    <canvas id="chartReservasiBulan"></canvas>
                </div>
            </div>
        </div>

        <!-- Status Reservasi (Doughnut with detailed side list) -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
            <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/30 bg-gradient-to-r from-slate-50/50 to-transparent">
                <div>
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Distribusi Status</h2>
                    <h3 class="text-sm font-bold text-slate-800 mt-0.5">Status Reservasi</h3>
                </div>
            </div>
            <div class="p-4 flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center h-full">
                    <div class="sm:col-span-5 h-[180px] relative flex justify-center items-center">
                        <canvas id="chartStatusReservasi"></canvas>
                    </div>
                    <div class="sm:col-span-7 space-y-1.5">
                        @php
                            $statusLabels = ['Pending', 'Approved', 'Rejected', 'Completed', 'Cancelled'];
                            $statusColors = [
                                'bg-amber-500 border-amber-600/20',   // Pending
                                'bg-emerald-500 border-emerald-600/20', // Approved
                                'bg-rose-500 border-rose-600/20',    // Rejected
                                'bg-blue-500 border-blue-600/20',    // Completed
                                'bg-slate-400 border-slate-500/20',   // Cancelled
                            ];
                        @endphp
                        @foreach($statusLabels as $index => $label)
                            <div class="flex items-center justify-between text-[11px] border border-slate-50 rounded-xl p-2 hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full border {{ $statusColors[$index] }}"></span>
                                    <span class="font-semibold text-slate-600">{{ $label }}</span>
                                </div>
                                <span class="font-extrabold text-slate-800 bg-slate-100 px-2 py-0.5 rounded-md min-w-[24px] text-center">{{ $chartStatusData[$index] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendapatan Per Bulan -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
            <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/30 bg-gradient-to-r from-slate-50/50 to-transparent">
                <div>
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Performa Finansial</h2>
                    <h3 class="text-sm font-bold text-slate-800 mt-0.5">Pendapatan Per Bulan</h3>
                </div>
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            </div>
            <div class="p-4 flex-1">
                <div class="h-[200px] relative">
                    <canvas id="chartPendapatan"></canvas>
                </div>
            </div>
        </div>

        <!-- Top 5 Meja Terlaris -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
            <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/30 bg-gradient-to-r from-slate-50/50 to-transparent">
                <div>
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Popularitas Aset</h2>
                    <h3 class="text-sm font-bold text-slate-800 mt-0.5">Top 5 Meja Terlaris</h3>
                </div>
            </div>
            <div class="p-4 flex-1">
                <div class="h-[200px] relative">
                    <canvas id="chartMejaPopuler"></canvas>
                </div>
            </div>
        </div>
    </div>

    @php
        $persenTersedia = $totalMeja > 0 ? round(($mejaTersedia / $totalMeja) * 100) : 0;
        $persenTerisi = $totalMeja > 0 ? round(($mejaTerisi / $totalMeja) * 100) : 0;
    @endphp

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Recent Reservasi -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col h-[420px]">
            <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/30 shrink-0">
                <div>
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Aktivitas Real-time</h2>
                    <h3 class="text-sm font-bold text-slate-800 mt-0.5">Reservasi Terbaru</h3>
                </div>
            </div>
            <div class="p-4 flex-1 overflow-y-auto scrollbar-thin space-y-2.5">
                @forelse($recentReservasi as $reservasi)
                    <div class="flex items-center gap-3 p-2.5 rounded-xl border border-slate-50 hover:border-slate-100 hover:bg-slate-50/50 transition-all duration-155">
                        <!-- Initials Avatar Badge -->
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500/10 to-indigo-500/10 text-indigo-700 border border-indigo-100/20 font-bold text-xs flex items-center justify-center shrink-0 shadow-sm">
                            {{ strtoupper(substr($reservasi->nama_pemesan, 0, 2)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                           <div class="flex items-center justify-between gap-2">
                               <p class="text-xs font-semibold text-slate-800 truncate leading-tight">{{ $reservasi->nama_pemesan }}</p>
                               @php
                                   $badgeColors = [
                                       'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                                       'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                       'rejected' => 'bg-rose-50 text-rose-700 border-rose-100',
                                       'completed' => 'bg-blue-50 text-blue-700 border-blue-100',
                                       'cancelled' => 'bg-slate-50 text-slate-700 border-slate-100',
                                   ];
                               @endphp
                               <span class="px-2 py-0.5 text-[9px] font-bold rounded-md border {{ $badgeColors[$reservasi->status] ?? 'bg-slate-50 text-slate-700 border-slate-100' }} uppercase tracking-wider">
                                   {{ $reservasi->status }}
                                </span>
                           </div>
                           <div class="flex items-center justify-between mt-1">
                               <span class="text-[10px] text-slate-500 font-medium flex items-center gap-1">
                                   <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                                   {{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->translatedFormat('d M Y') }} • {{ $reservasi->jam_reservasi }}
                               </span>
                               <span class="text-[10px] text-slate-400 font-semibold bg-slate-100 px-1.5 py-0.5 rounded-md">
                                   Meja {{ $reservasi->meja?->nomor_meja ?? '-' }} ({{ $reservasi->jumlah_orang }} org)
                               </span>
                           </div>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-16 text-slate-400">
                        <svg class="w-10 h-10 stroke-current mb-2 opacity-60" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.008 1.24l.885 1.77a2.25 2.25 0 0 0 2.007 1.24h1.98a2.25 2.25 0 0 0 2.007-1.24l.885-1.77a2.25 2.25 0 0 1 2.007-1.24h3.86m-18 0h18" /></svg>
                        <p class="text-xs font-semibold">Belum ada reservasi</p>
                    </div>
                @endforelse
            </div>
            <div class="px-5 py-3.5 bg-slate-50 border-t border-slate-100 flex justify-end shrink-0">
                <a href="{{ route('admin.reservasi.index') }}" class="text-[11px] font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 transition-colors">
                    Lihat Semua Reservasi
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </a>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col h-[420px]">
            <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/30 shrink-0">
                <div>
                    <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Overview Operasional</h2>
                    <h3 class="text-sm font-bold text-slate-800 mt-0.5">Statistik Cepat</h3>
                </div>
            </div>
            <div class="p-4 flex-1 overflow-y-auto scrollbar-thin space-y-3.5">
                <!-- Meja Tersedia with progress bar -->
                <div class="p-3 border border-slate-100 rounded-xl hover:bg-slate-50/30 transition-colors">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-emerald-500/10 text-emerald-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" /></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-700">Meja Tersedia</span>
                        </div>
                        <span class="text-xs font-extrabold text-slate-800">{{ $mejaTersedia }} / {{ $totalMeja }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-1.5">
                        <div class="bg-emerald-500 h-1.5 rounded-full transition-all duration-500" style="width: {{ $persenTersedia }}%"></div>
                    </div>
                    <div class="flex justify-between items-center mt-1">
                        <span class="text-[9px] text-slate-400 font-semibold">Tingkat Ketersediaan</span>
                        <span class="text-[10px] text-emerald-600 font-extrabold">{{ $persenTersedia }}%</span>
                    </div>
                </div>

                <!-- Meja Terisi with progress bar -->
                <div class="p-3 border border-slate-100 rounded-xl hover:bg-slate-50/30 transition-colors">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-amber-500/10 text-amber-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h16.5a1.5 1.5 0 0 0 1.5-1.5V13.5a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 13.5v6.75a1.5 1.5 0 0 0 1.5 1.5Z" /></svg>
                            </div>
                            <span class="text-xs font-bold text-slate-700">Meja Terisi</span>
                        </div>
                        <span class="text-xs font-extrabold text-slate-800">{{ $mejaTerisi }} / {{ $totalMeja }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-1.5">
                        <div class="bg-amber-500 h-1.5 rounded-full transition-all duration-500" style="width: {{ $persenTerisi }}%"></div>
                    </div>
                    <div class="flex justify-between items-center mt-1">
                        <span class="text-[9px] text-slate-400 font-semibold">Tingkat Keterisian</span>
                        <span class="text-[10px] text-amber-600 font-extrabold">{{ $persenTerisi }}%</span>
                    </div>
                </div>

                <!-- Grid of other 3 stats to look extremely compact -->
                <div class="grid grid-cols-3 gap-2">
                    <div class="p-2 border border-slate-100 rounded-xl text-center hover:bg-slate-50/50 transition-all duration-150 flex flex-col justify-between">
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider leading-tight">Approved Hari Ini</p>
                        <p class="text-lg font-black text-blue-600 mt-1.5 tracking-tight">{{ $approvedToday }}</p>
                        <p class="text-[8px] text-slate-400 mt-0.5">Reservasi</p>
                    </div>
                    <div class="p-2 border border-slate-100 rounded-xl text-center hover:bg-slate-50/50 transition-all duration-150 flex flex-col justify-between">
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider leading-tight">Total Galeri</p>
                        <p class="text-lg font-black text-purple-600 mt-1.5 tracking-tight">{{ $totalGaleri }}</p>
                        <p class="text-[8px] text-slate-400 mt-0.5">Media Foto</p>
                    </div>
                    <div class="p-2 border border-slate-100 rounded-xl text-center hover:bg-slate-50/50 transition-all duration-150 flex flex-col justify-between">
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider leading-tight">Total Pelanggan</p>
                        <p class="text-lg font-black text-cyan-600 mt-1.5 tracking-tight">{{ $totalPelanggan }}</p>
                        <p class="text-[8px] text-slate-400 mt-0.5">User</p>
                    </div>
                </div>
            </div>
            <div class="px-5 py-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between shrink-0">
                <span class="text-[9px] text-slate-400 font-semibold flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Live Monitoring
                </span>
                <span class="text-[9px] text-slate-400 font-semibold">Update: {{ now()->format('H:i') }} WITA</span>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ===== 1. Line Chart: Reservasi Per Bulan =====
            const ctx1 = document.getElementById('chartReservasiBulan').getContext('2d');
            const gradient1 = ctx1.createLinearGradient(0, 0, 0, 180);
            gradient1.addColorStop(0, 'rgba(37, 99, 235, 0.15)');
            gradient1.addColorStop(1, 'rgba(37, 99, 235, 0.01)');

            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: @json($chartBulanLabels),
                    datasets: [{
                        label: 'Reservasi',
                        data: @json($chartBulanData),
                        borderColor: '#2563EB',
                        backgroundColor: gradient1,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.35,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#2563EB',
                        pointBorderWidth: 1.5,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1E293B',
                            titleFont: { size: 11, weight: 'bold' },
                            bodyFont: { size: 10 },
                            padding: 8,
                            cornerRadius: 6,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0, font: { size: 9, weight: '500' }, color: '#94A3B8' },
                            grid: { color: '#F1F5F9' }
                        },
                        x: {
                            ticks: { font: { size: 9, weight: '500' }, color: '#94A3B8' },
                            grid: { display: false }
                        }
                    }
                }
            });

            // ===== 2. Doughnut Chart: Status Reservasi =====
            const ctx2 = document.getElementById('chartStatusReservasi').getContext('2d');
            new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: @json($chartStatusLabels),
                    datasets: [{
                        data: @json($chartStatusData),
                        backgroundColor: [
                            '#f59e0b', // Pending - Amber
                            '#10b981', // Approved - Emerald
                            '#f43f5e', // Rejected - Rose
                            '#3b82f6', // Completed - Blue
                            '#94a3b8', // Cancelled - Slate/Gray
                        ],
                        borderWidth: 1.5,
                        borderColor: '#ffffff',
                        hoverOffset: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '78%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1E293B',
                            padding: 8,
                            cornerRadius: 6,
                            bodyFont: { size: 10 },
                        }
                    }
                }
            });

            // ===== 3. Bar Chart: Pendapatan Per Bulan =====
            const ctx3 = document.getElementById('chartPendapatan').getContext('2d');
            const gradient3 = ctx3.createLinearGradient(0, 0, 0, 180);
            gradient3.addColorStop(0, 'rgba(16, 185, 129, 0.8)');
            gradient3.addColorStop(1, 'rgba(16, 185, 129, 0.05)');

            new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: @json($chartBulanLabels),
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: @json($chartPendapatanData),
                        backgroundColor: gradient3,
                        borderColor: '#10B981',
                        borderWidth: 1.5,
                        borderRadius: 4,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#065F46',
                            padding: 8,
                            cornerRadius: 6,
                            bodyFont: { size: 10 },
                            callbacks: {
                                label: function(ctx) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(ctx.raw);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: { size: 9, weight: '500' },
                                color: '#94A3B8',
                                callback: function(val) {
                                    if (val >= 1000000) return 'Rp ' + (val / 1000000).toLocaleString('id-ID') + ' jt';
                                    if (val >= 1000) return 'Rp ' + (val / 1000).toLocaleString('id-ID') + ' rb';
                                    return 'Rp ' + val;
                                }
                            },
                            grid: { color: '#F1F5F9' }
                        },
                        x: {
                            ticks: { font: { size: 9, weight: '500' }, color: '#94A3B8' },
                            grid: { display: false }
                        }
                    }
                }
            });

            // ===== 4. Horizontal Bar Chart: Top 5 Meja Populer =====
            const mejaLabels = @json($chartMejaLabels);
            const mejaData = @json($chartMejaData);

            if (mejaLabels.length > 0) {
                const ctx4 = document.getElementById('chartMejaPopuler').getContext('2d');
                const gradient4 = ctx4.createLinearGradient(0, 0, 300, 0);
                gradient4.addColorStop(0, '#6366f1');
                gradient4.addColorStop(1, '#a855f7');

                new Chart(ctx4, {
                    type: 'bar',
                    data: {
                        labels: mejaLabels,
                        datasets: [{
                            label: 'Total Booking',
                            data: mejaData,
                            backgroundColor: gradient4,
                            borderWidth: 0,
                            borderRadius: 4,
                            borderSkipped: false,
                            barThickness: 12
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#4C1D95',
                                padding: 8,
                                cornerRadius: 6,
                                bodyFont: { size: 10 },
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: { precision: 0, font: { size: 9, weight: '500' }, color: '#94A3B8' },
                                grid: { color: '#F1F5F9' }
                            },
                            y: {
                                ticks: { font: { size: 10, weight: '600' }, color: '#64748B' },
                                grid: { display: false }
                            }
                        }
                    }
                });
            } else {
                document.getElementById('chartMejaPopuler').parentElement.innerHTML = '<div class="flex items-center justify-center h-full text-slate-400 py-8"><p class="text-xs font-semibold">Belum ada data meja</p></div>';
            }
        });
    </script>
@endsection
