<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Barang',
            'data_barang' => Barang::all(),
            'data_jenis' => JenisBarang::all(),
        );

        return view('admin.master.barang.list', $data);
    }

    public function store(Request $request)
    {
        Barang::create([
            'id_jenis' => $request->id_jenis,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect('/barang')->with('success', 'Data baru telah disimpan');
    }

    public function update(Request $request, $id)
    {
        Barang::where('id', $id)
            ->where('id', $id)
            ->update([
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'stok' => $request->stok
            ]);

        return redirect('/barang')->with('success', 'Data telah diubah');
    }

    public function destroy($id)
    {
        Barang::where('id', $id)->delete();
        return redirect('/barang')->with('success', 'Data telah dihapus');
    }
}