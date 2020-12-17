<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Lapor_produk;
use App\Mail\TanggapiKeluhanMail;
use App\Mail\TolakPartnerMail;
use App\Member;
use App\Pengelola_Percetakan;
use App\Pesanan;
use App\Transaksi_saldo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        $member = Member::all();
        $partner = Pengelola_Percetakan::all();
        $pesanan = Pesanan::all();
        $transaksiSaldo = Transaksi_saldo::all();

        $jumlahMember = count($member);
        $jumlahPartner = count($partner);
        $jumlahTransaksi = count($transaksiSaldo);

        return view('admin.homepage', [
            'member' => $member,
            'jumlahMember' => $jumlahMember,
            'partner' => $partner,
            'jumlahPartner' => $jumlahPartner,
            'jumlahTransaksi' => $jumlahTransaksi,
        ]);
    }

    public function dataMember()
    {
        $member = Member::all();

        return view('admin.data_member', [
            'member' => $member,
        ]);
    }

    public function memberJson()
    {
        return datatables(Member::all())->make(true);
    }

    public function partnerJson()
    {
        return datatables(Pengelola_Percetakan::all())->make(true);
    }

    public function saldoMemberJson()
    {
        $transaksiSaldo = Transaksi_saldo::where('jenis_transaksi', '=', 'TopUp')->orWhere('jenis_transaksi', '=', 'Pembayaran');

        return datatables($transaksiSaldo)
            ->editColumn('jenis_transaksi', function ($transaksiSaldo) {
                $saldoMember = $transaksiSaldo->member->nama_lengkap;
                return $saldoMember;
            })
            ->editColumn('jumlah_saldo', function ($transaksiSaldo) {
                $jumlahTopUp = rupiah($transaksiSaldo->jumlah_saldo);
                return $jumlahTopUp;
            })->make(true);
    }

    public function saldoPartnerJson()
    {
        $transaksiSaldo = Transaksi_saldo::where('jenis_transaksi', '=', 'Tarik');

        return datatables($transaksiSaldo)
            ->editColumn('jenis_transaksi', function ($transaksiSaldo) {
                $saldoPartner = $transaksiSaldo->partner->nama_lengkap;
                return $saldoPartner;
            })
            ->editColumn('jumlah_saldo', function ($transaksiSaldo) {
                $jumlahPenarikan = rupiah($transaksiSaldo->jumlah_saldo);
                return $jumlahPenarikan;
            })->make(true);
    }

    public function keluhanJson()
    {
        $laporProduk = Lapor_produk::all();
        return datatables($laporProduk)
            ->editColumn('id_member', function ($laporProduk) {
                $namaMember = $laporProduk->member->nama_lengkap;
                return $namaMember;
            })
            ->make(true);
    }

    public function detailMember($id)
    {
        $member = Member::find($id);
        return view('admin.detail_member', [
            'member' => $member,
            'tanggalLahir' => $this->getDateBorn($id),
        ]);
    }

    public function hapusMember($id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect()->route('admin.member')->with('success', 'Anda telah berhasil menghapus akun ' . $member->nama_lengkap);
    }

    public function getDateBorn($id)
    {
        $member = Member::find($id);
        if (empty($member->tanggal_lahir)) {
            return "-";
        } else {
            $monthName = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            $date = $member->tanggal_lahir;
            $tanggal = intval(substr($date, 8, 2));
            $bulan = $monthName[intval(substr($date, 5, 2) - 1)];
            $tahun = substr($date, 0, 4);
            return "$tanggal $bulan $tahun";
        }
    }

    public function dataPartner()
    {
        $partner = Pengelola_Percetakan::all();

        return view('admin.data_pengelola', compact('partner'));
    }

    public function detailPartner($id)
    {
        $partner = Pengelola_Percetakan::find($id);

        return view('admin.detail_pengelola', compact('partner'));
    }

    public function terimaPartner($id)
    {
        $partner = Pengelola_Percetakan::find($id);
        $partner->email_verified_at = Carbon::now()->format('Y:m:d H:i:s');

        $partner->save();
        return redirect()->route('admin.partner')->with('success', 'Anda telah berhasil memverifikasi akun ' . $partner->nama_lengkap);
    }

    public function tolakPartner($id)
    {
        $partner = Pengelola_Percetakan::find($id);
        return view('admin.tolak_pengelola', compact('partner'));
    }

    public function alasanTolakPartner($id, Request $request)
    {
        $partner = Pengelola_Percetakan::find($id);
        if ($request->radioAlasan === "0") {
            $isiAlasan = "Top-Up Tidak Mencapai Batas Minimal";
        } else if ($request->radioAlasan === "1") {
            $isiAlasan = "Terdapat Kendala pada Verifikasi Pendaftaran";
        } else if ($request->radioAlasan === "2") {
            $isiAlasan = "Saldo Tidak Mencukupi untuk Melakukan Transaksi";
        } else if ($request->radioAlasan === "3") {
            $isiAlasan = "Akun Dibekukan untuk Sementara";
        } else {
            $isiAlasan = $request->alasan;
        }

        $partner->delete();
        $m = (Mail::to($partner->email)->send(new TolakPartnerMail($partner, $isiAlasan)));
        try {
            Mail::to($partner->email)->send(new TolakPartnerMail($partner, $isiAlasan));
            return redirect()->route('admin.partner')->with('success', 'Anda telah berhasil menolak verifikasi akun ' . $partner->nama_lengkap);
        } catch (\Throwable $th) {
            alert()->error('Maaf', 'Gagal mengirimkan email penolakan verifikasi akun ' . $partner->nama_lengkap . '. Silahkan coba beberapa saat.');
        }

    }

    public function dataSaldo()
    {
        $member = Member::all();
        $partner = Pengelola_Percetakan::all();
        $transaksi_saldo = Transaksi_saldo::all();

        return view('admin.konfirmasi_saldo', compact('member', 'partner', 'transaksi_saldo'));
    }

    public function saldoTolak($id)
    {
        $partner = Pengelola_Percetakan::find($id);
        $transaksiSaldo = Transaksi_saldo::find($id);

        return view('admin.tolak_pengelola', compact('transaksiSaldo', 'partner'));
    }

    public function storeTolak(Request $request, $id)
    {
        $transaksiSaldo = Transaksi_saldo::find($id);
        $transaksiSaldo->status = "Gagal";
        if ($request->radioAlasan === "0") {
            $transaksiSaldo->keterangan = "Top-Up Tidak Mencapai Batas Minimal";
        } else if ($request->radioAlasan === "1") {
            $transaksiSaldo->keterangan = "Terdapat Kendala pada Verifikasi Pendaftaran";
        } else if ($request->radioAlasan === "2") {
            $transaksiSaldo->keterangan = "Saldo Tidak Mencukupi untuk Melakukan Transaksi";
        } else if ($request->radioAlasan === "3") {
            $transaksiSaldo->keterangan = "Akun Dibekukan untuk Sementara";
        } else {
            $transaksiSaldo->keterangan = $request->alasan;
        }

        $transaksiSaldo->save();

        return redirect()->route('admin.saldo')->with('success', 'Anda telah berhasil menolak ' . $transaksiSaldo->jenis_transaksi . ' saldo.');
    }

    public function storeTerimaSaldoMember($id)
    {
        $transaksiSaldo = Transaksi_saldo::find($id);
        if ($transaksiSaldo->jenis_transaksi === 'TopUp') {
            $transaksiSaldo->status = "Berhasil";
            $transaksiSaldo->keterangan = "Top Up Saldo Berhasil";
            $transaksiSaldo->member->jumlah_saldo += $transaksiSaldo->jumlah_saldo;
            $transaksiSaldo->member->save();
            $transaksiSaldo->save();
        } else {
            $transaksiSaldo->status = "Berhasil";
            $transaksiSaldo->keterangan = "Pembayaran Berhasil";
            $transaksiSaldo->member->jumlah_saldo = ($transaksiSaldo->member->jumlah_saldo + $transaksiSaldo->jumlah_saldo) - $transaksiSaldo->jumlah_saldo;
            $transaksiSaldo->member->save();
            $transaksiSaldo->save();
        }

        return redirect()->route('admin.saldo')->with('success', 'Anda telah berhasil mengkonfirmasi ' . $transaksiSaldo->jenis_transaksi . ' saldo.');
    }

    public function storeTerimaSaldoPartner($id)
    {
        $transaksiSaldo = Transaksi_saldo::find($id);
        $transaksiSaldo->status = "Berhasil";
        $transaksiSaldo->keterangan = "Tarik Saldo Berhasil";
        $transaksiSaldo->partner->jumlah_saldo -= $transaksiSaldo->jumlah_saldo;
        $transaksiSaldo->partner->save();
        $transaksiSaldo->save();

        return redirect()->route('admin.saldo')->with('success', 'Anda telah berhasil mengkonfirmasi ' . $transaksiSaldo->jenis_transaksi . ' saldo.');
    }

    public function keluhan()
    {
        $member = Member::all();
        $partner = Pengelola_Percetakan::all();

        return view('admin.kelola_keluhan', [
            'member' => $member,
            'pengelola_percetakan' => $partner,
        ]);
    }

    public function detailKeluhan($id)
    {
        $laporProduk = Lapor_produk::find($id);
        return view('admin.tanggapi_keluhan', compact('laporProduk'));
    }

    public function tanggapiKeluhan(Request $request)
    {
        $laporan = Lapor_produk::find($request->id_laporan);
        $laporan->pesan_tanggapan = $request->tanggapan_keluhan;
        $laporan->save();
        $m = (Mail::to($laporan->member->email)->send(new TanggapiKeluhanMail($laporan)));
        try {
            Mail::to($laporan->member->email)->send(new TanggapiKeluhanMail($laporan));
            $laporan->status = 'Ditanggapi';
            $laporan->save();
            return redirect()->route('admin.keluhan')->with('success', 'Tanggapan telah berhasil dikirimkan ke email ' . $laporan->member->nama_lengkap . '.');
        } catch (\Throwable $th) {
            alert()->error('Maaf', 'Tanggapan gagal dikirimkan ke email ' . $laporan->member->nama_lengkap . '. Silahkan coba beberapa saat.');
        }
    }
}
