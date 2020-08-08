<?php

namespace App\Http\Controllers;

use App\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengujian');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1 $path = $request->file('file')->storeAs('pdf', $request->file('file')->getClientOriginalName());

        // 2 $path = $request->file('file')->storeAs(
        //     'pdf',
        //     $request->file('file')->getClientOriginalName(),
        //     'public'
        // );

        //  dd($path);

        //  1 $path = storage_path("app/" . $path);

        $path = public_path('pengujian/pdf');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $request->file('file')->move($path, $request->file('file')->getClientOriginalName());
        $path = $path . '/' . $request->file('file')->getClientOriginalName();

        $percenMin = $request->percenMin;

        $pdf = cekWarna($path, $percenMin);

        return response()->json($pdf, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pdf  $pdf
     * @return \Illuminate\Http\Response
     */
    public function show(Pdf $pdf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pdf  $pdf
     * @return \Illuminate\Http\Response
     */
    public function edit(Pdf $pdf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pdf  $pdf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pdf $pdf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pdf  $pdf
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pdf $pdf)
    {
        //
    }

}
