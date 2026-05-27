<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservasi - Step 4 - Nugi Bali</title>
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

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 w-full flex-1">
        <!-- Step Indicator -->
        <div class="mb-8 sm:mb-12">
            <div class="flex items-center justify-between">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold">✓</div>
                    <p class="text-xs sm:text-sm font-semibold mt-2 text-center">Reservasi</p>
                </div>
                <div class="flex-1 h-1 bg-blue-600 mx-2 sm:mx-4"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold">✓</div>
                    <p class="text-xs sm:text-sm font-semibold mt-2 text-center">Informasi</p>
                </div>
                <div class="flex-1 h-1 bg-blue-600 mx-2 sm:mx-4"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold">✓</div>
                    <p class="text-xs sm:text-sm font-semibold mt-2 text-center">Konfirmasi</p>
                </div>
                <div class="flex-1 h-1 bg-blue-600 mx-2 sm:mx-4"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">4</div>
                    <p class="text-xs sm:text-sm font-semibold mt-2 text-center">Pembayaran</p>
                </div>
            </div>
        </div>

        <!-- Payment Page -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-6 sm:px-8 py-8 sm:py-12 text-white">
                <h1 class="text-3xl sm:text-4xl font-bold">Pilih Metode Pembayaran</h1>
                <p class="text-blue-100 mt-2">Langkah 4 dari 4 - Selesaikan pembayaran Anda</p>
            </div>

            <div class="p-6 sm:p-8 space-y-8">
                <!-- Total Amount -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-4 sm:p-6 border-2 border-green-300">
                    <div class="text-center">
                        <p class="text-gray-600 text-sm mb-2">Total Pembayaran</p>
                        <p class="text-4xl sm:text-5xl font-bold text-green-600">Rp {{ number_format($meja->harga ?? 0, 0, ',', '.') }}</p>
                        <p class="text-gray-600 text-sm mt-2">untuk {{ $reservasi['jumlah_orang'] }} orang pada Meja {{ $meja->nomor_meja }}</p>
                    </div>
                </div>

                <!-- Payment Methods -->
                <form method="POST" action="{{ route('reservasi.payment') }}" class="space-y-4">
                    @csrf

                    <!-- Transfer Bank -->
                    <div class="border-2 border-gray-200 rounded-lg p-4 sm:p-6 hover:border-blue-600 hover:bg-blue-50 transition cursor-pointer payment-option" data-value="transfer_bank">
                        <label class="flex items-center space-x-4 cursor-pointer">
                            <input type="radio" name="payment_method" value="transfer_bank" class="w-5 h-5 text-blue-600 payment-radio" required>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">💳 Transfer Bank</p>
                                <p class="text-sm text-gray-600">Transfer langsung ke rekening NUGI BALI</p>
                                <p class="text-xs text-gray-500 mt-1">Konfirmasi pembayaran: hingga 1 jam</p>
                            </div>
                        </label>
                    </div>

                    <!-- Credit/Debit Card -->
                    <div class="border-2 border-gray-200 rounded-lg p-4 sm:p-6 hover:border-blue-600 hover:bg-blue-50 transition cursor-pointer payment-option" data-value="card">
                        <label class="flex items-center space-x-4 cursor-pointer">
                            <input type="radio" name="payment_method" value="card" class="w-5 h-5 text-blue-600 payment-radio" required>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">💰 Kartu Kredit/Debit</p>
                                <p class="text-sm text-gray-600">Visa, MasterCard, atau debit card lainnya</p>
                                <p class="text-xs text-gray-500 mt-1">Konfirmasi pembayaran: instant</p>
                            </div>
                        </label>
                    </div>

                    <!-- E-Wallet -->
                    <div class="border-2 border-gray-200 rounded-lg p-4 sm:p-6 hover:border-blue-600 hover:bg-blue-50 transition cursor-pointer payment-option" data-value="ewallet">
                        <label class="flex items-center space-x-4 cursor-pointer">
                            <input type="radio" name="payment_method" value="ewallet" class="w-5 h-5 text-blue-600 payment-radio" required>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">📱 E-Wallet</p>
                                <p class="text-sm text-gray-600">GCash, OVO, DANA, atau e-wallet lainnya</p>
                                <p class="text-xs text-gray-500 mt-1">Konfirmasi pembayaran: instant</p>
                            </div>
                        </label>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4">
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input type="checkbox" name="terms_accepted" class="w-5 h-5 text-blue-600 mt-1" required>
                            <div>
                                <p class="text-sm text-yellow-800">
                                    Saya setuju dengan <strong>Syarat & Ketentuan Pembayaran</strong> dan <strong>Kebijakan Privasi</strong> NUGI BALI. Saya juga memahami bahwa pembayaran ini adalah final dan tidak dapat dikembalikan.
                                </p>
                            </div>
                        </label>
                        @error('terms_accepted')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('reservasi.step3') }}" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-100 transition text-center">
                            Kembali
                        </a>
                        <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-lg font-semibold hover:shadow-lg transition disabled:opacity-50 disabled:cursor-not-allowed" id="submitBtn" disabled>
                            Lanjutkan Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.partials.footer')

    <script>
        // Enable/disable submit button based on checkbox
        const termsCheckbox = document.querySelector('input[name="terms_accepted"]');
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-base font-bold mb-3 uppercase tracking-wider text-white">NUGI BALI</h3>
                    <p class="text-blue-100/80 text-xs leading-relaxed">{{ $footerInfo?->profil ?? 'Coffee shop terbaik dengan pelayanan prima.' }}</p>
                </div>
                <div>
                    <h3 class="text-base font-bold mb-3 uppercase tracking-wider text-white">Menu</h3>
                    <ul class="space-y-2 text-blue-100/80 text-xs">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('menu') }}" class="hover:text-white transition">Menu</a></li>
                        <li><a href="{{ route('tentang') }}" class="hover:text-white transition">Tentang</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-base font-bold mb-3 uppercase tracking-wider text-white">Kontak</h3>
                    <ul class="space-y-2 text-blue-100/80 text-xs">
                        <li class="flex items-center gap-2">📧 {{ $footerInfo?->kontak_email ?? 'info@nugibali.com' }}</li>
                        <li class="flex items-center gap-2">📞 {{ $footerInfo?->kontak_telepon ?? '+62 812-3456-7890' }}</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-base font-bold mb-3 uppercase tracking-wider text-white">Slogan</h3>
                    <p class="text-blue-100/80 text-xs italic">Space . Moment . Togetherness</p>
                </div>
            </div>
            <div class="border-t border-blue-800/60 mt-8 pt-6 text-center text-blue-200/60 text-xs">
                <p>&copy; 2026 NUGI BALI. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Enable/disable submit button based on checkbox
        const termsCheckbox = document.querySelector('input[name="terms_accepted"]');
        const submitBtn = document.getElementById('submitBtn');
        
        function updateSubmitButton() {
            const hasMethod = document.querySelector('input[name="payment_method"]:checked');
            submitBtn.disabled = !(termsCheckbox.checked && hasMethod);
        }

        termsCheckbox.addEventListener('change', updateSubmitButton);
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', updateSubmitButton);
        });

        // Highlight selected payment option
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.payment-option').forEach(o => {
                    o.classList.remove('border-blue-600', 'bg-blue-50');
                    o.classList.add('border-gray-200');
                });
                this.classList.add('border-blue-600', 'bg-blue-50');
                this.classList.remove('border-gray-200');
                
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
                updateSubmitButton();
            });
        });
    </script>
</body>
</html>
