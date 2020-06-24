<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\product;

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
        return redirect('/testjson');
    }

    // public function update(UpdateProductRequest $request, Product $product)
    // {
    //     //$product = Product::find($id);
    //     $product->update($request->all());
    //     return redirect()->route('admin.products.index');
    // }

}
