<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lokasi - Nugi Bali</title>
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
            <span class="text-[10px] font-bold text-blue-800 uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-lg">Kunjungi Kami</span>
            <h1 class="text-3xl sm:text-5xl font-playfair font-bold text-blue-900 tracking-wide mt-3 mb-2">LOKASI KAMI</h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium">Temukan ruang nyaman Anda untuk bersantai dan bercengkerama.</p>
        </div>

        <!-- Map Container (Embedded Google Maps with coordinates) -->
        <div class="bg-white rounded-3xl p-3 border border-slate-200/60 shadow-md mb-8 overflow-hidden">
            <div class="rounded-2xl overflow-hidden aspect-[16/9] w-full min-h-[300px] sm:min-h-[400px] lg:min-h-[480px] bg-slate-50 relative">
                <!-- Free Google Maps Embed using exact coordinates -->
                <iframe 
                    src="https://maps.google.com/maps?q=-8.4663646,115.350125&z=17&ie=UTF8&output=embed" 
                    class="absolute inset-0 w-full h-full border-0" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        @if($info)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                <!-- Contact Details -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/60 shadow-sm flex flex-col justify-between">
                    <div>
                        <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-slate-100 pb-3 mb-6 tracking-wide flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            Informasi Kontak
                        </h2>
                        
                        <div class="space-y-5">
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0 mt-0.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Alamat</p>
                                    <p class="text-xs text-slate-700 leading-relaxed font-semibold">{{ $info->alamat ?? 'Alamat belum diatur.' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0 mt-0.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0l-7.5-4.615m19.5 0A2.25 2.25 0 0 0 19.5 4.5" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Email</p>
                                    <p class="text-xs text-slate-700 font-semibold truncate"><a href="mailto:{{ $info->kontak_email }}" class="text-blue-600 hover:underline">{{ $info->kontak_email ?? '-' }}</a></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0 mt-0.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.387a12.035 12.035 0 0 1-7.108-7.108c-.145-.44.02-.927.396-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Telepon</p>
                                    <p class="text-xs text-slate-700 font-semibold"><a href="tel:{{ $info->kontak_telepon }}" class="text-blue-600 hover:underline">{{ $info->kontak_telepon ?? '-' }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-slate-100 w-full">
                        <a href="https://www.google.com/maps/place/NUGI+BALI/@-8.4663646,115.350125,17z/data=!3m1!4b1!4m6!3m5!1s0x2dd2190044e1c829:0x3e458d94f204718b!8m2!3d-8.4663646!4d115.350125!16s%2Fg%2F11y5mclyn7?entry=tts&g_ep=EgoyMDI2MDQxMy4wIPu8ASoASAFQAw%3D%3D&skid=24040f6c-835e-408e-a4b0-24b1951689ee" 
                           target="_blank" 
                           class="inline-flex items-center justify-center gap-2 bg-blue-900 hover:bg-blue-950 text-white px-5 py-3 rounded-xl font-bold transition text-xs text-center w-full shadow-sm hover:shadow">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"></path>
                            </svg>
                            Buka di Google Maps
                        </a>
                    </div>
                </div>
                
                <!-- Operational Hours -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/60 shadow-sm flex flex-col justify-between">
                    <div>
                        <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-slate-100 pb-3 mb-6 tracking-wide flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Jam Operasional
                        </h2>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2.5 border-b border-slate-100">
                                <span class="font-bold text-xs text-slate-700">Senin - Jumat</span>
                                <span class="text-xs text-slate-500 font-semibold">09:00 - 21:00 WITA</span>
                            </div>
                            <div class="flex justify-between items-center py-2.5 border-b border-slate-100">
                                <span class="font-bold text-xs text-slate-700">Sabtu</span>
                                <span class="text-xs text-slate-500 font-semibold">08:00 - 22:00 WITA</span>
                            </div>
                            <div class="flex justify-between items-center py-2.5">
                                <span class="font-bold text-xs text-slate-700">Minggu</span>
                                <span class="text-xs text-slate-500 font-semibold">08:00 - 21:00 WITA</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-slate-100 w-full">
                        <a href="{{ route('reservasi.step1') }}" 
                           class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-5 py-3 rounded-xl font-bold transition text-xs text-center w-full shadow-sm hover:shadow hover:shadow-blue-500/10">
                            Reservasi Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @include('layouts.partials.footer')
</body>
</html>
