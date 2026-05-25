<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu - Nugi Bali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-gray-50 to-white font-poppins">
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10 sm:h-12 object-contain">
                <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-bold text-blue-700">NUGI BALI</a>
            </div>
            <div class="hidden md:flex items-center space-x-6 lg:space-x-8 text-sm">
                <a href="{{ route('home') }}" class="text-slate-700 hover:text-blue-600 transition">Beranda</a>
                <a href="{{ route('tentang') }}" class="text-slate-700 hover:text-blue-600 transition">Tentang</a>
                <a href="{{ route('menu') }}" class="font-semibold text-blue-700">Menu</a>
                <a href="{{ route('galeri') }}" class="text-slate-700 hover:text-blue-600 transition">Galeri</a>
                <a href="{{ route('lokasi') }}" class="text-slate-700 hover:text-blue-600 transition">Lokasi</a>
                @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-slate-700 hover:text-blue-600 transition">Logout</button>
                </form>
                @endauth
            </div>
            <a href="{{ route('reservasi.step1') }}" class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-4 sm:px-6 py-2 rounded-lg font-bold text-sm hover:shadow-lg transition">RESERVASI</a>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
    <h1 class="text-4xl sm:text-5xl font-bold text-slate-800 mb-12 text-center">MENU</h1>
    
    <div class="flex flex-wrap justify-center gap-3 sm:gap-4 mb-12">
        <a href="{{ route('menu', ['kategori' => 'semua']) }}" class="px-4 sm:px-6 py-2 rounded-lg font-bold text-sm transition {{ $kategori === 'semua' ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">SEMUA</a>
        <a href="{{ route('menu', ['kategori' => 'Makanan']) }}" class="px-4 sm:px-6 py-2 rounded-lg font-bold text-sm transition {{ $kategori === 'Makanan' ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">MAKANAN</a>
        <a href="{{ route('menu', ['kategori' => 'Minuman']) }}" class="px-4 sm:px-6 py-2 rounded-lg font-bold text-sm transition {{ $kategori === 'Minuman' ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">MINUMAN</a>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($menus as $menu)
            <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-xl transition-all duration-300">
                <div class="h-44 bg-blue-50">
                    @if($menu->foto)
                        <img src="{{ asset('storage/' . $menu->foto) }}" class="h-full w-full object-cover" alt="{{ $menu->nama_menu }}">
                    @else
                        <div class="h-full flex items-center justify-center text-gray-500 text-sm">Foto belum diatur</div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-900">{{ $menu->nama_menu }}</h3>
                    <p class="text-xs text-gray-500 mb-2 px-2 py-1 bg-blue-50 rounded inline-block">{{ $menu->kategori }}</p>
                    @if($menu->deskripsi)<p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $menu->deskripsi }}</p>@endif
                    <p class="text-blue-600 font-bold text-lg">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500 py-12">Menu tidak tersedia</p>
        @endforelse
    </div>
</div>

<!-- Footer -->
<footer class="bg-gradient-to-r from-blue-900 to-cyan-900 text-white mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">NUGI BALI</h3>
                <p class="text-blue-100 text-sm">Coffee shop terbaik dengan pelayanan prima</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Menu</h3>
                <ul class="space-y-2 text-blue-100 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri</a></li>
                    <li><a href="{{ route('tentang') }}" class="hover:text-white transition">Tentang</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Kontak</h3>
                <ul class="space-y-2 text-blue-100 text-sm">
                    <li>📧 info@nugibali.com</li>
                    <li>📞 +62 812-3456-7890</li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Ikuti Kami</h3>
                <p class="text-blue-100 text-sm">Instagram & Media Sosial</p>
            </div>
        </div>
        <div class="border-t border-blue-800 mt-8 pt-8 text-center text-blue-200 text-sm">
            <p>&copy; 2026 NUGI BALI. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>
</body>
</html>
