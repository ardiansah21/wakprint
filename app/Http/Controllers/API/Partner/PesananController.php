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
        $data = new stdClass();
        $data->id_pesanan = $pesanan->id_pesanan;
        $data->nama_lengkap = $pesanan->member->nama_lengkap;
        $data->metode_penerimaan = $pesanan->metode_penerimaan;
        $data->alamat_penerima = $pesanan->alamat_penerima;
        $data->alamat_toko = request()->user()->alamat_toko;
        $data->status = $pesanan->status;
        $data->biaya = $pesanan->biaya;
        $data->jumlah_file = count($pesanan->konfigurasiFile);
        $data->nama_file = $pesanan->konfigurasiFile->pluck('nama_file')->all();
        $data->atk_terpilih = json_decode($pesanan->atk_terpilih, true);
        $data->waktu_estimasi = $pesanan->waktu_estimasi;
        $data->updated_at = $pesanan->updated_at;

        $arrFiturTerpilih = [];
        foreach ($pesanan->konfigurasiFile as $k) {
            $k->halaman_terpilih = json_decode($k->halaman_terpilih, true);
            $k->fitur_terpilih = json_decode($k->fitur_terpilih, true);

            foreach ($k->fitur_terpilih as $ft) {
                array_push($arrFiturTerpilih, [$ft['namaFitur'], $ft['hargaFitur']]);
            }

            $k->fitur_terpilih = $arrFiturTerpilih;
            $k->file_url = $k->getFirstMediaUrl('file_konfigurasi');
            $k->alamat_toko = request()->user()->alamat_toko;
            $k->product->fitur = json_decode($k->product->fitur, true);
            $k->produk = $k->product;
        }

        $data->konfigurasi_file = $pesanan->konfigurasiFile;

        return responseSuccess("detail pesanan partner yang login", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function terimaPesanan(Pesanan $pesanan, Request $request)
    {
        $pesanan->update([
            'status' => 'Diproses',
            'waktu_estimasi' => $request->waktu_estimasi,
        ]);

        $pesanan->save();
        $pesanan->push();

        $data = new stdClass();
        $data->id_pesanan = $pesanan->id_pesanan;
        $data->nama_lengkap = $pesanan->member->nama_lengkap;
        $data->metode_penerimaan = $pesanan->metode_penerimaan;
        $data->alamat_penerima = $pesanan->alamat_penerima;
        $data->alamat_toko = request()->user()->alamat_toko;
        $data->status = $pesanan->status;
        $data->biaya = $pesanan->biaya;
        $data->jumlah_file = count($pesanan->konfigurasiFile);
        $data->nama_file = $pesanan->konfigurasiFile->pluck('nama_file')->all();
        $data->atk_terpilih = json_decode($pesanan->atk_terpilih, true);
        $data->waktu_estimasi = $pesanan->waktu_estimasi;
        $data->updated_at = $pesanan->updated_at;
        $data->konfigurasi_file = $pesanan->konfigurasiFile;

        $arrFiturTerpilih = [];
        foreach ($pesanan->konfigurasiFile as $k) {
            $k->halaman_terpilih = json_decode($k->halaman_terpilih, true);
            $k->fitur_terpilih = json_decode($k->fitur_terpilih, true);

            foreach ($k->fitur_terpilih as $ft) {
                array_push($arrFiturTerpilih, [$ft['namaFitur'], $ft['hargaFitur']]);
            }

            $k->fitur_terpilih = $arrFiturTerpilih;
            $k->file_url = $k->getFirstMediaUrl('file_konfigurasi');
            $k->alamat_toko = request()->user()->alamat_toko;
            $k->product->fitur = json_decode($k->product->fitur, true);
            $k->produk = $k->product;
        }

        $pesanan->member->notify(new PesananNotification('pesananDiterimaPercetakan', $pesanan));
        return responseSuccess("Yeyy pesanan telah diterima !, Silahkan lanjutkan proses pencetakan dokumen pelanggan", $data);
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
        $pesanan->atk_terpilih = json_decode($pesanan->atk_terpilih, true);
        $pesanan->status = "Batal";
        $pesanan->transaksiSaldo->status = "Gagal";
        $pesanan->transaksiSaldo->keterangan = "Pesanan telah ditolak oleh pihak percetakan";
        $pesanan->member->jumlah_saldo += $pesanan->transaksiSaldo->jumlah_saldo;
        $pesanan->member->save();
        $pesanan->member->push();
        $pesanan->transaksiSaldo->save();
        $pesanan->transaksiSaldo->push();
        $pesanan->save();
        $pesanan->push();

        $data = new stdClass();
        $data->id_pesanan = $pesanan->id_pesanan;
        $data->nama_lengkap = $pesanan->member->nama_lengkap;
        $data->metode_penerimaan = $pesanan->metode_penerimaan;
        $data->alamat_penerima = $pesanan->alamat_penerima;
        $data->alamat_toko = request()->user()->alamat_toko;
        $data->status = $pesanan->status;
        $data->biaya = $pesanan->biaya;
        $data->jumlah_file = count($pesanan->konfigurasiFile);
        $data->nama_file = $pesanan->konfigurasiFile->pluck('nama_file')->all();
        $data->atk_terpilih = $pesanan->atk_terpilih;
        $data->waktu_estimasi = $pesanan->waktu_estimasi;
        $data->updated_at = $pesanan->updated_at;
        $data->konfigurasi_file = $pesanan->konfigurasiFile;

        $arrFiturTerpilih = [];
        foreach ($pesanan->konfigurasiFile as $k) {
            $k->halaman_terpilih = json_decode($k->halaman_terpilih, true);
            $k->fitur_terpilih = json_decode($k->fitur_terpilih, true);

            foreach ($k->fitur_terpilih as $ft) {
                array_push($arrFiturTerpilih, [$ft['namaFitur'], $ft['hargaFitur']]);
            }

            $k->fitur_terpilih = $arrFiturTerpilih;
            $k->file_url = $k->getFirstMediaUrl('file_konfigurasi');
            $k->alamat_toko = request()->user()->alamat_toko;
            $k->product->fitur = json_decode($k->product->fitur, true);
            $k->produk = $k->product;
        }

        $pesanan->member->notify(new PesananNotification('pesananDiTolak', $pesanan));
        $pesanan->partner->notify(new PesananPartnerNotification('pesananDiTolak', $pesanan));
        return responseSuccess("Yahh, Pesanan telah ditolak", $data);
    }

    public function selesaiCetakPesanan(Pesanan $pesanan)
    {
        $data = new stdClass();
        $data->id_pesanan = $pesanan->id_pesanan;
        $data->nama_lengkap = $pesanan->member->nama_lengkap;
        $data->metode_penerimaan = $pesanan->metode_penerimaan;
        $data->alamat_penerima = $pesanan->alamat_penerima;
        $data->alamat_toko = request()->user()->alamat_toko;
        $data->status = $pesanan->status;
        $data->biaya = $pesanan->biaya;
        $data->jumlah_file = count($pesanan->konfigurasiFile);
        $data->nama_file = $pesanan->konfigurasiFile->pluck('nama_file')->all();
        $data->atk_terpilih = json_decode($pesanan->atk_terpilih, true);
        $data->waktu_estimasi = $pesanan->waktu_estimasi;
        $data->updated_at = $pesanan->updated_at;
        $data->konfigurasi_file = $pesanan->konfigurasiFile;

        $arrFiturTerpilih = [];
        foreach ($pesanan->konfigurasiFile as $k) {
            $k->halaman_terpilih = json_decode($k->halaman_terpilih, true);
            $k->fitur_terpilih = json_decode($k->fitur_terpilih, true);

            foreach ($k->fitur_terpilih as $ft) {
                array_push($arrFiturTerpilih, [$ft['namaFitur'], $ft['hargaFitur']]);
            }

            $k->fitur_terpilih = $arrFiturTerpilih;
            $k->file_url = $k->getFirstMediaUrl('file_konfigurasi');
            $k->alamat_toko = request()->user()->alamat_toko;
            $k->product->fitur = json_decode($k->product->fitur, true);
            $k->produk = $k->product;
        }

        $pesanan->member->notify(new PesananNotification('pesananSelesaiDiCetak', $pesanan));
        $pesanan->partner->notify(new PesananPartnerNotification('pesananSelesai', $pesanan));
        return responseSuccess("Pesanan Selesai Dicetak, Pesanan Anda telah dikonfirmasi selesai mencetak, silahkan konfirmasikan kembali ke pelanggan untuk memastikan penyelesaian proses pencetakan", $data);
    }

    public function selesaikanPesanan(Pesanan $pesanan)
    {
        $pesanan->atk_terpilih = json_decode($pesanan->atk_terpilih, true);
        $pesanan->status = "Selesai";
        $pesanan->save();
        $pesanan->push();
        $pesanan->transaksiSaldo->keterangan = "Pesanan telah selesai";
        $pesanan->transaksiSaldo->push();
        $pesanan->partner->jumlah_saldo += $pesanan->transaksiSaldo->jumlah_saldo;
        $pesanan->partner->push();
        $pesanan->member->notify(new PesananNotification('pesananSelesaiDiCetak', $pesanan));
        $pesanan->partner->notify(new PesananPartnerNotification('pesananSelesai', $pesanan));
        return responseSuccess("Pesanan Telah Selesai, terima kasih telah melakukan transaksi dengan wakprint yah :)", $pesanan);
    }

    public function filterPesanan(Request $request)
    {
        $partner = request()->user();
        $data = $partner->pesanans;
        $arrFiturTerpilih = [];

        if ($data != null) {
            if ($request->urutkan_pesanan === 'Terbaru') {
                $data = $data->first()->where('id_pengelola', $partner->id_pengelola)
                    ->where('status', $request->status_pesanan)
                    ->where('metode_penerimaan', 'like', '%' . $request->keyword_filter . '%')
                    ->orWhere('id_pesanan', $request->keyword_filter)
                    ->orderBy('updated_at', 'desc')
                    ->get();

            } else if ($request->urutkan_pesanan === 'Harga Tertinggi') {
                $data = $data->first()->where('id_pengelola', $partner->id_pengelola)
                    ->where('status', $request->status_pesanan)
                    ->where('metode_penerimaan', 'like', '%' . $request->keyword_filter . '%')
                    ->orWhere('id_pesanan', $request->keyword_filter)
                    ->orderBy('biaya', 'desc')
                    ->get();
            } else if ($request->urutkan_pesanan === 'Harga Terendah') {
                $data = $data->first()->where('id_pengelola', $partner->id_pengelola)
                    ->where('status', $request->status_pesanan)
                    ->where('metode_penerimaan', 'like', '%' . $request->keyword_filter . '%')
                    ->orWhere('id_pesanan', $request->keyword_filter)
                    ->orderBy('biaya', 'asc')
                    ->get();
            } else {
                if ($data->first()->isPaid() != null && $data->first()->isPaid()) {
                    $data = $data->first()->where('id_pengelola', $partner->id_pengelola)
                        ->where('status', $request->status_pesanan)
                        ->where('metode_penerimaan', 'like', '%' . $request->keyword_filter . '%')
                        ->orWhere('id_pesanan', $request->keyword_filter)
                        ->get();
                }
            }

            foreach ($data as $p) {
                $p->nama_file = $p->konfigurasiFile->pluck('nama_file')->all();
                $p->jumlah_file = count($p->konfigurasiFile);
                $p->nama_lengkap = $p->first()->member->nama_lengkap;
                $p->atk_terpilih = json_decode($p->atk_terpilih, true);
                foreach ($p->konfigurasiFile as $k) {
                    $k->fitur_terpilih = json_decode($k->fitur_terpilih, true);
                    foreach ($k->fitur_terpilih as $ft) {
                        array_push($arrFiturTerpilih, [$ft['namaFitur'], $ft['hargaFitur']]);
                    }
                    $k->fitur_terpilih = $arrFiturTerpilih;
                }
            }

            return responseSuccess("Hasil filter data pesanan", $data);
        } else {
            return responseSuccess("Hasil filter data pesanan kosong");
        }
    }
}
