<?php

function cekWarna($path, $percenMinimum = 0)
{
    $totalPageGray = 0;
    $totalPageColor = 0;
    $totalPage = 0;

    $pdf = new stdClass();
    $FileName = basename($path);
    $jumlahHal = preg_match_all("/\/Page\W/", file_get_contents($path), $dummy);

    for ($i = 0; $i < $jumlahHal; $i++) {
        $totalpixel[$i] = 0;
        $totalPixelGray[$i] = 0;
        $totalPixelColor[$i] = 0;

        $im = new imagick($path . '[' . $i . ']');
        // convert to jpg
        // $im->setResolution(400, 565);
        $im->setImageColorspace(255);
        $im->setCompression(Imagick::COMPRESSION_JPEG);
        $im->setCompressionQuality(60);
        $im->setImageFormat('jpeg');
        $im->thumbnailImage(100, 0);
        $im->setImageAlphaChannel(11); // Imagick::ALPHACHANNEL_REMOVE
        $im->resizeImage(500, 300, Imagick::FILTER_LANCZOS, 1);
        for ($x = 0; $x < $im->getImageWitdh(); $x++) {
            for ($y = 0; $y < $im->getImageHeight(); $y++) {
                $pixel = $image->getImagePixelColor($x, $y);
                $colors = $pixel->getColor();
                if ($colors['r'] == $color['g'] && $colors['r'] == $color['b']) {
                    $totalPixelGray[$i]++;
                }
            }
        }
        $totalpixel[$i] = ($im->getImageWitdh() * $im->getImageHeight());
        $totalPixelColor[$i] = $totalpixel - $totalPixelGray;
        $percenMin = $percenMinimum * $totalpixel / 100;

        if ($totalPixelColor[$i] < $totalPixelGray[$i]) {
            if ($$totalPixelColor[$i] < $persenMin) {
                $totalPageGray++;
            } else {
                $totalPageColor++;
            }
        } else {
            if ($totalPixelGray[$i] < $persenMin) {
                $totalPageColor++;
            } else {
                $totalPageGray++;
            }
        }

        //$im->writeImage($nameto);
        $im->clear();
        $im->destroy();
    }
    // echo "jumlah Halaman :" . $totalPage . "<br>total halaman berwarnaa" . $totalPageColor . "<br> total hal hitam putih" . $totalPageGray;
    $pdf->namaFile = $FileName;
    $pdf->jumlahHalaman = $jumlahHal;
    $pdf->jumlahHalBerwarna = $totalPageColor;
    $pdf->jumlahHalHitamPutih = $totalPageGray;
    $pdf->path = $path;
    $pdf->jumlahPikselBerwarna = $totalPixelColor;
    $pdf->jumlahPikselHitamPutih = $totalPixelGray;

}
