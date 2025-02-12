<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengirim extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
    ];

    public function pakets()
    {
        return $this->hasMany(Paket::class);
    }
}
