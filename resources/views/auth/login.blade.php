<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Admincast | Login</title>
    
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <!-- THEME STYLES-->
    <link href="{{asset('assets/css/main.min.css')}}" rel="stylesheet"/>
    <!-- PAGE LEVEL STYLES-->
    <link href="{{asset('assets/css/pages/auth-light.css')}}" rel="stylesheet"/>

</head>

<body class="bg">
<div class="content">
    <div class="brand">
        <span><i class="fa fa-code"> </i>UniCode</span>
    </div>
    <form id="login-form" class="card" style="box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.1);" action="{{ route('login') }}" method="post">
        @csrf
        
        <div class="login-header text-center text-">
            <i style="font-size: 100px;" class="fa fa-user-circle"></i>
        </div>
        <h3 class="login-title">Log in</h3>
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
                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                       name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
        <div class="form-group d-flex justify-content-between">
            <label class="ui-checkbox ui-checkbox-info">
                <input type="checkbox">
                <span class="input-span" type="checkbox" name="remember"
                      id="remember" {{ old('remember') ? 'checked' : '' }}></span>Remember me</label>
            <a href="{{ route('password.request') }}">Forgot password?</a>
        </div>
        <br>
        <div class="form-group">
            <button class="btn btn-info btn-block" type="submit">Login</button>
        </div>
        <div class="social-auth-hr">
        </div>
        <div class="text-center">Not a member?
            <a class="color-blue" href="{{ route('register') }}">Create account</a>
        </div>
    </form>
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
</body>

</html>