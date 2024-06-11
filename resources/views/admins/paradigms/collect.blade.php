@extends('admins.layouts.master')

@section('title')
    Danh sách thu tiền
@endsection

@section('style')
<style>
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em .2em 1.4em !important;
        margin: 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
                box-shadow: 0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        /* font-size: 1.2em !important; */
        /* font-weight: bold !important; */
        /* text-align: left !important; */
        width: auto;
        padding: 0 10px;
        border-bottom: none;
    }

    table {
        min-width: max-content;
    }


    th {
        box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
        background: #333;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .table-wrapper {
        max-height: 450px;
        overflow: scroll;
    }
</style>
@endsection

@section('content')
<!--# Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-lg-inline">
        <div class="page-title d-flex"></div>
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <a href="#" class="btn btn-link btn-float text-body"><i class="icon-bars-alt text-primary"></i><span>Thống kê</span></a>
                <a href="#" class="btn btn-link btn-float text-body"><i class="icon-calculator text-primary"></i> <span>Hóa đơn</span></a>
                <a href="#" class="btn btn-link btn-float text-body"><i class="icon-calendar5 text-primary"></i> <span>Lịch trình</span></a>
            </div>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Trang chủ</a>
                <a href="#" class="breadcrumb-item">{{$paradigm_title ?? ''}}</a>
                <a href="#" class="breadcrumb-item active">Thu tiền</a>
            </div>
            <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!--# /page header -->

<div class="content">
    @if (Session::has('authorization'))
        <div class="alert alert-danger">
            {{ Session::get('authorization') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="container">
        	@if ($paradigm_id != 7 && $paradigm_id != 9)
            <div class="mt-2">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Tìm kiếm</legend>
                    <form action="{{route('get.paradigms.collect')}}" method="GET">
                    	@method('GET')
                    	@csrf
                    	@include('admins.paradigms.layouts.search-collect')
                    </form>
                </fieldset>
            </div>
            @elseif ($paradigm_id == 7 || $paradigm_id == 9)

            @include('admins.paradigms.layouts.infor-collect')

            @endif
            @if(isset($householdInformations))
			@if ($householdInformations !== null && count($householdInformations) > 1 && $householdInformation == null)
            <div class="mt-3">
                <i class="fa-solid fa-paper-plane" style="color: #868686;"></i>
                <span class="text-uppercase" style="color: #868686; font-weight: 500;">Danh sách Hộ dân</span>
            </div>
            <div class="">
            	<div class="mt-2 table-wrapper overflow-auto">
				    <table class="table table-hover table-dark table-bordered table-striped mb-1">
				        <thead>
				            <th scope="col" class="text-center">STT</th>
				            <th scope="col" class="">Hộ dân</th>
				            <th scope="col" class="text-center">Hiện trạng hợp đồng</th>
				            <th scope="col" class="text-center">Thao tác</th>
				        </thead>
				        <tbody>
			                @foreach ($householdInformations as $key => $household)
			                    <tr>
			                        <td scope="row" class="text-center">{{ $key + 1 }}</td>
			                      
			                        <td scope="row" class="text-center">{{$household->fullname}}</td>
			                        <td scope="row" class="">{{$household->household_status->title ?? ''}}</td>
			                        <td scope="row" class="text-center">
			                        	<form action="{{route('get.paradigms.collect')}}" method="GET">
			                        		@method('GET')
			                        		@csrf
			                        		<input type="text" name="apartment_id" value="{{$params['apartment_id'] ?? 0}}" hidden>
			                        		<input type="text" name="room_id" value="{{$params['room_id'] ?? ''}}" hidden>
			                        		<input type="text" name="fullname" value="{{$params['fullname'] ?? ''}}" hidden>
                                    		<input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
                                    		<input type="text" name="household_information_id" value="{{$household->id}}" hidden>
                                    		<input type="text" name="district_id" value="{{$household->district_id ?? 0}}" hidden>
			                        		<input type="text" name="ward_id" value="{{$household->ward_id ?? ''}}" hidden>
											<input type="text" class="form-control" name="street" value="{{$params['street'] ?? ''}}" placeholder="Nguyễn Công Hoan" hidden>
											<input type="text" data-id="household_type" name="household_type" value="{{$household_type ?? 0}}" hidden>
			                        		<input type="text" class="form-control" name="apartment_number" value="{{$params['apartment_number'] ?? ''}}" placeholder="K111/12" hidden>
			                        		<button type="submit" class="btn btn-secondary">Thu tiền</button>
			                        	</form>
			                        </td>
			                    </tr>  
			                @endforeach
				        </tbody>
				    </table>
				</div>
            </div>
            @elseif ($householdInformations !== null && count($householdInformations) == 1 || $householdInformation)

            @if (count($householdInformations) == 1)
            @foreach ($householdInformations as $key => $householdInformation)
            @include('admins.paradigms.layouts.infor-collect')
            @endforeach
            @else
            @include('admins.paradigms.layouts.infor-collect')
            @endif
            @else
            @if ($paradigm_id != 7 && $paradigm_id != 9)
            <div class="row mt-4">
            	<div class="col-lg-12 text-center">
            		<h4 class="badge badge-danger text-center">Không có dữ liệu căn hộ</h4>
            	</div>
            </div>
            @endif
            @endif
			@endif

			
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {

    	$('.select').select2({
            placeholder: '‎',
            allowClear: true,
        });

    	getInputCollect(1);

    });

    function getInputCollect(id) {

    	var input_price_transfer = $('#input_price_transfer');

    	var input_price_cash = $('#input_price_cash');

    	let price_transfer = $('#price_transfer').val('');

    	let price_cash = $('#price_cash').val('');

    	let label_sum_price = $('#label_sum_price').text('0');

    	let label_sum_word = $('#label_sum_word').text('Không');

    	if (id == 1) {

    		input_price_cash.css('display', 'block');
    		$('#price_cash').removeAttr('disabled');

    		input_price_transfer.css('display', 'none');
    		$('#price_transfer').attr('disabled', 'true');

    	}
    	else if (id == 2) {

    		input_price_cash.css('display', 'none');
    		$('#price_cash').attr('disabled', 'true');

    		input_price_transfer.css('display', 'block');
    		$('#price_transfer').removeAttr('disabled');


    	}
    	else {

    		input_price_cash.css('display', 'block');
    		$('#price_cash').removeAttr('disabled');

    		input_price_transfer.css('display', 'block');
    		$('#price_transfer').removeAttr('disabled');

    	}

    }

    function sumPriceCollect() {

    	let price_transfer = $('#price_transfer').val();

    	let price_cash = $('#price_cash').val();

    	if (price_cash == '' ) {

    		price_cash = 0;

    	}

    	if (price_transfer == '' ) {

    		price_transfer = 0;

    	}

    	let label_sum_price = $('#label_sum_price');

    	let label_sum_word = $('#label_sum_word');

    	let sum_price = parseFloat(price_transfer) + parseFloat(price_cash);

    	if (sum_price > 0) {

    		label_sum_price.text(new Intl.NumberFormat().format(sum_price));

    		$.ajax({
	            type: 'GET',

	            data: {
	                'sum_price': sum_price,
	            },

	            url: '{{route('convert.number.to.string')}}',

	            success: function (data) {

	                label_sum_word.text(data);

	            },
	            error: function (error) {

	            }
	        });

    	}
    	else
    	{
    		label_sum_price.text(0);
    		label_sum_word.text('Không');
    	}
    }

    function getWard() {

        let select_ward = $('#select-ward');

        let select_district = $('#select-district').val();


        $.ajax({
            type: 'GET',

            data: {
                'id' : select_district
            },

            url: '{{route('paradigms.ward.list','id')}}',

            success: function (data) {

                $('#select-ward').html(data);


            },
            error: function (error) {

            }
        });

    }

    function getRoom() {

        let select_room = $('#select-room');
        let apartment_id = $('#select-apartment').val();
        let paradigmId = $('input[data-id="paradigm_id"]').val();

        $.ajax({
            type: 'GET',

            data: {
                'id' : apartment_id,
                'paradigm_id' : paradigmId,
            },

            url: '{{route('paradigms.room.list','apartment_id')}}',

            success: function (data) {
            	$('#select-room').html(data);
            },
            error: function (error) {

            }
        });

    }

    
</script>
@include('admins.layouts.success')
@include('admins.layouts.error')
@endsection
