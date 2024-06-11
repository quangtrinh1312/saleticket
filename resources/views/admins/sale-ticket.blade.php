@extends('admins.layouts.master')

@section('title')
    Loại vé
@endsection

@section('style')
<style>

label {
    margin:0;
    padding:0; 
}

.input-right {
    width: 10rem;
    height: 1.8rem;
    padding-top: 0;
    padding-bottom: 0;
}

button.btn-square {
    width: 1.5rem;
    height: 1.5rem;
    font-size: .8rem;
    padding: 0;
}

    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .input-right {
            width: 9rem;
        }

    }

    @media only screen and (min-width: 769px) and (max-width: 991px) {
        .input-right {
            width: 25rem;
        }
    }

    @media only screen and (min-width: 576px) and (max-width: 768px) {
        .input-right {
            width: 18rem;
        }
    }

    @media only screen and (max-width: 575px) {
        .input-right {
            width: 40vw;
        }
    }

</style>
@endsection

@section('content')

    @include('admins.layouts.header')

    <div class="container-fluid" style="flex:1;">

        <form action="#!">

        <div class="container mt-4">
            <div class="row d-flex align-items-stretch">
                <div class="col-lg-8 col-12">
                    <div class="container-fluid shadow h-100">
                        <div class="row bg-primary text-light p-1">
                            <span>Thông tin bán vé</span>
                        </div>
                        <div class="row py-2">
                            <div class="col-lg-10 col-12">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <input type="text" class="form-control" placeholder="Tên khách hàng">
                                        <span class="text-danger"><strong>Mặc định là: Khách lẻ</strong></span>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <input type="text" class="form-control" placeholder="Địa chỉ">
                                        <span class="text-danger"><strong>Mặc định là: Đà Nẵng</strong></span>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-12">
                                        <input type="text" class="form-control" placeholder="Mã số thuế">
                                    </div>
                                    <div class="d-lg-none col-sm-6 col-12 pt-sm-0 pt-3">
                                        <button type="button" class="btn btn-block btn-danger">Nhập lại vé</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 d-lg-block d-none">
                                <div class="row">
                                    <button type="button" class="btn btn-danger">Nhập lại vé</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
    
                            @foreach (['vé xe đạp', 'vé xe máy', 'vé ô tô'] as $name)
    
                            <div class="col-lg-4 col-sm-6 p-3">
                                <div class="row border border-info shadow py-1">
                                    <div class="col-5">
                                        <img src="{{ asset('images/ticket.png') }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-7 d-flex flex-column justify-content-around">
                                        <span class="text-uppercase">{{ $name }}</span>
                                        <span><strong>2.000 VNĐ</strong></span>
                                        <div class="row d-flex justify-content-between px-2" style="gap:.5rem;">
                                            <button type="button" class="btn btn-square btn-secondary rounded-0"><i class="fa-solid fa-minus"></i></button>
                                            <div class="bg-danger text-light text-center" style="flex:1;">
                                                <span>1</span>
                                            </div>
                                            <button type="button" class="btn btn-square btn-secondary rounded-0"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            @endforeach
    
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12 mt-2 mt-lg-0">
                    <div class="container-fluid shadow">
                        <div class="row bg-primary text-light p-1">
                            <span>Thông tin bán vé</span>
                        </div>
                        <div class="row d-flex flex-column">
                            <div class="p-2">
                                <span><strong>Tổng tiền vé:</strong> 0 VNĐ</span>
                            </div>
                            <div class="p-2">
                                <span>Khách phải trả: 0 VNĐ</span>
                            </div>
                            <div class="p-2 d-flex align-items-center justify-content-between">
                                <label>Khách thanh toán</label>
                                <input type="text" class="form-control input-right">
                            </div>
                            <div class="p-2 d-flex align-items-center justify-content-between">
                                <label>Hình thức thanh toán</label>
                                <select class="form-control input-right">
                                    <option value="">Tiền mặt</option>
                                </select>
                            </div>
                            <div class="p-2 d-flex align-items-center">
                                <input type="checkbox">
                                <span class="text-uppercase pl-2">In gộp</span>
                            </div>
                            <div class="p-2 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-sm rounded-0 text-uppercase">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </form>

    </div>

    @include('admins.layouts.footer')

@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection