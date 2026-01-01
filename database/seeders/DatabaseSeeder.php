<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===============================
        // ADMIN UTAMA (AMAN DARI DUPLIKAT)
        // ===============================
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // kondisi
            [
                'name'     => 'Lindy',
                'role'     => 'admin',
                'password' => Hash::make('linday'),
            ]
        );

        // ===============================
        // USER DUMMY (RANGE + ROLE)
        // ===============================
        foreach (range(1, 150) as $i) {

            if ($i <= 30) {
                $role = 'admin';
            } elseif ($i <= 40) {
                $role = 'staff';
            } else {
                $role = 'klien';
            }

            User::updateOrCreate(
                ['email' => "{$role}{$i}@gmail.com"],
                [
                    'name'     => ucfirst($role) . " $i",
                    'role'     => $role,
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}
