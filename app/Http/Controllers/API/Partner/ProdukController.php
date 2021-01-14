<?php

namespace App\Http\Controllers\API\Partner;

use App\Http\Controllers\Controller;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!empty(request()->user()->products)) {
            if (empty(request()->status_promo)) {
                $produk = request()->user()->products;
                foreach ($produk as $p) {
                    $p->fitur = json_decode($p->fitur, true);
                }
                return responseSuccess('data seluruh produk', request()->user()->products);
            } else {
                if (count(request()->user()->products->where('status_diskon', 'TidakTersedia')) > 1) {
                    return responseSuccess('data seluruh produk', request()->user()->products->where('status_diskon', 'TidakTersedia'));
                } else {
                    return responseSuccess('data seluruh produk', array(request()->user()->products->where('status_diskon', 'TidakTersedia')->first()));
                }
            }
        }
        return responseError('Data Tidak Ada');
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
            'nama' => ['required', 'string', 'max:150'],
            'harga_hitam_putih' => ['required', 'numeric'],
            'jenis_kertas' => ['required', 'string'],
            'jenis_printer' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

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
                            (int) str_replace('.', '', $value2['harga']),
                            $value2['deskripsi'],
                            $foto_fitur
                        ));
                    }
                } else {
                    array_push($fiturFinal, $this->getFiturTemplate($key, $value));
                }
            }
        }

        $produk = Produk::create([
            'id_pengelola' => request()->user()->id_pengelola,
            'nama' => $request->nama,
            'harga_hitam_putih' => (int) str_replace('.', '', $request->harga_hitam_putih),
            'harga_timbal_balik_hitam_putih' => (int) str_replace('.', '', $request->harga_timbal_balik_hitam_putih),
            'harga_berwarna' => (int) str_replace('.', '', $request->harga_berwarna),
            'harga_timbal_balik_berwarna' => (int) str_replace('.', '', $request->harga_timbal_balik_berwarna),
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

        return responseSuccess('Anda berhasil menambahkan produk baru Anda', $produk, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return responseSuccess('data detail produk ' . $produk->id_produk, $produk);
        // return responseSuccess('show atk id = ' . $atk->id_atk, collect($atk)->except(['media', 'id_pengelola']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:150'],
            'harga_hitam_putih' => ['required', 'numeric'],
            'jenis_kertas' => ['required', 'string'],
            'jenis_printer' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

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
                            } else {
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
                            (int) str_replace('.', '', $value2['harga']),
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
                'id_pengelola' => request()->user()->id_pengelola,
                'nama' => $request->nama,
                'harga_hitam_putih' => (int) str_replace('.', '', $request->harga_hitam_putih),
                'harga_timbal_balik_hitam_putih' => (int) str_replace('.', '', $request->harga_timbal_balik_hitam_putih),
                'harga_berwarna' => (int) str_replace('.', '', $request->harga_berwarna),
                'harga_timbal_balik_berwarna' => (int) str_replace('.', '', $request->harga_timbal_balik_berwarna),
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
        return responseSuccess('Anda berhasil mengubah produk Anda', $produk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        if ($produk->delete()) {
            $produk->clearMediaCollection();
            return responseSuccess('Anda berhasil menghapus produk Anda');
        }
        return responseError('Gagal menghapus produk, silahkan coba kembali');
    }

    public function duplicate(Produk $produkA)
    {
        $produkB = $produkA->replicate();
        $produkB->status = "TidakTersedia";
        $produkB->nama = $produkA->nama . " [ SALINAN ]";

        $fiturDefault = array('Kliping', 'Lem', 'Baut', 'Kawat', 'Spiral', 'Hekter', 'Tulang Kliping', 'Penjepit Kertas', 'Plastik Transparan', 'Kertas Jeruk');

        $fitur = json_decode($produkB->fitur);
        foreach ($fitur as $value) {
            if (isset($value->foto_fitur) && !in_array($value->foto_fitur, $fiturDefault)) {
                $name = basename($value->foto_fitur);
                $path = public_path('storage/_fitur');
                File::copy($path . '/' . $name, $path . '/copy-' . $name);
                $value->foto_fitur = url('/storage/_fitur') . '/copy-' . $name;
            }
        }
        $produkB->fitur = json_encode($fitur);
        $produkB->push();

        foreach ($produkA->media as $media) {
            assert($media instanceof Media);
            $props = $media->toArray();
            unset($props['id']);
            $produkB->addMedia($media->getPath())
                ->preservingOriginal()
                ->withProperties($props)
                ->toMediaCollection($media->collection_name);
        }

        return responseSuccess('Anda berhasil menduplikat produk Anda', $produkA);
    }

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
        $fiturTemplate = array(
            $this->setFitur('Kliping', 'https://ecs7.tokopedia.net/img/cache/700/product-1/2017/11/3/24128252/24128252_b0f7c29c-5096-4d76-9d7e-91fee75f553c_320_427.jpg', 'Kliping adalah hasil cetakan Anda akan sekaligus diberikan tulang kliping, plastik transparan, dan kertas jeruk secara lengkap diberikan dalam 1 paket pada dokumen Anda.'),
            $this->setFitur('Lem', 'https://solusiprinting.com/wp-content/uploads/2020/03/Jilid-lem-panas-perfect-binding.jpg', 'Jilid lem panas dilakukan dengan cara merekatkan bagian pinggir kertas ke punggung sampul buku bagian dalam menggunakan lem atau perekat. Teknik ini cocok untuk buku yang cukup tebal, dengan soft cover maupun hard cover.'),
            $this->setFitur('Baut', 'https://solusiprinting.com/wp-content/uploads/2020/03/Jilid-baut-screw-binding.jpg', 'Teknik jilid baut mirip dengan jilid spiral, yaitu melubangi tepi halaman untuk menyatukan kertas. Bedanya adalah yang digunakan untuk menyatukan halaman adalah baut yang dikencangkan. Tentunya dipilih baut khusus yang juga bisa menunjang estetika buku. Penjilidan ini seringnya dipakai untuk buku hard cover yang dibuat khusus seperti katalog warna, katalog pameran, buku menu, dll.'),
            $this->setFitur('Kawat', 'https://solusiprinting.com/wp-content/uploads/2020/03/Jilid-kawat-staples-tengah-saddle-stitching.jpg', 'Jilid Kawat ini cocok untuk dokumen dengan soft cover dan ketebalan yang tipis antara 4-80 halaman seperti booklet, majalah, atau buku modul tipis.'),
            $this->setFitur('Spiral', 'https://solusiprinting.com/wp-content/uploads/2020/03/Jilid-spiral-wire-binding.jpg', 'Jilid spiral dilakukan dengan cara melubangi tepi halaman di satu sisi lalu menyatukannya dengan kawat atau plastik berbentuk roll. Teknik ini biasanya dipakai untuk buku dengan bahan kertas yang cukup tebal namun tidak memiliki terlalu banyak halaman.'),
            $this->setFitur('Hekter', 'https://qph.fs.quoracdn.net/main-qimg-92ca56763f43afe14652d15eadc59264', 'Hasil cetakan Anda akan sekaligus dihekter untuk membuat dokumen Anda terlihat rapi dan tidak berantakan.'),
            $this->setFitur('Tulang Kliping', 'https://ecs7.tokopedia.net/img/cache/700/product-1/2017/11/3/24128252/24128252_b0f7c29c-5096-4d76-9d7e-91fee75f553c_320_427.jpg', 'Hasil cetakan Anda akan sekaligus diberikan tulang kliping pada saat proses pencetakan dokumen telah selesai.'),
            $this->setFitur('Penjepit Kertas', 'https://cdn0-production-images-kly.akamaized.net/eJOTPdEE8EJmfGT90UZpzbdbhHI=/640x640/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/2887278/original/001566000_1566293636-rainbow-made-colorful-paper-clips_23-2148092020freepika.jpg', 'Hasil cetakan Anda akan sekaligus dijepit dengan penjepit kertas untuk membuat dokumen Anda terlihat rapi dan tidak berantakan.'),
            $this->setFitur('Plastik Transparan', 'https://1.bp.blogspot.com/-ZNjTq20AXBE/Vp13uSac7YI/AAAAAAAAABQ/3-V4wH-wlsA/s1600/IMG-20160104-WA0002.jpg', 'Hasil cetakan Anda akan sekaligus diberikan plastik transparan untuk halaman depan pada dokumen Anda.'),
            $this->setFitur('Kertas Jeruk', 'https://cdn.siplah.pesonaedu.id/uploads/6f84a30ff9f80054908cb570c0a86c6743e9f6683f18602a0d89901bf781fc64/51826/image.png', 'Hasil cetakan Anda akan sekaligus diberikan kertas jeruk untuk halaman belakang pada dokumen Anda.'),
        );

        $key = array_search($keyword, array_column($fiturTemplate, 'nama'));
        $fiturTemplate[$key]['harga'] = $harga;
        return $fiturTemplate[$key];
    }
}
