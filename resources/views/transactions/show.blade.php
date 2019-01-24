@extends('layouts.layout')
@section('content')
    <div class="page-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('transaction.index')}}">Book</a></li>
            <li class="breadcrumb-item">Show</li>
        </ol>
        
        <div class="card ibox">
            <div class="ibox-head">
                <div class="ibox-title">Detail <b>{{$data->kd_transaksi}}</b></div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <div class="form-group">
                    <div class="col-md-6">
                        <img width="200" height="200"
                             @if($data->book->cover) src="{{ asset('images/book/'.$data->book->cover) }}" @endif />
                    </div>
                </div>
                <div class="form-group{{ $errors->has('kode_transaksi') ? ' has-error' : '' }}">
                    <label for="kode_transaksi" class="col-md-4 control-label">Kode Transaksi</label>
                    <div class="col-md-6">
                        <input id="kode_transaksi" type="text" class="form-control" name="kode_transaksi"
                               value="{{$data->kd_transaksi}}" required readonly="">
                    </div>
                </div>
                <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                    <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>
                    <div class="col-md-3">
                        <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam"
                               value="{{ date('Y-m-d', strtotime($data->tgl_pinjam)) }}" readonly="">
                    </div>
                </div>
                <div class="form-group{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
                    <label for="tgl_kembali" class="col-md-4 control-label">Tanggal Kembali</label>
                    <div class="col-md-3">
                        <input id="tgl_kembali" type="date" class="form-control" name="tgl_kembali"
                               value="{{ date('Y-m-d', strtotime($data->tgl_kembali)) }}" readonly="">
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label for="anggota_id" class="col-md-4 control-label">Buku</label>
                    <div class="col-md-6">
                        <input id="buku" type="text" class="form-control" readonly="" value="{{$data->book->judul}}">
                    
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="anggota_id" class="col-md-4 control-label">Anggota</label>
                    <div class="col-md-6">
                        <input id="anggota_nama" type="text" class="form-control" readonly=""
                               value="{{$data->member->nama}}">
                    
                    </div>
                </div>
                
                <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                    <label for="ket" class="col-md-4 control-label">Status</label>
                    <div class="col-md-6">
                        @if($data->status == 'pinjam')
                            <label class="badge badge-warning">Pinjam</label>
                        @else
                            <label class="badge badge-success">Kembali</label>
                        @endif
                    </div>
                </div>
                
                <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                    <label for="ket" class="col-md-4 control-label">Keterangan</label>
                    <div class="col-md-6">
                        <input id="ket" type="text" class="form-control" name="ket" value="{{ $data->ket }}"
                               readonly="">
                    </div>
                </div>
                
                <a href="{{route('transaction.index')}}" class="btn btn-light pull-right">Back</a>
            </div>
        </div>
    </div>
@endsection