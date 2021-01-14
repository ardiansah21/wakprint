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
        if (!empty($atk->getFirstMediaUrl())) {
            $atk->url_image = $atk->getFirstMediaUrl();
        } else {
            $atk->url_image = 'https://ui-avatars.com/api/?name=ATK&background=BC41BE&color=F2FF58';
        }
        return responseSuccess('show atk id = ' . $atk->id_atk, $atk);
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
        if (!empty($request->foto_atk)) {
            $atk->addMedia($request->foto_atk)->toMediaCollection();
        }

        return responseSuccess('Item Atk Anda berhasil diubah', $atk);
    }

    public function uploadFotoAtk(Request $request, Atk $atk)
    {
        //return $request->all();

        // $atk->clearMediaCollection();
        if (!empty($request->foto_atk)) {
            $f = $atk->addMedia($request->foto_atk)->toMediaCollection();
            return responseSuccess('Foto Atk Anda berhasil diubah', $f);
        }
        return responseError('Foto Atk Anda kosong atau gagal');
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
            $atk->clearMediaCollection();
            return responseSuccess('Atk berhasil di hapus');
        }
        return responseError('Gagal menghapus atk, silahkan coba kembali');
    }

}
