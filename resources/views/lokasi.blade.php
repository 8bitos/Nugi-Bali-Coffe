<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lokasi - Nugi Bali</title>
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
                <a href="{{ route('menu') }}" class="text-slate-700 hover:text-blue-600 transition">Menu</a>
                <a href="{{ route('galeri') }}" class="text-slate-700 hover:text-blue-600 transition">Galeri</a>
                <a href="{{ route('lokasi') }}" class="font-semibold text-blue-700">Lokasi</a>
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
    <h1 class="text-4xl sm:text-5xl font-bold text-slate-800 mb-12 text-center">KUNJUNGI KAMI</h1>
    
    <div class="rounded-2xl overflow-hidden bg-blue-100 min-h-80 mb-8 shadow-xl">
        @if(!empty($info?->lokasi_image))
            <img src="{{ asset('storage/' . $info->lokasi_image) }}" class="h-full w-full object-cover" alt="Lokasi Nugi Bali">
        @elseif(!empty($info?->lokasi_url))
            <iframe src="{{ $info->lokasi_url }}" class="w-full h-80 sm:h-96 lg:h-[500px] border-0" loading="lazy"></iframe>
        @else
            <div class="h-80 flex items-center justify-center text-gray-600">Peta lokasi belum diatur</div>
        @endif
    </div>
    
    @if($info)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-6 sm:p-8 border border-blue-100 shadow-lg">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">{{ $info?->nama_web ?? 'Nugi Bali' }}</h2>
                
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <span class="text-2xl">📍</span>
                        <div>
                            <p class="font-bold text-gray-900">Alamat</p>
                            <p class="text-gray-700">{{ $info?->alamat ?? 'Alamat belum diatur.' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <span class="text-2xl">📧</span>
                        <div>
                            <p class="font-bold text-gray-900">Email</p>
                            <p class="text-gray-700"><a href="mailto:{{ $info?->kontak_email }}" class="text-blue-600 hover:underline">{{ $info?->kontak_email ?? '-' }}</a></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <span class="text-2xl">📞</span>
                        <div>
                            <p class="font-bold text-gray-900">Telepon</p>
                            <p class="text-gray-700"><a href="tel:{{ $info?->kontak_telepon }}" class="text-blue-600 hover:underline">{{ $info?->kontak_telepon ?? '-' }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-6 sm:p-8 border border-blue-100 shadow-lg">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">Jam Operasional</h2>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-blue-200">
                        <span class="font-semibold text-gray-700">Senin - Jumat</span>
                        <span class="text-gray-600">09:00 - 21:00 WIB</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-blue-200">
                        <span class="font-semibold text-gray-700">Sabtu</span>
                        <span class="text-gray-600">08:00 - 22:00 WIB</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="font-semibold text-gray-700">Minggu</span>
                        <span class="text-gray-600">08:00 - 21:00 WIB</span>
                    </div>
                </div>
                
                <a href="{{ route('reservasi.step1') }}" class="inline-block mt-6 bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-6 py-3 rounded-lg font-bold hover:shadow-lg transition w-full text-center">RESERVASI SEKARANG</a>
            </div>
        </div>
    @endif
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
