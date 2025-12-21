<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DokumenPersilSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $persilIds = DB::table('persil')->pluck('persil_id')->toArray();

        if (empty($persilIds)) {
            $this->command->error('Seeder DokumenPersil gagal: data persil kosong');
            return;
        }

        $jenisDokumenList = ['Sertifikat', 'AJB', 'SHM', 'Surat Ukur', 'IMB'];

        $keteranganTemplates = [
            'Dokumen %s digunakan sebagai bukti kepemilikan sah atas persil.',
            'Berkas %s sebagai dokumen resmi pendukung administrasi persil.',
            'Dokumen %s diperlukan untuk proses legal dan pencatatan pertanahan.',
            'Dokumen %s menjadi dasar pencatatan hak atas tanah.',
            'Dokumen %s ini masih berlaku dan tercatat dalam sistem pertanahan.',
        ];

        foreach (range(1, 300) as $i) {
            $jenis = $faker->randomElement($jenisDokumenList);

            DB::table('dokumen_persil')->insert([
                'persil_id'     => $faker->randomElement($persilIds),
                'jenis_dokumen' => $jenis,
                'nomor'         => strtoupper($faker->bothify('DOC-###/??')),
                'keterangan'    => sprintf(
                    $faker->randomElement($keteranganTemplates),
                    $jenis
                ),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
