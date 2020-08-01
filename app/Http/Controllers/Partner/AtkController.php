<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AtkController extends Controller
{
    public function index()
    {
        return view('pengelola.homepage');
    }

    public function create()
    {
        return view('pengelola.tambah_atk');
    }
    
}
