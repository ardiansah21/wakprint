<?php

namespace App\Http\Controllers\API\Member;

use App\Http\Controllers\Controller;
use App\Konfigurasi_file;
use App\Pesanan;
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
            'halaman_terpilih' => json_encode($request->halamanTerpilih),
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
    public function show(Konfigurasi_File $konfigurasi_File)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Konfigurasi_File  $konfigurasi_File
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konfigurasi_File $konfigurasi_File)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Konfigurasi_File  $konfigurasi_File
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konfigurasi_File $konfigurasi_File)
    {
        //
    }

    public function konfigurasiPesanan(Request $request)
    {
        $konfigurasi = Konfigurasi_file::find($request->konfigurasi);
        $pesanan = request()->user()->pesanans->where('status', null)->first();
        if ($pesanan) {
            if ($konfigurasi) {
                $konfigurasi->pesanan()->associate($pesanan)->save();
            }
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
            return responseSuccess("Data Pesanan", $pesanan);
        }

        return responseError('anda belum membuat pesanan');
    }
}
