<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $partner = Auth::user();
        // $a = json_encode($partner->pesanan);
        // dd($partner->pesanan->first()->where('id_pengelola', $partner->id_pengelola)->get());
        return view('pengelola.pesanan', compact('partner'));
    }

    public function detailPesanan($idPesanan, Request $request)
    {
        $partner = Auth::user();
        $pesanan = $partner->pesanan->find($idPesanan);
        $atks = json_decode($pesanan->atk_terpilih);

        // function unduh(Media $mediaItem)
        // {
        //     return response()->download($mediaItem->getPath(), $mediaItem->file_name);
        // }

        return view('pengelola.detail_pesanan_masuk', compact('pesanan', 'partner', 'atks'));
    }

    public function terimaPesanan($idPesanan)
    {
        $partner = Auth::user();
        $pesanan = $partner->pesanan->find($idPesanan);
        $pesanan->status = "Diproses";
        $pesanan->save();

        return redirect()->back();
    }

    public function tolakPesanan($idPesanan)
    {
        $partner = Auth::user();
        $pesanan = $partner->pesanan->find($idPesanan);
        $pesanan->status = "Batal";
        $pesanan->transaksiSaldo->status = "Gagal";
        $pesanan->transaksiSaldo->keterangan = "Pesanan telah ditolak oleh pihak percetakan";
        $pesanan->transaksiSaldo->save();
        $pesanan->save();

        return redirect()->route('partner.pesanan');
    }

    public function selesaikanPesanan($idPesanan)
    {
        $partner = Auth::user();
        $pesanan = $partner->pesanan->find($idPesanan);
        $pesanan->status = "Selesai";
        $pesanan->transaksiSaldo->status = "Berhasil";
        $pesanan->transaksiSaldo->keterangan = "Pesanan telah selesai";
        $pesanan->transaksiSaldo->save();
        $pesanan->save();

        return redirect()->route('partner.pesanan');
    }

    public function filterPesanan(Request $request)
    {
        if ($request->ajax()) {
            $partner = Auth::user();
            $konfigurasi = $partner->pesanan->first()->konfigurasiFile;
            if ($request->urutkanPesanan === 'Terbaru') {
                if (!empty($request->keywordFilterPesanan)) {
                    $pesanan = $partner->pesanan->where('id_pengelola', $partner->id_pengelola)
                        ->where('id_pesanan', $request->keywordFilterPesanan)
                        ->where('metode_penerimaan', $request->keywordFilterPesanan)
                        ->where('status', $request->keywordFilterPesanan)
                        ->orderBy('updated_at', 'desc')
                        ->get();
                } else {
                    $pesanan = $partner->pesanan->where('id_pengelola', $partner->id_pengelola)->orderBy('updated_at', 'desc')->get();
                }
            } else if ($request->urutkanPesanan === 'Harga Tertinggi') {
                if (!empty($request->keywordFilterPesanan)) {
                    $pesanan = $partner->pesanan->where('id_pesanan', $request->keywordFilterPesanan)
                        ->where('metode_penerimaan', $request->keywordFilterPesanan)
                        ->where('status', $request->keywordFilterPesanan)
                        ->orderBy('biaya', 'desc')
                        ->get();
                } else {
                    $pesanan = $partner->pesanan->orderBy('biaya', 'desc')->get();
                }
            } else if ($request->urutkanPesanan === 'Harga Terendah') {
                if (!empty($request->keywordFilterPesanan)) {
                    $pesanan = $partner->pesanan->where('id_pesanan', $request->keywordFilterPesanan)
                        ->where('metode_penerimaan', $request->keywordFilterPesanan)
                        ->where('status', $request->keywordFilterPesanan)
                        ->orderBy('biaya', 'asc')
                        ->get();
                } else {
                    $pesanan = $partner->pesanan->orderBy('biaya', 'asc')->get();
                }
            } else {
                $pesanan = $partner->pesanan->first()->where('id_pesanan', $partner->pesanan->first()->id_pesanan)
                // ->where('metode_penerimaan', $request->keywordFilterPesanan)
                    ->where('status', $request->keywordFilterPesanan)
                    ->get();

                $transaksiSaldo = $partner->pesanan->first()->transaksiSaldo;
            }

            return response()->json([
                'pesanan' => json_encode($pesanan),
                'konfigurasi' => $konfigurasi,
                'transaksiSaldo' => $transaksiSaldo,
            ], 200);
        }
    }
}
