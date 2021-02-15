<?php

namespace App\Http\Controllers\Partner;

use App\Exports\TransaksiSaldoPartnerExport;
use App\Http\Controllers\Controller;
use App\Notifications\PesananPartnerNotification;
use App\Notifications\TarikSaldoNotification;
use App\Pengelola_Percetakan;
use App\Pesanan;
use App\Transaksi_saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PartnerController extends Controller
{
    public function index()
    {
        $partner = Auth::user();
        $arrTotalPelanggan = array();
        $arrJumlahDokumen = array();

        foreach ($partner->pesanans as $value) {
            if (!in_array($value->id_member, $arrTotalPelanggan, true)) {
                array_push($arrTotalPelanggan, $value->id_member);
            }
        }

        foreach ($partner->pesanans as $p => $value) {
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
        $menitBuka = $request->menitbuka;
        $jamTutup = $request->jamtutup;
        $menitTutup = $request->menittutup;

        $metodePelayanan[] = array(
            'AmbilDiTempat' => $request->ambiltempat,
            'AntarKeTempat' => $request->antartempat,
        );

        if ($jamBuka > 24 || $jamTutup > 24) {
            alert()->error('Maaf', 'Terdapat kesalahan format pada jam operasional percetakan Anda, silahkan periksa kembali yah');
            return redirect()->back();
        }

        $opBuka = date_create("$jamBuka:$menitBuka");
        $opTutup = date_create("$jamTutup:$menitTutup");

        $partner->nama_toko = $request->namapercetakan;
        $partner->deskripsi_toko = $request->deskripsi;
        $partner->alamat_toko = $request->alamat;
        $partner->url_google_maps = $request->urlmaps;
        $partner->jam_op_buka = $opBuka;
        $partner->jam_op_tutup = $opTutup;
        $partner->ongkir_toko = (int) str_replace('.', '', $request->ongkir_toko);
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
            $partner->addMedia($request->file('foto_partner'))->toMediaCollection('avatar');
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

        return redirect()->route('partner.profile')->with('success', 'Profil berhasil diubah');
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
        $jumlahSaldo = (int) str_replace('.', '', $request->jumlah_saldo);

        if ($partner->jumlah_saldo <= 0) {
            alert()->error('Maaf', 'Saldo Anda kosong');
            return redirect()->route('partner.saldo');
        } else if ($jumlahSaldo > $partner->jumlah_saldo) {
            alert()->error('Maaf', 'Saldo Anda Tidak Mencukupi Untuk Melakukan Penarikan Saldo !');
            return redirect()->route('partner.saldo');
        } else {
            $jenisTransaksi = 'Tarik';
            $kodePembayaran = $jumlahSaldo + rand(1, 999);
            $status = 'Pending';
            $keterangan = 'Penarikan Saldo Sedang Diproses';

            $transaksiSaldo = Transaksi_saldo::create([
                'id_pengelola' => $partner->id_pengelola,
                'jenis_transaksi' => $jenisTransaksi,
                'jumlah_saldo' => $jumlahSaldo,
                'kode_pembayaran' => $kodePembayaran,
                'status' => $status,
                'keterangan' => $keterangan,
            ]);

            $partner->notify(new TarikSaldoNotification('pending', $transaksiSaldo));
            return redirect()->route('partner.saldo')->with('success', 'Penarikan Saldo Anda Sedang Diproses');
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
                    if ($request->tanggalAwal <= $request->tanggalAkhir || $request->tanggalAkhir >= $request->tanggalAwal) {
                        $transaksiSaldo = Transaksi_saldo::where('id_pengelola', Auth::user()->id_pengelola)
                            ->where('jenis_transaksi', 'Tarik')
                            ->orWhere('jenis_transaksi', 'Pembayaran')
                            ->where('status', '!=', null)
                            ->where('updated_at', $request->tanggalAwal)
                            ->orWhere('updated_at', $request->tanggalAkhir)
                            ->get();
                    } else {
                        $transaksiSaldo = Transaksi_saldo::where('id_pengelola', Auth::user()->id_pengelola)
                            ->where('jenis_transaksi', null)
                            ->orWhere('jenis_transaksi', null)
                            ->where('status', '!=', null)
                            ->where('updated_at', null)
                            ->orWhere('updated_at', null)
                            ->get();
                    }
                } else {
                    $transaksiSaldo = Transaksi_saldo::where('id_pengelola', '=', Auth::user()->id_pengelola)
                        ->where('jenis_transaksi', '=', 'Pembayaran')
                        ->where('status', '!=', null)
                        ->get();
                }
            } else if ($request->jenisDana === 'Dana Keluar') {
                if (!empty($request->tanggalAwal) || !empty($request->tanggalAkhir)) {
                    if ($request->tanggalAwal <= $request->tanggalAkhir || $request->tanggalAkhir >= $request->tanggalAwal) {
                        $transaksiSaldo = Transaksi_saldo::where('id_pengelola', Auth::user()->id_pengelola)
                            ->where('jenis_transaksi', 'Tarik')
                            ->orWhere('jenis_transaksi', 'Pembayaran')
                            ->where('status', '!=', null)
                            ->where('updated_at', $request->tanggalAwal)
                            ->orWhere('updated_at', $request->tanggalAkhir)
                            ->get();
                    } else {
                        $transaksiSaldo = Transaksi_saldo::where('id_pengelola', Auth::user()->id_pengelola)
                            ->where('jenis_transaksi', null)
                            ->orWhere('jenis_transaksi', null)
                            ->where('status', '!=', null)
                            ->where('updated_at', null)
                            ->orWhere('updated_at', null)
                            ->get();
                    }
                } else {
                    $transaksiSaldo = Transaksi_saldo::where('id_pengelola', '=', Auth::user()->id_pengelola)
                        ->where('jenis_transaksi', '=', 'Tarik')
                        ->where('status', '!=', null)
                        ->get();
                }
            } else {
                if (!empty($request->tanggalAwal) || !empty($request->tanggalAkhir)) {
                    if ($request->tanggalAwal <= $request->tanggalAkhir || $request->tanggalAkhir >= $request->tanggalAwal) {
                        $transaksiSaldo = Transaksi_saldo::where('id_pengelola', Auth::user()->id_pengelola)
                            ->where('jenis_transaksi', 'Tarik')
                            ->orWhere('jenis_transaksi', 'Pembayaran')
                            ->where('status', '!=', null)
                            ->where('updated_at', $request->tanggalAwal)
                            ->orWhere('updated_at', $request->tanggalAkhir)
                            ->get();
                    } else {
                        $transaksiSaldo = Transaksi_saldo::where('id_pengelola', Auth::user()->id_pengelola)
                            ->where('jenis_transaksi', null)
                            ->orWhere('jenis_transaksi', null)
                            ->where('status', '!=', null)
                            ->where('updated_at', null)
                            ->orWhere('updated_at', null)
                            ->get();
                    }
                } else {
                    $transaksiSaldo = Transaksi_saldo::where('id_pengelola', Auth::user()->id_pengelola)
                        ->where('jenis_transaksi', '!=', 'TopUp')
                        ->where('status', '!=', null)
                        ->get();
                }
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
        return redirect()->back()->with('success', 'Percetakan Anda telah ' . $status);
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

    public function notif()
    {
        $member = Pengelola_Percetakan::find(Auth::id());
        $pesanan = Pesanan::find(1);
        $member->notify(new PesananPartnerNotification('pesananMasuk', $pesanan));
        return "udahh dikirim";
        // Notification::send($member, new PesananPartnerNotification($pesanan));
    }
}
