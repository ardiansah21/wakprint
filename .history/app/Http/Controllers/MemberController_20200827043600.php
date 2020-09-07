<?php

namespace App\Http\Controllers;

use App\Atk;
use App\Konfigurasi_file;
use App\Member;
use App\Pengelola_Percetakan;
use App\Produk;
use App\Transaksi_saldo;
use Carbon\Carbon;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use imagick;
use Str;
use Validator;
use \stdClass;

class MemberController extends Controller
{

    private $id;
    private $f;

    public function __construct()
    {

    }

////
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

    public function index()
    {
        // $member = Auth::user();
        $produk = Produk::all();
        $partner = Pengelola_Percetakan::all();
        // json_decode($produk->fitur,true);
        //dd($fitur);
        return view('home', compact('produk', 'partner'));
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

    public function konfigurasiFile($pdf)
    {
        $produk = Produk::all();
        $partner = Pengelola_Percetakan::all();
        $fitur = json_decode($produk->fitur, true);
        return view('member.konfigurasi_file_lanjutan', [
            'pdf' => $pdf,
            'produk' => $produk,
            'partner' => $partner,
            'fitur' => $fitur,
        ]);
    }

    public function pencarian(Request $request)
    {
        $produk = Produk::paginate(1);
        $partner = Pengelola_Percetakan::paginate(30);

        if ($request->ajax()) {
            return view('member.cardf_produk', ['produk' => $produk])->render();
        }
        // $fitur = json_decode($produk->fitur,true);
        return view('member.pencarian', compact('partner', 'produk'));
    }

    public function detailPartner($id)
    {
        $produk = Produk::all();
        $partner = Pengelola_Percetakan::find($id);
        $atk = Atk::all();
        // $fitur = json_decode($produk->fitur,true);
        return view('member.detail_percetakan', compact('produk', 'partner', 'atk'));
    }

    public function detailProduk($id)
    {
        $produk = Produk::find($id);
        $atk = Atk::all();
        $fitur = json_decode($produk->fitur, true);
        return view('member.detail_produk', compact('produk', 'fitur', 'atk'));
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
        ]);
        $file = $request->file('file');
        $k = Konfigurasi_file::insertGetId([
            'nama_file' => $file->getClientOriginalName(),
            'waktu' => now(),
        ]);
        $idd = $k;
        $path = $file->move(public_path('tmp/upload'), $file->getClientOriginalName());
        $pdf = $this->cekWarna($file, $path);

        $produk = Produk::all();
        $partner = Pengelola_Percetakan::all();
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

        return view('member.konfigurasi_file_lanjutan', [
            'pdf' => $pdf,
            'produk' => $produk,
            'partner' => $partner,
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

    public function profile()
    {
        //dd(getDateBorn());
        $member = Auth::user();
        $transaksi_saldo = Transaksi_saldo::all();
        $pengelola = Pengelola_Percetakan::all();
        $produk = Produk::all();

        // foreach ($transaksi_saldo as $ts => $value) {
        //     dd($value['kode_pembayaran']);
        // }

        //dd($transaksiSaldo);

        // $id = Transaksi_saldo::find(Auth::id());

        //dd($member);
        return view('member.profil', [
            'member' => $member,
            'transaksi_saldo' => $transaksi_saldo,
            'pengelola_percetakan' => $pengelola,
            'produk' => $produk,
            'tanggalLahir' => $this->getDateBorn()]
        );
    }

    public function show(Request $request, $id)
    {
        $transaksiSaldo = Transaksi_saldo::find($id);
        return view('member.profil', compact('transaksiSaldo'))->renderSections()['content'];
    }

    public function saldo()
    {
        $member = Auth::user();
        // $id = Pengelola_Percetakan::find(Auth::id());
        $transaksi_saldo = Transaksi_saldo::all();
        // $id = Auth::user($transaksi_saldo->id_pengelola);
        return view('member.topup_saldo', [
            'member' => $member,
            // 'id' => $id,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function topUpSaldo(Request $request)
    {
        $member = Auth::user();
        //$member = Member::find(Auth::id());
        $transaksiSaldo = Transaksi_saldo::all();
        //$transaksiSaldo = transaks

        $jenisTransaksi = $transaksiSaldo->jenis_transaksi = 'TopUp';
        $transaksiSaldo->status = 'Berhasil';
        $transaksiSaldo->keterangan = 'Top Up Telah Berhasil Dilakukan';
        $transaksiSaldo->waktu = Carbon::now()->format('Y:m:d H:i:s');
        $jumlahSaldo = $request->jumlah_saldo;
        $kodePembayaran = Str::random(20);
        $status = 'Pending';
        $keterangan = 'Top Up Sedang Diproses';
        $waktu = Carbon::now()->format('Y:m:d H:i:s');

        Transaksi_saldo::create([
            'id_member' => $member->id_member,
            'jenis_transaksi' => $jenisTransaksi,
            'jumlah_saldo' => $jumlahSaldo,
            'kode_pembayaran' => $kodePembayaran,
            'status' => $status,
            'keterangan' => $keterangan,
            'waktu' => $waktu,
        ]);

        return redirect()->route('saldo')->with('alert', 'Top Up Anda Sedang Diproses, Silahkan Periksa Riwayat Halaman Pembayaran ! ');
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
        return view('member.edit_profil', ['member' => $member]);
    }

    public function updateDataProfile(Request $request)
    {
        $member = Member::find(Auth::id());
        $date = $request->date;
        $month = $request->month;
        $year = $request->year;

        $dateBorn = date_create("$year-$month-$date");

        if (empty($request->input('current-password')) && empty($request->input('password')) && empty($request->input('confirm-password'))) {
            $member->update([
                'nama_lengkap' => $request->nama,
                'jenis_kelamin' => $request->jk,
                'tanggal_lahir' => $dateBorn,
            ]);
            $member->clearMediaCollection();
            $member->addMedia($request->file('foto_member'))->toMediaCollection();
            return redirect()->route('profile')->with('alert', 'Profil berhasil diubah');
        } else {
            if (Auth::Check()) {
                $request_data = $request->All();
                $validator = $this->credentialRules($request_data);
                if ($validator->fails()) {
                    //return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);

                    return redirect()->route('profile.edit')->with('alert', 'Ubah Password Gagal, Silahkan Periksa Kembali Password yang Anda Ubah');
                } else {
                    $current_password = Auth::user()->password;
                    if (Hash::check($request_data['current-password'], $current_password)) {
                        // $member_id = Auth::user()->id_member;
                        // $member = Member::find($member_id);
                        $member->update([
                            'nama_lengkap' => $request->nama,
                            'jenis_kelamin' => $request->jk,
                            'tanggal_lahir' => $dateBorn,
                            'password' => Hash::make($request->password),
                        ]);
                        $member->clearMediaCollection();
                        $member->addMedia($request->file('foto_member'))->toMediaCollection();
                        return redirect()->route('profile')->with('alert', 'Profil dan Password telah berhasil diubah');
                    } else {
                        return redirect()->route('profile.edit')->with('alert', 'Silahkan Masukkan Password Lama dengan Benar !');
                    }
                }
            } else {
                $member->update([
                    'nama_lengkap' => $request->nama,
                    'jenis_kelamin' => $request->jk,
                    'tanggal_lahir' => $dateBorn,
                ]);
                $member->clearMediaCollection();
                $member->addMedia($request->file('foto_member'))->toMediaCollection();
                return redirect()->route('profile')->with('alert', 'Profil telah berhasil diubah');
            }
        }
    }

    public function alamat()
    {
        //$member = Member::find(Auth::id())->get();
        //$member = Member::find($id);

        //$member = Member::all();
        //return view('member.profil');
        //dd(count(Auth::user()->alamat));
        return view('member.alamat', ['member' => Auth::user()]);
    }

    public function tambahAlamat(Request $request)
    {
        $member = Member::find(Auth::id());

        $alamatLama = $member->alamat;

        if (empty($alamatLama)) {
            $alamatLama = array(
                'IdAlamatUtama' => 0,
                'alamat' => array(),
            );
            $id = 0;
        } else {
            $id = count($alamatLama['alamat']);
        }

        $alamatBaru[] = array(
            'id' => $id,
            'Nama Penerima' => $request->namapenerima,
            'Nomor HP' => $request->nomorhp,
            'Provinsi' => $request->provinsi,
            'Kabupaten Kota' => $request->kota,
            'Kecamatan' => $request->kecamatan,
            'Kelurahan' => $request->kelurahan,
            'Kode Pos' => $request->kodepos,
            'Alamat Jalan' => $request->alamatjalan,
        );

        $AlamatFinal['IdAlamatUtama'] = $alamatLama['IdAlamatUtama'];
        $AlamatFinal['alamat'] = array_merge($alamatLama['alamat'], $alamatBaru);

        $member->alamat = $AlamatFinal;
        $member->save();

        // dd($member->alamat['IdAlamatUtama']);

        // //tampilan
        // for($i=0 ; $i < count($alamatLama['alamat'])-1;i++ ){
        //     if($member->alamat['IdAlamatUtama']==$i){
        //         div aktif
        //     }
        //     else{
        //         div biasa
        //     }
        // }
        // //ubah alat utama
        // $member->alamat['IdAlamatUtama'] = 2
        // $member->save();
        // return view('/alamat');

        // dd(json_encode($member->alamat));
        return redirect()->route('alamat');
    }

    public function editAlamat($id, Request $request)
    {
        $member = Member::find($id);

        $namaPenerima = $request->namapenerima;
        $nomorHP = $request->nomorhp;
        $provinsi = $request->provinsi;
        $kabKota = $request->kota;
        $kecamatan = $request->kecamatan;
        $kelurahan = $request->kelurahan;
        $kodePos = $request->kodepos;
        $alamatJalan = $request->alamatjalan;

        $alamatBaru = array(
            'Nama Penerima' => $request->namapenerima,
            'Nomor HP' => $request->nomorhp,
            'Provinsi' => $request->provinsi,
            'Kabupaten Kota' => $request->kota,
            'Kecamatan' => $request->kecamatan,
            'Kelurahan' => $request->kelurahan,
            'Kode Pos' => $request->kodepos,
            'Alamat Jalan' => $request->alamatjalan,
        );

        $alamat['alamat'][$request->id] = $alamatBaru;
        $member->alamat = $alamat;
        $member->save();

        return redirect()->route('alamat');
    }

    public function hapusAlamat($id)
    {
        $member = Member::find(Auth::id());
        $alamat = $member->alamat;
        $new_array[] = array();
        $i = 0;
        foreach ($alamat['alamat'] as $key => $value) {
            if ($value['id'] != $id) {
                $new_array[$i] = $value;
                $new_array[$i]['id'] = $i;
                $i++;
            }
        }
        $alamat['alamat'] = $new_array;

        if (empty($new_array['alamat'])) {

            //unset($new_array['alamat']);
            //unset($alamat['IdAlamatUtama']);
            //unset($new_array['IdAlamatUtama']);
            //dd($alamat['alamat']);
        }
        $member->alamat = $alamat;
        $member->save();

        //return redirect()->route('alamat');
        //return view('member.alamat',['member'=>Auth::user()]);
        return redirect()->to('alamat/' . $id);
    }

    public function konfigurasiPesanan()
    {
        return view('member.konfigurasi_pesanan');
    }

    public function saldoPembayaran($id)
    {
        $member = Auth::user();
        $transaksi_saldo = Transaksi_saldo::find($id);
        $waktu = $transaksi_saldo->waktu;

        return view('member.pembayaran_topup', [
            'member' => $member,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function riwayat()
    {
        $member = Auth::user();
        $transaksi_saldo = Transaksi_saldo::all();

        return view('member.riwayat', [
            'member' => $member,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function riwayatSaldo($id)
    {
        $member = Auth::user();
        $transaksi_saldo = Transaksi_saldo::find($id);

        return view('member.riwayat_topup', [
            'member' => $member,
            'transaksi_saldo' => $transaksi_saldo,
        ]);
    }

    public function detailRiwayat()
    {
        // $member=Auth::user();
        // $transaksi_saldo = Transaksi_saldo::all();

        return view('member.detail_pesanan');
    }

    public function pesanan()
    {
        $member = Auth::user();
        // $transaksi_saldo = Transaksi_saldo::all();

        return view('member.pesanan', [
            'member' => $member,
            // 'transaksi_saldo' => $transaksi_saldo
        ]);
    }

    public function favorit()
    {
        $member = Auth::user();
        $produk = Produk::all();
        // $transaksi_saldo = Transaksi_saldo::all();

        return view('member.produk_favorit', [
            'member' => $member,
            'produk' => $produk,
            // 'transaksi_saldo' => $transaksi_saldo
        ]);
    }

    public function ulasan()
    {
        $member = Auth::user();
        // $produk=Produk::all();
        // $transaksi_saldo = Transaksi_saldo::all();

        return view('member.ulasan', [
            'member' => $member,
        ]);
    }

    public function ulas()
    {
        return view('member.ulas_produk');
    }

    public function ulasanSaya()
    {
        return view('member.ulasan_saya');
    }

    public function chat()
    {
        return view('member.chat');
    }

}
