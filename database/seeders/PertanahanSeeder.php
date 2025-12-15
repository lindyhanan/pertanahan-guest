<?php
namespace Database\Seeders;

use App\Models\Penggunaan;
use App\Models\Persil;
use App\Models\User;
use App\Models\Warga;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PertanahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID'); // Menggunakan locale Indonesia untuk data yang lebih relevan

        // ----------------------------
        // Seeder User
        // ----------------------------
        for ($i = 1; $i <= 100; $i++) {
            User::create([
                'name'     => $faker->name(),
                'email'    => $faker->unique()->safeEmail(),
                'role'     => $faker->randomElement(['admin', 'staff', 'klien']),
                'foto'     => null,
                'password' => Hash::make('password123'),
            ]);
        }

        // ----------------------------
        // Seeder Warga (Disesuaikan dengan migrasi: nama, nik, alamat)
        // ----------------------------
        for ($i = 1; $i <= 100; $i++) {
            Warga::create([
                'nama'          => $faker->name(),
                'no_ktp'        => $faker->unique()->numerify('################'), // 16 digit NIK
                'alamat'        => $faker->address(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama'         => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']),
                'pekerjaan'     => $faker->jobTitle(),
                'telp'          => $faker->phoneNumber(),
                'email'         => $faker->unique()->safeEmail(),
            ]);
        }

        // ----------------------------
        // Seeder Penggunaan
        // ----------------------------
        $jenisPenggunaan = [
    'Permukiman',
    'Sawah',
    'Kebun',
    'Ternak',
    'Industri',
    'Lapangan Olahraga',
    'Fasilitas Umum',
    'Hutan Lindung',
    'Perkebunan',
    'Taman Kota'
];

for ($i = 1; $i <= 150; $i++) {

    $jenis = $faker->randomElement($jenisPenggunaan);

    Penggunaan::updateOrCreate(
        ['nama_penggunaan' => $jenis],
        ['keterangan' =>
            'Lahan ini digunakan untuk ' .
            strtolower($jenis) .
            ' dan dikelola sesuai ketentuan yang berlaku.'
        ]
    );
}


                                      // ----------------------------
                                      // Seeder Persil
                                      // ----------------------------
        $wargaCount = Warga::count(); // Ambil jumlah warga yang telah dibuat
        for ($i = 1; $i <= 100; $i++) {
            Persil::create([
                'kode_persil'      => 'P' . str_pad($i, 3, '0', STR_PAD_LEFT),
                // Pastikan pemilik_warga_id tidak melebihi jumlah warga yang ada
                'pemilik_warga_id' => $faker->numberBetween(1, $wargaCount),
                'luas_m2'          => $faker->numberBetween(50, 1000),
                'penggunaan'       => $faker->randomElement($jenisPenggunaan),
                'alamat_lahan'     => $faker->streetAddress(),
                'rt'               => str_pad($faker->numberBetween(1, 15), 3, '0', STR_PAD_LEFT),
                'rw'               => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
