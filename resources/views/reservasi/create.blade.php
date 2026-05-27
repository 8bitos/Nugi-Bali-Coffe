<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservasi - Nugi Bali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .font-playfair {
            font-family: 'Playfair Display', Georgia, serif;
        }
        .font-jakarta {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#FAF9F6] font-jakarta text-slate-800 min-h-screen flex flex-col justify-between">
    <!-- Navigation -->
    @include('layouts.partials.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 w-full flex-1">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-200/60">
                <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-6 sm:px-8 py-8 sm:py-12 text-white">
                    <h1 class="text-3xl sm:text-4xl font-playfair font-bold">Buat Reservasi</h1>
                    <p class="text-blue-100 mt-2 text-sm">Pesan meja Anda sekarang untuk pengalaman kuliner terbaik</p>
                </div>

                <div class="p-6 sm:p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            @foreach ($errors->all() as $error)
                                <p class="text-red-600 text-sm">• {{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reservasi.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2 text-sm">Nama Pemesan *</label>
                                <input type="text" name="nama_pemesan" value="{{ old('nama_pemesan', Auth::user()?->name) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2 text-sm">Kontak (No. HP) *</label>
                                <input type="tel" name="kontak_pemesan" value="{{ old('kontak_pemesan') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm" placeholder="08xx-xxxx-xxxx">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2 text-sm">Tanggal Reservasi *</label>
                                <input type="date" name="tanggal_reservasi" value="{{ old('tanggal_reservasi') }}" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2 text-sm">Jam Reservasi *</label>
                                <input type="time" name="jam_reservasi" value="{{ old('jam_reservasi') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm" min="09:00" max="21:00">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2 text-sm">Jumlah Orang *</label>
                                <input type="number" name="jumlah_orang" value="{{ old('jumlah_orang', 2) }}" required min="1" max="20" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2 text-sm">Pilih Meja *</label>
                                <select name="meja_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm">
                                    <option value="">-- Pilih Meja --</option>
                                    @forelse($meja as $m)
                                        <option value="{{ $m->id }}" data-kapasitas="{{ $m->kapasitas }}">
                                            {{ $m->nomor_meja }} - Kapasitas: {{ $m->kapasitas }} orang
                                            @if($m->harga)
                                                - Rp {{ number_format($m->harga, 0, ',', '.') }}
                                            @endif
                                        </option>
                                    @empty
                                        <option value="" disabled>Tidak ada meja tersedia</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2 text-sm">Catatan (Opsional)</label>
                            <textarea name="catatan" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm" rows="4" placeholder="Contoh: Alergi makanan, preferensi tempat duduk, dll">{{ old('catatan') }}</textarea>
                        </div>

                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                            <p class="text-xs text-gray-700 font-semibold">Informasi:</p>
                            <ul class="text-xs text-gray-600 mt-2 space-y-1">
                                <li>• Reservasi minimal H+1 hari sebelum kedatangan</li>
                                <li>• Konfirmasi akan dikirim melalui WhatsApp</li>
                                <li>• Jam operasional: 09:00 - 21:00 WITA</li>
                                <li>• Hubungi kami jika ada perubahan</li>
                            </ul>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold py-3 rounded-xl hover:shadow-lg transition text-sm">Buat Reservasi</button>
                            <a href="{{ route('home') }}" class="flex-1 bg-slate-100 text-slate-700 font-bold py-3 rounded-xl hover:bg-slate-200 transition text-center text-sm">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials.footer')

    <script>
        const selectMeja = document.querySelector('select[name="meja_id"]');
        const inputJumlahOrang = document.querySelector('input[name="jumlah_orang"]');
        
        if (selectMeja && inputJumlahOrang) {
            selectMeja.addEventListener('change', function() {
                const option = this.options[this.selectedIndex];
                const kapasitas = option.dataset.kapasitas;
                if (kapasitas) {
                    inputJumlahOrang.max = kapasitas;
                    if (parseInt(inputJumlahOrang.value) > parseInt(kapasitas)) {
                        inputJumlahOrang.value = kapasitas;
                    }
                }
            });
        }
    </script>
</body>
</html>
