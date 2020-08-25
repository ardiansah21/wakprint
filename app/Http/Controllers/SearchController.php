<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '<h2 style="margin-left: 30px">data tidak di temukan</h2>';
            $produk = Produk::where('nama', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('harga_hitam_putih', 'LIKE', '%' . $request->keyword . '%')
                ->get();
            if (count($produk) > 0) {
                $output = '';
                foreach ($produk as $p) {
                    $output .= $this->ProdukCard($p);
                }
            }
            return $output;
        }

        // $produk = new Produk();
        // $partner = new Pengelola_Percetakan();
        // $keyword = $request->keyword;
        // // $keyword = 'ERDE';
        // $produk = Produk::where('nama', 'LIKE', "%$keyword%")
        //     ->orWhere('harga_hitam_putih', 'LIKE', "%$keyword%")
        //     ->get();

        // $partner = Pengelola_Percetakan::where('nama_toko', 'LIKE', "%$keyword%")
        //     ->orWhere('alamat_toko', 'LIKE', "%$keyword%")
        //     ->get();

        // return redirect()->back()->with('produk', $produk, 'partner', $partner)->with('keyword', $keyword);
    }

    public function ProdukCard($produk)
    {

        if ($produk->berwarna === 0 && $produk->hitam_putih === 1) {
            $berwarna = 'Hitam-Putih';
        } elseif ($produk->berwarna === 1 && $produk->hitam_putih === 0) {
            $berwarna = 'Berwarna';
        } elseif ($produk->hitam_putih === 1 && $produk->berwarna === 1) {
            $berwarna = 'Berwarna';
        } else {
            $berwarna = '-';
        }

        if (!empty($produk->harga_berwarna)) {
            $hargaBerwarna =
            '
         <label
         class="card-text SemiBold text-primary-yellow my-auto mr-2"
         style="font-size: 16px;">
         Rp. ' . $produk->harga_berwarna . '
         </label>
         <label
         class="card-text SemiBold badge-sm bg-primary-yellow text-dark px-1"
         style="font-size: 12px; border-radius:5px;">
         Berwarna
         </label>
         ';
        }

        return
        '
        <div class="col-md-6 mb-4">
        <div class="col-md-auto mb-4">
            <div class="card shadow mb-2" style="border-radius: 10px;">
                <a class="text-decoration-none" href="produk/detail/' . $produk->id_produk . '"
                    style="color: black;">
                    <div class="text-center" style="position: relative;">
                        <div class="bg-promo" style="position: absolute; top: 55%; left: 10%;
                                            width:75px;
                                            height:50px;
                                            border-radius:0px 0px 8px 8px;">
                            <label class="font-weight-bold mb-1 mt-3"
                                style="font-size: 12px;">Promo</label>
                        </div>
                    </div>
                    <i class="fa fa-heart fa-2x fa-responsive"
                        style="position: absolute;top: 5%; left: 87%; transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%);">
                    </i>
                    <img class="card-img-top"
                        src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                        style="height: 180px; border-radius: 10px 10px 0px 0px;"
                        alt="Card image cap" />
                    <div class="card-body">
                        <div class="row">
                            <label class="col-md-7 text-truncate ml-0"
                                style="font-size: 14px;">' . $produk->partner->nama_toko . '</label>
                            <label class="col-md-auto card-text mr-0"
                                style="font-size: 14px;"><i
                                    class="material-icons md-18 align-middle mr-0">location_on</i>
                                100 m</label>
                        </div>
                        <label
                            class="card-title text-truncate-multiline font-weight-bold"
                            style="font-size: 24px;">' . $produk->nama . '</label>
                        <label class="card-text text-truncate-multiline"
                            style="font-size: 18px;">' . $produk->partner->alamat_toko . '</label>
                        <div class="row justify-content-between ml-0 mr-0">
                            <label class="card-text text-truncate SemiBold"
                                style="font-size: 14px;"><i
                                    class="material-icons md-18 align-middle mr-1">color_lens</i>
                                    ' . $berwarna . '
                            </label>
                            <label class="card-text text-truncate SemiBold"
                                style="font-size: 14px;"><i
                                    class="material-icons md-18 align-middle mr-1">description</i>' . $produk->jenis_kertas . '</label>
                            <label class="card-text text-truncate SemiBold"
                                style="font-size: 14px;"><i
                                    class="material-icons md-18 align-middle mr-1">menu_book</i>
                                Jilid</label>
                            <label class="card-text text-truncate SemiBold"
                                style="font-size: 14px;"><i
                                    class="material-icons md-18 align-middle mr-1">print</i>' . $produk->jenis_printer . '</label>
                        </div>
                    </div>
                    <div class="card-footer card-footer-primary"
                        style="border-radius: 0px 0px 10px 10px;">
                        <div class="row justify-content-between">
                            <div class="ml-3">
                                <label
                                    class="card-text SemiBold text-white my-auto mr-2"
                                    style="font-size: 16px;">
                                    Rp. ' . $produk->harga_hitam_putih . '
                                </label>
                                <label
                                    class="card-text SemiBold badge-sm badge-light px-1"
                                    style="font-size: 12px; border-radius:5px;">
                                    Hitam-Putih
                                </label>
                                <br>
                                ' . $hargaBerwarna . '
                            </div>
                            <div class="mr-0 my-auto">
                                <label class="card-text mt-0 mr-4 SemiBold"
                                    style="font-size: 18px;">
                                    <i class="material-icons md-24 mr-1 align-middle"
                                        style="color: #FCFF82">star</i>
                                    ' . $produk->rating . '
                                </label>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
        ';
    }
}
