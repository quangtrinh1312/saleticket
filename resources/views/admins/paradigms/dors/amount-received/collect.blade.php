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
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Trang chủ</a>
                <a href="alpaca_advanced.html" class="breadcrumb-item">Kí túc xá</a>
                <a href="alpaca_advanced.html" class="breadcrumb-item active">Thu tiền</a>
                {{-- <span class="breadcrumb-item active">Trang 1</span> --}}
            </div>
            <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!--# /page header -->

<div class="content">
    <div class="card mb-4">
        <div class="container">
            <div class="mt-2">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Tìm kiếm</legend>
                    <form action="{{route('get.paradigms.dor.collect')}}" method="GET">
                    	@method('GET')
                    	@csrf
                    	<div class="row">
                    		<div class="col-lg-6">
                    			<div class="col-lg-12">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4">
	                                            <label for="" class=" col-form-label">Khu KTX</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <select name="dormitory_id" class="custom-select">
			                                        @if ($dors && count($dors) > 0)
			                                            @foreach ($dors as $dor)
			                                                <option class="option_dor" value="{{$dor->id}}" {{isset($params['dormitory_id']) ? $params['dormitory_id'] == $dor->id ? 'selected' : '' : ''}}>{{$dor->name}}</option>
			                                            @endforeach
			                                        @endif
			                                    </select>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                    		</div>
                    		<!-- <div class="col-lg-6">
                    			<div class="col-lg-12">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4 float-right">
                                            <label for="" class="col-form-label float-right">Loại tiền:</label>
                                        </div>
                                        <div class="col-8">
                                           	<select name="type_price_id" class="custom-select">
                                           		@if ($type_prices && count($type_prices) > 0)
		                                            @foreach ($type_prices as $type_price)
		                                                <option class="option_type_price" value="{{$type_price->id}}">{{$type_price->type}}</option>
		                                            @endforeach
		                                        @endif
                                           	</select>
                                        </div>
                                        </div>
	                                </div>
	                            </div>
                    		</div> -->
                    		<div class="col-lg-12 mb-2">
                    			<input type="text" name="url" value="" hidden>
                                <input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
                                <button type="submit" class="btn btn-success btn-sm float-right" id="">
                                    <i class="fa-solid fa-magnifying-glass mr-1"></i>
                                    Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
			@if($collect === 1)
            <div class="collect mt-3">
            	<fieldset class="scheduler-border embed-responsive overflow-auto">
                    <legend class="scheduler-border">Thông tin thu tiền</legend>
                    <form action="{{route('post.paradigms.dor.collect')}}" method="POST" >
                    	@csrf
                    	@method('POST')
                    	<div class="row">
                    		<div class="col-lg-6">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4">
	                                            <label for="" class=" col-form-label float-right">Khu KTX:</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <label for="" class=" col-form-label ">{{getNameDorByID($params['dormitory_id'])}}</label>
	                                        </div>
	                                    </div>
	                                </div>
                    		</div>

                    		<div class="col-lg-6">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4 float-right">
	                                            <label for="" class="col-form-label float-right">Người nộp:</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <input type="text" class="form-control" id="input_fullname" name="fullname" value="{{old('fullname')}}" required onkeyup="validateForm()" onchange="validateForm()">
	                                            @if ($errors->first('fullname'))
			                                        <span class="text-danger k-error">{{ $errors->first('fullname') }}</span>
			                                    @endif
			                                    <span class="text-danger k-error" id="message_fullname"></span>
	                                        </div>
	                                    </div>
	                                </div>
                    		</div>

                    		<div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4 float-right">
                                            <label for="" class="col-form-label float-right">Loại tiền:</label>
                                        </div>
                                        <div class="col-8">
                                           	<select name="type_price_id" class="custom-select">
                                           		@if ($type_prices && count($type_prices) > 0)
		                                            @foreach ($type_prices as $type_price)
		                                                <option class="option_type_price" value="{{$type_price->id}}">{{$type_price->type}}</option>
		                                            @endforeach
		                                        @endif
                                           	</select>
                                        </div>
                                    </div>
                                </div>
                    		</div>
                    		<div class="col-lg-6">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4 float-right">
	                                            <label for="" class="col-form-label float-right">Nội dung:</label>
	                                        </div>
	                                        <div class="col-8">
	                                           	<textarea type="text" class="form-control" name="content_bill_debt_month" required></textarea>
	                                        </div>
	                                    </div>
	                                </div>
                    		</div>
                    		<div class="col-lg-6">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4 float-right">
	                                            <label for="" class="col-form-label float-right">Hình thức thanh toán:</label>
	                                        </div>
	                                        <div class="col-8">
	                                           	<select name="pay_method_id" class="custom-select" onchange="getInputCollect(this.value)">
	                                           		
	                                           	
	                                           	@if ($payMethods && count($payMethods) > 0)
		                                            @foreach ($payMethods as $payMethod)
		                                                <option class="option_payMethod" value="{{$payMethod->id}}">{{$payMethod->title}}</option>
		                                            @endforeach
		                                        @endif
		                                        </select>
	                                        </div>
	                                    </div>
	                                </div>
                    		</div>
                    		<div class="col-lg-6" id="input_price_transfer">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4 float-right">
	                                            <label for="" class="col-form-label float-right">Chuyển khoản:</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <input type="number" min=1 class="form-control" name="price_transfer" id="price_transfer" value="" required onkeyup="sumPriceCollect()" onchange="sumPriceCollect()">
	                                        </div>
	                                    </div>
	                                </div>
                    		</div>

                    		<div class="col-lg-6" id="input_price_cash">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4 float-right">
	                                            <label for="" class="col-form-label float-right">Tiền mặt:</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <input type="number" min="1" class="form-control" name="price_cash" value="" id="price_cash" required onkeyup="sumPriceCollect()" onchange="sumPriceCollect()">
	                                        </div>
	                                    </div>
	                                </div>
                    		</div>

                    		<div class="col-lg-6">
	                                <div class="form-group">
	                                    <div class="row text-right">
	                                        <div class="col-12 float-right">
	                                            <label for="" class="col-form-label">Tổng tiền: <span id="label_sum_price">0</span> đồng</label>
	                                        </div>
	                                        <div class="col-12 float-right">
	                                            <label for="" class="col-form-label">Bằng chữ: <span id="label_sum_word">Năm trăm nghàn</span> đồng</label>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-12">
	                                        <input type="text" name="dormitory_id" value="{{$params['dormitory_id'] ?? 0}}" hidden>
			               					<input type="text" name="url" value="{{url()->full()}}" hidden>
			                        		<input type="text" name="url" value="" hidden>
                                    		<input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
	                                        <button type="submit" id="submit_collect" class="btn btn-primary float-right" disabled>Xác nhận thu tiền</button>
	                                        </div>
	                                    </div>
	                                </div>
                    		</div>
                        </div>
                    </form>
                </fieldset>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

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
</script>
@endsection
