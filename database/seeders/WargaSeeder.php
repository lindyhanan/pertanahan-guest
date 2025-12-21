<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Locale Indonesia

        $jenisKelamin = ['Laki-laki', 'Perempuan'];
        $agamaList    = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];

        for ($i = 0; $i < 50; $i++) {
            DB::table('warga')->insert([
                'no_ktp'        => $faker->unique()->numerify('################'), // 16 digit
                'nama'          => $faker->name,
                'jenis_kelamin' => $faker->randomElement($jenisKelamin),
                'agama'         => $faker->randomElement($agamaList),
                'pekerjaan'     => $faker->jobTitle,
                'telp'          => $faker->phoneNumber,
                'email'         => $faker->unique()->safeEmail,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
