<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri - Nugi Bali</title>
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
            <span class="text-[10px] font-bold text-blue-800 uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-lg">Dokumentasi</span>
            <h1 class="text-3xl sm:text-5xl font-playfair font-bold text-blue-900 tracking-wide mt-3 mb-2">GALERI KAMI</h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium">Momen indah yang terekam di Nugi Bali.</p>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @forelse($galeri as $item)
                <div class="group overflow-hidden rounded-2xl bg-white border border-slate-200/60 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="aspect-square bg-blue-50 overflow-hidden">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $item->judul }}">
                        @else
                            <div class="h-full flex items-center justify-center text-slate-400 text-xs font-medium">
                                <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <p class="font-bold text-sm text-slate-800 truncate">{{ $item->judul ?: 'Tanpa Judul' }}</p>
                        @if($item->deskripsi)
                            <p class="text-[11px] text-slate-400 mt-1 line-clamp-2">{{ $item->deskripsi }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-20 text-slate-400">
                    <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
                    </svg>
                    <p class="font-semibold text-sm">Galeri belum tersedia</p>
                    <p class="text-xs mt-1">Foto-foto akan segera ditambahkan.</p>
                </div>
            @endforelse
        </div>

        <!-- Instagram CTA -->
        @if($info && $info->instagram_url)
            <div class="text-center mt-12">
                <a href="{{ $info->instagram_url }}" target="_blank" class="inline-flex items-center gap-2 bg-blue-900 hover:bg-blue-950 text-white px-6 py-3 rounded-xl font-bold transition text-xs shadow-sm hover:shadow">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    Kunjungi Instagram
                </a>
            </div>
        @endif
    </div>

    @include('layouts.partials.footer')
</body>
</html>
