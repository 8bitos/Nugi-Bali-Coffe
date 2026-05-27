@extends('admin.layout')
@section('title', 'Detail Reservasi')
@section('breadcrumb')
    <a href="{{ route('admin.reservasi.index') }}" class="hover:text-blue-600 transition">Reservasi</a>
    <span class="text-gray-300">/</span>
    <span class="text-gray-700 font-medium">Detail</span>
@endsection

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2.5 py-1 rounded-lg">ID: #{{ $reservasi->id }}</span>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight mt-1.5">Detail Reservasi</h1>
            <p class="text-xs text-slate-400">Tinjau informasi lengkap dan kelola status pemesanan.</p>
        </div>
        <a href="{{ route('admin.reservasi.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Pemesan -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/40 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                    <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Informasi Pemesan</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Nama Pemesan</p>
                        <p class="text-slate-800 font-extrabold text-base mt-1">{{ $reservasi->nama_pemesan }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Nomor Kontak</p>
                        <p class="text-slate-800 font-semibold mt-1">{{ $reservasi->kontak_pemesan }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Akun Terdaftar</p>
                        @if($reservasi->user)
                            <p class="text-slate-700 font-medium mt-1">{{ $reservasi->user->name }} <span class="text-slate-400 font-normal">({{ $reservasi->user->email }})</span></p>
                        @else
                            <p class="text-slate-400 font-medium mt-1">Non-Member / Guest</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Dibuat Pada</p>
                        <p class="text-slate-700 font-medium mt-1">{{ $reservasi->created_at?->format('d M Y, H:i') }} WITA</p>
                    </div>
                </div>
            </div>

            <!-- Detail Reservasi -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/40 flex items-center gap-2">
                    <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" /></svg>
                    <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Detail Booking</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Meja Terpilih</p>
                        <p class="text-slate-800 font-black text-lg mt-1">Meja {{ $reservasi->meja?->nomor_meja ?? '-' }}</p>
                        <p class="text-[10px] text-slate-400 font-medium mt-0.5">Kapasitas: {{ $reservasi->meja?->kapasitas ?? '-' }} orang</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Tanggal</p>
                        <p class="text-slate-800 font-bold mt-1">{{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->translatedFormat('d F Y') }}</p>
                        <p class="text-[10px] text-slate-400 font-semibold mt-0.5">{{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->translatedFormat('l') }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Waktu Booking</p>
                        <p class="text-slate-800 font-bold mt-1 text-base">{{ $reservasi->jam_reservasi }} WITA</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Jumlah Tamu</p>
                        <p class="text-slate-800 font-semibold mt-1">{{ $reservasi->jumlah_orang }} orang</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Metode Pembayaran</p>
                        @php
                            $paymentLabels = [
                                'transfer_bank' => 'Transfer Bank',
                                'card' => 'Kartu Kredit/Debit',
                                'ewallet' => 'E-Wallet',
                            ];
                        @endphp
                        <p class="text-slate-800 font-semibold mt-1">{{ $paymentLabels[$reservasi->payment_method] ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Harga Meja</p>
                        <p class="text-blue-600 font-extrabold text-base mt-1">Rp {{ number_format($reservasi->meja?->harga ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
                @if($reservasi->catatan)
                    <div class="px-6 pb-6">
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold mb-2">Catatan Pelanggan</p>
                        <p class="text-slate-600 bg-slate-50 border border-slate-100 rounded-xl p-3.5 text-xs font-medium leading-relaxed">{{ $reservasi->catatan }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar: Status & Actions -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-3">Status Saat Ini</p>
                @php
                    $statusConfig = [
                        'pending' => ['bg' => 'bg-amber-50 text-amber-800 border-amber-200', 'label' => 'Pending'],
                        'approved' => ['bg' => 'bg-emerald-50 text-emerald-800 border-emerald-200', 'label' => 'Disetujui'],
                        'rejected' => ['bg' => 'bg-rose-50 text-rose-800 border-rose-200', 'label' => 'Ditolak'],
                        'completed' => ['bg' => 'bg-blue-50 text-blue-800 border-blue-200', 'label' => 'Selesai'],
                        'cancelled' => ['bg' => 'bg-slate-50 text-slate-700 border-slate-200', 'label' => 'Dibatalkan'],
                    ];
                    $sc = $statusConfig[$reservasi->status] ?? $statusConfig['pending'];
                @endphp
                <div class="flex items-center gap-3 p-4 rounded-xl border {{ $sc['bg'] }}">
                    <span class="font-extrabold text-base uppercase tracking-wider">{{ $sc['label'] }}</span>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-4">Aksi Operasional</p>
                <div class="space-y-2.5">
                    @if($reservasi->status === 'pending')
                        <form method="POST" action="{{ route('admin.reservasi.approve', $reservasi->id) }}">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl shadow-sm transition text-xs flex items-center justify-center gap-2 cursor-pointer">
                                Setujui Reservasi
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.reservasi.reject', $reservasi->id) }}" onsubmit="return confirm('Tolak reservasi ini?')">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold rounded-xl border border-rose-100 transition text-xs flex items-center justify-center gap-2 cursor-pointer">
                                Tolak Reservasi
                            </button>
                        </form>
                    @endif

                    @if($reservasi->status === 'approved')
                        <form method="POST" action="{{ route('admin.reservasi.complete', $reservasi->id) }}">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-sm transition text-xs flex items-center justify-center gap-2 cursor-pointer">
                                Tandai Selesai
                            </button>
                        </form>
                    @endif

                    <div class="pt-2 border-t border-slate-100 flex flex-col gap-2">
                        <a href="{{ route('admin.reservasi.edit', $reservasi->id) }}" class="w-full px-4 py-2.5 bg-white border border-slate-200 text-slate-700 font-semibold rounded-xl hover:bg-slate-50 transition text-xs flex items-center justify-center gap-2">
                            Edit Data Booking
                        </a>

                        <a href="{{ route('reservasi.invoice', $reservasi->id) }}" target="_blank" class="w-full px-4 py-2.5 bg-slate-50 hover:bg-slate-100 text-slate-600 font-semibold rounded-xl border border-slate-200/50 transition text-xs flex items-center justify-center gap-2">
                            Cetak Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
