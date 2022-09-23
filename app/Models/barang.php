<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;


    protected $table = 'barangs';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'nama_barang',
        'harga',
        'stok',
        'id_siswa_penjual',
    ];
    
}
