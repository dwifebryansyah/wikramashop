    <!DOCTYPE html>

    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <style>
            .sidebar-primary{
                border-left: 2px #5e72e4 solid;
                background-color: #5e72e4;
                color: #ffffff!important;
            }

            .sidebar-success{
                border-left: 2px #2dce89 solid;
                background-color: #2dce89;
                color: #ffffff!important;
            }

            .sidebar-warning{
                border-left: 2px #fb6340 solid;
                background-color: #fb6340;
                color: #ffffff!important;
            }

            .sidebar-info{
                border-left: 2px #11cdef solid;
                background-color: #11cdef;
                color: #ffffff!important;
            }

            .bd-primary{
                border: 1px #5e72e4 solid;
            }

            /*************** SCROLLBAR BASE CSS ***************/

        .scroll-wrapper {
            overflow: hidden !important;
            padding: 0 !important;
            position: relative;
        }

        .scroll-wrapper > .scroll-content {
            border: none !important;
            box-sizing: content-box !important;
            height: auto;
            left: 0;
            margin: 0;
            max-height: none;
            max-width: none !important;
            overflow: scroll !important;
            padding: 0;
            position: relative !important;
            top: 0;
            width: auto !important;
        }

        .scroll-wrapper > .scroll-content::-webkit-scrollbar {
            height: 0;
            width: 0;
        }

        .scroll-element {
            display: none;
        }
        .scroll-element, .scroll-element div {
            box-sizing: content-box;
        }

        .scroll-element.scroll-x.scroll-scrollx_visible,
        .scroll-element.scroll-y.scroll-scrolly_visible {
            display: block;
        }

        .scroll-element .scroll-bar,
        .scroll-element .scroll-arrow {
            cursor: default;
        }

        .scroll-textarea {
            border: 1px solid #cccccc;
            border-top-color: #999999;
        }
        .scroll-textarea > .scroll-content {
            overflow: hidden !important;
        }
        .scroll-textarea > .scroll-content > textarea {
            border: none !important;
            box-sizing: border-box;
            height: 100% !important;
            margin: 0;
            max-height: none !important;
            max-width: none !important;
            overflow: scroll !important;
            outline: none;
            padding: 2px;
            position: relative !important;
            top: 0;
            width: 100% !important;
        }
        .scroll-textarea > .scroll-content > textarea::-webkit-scrollbar {
            height: 0;
            width: 0;
        }




        /*************** SIMPLE INNER SCROLLBAR ***************/

        .scrollbar-inner > .scroll-element,
        .scrollbar-inner > .scroll-element div
        {
            border: none;
            margin: 0;
            padding: 0;
            position: absolute;
            z-index: 10;
        }

        .scrollbar-inner > .scroll-element div {
            display: block;
            height: 100%;
            left: 0;
            top: 0;
            width: 100%;
        }

        .scrollbar-inner > .scroll-element.scroll-x {
            bottom: 2px;
            height: 8px;
            left: 0;
            width: 100%;
        }

        .scrollbar-inner > .scroll-element.scroll-y {
            height: 100%;
            right: -1px !important;
            top: 0;
            width: 8px;
        }

        .scrollbar-inner > .scroll-element .scroll-element_outer {
            overflow: hidden;
        }

        .scrollbar-inner > .scroll-element .scroll-element_outer,
        .scrollbar-inner > .scroll-element .scroll-element_track,
        .scrollbar-inner > .scroll-element .scroll-bar {
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
        }

        .scrollbar-inner > .scroll-element .scroll-element_track,
        .scrollbar-inner > .scroll-element .scroll-bar {
            -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";
            filter: alpha(opacity=40);
            opacity: 0.8;
        }

        .scrollbar-inner > .scroll-element .scroll-element_track { background-color: #e0e0e0; }
        .scrollbar-inner > .scroll-element .scroll-bar { background-color: #3d3d3d ; }
        .scrollbar-inner > .scroll-element:hover .scroll-bar { background-color: #919191; }
        .scrollbar-inner > .scroll-element.scroll-draggable .scroll-bar { background-color: #919191; }


        /* update scrollbar offset if both scrolls are visible */

        .scrollbar-inner > .scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_track { left: -12px; }
        .scrollbar-inner > .scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_track { top: -12px; }


        .scrollbar-inner > .scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_size { left: -12px; }
        .scrollbar-inner > .scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_size { top: -12px; }

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
    <body class="">

        @include('layouts.element.sidebar')
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

        <script src="{{ asset('assets/js/sweetalert2.all.js') }}"></script>

        @yield('scripts')

    </body>
    </html>

