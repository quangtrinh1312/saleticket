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
        label {
            font-size: .8rem;
        }
    }

    @media only screen and (max-width: 61.89em) {
        .input-box {
            flex: 1;
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

            <div class="row px-5 px-lg-2">

                <div class="col-lg-3 col-12 mt-2">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center justify-content-lg-end p-sm-0">
                            <label>Từ ngày</label>
                        </div>
                        <div class="col-8 pr-0">
                            <input type="text" class="form-input">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-12 mt-2">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center justify-content-lg-end p-sm-0">
                            <label>Đến ngày</label>
                        </div>
                        <div class="col-8 pr-0">
                            <input type="text" class="form-input">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-12 mt-2">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center justify-content-lg-end p-sm-0">
                            <label>Trạng thái HĐ</label>
                        </div>
                        <div class="col-8 pr-0">
                            <select class="form-input">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-12 mt-2">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center px-0 px-lg-5">
                            <button type="submit" class="btn btn-sm btn-primary text-uppercase rounded-0 w-100">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
                
            </div>


            </form>
        </div>

        <div class="container shadow pb-5 mt-5">
            <div class="row bg-primary text-light p-1">
                <span>Danh sách hóa đơn</span>
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
                                <th scope="col" class="text-center">Mã vé</th>
                                <th scope="col" class="text-center">Tên loại vé</th>
                                <th scope="col" class="text-center">Giá tiền</th>
                                <th scope="col" class="text-center">Ngày xuất hóa đơn</th>
                                <th scope="col" class="text-center">Trạng thái hóa đơn</th>
                                <th scope="col" class="text-center">Số hóa đơn</th>
                                <th scope="col" class="text-center"></th>
                            </thead>
                            <tbody id="list_ticket_table_data">
                                <tr>
                                    <td scope="row" class="text-center"></td>
                                    <td scope="row" class="text-center text-uppercase">Vé xe đạp</td>
                                    <td scope="row" class="text-center">2.000 VND</td>
                                    <td scope="row" class="text-center">01/06/2023</td>
                                    <td scope="row" class="text-center">Trong ngày</td>
                                    <td scope="row" class="text-center">Đã xuất</td>
                                    <td scope="row" class="text-center"></td>
                                    <td scope="row" class="text-center">
                                        <a href="#!"><i class="fa-regular fa-eye"></i></a> 
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