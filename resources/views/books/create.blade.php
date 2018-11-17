@section('js')
    
    <script type="text/javascript">

        $(document).ready(function () {
            $(".users").select2();
        });
    </script>
    
    <script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function () {
                // do ajax submit or just classic form submit
                //  alert("fake subminting")
                return false
            })
        })
    </script>
@stop

@extends('layouts.layout')
@section('content')
    <div class="page-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('book.index')}}">Book</a></li>
            <li class="breadcrumb-item">Create</li>
        </ol>
        
        <div class="card ibox">
            <div class="ibox-head">
                <div class="ibox-title">Create Book</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                
                <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    
                    <div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
                        <label for="judul" class="col-md-4 control-label">Judul</label>
                        <div class="col-md-6">
                            <input id="judul" type="text" class="form-control" name="judul"
                                   value="{{ old('judul') }}" required>
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
                                   value="{{ old('pengarang') }}" required>
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
                                   value="{{ old('penerbit') }}" required>
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
                                   name="tahun_terbit" value="{{ old('tahun_terbit') }}" required>
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
                            <input id="jumlah_buku" type="number" maxlength="4" class="form-control"
                                   name="jumlah_buku" value="{{ old('jumlah_buku') }}" required>
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
                            <textarea class="form-control" name="deskripsi" rows="4"
                                      placeholder="Description">{{ old('description') }}</textarea>
                            
                            @if ($errors->has('deskripsi'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Cover</label>
                        <div class="col-md-6">
                            <img width="200" height="200"/>
                            <input type="file" class="uploads form-control" style="margin-top: 20px;"
                                   name="cover">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-fix" id="submit">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-danger btn-fix pull-right">
                                Reset
                            </button>
                        </div>
                        <a href="{{route('book.index')}}" class="btn btn-light pull-right">Back</a>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
@endsection