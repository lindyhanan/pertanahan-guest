<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateFirstUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name'       => 'Admin Pertanahan',
            'email'      => 'admin@pertanahan.test',
            'password'   => Hash::make('password123'), // ganti sesuai kebutuhan
            'role'       => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
