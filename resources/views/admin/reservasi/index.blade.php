@extends('admin.layout')

@section('title', 'Manajemen Reservasi')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Reservasi</h1>
        <p class="text-gray-600 mt-1">Kelola dan konfirmasi reservasi pelanggan</p>
    </div>

    <div class="mb-6 flex gap-2 flex-wrap">
        <a href="{{ route('admin.reservasi.index') }}" class="px-4 py-2 {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-lg">Semua</a>
        <a href="{{ route('admin.reservasi.index', ['status' => 'pending']) }}" class="px-4 py-2 {{ request('status') === 'pending' ? 'bg-yellow-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-lg">Pending</a>
        <a href="{{ route('admin.reservasi.index', ['status' => 'approved']) }}" class="px-4 py-2 {{ request('status') === 'approved' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-lg">Disetujui</a>
        <a href="{{ route('admin.reservasi.index', ['status' => 'rejected']) }}" class="px-4 py-2 {{ request('status') === 'rejected' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-700' }} rounded-lg">Ditolak</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Nama Pemesan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Kontak</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Tanggal & Jam</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Meja</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($reservasi as $res)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $res->nama_pemesan }}</td>
                            <td class="px-6 py-4 text-gray-700 text-sm">{{ $res->kontak_pemesan }}</td>
                            <td class="px-6 py-4 text-gray-700 text-sm">{{ $res->tanggal_reservasi }}<br>{{ $res->jam_reservasi }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $res->meja?->nomor_meja }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $res->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $res->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $res->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $res->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                ">
                                    {{ ucfirst($res->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('admin.reservasi.show', $res->id) }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">Detail</a>
                                @if($res->status === 'pending')
                                    <form method="POST" action="{{ route('admin.reservasi.approve', $res->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-700 font-semibold text-sm">Setuju</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.reservasi.reject', $res->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-700 font-semibold text-sm">Tolak</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-600">Belum ada reservasi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
