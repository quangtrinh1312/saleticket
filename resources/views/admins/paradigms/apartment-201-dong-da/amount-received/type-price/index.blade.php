@extends('admins.layouts.master')

@section('title')
    Loại tiền
@endsection

@section('style')
<style>
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
                <a href="" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Trang chủ</a>
                <a href="" class="breadcrumb-item">Chung cư 201 Đống Đa</a>
                <span href="" class="breadcrumb-item active">Loại tiền</span>
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
                <i class="fa-solid fa-paper-plane" style="color: #868686;"></i>
                <span class="text-uppercase" style="color: #868686; font-weight: 500;">Danh sách loại tiền</span>
            </div>

            <div class="mt-2 d-flex justify-content-between">
                <div>
                    <select name="" class="custom-select custom-select-sm" id="row">
                        <option value="5">5 hàng</option>
                        <option value="10">10 hàng</option>
                        <option value="15">15 hàng</option>
                        <option value="20">20 hàng</option>
                    </select>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-info btn-sm" id="tp_btn_create">
                        <i class="fa-solid fa-plus mr-1"></i>
                        Tạo mới
                    </button>
                </div>
            </div>

            <div id="list_type_price_table">
                @include('admins.paradigms.apartment-201-dong-da.amount-received.type-price.pagination')
            </div>

            {{-- Modal Tạo mới --}}
            <div class="modal fade" id="tp_modal_create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tạo mới Loại tiền</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="tp_form_create">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="" class="col-form-label-sm float-right">Loại tiền:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control form-control-sm" id="tp_name_create">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="" class="col-form-label-sm float-right">Loại biên nhận:</label>
                                    </div>
                                    <div class="col-9">
                                        <select name="" id="tp_type_receipt_create" class="form-control custom-select custom-select-sm">
                                            @if ($typeReceipts !== null && count($typeReceipts) > 0)
                                                @foreach ($typeReceipts as $typeReceipt)
                                                    <option value="{{ $typeReceipt->id }}">{{ $typeReceipt->type }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-warning btn-sm" id="tp_btn_refresh_store" style="margin-left: 0.5rem !important;">Làm mới</button>
                            <button type="button" class="btn btn-primary btn-sm" id="tp_btn_store" style="margin-left: 0.5rem !important;">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Chỉnh sửa --}}
            <div class="modal fade" id="tp_modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa Loại tiền</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="tp_form_edit">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="" class="col-form-label-sm float-right">Loại tiền:</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control form-control-sm" id="tp_name_edit">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="" class="col-form-label-sm float-right">Loại biên nhận:</label>
                                    </div>
                                    <div class="col-9">
                                        <select name="" id="tp_type_receipt_edit" class="form-control custom-select custom-select-sm">
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-warning btn-sm" id="tp_btn_refresh_update" style="margin-left: 0.5rem !important;">Làm mới</button>
                            <button type="button" class="btn btn-success btn-sm" id="tp_btn_update" style="margin-left: 0.5rem !important;">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Xác nhận xóa --}}
            <div class="modal fade" id="tp_modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Xác nhận xóa Loại tiền này?</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-danger btn-sm" id="tp_btn_destroy" style="margin-left: 0.5rem !important;">Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let paradigmId = 5;
    let token = "{{ csrf_token() }}";
    let routeStore = "{{ route('post.paradigms.apartment.201.dong.da.type.price') }}";
    let routeEdit = "{{ route('edit.paradigms.apartment.201.dong.da.type.price', ':id') }}";
    let routeUpdate = "{{ route('update.paradigms.apartment.201.dong.da.type.price', ':id') }}";
    let routeDestroy = "{{ route('destroy.paradigms.apartment.201.dong.da.type.price', ':id') }}";
    let routeGetRow = "{{ route('get.row.paradigms.apartment.201.dong.da.type.price') }}";
    let route = {
        store: routeStore,
        edit: routeEdit,
        update: routeUpdate,
        destroy: routeDestroy,
        getRow: routeGetRow,
    };
</script>
<script src="{{ asset('./js/type-price.js') }}"></script>
@endsection
