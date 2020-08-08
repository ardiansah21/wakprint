<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\product;
use DataTables;
use App\Member;
use App\Pengelola_Percetakan;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        // mengambil data produk
        $product = product::all();

        return view('testjson', ['products' => $product]);
    }
     public function tambah()
    {
        return view('testjsontambah');
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
    	// 	'nama' => 'required',
    	// 	'alamat' => 'required'
    	// ]);

        // Pegawai::create([
    	// 	'nama' => $request->nama,
    	// 	'alamat' => $requespegawai.sqlt->alamat
        // ]);

        $product = Product::create($request->all());
        // dd($request->all());
        return redirect('/testjson');
    }

    public function updateShow($id)
    {
        $product = Product::find($id);
        return view('testjsonedit',['product'=> $product]);
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return redirect('/testjson');
    }

    public function table(Request $request)
    {
        return view('table');
    }

    public function carousel()
    {
        return view('carousel');
    }

    public function json(){
        return Datatables::of(Member::all())->make(true);
    }


    public function foto()
    {
        $pengelola = Pengelola_Percetakan::user();
        $pengelola
            ->addMedia(public_path('img/facebook.png'))
            ->toMediaCollection('nyobak');

            return $pengelola->getMedia('nyobak');
        //return view('table');
    }

}
