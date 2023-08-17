<?php

namespace Database\Seeders;

use App\Models\KategoriLayanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
                'id' => 1,
                'nama' => 'Wo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => 'Mua',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        KategoriLayanan::insert($kategori);
    }
}
