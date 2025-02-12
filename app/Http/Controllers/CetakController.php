<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public Paket $paket ;
    public function print($id) {
        $paket = Paket::find($id);
        return view('cetakStruk', compact('paket'));
    }
}
