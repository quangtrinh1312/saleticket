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
                <a href="alpaca_advanced.html" class="breadcrumb-item">Nhà bán thuộc SHNN</a>
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
                    <form action="{{route('get.paradigms.house.sell.shnn.collect')}}" method="GET">
                    	@method('GET')
                    	@csrf
                    	<div class="row">
                    		<div class="col-lg-6">
                    			<div class="col-lg-12">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4">
	                                            <label for="" class=" col-form-label">Quận/huyện</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <select name="district_id" onchange="getWard(this.value)" class="custom-select" >
	                                            	<option value="">Tất cả</option>
			                                        @if ($districts && count($districts) > 0)
			                                            @foreach ($districts as $district)
			                                                <option class="option_district" value="{{$district->id}}" {{isset($params['district_id']) ? $params['district_id'] == $district->id ? 'selected' : '' : ''}}>{{$district->name}}</option>
			                                            @endforeach
			                                        @endif
			                                    </select>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                    		</div>
                    		<div class="col-lg-6">
                    			<div class="col-lg-12">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4">
	                                            <label for="" class=" col-form-label">Phường/xã</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <select name="ward_id" id="ward_id" class="custom-select">
			                                        @if ($wards && count($wards) > 0)
			                                            @foreach ($wards as $ward)
			                                                <option class="option_ward" value="{{$ward->id}}" {{isset($params['ward_id']) ? $params['ward_id'] == $ward->id ? 'selected' : '' : ''}}>{{$ward->name}}</option>
			                                            @endforeach
			                                        @endif
			                                    </select>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                    		</div>

                    		<div class="col-lg-6">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4 float-right">
	                                            <label for="" class="col-form-label float-right">Đường:</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <input type="text" class="form-control" name="apartment_number" placeholder="Nguyễn Công Hoang" required>
	                                        </div>
	                                    </div>
	                                </div>
                    		</div>

                    		<div class="col-lg-6">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4 float-right">
	                                            <label for="" class="col-form-label float-right">Số nhà:</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <input type="text" class="form-control" name="street" placeholder="K111/12" required>
	                                        </div>
	                                    </div>
	                                </div>
                    		</div>
                    		<div class="col-lg-6">
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
                    		</div>
                    		<div class="col-lg-12 mb-2">
                    			<input type="text" name="url" value="{{url()->full()}}" hidden>
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
                    <form action="{{route('post.paradigms.other.amount.collect')}}" method="POST" >
                    	@csrf
                    	@method('POST')
                    	<div class="row">
                    		<div class="col-lg-6">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4">
	                                            <label for="" class=" col-form-label float-right">Quận/huyện:</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <label for="" class=" col-form-label ">{{getNameDistrictByID($params['district_id'])}}</label>
	                                        </div>
	                                    </div>
	                                </div>
                    		</div>

                    		<div class="col-lg-6">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4">
	                                            <label for="" class=" col-form-label float-right">Phường/xã:</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <label for="" class=" col-form-label ">{{getNameWardByID($params['ward_id'])}}</label>
	                                        </div>
	                                    </div>
	                                </div>
                    		</div>

                    		<div class="col-lg-6">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4 float-right">
	                                            <label for="" class="col-form-label float-right">Đường:</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <input type="text" class="form-control" name="apartment_number" placeholder="Nguyễn Công Hoang" required>
	                                        </div>
	                                    </div>
	                                </div>
                    		</div>

                    		<div class="col-lg-6">
	                                <div class="form-group">
	                                    <div class="row align-items-center">
	                                        <div class="col-4 float-right">
	                                            <label for="" class="col-form-label float-right">Số nhà:</label>
	                                        </div>
	                                        <div class="col-8">
	                                            <input type="text" class="form-control" name="street" placeholder="K111/12" required>
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
	                                            <input type="text" class="form-control" name="fullname" required>
	                                            @if ($errors->first('fullname'))
			                                        <span class="text-danger k-error">{{ $errors->first('fullname') }}</span>
			                                    @endif
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
                                           	<label for="" class=" col-form-label ">{{getNameTypePriceByID($params['type_price_id'])}}</label>
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
	                                            <input type="number" min=1 class="form-control" name="price_transfer" id="price_transfer" value="0" required onkeyup="sumPriceCollect()" onchange="sumPriceCollect()">
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
	                                            <input type="number" min="1" class="form-control" name="price_cash" value="0" id="price_cash" required onkeyup="sumPriceCollect()" onchange="sumPriceCollect()">
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
	                                        <input type="text" name="district_id" value="{{$params['district_id'] ?? 0}}" hidden>
	                                        <input type="text" name="ward_id" value="{{$params['ward_id'] ?? 0}}" hidden>
			                        		<input type="text" name="type_price_id" value="{{$params['type_price_id'] ?? 0}}" hidden>
			                        		<input type="text" name="url" value="{{url()->full()}}" hidden>
                                    		<input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
	                                            <button type="submit" class="btn btn-primary float-right">Xác nhận thu tiền</button>
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

    	let price_transfer = $('#price_transfer').val('0');

    	let price_cash = $('#price_cash').val('0');

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

    function getWard(id) {

        var select_ward = $('#ward_id');


        $.ajax({
            type: 'GET',

            data: {
                'id' : id
            },

            url: '{{route('paradigms.ward.list','id')}}',

            success: function (data) {

            	$('#ward_id').html(data);


            },
            error: function (error) {

            }
        });

    }
</script>
@endsection
