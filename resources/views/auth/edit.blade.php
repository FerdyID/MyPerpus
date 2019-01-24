@extends('layouts.layout')
@section('content')
    <div class="page-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('user')}}">User</a></li>
            <li class="breadcrumb-item">Create</li>
        </ol>
        
        <div class="card ibox">
            <div class="ibox-head">
                <div class="ibox-title">Edit User</div>
            </div>
            <div class="ibox-body">
                <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control input-rounded" name="name"
                                   value="{{ $user->name }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control input-rounded" name="email"
                                   value="{{ $user->email }}" required readonly="">
                            @if ($errors->has('email'))
                                <span class="text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Gambar</label>
                        <div class="col-md-6">
                            <img class="product" width="200" height="200"
                                 @if($user->gambar =='') src="{{ asset('images/user/default.jpg') }}"
                                 @else
                            
                                 src="{{ asset('images/user/'.$user->gambar) }}"
                                    @endif />
                            <input type="file" class="uploads form-control input-rounded" style="margin-top: 20px;"
                                   name="gambar">
                        </div>
                    </div>
                    
                    @if(Auth::user()->level == 'admin')
                        <div class="form-group">
                            <label for="level" class="col-md-4 control-label">Level</label>
                            <div class="col-md-6 {{ $errors->has('level') ? ' has-error' : '' }}">
                                <select class="form-control" name="level" required="">
                                    <option value="admin" @if($user->level == 'admin') selected @endif>
                                        Admin
                                    </option>
                                    <option value="user" @if($user->level == 'user') selected @endif>
                                        User
                                    </option>
                                </select>
                            </div>
                        </div>
                    @endif
    
                    @if(Auth::user()->id == $user->id)
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control input-rounded"
                                       onkeyup='check();'
                                       name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="confirm_password" type="password" onkeyup="check()"
                                       class="form-control input-rounded" name="password_confirmation">
                                <span id='message'></span>
                            </div>
                        </div>
                    @endif
                    
                    <br>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary btn-fix" id="submit">Update</button>
                        {{--<a href="{{url('user')}}" class="btn btn-default btn-fix pull-right">Back</a>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    {{--<script>--}}
    {{--$(document).ready(function(){--}}
    {{--$('#nav-dashboard').removeClass('active');--}}
    {{--$('#nav-user').addClass('active');--}}
    {{--});--}}
    {{--</script>--}}
    
    <script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function () {
                // do ajax submit or just classic form submit
                //  alert("fake subminting")
                return false
            })
        })

        var check = function () {
            if (document.getElementById('password').value == document.getElementById('confirm_password').value && document.getElementById('password').value != '') {
                document.getElementById('submit').disabled = false;
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'matching';
            } else {
                document.getElementById('submit').disabled = true;
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'not matching';
            }
        }
    </script>
@stop