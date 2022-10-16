<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                'nama_siswa' => "Dummy Akun",
                'password' => Hash::make('123456'),
                'saldo' => 0,
            ],
        );
    }
}
