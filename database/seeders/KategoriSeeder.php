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
            ['nama_kategori' => 'makanan'],
        );
        Kategori::create(
            ['nama_kategori' => 'minuman'],
        );
        Kategori::create(
            ['nama_kategori' => 'pakaian'],

        );
        Kategori::create(
            ['nama_kategori' => 'mainan'],
        );
        Kategori::create(
            ['nama_kategori' => 'elektronik'],
        );
        Kategori::create(
            ['nama_kategori' => 'alat tulis'],
        );
    }
}
