@extends('layouts.layout')
@section('content')
    <div class="page-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Profile</li>
        </ol>
        
            {{--<div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Detail <b>{{$user->name}}</b></div>
                </div>
                <div class="ibox-body">
                    <div class="form-group">
                        <div class="col-md-8 centered">
                            <img class="product" width="200" height="200"
                                 @if($user->gambar !='') src="{{ asset('images/user/'.$user->gambar) }}"
                                 @else
                                 src="{{ asset('images/user/default.jpg') }}" @endif />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Name</label>
                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control input-rounded" name="name"
                                   value="{{ $user->name }}" readonly="">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control input-rounded" name="email"
                                   value="{{ $user->email }}" required readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="{{route('user.index')}}" class="btn btn-default btn-fix pull-right">Back</a>
                    </div>
                    <br><br>
                </div>
            </div>--}}
        <div class="col-md-6">
            <div class="card ibox">
                <div class="ibox-head">
                    <div class="ibox-title"><i class="fa fa-user"></i> Profile {{$user->name}}</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                
                <div class="ibox-body">
                    <div class="mx-auto d-block">
                        <a href="#">
                            <img class="rounded-circle mx-auto d-block mr-3" width="200" height="200"
                                 style="border: 5px solid #646464;"
                                 @if($user->gambar !='') src="{{ asset('images/user/'.$user->gambar) }}"
                                 @else
                                 src="{{ asset('images/user/default.jpg') }}" @endif />
                        </a>
                        <h5 class="text-sm-center mt-2 mb-1">{{$user->name}}</h5>
                        <div class="location text-sm-center"><i class="fa fa-envelope-o"></i> {{$user->email}}
                        </div>
                    </div>
                    <hr>
                    <div class="card-text text-sm-center">
                        <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                        <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                        <a href="#"><i class="fa fa-linkedin pr-1"></i></a>
                        <a href="#"><i class="fa fa-pinterest pr-1"></i></a>
                    </div>
                    {{--<span class="pull-right text-muted font-13">Joined in 12.01</span>--}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#nav-dashboard').removeClass('active');
            $('#nav-user').addClass('active');
        });
    </script>
@stop