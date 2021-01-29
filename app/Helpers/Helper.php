<?php

use Illuminate\Support\Facades\Log;
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
function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function cekWarna($path, $percenMinimum = 0)
{
    ini_set('max_execution_time', 3000);
    $start = microtime(true);

    $totalPageGray = 0;
    $totalPageColor = 0;
    $totalPage = 0;

    $pdf = new stdClass();
    $FileName = basename($path);
    $jumlahHal = preg_match_all("/\/Page\W/", file_get_contents($path), $dummy);

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

        if ($totalPixelColor[$i] < $totalPixelGray[$i]) {
            if ($totalPixelColor[$i] <= $percenMinPixelColor) {
                $totalPageGray++;
                $jenisWarna[$i] = "Hitam putih";
            } else {
                $totalPageColor++;
                $jenisWarna[$i] = "Berwarna";
            }
        } else {
            if ($totalPixelGray[$i] <= $percenMinPixelColor || $percenMinPixelColor == 0) {
                $totalPageColor++;
                $jenisWarna[$i] = "Berwarna";
            } else {
                $totalPageGray++;
                $jenisWarna[$i] = "Hitam putih";
            }
        }

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
    $pdf->waktuEksekusi = (microtime(true) - $start);
    $pdf->pixelPercenMin = $percenMinPixelColor;

    // $pdf->jumlahPiksel = $totalPixel;
    // $pdf->jumlahPikselBerwarna = $totalPixelColor;
    // $pdf->jumlahPikselHitamPutih = $totalPixelGray;

    Log::info("------------------");
    Log::info($percenMinPixelColor);
    Log::info($percenMinimum);
    Log::info("------------------");
    return $pdf;
}

function cekWarnaNew($path, $percenMinimum)
{
    ini_set('max_execution_time', 300000);
    $start = microtime(true);

    $totalPageGray = 0;
    $totalPageColor = 0;
    $totalPage = 0;

    $pdf = new stdClass();
    $FileName = basename($path);
    $jumlahHal = preg_match_all("/\/Page\W/", file_get_contents($path), $dummy);

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
    $pdf->namaFile = $FileName;
    $pdf->jumlahHalaman = $jumlahHal;
    $pdf->jumlahHalBerwarna = $totalPageColor;
    $pdf->jumlahHalHitamPutih = $totalPageGray;
    $pdf->path = $path;
    $pdf->waktuEksekusi = number_format((microtime(true) - $start), 2);
    $pdf->pixelPercenMin = $percenMinPixelColor;

    // $pdf->jumlahPiksel = $totalPixel;
    // $pdf->jumlahPikselBerwarna = $totalPixelColor;
    // $pdf->jumlahPikselHitamPutih = $totalPixelGray;

    Log::info("------------------");
    Log::info($percenMinPixelColor);
    Log::info($percenMinimum);
    Log::info("------------------");

    return $pdf;
}


function cekWarnaMobile($filePDF)
{
        $pdf = new stdClass();
        $filePDF = $filePDF;
        $jumlahHal = preg_match_all("/\/Page\W/", file_get_contents($filePDF), $dummy);;

        $totalPageGray = 0;
        $totalPageColor = 0;

        for ($i = 0; $i < $jumlahHal; $i++) {
            $jenisWarna[$i] = "";
            $totalPixel[$i] = 0;
            $totalPixelGray[$i] = 0;
            $totalPixelColor[$i] = 0;

            $im = new imagick($filePDF . '[' . $i . ']');
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
            $persentasePageColor[$i] = $totalPixelColor[$i] * $totalPixel[$i] / 100;

            $im->clear();
            $im->destroy();

            $pdf->halaman[$i]['jenis_warna'] = $jenisWarna[$i];
            $pdf->halaman[$i]['persetase_halaman_berwarna'] = $persentasePageColor[$i];

        }
        $pdf->jumlahHalaman = $jumlahHal;
        $pdf->jumlahHalBerwarna = $totalPageColor;
        $pdf->jumlahHalHitamPutih = $totalPageGray;
        return $pdf
}




function activeGuard()
{

    foreach (array_keys(config('auth.guards')) as $guard) {

        if (auth()->guard($guard)->check()) {
            return $guard;
        }

    }
    return null;
}
