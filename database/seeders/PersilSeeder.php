<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        $wargaIds = DB::table('warga')->pluck('warga_id');
        $penggunaanIds = DB::table('jenis_penggunaan')->pluck('jenis_id');

        for ($i = 1; $i <= 150; $i++) {
            DB::table('persil')->insert([
                'kode_persil' => 'PRS-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'pemilik_warga_id' => $faker->randomElement($wargaIds),
                'penggunaan_id' => $faker->randomElement($penggunaanIds),
                'luas_m2' => $faker->numberBetween(100, 5000),
                'alamat_lahan' => $faker->streetAddress(),
                'rt' => '01',
                'rw' => '02',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
