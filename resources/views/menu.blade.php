<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu - Nugi Bali</title>
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

    @php
        if (!function_exists('formatMenuPrice')) {
            function formatMenuPrice($item) {
                if ($item->kategori === 'Fizzy Breeze') {
                    return '20K / 50K';
                }
                $price = $item->harga;
                if ($price >= 1000) {
                    $formatted = $price / 1000;
                    return ($price % 1000 === 0 ? number_format($formatted, 0) : number_format($formatted, 1)) . 'K';
                }
                return $price;
            }
        }

        // Group menus by category
        $coffee = $menus->where('kategori', 'Coffee');
        $nonCoffee = $menus->where('kategori', 'Non Coffee');
        $signature = $menus->where('kategori', 'Signature');
        $milkshake = $menus->where('kategori', 'Milkshake');
        $tea = $menus->where('kategori', 'Tea');
        $fizzyBreeze = $menus->where('kategori', 'Fizzy Breeze');
        $smoothies = $menus->where('kategori', 'Smoothies');
        $additionalDrinks = $menus->where('kategori', 'Additional (Drinks)');

        $riceBowl = $menus->where('kategori', 'Rice Bowl');
        $munchies = $menus->where('kategori', 'Munchies');
        $burger = $menus->where('kategori', 'Nugi Burger');
        $hotdog = $menus->where('kategori', 'Hotdog');
        $salad = $menus->where('kategori', 'Salad');
        $toast = $menus->where('kategori', 'Toast');
        $additionalFood = $menus->where('kategori', 'Additional (Food)');
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 w-full flex-1">
        <!-- Title & Slogan Header -->
        <div class="text-center mb-10">
            <span class="text-[10px] font-bold text-blue-800 uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-lg">Catalog</span>
            <h1 class="text-3xl sm:text-5xl font-playfair font-bold text-blue-900 tracking-wide mt-3 mb-2">OUR MENU</h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium">Space . Moment . Togetherness</p>
        </div>
        
        <!-- Filter Tabs -->
        <div class="flex justify-center gap-3 mb-12">
            <a href="{{ route('menu', ['kategori' => 'semua']) }}" 
               class="px-5 py-2 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 {{ $kategori === 'semua' ? 'bg-blue-900 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                Semua
            </a>
            <a href="{{ route('menu', ['kategori' => 'Minuman']) }}" 
               class="px-5 py-2 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 {{ $kategori === 'Minuman' ? 'bg-blue-900 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                Minuman
            </a>
            <a href="{{ route('menu', ['kategori' => 'Makanan']) }}" 
               class="px-5 py-2 rounded-xl font-bold text-xs uppercase tracking-wider transition-all duration-200 {{ $kategori === 'Makanan' ? 'bg-blue-900 text-white shadow-md' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                Makanan
            </a>
        </div>

        <div class="space-y-16">
            <!-- SECTION 1: DRINKS (MINUMAN) -->
            @if(($kategori === 'semua' || $kategori === 'Minuman') && ($coffee->count() > 0 || $nonCoffee->count() > 0 || $signature->count() > 0))
                <div class="bg-white rounded-3xl border border-slate-200/60 p-6 sm:p-10 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50/40 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-cyan-50/30 rounded-full blur-2xl"></div>

                    <!-- Grid Layout for Drinks -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 relative z-10">
                        <!-- Left Column: Coffee, Non Coffee, Milkshake -->
                        <div class="space-y-8">
                            <!-- Coffee Category -->
                            @if($coffee->count() > 0)
                                <div>
                                    <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-slate-100 pb-2 mb-4 tracking-wide">Coffee</h2>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                                        @foreach($coffee as $item)
                                            <div class="flex flex-col">
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                                @if($item->deskripsi)
                                                    <span class="text-[10px] text-slate-400 mt-0.5 leading-normal">{{ $item->deskripsi }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Non Coffee Category -->
                            @if($nonCoffee->count() > 0)
                                <div>
                                    <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-slate-100 pb-2 mb-4 tracking-wide">Non Coffee</h2>
                                    <div class="space-y-4">
                                        @foreach($nonCoffee as $item)
                                            <div class="flex flex-col">
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                                @if($item->deskripsi)
                                                    <span class="text-[10px] text-slate-400 mt-0.5 leading-normal">{{ $item->deskripsi }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Milkshake Category -->
                            @if($milkshake->count() > 0)
                                <div>
                                    <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-slate-100 pb-2 mb-4 tracking-wide">Milkshake</h2>
                                    <div class="space-y-4">
                                        @foreach($milkshake as $item)
                                            <div class="flex flex-col">
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                                @if($item->deskripsi)
                                                    <span class="text-[10px] text-slate-400 mt-0.5 leading-normal">{{ $item->deskripsi }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Right Column: Signature, Tea, Fizzy Breeze, Smoothies, Additional -->
                        <div class="space-y-8">
                            <!-- Signature Category (solid blue card wrapper) -->
                            @if($signature->count() > 0)
                                <div class="border border-blue-900 rounded-2xl p-6 bg-[#EFF6FF]/20 shadow-sm relative overflow-hidden">
                                    <h2 class="font-playfair text-2xl font-bold text-blue-900 pb-2 mb-4 tracking-wide flex justify-between items-center border-b border-blue-900/10">
                                        <span>Signature</span>
                                    </h2>
                                    <div class="space-y-4">
                                        @foreach($signature as $item)
                                            <div class="flex flex-col">
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                                @if($item->deskripsi)
                                                    <span class="text-[10px] text-slate-500 mt-0.5 leading-normal">{{ $item->deskripsi }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Tea Category -->
                            @if($tea->count() > 0)
                                <div>
                                    <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-slate-100 pb-2 mb-4 tracking-wide font-medium">Tea</h2>
                                    <div class="space-y-4">
                                        @foreach($tea as $item)
                                            <div class="flex flex-col">
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                                @if($item->deskripsi)
                                                    <span class="text-[10px] text-slate-400 mt-0.5 leading-normal">{{ $item->deskripsi }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Fizzy Breeze Category -->
                            @if($fizzyBreeze->count() > 0)
                                <div>
                                    <div class="flex justify-between items-baseline border-b border-slate-100 pb-2 mb-4">
                                        <h2 class="font-playfair text-2xl font-bold text-blue-900 tracking-wide">Fizzy Breeze</h2>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Glass / bottle</span>
                                    </div>
                                    <div class="space-y-4">
                                        @foreach($fizzyBreeze as $item)
                                            <div class="flex flex-col">
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                                @if($item->deskripsi && $item->deskripsi !== 'Glass / Bottle (20K / 50K)')
                                                    <span class="text-[10px] text-slate-400 mt-0.5 leading-normal">{{ $item->deskripsi }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Smoothies Category -->
                            @if($smoothies->count() > 0)
                                <div>
                                    <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-slate-100 pb-2 mb-4 tracking-wide">Smoothies</h2>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                                        @foreach($smoothies as $item)
                                            <div class="flex flex-col">
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                                @if($item->deskripsi)
                                                    <span class="text-[10px] text-slate-500 mt-0.5 leading-normal">{{ $item->deskripsi }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Additional Drinks Category (dashed border wrapper) -->
                            @if($additionalDrinks->count() > 0)
                                <div class="border-2 border-dashed border-blue-900/30 rounded-2xl p-5 bg-slate-50/40">
                                    <h3 class="text-[10px] font-extrabold text-blue-900 uppercase tracking-widest mb-3 pb-1.5 border-b border-slate-200">Additional Options</h3>
                                    <div class="space-y-3.5">
                                        @foreach($additionalDrinks as $item)
                                            <div class="flex flex-col text-slate-700">
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[11px] uppercase tracking-wide">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[11px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                                @if($item->deskripsi)
                                                    <span class="text-[9px] text-slate-400 mt-0.5 leading-relaxed">{{ $item->deskripsi }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Section Slogan Footer -->
                    <div class="mt-12 flex items-center justify-center gap-3 text-[9px] font-bold text-blue-900/40 uppercase tracking-widest border-t border-slate-100 pt-6">
                        <span class="border border-blue-900/30 px-2.5 py-0.5 rounded-full text-blue-900/60 font-extrabold">Nugi</span>
                        <span>Space . Moment . Togetherness</span>
                    </div>
                </div>
            @endif

            <!-- SECTION 2: FOODS (MAKANAN) -->
            @if(($kategori === 'semua' || $kategori === 'Makanan') && ($riceBowl->count() > 0 || $munchies->count() > 0 || $burger->count() > 0 || $hotdog->count() > 0 || $salad->count() > 0 || $toast->count() > 0))
                <div class="bg-white rounded-3xl border border-slate-200/60 p-6 sm:p-10 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-32 h-32 bg-cyan-50/30 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 right-0 w-32 h-32 bg-blue-50/40 rounded-full blur-2xl"></div>

                    <!-- Grid Layout for Foods -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 relative z-10">
                        <!-- Left Column: Rice Bowl, Munchies -->
                        <div class="space-y-8">
                            <!-- Rice Bowl Category (dashed border card wrapper) -->
                            @if($riceBowl->count() > 0)
                                <div class="border-2 border-dashed border-blue-900/30 rounded-2xl p-6 bg-slate-50/20 shadow-sm">
                                    <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-blue-900/10 pb-2 mb-4 tracking-wide">Rice Bowl</h2>
                                    <div class="space-y-4">
                                        @foreach($riceBowl as $item)
                                            <div class="flex flex-col">
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                                @if($item->deskripsi)
                                                    <span class="text-[10px] text-slate-400 mt-0.5 leading-normal">{{ $item->deskripsi }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Munchies Category (solid card wrapper) -->
                            @if($munchies->count() > 0)
                                <div class="border border-slate-200 rounded-2xl p-6 bg-white shadow-sm">
                                    <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-slate-100 pb-2 mb-4 tracking-wide">Munchies</h2>
                                    <div class="space-y-4">
                                        @foreach($munchies as $item)
                                            <div class="flex flex-col">
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                                @if($item->deskripsi)
                                                    <span class="text-[10px] text-slate-400 mt-0.5 leading-normal">{{ $item->deskripsi }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Right Column: Burger, Hotdog, Salad, Toast, Additional -->
                        <div class="space-y-8">
                            <!-- Main Solid Box for Specialties (Nugi Burger, Hotdog, Salad, Toast) -->
                            <div class="border border-blue-900 rounded-2xl p-6 bg-white shadow-sm space-y-6">
                                
                                <!-- Burger Category -->
                                @if($burger->count() > 0)
                                    <div>
                                        <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-slate-100 pb-2 mb-3 tracking-wide">Nugi Burger</h2>
                                        <div class="space-y-3">
                                            @foreach($burger as $item)
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Hotdog Category -->
                                @if($hotdog->count() > 0)
                                    <div>
                                        <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-slate-100 pb-2 mb-3 tracking-wide">Hotdog</h2>
                                        <div class="space-y-3">
                                            @foreach($hotdog as $item)
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Salad Category -->
                                @if($salad->count() > 0)
                                    <div>
                                        <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-slate-100 pb-2 mb-3 tracking-wide">Salad</h2>
                                        <div class="space-y-3">
                                            @foreach($salad as $item)
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Toast Category -->
                                @if($toast->count() > 0)
                                    <div>
                                        <h2 class="font-playfair text-2xl font-bold text-blue-900 border-b border-slate-100 pb-2 mb-3 tracking-wide">Toast</h2>
                                        <div class="space-y-3">
                                            @foreach($toast as $item)
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[12px] text-blue-950 tracking-wider uppercase">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[12px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Additional Food Category (dashed border wrapper) -->
                            @if($additionalFood->count() > 0)
                                <div class="border-2 border-dashed border-blue-900/30 rounded-2xl p-5 bg-slate-50/40">
                                    <h3 class="text-[10px] font-extrabold text-blue-900 uppercase tracking-widest mb-3 pb-1.5 border-b border-slate-200">Additional Options</h3>
                                    <div class="space-y-3">
                                        @foreach($additionalFood as $item)
                                            <div class="flex justify-between items-baseline gap-2 text-slate-700">
                                                <span class="font-bold text-[11px] uppercase tracking-wide">{{ $item->nama_menu }}</span>
                                                <span class="font-bold text-[11px] text-blue-900 whitespace-nowrap">{{ formatMenuPrice($item) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Section Slogan Footer -->
                    <div class="mt-12 flex items-center justify-center gap-3 text-[9px] font-bold text-blue-900/40 uppercase tracking-widest border-t border-slate-100 pt-6">
                        <span class="border border-blue-900/30 px-2.5 py-0.5 rounded-full text-blue-900/60 font-extrabold">Nugi</span>
                        <span>Space . Moment . Togetherness</span>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('layouts.partials.footer')
</body>
</html>
