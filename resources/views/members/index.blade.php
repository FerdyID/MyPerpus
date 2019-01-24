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
            <li class="breadcrumb-item">Users</li>
        </ol>
        
        <div style="margin-bottom: 20px;">
            <a href="{{ route('member.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i>
                Add Member</a>
        </div>
        
        @if (Session::has('message'))
            <div class="alert alert-{{ Session::get('message_type') }} alert-bordered">{{ Session::get('message') }}</div>
        @endif
        
        <div class="card ibox">
            <div class="ibox-head">
                <div class="ibox-title text-info"><i class="fa fa-user"></i> Data Members</div>
            </div>
            
            
            <div class="ibox-body">
                <h4 class="card-title">Data Anggota</h4>
                
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                        <tr>
                            <th>
                                Nama
                            </th>
                            <th>
                                NPM
                            </th>
                            <th>
                                Prodi
                            </th>
                            <th>
                                Jenis Kelamin
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $data)
                            <tr>
                                <td class="py-1">
                                    <a href="{{route('member.show', $data->id)}}">
                                        @if($data->user->gambar!='')
                                            <img src="{{ asset('images/user/'.$data->user->gambar) }}" alt="image"
                                                 style="margin-right: 10px;"/>
                                        @else
                                            <img src="{{ asset('images/user/default.jpg')}}" alt="image"
                                                 style="margin-right: 10px;"/>
                                        
                                        @endif
                                        {{$data->nama}}
                                    </a>
                                </td>
                                
                                <td>
                                    {{$data->npm}}
                                </td>
                                
                                <td>
                                    @if($data->prodi == 'TI')
                                        Teknik Informatika
                                    @elseif($data->prodi == 'SI')
                                        Sistem Informasi
                                    @endif
                                </td>
                                <td>
                                    {{$data->jk === "L" ? "Laki - Laki" : "Perempuan"}}
                                </td>
                                
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('member.edit', $data->id) }}">
                                            <button class="btn btn-default btn-xs m-r-5" data-toggle="tooltip"
                                                    data-original-title="Edit"><i class="fa fa-pencil font-14"></i>
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('member.destroy', $data->id) }}"
                                              class="pull-left" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button class="btn btn-default btn-xs" data-toggle="tooltip"
                                                    data-original-title="Delete"
                                                    onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i
                                                        class="fa fa-trash font-14"></i></button>
                                        </form>
                                    </div>
                                </td>
                            
                            
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection