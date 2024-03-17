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
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $title }}</h4>
                            <a class="btn btn-primary btn-rounded ml-auto" href="/transaksi/create">
                                <i class="fa fa-plus"></i>
                                Buat transaksi
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Total bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data_transaksi as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->no_transaksi }}</td>
                                        <td>{{ date('d/M/Y', strtotime($row->tanggal)) }}</td>
                                        <td>Rp.{{ number_format($row->total_bayar) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-info" href="/transaksi/detail/{{ $row->no_transaksi }}">
                                                    <i class="fa fa-list"></i>
                                                    Detail
                                                </a>
                                                <button class="btn btn-sm btn-danger dropdown-toggle" type="button" id="menuButton" data-toggle="dropdown">
                                                    <i class="fa fa-print"></i> Cetak </i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Faktur</a>
                                                    <a class="dropdown-item" href="#">Invoice</a>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection