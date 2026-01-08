<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Pantai'],
            ['nama' => 'Gunung'],
            ['nama' => 'Air Terjun'],
            ['nama' => 'Tempat Adat'],
        ];

        Kategori::insert($data);
    }
}