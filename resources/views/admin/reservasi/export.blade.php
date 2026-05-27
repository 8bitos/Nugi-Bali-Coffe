@extends('admin.layout')

@section('title', 'Export Reservasi')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Export Laporan Reservasi</h1>
        <p class="text-gray-600 mt-1">Filter dan download data reservasi dalam format PDF atau Excel</p>
    </div>

    <!-- Filter Form -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Filter Data</h2>
        <form method="GET" action="{{ route('admin.reservasi.export') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Dari Tanggal</label>
                <input type="date" name="dari_tanggal" value="{{ $dariTanggal }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Sampai Tanggal</label>
                <input type="date" name="sampai_tanggal" value="{{ $sampaiTanggal }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition text-sm">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Download Buttons -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <a href="{{ route('admin.reservasi.export.download', ['format' => 'pdf', 'status' => $status, 'dari_tanggal' => $dariTanggal, 'sampai_tanggal' => $sampaiTanggal]) }}"
           class="flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl hover:from-red-700 hover:to-red-800 transition shadow-sm">
            <span class="text-2xl"></span>
            <div class="text-left">
                <p class="text-base font-bold">Download PDF</p>
                <p class="text-xs opacity-80">Laporan dalam format PDF</p>
            </div>
        </a>
        <a href="{{ route('admin.reservasi.export.download', ['format' => 'excel', 'status' => $status, 'dari_tanggal' => $dariTanggal, 'sampai_tanggal' => $sampaiTanggal]) }}"
           class="flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-xl hover:from-green-700 hover:to-green-800 transition shadow-sm">
            <span class="text-2xl"></span>
            <div class="text-left">
                <p class="text-base font-bold">Download Excel</p>
                <p class="text-xs opacity-80">Laporan dalam format XLSX</p>
            </div>
        </a>
    </div>

    <!-- Preview Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-4 text-white flex justify-between items-center">
            <h2 class="text-lg font-bold">Preview Data ({{ $reservasi->count() }} data)</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-left text-gray-600">
                        <th class="px-4 py-3 font-semibold">No</th>
                        <th class="px-4 py-3 font-semibold">Nama</th>
                        <th class="px-4 py-3 font-semibold">Meja</th>
                        <th class="px-4 py-3 font-semibold">Tanggal</th>
                        <th class="px-4 py-3 font-semibold">Jam</th>
                        <th class="px-4 py-3 font-semibold">Jumlah</th>
                        <th class="px-4 py-3 font-semibold">Status</th>
                        <th class="px-4 py-3 font-semibold">Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservasi as $i => $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-gray-500">{{ $i + 1 }}</td>
                            <td class="px-4 py-3 font-semibold text-gray-900">{{ $item->nama_pemesan }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $item->meja?->nomor_meja ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $item->tanggal_reservasi }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $item->jam_reservasi }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $item->jumlah_orang }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'completed' => 'bg-blue-100 text-blue-800',
                                        'cancelled' => 'bg-gray-100 text-gray-800',
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-700">
                                @php
                                    $paymentLabels = ['transfer_bank' => 'Transfer Bank', 'card' => 'Kartu', 'ewallet' => 'E-Wallet'];
                                @endphp
                                {{ $paymentLabels[$item->payment_method] ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-12 text-center text-gray-500">
                                <div class="text-4xl mb-3"></div>
                                <p class="font-semibold">Tidak ada data reservasi</p>
                                <p class="text-sm mt-1">Coba ubah filter untuk menampilkan data</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reservasi->count() > 0)
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-sm text-gray-600">
                Total: <strong>{{ $reservasi->count() }}</strong> data reservasi
                @if($status) | Status: <strong>{{ ucfirst($status) }}</strong> @endif
                @if($dariTanggal) | Dari: <strong>{{ $dariTanggal }}</strong> @endif
                @if($sampaiTanggal) | Sampai: <strong>{{ $sampaiTanggal }}</strong> @endif
            </div>
        @endif
    </div>
@endsection
