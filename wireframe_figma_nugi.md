# Wireframe Figma - Sistem Informasi Reservasi Nugi Bali

Dokumen ini berisi blueprint wireframe yang bisa langsung dipindahkan ke Figma. Fokusnya adalah struktur layar, urutan komponen, dan isi utama tiap frame, bukan visual detail.

## 1. Arah Desain

- Tema: clean, modern, restaurant/cafe reservation
- Gaya: wireframe low-fidelity dengan kotak abu-abu, teks hitam, dan garis sederhana
- Grid: 12 kolom desktop
- Font wireframe: default sans-serif
- Ukuran frame Figma yang disarankan:
  - Desktop: 1440 x 1024

Catatan: seluruh wireframe di dokumen ini difokuskan untuk format desktop saja.

## 2. Struktur Halaman Utama

### 2.1 Komponen Umum

- Top navbar
- Hero section
- Section informasi / konten
- Footer
- Tombol utama CTA
- Komponen kartu untuk menu, galeri, dan reservasi

### 2.2 Navigasi Umum

- Beranda
- Menu
- Galeri
- Tentang
- Lokasi
- Reservasi
- Login
- Register
- Admin Login

## 3. Daftar Frame Figma

### A. Public Pages

#### Frame 1 - Beranda / Landing Page

Tujuan: memperkenalkan Nugi Bali dan mengarahkan user ke reservasi.

Susunan wireframe:
- Header / navbar
- Hero kiri: judul, deskripsi singkat, tombol reservasi
- Hero kanan: gambar utama / slider
- Section singkat keunggulan / highlight
- Section menu unggulan
- Section galeri singkat
- Section lokasi / peta singkat
- Footer

Wireframe kasar:

```text
--------------------------------------------------------------
| NAVBAR: Logo | Beranda | Menu | Galeri | Tentang | Login   |
--------------------------------------------------------------
| HERO LEFT                 | HERO RIGHT / IMAGE SLIDER      |
| Judul besar               | [ Gambar / Carousel ]          |
| Deskripsi singkat         |                                |
| [Tombol Reservasi]        |                                |
--------------------------------------------------------------
| Highlight 1 | Highlight 2 | Highlight 3                    |
--------------------------------------------------------------
| Menu Unggulan: [Card][Card][Card][Card]                   |
--------------------------------------------------------------
| Galeri Singkat: [Thumb][Thumb][Thumb][Thumb]              |
--------------------------------------------------------------
| Lokasi / CTA Reservasi                                     |
--------------------------------------------------------------
| FOOTER                                                     |
--------------------------------------------------------------
```

#### Frame 2 - Menu

Tujuan: menampilkan daftar menu makanan dan minuman.

Susunan wireframe:
- Navbar
- Judul halaman
- Filter kategori
- Grid kartu menu
- Footer

Isi kartu menu:
- Foto menu
- Nama menu
- Kategori
- Harga
- Deskripsi singkat

#### Frame 3 - Galeri

Tujuan: menampilkan foto suasana dan aktivitas Nugi Bali.

Susunan wireframe:
- Navbar
- Judul halaman
- Grid galeri 3 atau 4 kolom
- Modal preview image
- Footer

#### Frame 4 - Tentang

Tujuan: menampilkan profil singkat bisnis.

Susunan wireframe:
- Navbar
- Hero kecil / judul
- Profil singkat
- Visi misi / deskripsi
- Foto profil usaha
- Footer

#### Frame 5 - Lokasi

Tujuan: menampilkan alamat dan kontak.

Susunan wireframe:
- Navbar
- Judul halaman
- Alamat
- Kontak telepon / email
- Embed peta
- Jam operasional
- Footer

## 4. Auth Pages

#### Frame 6 - Login Pelanggan

Susunan wireframe:
- Logo / brand
- Judul login
- Input email / username
- Input password
- Checkbox remember me
- Tombol login
- Link register
- Link login admin

#### Frame 7 - Register Pelanggan

Susunan wireframe:
- Logo / brand
- Nama lengkap
- Email
- Password
- Konfirmasi password
- Nomor telepon
- Tombol register
- Link login

#### Frame 8 - Login Admin

Susunan wireframe:
- Logo / brand
- Judul admin login
- Username / email
- Password
- Tombol login
- Link ke login pelanggan

## 5. Reservasi Pelanggan

Sistem reservasi dibuat bertahap, jadi wireframe sebaiknya dipisah menjadi beberapa frame.

#### Frame 9 - Reservasi Step 1: Pilih Meja dan Jadwal

Isi:
- Progress step 1 dari 4
- Daftar meja tersedia
- Detail meja: nomor, kapasitas, harga, status
- Input tanggal reservasi
- Input jam reservasi
- Input jumlah orang
- Tombol lanjut

#### Frame 10 - Reservasi Step 2: Data Pemesan

Isi:
- Progress step 2 dari 4
- Nama pemesan
- Negara / kode telepon
- Nomor kontak
- Catatan tambahan
- Tombol kembali
- Tombol lanjut

#### Frame 11 - Reservasi Step 3: Konfirmasi Data

Isi:
- Progress step 3 dari 4
- Ringkasan data reservasi
- Detail meja
- Detail tanggal dan jam
- Detail pemesan
- Tombol edit / kembali
- Tombol lanjut

#### Frame 12 - Reservasi Step 4: Pembayaran

Isi:
- Progress step 4 dari 4
- Ringkasan total
- Pilihan metode pembayaran
- Checkbox persetujuan syarat
- Tombol bayar / submit

#### Frame 13 - Success / Konfirmasi Berhasil

Isi:
- Ikon sukses
- Nomor reservasi
- Status reservasi
- Ringkasan data
- Tombol cetak konfirmasi
- Tombol kembali ke dashboard / beranda

#### Frame 14 - Invoice / Bukti Reservasi

Isi:
- Header invoice
- Data pelanggan
- Data reservasi
- Detail meja
- Status pembayaran
- Referensi / kode invoice
- Tombol print

## 6. Dashboard Pelanggan

#### Frame 15 - Dashboard Pelanggan

Isi:
- Sidebar / navbar pelanggan
- Kartu ringkasan:
  - total reservasi
  - reservasi aktif
  - reservasi selesai
  - reservasi dibatalkan
- Daftar reservasi terbaru
- Tombol ke halaman reservasi

#### Frame 16 - Riwayat Reservasi Pelanggan

Isi:
- Filter status
- Tabel daftar reservasi
- Kolom: kode, meja, tanggal, jam, status, aksi
- Tombol batal reservasi bila masih valid

## 7. Admin Panel

#### Frame 17 - Dashboard Admin

Isi:
- Sidebar admin
- Statistik:
  - total reservasi
  - reservasi pending
  - total menu
  - total meja
  - total galeri
  - total pelanggan
- Grafik reservasi per bulan
- Grafik status reservasi
- Reservasi terbaru

#### Frame 18 - Admin Reservasi

Isi:
- Sidebar admin
- Filter status dan tanggal
- Tabel reservasi
- Detail reservasi
- Tombol approve
- Tombol reject
- Tombol complete
- Tombol export

#### Frame 19 - Admin Menu

Isi:
- Sidebar admin
- Tombol tambah menu
- Pencarian
- Filter kategori
- Tabel / kartu menu
- Aksi edit, hapus, reorder

#### Frame 20 - Admin Galeri

Isi:
- Sidebar admin
- Tombol tambah foto
- Grid galeri
- Aksi edit dan hapus

#### Frame 21 - Admin Meja

Isi:
- Sidebar admin
- Tombol tambah meja
- Tabel meja
- Kolom: nomor, kapasitas, harga, status
- Aksi edit, hapus

#### Frame 22 - Admin Informasi Web

Isi:
- Sidebar admin
- Form nama web
- Profil
- Kontak
- Alamat
- Lokasi URL
- Instagram URL
- Upload logo
- Upload hero image
- Upload tentang image
- Upload lokasi image
- Upload slides landing page

## 8. Komponen Reusable di Figma

Buat komponen berikut agar desain cepat disusun:

- Navbar publik
- Sidebar admin
- Card menu
- Card galeri
- Stat card
- Table row reservasi
- Input field
- Button primary
- Button secondary
- Badge status reservasi
- Progress step indicator
- Empty state card

## 9. Urutan Pembuatan di Figma

1. Buat halaman Figma bernama `Wireframe Nugi Bali`
2. Tambahkan frame desktop utama
3. Buat komponen navbar, sidebar, button, input, dan card
4. Susun frame public pages terlebih dahulu
5. Lanjutkan ke auth dan reservasi bertahap
6. Tambahkan dashboard pelanggan
7. Tambahkan halaman admin
8. Hubungkan antar frame dengan prototyping arrows

## 10. Rekomendasi Flow Prototipe

- Beranda -> Menu -> Reservasi Step 1
- Beranda -> Login -> Dashboard Pelanggan
- Reservasi Step 1 -> Step 2 -> Step 3 -> Step 4 -> Success -> Invoice
- Admin Login -> Dashboard Admin -> Reservasi / Menu / Galeri / Meja / Informasi Web

## 11. Catatan Visual untuk Wireframe

- Gunakan rectangle abu-abu untuk gambar placeholder
- Gunakan garis tipis untuk membedakan section
- Gunakan label sederhana seperti `Image`, `Button`, `Input`, `Card`
- Jangan pakai warna final dulu, fokus ke struktur
- Jika ingin presentasi proposal, urutkan frame sesuai alur pengguna

## 12. Prioritas Frame untuk Proposal

Jika hanya ingin membuat wireframe inti untuk laporan, prioritaskan:

1. Beranda / Landing Page
2. Menu
3. Galeri
4. Lokasi
5. Login / Register
6. Reservasi Step 1-4
7. Success / Invoice
8. Dashboard Admin
9. Reservasi Admin
10. Informasi Web Admin

## 13. Ringkasan Fungsi Sistem

Wireframe ini mencerminkan dua aktor utama:

- Pelanggan: melihat informasi, registrasi, login, melakukan reservasi, melihat riwayat, batal reservasi
- Admin: login, mengelola informasi web, menu, galeri, meja, reservasi, dan laporan

Jika diperlukan, dokumen ini bisa saya turunkan lagi menjadi format yang lebih detail per frame, misalnya untuk desktop, tablet, dan mobile sekaligus.
