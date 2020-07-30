<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TbBlog;
use App\TbKategori;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = TbBlog::all();
        return view('index',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog = new TbBlog;
        $kategori = TbKategori::pluck('nama_kategori','id_kategori')->all();
    
        return view('create',compact('blog','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new TbBlog;
        $blog->id_kategori = $request->id_kategori;
        $blog->tanggal = $request->tanggal;
        $blog->judul = $request->judul;
        $blog->isi = $request->isi;
        $blog->status = $request->status;
        $blog->save();
        \Session::flash('flash_message','data berhasil di simpan');
        return redirect('/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $blog = TbBlog::find($id);
        return view('show',compact('blog'))->renderSections()['content'];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = TbBlog::find($id);
        $kategori = TbKategori::pluck('nama_kategori','id_kategori')->all();
        return view('edit',compact('blog','kategori'));
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
        $blog = TbBlog::find($id);
        $blog->id_kategori = $request->id_kategori;
        $blog->tanggal = $request->tanggal;
        $blog->judul = $request->judul;
        $blog->isi = $request->isi;
        $blog->status = $request->status;
 
        $blog->save();
        \Session::flash('flash_message','data berhasil di update');
 
        return redirect()->action('SiteController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = TbBlog::destroy($id);
        \Session::flash('flash_message','data berhasil di hapus');
        return redirect()->action('SiteController@index');
    }
}
