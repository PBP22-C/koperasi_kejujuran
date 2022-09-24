<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBeli extends Model
{
    use HasFactory;

    protected $table = 'transaksi_beli';
    protected $primaryKey = 'id_beli';

    protected $fillable = [
        'id_barang',
        'kuantitas',
        'harga_total',
    ];

    public $timestamps = false;

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
