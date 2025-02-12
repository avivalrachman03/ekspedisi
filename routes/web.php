<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/cetak/{id}', [\App\Http\Controllers\CetakController::class, 'print'])->name('cetak');
Route::get('/ekspor/{id}', [\App\Http\Controllers\CetakController::class, 'print'])->name('ekspor');
