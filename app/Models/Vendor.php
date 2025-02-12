<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['name','phone','logo'];

    public function pakets()
    {
        return $this->hasMany(Paket::class);
    }
}
