<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    //primary key
    protected $primaryKey = 'id_kategori';

    //fillable
    protected $fillable = [
        'nama_kategori',
    ];

    //timestamps
    public $timestamps = false;
}
