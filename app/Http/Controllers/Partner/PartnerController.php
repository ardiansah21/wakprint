<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function index()
    {
        return view('pengelola.homepage');
    }

}
