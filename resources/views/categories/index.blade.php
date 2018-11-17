@extends('layouts.layout')
@section('content')
    <div class="page-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Categories</li>
        </ol>
        
        <div style="margin-bottom: 20px;">
            <a href="{{ route('category.create') }}" class="btn btn-primary btn-rounded btn-fw"><i
                        class="fa fa-plus"></i>
                Add Category</a>
        </div>
        
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Categories</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                //Code here
                
            </div>
        </div>
    </div>
@endsection