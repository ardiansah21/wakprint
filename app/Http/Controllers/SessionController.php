<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->session()->has('file')) {
            return $request->session()->get('file');
        } else {
            return "tidak ada session";
        }
    }

    public function put(Request $request)
    {
        $request->session()->put('file', 'GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG');
        return "Data file sudah ditambah pada session";
    }

    public function push(Request $request)
    {
        if ($request->session()->exists('file')) {
            $request->session()->push('file.k', '2131231212ddddddddddddddddddddddddd');
            return $request->session()->get('file');
        } else {
            return 'Data tidak ditemukan pada session';
        }
    }

    public function delete(Request $request)
    {
        $request->session()->forget('file');
        return "Data sudah dihapus pada session.";
    }

    public function tes(Request $request)
    {
        $a = $request->session()->get('file.k');
        return $a[0];
    }

}
