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
            'data_jenis' => JenisBarang::all(),
            'data_barang' => Barang::join('tb_jenis_barang', 'tb_jenis_barang.id', '=', 'tb_barang.id_jenis')
                                    ->select('tb_barang.*', 'tb_jenis_barang.nama_jenis')
                                    ->get(),
        );

        return view('admin.master.barang.list', $data);
    }

    public function show($id)
    {
        $barang = Barang::find($id);
        return response()->json($barang);
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
                'id_jenis' => $request->id_jenis,
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