<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siswa::create(
            [
                'id_siswa' => '123456',
                'nama_siswa' => fake()->name,
                'saldo' => 0,
            ],
        );
    }
}
