@extends('admin.layout')
@section('title', 'Ganti Password')
@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
    <span class="text-gray-300">/</span>
    <span class="text-gray-700 font-medium">Ganti Password</span>
@endsection

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2.5 py-1 rounded-lg">Keamanan</span>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight mt-1.5">Ganti Password</h1>
            <p class="text-xs text-slate-400">Amankan akun admin Anda dengan memperbarui password secara berkala.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
            Kembali ke Dashboard
        </a>
    </div>

    <div class="max-w-xl">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/40 flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" /></svg>
                <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Formulir Ganti Password</h2>
            </div>
            
            <form method="POST" action="{{ route('admin.password.update') }}" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password Saat Ini</label>
                    <input type="password" name="current_password" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50 @error('current_password') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror" placeholder="Masukkan password Anda yang aktif sekarang">
                    @error('current_password')
                        <p class="text-rose-600 text-[10px] font-semibold mt-1.5 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password Baru</label>
                    <input type="password" name="password" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50 @error('password') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror" placeholder="Minimal 6 karakter">
                    @error('password')
                        <p class="text-rose-600 text-[10px] font-semibold mt-1.5 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                            {{ $message }}
                        </p>
                    @else
                        <div class="mt-1.5 text-[10px] text-slate-400 font-medium">Gunakan kombinasi huruf, angka, dan simbol untuk keamanan ekstra.</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50" placeholder="Ketik ulang password baru Anda">
                </div>

                <div class="flex gap-2 pt-2">
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs shadow-sm transition cursor-pointer flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        Simpan Password
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 border border-slate-200 text-slate-600 font-semibold rounded-xl text-xs hover:bg-slate-50 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
