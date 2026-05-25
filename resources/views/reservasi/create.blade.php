<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservasi - Nugi Bali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-gray-50 to-white font-poppins">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10 sm:h-12 object-contain">
                    <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-bold text-blue-700">NUGI BALI</a>
                </div>
                <div class="hidden md:flex items-center space-x-6 lg:space-x-8 text-sm">
                    <a href="{{ route('home') }}" class="text-slate-700 hover:text-blue-600 transition">Beranda</a>
                    <a href="{{ route('tentang') }}" class="text-slate-700 hover:text-blue-600 transition">Tentang</a>
                    <a href="{{ route('menu') }}" class="text-slate-700 hover:text-blue-600 transition">Menu</a>
                    <a href="{{ route('galeri') }}" class="text-slate-700 hover:text-blue-600 transition">Galeri</a>
                    <a href="{{ route('lokasi') }}" class="text-slate-700 hover:text-blue-600 transition">Lokasi</a>
                    @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-slate-700 hover:text-blue-600 transition">Logout</button>
                    </form>
                    @else<a href="{{ route('login') }}" class="text-slate-700 hover:text-blue-600 transition">Login</a>@endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-6 sm:px-8 py-8 sm:py-12 text-white">
                    <h1 class="text-3xl sm:text-4xl font-bold">Buat Reservasi</h1>
                    <p class="text-blue-100 mt-2">Pesan meja Anda sekarang untuk pengalaman kuliner terbaik</p>
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
                                <label class="block text-gray-700 font-semibold mb-2">Nama Pemesan *</label>
                                <input type="text" name="nama_pemesan" value="{{ old('nama_pemesan', Auth::user()?->name) }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Kontak (No. HP) *</label>
                                <input type="tel" name="kontak_pemesan" value="{{ old('kontak_pemesan') }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="08xx-xxxx-xxxx">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Tanggal Reservasi *</label>
                                <input type="date" name="tanggal_reservasi" value="{{ old('tanggal_reservasi') }}" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Jam Reservasi *</label>
                                <input type="time" name="jam_reservasi" value="{{ old('jam_reservasi') }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" min="09:00" max="21:00">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Jumlah Orang *</label>
                                <input type="number" name="jumlah_orang" value="{{ old('jumlah_orang', 2) }}" required min="1" max="20" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Pilih Meja *</label>
                                <select name="meja_id" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
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
                            <label class="block text-gray-700 font-semibold mb-2">Catatan (Opsional)</label>
                            <textarea name="catatan" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" rows="4" placeholder="Contoh: Alergi makanan, preferensi tempat duduk, dll">{{ old('catatan') }}</textarea>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-sm text-gray-700"><strong>Informasi:</strong></p>
                            <ul class="text-sm text-gray-700 mt-2 space-y-1">
                                <li>• Reservasi minimal H+1 hari sebelum kedatangan</li>
                                <li>• Konfirmasi akan dikirim melalui WhatsApp</li>
                                <li>• Jam operasional: 09:00 - 21:00 WIB</li>
                                <li>• Hubungi kami jika ada perubahan</li>
                            </ul>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-blue-500 to-cyan-600 text-white font-bold py-3 rounded-lg hover:shadow-lg transition">Buat Reservasi</button>
                            <a href="{{ route('home') }}" class="flex-1 bg-gray-100 text-gray-700 font-bold py-3 rounded-lg hover:bg-gray-200 transition text-center">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-900 to-cyan-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">NUGI BALI</h3>
                    <p class="text-blue-100 text-sm">Coffee shop terbaik dengan pelayanan prima</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Menu</h3>
                    <ul class="space-y-2 text-blue-100 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('menu') }}" class="hover:text-white transition">Menu</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-blue-100 text-sm">
                        <li>📧 info@nugibali.com</li>
                        <li>📞 +62 812-3456-7890</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Jam Operasional</h3>
                    <p class="text-blue-100 text-sm">Senin - Minggu<br>09:00 - 21:00 WIB</p>
                </div>
            </div>
            <div class="border-t border-blue-800 mt-8 pt-8 text-center text-blue-200 text-sm">
                <p>&copy; 2026 NUGI BALI. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

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
