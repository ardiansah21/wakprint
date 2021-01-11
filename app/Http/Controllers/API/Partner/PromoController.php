<?php

namespace App\Http\Controllers\API\Partner;

use App\Http\Controllers\Controller;
use App\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use stdClass;

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
    public function store(Request $request, Produk $id)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_diskon' => ['required', 'numeric'],
            'maksimal_diskon' => ['required', 'numeric'],
            'mulai_waktu_diskon' => ['required', 'date'],
            'selesai_waktu_diskon' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $partner = request()->user();

        $statusDiskon = 'Tersedia';
        $maksimalDiskon = $request->maksimal_diskon;
        $jumlahDiskon = $request->jumlah_diskon;
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

        $produk = $partner->products->find($id);
        $produk->status_diskon = $statusDiskon;
        $produk->maksimal_diskon = (int) str_replace('.', '', $maksimalDiskon);
        $produk->jumlah_diskon = $jumlahDiskon;
        $produk->mulai_waktu_diskon = $tanggalMulaiPromo;
        $produk->selesai_waktu_diskon = $tanggalSelesaiPromo;
        $produk->save();
        $produk->push();

        $promo = new stdClass();
        $promo->status_diskon = $produk->status_diskon;
        $promo->jumlah_diskon = $produk->jumlah_diskon;
        $promo->maksimal_diskon = $produk->maksimal_diskon;
        $promo->mulai_waktu_diskon = $produk->mulai_waktu_diskon;
        $promo->selesai_waktu_diskon = $produk->selesai_waktu_diskon;

        return responseSuccess('Anda berhasil menambahkan promo baru pada produk Anda', $promo, 201);
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
            'jumlah_diskon' => ['required', 'numeric'],
            'maksimal_diskon' => ['required', 'numeric'],
            'mulai_waktu_diskon' => ['required', 'date'],
            'selesai_waktu_diskon' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $statusDiskon = 'Tersedia';
        $maksimalDiskon = $request->maksimal_diskon;
        $jumlahDiskon = $request->jumlah_diskon;
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
        $produk->jumlah_diskon = $jumlahDiskon;
        $produk->mulai_waktu_diskon = $tanggalMulaiPromo;
        $produk->selesai_waktu_diskon = $tanggalSelesaiPromo;
        $produk->save();
        $produk->push();

        $promo = new stdClass();
        $promo->status_diskon = $produk->status_diskon;
        $promo->jumlah_diskon = $produk->jumlah_diskon;
        $promo->maksimal_diskon = $produk->maksimal_diskon;
        $promo->mulai_waktu_diskon = $produk->mulai_waktu_diskon;
        $promo->selesai_waktu_diskon = $produk->selesai_waktu_diskon;

        return responseSuccess('Anda berhasil mengubah promo pada produk Anda', $promo);
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

        $promo = new stdClass();
        $promo->status_diskon = $produk->status_diskon;
        $promo->jumlah_diskon = $produk->jumlah_diskon;
        $promo->maksimal_diskon = $produk->maksimal_diskon;
        $promo->mulai_waktu_diskon = $produk->mulai_waktu_diskon;
        $promo->selesai_waktu_diskon = $produk->selesai_waktu_diskon;

        if ($produk->save()) {
            $produk->push();
            return responseSuccess('Anda berhasil menghapus promo pada produk Anda', $promo);
        }
        return responseError('Anda gagal menghapus promo pada produk Anda, silahkan coba kembali yah');
    }

    public function filterPromo()
    {
        if (!empty(request()->user()->products)) {
            if (count(request()->user()->products->where('status_diskon', 'TidakTersedia')) > 1) {
                $produkPromo = request()->user()->products->where('status_diskon', 'TidakTersedia')
                    ->where('nama', request()->keyword_produk);
                return responseSuccess('data seluruh produk', $produkPromo);
            } else {
                $produkPromo = request()->user()->products->where('status_diskon', 'TidakTersedia')
                    ->where('nama', request()->keyword_produk)
                    ->first();
                if (isEmptyOrNullString($produkPromo)) {
                    $produkPromo = [];
                    return responseSuccess('data seluruh produk', $produkPromo);
                } else {
                    return responseSuccess('data seluruh produk', array($produkPromo));
                }
            }
        }
        return responseError('Data Tidak Ada');
    }
}
