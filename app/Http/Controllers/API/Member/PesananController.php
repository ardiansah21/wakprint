<?php

namespace App\Http\Controllers\API\Member;

use App\Http\Controllers\Controller;
use App\Notifications\PesananNotification;
use App\Notifications\PesananPartnerNotification;
use App\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
                    $data->nama_toko = $p->partner->nama_toko;
                    $data->metode_penerimaan = $p->metode_penerimaan;
                    $data->biaya = $p->biaya;
                    $data->jumlah_file = count($p->konfigurasiFile);
                    $data->nama_file = $p->konfigurasiFile->pluck('nama_file')->all();
                    $data->updated_at = $p->updated_at;
                    array_push($dataArr, $data);
                }
            }
            return responseSuccess("data pesanan masuk member yang pending", $dataArr);
        } else if ($request->status_pesanan == "Diproses") {
            return responseSuccess("data pesanan member yang diproses", request()->user()->pesanans->where('status', 'Diproses'));
        } else if ($request->status_pesanan == "Selesai") {
            return responseSuccess("data pesanan member yang selesai", request()->user()->pesanans->where('status', 'Selesai'));
        } else if ($request->status_pesanan == "Batal") {
            return responseSuccess("data pesanan member yang batal", request()->user()->pesanans->where('status', 'Batal'));
        } else if ($request->status_pesanan == "Draft") {
            return responseSuccess("data pesanan member yang disimpan", request()->user()->pesanans->where('status', null));
        } else {
            return responseSuccess("data semua pesanan member", request()->user()->pesanans);
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
        $data->alamat_toko = $pesanan->partner->alamat_toko;
        $data->status = $pesanan->status;
        $data->biaya = $pesanan->biaya;
        $data->jumlah_file = count($pesanan->konfigurasiFile);
        $data->nama_file = $pesanan->konfigurasiFile->pluck('nama_file')->all();
        $data->atk_terpilih = json_decode($pesanan->atk_terpilih, true);
        $data->updated_at = $pesanan->updated_at;

        foreach ($pesanan->konfigurasiFile as $k) {
            $k->halaman_terpilih = json_decode($k->halaman_terpilih, true);
            $k->fitur_terpilih = json_decode($k->fitur_terpilih, true);

            foreach ($k->fitur_terpilih as $ft) {

                $ft = [
                    'namaFitur' => $ft['namaFitur'],
                    'hargaFitur' => $ft['hargaFitur'],
                ];

                $k->fitur_terpilih = [$ft];
            }

            $k->file_url = $k->getFirstMediaUrl('file_konfigurasi');
            $k->alamat_toko = $pesanan->partner->alamat_toko;
            $k->product->fitur = json_decode($k->product->fitur, true);
            $k->produk = $k->product;
        }

        $data->konfigurasi_file = $pesanan->konfigurasiFile;
        $data->transaksi_saldo = $pesanan->transaksiSaldo;
        $data->transaksi_saldo->batas_waktu = Carbon::parse($data->transaksi_saldo->updated_at)->addDays(1)->translatedFormat('l, d F Y H:i') . ' WIB';

        return responseSuccess("detail pesanan partner yang login", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function batalkanPesanan(Pesanan $pesanan)
    {
        $pesanan->atk_terpilih = json_decode($pesanan->atk_terpilih, true);
        $pesanan->status = "Batal";
        $pesanan->transaksiSaldo->status = "Gagal";
        $pesanan->transaksiSaldo->keterangan = "Pesanan telah dibatalkan oleh pelanggan";
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
        $data->alamat_toko = $pesanan->partner->alamat_toko;
        $data->status = $pesanan->status;
        $data->biaya = $pesanan->biaya;
        $data->jumlah_file = count($pesanan->konfigurasiFile);
        $data->nama_file = $pesanan->konfigurasiFile->pluck('nama_file')->all();

        if ($pesanan->atk_terpilih[0][0] != "") {
            $data->atk_terpilih = json_decode($pesanan->atk_terpilih, true);
        }

        $data->updated_at = $pesanan->updated_at;
        $data->konfigurasi_file = $pesanan->konfigurasiFile;

        foreach ($data->konfigurasi_file as $k) {
            $k->halaman_terpilih = json_decode($k->halaman_terpilih, true);
            $k->fitur_terpilih = json_decode($k->fitur_terpilih, true);

            foreach ($k->fitur_terpilih as $ft) {

                $ft = [
                    'namaFitur' => $ft['namaFitur'],
                    'hargaFitur' => $ft['hargaFitur'],
                ];

                $k->fitur_terpilih = [$ft];
            }

            $k->file_url = $k->getFirstMediaUrl('file_konfigurasi');
            $k->alamat_toko = $pesanan->partner->alamat_toko;
            $k->produk = $k->product;
            $k->produk->fitur = json_decode($k->produk->fitur, true);
        }

        $data->transaksi_saldo = $pesanan->transaksiSaldo;
        $data->transaksi_saldo->batas_waktu = Carbon::parse($data->transaksi_saldo->updated_at)->addDays(1)->translatedFormat('l, d F Y H:i') . ' WIB';

        $pesanan->member->notify(new PesananNotification('pesananDiBatalkan', $pesanan));
        $pesanan->partner->notify(new PesananPartnerNotification('pesananDiBatalkan', $pesanan));
        return responseSuccess("Yahh, Pesanan telah dibatalkan", $data);
    }

    public function selesaikanPesanan(Pesanan $pesanan)
    {
        $pesanan->atk_terpilih = json_decode($pesanan->atk_terpilih, true);
        $pesanan->status = "Selesai";
        $pesanan->save();
        $pesanan->push();
        $pesanan->transaksiSaldo->status = "Berhasil";
        $pesanan->transaksiSaldo->keterangan = "Pesanan telah selesai";
        $pesanan->transaksiSaldo->push();
        $pesanan->partner->jumlah_saldo += $pesanan->transaksiSaldo->jumlah_saldo;
        $pesanan->partner->push();
        $pesanan->konfigurasi_file = $pesanan->konfigurasiFile;
        $pesanan->nama_lengkap = $pesanan->member->nama_lengkap;
        $pesanan->alamat_toko = $pesanan->partner->alamat_toko;

        foreach ($pesanan->konfigurasi_file as $k) {
            $k->halaman_terpilih = json_decode($k->halaman_terpilih, true);
            $k->fitur_terpilih = json_decode($k->fitur_terpilih, true);

            foreach ($k->fitur_terpilih as $ft) {

                $ft = [
                    'namaFitur' => $ft['namaFitur'],
                    'hargaFitur' => $ft['hargaFitur'],
                ];

                $k->fitur_terpilih = [$ft];
            }

            $k->file_url = $k->getFirstMediaUrl('file_konfigurasi');
            $k->alamat_toko = $pesanan->partner->alamat_toko;
            $k->produk = $k->product;
            $k->produk->fitur = json_decode($k->produk->fitur, true);
        }

        $pesanan->member->notify(new PesananNotification('pesananSelesai', $pesanan));
        $pesanan->partner->notify(new PesananPartnerNotification('pesananSelesai', $pesanan));
        return responseSuccess("Pesanan Telah Selesai, terima kasih telah melakukan transaksi dengan wakprint yah :)", $pesanan);
    }

    public function filterPesanan(Request $request)
    {
        $member = request()->user();
        $data = $member->pesanans;

        if ($data != null) {
            if ($request->status_pesanan === 'Draft') {

                $data = request()->user()->pesanans->where('status', null)->first();
                if (!empty($data)) {
                    foreach ($data->konfigurasiFile as $key => $kf) {
                        $kf->fitur_terpilih = json_decode($kf->fitur_terpilih, true);
                        $data->konfigurasiFile[$key] = $kf;
                    }
                    $data->nama_file = $data->konfigurasiFile->pluck('nama_file')->all();
                    $data->jumlah_file = count($data->konfigurasiFile);
                    $data->nama_toko = $data->first()->partner->nama_toko;
                    $data->atk_terpilih = json_decode($data->atk_terpilih, true);
                    return responseSuccess("Hasil filter data pesanan " . $request->status_pesanan . " member", [$data]);
                } else {
                    if ($data != null) {
                        return responseSuccess("Hasil filter data pesanan " . $request->status_pesanan . " member", [$data]);
                    } else {
                        return responseSuccess("Hasil filter data pesanan " . $request->status_pesanan . " member", []);
                    }
                }
            } else {
                if ($request->urutkan_pesanan === 'Terbaru') {
                    $data = $data->first()->where('id_member', $member->id_member)
                        ->where('status', $request->status_pesanan)
                        ->where('metode_penerimaan', 'like', '%' . $request->keyword_filter . '%')
                        ->orWhere('id_pesanan', $request->keyword_filter)
                        ->orderBy('updated_at', 'desc')
                        ->get();

                } else if ($request->urutkan_pesanan === 'Harga Tertinggi') {
                    $data = $data->first()->where('id_member', $member->id_member)
                        ->where('status', $request->status_pesanan)
                        ->where('metode_penerimaan', 'like', '%' . $request->keyword_filter . '%')
                        ->orWhere('id_pesanan', $request->keyword_filter)
                        ->orderBy('biaya', 'desc')
                        ->get();
                } else if ($request->urutkan_pesanan === 'Harga Terendah') {
                    $data = $data->first()->where('id_member', $member->id_member)
                        ->where('status', $request->status_pesanan)
                        ->where('metode_penerimaan', 'like', '%' . $request->keyword_filter . '%')
                        ->orWhere('id_pesanan', $request->keyword_filter)
                        ->orderBy('biaya', 'asc')
                        ->get();
                } else {
                    if ($data->first()->isPaid()) {
                        $data = $data->first()->where('id_member', $member->id_member)
                            ->where('status', $request->status_pesanan)
                            ->where('metode_penerimaan', 'like', '%' . $request->keyword_filter . '%')
                            ->orWhere('id_pesanan', $request->keyword_filter)
                            ->get();
                    }
                }
                foreach ($data as $p) {
                    $p->nama_file = $p->konfigurasiFile->pluck('nama_file')->all();
                    $p->jumlah_file = count($p->konfigurasiFile);
                    $p->nama_toko = $p->first()->partner->nama_toko;
                    $p->atk_terpilih = json_decode($p->atk_terpilih, true);
                    foreach ($p->konfigurasiFile as $k) {
                        $k->fitur_terpilih = json_decode($k->fitur_terpilih, true);
                        foreach ($k->fitur_terpilih as $ft) {

                            $ft = [
                                'namaFitur' => $ft['namaFitur'],
                                'hargaFitur' => $ft['hargaFitur'],
                            ];
                            $k->fitur_terpilih = [$ft];
                        }
                    }
                }
                return responseSuccess("Hasil filter data pesanan " . $request->status_pesanan . " member", $data);
            }
        } else {
            return responseSuccess("Hasil filter data pesanan kosong");
        }
    }
}
