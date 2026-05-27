<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang - Nugi Bali</title>
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
    @include('layouts.partials.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 w-full flex-1">
        <!-- Title Header -->
        <div class="text-center mb-10">
            <span class="text-[10px] font-bold text-blue-800 uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-lg">Cerita Kami</span>
            <h1 class="text-3xl sm:text-5xl font-playfair font-bold text-blue-900 tracking-wide mt-3 mb-2">TENTANG KAMI</h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium">Mengenal lebih dekat NUGI BALI.</p>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-14 items-center">
            <!-- Image -->
            <div class="order-2 lg:order-1">
                <div class="rounded-3xl overflow-hidden border border-slate-200/60 shadow-md bg-white p-2">
                    <div class="h-64 sm:h-80 lg:h-96 rounded-2xl overflow-hidden bg-blue-50 flex items-center justify-center">
                        @if(!empty($info?->tentang_image))
                            <img src="{{ asset('storage/' . $info->tentang_image) }}" class="h-full w-full object-cover" alt="Tentang Kami">
                        @else
                            <div class="flex flex-col items-center text-slate-300">
                                <svg class="w-12 h-12 mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
                                </svg>
                                <span class="text-xs font-medium">Gambar Tentang Belum Diatur</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Text Content -->
            <div class="order-1 lg:order-2">
                <h2 class="font-playfair text-2xl sm:text-3xl font-bold text-blue-900 mb-4">{{ $info->nama_web ?? 'Nugi Bali' }}</h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-8">{{ $info->profil ?? 'Profil belum diatur.' }}</p>

                <!-- Contact Info Card -->
                <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/60 shadow-sm space-y-4">
                    <h3 class="font-playfair text-lg font-bold text-blue-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        Informasi
                    </h3>

                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Alamat</p>
                            <p class="text-xs text-slate-700 font-semibold">{{ $info->alamat ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0l-7.5-4.615m19.5 0A2.25 2.25 0 0 0 19.5 4.5" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Email</p>
                            <p class="text-xs text-slate-700 font-semibold"><a href="mailto:{{ $info->kontak_email }}" class="text-blue-600 hover:underline">{{ $info->kontak_email ?? '-' }}</a></p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.387a12.035 12.035 0 0 1-7.108-7.108c-.145-.44.02-.927.396-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Telepon</p>
                            <p class="text-xs text-slate-700 font-semibold"><a href="tel:{{ $info->kontak_telepon }}" class="text-blue-600 hover:underline">{{ $info->kontak_telepon ?? '-' }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @php
        $footerInfo = \App\Models\InformasiWeb::first();
    @endphp
    <footer class="bg-gradient-to-r from-blue-900 to-cyan-900 text-white mt-16 shrink-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-base font-bold mb-3 uppercase tracking-wider text-white">NUGI BALI</h3>
                    <p class="text-blue-100/80 text-xs leading-relaxed">{{ $footerInfo?->profil ?? 'Coffee shop terbaik dengan pelayanan prima.' }}</p>
                </div>
                <div>
                    <h3 class="text-base font-bold mb-3 uppercase tracking-wider text-white">Menu</h3>
                    <ul class="space-y-2 text-blue-100/80 text-xs">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('menu') }}" class="hover:text-white transition">Menu</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-base font-bold mb-3 uppercase tracking-wider text-white">Kontak</h3>
                    <ul class="space-y-2 text-blue-100/80 text-xs">
                        <li class="flex items-center gap-2">📧 {{ $footerInfo?->kontak_email ?? 'info@nugibali.com' }}</li>
                        <li class="flex items-center gap-2">📞 {{ $footerInfo?->kontak_telepon ?? '+62 812-3456-7890' }}</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-base font-bold mb-3 uppercase tracking-wider text-white">Slogan</h3>
                    <p class="text-blue-100/80 text-xs italic">Space . Moment . Togetherness</p>
                </div>
            </div>
            <div class="border-t border-blue-800/60 mt-8 pt-6 text-center text-blue-200/60 text-xs">
                <p>&copy; 2026 NUGI BALI. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>
