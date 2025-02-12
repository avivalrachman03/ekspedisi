<?php

namespace App\Models;

use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $guarded = [];
    
    public function regencies()
    {
        return $this->belongsTo(Regency::class);
    }

    public function pengirim()
    {
        return $this->belongsTo(Pengirim::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
