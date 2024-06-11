<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Phiếu thu</title>

	<!--# Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('global_assets/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('global_assets/css/icons/fontawesome/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/all.min.css')}}" rel="stylesheet" type="text/css">
	<!--# /global stylesheets -->

	<!-- asset css -->
	<link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<!-- end asset css -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"> -->
	<link href="{{asset('/css/style.css')}}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

	<script src="{{asset('/global_assets/js/plugins/notifications/jgrowl.min.js')}}"></script>
    <script src="{{asset('/global_assets/js/plugins/notifications/noty.min.js')}}"></script>
    <script src="{{asset('/global_assets/js/demo_pages/extra_jgrowl_noty.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">

	<style>

		#myContentEditableDiv:first-letter {
		    text-transform: capitalize;
		}

		#printJS-bill{
			visibility :hidden;
			position: absolute;
			top:-100000px;
		}
		.content {
			max-width: 1000px;
			height: auto;
			margin: auto;
			overflow: auto;
			position: relative;
		}

		.horizontal_dotted_line {
		  display: flex;

		} 
		.horizontal_dotted_line:after {
		  border-bottom: 2px dotted black;
		  content: '';
		  flex: 1;
		}

		@media (max-width: 975px) {
			.content {
				max-width: 500px;
			}
		}

	</style>

	<style>
        .box-wrap {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .box-wrap .left-info {
            width: 30%;
        }

        .box-wrap .right-info {
            width: 70%;
            padding-left: 15px;
        }
    </style>

</head>
<body  target="_blank">
	@if(session('toastr'))
        <script>
            var TYPE_MESSAGE = "{{ session('toastr.type') }}";
            var MESSAGE = "{{ session('toastr.message') }}";
        </script>
    @endif
    @php
        Session::forget('toastr');
        Session::Save();
    @endphp

    <div class="content">

		<div class="card card-body" style="max-width: 500px;">

			<div class="row"  target="_blank">

				<div class="col-lg-12">

					@include('admins.paradigms.bill.bill')

					<div class="col-lg-12 mt-4">

						<div class="row pl-2 pr-2">

							<a href="{{route('get.paradigms.collect', ['paradigm_id' => $paradigm_id ?? '0', 'household_type' => $household_type ?? 0])}}" class="btn btn-primary">Quay về</a>
							<a href="{{$url}}" class="btn btn-outline-success">Thu tiếp</a>
							 <button type="button" style="" class="btn btn-dark" onclick="printJS({printable: 'printJS-bill', type: 'html', 
							 style:'#printJS-bill{width:90%; margin:auto; margin-top: 20px; font-size: 24px; position:relative; text-align: center;} .header-bill{width: 100%;} .mau_so{margin-top:20px; position: relative; text-align: center;} .font-weight-bold{font-weight:bold;} .phieuthu{margin-top:20px;text-align: center;} .col-lg-12{width:100%;} .content_bill{width:100%;} .box-wrap {width:100%; display: flex ; justify-content: space-between;flex-wrap: wrap;}.box-wrap .left-info {width: max-content; }.box-wrap .right-info {width: max-content;padding-left: 15px; text-align:left; } .right-info .title-row {text-align:left; padding-left: -20px;} .ngaythang{text-align: right;} .nguoilap_phieu{margin-top:50px;text-align: center;} #myContentEditableDiv:first-letter {text-transform: capitalize;} .light-small{margin-top: -36px;} .light-medium{margin-top: -20px;} .light-margin-top-6px{margin-top: -6px;} .light-small-bottom{margin-bottom: -40px;} #image_logo{z-index:-99;} image{width: 70%; position: absolute; top: 50%; transform: translateY(-50%); opacity: 0.2; z-index: -9999; left: 14%;}' })">
							    In
							 </button>
						</div>

					</div>

				</div>
				
			</div>
			
		</div>

	</div>

	<!--# Core JS files -->
	<script src="{{asset('global_assets/js/main/jquery.min.js')}}"></script>
	<script src="{{asset('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<!--# /core JS files -->

	<!--# Theme JS files -->
	<script src="{{asset('global_assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>

	<script src="{{asset('assets/js/app.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_pages/dashboard.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_charts/pages/dashboard/light/streamgraph.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_charts/pages/dashboard/light/sparklines.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_charts/pages/dashboard/light/lines.js')}}"></script>	
	<script src="{{asset('global_assets/js/demo_charts/pages/dashboard/light/areas.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_charts/pages/dashboard/light/donuts.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_charts/pages/dashboard/light/bars.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_charts/pages/dashboard/light/progress.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_charts/pages/dashboard/light/heatmaps.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_charts/pages/dashboard/light/pies.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_charts/pages/dashboard/light/bullets.js')}}"></script>
	<!--# /theme JS files -->
	<script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script>
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
	@include('admins.layouts.success')
	@include('admins.layouts.error')

	@php

		Session::forget('open');
        Session::forget('active');
        Session::forget('success');
        Session::forget('error');
        Session::save();

	@endphp

    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
</body>
</html>
