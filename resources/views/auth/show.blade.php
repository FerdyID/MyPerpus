@extends('layouts.layout')
@section('content')
    <div class="page-content">
        {{--<div class="row">--}}
        <div class="col-md-8">
            <div class="ibox">
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
            </div>
        </div>
    </div>
@endsection