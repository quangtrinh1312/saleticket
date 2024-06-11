@extends('admins.layouts.master')

@section('title')
    Thống kê
@endsection

@section('style')
<style>

label {
    margin: 0;
    padding: 0;
}

.input-box {
    width: 231px;
    padding-left: .5rem;
}

.form-input {
    width: 100%;
    height: 31px;
    /* background: rgb(246, 246, 246);
    border: 1px solid #00000033; */
    border-radius: 0;
    padding: 0 0 0 .5rem;
}

.btn-submit {
    border-radius: 0 !important;
    width: 223px;
    padding: 3px 0;
}

table th,
table td {
    text-align: center;
    white-space: nowrap;
}

table th {
    position: sticky;
}


    @media only screen and (min-width: 62em) and (max-width: 74.9375em) {
        .input-box {
            width: 200px;
        }
    }

    @media only screen and (max-width: 61.89em) {
        .input-box {
            flex: 1;
        }

        .label-box {
            width: 150px;
        }
    }


</style>
@endsection

@section('content')

@include('admins.layouts.header')

<div class="container-fluid content" style="flex:1;">
    <div class="container shadow mt-4 bg-white">
        <div class="row bg-primary text-light p-1">
            <span>Tìm kiếm</span>
        </div>
    
        <form action="{{ route('get.ticker.stat', ['username' => Str::slug(Auth::user()->name, '-') ?? '']) }}" method="POST" class="py-3">
        @csrf
        <div class="row d-flex">
            <div class="px-3">
                <select name="swap_stat" id="swap_stat" class="w-100 form-control form-input mbl_ticket_infor">
                    <option value="1" @if(isset($params['swap_stat']) && $params['swap_stat'] == 1) @endif>Thống kê chung</option>
                    <option value="2" @if(isset($params['swap_stat']) && $params['swap_stat'] == 2) {{"selected"}} @endif>Thống kê theo thời gian</option>
                </select>
            </div>
            <div class="px-2 mr-3 d-none d-flex stat_common">
                <div class="row">    
                    <div class="input-box">
                        <select name="time" id="time" class="w-100 form-control form-input mbl_ticket_infor">
                            <option value="1" @if(isset($params['time']) && $params['time'] == 1) {{"selected"}} @endif>Ngày {{\Carbon\Carbon::now()->format('d-m-Y')}}</option>
                            <option value="2" @if(isset($params['time']) && $params['time'] == 2) {{"selected"}} @endif>7 ngày gần nhất</option>
                            <option value="3" @if(isset($params['time']) && $params['time'] == 3) {{"selected"}} @endif>Tháng {{\Carbon\Carbon::now()->format('m')}}</option>
                            <option value="4" @if(isset($params['time']) && $params['time'] == 4) {{"selected"}} @endif>QUÍ 1</option>
                            <option value="5" @if(isset($params['time']) && $params['time'] == 5) {{"selected"}} @endif>QUÍ 2</option>
                            <option value="6" @if(isset($params['time']) && $params['time'] == 6) {{"selected"}} @endif>QUÍ 3</option>
                            <option value="7" @if(isset($params['time']) && $params['time'] == 7) {{"selected"}} @endif>QUÍ 4</option>
                            <option value="8" @if(isset($params['time']) && $params['time'] == 8) {{"selected"}} @endif>Năm {{\Carbon\Carbon::now()->format('Y')}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="px-2 d-none d-flex stat_common">
                <div class="row justify-content-between">
                    <div class="d-flex align-items-center label-box">
                        <label>Nhân viên:</label>
                    </div>
                    <div class="input-box">
                        <select name="user_id" id="user_id" class="w-100 form-control form-input mbl_ticket_infor">
                            <option value="">-- Tất cả --</option>
                            @foreach ($staffs as $staff)
                            <option value="{{ $staff->id }}" @if(isset($params['user_id']) && $params['user_id'] == $staff->id) {{"selected"}} @endif>{{ $staff->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-2 d-none flex-column flex-lg-row justify-content-between" id="stat_time">
            <div class="px-3 mt-2">
                <div class="row d-flex justify-content-between">
                    <div class="d-flex align-items-center label-box">
                        <label>Từ ngày:</label>
                    </div>
                    <div class="input-box">
                        <input type="date" name="from_date" id="from_date" value="{{isset($params['from_date']) ? $params['from_date'] : ''}}" class="w-100 form-control form-input mbl_ticket_infor">
                    </div>
                </div>
                <div class="row mt-2 d-flex justify-content-between">
                    <div class="d-flex align-items-center label-box">
                        <label>Từ giờ:</label>
                    </div>
                    <div class="input-box">
                        <div class="row">
                            <div class="col-6">
                                <select name="from_time_hour" id="from_time_hour" class="w-100 form-control form-input mbl_ticket_infor">
                                    <option></option>
                                    @for ($i = 0; $i < 24; $i++)
                                    <option value="{{ $i }}" @if(isset($params['from_time_hour']) && $params['from_time_hour'] == $i) {{"selected"}} @endif>{{ $i }} giờ</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="from_time_minute" id="from_time_minute" class="w-100 form-control form-input mbl_ticket_infor">
                                    <option></option>
                                    @for ($i = 0; $i < 60; $i++)
                                    <option value="{{ $i }}" @if(isset($params['from_time_minute']) && $params['from_time_minute'] == $i) {{"selected"}} @endif>{{ $i }} phút</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 mt-2">
                <div class="row d-flex justify-content-between">
                    <div class="d-flex align-items-center label-box">
                        <label>Đến ngày:</label>
                    </div>
                    <div class="input-box">
                        <input type="date" name="to_date" value="{{isset($params['to_date']) ? $params['to_date'] : ''}}" id="to_date" class="w-100 form-control form-input mbl_ticket_infor">
                    </div>
                </div>
                <div class="row mt-2 d-flex justify-content-between">
                    <div class="d-flex align-items-center label-box">
                        <label>Đến giờ:</label>
                    </div>
                    <div class="input-box">
                        <div class="row">
                            <div class="col-6">
                                <select name="to_time_hour" id="to_time_hour" class="w-100 form-control form-input mbl_ticket_infor">
                                    <option></option>
                                    @for ($i = 0; $i < 24; $i++)
                                    <option value="{{ $i }}" @if(isset($params['to_time_hour']) && $params['to_time_hour'] == $i) {{"selected"}} @endif">{{ $i }} giờ</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="to_time_minute" id="to_time_minute" class="w-100 form-control form-input mbl_ticket_infor">
                                    <option></option>
                                    @for ($i = 0; $i < 60; $i++)
                                    <option value="{{ $i }}" @if(isset($params['to_time_minute']) && $params['to_time_minute'] == $i) {{"selected"}} @endif">{{ $i }} phút</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-2 mt-2">
                <div class="row d-flex justify-content-between">
                    <div class="d-flex align-items-center label-box">
                        <label>Nhân viên:</label>
                    </div>
                    <div class="input-box">
                        <select name="user_id" id="user_id" class="w-100 form-control form-input mbl_ticket_infor">
                            <option value="">-- Tất cả --</option>
                            @foreach ($staffs as $staff)
                            <option value="{{ $staff->id }}" @if(isset($params['user_id']) && $params['user_id'] == $staff->id) {{"selected"}} @endif>{{ $staff->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-sm btn-primary btn-submit text-uppercase">Tìm kiếm</button>
            </div>
        </div>
        </form>
    </div>
    <div class="container shadow mt-4 bg-white">
        <div class=" text-drak p-1">
            <H4>Tổng vé: <font style="color: red">{{$sum_number ?? 0}}</font> - Tổng tiền: <font style="color: red">{{number_format($sum_price, 0, ',', '.')}} đ</font></H4>
            @if (isset($total_ticket_type) && count($total_ticket_type) > 0)
            @foreach($total_ticket_type as $key => $value_)
            <h5>{{$value_->prod_name}}: {{$value_->number}}</h5>
            @endforeach
            @endif
        </div>
    </div>
    <div class="container shadow mt-4 pb-5 bg-white">
        <div class="row bg-primary text-light p-1">
            <span>Danh sách thống kê</span>
        </div>
        <!-- <div class="col-6 d-flex justify-content-start">
            <button type="button" class="btn btn-sm btn-secondary text-uppercase">Xuất Excel</button>
        </div> -->
        <div class="container-fluid px-3" id="list_ticket_table">
            @include('admins.tickets.stat.pagination')
        </div>
    </div>
</div>

@include('admins.layouts.footer')
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script>
    $( document ).ready(function() {
        typeTime();
    });
    function typeTime() {
        let type = $('#swap_stat').val();

        if (type != 1) {
            addClassTypeTime();
        }
    }
    $('#swap_stat').on('change', function() {
        addClassTypeTime();
    });

    function addClassTypeTime() {
        $('.stat_common').toggleClass('d-flex');
        $('#stat_time').toggleClass('d-flex');
    }
</script>
@endsection
