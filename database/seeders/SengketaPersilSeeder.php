<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SengketaPersilSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $persilIds = DB::table('persil')->pluck('persil_id')->toArray();

        if (empty($persilIds)) {
            $this->command->error('Seeder SengketaPersil gagal: data persil kosong');
            return;
        }

        foreach (range(1, 30) as $i) {
            DB::table('sengketa_persil')->insert([
                'persil_id'    => $faker->randomElement($persilIds),
                'pihak_1'      => $faker->name,
                'pihak_2'      => $faker->name,
                'kronologi'    => $this->kronologiIndonesia($faker),
                'status'       => $faker->randomElement(['proses', 'selesai']),
                'penyelesaian' => $faker->boolean ? $this->penyelesaianIndonesia() : null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        $this->command->info('Seeder SengketaPersil berhasil 🇮🇩');
    }

    protected function kronologiIndonesia($faker)
    {
        $templates = [
            'Sengketa bermula ketika pihak pertama mengklaim kepemilikan atas lahan tersebut sejak tahun %d. Pihak kedua kemudian mengajukan keberatan dan menyatakan bahwa lahan tersebut merupakan milik keluarganya berdasarkan dokumen lama.',
            'Perselisihan terjadi setelah adanya aktivitas pembangunan di atas lahan yang dipermasalahkan. Pihak kedua merasa tidak pernah memberikan izin atas penggunaan tanah tersebut.',
            'Masalah sengketa muncul akibat perbedaan batas lahan antara kedua pihak. Pengukuran ulang menunjukkan adanya tumpang tindih wilayah.',
            'Sengketa lahan ini bermula dari transaksi jual beli yang dilakukan secara lisan tanpa adanya bukti tertulis yang sah.',
            'Kedua belah pihak mengklaim hak kepemilikan tanah berdasarkan riwayat penguasaan yang berbeda sejak beberapa tahun terakhir.'
        ];

        $template = $faker->randomElement($templates);

        return sprintf($template, $faker->numberBetween(1990, 2023));
    }

    protected function penyelesaianIndonesia()
    {
        $data = [
            'Disepakati penyelesaian melalui musyawarah dan mufakat.',
            'Sengketa diselesaikan melalui mediasi pihak kelurahan.',
            'Putusan sementara menunggu hasil pengukuran ulang dari BPN.',
            'Kedua pihak sepakat menunggu proses hukum lebih lanjut.',
            'Disepakati pembagian lahan berdasarkan hasil kesepakatan bersama.'
        ];

        return $data[array_rand($data)];
    }
}
