<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nugi Bali - Reservasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-gray-50 to-white font-poppins">
    <!-- Navigation -->
    @include('layouts.partials.navbar')

    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">
            <div class="flex-1 text-center lg:text-left">
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold mb-6 leading-tight">
                    @php
                        $landingTitle = $info?->landing_title ?: 'NUGI BALI';
                        $parts = explode(' ', trim($landingTitle), 2);
                    @endphp
                    <span class="bg-gradient-to-r from-gray-900 via-blue-700 to-cyan-600 bg-clip-text text-transparent">{{ $parts[0] ?? 'NUGI' }}</span><br>
                    <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">{{ $parts[1] ?? 'BALI' }}</span>
                </h1>
                <p class="text-gray-600 text-base sm:text-lg mb-8 leading-relaxed max-w-md mx-auto lg:mx-0">{{ $info?->landing_subtitle ?: 'Nikmati pengalaman kuliner terbaik dengan suasana nyaman, dekorasi elegan, dan pelayanan prima.' }}</p>
                <a href="{{ $info?->landing_cta_url ?: route('reservasi.step1') }}" class="inline-block bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-bold text-sm sm:text-base hover:shadow-lg transition">{{ $info?->landing_cta_text ?: 'RESERVASI SEKARANG' }}</a>
            </div>
            
            <div class="flex-1">
                <div class="bg-gradient-to-br from-gray-200 via-blue-100 to-cyan-100 h-64 sm:h-80 lg:h-96 rounded-2xl relative shadow-2xl overflow-hidden">
                    @php
                        $landingSlides = $info?->landing_slides;
                        $slides = is_array($landingSlides) && count($landingSlides) ? $landingSlides : [];
                        if (empty($slides) && !empty($info?->hero_image)) {
                            $slides = [$info->hero_image];
                        }
                    @endphp
                    @if(count($slides))
                        @foreach($slides as $idx => $slide)
                            <img src="{{ asset('storage/' . $slide) }}" alt="Slide {{ $idx + 1 }}" class="hero-slide h-full w-full object-cover {{ $idx === 0 ? '' : 'hidden' }}">
                        @endforeach
                        @if(count($slides) > 1)
                            <button type="button" id="slidePrev" class="absolute left-2 sm:left-3 top-1/2 -translate-y-1/2 rounded-full bg-black/35 hover:bg-black/50 px-2 sm:px-3 py-1 text-xl sm:text-2xl text-white transition">‹</button>
                            <button type="button" id="slideNext" class="absolute right-2 sm:right-3 top-1/2 -translate-y-1/2 rounded-full bg-black/35 hover:bg-black/50 px-2 sm:px-3 py-1 text-xl sm:text-2xl text-white transition">›</button>
                        @endif
                    @else
                        <div class="flex h-full items-center justify-center text-xl sm:text-2xl font-semibold text-gray-500">Interior Coffee Shop</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-900 to-cyan-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-lg font-bold mb-4">{{ $info?->nama_web ?: 'NUGI BALI' }}</h3>
                    <p class="text-blue-100 text-sm">{{ substr($info?->profil ?? 'Coffee shop terbaik dengan pelayanan prima', 0, 100) }}...</p>
                </div>

                <!-- Menu Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Menu</h3>
                    <ul class="space-y-2 text-blue-100 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('menu') }}" class="hover:text-white transition">Menu</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri</a></li>
                        <li><a href="{{ route('tentang') }}" class="hover:text-white transition">Tentang</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-blue-100 text-sm">
                        <li>📧 {{ $info?->kontak_email ?: 'info@nugibali.com' }}</li>
                        <li>📞 {{ $info?->kontak_telepon ?: '+62 812-3456-7890' }}</li>
                        <li>📍 {{ substr($info?->alamat ?? 'Bali', 0, 40) }}</li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        @if($info?->instagram_url)
                            <a href="{{ $info->instagram_url }}" target="_blank" class="hover:text-cyan-300 transition" title="Instagram">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="border-t border-blue-800 mt-8 pt-8 text-center text-blue-200 text-sm">
                <p>&copy; 2026 {{ $info?->nama_web ?: 'NUGI BALI' }}. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Hero slider
        (() => {
            const slides = Array.from(document.querySelectorAll('.hero-slide'));
            if (slides.length <= 1) return;
            let current = 0;
            const show = (i) => {
                slides[current].classList.add('hidden');
                current = (i + slides.length) % slides.length;
                slides[current].classList.remove('hidden');
            };
            document.getElementById('slidePrev')?.addEventListener('click', () => show(current - 1));
            document.getElementById('slideNext')?.addEventListener('click', () => show(current + 1));
            setInterval(() => show(current + 1), 5000);
        })();
    </script>
</body>
</html>
