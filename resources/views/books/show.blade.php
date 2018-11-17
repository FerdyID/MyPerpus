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
                <div class="text-center" style="padding-left:200px; padding-right: 200px;">
                    <iframe src="https://drive.google.com/file/d/1jvNFrFoR-gss5yMDMHV1y8JeY9kvt1QG/preview" width="640" height="480"></iframe>
{{--                    <iframe id="inlineFrameExample"
                            title="Inline Frame Example"
                            width="500"
                            height="600"
                            src="{{asset('assets/pdf/laravel.pdf#toolbar=0')}}">
                    </iframe>--}}
                </div>
            </div>
        </div>
    </div>
@endsection