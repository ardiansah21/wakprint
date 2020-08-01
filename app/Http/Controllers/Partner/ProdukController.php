<?php

namespace App\Http\Controllers\Partner;

use App\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: Ubah view ke halaman produk @imaha7
        $produk = Produk::all();
        return view('pengelola.produk',[
            'produk' => $produk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengelola.tambah_produk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fitur = $request->fitur;
        if (!empty($fitur['tambahan']))
            $fitur['tambahan'] =  array_values($request->fitur['tambahan']);
        else
            $fitur['tambahan'] =  array_values($fitur);

        $produk = Produk::create([
            'nama'                  => $request->nama,
            'harga'                 => $request->harga,
            'harga_timbal_balik'    => $request->harga_timbal_balik,
            'berwarna'              => $request->berwarna == 'True' ? '0' : '1',
            'hitam_putih'           => $request->hitam_putih == 'True' ? '0' : '1',
            'deskripsi'             => $request->deskripsi,
            'jenis_kertas'          => $request->jenis_kertas,
            'jenis_printer'         => $request->jenis_printer,
            'status'                => $request->status,
            'fitur'                 => json_encode($fitur)
        ]);

        foreach ($request->input('document', []) as $file) {
            //dd($file);
            $produk->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('foto_produk');
        }

        return redirect()->route('partner.produk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $partner = Pengelola_Percetakan::find(Auth::id());
        // $produk = Produk::find(Auth::id());
        // return view('pengelola.edit_profil',['partner'=>$partner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     /**
     * Menyimpan sementara gambar yang di unggah.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    // public function duplicate(Request $request)
    // {
    //     $fitur = $request->fitur;
    //     if (!empty($fitur['tambahan']))
    //         $fitur['tambahan'] =  array_values($request->fitur['tambahan']);
    //     else
    //         $fitur['tambahan'] =  array_values($fitur);

    //     $produk = Produk::create([
    //         'nama'                  => $request->nama,
    //         'harga'                 => $request->harga,
    //         'harga_timbal_balik'    => $request->harga_timbal_balik,
    //         'berwarna'              => $request->berwarna == 'True' ? '0' : '1',
    //         'hitam_putih'           => $request->hitam_putih == 'True' ? '0' : '1',
    //         'deskripsi'             => $request->deskripsi,
    //         'jenis_kertas'          => $request->jenis_kertas,
    //         'jenis_printer'         => $request->jenis_printer,
    //         'status'                => $request->status,
    //         'fitur'                 => json_encode($fitur)
    //     ]);

    //     foreach ($request->input('document', []) as $file) {
    //         //dd($file);
    //         $produk->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('foto_produk');
    //     }

    //     return redirect()->route('partner.produk.index');
    // }

}
/**
 * KEEP
 *
 * **/
// public function update(UpdateProdukRequest $request, Produk $produk)
// {
//     $produk->update($request->all());

//     if (count($produk->document) > 0) {
//         foreach ($produk->document as $media) {
//             if (!in_array($media->file_name, $request->input('document', []))) {
//                 $media->delete();
//             }
//         }
//     }

//     $media = $produk->document->pluck('file_name')->toArray();

//     foreach ($request->input('document', []) as $file) {
//         if (count($media) === 0 || !in_array($file, $media)) {
//             $produk->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('document');
//         }
//     }

//     return redirect()->route('admin.produks.index');
// }
