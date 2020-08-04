<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $produk = Produk::first();
        //  return $produk->getMedia('foto_produk');

        // $produk = Produk::first()->with('media')->get();
        $produk = Produk::orderByDesc('id_produk')->get();
        return view('pengelola.produk', [
            'produk' => $produk,
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
        $rr = array();
        foreach ($fitur['tambahan'] as $key => $value) {
            $fitur['tambahan'][$key]['foto_fitur'] = $value['foto_fitur']->getClientOriginalName();
            $rr = $fitur;
        }
        if (!empty($fitur['tambahan'])) {
            $fitur['tambahan'] = array_values($request->fitur['tambahan']);
        }
        // else {
        //     $fitur['tambahan'] = array_values($fitur);
        // }
        $fitur = $rr;
        // $path = storage_path('tmp/uploads/fitur');

        // if (!file_exists($path)) {
        //     mkdir($path, 0777, true);
        // }

        // foreach ($request->file('fitur.tambahan.*.foto_fitur') as $file) {
        //     $name = uniqid() . '_' . trim($file->getClientOriginalName());
        //     $file->move($path, $name);
        // }
        // $file = $request->file('file');

        // $produk = new Produk();
        // $produk = $request->all();
        // $produk->fitur = json_encode($fitur);
        // $produk->foto_produk =

        $produk = Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'harga_timbal_balik' => $request->harga_timbal_balik,
            'berwarna' => $request->berwarna == 'True' ? '0' : '1',
            'hitam_putih' => $request->hitam_putih == 'True' ? '0' : '1',
            'deskripsi' => $request->deskripsi,
            'jenis_kertas' => $request->jenis_kertas,
            'jenis_printer' => $request->jenis_printer,
            'status' => $request->status,
            'fitur' => json_encode($fitur),
        ]);

        // dd(count($request->fitur['tambahan']));

        foreach ($request->input('document', []) as $file) {
            $produk->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('foto_produk');
        }
        foreach ($request->file('fitur.tambahan.*.foto_fitur') as $file) {

            $produk->addMedia($file)->toMediaCollection('foto_fitur');
        }

        $produk->foto_produk = $produk->getMedia('foto_produk');
        $produk->save();
        return $produk;

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
        $produk = Produk::find($id);
        view('pengelola.edit_produk', compact('produk'));
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->clearMediaCollection();
        $produk->delete();
        return redirect()->back();
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
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    /**
     * Mengduplikasi produk.
     *
     * @param  int  $id
     */
    public function duplicate($id)
    {
        // Produk::find($id)->replicate()->save();
        $produkA = Produk::find($id);
        $produkB = $produkA->replicate();
        $produkB->status = "TidakTersedia";
        $produkB->nama = $produkA->nama . " [ SALINAN ]";
        $produkB->save();

        $a = DB::table('media')->where('model_id', $id)->get();
        // dd($a);
        foreach ($a as $key => $value) {
            dd($value->id);
        }
        return redirect()->back();
    }

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
