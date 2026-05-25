@extends('admin.layouts.app')

@section('title', 'Edit Menu')
@section('page_title', 'Edit Menu')

@section('content')
<div class="mx-auto max-w-3xl">
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 p-6">
            <div>
                <div class="text-base font-extrabold text-slate-900">{{ $menu->nama_menu }}</div>
                <div class="mt-1 text-sm text-slate-500">Perbarui detail menu, foto, dan kategori.</div>
            </div>
            <a href="{{ route('admin.menu.index') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Kembali</a>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('admin.menu.update', $menu->id) }}" enctype="multipart/form-data" class="space-y-5" id="menuForm">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Menu</label>
                        <input name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100" required>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Kategori</label>
                        <div class="flex gap-2">
                            <select name="kategori" id="kategoriSelect" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100" required>
                                <option value="">Pilih kategori</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->nama }}" @selected(old('kategori', $menu->kategori) === $k->nama)>{{ $k->nama }}</option>
                                @endforeach
                                @if(!empty($menu->kategori) && $kategori->where('nama', $menu->kategori)->count() === 0)
                                    <option value="{{ $menu->kategori }}" selected>{{ $menu->kategori }}</option>
                                @endif
                            </select>
                            <button type="button" id="btnAddKategori" class="shrink-0 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 hover:border-blue-200 hover:bg-blue-50">+ Kategori</button>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Harga</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-500">Rp</div>
                            <input type="number" name="harga" value="{{ old('harga', $menu->harga) }}" min="0" step="0.01" class="w-full rounded-xl border border-slate-200 pl-12 pr-4 py-3 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100" required>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi (opsional)</label>
                    <textarea name="deskripsi" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Foto (opsional)</label>
                        <input type="file" name="foto" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-blue-700">
                        <div class="mt-2 text-xs text-slate-500">Upload baru untuk mengganti foto.</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="text-xs font-bold uppercase tracking-widest text-slate-500">Preview</div>
                        <div class="mt-3 flex items-center gap-3">
                            <div class="h-16 w-16 overflow-hidden rounded-xl bg-white ring-1 ring-black/5">
                                @if($menu->foto)
                                    <img src="{{ asset('storage/' . $menu->foto) }}" class="h-full w-full object-cover" alt="Foto Menu">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-xs font-bold text-slate-400">No</div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <div class="truncate text-sm font-extrabold text-slate-900">{{ $menu->nama_menu }}</div>
                                <div class="mt-1 text-sm text-blue-700 font-extrabold">Rp {{ number_format((int)round((float)$menu->harga), 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-2 sm:flex-row sm:justify-end">
                    <a href="{{ route('admin.menu.index') }}" class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
                    <button class="rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:opacity-95">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal: Add Kategori --}}
<div id="kategoriModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-md rounded-2xl bg-white p-5 shadow-xl ring-1 ring-black/10">
        <div class="flex items-center justify-between">
            <div class="text-base font-extrabold text-slate-900">Tambah Kategori</div>
            <button type="button" id="btnCloseKategori" class="rounded-lg p-2 text-slate-500 hover:bg-slate-100">✕</button>
        </div>
        <div class="mt-4 space-y-3">
            <label class="block text-sm font-semibold text-slate-700">Nama Kategori</label>
            <input id="kategoriNama" type="text" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100" placeholder="Contoh: Dessert">
            <div id="kategoriErr" class="hidden text-sm font-semibold text-rose-700"></div>
        </div>
        <div class="mt-5 flex justify-end gap-2">
            <button type="button" id="btnCancelKategori" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Batal</button>
            <button type="button" id="btnSaveKategori" class="rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-4 py-2 text-sm font-extrabold text-white hover:opacity-95">Simpan</button>
        </div>
    </div>
</div>

<script>
(() => {
    const modal = document.getElementById('kategoriModal');
    const btnOpen = document.getElementById('btnAddKategori');
    const btnClose = document.getElementById('btnCloseKategori');
    const btnCancel = document.getElementById('btnCancelKategori');
    const btnSave = document.getElementById('btnSaveKategori');
    const nama = document.getElementById('kategoriNama');
    const err = document.getElementById('kategoriErr');
    const select = document.getElementById('kategoriSelect');

    const openModal = () => {
        err.classList.add('hidden');
        err.textContent = '';
        nama.value = '';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => nama.focus(), 0);
    };
    const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };
    btnOpen?.addEventListener('click', openModal);
    btnClose?.addEventListener('click', closeModal);
    btnCancel?.addEventListener('click', closeModal);
    modal?.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

    const saveKategori = async () => {
        const value = (nama.value || '').trim();
        if (!value) {
            err.textContent = 'Nama kategori wajib diisi.';
            err.classList.remove('hidden');
            return;
        }
        err.classList.add('hidden');
        btnSave.disabled = true;
        btnSave.style.opacity = '0.7';
        try {
            const res = await fetch(@json(route('admin.menu-kategori.store')), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': @json(csrf_token()),
                },
                body: JSON.stringify({ nama: value }),
            });
            const data = await res.json().catch(() => ({}));
            if (!res.ok) {
                const msg = data?.message || 'Gagal menambah kategori.';
                err.textContent = msg;
                err.classList.remove('hidden');
                return;
            }
            const opt = document.createElement('option');
            opt.value = data.nama;
            opt.textContent = data.nama;
            select.appendChild(opt);
            select.value = data.nama;
            closeModal();
        } finally {
            btnSave.disabled = false;
            btnSave.style.opacity = '1';
        }
    };
    btnSave?.addEventListener('click', saveKategori);
    nama?.addEventListener('keydown', (e) => { if (e.key === 'Enter') { e.preventDefault(); saveKategori(); } });
})();
</script>
@endsection

