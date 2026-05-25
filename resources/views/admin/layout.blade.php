<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-poppins">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-blue-900 to-blue-800 text-white transform -translate-x-full lg:translate-x-0 transition duration-200 ease-in-out overflow-y-auto">
            <div class="p-6 border-b border-blue-700">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-8 object-contain">
                    <div>
                        <h1 class="text-xl font-bold">NUGI BALI</h1>
                        <p class="text-xs text-blue-200">Admin Panel</p>
                    </div>
                </div>
            </div>

            <nav class="px-3 py-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-blue-700' }} transition">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.reservasi.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.reservasi.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }} transition">
                    📅 Reservasi
                </a>
                <a href="{{ route('admin.menu.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.menu.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }} transition">
                    🍽️ Menu
                </a>
                <a href="{{ route('admin.meja.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.meja.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }} transition">
                    🪑 Meja
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.galeri.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }} transition">
                    🖼️ Galeri
                </a>
                <a href="{{ route('admin.informasi-web.index') }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.informasi-web.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }} transition">
                    ⚙️ Info Web
                </a>
            </nav>

            <div class="absolute bottom-6 left-3 right-3">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full px-4 py-3 bg-red-600 hover:bg-red-700 rounded-lg transition font-semibold">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-64">
            <!-- Top Navigation -->
            <div class="bg-white shadow">
                <div class="px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                    <button id="sidebarToggle" class="lg:hidden p-2 hover:bg-gray-100 rounded-lg transition">
                        ☰ Menu
                    </button>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Admin</p>
                        <p class="text-sm font-semibold text-gray-900">{{ auth()->user()?->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700">
                        ✗ {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        <!-- Sidebar Overlay (mobile) -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black opacity-50 z-40 lg:hidden hidden" onclick="closeSidebar()"></div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        toggleBtn?.addEventListener('click', toggleSidebar);
        overlay?.addEventListener('click', closeSidebar);
    </script>
</body>
</html>
