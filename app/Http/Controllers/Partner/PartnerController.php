<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Pengelola_Percetakan;
use App\Produk;
use App\Transaksi_saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        $partner = Auth::user();
        $transaksi_saldo = Transaksi_saldo::all();
        return view('pengelola.homepage', [
            'partner' => $partner,
            'produk' => $produk,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function profile()
    {
        $partner = Auth::user();
        $produk = Produk::all();
        $transaksi_saldo = Transaksi_saldo::all();
        return view('pengelola.profil', [
            'partner' => $partner,
            'produk' => $produk,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function profileEdit()
    {
        $partner = Pengelola_Percetakan::find(Auth::id());
        return view('pengelola.edit_profil', ['partner' => $partner]);
    }

    public function profileUpdate(Request $request)
    {
        // $request->validate([
        //     'foto_profil' => 'image|mimes:jpeg,png,jpg|max:2048',
        // ]);

        $partner = Pengelola_Percetakan::find(Auth::id());

        $jamBuka = $request->jambuka;
        // $jamBuka->format('H');
        $menitBuka = $request->menitbuka;
        // $menitBuka->format('i');
        $jamTutup = $request->jamtutup;
        $menitTutup = $request->menittutup;

        $metodePelayanan[] = array(
            'AmbilDiTempat' => $request->ambiltempat,
            'AntarKeTempat' => $request->antartempat,
        );

        $atkdwh = $request->atkdwh;

        $opBuka = date_create("$jamBuka:$menitBuka")->format('H:i');
        $opTutup = date_create("$jamTutup:$menitTutup")->format('H:i');

        $partner->nama_toko = $request->namapercetakan;
        $partner->deskripsi_toko = $request->deskripsi;
        $partner->alamat_toko = $request->alamat;
        $partner->url_google_maps = $request->urlmaps;
        $partner->jam_op_buka = $opBuka;
        $partner->jam_op_tutup = $opTutup;
        $partner->syaratkententuan = $request->skpercetakan;
        $partner->nama_lengkap = $request->namapemilik;
        $partner->nomor_hp = $request->nomorhp;
        $partner->nama_bank = $request->namabank;
        $partner->nomor_rekening = $request->nomorrekening;

        $partner->save();

        return redirect()->route('partner.profile')->with('alert', 'Profil berhasil diubah');
    }

    public function riwayatTransaksi($id)
    {
        $partner = Auth::user();
        $produk = Produk::all();
        $transaksi_saldo = Transaksi_saldo::find($id)->get();
        // foreach ($transaksi_saldo as $ts) {
        // dd($transaksi_saldo->id_transaksi);
        // }
        return view('pengelola.detail_transaksi', [
            'partner' => $partner,
            'produk' => $produk,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function saldo()
    {
        $transaksi_saldo = Transaksi_saldo::all();
        return view('pengelola.saldo', [
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function tarikSaldo()
    {
        $partner = Auth::user();
        $produk = Produk::all();
        $transaksi_saldo = Transaksi_saldo::all();
        return view('pengelola.tarik_saldo', [
            'partner' => $partner,
            'produk' => $produk,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function info()
    {
        return view('pengelola.info_bantuan');
    }
}
