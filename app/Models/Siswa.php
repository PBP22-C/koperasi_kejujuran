<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    //primary key
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $incrementing = false;
    protected $keyType = 'string';

    //fillable
    protected $fillable = [
        'nama_siswa',
        'saldo'
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
}
