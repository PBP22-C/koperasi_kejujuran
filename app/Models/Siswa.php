<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    //primary key
    protected $primaryKey = 'id_siswa';
    public $incrementing = false;

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
}
