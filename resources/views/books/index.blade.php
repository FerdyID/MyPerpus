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
            <li class="breadcrumb-item">Books</li>
        </ol>
        
        @if(Auth::user()->level == 'admin')
            <div style="margin-bottom: 20px;">
                <a href="{{ route('book.create') }}" class="btn btn-primary btn-rounded btn-fw"><i
                            class="fa fa-plus"></i>
                    Add Book</a>
            </div>
        @endif
        
        @if (Session::has('message'))
            <div class="alert alert-{{ Session::get('message_type') }} alert-bordered">{{ Session::get('message') }}</div>
        @endif
        
        <div class="card ibox">
            <div class="ibox-head">
                <div class="ibox-title">List Book</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                </div>
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
                                Judul
                            </th>
                            <th>
                                Pengarang
                            </th>
                            <th>
                                Penerbit
                            </th>
                            <th>
                                Tahun
                            </th>
                            <th>
                                Jumlah
                            </th>
                            @if(Auth::user()->level == 'admin')
                                <th>
                                    Actions
                                </th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>
                                    {{++$i}}
                                </td>
                                <td class="py-1">
                                    <a href="{{url('book', $book->id)}}">
                                        @if($book->cover!='')
                                            <img src="{{url('images/book', $book->cover)}}" alt="image"
                                                 style="margin-right: 10px;"/>
                                        @else
                                            <img src="{{url('images/book/default.png')}}" alt="image"
                                                 style="margin-right: 10px;"/>
                                        
                                        @endif
                                        {{$book->judul}}
                                    </a>
                                </td>
                                <td>
                                    {{$book->pengarang}}
                                </td>
                                <td>
                                    {{$book->penerbit}}
                                </td>
                                <td>
                                    {{$book->tahun_terbit}}
                                </td>
                                <td>
                                    {{$book->jumlah_buku}}
                                </td>
                                
                                @if(Auth::user()->level == 'admin')
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('book.edit', $book->id) }}">
                                                <button class="btn btn-default btn-xs m-r-5" data-toggle="tooltip"
                                                        data-original-title="Edit"><i class="fa fa-pencil font-14"></i>
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('book.destroy', $book->id) }}"
                                                  class="pull-left" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button class="btn btn-default btn-xs" data-toggle="tooltip"
                                                        data-original-title="Delete"
                                                        onclick="return confirm('Anda yakin ingin menghapus buku ini?')">
                                                    <i
                                                            class="fa fa-trash font-14"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{--                <div class="text-center">
                                    <ul style="display:inline-block;">
                                        {{$books->links()}}
                                    </ul>
                                </div>--}}
            </div>
        </div>
    </div>
@endsection