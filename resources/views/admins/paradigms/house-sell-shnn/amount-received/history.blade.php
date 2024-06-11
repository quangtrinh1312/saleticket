@extends('admins.layouts.master')

@section('title')
    Lịch sử thu tiền
@endsection

@section('style')
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

        position: relative;
    }

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
                <a href="alpaca_advanced.html" class="breadcrumb-item active">Lịch sử thu tiền (Địa chỉ)</a>
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
                    <form action="{{route('get.paradigms.house.sell.shnn.history', ['paradigm_id' => 2])}}" method="GET">
                        @method('GET')
                        @csrf
                        <div class="row">

                            <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="row align-items-center">
                                            <div class="col-4">
                                                <label for="" class=" col-form-label float-right">Quận/huyện:</label>
                                            </div>
                                            <div class="col-8">
                                                <select name="district_id" id="district_id" onchange="getWard()" class="custom-select" >
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

                            <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="row align-items-center">
                                            <div class="col-4">
                                                <label for="" class=" col-form-label float-right">Phường/xã:</label>
                                            </div>
                                            <div class="col-8">
                                                <select name="ward_id" id="ward_id" class="custom-select">
                                                    <option value="">Tất cả</option>
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

                            <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="row align-items-center">
                                            <div class="col-4 float-right">
                                                <label for="" class="col-form-label float-right">Đường:</label>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" class="form-control" name="street" value="{{$params['street'] ?? ''}}" placeholder="Nguyễn Công Hoan">
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
                                                <input type="text" class="form-control" name="apartment_number" value="{{$params['apartment_number'] ?? ''}}" placeholder="K111/12">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="" class="float-right col-form-label">Loại tiền</label>
                                        </div>
                                        <div class="col-8">
                                            <select name="type_price_id" class="custom-select">
                                                <option value="">Tất cả</option>
                                                @if ($type_prices && count($type_prices) > 0)
                                                    @foreach ($type_prices as $type_price)
                                                        <option class="option_type_price" value="{{$type_price->id}}" {{isset($params['type_price_id']) ? $params['type_price_id'] == $type_price->id ? 'selected' : '' : ''}}>{{$type_price->type}}</option>
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
                                        <div class="col-4">
                                            <label for="" class="float-right col-form-label">Họ tên người nộp tiền</label>
                                        </div>
                                        <div class="col-8">
                                            <input list="" name="fullname" id="" value="{{$params['fullname'] ?? ''}}" class="form-control form-control-sm">
                                            <datalist id="">
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="" class="float-right col-form-label">Thu hộ QLV</label>
                                        </div>
                                        <div class="col-8">
                                            <select name="" class="form-control">
                                                <option value="">Tất cả</option>
                                                <option value="">Có</option>
                                                <option value="">Không</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="" class="float-right col-form-label">Số BL / Phiếu thu</label>
                                        </div>
                                        <div class="col-8">
                                            <input list="" name="number_bill_number" value="{{$params['number_bill_number'] ?? ''}}" id="" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="" class="float-right col-form-label">Đã nộp KT</label>
                                        </div>
                                        <div class="col-8">
                                            <select name="send_accountant" class="form-control">
                                                <option value="" {{isset($params['send_accountant']) ? $params['send_accountant'] == '' ? 'selected' : '' : ''}}>Tất cả</option>
                                                <option value="1" {{isset($params['send_accountant']) ? $params['send_accountant'] == 1 ? 'selected' : '' : ''}}>Đã nộp</option>
                                                <option value="0" {{isset($params['send_accountant']) ? $params['send_accountant'] == 0 ? 'selected' : '' : ''}}>Chưa nộp</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="" class="float-right col-form-label">Hóa đơn</label>
                                        </div>
                                        <div class="col-8">
                                            <select name="original_bill" class="form-control">
                                                <option value="" {{isset($params['original_bill']) ? $params['original_bill'] == '' ? 'selected' : '' : ''}}>Tất cả</option>
                                                <option value="1" {{isset($params['original_bill']) ? $params['original_bill'] == 1 ? 'selected' : '' : ''}}>Gốc</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="" class="float-right col-form-label">Thu tiền</label>
                                        </div>
                                        <div class="col-8">
                                            <select name="type_paid" class="form-control">
                                                <option value="" {{isset($params['type_paid']) ? $params['type_paid'] == '' ? 'selected' : '' : ''}}>Tất cả</option>
                                                <option value="1" {{isset($params['type_paid']) ? $params['type_paid'] == 1 ? 'selected' : '' : ''}}>Đã thu</option>
                                                <option value="2" {{isset($params['type_paid']) ? $params['type_paid'] == 2 ? 'selected' : '' : ''}}>Đã thu hộ</option>
                                                <option value="3" {{isset($params['type_paid']) ? $params['type_paid'] == 3 ? 'selected' : '' : ''}}>Được thu hộ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="" class="float-right col-form-label">Từ ngày</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="date" name="date_start" id="" value="{{$params['date_start'] ?? ''}}" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="" class="float-right col-form-label">Đến ngày</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="date" name="date_end" value="{{$params['date_end'] ?? ''}}" id="" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="" class="float-right col-form-label">Mã BL / Phiếu thu</label>
                                        </div>
                                        <div class="col-8">
                                            <input list="" name="number_bill_string" id="" class="form-control form-control-sm" value="{{$params['number_bill_string'] ?? ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <label for="" class="float-right col-form-label">Trạng thái</label>
                                        </div>
                                        <div class="col-8">
                                            <select name="status" class="custom-select">
                                                <option value="" {{isset($params['status']) ? $params['status'] == '' ? 'selected' : '' : ''}}>Tất cả</option>
                                                <option value="0" {{isset($params['status']) ? $params['status'] == 0 ? 'selected' : '' : ''}}>Đã phát hành PT/BL/HĐ</option>
                                                <option value="1" {{isset($params['status']) ? $params['status'] == 1 ? 'selected' : '' : ''}}>Điều chỉnh PT/BL/HĐ</option>
                                                <option value="2" {{isset($params['status']) ? $params['status'] == 2 ? 'selected' : '' : ''}}>Xóa bỏ PT/BL/HĐ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            
                                        </div>
                                        <div class="col-8">
                                            <input type="text" name="url" value="" hidden>
                                            <input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
                                            <input type="text" name="household_type" value="2" hidden>
                                            <button type="submit" class="btn btn-success btn-sm" id="">
                                                <i class="fa-solid fa-magnifying-glass mr-1"></i>
                                                Tìm kiếm
                                            </button>
                                            <button type="button" onclick="resetValueForm()" class="btn btn-warning btn-sm" id="">
                                                <i class="fa-solid fa-rotate mr-1"></i>
                                                Làm mới
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>

            <div class="mt-3">
                {{-- <i class="fa-solid fa-paper-plane" style="color: #868686;"></i>
                <span class="text-uppercase" style="color: #868686; font-weight: 500;">Danh sách thu tiền</span> --}}
                <h3 class="m-0 text-center font-weight-bold text-uppercase">Lịch sử thu tiền</h3>
            </div>

            <div class="mt-2">
                <a href="{{ route('get.paradigms.export.excel', ['paradigm_id' => 4, 'params' => $params, 'household_type' => 2]) }}" class="btn btn-success btn-sm">
                    <i class="fa-solid fa-file-excel mr-1"></i>
                    Xuất file Excel
                </a>
            </div>

            <!-- <div class="mt-1 row">
                <div class="col-lg-12">
                    <a href="" class="btn btn-success"><i class="icon-file-excel"></i> Xuất Excel</a>
                </div>
            </div> -->

            <div id="">
                <div class="mt-2 table-wrapper">
                    <table class="table table-hover table-dark table-striped mb-1 table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px !important;">STT</th>
                                <th scope="col" class="text-center" style="width: 170px !important;">Địa chi</th>
                                <th scope="col" class="text-center" style="width: 220px !important;">Họ tên người nộp tiền</th>
                                <th scope="col" class="text-center" style="width: 130px !important;">Mã - Số BL/HĐ <br>Phiếu thu <br> (Điều chỉnh)</th>
                                <th scope="col" class="text-center" style="width: 130px !important;">Trạng thái</th>
                                <th scope="col" class="text-center" style="width: 150px !important;">Ngày tháng</th>
                                <th scope="col" class="text-center" style="width: 150px !important;">Loại tiền</th>
                                <th scope="col" class="text-center" style="width: 250px !important;">Nội dung</th>
                                <th scope="col" class="text-center" style="width: 250px !important;">Nội dung truy thu/bổ sung</th>
                                <th scope="col" class="text-center" style="width: 150px !important;">Tổng số tiền thu</th>
                                <th scope="col" class="text-center" style="width: 150px !important;">Tiền mặt</th>
                                <th scope="col" class="text-center" style="width: 150px !important;">Chuyển khoản</th>
                                <th scope="col" class="text-center" style="width: 200px !important;">Thu hộ</th>
                                <th scope="col" class="text-center" style="width: 150px !important;">Đã nộp tiền KT</th>
                                <th scope="col" class="text-center" style="width: 150px !important;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="list_accountant_table_data">
                            @if($amountReceived_1_s && count($amountReceived_1_s) > 0)
                            @php($sn = ($amountReceived_1_s->perPage() * ($amountReceived_1_s->currentPage() - 1)) + 1)
                            @foreach ($amountReceived_1_s as $key => $amountReceived_1_)
                            <tr id="r_id_">
                                <td scope="row" class="text-center">{{$sn ++}}</td>
                                <td scope="row">{{$amountReceived_1_->apartment_number}} {{$amountReceived_1_->street}}, {{$amountReceived_1_->ward->name}}, {{$amountReceived_1_->district->name}}</td>
                                <td scope="row">{{$amountReceived_1_->fullname}}</td>
                                <td scope="row" class="text-center">{{$amountReceived_1_->number_bill_string}} - {{$amountReceived_1_->number_bill_number}} <br>
                                {{$amountReceived_1_->parent_id != 0 ? '('.$amountReceived_1_->parent->number_bill_string.' - '.$amountReceived_1_->parent->number_bill_number.')' : ''}}
                                </td>
                                <td scope="row" class="text-center">
                                    @if ($amountReceived_1_->status == 0)
                                        Phát hành PT/BL/HĐ
                                    @elseif ($amountReceived_1_->status == 1)
                                        Điều chỉnh PT/BL/HĐ
                                    @else
                                        Xóa bỏ PT/BL/HĐ
                                    @endif

                                </td>
                                <td scope="row">{{$amountReceived_1_->created_at}}</td>
                                <td scope="row">{{$amountReceived_1_->typy_price->type}}</td>
                                <td scope="row">{{$amountReceived_1_->content_bill_debt_month}}</td>
                                <td scope="row">{{$amountReceived_1_->content_bill_debt_additional_arrears}}</td>
                                <td scope="row" class="text-right">{{number_format($amountReceived_1_->sum_price_amount_received,0,',','.')}}</td>
                                <td scope="row" class="text-right">{{number_format($amountReceived_1_->price_cash,0,',','.')}}</td>
                                <td scope="row" class="text-right">{{number_format($amountReceived_1_->price_transfer,0,',','.')}}</td>
                                <td scope="row">{{$amountReceived_1_->account_for->fullname ?? ''}}</td>
                                <td scope="row" class="text-center">
                                    {{$amountReceived_1_->send_accountant == 1 ? 'Đã nộp' : ''}}
                                </td>
                                <td scope="row" class="text-center">
                                    <a onclick="getDetail('{{$paradigm_id}}', '{{$amountReceived_1_->id}}', '{{url()->full()}}')" class="badge badge-secondary" title="Chi tiết"><i class="far fa-eye"></i></a>
                                    @if ($amountReceived_1_->original_bill == 1 && $amountReceived_1_->status != 2)
                                    <a  class="badge badge-primary" id="btn_update_apartment" onclick="getApartment('{{$paradigm_id}}', '{{$amountReceived_1_->id}}', '{{url()->full()}}')" title="Điều chỉnh PT/HĐ/BL"><i class="icon-pencil" aria-hidden="true"></i></a>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="mt-2" id="links">
                    @if(isset($amountReceived_1_s))
                        <span style="font-size: 15px;"><strong>Hiển thị {{ $amountReceived_1_s->firstItem() }} - {{ $amountReceived_1_s->lastItem() }} / Tổng {{ $amountReceived_1_s->total() }}</strong></span>
                    
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                <!--                 <li class="page-item {{ $amountReceived_1_s->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a href="?page=1" class="page-link">Đầu trang</a>
                                </li> -->
                                @if (isset($amountReceived_1_s) && count($amountReceived_1_s) > 0)
                                    {!! $amountReceived_1_s->appends(Request::all())->links('helpers.paginate') !!}
                                @endif
                <!--                 <li class="page-item {{ $amountReceived_1_s->currentPage() == $amountReceived_1_s->lastPage() ? 'disabled' : '' }}">
                                    <a href="?page={{ $amountReceived_1_s->lastPage() }}" class="page-link">Cuối trang</a>
                                </li> -->
                            </ul>
                        </nav>
                    @endif
                </div>

            </div>



            {{-- Modal Thống kê --}}
            <div class="modal fade" id="modal_statistic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="max-width: 900px !important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thống kê chung</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mt-2 table-wrapper">
                                <table class="table table-hover table-dark table-striped table-bordered mb-1">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="max-width: 50px !important;">STT</th>
                                            <th scope="col" style="width: 250px !important;">Quản lý viên</th>
                                            <th scope="col" style="width: 170px !important;">Tiền mặt</th>
                                            <th scope="col" style="width: 170px !important;">Chuyển khoản</th>
                                            <th scope="col" style="width: 170px !important;">Tổng cộng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- điều chỉnh -->

            <div class="modal fade" id="modal_update_apartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_update" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel_update">Điều chỉnh</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="update_content_apartment">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chi tiết -->

            <div class="modal fade" id="modal_detail_apartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_detail" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel_detail">Thông tin chi tiết</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="detail_content_apartment">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).off('click', '#btn_statistic').on('click', '#btn_statistic', function(e) {
            e.preventDefault();
            $('#modal_statistic').modal('show');
        });
    });
</script>
<script type="">
    
    function getApartment(paradigm_id, id, url) {

        $('#modal_update_apartment').modal('show');

        let content_modal_update_apartment =  $('#update_content_apartment');

        $.ajax({
            type: 'GET',

            data: {
                'paradigm_id': paradigm_id,
                'id' : id,
                'url' : url
            },

            url: '{{route('paradigms-apartments.house.sell.shnn.collect.edit','id')}}',

            success: function (data) {

                content_modal_update_apartment.html(data);

            },
            error: function (error) {

            }
        });

    }

    function getDetail(paradigm_id, id, url) {

        $('#modal_detail_apartment').modal('show');

        let content_modal_detail_apartment =  $('#detail_content_apartment');

        $.ajax({
            type: 'GET',

            data: {
                'paradigm_id': paradigm_id,
                'id' : id,
                'url' : url
            },

            url: '{{route('paradigms-apartments.house.sell.shnn.collect.detail','id')}}',

            success: function (data) {

                content_modal_detail_apartment.html(data);

            },
            error: function (error) {

            }
        });

    }

    function getWard() {

        var select_ward = $('#ward_id');

        var select_district = $('#district_id').val();


        $.ajax({
            type: 'GET',

            data: {
                'id' : select_district
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
@include('admins.layouts.success')
@include('admins.layouts.error')
@endsection
