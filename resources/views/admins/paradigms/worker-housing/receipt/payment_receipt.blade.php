<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Biên lai</title>

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

	<style>
		.content {
			max-width: 780px;
			height: auto;
			margin: auto;
			margin-top: 5%;
			overflow: auto;
		}

		.horizontal_dotted_line {
		  display: flex;

		} 
		.horizontal_dotted_line:after {
		  border-bottom: 1px dotted black;
		  content: '';
		  flex: 1;
		}

		@media (max-width: 975px) {
			.content {
				max-width: 500px;
			}
		}

	</style>

</head>
<body>
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

		<div class="card card-body">

			<div class="row">

				<div class="col-lg-12">

					<div class="row" style="margin-top: -20px;">
						<div class="col-lg-6 mt-2">
							<div class="horizontal_dotted_line"><b>Đơn vị</b>: </div>
							<div class="horizontal_dotted_line"><b>Địa chỉ</b>: </div>
							<div class="horizontal_dotted_line"><b>Mã đơn vị có QH với NS</b>: </div>
						</div>
						<div class="col-lg-6 text-center mt-2">
							<p class="font-weight-bold">Mẫu số: C38-BB</p>
							<p class="" style="margin-top: -10px;">(Ban hành theo QĐ số: 19/2006/QĐ-BTC ngày 30/3/2006 của Bộ trưởng BTC và sửa đổi, bổ sung theo Thông tư số 185/2010/TT-BTC ngày 15/11/2010 của Bộ Tài chính)</p>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12 text-center">
							<H1 class="text-uppercase font-weight-bold">BIÊN LAI THU TIỀN</H1>
							<p style="margin-top: -14px;">(Liên 2: Giao người nộp)</p>
							<p style="margin-top: -8px;">Ngày........ tháng........ năm</p>
						</div>
					</div>
						
					<!-- <div class="row">
						<div class="col-lg-12">
							<div class="row" style="">
								<p style="width: 19%;">- Họ, tên người nộp:</p>
								<p style="border-bottom: 1px dotted black; width: 81%;"></p>
							</div>
							<div class="row" style="">
								<p style="width: 9%;">- Địa chỉ:</p>
								<p style="border-bottom: 1px dotted black; width: 91%;"></p>
							</div>
							<div class="row" style="">
								<p style="width: 14%;">- Nội dung thu:</p>
								<p style="border-bottom: 1px dotted black; width: 86%;"></p>
							</div>
							<div class="row" style="">
								<p style="width: 12%;">- Số tiền thu:</p>
								<p style="border-bottom: 1px dotted black; width: 88%;"></p>
							</div>
							<div class="row" style="">
								<p style="width: 16%;">- (Viết bằng chữ):</p>
								<p style="border-bottom: 1px dotted black; width: 84%;"></p>
							</div>

						</div>
					</div> -->

					<div class="row">
						<div class="col-lg-12 mt-1">
							<div class="horizontal_dotted_line">- Họ, tên người nộp: </div>
						</div>
						<div class="col-lg-12 mt-1">
							<div class="horizontal_dotted_line">- Địa chỉ: </div>
						</div>
						<div class="col-lg-12 mt-1">
							<div class="horizontal_dotted_line">- Nội dung thu: </div>
						</div>
						<div class="col-lg-12 mt-1">
							<div class="horizontal_dotted_line">- Số tiền thu: </div>
						</div>
						<div class="col-lg-12 mt-1">
							<div class="horizontal_dotted_line">- (Viết bằng chữ): </div>
						</div>
						
					</div>

					<div class="row pb-4">

						<div class="col-lg-6 text-center mt-4">
							<p class="font-weight-bold">Người nộp tiền</p>
							<p>(Ký, họ tên)</p>
						</div>

						<div class="col-lg-6 text-center mt-4">
							<p class="font-weight-bold">Người thu tiền</p>
							<p>(Ký, họ tên)</p>
						</div>
						
					</div>

				</div>
				
			</div>
			
		</div>

	</div>

	@include('admins.layouts.success')
	@include('admins.layouts.error')
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
</body>
</html>
