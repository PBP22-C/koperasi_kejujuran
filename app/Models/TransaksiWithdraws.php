<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiWithdraw extends Model
{
    use HasFactory;
    protected $table = 'transaksi_withdraws';
    protected $primaryKey = 'id_withdraw';
    public $timestamps = false;
    protected $fillable = [
        'jumlah_withdraw'
    ];
    
}
