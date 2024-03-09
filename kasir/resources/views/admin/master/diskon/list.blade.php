@extends('layout.layout')
@section('content')

<div class="content-body">

   <div class="row page-titles mx-0">
      <div class="col p-md-0">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $title }}</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $title }}</a></li>
         </ol>
      </div>
   </div>

   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card">
               @foreach ($data_diskon as $d)
                  <form action="/setdiskon/update/{{ $d->id }}" method="post">
                     @csrf
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <h4 class="card-title">{{ $title }}</h4>
                        </div>
                        <hr/>
                        <div class="row">
                           <div class="col-md-6">
                              <label for="total_belanja">Total Belanja</label>
                              <div class="input-group mb-3">
                                 <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                                 <input type="number" name="total_belanja" value="{{ $d->total_belanja }}" class="form-control" placeholder="Total belanja..." required>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <label for="diskon">Diskon</label>
                              <div class="input-group mb-3">
                                 <input type="number" name="diskon" value="{{ $d->diskon }}" class="form-control" placeholder="Diskon..." required>
                                 <div class="input-group-append"><span class="input-group-text">%</span></div>
                              </div>
                           </div>
                        </div>
                        <div class="card-footer">
                           <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Ubah</button>
                        </div>
                     </div>
                  </form>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</div>

@foreach ($data_diskon as $d)
<div class="modal fade" id="modalEdit{{$d->id}}" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Ubah Diskon</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
         </div>
         <form action="/jenisbarang/update/{{$d->id}}" method="POST">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="name">Total belanja</label>
                  <input type="text" value="{{$d->total_belanja}}" class="form-control" name="total_belanja" placeholder="Total belanja..." required>
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
@endforeach

@endsection