@extends('admin.layouts.app')
@section('title','Detail Reservasi')
@section('page_title','Detail Reservasi')
@section('content')
<div class="rounded-xl border border-slate-200 bg-white p-5 text-sm">
<p><span class="font-semibold">Nama:</span> {{ $reservasi->nama_pemesan }}</p>
<p><span class="font-semibold">Kontak:</span> {{ $reservasi->kontak_pemesan }}</p>
<p><span class="font-semibold">Meja:</span> {{ $reservasi->meja->nomor_meja ?? '-' }}</p>
<p><span class="font-semibold">Tanggal:</span> {{ $reservasi->tanggal_reservasi }}</p>
<p><span class="font-semibold">Jam:</span> {{ $reservasi->jam_reservasi }}</p>
<p><span class="font-semibold">Jumlah Orang:</span> {{ $reservasi->jumlah_orang }}</p>
<p><span class="font-semibold">Status:</span> {{ ucfirst($reservasi->status) }}</p>
<p><span class="font-semibold">Catatan:</span> {{ $reservasi->catatan ?: '-' }}</p>
<div class="mt-4"><a href="{{ route('admin.reservasi.edit', $reservasi->id) }}" class="rounded bg-[#0f766e] px-4 py-2 text-sm font-semibold text-white">Edit</a></div>
</div>
@endsection
