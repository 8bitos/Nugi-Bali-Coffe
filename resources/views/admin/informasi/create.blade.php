@extends('admin.layouts.app')
@section('title','Tambah Info')
@section('page_title','Tambah Informasi Web')
@section('content')
<form method="POST" action="{{ route('admin.informasi-web.store') }}" enctype="multipart/form-data" class="space-y-4 rounded-xl border border-slate-200 bg-white p-5">@csrf
<input name="nama_web" value="{{ old('nama_web') }}" placeholder="Nama Web" class="w-full rounded border px-3 py-2">
<textarea name="profil" placeholder="Profil" class="w-full rounded border px-3 py-2">{{ old('profil') }}</textarea>
<input name="kontak_email" value="{{ old('kontak_email') }}" placeholder="Email" class="w-full rounded border px-3 py-2">
<input name="kontak_telepon" value="{{ old('kontak_telepon') }}" placeholder="Telepon" class="w-full rounded border px-3 py-2">
<textarea name="alamat" placeholder="Alamat" class="w-full rounded border px-3 py-2">{{ old('alamat') }}</textarea>
<input name="lokasi_url" value="{{ old('lokasi_url') }}" placeholder="URL Lokasi" class="w-full rounded border px-3 py-2">
<input name="instagram_url" value="{{ old('instagram_url') }}" placeholder="URL Instagram" class="w-full rounded border px-3 py-2">
<div><label class="mb-1 block text-sm font-medium">Logo Website</label><input type="file" name="logo" accept="image/*" class="w-full rounded border px-3 py-2"></div>
<div><label class="mb-1 block text-sm font-medium">Gambar Halaman Tentang</label><input type="file" name="tentang_image" accept="image/*" class="w-full rounded border px-3 py-2"></div>
<div><label class="mb-1 block text-sm font-medium">Gambar Halaman Lokasi</label><input type="file" name="lokasi_image" accept="image/*" class="w-full rounded border px-3 py-2"></div>
<p class="text-xs text-slate-500">Pengaturan landing page dikelola di halaman `Info Web` utama (section Landing Page Info).</p>
<div class="mt-2 rounded border border-slate-200 p-4">
    <h3 class="mb-3 text-sm font-semibold text-slate-700">Landing Page Info</h3>
    <input name="landing_title" value="{{ old('landing_title') }}" placeholder="Judul Landing (contoh: NUGI BALI)" class="mb-3 w-full rounded border px-3 py-2">
    <textarea name="landing_subtitle" placeholder="Deskripsi Landing" class="mb-3 w-full rounded border px-3 py-2">{{ old('landing_subtitle') }}</textarea>
    <input name="landing_cta_text" value="{{ old('landing_cta_text') }}" placeholder="Teks Tombol CTA" class="mb-3 w-full rounded border px-3 py-2">
    <input name="landing_cta_url" value="{{ old('landing_cta_url') }}" placeholder="URL Tombol CTA (contoh: /reservasi)" class="mb-3 w-full rounded border px-3 py-2">
    <div><label class="mb-1 block text-sm font-medium">Carousel Slides (bisa pilih banyak gambar)</label><input type="file" name="landing_slides[]" accept="image/*" multiple class="w-full rounded border px-3 py-2"></div>
</div>
<div class="flex gap-2"><button class="rounded bg-[#0f766e] px-4 py-2 text-sm font-semibold text-white">Simpan</button><a href="{{ route('admin.informasi-web.index') }}" class="rounded border px-4 py-2 text-sm">Batal</a></div>
</form>
@endsection
