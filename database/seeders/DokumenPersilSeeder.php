<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DokumenPersilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $persil = DB::table('persil')->first(); // ambil persil pertama

        DB::table('dokumen_persil')->insert([
            'persil_id' => $persil->persil_id,
            'jenis_dokumen' => 'Sertifikat Tanah',
            'nomor' => '123/ABC/2024',
            'keterangan' => 'Dokumen asli',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
