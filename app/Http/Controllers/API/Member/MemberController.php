<?php

namespace App\Http\Controllers\API\Member;

use App\Http\Controllers\Controller;
use App\Lapor_produk;
use App\Member;
use App\Notifications\TopUpNotification;
use App\Pengelola_Percetakan;
use App\Pesanan;
use App\Produk;
use App\Transaksi_saldo;
use App\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToArray;
use stdClass;

class MemberController extends Controller
{

    public function index()
    {
        $produk = Produk::where('status', 'Tersedia')->get();
        $produk = $produk->sortBy('jarak')->sortByDesc('rating')->sortBy('harga_hitam_putih')->sortBy('harga_berwarna')->take(5);

        $partner = Pengelola_Percetakan::where('email_verified_at', '!=', null)->get();

        // if (!empty($partner)) {
        //     $partner = $partner->sortBy('jarak')->sortByDesc('rating_toko');
        // }

        $produkFinal = [];
        foreach ($produk as $key => $p) {
            $p->fitur = json_decode($p->fitur, true);
            array_push($produkFinal, $p);
        }

        $data = [
            "produk" => $produkFinal,
            "partner" => $partner,
        ];

        return responseSuccess("data home", $data);
    }

    public function user()
    {
        request()->user()->produk_favorit = json_decode(request()->user()->produk_favorit);
        return responseSuccess("data user", request()->user());
    }

    public function produk()
    {
        $produk = Produk::all();
        foreach ($produk as $p) {
            $p->fitur = json_decode($p->fitur, true);
        }

        return responseSuccess("data semua produk", $produk);
    }

    public function partner()
    {
        $partner = Pengelola_Percetakan::all();
        return responseSuccess("data semua partner", $partner);
    }

    public function updateProfile(Request $request)
    {
        $member = $request->user();
        $member->produk_favorit = json_decode($member->produk_favorit, true);

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

    public function uploadPhotoProfile(Request $request)
    {
        $member = $request->user();
        $member->produk_favorit = json_decode($member->produk_favorit, true);

        if (!empty($request->foto)) {
            $member->clearMediaCollection();
            $member->addMedia($request->foto)->toMediaCollection('avatar');

            return responseSuccess('Poto Profil Anda telah berhasil diubah', $member);
        } else {
            return responseSuccess('Poto Profil Anda tidak berubah');
        }

    }

    public function tambahAlamat($idMember, Request $request)
    {
        $member = Member::find($idMember);
        $alamatLama = $member->alamat;

        if (empty($alamatLama)) {
            $alamatLama = array(
                'IdAlamatUtama' => 0,
                'alamat' => array(),
            );
            $id = 0;
        } else {
            $id = count($alamatLama->alamat);
        }

        $alamatBaru[] = array(
            'id' => $id,
            'NamaPenerima' => $request->nama_penerima,
            'NomorHP' => $request->nomor_hp,
            'Provinsi' => $request->provinsi,
            'KabupatenKota' => $request->kabupaten_kota,
            'Kecamatan' => $request->kecamatan,
            'Kelurahan' => $request->kelurahan,
            'KodePos' => $request->kode_pos,
            'AlamatJalan' => $request->alamat_jalan,
        );

        if (!empty($request->idAlamatUtama)) {
            $AlamatFinal['IdAlamatUtama'] = (int) $request->idAlamatUtama;
        } else {
            $AlamatFinal['IdAlamatUtama'] = $alamatLama->IdAlamatUtama;
        }

        $AlamatFinal['alamat'] = array_merge($alamatLama->alamat, $alamatBaru);

        $member->alamat = $AlamatFinal;
        $member->produk_favorit = json_decode($member->produk_favorit, true);

        if ($member->save()) {
            $member->save();
            $member->push();

            return responseSuccess('Anda telah berhasil menambahkan alamat baru', $member);
        }

        return responseError('Anda gagal menambahkan alamat baru');
    }

    public function editAlamat($idAlamat, Request $request)
    {
        $member = $request->user();
        $alamat = $member->alamat;

        $alamat->alamat[$idAlamat] = [
            'id' => $idAlamat,
            'NamaPenerima' => $request->nama_penerima,
            'NomorHP' => $request->nomor_hp,
            'Provinsi' => $request->provinsi,
            'KabupatenKota' => $request->kabupaten_kota,
            'Kecamatan' => $request->kecamatan,
            'Kelurahan' => $request->kelurahan,
            'KodePos' => $request->kode_pos,
            'AlamatJalan' => $request->alamat_jalan,
        ];

        if ($request->idAlamatUtama != null) {
            $alamat->IdAlamatUtama = $request->idAlamatUtama;
        } else if ($alamat->IdAlamatUtama != null) {
            $alamat->IdAlamatUtama = $member->alamat->IdAlamatUtama;
        } else {
            $alamat->IdAlamatUtama = 0;
        }

        $member->alamat = $alamat;
        $member->produk_favorit = json_decode($member->produk_favorit, true);
        $member->save();

        return responseSuccess('Anda telah berhasil mengubah alamat Anda', $member);
    }

    public function hapusAlamat($idAlamat, Request $request)
    {
        $member = $request->user();
        $alamat = $member->alamat;
        $new_array[] = array();
        $i = 0;

        foreach ($alamat->alamat as $key => $value) {
            if ($value->id != $idAlamat) {
                $new_array[$i] = $value;
                $new_array[$i]->id = $i;
                $i++;
            }
        }

        if (json_encode($new_array) === '[[]]') {
            $alamat = array(
                'IdAlamatUtama' => 0,
                'alamat' => array(),
            );
        } else {
            $alamat->alamat = $new_array;
            if ($alamat->IdAlamatUtama === $idAlamat) {
                $alamat->IdAlamatUtama = $alamat->alamat[$i - 1]->id;
            }
        }

        $member->alamat = $alamat;
        $member->produk_favorit = json_decode($member->produk_favorit, true);
        $member->save();
        $member->push();

        return responseSuccess('Anda telah berhasil menghapus alamat Anda', $member);
    }

    public function pilihAlamat($idAlamat, Request $request)
    {
        $member = $request->user();
        $alamat = $member->alamat;

        $alamat->IdAlamatUtama = $alamat->alamat[$idAlamat]->id;

        $member->alamat = $alamat;
        $member->produk_favorit = json_decode($member->produk_favorit, true);
        $member->save();
        $member->push();

        return responseSuccess("Alamat Utama telah berhasil diubah", $member);
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
                        $favorit = Produk::find($produkFavorit[$i]);
                        $favorit->fitur = json_decode($p->fitur, true);
                        array_push($arrFavorit, $favorit);
                    }
                }
            }
            return responseSuccess('Produk Favorit Anda : ', $arrFavorit);
        }
    }

    public function ulasan()
    {
        $member = request()->user();
        $pesanan = $member->pesanans->where('status', 'Selesai');

        $arrayBelumDiulas = [];
        $arraySudahDiulas = [];

        foreach ($pesanan as $p) {
            $p->atk_terpilih = json_decode($p->atk_terpilih, true);
            foreach ($p->konfigurasiFile as $k) {
                if ($k->product != null) {
                    $k->product->fitur = json_decode($k->product->fitur, true);
                    if ($member->ulasans->where('id_produk', $k->product->id_produk) != '[]') {
                        $ulasan = $member->ulasans->where('id_produk', $k->product->id_produk);
                        $ulasan->nama_produk = $k->product->nama;
                        $ulasan->nama_toko = $k->product->partner->nama_toko;
                        $ulasan->foto_produk = $k->product->foto_produk;
                        array_push($arraySudahDiulas, $ulasan);
                    } else {
                        $temp = new stdClass();
                        $temp->id_pesanan = $p->id_pesanan;
                        $temp->id_member = $p->id_member;
                        $temp->id_pengelola = $p->id_pengelola;
                        $temp->id_produk = $k->product->id_produk;
                        $temp->updated_at = $p->updated_at;
                        $temp->nama_produk = $k->product->nama;
                        $temp->nama_toko = $k->product->partner->nama_toko;
                        $temp->foto_produk = $k->product->foto_produk;
                        array_push($arrayBelumDiulas, $temp);
                    }
                }
            }
        }

        return responseSuccess("Data ulasan member", $arrayBelumDiulas);
    }

    public function sudahDiulas()
    {
        $member = request()->user();
        $pesanan = $member->pesanans->where('status', 'Selesai');
        $arraySudahDiulas = [];

        foreach ($pesanan as $p) {
            $p->atk_terpilih = json_decode($p->atk_terpilih, true);
            foreach ($p->konfigurasiFile as $k) {
                if ($k->product != null) {
                    $k->product->fitur = json_decode($k->product->fitur, true);
                    if ($member->ulasans->where('id_produk', $k->product->id_produk) != '[]') {
                        $ulasan = $member->ulasans->where('id_produk', $k->product->id_produk);
                        foreach ($ulasan as $u) {
                            $u->nama_produk = $k->product->nama;
                            $u->nama_toko = $k->product->partner->nama_toko;
                            $u->foto_produk = $k->product->foto_produk;
                            array_push($arraySudahDiulas, $u);
                        }
                    }
                }
            }
        }

        return responseSuccess("Data yang sudah diulas : ", $arraySudahDiulas);
    }

    public function showBelumDiulas(Pesanan $pesanan, Produk $produk)
    {
        $temp = new stdClass();
        $temp->id_pesanan = $pesanan->id_pesanan;
        $temp->id_member = $pesanan->id_member;
        $temp->id_pengelola = $pesanan->id_pengelola;
        $temp->updated_at = $pesanan->updated_at;
        $temp->nama_produk = $produk->nama;
        $temp->nama_toko = $produk->partner->nama_toko;
        $temp->foto_produk = $produk->foto_produk;

        return responseSuccess("Data Detail Ulas Produk", $temp);
    }

    public function showSudahDiulas(Ulasan $ulasan, Produk $produk)
    {
        $ulasan->id_pengelola = $produk->id_pengelola;
        $ulasan->foto = $ulasan->getFirstMediaUrl('foto_ulasan');
        $ulasan->nama_produk = $produk->nama;
        $ulasan->nama_toko = $produk->partner->nama_toko;
        $ulasan->foto_produk = $produk->foto_produk;

        return responseSuccess("Data Detail Ulasan Saya", $ulasan);
    }

    public function storeUlasan(Request $request, Produk $produk)
    {
        $member = $request->user();
        $ulasan = Ulasan::create([
            'id_produk' => $produk->id_produk,
            'id_member' => $member->id_member,
            'rating' => $request->rating,
            'pesan' => $request->pesan,
        ]);

        if (!empty($request->foto)) {
            $ulasan->addMedia($request->foto)->toMediaCollection('foto_ulasan');
        }

        $ulasan->nama_produk = $produk->nama;
        $ulasan->nama_toko = $produk->partner->nama_toko;
        $ulasan->foto_produk = $produk->foto_produk;

        return responseSuccess("Produk telah berhasil diulas", $ulasan);
    }

    public function uploadPhotoUlasan(Request $request)
    {
        $member = $request->user();
        $jumlahUlasan = count($member->ulasans);
        $ulasan = Ulasan::find($jumlahUlasan);

        if (!empty($request->foto)) {
            $ulasan->addMedia($request->foto)->toMediaCollection('foto_ulasan');
            return responseSuccess('Poto Ulasan Anda telah berhasil dikirim');
        } else {
            return responseSuccess('Tidak ada poto ulasan Anda');
        }

    }

    public function tambahFavorit(Request $request)
    {
        $member = $request->user();
        $member->produk_favorit = $request->favorit;
        $member->save();
        $member->push();

        return responseSuccess("Berhasil merubah item favorit", $member);
    }

    public function detailPartner($idPartner)
    {
        $partner = Pengelola_Percetakan::find($idPartner);
        $produk = $partner->products;
        foreach ($produk as $p) {
            $p->fitur = json_decode($p->fitur, true);
        }
        $arrFotoPercetakan = [];

        if (count($partner->getMedia('foto_percetakan')) > 0) {
            foreach ($partner->getMedia('foto_percetakan') as $p) {
                array_push($arrFotoPercetakan, "https://wakprint.com" . $p->getUrl());
            }
        }

        $partner->avatar = "https://wakprint.com" . $partner->avatar;
        $partner->foto_percetakans = $arrFotoPercetakan;
        $partner->produk = $produk;
        $ratingPartner = $produk->where('id_pengelola', $idPartner)->avg('rating');

        if (empty($ratingPartner)) {
            $ratingPartner = $partner->rating_toko;
        }

        $partner->rating_toko = $ratingPartner;

        return responseSuccess('Data Detail Partner', $partner);
    }

    public function detailProduk($idProduk)
    {
        $produk = Produk::find($idProduk);
        $produk->fitur = json_decode($produk->fitur, true);
        // $ulasan = Ulasan::all();

        // $ratingPartner = $produk->where('id_pengelola', $produk->partner->id_pengelola)->avg('rating');
        // $ratingProduk = $ulasan->where('id_produk', $produk->id_produk)->avg('rating');

        // $data->rating = $ratingProduk;
        return responseSuccess("Detail produk : ", $produk);
    }

    public function storeLaporProduk($idProduk, Request $request)
    {
        $member = $request->user();
        $produk = Produk::find($idProduk);

        $laporProduk = Lapor_produk::create([
            'id_produk' => $produk->id_produk,
            'id_member' => $member->id_member,
            'pesan' => $request->pesan,
            'status' => 'Pending',
        ]);

        return responseSuccess("Laporan telah berhasil dikirimkan ! ", $laporProduk);
    }

    public function ulasanProduk($idProduk, Request $request)
    {
        $produk = Produk::find($idProduk);

        if ($request->filter_ulasan === "Rating Tertinggi ke Terendah") {
            $ulasan = Ulasan::where('id_produk', $produk->id_produk)
                ->orderBy('rating', 'desc')
                ->get();
        } else if ($request->filter_ulasan === "Rating Terendah ke Tertinggi") {
            $ulasan = Ulasan::where('id_produk', $produk->id_produk)
                ->orderBy('rating', 'asc')
                ->get();
        } else {
            $ulasan = Ulasan::where('id_produk', $produk->id_produk)->get();
        }

        $ratingProduk = round($ulasan->avg('rating'), 1);

        foreach ($ulasan as $u) {
            $u->foto = "https://wakprint.com" . $u->getFirstMediaUrl('foto_ulasan');
            $u->pelanggan = Member::find($u->id_member);
            $u->pelanggan->produk_favorit = json_decode($u->pelanggan->produk_favorit, true);
        }

        $data = new stdClass();
        $data->ulasan = $ulasan;
        $data->produk = $produk;
        $data->produk->rating = $ratingProduk;
        $data->produk->fitur = json_decode($data->produk->fitur);

        return responseSuccess("Data Ulasan Produk : " . $produk->nama, $data);
    }

    public function cari(Request $request)
    {
        $arrProdukFinal = [];

        if ($request->filterPencarian === 'Harga Tertinggi') {
            if ($request->fiturTambahan != null) {
                $produks = Produk::where('nama', 'like', '%' . $request->keyword . '%')
                    ->orWhere('rating', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_hitam_putih', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_berwarna', 'like', '%' . $request->keyword . '%')
                    ->where('jenis_kertas', 'like', '%' . $request->jenisKertas . '%')
                    ->orWhere('jenis_kertas', 'like', '%' . $request->keyword . '%')
                    ->where('jenis_printer', 'like', '%' . $request->jenisPrinter . '%')
                    ->orWhere('jenis_printer', 'like', '%' . $request->keyword . '%')
                    ->where('fitur->nama', 'like', '%' . join(",", $request->fiturTambahan) . '%')
                    ->orderBy('harga_hitam_putih', 'desc')
                    ->orderBy('harga_berwarna', 'desc')
                    ->get();

                $produkFinal = collect($produks)->map(function ($p) use ($request) {
                    $flag = false;
                    $fiturKeyword = collect(json_decode($p->fitur))->pluck('nama');

                    foreach ($request->fiturTambahan as $ft) {
                        $flag = $flag || in_array($ft, $fiturKeyword->toArray(), false);
                    }

                    if ($flag === true) {
                        return $p;
                    }
                });

                foreach ($produkFinal as $pf) {
                    if ($pf != null && $pf != "null" && !empty($pf)) {
                        array_push($arrProdukFinal, $pf);
                    }
                }

                $produks = $arrProdukFinal;
            } else {
                $produks = Produk::where('nama', 'like', '%' . $request->keyword . '%')
                    ->orWhere('rating', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_hitam_putih', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_berwarna', 'like', '%' . $request->keyword . '%')
                    ->where('jenis_kertas', 'like', '%' . $request->jenisKertas . '%')
                    ->orWhere('jenis_kertas', 'like', '%' . $request->keyword . '%')
                    ->where('jenis_printer', 'like', '%' . $request->jenisPrinter . '%')
                    ->orWhere('jenis_printer', 'like', '%' . $request->keyword . '%')
                    ->orderBy('harga_hitam_putih', 'desc')
                    ->orderBy('harga_berwarna', 'desc')
                    ->get();
            }
        } else if ($request->filterPencarian === 'Harga Terendah') {
            if ($request->fiturTambahan != null) {
                $produks = Produk::where('nama', 'like', '%' . $request->keyword . '%')
                    ->orWhere('rating', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_hitam_putih', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_berwarna', 'like', '%' . $request->keyword . '%')
                    ->where('jenis_kertas', 'like', '%' . $request->jenisKertas . '%')
                    ->orWhere('jenis_kertas', 'like', '%' . $request->keyword . '%')
                    ->where('jenis_printer', 'like', '%' . $request->jenisPrinter . '%')
                    ->orWhere('jenis_printer', 'like', '%' . $request->keyword . '%')
                    ->where('fitur->nama', 'like', '%' . join(",", $request->fiturTambahan) . '%')
                    ->orderBy('harga_hitam_putih', 'asc')
                    ->orderBy('harga_berwarna', 'asc')
                    ->get();

                $produkFinal = collect($produks)->map(function ($p) use ($request) {
                    $flag = false;
                    $fiturKeyword = collect(json_decode($p->fitur))->pluck('nama');

                    foreach ($request->fiturTambahan as $ft) {
                        $flag = $flag || in_array($ft, $fiturKeyword->toArray(), false);
                    }

                    if ($flag === true) {
                        return $p;
                    }
                });

                foreach ($produkFinal as $pf) {
                    if ($pf != null && $pf != "null" && !empty($pf)) {
                        array_push($arrProdukFinal, $pf);
                    }
                }

                $produks = $arrProdukFinal;
            } else {
                $produks = Produk::where('nama', 'like', '%' . $request->keyword . '%')
                    ->orWhere('rating', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_hitam_putih', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_berwarna', 'like', '%' . $request->keyword . '%')
                    ->where('jenis_kertas', 'like', '%' . $request->jenisKertas . '%')
                    ->orWhere('jenis_kertas', 'like', '%' . $request->keyword . '%')
                    ->where('jenis_printer', 'like', '%' . $request->jenisPrinter . '%')
                    ->orWhere('jenis_printer', 'like', '%' . $request->keyword . '%')
                    ->orderBy('harga_hitam_putih', 'asc')
                    ->orderBy('harga_berwarna', 'asc')
                    ->get();
            }
        } else {
            if ($request->fiturTambahan != null) {
                $produks = Produk::where('nama', 'like', '%' . $request->keyword . '%')
                    ->orWhere('rating', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_hitam_putih', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_berwarna', 'like', '%' . $request->keyword . '%')
                    ->where('jenis_kertas', 'like', '%' . $request->jenisKertas . '%')
                    ->orWhere('jenis_kertas', 'like', '%' . $request->keyword . '%')
                    ->where('jenis_printer', 'like', '%' . $request->jenisPrinter . '%')
                    ->orWhere('jenis_printer', 'like', '%' . $request->keyword . '%')
                    ->orderBy('updated_at', 'desc')
                    ->get();

                $produkFinal = collect($produks)->map(function ($p) use ($request) {
                    $flag = false;
                    $fiturKeyword = collect(json_decode($p->fitur))->pluck('nama');

                    foreach ($request->fiturTambahan as $ft) {
                        $flag = $flag || in_array($ft, $fiturKeyword->toArray(), false);
                    }

                    if ($flag === true) {
                        return $p;
                    }
                });

                foreach ($produkFinal as $pf) {
                    if ($pf != null && $pf != "null" && !empty($pf)) {
                        array_push($arrProdukFinal, $pf);
                    }
                }

                $produks = $arrProdukFinal;
            } else {
                $produks = Produk::where('nama', 'like', '%' . $request->keyword . '%')
                    ->orWhere('rating', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_hitam_putih', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_berwarna', 'like', '%' . $request->keyword . '%')
                    ->where('jenis_kertas', 'like', '%' . $request->jenisKertas . '%')
                    ->orWhere('jenis_kertas', 'like', '%' . $request->keyword . '%')
                    ->where('jenis_printer', 'like', '%' . $request->jenisPrinter . '%')
                    ->orWhere('jenis_printer', 'like', '%' . $request->keyword . '%')
                    ->orderBy('updated_at', 'desc')
                    ->get();

            }
        }

        foreach ($produks as $p) {
            $p->fitur = json_decode($p->fitur, true);
        }

        $partners = Pengelola_Percetakan::where('nama_toko', 'like', '%' . $request->keyword . '%')
            ->orWhere('alamat_toko', 'like', '%' . $request->keyword . '%')
            ->orWhere('rating_toko', 'like', '%' . $request->keyword . '%')
            ->where('ambil_di_tempat', $request->ambilDiTempat)
            ->where('antar_ke_tempat', $request->antarKeTempat)
            ->orderBy('updated_at', 'desc')
            ->get();

        $data = new stdClass();
        $data->produks = $produks;
        $data->partners = $partners;

        return responseSuccess("Hasil Pencarian : " . $request->filterPencarian, $data);
    }
}
