<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservasi - Step 3 - Nugi Bali</title>
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
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">3</div>
                    <p class="text-xs sm:text-sm font-semibold mt-2 text-center">Konfirmasi</p>
                </div>
            </div>
        </div>

        <!-- Confirmation Page -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-6 sm:px-8 py-8 sm:py-12 text-white">
                <h1 class="text-3xl sm:text-4xl font-bold">Konfirmasi Reservasi</h1>
                <p class="text-blue-100 mt-2">Langkah 3 dari 3 - Periksa kembali data Anda</p>
            </div>

            <div class="p-6 sm:p-8 space-y-8">
                <!-- Ringkasan Reservasi -->
                <div class="border-b pb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Reservasi</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600">Tanggal</p>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($reservasi['tanggal_reservasi'])->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Jam Mulai</p>
                            <p class="font-semibold">{{ $reservasi['jam_mulai'] }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Jumlah Orang</p>
                            <p class="font-semibold">{{ $reservasi['jumlah_orang'] }} orang</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Meja</p>
                            <p class="font-semibold">Meja {{ $meja->nomor_meja }} ({{ $meja->kapasitas }} kapasitas)</p>
                        </div>
                    </div>
                </div>

                <!-- Data Pemesan -->
                <div class="border-b pb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Data Pemesan</h2>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-gray-600">Nama</p>
                            <p class="font-semibold">{{ $reservasi['nama_pemesan'] }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Email</p>
                            <p class="font-semibold">{{ Auth::user()->email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Nomor Telepon</p>
                            <p class="font-semibold">
                                @php
                                    $countryFlags = ['ID' => '🇮🇩', 'MY' => '🇲🇾', 'SG' => '🇸🇬', 'TH' => '🇹🇭', 'PH' => '🇵🇭'];
                                    $flag = $countryFlags[$reservasi['country_code'] ?? 'ID'] ?? '🌍';
                                @endphp
                                {{ $flag }} {{ $reservasi['kontak_pemesan'] }}
                            </p>
                        </div>
                        @if($reservasi['catatan'])
                        <div>
                            <p class="text-gray-600">Catatan</p>
                            <p class="font-semibold">{{ $reservasi['catatan'] }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Total Biaya -->
                <div class="bg-blue-50 rounded-lg p-4 sm:p-6 border border-blue-200">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-gray-800">Total Biaya Reservasi:</span>
                        <span class="text-3xl font-bold text-blue-600">Rp {{ number_format($meja->harga ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Important Note -->
                <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4">
                    <p class="text-sm text-yellow-800">
                        <strong>⚠️ Perhatian:</strong> Dengan mengklik tombol "Konfirmasi", Anda menyetujui syarat dan ketentuan reservasi kami. 
                        Admin akan menghubungi Anda untuk konfirmasi lebih lanjut.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('reservasi.step2') }}" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-100 transition text-center">
                        Kembali
                    </a>
                    <form method="POST" action="{{ route('reservasi.step4') }}" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                            Lanjut ke Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.partials.footer')
</body>
</html>
