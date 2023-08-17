<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'Admin',
                'status_akun' => 'Terverifikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Customer',
                'email' => 'customer@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'Customer',
                'status_akun' => 'Terverifikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Wo',
                'email' => 'wo@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'Wo',
                'status_akun' => 'Terverifikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Mua',
                'email' => 'mua@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'Mua',
                'status_akun' => 'Terverifikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        User::insert($user);
    }
}
