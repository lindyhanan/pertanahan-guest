<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===============================
        // ADMIN UTAMA (AMAN DARI DUPLIKAT)
        // ===============================
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Lindy',
                'role'     => 'admin',
                'password' => Hash::make('lindy'),
            ]
        );

        // =========
        // ======================
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
