@if($edit === 1) 

    <form action="{{route('paradigms-apartments.201.collect.edit.post',['id' => $amountReceived_1_->id])}}" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-3">
                <label for="block_name_create" class="col-form-label float-right">Họ, tên người nộp tiền</label>
            </div>
            <div class="col-9">
                <input type="text" name="fullname" value="{{$amountReceived_1_->fullname ?? ''}}" id="block_name_create" class="form-control form-control-sm" required>
                <input type="text" name="url" value="{{$url ?? ''}}" hidden>
                <input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
            </div>

            <div class="col-3">
                <label for="block_name_create" class="col-form-label float-right">Nội dung nợ tháng</label>
            </div>
            <div class="col-9">
                <input type="text" name="content_bill_debt_month" value="{{$amountReceived_1_->content_bill_debt_month ?? ''}}" id="block_name_create" class="form-control form-control-sm" required>
            </div>

            <div class="col-3">
                <label for="block_name_create" class="col-form-label float-right">Nội dung truy/thu bổ sung</label>
            </div>
            <div class="col-9">
                <input type="text" name="content_bill_debt_additional_arrears" value="{{$amountReceived_1_->content_bill_debt_additional_arrears ?? ''}}" id="block_name_create" class="form-control form-control-sm">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Đóng</button>
            <button type="submit" class="btn btn-primary btn-sm" id="" style="margin-left: 0.5rem !important;">Lưu</button>
        </div>
    </form>
@else

    <div class="content">

        <div class="card card-body">

            <div class="row">

                <div class="col-lg-12">

                    <div class="row" style="margin-top: -20px;">
                        <div class="col-lg-4 text-center mt-2" style="position: relative;">
                            <p class="font-weight-bold">Mẫu số: C40-BB</p>
                            <p class="" style="margin-top: -10px;">(Ban hành theo QĐ số: 107/2017/TT-BTC ngày 10/10/2017 của Bộ Tài Chính)</p>
                        </div>
                        <div class="col-lg-4">
                            <!-- <div class="horizontal_dotted_line mt-1 font-weight-bold"><b>Đơn vị</b>: Trung tâm Quản lý và Khai thác Nhà Đà Nẵng </div>
                            <div class="horizontal_dotted_line mt-1 font-weight-bold"><b>Địa chỉ</b>: 06 Trần Quý Cáp – Tp Đà Nẵng</div>
                            <div class="horizontal_dotted_line mt-1 font-weight-bold"><b>Mã đơn vị SDNS</b>: 1127535</div> -->
                            <p class="font-weight-bold">Đơn vị: Trung tâm Quản lý và Khai thác Nhà Đà Nẵng</p>
                            <p class="font-weight-bold">Địa chỉ: 06 Trần Quý Cáp – Tp Đà Nẵng</p>
                            <p class="font-weight-bold">Mã đơn vị SDNS: 1127535</p>
                        </div>
                        <div class="col-lg-4 mt-2 text-center" >
                            <H1 style="margin: 0px;"><b>PHIẾU THU</b></H1>
                            <p>Số: {{$amountReceived_1_->number_bill_string}}</p>
                            <p>Ngày {{$amountReceived_1_->created_at->format('d')}} tháng {{$amountReceived_1_->created_at->format('m')}} năm {{$amountReceived_1_->created_at->format('Y')}}</p>
                        </div>
                    </div>
                        
                    <!-- <div class="row">
                        <div class="col-lg-12">
                            <div class="row" style="">
                                <p style="">- Họ, tên người nộp: </p>
                                <p style="border-bottom: 2px dotted black; flex: 1; padding-left: 6px;"> aaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                            </div>
                            <div class="row" style="">
                                <p style="width: 9%;">- Địa chỉ:</p>
                                <p style="border-bottom: 1px dotted black; width: 91%;"></p>
                            </div>
                            <div class="row" style="">
                                <p style="width: 14%;">- Nội dung thu:</p>
                                <p style="border-bottom: 1px dotted black; width: 86%;"></p>
                            </div>
                            <div class="row" style="">
                                <p style="width: 12%;">- Số tiền thu:</p>
                                <p style="border-bottom: 1px dotted black; width: 88%;"></p>
                            </div>
                            <div class="row" style="">
                                <p style="width: 16%;">- (Viết bằng chữ):</p>
                                <p style="border-bottom: 1px dotted black; width: 84%;"></p>
                            </div>

                        </div>
                    </div> -->

                    <div class="col-lg-12">

                        <div class="row pl-2 pr-2">

                            <!-- <div class="col-lg-12 mt-1">
                                <div class="horizontal_dotted_line">Họ, tên người nộp: </div>
                            </div>
                            <div class="col-lg-12 mt-1">
                                <div class="horizontal_dotted_line">Địa chỉ: </div>
                            </div>
                            <div class="col-lg-12 mt-1">
                                <div class="horizontal_dotted_line">Lý do nộp: </div>
                            </div>
                            <div class="col-lg-12 mt-1">
                                <div class="horizontal_dotted_line">. </div>
                            </div>
                            <div class="col-lg-12 mt-1">
                                <div class="horizontal_dotted_line">Số tiền: </div>
                            </div>
                            <div class="col-lg-12 mt-1">
                                <div class="horizontal_dotted_line">(Viết bằng chữ): </div>
                            </div>
                            <div class="col-lg-12 mt-1">
                                <div class="horizontal_dotted_line">Hình thức nộp tiền: </div>
                            </div> -->

                            <div class="box-wrap col-lg-12 mt-1">
                                <div class="left-info">
                                    <p class="title-row">Họ tên người nộp:</p>
                                </div>
                                <div class="right-info">
                                    <p class="title-row text-uppercase">{{$amountReceived_1_->fullname}}</p>
                                </div>
                            </div>

                            <div class="box-wrap col-lg-12 mt-1">
                                <div class="left-info">
                                    <p class="title-row">Địa chỉ:</p>
                                </div>
                                <div class="right-info">
                                    <p class="title-row">{{$amountReceived_1_->apartment->name}} - {{$amountReceived_1_->room->name}}</p>
                                </div>
                            </div>

                            <div class="box-wrap col-lg-12 mt-1">
                                <div class="left-info">
                                    <p class="title-row">Lí do nộp:</p>
                                </div>
                                <div class="right-info">
                                    <p class="title-row">{{$amountReceived_1_->content_bill_debt_month}}, {{$amountReceived_1_->content_bill_debt_additional_arrears}}</p>
                                </div>
                            </div>

                            <div class="box-wrap col-lg-12 mt-1">
                                <div class="left-info">
                                    <p class="title-row">Số tiền:</p>
                                </div>
                                <div class="right-info">
                                    <p class="title-row">{{number_format($amountReceived_1_->sum_price_amount_received,2,'.',',')}} đồng</p>
                                </div>
                            </div>

                            <div class="box-wrap col-lg-12 mt-1">
                                <div class="left-info">
                                    <p class="title-row">(Viết bằng chữ):</p>
                                </div>
                                <div class="right-info">
                                    <p class="title-row">{{convert_curency_to_words($amountReceived_1_->sum_price_amount_received)}} đồng</p>
                                </div>
                            </div>

                            <div class="box-wrap col-lg-12 mt-1">
                                <div class="left-info">
                                    <p class="title-row">Hình thức nộp tiền:</p>
                                </div>
                                <div class="right-info">
                                    <p class="title-row">{{$amountReceived_1_->payment_method->title}}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-12 text-right pr-4">
                            <p>Ngày {{$amountReceived_1_->created_at->format('d')}} tháng {{$amountReceived_1_->created_at->format('m')}} năm {{$amountReceived_1_->created_at->format('Y')}}</p>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-3" style="margin-top: -60px;">
                        <div class="col-lg-2 text-center">
                            <p class="font-weight-bold">Người lập phiếu</p>
                            <p style="margin-top: -10px;">(Ký, họ tên)</p>
                            <h4 class="mt-4">{{$amountReceived_1_->account_for->fullname ?? $amountReceived_1_->account->fullname}}</h4>
                        </div>
                    </div>

                </div>
                
            </div>
            
        </div>

    </div>
@endif