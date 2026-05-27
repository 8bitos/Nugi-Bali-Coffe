<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservasi - Step 1 - Nugi Bali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-gray-50 to-white font-poppins">
    <!-- Navigation -->
    @include('layouts.partials.navbar')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
        <!-- Step Indicator -->
        <div class="mb-8 sm:mb-12">
            <div class="flex items-center justify-between">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">1</div>
                    <p class="text-xs sm:text-sm font-semibold mt-2 text-center">Reservasi</p>
                </div>
                <div class="flex-1 h-1 bg-gray-300 mx-2 sm:mx-4"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold">2</div>
                    <p class="text-xs sm:text-sm font-semibold mt-2 text-center">Informasi</p>
                </div>
                <div class="flex-1 h-1 bg-gray-300 mx-2 sm:mx-4"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold">3</div>
                    <p class="text-xs sm:text-sm font-semibold mt-2 text-center">Konfirmasi</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-6 sm:px-8 py-8 sm:py-12 text-white">
                <h1 class="text-3xl sm:text-4xl font-bold">Pesan Meja Anda</h1>
                <p class="text-blue-100 mt-2">Langkah 1 dari 3 - Pilih detail reservasi Anda</p>
            </div>

            <form method="POST" action="{{ route('reservasi.step2') }}" class="p-6 sm:p-8 space-y-6">
                @csrf

                <!-- Jumlah Orang -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Orang</label>
                    <input type="number" name="jumlah_orang" min="1" max="100" value="{{ old('jumlah_orang', 1) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    @error('jumlah_orang')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Reservasi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Reservasi</label>
                    <input type="date" name="tanggal_reservasi" value="{{ old('tanggal_reservasi') }}" 
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    @error('tanggal_reservasi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jam Mulai -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="{{ old('jam_mulai', '09:00') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                    @error('jam_mulai')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pilih Meja -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Meja</label>
                    <select name="meja_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                        <option value="">-- Pilih Meja --</option>
                        @foreach($meja as $item)
                            <option value="{{ $item->id }}" data-kapasitas="{{ $item->kapasitas }}" data-harga="{{ $item->harga ?? 0 }}">
                                Meja {{ $item->nomor_meja }} ({{ $item->kapasitas }} orang) - Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('meja_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Legend -->
                <div class="mt-2 text-sm">
                    <span class="inline-flex items-center mr-4">
                        <span class="w-3 h-3 bg-green-400 rounded-full inline-block mr-2"></span> Tersedia
                    </span>
                    <span class="inline-flex items-center mr-4">
                        <span class="w-3 h-3 bg-gray-400 rounded-full inline-block mr-2"></span> Maintenance
                    </span>
                    <span class="inline-flex items-center">
                        <span class="w-3 h-3 bg-yellow-400 rounded-full inline-block mr-2"></span> Sudah Dibooking
                    </span>
                </div>

                <!-- Summary -->
                <div class="bg-blue-50 rounded-lg p-4 sm:p-6 border border-blue-200">
                    <h3 class="font-semibold text-gray-800 mb-3">Ringkasan</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya Meja:</span>
                            <span class="font-semibold" id="biayaMeja">Rp 0</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-4">
                    <a href="{{ route('home') }}" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-100 transition text-center">
                        Kembali
                    </a>
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                        Lanjut ke Informasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-900 to-cyan-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">NUGI BALI</h3>
                    <p class="text-blue-100">Coffee shop terbaik dengan pelayanan prima...</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2 text-blue-100">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('menu') }}" class="hover:text-white transition">Menu</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-blue-100">
                        <li>📧 info@nugibali.com</li>
                        <li>📞 +62 812-3456-7890</li>
                        <li>📍 Bali</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-blue-800 mt-8 pt-8 text-center text-blue-100">
                <p>© 2026 NUGI BALI. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        const mejaSelect = document.querySelector('select[name="meja_id"]');
        const jumlahOrangInput = document.querySelector('input[name="jumlah_orang"]');
        const biayaMejaSpan = document.getElementById('biayaMeja');
        const tanggalInput = document.querySelector('input[name="tanggal_reservasi"]');

        async function fetchAvailability(tanggal) {
            if (!tanggal) return;
            try {
                const url = `{{ route('reservasi.check') }}?tanggal=${encodeURIComponent(tanggal)}`;
                const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                if (!res.ok) return;
                const data = await res.json();

                // Update options based on status
                Array.from(mejaSelect.options).forEach(opt => {
                    if (!opt.value) return; // skip placeholder
                    const m = data.find(x => String(x.id) === String(opt.value));
                    if (!m) return;
                    opt.disabled = false;
                    // reset text to base label
                    const baseLabel = `Meja ${m.nomor_meja} (${m.kapasitas} orang) - Rp ${Number(m.harga || 0).toLocaleString('id-ID')}`;
                    opt.text = baseLabel;
                    opt.dataset.kapasitas = m.kapasitas;
                    opt.dataset.harga = m.harga;
                    // reset title/style
                    opt.title = '';
                    try { opt.style.color = ''; } catch(e) {}

                    if (m.status === 'maintenance') {
                        opt.disabled = true;
                        opt.text = baseLabel + ' (Maintenance)';
                        opt.title = 'Meja sedang maintenance';
                        try { opt.style.color = '#9CA3AF'; } catch(e) {}
                    } else if (m.status === 'booked') {
                        opt.disabled = true;
                        opt.text = baseLabel + ' (Sudah Dibooking)';
                        opt.title = 'Meja sudah dibooking pada tanggal ini';
                        try { opt.style.color = '#D97706'; } catch(e) {}
                    }
                });

                // If currently selected option is disabled, clear selection
                const selectedOpt = mejaSelect.options[mejaSelect.selectedIndex];
                if (selectedOpt && selectedOpt.disabled) {
                    mejaSelect.value = '';
                    updateSummary();
                }
            } catch (err) {
                console.error('Failed to fetch availability', err);
            }
        }

        function updateSummary() {
            const selectedOption = mejaSelect.options[mejaSelect.selectedIndex];
            const harga = parseInt(selectedOption?.dataset.harga) || 0;
            const kapasitas = parseInt(selectedOption?.dataset.kapasitas) || 0;
            const jumlahOrang = parseInt(jumlahOrangInput.value) || 1;

            // Update display
            biayaMejaSpan.textContent = 'Rp ' + harga.toLocaleString('id-ID');

            // Validate capacity
            if (jumlahOrang > kapasitas && selectedOption && selectedOption.value) {
                jumlahOrangInput.classList.add('border-red-500');
            } else {
                jumlahOrangInput.classList.remove('border-red-500');
            }
        }

        // Trigger availability check when date changes
        tanggalInput.addEventListener('change', (e) => {
            fetchAvailability(e.target.value);
        });

        mejaSelect.addEventListener('change', updateSummary);
        jumlahOrangInput.addEventListener('change', updateSummary);

        // Initial load: if date already selected, fetch availability
        if (tanggalInput.value) {
            fetchAvailability(tanggalInput.value).then(() => updateSummary());
        } else {
            updateSummary();
        }
    </script>
</body>
</html>
