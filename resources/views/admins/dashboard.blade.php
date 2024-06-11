@extends('admins.layouts.master')

@section('title')
    Dashboard
@endsection

@section('style')
<style>

    .box-counter {
        font-size: 4rem;
        line-height: 4rem;
        padding: 1rem 0 0 .5rem;
    }

    .box-title {
        padding: 0 0 2rem .5rem;
    }

    .box-footer {
        background-color: rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: .3rem;
    }

    @media only screen and (max-width: 64.0625em) {
        
    }

    @media only screen and (min-width: 35em) and (max-width: 49.9375em) {

    }

    @media only screen and (max-width: 36em) {

        .col-0 {
            flex: 0 0 0;
            max-width: 0;
            padding-left: 0;
            padding-right: 0;
        }
    }

    @media only screen and (min-width: 75em) {
        .col-xl-0 {
            flex: 0 0 0;
            max-width: 0;
            padding-left: 0;
            padding-right: 0;
        }
    }

    @media only screen and (min-width: 62em) and (max-width: 75em) {
        .col-lg-0 {
            flex: 0 0 0;
            max-width: 0;
            padding-left: 0;
            padding-right: 0;
        }
    }

    @media only screen and (min-width: 48em) and (max-width: 62em) {
        .col-md-0 {
            flex: 0 0 0;
            max-width: 0;
            padding-left: 0;
            padding-right: 0;
        }
    }

    @media only screen and (min-width: 36em) and (max-width: 48.0625em) {
        .col-sm-0 {
            flex: 0 0 0;
            max-width: 0;
            padding-left: 0;
            padding-right: 0;
        }
    }

    @media only screen and (min-width: 36em) and (max-width: 48em) {

    }

    @media only screen and (max-width: 35.9375em) {

    }




</style>
@endsection

@section('content')

    @include('admins.layouts.header')

    <div class="container-fluid" style="flex:1;">

        <div class="container">
    
            <div class="row py-5">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="container-fluid bg-primary text-light">
                        <div class="row box-counter">
                            <span>0</span>
                        </div>
                        <div class="row box-title">
                            <span>Số lượng vé bán trong ngày</span>
                        </div>
                        <div class="row box-footer">
                            <span>ㅤ</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mt-3 mt-md-0">
                    <div class="container-fluid bg-danger text-light">
                        <div class="row box-counter">
                            <span>0</span>
                        </div>
                        <div class="row box-title">
                            <span>Số lượng vé hủy trong ngày</span>
                        </div>
                        <div class="row box-footer">
                            <span>ㅤ</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mt-3 mt-lg-0">
                    <div class="container-fluid bg-success text-light">
                        <div class="row box-counter">
                            <span>0</span>
                        </div>
                        <div class="row box-title">
                            <span>Số lượng hóa đơn đã tạo</span>
                        </div>
                        <div class="row box-footer">
                            <span>Xem thêm ➔</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mt-3 mt-lg-0">
                    <div class="container-fluid bg-warning text-light">
                        <div class="row box-counter">
                            <span>0</span>
                        </div>
                        <div class="row box-title">
                            <span>Số lượng hóa đơn đã xuất</span>
                        </div>
                        <div class="row box-footer">
                            <span>Xem thêm ➔</span>
                        </div>
                    </div>
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