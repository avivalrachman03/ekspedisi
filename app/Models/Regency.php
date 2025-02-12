<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    protected $table = 'regencies';

    protected $fillable = [
        'id',
        'province_id',
        'name',
        'code',
        'harga',
        'estimation',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function pakets()
    {
        return $this->hasMany(Paket::class);
    }

}
