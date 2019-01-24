<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Perpustakaan Online | MyPerpus</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendors/themify-icons/css/themify-icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{asset('DataTables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- THEME STYLES-->
    <link href="{{asset('assets/css/main.min.css')}}" rel="stylesheet"/>
    <!-- PAGE LEVEL STYLES-->
    @yield('styles')

</head>

<body class="has-animation fixed-navbar fixed-layout">
<div class="page-wrapper">
    @include('partials.navbar')
    @include('partials.sidebar')
    <div class="content-wrapper">
        @yield('content')
        @include('partials.footer')
    </div>

</div>

<!-- BEGIN PAGA BACKDROPS-->
{{--loading setelah login--}}
{{-- <div class="sidenav-backdrop backdrop"></div> --}}
<div id="loader" class="preloader-backdrop">
    <div class="text-center fixed-bottom"><img src="{{asset('loading.gif')}}"></div>
</div>

<!-- END PAGA BACKDROPS

<!-- CORE PLUGINS-->
<script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/metisMenu/dist/metisMenu.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>


<!-- CORE SCRIPTS-->
<script src="{{asset('assets/js/app.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/notify.js')}}" type="text/javascript"></script>
<script src="{{asset('sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('DataTables/datatables.min.js')}}" type="text/javascript"></script>
{{--<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>--}}
<!-- PAGE LEVEL SCRIPTS-->
{{--@include('sweetalert::alert')--}}

@include('sweetalert::view')

@section('js')

@show

<script>
    $(document).ready(function () {
        $("#loader").delay(500).fadeOut("slow");

        var pathname = window.location.pathname;
        console.log('url path =>', pathname);
        switch (pathname) {
            case '/':
                $('#nav-dashboard').addClass('active');
                $('#nav-user').removeClass('active');
                $('#nav-members').removeClass('active');
                $('#nav-books').removeClass('active');
                $('#nav-transactions').removeClass('active');
                $('#nav-lapbook').removeClass('active');
                $('#nav-laptrans').removeClass('active');
                break;
            case '/user':
            case '/user/create':
                $('#nav-user').addClass('active');
                $('#nav-dashboard').removeClass('active');
                $('#nav-books').removeClass('active');
                $('#nav-members').removeClass('active');
                $('#nav-transactions').removeClass('active');
                $('#nav-lapbook').removeClass('active');
                $('#nav-laptrans').removeClass('active');
                break;
            case '/book':
            case '/book/create':
                $('#nav-books').addClass('active');
                $('#nav-dashboard').removeClass('active');
                $('#nav-user').removeClass('active');
                $('#nav-members').removeClass('active');
                $('#nav-transactions').removeClass('active');
                $('#nav-lapbook').removeClass('active');
                $('#nav-laptrans').removeClass('active');
                break;
            case '/member':
            case '/member/create':
                $('#nav-members').addClass('active');
                $('#nav-dashboard').removeClass('active');
                $('#nav-user').removeClass('active');
                $('#nav-books').removeClass('active');
                $('#nav-transactions').removeClass('active');
                $('#nav-lapbook').removeClass('active');
                $('#nav-laptrans').removeClass('active');
                break;
            case '/transaction':
            case '/transaction/create':
                $('#nav-transactions').addClass('active');
                $('#nav-dashboard').removeClass('active');
                $('#nav-user').removeClass('active');
                $('#nav-members').removeClass('active');
                $('#nav-books').removeClass('active');
                $('#nav-lapbook').removeClass('active');
                $('#nav-laptrans').removeClass('active');
                break;
            case '/laporan/book':
                $('#nav-lapbook').addClass('active');
                $('#nav-laptrans').removeClass('active');
                $('#nav-transactions').removeClass('active');
                $('#nav-dashboard').removeClass('active');
                $('#nav-user').removeClass('active');
                $('#nav-members').removeClass('active');
                $('#nav-books').removeClass('active');
                break;
            case '/laporan/trs':
                $('#nav-laptrans').addClass('active');
                $('#nav-lapbook').removeClass('active');
                $('#nav-transactions').removeClass('active');
                $('#nav-dashboard').removeClass('active');
                $('#nav-user').removeClass('active');
                $('#nav-members').removeClass('active');
                $('#nav-books').removeClass('active');
                break;
            default:
            // alert('Looking forward to the Weekend');
        }
    });
</script>
</body>
</html>
