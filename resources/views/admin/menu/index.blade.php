@extends('admin.layout')

@section('title', 'Manajemen Menu')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Menu</h1>
            <p class="text-gray-600 mt-1">Kelola menu makanan & minuman</p>
        </div>
        <a href="{{ route('admin.menu.create') }}" class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold py-2 px-6 rounded-lg hover:shadow-lg transition">
            + Tambah Menu
        </a>
    </div>

    <div class="mb-6 flex gap-4 flex-wrap">
        <form method="GET" action="{{ route('admin.menu.index') }}" class="flex gap-2">
            <input type="text" name="search" placeholder="Cari menu..." value="{{ request('search') }}" class="px-4 py-2 border border-gray-300 rounded-lg">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Cari</button>
        </form>
        <button onclick="document.getElementById('filterForm').style.display = document.getElementById('filterForm').style.display === 'none' ? 'block' : 'none'" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Filter Kategori</button>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Nama Menu</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Deskripsi</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($menus as $menu)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $menu->nama_menu }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $menu->kategori }}</td>
                            <td class="px-6 py-4 text-gray-700">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-gray-700 text-sm truncate">{{ $menu->deskripsi }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('admin.menu.edit', $menu->id) }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.menu.destroy', $menu->id) }}" class="inline" onsubmit="return confirm('Hapus menu ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 font-semibold text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-600">Belum ada data menu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
