<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function index()
    {
        return view('pengelola.homepage');
    }
    public function produkTambah()
    {
        
        return view('pengelola.tambah_produk');
    }

    public function produkTambahStore(Request $request)
    {
        $fitur = $request->fitur;
        if(!empty($fitur['tambahan']))
            $fitur['tambahan'] =  array_values($request->fitur['tambahan']);

        dd(json_encode($fitur,JSON_PRETTY_PRINT));
        return redirect()->back();
    }

}
