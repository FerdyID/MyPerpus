@extends('layouts.layout')
@section('content')
    <div class="page-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Laporan / Book</li>
        </ol>
        
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Books Report</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <div class="pull-rightt">
                    <button class="btn btn-primary btn-fix dropdown-toggle" data-toggle="dropdown"><i
                                class="fa fa-download"></i><b> Export As <i class="fa fa-angle-down"></i></b></button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ url('laporan/book/pdf') }}">
                                <b><i class="fa fa-file-pdf-o"></i> PDF</b></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('laporan/book/excel') }}">
                                <b><i class="fa fa-file-excel-o"></i> Excel</b></a>
                        </li>
                    
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection