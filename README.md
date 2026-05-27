# Nugi Bali

Website reservasi dan informasi untuk Nugi Bali, sebuah coffee shop/restoran yang menampilkan menu, galeri, lokasi, informasi usaha, dan alur reservasi online.

## Tentang Sistem

Sistem ini dibuat untuk memudahkan pelanggan melihat informasi usaha, memilih meja, melakukan reservasi, lalu menerima konfirmasi dan invoice. Admin juga bisa mengelola data menu, galeri, meja, reservasi, dan informasi web dari dashboard.

## Fitur Utama

- Halaman beranda, menu, galeri, lokasi, dan tentang
- Reservasi online bertahap sampai sukses
- Invoice/konfirmasi reservasi siap cetak
- Login pelanggan dan login admin
- Dashboard admin untuk kelola data
- CRUD menu, galeri, meja, dan informasi web
- Desain responsif dengan Tailwind CSS

## Teknologi

- Laravel
- Blade
- MySQL / database relasional
- Tailwind CSS
- Vite

## Instalasi

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
```

## Menjalankan Aplikasi

```bash
php artisan serve
```

Jika menggunakan Vite saat development:

```bash
npm run dev
```

## Akses Sistem

- Website publik: halaman utama, menu, galeri, lokasi, reservasi
- Admin: login admin untuk mengelola data sistem

## Catatan

Seeder dibiarkan apa adanya untuk kebutuhan data contoh dan pengujian awal.