<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Konfigurasi_file;
use App\Pesanan;
use App\Produk;
use App\Atk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use SebastianBergmann\Environment\Console;
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
        $member = Auth::user();
        // $konfigurasi = Konfigurasi_file::all();
        $waktu = Carbon::now()->format('Y:m:d H:i:s');

        $konfigurasi = Konfigurasi_file::create([
            'id_member' => $member->id_member,
            'id_produk' => $request->idProduk,
            'nama_file' => $request->namaFile,
            'jumlah_halaman_berwarna' => $request->jumlahHalamanBerwarna,
            'jumlah_halaman_hitamputih' => $request->jumlahHalamanHitamPutih,
            'halaman_terpilih' => json_encode($request->halamanTerpilih),
            'jumlah_salinan' => $request->jumlahSalinan,
            'paksa_hitamputih' => $request->paksaHitamPutih,
            'biaya' => $request->biaya,
            'catatan_tambahan' => $request->catatanTambahan,
            'nama_produk' => $request->namaProduk,
            'fitur_terpilih' => json_encode($request->fiturTerpilih),
            'waktu' => $waktu,
        ]);

        $konfigurasi->addMedia($request->file_konfigurasi)->toMediaCollection('file_konfigurasi');


        //dd($konfigurasi);
        //return redirect()->route('konfigurasi.pesanan',['konfigurasi' => $konfigurasi]);
        return redirect()->action('KonfigurasiController@konfigurasiPesanan', ['konfigurasi' => $konfigurasi]);

        // return view('',['konfigurasi' => $konfigurasi]);

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

    public function konfigurasiPesanan(Request $request)
    {
        $member = Auth::user();

        if (empty($request->konfigurasi)) {
            if ($request->session()->has("pesanan-" . $member->id_member)) {
                $pesanan = $request->session()->get("pesanan-" . $member->id_member);
                $atk = $pesanan->konfigurasiFile[0]->product->partner->atk;

                return view('member.konfigurasi_pesanan', compact('pesanan', 'atk', 'member'));
            }
        } else {
            $konfigurasi = Konfigurasi_file::find($request->konfigurasi);
            $atk = $konfigurasi->product->partner->atk;

            if ($request->session()->has("pesanan-" . $konfigurasi->id_member)) {
                $pesanan = $request->session()->get("pesanan-" . $konfigurasi->id_member);
                // $konfigurasi->id_pesanan = $pesanan->id_pesanan;
                // $konfigurasi->save();

                $request->session()->put("alamatPesanan");

                // if($request->session()->has("pesanan-" . $member->id_member)){
                //     // $request->session()->get("alamatPesanan");
                //     // dd(true);
                // }
                // $request->session()->save();
                // dd($konfigurasi);

                return view('member.konfigurasi_pesanan', compact('pesanan', 'konfigurasi', 'member', 'atk'));
            } else {
                $pesanan = Pesanan::create([
                    'id_pengelola' => $konfigurasi->product->partner->id_pengelola,
                    'id_member' => $konfigurasi->id_member,
                    'metode_penerimaan' => 'Ditempat',
                    'biaya' => $konfigurasi->biaya,
                    'status' => 'Pending'
                ]);

                $konfigurasi->id_pesanan = $pesanan->id_pesanan;
                $konfigurasi->save();

                $request->session()->put("pesanan-" . $konfigurasi->id_member, $pesanan);
                $request->session()->put("alamatPesanan");

                // dd($konfigurasi);

                return view('member.konfigurasi_pesanan', compact('pesanan', 'konfigurasi', 'member', 'atk'));
            }
        }
    }
}
