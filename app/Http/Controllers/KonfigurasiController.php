<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Konfigurasi_file;
use App\Member;
use App\Notifications\PesananNotification;
use App\Notifications\PesananPartnerNotification;
use App\Pesanan;
use App\Produk;
use App\Transaksi_saldo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class KonfigurasiController extends Controller
{
    public function uploadFile(Request $request)
    {
        $file = $request->file('fileUpload');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('tmp' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR), $fileName);
        $path = public_path('tmp' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR) . $fileName;

        $countPage = preg_match_all("/\/Page\W/", file_get_contents($path), $dummy);
        // $countPage = 5;
        $fileUpload = new stdClass();
        $fileUpload->name = $fileName;
        $fileUpload->path = $path;
        $fileUpload->countPage = $countPage;

        $request->session()->put('fileUpload', $fileUpload);

        return redirect()->back();
    }

    public function selectedProduk(Request $request, $produkId)
    {
        $p = Produk::find($produkId);
        $request->session()->put('produkKonfigurasiFile', $p);

        if ($request->fromKonfigurasi == true) {
            return redirect()->route('konfigurasi.edit', [$request->id_konfigurasi]);
        } else {
            return redirect()->route('konfigurasi.file');
        }
    }

    public function prosesCekWarna(Request $request)
    {
        if ($request->ajax()) {
            $pdf = cekWarnaNew(
                $request->path,
                $request->percenMin
            );

            $request->session()->put('KonfigurasiCekwarna', $pdf);
            return response()->json($pdf, 200);
        }
    }

    public function tambahKonfigurasi(Request $request)
    {
        $member = Auth::user();

        $konfigurasi = Konfigurasi_file::create([
            'id_member' => $member->id_member,
            'id_produk' => $request->idProduk,
            'nama_file' => $request->namaFile,
            'jumlah_halaman_berwarna' => $request->jumlahHalamanBerwarna,
            'jumlah_halaman_hitamputih' => $request->jumlahHalamanHitamPutih,
            'status_halaman' => $request->statusHalaman,
            'halaman_terpilih' => json_encode($request->halamanTerpilih),
            'jumlah_salinan' => $request->jumlahSalinan,
            'paksa_hitamputih' => $request->paksaHitamPutih,
            'timbal_balik' => $request->timbalBalik,
            'biaya' => $request->biaya,
            'catatan_tambahan' => $request->catatanTambahan,
            'nama_produk' => $request->namaProduk,
            'fitur_terpilih' => $request->fiturTerpilih,
        ]);

        $konfigurasi->addMedia($request->file_konfigurasi)->toMediaCollection('file_konfigurasi');

        $request->session()->forget('fileUpload');
        $request->session()->forget('produkKonfigurasiFile');
        $request->session()->forget('KonfigurasiCekwarna');
        return redirect()->action('KonfigurasiController@konfigurasiPesanan', ['konfigurasi' => $konfigurasi]);

    }

    public function kustomHal(Request $request)
    {
        if ($request->ajax()) {
            $hh = preg_split("/[\s,,]+/", $request->nilaiKustomHal);
            $hasil = array();

            foreach ($hh as $h) {
                if (strpos($h, '-') != false) {
                    $kk = explode("-", $h);
                    for ($i = $kk[0]; $i <= $kk[1]; $i++) {
                        array_push($hasil, $i);
                    }
                } else {
                    array_push($hasil, $h);
                }
            }
            sort($hasil);
            return $hasil;
        }
    }

    public function storeEditKonfigurasi($id, Request $request)
    {
        $member = Auth::user();
        $konfigurasi = $member->konfigurasi->first()->find($id);

        $konfigurasi->update([
            'id_member' => $member->id_member,
            'id_produk' => $request->idProduk,
            'nama_file' => $request->namaFile,
            'jumlah_halaman_berwarna' => $request->jumlahHalamanBerwarna,
            'jumlah_halaman_hitamputih' => $request->jumlahHalamanHitamPutih,
            'status_halaman' => $request->statusHalaman,
            'halaman_terpilih' => json_encode($request->halamanTerpilih),
            'jumlah_salinan' => $request->jumlahSalinan,
            'paksa_hitamputih' => $request->paksaHitamPutih,
            'timbal_balik' => $request->timbalBalik,
            'biaya' => $request->biaya,
            'catatan_tambahan' => $request->catatanTambahan,
            'nama_produk' => $request->namaProduk,
            'fitur_terpilih' => $request->fiturTerpilih,
        ]);

        if (!empty($request->fileKonfigurasi)) {
            $media = $konfigurasi->getFirstMedia('file_konfigurasi');
            $media->delete();
            $konfigurasi->addMedia($request->fileKonfigurasi)->toMediaCollection('file_konfigurasi');
            // if ($request->session()->has('produkKonfigurasiFile')) {
            //     $konfigurasi->addMedia($konfigurasi->getFirstMedia('file_konfigurasi'))->toMediaCollection('file_konfigurasi');
            // } else {
            //     $konfigurasi->addMedia($request->fileKonfigurasi)->toMediaCollection('file_konfigurasi');
            // }
        }

        $request->session()->forget('fileUpload');
        $request->session()->forget('produkKonfigurasiFile');
        $request->session()->forget('KonfigurasiCekwarna');

        if ($konfigurasi) {
            return redirect()->route('konfigurasi.pesanan');
        }
        return response()->json(['status' => 'error'], 400);
    }

    public function editKonfigurasi($id, Request $request)
    {
        $member = Auth::user();
        $konfigurasi = $member->konfigurasi->find($id);
        $pdf = $konfigurasi->getFirstMediaPath('file_konfigurasi');

        function countPages($path)
        {
            $pdftext = file_get_contents($path);
            $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
            return $num;
        }

        $countPage = countPages($pdf);
        // $pdf = new Pdf(public_path('storage/' . $konfigurasi->id_konfigurasi . '/' . $konfigurasi->getMedia('file_konfigurasi')->first()->file_name));
        // $countPage = $pdf->getNumberOfPages();
        $produk = $konfigurasi->product;

        return view('member.edit_konfigurasi_file', compact('member', 'konfigurasi', 'produk', 'countPage'));
    }

    public function hapusKonfigurasi($id)
    {
        $member = Auth::user();
        $konfigurasi = $member->konfigurasi->first()->find($id);
        // $pesanan = $konfigurasi->pesanan;
        $konfigurasi->delete();
        // $pesanan->delete();
        return response()->json(['status' => 'success'], 204);
    }

    public function konfigurasiPesanan(Request $request)
    {
        $konfigurasi = Konfigurasi_file::find($request->konfigurasi);
        $pesanan = Auth::user()->pesanans->where('status', null)->first();
        if ($pesanan) {
            if ($konfigurasi) {
                $konfigurasi->pesanan()->associate($pesanan)->save();
            }
            return view('member.konfigurasi_pesanan', ['pesanan' => $pesanan]);
        }
        if ($konfigurasi) {
            $pesanan = Pesanan::create([
                'id_pengelola' => $konfigurasi->product->partner->id_pengelola,
                'id_member' => $konfigurasi->id_member,
                'metode_penerimaan' => 'Ditempat',
                'biaya' => $konfigurasi->biaya,
            ]);
            $konfigurasi->pesanan()->associate($pesanan)->save();
            return view('member.konfigurasi_pesanan', ['pesanan' => $pesanan]);
        }

        return redirect()->back()->with('error', 'anda belum membuat pesanan');
    }

    public function createPesanan(Request $request)
    {
        return response()->json($request->all(), 201);
    }
    public function konfirmasiPesanan(Request $request)
    {
        $konFileTerpilih = Konfigurasi_file::findMany(explode(',', $request->konFileTerpilih));
        $member = Auth::user();
        $idPesanan = $konFileTerpilih->first()->pesanan->id_pesanan;
        $atks = array_chunk(explode(',', $request->atks), 4);
        $penerimaan = $request->penerimaan;
        $subTotalFile = $request->subTotalFile;

        if ($konFileTerpilih->first()->pesanan->metode_penerimaan != "Ditempat") {
            $ongkir = $request->ongkir;
            $totalBiaya = $request->totalBiaya + $ongkir;
        } else {
            $ongkir = 0;
            $totalBiaya = $request->totalBiaya;
        }

        return view('member.konfirmasi_pesanan', compact('idPesanan', 'member', 'konFileTerpilih', 'atks', 'penerimaan', 'subTotalFile', 'ongkir', 'totalBiaya'));
    }

    public function updateKonfirmasiPesanan($idPesanan, Request $request)
    {
        $member = Member::find(Auth::id());
        $pesanan = $member->pesanans->find($idPesanan);

        if ($member->jumlah_saldo < $request->totalBiaya) {
            $transaksiSaldo = Transaksi_saldo::create([
                'id_pesanan' => $idPesanan,
                'id_pengelola' => $pesanan->partner->id_pengelola,
                'id_member' => $member->id_member,
                'jenis_transaksi' => 'Pembayaran',
                'jumlah_saldo' => $request->totalBiaya,
                'kode_pembayaran' => $request->totalBiaya + rand(1, 999),
                'status' => 'Pending',
                'keterangan' => 'Pembayaran sedang diproses',
            ]);
            $transaksiSaldo->save();
            $member->notify(new PesananNotification('pembayaranPending', $pesanan));
        } else {
            $transaksiSaldo = Transaksi_saldo::create([
                'id_pesanan' => $idPesanan,
                'id_pengelola' => $pesanan->partner->id_pengelola,
                'id_member' => $member->id_member,
                'jenis_transaksi' => 'Pembayaran',
                'jumlah_saldo' => $request->totalBiaya,
                'kode_pembayaran' => $request->totalBiaya + rand(1, 999),
                'status' => 'Berhasil',
                'keterangan' => 'Pembayaran telah berhasil dilakukan',
            ]);
            $sisaSaldo = $member->jumlah_saldo - $request->totalBiaya;
            $member->jumlah_saldo = $sisaSaldo;

            $member->save();
            $transaksiSaldo->save();
            $member->notify(new PesananNotification('pembayaranBerhasil', $pesanan));
            $pesanan->partner->notify(new PesananPartnerNotification('pesananMasuk', $pesanan));
        }

        $pesanan->update([
            'atk_terpilih' => $request->atkTerpilih,
            'alamat_penerima' => $request->alamatPenerima,
            'metode_penerimaan' => $request->metodePenerimaan,
            'ongkos_kirim' => $request->ongkir,
            'atk_terpilih' => $request->atkTerpilih,
            'biaya' => $request->totalBiaya,
            'status' => 'Pending',
        ]);

        $pesanan->save();
        // dd(json_decode($pesanan->atk_terpilih));
        return redirect()->route('konfirmasi.pembayaran', $idPesanan);
    }

    public function deleteKonfirmasiPesanan($idPesanan, Request $request)
    {
        $member = Member::find(Auth::id());
        $pesanan = $member->pesanans->find($idPesanan);
        // $konfigurasiPesanan = $pesanan->konfgurasiFile

        $pesanan->konfigurasiFile->first()->delete();
        $pesanan->konfigurasiFile->first()->clearMediaCollection('file_konfigurasi');
        $pesanan->delete();

        $member->notify(new PesananNotification('pesananDiBatalkan', $pesanan));
        $pesanan->partner->notify(new PesananPartnerNotification('pesananDibatalkan', $pesanan));
        // dd(json_decode($pesanan->atk_terpilih));
        return redirect()->route('pesanan');
    }

    public function konfirmasiPembayaran($idPesanan, Request $request)
    {
        $pesanan = Pesanan::find($idPesanan);
        $konFileTerpilih = $pesanan->konfigurasiFile;
        $member = Auth::user();
        $transaksiSaldo = $pesanan->transaksiSaldo;
        $atks = json_decode($pesanan->atk_terpilih);
        $penerimaan = $pesanan->metode_penerimaan;
        $subTotalFile = count($pesanan->konfigurasiFile);
        $batasWaktuTransaksi = Carbon::parse($transaksiSaldo->updated_at)->addDays(1)->translatedFormat('l, d F Y H:i');
        $waktuTransaksiExpired = Carbon::parse($transaksiSaldo->updated_at)->translatedFormat('l, d F Y H:i');

        if ($penerimaan != "Ditempat") {
            $ongkir = $pesanan->ongkos_kirim;
            $totalBiaya = $pesanan->biaya + $ongkir;
        } else {
            $ongkir = 0;
            $totalBiaya = $pesanan->biaya;
        }
        return view('member.detail_pesanan', compact('member', 'pesanan', 'konFileTerpilih', 'atks', 'penerimaan', 'subTotalFile', 'ongkir', 'totalBiaya', 'transaksiSaldo', 'batasWaktuTransaksi', 'waktuTransaksiExpired'));
    }

    public function cancelPesanan($idPesanan)
    {
        $pesanan = Pesanan::find($idPesanan);
        $transaksiSaldo = $pesanan->transaksiSaldo;

        if ($transaksiSaldo->status != 'Pending') {
            $pesanan->member->jumlah_saldo += $transaksiSaldo->jumlah_saldo;
            $pesanan->member->save();
        }

        $pesanan->status = "Batal";
        $transaksiSaldo->status = "Gagal";
        $transaksiSaldo->keterangan = "Pesanan telah dibatalkan oleh pelanggan";

        $pesanan->save();
        $transaksiSaldo->save();

        $pesanan->member->notify(new PesananNotification('pesananDiBatalkan', $pesanan));
        $pesanan->partner->notify(new PesananPartnerNotification('pesananDibatalkan', $pesanan));

        return redirect()->route('pesanan');
    }

    public function selesaikanPesanan($idPesanan)
    {
        $pesanan = Pesanan::find($idPesanan);
        $partner = $pesanan->partner;
        $transaksiSaldo = $pesanan->transaksiSaldo;

        $pesanan->status = "Selesai";
        $transaksiSaldo->status = "Berhasil";
        $transaksiSaldo->keterangan = "Pesanan telah selesai";
        $partner->jumlah_saldo += $transaksiSaldo->jumlah_saldo;

        $partner->save();
        $pesanan->save();
        $transaksiSaldo->save();

        $pesanan->member->notify(new PesananNotification('pesananSelesai', $pesanan));

        return redirect()->route('pesanan');
    }
}
