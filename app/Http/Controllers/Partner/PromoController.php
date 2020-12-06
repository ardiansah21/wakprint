<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Pengelola_Percetakan;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoController extends Controller
{
    public function index()
    {
        $partner = Pengelola_Percetakan::find(Auth::id());
        $produk = Produk::all();
        return view('pengelola.promo', [
            'partner' => $partner,
            'produk' => $produk,
        ]);
    }

    public function create()
    {
        $partner = Auth::user();
        $produk = $partner->products;
        // dd(route('partner.promo.search'));

        return view('pengelola.tambah_promo', compact('partner'));
    }

    public function storeCreate(Request $request)
    {
        $partner = Auth::user();
        $arrIdProduk = array();

        foreach (json_decode($request->idProduk) as $id) {
            array_push($arrIdProduk, $id);
        }

        $statusDiskon = 'Tersedia';
        $maksimalDiskon = $request->maksimal_diskon;
        $tanggalMulai = $request->tanggal_mulai_promo;
        $bulanMulai = $request->bulan_mulai_promo;
        $tahunMulai = $request->tahun_mulai_promo;
        $jumlahDiskon = $request->jumlah_diskon / 100;
        $tanggalSelesai = $request->tanggal_selesai_promo;
        $bulanSelesai = $request->bulan_selesai_promo;
        $tahunSelesai = $request->tahun_selesai_promo;
        $tanggalMulaiPromo = date('Y-m-d', strtotime("$tanggalMulai $bulanMulai $tahunMulai"));
        $tanggalSelesaiPromo = date('Y-m-d', strtotime("$tanggalSelesai $bulanSelesai $tahunSelesai"));

        foreach ($arrIdProduk as $id) {
            $produk = $partner->products->find($id);
            $produk->status_diskon = $statusDiskon;
            $produk->maksimal_diskon = $maksimalDiskon;
            $produk->mulai_waktu_diskon = $tanggalMulaiPromo;
            $produk->jumlah_diskon = $jumlahDiskon;
            $produk->selesai_waktu_diskon = $tanggalSelesaiPromo;
            $produk->save();
        }

        return redirect()->route('partner.promo.index', ['partner' => $partner]);
    }

    public function edit($id)
    {
        $partner = Auth::user();
        $produk = $partner->products->find($id);
        return view('pengelola.edit_promo', [
            'partner' => $partner,
            'produk' => $produk,
        ]);
    }

    public function update(Request $request, $id)
    {
        $partner = Auth::user();
        // $arrIdProduk = array();

        // // dd(json_decode($request->idProduk));

        // foreach (json_decode($request->idProduk) as $id) {
        //     array_push($arrIdProduk, $id);
        // }

        $statusDiskon = 'Tersedia';
        $maksimalDiskon = $request->maksimal_diskon;
        $tanggalMulai = $request->tanggal_mulai_promo;
        $bulanMulai = $request->bulan_mulai_promo;
        $tahunMulai = $request->tahun_mulai_promo;
        $jumlahDiskon = $request->jumlah_diskon / 100;
        $tanggalSelesai = $request->tanggal_selesai_promo;
        $bulanSelesai = $request->bulan_selesai_promo;
        $tahunSelesai = $request->tahun_selesai_promo;
        $tanggalMulaiPromo = date('Y-m-d', strtotime("$tanggalMulai $bulanMulai $tahunMulai"));
        $tanggalSelesaiPromo = date('Y-m-d', strtotime("$tanggalSelesai $bulanSelesai $tahunSelesai"));

        // dd($tanggalSelesaiPromo);

        // foreach ($arrIdProduk as $id) {
        $produk = $partner->products->find($id);
        $produk->status_diskon = $statusDiskon;
        $produk->maksimal_diskon = $maksimalDiskon;
        $produk->mulai_waktu_diskon = $tanggalMulaiPromo;
        $produk->jumlah_diskon = $jumlahDiskon;
        $produk->selesai_waktu_diskon = $tanggalSelesaiPromo;
        $produk->save();
        // }

        return redirect()->route('partner.promo.index', ['partner' => $partner]);
    }

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

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $partner = Auth::user();
            $produk = $partner->products->first()->where('id_pengelola', $partner->id_pengelola)
                ->where('status_diskon', 'TidakTersedia')
                ->where('nama', 'like', '%' . $request->keyword . '%')
            // ->where('harga_hitam_putih', $request->keyword)
            // ->where('harga_berwarna', $request->keyword)
            // ->where('deskripsi', 'like', '%' . $request->keyword . '%')
                ->get();

            return response()->json([
                'produk' => $produk,
            ], 200);
        }
    }
}
