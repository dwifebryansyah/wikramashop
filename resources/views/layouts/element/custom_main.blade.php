<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        .test{
            border-left: 2px #5e72e4 solid;
            background-color: #5e72e4;
            color: #ffffff!important;
        }

    </style>

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/argon/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/argon/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/argon/css/argon-dashboard.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/picker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/argon/css/font-open-sans.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/img/logo_compact.png') }}">

    @yield('custom-css')

    <title>@yield('title')</title>

</head>
<body class="bg-gradient-primary">

    <div class="main-content">
        @section('content')

        @show
    </div>

    {{-- all jquery --}}
    <script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
    <!--   Core   -->
    <script src="{{ asset('assets/argon/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/argon/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/picker.js') }}"></script>
    <!--   Optional JS   -->
    <script src="{{ asset('assets/argon/js/plugins/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/argon/js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
    <!--   Argon JS   -->
    <script src="{{ asset('assets/argon/js/argon-dashboard.min.js') }}"></script>
    <script src="{{ asset('assets/argon/js/track-js.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-scrollLock.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>





    @yield('scripts')

</body>
</html>

