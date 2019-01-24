@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
                "iDisplayLength": 10
            });

        });
    </script>
@stop

@extends('layouts.layout')
@section('content')
    <div class="page-content fade-in-up">
        
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home font-18"></i> Dashboard</li>
        </ol>
        
        <div class="col-lg-12">
            @if (Session::has('message'))
                <div class="alert alert-{{ Session::get('message_type') }}"
                     style="margin-top:10px;">{{ Session::get('message') }}</div>
            @endif
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$trans->where('status', 'pinjam')->count()}}</h2>
                        <div class="m-b-5">Sedang Pinjam</div>
                        <i class="fa fa-address-book widget-stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$trans->count()}}</h2>
                        <div class="m-b-5">Total Transaksi</div>
                        <i class="fa fa-bar-chart-o widget-stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$books->count()}}</h2>
                        <div class="m-b-5">Total Buku</div>
                        <i class="fa fa-book widget-stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$members->count()}}</h2>
                        <div class="m-b-5">Total Member</div>
                        <i class="fa fa fa-users widget-stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                
                <div class="card-body">
                    <h4 class="card-title"><b>Data Transaksi Sedang Pinjam</b></h4>
                    
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                            <tr>
                                <th>
                                    Kode
                                </th>
                                <th>
                                    Buku
                                </th>
                                <th>
                                    Peminjam
                                </th>
                                <th>
                                    Tgl Pinjam
                                </th>
                                <th>
                                    Tgl Kembali
                                </th>
                                <th>
                                    Status
                                </th>
                                @if(Auth::user()->level == 'admin')
                                    <th>
                                        Action
                                    </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td class="py-1">
                                        <a href="{{route('transaction.show', $data->id)}}">
                                            {{$data->kd_transaksi}}
                                        </a>
                                    </td>
                                    <td>
                                        
                                        {{$data->book->judul}}
                                    
                                    </td>
                                    
                                    <td>
                                        {{$data->member->nama}}
                                    </td>
                                    <td>
                                        {{date('d/m/y', strtotime($data->tgl_pinjam))}}
                                    </td>
                                    <td>
                                        {{date('d/m/y', strtotime($data->tgl_kembali))}}
                                    </td>
                                    <td>
                                        @if($data->status == 'pinjam')
                                            <label class="badge badge-warning">Pinjam</label>
                                        @else
                                            <label class="badge badge-success">Kembali</label>
                                        @endif
                                    </td>
                                    @if(Auth::user()->level == 'admin')
                                        <td>
                                            <form action="{{ route('transaction.update', $data->id) }}" method="post"
                                                  enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <button class="btn btn-info btn-sm"
                                                        onclick="return confirm('Anda yakin data ini sudah kembali?')">
                                                    Sudah
                                                    Kembali
                                                </button>
                                            </form>
                                        
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection