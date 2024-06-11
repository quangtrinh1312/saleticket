<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!--# Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('global_assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!--# /global stylesheets -->

    <!-- asset css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('font/fontawesome-free-6.1.2-web/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- end asset css -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"> -->
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    @yield('css')
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <!-- notifications  -->
    <script src="{{ asset('global_assets/js/plugins/notifications/jgrowl.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/notifications/noty.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_pages/extra_jgrowl_noty.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">

    @yield('style')

    @stack('style')

    @livewireStyles
</head>

<body class="d-flex flex-column" style="min-height:100vh; height: auto; overflow-y: auto;">
    <!-- zalo -->
    <div class="zalo-chat-widget" data-oaid="2126436102531563859" data-welcome-message="Rất vui khi được hỗ trợ bạn!"
        data-autopopup="10" data-width="400" data-height="450"></div>
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
    <!--  -->
    @if (session('toastr'))
        <script>
            var TYPE_MESSAGE = "{{ session('toastr.type') }}";
            var MESSAGE = "{{ session('toastr.message') }}";
        </script>
    @endif
    @yield('content')
    @include('admins.layouts.success')
    @include('admins.layouts.error')
    @yield('script')
    @livewireScripts
    <!--# Core JS files -->
    <script src="{{ asset('global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <!--# /core JS files -->
    <!--# Theme JS files -->
    <script src="{{ asset('global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_pages/dashboard.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_charts/pages/dashboard/light/streamgraph.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_charts/pages/dashboard/light/sparklines.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_charts/pages/dashboard/light/lines.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_charts/pages/dashboard/light/areas.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_charts/pages/dashboard/light/donuts.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_charts/pages/dashboard/light/bars.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_charts/pages/dashboard/light/progress.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_charts/pages/dashboard/light/heatmaps.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_charts/pages/dashboard/light/pies.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_charts/pages/dashboard/light/bullets.js') }}"></script>
    <!--# /theme JS files -->
    <script src="toastr/toastr.min.js"></script>
    <script type="text/javascript">
        if (typeof TYPE_MESSAGE != "undefined") {
            switch (TYPE_MESSAGE) {
                case 'success':
                    toastr.success(MESSAGE)
                    break;
                case 'error':
                    toastr.error(MESSAGE)
                    break;
            }
        }
    </script>
    <script src="{{ asset('./js/numberToWords.js') }}"></script>
    <script src="{{ asset('./js/index.js') }}"></script>
    <script src="{{ asset('./js/personal-infor.js') }}"></script>
    <script src="{{ asset('./js/change-pwd.js') }}"></script>

    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script src="{{ asset('./js/js-btn-reset.js') }}"></script>

    {{-- <script src="{{ asset('./js/type-price.js') }}"></script> --}}

    <script src="{{ asset('assets/js/easy-number-separator.js') }}"></script>

    @stack('script')
    @php
        Session::forget('toastr');
        Session::forget('error');
        Session::forget('success');
        Session::forget('open');
        Session::forget('active');
        Session::save();
    @endphp
</body>

</html>
