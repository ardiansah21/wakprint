<?php

namespace App\Http\Controllers\API\Partner;

use App\Atk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AtkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return responseSuccess('data seluruh atk', request()->user()->atk);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $partner = $request->user();
        $atk = Atk::create([
            'id_pengelola' => $partner->id_pengelola,
            'nama' => $request->nama,
            'harga' => (int) str_replace('.', '', $request->harga),
            'jumlah' => $request->jumlah,
            'status' => 'Tersedia',
        ]);

        if ($request->hasFile('foto_atk')) {
            $atk->addMedia($request->file('foto_atk'))->toMediaCollection();
        } //code...

        return responseSuccess('Anda berhasil menambahkan item Atk yang baru', $atk, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atk  $atk
     * @return \Illuminate\Http\Response
     */
    public function show(Atk $atk)
    {
        return responseSuccess('show atk id = ' . $atk->id_atk, $atk);
        // return responseSuccess('show atk id = ' . $atk->id_atk, collect($atk)->except(['media', 'id_pengelola']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atk  $atk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atk $atk)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $atk->update([
            'nama' => $request->nama,
            'harga' => (int) str_replace('.', '', $request->harga),
            'jumlah' => $request->jumlah,
        ]);
        // $atk->clearMediaCollection();
        if ($request->hasFile('foto_atk')) {
            $atk->addMedia($request->file('foto_atk'))->toMediaCollection();
        }

        // return redirect()->route('partner.atk.index')->with('success', 'Item Atk Anda berhasil diubah');
        return responseSuccess('Item Atk Anda berhasil diubah', $atk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atk  $atk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atk $atk)
    {
        if ($atk->delete()) {
            return responseSuccess('Atk berhasil di hapus');
        }
        return responseError('Gagagl menghapus atk, silahkan coba kembali');
    }

}