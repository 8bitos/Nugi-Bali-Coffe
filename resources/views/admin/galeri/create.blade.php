@extends('admin.layouts.app')
@section('title','Tambah Galeri')
@section('page_title','Tambah Galeri')
@section('content')
<form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data" class="space-y-4 rounded-xl border border-slate-200 bg-white p-5">@csrf
<input name="judul" value="{{ old('judul') }}" placeholder="Judul" class="w-full rounded border px-3 py-2">
<textarea name="deskripsi" placeholder="Deskripsi" class="w-full rounded border px-3 py-2">{{ old('deskripsi') }}</textarea>
<input type="file" name="foto" accept="image/*" class="w-full rounded border px-3 py-2" required>
<div class="flex gap-2"><button class="rounded bg-[#0f766e] px-4 py-2 text-sm font-semibold text-white">Simpan</button><a href="{{ route('admin.galeri.index') }}" class="rounded border px-4 py-2 text-sm">Batal</a></div>
</form>
@endsection
