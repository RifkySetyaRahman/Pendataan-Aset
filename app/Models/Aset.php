<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    protected $table = 'aset';

protected $fillable = [
    'name',
    'serialnumber',
    'location',
    'purchase_date',
    'category_code',
    'condition_code',
    'description',
    'status',
    'quantity',
];

    public function kategori()
    {
    return $this->belongsTo(KategoriAset::class, 'category_code', 'code');
    }

    public function kondisi()
    {
    return $this->belongsTo(KondisiAset::class, 'condition_code', 'code');
    }
}
