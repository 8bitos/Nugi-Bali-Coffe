<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nugi Bali - Reservasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .font-playfair {
            font-family: 'Playfair Display', Georgia, serif;
        }
        .font-jakarta {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#FAF9F6] font-jakarta text-slate-800 min-h-screen flex flex-col justify-between">
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

    @include('layouts.partials.footer')

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
