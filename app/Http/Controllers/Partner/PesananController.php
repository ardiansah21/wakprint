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
                    if ($request->keywordFilterPesanan === 'Ambil di Tempat') {
                        $pesanan = $partner->pesanan->first()->where('metode_penerimaan', 'Ditempat')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('updated_at', 'desc')
                            ->get();
                    } else if ($request->keywordFilterPesanan === 'Antar ke Rumah' || $request->keywordFilterPesanan === 'Diantar') {
                        $pesanan = $partner->pesanan->first()->where('metode_penerimaan', 'Diantar')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('updated_at', 'desc')
                            ->get();
                    } else {
                        $pesanan = $partner->pesanan->first()->where('metode_penerimaan', $request->keywordFilterPesanan)
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('updated_at', 'desc')
                            ->get();
                    }
                } else {
                    $pesanan = $partner->pesanan->first()->orderBy('updated_at', 'desc')->get();
                }
            } else if ($request->urutkanPesanan === 'Harga Tertinggi') {
                if (!empty($request->keywordFilterPesanan)) {
                    if ($request->keywordFilterPesanan === 'Ambil di Tempat') {
                        $pesanan = $partner->pesanan->first()->where('metode_penerimaan', 'Ditempat')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('biaya', 'desc')
                            ->get();
                    } else if ($request->keywordFilterPesanan === 'Antar ke Rumah' || $request->keywordFilterPesanan === 'Diantar') {
                        $pesanan = $partner->pesanan->first()->where('metode_penerimaan', 'Diantar')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('biaya', 'desc')
                            ->get();
                    } else {
                        $pesanan = $partner->pesanan->first()->where('metode_penerimaan', $request->keywordFilterPesanan)
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('biaya', 'desc')
                            ->get();
                    }
                } else {
                    $pesanan = $partner->pesanan->first()->orderBy('biaya', 'asc')->get();
                }
            } else if ($request->urutkanPesanan === 'Harga Terendah') {
                if (!empty($request->keywordFilterPesanan)) {
                    if ($request->keywordFilterPesanan === 'Ambil di Tempat') {
                        $pesanan = $partner->pesanan->first()->where('metode_penerimaan', 'Ditempat')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('biaya', 'asc')
                            ->get();
                    } else if ($request->keywordFilterPesanan === 'Antar ke Rumah' || $request->keywordFilterPesanan === 'Diantar') {
                        $pesanan = $partner->pesanan->first()->where('metode_penerimaan', 'Diantar')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('biaya', 'asc')
                            ->get();
                    } else {
                        $pesanan = $partner->pesanan->first()->where('metode_penerimaan', $request->keywordFilterPesanan)
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('biaya', 'asc')
                            ->get();
                    }
                } else {
                    $pesanan = $partner->pesanan->first()->orderBy('biaya', 'asc')->get();
                }
            } else {
                if (!empty($request->keywordFilterPesanan)) {
                    if ($request->keywordFilterPesanan === 'Ambil di Tempat') {
                        $pesanan = $partner->pesanan->first()->where('metode_penerimaan', 'Ditempat')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->get();
                    } else if ($request->keywordFilterPesanan === 'Antar ke Rumah' || $request->keywordFilterPesanan === 'Diantar') {
                        $pesanan = $partner->pesanan->first()->where('metode_penerimaan', 'Diantar')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->get();
                    } else {
                        $pesanan = $partner->pesanan->first()->where('metode_penerimaan', $request->keywordFilterPesanan)
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->get();
                    }
                } else {
                    $pesanan = $partner->pesanan->first()->where('status', '!=', 'Pending')->get();
                }

                $transaksiSaldo = $partner->pesanan->first()->transaksiSaldo;
            }

            return response()->json([
                'pesanan' => $pesanan,
                'konfigurasi' => $konfigurasi,
                'transaksiSaldo' => $transaksiSaldo,
            ], 200);
        }
    }
}
