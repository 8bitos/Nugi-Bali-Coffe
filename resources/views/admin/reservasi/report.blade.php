@extends('admin.layouts.app')
@section('title','Laporan Reservasi')
@section('page_title','Laporan Reservasi')
@section('content')
<div class="overflow-x-auto rounded-xl border border-slate-200 bg-white p-4">
<table class="w-full text-sm"><thead><tr class="border-b text-left text-slate-500"><th class="pb-2">Nama</th><th class="pb-2">Meja</th><th class="pb-2">Tanggal</th><th class="pb-2">Jam</th><th class="pb-2">Status</th></tr></thead><tbody>
@forelse($reservasi as $item)
<tr class="border-b border-slate-100"><td class="py-2">{{ $item->nama_pemesan }}</td><td class="py-2">{{ $item->meja->nomor_meja ?? '-' }}</td><td class="py-2">{{ $item->tanggal_reservasi }}</td><td class="py-2">{{ $item->jam_reservasi }}</td><td class="py-2">{{ ucfirst($item->status) }}</td></tr>
@empty<tr><td colspan="5" class="py-6 text-center text-slate-500">Tidak ada data.</td></tr>@endforelse
</tbody></table></div>
@endsection
