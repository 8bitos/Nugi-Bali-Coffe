@extends('admin.layout')
@section('title', 'Edit Foto Galeri')
@section('breadcrumb')
    <a href="{{ route('admin.galeri.index') }}" class="hover:text-blue-600 transition">Galeri</a>
    <svg class="w-3.5 h-3.5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
    <span class="text-gray-700 font-medium">Edit</span>
@endsection

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2.5 py-1 rounded-lg">Workspace</span>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight mt-1.5">Edit Foto Galeri</h1>
            <p class="text-xs text-slate-400">Perbarui informasi foto atau ganti berkas media galeri.</p>
        </div>
        <a href="{{ route('admin.galeri.index') }}" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-2 px-3.5 rounded-xl transition text-xs cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" /></svg>
            Kembali
        </a>
    </div>

    <!-- Main Content Form -->
    <form method="POST" action="{{ route('admin.galeri.update', $galeri->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Card: Inputs -->
            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm flex flex-col justify-between">
                <div class="space-y-4">
                    <h2 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-3 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18V6a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6v3.75m-9.75 3h9.75" /></svg>
                        Informasi Foto
                    </h2>

                    <div>
                        <label for="judul" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-1.5">Judul Foto <span class="text-slate-400 font-normal">(Opsional)</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $galeri->judul) }}" placeholder="Masukkan judul foto..." 
                               class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs text-slate-700 placeholder:text-slate-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-1.5">Deskripsi Foto <span class="text-slate-400 font-normal">(Opsional)</span></label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" placeholder="Tulis deskripsi singkat tentang foto ini..." 
                                  class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs text-slate-700 placeholder:text-slate-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition resize-none">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-slate-100 mt-6 lg:mt-0 gap-3">
                    <button type="button" class="bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold py-2.5 px-4 rounded-xl transition text-xs text-center cursor-pointer" 
                            onclick="confirmDelete(document.getElementById('delete-form'), 'Hapus foto {{ addslashes($galeri->judul ?? 'ini') }}?')">
                        Hapus Foto
                    </button>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.galeri.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-2.5 px-4 rounded-xl transition text-xs text-center cursor-pointer">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl shadow-sm transition text-xs text-center cursor-pointer">
                            Perbarui Galeri
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Card: Photo Preview & Edit -->
            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm flex flex-col">
                <h2 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                    Media Galeri
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-1">
                    <!-- Column 1: Current Photo -->
                    <div class="flex flex-col">
                        <span class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Foto Saat Ini</span>
                        <div class="relative overflow-hidden rounded-xl border border-slate-200 bg-slate-50 aspect-square w-full">
                            @if($galeri->foto)
                                <img src="{{ Storage::url($galeri->foto) }}" alt="{{ $galeri->judul ?? 'Foto Aktif' }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    No Image
                                </div>
                            @endif
                        </div>
                        <p class="text-[10px] text-slate-400 mt-2 font-medium">Foto yang sedang digunakan di website.</p>
                    </div>

                    <!-- Column 2: Upload Zone -->
                    <div class="flex flex-col">
                        <span class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide mb-2">Unggah Foto Baru</span>
                        
                        <!-- Hidden Real File Input -->
                        <input type="file" name="foto" id="foto-input" accept="image/*" class="hidden">

                        <!-- Drag and Drop Dropzone -->
                        <div id="dropzone" class="flex-1 flex flex-col items-center justify-center border-2 border-dashed border-slate-200 hover:border-blue-400 rounded-xl p-4 text-center cursor-pointer bg-slate-50/50 hover:bg-blue-50/20 transition-all duration-300 min-h-[160px] aspect-square relative overflow-hidden group">
                            
                            <!-- Upload Prompt State -->
                            <div id="upload-prompt" class="space-y-2 flex flex-col items-center p-2">
                                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center border border-slate-100 shadow-sm group-hover:scale-105 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-700 leading-normal">Seret foto ke sini</p>
                                    <p class="text-[9px] text-slate-400 mt-0.5 leading-normal">atau klik untuk memilih</p>
                                </div>
                            </div>

                            <!-- Preview State (hidden initially) -->
                            <div id="preview-container" class="hidden absolute inset-0 w-full h-full p-1 bg-white">
                                <div class="relative w-full h-full rounded-lg overflow-hidden group/preview bg-slate-50 flex items-center justify-center">
                                    <img id="image-preview" src="#" alt="Pratinjau Foto" class="w-full h-full object-cover">
                                    
                                    <!-- Overlay actions on hover -->
                                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover/preview:opacity-100 transition-opacity flex items-center justify-center gap-1.5">
                                        <button type="button" id="change-photo-btn" class="px-2.5 py-1.5 bg-white hover:bg-slate-50 text-slate-700 text-[10px] font-bold rounded-lg shadow transition-all duration-200 hover:scale-105 cursor-pointer">
                                            Ganti
                                        </button>
                                        <button type="button" id="remove-photo-btn" class="p-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow transition-all duration-200 hover:scale-105 cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- External Deletion Form to prevent invalid nesting -->
    <form id="delete-form" method="POST" action="{{ route('admin.galeri.destroy', $galeri->id) }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dropzone = document.getElementById('dropzone');
            const fileInput = document.getElementById('foto-input');
            const uploadPrompt = document.getElementById('upload-prompt');
            const previewContainer = document.getElementById('preview-container');
            const imagePreview = document.getElementById('image-preview');
            const changePhotoBtn = document.getElementById('change-photo-btn');
            const removePhotoBtn = document.getElementById('remove-photo-btn');

            // Trigger file dialog
            dropzone.addEventListener('click', (e) => {
                if (e.target.closest('#change-photo-btn') || e.target.closest('#remove-photo-btn')) {
                    return;
                }
                fileInput.click();
            });

            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Drag highlighting
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, () => {
                    dropzone.classList.add('border-blue-400', 'bg-blue-50/20');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, () => {
                    dropzone.classList.remove('border-blue-400', 'bg-blue-50/20');
                }, false);
            });

            // Handle dropped files
            dropzone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    handleFileSelection(files[0]);
                }
            });

            // Handle selected files
            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    handleFileSelection(fileInput.files[0]);
                }
            });

            function handleFileSelection(file) {
                if (!file.type.startsWith('image/')) {
                    alert('File harus berupa gambar (JPEG, PNG, JPG, GIF)');
                    resetFile();
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal adalah 2MB');
                    resetFile();
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    uploadPrompt.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }

            function resetFile() {
                fileInput.value = '';
                imagePreview.src = '#';
                previewContainer.classList.add('hidden');
                uploadPrompt.classList.remove('hidden');
            }

            changePhotoBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                fileInput.click();
            });

            removePhotoBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                resetFile();
            });
        });
    </script>
@endsection
