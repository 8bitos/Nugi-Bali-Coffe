@extends('admin.layouts.app')
@section('title','Edit Galeri')
@section('page_title','Edit Galeri')
@section('content')
<form method="POST" action="{{ route('admin.galeri.update', $galeri->id) }}" enctype="multipart/form-data" class="space-y-4 rounded-xl border border-slate-200 bg-white p-5">@csrf @method('PUT')
<input name="judul" value="{{ old('judul', $galeri->judul) }}" class="w-full rounded border px-3 py-2">
<textarea name="deskripsi" class="w-full rounded border px-3 py-2">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
<input type="file" name="foto" accept="image/*" class="w-full rounded border px-3 py-2">
@if($galeri->foto)<img src="{{ asset('storage/' . $galeri->foto) }}" class="h-16 w-16 rounded object-cover">@endif
<div class="flex gap-2"><button class="rounded bg-[#0f766e] px-4 py-2 text-sm font-semibold text-white">Update</button><a href="{{ route('admin.galeri.index') }}" class="rounded border px-4 py-2 text-sm">Batal</a></div>
</form>
@endsection
