<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Nugi Bali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-900 to-cyan-900 font-poppins min-h-screen">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8">
                <div class="text-center mb-8">
                    <div class="inline-block bg-gradient-to-r from-blue-600 to-cyan-600 p-3 rounded-full mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.894 2.553a.989.989 0 00-.788 0l-7 3.5a.989.989 0 00-.503 1.316c.57 1.255 1.667 2.17 3.032 2.788 1.365.618 2.972.927 4.465.927.988 0 1.968-.14 2.937-.408-.066.368-.176.727-.297 1.076-.214.683-.471 1.329-.789 1.927-.381.878-.821 1.651-1.315 2.288.145.09.293.176.443.255.906.482 1.873.77 2.843.77.743 0 1.482-.104 2.206-.304.842-.227 1.637-.604 2.36-1.115-.166-.302-.33-.615-.487-.93.236.066.468.138.695.209.865.278 1.722.573 2.551.87-.378.52-.784 1.012-1.215 1.47.056.06.111.122.166.183l.163.186.164-.186c.341-.366.668-.794.977-1.279.31-.485.595-1.037.856-1.63.26-.596.483-1.25.664-1.948-.13-1.084-.437-2.115-.906-3.052.067.183.133.366.197.549.39 1.04.601 2.121.601 3.22 0 1.089-.191 2.159-.563 3.174l-.083.227-.082-.227c-.372-1.015-.564-2.085-.564-3.174 0-.997.161-1.978.471-2.91.31-.933.746-1.801 1.292-2.587l.088-.136.088.136c.546.786.982 1.654 1.292 2.587.31.932.471 1.913.471 2.91 0 1.089-.191 2.159-.563 3.174l-.083.227-.082-.227c-.372-1.015-.564-2.085-.564-3.174 0-1.099.211-2.18.621-3.219.41-1.039.975-1.993 1.68-2.83.706-.836 1.54-1.538 2.47-2.08.93-.541 1.945-.915 2.99-1.104.263.34.504.728.709 1.15l.203.484-.411.268c-1.05.688-2.033 1.532-2.896 2.495-.863.963-1.604 2.044-2.192 3.188-.588 1.144-.991 2.363-1.182 3.609.35.122.701.182 1.053.182.858 0 1.708-.201 2.513-.598l.374-.185.077.406c.125.67.188 1.368.188 2.083 0 2.184-.652 4.259-1.886 6.035-.936 1.345-2.203 2.436-3.647 3.177-1.444.74-3.045 1.115-4.652 1.115-.855 0-1.702-.103-2.523-.306-1.66-.405-3.2-1.231-4.494-2.392-1.295-1.16-2.25-2.633-2.782-4.243-.532-1.61-.556-3.296-.07-4.917.243-.824.609-1.61 1.081-2.325l.202-.306.208.298c.472.715.84 1.503 1.084 2.327.174.587.262 1.21.263 1.844 0 1.267-.37 2.487-1.07 3.531-.7 1.044-1.668 1.855-2.806 2.353-1.138.498-2.42.577-3.657.227-1.236-.35-2.313-1.122-3.043-2.157-.73-1.035-.977-2.37-.704-3.678.273-1.308 1.029-2.402 2.101-3.155 1.072-.753 2.43-1.082 3.729-.923.693.084 1.359.3 1.97.638.305.169.598.371.872.601l.339.28-.134-.42c-.438-1.361-.296-2.82.4-4.106.696-1.286 1.896-2.287 3.318-2.7.712-.207 1.469-.213 2.188-.018 1.438.385 2.68 1.36 3.413 2.658.733 1.299.778 2.908.121 4.26l-.194.394-.292-.179c-.595-.364-1.27-.55-1.963-.538-.693.012-1.345.232-1.91.653-.566.421-.98 1.04-1.177 1.739z"/></svg>
                        </svg>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">Admin Login</h2>
                    <p class="text-gray-600 text-sm mt-2">Masuk ke panel admin</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-600 text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email Admin</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" name="password" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold py-3 rounded-lg hover:shadow-lg transition">Login Admin</button>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">← Kembali ke Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
