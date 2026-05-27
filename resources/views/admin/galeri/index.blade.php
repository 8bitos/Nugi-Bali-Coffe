@extends('admin.layout')
@section('title', 'Manajemen Galeri')
@section('breadcrumb')
    <span class="text-gray-700 font-medium">Galeri</span>
@endsection

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2.5 py-1 rounded-lg">Media Library</span>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight mt-1.5">Manajemen Galeri</h1>
            <p class="text-xs text-slate-400">Kelola foto-foto suasana restoran, event, dan promosi.</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl shadow-sm transition text-xs cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            Tambah Foto
        </a>
    </div>

    <!-- Gallery Grid -->
    @if($galeri->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($galeri as $item)
                <div class="relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
                    <div class="aspect-[4/3] w-full overflow-hidden bg-slate-100 relative">
                        @if($item->foto)
                            <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul ?? 'Foto Galeri' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-300">
                                <svg class="w-10 h-10 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                            </div>
                        @endif

                        <!-- Gradient Overlay (for text visibility) -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Content Overlay -->
                        <div class="absolute bottom-0 inset-x-0 p-4 flex flex-col justify-end text-white">
                            <h3 class="font-bold text-[13px] leading-tight text-white drop-shadow-sm truncate">{{ $item->judul ?? 'Tanpa Judul' }}</h3>
                            @if($item->deskripsi)
                                <p class="text-[11px] text-slate-300 line-clamp-1 mt-1 font-light drop-shadow-sm">{{ $item->deskripsi }}</p>
                            @endif
                        </div>

                        <!-- Action Buttons Floating Overlay -->
                        <div class="absolute top-3 right-3 flex items-center gap-1.5 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-all duration-300 transform sm:translate-y-[-4px] sm:group-hover:translate-y-0">
                            <a href="{{ route('admin.galeri.edit', $item->id) }}" class="p-2 bg-white/95 hover:bg-white text-slate-700 hover:text-blue-600 rounded-lg shadow-sm border border-slate-100 transition-all duration-200 hover:scale-105" title="Edit Foto">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.83 20.089a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.galeri.destroy', $item->id) }}" class="inline-block" onsubmit="event.preventDefault(); confirmDelete(this, 'Hapus foto {{ addslashes($item->judul ?? 'ini') }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-white/95 hover:bg-white text-slate-700 hover:text-red-600 rounded-lg shadow-sm border border-slate-100 transition-all duration-200 hover:scale-105 cursor-pointer" title="Hapus Foto">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="border-2 border-dashed border-slate-200 rounded-2xl bg-white p-16 text-center max-w-lg mx-auto my-8">
            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-slate-100">
                <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </div>
            <h3 class="text-base font-bold text-slate-900 mb-1">Belum ada foto galeri</h3>
            <p class="text-xs text-slate-500 mb-6 max-w-xs mx-auto">Unggah foto menu, suasana restoran, atau kegiatan promosi untuk ditampilkan di halaman galeri website.</p>
            <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold py-2.5 px-6 rounded-xl hover:shadow-lg transition text-xs cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Foto Pertama
            </a>
        </div>
    @endif
@endsection
