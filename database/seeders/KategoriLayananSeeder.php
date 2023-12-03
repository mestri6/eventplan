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
                'id_kategori_layanan' => 1,
                'nama_kategori_layanan' => 'Wo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori_layanan' => 2,
                'nama_kategori_layanan' => 'Mua',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        KategoriLayanan::insert($kategori);
    }
}
