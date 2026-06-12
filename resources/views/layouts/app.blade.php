<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Nugi Bali</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Nugi Bali" class="h-10">
                <span class="text-2xl font-bold text-blue-600">Nugi Bali</span>
            </a>
            <div class="flex items-center gap-4">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('pelanggan.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Dashboard Saya</a>
                        <a href="{{ route('pelanggan.reservasi') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Reservasi Saya</a>
                    @endif
                    <span class="text-gray-500 text-sm">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('auth.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ route('auth.login') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Login</a>
                    <a href="{{ route('auth.register') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Register</a>
                    <a href="{{ route('admin.login') }}" class="text-purple-600 hover:text-purple-800 font-semibold text-sm">Admin</a>
                @endauth
            </div>
        </div>
    </nav>


    <div id="global-loading-bar" class="fixed top-0 left-0 h-[3px] bg-gradient-to-r from-blue-500 via-indigo-500 to-cyan-400 z-[9999] transition-all duration-300 ease-out" style="width: 0%; opacity: 0; pointer-events: none;"></div>

    <div class="max-w-7xl mx-auto py-6 px-4">
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        <p>&copy; 2026 Nugi Bali. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
            const links = document.querySelectorAll('a');
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

            // Trigger loading bar on form submissions
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
</body>
</html>
