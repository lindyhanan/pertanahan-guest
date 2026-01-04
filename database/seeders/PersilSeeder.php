<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersilSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $wargaIds = DB::table('warga')->pluck('warga_id')->toArray();
        $penggunaanIds = DB::table('penggunaan')->pluck('jenis_id')->toArray();

        if (empty($wargaIds)) {
            $this->command->error('Seeder gagal: tabel warga kosong');
            return;
        }

        if (empty($penggunaanIds)) {
            $this->command->error('Seeder gagal: tabel penggunaan kosong');
            return;
        }

        for ($i = 1; $i <= 100; $i++) {
            DB::table('persil')->insert([
    'kode_persil'      => 'P' . str_pad($i, 3, '0', STR_PAD_LEFT),
    'pemilik_warga_id' => $faker->randomElement($wargaIds),
    'penggunaan_id'    => $faker->randomElement($penggunaanIds), // ✅ FIX
    'luas_m2'          => $faker->randomFloat(2, 100, 5000),
    'alamat_lahan'     => $faker->streetAddress,
    'rt'               => str_pad($faker->numberBetween(1, 20), 3, '0', STR_PAD_LEFT),
    'rw'               => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
    'created_at'       => now(),
    'updated_at'       => now(),
]);

        }

        $this->command->info('Seeder Persil berhasil (100 data)');
    }
}
