<?php

namespace App\Http\Controllers\API\Partner;

use App\Http\Controllers\Controller;
use App\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return responseSuccess("data seluruh promo produk", collect(request()->user()->products->where('status_diskon', 'Tersedia'))->map(function ($item) {
            return collect($item)->only([
                'id_produk',
                'nama',
                'jumlah_diskon',
                'maksimal_diskon',
                'mulai_waktu_diskon',
                'selesai_waktu_diskon',
            ]);
        }));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Produk $produk)
    {
        $validator = Validator::make($request->all(), [
            'id_produk' => ['required', 'numeric'],
            'jumlah_diskon' => ['required', 'numeric'],
            'maksimal_diskon' => ['required', 'numeric'],
            'mulai_waktu_diskon' => ['required', 'date'],
            'selesai_waktu_diskon' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $partner = request()->user();
        // $arrIdProduk = array();

        // foreach (json_decode($request->id_produk) as $id) {
        //     array_push($arrIdProduk, $id);
        // }

        // $months = ['Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4, 'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8, 'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12];
        $statusDiskon = 'Tersedia';
        $maksimalDiskon = $request->maksimal_diskon;
        // $tanggalMulai = $request->tanggal_mulai_promo;
        // $bulanMulai = $months[$request->bulan_mulai_promo];
        // $tahunMulai = $request->tahun_mulai_promo;
        $jumlahDiskon = $request->jumlah_diskon / 100;
        // $tanggalSelesai = $request->tanggal_selesai_promo;
        // $bulanSelesai = $months[$request->bulan_selesai_promo];
        // $tahunSelesai = $request->tahun_selesai_promo;
        // $tanggalMulaiPromo = "$tahunMulai-$bulanMulai-$tanggalMulai";
        // $tanggalSelesaiPromo = "$tahunSelesai-$bulanSelesai-$tanggalSelesai";
        $tanggalMulaiPromo = $request->mulai_waktu_diskon;
        $tanggalSelesaiPromo = $request->selesai_waktu_diskon;

        if ($tanggalMulaiPromo < Carbon::now()->format('Y-m-d')) {
            return responseError('Maaf waktu mulai promo tidak boleh menggunakan waktu lampau, silahkan periksa kembali yah');
        } else if ($tanggalSelesaiPromo < Carbon::now()->format('Y-m-d')) {
            return responseError('Maaf waktu selesai promo tidak boleh menggunakan waktu lampau, silahkan periksa kembali yah');
        }

        if ($tanggalMulaiPromo > $tanggalSelesaiPromo) {
            return responseError('Maaf waktu mulai promo tidak boleh melewati masa waktu selesai promo, silahkan periksa kembali yah');
        }

        // foreach ($request->id_produk as $id) {
        $produk = $partner->products->find($request->id_produk);
        $produk->status_diskon = $statusDiskon;
        $produk->maksimal_diskon = (int) str_replace('.', '', $maksimalDiskon);
        $produk->mulai_waktu_diskon = $tanggalMulaiPromo;
        $produk->jumlah_diskon = $jumlahDiskon;
        $produk->mulai_waktu_diskon = $tanggalMulaiPromo;
        $produk->selesai_waktu_diskon = $tanggalSelesaiPromo;
        $produk->save();
        // }

        return responseSuccess('Anda berhasil menambahkan promo baru pada produk Anda', $produk, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $validator = Validator::make($request->all(), [
            'id_produk' => ['required', 'numeric'],
            'jumlah_diskon' => ['required', 'numeric'],
            'maksimal_diskon' => ['required', 'numeric'],
            'mulai_waktu_diskon' => ['required', 'date'],
            'selesai_waktu_diskon' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // if (empty($request->tahun_mulai_promo) || empty($request->bulan_mulai_promo) || empty($request->tanggal_mulai_promo) || empty($request->tahun_selesai_promo) || empty($request->bulan_selesai_promo) || empty($request->tanggal_selesai_promo)) {
        //     return responseError('Maaf', 'Waktu promo tidak boleh ada yang kosong. Silahkan periksa kembali yah');
        // }

        // $months = ['Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4, 'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8, 'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12];
        $statusDiskon = 'Tersedia';
        $maksimalDiskon = $request->maksimal_diskon;
        // $tanggalMulai = $request->tanggal_mulai_promo;
        // $bulanMulai = $months[$request->bulan_mulai_promo];
        // $tahunMulai = $request->tahun_mulai_promo;
        $jumlahDiskon = $request->jumlah_diskon / 100;
        // $tanggalSelesai = $request->tanggal_selesai_promo;
        // $bulanSelesai = $months[$request->bulan_selesai_promo];
        // $tahunSelesai = $request->tahun_selesai_promo;
        // $tanggalMulaiPromo = "$tahunMulai-$bulanMulai-$tanggalMulai";
        // $tanggalSelesaiPromo = "$tahunSelesai-$bulanSelesai-$tanggalSelesai";
        $tanggalMulaiPromo = $request->mulai_waktu_diskon;
        $tanggalSelesaiPromo = $request->selesai_waktu_diskon;

        if ($tanggalMulaiPromo < Carbon::now()->format('Y-m-d')) {
            return responseError('Maaf waktu mulai promo tidak boleh menggunakan waktu lampau, silahkan periksa kembali yah');
        } else if ($tanggalSelesaiPromo < Carbon::now()->format('Y-m-d')) {
            return responseError('Maaf waktu selesai promo tidak boleh menggunakan waktu lampau, silahkan periksa kembali yah');
        }

        if ($tanggalMulaiPromo > $tanggalSelesaiPromo) {
            return responseError('Maaf waktu mulai promo tidak boleh melewati masa waktu selesai promo, silahkan periksa kembali yah');
        }

        $produk->status_diskon = $statusDiskon;
        $produk->maksimal_diskon = (int) str_replace('.', '', $maksimalDiskon);
        $produk->mulai_waktu_diskon = $tanggalMulaiPromo;
        $produk->jumlah_diskon = $jumlahDiskon;
        $produk->mulai_waktu_diskon = $tanggalMulaiPromo;
        $produk->selesai_waktu_diskon = $tanggalSelesaiPromo;
        $produk->save();

        return responseSuccess('Anda berhasil mengubah promo pada produk Anda', $produk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $produk->status_diskon = 'TidakTersedia';
        $produk->maksimal_diskon = null;
        $produk->mulai_waktu_diskon = null;
        $produk->jumlah_diskon = null;
        $produk->selesai_waktu_diskon = null;
        if ($produk->save()) {
            return responseSuccess('Anda berhasil menghapus promo pada produk Anda', $produk);
        }
        return responseError('Anda gagal menghapus promo pada produk Anda, silahkan coba kembali yah');
    }
}
