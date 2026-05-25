<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Nugi Bali</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f4f6f8] text-slate-800">
    <div class="min-h-screen lg:flex">
        <aside class="w-full border-r border-slate-200 bg-white lg:w-64">
            <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-5">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-9 w-9 rounded-full border border-slate-200 object-contain p-1">
                <div>
                    <p class="text-lg font-bold leading-none text-[#0f766e]">NUGI BALI</p>
                    <p class="text-xs text-slate-500">Admin Panel</p>
                </div>
            </div>

            <nav class="space-y-1 px-4 py-4 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('admin.dashboard') ? 'bg-[#0f766e] font-semibold text-white' : 'text-slate-600 hover:bg-slate-100' }}">Dashboard</a>
                <a href="{{ route('admin.reservasi.index') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('admin.reservasi.*') ? 'bg-[#0f766e] font-semibold text-white' : 'text-slate-600 hover:bg-slate-100' }}">Reservasi</a>
                <a href="{{ route('admin.menu.index') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('admin.menu.*') ? 'bg-[#0f766e] font-semibold text-white' : 'text-slate-600 hover:bg-slate-100' }}">Menu</a>
                <a href="{{ route('admin.meja.index') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('admin.meja.*') ? 'bg-[#0f766e] font-semibold text-white' : 'text-slate-600 hover:bg-slate-100' }}">Meja</a>
                <a href="{{ route('admin.galeri.index') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('admin.galeri.*') ? 'bg-[#0f766e] font-semibold text-white' : 'text-slate-600 hover:bg-slate-100' }}">Galeri</a>
                <a href="{{ route('admin.informasi-web.index') }}" class="block rounded-lg px-3 py-2 {{ request()->routeIs('admin.informasi-web.*') ? 'bg-[#0f766e] font-semibold text-white' : 'text-slate-600 hover:bg-slate-100' }}">Info Web</a>
            </nav>

            <div class="px-4 pb-6">
                <a href="{{ route('logout') }}" class="block rounded-lg bg-red-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-red-600">Logout</a>
            </div>
        </aside>

        <main class="flex-1 p-4 lg:p-7">
            <header class="mb-5 flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 sm:flex-row sm:items-center sm:justify-between">
                <h1 class="text-xl font-bold">@yield('page_title', 'Dashboard')</h1>
                <div class="text-sm text-slate-500">
                    <span class="font-semibold text-slate-700">{{ auth()->user()->name }}</span>
                    <span class="mx-1">-</span>
                    <span>{{ auth()->user()->email }}</span>
                </div>
            </header>

            @if(session('success'))
                <div class="mb-4 rounded border border-green-200 bg-green-50 p-3 text-sm text-green-700">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 rounded border border-red-200 bg-red-50 p-3 text-sm text-red-700">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="mb-4 rounded border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
