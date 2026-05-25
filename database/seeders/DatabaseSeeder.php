<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use App\Models\Galeri;
use App\Models\Meja;
use App\Models\InformasiWeb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@nugi.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Create sample pelanggan users
        User::create([
            'name' => 'Pelanggan Test',
            'email' => 'pelanggan@example.com',
            'password' => Hash::make('password123'),
            'role' => 'pelanggan',
        ]);

        // Create informasi web
        InformasiWeb::create([
            'nama_web' => 'Nugi Bali',
            'profil' => 'Nugi Bali adalah coffee shop yang menyediakan berbagai macam menu makanan dan minuman berkualitas dengan suasana yang nyaman.',
            'kontak_email' => 'info@nugibali.com',
            'kontak_telepon' => '+62 812-3456-7890',
            'alamat' => 'Jl. Example No. 123, Bali, Indonesia',
            'lokasi_url' => 'https://maps.google.com',
        ]);

        // Create sample menus
        \DB::table('menu')->insert([
            'nama_menu' => 'Espresso',
            'kategori' => 'Minuman',
            'harga' => 25000,
            'deskripsi' => 'Kopi espresso premium',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('menu')->insert([
            'nama_menu' => 'Cappuccino',
            'kategori' => 'Minuman',
            'harga' => 35000,
            'deskripsi' => 'Cappuccino dengan busa susu yang lembut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('menu')->insert([
            'nama_menu' => 'Nasi Goreng',
            'kategori' => 'Makanan',
            'harga' => 45000,
            'deskripsi' => 'Nasi goreng dengan telur dan ayam',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create sample meja
        \DB::table('meja')->insert([
            'nomor_meja' => 'Meja 1',
            'kapasitas' => 2,
            'status' => 'tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('meja')->insert([
            'nomor_meja' => 'Meja 2',
            'kapasitas' => 4,
            'status' => 'tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('meja')->insert([
            'nomor_meja' => 'Meja 3',
            'kapasitas' => 6,
            'status' => 'tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create sample galeri
        \DB::table('galeri')->insert([
            'judul' => 'Interior Coffee Shop',
            'foto' => 'galeri/interior.jpg',
            'deskripsi' => 'Pemandangan interior coffee shop kami yang nyaman',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('galeri')->insert([
            'judul' => 'Menu Favorit',
            'foto' => 'galeri/menu.jpg',
            'deskripsi' => 'Salah satu menu favorit pelanggan kami',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
