<?php

namespace App\Http\Controllers\API\Member;

use App\Http\Controllers\Controller;
use App\Konfigurasi_file;
use App\Member;
use App\Notifications\PesananNotification;
use App\Notifications\PesananPartnerNotification;
use App\Pesanan;
use App\Transaksi_saldo;
use Illuminate\Http\Request;

class KonfigurasiController extends Controller
{

    public function prosesCekWarna(Request $request)
    {
        $pdf = cekWarnaMobile($request->filePDF);

        return responseSuccess("Data Deteksi Warna Halaman", $pdf);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = request()->user();

        $konfigurasi = Konfigurasi_file::create([
            'id_member' => $member->id_member,
            'id_produk' => $request->idProduk,
            'nama_file' => $request->namaFile,
            'jumlah_halaman_berwarna' => $request->jumlahHalamanBerwarna,
            'jumlah_halaman_hitamputih' => $request->jumlahHalamanHitamPutih,
            'status_halaman' => $request->statusHalaman,
            'halaman_terpilih' => $request->halamanTerpilih,
            'jumlah_salinan' => $request->jumlahSalinan,
            'timbal_balik' => $request->timbalBalik,
            'paksa_hitamputih' => $request->paksaHitamPutih,
            'catatan_tambahan' => $request->catatanTambahan,
            'biaya' => $request->biaya,
            'nama_produk' => $request->namaProduk,
            'fitur_terpilih' => $request->fiturTerpilih,
        ]);

        $konfigurasi->addMedia($request->file_konfigurasi)->toMediaCollection('file_konfigurasi');

        if ($konfigurasi) {
            $konfigurasi->fitur_terpilih = json_decode($konfigurasi->fitur_terpilih, true);
            return responseSuccess("Konfigurasi berhasil di simpan", $konfigurasi);
        }
        return responseError("Konfigurasi gagal Disimpan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Konfigurasi_File  $konfigurasi_File
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $konfigurasi_File = Konfigurasi_File::find($id);

        $konfigurasi_File->file_url = $konfigurasi_File->getMedia('file_konfigurasi')[0]->getFullUrl();
        $konfigurasi_File->fitur_terpilih = json_decode($konfigurasi_File->fitur_terpilih, true);
        return responseSuccess("data Konfigurasi file id =" . $konfigurasi_File->id_konfigurasi, $konfigurasi_File);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Konfigurasi_File  $konfigurasi_File
     * @return \Illuminate\Http\Response
     */
    public function updateProduk(Request $request, $id)
    {
        $member = request()->user();

        $konfigurasi_File = Konfigurasi_File::find($id);
        $konfigurasi_File->update([
            'id_member' => $member->id_member,
            'id_produk' => $request->idProduk,
            'nama_file' => $request->namaFile,
            'jumlah_halaman_berwarna' => $request->jumlahHalamanBerwarna,
            'jumlah_halaman_hitamputih' => $request->jumlahHalamanHitamPutih,
            'status_halaman' => $request->statusHalaman,
            'halaman_terpilih' => json_encode($request->halamanTerpilih),
            'jumlah_salinan' => $request->jumlahSalinan,
            'timbal_balik' => $request->timbalBalik,
            'paksa_hitamputih' => $request->paksaHitamPutih,
            'catatan_tambahan' => $request->catatanTambahan,
            'biaya' => $request->biaya,
            'nama_produk' => $request->namaProduk,
            'fitur_terpilih' => $request->fiturTerpilih,
        ]);

        $konfigurasi_File->addMedia($request->file_konfigurasi)->toMediaCollection('file_konfigurasi');

        if ($konfigurasi_File) {
            $konfigurasi_File->fitur_terpilih = json_decode($konfigurasi_File->fitur_terpilih, true);
            return responseSuccess("Konfigurasi Berhasil Di Perbarui", $konfigurasi_File);
        }
        return responseError("Konfigurasi Gagal Di Perbarui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Konfigurasi_File  $konfigurasi_File
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $konfigurasi_File = Konfigurasi_File::find($id);
        if ($konfigurasi_File->delete()) {
            $konfigurasi_File->clearMediaCollection();

            $pesanan = request()->user()->pesanans->where('status', null)->first();
            if (count($pesanan->konfigurasiFile) <= 0) {
                $pesanan->delete();
            }

            return responseSuccess('Konfigurasi file berhasil di hapus');
        }
        return responseError('Gagal menghapus konfigurasi file, silahkan coba kembali');
    }

    public function konfigurasiPesanan(Request $request)
    {
        $konfigurasi = Konfigurasi_file::find($request->konfigurasi);
        $pesanan = request()->user()->pesanans->where('status', null)->first();
        if ($pesanan) {
            if ($konfigurasi) {
                $konfigurasi->pesanan()->associate($pesanan)->save();
            }
            foreach ($pesanan->konfigurasiFile as $key => $konfigurasi) {
                $pesanan->konfigurasiFile[$key]->fitur_terpilih = json_decode($konfigurasi->fitur_terpilih, true);
                $pesanan->konfigurasiFile[$key]->file_url = $konfigurasi->getMedia('file_konfigurasi')[0]->getFullUrl();
                $pesanan->konfigurasiFile[$key]->produk = $konfigurasi->product;
                $pesanan->konfigurasiFile[$key]->produk->fitur = json_decode($pesanan->konfigurasiFile[$key]->produk->fitur, true);
            }
            $pesanan->listAtk = $pesanan->partner->atk;
            return responseSuccess("Data Pesanan", $pesanan);
        }
        if ($konfigurasi) {
            $pesanan = Pesanan::create([
                'id_pengelola' => $konfigurasi->product->partner->id_pengelola,
                'id_member' => $konfigurasi->id_member,
                'metode_penerimaan' => 'Ditempat',
                'biaya' => $konfigurasi->biaya,
            ]);
            $konfigurasi->pesanan()->associate($pesanan)->save();
            foreach ($pesanan->konfigurasiFile as $key => $konfigurasi) {
                $pesanan->konfigurasiFile[$key]->fitur_terpilih = json_decode($konfigurasi->fitur_terpilih, true);
                $pesanan->konfigurasiFile[$key]->file_url = $konfigurasi->getMedia('file_konfigurasi')[0]->getFullUrl();
                $pesanan->konfigurasiFile[$key]->produk = $konfigurasi->product;
                $pesanan->konfigurasiFile[$key]->produk->fitur = json_decode($pesanan->konfigurasiFile[$key]->produk->fitur, true);
            }
            $pesanan->listAtk = $pesanan->partner->atk;
            return responseSuccess("Data Pesanan", $pesanan);
        }

        return responseError('anda belum membuat pesanan');
    }

    public function updateKonfirmasiPesanan($idPesanan, Request $request)
    {
        $member = $request->user();
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
            // $member->notify(new PesananNotification('pembayaranPending', $pesanan));
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
            // $member->notify(new PesananNotification('pembayaranBerhasil', $pesanan));
            // $pesanan->partner->notify(new PesananPartnerNotification('pesananMasuk', $pesanan));
        }

        $pesanan->update([
            'alamat_penerima' => $request->alamatPenerima,
            'metode_penerimaan' => $request->metodePenerimaan,
            'ongkos_kirim' => $request->ongkir,
            'atk_terpilih' => $request->atkTerpilih,
            'biaya' => $request->totalBiaya,
            'status' => 'Pending',
        ]);

        $pesanan->save();
        return responseSuccess("Pesanan berhasil dikonfirmasi", $pesanan);
    }

    public function deleteKonfirmasiPesanan($idPesanan, Request $request)
    {
        $member = $request->user();
        $pesanan = $member->pesanans->find($idPesanan);
        $pesanan->konfigurasiFile->first()->delete();
        $pesanan->konfigurasiFile->first()->clearMediaCollection('file_konfigurasi');
        $pesanan->delete();

        $member->notify(new PesananNotification('pesananDiBatalkan', $pesanan));
        $pesanan->partner->notify(new PesananPartnerNotification('pesananDibatalkan', $pesanan));
        return responseSuccess("Pesanan berhasil dihapus dan dibatalkan");
    }
}
