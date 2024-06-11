<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Kiểm tra vé</title>
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
	<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
	<!-- notifications  -->
    <script src="{{ asset('global_assets/js/plugins/notifications/jgrowl.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/notifications/noty.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_pages/extra_jgrowl_noty.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">
</head>
<body>
	<div class="text-center ml-auto mr-auto">
		<a href="{{route('set.check.bill', ['name' => Str::slug($user->name, '-') ?? '', 'number' => $number, 'user_id' => $user->id])}}" class="btn btn-primary">Soát vé</a>
	</div>
	@foreach ($tickets as $key => $value)
	<div class="text-center border ml-auto mr-auto {{$value->check == 1 ? 'border-success' : 'border-warning'}}" style="width: 350px; height: 200px; margin-top: 10px !important;">
		<p>Số: {{covert_code_bill($value->number_bill_number)}}</p>
		@if ($result_tickets[$value->number_bill_number] == 1)
		<p class="font-weight-bold text-uppercase">Vé hợp lệ</p>
		<img src="{{asset('images/success.png')}}" style="width: 100px; height:100px; " alt="Vé hợp lệ">
		@else
		<p class="font-weight-bold text-uppercase">Vé Không hợp lệ</p>
		<img src="{{asset('images/erross.png')}}" style="width: 100px; height:100px; " alt="Vé không hợp lệ">
		@endif
	</div>
	@endforeach
	<script src="{{asset('global_assets/js/main/jquery.min.js')}}"></script>
	<script src="{{asset('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>

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

	@stack('script')

	@php

		Session::forget('open');
        Session::forget('active');
        Session::forget('success');
        Session::forget('error');
        Session::save();

	@endphp
</body>
</html>