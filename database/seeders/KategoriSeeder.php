<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create(
            ['nama_kategori' => 'Makanan'],
        );
        Kategori::create(
            ['nama_kategori' => 'Minuman'],
        );
        Kategori::create(
            ['nama_kategori' => 'Pakaian'],

        );
        Kategori::create(
            ['nama_kategori' => 'Mainan'],
        );
        Kategori::create(
            ['nama_kategori' => 'Elektronik'],
        );
        Kategori::create(
            ['nama_kategori' => 'Alat Tulis'],
        );
    }
}
