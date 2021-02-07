<?php

namespace App\Http\Controllers;

use App\Atk;
use App\Lapor_produk;
use App\Member;
use App\Notifications\PesananNotification;
use App\Notifications\TopUpNotification;
use App\Pengelola_Percetakan;
use App\Pesanan;
use App\Produk;
use App\Transaksi_saldo;
use App\Ulasan;
use Carbon\Carbon;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use imagick;
use stdClass;
use Str;
use Validator;

class MemberController extends Controller
{

    private $idProduk;
    private $f;

    public function __construct()
    {

    }

////

    public function member()
    {
        return response()->json(Auth::user(), 200);
    }
    public function uploadPdf(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $path = $file->move(public_path('tmp/upload'), $fileName);
        $pdf = $this->cekWarna($file, $path);
        $pdf->path = public_path('tmp/upload') . "/" . $fileName;

        return response()->json(['pdf' => $pdf]);
    }

    public function uploadtes(Request $request)
    {
        $produk = Produk::all();
        $pdf = new stdClass();
        $pdf->namaFile = $request->namaFile;
        $pdf->jumlahHalaman = $request->jumlahHalaman;
        $pdf->jumlahHalBerwarna = $request->jumlahHalBerwarna;
        $pdf->jumlahHalBerwarna = $request->jumlahHalBerwarna;
        $pdf->path = $request->path;

        return view('member.konfigurasi_file_lanjutan', compact('pdf', 'produk'));
    }

////

    public function index(Request $request)
    {
        // $member = Auth::user();
        $produk = Produk::where('rating', '>=', 4)
        // ->where('jarak', '<=', 1000)
            ->where('status', 'Tersedia')
            ->where('harga_hitam_putih', '<=', 5000)
            ->orWhere('harga_berwarna', '<=', 5000)
            ->get();

        $partner = Pengelola_Percetakan::where('rating_toko', '>=', 4)
        // ->where('jarak', '<=', 1000)
            ->where('email_verified_at', '!=', null)
            ->get();
        // $ratingPartner = $produk->where('id_pengelola',$produk->partner->id_pengelola)->avg('rating');

        $atk = Atk::all();
        return view('home', compact('produk', 'partner', 'atk'));
    }

    // temp dropzone
    public function fileupload(Request $request)
    {
        if ($request->hasFile('file')) {

            // Upload path
            $destinationPath = 'files/';

            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            // Valid extensions
            $validextensions = array("jpeg", "jpg", "png", "pdf");

            // Check extension
            if (in_array(strtolower($extension), $validextensions)) {

                // Rename file
                $fileName = Str::slug(Carbon::now()->toDayDateTimeString()) . rand(11111, 99999) . '.' . $extension;

                // Uploading file to given path
                $request->file('file')->move($destinationPath, $fileName);
            }
        }
    }

    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $members = Auth::user();
            $idKonfigurasi = $request->id_konfigurasi;
            $fromKonfigurasi = $request->fromKonfigurasi;
            $arrProdukFinal = [];

            if ($fromKonfigurasi != 'false') {
                if (!empty($members->pesanans) && $members->pesanans->where('status', null)) {
                    if ($request->filterPencarian === 'Harga Tertinggi') {
                        if ($request->fiturTambahan != null) {
                            $produks = Produk::where('id_pengelola', $members->pesanans->first()->id_pengelola)
                                ->where('nama', 'like', '%' . $request->keyword . '%')
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
                            $produks = Produk::where('id_pengelola', $members->pesanans->first()->id_pengelola)
                                ->where('nama', 'like', '%' . $request->keyword . '%')
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
                            $produks = Produk::where('id_pengelola', $members->pesanans->first()->id_pengelola)
                                ->where('nama', 'like', '%' . $request->keyword . '%')
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
                            $produks = Produk::where('id_pengelola', $members->pesanans->first()->id_pengelola)
                                ->where('nama', 'like', '%' . $request->keyword . '%')
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
                            $produks = Produk::where('id_pengelola', $members->pesanans->first()->id_pengelola)
                                ->where('nama', 'like', '%' . $request->keyword . '%')
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
                            $produks = Produk::where('id_pengelola', $members->pesanans->first()->id_pengelola)
                                ->where('nama', 'like', '%' . $request->keyword . '%')
                                ->orWhere('rating', 'like', '%' . $request->keyword . '%')
                                ->orWhere('harga_hitam_putih', 'like', '%' . $request->keyword . '%')
                                ->orWhere('harga_berwarna', 'like', '%' . $request->keyword . '%')
                                ->orWhere('jenis_kertas', 'like', '%' . $request->keyword . '%')
                                ->orWhere('jenis_printer', 'like', '%' . $request->keyword . '%')
                                ->where('jenis_kertas', 'like', '%' . $request->jenisKertas . '%')
                                ->where('jenis_printer', 'like', '%' . $request->jenisPrinter . '%')
                                ->orderBy('updated_at', 'desc')
                                ->get();
                        }
                    }

                    $partners = Pengelola_Percetakan::where('id_pengelola', $members->pesanans->first()->id_pengelola)
                        ->where('nama_toko', 'like', '%' . $request->keyword . '%')
                        ->orWhere('nama_lengkap', 'like', '%' . $request->keyword . '%')
                        ->orWhere('alamat_toko', 'like', '%' . $request->keyword . '%')
                        ->orWhere('rating_toko', 'like', '%' . $request->keyword . '%')
                        ->where('ambil_di_tempat', 'like', '%' . $request->ambilDiTempat . '%')
                        ->where('antar_ke_tempat', 'like', '%' . $request->antarKeTempat . '%')
                        ->orderBy('updated_at', 'desc')
                        ->get();

                    $atks = Atk::where('id_pengelola', $members->pesanans->first()->id_pengelola)
                        ->where('nama', 'like', '%' . $request->keyword . '%')
                        ->orderBy('id_atk', 'asc')
                        ->get();

                    $idProdukPartnerDariProduk = array();
                    $namaPartnerDariProduk = array();
                    $alamatPartnerDariProduk = array();
                    foreach ($produks as $p) {
                        array_push($idProdukPartnerDariProduk, $p->partner->id_pengelola);
                        array_push($namaPartnerDariProduk, $p->partner->nama_toko);
                        array_push($alamatPartnerDariProduk, $p->partner->alamat_toko);
                    }

                    $atkIdPartner = array();
                    $atkStatusPartner = array();
                    foreach ($atks as $a) {
                        array_push($atkIdPartner, $a->partner->id_pengelola);
                        array_push($atkStatusPartner, $a->partner->status);
                    }

                    return response()->json([
                        'members' => $members,
                        'produks' => $produks,
                        'partners' => $partners,
                        'id_partner_dari_produk' => $idProdukPartnerDariProduk,
                        'nama_partner_dari_produk' => $namaPartnerDariProduk,
                        'alamat_partner_dari_produk' => $alamatPartnerDariProduk,
                        'atk_id_partner' => $atkIdPartner,
                        'atk_status_partner' => $atkStatusPartner,
                        'atks' => $atks,
                        'idKonfigurasi' => $idKonfigurasi,
                        'fromKonfigurasi' => $fromKonfigurasi,
                    ], 200);
                }
            } else {
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

                $partners = Pengelola_Percetakan::where('nama_toko', 'like', '%' . $request->keyword . '%')
                    ->orWhere('alamat_toko', 'like', '%' . $request->keyword . '%')
                    ->orWhere('rating_toko', 'like', '%' . $request->keyword . '%')
                    ->where('ambil_di_tempat', 'like', '%' . $request->ambilDiTempat . '%')
                    ->where('antar_ke_tempat', 'like', '%' . $request->antarKeTempat . '%')
                    ->orderBy('updated_at', 'desc')
                    ->get();

                $atks = Atk::where('nama', 'like', '%' . $request->keyword . '%')
                    ->orderBy('id_atk', 'asc')
                    ->get();

                $idProdukPartnerDariProduk = array();
                $namaPartnerDariProduk = array();
                $alamatPartnerDariProduk = array();
                foreach ($produks as $p) {
                    array_push($idProdukPartnerDariProduk, $p->partner->id_pengelola);
                    array_push($namaPartnerDariProduk, $p->partner->nama_toko);
                    array_push($alamatPartnerDariProduk, $p->partner->alamat_toko);
                }

                $atkIdPartner = array();
                $atkStatusPartner = array();
                foreach ($atks as $a) {
                    array_push($atkIdPartner, $a->partner->id_pengelola);
                    array_push($atkStatusPartner, $a->partner->status);
                }

                return response()->json([
                    'members' => $members,
                    'produks' => $produks,
                    'partners' => $partners,
                    'id_partner_dari_produk' => $idProdukPartnerDariProduk,
                    'nama_partner_dari_produk' => $namaPartnerDariProduk,
                    'alamat_partner_dari_produk' => $alamatPartnerDariProduk,
                    'atk_id_partner' => $atkIdPartner,
                    'atk_status_partner' => $atkStatusPartner,
                    'atks' => $atks,
                ], 200);
            }
        }
    }

    public function pencarian(Request $request)
    {
        $member = Auth::user();
        $fromKonfigurasi = $request->fromKonfigurasi;
        $idKonfigurasi = $request->id_konfigurasi;

        if ($fromKonfigurasi == true) {
            if (!empty($member->pesanans) && $member->pesanans->where('status', null)) {
                if ($request->keyword != null) {
                    $produk = Produk::where('id_pengelola', $member->pesanans->first()->id_pengelola)
                        ->where('nama', 'like', '%' . $request->keyword . '%')
                        ->orWhere('jenis_kertas', 'like', '%' . $request->keyword . '%')
                        ->orWhere('jenis_printer', 'like', '%' . $request->keyword . '%')
                        ->orWhere('harga_hitam_putih', 'like', '%' . $request->keyword . '%')
                        ->orWhere('harga_berwarna', 'like', '%' . $request->keyword . '%')
                        ->orWhere('rating', 'like', '%' . $request->keyword . '%')
                        ->get();
                    $partner = Pengelola_Percetakan::where('id_pengelola', $member->pesanans->first()->id_pengelola)
                        ->where('nama_toko', 'like', '%' . $request->keyword . '%')
                        ->orWhere('alamat_toko', 'like', '%' . $request->keyword . '%')
                        ->orWhere('rating_toko', 'like', '%' . $request->keyword . '%')
                        ->get();
                    $atk = Atk::where('id_pengelola', $member->pesanans->first()->id_pengelola)
                        ->where('nama', 'like', '%' . $request->keyword . '%')
                        ->get();
                } else {
                    $produk = Produk::where('id_pengelola', $member->pesanans->first()->id_pengelola)->get();
                    $partner = Pengelola_Percetakan::where('id_pengelola', $member->pesanans->first()->id_pengelola)->get();
                    $atk = Atk::where('id_pengelola', $member->pesanans->first()->id_pengelola)->get();
                }

            }
            return view('member.pencarian', compact('partner', 'produk', 'atk', 'fromKonfigurasi', 'idKonfigurasi'))->render();
        } else {
            if ($request->keyword != null) {
                $produk = Produk::where('nama', 'like', '%' . $request->keyword . '%')
                    ->orWhere('jenis_kertas', 'like', '%' . $request->keyword . '%')
                    ->orWhere('jenis_printer', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_hitam_putih', 'like', '%' . $request->keyword . '%')
                    ->orWhere('harga_berwarna', 'like', '%' . $request->keyword . '%')
                    ->orWhere('rating', 'like', '%' . $request->keyword . '%')
                    ->get();
                $partner = Pengelola_Percetakan::where('nama_toko', 'like', '%' . $request->keyword . '%')
                    ->orWhere('alamat_toko', 'like', '%' . $request->keyword . '%')
                    ->orWhere('rating_toko', 'like', '%' . $request->keyword . '%')
                    ->get();
                $atk = Atk::where('nama', 'like', '%' . $request->keyword . '%')->get();
            } else {
                $produk = Produk::all();
                $partner = Pengelola_Percetakan::all();
                $atk = Atk::all();
            }
            return view('member.pencarian', compact('partner', 'produk', 'atk'))->render();
        }
    }

    public function detailPartner($idProduk)
    {
        $partner = Pengelola_Percetakan::find($idProduk);
        $produk = $partner->products;
        $atk = Atk::all();
        $ulasan = Ulasan::all();
        $ratingPartner = $produk->where('id_pengelola', $idProduk)->avg('rating');
        // $ratingProduk = $ulasan->where('id_produk', $produk->id_produk)->avg('rating');

        if (empty($ratingPartner)) {
            $ratingPartner = $partner->rating_toko;
        }

        $partner->rating_toko = $ratingPartner;
        $partner->save();

        return view('member.detail_percetakan', compact('produk', 'partner', 'atk', 'ratingPartner'));
    }

    public function detailProduk($idProduk)
    {
        $member = Auth::user();
        $produk = Produk::find($idProduk);
        $atk = $produk->atks();
        $fitur = json_decode($produk->fitur, true);
        $ulasan = Ulasan::all();
        $ratingPartner = $produk->where('id_pengelola', $produk->partner->id_pengelola)->avg('rating');
        $ratingProduk = $ulasan->where('id_produk', $produk->id_produk)->avg('rating');

        return view('member.detail_produk', compact('member', 'produk', 'fitur', 'atk', 'ulasan', 'ratingPartner', 'ratingProduk'));
    }

    public function shareLink()
    {
        $urlCurrent = Share::currentPage()->facebook();
        return $urlCurrent;
    }

    public function upload(Request $request)
    {
        // $this->validate($request, [
        //     'file' => 'required',
        // ]);
        // $file = $request->file('file');
        // // $k = Konfigurasi_file::insertGetId([
        // //     'nama_file' => $file->getClientOriginalName(),
        // //     'waktu' => now(),
        // // ]);
        // // $idProdukd = $k;
        // $path = $file->move(public_path('tmp' . DIRECTORY_SEPARATOR . 'upload'), $file->getClientOriginalName());
        // $pdf = $this->cekWarna($file, $path);

        // $produk = Produk::all();
        // $partner = Pengelola_Percetakan::all();

        // return response()->json([
        //     'original_name' => $file->getClientOriginalName(),
        //     'request' => $request,
        // ]);

        // if ($path) {
        //     return Response::json([
        //         'pdf'=> $pdf,
        //     ], 200);
        // } else {
        //     return Response::json('error', 400);
        // }

        // return response()->json([
        //     'original_name' => $file->getClientOriginalName(),
        //     'request' => $request,
        // ]);

        // if ($path) {
        //     return Response::json([
        //         'pdf'=> $pdf,
        //     ], 200);
        // } else {
        //     return Response::json('error', 400);
        // }

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('tmp' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR), $fileName);
        $path = public_path('tmp' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR) . $fileName;

        $countPage = preg_match_all("/\/Page\W/", file_get_contents($path), $dummy);
        // $countPage = 5;
        $fileUpload = new stdClass();
        $fileUpload->name = $fileName;
        $fileUpload->path = $path;
        $fileUpload->countPage = $countPage;

        $request->session()->put('fileUpload', $fileUpload);
        if ($request->ajax()) {
            return response()->json(['status' => "OK"]);
        }

        return view('member.konfigurasi_file_lanjutan', [
            'member' => Auth::user(),
        ]);
    }

    public function cekWarna(\Illuminate\Http\UploadedFile $file, $path)
    {
        //TODO merapikan struktur code dan storage

        $gray = 0;
        $notgray = 0;
        $RandomNum = time();
        $FileName = $file->getClientOriginalName();
        $output_dir = public_path('tempCekwarna/') . $FileName;
        // if (!File::exists(public_path('tempCekwarna/') . $FileName)) {
        //     $output_dir = File::makeDirectory(public_path('tempCekwarna/') . $FileName, 0777, true);
        // }
        $jumlahHal = preg_match_all("/\/Page\W/", file_get_contents($path), $dummy);

        $name = $path;

        for ($i = 0; $i < $jumlahHal; $i++) {
            $nameto = $output_dir . $RandomNum . '-' . $i . '.jpg';
            $im = new imagick($name . '[' . $i . ']');
            // convert to jpg
            $im->setResolution(400, 565);
            $im->setImageColorspace(255);
            $im->setCompression(Imagick::COMPRESSION_JPEG);
            $im->setCompressionQuality(60);
            $im->setImageFormat('jpeg');

            //write image on server
            $im->writeImage($nameto);
            $im->clear();
            $im->destroy();
        }
        //cekWarna
        for ($h = 0; $h < $jumlahHal; $h++) {
            $imy = ImageCreateFromJpeg($output_dir . $RandomNum . '-' . $h . '.jpg');
            $imgw = imagesx($imy);
            $imgh = imagesy($imy);

            $r = array();
            $g = array();
            $b = array();

            $c = 0;
            for ($i = 0; $i < $imgw; $i++) {
                for ($j = 0; $j < $imgh; $j++) {

                    // get the rgb value for current pixel

                    $rgb = ImageColorAt($imy, $i, $j);

                    // extract each value for r, g, b

                    $r[$i][$j] = ($rgb >> 16) & 0xFF;
                    $g[$i][$j] = ($rgb >> 8) & 0xFF;
                    $b[$i][$j] = $rgb & 0xFF;

                    // count gray pixels (r=g=b)

                    if ($r[$i][$j] == $g[$i][$j] && $r[$i][$j] == $b[$i][$j]) {
                        $c++;
                    }
                }
            }
            $w = ($imgw * $imgh) - $c;
            $persenMin = ($imgw * $imgh) * (1 / 100);

            if ($w < $c) {
                if ($w < $persenMin) {
                    $gray++;
                } else {
                    $notgray++;
                }
            } else {
                if ($c < $persenMin) {
                    $notgray++;
                } else {
                    $gray++;
                }
            }
        }
        $pdf = new stdClass();
        $pdf->namaFile = $FileName;
        $pdf->jumlahHalaman = $jumlahHal;
        $pdf->jumlahHalBerwarna = $notgray;
        $pdf->jumlahHalHitamPutih = $gray;
        $pdf->path = $path;

        return $pdf;
    }

    ///tempat nambah

    public function produk()
    {
        //dd(getDateBorn());
        return view('member.detail_produk');
    }

    public function laporProduk($idProduk)
    {
        //dd(getDateBorn());
        $member = Auth::user();
        $produk = Produk::find($idProduk);
        $atk = Atk::all();
        $fitur = json_decode($produk->fitur, true);
        return view('member.lapor_produk', compact('member', 'produk', 'fitur', 'atk'));
    }

    public function storeLapor(Request $request, $idProduk)
    {
        //dd(getDateBorn());
        $member = Auth::user();
        $produk = Produk::find($idProduk);
        $laporProduk = Lapor_produk::all();

        $pesan = $request->pesan;
        $status = $laporProduk->status = 'Pending';
        // $waktu = $laporProduk->waktu = Carbon::now()->format('Y:m:d H:i:s');

        Lapor_produk::create([
            'id_produk' => $produk->id_produk,
            'id_member' => $member->id_member,
            'pesan' => $pesan,
            // 'waktu' => $waktu,
            'status' => $status,
        ]);

        return redirect()->route('detail.produk', $produk->id_produk)->with('success', 'Laporan telah berhasil dikirim !');
    }

    public function profile(Request $request)
    {
        $member = Auth::user();
        $transaksi_saldo = Transaksi_saldo::all();
        $pengelola = Pengelola_Percetakan::all();
        $produk = Produk::all();
        if ($member->pesanans != "[]") {
            $pesanan = $member->pesanans->first()->where('status', 'Pending')->orWhere('status', 'Diproses')->get();
        } else {
            $pesanan = null;
        }
        $konfigurasi = $member->konfigurasi;

        $request->session()->forget('alamatPesanan');

        return view('member.profil', [
            'member' => $member,
            'transaksi_saldo' => $transaksi_saldo,
            'pengelola_percetakan' => $pengelola,
            'produk' => $produk,
            'konfigurasi' => $konfigurasi,
            'pesanan' => $pesanan,
            'tanggalLahir' => $this->getDateBorn()]
        );
    }

    public function show(Request $request, $idProduk)
    {
        $transaksiSaldo = Transaksi_saldo::find($idProduk);
        return view('member.profil', compact('transaksiSaldo'))->renderSections()['content'];
    }

    public function saldo()
    {
        $member = Auth::user();
        // $idProduk = Pengelola_Percetakan::find(Auth::id());
        $transaksi_saldo = Transaksi_saldo::all();
        // $idProduk = Auth::user($transaksi_saldo->id_pengelola);
        return view('member.topup_saldo', [
            'member' => $member,
            // 'id' => $idProduk,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function credentialRules(array $data)
    {
        $messages = [
            'current-password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
            'confirm-password.required' => 'Please confirm password',
        ];

        $validator = Validator::make($data, [
            'current-password' => 'required',
            'password' => 'required|same:password',
            'confirm-password' => 'required|same:password',
        ], $messages);

        return $validator;
    }

    public function getDateBorn()
    {
        if (empty(Auth::user()->tanggal_lahir)) {
            return "-";
        } else {
            $monthName = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            $date = Auth::user()->tanggal_lahir;
            $tanggal = intval(substr($date, 8, 2));
            $bulan = $monthName[intval(substr($date, 5, 2) - 1)];
            $tahun = substr($date, 0, 4);
            return "$tanggal $bulan $tahun";
        }
    }

    public function profileEdit()
    {
        $member = Auth::user();
        $tanggalLahir = $member->tanggal_lahir;
        $tanggal = substr($tanggalLahir, 8, 2);
        return view('member.edit_profil', [
            'member' => $member,
            'tanggal' => $tanggal,
        ]);
    }

    public function updateDataProfile(Request $request)
    {
        $member = Member::find(Auth::id());
        $date = $request->date;
        $months = ['Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4, 'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8, 'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12];
        $month = $months[$request->month];
        $year = $request->year;
        $dateBorn = "$year-$month-$date";

        if ($request->hasFile('foto_member')) {
            $member->clearMediaCollection();
            $member->addMedia($request->file('foto_member'))->toMediaCollection('avatar');
        }

        if (empty($request->input('current-password')) && empty($request->input('password')) && empty($request->input('confirm-password'))) {
            $member->update([
                'nama_lengkap' => $request->nama,
                'jenis_kelamin' => $request->jk,
                'tanggal_lahir' => $dateBorn,
            ]);
            return redirect()->route('profile')->with('success', 'Profil Anda telah berhasil diubah');
        } else {
            if (Auth::Check()) {
                $request_data = $request->All();
                $validator = $this->credentialRules($request_data);
                if ($validator->fails()) {
                    alert()->error('Maaf', 'Ubah Password Gagal, Silahkan Periksa Kembali Password yang Anda Ubah');
                    return redirect()->route('profile.edit');
                } else {
                    $current_password = Auth::user()->password;
                    if (Hash::check($request_data['current-password'], $current_password)) {
                        $member->update([
                            'nama_lengkap' => $request->nama,
                            'jenis_kelamin' => $request->jk,
                            'tanggal_lahir' => $dateBorn,
                            'password' => Hash::make($request->password),
                        ]);
                        return redirect()->route('profile')->with('success', 'Profil dan Password telah berhasil diubah');
                    } else {
                        alert()->error('Maaf', 'Silahkan Masukkan Password Lama dengan Benar !');
                        return redirect()->route('profile.edit');
                    }
                }
            } else {
                $member->update([
                    'nama_lengkap' => $request->nama,
                    'jenis_kelamin' => $request->jk,
                    'tanggal_lahir' => $dateBorn,
                ]);
                return redirect()->route('profile')->with('success', 'Profil Anda telah berhasil diubah');
            }
        }
    }

    public function alamat(Request $request)
    {
        $member = Auth::user();
        return view('member.alamat', compact('member'));
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
            'NamaPenerima' => $request->namapenerima,
            'NomorHP' => $request->nomorhp,
            'Provinsi' => $request->provinsi,
            'KabupatenKota' => $request->kota,
            'Kecamatan' => $request->kecamatan,
            'Kelurahan' => $request->kelurahan,
            'KodePos' => $request->kodepos,
            'AlamatJalan' => $request->alamatjalan,
        );

        $AlamatFinal['IdAlamatUtama'] = $alamatLama->IdAlamatUtama;
        $AlamatFinal['alamat'] = array_merge($alamatLama->alamat, $alamatBaru);

        $member->alamat = $AlamatFinal;
        $member->save();

        return redirect()->route('alamat')->with('success', 'Anda telah berhasil menambahkan alamat baru');
    }

    public function editAlamat($idMember, Request $request)
    {
        $member = Member::find(Auth::id());
        $alamat = $member->alamat;

        $alamat->alamat[$request->id] = [
            'id' => $request->id,
            'NamaPenerima' => $request->namapenerima,
            'NomorHP' => $request->nomorhp,
            'Provinsi' => $request->provinsi,
            'KabupatenKota' => $request->kota,
            'Kecamatan' => $request->kecamatan,
            'Kelurahan' => $request->kelurahan,
            'KodePos' => $request->kodepos,
            'AlamatJalan' => $request->alamatjalan,
        ];

        if ($alamat->IdAlamatUtama === $request->id) {
            $alamat->IdAlamatUtama = $request->id;
        }

        // array_merge($alamat->alamat, $alamat->alamat[$request->id]);
        $member->alamat = $alamat;
        $member->save();

        return redirect()->route('alamat')->with('success', 'Anda telah berhasil mengubah alamat Anda');
    }

    public function pilihAlamat($id, Request $request)
    {
        $member = Member::find(Auth::id());
        $alamat = $member->alamat;

        $alamat->IdAlamatUtama = $alamat->alamat[$id]->id;

        $member->alamat = $alamat;
        $member->save();

        if ($request->fromOrder == true) {
            return redirect()->route('konfigurasi.pesanan')->with('success', 'Anda telah mengubah alamat utama Anda');
        } else {
            return redirect()->route('alamat')->with('success', 'Anda telah mengubah alamat utama Anda');
        }
    }

    public function hapusAlamat($id, Request $request)
    {
        $member = Member::find(Auth::id());
        $alamat = $member->alamat;
        $new_array[] = array();
        $i = 0;

        foreach ($alamat->alamat as $key => $value) {
            if ($value->id != $id) {
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
            if ($alamat->IdAlamatUtama === $request->id) {
                $alamat->IdAlamatUtama = $alamat->alamat[$i - 1]->id;
            }
        }

        $member->alamat = $alamat;
        $member->save();

        return redirect()->route('alamat')->with('success', 'Anda telah berhasil menghapus alamat Anda');
    }

    public function saldoPembayaran($idProduk)
    {
        $member = Auth::user();
        $transaksi_saldo = Transaksi_saldo::find($idProduk);

        return view('member.pembayaran_topup', [
            'member' => $member,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function riwayat()
    {
        $member = Auth::user();
        $transaksi_saldo = $member->transaksiSaldo;
        if (!empty($transaksi_saldo->first()->pesanan)) {
            $idPesanan = $transaksi_saldo->first()->pesanan->id_pesanan;
            return view('member.riwayat', [
                'member' => $member,
                'transaksi_saldo' => $transaksi_saldo,
                'idPesanan' => $idPesanan,
            ]);
        } else {
            return view('member.riwayat', [
                'member' => $member,
                'transaksi_saldo' => $transaksi_saldo,
            ]);
        }
    }

    public function filterRiwayat(Request $request)
    {
        if ($request->ajax()) {
            $member = Auth::user();
            if ($request->filterRiwayat === 'Terbaru') {
                $transaksi_saldo = $member->transaksiSaldo->first()->where('jenis_transaksi', '!=', 'Tarik')
                    ->where('status', '!=', 'Pending')
                    ->orderBy('updated_at', 'desc')
                    ->get();
            } else if ($request->filterRiwayat === 'Harga Tertinggi') {
                $transaksi_saldo = $member->transaksiSaldo->first()->where('jenis_transaksi', '!=', 'Tarik')
                    ->where('status', '!=', 'Pending')
                    ->orderBy('jumlah_saldo', 'desc')
                    ->get();
            } else if ($request->filterRiwayat === 'Harga Terendah') {
                $transaksi_saldo = $member->transaksiSaldo->first()->where('jenis_transaksi', '!=', 'Tarik')
                    ->where('status', '!=', 'Pending')
                    ->orderBy('jumlah_saldo', 'asc')
                    ->get();
            } else if ($request->filterRiwayat === 'Saldo Masuk') {
                $transaksi_saldo = $member->transaksiSaldo->first()->where('jenis_transaksi', 'TopUp')
                    ->where('status', '!=', 'Pending')
                    ->get();
            } else if ($request->filterRiwayat === 'Saldo Keluar') {
                $transaksi_saldo = $member->transaksiSaldo->first()->where('jenis_transaksi', 'Pembayaran')
                    ->where('status', '!=', 'Pending')
                    ->get();
            } else {
                $transaksi_saldo = $member->transaksiSaldo->first()->where('jenis_transaksi', '!=', 'Tarik')
                    ->where('status', '!=', 'Pending')
                    ->get();
            }
            return response()->json([
                'transaksi_saldo' => $transaksi_saldo,
            ], 200);
        }
    }

    public function topUpSaldo(Request $request)
    {
        $member = Auth::user();
        $transaksiSaldo = Transaksi_saldo::all();

        $jenisTransaksi = $transaksiSaldo->jenis_transaksi = 'TopUp';
        $transaksiSaldo->status = 'Berhasil';
        $transaksiSaldo->keterangan = 'Top Up Telah Berhasil Dilakukan';
        $jumlahSaldo = (int) str_replace('.', '', $request->jumlah_saldo);
        $kodePembayaran = $jumlahSaldo + rand(1, 999);
        $status = 'Pending';
        $keterangan = 'Top Up Sedang Diproses';

        $transaksi = Transaksi_saldo::create([
            'id_member' => $member->id_member,
            'jenis_transaksi' => $jenisTransaksi,
            'jumlah_saldo' => $jumlahSaldo,
            'kode_pembayaran' => $kodePembayaran,
            'status' => $status,
            'keterangan' => $keterangan,
        ]);

        alert()->success('Top Up Anda Sedang Diproses', 'Silahkan Periksa Riwayat Halaman Pembayaran !');
        $member->notify(new TopUpNotification('pending', $transaksi));
        return redirect()->route('saldo');
    }

    public function batalTopUpSaldo($idTransaksi)
    {
        $member = Auth::user();
        $transaksiSaldo = Transaksi_saldo::find($idTransaksi);
        $transaksiSaldo->jenis_transaksi = 'TopUp';
        $transaksiSaldo->status = 'Gagal';
        $transaksiSaldo->keterangan = 'Top Up Telah Dibatalkan';
        $transaksiSaldo->save();

        $member->notify(new TopUpNotification('gagal', $transaksiSaldo));
        return redirect()->route('saldo')->with('success', 'Top Up Anda Telah Berhasil Dibatalkan');
    }

    public function riwayatSaldo($idProduk)
    {
        $member = Auth::user();
        $transaksi_saldo = Transaksi_saldo::find($idProduk);

        return view('member.riwayat_topup', [
            'member' => $member,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function pesanan()
    {
        $member = Auth::user();
        $pesanan = $member->pesanans;

        return view('member.pesanan', compact('member', 'pesanan'));
    }

    public function favorit()
    {
        $member = Auth::user();
        $produk = Produk::all();
        $produkFavorit = json_decode($member->produk_favorit);

        return view('member.produk_favorit', [
            'member' => $member,
            'produk' => $produk,
            'produkFavorit' => $produkFavorit,
        ]);
    }

    public function tambahFavorit(Request $request)
    {
        $member = Member::find(Auth::id());
        $status = false;
        $produkFavorit = json_decode($member->produk_favorit);

        if (empty($produkFavorit)) {
            array_push($produkFavorit, $request->id_produk);
            $status = true;
        } else {
            if (in_array($request->id_produk, $produkFavorit)) {
                $valueFavorit = array_search($request->id_produk, $produkFavorit);
                Arr::pull($produkFavorit, $valueFavorit);
                $status = false;
            } else {
                array_push($produkFavorit, $request->id_produk);
                $status = true;
            }
            Arr::sort($produkFavorit);
        }

        $member->produk_favorit = json_decode(json_encode($produkFavorit), true);
        // $member->produk_favorit = $produkFavorit;
        $member->save();
        $member->push();

        if ($request->fromAxios) {
            return response()->json($member->produk_favorit, 200);
        }

        if ($status != true) {
            return redirect()->back()->with('success', 'Produk telah dihilangkan dari daftar favorit Anda');
        } else {
            return redirect()->back()->with('success', 'Produk telah berhasil ditambahkan ke daftar favorit Anda');
        }
    }

    public function ulasan()
    {
        $member = Auth::user();
        $pesanan = $member->pesanans->where('status', 'Selesai');

        $arrayBelumDiulas = [];
        $arraySudahDiulas = [];

        foreach ($pesanan as $p) {
            foreach ($p->konfigurasiFile as $k) {
                if ($k->product != null) {
                    if ($member->ulasans->where('id_produk', $k->product->id_produk) != '[]') {
                        $ulasan = $member->ulasans->where('id_produk', $k->product->id_produk);
                        array_push($arraySudahDiulas, $ulasan);
                    } else {
                        $temp = new stdClass();
                        $temp->pesanan = $p;
                        $temp->product = $k->product;
                        array_push($arrayBelumDiulas, $temp);
                    }
                }
            }
        }

        return view('member.ulasan', compact('member', 'arrayBelumDiulas', 'arraySudahDiulas', 'pesanan'));
    }

    public function filterUlasan(Request $request)
    {
        if ($request->ajax()) {
            $member = Auth::user();
            $pesanan = $member->pesanans->where('status', 'Selesai');
            $ulasan = Ulasan::where('id_member', $member->id_member)->get();
            $filterKey = $request->keywordFilter;

            $arrayBelumDiulas = [];
            $arraySudahDiulas = [];
            $arrayProdukUlasan = [];
            $arrayFotoProdukUlasan = [];
            $arrayPartnerProduk = [];
            $arrayPesananUlasan = [];

            foreach ($pesanan as $p) {
                foreach ($p->konfigurasiFile as $k) {
                    if ($k->product != null) {
                        if ($member->ulasans->where('id_produk', $k->product->id_produk) != '[]') {
                            $ulasann = $member->ulasans->where('id_produk', $k->product->id_produk);
                            array_push($arraySudahDiulas, $ulasann);
                        } else {
                            $temp = new stdClass();
                            $temp->pesanan = $p;
                            $temp->product = $k->product;
                            array_push($arrayBelumDiulas, $temp);
                        }
                        $arrayFotoProdukUlasan = $k->product->foto_produk;
                    }
                }
            }

            if ($request->keywordFilter === 'Sudah Diulas') {
                foreach ($ulasan as $up => $value) {
                    array_push($arrayProdukUlasan, $value->produk);
                    $arrayFotoProdukUlasan = $value->produk->foto_produk;
                    // array_push($arrayFotoProdukUlasan, $value->produk->foto_produk);
                    array_push($arrayPartnerProduk, $value->produk->partner);
                }

                return response()->json(['ulasan' => $ulasan, 'arrayProdukUlasan' => $arrayProdukUlasan, 'arrayFotoProdukUlasan' => $arrayFotoProdukUlasan, 'arrayPartnerProduk' => $arrayPartnerProduk, 'filterKey' => $filterKey], 200);
            } else {
                foreach ($arrayBelumDiulas as $abd => $value) {
                    array_push($arrayProdukUlasan, $value->product);
                    $arrayFotoProdukUlasan = $value->product->foto_produk;
                    // array_push($arrayFotoProdukUlasan, $value->product->foto_produk);
                    array_push($arrayPartnerProduk, $value->product->partner);
                    array_push($arrayPesananUlasan, $value->pesanan);
                }

                return response()->json(['arrayBelumDiulas' => $arrayBelumDiulas, 'arrayProdukUlasan' => $arrayProdukUlasan, 'arrayFotoProdukUlasan' => $arrayFotoProdukUlasan, 'arrayPartnerProduk' => $arrayPartnerProduk, 'arrayPesananUlasan' => $arrayPesananUlasan, 'filterKey' => $filterKey], 200);
            }
        }
    }

    public function ulas($idProduk, $idPesanan)
    {
        $member = Auth::user();
        $produk = Produk::find($idProduk);
        $pesanan = Pesanan::find($idPesanan);

        return view('member.ulas_produk', compact('produk', 'member', 'pesanan'));
    }

    public function storeUlasan(Request $request, $idProduk)
    {
        $member = Auth::user();
        $produk = Produk::find($idProduk);
        // $pesanan = Pesanan::find($idPesanan);
        $ulasan = Ulasan::create([
            'id_produk' => $produk->id_produk,
            'id_member' => $member->id_member,
            'rating' => $request->stars,
            'pesan' => $request->pesan,
        ]);

        if (!empty($request->file('foto_ulasan'))) {
            $ulasan->addMedia($request->file('foto_ulasan'))->toMediaCollection('foto_ulasan');
        }

        return redirect()->route('ulasan.ulasansaya', [
            $produk->id_produk,
            $ulasan->id_ulasan,
        ])->with('success', 'Terima kasih atas penilaian Anda pada produk ini');
    }

    public function ulasanSaya($idProduk, $idUlasan)
    {
        $member = Auth::user();
        $ulasan = Ulasan::find($idUlasan);
        $produk = Produk::find($idProduk);

        return view('member.ulasan_saya', compact('member', 'produk', 'ulasan'));
    }

    public function ulasanPartner($idProduk)
    {
        $produk = Produk::find($idProduk);
        $ulasan = Ulasan::where('id_produk', $produk->id_produk)->get();
        $ratingProduk = round($ulasan->avg('rating'), 1);

        return view('member.ulasan_produk_pengelola', compact('produk', 'ulasan', 'ratingProduk'));
    }

    public function urutkanProdukPartner(Request $request)
    {
        if ($request->ajax()) {
            if ($request->filterUrutkan === 'Rating Tertinggi ke Terendah') {
                $produk = Produk::find($request->idProduk);
                $ulasan = Ulasan::where('id_produk', $produk->id_produk)
                    ->orderBy('rating', 'desc')
                    ->get();
                // $fotoUlasan = $ulasan->getFirstMediaUrl('foto_ulasan');
                // $member = $ulasan->member;
            } else if ($request->filterUrutkan === 'Rating Terendah ke Tertinggi') {
                $produk = Produk::find($request->idProduk);
                $ulasan = Ulasan::where('id_produk', $produk->id_produk)
                    ->orderBy('rating', 'asc')
                    ->get();

                // $fotoUlasan = $ulasan->getFirstMediaUrl('foto_ulasan');
                // $member = $ulasan->member;
            } else {
                $produk = Produk::find($request->idProduk);
                $ulasan = Ulasan::where('id_produk', $produk->id_produk)->get();
                // $fotoUlasan = $ulasan->getFirstMediaUrl('foto_ulasan');
                // $member = $ulasan->member;
            }
            return response()->json([
                'ulasan' => $ulasan,
                // 'fotoUlasan' => $fotoUlasan,
            ], 200);
        }
    }

    public function faq()
    {
        return view('member.faq');
    }

    public function tentang()
    {
        return view('member.tentang');
    }

    public function notif()
    {
        $member = Member::find(Auth::id());
        $pesanan = Pesanan::find(1);
        $member->notify(new PesananNotification('pembayaranPending', $pesanan));
        return "udahh dikirim";
        // Notification::send($member, new PesananNotification($pesanan));
    }

}
