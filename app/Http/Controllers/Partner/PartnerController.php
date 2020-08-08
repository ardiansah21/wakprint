<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Pengelola_Percetakan;
use App\Produk;
use App\Transaksi_saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Carbon\Carbon;

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

        $opBuka = date_create("$jamBuka:$menitBuka");
        $opTutup = date_create("$jamTutup:$menitTutup");

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
        $partner->ambil_di_tempat = $request->ambiltempat == 'Ambil di Tempat' ? '1' : '0';
        $partner->antar_ke_tempat = $request->antartempat == 'Diantar ke Tempat' ? '1' : '0';
        $partner->atkdwh = $request->atkdwh;

        $partner->save();

        $partner->clearMediaCollection();
        $partner->addMedia($request->file('foto_partner'))->toMediaCollection();

        return redirect()->route('partner.profile')->with('alert', 'Profil berhasil diubah');
    }

    public function riwayatTransaksi($id)
    {
        $partner = Auth::user();
        $transaksi_saldo = Transaksi_saldo::find($id);
        return view('pengelola.detail_transaksi', [
            'partner' => $partner,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function saldo()
    {
        $partner = Auth::user();
        $id = Pengelola_Percetakan::find(Auth::id());
        $transaksi_saldo = Transaksi_saldo::all();
        // $id = Auth::user($transaksi_saldo->id_pengelola);
        return view('pengelola.saldo', [
            'partner' => $partner,
            'id' => $id,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function tarikSaldo()
    {
        $partner = Pengelola_Percetakan::find(Auth::id());
        $transaksi_saldo = Transaksi_saldo::all();

        return view('pengelola.tarik_saldo', [
            'partner' => $partner,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function storeTarikSaldo(Request $request)
    {
        $partner = Pengelola_Percetakan::find(Auth::id());
        $jumlahSaldo = $request->jumlah_saldo;

        if($partner->jumlah_saldo <= 0){
            return redirect()->route('partner.saldo')->with('alert', 'Saldo Anda Kosong !');
        }

        else if($jumlahSaldo > $partner->jumlah_saldo){
            return redirect()->route('partner.saldo')->with('alert', 'Saldo Anda Tidak Mencukupi Untuk Melakukan Penarikan Saldo !');
        }

        else{
            $jenisTransaksi = 'Tarik';
            $partner->jumlah_saldo =  $partner->jumlah_saldo - $jumlahSaldo;
            $kodePembayaran = Str::random(20);
            $status = 'Pending';
            $keterangan = 'Penarikan Saldo Sedang Diproses';
            $waktu = Carbon::now()->format('Y:m:d H:i:s');

            Transaksi_saldo::create([
                'id_pengelola' => $partner->id_pengelola,
                'jenis_transaksi' => $jenisTransaksi,
                'jumlah_saldo' => $jumlahSaldo,
                'kode_pembayaran' => $kodePembayaran,
                'status' => $status,
                'keterangan' => $keterangan,
                'waktu' => $waktu
            ]);

            $partner->save();

            return redirect()->route('partner.saldo')->with('alert', 'Penarikan Saldo Anda Sedang Diproses, Silahkan Periksa Riwayat Transaksi Anda ! ');
        }
    }

    public function tambahPromo()
    {

    }

    public function info()
    {
        return view('pengelola.info_bantuan');
    }

    public function statusToko(Request $request)
    {
        // dd($request->status_toko);
        $status = 'Buka';
        if($request->status_toko != 'Buka')
            $status = 'Tutup';
        $partner = Pengelola_Percetakan::find(Auth::id());
        $partner->status_toko = $status;
        $partner->save();
        return redirect()->back();
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
