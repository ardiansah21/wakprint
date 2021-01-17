<?php

namespace App\Http\Controllers\API\Member;

use App\Http\Controllers\Controller;
use App\Member;

class MemberController extends Controller
{

    public function index()
    {
        // $member = Auth::user();
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

        // $ratingPartner = $produk->where('id_pengelola',$produk->partner->id_pengelola)->avg('rating');

        // $atk = Atk::all();
        // return responseSuccess("data user yang login", request()->user());
    }

    // public function showProfil()
    // {
    //     return responseSuccess("data user yang login", request()->user());
    // }

}
