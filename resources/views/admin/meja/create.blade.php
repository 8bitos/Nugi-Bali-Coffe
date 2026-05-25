@extends('admin.layouts.app')
@section('title','Tambah Meja')
@section('page_title','Tambah Meja')
@section('content')
<div class="mx-auto max-w-3xl">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.meja.store') }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nomor Meja</label>
                    <input name="nomor_meja" value="{{ old('nomor_meja') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100" placeholder="Contoh: A1" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                    <select name="status" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100">
                        <option value="tersedia" @selected(old('status','tersedia')==='tersedia')>Tersedia</option>
                        <option value="terisi" @selected(old('status')==='terisi')>Terisi</option>
                        <option value="maintenance" @selected(old('status')==='maintenance')>Maintenance</option>
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Kapasitas</label>
                    <input type="number" name="kapasitas" value="{{ old('kapasitas', 1) }}" min="1" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100" required>
                    <div class="mt-2 text-xs text-slate-500">Jumlah orang maksimal untuk meja ini.</div>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Harga</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-500">Rp</div>
                        <input type="number" name="harga" value="{{ old('harga', 0) }}" min="0" step="0.01" class="w-full rounded-xl border border-slate-200 pl-12 pr-4 py-3 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100" required>
                    </div>
                    <div class="mt-2 text-xs text-slate-500">Biaya reservasi untuk meja ini (jika ada).</div>
                </div>
            </div>

            <div class="rounded-2xl bg-slate-50 p-4 ring-1 ring-slate-100">
                <div class="text-xs font-bold uppercase tracking-widest text-slate-500">Preview</div>
                <div class="mt-3 flex items-center justify-between">
                    <div>
                        <div class="text-sm font-extrabold text-slate-900">Meja <span class="text-blue-700" id="pvNomor">-</span></div>
                        <div class="mt-1 text-sm text-slate-600">Kapasitas <span class="font-bold text-slate-800" id="pvKapasitas">-</span> orang</div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs font-semibold text-slate-500">Harga</div>
                        <div class="text-base font-extrabold text-blue-700">Rp <span id="pvHarga">0</span></div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.meja.index') }}" class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
                <button class="rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:opacity-95">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
(() => {
    const rupiah = (n) => (new Intl.NumberFormat('id-ID')).format(Math.max(0, Math.round(n || 0)));
    const nomor = document.querySelector('input[name="nomor_meja"]');
    const kapasitas = document.querySelector('input[name="kapasitas"]');
    const harga = document.querySelector('input[name="harga"]');
    const pvNomor = document.getElementById('pvNomor');
    const pvKapasitas = document.getElementById('pvKapasitas');
    const pvHarga = document.getElementById('pvHarga');
    const sync = () => {
        pvNomor.textContent = (nomor.value || '-').trim() || '-';
        pvKapasitas.textContent = kapasitas.value || '-';
        pvHarga.textContent = rupiah(harga.value || 0);
    };
    nomor.addEventListener('input', sync);
    kapasitas.addEventListener('input', sync);
    harga.addEventListener('input', sync);
    sync();
})();
</script>
@endsection

