<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPenggunaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Jenis dasar penggunaan lahan
        $jenisDasar = [
            'Pertanian', 'Perkebunan', 'Perumahan', 'Perdagangan', 'Industri',
            'Pendidikan', 'Fasilitas Umum', 'Kehutanan', 'Perikanan', 'Peternakan',
        ];

        $insertData = [];

        for ($i = 1; $i <= 100; $i++) {
            // Ambil jenis dasar secara acak
            $jenis = $faker->randomElement($jenisDasar);

            // Buat keterangan relevan
            $keterangan = match ($jenis) {
                'Pertanian'      => $faker->sentence() . ' untuk lahan pertanian.',
                'Perkebunan'     => $faker->sentence() . ' untuk lahan perkebunan.',
                'Perumahan'      => $faker->sentence() . ' untuk hunian/permukiman.',
                'Perdagangan'    => $faker->sentence() . ' untuk aktivitas perdagangan.',
                'Industri'       => $faker->sentence() . ' untuk industri/manufaktur.',
                'Pendidikan'     => $faker->sentence() . ' untuk fasilitas pendidikan.',
                'Fasilitas Umum' => $faker->sentence() . ' untuk fasilitas publik.',
                'Kehutanan'      => $faker->sentence() . ' termasuk hutan dan konservasi.',
                'Perikanan'      => $faker->sentence() . ' untuk budidaya ikan/tambak.',
                'Peternakan'     => $faker->sentence() . ' untuk peternakan/hewan.',
                default          => $faker->sentence()
            };

            // Pastikan nama unik dan <=50 karakter
            $namaPenggunaan = substr($jenis . ' ' . $i, 0, 50);

            $insertData[] = [
                'nama_penggunaan' => $namaPenggunaan,
                'keterangan'      => $keterangan,
                'created_at'      => now(),
                'updated_at'      => now(),
            ];
        }

        // Insert sekaligus agar lebih cepat
        DB::table('jenis_penggunaan')->insert($insertData);
    }
}
