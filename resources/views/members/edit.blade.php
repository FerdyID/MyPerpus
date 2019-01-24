@section('js')
    
    <script type="text/javascript">

        $(document).ready(function () {
            $(".users").select2();
        });
    
    </script>
@stop

@extends('layouts.layout')

@section('content')
    <div class="page-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('member.index')}}">Member</a></li>
            <li class="breadcrumb-item">Edit</li>
        </ol>
        
        <div class="card ibox">
            <div class="ibox-head">
                <div class="ibox-title">Edit Member</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <form action="{{ route('member.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    
                    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                        <label for="nama" class="col-md-4 control-label">Nama</label>
                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control" name="nama" value="{{ $data->nama }}"
                                   required>
                            @if ($errors->has('nama'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('npm') ? ' has-error' : '' }}">
                        <label for="npm" class="col-md-4 control-label">NPM</label>
                        <div class="col-md-6">
                            <input id="npm" type="number" class="form-control" name="npm" value="{{ $data->npm }}"
                                   maxlength="8"
                                   required>
                            @if ($errors->has('npm'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('npm') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
                        <label for="tempat_lahir" class="col-md-4 control-label">Tempat Lahir</label>
                        <div class="col-md-6">
                            <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir"
                                   value="{{ $data->tempat_lahir }}" required>
                            @if ($errors->has('tempat_lahir'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('tgl_lahir') ? ' has-error' : '' }}">
                        <label for="tgl_lahir" class="col-md-4 control-label">Tanggal Lahir</label>
                        <div class="col-md-6">
                            <input id="tgl_lahir" type="date" class="form-control" name="tgl_lahir"
                                   value="{{ $data->tgl_lahir }}" required>
                            @if ($errors->has('tgl_lahir'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('tgl_lahir') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                        <label for="level" class="col-md-4 control-label">Jenis Kelamin</label>
                        <div class="col-md-6">
                            <select class="form-control" name="jk" required="">
                                <option value=""></option>
                                <option value="L" {{$data->jk === "L" ? "selected" : ""}}>Laki - Laki</option>
                                <option value="P" {{$data->jk === "P" ? "selected" : ""}}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('prodi') ? ' has-error' : '' }}">
                        <label for="prodi" class="col-md-4 control-label">Prodi</label>
                        <div class="col-md-6">
                            <select class="form-control" name="prodi" required="">
                                <option value=""></option>
                                <option value="TI" {{$data->prodi === "TI" ? "selected" : ""}} >Teknik Informatika
                                </option>
                                <option value="SI" {{$data->prodi === "SI" ? "selected" : ""}} >Sistem Informasi
                                </option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }} "
                         style="margin-bottom: 20px;">
                        <label for="user_id" class="col-md-4 control-label">User Login</label>
                        <div class="col-md-6">
                            <select class="form-control" name="user_id" required="">
                                <option value="">(Cari User)</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{$data->user_id === $user->id ? "selected" : ""}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary btn-fix" id="submit">Update</button>
                        <a href="{{route('member.index')}}" class="btn btn-default btn-fix pull-right">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection