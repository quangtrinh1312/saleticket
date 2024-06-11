@extends('admins.layouts.master')

@section('title')
    Loại vé
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

.table-wrapper::-webkit-scrollbar {
    width: 0;
    height: .5rem;
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

            <div class="row px-2">

                <div class="col-lg-3 col-sm-6 col-12 mt-2">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center justify-content-sm-end p-sm-0">
                            <label>Tên loại vé</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-input">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-sm-6 col-12 mt-2">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center justify-content-sm-end p-sm-0">
                            <label>Giá vé</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-input">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-sm-6 col-12 mt-2">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center justify-content-sm-end p-sm-0">
                            <label>Mẫu số</label>
                        </div>
                        <div class="col-8">
                            <select class="form-input">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-sm-6 col-12 mt-2">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center justify-content-sm-end p-sm-0">
                            <label>Ký hiệu</label>
                        </div>
                        <div class="col-8">
                            <select class="form-input">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                

            </div>
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-sm btn-primary text-uppercase rounded-0" style="width:14rem;padding: 3px 0;">Tìm kiếm</button>
                </div>
            </div>

            </form>
        </div>

        <div class="container shadow pb-5 mt-5">
            <div class="row bg-primary text-light p-1">
                <span>Danh sách loại vé</span>
            </div>

            <div class="container-fluid px-3">
                <div class="row mt-3 d-flex justify-content-between">
                    <div>
                        <select class="form-input px-2">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                    </div>

                    <div>
                        <button type="button" class="btn btn-sm rounded-0 btn-primary text-uppercase" data-toggle="modal" data-target="#createTicketModal">
                            Thêm mới
                        </button>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="container-fluid p-0 table-wrapper" style="max-height:450px;overflow-y:scroll">
                        <table class="table table-sm table-bordered table-hover table-dark table-striped mb-1">
                            <thead>
                                <th scope="col" class="text-center">STT</th>
                                <th scope="col" class="text-center">Loại vé</th>
                                <th scope="col" class="text-center">Giá vé</th>
                                <th scope="col" class="text-center">Giá trước thuế</th>
                                <th scope="col" class="text-center">Sử dụng</th>
                                <th scope="col" class="text-center">Giờ kết thúc</th>
                                <th scope="col" class="text-center">Mẫu số</th>
                                <th scope="col" class="text-center">Ký hiệu</th>
                                <th scope="col" class="text-center">VAT</th>
                                <th scope="col" class="text-center">Kích hoạt</th>
                                <th scope="col" class="text-center">Thao tác</th>
                            </thead>
                            <tbody id="list_ticket_table_data">
                                <tr>
                                    <td scope="row" class="text-center">1</td>
                                    <td scope="row" class="text-center text-uppercase">Vé xe đạp</td>
                                    <td scope="row" class="text-center">2.000 VND</td>
                                    <td scope="row" class="text-center">2.000 VND</td>
                                    <td scope="row" class="text-center">Trong ngày</td>
                                    <td scope="row" class="text-center"></td>
                                    <td scope="row" class="text-center">5/001</td>
                                    <td scope="row" class="text-center">C23GAA</td>
                                    <td scope="row" class="text-center">Không chịu thuế</td>
                                    <td scope="row" class="text-center">
                                        <button type="button" class="btn btn-sm btn-success"><i class="fa-solid fa-check"></i></button>
                                    </td>
                                    <td scope="row" class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updateTicketModal"><i class="fa-solid fa-pen"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="w-100 px-3 d-flex justify-content-between">
                        <span style="font-size: 15px;"><strong>Hiển thị 1 - 4 / Tổng 4</strong></span>
                    </div>
                
                    {{-- <nav aria-label="Page navigation example" class="mbl_pagination">
                        <ul class="pagination justify-content-center">
                            
                        </ul>
                    </nav> --}}
                </div>
            </div>



        </div>

    </div>

    @include('admins.layouts.modals.create-ticket-modal')
    @include('admins.layouts.modals.update-ticket-modal')

    @include('admins.layouts.footer')

@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection