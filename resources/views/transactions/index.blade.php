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
    <div class="page-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Transaction</li>
        </ol>
        
        @if(Auth::user()->level == 'admin')
            <div style="margin-bottom: 20px;">
                <a href="{{ route('transaction.create') }}" class="btn btn-primary btn-rounded btn-fw"><i
                            class="fa fa-plus"></i>
                    Add Transaction</a>
            </div>
        @endif
        
        @if (Session::has('message'))
            <div class="alert alert-{{ Session::get('message_type') }} alert-bordered">{{ Session::get('message') }}</div>
        @endif
        
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Transaction</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            <div class="ibox-body">
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
                                        @if(Auth::user()->level == 'admin')
                                            <div class="btn-group dropdown">
                                                <button type="button" class="btn btn-success dropdown-toggle btn-sm"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start"
                                                     style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                                                    @if($data->status == 'pinjam')
                                                        <form action="{{ route('transaction.update', $data->id) }}"
                                                              method="post" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            {{ method_field('put') }}
                                                            <button class="dropdown-item"
                                                                    onclick="return confirm('Anda yakin data ini sudah kembali?')">
                                                                Sudah Kembali
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('transaction.destroy', $data->id) }}"
                                                          class="pull-left" method="post">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button class="dropdown-item"
                                                                onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @else
                                            @if($data->status == 'pinjam')
                                                <form action="{{ route('transaction.update', $data->id) }}"
                                                      method="post"
                                                      enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    {{ method_field('put') }}
                                                    <button class="btn btn-info btn-xs"
                                                            onclick="return confirm('Anda yakin data ini sudah kembali?')">
                                                        Sudah Kembali
                                                    </button>
                                                </form>
                                            @else
                                                -
                                            @endif
                                        @endif
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
@endsection