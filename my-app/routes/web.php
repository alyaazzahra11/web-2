<?php

use App\Http\Controllers\UnitkerjaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/unit-kerja', [UnitkerjaController::class, "index"]);
