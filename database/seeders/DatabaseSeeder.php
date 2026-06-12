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
        User::updateOrCreate([
            'email' => 'admin@nugi.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Create sample pelanggan users
        User::updateOrCreate([
            'email' => 'pelanggan@example.com',
        ], [
            'name' => 'Pelanggan Test',
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

        // Create real system menus
        \DB::table('menu')->truncate();

        $menus = [
            ['nama_menu' => 'ESPRESSO', 'kategori' => 'Coffee', 'harga' => 20000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'PICCOLO', 'kategori' => 'Coffee', 'harga' => 25000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'MAGIC', 'kategori' => 'Coffee', 'harga' => 28000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'CAFÉ LATTE', 'kategori' => 'Coffee', 'harga' => 28000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'CAFÉ MOCHA', 'kategori' => 'Coffee', 'harga' => 30000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'LONGBLACK', 'kategori' => 'Coffee', 'harga' => 23000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'MACCHIATO', 'kategori' => 'Coffee', 'harga' => 25000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'CAPPUCINNO', 'kategori' => 'Coffee', 'harga' => 28000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'FLATWHITE', 'kategori' => 'Coffee', 'harga' => 28000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'AFFOGATO', 'kategori' => 'Coffee', 'harga' => 28000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'MATCHA', 'kategori' => 'Non Coffee', 'harga' => 25000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'CHOCOLATE', 'kategori' => 'Non Coffee', 'harga' => 25000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'NUTELLA', 'kategori' => 'Non Coffee', 'harga' => 28000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'HAZELNUT CHOCOLATE', 'kategori' => 'Non Coffee', 'harga' => 28000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'BUTTERSCOTCH', 'kategori' => 'Non Coffee', 'harga' => 25000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'NUGI ICED SHAKEN COFFEE', 'kategori' => 'Signature', 'harga' => 33000, 'deskripsi' => 'Espresso, freshmilk, ice cream, hazelnut, choco', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'BUTTERSCOTCH COFFEE CREAM', 'kategori' => 'Signature', 'harga' => 32000, 'deskripsi' => 'Coffee cream with butterscotch and caramel sauce', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'REFRESHOT', 'kategori' => 'Signature', 'harga' => 30000, 'deskripsi' => 'Foamy espresso, lime and honey', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'CHUCK BERRY', 'kategori' => 'Signature', 'harga' => 30000, 'deskripsi' => 'Shaken espresso with home made strawberry puree', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'BREEZY AMERICANO', 'kategori' => 'Signature', 'harga' => 30000, 'deskripsi' => 'Layered espresso, based with honey and lemon', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'HIGH IN THE CLOUD SERIES', 'kategori' => 'Signature', 'harga' => 33000, 'deskripsi' => '*Matcha, Coffee Cream, Strawberry / Creamy cloudy matcha with coconut water', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'CLOUDY BERRY', 'kategori' => 'Signature', 'harga' => 30000, 'deskripsi' => 'Homemade strawberry puree with creamy milk', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'NUGI HAZELNUT CHOCO MILK TEA', 'kategori' => 'Signature', 'harga' => 28000, 'deskripsi' => 'Tea, condense milk, chocolate and hazelnut', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'VANILLA', 'kategori' => 'Milkshake', 'harga' => 30000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'MATCHA', 'kategori' => 'Milkshake', 'harga' => 30000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'NUTELLA', 'kategori' => 'Milkshake', 'harga' => 30000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'BANANA NUTELLA', 'kategori' => 'Milkshake', 'harga' => 30000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'BANANA PEANUT BUTTER', 'kategori' => 'Milkshake', 'harga' => 30000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'BLACK TEA', 'kategori' => 'Tea', 'harga' => 15000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'LEMON TEA', 'kategori' => 'Tea', 'harga' => 20000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'LYCHEE TEA', 'kategori' => 'Tea', 'harga' => 25000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'PEACH TEA', 'kategori' => 'Tea', 'harga' => 20000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'ROSELLA TEA', 'kategori' => 'Tea', 'harga' => 20000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'FRUIT PUNCH', 'kategori' => 'Fizzy Breeze', 'harga' => 20000, 'deskripsi' => 'Glass / Bottle (20K / 50K)', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'LEMON HONEY', 'kategori' => 'Fizzy Breeze', 'harga' => 20000, 'deskripsi' => 'Glass / Bottle (20K / 50K)', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'LEMONGRASS', 'kategori' => 'Fizzy Breeze', 'harga' => 20000, 'deskripsi' => 'Glass / Bottle (20K / 50K)', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'PEACH', 'kategori' => 'Fizzy Breeze', 'harga' => 20000, 'deskripsi' => 'Glass / Bottle (20K / 50K)', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'PASSION', 'kategori' => 'Fizzy Breeze', 'harga' => 20000, 'deskripsi' => 'Glass / Bottle (20K / 50K)', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'BERRY GOOD', 'kategori' => 'Smoothies', 'harga' => 30000, 'deskripsi' => 'Mix berries, banana, yoghurt, honey', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'BANABERRY', 'kategori' => 'Smoothies', 'harga' => 30000, 'deskripsi' => 'Banana, strawberry, yoghurt, honey', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'MANGO DISCO', 'kategori' => 'Smoothies', 'harga' => 30000, 'deskripsi' => 'Mango, pineapple, lemon, mint, honey', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'FAT BURNER', 'kategori' => 'Smoothies', 'harga' => 30000, 'deskripsi' => 'Spinach, banana, cucumber, lemon honey', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'YELLOW DETOX', 'kategori' => 'Smoothies', 'harga' => 30000, 'deskripsi' => 'Mango, banana, pineapple, orange, lemon, ginger, honey', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'Additional Syrup / juice', 'kategori' => 'Additional (Drinks)', 'harga' => 5000, 'deskripsi' => 'Caramel, vanilla, hazelnut, butterscotch, mint, orange, ice cream', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'Additional sauce', 'kategori' => 'Additional (Drinks)', 'harga' => 5000, 'deskripsi' => 'Caramel', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'Milk Alternative', 'kategori' => 'Additional (Drinks)', 'harga' => 8000, 'deskripsi' => 'Oatmilk', 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'CHICKEN TERIYAKI', 'kategori' => 'Rice Bowl', 'harga' => 25000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'CHICKEN KATSU', 'kategori' => 'Rice Bowl', 'harga' => 35000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'AYAM CABAI GARAM', 'kategori' => 'Rice Bowl', 'harga' => 28000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'AYAM GORENG MENTEGA', 'kategori' => 'Rice Bowl', 'harga' => 28000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'NASI GORENG NUGI', 'kategori' => 'Rice Bowl', 'harga' => 25000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'FRENCH FRIES', 'kategori' => 'Munchies', 'harga' => 20000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'NUGI MIX PLATER', 'kategori' => 'Munchies', 'harga' => 28000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'CHICKEN POPCORN', 'kategori' => 'Munchies', 'harga' => 23000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'CHICKEN POPCORN HONEY GARLIC', 'kategori' => 'Munchies', 'harga' => 25000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'VEGGIE SPRING ROLLS', 'kategori' => 'Munchies', 'harga' => 16000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'CHICKEN SPRING ROLLS', 'kategori' => 'Munchies', 'harga' => 20000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'PISANG GORENG NUGI', 'kategori' => 'Munchies', 'harga' => 15000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'NUGI BEEF BURGER', 'kategori' => 'Nugi Burger', 'harga' => 45000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'NUGI CHICKEN BURGER', 'kategori' => 'Nugi Burger', 'harga' => 35000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'NUGI HOTDOG', 'kategori' => 'Hotdog', 'harga' => 38000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'HOTDOG CLASSIC', 'kategori' => 'Hotdog', 'harga' => 40000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'GUACAMOLE HOTDOG', 'kategori' => 'Hotdog', 'harga' => 40000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'NUGI CHICKEN SALAD', 'kategori' => 'Salad', 'harga' => 40000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'NUGI BACON SALAD', 'kategori' => 'Salad', 'harga' => 40000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'CHOCOLATE', 'kategori' => 'Toast', 'harga' => 20000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'NUTELLA', 'kategori' => 'Toast', 'harga' => 25000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'TUNA MAYO', 'kategori' => 'Toast', 'harga' => 40000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'NUGI AVOTOAST', 'kategori' => 'Toast', 'harga' => 35000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],

            ['nama_menu' => 'Bacon', 'kategori' => 'Additional (Food)', 'harga' => 8000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'Egg', 'kategori' => 'Additional (Food)', 'harga' => 5000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'Cheese', 'kategori' => 'Additional (Food)', 'harga' => 5000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'Fries', 'kategori' => 'Additional (Food)', 'harga' => 10000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'Patty', 'kategori' => 'Additional (Food)', 'harga' => 15000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nama_menu' => 'Mix romaine and Ice berg', 'kategori' => 'Additional (Food)', 'harga' => 5000, 'deskripsi' => null, 'foto' => null, 'created_at' => now(), 'updated_at' => now()],
        ];

        \DB::table('menu')->insert($menus);

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
