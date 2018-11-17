@section('js')
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
                document.getElementById('message').innerHTML = 'Matching';
            } else {
                document.getElementById('submit').disabled = true;
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Not Matching';
            }
        }
    </script>
@stop

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
        
        <div class="col-md-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title text-info"><i class="ti-plus"></i> Tabah User</div>
                </div>
    
                <div class="col-lg-12">
                    @if (Session::has('message'))
                        <div class="alert alert-{{ Session::get('message_type') }}"
                             style="margin-top:10px;">{{ Session::get('message') }}</div>
                    @endif
                </div>
                
                <div class="ibox-body">
                    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">{{ __('Name') }}</label>
                            <div class="col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text"
                                       class="form-control input-rounded"
                                       name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="email" class="col-md-4 control-label">{{ __('E-Mail Address') }}</label>
                            
                            <div class="col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email"
                                       class="form-control input-rounded" name="email" value="{{ old('email') }}" required>
                                
                                @if ($errors->has('email'))
                                    <span class="text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="gambar" class="col-md-4 control-label">Gambar</label>
                            <div class="col-md-6">
                                <img class="product" width="200" height="200"/>
                                <input type="file" class="uploads form-control input-rounded" style="margin-top: 20px;"
                                       name="gambar">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="level" class="col-md-4 control-label">Level</label>
                            <div class="col-md-6">
                                <select class="form-control input-rounded" name="level" required="">
                                    <option value=""></option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control input-rounded"
                                       onkeyup='check();' name="password" required>
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
                                       class="form-control input-rounded" name="password_confirmation" required>
                                <span id='message'></span>
                            </div>
                        </div>
                        <br>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-fix" id="submit">
                                Register
                            </button>
                            <button type="reset" class="btn btn-danger btn-fix">
                                Reset
                            </button>
                            <a href="{{url('user')}}" class="btn btn-light btn-fix pull-right">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
