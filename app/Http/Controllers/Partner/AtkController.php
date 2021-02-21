<?php

namespace App\Http\Controllers\Partner;

use App\Atk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtkController extends Controller
{
    public function index()
    {
        $partner = Auth::user();
        $atk = Atk::all();
        return view('pengelola.atk', compact('partner', 'atk'));
    }

    public function create()
    {
        return view('pengelola.tambah_atk');
    }

    public function edit($id)
    {
        $atk = Atk::find($id);
        return view('pengelola.edit_atk', compact('atk'));
    }

    public function store(Request $request)
    {
        $partner = Auth::user();

        $atk = Atk::create([
            'id_pengelola' => $partner->id_pengelola,
            'nama' => $request->nama,
            'harga' => (int) str_replace('.', '', $request->harga),
            'jumlah' => $request->jumlah,
            'status' => 'Tersedia',
        ]);

        if ($request->hasFile('foto_atk')) {
            $atk->addMedia($request->file('foto_atk'))->toMediaCollection();
        }

        return redirect()->route('partner.atk.index')->with('success', 'Anda berhasil menambahkan item Atk yang baru');
    }

    public function update(Request $request, $id)
    {
        $atk = Atk::find($id);
        $atk->update([
            'nama' => $request->nama,
            'harga' => (int) str_replace('.', '', $request->harga),
            'jumlah' => $request->jumlah,
        ]);
        if ($request->hasFile('foto_atk')) {
            $atk->addMedia($request->file('foto_atk'))->toMediaCollection();
        }

        return redirect()->route('partner.atk.index')->with('success', 'Item Atk Anda berhasil diubah');
    }

    public function destroy($id)
    {
        $atk = Atk::find($id);
        $atk->clearMediaCollection();
        $atk->delete();
        return redirect()->route('partner.atk.index')->with('success', 'Item Atk Anda berhasil dihapus');
    }

}
