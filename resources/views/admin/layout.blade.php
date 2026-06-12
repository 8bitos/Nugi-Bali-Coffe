<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-poppins">
    <!-- Global Top Loading Bar -->
    <div id="global-loading-bar" class="fixed top-0 left-0 h-[3px] bg-gradient-to-r from-blue-500 via-indigo-500 to-cyan-400 z-[9999] transition-all duration-300 ease-out" style="width: 0%; opacity: 0;"></div>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-[260px] bg-slate-900 border-r border-slate-800 transform -translate-x-full lg:translate-x-0 transition duration-200 ease-in-out flex flex-col">
            <!-- Brand -->
            <div class="h-16 flex items-center gap-3 px-6 border-b border-slate-800 shrink-0">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 via-indigo-500 to-cyan-400 flex items-center justify-center shadow-md shadow-blue-500/10">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" /></svg>
                </div>
                <div>
                    <h1 class="text-base font-extrabold text-white leading-none tracking-tight">Nugi Bali</h1>
                    <p class="text-[11px] text-slate-400 font-medium mt-0.5">Admin Panel</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                <p class="px-3 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Menu Utama</p>

                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium transition-all duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/10 font-semibold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" /></svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.reservasi.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium transition-all duration-150 relative {{ request()->routeIs('admin.reservasi.*') && !request()->routeIs('admin.reservasi.report') && !request()->routeIs('admin.reservasi.export*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/10 font-semibold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('admin.reservasi.*') && !request()->routeIs('admin.reservasi.report') && !request()->routeIs('admin.reservasi.export*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                    Reservasi
                    @php $pendingCount = \App\Models\Reservasi::where('status', 'pending')->count(); @endphp
                    @if($pendingCount > 0)
                        <span class="ml-auto bg-rose-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-lg min-w-[20px] text-center leading-none shadow-sm shadow-rose-900/50">{{ $pendingCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.menu.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium transition-all duration-150 {{ request()->routeIs('admin.menu.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/10 font-semibold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('admin.menu.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75-1.5.75a3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0L3 16.5m15-3.379a48.474 48.474 0 0 0-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 0 1 3 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 0 1 6 13.12M12.265 3.11a.375.375 0 1 1-.53 0L12 2.845l.265.265Z" /></svg>
                    Menu
                </a>

                <a href="{{ route('admin.meja.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium transition-all duration-150 {{ request()->routeIs('admin.meja.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/10 font-semibold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('admin.meja.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" /></svg>
                    Meja
                </a>

                <a href="{{ route('admin.galeri.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium transition-all duration-150 {{ request()->routeIs('admin.galeri.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/10 font-semibold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('admin.galeri.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                    Galeri
                </a>

                <a href="{{ route('admin.informasi-web.index') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium transition-all duration-150 {{ request()->routeIs('admin.informasi-web.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/10 font-semibold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('admin.informasi-web.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                    Info Web
                </a>

                <div class="pt-4 mt-3 border-t border-slate-800/80">
                    <p class="px-3 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Laporan</p>

                    <a href="{{ route('admin.reservasi.report') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium transition-all duration-150 {{ request()->routeIs('admin.reservasi.report') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/10 font-semibold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                        <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('admin.reservasi.report') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>
                        Report
                    </a>

                    <a href="{{ route('admin.reservasi.export') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium transition-all duration-150 {{ request()->routeIs('admin.reservasi.export*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/10 font-semibold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                        <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('admin.reservasi.export*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                        Export
                    </a>
                </div>

                <div class="pt-4 mt-3 border-t border-slate-800/80">
                    <p class="px-3 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Pengaturan</p>

                    <a href="{{ route('admin.password.edit') }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13px] font-medium transition-all duration-150 {{ request()->routeIs('admin.password.edit') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/10 font-semibold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                        <svg class="w-[18px] h-[18px] shrink-0 {{ request()->routeIs('admin.password.edit') ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" /></svg>
                        Ganti Password
                    </a>
                </div>
            </nav>

            <!-- User & Logout -->
            <div class="shrink-0 border-t border-slate-800/80 p-3">
                <div class="flex items-center gap-3 px-3 py-2 mb-2 bg-slate-800/30 border border-slate-800/50 rounded-2xl">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 via-indigo-500 to-cyan-400 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                        {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[13px] font-semibold text-white truncate leading-none">{{ auth()->user()?->name }}</p>
                        <p class="text-[11px] text-slate-400 truncate mt-1 leading-none">{{ auth()->user()?->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 text-[13px] font-medium text-rose-400 hover:bg-rose-500/10 rounded-xl transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" /></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-[260px]">
            <!-- Top Bar -->
            <header class="h-16 bg-white border-b border-gray-200/80 flex items-center justify-between px-4 sm:px-6 lg:px-8 shrink-0">
                <div class="flex items-center gap-4">
                    <button id="sidebarToggle" class="lg:hidden p-2 -ml-2 hover:bg-gray-100 rounded-xl transition text-gray-500">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                    </button>
                    <!-- Breadcrumb -->
                    <nav class="hidden sm:flex items-center gap-2 text-sm text-gray-400">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                        </a>
                        @hasSection('breadcrumb')
                            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                            @yield('breadcrumb')
                        @endif
                    </nav>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" target="_blank" class="hidden sm:flex items-center gap-1.5 text-xs text-gray-400 hover:text-blue-600 transition px-3 py-1.5 rounded-lg hover:bg-blue-50">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                        Lihat Website
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div id="flashSuccess" class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 flex items-center justify-between animate-fade-in">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                            <span class="font-medium text-sm">{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600 transition p-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div id="flashError" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 flex items-center justify-between animate-fade-in">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                            <span class="font-medium text-sm">{{ session('error') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 transition p-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                        @foreach($errors->all() as $error)
                            <p class="text-sm flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-red-400 shrink-0"></span> {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        <!-- Sidebar Overlay (mobile) -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 lg:hidden hidden transition-opacity"></div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/40 backdrop-blur-sm p-4">
        <div class="w-full max-w-sm bg-white rounded-2xl shadow-2xl p-6 animate-scale-in">
            <div class="text-center">
                <div class="mx-auto w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Konfirmasi Hapus</h3>
                <p id="deleteModalMsg" class="text-sm text-gray-500 mb-6">Apakah Anda yakin? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">Batal</button>
                <button id="deleteModalConfirm" class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-xl text-sm font-semibold hover:bg-red-700 transition">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle
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

        // Auto-dismiss flash messages
        setTimeout(() => {
            document.querySelectorAll('#flashSuccess, #flashError').forEach(el => {
                el.style.transition = 'opacity 0.5s, transform 0.5s';
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(() => el.remove(), 500);
            });
        }, 5000);

        // Delete confirmation modal
        let deleteForm = null;
        function confirmDelete(formEl, message) {
            deleteForm = formEl;
            document.getElementById('deleteModalMsg').textContent = message || 'Apakah Anda yakin? Tindakan ini tidak dapat dibatalkan.';
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            deleteForm = null;
        }
        document.getElementById('deleteModalConfirm')?.addEventListener('click', () => {
            if (deleteForm) deleteForm.submit();
        });
        document.getElementById('deleteModal')?.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) closeDeleteModal();
        });

        // Global Page Top Loading Bar
        document.addEventListener('DOMContentLoaded', () => {
            const loadingBar = document.getElementById('global-loading-bar');
            
            function startLoading() {
                if (!loadingBar) return;
                loadingBar.style.opacity = '1';
                loadingBar.style.width = '0%';
                
                // Animate progress bar incrementally
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

            // Trigger loading bar on sidebar menu link clicks
            const links = document.querySelectorAll('aside a, header a, main a');
            links.forEach(link => {
                link.addEventListener('click', (e) => {
                    const href = link.getAttribute('href');
                    const target = link.getAttribute('target');
                    
                    // Only show loading if it's a normal link pointing to another page on same domain
                    if (href && 
                        !href.startsWith('#') && 
                        !href.startsWith('javascript:') && 
                        target !== '_blank' && 
                        !e.defaultPrevented && 
                        e.button === 0 && // Left click only
                        !(e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) // No modifier keys
                    ) {
                        startLoading();
                    }
                });
            });

            // Trigger loading bar on form submissions and show feedback on submit button
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', (e) => {
                    if (e.defaultPrevented) return;
                    
                    // Skip loading if the form submission is aborted or if it's handled by confirm modal
                    if (form.getAttribute('id') === 'deleteForm' || form.onsubmit?.toString().includes('confirm')) {
                        // Let confirmation flow handle it
                        return;
                    }
                    
                    startLoading();
                    
                    // Find submit button and add loading class/text
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        setTimeout(() => {
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = `
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            `;
                        }, 50);
                    }
                });
            });
        });
    </script>
</body>
</html>
