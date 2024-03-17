<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;

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
            'data_trans' => Transaksi::all()
        );
        return view('kasir.transaksi.add', $data);
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