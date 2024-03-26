<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Diskon;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Transaksi',
            'data_transaksi' => Transaksi::all()
        );
        return view('kasir.transaksi.list', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Tambah Transaksi',
            'data_barang' => Barang::all(),
            'data_det_trans' => DetailTransaksi::all(),
            'data_trans' => Transaksi::all(),
            'data_diskon' => Diskon::find(1)
        );
        return view('kasir.transaksi.add', $data);
    }

    public function store(Request $request)
    {
        $tanggal = Carbon::createFromFormat('d-m-Y', $request->input('tanggal'))->format('Y-m-d');
        $trans = new Transaksi();
        $trans->no_transaksi = $request->no_transaksi;
		$trans->tanggal = $tanggal;
		$trans->diskon = $request->diskon;
		$trans->total_bayar = $request->totalBayar;
		$trans->id_kasir = $request->totalBayar;
        $trans->save();

        $list_barang = $request->input('barang');
        
        // Iterasi untuk setiap barang
        foreach ($list_barang['id_barang'] as $key => $id_barang) {
            $detail = new DetailTransaksi();

            // Memasukkan data detail transaksi
            $detail->no_transaksi = $request->no_transaksi;
            $detail->id_barang = $id_barang;

            // Memastikan quantity tersedia
            if (isset($list_barang['quantity'][$key])) {
                $detail->qty = $list_barang['quantity'][$key];
            } else {
                // Jika quantity tidak tersedia, set nilai default ke 1 atau sesuai kebutuhan
                $detail->qty = 1;
            }
            // Menyimpan detail transaksi
            $detail->save();

            // Ambil data barang berdasarkan ID
            $barang = Barang::findOrFail($id_barang);

            // Update data barang dengan data dari request
            $barang->stok = $barang->stok - $list_barang['quantity'][$key];

            // Simpan perubahan stok barang
            $barang->save();
        }

        return redirect('transaksi')->with('success', 'Transaksi baru telah disimpan');
    }
    
    public function detail($no_transaksi)
    {
        $data = array(
            'title' => 'Detail Transaksi',
            'data_detail' => Transaksi::findorfail($no_transaksi),
            'data_barang' => Barang::join('tb_detail_transaksi', 'tb_barang.id', '=', 'tb_detail_transaksi.id_barang')
                                        ->select('tb_barang.*', 'tb_detail_transaksi.*')
                                        ->where('tb_detail_transaksi.no_transaksi', '=', $no_transaksi)
                                        ->get()
        );
        return view('kasir.transaksi.detail', $data);
    }
}