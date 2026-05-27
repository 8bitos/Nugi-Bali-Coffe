@extends('admin.layout')
@section('title', 'Edit Reservasi')
@section('breadcrumb')
    <a href="{{ route('admin.reservasi.index') }}" class="hover:text-blue-600 transition">Reservasi</a>
    <span class="text-gray-300">/</span>
    <a href="{{ route('admin.reservasi.show', $reservasi->id) }}" class="hover:text-blue-600 transition">Detail</a>
    <span class="text-gray-300">/</span>
    <span class="text-gray-700 font-medium">Edit</span>
@endsection

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2.5 py-1 rounded-lg">ID: #{{ $reservasi->id }}</span>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight mt-1.5">Edit Reservasi</h1>
            <p class="text-xs text-slate-400">Ubah data reservasi pelanggan dan sesuaikan meja atau status.</p>
        </div>
        <a href="{{ route('admin.reservasi.show', $reservasi->id) }}" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
            Batal
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/40 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                    <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Form Edit</h2>
                </div>
                <form method="POST" action="{{ route('admin.reservasi.update', $reservasi->id) }}" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Meja Terpilih</label>
                            <select name="meja_id" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50 bg-white">
                                @foreach($meja as $m)
                                    <option value="{{ $m->id }}" @selected(old('meja_id', $reservasi->meja_id) == $m->id)>
                                        Meja {{ $m->nomor_meja }} — Kapasitas {{ $m->kapasitas }} org (Rp {{ number_format($m->harga, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status Booking</label>
                            @php
                                $statusOptions = [
                                    'pending' => 'Pending',
                                    'approved' => 'Approved',
                                    'rejected' => 'Rejected',
                                    'completed' => 'Completed',
                                    'cancelled' => 'Cancelled',
                                ];
                            @endphp
                            <select name="status" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50 bg-white">
                                @foreach($statusOptions as $value => $label)
                                    <option value="{{ $value }}" @selected(old('status', $reservasi->status) === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Catatan Admin</label>
                        <textarea name="catatan" rows="4" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50" placeholder="Catatan internal admin...">{{ old('catatan', $reservasi->catatan) }}</textarea>
                    </div>

                    <div class="flex gap-2 pt-2">
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs shadow-sm transition cursor-pointer">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.reservasi.show', $reservasi->id) }}" class="px-5 py-2.5 border border-slate-200 text-slate-600 font-semibold rounded-xl text-xs hover:bg-slate-50 transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Sidebar (readonly) -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-4">Ringkasan Reservasi</p>
                <div class="space-y-4 text-xs font-medium">
                    <div>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Nama Pemesan</p>
                        <p class="text-slate-800 font-bold mt-1 text-sm">{{ $reservasi->nama_pemesan }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Kontak</p>
                        <p class="text-slate-800 mt-1">{{ $reservasi->kontak_pemesan }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Tanggal</p>
                        <p class="text-slate-800 font-bold mt-1">{{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->translatedFormat('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Waktu</p>
                        <p class="text-slate-800 mt-1">{{ $reservasi->jam_reservasi }} WITA</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Jumlah Orang</p>
                        <p class="text-slate-800 mt-1">{{ $reservasi->jumlah_orang }} orang</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Dibuat Pada</p>
                        <p class="text-slate-500 mt-1">{{ $reservasi->created_at?->format('d M Y, H:i') }} WITA</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
