@extends('admin.layout')
@section('title','Edit Info')
@section('page_title','Edit Informasi Web')
@section('content')
<form method="POST" action="{{ route('admin.informasi-web.update', $informasi->id) }}" enctype="multipart/form-data" class="space-y-4 rounded-xl border border-slate-200 bg-white p-5">@csrf @method('PUT')
<input name="nama_web" value="{{ old('nama_web', $informasi->nama_web) }}" class="w-full rounded border px-3 py-2">
<textarea name="profil" class="w-full rounded border px-3 py-2">{{ old('profil', $informasi->profil) }}</textarea>
<input name="kontak_email" value="{{ old('kontak_email', $informasi->kontak_email) }}" class="w-full rounded border px-3 py-2">
<input name="kontak_telepon" value="{{ old('kontak_telepon', $informasi->kontak_telepon) }}" class="w-full rounded border px-3 py-2">
<textarea name="alamat" class="w-full rounded border px-3 py-2">{{ old('alamat', $informasi->alamat) }}</textarea>
<input name="lokasi_url" value="{{ old('lokasi_url', $informasi->lokasi_url) }}" class="w-full rounded border px-3 py-2">
<input name="instagram_url" value="{{ old('instagram_url', $informasi->instagram_url) }}" class="w-full rounded border px-3 py-2" placeholder="URL Instagram">
<div>
    <label class="mb-1 block text-sm font-medium">Logo Website</label>
    <input type="file" name="logo" accept="image/*" class="w-full rounded border px-3 py-2">
    @if($informasi->logo)<img src="{{ asset('storage/' . $informasi->logo) }}" class="mt-2 h-12 w-12 rounded object-cover">@endif
</div>
<div>
    <label class="mb-1 block text-sm font-medium">Gambar Halaman Tentang</label>
    <input type="file" name="tentang_image" accept="image/*" class="w-full rounded border px-3 py-2">
    @if($informasi->tentang_image)<img src="{{ asset('storage/' . $informasi->tentang_image) }}" class="mt-2 h-20 w-32 rounded object-cover">@endif
</div>
<div>
    <label class="mb-1 block text-sm font-medium">Gambar Halaman Lokasi</label>
    <input type="file" name="lokasi_image" accept="image/*" class="w-full rounded border px-3 py-2">
    @if($informasi->lokasi_image)<img src="{{ asset('storage/' . $informasi->lokasi_image) }}" class="mt-2 h-20 w-32 rounded object-cover">@endif
</div>
<p class="text-xs text-slate-500">Pengaturan landing page dikelola di halaman `Info Web` utama (section Landing Page Info).</p>
<div class="mt-2 rounded border border-slate-200 p-4">
    <h3 class="mb-3 text-sm font-semibold text-slate-700">Landing Page Info</h3>
    <input name="landing_title" value="{{ old('landing_title', $informasi->landing_title) }}" placeholder="Judul Landing" class="mb-3 w-full rounded border px-3 py-2">
    <textarea name="landing_subtitle" placeholder="Deskripsi Landing" class="mb-3 w-full rounded border px-3 py-2">{{ old('landing_subtitle', $informasi->landing_subtitle) }}</textarea>
    <input name="landing_cta_text" value="{{ old('landing_cta_text', $informasi->landing_cta_text) }}" placeholder="Teks Tombol CTA" class="mb-3 w-full rounded border px-3 py-2">
    <input name="landing_cta_url" value="{{ old('landing_cta_url', $informasi->landing_cta_url) }}" placeholder="URL Tombol CTA" class="mb-3 w-full rounded border px-3 py-2">
    <div><label class="mb-1 block text-sm font-medium">Ganti Carousel Slides (pilih banyak gambar)</label><input type="file" name="landing_slides[]" accept="image/*" multiple class="w-full rounded border px-3 py-2"></div>
    @if(is_array($informasi->landing_slides) && count($informasi->landing_slides))
        <div class="mt-3 flex flex-wrap gap-2">
            @foreach($informasi->landing_slides as $slide)
                <img src="{{ asset('storage/' . $slide) }}" class="h-16 w-24 rounded object-cover">
            @endforeach
        </div>
        <label class="mt-3 flex items-center gap-2 text-sm text-red-600">
            <input type="checkbox" name="remove_landing_slides" value="1"> Hapus semua slide saat simpan
        </label>
    @endif
</div>
<div class="flex gap-2"><button class="rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white">Update</button><a href="{{ route('admin.informasi-web.index') }}" class="rounded border px-4 py-2 text-sm">Batal</a></div>
</form>
@endsection
