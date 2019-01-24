@extends('layouts.layout')

@section('content')
    <div class="page-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Laporan / Transactions</li>
        </ol>
        
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Transactions Report</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <div class="btn-group dropdown">
                    <button class="btn btn-info btn-fix dropdown-toggle" data-toggle="dropdown"><i
                                class="fa fa-download"></i><b> Export PDF<i class="fa fa-angle-down"></i></b></button>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('laporan/trs/pdf')}}"> Semua Transaksi </a>
                        <a class="dropdown-item" href="{{url('laporan/trs/pdf?status=pinjam')}}"> Pinjam </a>
                        <a class="dropdown-item" href="{{url('laporan/trs/pdf?status=kembali')}}"> Kembali </a>
                    </ul>
                
                </div>
                
                <div class="btn-group dropdown">
                    <button class="btn btn-success btn-fix dropdown-toggle" data-toggle="dropdown"><i
                                class="fa fa-download"></i><b> Export Excel <i class="fa fa-angle-down"></i></b>
                    </button>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('laporan/trs/excel')}}"> Semua Transaksi </a>
                        {{--                        <a class="dropdown-item" href="{{url('laporan/trs/excel?status=pinjam')}}"> Pinjam </a>
                                                <a class="dropdown-item" href="{{url('laporan/trs/excel?status=kembali')}}"> Kembali </a>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection