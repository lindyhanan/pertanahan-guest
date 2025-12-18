<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PersilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua ID warga dan penggunaan
        $wargaIds = DB::table('warga')->pluck('warga_id')->toArray();
        $penggunaanIds = DB::table('penggunaan')->pluck('jenis_id')->toArray(); // pastikan tabel penggunaan benar

        // Cek kalau kosong, jangan lanjut
        if (empty($wargaIds) || empty($penggunaanIds)) {
            $this->command->error('Seeder gagal: Pastikan tabel warga dan penggunaan sudah diisi!');
            return;
        }

        for ($i = 1; $i <= 100; $i++) {
            DB::table('persil')->insert([
                'kode_persil'      => 'PERSIL-' . strtoupper($faker->bothify('??##??')),
                'pemilik_warga_id' => $faker->randomElement($wargaIds),
                'luas_m2'          => $faker->randomFloat(2, 100, 5000),
                'penggunaan_id'    => $faker->randomElement($penggunaanIds),
                'alamat_lahan'     => $faker->streetAddress,
                'rt'               => str_pad($faker->numberBetween(1, 20), 3, '0', STR_PAD_LEFT),
                'rw'               => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}
