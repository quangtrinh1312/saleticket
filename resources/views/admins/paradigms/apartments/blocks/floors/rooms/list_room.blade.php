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
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Trang chủ</a>
                <a href="#" class="breadcrumb-item">Chung cư</a>
                <a href="#" class="breadcrumb-item">Nhà</a>
                <!-- <span class="breadcrumb-item active">Trang 1</span> -->
            </div>
            <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!--# /page header -->

<div class="content">
    <div class="card mb-4">
        <div class="container mb-2">
            <div class="mt-2">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Tìm kiếm</legend>
                    <form action="{{route('paradigms-rooms.index', ['paradigm_id' => 1])}}" method="GET">
                        @method('GET')
                        @csrf
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-lg-3">
                                    <label>Chung cư:</label>
                                    <select name="apartment_id" id="apartment_id" onchange="getBlockByApartmentID(this.value, '{{$paradigm_id}}', '{{$url}}')" class="custom-select">
                                        <option value="">Tất cả</option>
                                        @if ($apartments && count($apartments) > 0)
                                            @foreach ($apartments as $apartment)
                                                <option class="option_apartment" value="{{$apartment->id}}" {{isset($params['apartment_id']) ? $params['apartment_id'] == $apartment->id ? 'selected' : '' : ''}}>{{$apartment->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label>Nhà:</label>
                                    <select name="block_id" onchange="getFloorByBlockID(this.value, '{{$paradigm_id}}', '{{$url}}')" id="block_id" class=" custom-select">
                                        <option value="">Tất cả</option>
                                        @if ($blocks && count($blocks) > 0)
                                            @foreach ($blocks as $block)
                                                <option class="option_block" value="{{$block->id}}" {{isset($params['block_id']) ? $params['block_id'] == $block->id ? 'selected' : '' : ''}}>{{$block->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label>Tầng:</label>
                                    <select name="floor_id" id="floor_id" onchange="getRoomByFloorID(this.value, '{{$paradigm_id}}', '{{$url}}')" class="custom-select">
                                        <option value="">Tất cả</option>
                                        @if ($floors && count($floors) > 0)
                                            @foreach ($floors as $floor)
                                                <option class="option_floor" value="{{$floor->id}}" {{isset($params['floor_id']) ? $params['floor_id'] == $floor->id ? 'selected' : '' : ''}}>{{$floor->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label>Căn hộ:</label>
                                    <select name="room_id" id="room_id" class=" custom-select">
                                        <option value="">Tất cả</option>
                                        @if ($rooms && count($rooms) > 0)
                                            @foreach ($rooms as $room)
                                                <option class="option_room" value="{{$room->id}}" {{isset($params['room_id']) ? $params['room_id'] == $room->id ? 'selected' : '' : ''}}>{{$room->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label></label>
                                    <input type="text" name="url" value="{{$url ?? ''}}" hidden>
                                    <input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
                                    <button type="submit" class="form-control  btn btn-success btn-sm" id="">
                                        <i class="fa-solid fa-magnifying-glass mr-1"></i>
                                        Tìm kiếm
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </fieldset>
            </div>

            <div class="mt-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <!-- <select name="" id="row" class="form-control custom-select">
                            <option value="5">5 hàng</option>
                            <option value="10">10 hàng</option>
                            <option value="15">15 hàng</option>
                            <option value="20">20 hàng</option>
                        </select> -->
                    </div>
                    <div>
                        <button type="button" class="btn btn-info btn-sm" id="modal_create_room_btn">
                            <i class="fa-solid fa-plus mr-1"></i>
                            Tạo mới
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <i class="fa-solid fa-paper-plane" style="color: #868686;"></i>
                <span class="text-uppercase" style="color: #868686; font-weight: 500;">Danh sách nhà</span>
            </div>

            <div id="list_apartment_table">
                @include('admins.paradigms.apartments.blocks.floors.rooms.ajax_list_room')
            </div>

            <!-- Modal create apartment -->

            <div class="modal fade" id="modal_create_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tạo Nhà</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('paradigms-rooms.store', ['paradigm_id' => 1])}}" method="POST">
                                @method('POST')
                                @csrf
                                <div class="row">
                                    <div class="col-3">
                                        <label class="float-right">Chung cư:</label>
                                    </div>

                                    <div class="col-9">
                                        <select name="apartment_id" id="apartment_id_create" onchange="getBlockByApartmentIdCrud(this.value, '{{$paradigm_id}}', '{{$url}}', 'create')" class="custom-select">
                                            @if ($apartments && count($apartments) > 0)
                                                @foreach ($apartments as $apartment)
                                                    <option class="option_apartment" value="{{$apartment->id}}">{{$apartment->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-3 mt-3">
                                        <label class="float-right">Nhà:</label>
                                    </div>

                                    <div class="col-9 mt-3">
                                        <select name="block_id" id="block_id_create" onchange="getFloorByBlockIdCrud(this.value, '{{$paradigm_id}}', '{{$url}}', 'create')" class="custom-select">
                                            
                                        </select>
                                    </div>

                                    <div class="col-3 mt-3">
                                        <label class="float-right">Tầng:</label>
                                    </div>

                                    <div class="col-9 mt-3">
                                        <select name="floor_id" id="floor_id_create" class="custom-select">
                                            
                                        </select>
                                    </div>

                                    <div class="col-3 mt-3 ">
                                        <label for="name" class="col-form-label float-right">Tên Căn Hộ:</label>
                                    </div>
                                    <div class="col-9 mt-3">
                                        <input type="text" name="name" id="room_name_create" class="form-control form-control-sm" required>
                                        <input type="text" name="url" value="{{$url ?? ''}}" hidden>
                                        <input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Đóng</button>
                                    <button type="reset" class="btn btn-warning btn-sm" style="margin-left: 0.5rem !important;">Làm mới</button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="" style="margin-left: 0.5rem !important;">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- model update apartment -->

            <div class="modal fade" id="modal_update_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_update" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel_update">Sửa Nhà</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="update_content_room">
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
<!-- <script src="{{ asset('./js/index.js') }}"></script> -->
<script>
    function getFloorByBlockIdCrud($block_id, $paradigm_id, $url, $crud) {

        var floor_id = $('#floor_id_'+$crud);

        floor_id.empty();

        var $selected_apartment_id = $('#apartment_id_crud').val();

        $.ajax({
            type: 'GET',

            data: {
                'block_id': $block_id,
                'apartment_id': $selected_apartment_id,
                'paradigm_id' : $paradigm_id,
                'url' : $url,
                'crud': true,
            },
            url: '{{route('get.floor.id.block.paradigm')}}',

            success: function (data) {

                floor_id.empty();

                floor_id.append(data);

            },
            error: function (error) {

            }
        });
    }

    function getBlockByApartmentIdCrud($apartment_id, $paradigm_id, $url, $crud) {

        var block_id = $('#block_id_'+$crud);

        block_id.empty();

        $.ajax({
            type: 'GET',

            data: {
                'apartment_id': $apartment_id,
                'paradigm_id' : $paradigm_id,
                'url' : $url,
                'crud': true,
            },
            url: '{{route('get.block.id.apartment.paradigm')}}',

            success: function (data) {

                block_id.empty();

                block_id.append(data);

            },
            error: function (error) {

            }
        });

        getFloorByBlockIdCrud($('#block_id_'+$crud).val(), $paradigm_id, $url, $crud)
    }

    $(document).ready(function() {
        $(document).off('click', '#modal_create_room_btn').on('click', '#modal_create_room_btn', function(e) {
            e.preventDefault();
            $('#modal_create_room').modal('show');
        });
        getBlockByApartmentIdCrud($('#apartment_id_create').val(), {{$paradigm_id}}, '{{$url}}', 'create');
    });

    function getRoom(paradigm_id, id, url) {

        $('#modal_update_room').modal('show');

        let content_modal_update_room =  $('#update_content_room');

        $.ajax({
            type: 'GET',

            data: {
                'paradigm_id': paradigm_id,
                'id' : id,
                'url' : url
            },

            url: '{{route('paradigms-rooms.edit','id')}}',

            success: function (data) {

                content_modal_update_room.html(data);

            },
            error: function (error) {

            }
        });

    }

    function getRoomByFloorID($floor_id, $paradigm_id, $url) {

        var room_id = $('#room_id');

        room_id.empty();

        var $selected_apartment_id = $('#apartment_id').val();

        var $selected_block_id = $('#block_id').val();

        $.ajax({
            type: 'GET',

            data: {
                'apartment_id': $selected_apartment_id,
                'block_id': $selected_block_id,
                'floor_id': $floor_id,
                'paradigm_id' : $paradigm_id,
                'url' : $url,
            },
            url: '{{route('get.room.id.floor.paradigm')}}',

            success: function (data) {

                room_id.empty();

                room_id.append(data);

            },
            error: function (error) {

            }
        });
    }

    function getFloorByBlockID($block_id, $paradigm_id, $url) {

        var floor_id = $('#floor_id');

        floor_id.empty();

        var $selected_apartment_id = $('#apartment_id').val();

        $.ajax({
            type: 'GET',

            data: {
                'apartment_id': $selected_apartment_id,
                'block_id': $block_id,
                'paradigm_id' : $paradigm_id,
                'url' : $url,
            },
            url: '{{route('get.floor.id.block.paradigm')}}',

            success: function (data) {

                floor_id.empty();

                floor_id.append(data);

            },
            error: function (error) {

            }
        });

        getRoomByFloorID($('#floor_id').val(), $paradigm_id, $url);
    }

    function getBlockByApartmentID($apartment_id, $paradigm_id, $url) {

            var block_id = $('#block_id');

            block_id.empty();

            $.ajax({
                type: 'GET',

                data: {
                    'apartment_id': $apartment_id,
                    'paradigm_id' : $paradigm_id,
                    'url' : $url,
                },
                url: '{{route('get.block.id.apartment.paradigm')}}',

                success: function (data) {

                    block_id.empty();

                    block_id.append(data);

                },
                error: function (error) {

                }
            });

            getFloorByBlockID($('#block_id').val(), $paradigm_id, $url)
        }
</script>
@endsection
