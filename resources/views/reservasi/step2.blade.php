<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservasi - Step 2 - Nugi Bali</title>
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
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold">✓</div>
                    <p class="text-xs sm:text-sm font-semibold mt-2 text-center">Reservasi</p>
                </div>
                <div class="flex-1 h-1 bg-blue-600 mx-2 sm:mx-4"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">2</div>
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
                <h1 class="text-3xl sm:text-4xl font-bold">Data Pemesan</h1>
                <p class="text-blue-100 mt-2">Langkah 2 dari 3 - Isi data pribadi Anda</p>
            </div>

            <form method="POST" action="{{ route('reservasi.step3') }}" class="p-6 sm:p-8 space-y-6">
                @csrf

                <!-- Nama Pemesan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_pemesan" value="{{ old('nama_pemesan', Auth::user()->name) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                    @error('nama_pemesan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100" disabled>
                    <p class="text-xs text-gray-500 mt-1">Berdasarkan akun Anda</p>
                </div>

                <!-- Kontak Pemesan with Country Code -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon</label>
                    <div class="flex gap-2">
                        <!-- Custom Country Code Selector with flag images -->
                        <div class="relative w-28 shrink-0" id="countryDropdownContainer">
                            <button type="button" id="countryDropdownBtn" class="flex w-full items-center justify-between gap-1.5 px-3 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-600 focus:border-transparent cursor-pointer h-10 select-none">
                                <span class="flex items-center gap-1.5" id="selectedCountry">
                                    <img src="https://flagcdn.com/w20/id.png" alt="ID" class="w-5 h-3.5 object-cover rounded shadow-sm">
                                    <span class="font-medium text-sm text-gray-800">+62</span>
                                </span>
                                <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            <div id="countryDropdownList" class="absolute left-0 mt-1 w-48 bg-white border border-gray-100 rounded-xl shadow-xl py-1 hidden z-50 transform origin-top-left transition-all duration-200">
                                <button type="button" data-code="ID" data-dial="+62" data-flag="id" class="flex w-full items-center gap-2.5 px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition cursor-pointer text-left w-full">
                                    <img src="https://flagcdn.com/w20/id.png" alt="ID" class="w-5 h-3.5 object-cover rounded shadow-sm shrink-0">
                                    <span class="font-medium">Indonesia (+62)</span>
                                </button>
                                <button type="button" data-code="MY" data-dial="+60" data-flag="my" class="flex w-full items-center gap-2.5 px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition cursor-pointer text-left w-full">
                                    <img src="https://flagcdn.com/w20/my.png" alt="MY" class="w-5 h-3.5 object-cover rounded shadow-sm shrink-0">
                                    <span class="font-medium">Malaysia (+60)</span>
                                </button>
                                <button type="button" data-code="SG" data-dial="+65" data-flag="sg" class="flex w-full items-center gap-2.5 px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition cursor-pointer text-left w-full">
                                    <img src="https://flagcdn.com/w20/sg.png" alt="SG" class="w-5 h-3.5 object-cover rounded shadow-sm shrink-0">
                                    <span class="font-medium">Singapore (+65)</span>
                                </button>
                                <button type="button" data-code="TH" data-dial="+66" data-flag="th" class="flex w-full items-center gap-2.5 px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition cursor-pointer text-left w-full">
                                    <img src="https://flagcdn.com/w20/th.png" alt="TH" class="w-5 h-3.5 object-cover rounded shadow-sm shrink-0">
                                    <span class="font-medium">Thailand (+66)</span>
                                </button>
                                <button type="button" data-code="PH" data-dial="+63" data-flag="ph" class="flex w-full items-center gap-2.5 px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition cursor-pointer text-left w-full">
                                    <img src="https://flagcdn.com/w20/ph.png" alt="PH" class="w-5 h-3.5 object-cover rounded shadow-sm shrink-0">
                                    <span class="font-medium">Philippines (+63)</span>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="country_code" id="country_code" value="{{ old('country_code', 'ID') }}">
                        <!-- Phone Number Input -->
                        <input type="tel" name="kontak_pemesan" value="{{ old('kontak_pemesan') }}" 
                               placeholder="8xx-xxxx-xxxx"
                               pattern="[0-9]{9,12}"
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" 
                               required>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Mulai dengan 0 untuk Indonesia (0812...) atau tanpa 0 untuk negara lain</p>
                    @error('kontak_pemesan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @error('country_code')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catatan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="catatan" rows="4" placeholder="Tuliskan permintaan khusus atau catatan Anda..."
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent"></textarea>
                    @error('catatan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-4">
                    <a href="{{ route('reservasi.step1') }}" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-100 transition text-center">
                        Kembali
                    </a>
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                        Lanjut ke Konfirmasi
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
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtn = document.getElementById('countryDropdownBtn');
            const dropdownList = document.getElementById('countryDropdownList');
            const selectedCountry = document.getElementById('selectedCountry');
            const countryCodeInput = document.getElementById('country_code');

            // Toggle dropdown list
            dropdownBtn?.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownList?.classList.toggle('hidden');
            });

            // Close dropdown list when clicking outside
            document.addEventListener('click', function() {
                dropdownList?.classList.add('hidden');
            });

            // Select country option
            dropdownList?.querySelectorAll('button').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const code = this.getAttribute('data-code');
                    const dial = this.getAttribute('data-dial');
                    const flag = this.getAttribute('data-flag');

                    // Update button UI
                    selectedCountry.innerHTML = `
                        <img src="https://flagcdn.com/w20/${flag}.png" alt="${code}" class="w-5 h-3.5 object-cover rounded shadow-sm">
                        <span class="font-medium text-sm text-gray-800">${dial}</span>
                    `;

                    // Update hidden input value
                    countryCodeInput.value = code;

                    // Close dropdown list
                    dropdownList.classList.add('hidden');
                });
            });

            // Handle old/existing value on load
            const currentCode = countryCodeInput.value || 'ID';
            const activeOption = dropdownList?.querySelector(`button[data-code="${currentCode}"]`);
            if (activeOption) {
                const dial = activeOption.getAttribute('data-dial');
                const flag = activeOption.getAttribute('data-flag');
                selectedCountry.innerHTML = `
                    <img src="https://flagcdn.com/w20/${flag}.png" alt="${currentCode}" class="w-5 h-3.5 object-cover rounded shadow-sm">
                    <span class="font-medium text-sm text-gray-800">${dial}</span>
                `;
            }
        });
    </script>
</body>
</html>
