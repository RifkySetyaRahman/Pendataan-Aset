<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriAset extends Model
{
    protected $table = 'kategori_aset';
    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    public function aset()
    {
    return $this->hasMany(Aset::class, 'category_code', 'code');
    }
}