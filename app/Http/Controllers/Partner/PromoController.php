<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Pengelola_Percetakan;
use App\Produk;
use App\Transaksi_saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partner = Pengelola_Percetakan::find(Auth::id());
        $produk = Produk::all();
        return view('pengelola.promo',[
            'partner' => $partner,
            'produk' => $produk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partner = Auth::user();
        $produk = Produk::all();

        return view('pengelola.tambah_promo', [
            'partner' => $partner,
            'produk' => $produk
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $produk = Produk::all();
        // $produk = Produk::find($id);
        // $partner = Pengelola_Percetakan::find(Auth::id());

        $idProduk = $request->checkbox_promo;
        $statusDiskon = 'Tersedia';
        $maksimalDiskon = $request->maksimal_diskon;
        $tanggalMulai = $request->tanggal_mulai_promo;
        $bulanMulai = $request->bulan_mulai_promo;
        $tahunMulai = $request->tahun_mulai_promo;
        $jumlahDiskon = $request->jumlah_diskon / 100;
        $tanggalSelesai = $request->tanggal_selesai_promo;
        $bulanSelesai = $request->bulan_selesai_promo;
        $tahunSelesai = $request->tahun_selesai_promo;
        $tanggalMulaiPromo = date_create("$tanggalMulai-$bulanMulai-$tahunMulai");
        $tanggalSelesaiPromo = date_create("$tanggalSelesai-$bulanSelesai-$tahunSelesai");

        foreach ($idProduk as $id) {
            $produk = Produk::find($id);
            // $produk->id_produk = $idProduk;
            $produk->status_diskon = $statusDiskon;
            $produk->maksimal_diskon = $maksimalDiskon;
            $produk->mulai_waktu_diskon = $tanggalMulaiPromo;
            $produk->jumlah_diskon = $jumlahDiskon;
            $produk->selesai_waktu_diskon = $tanggalSelesaiPromo;
            $produk->save();
        }

        //$produk->save();
        //dd($idProduk);
        // $produk->update([
        //     'maksimal_diskon' => $maksimalDiskon,
        //     'mulai_waktu_diskon' => $tanggalMulaiPromo,
        //     'jumlah_diskon' => $jumlahDiskon,
        //     'selesai_waktu_diskon' => $tanggalSelesaiPromo
        // ]);



        // dd($idProduk);
        //$produk->save();

        return redirect()->route('partner.promo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partner = Pengelola_Percetakan::find(Auth::id());
        $produk = Produk::find($id);
        return view('pengelola.edit_promo',[
            'partner' => $partner,
            'produk' => $produk
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->status_diskon = 'TidakTersedia';
        $produk->maksimal_diskon = null;
        $produk->mulai_waktu_diskon = null;
        $produk->jumlah_diskon = null;
        $produk->selesai_waktu_diskon = null;
        $produk->save();

        return redirect()->back();
    }

    public function searchProdukPartner(Request $request)
    {
        $produk = new Produk();
        $keyword = $request->keyword;
        $produk =  Produk::where('nama','LIKE',"%$keyword%")
                    ->orWhere('harga_hitam_putih','LIKE',"%$keyword%")
                    ->get();


        return redirect()->back()->with('produk',$produk)->with('keyword', $keyword);
    }
}
