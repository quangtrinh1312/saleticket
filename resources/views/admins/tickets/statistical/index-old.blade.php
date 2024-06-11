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
    background: rgb(246, 246, 246);
    border: 1px solid #00000033;
    padding-left: .5rem;
}

.btn {
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
<div class="content">
    <div class="card mb-3">
        <div class="container mb-2">
            <div class="row">
                <div class="col-6 d-flex">
                    <div class="col-3 mt-2 text-center text-uppercase p-1 bg-primary text-light" style="width: 130px; border-radius: 5px 5px 0 0;">
                        <a href="#" class="text-light">Thống kê</a>
                    </div>
                </div>
            </div>
            <form action="{{route('get.ticker.statistical', ['username' => Str::slug($config->name, '-') ?? ''])}}" method="GET">
            @method('GET')
            @csrf
            <div class="d-flex" id="mbl_ticket_box">
                <div class="col-12 pl-0" id="mbl_ticket_sell_box">
                    <div class="p-1 pl-2 bg-primary text-light mbl_ttbv" style="border-radius: 0 5px 0 0;">Thông tin bán vé</div>
                    <div class="ml-3 row" id="_1">
                        <div class="mt-1 col-6">
                            <div class="row">
                                <div class="col-3">
                                    <p class="mb-0">Thời gian:</p>
                                </div>
                                <div class="col-9">
                                    <select name="time" class="w-100 form-control form-control-sm mbl_ticket_time selects" onchange="getInputTime()">
                                        <option value="1" {{isset($params['time']) ? $params['time'] == 1 ? 'selected' : '' : ''}}>Tùy chọn thời gian</option>
                                        <option value="2" {{isset($params['time']) ? $params['time'] == 2 ? 'selected' : '' : ''}}>Mốc thời gian</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 col-6">
                            <div class="row">
                                <div class="col-3">
                                    <p class="mb-0">Nhân viên:</p>
                                </div>
                                <div class="col-9">
                                    <select name="user_id" id="select-user" class="custom-select select">
                                    <option value=""></option>
                                    @if ($users && count($users) > 0)
                                        @foreach ($users as $user)
                                            <option class="option_user" value="{{$user->id}}" {{isset($params['user_id']) ? $params['user_id'] == $user->id ? 'selected' : '' : ''}}>{{$user->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 col-6 time_1">
                            <div class="row">
                                <div class="col-3">
                                    <p class="mb-0">Từ ngày:</p>
                                </div>
                                <div class="col-9">
                                    <input type="date" name="date_start" value="{{$params['date_start'] ?? ''}}" id="" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 col-6 time_1">
                            <div class="row">
                                <div class="col-3">
                                    <p class="mb-0">Đến ngày:</p>
                                </div>
                                <div class="col-9">
                                    <input type="date" name="date_end" value="{{$params['date_end'] ?? Carbon\Carbon::now()->format('Y-m-d')}}" id="" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 col-6 time_2" style="display:none;">
                            <div class="row">
                                <div class="col-3">
                                    <p class="mb-0">Mốc thời gian:</p>
                                </div>
                                <div class="col-9">
                                    <select class="w-100 form-control form-control-sm selects mbl_ticket_time2" name="time2" onchange="getInputTime2Item()">
                                        <option value="1" {{isset($params['time2']) ? $params['time2'] == 1 ? 'selected' : '' : ''}}>Quý</option>
                                        <option value="2" {{isset($params['time2']) ? $params['time2'] == 2 ? 'selected' : '' : ''}}>Tháng</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 col-6 time2_1_item" style="display: none;">
                            <div class="row">
                                <div class="col-3">
                                    <p class="mb-0">Quý:</p>
                                </div>
                                <div class="col-9">
                                    <select class="w-100 form-control form-control-sm selects time2_1_item" name="time2_1_item" >
                                        <option value="1" {{isset($params['time2_1_item']) ? $params['time2_1_item'] == 1 ? 'selected' : '' : ''}}>I</option>
                                        <option value="2" {{isset($params['time2_1_item']) ? $params['time2_1_item'] == 2 ? 'selected' : '' : ''}}>II</option>
                                        <option value="3" {{isset($params['time2_1_item']) ? $params['time2_1_item'] == 3 ? 'selected' : '' : ''}}>III</option>
                                        <option value="4" {{isset($params['time2_1_item']) ? $params['time2_1_item'] == 4 ? 'selected' : '' : ''}}>IV</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 col-6 time2_2_item" style="display: none;">
                            <div class="row">
                                <div class="col-3">
                                    <p class="mb-0">Tháng:</p>
                                </div>
                                <div class="col-9">
                                    <select class="w-100 form-control form-control-sm selects" name="time2_2_item" >
                                        <option value="1" {{isset($params['time2_2_item']) ? $params['time2_2_item'] == 1 ? 'selected' : '' : ''}}>1</option>
                                        <option value="2" {{isset($params['time2_2_item']) ? $params['time2_2_item'] == 2 ? 'selected' : '' : ''}}>2</option>
                                        <option value="3" {{isset($params['time2_2_item']) ? $params['time2_2_item'] == 3 ? 'selected' : '' : ''}}>3</option>
                                        <option value="4" {{isset($params['time2_2_item']) ? $params['time2_2_item'] == 4 ? 'selected' : '' : ''}}>4</option>
                                        <option value="5" {{isset($params['time2_2_item']) ? $params['time2_2_item'] == 5 ? 'selected' : '' : ''}}>5</option>
                                        <option value="6" {{isset($params['time2_2_item']) ? $params['time2_2_item'] == 6 ? 'selected' : '' : ''}}>6</option>
                                        <option value="7" {{isset($params['time2_2_item']) ? $params['time2_2_item'] == 7 ? 'selected' : '' : ''}}>7</option>
                                        <option value="8" {{isset($params['time2_2_item']) ? $params['time2_2_item'] == 8 ? 'selected' : '' : ''}}>8</option>
                                        <option value="9" {{isset($params['time2_2_item']) ? $params['time2_2_item'] == 9 ? 'selected' : '' : ''}}>9</option>
                                        <option value="10" {{isset($params['time2_2_item']) ? $params['time2_2_item'] == 10 ? 'selected' : '' : ''}}>10</option>
                                        <option value="11" {{isset($params['time2_2_item']) ? $params['time2_2_item'] == 11 ? 'selected' : '' : ''}}>11</option>
                                        <option value="12" {{isset($params['time2_2_item']) ? $params['time2_2_item'] == 12 ? 'selected' : '' : ''}}>12</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-1 col-6">
                            <div class="row">
                                <div class="col-3">
                                    <input type="submit" class="form-control btn btn-primary" value="Tìm kiếm" name="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

        <div class="container mb-3">
            <div class="mt-3">
                <div class="p-1 pl-2 bg-primary text-light" style="border-radius: 5px 5px 0 0;">
                    <span>Danh sách bán vé</span>
                </div>
                <div id="list_ticket_table">
                    @include('admins.tickets.statistical.pagination')
                </div>
            </div>
        </div>
        <!-- @include('admins.layouts.footer') -->
    </div>
</div>
@include('admins.layouts.footer')
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
