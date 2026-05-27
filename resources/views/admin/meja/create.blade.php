@extends('admin.layout')
@section('title', 'Tambah Meja')
@section('breadcrumb')
    <a href="{{ route('admin.meja.index') }}" class="hover:text-blue-600 transition">Meja</a>
    <span class="text-gray-300">/</span>
    <span class="text-gray-700 font-medium">Tambah Meja</span>
@endsection

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2.5 py-1 rounded-lg">Workspace</span>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight mt-1.5">Tambah Meja Baru</h1>
            <p class="text-xs text-slate-400">Daftarkan aset meja baru untuk reservasi pelanggan.</p>
        </div>
        <a href="{{ route('admin.meja.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/40 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Formulir Meja</h2>
                </div>
                <form method="POST" action="{{ route('admin.meja.store') }}" class="p-6 space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nomor Meja</label>
                            <input name="nomor_meja" value="{{ old('nomor_meja') }}" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50" placeholder="Contoh: A1, B5, VIP-1" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status Awal</label>
                            <select name="status" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50 bg-white">
                                <option value="tersedia" @selected(old('status')==='tersedia')>Tersedia</option>
                                <option value="terisi" @selected(old('status')==='terisi')>Terisi</option>
                                <option value="maintenance" @selected(old('status')==='maintenance')>Maintenance</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Kapasitas Kursi</label>
                            <input type="number" name="kapasitas" value="{{ old('kapasitas', 2) }}" min="1" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50" required>
                            <div class="mt-1.5 text-[10px] text-slate-400 font-medium">Batas maksimal jumlah tamu untuk satu meja ini.</div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tarif Reservasi (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-3 text-xs font-extrabold text-slate-400">Rp</span>
                                <input type="number" name="harga" value="{{ old('harga', 0) }}" min="0" class="w-full border border-slate-200 rounded-xl pl-9 pr-4 py-2.5 text-xs outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/50" required>
                            </div>
                            <div class="mt-1.5 text-[10px] text-slate-400 font-medium">Kosongkan atau atur 0 jika pemesanan meja gratis.</div>
                        </div>
                    </div>

                    <div class="flex gap-2 pt-2">
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs shadow-sm transition cursor-pointer">
                            Simpan Meja
                        </button>
                        <a href="{{ route('admin.meja.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-600 font-semibold rounded-xl text-xs hover:bg-slate-50 transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sticky Live Preview Widget -->
        <div>
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 sticky top-6">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-4">Pratinjau Visual</p>
                
                <!-- Room Table Graphic Preview -->
                <div id="pvCard" class="bg-slate-50 border border-slate-100 rounded-2xl p-6 transition-all duration-300 flex flex-col items-center justify-center min-h-[190px]">
                    <div class="relative flex items-center justify-center w-28 h-28 bg-white border border-slate-200/50 rounded-2xl shadow-sm/30 mb-4 transition-all duration-300" id="pvTableShape">
                        <!-- Chairs Visual representation dynamically styled -->
                        <div class="absolute -top-3 flex gap-2 justify-center w-full" id="pvChairsTop">
                            <span class="w-4 h-4 bg-slate-300 rounded-md border border-slate-400/20"></span>
                        </div>
                        <div class="absolute -bottom-3 flex gap-2 justify-center w-full" id="pvChairsBottom">
                            <span class="w-4 h-4 bg-slate-300 rounded-md border border-slate-400/20"></span>
                        </div>
                        <div class="absolute -left-3 top-1/2 -translate-y-1/2 flex flex-col gap-2" id="pvChairsLeft"></div>
                        <div class="absolute -right-3 top-1/2 -translate-y-1/2 flex flex-col gap-2" id="pvChairsRight"></div>

                        <!-- Table Brand Name -->
                        <div class="text-center">
                            <span class="text-xs font-black text-slate-800 uppercase" id="pvNomor">A1</span>
                            <p class="text-[9px] text-slate-400 font-semibold mt-0.5" id="pvKapasitas">2 Kursi</p>
                        </div>
                    </div>
                    
                    <div class="text-center w-full">
                        <span class="px-2 py-0.5 text-[8px] font-black uppercase rounded border transition-colors duration-300" id="pvStatusBadge">Tersedia</span>
                        <div class="text-xs font-black text-slate-700 mt-2">Tarif: <span class="text-blue-600" id="pvHarga">Rp 0</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const rupiah = (n) => (new Intl.NumberFormat('id-ID')).format(Math.max(0, Math.round(n || 0)));
        
        const inputNomor = document.querySelector('input[name="nomor_meja"]');
        const inputKapasitas = document.querySelector('input[name="kapasitas"]');
        const inputHarga = document.querySelector('input[name="harga"]');
        const selectStatus = document.querySelector('select[name="status"]');
        
        const pvNomor = document.getElementById('pvNomor');
        const pvKapasitas = document.getElementById('pvKapasitas');
        const pvHarga = document.getElementById('pvHarga');
        const pvStatusBadge = document.getElementById('pvStatusBadge');
        const pvCard = document.getElementById('pvCard');
        const pvTableShape = document.getElementById('pvTableShape');
        
        const pvChairsTop = document.getElementById('pvChairsTop');
        const pvChairsBottom = document.getElementById('pvChairsBottom');
        const pvChairsLeft = document.getElementById('pvChairsLeft');
        const pvChairsRight = document.getElementById('pvChairsRight');

        const sync = () => {
            const num = (inputNomor.value || '-').trim();
            pvNomor.textContent = num;
            
            const cap = parseInt(inputKapasitas.value || 0);
            pvKapasitas.textContent = `${cap} Tamu`;
            
            const price = parseFloat(inputHarga.value || 0);
            pvHarga.textContent = price > 0 ? `Rp ${rupiah(price)}` : 'Gratis';
            
            const status = selectStatus.value;
            
            // Sync status badge and card styling
            pvStatusBadge.className = 'px-2 py-0.5 text-[8px] font-black uppercase rounded border transition-all duration-300 ';
            pvCard.className = 'border rounded-2xl p-6 transition-all duration-300 flex flex-col items-center justify-center min-h-[190px] ';
            
            if (status === 'tersedia') {
                pvStatusBadge.textContent = 'Tersedia';
                pvStatusBadge.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-100');
                pvCard.classList.add('bg-emerald-50/20', 'border-emerald-100/50');
                pvTableShape.className = 'relative flex items-center justify-center w-28 h-28 bg-white border border-emerald-200/50 rounded-2xl shadow-sm transition-all duration-300';
            } else if (status === 'terisi') {
                pvStatusBadge.textContent = 'Terisi';
                pvStatusBadge.classList.add('bg-amber-50', 'text-amber-700', 'border-amber-100');
                pvCard.classList.add('bg-amber-50/20', 'border-amber-100/50');
                pvTableShape.className = 'relative flex items-center justify-center w-28 h-28 bg-white border border-amber-200/50 rounded-2xl shadow-sm transition-all duration-300';
            } else {
                pvStatusBadge.textContent = 'Maintenance';
                pvStatusBadge.classList.add('bg-rose-50', 'text-rose-700', 'border-rose-100');
                pvCard.classList.add('bg-rose-50/20', 'border-rose-100/50');
                pvTableShape.className = 'relative flex items-center justify-center w-28 h-28 bg-white border border-rose-200/50 rounded-2xl shadow-sm transition-all duration-300';
            }
            
            // Build chairs dynamically
            pvChairsTop.innerHTML = '';
            pvChairsBottom.innerHTML = '';
            pvChairsLeft.innerHTML = '';
            pvChairsRight.innerHTML = '';
            
            const chairEl = () => {
                const span = document.createElement('span');
                span.className = 'w-3.5 h-3.5 bg-slate-200 border border-slate-300 rounded-md transition-all duration-300 block shadow-sm';
                if (status === 'tersedia') {
                    span.classList.add('bg-emerald-100/40', 'border-emerald-200/40');
                } else if (status === 'terisi') {
                    span.classList.add('bg-amber-100/40', 'border-amber-200/40');
                } else {
                    span.classList.add('bg-rose-100/40', 'border-rose-200/40');
                }
                return span;
            };

            for (let i = 0; i < cap; i++) {
                if (i % 4 === 0) {
                    pvChairsTop.appendChild(chairEl());
                } else if (i % 4 === 1) {
                    pvChairsBottom.appendChild(chairEl());
                } else if (i % 4 === 2) {
                    pvChairsLeft.appendChild(chairEl());
                } else {
                    pvChairsRight.appendChild(chairEl());
                }
            }
        };
        
        inputNomor.addEventListener('input', sync);
        inputKapasitas.addEventListener('input', sync);
        inputHarga.addEventListener('input', sync);
        selectStatus.addEventListener('change', sync);
        
        sync();
    });
    </script>
@endsection

