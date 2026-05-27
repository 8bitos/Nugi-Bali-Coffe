<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri - Nugi Bali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-gray-50 to-white font-poppins">
@include('layouts.partials.navbar')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
    <h1 class="text-4xl sm:text-5xl font-bold text-slate-800 mb-12 text-center">GALERI</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($galeri as $item)
            <div class="overflow-hidden rounded-xl bg-white shadow hover:shadow-xl transition-all duration-300">
                <div class="h-48 bg-blue-100">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" class="h-full w-full object-cover" alt="{{ $item->judul }}">
                    @else
                        <div class="h-full flex items-center justify-center text-gray-500">Foto belum diatur</div>
                    @endif
                </div>
                <div class="p-4">
                    <p class="font-semibold text-slate-800">{{ $item->judul ?: 'Tanpa Judul' }}</p>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500 py-12">Galeri tidak tersedia</p>
        @endforelse
    </div>
    <div class="text-center mt-12">
        @if($info && $info->instagram_url)
            <a href="{{ $info->instagram_url }}" target="_blank" class="inline-block bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-8 py-3 rounded-lg font-bold hover:shadow-lg transition">KUNJUNGI INSTAGRAM</a>
        @endif
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
                @if($info?->instagram_url)
                    <a href="{{ $info->instagram_url }}" target="_blank" class="hover:text-cyan-300 transition">Instagram →</a>
                @endif
            </div>
        </div>
        <div class="border-t border-blue-800 mt-8 pt-8 text-center text-blue-200 text-sm">
            <p>&copy; 2026 NUGI BALI. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>
</body>
</html>
