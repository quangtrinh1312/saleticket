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

    <div class="container-fluid" style="flex:1;">

        <div class="container shadow mt-4">
            <div class="row bg-primary text-light p-1">
                <span>Tìm kiếm</span>
            </div>

            <form action="!#" class="py-3">

            <div class="row px-2 d-flex flex-column flex-lg-row justify-content-between">

                <div class="px-3 mt-2">
                    <div class="row d-flex justify-content-between">
                        <div class="d-flex align-items-center label-box">
                            <label>Từ ngày</label>
                        </div>
                        <div class="input-box">
                            <input type="text" class="form-input">
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-between">
                        <div class="d-flex align-items-center label-box">
                            <label>Từ giờ</label>
                        </div>
                        <div class="input-box">
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-input">
                                        <option value="0">0 giờ</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-input">
                                        <option value="0">0 phút</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-3 mt-2">
                    <div class="row d-flex justify-content-between">
                        <div class="d-flex align-items-center label-box">
                            <label>Đến ngày</label>
                        </div>
                        <div class="input-box">
                            <input type="text" class="form-input">
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-between">
                        <div class="d-flex align-items-center label-box">
                            <label>Đến giờ</label>
                        </div>
                        <div class="input-box">
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-input">
                                        <option value="0">0 giờ</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-input">
                                        <option value="0">0 phút</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-3 mt-2">
                    <div class="row d-flex justify-content-between">
                        <div class="d-flex align-items-center label-box">
                            <label>Trạng thái hóa đơn</label>
                        </div>
                        <div class="input-box">
                            <select class="form-input">
                                <option value="0">-- Chọn trạng thái --</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-between">
                        <div class="d-flex align-items-center label-box">
                            <label>Ký hiệu</label>
                        </div>
                        <div class="input-box">
                            <select class="form-input">
                                <option value="0">Tất cả</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6 d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary text-uppercase">Tìm kiếm</button>
                </div>
                <div class="col-6 d-flex justify-content-start">
                    <button type="button" class="btn btn-sm btn-secondary text-uppercase">Xuất Excel</button>
                </div>
            </div>

            </form>
        </div>

        <div class="container shadow pb-5 mt-5">
            <div class="row bg-primary text-light p-1">
                <span>Thống kê</span>
            </div>

            <div class="container-fluid px-3">
                <div class="row mt-3">
                    <div>
                        <select class="form-input px-2">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="container-fluid p-0" style="max-height:450px;overflow-y:scroll">
                        <table class="table table-sm table-bordered table-hover table-dark table-striped mb-1">
                            <thead>
                                <th scope="col" class="text-center">STT</th>
                                <th scope="col" class="text-center">Loại vé</th>
                                <th scope="col" class="text-center">Số lượng</th>
                                <th scope="col" class="text-center">Đơn giá</th>
                                <th scope="col" class="text-center">Thành tiền</th>
                                <th scope="col" class="text-center"></th>
                            </thead>
                            <tbody id="list_ticket_table_data">
                                <tr>
                                    <td scope="row" class="text-center">1</td>
                                    <td scope="row" class="text-center text-uppercase">Vé xe đạp</td>
                                    <td scope="row" class="text-center">5</td>
                                    <td scope="row" class="text-center">2.000 VND</td>
                                    <td scope="row" class="text-center">10.000 VND</td>
                                    <td scope="row" class="text-center"></td>
                                </tr>
                                <tr>
                                    <td scope="row" class="text-center">2</td>
                                    <td scope="row" class="text-center text-uppercase">Vé xe máy</td>
                                    <td scope="row" class="text-center">20</td>
                                    <td scope="row" class="text-center">5.000 VND</td>
                                    <td scope="row" class="text-center">100.000 VND</td>
                                    <td scope="row" class="text-center"></td>
                                </tr>
                                <tr>
                                    <td scope="row" class="text-center">3</td>
                                    <td scope="row" class="text-center text-uppercase">Vé xe oto</td>
                                    <td scope="row" class="text-center">10</td>
                                    <td scope="row" class="text-center">20.000 VND</td>
                                    <td scope="row" class="text-center">200.000 VND</td>
                                    <td scope="row" class="text-center"></td>
                                </tr>
                                <tr>
                                    <td scope="row" class="text-center">4</td>
                                    <td scope="row" class="text-center text-uppercase">Vé đi bộ</td>
                                    <td scope="row" class="text-center">30</td>
                                    <td scope="row" class="text-center">1.000 VND</td>
                                    <td scope="row" class="text-center">30.000 VND</td>
                                    <td scope="row" class="text-center"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="w-100 px-3 d-flex justify-content-between">
                        <span style="font-size: 15px;"><strong>Hiển thị 1 - 4 / Tổng 4</strong></span>
                        <span style="font-size: 15px;"><strong>Tổng tiền: 340.000 VND</strong></span>
                    </div>
                
                    {{-- <nav aria-label="Page navigation example" class="mbl_pagination">
                        <ul class="pagination justify-content-center">
                            
                        </ul>
                    </nav> --}}
                </div>
            </div>



        </div>

    </div>

    @include('admins.layouts.footer')

@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection