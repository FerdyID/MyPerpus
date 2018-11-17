<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <title>Document</title>
</head>
<body>
<div class="text-center">
    <iframe id="inlineFrameExample"
            title="Inline Frame Example"
            width="700"
            height="600"
            src="{{asset('assets/pdf/laravel.pdf#toolbar=0')}}">
    </iframe>
</div>

{{--    <embed src="{{asset('assets/pdf/laravel.pdf#toolbar=0&navpanes=0&scrollbar=0&statusbar=0&messages=0&scrollbar=0')}}" width="700" height="575">--}}

</body>
</html>