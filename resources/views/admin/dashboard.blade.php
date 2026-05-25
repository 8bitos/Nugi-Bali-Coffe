@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600 mt-1">Selamat datang, {{ auth()->user()?->name }}!</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Reservasi -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-600">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Total Reservasi</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $total_reservasi ?? 0 }}</p>
                </div>
                <div class="text-3xl opacity-20">📅</div>
            </div>
            <a href="{{ route('admin.reservasi.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold mt-3 inline-block">Lihat Detail →</a>
        </div>

        <!-- Pending Reservasi -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Pending</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pending_reservasi ?? 0 }}</p>
                </div>
                <div class="text-3xl opacity-20">⏳</div>
            </div>
            <p class="text-yellow-600 text-sm font-semibold mt-3">Perlu konfirmasi</p>
        </div>

        <!-- Total Menu -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-600">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Total Menu</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $total_menu ?? 0 }}</p>
                </div>
                <div class="text-3xl opacity-20">🍽️</div>
            </div>
            <a href="{{ route('admin.menu.index') }}" class="text-green-600 hover:text-green-700 text-sm font-semibold mt-3 inline-block">Kelola Menu →</a>
        </div>

        <!-- Total Meja -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-600">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Total Meja</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $total_meja ?? 0 }}</p>
                </div>
                <div class="text-3xl opacity-20">🪑</div>
            </div>
            <a href="{{ route('admin.meja.index') }}" class="text-purple-600 hover:text-purple-700 text-sm font-semibold mt-3 inline-block">Kelola Meja →</a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Reservasi -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-4 text-white">
                <h2 class="text-lg font-bold">📅 Reservasi Terbaru</h2>
            </div>
            <div class="p-6">
                @forelse($recent_reservasi ?? [] as $reservasi)
                    <div class="border-b pb-4 mb-4 last:border-b-0 last:mb-0 last:pb-0">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $reservasi->nama_pemesan }}</p>
                                <p class="text-sm text-gray-600">{{ $reservasi->tanggal_reservasi }} @ {{ $reservasi->jam_reservasi }}</p>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                {{ $reservasi->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $reservasi->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $reservasi->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                            ">
                                {{ ucfirst($reservasi->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-700">Meja: {{ $reservasi->meja?->nomor_meja }} | {{ $reservasi->jumlah_orang }} orang</p>
                    </div>
                @empty
                    <p class="text-gray-600 text-center py-6">Belum ada reservasi</p>
                @endforelse
                <a href="{{ route('admin.reservasi.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm mt-4 inline-block">Lihat Semua →</a>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-4 text-white">
                <h2 class="text-lg font-bold">📊 Statistik Cepat</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-700 font-semibold">Meja Tersedia</span>
                    <span class="text-2xl font-bold text-green-600">{{ $meja_tersedia ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-700 font-semibold">Meja Terisi</span>
                    <span class="text-2xl font-bold text-orange-600">{{ $meja_terisi ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-700 font-semibold">Approved Today</span>
                    <span class="text-2xl font-bold text-blue-600">{{ $approved_today ?? 0 }}</span>
                </div>
                <div class="pt-4 border-t">
                    <p class="text-sm text-gray-600">Terakhir update: <strong>{{ now()->format('H:i:s') }}</strong></p>
                </div>
            </div>
        </div>
    </div>
@endsection
