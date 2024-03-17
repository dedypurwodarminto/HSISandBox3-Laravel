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
                                 @php
                                    // setlocale(LC_TIME, 'id_ID');
                                    // $longdate = strftime('%d %B %Y');
                                    //English: date('d/m/Y'), 'd/F/Y'

                                    $newTrans = "";
                                    $lastRecVal =  $data_trans->last()->no_transaksi;
                                    for ($i=0; $i < strlen($lastRecVal)-1; $i++) {
                                       $newTrans = $newTrans."0";
                                    }
                                    $newTrans = $newTrans.intval($lastRecVal)+1
                                 @endphp
                                 <label for="no_transaksi">No Transaksi</label>
                                 <input type="text" class="form-control" name="no_transaksi" value="{{ $newTrans }}" readonly required>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Tanggal</label>
                              <input type="text" class="form-control" value="{{ date('d/m/Y') }}" readonly required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label>Uang pembeli</label>
                              <input type="number" class="form-control" id="uangPembeli" value="0" required>
                           </div>
                           </div>
                           <div class="col-md-3">
                           <div class="form-group">
                              <label>Kembalian</label>
                              <input type="number" class="form-control" id="kembalian" placeholder="0" readonly style="font-weight: bold; color: red">
                           </div>
                        </div>
                     </div>
                     <div class="table-responsive table-hover">
                        <table class="table table-bordered">
                           <tr class="table-active">
                              <th>No</th>
                              <th>Barang</th>
                              <th style="text-align: center">Harga</th>
                              <th style="text-align: center">Qty</th>
                              <th style="text-align: center">Subtotal</th>
                              <th>Opsi</th>
                           </tr>
                           @php
                               $no = 1;
                           @endphp
                           @foreach ($data_barang as $row)
                              <tr>
                                 {{-- SIMPAN DATA DALAM ARRAY PENAMPUNG_________________ --}}
                                 <td>{{ $no++ }}</td>
                                 <td>{{ $row->nama_barang }}</td>
                                 <td style="text-align: right">{{number_format( $row->harga, 0, ',', '.')}}</td>
                                 <td style="text-align: right">{{ number_format( $row->qty, 0, ',', '.') }}</td>
                                 <td style="text-align: right">{{ number_format( $row->harga * $row->qty, 0, ',', '.') }}</td>
                                 <td>
                                    <a href="#modalHapus{{$row->id}}" data-toggle="modal" class="btn btn-sm btn-danger"><i class="fa fa-trash"> Hapus</i></a>
                                 </td>
                              </tr>
                           @endforeach
                           <tr>
                              <td colspan="4">Total</td>
                              <td style="text-align: right" name="total">{{number_format(120000, 0, ',', '.')}}</td>
                           </tr>
                           <tr>
                              <td colspan="4">Diskon</td>
                              <td style="text-align: right" name="diskon">{{number_format(2000, 0, ',', '.')}}</td>
                           </tr>
                           <tr>
                              <td colspan="4">Total bayar</td>
                              <td style="text-align: right" name="totalBayar">{{number_format(200000, 0, ',', '.')}}</td>
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
                  <label for="jenis">Nama barang</label>
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

@foreach ($data_barang as $c)
<div class="modal fade" id="modalHapus{{$c->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data user</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="/user/destroy/{{$c->id}}" method="GET">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <h5>Apakah anda yakin akan menghapus data ini?</h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-close" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
   document.getElementById('uangPembeli').addEventListener('input', function () {
      var totalBayar = parseInt(document.querySelector('td[name="totalBayar"]').textContent.replace(/\./g, ""));
      var uangPembeli = parseInt(this.value);
      var kembalian = uangPembeli - totalBayar;

      document.getElementById('kembalian').value = kembalian;
   });
</script>

@endforeach

@endsection