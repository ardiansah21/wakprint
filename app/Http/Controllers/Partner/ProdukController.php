<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Pengelola_Percetakan;
use App\Produk;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProdukController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partner = Auth::user();
        $produk = Produk::orderByDesc('id_produk')->get();
        return view('pengelola.produk', [
            'produk' => $produk,
            'partner' => $partner,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partner = Pengelola_Percetakan::find(Auth::id());
        return view('pengelola.tambah_produk', compact('partner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $fiturFinal = array();

        if (!empty($request->fitur)) {
            foreach ($request->fitur as $key => $value) {
                if ($key == 'tambahan') {
                    foreach ($value as $value2) {
                        if (isset($value2['foto_fitur'])) {
                            $path = public_path('storage/_fitur');

                            if (!file_exists($path)) {
                                mkdir($path, 0777, true);
                            }
                            $file = $value2['foto_fitur'];
                            $name = uniqid() . '-' . str_replace(' ', '_', $file->getClientOriginalName());

                            $file->move($path, $name);
                            $foto_fitur = url('/storage/_fitur') . '/' . $name;
                        } else {
                            $foto_fitur = null;
                        }

                        array_push($fiturFinal, $this->setFitur(
                            $value2['nama'],
                            $value2['harga'],
                            $value2['deskripsi'],
                            $foto_fitur
                        ));
                    }
                } else {
                    array_push($fiturFinal, $this->getFiturTemplate($key, $value));
                }
            }
        }
        // return $fiturFinal;

        $produk = Produk::create([
            'id_pengelola' => Auth::id(),
            'nama' => $request->nama,
            'harga_hitam_putih' => $request->harga_hitam_putih,
            'harga_timbal_balik_hitam_putih' => $request->harga_timbal_balik_hitam_putih,
            'harga_berwarna' => $request->harga_berwarna,
            'harga_timbal_balik_berwarna' => $request->harga_timbal_balik_berwarna,
            'berwarna' => $request->berwarna == 'True' ? '1' : '0',
            'hitam_putih' => $request->hitam_putih == 'True' ? '1' : '0',
            'deskripsi' => $request->deskripsi,
            'jenis_kertas' => $request->jenis_kertas,
            'jenis_printer' => $request->jenis_printer,
            'status' => $request->status,
            'fitur' => json_encode($fiturFinal),
        ]);

        if ($request->input('document') != null) {
            foreach ($request->input('document', []) as $file) {
                $produk->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('foto_produk');
            }
        }
        $produk->save();
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
        $fitur = json_decode($produk->fitur);
        return view('pengelola.edit_produk', compact('produk'));
    }

    public function getCollectFitur(Produk $produk, string $nama)
    {
        $fitur = json_decode($produk->fitur);
        try {
            $hasil = collect((collect($fitur)->where('nama', $nama))[0]);
            return $hasil;
        } catch (\Throwable $th) {
            return collect();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $fiturFinal = array();
        if (!empty($request->fitur)) {
            foreach ($request->fitur as $key => $value) {
                if ($key == 'tambahan') {
                    foreach ($value as $value2) {
                        if (isset($value2['foto_fitur']) && is_file($value2['foto_fitur'])) {
                            if (empty($value2['uniqid'])) {
                                $path = public_path('storage/_fitur');
                                $file = $value2['foto_fitur'];
                                $name = uniqid() . '-' . str_replace(' ', '_', $file->getClientOriginalName());

                                $file->move($path, $name);
                                $foto_fitur = url('/storage/_fitur') . '/' . $name;
                            }else {
                                $lastNameFile = basename(json_decode($produk->fitur)[array_search($value2['uniqid'], array_column(json_decode($produk->fitur), 'uniqid'))]->foto_fitur);
                                $path = public_path('storage/_fitur');
                                unlink($path . '/' . $lastNameFile);
                                $file = $value2['foto_fitur'];
                                $name = uniqid() . '-' . str_replace(' ', '_', $file->getClientOriginalName());

                                $file->move($path, $name);
                                $foto_fitur = url('/storage/_fitur') . '/' . $name;
                            }

                        } else {
                            $foto_fitur = json_decode($produk->fitur)[array_search($value2['uniqid'], array_column(json_decode($produk->fitur), 'uniqid'))]->foto_fitur;
                        }

                        array_push($fiturFinal, $this->setFitur(
                            $value2['nama'],
                            $value2['harga'],
                            $value2['deskripsi'],
                            $foto_fitur
                        ));
                    }
                } else {
                    array_push($fiturFinal, $this->getFiturTemplate($key, $value));
                }
            }
        }

        $produk->update(
            [
                'id_pengelola' => Auth::id(),
                'nama' => $request->nama,
                'harga_hitam_putih' => $request->harga_hitam_putih,
                'harga_timbal_balik_hitam_putih' => $request->harga_timbal_balik_hitam_putih,
                'harga_berwarna' => $request->harga_berwarna,
                'harga_timbal_balik_berwarna' => $request->harga_timbal_balik_berwarna,
                'berwarna' => $request->berwarna == 'True' ? '1' : '0',
                'hitam_putih' => $request->hitam_putih == 'True' ? '1' : '0',
                'deskripsi' => $request->deskripsi,
                'jenis_kertas' => $request->jenis_kertas,
                'jenis_printer' => $request->jenis_printer,
                'status' => $request->status,
                'fitur' => json_encode($fiturFinal),
            ]
        );

        if (count($produk->getMedia('foto_produk')) > 0) {
            foreach ($produk->getMedia('foto_produk') as $media) {
                if (!in_array($media->file_name, $request->input('document', []))) {
                    $media->delete();
                }
            }
        }

        $media = $produk->getMedia('foto_produk')->pluck('file_name')->toArray();

        if ($request->input('document', []) != null) {
            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $produk->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('foto_produk');
                }
            }
        }
        $produk->save();
        return redirect()->route('partner.produk.index');

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
        // foreach ($a as $key => $value) {
        //     dd($value->id);
        // }
        return redirect()->back();
    }

//Helper
    public function setFitur($nama, $harga, $deskripsi = null, $foto_fitur = null)
    {
        $fitur = new stdClass();
        $fitur->nama = $nama;
        $fitur->harga = $harga;
        if ($deskripsi != null) {
            $fitur->deskripsi = $deskripsi;
        }
        $fitur->foto_fitur = $foto_fitur;
        $fitur->uniqid = uniqid() . $nama;

        return (array) $fitur;
    }

    public function getFiturTemplate($keyword, $harga = null)
    {
        //TODO tambah deskripsi dan foto di setiap fitur template di bawah ini
        $fiturTemplate = array(
            $this->setFitur('Kliping', null, 'deskripsinya, fotonya taruh di sebelah'),
            $this->setFitur('Lem', null, 'deskripsinya, fotonya taruh di sebelah'),
            $this->setFitur('Baut', null, 'deskripsinya, fotonya taruh di sebelah'),
            $this->setFitur('Kawat', null, 'deskripsinya, fotonya taruh di sebelah'),
            $this->setFitur('Spiral', null, 'deskripsinya, fotonya taruh di sebelah'),
            $this->setFitur('Hekter', null, 'deskripsinya, fotonya taruh di sebelah'),
            $this->setFitur('Tulang Kliping', null, 'deskripsinya, fotonya taruh di sebelah'),
            $this->setFitur('Penjepit Kertas', null, 'deskripsinya, fotonya taruh di sebelah'),
            $this->setFitur('Plastik Transparan', null, 'deskripsinya, fotonya taruh di sebelah'),
            $this->setFitur('Kertas Jeruk', null, 'deskripsinya, fotonya taruh di sebelah'),
        );

        // $key = array_search($keyword, array_column($fiturTemplate, 'name'));
        $key = array_search($keyword, array_column($fiturTemplate, 'nama'));
        $fiturTemplate[$key]['harga'] = $harga;
        return $fiturTemplate[$key];
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
