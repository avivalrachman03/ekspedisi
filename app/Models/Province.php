<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    protected $guarded = [];

    public function regencie()
    {
        return $this->hasMany(Regency::class);
    }
    public function paket()
    {
        return $this->hasMany(Paket::class);
    }

}
