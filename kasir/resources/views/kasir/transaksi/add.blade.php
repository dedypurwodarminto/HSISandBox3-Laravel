@extends('layout.layout')
@section('content')

<div class="content-body">

   <div class="row page-titles mx-0">
      <div class="col p-md-0">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">{{$title}}</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$title}}</a></li>
         </ol>
      </div>
   </div>

   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <form action="/transaksi/store" method="POST">
                  @csrf
                  <div class="card-body">
                     <div class="d-flex justify-content-between align-items-center">
                        <div>
                           <h4 class="card-title">{{ $title }}
                        </div>
                        <div>
                           <button class="btn btn-primary" type="button" data-target="#modalCreate" data-toggle="modal">
                              <i class="fa fa-plus"></i>
                              Tambah barang
                           </button></h4>
                        </div>
                     </div>
                     <hr/>
                     <div class="row justify-content-between">
                        <div class="col-md-3">
                           <div class="form-group">
                              <div>
                                 <label for="no_transaksi">No Transaksi</label>
                                 <input type="text" class="form-control" name="no_transaksi" value="contoh1" readonly required>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Tanggal</label>
                              <input type="text" class="form-control" value="{{ date('d/M/Y') }}" readonly required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Uang pembeli</label>
                              <input type="number" class="form-control" name="uang_pembeli" placeholder="Uang pembeli..." required>
                           </div>
                           </div>
                           <div class="col-md-3">
                           <div class="form-group">
                              <label>Kembalian</label>
                              <input type="number" class="form-control" name="kembalian" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <tr>
                              <th>No</th>
                              <th>Barang</th>
                              <th>Harga</th>
                              <th>Qty</th>
                              <th>Subtotal</th>
                           </tr>
                           <tr>
                              <td>No</td>
                              <td>Barang</td>
                              <td>Harga</td>
                              <td>Qty</td>
                              <td>Subtotal</td>
                           </tr>
                           <tr>
                              <td colspan="4">Diskon</td>
                              <td>Diskon</td>
                           </tr>
                           <tr>
                              <td colspan="4">Total bayar</td>
                              <td>Total bayar</td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Proses transaksi</button>
                     <a href="/transaksi" class="btn btn-danger"><i class="fa fa-undo"></i> Batal</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Tambah Transaksi</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
         </div>
         <form action="/transaksi/cart" method="POST">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="jenis">Jenis barang</label>
                  <select name="id_barang" class="form-control" required>
                     <option disabled selected value>-- Pilih barang --</option>
                     {{-- @foreach ($data_transaksi as $t)
                        <option value="{{ $t->id }}">{{ $t->no_transaksi }}</option>
                     @endforeach --}}
                  </select>
               </div>
               <div id="tampil_barang">

               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
               <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>
</div>

@endsection