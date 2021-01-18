<?php

namespace App\Http\Controllers\API\Member;

use App\Http\Controllers\Controller;
use App\Notifications\TopUpNotification;
use App\Pengelola_Percetakan;
use App\Produk;
use App\Transaksi_saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{

    public function index()
    {
        $produk = Produk::where('rating', '>=', 4)
        // ->where('jarak', '<=', 1000)
            ->where('status', 'Tersedia')
            ->where('harga_hitam_putih', '<=', 2000)
            ->where('harga_berwarna', '<=', 2000)
            ->get();

        $partner = Pengelola_Percetakan::where('rating_toko', '>=', 4)
        // ->where('jarak', '<=', 1000)
            ->where('email_verified_at', '!=', null)
            ->get();

        $data = [
            "produk" => $produk,
            "partner" => $partner,
        ];

        return responseSuccess("data home", $data);
    }

    public function user()
    {
        request()->user()->produk_favorit = json_decode(request()->user()->produk_favorit);
        return responseSuccess("data user", request()->user());
    }

    public function updateProfile(Request $request)
    {
        $member = $request->user();

        if (!empty($request->foto)) {
            $member->clearMediaCollection();
            $member->addMedia($request->foto)->toMediaCollection('avatar');
        }

        if (empty($request->password_baru)) {
            $member->update([
                'nama_lengkap' => $request->nama,
                'jenis_kelamin' => $request->jk,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            $member->save();
            $member->push();

            return responseSuccess('Profil Anda telah berhasil diubah', $member);
        } else {
            if ($member) {
                $current_password = $member->password;
                if (Hash::check($request->password_lama, $current_password)) {
                    $member->update([
                        'nama_lengkap' => $request->nama,
                        'jenis_kelamin' => $request->jk,
                        'tanggal_lahir' => $request->tanggal_lahir,
                        'password' => Hash::make($request->password_baru),
                    ]);

                    $member->save();
                    $member->push();

                    return responseSuccess('Profil Anda telah berhasil diubah', $member);
                } else {
                    return responseSuccess('Maaf Silahkan Masukkan Password Lama dengan Benar !');
                }
            } else {
                $member->update([
                    'nama_lengkap' => $request->nama,
                    'jenis_kelamin' => $request->jk,
                    'tanggal_lahir' => $request->tanggal_lahir,
                ]);

                $member->save();
                $member->push();

                return responseSuccess('Profil Anda telah berhasil diubah', $member);
            }
        }
    }

    public function saldo()
    {
        return responseSuccess("data riwayat saldo user", request()->user()->transaksiSaldo);
    }

    public function filterSaldo(Request $request)
    {
        if ($request->filter_saldo === 'Terbaru') {
            $transaksiSaldo = request()->user()->transaksiSaldo->first()->where('id_member', request()->user()->id_member)
                ->where('jenis_transaksi', '!=', 'Tarik')
                ->where('status', '!=', null)
                ->orderBy('updated_at', 'desc')
                ->get();
        } else if ($request->filter_saldo === 'Harga Tertinggi') {
            $transaksiSaldo = request()->user()->transaksiSaldo->first()->where('id_member', request()->user()->id_member)
                ->where('jenis_transaksi', '!=', 'Tarik')
                ->where('status', '!=', null)
                ->orderBy('jumlah_saldo', 'desc')
                ->get();
        } else if ($request->filter_saldo === 'Harga Terendah') {
            $transaksiSaldo = request()->user()->transaksiSaldo->first()->where('id_member', request()->user()->id_member)
                ->where('jenis_transaksi', '!=', 'Tarik')
                ->where('status', '!=', null)
                ->orderBy('jumlah_saldo', 'asc')
                ->get();
        } else if ($request->filter_saldo === 'Saldo Keluar') {
            $transaksiSaldo = request()->user()->transaksiSaldo->first()->where('id_member', request()->user()->id_member)
                ->where('jenis_transaksi', 'Pembayaran')
                ->where('status', '!=', null)
                ->get();
        } else if ($request->filter_saldo === 'Saldo Masuk') {
            $transaksiSaldo = request()->user()->transaksiSaldo->first()->where('id_member', request()->user()->id_member)
                ->where('jenis_transaksi', 'TopUp')
                ->where('status', '!=', null)
                ->get();
        } else {
            $transaksiSaldo = request()->user()->transaksiSaldo->first()->where('id_member', request()->user()->id_member)
                ->where('jenis_transaksi', '!=', 'Tarik')
                ->where('status', '!=', null)
                ->get();
        }

        if (!empty($transaksiSaldo)) {
            return responseSuccess("Data Saldo Anda : " . $request->filter_saldo, $transaksiSaldo);
        }

        return responseError("Data Saldo Anda : " . $request->jenis_dana . " Tidak Ditemukan");
    }

    public function showSaldo(Transaksi_saldo $transaksi_saldo)
    {
        if (!empty($transaksi_saldo)) {
            $transaksi_saldo->batas_waktu = Carbon::parse($transaksi_saldo->updated_at)->addDays(1)->translatedFormat('l, d F Y H:i') . ' WIB';
            return responseSuccess("detail riwayat saldo member", $transaksi_saldo);
        }
        return responseError("detail riwayat saldo member kosong");
    }

    public function topUpSaldo(Request $request)
    {
        $member = $request->user();
        $jumlahSaldo = (int) str_replace('.', '', $request->jumlah_saldo);
        $kodePembayaran = $jumlahSaldo + rand(1, 999);

        $transaksi = Transaksi_saldo::create([
            'id_member' => $member->id_member,
            'jenis_transaksi' => 'TopUp',
            'jumlah_saldo' => (int) str_replace('.', '', $request->jumlah_saldo),
            'kode_pembayaran' => $kodePembayaran,
            'status' => 'Pending',
            'keterangan' => 'Top Up Sedang Diproses',
        ]);

        $member->notify(new TopUpNotification('pending', $transaksi));
        return responseSuccess('Top Up Anda Sedang Diproses Silahkan Periksa Riwayat Halaman Pembayaran !', $transaksi);
    }

    public function batalTopUpSaldo(Transaksi_saldo $transaksi_saldo)
    {
        $transaksi_saldo->status = 'Gagal';
        $transaksi_saldo->keterangan = 'Top Up Telah Dibatalkan';
        $transaksi_saldo->save();
        $transaksi_saldo->push();
        request()->user()->notify(new TopUpNotification('gagal', $transaksi_saldo));
        return responseSuccess('Top Up Anda Telah Berhasil Dibatalkan', $transaksi_saldo);
    }

    public function favorit()
    {
        $member = request()->user();
        $produk = Produk::all();
        $produkFavorit = json_decode($member->produk_favorit);
        $arrFavorit = [];

        if (!empty($produkFavorit)) {
            foreach ($produk as $p) {
                for ($i = 0; $i < count($produkFavorit); $i++) {
                    if ($produkFavorit[$i] == $p->id_produk) {
                        array_push($arrFavorit, Produk::find($produkFavorit[$i]));
                    }
                }
            }
            return responseSuccess('Produk Favorit Anda : ', $arrFavorit);
        }
    }

}
