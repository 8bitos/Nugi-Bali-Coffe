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

## Jalankan Dengan Docker

Kalau project ini dibuka di laptop lain, cukup pastikan Docker Desktop sudah terpasang, lalu jalankan langkah di bawah dari folder project.

### Pertama Kali

1. Siapkan file environment.

Kalau file `.env` belum ada, salin dari `.env.example`.

```bash
copy .env.example .env
```

Kalau `.env` sudah ada, langsung lanjut ke langkah berikutnya.

2. Build dan jalankan semua service.

```bash
docker compose up -d --build
```

3. Generate application key.

```bash
docker compose exec app php artisan key:generate
```

4. Jalankan migrasi dan isi data awal.

```bash
docker compose exec app php artisan migrate --seed
```

5. Buka aplikasi.

- Website: http://localhost:8000
- Vite dev server: http://localhost:5173

### Kalau Mau Menjalankan Lagi di Lain Waktu

Kalau container sudah pernah dibuat sebelumnya, biasanya cukup jalankan:

```bash
docker compose up -d
```

Kalau mau berhenti:

```bash
docker compose down
```

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
```bash
npm run dev
```

## Akses Sistem

- Website publik: halaman utama, menu, galeri, lokasi, reservasi
- Admin: login admin untuk mengelola data sistem

## Catatan

Seeder dibiarkan apa adanya untuk kebutuhan data contoh dan pengujian awal.