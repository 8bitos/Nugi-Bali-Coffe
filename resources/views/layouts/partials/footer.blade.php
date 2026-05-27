@php
    $footerData = $footerInfo ?? $info ?? \App\Models\InformasiWeb::first();
    $instagramUrl = $footerData?->instagram_url ?: 'https://www.instagram.com/nugibali';
@endphp

<footer class="bg-gradient-to-r from-blue-900 to-cyan-900 text-white mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">{{ $footerData?->nama_web ?: 'NUGI BALI' }}</h3>
                <p class="text-blue-100 text-sm leading-relaxed">{{ $footerData?->profil ?? 'Coffee shop terbaik dengan pelayanan prima.' }}</p>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-4">Menu</h3>
                <ul class="space-y-2 text-blue-100 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('menu') }}" class="hover:text-white transition">Menu</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri</a></li>
                    <li><a href="{{ route('tentang') }}" class="hover:text-white transition">Tentang</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-4">Kontak</h3>
                <ul class="space-y-2 text-blue-100 text-sm">
                    <li>📧 {{ $footerData?->kontak_email ?? 'info@nugibali.com' }}</li>
                    <li>📞 {{ $footerData?->kontak_telepon ?? '+62 812-3456-7890' }}</li>
                    <li>📍 {{ $footerData?->alamat ? \Illuminate\Support\Str::limit($footerData->alamat, 40) : 'Bali' }}</li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-4">Ikuti Kami</h3>
                <div class="flex space-x-4">
                    <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-blue-100 hover:text-cyan-300 transition" title="Instagram">
                        <svg class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2Zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5a4.25 4.25 0 0 0 4.25 4.25h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5a4.25 4.25 0 0 0-4.25-4.25h-8.5Zm9.75 1.75a.75.75 0 1 1 0 1.5.75.75 0 0 1 0-1.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 1.5A3.5 3.5 0 1 0 12 16a3.5 3.5 0 0 0 0-7Z"/>
                        </svg>
                        <span class="font-medium">@nugibali</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-blue-800 mt-8 pt-8 text-center text-blue-200 text-sm">
            <p>&copy; 2026 {{ $footerData?->nama_web ?: 'NUGI BALI' }}. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>