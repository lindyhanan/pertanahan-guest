<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaanSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            ['nama_penggunaan' => 'Perumahan',   'keterangan' => 'Lahan untuk rumah tinggal'],
            ['nama_penggunaan' => 'Pertanian',   'keterangan' => 'Lahan untuk kegiatan pertanian'],
            ['nama_penggunaan' => 'Perkebunan',  'keterangan' => 'Lahan untuk perkebunan komersial'],
            ['nama_penggunaan' => 'Perdagangan', 'keterangan' => 'Lahan untuk toko atau ruko'],
            ['nama_penggunaan' => 'Industri',    'keterangan' => 'Lahan untuk kegiatan industri pabrik'],
            ['nama_penggunaan' => 'Pendidikan',  'keterangan' => 'Lahan untuk sekolah dan universitas'],
            ['nama_penggunaan' => 'Kesehatan',   'keterangan' => 'Lahan untuk rumah sakit dan klinik'],
            ['nama_penggunaan' => 'Pariwisata',  'keterangan' => 'Lahan untuk hotel, resort, dan wisata'],
            ['nama_penggunaan' => 'Hutan',       'keterangan' => 'Lahan untuk hutan lindung atau produksi'],
            ['nama_penggunaan' => 'Transportasi','keterangan' => 'Lahan untuk jalan, terminal, atau bandara'],
            ['nama_penggunaan' => 'Perkantoran', 'keterangan' => 'Lahan untuk gedung perkantoran'],
            ['nama_penggunaan' => 'Olahraga',    'keterangan' => 'Lahan untuk stadion atau lapangan olahraga'],
        ];

        foreach ($data as $item) {
            DB::table('penggunaan')->updateOrInsert(
                ['nama_penggunaan' => $item['nama_penggunaan']], // KEY UNIK
                [
                    'keterangan' => $item['keterangan'],
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }
    }
}
