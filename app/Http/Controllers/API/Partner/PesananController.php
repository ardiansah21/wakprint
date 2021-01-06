<?php

namespace App\Http\Controllers\API\Partner;

use App\Http\Controllers\Controller;
use App\Notifications\PesananNotification;
use App\Notifications\PesananPartnerNotification;
use App\Pesanan;
use Illuminate\Http\Request;
use stdClass;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->status_pesanan == "Pending") {
            $dataArr = array();
            foreach (request()->user()->pesanans as $p) {
                if ($p->isPaid() && $p->status == 'Pending') {
                    $data = new stdClass();
                    $data->id_pesanan = $p->id_pesanan;
                    $data->nama_lengkap = $p->member->nama_lengkap;
                    $data->metode_penerimaan = $p->metode_penerimaan;
                    $data->biaya = $p->biaya;
                    $data->jumlah_file = count($p->konfigurasiFile);
                    $data->nama_file = $p->konfigurasiFile->pluck('nama_file')->all();
                    $data->updated_at = $p->updated_at;
                    array_push($dataArr, $data);
                }
            }
            return responseSuccess("data pesanan masuk partner yang pending", $dataArr);
        } else if ($request->status_pesanan == "Diproses") {
            return responseSuccess("data pesanan partner yang diproses", request()->user()->pesanans->where('status', 'Diproses'));
        } else if ($request->status_pesanan == "Selesai") {
            return responseSuccess("data pesanan partner yang selesai", request()->user()->pesanans->where('status', 'Selesai'));
        } else if ($request->status_pesanan == "Batal") {
            return responseSuccess("data pesanan partner yang batal", request()->user()->pesanans->where('status', 'Batal'));
        } else {
            return responseSuccess("data semua pesanan partner", request()->user()->pesanans);
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

    public function filterPesanan(Request $request)
    {
        $partner = request()->user();
        if ($request->urutkan_pesanan === 'Terbaru') {
            if (!empty($request->keyword_filter)) {
                if ($request->keyword_filter === 'Ambil di Tempat') {
                    $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Ditempat')
                        ->where('status', '!=', 'Pending')
                        ->orWhere('status', $request->keyword_filter)
                        ->orderBy('updated_at', 'desc');
                } else if ($request->keyword_filter === 'Antar ke Rumah' || $request->keyword_filter === 'Diantar') {
                    $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Diantar')
                        ->where('status', '!=', 'Pending')
                        ->orWhere('status', $request->keyword_filter)
                        ->orderBy('updated_at', 'desc');
                } else {
                    $pesanan = $partner->pesanans->first()->where('metode_penerimaan', $request->keyword_filter)
                        ->where('status', '!=', 'Pending')
                        ->orWhere('status', $request->keyword_filter)
                        ->orderBy('updated_at', 'desc');
                }
            } else {
                $pesanan = $partner->pesanans->first()->where('status', '!=', 'Pending')
                    ->orderBy('updated_at', 'desc')
                    ->get();
            }
        } else if ($request->urutkan_pesanan === 'Harga Tertinggi') {
            if (!empty($request->keyword_filter)) {
                if ($request->keyword_filter === 'Ambil di Tempat') {
                    $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Ditempat')
                        ->where('status', '!=', 'Pending')
                        ->orWhere('status', $request->keyword_filter)
                        ->orderBy('biaya', 'desc');
                } else if ($request->keyword_filter === 'Antar ke Rumah' || $request->keyword_filter === 'Diantar') {
                    $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Diantar')
                        ->where('status', '!=', 'Pending')
                        ->orWhere('status', $request->keyword_filter)
                        ->orderBy('biaya', 'desc');
                } else {
                    $pesanan = $partner->pesanans->first()->where('metode_penerimaan', $request->keyword_filter)
                        ->where('status', '!=', 'Pending')
                        ->orWhere('status', $request->keyword_filter)
                        ->orderBy('biaya', 'desc');
                }
            } else {
                $pesanan = $partner->pesanans->first()->orderBy('biaya', 'asc');
            }
        } else if ($request->urutkan_pesanan === 'Harga Terendah') {
            if (!empty($request->keyword_filter)) {
                if ($request->keyword_filter === 'Ambil di Tempat') {
                    $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Ditempat')
                        ->where('status', '!=', 'Pending')
                        ->orWhere('status', $request->keyword_filter)
                        ->orderBy('biaya', 'asc');
                } else if ($request->keyword_filter === 'Antar ke Rumah' || $request->keyword_filter === 'Diantar') {
                    $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Diantar')
                        ->where('status', '!=', 'Pending')
                        ->orWhere('status', $request->keyword_filter)
                        ->orderBy('biaya', 'asc');
                } else {
                    $pesanan = $partner->pesanans->first()->where('metode_penerimaan', $request->keyword_filter)
                        ->where('status', '!=', 'Pending')
                        ->orWhere('status', $request->keyword_filter)
                        ->orderBy('biaya', 'asc');
                }
            } else {
                $pesanan = $partner->pesanans->first()->orderBy('biaya', 'asc');
            }
        } else {
            if (!empty($request->keyword_filter)) {
                if ($request->keyword_filter === 'Ambil di Tempat') {
                    $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Ditempat')
                        ->where('status', '!=', 'Pending')
                        ->orWhere('status', $request->keyword_filter);
                } else if ($request->keyword_filter === 'Antar ke Rumah' || $request->keyword_filter === 'Diantar') {
                    $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Diantar')
                        ->where('status', '!=', 'Pending')
                        ->orWhere('status', $request->keyword_filter);
                } else {
                    $pesanan = $partner->pesanans->first()->where('metode_penerimaan', $request->keyword_filter)
                        ->where('status', '!=', 'Pending')
                        ->orWhere('status', $request->keyword_filter);
                }
            } else {
                if ($partner->pesanans->first()->isPaid()) {
                    $pesanan = $partner->pesanans->first()->where('status', '!=', null)->get();
                }
            }
        }

        return responseSuccess("Hasil filter data pesanan", $pesanan);
    }
}
