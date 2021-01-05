<?php

namespace App\Http\Controllers\API\Partner;

use App\Http\Controllers\Controller;
use App\Notifications\PesananNotification;
use App\Notifications\PesananPartnerNotification;
use App\Pesanan;
use App\Transaksi_saldo;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return responseSuccess("data pesanan partner yang login", request()->user()->pesanans);
    }

    public function getPesananMasuk()
    {
        $jumlahFile = count(request()->user()->pesanans->first()->konfigurasiFile);

        $transaksiSaldo = Transaksi_saldo::where('id_pengelola', request()->user()->id_pengelola)
            ->where('jenis_transaksi', 'Pembayaran')
            ->where('status', 'Berhasil')
            ->get();

        if (!empty($transaksiSaldo) && !empty(request()->user()->pesanans->where('status', 'Pending'))) {
            $data = [
                "pesanan" => request()->user()->pesanans->where('status', 'Pending'),
                "jumlah_file" => $jumlahFile,
            ];
            return responseSuccess("data pesanan masuk partner yang login", json_decode(json_encode($data), true));
        } else {
            return responseError("data pesanan masuk partner tidak ada");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pesanan $pesanan)
    {
        $atks = json_decode($pesanan->find('atk_terpilih'));
        return responseSuccess("detail pesanan partner yang login", [$pesanan, $atks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Pesanan $pesanan)
    {
        $pesanan->update(['status' => request()->status]);
        $pesanan->save();
        $pesanan->member->notify(new PesananNotification('pesananDiterimaPercetakan', $pesanan));
        return responseSuccess("Yeyy pesanan telah diterima !, Silahkan lanjutkan proses pencetakan dokumen pelanggan", $pesanan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function tolakPesanan(Pesanan $pesanan)
    {

        // $pesanan = json_encode($pesanan, true);
        // return responseSuccess("dsdf", $pesanan);
        $pesanan->status = "Batal";
        // $pesanan->status = request()->status;
        // $pesanan->transaksiSaldo->status = "Gagal";
        // $pesanan->transaksiSaldo->keterangan = "Pesanan telah ditolak oleh pihak percetakan";
        // $pesanan->member->jumlah_saldo += $pesanan->transaksiSaldo->jumlah_saldo;
        // $pesanan->member->save();
        // $pesanan->transaksiSaldo->save();
        $pesanan->save();
        $pesanan->member->notify(new PesananNotification('pesananDiTolak', $pesanan));
        $pesanan->partner->notify(new PesananPartnerNotification('pesananDiTolak', $pesanan));
        return responseSuccess("Yahh, Pesanan telah ditolak", $pesanan);
    }

    public function selesaikanPesanan(Pesanan $pesanan)
    {
        $pesanan->status = "Selesai";
        $pesanan->save();
        $pesanan->transaksiSaldo->keterangan = "Pesanan telah selesai";
        $pesanan->transaksiSaldo->push();
        $pesanan->partner->jumlah_saldo += $pesanan->transaksiSaldo->jumlah_saldo;
        $pesanan->partner->push();

        $pesanan->member->notify(new PesananNotification('pesananSelesaiDiCetak', $pesanan));
        $pesanan->partner->notify(new PesananPartnerNotification('pesananSelesai', $pesanan));
        return responseSuccess("Pesanan Selesai Dicetak, Pesanan Anda telah dikonfirmasi selesai mencetak, silahkan konfirmasikan kembali ke pelanggan untuk memastikan penyelesaian proses pencetakan", $pesanan);
    }
}
