<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \stdClass;
use Auth;
use App\Member;
use App\Transaksi_saldo;
use phpDocumentor\Reflection\Types\This;
use App\konfigurasi_file;
use imagick;
use File;
use Storage;
use Response;
use Validator;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    private stdClass $member;
    private $id;
    private $f;
    public function __construct()
    {
        if (Auth::check()) {
            // $this->member = Auth::User();         
        } else {
            // $this->member = null;
        }

        //$this->member = Member::where('id_member', $id)->get();
        // $this->member = Member::where('id_member', $id)->get();
        //$this->member->id_member = "123456789";
        $this->middleware('auth')->except(['upload', 'showPDF']);
    }

    public function konfigurasiFile()
    {
        return view('member.konfigurasi_file_lanjutan', ['namafile' => $this->f]);
    }


    public function upload(Request $request)
    {
        // $path = Storage::putFile(
        //     'public/files',
        //     $request->file('file'),
        // );
        $this->validate($request, [
            'file' => 'required',
        ]);
        $file = $request->file('file');
        $k = konfigurasi_file::insertGetId([
            'nama_file' => $file->getClientOriginalName(),
            'waktu'     => now(),
        ]);
        $idd = $k;
        $path = $file->move(public_path('filenya/'), $file->getClientOriginalName());
        $pdf = $this->cekWarna($file, $path);


        return view('member.konfigurasi_file_lanjutan', ['pdf' => $pdf]);
    }



    public function cekWarna(\Illuminate\Http\UploadedFile $file, $path)
    {

        $gray = 0;
        $notgray = 0;
        $RandomNum   = time();
        $FileName      = $file->getClientOriginalName();
        $output_dir = public_path('tempCekwarna/') . $FileName;
        if (!File::exists(public_path('tempCekwarna/') . $FileName)) {
            $output_dir = File::makeDirectory(public_path('tempCekwarna/') . $FileName, 0777, true);
        }
        $jumlahHal = preg_match_all("/\/Page\W/", file_get_contents($path), $dummy);


        // $name = $output_dir . $FileName;
        $name = $path;

        // $location . " " .  $convert    = $location . " " . $name . " ".$nameto;
        // exec("convert ".$convert);

        for ($i = 0; $i < $jumlahHal; $i++) {
            $nameto     = $output_dir . $RandomNum . '-' . $i . '.jpg';
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
            //$display .= "<img src='$output_dir$RandomNum-$i.jpg' title='Page-$i' /><br>";
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

    public function showPDF($path)
    {
        // return Response::make($pdfContent, 200, [
        //     'Content-Type'        => $type,
        //     'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        //   ]);
        // return response()->file($path);
        
        // $contentType = mime_content_type($path);
        // return Response::make(file_get_contents($path), 200, [

        //     'Content-Type' => $contentType,
        //     'Content-Disposition' => 'inline; filename="' . $filename . '"'
        // ]);
    }



    // public function profil()
    // {
    //     return view('member.profil');
    // }

    // public function logout()
    // {
    //     Auth::guard('member')->logout();
    //     return redirect()->route('member.login');
    // }
    // public function logout(Request $request)
    // {
    //     Auth::guard('member')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     if ($response = $this->loggedOut($request)) {
    //         return $response;
    //     }

    //     return $request->wantsJson()
    //         ? new Response('', 204)
    //         : redirect('/member/login');
    // }


    ///tempat nambah


    public function produk()
    {
        //dd(getDateBorn());
        return view('member.detail_produk');
    }

    public function profile()
    {
        //dd(getDateBorn());
        $member=Auth::user();
        $transaksi_saldo = Transaksi_saldo::all();
        
        // foreach ($transaksi_saldo as $ts => $value) {
        //     dd($value['kode_pembayaran']);    
        // }

        //dd($transaksiSaldo);

        // $id = Transaksi_saldo::find(Auth::id());
        
        //dd($member);
        return view('member.profil',[
            'member' => $member,
            'transaksi_saldo' => $transaksi_saldo,
            'tanggalLahir'=>$this->getDateBorn()]
        );
    }

    public function show(Request $request,$id)
    {
        $transaksiSaldo = Transaksi_saldo::find($id);
        return view('member.profil',compact('transaksiSaldo'))->renderSections()['content'];
    }

    public function topUpSaldo(Request $request)
    {
        $member = Member::find(Auth::id());
        $transaksiSaldo = Transaksi_saldo::all();
        //$transaksiSaldo = transaks
        
        $transaksiSaldo->jenis_transaksi = 'TopUp';
        $transaksiSaldo->status = 'Berhasil';
        $transaksiSaldo->keterangan = 'Top Up Telah Berhasil Dilakukan';
        $transaksiSaldo->waktu = Carbon::now()->format('Y:m:d H:i:s');
        $jumlahSaldo = $request->jumlah_saldo;
        $waktuTransaksi = $transaksiSaldo->waktu;
        $jenisTransaksi = $transaksiSaldo->jenis_transaksi;
        $statusTransaksi = $transaksiSaldo->status;
        $keteranganTransaksi = $transaksiSaldo->keterangan;
        dd($transaksiSaldo->id_transaksi);
        
        $transaksiSaldo->save();
    
        return redirect()->route('profile');
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
    // public function postCredentials(Request $request)
    // {
        
    // }

    public function getDateBorn()
    {
        if(empty(Auth::user()->tanggal_lahir)){
            return "-";
        }

        else{
            $monthName=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
            $date = Auth::user()->tanggal_lahir;
            $tanggal = intval(substr($date,8,2));
            $bulan = $monthName[intval(substr($date,5,2)-1)];
            $tahun = substr($date,0,4);
            return "$tanggal $bulan $tahun";
        }
        
    }

    public function profileEdit()
    {
        $member = Member::find(Auth::id())->get();
        $transaksiSaldo=Transaksi_saldo::all();
        return view('member.edit_profil',[
            'member'=>$member,
            'transaksi_saldo' => $transaksiSaldo
        ]);
    }

    public function updateDataProfile(Request $request){
        // $request->validate([
        //     'foto_profil' => 'image|mimes:jpeg,png,jpg|max:2048',
        // ]);

        // $member = Member::find(Auth::user());
        
        $date = $request->date;
        $month = $request->month;
        $year = $request->year;

        // $dateBorn = array(
        //     'Tanggal' => $date,
        //     'Bulan' => $month,
        //     'Tahun' => $year,
        // );

        $dateBorn = date_create("$year-$month-$date");

        if(empty($request->input('current-password')) && empty($request->input('password')) && empty($request->input('confirm-password'))){
            Member::find(Auth::id())->update([
                'nama_lengkap' => $request->nama,
                'jenis_kelamin' => $request->jk,
                'tanggal_lahir' => $dateBorn
            ]);

            // $photoName = $member->id_member.'_image'.time().'.'.request()->photoprofile->getClientOriginalExtension();
            // $request->photoprofile->storeAs('img/photos',$photoName);
            // $member->foto_profil = $photoName;
            // $member->save();

            return redirect()->route('profile')->with('alert','Profil berhasil diubah');
        }
        else{
            if(Auth::Check())
            {
                $request_data = $request->All();
                $validator = $this->credentialRules($request_data);
                if($validator->fails())
                {
                    //return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
    
                    return redirect()->route('profile.edit')->with('alert', 'Ubah Password Gagal, Silahkan Periksa Kembali Password yang Anda Ubah');
                }
                else
                {  
                    $current_password = Auth::user()->password;         
                    if(Hash::check($request_data['current-password'], $current_password))
                    {           
                        $member_id = Auth::user()->id_member;                       
                        $member = Member::find($member_id);
                        $member->update([
                            'password' => Hash::make($request->password)
                        ]);
                        return redirect()->route('profile')->with('alert', 'Password telah berhasil diubah');
                    }
                    else
                    {           
                        // $error = array('current-password' => 'Please enter correct current password');
                        // return response()->json(array('error' => $error), 400);

                        return redirect()->route('profile.edit')->with('alert', 'Silahkan Masukkan Password Lama dengan Benar !');
                    }
                }        
            }
            else
            {   
                Member::find(Auth::id())->update([
                    'nama_lengkap' => $request->nama,
                    'jenis_kelamin' => $request->jk,
                    'tanggal_lahir' => $dateBorn
                ]);
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
        return view('member.alamat',['member'=>Auth::user()]);
    }

    public function tambahAlamat(Request $request)
    {
        $member = Member::find(Auth::id());
        
        $alamatLama = $member->alamat;
        
        if(empty($alamatLama)){
            $alamatLama = array(
                'IdAlamatUtama' => 0,
                'alamat'=>array()
            );
            $id=0;
        }
        else{
            $id = count($alamatLama['alamat']);
        }
        
        $alamatBaru[] = array(
            'id'=> $id,
            'NamaPenerima' => $request->namapenerima,
            'NomorHP' => $request->nomorhp,
            'Provinsi' => $request->provinsi,
            'KabupatenKota' => $request->kota,
            'Kecamatan' => $request->kecamatan,
            'Kelurahan' => $request->kelurahan,
            'KodePos' => $request->kodepos,
            'AlamatJalan' => $request->alamatjalan
        );        
        
        $AlamatFinal['IdAlamatUtama'] = $alamatLama['IdAlamatUtama'];
        $AlamatFinal['alamat'] = array_merge($alamatLama['alamat'],$alamatBaru);

        $member->alamat = $AlamatFinal;
        $member->save();
    
        return redirect()->route('alamat');
    }

    public function editAlamat(Request $request)
    {   
        
        $member = Member::find(Auth::id());
        $alamat = $member->alamat;

        $alamatBaru = array(
            'id'=> $request->id,
            'NamaPenerima' => $request->namapenerima,
            'NomorHP' => $request->nomorhp,
            'Provinsi' => $request->provinsi,
            'KabupatenKota' => $request->kota,
            'Kecamatan' => $request->kecamatan,
            'Kelurahan' => $request->kelurahan,
            'KodePos' => $request->kodepos,
            'AlamatJalan' => $request->alamatjalan
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
            if($value['id'] != $id){
                $new_array[$i] = $value;
                $new_array[$i]['id'] = $i;
                $i++; 
            }
        }
        $alamat['alamat'] = $new_array; 
        
        if(empty($new_array['alamat'])){
            
            //unset($new_array['alamat']);
            //unset($alamat['IdAlamatUtama']);
            //unset($new_array['IdAlamatUtama']);
            //dd($alamat['alamat']);
        }
        $member->alamat = $alamat;
        $member->save();

        return redirect()->route('alamat');
        //return view('member.alamat',['member'=>Auth::user()]);
    }

    public function konfigurasiPesanan()
    {
        return view('member.konfigurasi_pesanan');
    }

    public function ulas()
    {
        return view('member.ulas_produk');
    }

    public function ulasanSaya()
    {
        return view('member.ulasan_saya');
    }
}
