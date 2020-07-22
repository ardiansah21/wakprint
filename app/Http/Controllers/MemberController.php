<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \stdClass;
use Auth;
use App\Member;
use phpDocumentor\Reflection\Types\This;
use App\konfigurasi_file;

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
        // $this->member = Member::where('id_member', $id)->get();
        //$this->member->id_member = "123456789";
        $this->middleware('auth')->except('upload');
    }

    public function profile()
    {
        return view('member.profil');
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
        konfigurasi_file::create([
            'nama_file' => $file->getClientOriginalName(),
            'waktu'     => now(),
        ]);

        $path = $file->move(public_path('filenya/'), $file->getClientOriginalName());
        $this->f = $file;



        return view('member.konfigurasi_file_lanjutan', ['namafile' => $file->getClientOriginalName()]);
    }



    public function cekWarna(\Illuminate\Http\UploadedFile $file)
    {

        $gray = 0;
        $notgray = 0;
        $RandomNum   = time();
        $output_dir = public_path('tempCekwarna/');
        $FileName      = $file->getClientOriginalName();
        $jumlahHal = preg_match_all("/\/Page\W/", file_get_contents($file), $dummy);


        $name = $output_dir . $FileName;
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

            // if ($c == ($imgw*$imgh))
            // {
            //     $gray++;
            //     //    echo "The image is grayscale.";
            // }
            // else
            // {
            //     $notgray++;
            // //       echo "The image is NOT grayscale.";
            // }
        }


        $message = "Ciieeee PDF converted to JPEG sucessfully!!";
        $jlhWarna = "persentase minimum = 1%; yang berwarna = " . $notgray . " \nyang hitam-putih= " . $gray . "";
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

}
