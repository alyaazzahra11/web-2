<?php

namespace App\Http\Controllers;

use App\Models\Unitkerja;
use Illuminate\Http\Request;

class UnitkerjaController extends Controller
{
    public function index()
    {
        $unitkerja = Unitkerja::all();
        
        return view("unit-kerja.index", compact("unitkerja"));
    }

    
}
