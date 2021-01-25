<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Notifications\PesananNotification;
use App\Notifications\PesananPartnerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $partner = Auth::user();
        return view('pengelola.pesanan', compact('partner'));
    }

    public function detailPesanan($idPesanan, Request $request)
    {
        $partner = Auth::user();
        $pesanan = $partner->pesanans->find($idPesanan);
        $atks = json_decode($pesanan->atk_terpilih, true);

        return view('pengelola.detail_pesanan_masuk', compact('pesanan', 'partner', 'atks'));
    }

    public function terimaPesanan($idPesanan)
    {
        $partner = Auth::user();
        $pesanan = $partner->pesanans->find($idPesanan);
        $pesanan->status = "Diproses";
        $pesanan->save();

        $pesanan->member->notify(new PesananNotification('pesananDiterimaPercetakan', $pesanan));
        alert()->success('Yeyy pesanan telah diterima !', 'Silahkan lanjutkan proses pencetakan dokumen pelanggan');
        return redirect()->back();
    }

    public function tolakPesanan($idPesanan)
    {
        $partner = Auth::user();
        $pesanan = $partner->pesanans->find($idPesanan);
        $pesanan->status = "Batal";
        $pesanan->transaksiSaldo->status = "Gagal";
        $pesanan->transaksiSaldo->keterangan = "Pesanan telah ditolak oleh pihak percetakan";
        $pesanan->member->jumlah_saldo += $pesanan->transaksiSaldo->jumlah_saldo;
        $pesanan->member->save();
        $pesanan->transaksiSaldo->save();
        $pesanan->save();

        $pesanan->member->notify(new PesananNotification('pesananDiTolak', $pesanan));
        $pesanan->partner->notify(new PesananPartnerNotification('pesananDiTolak', $pesanan));
        alert()->error('Yahh', 'Pesanan telah ditolak');
        return redirect()->route('partner.pesanan');
    }

    public function selesaikanPesanan($idPesanan)
    {
        $partner = Pengelola_Percetakan::find(Auth::id());
        $pesanan = $partner->pesanans->find($idPesanan);
        // $pesanan->status = "Selesai";
        // $pesanan->transaksiSaldo->status = "Berhasil";
        // $pesanan->transaksiSaldo->keterangan = "Pesanan telah selesai";
        // $partner->jumlah_saldo += $pesanan->transaksiSaldo->jumlah_saldo;
        // $partner->save();
        // $pesanan->transaksiSaldo->save();
        // $pesanan->save();

        $pesanan->member->notify(new PesananNotification('pesananSelesaiDiCetak', $pesanan));
        $pesanan->partner->notify(new PesananPartnerNotification('pesananSelesai', $pesanan));
        alert()->success('Pesanan Selesai Dicetak', 'Pesanan Anda telah dikonfirmasi selesai mencetak, silahkan konfirmasikan kembali ke pelanggan untuk memastikan penyelesaian proses pencetakan');
        return redirect()->route('partner.pesanan');
    }

    public function filterPesanan(Request $request)
    {
        if ($request->ajax()) {
            $partner = Auth::user();
            $konfigurasi = $partner->pesanans->first()->konfigurasiFile;
            if ($request->urutkanPesanan === 'Terbaru') {
                if (!empty($request->keywordFilterPesanan)) {
                    if ($request->keywordFilterPesanan === 'Ambil di Tempat') {
                        $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Ditempat')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('updated_at', 'desc')
                            ->get();
                    } else if ($request->keywordFilterPesanan === 'Antar ke Rumah' || $request->keywordFilterPesanan === 'Diantar') {
                        $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Diantar')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('updated_at', 'desc')
                            ->get();
                    } else {
                        $pesanan = $partner->pesanans->first()->where('metode_penerimaan', $request->keywordFilterPesanan)
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('updated_at', 'desc')
                            ->get();
                    }
                } else {
                    $pesanan = $partner->pesanans->first()->where('status', '!=', 'Pending')
                        ->orderBy('updated_at', 'desc')
                        ->get();
                }
            } else if ($request->urutkanPesanan === 'Harga Tertinggi') {
                if (!empty($request->keywordFilterPesanan)) {
                    if ($request->keywordFilterPesanan === 'Ambil di Tempat') {
                        $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Ditempat')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('biaya', 'desc')
                            ->get();
                    } else if ($request->keywordFilterPesanan === 'Antar ke Rumah' || $request->keywordFilterPesanan === 'Diantar') {
                        $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Diantar')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('biaya', 'desc')
                            ->get();
                    } else {
                        $pesanan = $partner->pesanans->first()->where('metode_penerimaan', $request->keywordFilterPesanan)
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('biaya', 'desc')
                            ->get();
                    }
                } else {
                    $pesanan = $partner->pesanans->first()->orderBy('biaya', 'asc')->get();
                }
            } else if ($request->urutkanPesanan === 'Harga Terendah') {
                if (!empty($request->keywordFilterPesanan)) {
                    if ($request->keywordFilterPesanan === 'Ambil di Tempat') {
                        $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Ditempat')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('biaya', 'asc')
                            ->get();
                    } else if ($request->keywordFilterPesanan === 'Antar ke Rumah' || $request->keywordFilterPesanan === 'Diantar') {
                        $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Diantar')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('biaya', 'asc')
                            ->get();
                    } else {
                        $pesanan = $partner->pesanans->first()->where('metode_penerimaan', $request->keywordFilterPesanan)
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->orderBy('biaya', 'asc')
                            ->get();
                    }
                } else {
                    $pesanan = $partner->pesanans->first()->orderBy('biaya', 'asc')->get();
                }
            } else {
                if (!empty($request->keywordFilterPesanan)) {
                    if ($request->keywordFilterPesanan === 'Ambil di Tempat') {
                        $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Ditempat')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->get();
                    } else if ($request->keywordFilterPesanan === 'Antar ke Rumah' || $request->keywordFilterPesanan === 'Diantar') {
                        $pesanan = $partner->pesanans->first()->where('metode_penerimaan', 'Diantar')
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->get();
                    } else {
                        $pesanan = $partner->pesanans->first()->where('metode_penerimaan', $request->keywordFilterPesanan)
                            ->where('status', '!=', 'Pending')
                            ->orWhere('status', $request->keywordFilterPesanan)
                            ->get();
                    }
                } else {
                    $pesanan = $partner->pesanans->first()->where('status', '!=', 'Pending')->get();
                }
            }

            $transaksiSaldo = $partner->pesanans->first()->transaksiSaldo;

            return response()->json([
                'pesanan' => $pesanan,
                'konfigurasi' => $konfigurasi,
                'transaksiSaldo' => $transaksiSaldo,
            ], 200);
        }
    }
}
