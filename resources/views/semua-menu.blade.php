<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Semua Menu - Nugi Bali</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');
            body { font-family: 'Poppins', sans-serif; }
        </style>
    </head>
    <body class="bg-gradient-to-b from-gray-50 to-white">
        {{-- Navigation --}}
        @include('layouts.partials.navbar')

        {{-- Semua Menu Section --}}
        <div class="max-w-7xl mx-auto px-8 py-20">
            <h1 class="text-5xl font-bold bg-gradient-to-r from-gray-900 to-blue-600 bg-clip-text text-transparent mb-12 text-center">Semua Menu</h1>

            {{-- Filter Buttons --}}
            <div class="flex justify-center gap-4 mb-12 flex-wrap">
                <a href="{{ route('semua-menu', ['kategori' => 'semua']) }}" 
                   class="px-6 py-2 rounded-lg font-bold transition-all duration-200 {{ $kategori === 'semua' ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg' : 'bg-gray-200 text-gray-900 hover:bg-blue-100' }}">
                    SEMUA
                </a>
                <a href="{{ route('semua-menu', ['kategori' => 'Makanan']) }}" 
                   class="px-6 py-2 rounded-lg font-bold transition-all duration-200 {{ $kategori === 'Makanan' ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg' : 'bg-gray-200 text-gray-900 hover:bg-blue-100' }}">
                    MAKANAN
                </a>
                <a href="{{ route('semua-menu', ['kategori' => 'Minuman']) }}" 
                   class="px-6 py-2 rounded-lg font-bold transition-all duration-200 {{ $kategori === 'Minuman' ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg' : 'bg-gray-200 text-gray-900 hover:bg-blue-100' }}">
                    MINUMAN
                </a>
            </div>

            {{-- Menu Grid (4 columns for more items display) --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @forelse($menus as $menu)
                    <div class="bg-white rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="bg-gradient-to-br from-blue-100 to-cyan-100 h-40 flex items-center justify-center text-gray-500">
                            <div class="text-center">
                                <div class="text-4xl mb-2">🍽️</div>
                                <p class="text-sm font-semibold text-gray-600">{{ $menu->kategori }}</p>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-base font-bold text-gray-900 mb-2">{{ $menu->nama_menu }}</h3>
                            <p class="text-blue-600 font-bold">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-12">
                        <p class="text-gray-500 text-lg">Menu tidak tersedia</p>
                    </div>
                @endforelse
            </div>
        </div>
    </body>
</html>
