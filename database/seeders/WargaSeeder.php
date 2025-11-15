<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('warga')->insert([
            [
                'warga_id'   => 1,
                'nik'        => '3174010101010001',
                'nama'       => 'Budi Santoso',
                'alamat'     => 'Jalan Mawar No. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'warga_id'   => 2,
                'nik'        => '3174010101020002',
                'nama'       => 'Siti Aminah',
                'alamat'     => 'Jalan Melati No. 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'warga_id'   => 3,
                'nik'        => '3174010101030003',
                'nama'       => 'Ahmad Fauzi',
                'alamat'     => 'Jalan Kenanga No. 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'warga_id'   => 4,
                'nik'        => '3174010101040004',
                'nama'       => 'Rina Wijaya',
                'alamat'     => 'Jalan Anggrek No. 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
