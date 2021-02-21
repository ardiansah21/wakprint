<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengujianController extends Controller
{

    public function index()
    {
        return view('pengujian');
    }

    public function store(Request $request)
    {

        $path = public_path('temp_pdf_pengujian');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $nameFile = $request->file('file')->getClientOriginalName();

        $request->file('file')->move($path, $nameFile);
        $path = $path . '/' . $nameFile;

        return response()->json([
            'path' => $path,
            'name' => $nameFile,
        ], 200);
    }

    public function proses(Request $request)
    {
        $pdf = cekWarnaNew($request->path, $request->percenMin);
        return response()->json($pdf, 200);

    }
}
