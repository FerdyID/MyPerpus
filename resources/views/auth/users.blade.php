@extends('layouts.layout')
@section('styles')
    {{--<link href="{{asset('css/datatables.bootstrap.css')}}" rel="stylesheet"/>--}}
@endsection

@section('content')
    <div class="page-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Users</li>
        </ol>
        
        <div style="margin-bottom: 20px;">
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i>
                Add User</a>
        </div>
        
        @if (Session::has('message'))
            <div class="alert alert-{{ Session::get('message_type') }} alert-bordered">{{ Session::get('message') }}</div>
        @endif
        
        <div class="card ibox">
            <div class="ibox-head">
                <div class="ibox-title text-info"><i class="fa fa-user"></i> Data Users</div>
                {{--                <div class="pull-rightt">
                                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i
                                                class="fa fa-download"></i> Export As <i class="fa fa-angle-down"></i></button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ url('/downloadPDF') }}"><i
                                                        class="fa fa-file-pdf-o"></i> PDF</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ url('/downloadExcel') }}"><i
                                                        class="fa fa-file-excel-o"></i> Excel</a>
                                        </li>
                                    </ul>
                                </div>--}}
            </div>
            
            <div class="ibox-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Level
                            </th>
                            <th>
                                Created At
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{++$i}}
                                </td>
                                <td class="py-1">
                                    <a href="{{url('user', $user->id)}}">
                                        
                                        @if($user->gambar!='')
                                            <img src="{{url('images/user', $user->gambar)}}" alt="image"
                                                 style="margin-right: 10px;"/>
                                        @else
                                            <img src="{{url('images/user/default.jpg')}}" alt="image"
                                                 style="margin-right: 10px;"/>
                                        
                                        @endif
                                        {{$user->name}}
                                    </a>
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                        <span @if($user->level=='admin') class="badge badge-primary"
                                              @else class="badge badge-success" @endif>
                                            {{$user->level}}
                                        </span>
                                </td>
                                <td>
                                    {{$user->created_at}}
                                </td>
                                
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('user.edit', $user->id) }}">
                                            <button class="btn btn-default btn-xs m-r-5" data-toggle="tooltip"
                                                    data-original-title="Edit"><i class="fa fa-pencil font-14"></i>
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('user.destroy', $user->id) }}"
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
                                {{--    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"> Actions <i
                                                        class="fa fa-angle-down"></i></button>
                                            <ul class="dropdown-menu" x-placement="top-start"
                                                style="position: absolute; min-width: 5rem; transform: translate3d(0px, -115px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="{{route('user.edit', $user->id)}}"><i
                                                                class="fa fa-edit"></i> Edit</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('user.destroy', $user->id) }}"
                                                          class="pull-left" method="post">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button class="dropdown-item"
                                                                onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                                            <i class="fa fa-dropbox"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <ul style="display:inline-block;">
                        {{$users->links()}}
                    </ul>
                </div>
            </div>
        </div>
        
        {{--<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST"--}}
        {{--action="{{url('import')}}">--}}
        {{--{{csrf_field()}}--}}
        {{----}}
        {{--<div class="form-group">--}}
        {{--<input id="file" type="file" class="uploads form-control input-rounded"--}}
        {{--name="file" accept=".xls, .xlsx" title="Choose a excel file">--}}
        {{--</div>--}}
        {{----}}
        {{--<div class="form-group">--}}
        {{--<div class="col-md-3 col-md-offset-3">--}}
        {{--<button type="submit" class="btn btn-primary">Import</button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</form>--}}
    
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
                "iDisplayLength": 10
            });

        });
    </script>
@stop