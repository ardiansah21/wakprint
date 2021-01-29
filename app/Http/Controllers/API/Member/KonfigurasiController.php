<?php

namespace App\Http\Controllers\API\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use imagick;
use stdClass;

class KonfigurasiController extends Controller
{
    public function prosesCekWarna(Request $request)
    {
        $jumlahHal = $request->jumlahHal;

        $pdf = new stdClass();
        $path = $request->path;
        $percenMinimum = $request->ntkwh;

        $totalPageGray = 0;
        $totalPageColor = 0;

        for ($i = 0; $i < $jumlahHal; $i++) {
            $jenisWarna[$i] = "";
            $totalPixel[$i] = 0;
            $totalPixelGray[$i] = 0;
            $totalPixelColor[$i] = 0;

            $im = new imagick($path . '[' . $i . ']');
            // convert to jpg
            // $im->setResolution(400, 565);
            $im->setImageColorspace(255);
            $im->setCompression(Imagick::COMPRESSION_JPEG);
            $im->setCompressionQuality(60);
            $im->setImageFormat('jpeg');
            $im->setImageAlphaChannel(11); // Imagick::ALPHACHANNEL_REMOVE
            // $im->resizeImage(10, 5, Imagick::FILTER_LANCZOS, 1);

            for ($x = 0; $x < $im->getImageWidth(); $x++) {
                for ($y = 0; $y < $im->getImageHeight(); $y++) {
                    $pixel = $im->getImagePixelColor($x, $y);
                    $colors = $pixel->getColor();
                    if ($colors['r'] == $colors['g'] && $colors['r'] == $colors['b']) {
                        $totalPixelGray[$i]++;
                    }
                }
            }
            $totalPixel[$i] = $im->getImageWidth() * $im->getImageHeight();
            $totalPixelColor[$i] = $totalPixel[$i] - $totalPixelGray[$i];
            $percenMinPixelColor = $percenMinimum * $totalPixel[$i] / 100;

            if ($totalPixelColor[$i] <= $percenMinPixelColor) {
                $totalPageGray++;
                $jenisWarna[$i] = "Hitam putih";
            } else {
                $totalPageColor++;
                $jenisWarna[$i] = "Berwarna";
            }

            $im->clear();
            $im->destroy();

            $pdf->halaman[$i]['jenis_warna'] = $jenisWarna[$i];
            $pdf->halaman[$i]['piksel_hitam_putih'] = $totalPixelGray[$i];
            $pdf->halaman[$i]['piksel_berwarna'] = $totalPixelColor[$i];
            $pdf->halaman[$i]['total_piksel'] = $totalPixel[$i];

        }
        // echo "jumlah Halaman :" . $totalPage . "<br>total halaman berwarnaa" . $totalPageColor . "<br> total hal hitam putih" . $totalPageGray;
        $pdf->jumlahHalaman = $jumlahHal;
        $pdf->jumlahHalBerwarna = $totalPageColor;
        $pdf->jumlahHalHitamPutih = $totalPageGray;
        $pdf->path = $path;

        return responseSuccess("Data Deteksi Warna Halaman", $pdf);
    }
}
