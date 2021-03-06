<?php

namespace App\Http\Controllers\API\Partner;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Notifications\AdminNotification;
use App\Notifications\TarikSaldoNotification;
use App\Pengelola_Percetakan;
use App\Transaksi_saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use stdClass;

class PartnerController extends Controller
{
    public function index()
    {
        $partner = request()->user();
        $arrTotalPelanggan = array();
        $arrJumlahDokumen = array();

        foreach ($partner->pesanans as $value) {
            if (!in_array($value->id_member, $arrTotalPelanggan, true)) {
                array_push($arrTotalPelanggan, $value->id_member);
            }
        }

        foreach ($partner->pesanans as $p => $value) {
            array_push($arrJumlahDokumen, $value->nama_file);
        }

        $data = [
            "user" => request()->user(),
            "totalPelanggan" => count($arrTotalPelanggan),
            "totalTransaksi" => count($arrJumlahDokumen),
        ];

        return responseSuccess("data start app partner", $data);
    }

    public function user()
    {
        return responseSuccess("data partner yang login", request()->user());
    }

    public function profileUpdate(Request $request, Pengelola_Percetakan $partner)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'nama_toko' => ['required', 'string', 'max:150'],
            'alamat_toko' => ['required', 'string', 'max:191'],
            'nama_bank' => ['required', 'string', 'max:100'],
            'nomor_rekening' => ['required', 'string', 'max:100'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $partner = request()->user();

        if ($request->ntkwh > 100) {
            return responseError('Maaf nilai persentase toleransi minimum halaman berwarna tidak boleh lebih dari 100% yah');
        }

        $partner->nama_toko = $request->nama_toko;
        $partner->deskripsi_toko = $request->deskripsi_toko;
        $partner->alamat_toko = $request->alamat_toko;
        $partner->url_google_maps = $request->url_google_maps;
        $partner->jam_op_buka = $request->jam_op_buka;
        $partner->jam_op_tutup = $request->jam_op_tutup;
        $partner->ongkir_toko = $request->ongkir_toko;
        $partner->syaratkententuan = $request->syaratkententuan;
        $partner->nama_lengkap = $request->nama_lengkap;
        $partner->nama_bank = $request->nama_bank;
        $partner->nomor_rekening = $request->nomor_rekening;
        $partner->ambil_di_tempat = $request->ambil_di_tempat;
        $partner->antar_ke_tempat = $request->antar_ke_tempat;
        $partner->ntkwh = $request->ntkwh;

        if ($request->hasFile('avatar')) {
            $partner->clearMediaCollection();
            $partner->addMedia($request->file('avatar'))->toMediaCollection('avatar');
        }

        if (count($partner->getMedia('foto_percetakan', [])) > 0) {
            $arrOriNamesResponse = collect($request->foto_percetakan)->map(function ($i) {
                return $i->getClientOriginalName();
            });

            foreach ($partner->getMedia('foto_percetakan') as $media) {
                if (!in_array($media->file_name, $arrOriNamesResponse->toArray())) {
                    $media->delete();

                }
            }
        }

        $media = $partner->getMedia('foto_percetakan')->pluck('file_name')->toArray();

        if (count($request->file('foto_percetakan', [])) > 0) {
            foreach ($request->foto_percetakan as $file) {
                if (count($media) === 0 || !in_array($file->getClientOriginalName(), $media)) {
                    $partner->addMedia($file)->toMediaCollection('foto_percetakan');
                }
            }
        }

        if ($partner->push() && $partner->save()) {
            return responseSuccess("Profil berhasil diubah", $partner);
        }

        return responseError("Profil gagal diubah, silahkan coba kembali");
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');
        $arrResponse = [];

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        foreach ($request->file('images', []) as $image) {
            $response = new stdClass();
            $response->name = uniqid() . '_' . trim($image->getClientOriginalName());
            $response->original_name = $image->getClientOriginalName();
            $image->move($path, $response->name);
            array_push($arrResponse, $response);
        }

        return responseSuccess("Berhasil simpan foto", $arrResponse);
    }

    public function saldoIndex()
    {
        if (!empty(request()->user()->transaksiSaldo)) {
            return responseSuccess("data saldo partner", request()->user()->transaksiSaldo);
        }
        return responseError("data saldo tidak ditemukan");
    }

    public function showSaldo(Transaksi_saldo $transaksiSaldo)
    {
        if (!empty($transaksiSaldo) || $transaksiSaldo != "[]") {
            return responseSuccess("detail riwayat saldo partner", $transaksiSaldo);
        }
        return responseError("detail riwayat saldo partner kosong");
    }

    public function storeTarikSaldo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_saldo' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $partner = request()->user();
        $jumlahSaldo = (int) str_replace('.', '', $request->jumlah_saldo);

        if ($partner->jumlah_saldo <= 0) {
            return responseError('Maaf Saldo Anda kosong');
        } else if ($jumlahSaldo > $partner->jumlah_saldo) {
            return responseError('Maaf Saldo Anda Tidak Mencukupi Untuk Melakukan Penarikan Saldo !');
        } else {
            $jenisTransaksi = 'Tarik';
            $kodePembayaran = $jumlahSaldo + rand(1, 999);
            $status = 'Pending';
            $keterangan = 'Penarikan Saldo Sedang Diproses';

            $transaksiSaldo = Transaksi_saldo::create([
                'id_pengelola' => $partner->id_pengelola,
                'jenis_transaksi' => $jenisTransaksi,
                'jumlah_saldo' => $jumlahSaldo,
                'kode_pembayaran' => $kodePembayaran,
                'status' => $status,
                'keterangan' => $keterangan,
            ]);

            $partner->notify(new TarikSaldoNotification('pending', $transaksiSaldo));
            Admin::find(1)->notify(new AdminNotification('tarikSaldoPartner', 0));
            return responseSuccess("Penarikan Saldo Anda Sedang Diproses", $transaksiSaldo, 201);
        }
    }

    public function filterSaldo(Request $request)
    {
        if ($request->jenis_dana === 'Dana Masuk') {
            $transaksiSaldo = request()->user()->transaksiSaldo->where('jenis_transaksi', 'Pembayaran')
                ->where('status', '!=', null)
                ->whereBetween('updated_at', [Carbon::parse($request->tanggal_awal)->translatedFormat('Y-m-d H:m:s'), Carbon::parse($request->tanggal_akhir)->translatedFormat('Y-m-d H:m:s')]);
        } else if ($request->jenis_dana === 'Dana Keluar') {
            $transaksiSaldo = request()->user()->transaksiSaldo->where('jenis_transaksi', 'Tarik')
                ->where('status', '!=', null)
                ->whereBetween('updated_at', [Carbon::parse($request->tanggal_awal)->translatedFormat('Y-m-d H:m:s'), Carbon::parse($request->tanggal_akhir)->translatedFormat('Y-m-d H:m:s')]);
        } else {
            $transaksiSaldo = request()->user()->transaksiSaldo->where('jenis_transaksi', '!=', 'TopUp')
                ->where('status', '!=', null)
                ->whereBetween('updated_at', [Carbon::parse($request->tanggal_awal)->translatedFormat('Y-m-d H:m:s'), Carbon::parse($request->tanggal_akhir)->translatedFormat('Y-m-d H:m:s')]);
        }

        if (!empty($transaksiSaldo)) {
            return responseSuccess("Data Saldo Anda : " . $request->jenis_dana, $transaksiSaldo);
        }

        return responseError("Data Saldo Anda : " . $request->jenis_dana . " Tidak Ditemukan");
    }

    public function statusToko(Request $request)
    {
        $status = 'Buka';
        if ($request->status_toko != 'Buka') {
            $status = 'Tutup';
        }

        $partner = request()->user();
        $partner->status_toko = $status;

        if ($partner->save()) {
            return responseSuccess("Percetakan Anda telah " . $status, $partner);
        }
        return responseError("Gagal merubah status percetakan Anda, silahkan coba lagi yah");
    }
}
