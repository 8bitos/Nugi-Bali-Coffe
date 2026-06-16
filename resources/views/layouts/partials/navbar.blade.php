@php
    $navbarInfo = \App\Models\InformasiWeb::first();
@endphp

<!-- Global Top Loading Bar for Public Pages -->
<div id="global-loading-bar" class="fixed top-0 left-0 h-[3px] bg-gradient-to-r from-blue-500 via-indigo-500 to-cyan-400 z-[9999] transition-all duration-300 ease-out" style="width: 0%; opacity: 0; pointer-events: none;"></div>

<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo Section -->
            <div class="flex items-center space-x-3">
                <img src="{{ !empty($navbarInfo?->logo) ? asset('storage/' . $navbarInfo->logo) : asset('assets/images/logo.png') }}" alt="Nugi Bali Logo" class="h-10 sm:h-12 object-contain">
                <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">NUGI BALI</a>
            </div>
            
            <!-- Mobile Menu Toggle -->
            <div class="md:hidden flex items-center">
                <button id="mobileMenuBtn" class="text-blue-600 hover:text-black focus:outline-none transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Menu Links -->
            <div id="desktopMenu" class="hidden md:flex items-center space-x-6 lg:space-x-8">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-800 font-bold border-b-2 border-blue-600' : 'text-blue-600 font-medium' }} hover:text-black transition py-1 text-sm">Beranda</a>
                <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'text-blue-800 font-bold border-b-2 border-blue-600' : 'text-blue-600 font-medium' }} hover:text-black transition py-1 text-sm">Tentang</a>
                <a href="{{ route('menu') }}" class="{{ request()->routeIs('menu') || request()->routeIs('semua-menu') ? 'text-blue-800 font-bold border-b-2 border-blue-600' : 'text-blue-600 font-medium' }} hover:text-black transition py-1 text-sm">Menu</a>
                <a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'text-blue-800 font-bold border-b-2 border-blue-600' : 'text-blue-600 font-medium' }} hover:text-black transition py-1 text-sm">Galeri</a>
                <a href="{{ route('lokasi') }}" class="{{ request()->routeIs('lokasi') ? 'text-blue-800 font-bold border-b-2 border-blue-600' : 'text-blue-600 font-medium' }} hover:text-black transition py-1 text-sm">Lokasi</a>
                <a href="{{ route('reservasi.step1') }}" class="{{ request()->routeIs('reservasi.*') ? 'text-blue-800 font-bold border-b-2 border-blue-600' : 'text-blue-600 font-medium' }} hover:text-black transition py-1 text-sm">Reservasi</a>
            </div>

            <!-- Desktop Right Side: Login / Dropdown -->
            <div class="hidden md:block">
                @auth
                    <div class="relative group">
                        <button class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:shadow-lg transition-all duration-200 cursor-pointer">
                            <span>{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-52 bg-white border border-gray-100 rounded-2xl shadow-xl py-2 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50 transform origin-top-right translate-y-1 group-hover:translate-y-0">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                                    Dashboard Admin
                                </a>
                            @else
                                <a href="{{ route('pelanggan.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    Dashboard Saya
                                </a>
                                <a href="{{ route('pelanggan.reservasi') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                    Reservasi Saya
                                </a>
                            @endif
                            <hr class="border-gray-100 my-1">
                            <form method="POST" action="{{ route('logout') }}" class="block w-full">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:shadow-lg transition-all duration-200">Login</a>
                @endauth
            </div>
        </div>

        <!-- Mobile Menu Links -->
        <div id="mobileMenu" class="hidden md:hidden mt-4 space-y-3 pb-4 border-t border-gray-100 pt-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-xl {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-800 font-bold' : 'text-blue-600' }} hover:text-black transition">Beranda</a>
            <a href="{{ route('tentang') }}" class="block px-3 py-2 rounded-xl {{ request()->routeIs('tentang') ? 'bg-blue-50 text-blue-800 font-bold' : 'text-blue-600' }} hover:text-black transition">Tentang</a>
            <a href="{{ route('menu') }}" class="block px-3 py-2 rounded-xl {{ request()->routeIs('menu') || request()->routeIs('semua-menu') ? 'bg-blue-50 text-blue-800 font-bold' : 'text-blue-600' }} hover:text-black transition">Menu</a>
            <a href="{{ route('galeri') }}" class="block px-3 py-2 rounded-xl {{ request()->routeIs('galeri') ? 'bg-blue-50 text-blue-800 font-bold' : 'text-blue-600' }} hover:text-black transition">Galeri</a>
            <a href="{{ route('lokasi') }}" class="block px-3 py-2 rounded-xl {{ request()->routeIs('lokasi') ? 'bg-blue-50 text-blue-800 font-bold' : 'text-blue-600' }} hover:text-black transition">Lokasi</a>
            <a href="{{ route('reservasi.step1') }}" class="block px-3 py-2 rounded-xl {{ request()->routeIs('reservasi.*') ? 'bg-blue-50 text-blue-800 font-bold' : 'text-blue-600' }} hover:text-black transition">Reservasi</a>
            
            <hr class="border-gray-100 my-2">
            @auth
                <div class="px-3 py-1.5 text-xs text-gray-500 font-semibold bg-gray-50 rounded-xl mb-2">Masuk sebagai: <span class="text-blue-600">{{ auth()->user()->name }}</span></div>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-blue-600 hover:text-black font-semibold">Dashboard Admin</a>
                @else
                    <a href="{{ route('pelanggan.dashboard') }}" class="block px-3 py-2 text-blue-600 hover:text-black font-semibold">Dashboard Saya</a>
                    <a href="{{ route('pelanggan.reservasi') }}" class="block px-3 py-2 text-blue-600 hover:text-black">Reservasi Saya</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 text-red-600 hover:text-red-800 font-semibold cursor-pointer">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block w-full text-center bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-4 py-2.5 rounded-xl font-bold hover:shadow-lg transition">Login</a>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('mobileMenuBtn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            if (menu) menu.classList.toggle('hidden');
        });

        // Global Page Top Loading Bar
        const loadingBar = document.getElementById('global-loading-bar');
        
        function startLoading() {
            if (!loadingBar) return;
            loadingBar.style.opacity = '1';
            loadingBar.style.width = '0%';
            
            let width = 0;
            const interval = setInterval(() => {
                if (width >= 90) {
                    clearInterval(interval);
                } else {
                    width += Math.random() * 15;
                    if (width > 90) width = 90;
                    loadingBar.style.width = width + '%';
                }
            }, 150);
            
            window._loadingInterval = interval;
        }

        // Trigger loading bar on navigation link clicks
        const links = document.querySelectorAll('nav a, #mobileMenu a, body a');
        links.forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');
                const target = link.getAttribute('target');
                
                if (href && 
                    !href.startsWith('#') && 
                    !href.startsWith('javascript:') && 
                    target !== '_blank' && 
                    !e.defaultPrevented && 
                    e.button === 0 && 
                    !(e.metaKey || e.ctrlKey || e.shiftKey || e.altKey)
                ) {
                    startLoading();
                }
            });
        });

        // Trigger loading bar on form submissions (like reservation steps)
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', (e) => {
                if (e.defaultPrevented) return;
                startLoading();
                
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    setTimeout(() => {
                        submitBtn.disabled = true;
                        const hasIcon = submitBtn.querySelector('svg');
                        if (!hasIcon) {
                            submitBtn.innerHTML = `
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            `;
                        }
                    }, 50);
                }
            });
        });
    });
</script>
