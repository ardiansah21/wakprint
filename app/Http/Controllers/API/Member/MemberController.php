<?php

namespace App\Http\Controllers\API\Member;

use App\Http\Controllers\Controller;
use App\Member;
use App\Pengelola_Percetakan;
use App\Produk;

class MemberController extends Controller
{

    public function index()
    {
        $produk = Produk::where('rating', '>=', 4)
        // ->where('jarak', '<=', 1000)
            ->where('status', 'Tersedia')
            ->where('harga_hitam_putih', '<=', 2000)
            ->where('harga_berwarna', '<=', 2000)
            ->get();

        $partner = Pengelola_Percetakan::where('rating_toko', '>=', 4)
        // ->where('jarak', '<=', 1000)
            ->where('email_verified_at', '!=', null)
            ->get();

        $data = [
            "produk" => $produk,
            "partner" => $partner,
        ];

        return responseSuccess("data home", $data);
    }

    public function user()
    {
        return responseSuccess("data user", request()->user());
    }

}
