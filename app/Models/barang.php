<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;


    protected $table = 'barangs';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'nama_barang',
        'harga',
        'foto',
        'deskripsi',
        'stok',
        'id_kategori',
        'id_siswa_penjual',
    ];
    
}
