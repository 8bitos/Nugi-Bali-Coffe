<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang - Nugi Bali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-gray-50 to-white font-poppins">
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{ !empty($info?->logo) ? asset('storage/' . $info->logo) : asset('assets/images/logo.png') }}" alt="Logo" class="h-10 sm:h-12 object-contain">
                <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-bold text-blue-700">NUGI BALI</a>
            </div>
            <div class="hidden md:flex items-center space-x-6 lg:space-x-8 text-sm">
                <a href="{{ route('home') }}" class="text-slate-700 hover:text-blue-600 transition">Beranda</a>
                <a href="{{ route('tentang') }}" class="font-semibold text-blue-700">Tentang</a>
                <a href="{{ route('menu') }}" class="text-slate-700 hover:text-blue-600 transition">Menu</a>
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
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">
        <div class="order-2 lg:order-1">
            <div class="h-64 sm:h-80 lg:h-96 rounded-2xl overflow-hidden shadow-2xl bg-blue-100 flex items-center justify-center">
                @if(!empty($info?->tentang_image))
                    <img src="{{ asset('storage/' . $info->tentang_image) }}" class="h-full w-full object-cover" alt="Tentang Kami">
                @else
                    <span class="text-gray-500 text-sm">Gambar Tentang Belum Diatur</span>
                @endif
            </div>
        </div>
        
        <div class="order-1 lg:order-2">
            <h1 class="text-4xl sm:text-5xl font-bold text-slate-800 mb-6">Tentang Kami</h1>
            <p class="text-gray-700 text-base sm:text-lg leading-relaxed mb-8">{{ $info->profil ?? 'Profil belum diatur.' }}</p>
            
            <div class="space-y-4 mb-8 bg-gradient-to-br from-blue-50 to-cyan-50 p-6 rounded-xl border border-blue-100">
                <div>
                    <h3 class="font-bold text-gray-900 text-lg">{{ $info->nama_web ?? 'Nugi Bali' }}</h3>
                </div>
                <div>
                    <p class="text-gray-700 text-sm"><strong>📍 Alamat:</strong> {{ $info->alamat ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-700 text-sm"><strong>📧 Email:</strong> {{ $info->kontak_email ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-700 text-sm"><strong>📞 Telepon:</strong> {{ $info->kontak_telepon ?? '-' }}</p>
                </div>
            </div>
        </div>
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
                    <li><a href="{{ route('menu') }}" class="hover:text-white transition">Menu</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri</a></li>
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
                <h3 class="text-lg font-bold mb-4">Jam Operasional</h3>
                <p class="text-blue-100 text-sm">Senin - Minggu<br>09:00 - 21:00 WIB</p>
            </div>
        </div>
        <div class="border-t border-blue-800 mt-8 pt-8 text-center text-blue-200 text-sm">
            <p>&copy; 2026 NUGI BALI. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>
</body>
</html>
