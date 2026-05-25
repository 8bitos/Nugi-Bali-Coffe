<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Nugi Bali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-cyan-50 font-poppins">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">Login</h2>
                    <p class="text-gray-600 text-sm mt-2">Masuk ke akun pelanggan Anda</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-600 text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" name="password" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-cyan-600 text-white font-bold py-3 rounded-lg hover:shadow-lg transition">Login</button>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <p class="text-gray-600 text-sm text-center mb-3">Belum punya akun?</p>
                    <a href="{{ route('register') }}" class="block w-full bg-gray-100 text-gray-700 font-bold py-3 rounded-lg hover:bg-gray-200 transition text-center">Daftar di sini</a>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.login') }}" class="block text-blue-600 hover:text-blue-700 text-sm text-center font-semibold">Admin? Login di sini</a>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-700 text-sm">← Kembali ke beranda</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
