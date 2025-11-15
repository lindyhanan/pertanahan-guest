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
        DB::table('persil')->insert([
            [
                'kode_persil' => 'PRS-001',
                'pemilik_warga_id' => 1,
                'luas_m2' => 250.5,
                'penggunaan' => 'Lahan Pertanian',
                'alamat_lahan' => 'Jalan Melati No. 5',
                'rt' => '01',
                'rw' => '02',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
