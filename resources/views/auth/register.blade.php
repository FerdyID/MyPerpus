<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Register | MyPerpus</title>
    
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <!-- THEME STYLES-->
    <link href="{{asset('assets/css/main.min.css')}}" rel="stylesheet"/>
    <!-- PAGE LEVEL STYLES-->
    <link href="{{asset('assets/css/pages/auth-light.css')}}" rel="stylesheet"/>

</head>

<body>
<div class="content">
    <div class="brand">
        {{--<span><i class="fa fa-code"> </i>UniCode</span>--}}
    </div>
    
    <form style="box-shadow: 0 8px 8px rgba(0, 0, 0, 0.2);" action="{{ url('register') }}" method="post">
        {{csrf_field()}}
        
        <div class="login-header text-center text-">
            <i style="font-size: 100px;" class="fa fa-user-circle"></i>
        </div>
        <h3 class="login-title">Sign Up</h3>

        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-user font-20"></i></div>
                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name"
                       value="{{ old('name') }}" placeholder="Name" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-envelope"></i></div>
                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email"
                       value="{{ old('email') }}" placeholder="Email" required autofocus autocomplete="off">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-lock font-20"></i></div>
                <input id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                       name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-check font-18"></i></div>
                <input id="confirm_password" type="password" onkeyup="check()"
                       class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                <span id='message'></span>
            </div>
        </div>
        
        <div class="form-group text-left">
            <label class="ui-checkbox ui-checkbox-info">
                <input type="checkbox" name="agree">
                <span class="input-span"></span>I agree the terms and policy</label>
        </div><br>
        <div class="form-group">
            <button class="btn btn-info btn-block" type="submit">Sign up</button>
        </div>
        <div class="social-auth-hr">
        </div>
        <div class="text-center">Already a member?
            <a class="color-blue" href="{{route('login')}}">Login here</a>
        </div>
    </form>
    <br>
    
</div>
<!-- CORE SCRIPTS-->
<script src="{{asset('js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js')}}" type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src="{{asset('assets/js/app.min.js')}}" type="text/javascript"></script>
<!-- PAGE LEVEL SCRIPTS-->

<script type="text/javascript">
    $(function() {
        $('#register-form').validate({
            errorClass: "help-block",
            rules: {
                first_name: {
                    required: true,
                    minlength: 2
                },
                last_name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    confirmed: true
                },
                password_confirmation: {
                    equalTo: password
                }
            },
            highlight: function(e) {
                $(e).closest(".form-group").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group").removeClass("has-error")
            },
        });
    });
</script>
</body>

</html>