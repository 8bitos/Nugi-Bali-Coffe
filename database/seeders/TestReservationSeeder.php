<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestReservationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservasi')->insert([
            'user_id' => 2,
            'meja_id' => 1,
            'nama_pemesan' => 'Pelanggan Test',
            'kontak_pemesan' => '081234567890',
            'tanggal_reservasi' => Carbon::now()->addDay(),
            'jam_reservasi' => '18:00',
            'jumlah_orang' => 4,
            'status' => 'approved',
            'catatan' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        echo "Test reservation created!\n";
    }
}
