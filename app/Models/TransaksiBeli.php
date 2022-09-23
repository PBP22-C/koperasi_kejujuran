<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi_beli extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_beli';

    protected $fillable = [
        'id_barang',
        'kuantitas',
        'harga_total',
    ];
}
