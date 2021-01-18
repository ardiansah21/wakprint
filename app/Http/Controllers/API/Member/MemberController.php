<?php

namespace App\Http\Controllers\API\Member;

use App\Http\Controllers\Controller;
use App\Pengelola_Percetakan;
use App\Produk;
use Illuminate\Http\Request;
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
            return responseSuccess("detail riwayat saldo member", $transaksi_saldo);
        }
        return responseError("detail riwayat saldo member kosong");
    }

}
