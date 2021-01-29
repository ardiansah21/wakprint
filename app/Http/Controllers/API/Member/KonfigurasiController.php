<?php

namespace App\Http\Controllers\API\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KonfigurasiController extends Controller
{
    public function prosesCekWarna(Request $request)
    {
        $pdf = cekWarnaMobile($request->filePDF);

        return responseSuccess("Data Deteksi Warna Halaman", $pdf);
    }
}
