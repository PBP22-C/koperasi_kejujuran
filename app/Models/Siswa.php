<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use HasFactory;

    //primary key
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $incrementing = false;
    protected $keyType = 'string';

    //fillable
    protected $fillable = [
        'id_siswa',
        'nama_siswa',
        'saldo',
        'password',
    ];

    //password
    protected $hidden = [
        'password',
    ];

    //timestamps
    public $timestamps = false;

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_siswa_penjual');
    }

    protected $attributes = [
        'saldo' => 0,
    ];
}
