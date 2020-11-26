<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Konfigurasi_file;
use App\Pesanan;
use App\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $request->session()->forget('fileUpload');
        $request->session()->forget('produkKonfigurasiFile');
        $request->session()->forget('KonfigurasiCekwarna');
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

    public function editKonfigurasi($id, Request $request)
    {
        $konfigurasi = Konfigurasi_file::find($id);
        $member = Auth::user();
        $waktu = Carbon::now()->format('Y:m:d H:i:s');

        $konfigurasi->update([
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
        $konfigurasi->clearMediaCollection();
        $konfigurasi->addMedia($request->file_konfigurasi)->toMediaCollection('file_konfigurasi');

        if ($konfigurasi) {
            return response()->json(['status' => 'success'], 200);
        }
        return response()->json(['status' => 'error'], 400);
    }

    public function hapusKonfigurasi($id)
    {
        $konfigurasi = Konfigurasi_file::find($id);
        $konfigurasi->delete();
        return response()->json(['status' => 'success'], 204);
    }

    /*
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
     */
    public function konfigurasiPesanan(Request $request)
    {
        $konfigurasi = Konfigurasi_file::find($request->konfigurasi);
        $pesanan = Auth::user()->pesanans->where('status', null)->first();
        if ($pesanan) {
            if ($konfigurasi) {
                $konfigurasi->pesanan()->associate($pesanan)->save();
            }

            return view('member.konfigurasi_pesanan', ['pesanan' => $pesanan]);
        }
        if ($konfigurasi) {
            $pesanan = Pesanan::create([
                'id_pengelola' => $konfigurasi->product->partner->id_pengelola,
                'id_member' => $konfigurasi->id_member,
                'metode_penerimaan' => 'Ditempat',
                'biaya' => $konfigurasi->biaya,
                'status' => 'Pending',
            ]);
            $konfigurasi->pesanan()->associate($pesanan)->save();
            return view('member.konfigurasi_pesanan', ['pesanan' => $pesanan]);
        }
        return redirect()->back()->with('error', 'anda belum membuat pesanan');
    }

    public function createPesanan(Request $request)
    {
        return response()->json($request->all(), 201);
    }
    public function konfirmasiPesanan(Request $request)
    {
        $konFileTerpilih = Konfigurasi_file::findMany(explode(',', $request->konFileTerpilih));
        // $atkTerpilih = Atk::findMany(explode(',', $request->atkTerpilih));
        $atks = array_chunk(explode(',', $request->atks), 4);
        $penerimaan = $request->penerimaan;
        $subTotalFile = $request->subTotalFile;
        $ongkir = $request->ongkir;
        $totalBiaya = $request->totalBiaya;
        // dd($konFileTerpilih);
        // dd($atkTerpilih);
        // dd($request->atkTerpilih);

        // $a = "[{ayam: 1, bebek: 2, dodol: 4}]";
        // dd(json_decode($a));
        // dd(array_chunk($atks, 4));
        // dd($atks);

        // dd($request->all());
        // dd($request->konFileTerpilih);
        return view('member.konfirmasi_pesanan', compact('konFileTerpilih', 'atks', 'penerimaan', 'subTotalFile', 'ongkir', 'totalBiaya'));
    }

    public function konfirmasiPembayaran(Request $request)
    {
        return 'bbbbb';
    }
}
