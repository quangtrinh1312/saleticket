@extends('admins.layouts.master')

@section('title')
   Hóa đơn
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
                        <a href="#" class="text-light">Hóa đơn</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('get.ticker.stat', ['username' => Str::slug(Auth::user()->name, '-') ?? '']) }}" method="POST">
            @method('POST')
            @csrf
            <div class="d-flex" id="mbl_ticket_box">
                <div class="col-12 pl-0" id="mbl_ticket_sell_box">
                    <div class="p-1 pl-2 bg-primary text-light mbl_ttbv" style="border-radius: 0 5px 0 0;">Tìm kiếm</div>
                    
                    <div class="ml-3" id="_1">
                        <div class="row mt-1">
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center">
                                        <p class="mb-0">Từ ngày:</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="date" name="from_date" id="from_date" class="w-100 form-control form-control-sm mbl_ticket_infor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center">
                                        <p class="mb-0">Đến ngày:</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="date" name="to_date" id="to_date" class="w-100 form-control form-control-sm mbl_ticket_infor">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center">
                                        <p class="mb-0">Trạng thái HĐ:</p>
                                    </div>
                                    <div class="col-8">
                                        <select name="status" id="status" class="w-100 form-control form-control-sm mbl_ticket_infor">
                                            <option value="">-- Chọn trạng thái --</option>
                                            @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center">
                                        <p class="mb-0">Từ giờ:</p>
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-6">
                                                <select name="from_time_hour" id="from_time_hour" class="w-100 form-control form-control-sm mbl_ticket_infor">
                                                    @for ($i = 0; $i < 24; $i++)
                                                    <option value="{{ $i }}">{{ $i }} giờ</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <select name="from_time_minute" id="from_time_minute" class="w-100 form-control form-control-sm mbl_ticket_infor">
                                                    @for ($i = 0; $i < 59; $i++)
                                                    <option value="{{ $i }}">{{ $i }} phút</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center">
                                        <p class="mb-0">Đến giờ:</p>
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-6">
                                                <select name="to_time_hour" id="to_time_hour" class="w-100 form-control form-control-sm mbl_ticket_infor">
                                                    @for ($i = 0; $i < 24; $i++)
                                                    <option value="{{ $i }}">{{ $i }} giờ</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <select name="to_time_minute" id="to_time_minute" class="w-100 form-control form-control-sm mbl_ticket_infor">
                                                    @for ($i = 0; $i < 59; $i++)
                                                    <option value="{{ $i }}">{{ $i }} phút</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center">
                                        <p class="mb-0">Ký hiệu:</p>
                                    </div>
                                    <div class="col-8">
                                        <select name="serial" id="serial" class="w-100 form-control form-control-sm mbl_ticket_infor">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-sm text-uppercase" id="btn_search">Tìm kiếm</button>
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
                    @include('admins.tickets.stat.pagination')
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
