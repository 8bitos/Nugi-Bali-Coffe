@extends('admin.layout')

@section('title', 'Manajemen Galeri')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Galeri</h1>
            <p class="text-gray-600 mt-1">Kelola foto galeri restoran</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold py-2 px-6 rounded-lg hover:shadow-lg transition">
            + Tambah Foto
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($galeri as $item)
            <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                <div class="aspect-square overflow-hidden bg-gray-200">
                    @if($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-3">{{ $item->judul }}</h3>
                    <div class="flex gap-2 justify-center">
                        <a href="{{ route('admin.galeri.edit', $item->id) }}" class="flex-1 text-center text-blue-600 hover:text-blue-700 font-semibold text-sm py-2 bg-blue-50 rounded transition">Edit</a>
                        <form method="POST" action="{{ route('admin.galeri.destroy', $item->id) }}" class="flex-1" onsubmit="return confirm('Hapus foto ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-red-600 hover:text-red-700 font-semibold text-sm py-2 bg-red-50 rounded transition">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-600">Belum ada data galeri</p>
            </div>
        @endforelse
    </div>
@endsection
