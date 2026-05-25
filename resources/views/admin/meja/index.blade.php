@extends('admin.layout')

@section('title', 'Manajemen Meja')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Meja</h1>
            <p class="text-gray-600 mt-1">Kelola data meja di restoran</p>
        </div>
        <a href="{{ route('admin.meja.create') }}" class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold py-2 px-6 rounded-lg hover:shadow-lg transition">
            + Tambah Meja
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Nomor Meja</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Kapasitas</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($meja as $m)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $m->nomor_meja }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $m->kapasitas }} orang</td>
                            <td class="px-6 py-4 text-gray-700">
                                @if($m->harga)
                                    Rp {{ number_format($m->harga, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $m->status === 'tersedia' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $m->status === 'terisi' ? 'bg-orange-100 text-orange-800' : '' }}
                                    {{ $m->status === 'maintenance' ? 'bg-red-100 text-red-800' : '' }}
                                ">
                                    {{ ucfirst($m->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('admin.meja.edit', $m->id) }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.meja.destroy', $m->id) }}" class="inline" onsubmit="return confirm('Hapus meja ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 font-semibold text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-600">Belum ada data meja</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
