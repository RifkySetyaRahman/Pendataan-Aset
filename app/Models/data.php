<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    protected $table = 'data';
    protected $fillable = [
        'nama_data',
        'kode',
        'alamat',
        'jumlah_tersedia',
        'jumlah_terpakai',
    ];

    protected static function booted()
    {
        static::saving(function ($data) {
            $data->total = $data->jumlah_tersedia + $data->jumlah_terpakai;
        });
    }
}
