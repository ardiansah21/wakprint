<?php

use Illuminate\Support\Facades\Route;

function set_active($uri, $output = 'active')
{
    if (is_array($uri)) {
        foreach ($uri as $u) {
            if (Route::is($u)) {
                return $output;
            }
        }
    } else {
        if (Route::is($uri)) {
            return $output;
        }
    }
}

function cekWarna($path, $percenMinimum = 0)
{

    $totalPageGray = 0;
    $totalPageColor = 0;
    $totalPage = 0;

    $pdf = new stdClass();
    $FileName = basename($path);
    $jumlahHal = preg_match_all("/\/Page\W/", file_get_contents($path), $dummy);

    for ($i = 0; $i < $jumlahHal; $i++) {
        $totalPixel[$i] = 0;
        $totalPixelGray[$i] = 0;
        $totalPixelColor[$i] = 0;
        $jenisWarna[$i] = "";

        $im = new imagick($path . '[' . $i . ']');
        // convert to jpg
        // $im->setResolution(400, 565);
        $im->setImageColorspace(255);
        $im->setCompression(Imagick::COMPRESSION_JPEG);
        $im->setCompressionQuality(60);
        $im->setImageFormat('jpeg');
        $im->setImageAlphaChannel(11); // Imagick::ALPHACHANNEL_REMOVE
        $im->resizeImage(10, 5, Imagick::FILTER_LANCZOS, 1);

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
        $percenMin = $percenMinimum * $totalPixel[$i] / 100;

        // if ($totalPixelColor[$i] < $totalPixelGray[$i]) {
        //     if ($totalPixelColor[$i] < $percenMin) {
        //         $totalPageGray++;
        //         $jenisWarna[$i] = "Hitam putih";
        //     } else {
        //         $totalPageColor++;
        //         $jenisWarna[$i] = "Berwarna";
        //     }
        // } else {
        //     if ($totalPixelGray[$i] < $percenMin) {
        //         $totalPageColor++;
        //         $jenisWarna[$i] = "Berwarna";
        //     } else {
        //         $totalPageGray++;
        //         $jenisWarna[$i] = "Hitam putih";
        //     }
        // }

        // if ($totalPixelColor[$i] < $totalPixelGray[$i]) { //color
        //     if ($totalPixelColor[$i] < $percenMin) {
        //         $totalPageGray++;
        //         $jenisWarna[$i] = "Hitam putih";
        //     } else {
        //         $totalPageColor++;
        //         $jenisWarna[$i] = "Berwarna";
        //     }
        // } else {
        //     if ($totalPixelColor[$i] > $percenMin) { //
        //         $totalPageColor++;
        //         $jenisWarna[$i] = "Berwarna";
        //     } else {
        //         $totalPageGray++;
        //         $jenisWarna[$i] = "Hitam putih";
        //     }
        // }

        if ($totalPixelColor[$i] != 0) {
            if ($totalPixelColor[$i] < $percenMin) {
                $jenisWarna[$i] = "Hitam putih";
            } else {
                $jenisWarna[$i] = "Berwarna";
            }
        } else {
            $jenisWarna[$i] = "Hitam putih";
        }

        //$im->writeImage($nameto);

        $im->clear();
        $im->destroy();

        $pdf->halaman[$i]['jenis_warna'] = $jenisWarna[$i];
        $pdf->halaman[$i]['piksel_hitam_putih'] = $totalPixelGray[$i];
        $pdf->halaman[$i]['piksel_berwarna'] = $totalPixelColor[$i];
        $pdf->halaman[$i]['total_piksel'] = $totalPixel[$i];

    }
    // echo "jumlah Halaman :" . $totalPage . "<br>total halaman berwarnaa" . $totalPageColor . "<br> total hal hitam putih" . $totalPageGray;
    $pdf->namaFile = $FileName;
    $pdf->jumlahHalaman = $jumlahHal;
    $pdf->jumlahHalBerwarna = $totalPageColor;
    $pdf->jumlahHalHitamPutih = $totalPageGray;
    $pdf->path = $path;

    // $pdf->jumlahPiksel = $totalPixel;
    // $pdf->jumlahPikselBerwarna = $totalPixelColor;
    // $pdf->jumlahPikselHitamPutih = $totalPixelGray;

    return $pdf;
}
