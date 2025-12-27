<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KondisiAset extends Model
{
    protected $table = 'kondisi_aset';
    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    public function aset()
    {
    return $this->hasMany(Aset::class, 'condition_code', 'code');
    }
}
