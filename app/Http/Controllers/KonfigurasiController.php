<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Konfigurasi_file;
use App\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use stdClass;

class KonfigurasiController extends Controller
{
    public function uploadFile(Request $request)
    {
        $file = $request->file('fileUpload');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('tmp/upload'), $fileName);
        $path = public_path('tmp/upload') . "/" . $fileName;

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

        return redirect()->route('konfigurasi.file');
    }

    public function prosesCekWarna(Request $request)
    {

        // dd($request->path);
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
        if($request->ajax()){
            $member = Auth::user();
            $konfigurasi = Konfigurasi_file::all();
            $waktu = Carbon::now()->format('Y:m:d H:i:s');

            Konfigurasi_file::create([
                // 'id_konfigurasi' => $konfigurasi->id_konfigurasi,
                'id_member' => $member->id_member,
                'id_produk' => $request->idProduk,
                'nama_file' => $request->namaFile,
                'jumlah_halaman_berwarna' => $request->jumlahHalamanBerwarna,
                'jumlah_halaman_hitamputih' => $request->jumlahHalamanHitamPutih,
                'halaman_terpilih' => $request->halamanTerpilih,
                'jumlah_salinan' => $request->jumlahSalinan,
                'paksa_hitamputih' => $request->paksaHitamPutih,
                'biaya' => $request->biaya,
                'catatan_tambahan' => $request->catatanTambahan,
                'nama_produk' => $request->namaProduk,
                'waktu' => $waktu,
            ]);
            // return response()->json($konfigurasi,200);
            return redirect()->back();
        }

        // $member = Auth::user();
        //     $konfigurasi = Konfigurasi_file::all();
        //     $waktu = Carbon::now()->format('Y:m:d H:i:s');

        //     Konfigurasi_file::create([
        //         // 'id_konfigurasi' => $request->$konfigurasi->id_konfigurasi,
        //         'id_member' => $member->id_member,
        //         'id_produk' => $request->idProduk,
        //         'nama_file' => $request->namaFile,
        //         'jumlah_halaman_berwarna' => $request->jumlahHalamanBerwarna,
        //         'jumlah_halaman_hitamputih' => $request->jumlahHalamanHitamPutih,
        //         'halaman_terpilih' => $request->halamanTerpilih,
        //         'jumlah_salinan' => $request->jumlahSalinan,
        //         'paksa_hitamputih' => $request->paksaHitamPutih,
        //         'biaya' => $request->biaya,
        //         'catatan_tambahan' => $request->catatanTambahan,
        //         'nama_produk' => $request->namaProduk,
        //         'waktu' => $waktu,
        //     ]);

        // return redirect()->back();
    }

}
