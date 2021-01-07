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
        if (empty($request->tahun_mulai_promo) || empty($request->bulan_mulai_promo) || empty($request->tanggal_mulai_promo) || empty($request->tahun_selesai_promo) || empty($request->bulan_selesai_promo) || empty($request->tanggal_selesai_promo)) {
            alert()->error('Maaf', 'Waktu promo tidak boleh ada yang kosong. Silahkan periksa kembali yah');
            return redirect()->back();
        }

        $partner = Auth::user();
        $arrIdProduk = array();

        foreach (json_decode($request->idProduk) as $id) {
            array_push($arrIdProduk, $id);
        }

        $months = ['Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4, 'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8, 'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12];
        $statusDiskon = 'Tersedia';
        $maksimalDiskon = $request->maksimal_diskon;
        $tanggalMulai = $request->tanggal_mulai_promo;
        $bulanMulai = $months[$request->bulan_mulai_promo];
        $tahunMulai = $request->tahun_mulai_promo;
        $jumlahDiskon = $request->jumlah_diskon / 100;
        $tanggalSelesai = $request->tanggal_selesai_promo;
        $bulanSelesai = $months[$request->bulan_selesai_promo];
        $tahunSelesai = $request->tahun_selesai_promo;
        $tanggalMulaiPromo = "$tahunMulai-$bulanMulai-$tanggalMulai";
        $tanggalSelesaiPromo = "$tahunSelesai-$bulanSelesai-$tanggalSelesai";

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
            $produk->push();
            $produk->save();
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
        if (empty($request->tahun_mulai_promo) || empty($request->bulan_mulai_promo) || empty($request->tanggal_mulai_promo) || empty($request->tahun_selesai_promo) || empty($request->bulan_selesai_promo) || empty($request->tanggal_selesai_promo)) {
            alert()->error('Maaf', 'Waktu promo tidak boleh ada yang kosong. Silahkan periksa kembali yah');
            return redirect()->back();
        }

        $partner = Auth::user();
        $months = ['Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4, 'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8, 'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12];

        $statusDiskon = 'Tersedia';
        $maksimalDiskon = $request->maksimal_diskon;
        $tanggalMulai = $request->tanggal_mulai_promo;
        $bulanMulai = $months[$request->bulan_mulai_promo];
        $tahunMulai = $request->tahun_mulai_promo;
        $jumlahDiskon = $request->jumlah_diskon / 100;
        $tanggalSelesai = $request->tanggal_selesai_promo;
        $bulanSelesai = $months[$request->bulan_selesai_promo];
        $tahunSelesai = $request->tahun_selesai_promo;
        $tanggalMulaiPromo = "$tahunMulai-$bulanMulai-$tanggalMulai";
        $tanggalSelesaiPromo = "$tahunSelesai-$bulanSelesai-$tanggalSelesai";

        if ($tanggalMulaiPromo < Carbon::now()->format('Y-m-d')) {
            alert()->error('Maaf', 'Waktu mulai promo tidak boleh menggunakan waktu lampau, silahkan periksa kembali yah');
            return redirect()->back();
        } else if ($tanggalSelesaiPromo < Carbon::now()->format('Y-m-d')) {
            alert()->error('Maaf', 'Waktu selesai promo tidak boleh menggunakan waktu lampau, silahkan periksa kembali yah');
            return redirect()->back();
        }

        if ($tanggalMulaiPromo > $tanggalSelesaiPromo || $tanggalSelesaiPromo < $tanggalMulaiPromo || $bulanMulai > $bulanSelesai || $bulanSelesai < $bulanMulai || $tanggalMulai > $tanggalSelesai || $tanggalSelesai < $tanggalMulai) {
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
