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
               @foreach ($data_profile as $d)
                  <form action="/profile/updateProfile/{{ $d->id }}" method="post">
                     @csrf
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <h4 class="card-title">{{ $title }}</h4>
                        </div>
                        <hr/>
                        <div class="form-group">
                           <label for="name">Nama lengkap</label>
                           <input type="text" name="name" value="{{ $d->name }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                           <label for="role">Role</label>
                           <div class="input-group mb-3">
                              <input type="text" name="role" value="{{ $d->role }}" class="form-control" readonly>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label for="email">Email</label>
                              <div class="input-group mb-3">
                                 <input type="email" name="email" value="{{ $d->email }}" class="form-control" placeholder="Email..." required>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <label for="password">Password baru</label>
                              <div class="input-group mb-3">
                                 <input type="password" name="password" class="form-control" placeholder="Password baru..." required>
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

@endsection