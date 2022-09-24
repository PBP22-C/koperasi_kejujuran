<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    //primary key
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    //fillable
    protected $fillable = [
        'nama_kategori',
    ];

    //timestamps
    public $timestamps = false;

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_kategori');
    }
}
