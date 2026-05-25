<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservasi Berhasil - Nugi Bali</title>
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
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-slate-700 hover:text-blue-600 transition">Beranda</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-slate-700 hover:text-blue-600 transition">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 sm:px-8 py-12 sm:py-16 text-white text-center">
                <div class="flex justify-center mb-6">
                    <svg class="w-16 h-16 sm:w-20 sm:h-20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold mb-2">Reservasi Berhasil!</h1>
                <p class="text-green-100 text-lg">Terima kasih telah melakukan reservasi</p>
            </div>

            <div class="p-6 sm:p-8 space-y-8">
                <!-- Success Message -->
                <div class="bg-green-50 border border-green-300 rounded-lg p-4 sm:p-6">
                    <p class="text-green-800 text-sm sm:text-base">
                        Reservasi Anda telah berhasil dibuat dan <strong>pembayaran telah dikonfirmasi</strong>. Anda dapat langsung datang sesuai jadwal yang telah ditentukan. Terima kasih telah mempercayai NUGI BALI!
                    </p>
                </div>

                <!-- Booking Details -->
                <div class="border-b pb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Detail Reservasi</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-600 text-sm">Kode Booking</p>
                                <p class="font-bold text-lg text-blue-600">{{ str_pad($reservasi->id, 8, '0', STR_PAD_LEFT) }}</p>
                            </div>
                    <div>
                        <p class="text-gray-600 text-sm mb-2">Status</p>
                        <p class="font-semibold">
                            <span class="inline-flex items-center px-4 py-1 rounded-full text-white bg-green-500 text-sm shadow-sm">Disetujui</span>
                        </p>
                    </div>
                            <div>
                                <p class="text-gray-600 text-sm">Tanggal Reservasi</p>
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d F Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Waktu</p>
                                <p class="font-semibold">{{ $reservasi->jam_reservasi }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Jumlah Orang</p>
                                <p class="font-semibold">{{ $reservasi->jumlah_orang }} orang</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Meja</p>
                                <p class="font-semibold">Meja {{ $meja->nomor_meja }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Details -->
                <div class="border-b pb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Data Pemesan</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-600 text-sm">Nama</p>
                            <p class="font-semibold">{{ $reservasi->nama_pemesan }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Nomor Telepon</p>
                            <p class="font-semibold">{{ $reservasi->kontak_pemesan }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Email</p>
                            <p class="font-semibold">{{ $reservasi->user->email }}</p>
                        </div>
                        @if($reservasi->catatan)
                        <div>
                            <p class="text-gray-600 text-sm">Catatan</p>
                            <p class="font-semibold">{{ $reservasi->catatan }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Total Cost -->
                <div class="bg-blue-50 rounded-lg p-4 sm:p-6 border border-blue-200">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-gray-800">Total Biaya:</span>
                        <span class="text-3xl font-bold text-blue-600">Rp {{ number_format($meja->harga ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Important Info -->
                <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4 sm:p-6">
                    <h3 class="font-semibold text-yellow-800 mb-2">📋 Informasi Penting</h3>
                    <ul class="space-y-2 text-sm text-yellow-800">
                        <li>✓ Admin akan menghubungi Anda melalui telepon yang tercatat</li>
                        <li>✓ Simpan Kode Booking Anda untuk referensi</li>
                        <li>✓ Harap tiba 10 menit sebelum waktu yang dijadwalkan</li>
                        <li>✓ Jika ingin membatalkan, hubungi kami sebelum 24 jam</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('home') }}" class="flex-1 px-6 py-3 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition text-center">
                        Kembali ke Beranda
                    </a>
                    <a href="javascript:window.print()" class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-center">
                        Cetak Konfirmasi
                    </a>
                </div>
            </div>
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
</body>
</html>
