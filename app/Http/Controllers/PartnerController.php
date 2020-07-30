<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pengelola_Percetakan;

class PartnerController extends Controller
{
    public function index()
    {
        
        return view('pengelola.homepage');
    }

    public function profile()
    {
        $partner = Auth::user();
        return view('pengelola.profil',['partner'=>$partner]);
    }

    public function profileEdit()
    {
       
        $partner = Pengelola_Percetakan::find(Auth::id());
        return view('pengelola.edit_profil',['partner'=>$partner]);
    }

    public function profileUpdate(Request $request){
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

        $opBuka = date_create("$jamBuka:$menitBuka");
        //$opBuka->format('H:i');
        $opTutup = date_create("$jamTutup:$menitTutup");
        //$opTutup->format('H:i');

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
        
        return redirect()->route('partner.profile')->with('alert','Profil berhasil diubah');
    }

}
