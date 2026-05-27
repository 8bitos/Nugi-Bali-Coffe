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
</body>
</html>
