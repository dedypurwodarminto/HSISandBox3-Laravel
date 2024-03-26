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
               <form action="#" method="POST">
                  @csrf
                  <div class="card-body">
                     <div class="d-flex justify-content-between align-items-center">
                        <div>
                           <h4 class="card-title">{{ $title }}</h4>
                        </div>
                        <div>
                           <a class="btn btn-primary" href="/transaksi"><i class="fa fa-backward"></i> Kembali</a>
                        </div>
                     </div>
                     <hr/>
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="col-6"></div>
                        <div>
                           <label>No Transaksi</label>
                        </div>
                        <div>
                           <label><strong>: {{ $data_detail->no_transaksi }} </strong></label>
                        </div>
                        <div>
                           <label>Tanggal</label>
                        </div>
                        <div>
                           <label><strong>: {{ date('d/M/Y', strtotime($data_detail->created_at)) }}</strong></label>
                        </div>
                        {{-- <div class="col-3"></div> --}}
                     </div>
                     <div class="table-responsive data-table-container">
                        <table class="table table-bordered table-hover">
                           <tr class="table-active">
                              <th>No</th>
                              <th>Barang</th>
                              <th style="text-align: center">Harga</th>
                              <th style="text-align: center">Qty</th>
                              <th style="text-align: center">Subtotal</th>
                           </tr>
                           @php
                               $no = 1;
                               $total = 0;
                               $diskon = 0;
                               $bayar =0;
                           @endphp
                           @foreach ($data_barang as $d)
                              <?php $total = $d->harga * $d->qty ?>
                              <tr>
                                 <td>{{ $no++ }}</td>
                                 <td>{{ $d->nama_barang }}</td>
                                 <td style="text-align: right">{{ number_format($d->harga) }}</td>
                                 <td style="text-align: right">{{ $d->qty }}</td>
                                 <td style="text-align: right">{{ number_format($total) }}</td>
                              </tr>
                              <?php $bayar += $total ?>
                           @endforeach
                           <tr>
                              <td colspan="4">Total</td>
                              <td style="text-align: right">{{ number_format($bayar) }}</td>
                           </tr>
                           <tr>
                              <td colspan="4">Diskon</td>
                              <td style="text-align: right">{{ number_format($data_detail->diskon) }}</td>
                           </tr>
                           <tr>
                              <td colspan="4">Harga bayar</td>
                              <td style="text-align: right">{{ number_format($bayar - $data_detail->diskon) }}</td>
                           </tr>
                        </table>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection