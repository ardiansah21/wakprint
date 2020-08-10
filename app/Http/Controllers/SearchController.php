<?php

namespace App\Http\Controllers;

use App\Pengelola_Percetakan;
use App\Produk;
use App\Transaksi_saldo;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $produk = new Produk();
        $partner = new Pengelola_Percetakan();
        $keyword = $request->keyword;
        // $keyword = 'ERDE';
        $produk =  Produk::where('nama','LIKE',"%$keyword%")
                    ->orWhere('harga_hitam_putih','LIKE',"%$keyword%")
                    ->get();

        $partner =  Pengelola_Percetakan::where('nama_toko','LIKE',"%$keyword%")
                    ->orWhere('alamat_toko','LIKE',"%$keyword%")
                    ->get();


        return redirect()->back()->with('produk',$produk,'partner',$partner)->with('keyword', $keyword);
    }
}
