<?php

namespace App\Http\Controllers;

use App\konfigurasi_file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

// class KonFileController extends Controller
// {

//     public function upload(Request $request)
//     {
//         // $path = Storage::putFile(
//         //     'public/files',
//         //     $request->file('file'),
//         // );
//         $this->validate($request, [
// 			'file' => 'required',
// 		]);
//         $file = $request->file('file');
//         konfigurasi_file::create([
//             'nama_file' => $file->getClientOriginalName(),
//             'waktu'     => now(),
//         ]);
        
//         $file->move(public_path('filenya/'), $file->getClientOriginalName());
//         return redirect()->route('konfigurasi.file',['namafile'=>$file->getClientOriginalName()]);
//     }

//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         //
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         //
//     }
// }
