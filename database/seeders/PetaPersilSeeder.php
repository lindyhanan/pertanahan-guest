<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class PetaPersilSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        $persilIds = DB::table('persil')->pluck('persil_id')->toArray();

        if (count($persilIds) === 0) {
            $this->command->error('Seeder PetaPersil gagal: tabel persil kosong');
            return;
        }

        foreach ($persilIds as $persilId) {

            // koordinat random sekitar Pekanbaru
            $lat = $faker->latitude(-0.6, 0.6);
            $lng = $faker->longitude(101.3, 102.9);

            $geojson = array(
                "type" => "Polygon",
                "coordinates" => array(
                    array(
                        array($lng, $lat),
                        array($lng + 0.0005, $lat),
                        array($lng + 0.0005, $lat + 0.0005),
                        array($lng, $lat + 0.0005),
                        array($lng, $lat)
                    )
                )
            );

            DB::table('peta_persil')->insert(array(
                'persil_id' => $persilId,
                'geojson'   => json_encode($geojson),
                'panjang_m' => $faker->numberBetween(20, 100),
                'lebar_m'   => $faker->numberBetween(10, 80),
                'created_at' => now(),
                'updated_at' => now(),
            ));
        }

        $this->command->info('Seeder PetaPersil BERHASIL 🎉');
    }
}
