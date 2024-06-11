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
                <a href="alpaca_advanced.html" class="breadcrumb-item">Chung cư</a>
                <a href="alpaca_advanced.html" class="breadcrumb-item active">Thu tiền</a>
                {{-- <span class="breadcrumb-item active">Trang 1</span> --}}
            </div>
            <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!--# /page header -->

<div class="content">
    @if (Session::has('authorization'))
        <div class="alert alert-danger">
            {{ Session::get('authorization') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="container">
            @include('admins.layouts.content_config_bill')
        </div>
    </div>
</div>
@endsection

@section('script')

@include('admins.layouts.success')
@include('admins.layouts.error')
@endsection
