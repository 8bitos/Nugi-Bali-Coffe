@extends('layouts.app')

@section('title', 'Reservasi Saya')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('pelanggan.dashboard') }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 font-semibold text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg> Dashboard
            </a>
        </div>
        <h1 class="text-3xl font-bold text-gray-900">Reservasi Saya</h1>
        <p class="text-gray-600 mt-1">Kelola dan pantau semua reservasi Anda</p>
    </div>

    <!-- Filter Tabs -->
    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ route('pelanggan.reservasi') }}"
           class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $status === '' ? 'bg-blue-600 text-white shadow' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300' }}">
            Semua <span class="ml-1 opacity-75">({{ $counts['total'] }})</span>
        </a>
        <a href="{{ route('pelanggan.reservasi', ['status' => 'pending']) }}"
           class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $status === 'pending' ? 'bg-yellow-500 text-white shadow' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300' }}">
            Pending <span class="ml-1 opacity-75">({{ $counts['pending'] }})</span>
        </a>
        <a href="{{ route('pelanggan.reservasi', ['status' => 'approved']) }}"
           class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $status === 'approved' ? 'bg-green-600 text-white shadow' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300' }}">
            Approved <span class="ml-1 opacity-75">({{ $counts['approved'] }})</span>
        </a>
        <a href="{{ route('pelanggan.reservasi', ['status' => 'completed']) }}"
           class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $status === 'completed' ? 'bg-blue-600 text-white shadow' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300' }}">
            Selesai <span class="ml-1 opacity-75">({{ $counts['completed'] }})</span>
        </a>
        <a href="{{ route('pelanggan.reservasi', ['status' => 'cancelled']) }}"
           class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $status === 'cancelled' ? 'bg-gray-600 text-white shadow' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300' }}">
            Dibatalkan <span class="ml-1 opacity-75">({{ $counts['cancelled'] }})</span>
        </a>
    </div>

    <!-- Reservasi Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-left text-gray-600">
                        <th class="px-6 py-3 font-semibold">No</th>
                        <th class="px-6 py-3 font-semibold">Meja</th>
                        <th class="px-6 py-3 font-semibold">Tanggal</th>
                        <th class="px-6 py-3 font-semibold">Jam</th>
                        <th class="px-6 py-3 font-semibold">Jumlah</th>
                        <th class="px-6 py-3 font-semibold">Status</th>
                        <th class="px-6 py-3 font-semibold">Pembayaran</th>
                        <th class="px-6 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservasi as $i => $res)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-500">{{ $reservasi->firstItem() + $i }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900">Meja {{ $res->meja?->nomor_meja ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ \Carbon\Carbon::parse($res->tanggal_reservasi)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $res->jam_reservasi }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $res->jumlah_orang }} orang</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'completed' => 'bg-blue-100 text-blue-800',
                                        'cancelled' => 'bg-gray-100 text-gray-800',
                                    ];
                                    $statusLabels = [
                                        'pending' => 'Pending',
                                        'approved' => 'Approved',
                                        'rejected' => 'Ditolak',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                    ];
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$res->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusLabels[$res->status] ?? ucfirst($res->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                @php
                                    $paymentLabels = [
                                        'transfer_bank' => 'Transfer Bank',
                                        'card' => 'Kartu',
                                        'ewallet' => 'E-Wallet',
                                    ];
                                @endphp
                                {{ $paymentLabels[$res->payment_method] ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('reservasi.invoice', $res->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg text-xs font-semibold transition" title="Lihat Invoice">
                                        Invoice
                                    </a>
                                    @if(in_array($res->status, ['pending', 'approved']) && $res->tanggal_reservasi >= now()->toDateString())
                                        <form method="POST" action="{{ route('pelanggan.reservasi.cancel', $res->id) }}" onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 rounded-lg text-xs font-semibold transition">
                                                Batalkan
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center text-gray-500">
                                <div class="text-gray-300 mb-4">
                                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                                </div>
                                <p class="font-semibold text-lg mb-1">Tidak ada reservasi ditemukan</p>
                                <p class="text-sm mb-4">
                                    @if($status)
                                        Tidak ada reservasi dengan status "{{ ucfirst($status) }}"
                                    @else
                                        Anda belum memiliki reservasi
                                    @endif
                                </p>
                                <a href="{{ route('reservasi.step1') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg> Buat Reservasi Baru
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($reservasi->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $reservasi->links() }}
            </div>
        @endif
    </div>
@endsection
