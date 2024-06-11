@extends('admins.layouts.master')

@section('title')
    Chung cư, nhà, tầng
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

    .list_block_name,
    .list_room_name {
        display: block;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    table {
        position: relative;
    }
    table > thead > tr {
        position: sticky;
        top: 0;
        box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
        background-color: #333333;
        z-index: 999;
    }
</style>
@endsection

@section('content')
<!--# Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-lg-inline">
        <div class="page-title d-flex">
            <h4 style="text-transform: uppercase;">@yield('title')</h4>
            <a href="#!" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="#!" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Trang chủ</a>
                @if ($paradigm_id == 1)
                <a href="#!" class="breadcrumb-item">Chung cư</a>
                @elseif ($paradigm_id == 5)
                <a href="#!" class="breadcrumb-item">Chung cư 201 Đống Đa</a>
                @elseif ($paradigm_id == 6)
                <a href="#!" class="breadcrumb-item">Nhà ở công nhân</a>
                @elseif ($paradigm_id == 4)
                <a href="#!" class="breadcrumb-item">Nhà bán thuộc SHNN</a>
                @endif
                <a href="#!" class="breadcrumb-item">Nhà</a>
                <span class="breadcrumb-item active">Tầng</span>
                <!-- <span class="breadcrumb-item active">Trang 1</span> -->
            </div>
            <a href="#!" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!--# /page header -->

<div class="content">
    <div class="card mb-4">
        <div class="container mb-2">
            <div class="mt-2">
                @livewire('floors.search-floor-livewire', ['paradigm_id' => $paradigm_id])
            </div>

            @livewire('floors.list-floor-livewire', ['paradigm_id' => $paradigm_id])

            @livewire('floors.create-floor-livewire', ['paradigm_id' => $paradigm_id])

            @livewire('floors.update-floor-livewire', ['paradigm_id' => $paradigm_id])

            @livewire('floors.delete-floor-livewire', ['paradigm_id' => $paradigm_id])
        </div>
    </div>
</div>
@endsection

@section('script')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
{{-- <script src="{{ asset('./js/index.js') }}"></script> --}}
@endsection
