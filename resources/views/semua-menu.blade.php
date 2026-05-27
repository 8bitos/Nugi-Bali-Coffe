<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Semua Menu - Nugi Bali</title>
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
        {{-- Navigation --}}
        @include('layouts.partials.navbar')

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 w-full flex-1">
            <!-- Title Header -->
            <div class="text-center mb-10">
                <span class="text-[10px] font-bold text-blue-800 uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-lg">Catalog</span>
                <h1 class="text-3xl sm:text-5xl font-playfair font-bold text-blue-900 tracking-wide mt-3 mb-2">SEMUA MENU</h1>
                <p class="text-xs sm:text-sm text-slate-500 font-medium">Space . Moment . Togetherness</p>
            </div>

            {{-- Filter Buttons --}}
            <div class="flex justify-center gap-3 mb-10 flex-wrap">
                <a href="{{ route('semua-menu', ['kategori' => 'semua']) }}" 
                   class="px-5 py-2 rounded-xl font-bold transition-all duration-200 text-xs {{ $kategori === 'semua' ? 'bg-blue-900 text-white shadow-sm' : 'bg-white text-slate-700 border border-slate-200/60 hover:bg-blue-50' }}">
                    SEMUA
                </a>
                <a href="{{ route('semua-menu', ['kategori' => 'Makanan']) }}" 
                   class="px-5 py-2 rounded-xl font-bold transition-all duration-200 text-xs {{ $kategori === 'Makanan' ? 'bg-blue-900 text-white shadow-sm' : 'bg-white text-slate-700 border border-slate-200/60 hover:bg-blue-50' }}">
                    MAKANAN
                </a>
                <a href="{{ route('semua-menu', ['kategori' => 'Minuman']) }}" 
                   class="px-5 py-2 rounded-xl font-bold transition-all duration-200 text-xs {{ $kategori === 'Minuman' ? 'bg-blue-900 text-white shadow-sm' : 'bg-white text-slate-700 border border-slate-200/60 hover:bg-blue-50' }}">
                    MINUMAN
                </a>
            </div>

            {{-- Menu Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @forelse($menus as $menu)
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/60 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 h-36 flex items-center justify-center text-slate-400">
                            <div class="text-center">
                                <div class="text-3xl mb-1">🍽️</div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $menu->kategori }}</p>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-bold text-slate-800 mb-1 truncate">{{ $menu->nama_menu }}</h3>
                            <p class="text-blue-600 font-bold text-sm">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-20 text-slate-400">
                        <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        <p class="font-semibold text-sm">Menu tidak tersedia</p>
                    </div>
                @endforelse
            </div>
        </div>

        @include('layouts.partials.footer')
    </body>
</html>
