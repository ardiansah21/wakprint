<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $produk = new Produk();
        $keyword = $request->keyword;
        // $keyword = 'ERDE';
        $produk =  Produk::where('nama','LIKE',"%$keyword%")
                    ->orWhere('harga_hitam_putih','LIKE',"%$keyword%")
                    ->get();


        return redirect()->back()->with('produk',$produk)->with('keyword', $keyword);
    }
}
