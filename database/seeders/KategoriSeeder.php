<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert(
            ['nama_kategori' => 'makanan'],

        );
        DB::table('kategori')->insert(
            ['nama_kategori' => 'minuman'],
        );
        DB::table('kategori')->insert(
            ['nama_kategori' => 'pakaian'],

        );
        DB::table('kategori')->insert(
            ['nama_kategori' => 'mainan'],

        );
        DB::table('kategori')->insert(
            ['nama_kategori' => 'elektronik'],

        );
    }
}
