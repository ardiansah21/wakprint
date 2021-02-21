<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Pengelola_Percetakan;
use App\Produk;
use Carbon\Carbon;
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

        return view('pengelola.tambah_promo', compact('partner'));
    }

    public function storeCreate(Request $request)
    {
        if (empty($request->tanggal_awal_promo) || empty($request->tanggal_selesai_promo)) {
            alert()->error('Maaf', 'Waktu promo tidak boleh ada yang kosong. Silahkan periksa kembali yah');
            return redirect()->back();
        }

        $partner = Auth::user();
        $arrIdProduk = array();

        foreach (json_decode($request->idProduk) as $id) {
            array_push($arrIdProduk, $id);
        }

        $statusDiskon = 'Tersedia';
        $maksimalDiskon = $request->maksimal_diskon;
        $jumlahDiskon = $request->jumlah_diskon / 100;
        $tanggalMulaiPromo = $request->tanggal_awal_promo;
        $tanggalSelesaiPromo = $request->tanggal_selesai_promo;

        if ($tanggalMulaiPromo < Carbon::now()->format('Y-m-d')) {
            alert()->error('Maaf', 'Waktu mulai promo tidak boleh menggunakan waktu lampau, silahkan periksa kembali yah');
            return redirect()->back();
        } else if ($tanggalSelesaiPromo < Carbon::now()->format('Y-m-d')) {
            alert()->error('Maaf', 'Waktu selesai promo tidak boleh menggunakan waktu lampau, silahkan periksa kembali yah');
            return redirect()->back();
        }

        if ($tanggalMulaiPromo > $tanggalSelesaiPromo) {
            alert()->error('Maaf', 'Waktu mulai promo tidak boleh melewati masa waktu selesai promo, silahkan periksa kembali yah');
            return redirect()->back();
        }

        foreach ($arrIdProduk as $id) {
            $produk = $partner->products->find($id);
            $produk->status_diskon = $statusDiskon;
            $produk->maksimal_diskon = (int) str_replace('.', '', $maksimalDiskon);
            $produk->mulai_waktu_diskon = $tanggalMulaiPromo;
            $produk->jumlah_diskon = $jumlahDiskon;
            $produk->selesai_waktu_diskon = $tanggalSelesaiPromo;
            $produk->save();
            $produk->push();
        }

        return redirect()->route('partner.promo.index', ['partner' => $partner])->with('success', 'Anda berhasil menambahkan promo baru pada produk Anda');
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
        if (empty($request->tanggal_awal_promo) || empty($request->tanggal_selesai_promo)) {
            alert()->error('Maaf', 'Waktu promo tidak boleh ada yang kosong. Silahkan periksa kembali yah');
            return redirect()->back();
        }

        $partner = Auth::user();
        $statusDiskon = 'Tersedia';
        $maksimalDiskon = $request->maksimal_diskon;
        $jumlahDiskon = $request->jumlah_diskon / 100;
        $tanggalMulaiPromo = $request->tanggal_awal_promo;
        $tanggalSelesaiPromo = $request->tanggal_selesai_promo;

        if ($tanggalMulaiPromo < Carbon::now()->format('Y-m-d')) {
            alert()->error('Maaf', 'Waktu mulai promo tidak boleh menggunakan waktu lampau, silahkan periksa kembali yah');
            return redirect()->back();
        } else if ($tanggalSelesaiPromo < Carbon::now()->format('Y-m-d')) {
            alert()->error('Maaf', 'Waktu selesai promo tidak boleh menggunakan waktu lampau, silahkan periksa kembali yah');
            return redirect()->back();
        }

        if ($tanggalMulaiPromo > $tanggalSelesaiPromo || $tanggalSelesaiPromo < $tanggalMulaiPromo) {
            alert()->error('Maaf', 'Waktu mulai promo tidak boleh melewati masa waktu selesai promo, silahkan periksa kembali yah');
            return redirect()->back();
        }

        $produk = $partner->products->find($id);
        $produk->status_diskon = $statusDiskon;
        $produk->maksimal_diskon = (int) str_replace('.', '', $maksimalDiskon);
        $produk->mulai_waktu_diskon = $tanggalMulaiPromo;
        $produk->jumlah_diskon = $jumlahDiskon;
        $produk->selesai_waktu_diskon = $tanggalSelesaiPromo;
        $produk->save();
        $produk->push();

        return redirect()->route('partner.promo.index', ['partner' => $partner])->with('success', 'Anda berhasil mengubah promo pada produk Anda');
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
        $produk->push();

        return redirect()->back()->with('success', 'Anda berhasil menghapus promo pada produk Anda');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $partner = Auth::user();
            $produk = $partner->products->first()->where('id_pengelola', $partner->id_pengelola)
                ->where('status_diskon', 'TidakTersedia')
                ->where('nama', 'like', '%' . $request->keyword . '%')
                ->get();

            return response()->json([
                'produk' => $produk,
            ], 200);
        }
    }
}
