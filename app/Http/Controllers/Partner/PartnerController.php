<?php

namespace App\Http\Controllers\Partner;

use App\Exports\TransaksiSaldoPartnerExport;
use App\Http\Controllers\Controller;
use App\Pengelola_Percetakan;
use App\Pesanan;
use App\Transaksi_saldo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Str;

class PartnerController extends Controller
{
    public function index()
    {
        $partner = Auth::user();
        // $pesanan = $partner->pesanan;
        // dd($pesanan->first()->status);
        $arrTotalPelanggan = array();
        $arrJumlahDokumen = array();

        foreach ($partner->pesanan as $value) {
            if (!in_array($value->id_member, $arrTotalPelanggan, true)) {
                array_push($arrTotalPelanggan, $value->id_member);
            }
        }

        foreach ($partner->pesanan as $p => $value) {
            array_push($arrJumlahDokumen, $value->nama_file);
        }

        $totalPelanggan = count($arrTotalPelanggan);
        $jumlahDokumen = count($arrJumlahDokumen);
        return view('pengelola.homepage', compact('partner', 'totalPelanggan', 'jumlahDokumen'));
    }

    public function profile()
    {
        $partner = Auth::user();
        return view('pengelola.profil', [
            'partner' => $partner,
        ]);
    }

    public function profileEdit()
    {
        $partner = Pengelola_Percetakan::find(Auth::id());
        return view('pengelola.edit_profil', ['partner' => $partner]);
    }

    public function profileUpdate(Request $request)
    {
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
        $partner->ntkwh = $request->ntkwh;

        $partner->save();
        if ($request->file('foto_partner') != null) {
            $partner->clearMediaCollection();
            $partner->addMedia($request->file('foto_partner'))->toMediaCollection();
        }

        if (count($partner->getMedia('foto_percetakan')) > 0) {
            foreach ($partner->getMedia('foto_percetakan') as $media) {
                if (!in_array($media->file_name, $request->input('document', []))) {
                    $media->delete();
                }
            }
        }

        $media = $partner->getMedia('foto_percetakan')->pluck('file_name')->toArray();

        if ($request->input('document', []) != null) {
            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $partner->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('foto_percetakan');
                }
            }
        }

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

        if ($partner->jumlah_saldo <= 0) {
            return redirect()->route('partner.saldo')->with('alert', 'Saldo Anda Kosong !');
        } else if ($jumlahSaldo > $partner->jumlah_saldo) {
            return redirect()->route('partner.saldo')->with('alert', 'Saldo Anda Tidak Mencukupi Untuk Melakukan Penarikan Saldo !');
        } else {
            $jenisTransaksi = 'Tarik';
            $partner->jumlah_saldo = $partner->jumlah_saldo - $jumlahSaldo;
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
                'waktu' => $waktu,
            ]);

            $partner->save();

            return redirect()->route('partner.saldo')->with('alert', 'Penarikan Saldo Anda Sedang Diproses, Silahkan Periksa Riwayat Transaksi Anda ! ');
        }
    }

    public function exportTransaksiSaldo()
    {
        return Excel::download(new TransaksiSaldoPartnerExport, 'export_transaksi_saldo.xlsx');
    }

    public function filterSaldo(Request $request)
    {
        if ($request->ajax()) {
            if ($request->jenisDana === 'Dana Masuk') {
                if (!empty($request->tanggalAwal) || !empty($request->tanggalAkhir)) {
                    $transaksiSaldo = Transaksi_saldo::where('jenis_transaksi', '=', 'Pembayaran')
                        ->where('id_pengelola', '=', $request->idPartner)
                        ->where('status', '=', 'Berhasil')
                        ->orWhere('status', '=', 'Gagal')
                        ->where('waktu', '=', $request->tanggalAwal)
                        ->orWhere('waktu', '=', $request->tanggalAkhir)
                        ->get();
                } else {
                    $transaksiSaldo = Transaksi_saldo::where('jenis_transaksi', '=', 'Pembayaran')
                        ->where('id_pengelola', '=', $request->idPartner)
                        ->where('status', '=', 'Berhasil')
                        ->orWhere('status', '=', 'Gagal')
                        ->get();
                }
                // $transaksiSaldo = Transaksi_saldo::where('jenis_transaksi', '=', 'Pembayaran')
                //         ->where('id_pengelola', '=', $request->idPartner)
                //         ->where('status', '=', 'Berhasil')
                //         ->orWhere('status', '=', 'Gagal')
                //         ->get();
            } else if ($request->jenisDana === 'Dana Keluar') {
                if (!empty($request->tanggalAwal) || !empty($request->tanggalAkhir)) {
                    $transaksiSaldo = Transaksi_saldo::where('jenis_transaksi', '=', 'Tarik')
                        ->where('id_pengelola', '=', $request->idPartner)
                        ->where('waktu', '=', $request->tanggalAwal)
                        ->orWhere('waktu', '=', $request->tanggalAkhir)
                        ->get();
                } else {
                    $transaksiSaldo = Transaksi_saldo::where('jenis_transaksi', '=', 'Tarik')
                        ->where('id_pengelola', '=', $request->idPartner)
                        ->get();
                }
                // $transaksiSaldo = Transaksi_saldo::where('jenis_transaksi', '=', 'Tarik')
                //         ->where('id_pengelola', '=', $request->idPartner)
                //         ->get();
            } else {
                if (!empty($request->tanggalAwal) || !empty($request->tanggalAkhir)) {
                    $transaksiSaldo = Transaksi_saldo::where('id_pengelola', '=', $request->idPartner)
                        ->where(function ($q) {
                            $q->where('jenis_transaksi', '=', 'Pembayaran')
                                ->where(function ($q) {
                                    $q->where('status', '=', 'Berhasil')
                                        ->orWhere('status', '=', 'Gagal');
                                })
                                ->orWhere('jenis_transaksi', '=', 'Tarik');
                        })
                        ->where('waktu', '=', $request->tanggalAwal)
                        ->orWhere('waktu', '=', $request->tanggalAkhir)
                        ->get();
                } else {
                    $transaksiSaldo = Transaksi_saldo::where('id_pengelola', '=', $request->idPartner)
                        ->where('jenis_transaksi', '=', 'Pembayaran')
                        ->where(function ($q) {
                            $q->where('status', '=', 'Berhasil')
                                ->orWhere('status', '=', 'Gagal');
                        })
                        ->orWhere('jenis_transaksi', '=', 'Tarik')
                        ->get();
                }
                // $transaksiSaldo = Transaksi_saldo::where('id_pengelola', '=', $request->idPartner)
                //         ->where('jenis_transaksi', '=', 'Pembayaran')
                //         ->where(function($q){
                //             $q->where('status', '=', 'Berhasil')
                //             ->orWhere('status', '=', 'Gagal');
                //         })
                //         ->orWhere('jenis_transaksi', '=', 'Tarik')
                //         ->get();
            }

            return response()->json([
                'transaksiSaldo' => $transaksiSaldo,
            ], 200);
        }
    }

    public function info()
    {
        return view('pengelola.info_bantuan');
    }

    public function statusToko(Request $request)
    {
        $status = 'Buka';
        if ($request->status_toko != 'Buka') {
            $status = 'Tutup';
        }

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

    public function pengujianDeteksiWarna()
    {
        return view('pengujian');
    }
}
