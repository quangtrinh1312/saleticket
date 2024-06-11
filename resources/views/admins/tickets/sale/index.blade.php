@extends('admins.layouts.master')

@section('title')
    Bán vé
@endsection

@section('style')
    <style>
        #printJS-bill,
        #printJS-bill1 {
            visibility: hidden;
            position: absolute;
            top: -100000px;
        }

        .content {
            position: relative;
        }

        .content-detail__qty {
            display: flex;
            justify-content: start;

        }

        .content-detail__qty .content-detail__qty--btn {

            width: 30px;
            height: 30px;
            background-color: #CCCCCC;
            border: none;
            cursor: pointer;

        }


        .content-detail__qty .input_qty {
            width: 100%;
            text-align: center;
            border: none;
            outline: none;

        }

        .content-detail__qty .input_qty {
            width: 100%;
            text-align: center;
            border: none;

        }

        .content-detail__qty .content-detail__qty--btn i {
            opacity: 0.5;
            font-weight: 600 !important;
            font-size: 16px;
        }

        .content-detail__qty .content-detail__qty--btn:active {
            transform: translate3d(1px, 0px, 1px)
        }


        .content-detail__qty .input_qty[type="number"]::-webkit-inner-spin-button,
        .content-detail__qty .input_qty[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        label {
            margin: 0;
            padding: 0;
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

        <div class="container mt-4">

            <form action="{{ route('ticker.store') }}" method="POST">
                @method('POST') @csrf

                <div class="row d-flex align-items-stretch">
                    <div class="container mt-4">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-lg-8 col-12">
                                <div class="container-fluid shadow h-100 bg-white">
                                    <div class="row bg-primary text-light p-1">
                                        <span>Thông tin bán vé</span>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-lg-10 col-12">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <input type="text" class="form-control reset_ticket_input"
                                                        id="input-cus_name" name="cus_name" placeholder="Tên khách hàng">
                                                    <span class="text-danger">
                                                        <small>
                                                            @if (isset($user) && $user->cus_name != '')
                                                                Mặc định là: {{ $user->cus_name }}
                                                            @endif
                                                        </small>
                                                    </span>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <input type="text" class="form-control reset_ticket_input"
                                                        name="address" placeholder="Địa chỉ" id="input-address">
                                                    <span class="text-danger">
                                                        @if (isset($user) && $user->address != '')
                                                            <small>Mặc định là: {{ $user->address }}</small>
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <input type="text" class="form-control reset_ticket_input"
                                                        id="input_mst" name="mst" placeholder="Mã số thuế">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 d-lg-block d-none">
                                            <div class="row">
                                                <button type="button" class="btn btn-block btn-danger"
                                                    id="reset_ticket">Nhập lại vé</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        @foreach ($ticket_types as $key => $ticket_type)
                                            <div class="col-lg-4 col-sm-6 p-3">
                                                <div class="row border border-info shadow py-1">
                                                    <div class="col-5">
                                                        <img src="{{ asset('images/ticket.png') }}" alt=""
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="col-7 d-flex flex-column justify-content-around">
                                                        <span class="text-uppercase">{{ $ticket_type->name }}</span>
                                                        <span>
                                                            <strong>
                                                                {{ number_format($ticket_type->post_vat_price, 0, ',', '.') }}
                                                                <input type="text" name=""
                                                                    id="price{{ $key + 1 }}"
                                                                    value="{{ $ticket_type->post_vat_price }}" hidden
                                                                    disabled>
                                                                <input type="text" name="post_vat_price[]"
                                                                    value="{{ $ticket_type->post_vat_price }}" hidden>
                                                                <input type="text" name="prod_name[]"
                                                                    value="{{ $ticket_type->name }}" hidden>
                                                                <input type="text" name="ticket_id[]"
                                                                    value="{{ $ticket_type->id }}" hidden>
                                                            </strong>
                                                        </span>
                                                        <div class="row d-flex justify-content-between px-2"
                                                            style="gap:.5rem;">
                                                            <button type="button"
                                                                class="btn btn-square btn-secondary rounded-0"
                                                                onclick="click_minus('{{ $key + 1 }}')"><i
                                                                    class="fa-solid fa-minus"></i>
                                                            </button>
                                                            <div class="bg-danger text-light text-center content-detail__qty"
                                                                style="flex:1;">
                                                                <input class="content-detail__qty--input input_qty"
                                                                    id="input_quantity{{ $key + 1 }}" min="0"
                                                                    data-id="{{ $key + 1 }}" name="quantity[]"
                                                                    value="0" type="number">
                                                            </div>
                                                            <button type="button"
                                                                onclick="click_plus('{{ $key + 1 }}')"
                                                                class="btn btn-square btn-secondary rounded-0"><i
                                                                    class="fa-solid fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-12 mt-2 mt-lg-0">
                                <div class="container-fluid shadow bg-white">
                                    <div class="row bg-primary text-light p-1">
                                        <span>Thông tin bán vé</span>
                                    </div>
                                    <div class="row d-flex flex-column">
                                        <div class="p-2">
                                            <span><strong>Tổng tiền vé: </strong><strong id="total_amount_ticket"> 0
                                                </strong></span>
                                        </div>
                                        <!-- <div class="p-2">
                                            <span>Khách phải trả: 0 VNĐ</span>
                                        </div>
                                        <div class="p-2 d-flex align-items-center justify-content-between">
                                            <label>Khách thanh toán</label>
                                            <input type="text" class="form-control input-right">
                                        </div>  -->
                                        <div class="p-2 d-flex align-items-center justify-content-between">
                                            <label>Hình thức thanh toán</label>
                                            <select name="payment_method_id" class="custom-select form-control input-right">
                                                @if ($payMethods && count($payMethods) > 0)
                                                    @foreach ($payMethods as $payMethod)
                                                        <option class="option_payMethod" value="{{ $payMethod->id }}">
                                                            {{ $payMethod->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="p-2 align-items-center" id="in_gop" style="display: none;">
                                            <input type="checkbox" id="check_print" name="check_print">
                                            <label for="check_print" class="text-uppercase pl-2">In gộp</label>
                                        </div>
                                        <div class="p-2 d-flex justify-content-around">
                                            @if (isset($result_tickets) && count($result_tickets) > 0)
                                                <button type="button"
                                                    class="btn btn-primary btn-sm rounded-0 text-uppercase" id=""
                                                    onclick="printJS({printable: 'printJS-bill', type: 'html', style:'#printJS-bill{width:100%; margin:auto; margin-top: 20px; position:relative; text-align: center;} .header-bill{width: 100%; margin-bottom:40px;  padding-bottom: 30px; border-bottom: 1px solid black;} .mau_so{margin-top:20px; position: relative; text-align: center;} .font-weight-bold{font-weight:bold; font-size: 22px} .phieuthu{text-align: center;} .col-lg-12{width:100%;} .content_bill{width:100%;} .box-wrap {width:100%; display: flex ; justify-content: left;flex-wrap: wrap;}.box-wrap .left-info {width: max-content; }.box-wrap .right-info {width: max-content;padding-left: 15px; text-align:left; } .right-info .title-row {text-align:left; padding-left: -20px;} .ngaythang{text-align: right;} .nguoilap_phieu{margin-top:50px;text-align: center;} #myContentEditableDiv:first-letter {text-transform: capitalize;} .light-small{margin-top: -36px;} .light-medium{margin-top: -20px;} .light-margin-top-6px{margin-top: -6px;} .light-small-bottom{margin-bottom: -40px;} #image_logo{z-index:-99;} image{width: 70%; position: absolute; top: 50%; transform: translateY(-50%); opacity: 0.2; z-index: -9999; left: 14%;} #infor_inv{text-align:right} #infor_inv .row {display:flex; text-align:right; justify-content: flex-start;} #infor_inv .row .title-left{width:16%; text-align:left} #infor_inv .row .title-right{width:30%; text-align:left} #infor_inv .row .space{width:50%; text-align:left} .header_receipt{text-align:left} #content_inv{width:80%; margin:auto;} #cong_hoa{font-size: 20px;} .bold{font-weight:bold} .price{font-size: 40px; color:red;} .italic{font-style : italic;} .title_price{font-size:28px;} .kyten{width:100%; border: 1px solid black; margin:auto; text-align:left;} .title-left-ky{text-align:left; margin-right:10px} .title-right-ky{text-align:left} .mt_ky{margin-top:-16px; margin-bottom: 26px} .mt_content {margin-top:-16px;} .mt_content_covert {margin-top:-50px;} #myContentEditableDiv{ margin-left:10px;} .box-wrap-b {width:100%; display: flex ; justify-content: center;flex-wrap: wrap;} .mt_header{margin-top:-30px;}h1{padding: 0px; margin: 0px;}' });">In
                                                    lại</button>
                                            @endif
                                            <button type="submit" class="btn btn-primary btn-sm rounded-0 text-uppercase"
                                                id="btn_purchase">Thanh toán</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="container shadow mt-4 bg-white">
                <div class="text-drak mt-2 p1">
                    <h4>{{ Auth::user()->name }}</h4>
                </div>
                <div class=" text-drak p-1">
                    <H4>Số lượng vé đã bán hôm nay: <font style="color: red">{{ $sum_number ?? 0 }}</font> - Tổng tiền:
                        <font style="color: red">{{ number_format($sum_all, 0, ',', '.') }} đ</font>
                    </H4>
                    @if (isset($total_ticket_type) && count($total_ticket_type) > 0)
                        @foreach ($total_ticket_type as $key => $value_)
                            <h5>{{ $value_->prod_name }}: {{ $value_->number }}</h5>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="container shadow mt-4 pb-5 bg-white">
                        <div class="row bg-primary text-light p-1">
                            <span>Danh sách bán vé</span>
                        </div>

                        <div class="container-fluid px-3" id="list_ticket_table">
                            @include('admins.tickets.sale.pagination')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('admins.tickets.modal.modal_detail')

    @if (isset($result_tickets) && count($result_tickets) > 0)
        @include('admins.tickets.print')
    @endif
    @include('admins.layouts.footer')
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script>
        $(document).ready(function() {
            number();
            in_gop();
            printJS({
                printable: 'printJS-bill',
                type: 'html',
                style: '#printJS-bill{width:100%; margin:auto; margin-top: 20px; position:relative; text-align: center;} .header-bill{width: 100%; margin-bottom:40px;  padding-bottom: 30px; border-bottom: 1px solid black;} .mau_so{margin-top:20px; position: relative; text-align: center;} .font-weight-bold{font-weight:bold; font-size: 22px} .phieuthu{text-align: center;} .col-lg-12{width:100%;} .content_bill{width:100%;} .box-wrap {width:100%; display: flex ; justify-content: left;flex-wrap: wrap;}.box-wrap .left-info {width: max-content; }.box-wrap .right-info {width: max-content;padding-left: 15px; text-align:left; } .right-info .title-row {text-align:left; padding-left: -20px;} .ngaythang{text-align: right;} .nguoilap_phieu{margin-top:50px;text-align: center;} #myContentEditableDiv:first-letter {text-transform: capitalize;} .light-small{margin-top: -36px;} .light-medium{margin-top: -20px;} .light-margin-top-6px{margin-top: -6px;} .light-small-bottom{margin-bottom: -40px;} #image_logo{z-index:-99;} image{width: 70%; position: absolute; top: 50%; transform: translateY(-50%); opacity: 0.2; z-index: -9999; left: 14%;} #infor_inv{text-align:right} #infor_inv .row {display:flex; text-align:right; justify-content: flex-start;} #infor_inv .row .title-left{width:16%; text-align:left} #infor_inv .row .title-right{width:30%; text-align:left} #infor_inv .row .space{width:50%; text-align:left} .header_receipt{text-align:left} #content_inv{width:80%; margin:auto;} #cong_hoa{font-size: 20px;} .bold{font-weight:bold} .price{font-size: 40px; color:red;} .italic{font-style : italic;} .title_price{font-size:28px;} .kyten{width:100%; border: 1px solid black; margin:auto; text-align:left;} .title-left-ky{text-align:left; margin-right:10px} .title-right-ky{text-align:left} .mt_ky{margin-top:-16px; margin-bottom: 26px} .mt_content {margin-top:-16px;} .mt_content_covert {margin-top:-50px;} #myContentEditableDiv{ margin-left:10px;} .box-wrap-b {width:100%; display: flex ; justify-content: center;flex-wrap: wrap;} .mt_header{margin-top:-30px;}h1{padding: 0px; margin: 0px;}'
            });
        });

        $('#input_mst').on('keyup change', function(e) {
            let url = '{{ route('company.tax.code', ':tax_code') }}';
            $.ajax({
                type: 'GET',
                url: url.replace(':tax_code', this.value),

                success: function(data) {
                    $('#input-cus_name').val(data.name);
                    $('#input-address').val(data.address);
                },
                error: function(error) {

                }
            });
        });

        function ticketDetail(id) {

            $('#detailTicketModal').modal('show');

            let modal_body_detail = $('#modal_body_detail');

            let id_ticket = 0;

            let url = '{{ route('ticker.show', ':id') }}';

            $.ajax({
                type: 'GET',

                data: {
                    'id': id,
                },

                url: url.replace(':id', id),

                success: function(data) {

                    modal_body_detail.html(data);

                },
                error: function(error) {

                }
            });
        }

        function click_plus(key) {
            let input_quantity = $('#input_quantity' + key);

            if (input_quantity.val() == '') {

                input_quantity.val(1);

            } else {
                let result = parseInt(input_quantity.val()) + 1;

                if (result > 9) {

                    input_quantity.val(result);


                } else input_quantity.val(result);
            }

            total_amount_ticket();
            in_gop()
            number()
        }

        $('#reset_ticket').on('click', function() {
            $('.reset_ticket_input').val('').trigger('change');
            $('.input_qty').val(0).trigger('change');
            total_amount_ticket();
            in_gop()
            number()
        });

        function click_minus(key) {
            let input_quantity = $('#input_quantity' + key);

            if (input_quantity.val() == '') {

                input_quantity.val(0);

            } else {
                let result = parseInt(input_quantity.val()) - 1;

                if (result > 9) {

                    input_quantity.val(result);

                } else if (result == 0 || result < 0) {
                    input_quantity.val(0);
                } else {
                    input_quantity.val(result);
                }
            }
            total_amount_ticket();
            in_gop()
            number()
        }

        function total_amount_ticket() {

            let total_amount_ticket = $('#total_amount_ticket');
            let input_qty = $('.input_qty');
            let total = 0;
            let length = input_qty.length;
            for (let i = 0; i < length; i++) {
                let key = input_qty[i].getAttribute('data-id');

                total = total + (parseInt($('#price' + key).val()) * parseInt(parseInt($('#input_quantity' + key).val())));
            }

            total_amount_ticket.text(new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            }).format(total));

        }

        function in_gop() {

            let input_qty = $('.input_qty');
            let number = 0;
            let length = input_qty.length;
            for (let i = 0; i < length; i++) {
                number = parseInt(input_qty[i].value) + parseInt(number);
            }

            if (number > 1) {
                $('#in_gop').css('display', 'block');
            } else $('#in_gop').css('display', 'none');

        }

        function number() {

            let input_qty = $('.input_qty');
            let number = 0;
            let length = input_qty.length;
            for (let i = 0; i < length; i++) {
                number = parseInt(input_qty[i].value) + parseInt(number);
            }
            if (number > 0) {
                $('#btn_purchase').removeAttr('disabled');
            } else $('#btn_purchase').attr('disabled', 'true');

        }
    </script>


    <!-- max -->

    <script>
        function max(key) {
            let input_quantity = $('#input_quantity' + key);

            let number = input_quantity.val();

            let max = input_quantity.attr('max');

            if (number > max) {

                input_quantity.val(max);

            }
        }
    </script>
@endsection
