@extends('admin.layouts.app')
@section('title','Edit Reservasi')
@section('page_title','Edit Reservasi')
@section('content')
<form method="POST" action="{{ route('admin.reservasi.update', $reservasi->id) }}" class="space-y-4 rounded-xl border border-slate-200 bg-white p-5">@csrf @method('PUT')
<select name="meja_id" class="w-full rounded border px-3 py-2">
@foreach($meja as $m)
<option value="{{ $m->id }}" @selected(old('meja_id', $reservasi->meja_id)==$m->id)>{{ $m->nomor_meja }} ({{ $m->kapasitas }})</option>
@endforeach
</select>
<select name="status" class="w-full rounded border px-3 py-2">
@foreach(['pending','approved','rejected','completed','cancelled'] as $status)
<option value="{{ $status }}" @selected(old('status', $reservasi->status)===$status)>{{ ucfirst($status) }}</option>
@endforeach
</select>
<textarea name="catatan" class="w-full rounded border px-3 py-2" placeholder="Catatan">{{ old('catatan', $reservasi->catatan) }}</textarea>
<div class="flex gap-2"><button class="rounded bg-[#0f766e] px-4 py-2 text-sm font-semibold text-white">Update</button><a href="{{ route('admin.reservasi.index') }}" class="rounded border px-4 py-2 text-sm">Batal</a></div>
</form>
@endsection
