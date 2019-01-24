@extends('layouts.layout')
@section('content')
    <div class="page-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('book.index')}}">Book</a></li>
            <li class="breadcrumb-item">Show</li>
        </ol>
        
        <div class="card ibox">
            <div class="ibox-head">
                <div class="ibox-title">Detail Book</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                {{--                <div class="text-center" style="padding-left:200px; padding-right: 200px;">
                                    <iframe src="https://drive.google.com/file/d/1jvNFrFoR-gss5yMDMHV1y8JeY9kvt1QG/preview" width="640" height="480"></iframe>
                --}}{{--                    <iframe id="inlineFrameExample"
                                            title="Inline Frame Example"
                                            width="500"
                                            height="600"
                                            src="{{asset('assets/pdf/laravel.pdf#toolbar=0')}}">
                                    </iframe>--}}{{--
                                </div>--}}
    
                <form class="forms-sample">
        
                    <div class="form-group">
                        <div class="col-md-6">
                            <img width="200" height="200"
                                 @if($book->cover) src="{{ asset('images/book/'.$book->cover) }}" @endif />
                        </div>
                    </div>
        
                    <div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
                        <label for="judul" class="col-md-4 control-label">Judul</label>
                        <div class="col-md-6">
                            <input id="judul" type="text" class="form-control" name="judul" value="{{ $book->judul }}"
                                   readonly="">
                            @if ($errors->has('judul'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('judul') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
        
                    <div class="form-group{{ $errors->has('pengarang') ? ' has-error' : '' }}">
                        <label for="pengarang" class="col-md-4 control-label">Pengarang</label>
                        <div class="col-md-6">
                            <input id="pengarang" type="text" class="form-control" name="pengarang"
                                   value="{{ $book->pengarang }}" readonly>
                            @if ($errors->has('pengarang'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('pengarang') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('penerbit') ? ' has-error' : '' }}">
                        <label for="penerbit" class="col-md-4 control-label">Penerbit</label>
                        <div class="col-md-6">
                            <input id="penerbit" type="text" class="form-control" name="penerbit"
                                   value="{{ $book->penerbit }}" readonly>
                            @if ($errors->has('penerbit'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('penerbit') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('tahun_terbit') ? ' has-error' : '' }}">
                        <label for="tahun_terbit" class="col-md-4 control-label">Tahun Terbit</label>
                        <div class="col-md-6">
                            <input id="tahun_terbit" type="number" maxlength="4" class="form-control"
                                   name="tahun_terbit" value="{{ $book->tahun_terbit }}" readonly>
                            @if ($errors->has('tahun_terbit'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('tahun_terbit') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('jumlah_buku') ? ' has-error' : '' }}">
                        <label for="jumlah_buku" class="col-md-4 control-label">Jumlah Buku</label>
                        <div class="col-md-6">
                            <input id="jumlah_buku" type="number" maxlength="4" class="form-control" name="jumlah_buku"
                                   value="{{ $book->jumlah_buku }}" readonly>
                            @if ($errors->has('jumlah_buku'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('jumlah_buku') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
        
                    <div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
                        <label for="deskripsi" class="col-md-4 control-label">Deskripsi</label>
                        <div class="col-md-6">
                            <textarea id="deskripsi" class="form-control" rows="3" name="deskripsi"
                                      readonly="">{{ $book->deskripsi }}</textarea>
                            @if ($errors->has('deskripsi'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
        
                    <a href="{{route('book.index')}}" class="btn btn-light pull-right">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection