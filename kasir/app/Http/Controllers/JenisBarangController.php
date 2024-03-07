<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Jenis Barang',
            'data_jenis' => JenisBarang::all()
        );

        return view('admin.master.jenisbarang.list', $data);
    }

    public function store(Request $request)
    {
        JenisBarang::create([
            'nama_jenis' => $request->nama_jenis
        ]);

        return redirect('/jenisbarang')->with('success', 'Data baru telah disimpan');
    }

    public function update(Request $request, $id)
    {
        JenisBarang::where('id', $id)
            ->where('id', $id)
                ->update([
                    'nama_jenis' => $request->nama_jenis
                ]);

        return redirect('/jenisbarang')->with('success', 'Data telah diubah');
    }

    public function destroy($id)
    {
        JenisBarang::where('id', $id)->delete();
        return redirect('/jenisbarang')->with('success', 'Data telah dihapus');
    }
}
