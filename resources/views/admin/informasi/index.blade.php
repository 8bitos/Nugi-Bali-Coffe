@extends('admin.layout')
@section('title','Pengaturan Web')
@section('page_title','Pengaturan Website')
@section('content')

<div class="max-w-[1400px] mx-auto">
    <!-- Header Page -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Pengaturan Website</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola data profil, kontak, media sosial, serta halaman depan (landing page) secara real-time.</p>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Side: Forms Configuration (Tabs) -->
        <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <!-- Tabs Menu Header -->
            <div class="flex border-b border-slate-100 bg-slate-50/50 p-2 overflow-x-auto gap-1">
                <button type="button" data-target="pane-profile" class="tab-btn flex-1 min-w-[100px] py-2 px-3 text-xs font-semibold rounded-lg text-blue-600 bg-white shadow-sm font-bold transition">
                    Profil & Logo
                </button>
                <button type="button" data-target="pane-contact" class="tab-btn flex-1 min-w-[100px] py-2 px-3 text-xs font-semibold rounded-lg text-slate-600 hover:text-slate-900 transition">
                    Kontak & Sosmed
                </button>
                <button type="button" data-target="pane-landing" class="tab-btn flex-1 min-w-[100px] py-2 px-3 text-xs font-semibold rounded-lg text-slate-600 hover:text-slate-900 transition">
                    Landing Page
                </button>
                <button type="button" data-target="pane-slideshow" class="tab-btn flex-1 min-w-[100px] py-2 px-3 text-xs font-semibold rounded-lg text-slate-600 hover:text-slate-900 transition">
                    Slideshow
                </button>
                <button type="button" data-target="pane-banners" class="tab-btn flex-1 min-w-[100px] py-2 px-3 text-xs font-semibold rounded-lg text-slate-600 hover:text-slate-900 transition">
                    Banner Halaman
                </button>
            </div>

            <!-- Configuration Form -->
            <form id="webSettingsForm" method="POST" action="{{ route('admin.informasi-web.landing.update') }}" enctype="multipart/form-data" class="p-6 md:p-8 space-y-6">
                @csrf
                @method('PUT')
                <div id="removed-slides-markers"></div>

                <!-- 1. Tab Profil -->
                <div id="pane-profile" class="tab-pane space-y-6">
                    <div>
                        <h3 class="text-base font-bold text-slate-800 mb-1">Profil & Logo</h3>
                        <p class="text-xs text-slate-400">Atur identitas dasar dan brand website restoran Anda.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Nama Website</label>
                            <input name="nama_web" id="input_nama_web" value="{{ old('nama_web', $landingInfo->nama_web ?? 'Nugi Bali') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Profil / Deskripsi Singkat</label>
                            <textarea name="profil" id="input_profil" rows="4" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 focus:outline-none">{{ old('profil', $landingInfo->profil ?? '') }}</textarea>
                        </div>

                        <!-- Logo Upload -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Logo Restoran</label>
                            
                            <input type="hidden" name="remove_logo" id="remove_logo_flag" value="0">
                            <input type="file" name="logo" id="logo_file_input" accept="image/*" class="hidden">
                            
                            <!-- Upload Area -->
                            <div id="logo_upload_area" class="relative group cursor-pointer border-2 border-dashed border-slate-200 hover:border-blue-500 rounded-2xl p-6 text-center bg-slate-50/40 hover:bg-slate-50 transition duration-200 {{ !empty($landingInfo->logo) ? 'hidden' : '' }}">
                                <div class="flex flex-col items-center">
                                    <svg class="w-8 h-8 text-slate-400 group-hover:text-blue-500 transition-colors mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" /></svg>
                                    <p class="text-sm font-semibold text-slate-700">Unggah Logo</p>
                                    <p class="text-xs text-slate-400 mt-1">Format PNG, JPG, SVG hingga 2MB</p>
                                </div>
                            </div>

                            <!-- Preview Area -->
                            <div id="logo_preview_area" class="relative rounded-2xl border border-slate-200 p-4 bg-slate-50 flex items-center justify-between {{ empty($landingInfo->logo) ? 'hidden' : '' }}">
                                <div class="flex items-center gap-3">
                                    <div class="w-16 h-16 rounded-xl bg-white border border-slate-100 flex items-center justify-center p-2 overflow-hidden shadow-sm">
                                        <img id="logo_preview_img" src="{{ !empty($landingInfo->logo) ? asset('storage/' . $landingInfo->logo) : '#' }}" class="max-w-full max-h-full object-contain">
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-slate-700">logo_restoran.png</p>
                                        <p class="text-[10px] text-slate-400">Aktif digunakan sebagai logo brand</p>
                                    </div>
                                </div>
                                <div class="flex gap-1.5">
                                    <button type="button" id="btn_edit_logo" class="p-2 bg-white border border-slate-200 rounded-lg hover:border-slate-300 hover:text-slate-900 text-slate-500 transition shadow-sm cursor-pointer" title="Ganti logo">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg>
                                    </button>
                                    <button type="button" id="btn_remove_logo" class="p-2 bg-white border border-slate-200 rounded-lg hover:border-red-200 hover:text-red-600 text-slate-500 transition shadow-sm cursor-pointer" title="Hapus logo">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Tab Kontak & Sosmed -->
                <div id="pane-contact" class="tab-pane space-y-6 hidden">
                    <div>
                        <h3 class="text-base font-bold text-slate-800 mb-1">Kontak & Lokasi</h3>
                        <p class="text-xs text-slate-400">Atur rincian kontak dan peta lokasi yang ditampilkan di footer & halaman lokasi.</p>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Email Kontak</label>
                                <input type="email" name="kontak_email" value="{{ old('kontak_email', $landingInfo->kontak_email ?? 'info@nugibali.com') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Nomor Telepon</label>
                                <input name="kontak_telepon" value="{{ old('kontak_telepon', $landingInfo->kontak_telepon ?? '+62 812-3456-7890') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Alamat Lengkap</label>
                            <textarea name="alamat" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 focus:outline-none">{{ old('alamat', $landingInfo->alamat ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Link Google Maps URL (Embed/Share)</label>
                            <input type="url" name="lokasi_url" value="{{ old('lokasi_url', $landingInfo->lokasi_url ?? '') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 focus:outline-none" placeholder="https://maps.google.com/...">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Link Profil Instagram URL</label>
                            <input type="url" name="instagram_url" value="{{ old('instagram_url', $landingInfo->instagram_url ?? '') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 focus:outline-none" placeholder="https://instagram.com/username">
                        </div>
                    </div>
                </div>

                <!-- 3. Tab Landing Page Info -->
                <div id="pane-landing" class="tab-pane space-y-6 hidden">
                    <div>
                        <h3 class="text-base font-bold text-slate-800 mb-1">Teks Utama Landing Page</h3>
                        <p class="text-xs text-slate-400">Atur pesan promosi utama yang langsung tampil di layar depan pengunjung.</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Judul Utama (Landing Title)</label>
                            <input name="landing_title" id="input_landing_title" value="{{ old('landing_title', $landingInfo->landing_title ?? 'NUGI BALI') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Deskripsi Landing (Subtitle)</label>
                            <textarea name="landing_subtitle" id="input_landing_subtitle" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 focus:outline-none">{{ old('landing_subtitle', $landingInfo->landing_subtitle ?? 'Nikmati pengalaman kuliner terbaik dengan suasana nyaman, dekorasi elegan, dan pelayanan prima.') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Teks Tombol CTA</label>
                                <input name="landing_cta_text" id="input_landing_cta_text" value="{{ old('landing_cta_text', $landingInfo->landing_cta_text ?? 'RESERVASI SEKARANG') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">URL Tombol CTA</label>
                                <input name="landing_cta_url" id="input_landing_cta_url" value="{{ old('landing_cta_url', $landingInfo->landing_cta_url ?? route('reservasi.step1')) }}" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-200 focus:outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Tab Slideshow Carousel -->
                <div id="pane-slideshow" class="tab-pane space-y-6 hidden">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-bold text-slate-800 mb-1">Carousel Slideshow</h3>
                            <p class="text-xs text-slate-400">Atur gambar latar belakang bertransisi di halaman utama (Maksimal 10 slide).</p>
                        </div>
                        <button type="button" id="add-slide-btn" class="inline-flex items-center justify-center px-3.5 py-1.5 border border-transparent rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white transition-all shadow-sm shadow-blue-500/10 cursor-pointer">
                            + Tambah Slide
                        </button>
                    </div>

                    @php
                        $existingSlides = isset($landingInfo) && is_array($landingInfo->landing_slides) ? array_values($landingInfo->landing_slides) : [];
                        if (count($existingSlides) < 3) {
                            $existingSlides = array_pad($existingSlides, 3, null);
                        }
                    @endphp

                    <div id="slides-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($existingSlides as $index => $slidePath)
                            <div class="slide-card rounded-2xl border border-slate-200 bg-slate-50/50 p-3 flex flex-col group relative" data-index="{{ $index }}">
                                <div class="mb-2 flex items-center justify-between">
                                    <p class="text-xs font-bold text-slate-500 tracking-wider">SLIDE {{ $index + 1 }}</p>
                                    <div class="flex gap-1">
                                        <button type="button" class="edit-slide-btn p-1.5 bg-white border border-slate-200 text-slate-500 rounded-lg hover:text-slate-900 transition hover:border-slate-300 shadow-sm cursor-pointer" title="Ganti gambar">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg>
                                        </button>
                                        <button type="button" class="remove-slide-btn p-1.5 bg-white border border-slate-200 text-slate-500 rounded-lg hover:text-red-600 transition hover:border-red-200 shadow-sm cursor-pointer" title="Hapus slide">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="slide-preview aspect-[4/3] w-full overflow-hidden rounded-xl border border-slate-200 bg-white relative flex items-center justify-center cursor-pointer {{ !empty($slidePath) ? '' : 'border-dashed' }}">
                                    @if(!empty($slidePath))
                                        <img src="{{ asset('storage/' . $slidePath) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="text-center p-3 select-none">
                                            <svg class="w-6 h-6 text-slate-300 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                                            <p class="text-[10px] text-slate-400">Kosong</p>
                                        </div>
                                    @endif
                                </div>

                                <input type="hidden" name="existing_slides[{{ $index }}]" value="{{ $slidePath }}" class="existing-slide-input">
                                <input type="hidden" name="remove_flags[{{ $index }}]" value="0" class="remove-flag-input">
                                <input type="file" name="slide_files[{{ $index }}]" accept="image/*" class="slide-file-input hidden">
                            </div>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-3 pt-2">
                        @if(count($existingSlides) > 0)
                            <label class="flex items-center gap-2 text-xs font-semibold text-rose-600 cursor-pointer bg-rose-50 border border-rose-100 hover:bg-rose-100/50 rounded-xl px-4 py-2 transition-colors">
                                <input type="checkbox" name="remove_landing_slides" value="1" class="rounded text-rose-600 focus:ring-rose-500"> Hapus semua slide carousel saat menyimpan
                            </label>
                        @endif
                    </div>
                </div>

                <!-- 5. Tab Banner Halaman -->
                <div id="pane-banners" class="tab-pane space-y-6 hidden">
                    <div>
                        <h3 class="text-base font-bold text-slate-800 mb-1">Banner Halaman</h3>
                        <p class="text-xs text-slate-400">Unggah gambar banner khusus untuk mempercantik sub-halaman publik.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Banner Tentang -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500">Banner Halaman "Tentang"</label>
                            <input type="hidden" name="remove_tentang_image" id="remove_tentang_image_flag" value="0">
                            <input type="file" name="tentang_image" id="tentang_file_input" accept="image/*" class="hidden">
                            
                            <!-- Upload Area -->
                            <div id="tentang_upload_area" class="relative group cursor-pointer border-2 border-dashed border-slate-200 hover:border-blue-500 rounded-2xl p-6 text-center bg-slate-50/40 hover:bg-slate-50 transition duration-200 {{ !empty($landingInfo->tentang_image) ? 'hidden' : '' }}">
                                <div class="flex flex-col items-center">
                                    <svg class="w-8 h-8 text-slate-400 group-hover:text-blue-500 transition-colors mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" /></svg>
                                    <p class="text-xs font-semibold text-slate-700">Pilih Gambar Tentang</p>
                                </div>
                            </div>

                            <!-- Preview Area -->
                            <div id="tentang_preview_area" class="relative rounded-2xl border border-slate-200 p-3 bg-slate-50 flex flex-col {{ empty($landingInfo->tentang_image) ? 'hidden' : '' }}">
                                <div class="relative aspect-video w-full rounded-xl overflow-hidden border border-slate-200/80 bg-white">
                                    <img id="tentang_preview_img" src="{{ !empty($landingInfo->tentang_image) ? asset('storage/' . $landingInfo->tentang_image) : '#' }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-[10px] text-slate-400">tentang_banner.jpg</span>
                                    <div class="flex gap-1.5">
                                        <button type="button" id="btn_edit_tentang" class="p-1.5 bg-white border border-slate-200 rounded-lg hover:border-slate-300 hover:text-slate-900 text-slate-500 transition shadow-sm cursor-pointer" title="Ganti gambar">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg>
                                        </button>
                                        <button type="button" id="btn_remove_tentang" class="p-1.5 bg-white border border-slate-200 rounded-lg hover:border-red-200 hover:text-red-600 text-slate-500 transition shadow-sm cursor-pointer" title="Hapus gambar">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Banner Lokasi -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500">Banner Halaman "Lokasi"</label>
                            <input type="hidden" name="remove_lokasi_image" id="remove_lokasi_image_flag" value="0">
                            <input type="file" name="lokasi_image" id="lokasi_file_input" accept="image/*" class="hidden">
                            
                            <!-- Upload Area -->
                            <div id="lokasi_upload_area" class="relative group cursor-pointer border-2 border-dashed border-slate-200 hover:border-blue-500 rounded-2xl p-6 text-center bg-slate-50/40 hover:bg-slate-50 transition duration-200 {{ !empty($landingInfo->lokasi_image) ? 'hidden' : '' }}">
                                <div class="flex flex-col items-center">
                                    <svg class="w-8 h-8 text-slate-400 group-hover:text-blue-500 transition-colors mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" /></svg>
                                    <p class="text-xs font-semibold text-slate-700">Pilih Gambar Lokasi</p>
                                </div>
                            </div>

                            <!-- Preview Area -->
                            <div id="lokasi_preview_area" class="relative rounded-2xl border border-slate-200 p-3 bg-slate-50 flex flex-col {{ empty($landingInfo->lokasi_image) ? 'hidden' : '' }}">
                                <div class="relative aspect-video w-full rounded-xl overflow-hidden border border-slate-200/80 bg-white">
                                    <img id="lokasi_preview_img" src="{{ !empty($landingInfo->lokasi_image) ? asset('storage/' . $landingInfo->lokasi_image) : '#' }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-[10px] text-slate-400">lokasi_banner.jpg</span>
                                    <div class="flex gap-1.5">
                                        <button type="button" id="btn_edit_lokasi" class="p-1.5 bg-white border border-slate-200 rounded-lg hover:border-slate-300 hover:text-slate-900 text-slate-500 transition shadow-sm cursor-pointer" title="Ganti gambar">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg>
                                        </button>
                                        <button type="button" id="btn_remove_lokasi" class="p-1.5 bg-white border border-slate-200 rounded-lg hover:border-red-200 hover:text-red-600 text-slate-500 transition shadow-sm cursor-pointer" title="Hapus gambar">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sticky Bottom Action Bar -->
                <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                    <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition duration-150 shadow-md shadow-blue-500/10 cursor-pointer">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        Simpan Semua Pengaturan
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Side: Realtime Website Preview -->
        <div class="lg:col-span-5 lg:sticky lg:top-6 space-y-4">
            <div class="flex items-center justify-between px-1">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Pratinjau Halaman Utama</span>
                <!-- Viewport Control -->
                <div class="inline-flex rounded-xl bg-slate-200/60 p-0.5 border border-slate-200">
                    <button type="button" id="previewDesktopBtn" class="px-3 py-1.5 text-xs font-bold rounded-lg transition-all duration-150 cursor-pointer bg-white text-slate-800 shadow-sm">
                        Desktop
                    </button>
                    <button type="button" id="previewMobileBtn" class="px-3 py-1.5 text-xs font-bold rounded-lg text-slate-500 hover:text-slate-800 transition-all duration-150 cursor-pointer">
                        Mobile
                    </button>
                </div>
            </div>

            <!-- Browser Mockup Card -->
            <div id="previewFrame" class="w-full mx-auto bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden transition-all duration-300">
                <!-- Browser Header / Address Bar -->
                <div class="h-10 bg-slate-50 border-b border-slate-200/80 flex items-center px-4 gap-3 shrink-0">
                    <!-- Color dots -->
                    <div class="flex gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-400"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                    </div>
                    <!-- Address input -->
                    <div class="flex-1 max-w-sm mx-auto h-6 rounded bg-slate-200/50 border border-slate-200 flex items-center justify-center px-2 text-[10px] text-slate-400 gap-1 select-none">
                        <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                        <span>nugibali.com</span>
                    </div>
                </div>

                <!-- Viewport Content Area -->
                <div id="previewViewport" class="relative overflow-hidden aspect-[4/3] bg-slate-50 flex flex-col transition-all duration-300">
                    
                    <!-- Navigation Mockup -->
                    <nav class="bg-white border-b border-slate-200/60 shadow-sm px-4 py-2 flex items-center justify-between z-10 relative shrink-0">
                        <div class="flex items-center gap-1.5">
                            <!-- Logo Preview Mockup -->
                            <div class="w-6 h-6 rounded bg-blue-600 flex items-center justify-center p-0.5 overflow-hidden">
                                <img id="mock_logo" src="{{ !empty($landingInfo->logo) ? asset('storage/' . $landingInfo->logo) : '#' }}" class="max-w-full max-h-full object-contain {{ empty($landingInfo->logo) ? 'hidden' : '' }}">
                                <div id="mock_logo_placeholder" class="w-full h-full rounded bg-blue-500 flex items-center justify-center text-white text-[8px] font-extrabold {{ !empty($landingInfo->logo) ? 'hidden' : '' }}">NB</div>
                            </div>
                            <span id="mock_web_name" contenteditable="true" class="text-xs font-bold text-slate-800 tracking-tight leading-none hover:outline hover:outline-dashed hover:outline-blue-400 hover:outline-offset-2 cursor-text rounded focus:outline focus:outline-blue-500 transition-all duration-150">{{ old('nama_web', $landingInfo->nama_web ?? 'Nugi Bali') }}</span>
                        </div>
                        
                        <!-- Nav menu (Hidden on mobile) -->
                        <div id="mock_nav_links" class="flex gap-2.5 text-[8px] font-semibold text-slate-500">
                            <span>Beranda</span>
                            <span>Tentang</span>
                            <span>Menu</span>
                            <span>Galeri</span>
                            <span>Lokasi</span>
                            <span>Reservasi</span>
                        </div>

                        <!-- Menu Button (Mobile view hamburger) -->
                        <div id="mock_nav_burger" class="hidden">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        </div>
                    </nav>

                    <!-- Scrollable Page Container -->
                    <div id="mock_page_container" class="flex-1 overflow-y-auto flex flex-col scrollbar-thin">
                        
                        <!-- Hero Section Mockup (Split Columns) -->
                        <div id="mock_hero_section" class="grid grid-cols-2 gap-4 items-center p-6 bg-gradient-to-b from-gray-50 to-white shrink-0">
                            <!-- Left Column: Text -->
                            <div id="hero_text_col" class="text-left">
                                <h2 id="mock_title" contenteditable="true" class="text-xs sm:text-sm md:text-base font-extrabold bg-gradient-to-r from-gray-900 via-blue-700 to-cyan-600 bg-clip-text text-transparent leading-tight uppercase tracking-wider hover:outline hover:outline-dashed hover:outline-blue-400 hover:outline-offset-2 cursor-text rounded focus:outline focus:outline-blue-500 transition-all duration-150">
                                    {{ old('landing_title', $landingInfo->landing_title ?? 'NUGI BALI') }}
                                </h2>
                                <p id="mock_subtitle" contenteditable="true" class="text-[7px] sm:text-[8px] text-slate-500 mt-2 leading-relaxed font-medium max-w-[140px] hover:outline hover:outline-dashed hover:outline-blue-400 hover:outline-offset-2 cursor-text rounded focus:outline focus:outline-blue-500 transition-all duration-150">
                                    {{ old('landing_subtitle', $landingInfo->landing_subtitle ?? 'Nikmati pengalaman kuliner terbaik dengan suasana nyaman, dekorasi elegan, dan pelayanan prima.') }}
                                </p>
                                <a id="mock_cta" contenteditable="true" href="#" class="mt-3 inline-block px-3 py-1 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded text-[7px] font-bold shadow transition leading-none select-none uppercase tracking-wide hover:outline hover:outline-dashed hover:outline-blue-400 hover:outline-offset-2 cursor-text focus:outline focus:outline-blue-500 transition-all duration-150">
                                    {{ old('landing_cta_text', $landingInfo->landing_cta_text ?? 'RESERVASI SEKARANG') }}
                                </a>
                            </div>

                            <!-- Right Column: Slide Mockup -->
                            <div class="relative">
                                <div class="bg-gradient-to-br from-gray-200 via-blue-100 to-cyan-100 aspect-[4/3] rounded-xl relative shadow-md overflow-hidden flex items-center justify-center">
                                    <div id="mock_hero_bg" class="absolute inset-0 bg-slate-900 z-0">
                                        @if(count($existingSlides) > 0 && !empty($existingSlides[0]))
                                            <img id="mock_hero_img" src="{{ asset('storage/' . $existingSlides[0]) }}" class="w-full h-full object-cover opacity-90">
                                        @else
                                            <div id="mock_hero_placeholder" class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-950 opacity-90 flex items-center justify-center"></div>
                                        @endif
                                    </div>
                                    <div class="absolute left-1.5 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-black/25 flex items-center justify-center text-[8px] text-white select-none pointer-events-none">‹</div>
                                    <div class="absolute right-1.5 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-black/25 flex items-center justify-center text-[8px] text-white select-none pointer-events-none">›</div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Mockup -->
                        <div class="bg-gradient-to-r from-blue-900 to-cyan-900 text-white p-4 mt-auto text-left shrink-0">
                            <div class="grid grid-cols-2 gap-4 text-[7px]">
                                <!-- About column -->
                                <div>
                                    <h4 id="mock_footer_web_name" contenteditable="true" class="font-bold text-white mb-1.5 text-[8px] tracking-wide hover:outline hover:outline-dashed hover:outline-blue-400 hover:outline-offset-2 cursor-text rounded focus:outline focus:outline-blue-500 transition-all duration-150">{{ old('nama_web', $landingInfo->nama_web ?? 'Nugi Bali') }}</h4>
                                    <p id="mock_footer_profil" contenteditable="true" class="text-blue-200/80 leading-normal max-w-[120px] hover:outline hover:outline-dashed hover:outline-blue-400 hover:outline-offset-2 cursor-text rounded focus:outline focus:outline-blue-500 transition-all duration-150">{{ old('profil', $landingInfo->profil ?? 'Coffee shop terbaik dengan pelayanan prima') }}</p>
                                </div>
                                <!-- Contact column -->
                                <div class="space-y-1">
                                    <h4 class="font-bold text-white text-[8px] tracking-wide">Kontak</h4>
                                    <p id="mock_footer_email" contenteditable="true" class="text-blue-200/80 hover:outline hover:outline-dashed hover:outline-blue-400 hover:outline-offset-2 cursor-text rounded focus:outline focus:outline-blue-500 transition-all duration-150">📧 {{ old('kontak_email', $landingInfo->kontak_email ?? 'info@nugibali.com') }}</p>
                                    <p id="mock_footer_telepon" contenteditable="true" class="text-blue-200/80 hover:outline hover:outline-dashed hover:outline-blue-400 hover:outline-offset-2 cursor-text rounded focus:outline focus:outline-blue-500 transition-all duration-150">📞 {{ old('kontak_telepon', $landingInfo->kontak_telepon ?? '+62 812-3456-7890') }}</p>
                                    <p id="mock_footer_alamat" contenteditable="true" class="text-blue-200/80 hover:outline hover:outline-dashed hover:outline-blue-400 hover:outline-offset-2 cursor-text rounded focus:outline focus:outline-blue-500 transition-all duration-150">📍 {{ old('alamat', $landingInfo->alamat ?? 'Bali') }}</p>
                                </div>
                            </div>
                            <div class="border-t border-blue-800/80 mt-3 pt-2 text-[6px] text-blue-300 text-center">
                                <p>&copy; 2026 <span id="mock_footer_web_name_copy">{{ old('nama_web', $landingInfo->nama_web ?? 'Nugi Bali') }}</span>. Semua hak dilindungi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (() => {
        // Tab switching logic
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabPanes = document.querySelectorAll('.tab-pane');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.getAttribute('data-target');
                tabBtns.forEach(t => t.className = 'tab-btn flex-1 min-w-[100px] py-2 px-3 text-xs font-semibold rounded-lg text-slate-600 hover:text-slate-900 transition');
                btn.className = 'tab-btn flex-1 min-w-[100px] py-2 px-3 text-xs font-semibold rounded-lg text-blue-600 hover:text-blue-700 bg-white shadow-sm font-bold transition';

                tabPanes.forEach(pane => {
                    if (pane.id === target) {
                        pane.classList.remove('hidden');
                    } else {
                        pane.classList.add('hidden');
                    }
                });
            });
        });

        // Viewport switching logic
        const desktopBtn = document.getElementById('previewDesktopBtn');
        const mobileBtn = document.getElementById('previewMobileBtn');
        const previewFrame = document.getElementById('previewFrame');
        const previewViewport = document.getElementById('previewViewport');
        const mockNavLinks = document.getElementById('mock_nav_links');
        const mockNavBurger = document.getElementById('mock_nav_burger');
        const mockTitle = document.getElementById('mock_title');
        const mockSubtitle = document.getElementById('mock_subtitle');
        const mockHeroSection = document.getElementById('mock_hero_section');
        const heroTextCol = document.getElementById('hero_text_col');

        desktopBtn?.addEventListener('click', () => {
            previewFrame.className = 'w-full mx-auto bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden transition-all duration-300';
            desktopBtn.className = 'px-3 py-1.5 text-xs font-bold rounded-lg transition-all duration-150 cursor-pointer bg-white text-slate-800 shadow-sm';
            mobileBtn.className = 'px-3 py-1.5 text-xs font-bold rounded-lg text-slate-500 hover:text-slate-800 transition-all duration-150 cursor-pointer';
            
            mockNavLinks.classList.remove('hidden');
            mockNavBurger.classList.add('hidden');

            if (previewViewport) {
                previewViewport.classList.remove('aspect-[9/16]');
                previewViewport.classList.add('aspect-[4/3]');
            }

            if (mockHeroSection) {
                mockHeroSection.className = 'grid grid-cols-2 gap-4 items-center p-6 bg-gradient-to-b from-gray-50 to-white shrink-0';
            }
            if (heroTextCol) {
                heroTextCol.className = 'text-left';
            }
            if (mockTitle) {
                mockTitle.className = 'text-xs sm:text-sm md:text-base font-extrabold text-slate-900 leading-tight uppercase tracking-wider';
            }
            if (mockSubtitle) {
                mockSubtitle.className = 'text-[7px] sm:text-[8px] text-slate-500 mt-2 leading-relaxed font-medium max-w-[140px]';
            }
        });

        mobileBtn?.addEventListener('click', () => {
            previewFrame.className = 'w-[320px] mx-auto bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden transition-all duration-300';
            mobileBtn.className = 'px-3 py-1.5 text-xs font-bold rounded-lg transition-all duration-150 cursor-pointer bg-white text-slate-800 shadow-sm';
            desktopBtn.className = 'px-3 py-1.5 text-xs font-bold rounded-lg text-slate-500 hover:text-slate-800 transition-all duration-150 cursor-pointer';
            
            mockNavLinks.classList.add('hidden');
            mockNavBurger.classList.remove('hidden');

            if (previewViewport) {
                previewViewport.classList.remove('aspect-[4/3]');
                previewViewport.classList.add('aspect-[9/16]');
            }

            if (mockHeroSection) {
                mockHeroSection.className = 'grid grid-cols-1 gap-4 p-4 bg-gradient-to-b from-gray-50 to-white text-center shrink-0';
            }
            if (heroTextCol) {
                heroTextCol.className = 'text-center flex flex-col items-center';
            }
            if (mockTitle) {
                mockTitle.className = 'text-[10px] font-extrabold text-slate-900 leading-tight uppercase tracking-wider text-center';
            }
            if (mockSubtitle) {
                mockSubtitle.className = 'text-[7px] text-slate-500 mt-1.5 leading-normal font-medium max-w-[200px] text-center';
            }
        });

        // Realtime binding inputs to preview mockup
        const inputNamaWeb = document.getElementById('input_nama_web');
        const inputLandingTitle = document.getElementById('input_landing_title');
        const inputLandingSubtitle = document.getElementById('input_landing_subtitle');
        const inputLandingCtaText = document.getElementById('input_landing_cta_text');
        const inputLandingCtaUrl = document.getElementById('input_landing_cta_url');
        const inputProfil = document.getElementById('input_profil');
        const inputKontakEmail = document.querySelector('[name="kontak_email"]');
        const inputKontakTelepon = document.querySelector('[name="kontak_telepon"]');
        const inputAlamat = document.querySelector('[name="alamat"]');

        const mockWebName = document.getElementById('mock_web_name');
        const mockTitleTarget = document.getElementById('mock_title');
        const mockSubtitleTarget = document.getElementById('mock_subtitle');
        const mockCtaTarget = document.getElementById('mock_cta');
        const mockFooterWebName = document.getElementById('mock_footer_web_name');
        const mockFooterWebNameCopy = document.getElementById('mock_footer_web_name_copy');
        const mockFooterProfil = document.getElementById('mock_footer_profil');
        const mockFooterEmail = document.getElementById('mock_footer_email');
        const mockFooterTelepon = document.getElementById('mock_footer_telepon');
        const mockFooterAlamat = document.getElementById('mock_footer_alamat');

        const syncInputs = () => {
            // Guard with activeElement to prevent cursor jumping while user edits in preview
            if (document.activeElement !== mockWebName && inputNamaWeb) {
                mockWebName.textContent = inputNamaWeb.value || 'Nugi Bali';
            }
            if (document.activeElement !== mockFooterWebName && inputNamaWeb && mockFooterWebName) {
                mockFooterWebName.textContent = inputNamaWeb.value || 'Nugi Bali';
            }
            if (document.activeElement !== mockFooterWebNameCopy && inputNamaWeb && mockFooterWebNameCopy) {
                mockFooterWebNameCopy.textContent = inputNamaWeb.value || 'Nugi Bali';
            }
            if (document.activeElement !== mockTitleTarget && inputLandingTitle) {
                mockTitleTarget.textContent = inputLandingTitle.value || 'NUGI BALI';
            }
            if (document.activeElement !== mockSubtitleTarget && inputLandingSubtitle) {
                mockSubtitleTarget.textContent = inputLandingSubtitle.value || 'Nikmati pengalaman kuliner terbaik dengan suasana nyaman, dekorasi elegan, dan pelayanan prima.';
            }
            if (document.activeElement !== mockCtaTarget && inputLandingCtaText) {
                mockCtaTarget.textContent = inputLandingCtaText.value || 'RESERVASI SEKARANG';
            }
            if (mockCtaTarget && inputLandingCtaUrl) {
                mockCtaTarget.setAttribute('href', inputLandingCtaUrl.value || '#');
            }
            if (document.activeElement !== mockFooterProfil && mockFooterProfil && inputProfil) {
                mockFooterProfil.textContent = inputProfil.value || 'Coffee shop terbaik dengan pelayanan prima';
            }
            if (document.activeElement !== mockFooterEmail && mockFooterEmail && inputKontakEmail) {
                mockFooterEmail.textContent = '📧 ' + (inputKontakEmail.value || 'info@nugibali.com');
            }
            if (document.activeElement !== mockFooterTelepon && mockFooterTelepon && inputKontakTelepon) {
                mockFooterTelepon.textContent = '📞 ' + (inputKontakTelepon.value || '+62 812-3456-7890');
            }
            if (document.activeElement !== mockFooterAlamat && mockFooterAlamat && inputAlamat) {
                mockFooterAlamat.textContent = '📍 ' + (inputAlamat.value || 'Bali');
            }
        };

        const bindReverseSync = (previewEl, inputEl, emojiPrefix = '') => {
            if (!previewEl || !inputEl) return;
            previewEl.addEventListener('input', () => {
                let text = previewEl.textContent;
                if (emojiPrefix && text.startsWith(emojiPrefix)) {
                    text = text.substring(emojiPrefix.length);
                }
                inputEl.value = text;
                // Dispatch input event to sync other observers
                inputEl.dispatchEvent(new Event('input'));
            });
        };

        // Bind observers (Form Input -> Preview El)
        [inputNamaWeb, inputLandingTitle, inputLandingSubtitle, inputLandingCtaText, inputLandingCtaUrl, inputProfil, inputKontakEmail, inputKontakTelepon, inputAlamat].forEach(el => {
            if (el) el.addEventListener('input', syncInputs);
        });

        // Bind reverse syncing (Preview El -> Form Input)
        bindReverseSync(mockWebName, inputNamaWeb);
        bindReverseSync(mockTitleTarget, inputLandingTitle);
        bindReverseSync(mockSubtitleTarget, inputLandingSubtitle);
        bindReverseSync(mockCtaTarget, inputLandingCtaText);
        bindReverseSync(mockFooterWebName, inputNamaWeb);
        bindReverseSync(mockFooterProfil, inputProfil);
        bindReverseSync(mockFooterEmail, inputKontakEmail, '📧 ');
        bindReverseSync(mockFooterTelepon, inputKontakTelepon, '📞 ');
        bindReverseSync(mockFooterAlamat, inputAlamat, '📍 ');

        syncInputs();

        // Logo Upload Preview handler
        const logoFileInput = document.getElementById('logo_file_input');
        const logoUploadArea = document.getElementById('logo_upload_area');
        const logoPreviewArea = document.getElementById('logo_preview_area');
        const logoPreviewImg = document.getElementById('logo_preview_img');
        const mockLogo = document.getElementById('mock_logo');
        const mockLogoPlaceholder = document.getElementById('mock_logo_placeholder');
        const removeLogoFlag = document.getElementById('remove_logo_flag');

        logoUploadArea?.addEventListener('click', () => logoFileInput.click());
        document.getElementById('btn_edit_logo')?.addEventListener('click', () => logoFileInput.click());

        logoFileInput?.addEventListener('change', () => {
            const file = logoFileInput.files?.[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                logoPreviewImg.src = e.target.result;
                logoUploadArea.classList.add('hidden');
                logoPreviewArea.classList.remove('hidden');
                
                mockLogo.src = e.target.result;
                mockLogo.classList.remove('hidden');
                mockLogoPlaceholder.classList.add('hidden');
                removeLogoFlag.value = "0";
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('btn_remove_logo')?.addEventListener('click', () => {
            logoFileInput.value = "";
            logoPreviewImg.src = "#";
            logoUploadArea.classList.remove('hidden');
            logoPreviewArea.classList.add('hidden');
            
            mockLogo.src = "#";
            mockLogo.classList.add('hidden');
            mockLogoPlaceholder.classList.remove('hidden');
            removeLogoFlag.value = "1";
        });

        // Banner Tentang Upload Preview handler
        const tentangFileInput = document.getElementById('tentang_file_input');
        const tentangUploadArea = document.getElementById('tentang_upload_area');
        const tentangPreviewArea = document.getElementById('tentang_preview_area');
        const tentangPreviewImg = document.getElementById('tentang_preview_img');
        const removeTentangFlag = document.getElementById('remove_tentang_image_flag');

        tentangUploadArea?.addEventListener('click', () => tentangFileInput.click());
        document.getElementById('btn_edit_tentang')?.addEventListener('click', () => tentangFileInput.click());

        tentangFileInput?.addEventListener('change', () => {
            const file = tentangFileInput.files?.[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                tentangPreviewImg.src = e.target.result;
                tentangUploadArea.classList.add('hidden');
                tentangPreviewArea.classList.remove('hidden');
                removeTentangFlag.value = "0";
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('btn_remove_tentang')?.addEventListener('click', () => {
            tentangFileInput.value = "";
            tentangPreviewImg.src = "#";
            tentangUploadArea.classList.remove('hidden');
            tentangPreviewArea.classList.add('hidden');
            removeTentangFlag.value = "1";
        });

        // Banner Lokasi Upload Preview handler
        const lokasiFileInput = document.getElementById('lokasi_file_input');
        const lokasiUploadArea = document.getElementById('lokasi_upload_area');
        const lokasiPreviewArea = document.getElementById('lokasi_preview_area');
        const lokasiPreviewImg = document.getElementById('lokasi_preview_img');
        const removeLokasiFlag = document.getElementById('remove_lokasi_image_flag');

        lokasiUploadArea?.addEventListener('click', () => lokasiFileInput.click());
        document.getElementById('btn_edit_lokasi')?.addEventListener('click', () => lokasiFileInput.click());

        lokasiFileInput?.addEventListener('change', () => {
            const file = lokasiFileInput.files?.[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                lokasiPreviewImg.src = e.target.result;
                lokasiUploadArea.classList.add('hidden');
                lokasiPreviewArea.classList.remove('hidden');
                removeLokasiFlag.value = "0";
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('btn_remove_lokasi')?.addEventListener('click', () => {
            lokasiFileInput.value = "";
            lokasiPreviewImg.src = "#";
            lokasiUploadArea.classList.remove('hidden');
            lokasiPreviewArea.classList.add('hidden');
            removeLokasiFlag.value = "1";
        });

        // Carousel Slides container management
        const slidesContainer = document.getElementById('slides-container');
        const addSlideBtn = document.getElementById('add-slide-btn');
        const mockHeroBg = document.getElementById('mock_hero_bg');
        let nextIndex = slidesContainer.querySelectorAll('.slide-card').length;

        const updateMockHeroImage = () => {
            const firstCardImage = slidesContainer.querySelector('.slide-card:not(.removed) .slide-preview img');
            if (firstCardImage) {
                mockHeroBg.innerHTML = `<img id="mock_hero_img" src="${firstCardImage.src}" class="w-full h-full object-cover opacity-60">`;
            } else {
                mockHeroBg.innerHTML = `<div id="mock_hero_placeholder" class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-950 opacity-90 flex items-center justify-center"></div>`;
            }
        };

        const bindSlideCardEvents = (card) => {
            const fileInput = card.querySelector('.slide-file-input');
            const editBtn = card.querySelector('.edit-slide-btn');
            const removeBtn = card.querySelector('.remove-slide-btn');
            const previewContainer = card.querySelector('.slide-preview');
            const removeFlag = card.querySelector('.remove-flag-input');
            const existingInput = card.querySelector('.existing-slide-input');

            // Click preview or edit button triggers file dialog
            previewContainer.addEventListener('click', () => fileInput.click());
            editBtn?.addEventListener('click', (e) => {
                e.stopPropagation();
                fileInput.click();
            });

            fileInput.addEventListener('change', () => {
                const file = fileInput.files?.[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewContainer.innerHTML = `<img src="${e.target.result}" class="h-full w-full object-cover">`;
                    previewContainer.className = 'slide-preview aspect-[4/3] w-full overflow-hidden rounded-xl border border-slate-200 bg-white relative flex items-center justify-center';
                    removeFlag.value = "0";
                    card.classList.remove('removed');
                    updateMockHeroImage();
                };
                reader.readAsDataURL(file);
            });

            removeBtn?.addEventListener('click', (e) => {
                e.stopPropagation();
                const existingPath = existingInput.value;
                if (existingPath) {
                    // Mark as removed, submit removal flag to backend
                    removeFlag.value = "1";
                    card.classList.add('removed');
                    previewContainer.innerHTML = `
                        <div class="text-center p-3 select-none">
                            <p class="text-xs font-bold text-red-500">Dihapus</p>
                            <p class="text-[9px] text-slate-400 mt-1">Klik untuk batal hapus</p>
                        </div>
                    `;
                    previewContainer.className = 'slide-preview aspect-[4/3] w-full overflow-hidden rounded-xl border border-red-200 bg-red-50 relative flex items-center justify-center border-dashed';
                } else {
                    // Newly added card, just remove from DOM
                    card.remove();
                }
                updateMockHeroImage();
            });

            // Undo delete if clicked when marked as removed
            previewContainer.addEventListener('click', (e) => {
                if (removeFlag.value === "1") {
                    e.stopPropagation();
                    removeFlag.value = "0";
                    card.classList.remove('removed');
                    const originalPath = existingInput.value;
                    const cleanPath = originalPath.startsWith('http') ? originalPath : `{{ asset('storage') }}/${originalPath}`;
                    previewContainer.innerHTML = `<img src="${cleanPath}" class="h-full w-full object-cover">`;
                    previewContainer.className = 'slide-preview aspect-[4/3] w-full overflow-hidden rounded-xl border border-slate-200 bg-white relative flex items-center justify-center';
                    updateMockHeroImage();
                }
            });
        };

        // Bind existing slides
        slidesContainer.querySelectorAll('.slide-card').forEach(bindSlideCardEvents);

        // Add slide button
        addSlideBtn?.addEventListener('click', () => {
            const idx = nextIndex++;
            const card = document.createElement('div');
            card.className = 'slide-card rounded-2xl border border-slate-200 bg-slate-50/50 p-3 flex flex-col group relative';
            card.setAttribute('data-index', idx);
            card.innerHTML = `
                <div class="mb-2 flex items-center justify-between">
                    <p class="text-xs font-bold text-slate-500 tracking-wider">SLIDE ${idx + 1}</p>
                    <div class="flex gap-1">
                        <button type="button" class="edit-slide-btn p-1.5 bg-white border border-slate-200 text-slate-500 rounded-lg hover:text-slate-900 transition hover:border-slate-300 shadow-sm cursor-pointer" title="Pilih gambar">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg>
                        </button>
                        <button type="button" class="remove-slide-btn p-1.5 bg-white border border-slate-200 text-slate-500 rounded-lg hover:text-red-600 transition hover:border-red-200 shadow-sm cursor-pointer" title="Hapus slide">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                        </button>
                    </div>
                </div>
                
                <div class="slide-preview aspect-[4/3] w-full overflow-hidden rounded-xl border border-slate-200 bg-white relative flex items-center justify-center border-dashed cursor-pointer">
                    <div class="text-center p-3 select-none">
                        <svg class="w-6 h-6 text-slate-300 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" /></svg>
                        <p class="text-[10px] text-slate-400">Pilih berkas</p>
                    </div>
                </div>

                <input type="hidden" name="existing_slides[${idx}]" value="" class="existing-slide-input">
                <input type="hidden" name="remove_flags[${idx}]" value="0" class="remove-flag-input">
                <input type="file" name="slide_files[${idx}]" accept="image/*" class="slide-file-input hidden">
            `;
            slidesContainer.appendChild(card);
            bindSlideCardEvents(card);
            // Automatically click the file input for user convenience
            card.querySelector('.slide-file-input').click();
        });
    })();
</script>

@endsection
