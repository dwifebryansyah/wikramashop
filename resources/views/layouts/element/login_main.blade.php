<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('assets/login/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">
    @yield('custom-css')

    <style>
        .btn-purple{
            color: #fff;
            background-color: #000000;
        }

        .btn-cyan{
            color: #fff;
            background-color: #11cdef;
        }
    </style>

</head>
<body>

    <div class="main">

        @section('content')

        @show

    </div>

    <!-- JS -->
    <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/main.js') }}"></script>

    @yield('scripts')
</body>
</html>
