@if($edit === 1) 

    <form action="{{route('paradigms-apartments.201.collect.edit.post',['id' => $amountReceived7->id])}}" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-3">
                <label for="block_name_create" class="col-form-label">Họ, tên người nộp tiền</label>
            </div>
            <div class="col-9">
                <input type="text" class="form-control" name="fullname" value="{{$amountReceived7->fullname ?? ''}}" id="input_fullname" required onkeyup="validateForm()" onchange="validateForm()">
                <input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
                <span class="text-danger k-error" id="message_fullname"></span>
            </div>

            <div class="col-3">
                <label for="block_name_create" class="col-form-label">Nội dung</label>
            </div>
            <div class="col-9">
                <textarea type="text" name="content_bill_debt_month" value="{{$amountReceived7->content_bill_debt_month ?? ''}}" id="block_name_create" class="form-control form-control-sm" required onkeyup="validateForm()" onchange="validateForm()">{{$amountReceived7->content_bill_debt_month ?? ''}}</textarea>
                <span class="text-danger k-error" id="message_content_bill_debt_month"></span>
            </div>

            <div class="col-3 mt-2">
                <label for="block_name_create" class="col-form-label">Nội dung truy/thu bổ sung</label>
            </div>
            <div class="col-9 mt-2">

                <textarea type="text" name="content_bill_debt_additional_arrears" value="{{$amountReceived7->content_bill_debt_additional_arrears ?? ''}}" id="block_name_create" class="form-control form-control-sm" onkeyup="validateForm()" onchange="validateForm()">{{$amountReceived7->content_bill_debt_additional_arrears ?? ''}}</textarea>
                 <span class="text-danger k-error" id="message_content_bill_debt_additional_arrears"></span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Đóng</button>
            <button type="button" onclick="resetValueForm()" class="btn btn-warning btn-sm" id="">
                <i class="fa-solid fa-rotate mr-1"></i>
                Làm mới
            </button>
            <button type="submit" class="btn btn-primary btn-sm" id="submit_collect" style="margin-left: 0.5rem !important;">Lưu</button>
        </div>
    </form>
@else
    
    @if ($amountReceived7->type_receipt_id == 2)
    <div class="content">

        <div class="card card-body" style="max-width: 500px;">

            <div class="row"  target="_blank">

                <div class="col-lg-12">

                    @include('admins.paradigms.bill.bill')

                    <div class="col-lg-12 mt-4">

                        <div class="row pl-2 pr-2">
                             <button type="button" style="" class="btn btn-dark" onclick="printJS({printable: 'printJS-bill', type: 'html', 
                             style:'#printJS-bill{width:90%; margin:auto; margin-top: 20px; font-size: 24px;} .header-bill{width: 100%;} .mau_so{margin-top:20px; position: relative; text-align: center;} .font-weight-bold{font-weight:bold;} .phieuthu{margin-top:20px;text-align: center;} .col-lg-12{width:100%;} .content_bill{width:100%;} .box-wrap {width:100%; display: flex ; justify-content: space-between;flex-wrap: wrap;}.box-wrap .left-info {width: max-content; }.box-wrap .right-info {width: max-content;padding-left: 15px; text-align:left; } .right-info .title-row {text-align:left; padding-left: -20px;} .ngaythang{text-align: right;} .nguoilap_phieu{margin-top:50px;text-align: center;} #myContentEditableDiv:first-letter {text-transform: capitalize;} .light-small{margin-top: -36px;} .light-medium{margin-top: -20px;} .light-margin-top-6px{margin-top: -6px;}'})">
                                In
                             </button>
                        </div>

                    </div>

                </div>
                
            </div>
            
        </div>

    </div>
    @elseif ($amountReceived7->type_receipt_id == 1)
    <div class="content">

        <div class="card card-body" style="max-width: 500px;">

            <div class="row"  target="_blank">

                <div class="col-lg-12">

                    @include('admins.paradigms.bill.receipt_bill')

                    <div class="col-lg-12 mt-4">

                        <div class="row pl-2 pr-2">
                             <button type="button" style="" class="btn btn-dark" onclick="printJS({printable: 'printJS-bill', type: 'html', 
                             style:'#printJS-bill{width:90%; margin:auto; margin-top: 20px; font-size: 24px;} .header-bill{width: 100%;} .mau_so{margin-top:20px; position: relative; text-align: center;} .font-weight-bold{font-weight:bold;} .phieuthu{margin-top:20px;text-align: center;} .col-lg-12{width:100%;} .content_bill{width:100%;} .box-wrap {width:100%; display: flex ; justify-content: space-between;flex-wrap: wrap;}.box-wrap .left-info {width: max-content; }.box-wrap .right-info {width: max-content;padding-left: 15px; text-align:left; } .right-info .title-row {text-align:left; padding-left: -20px;} .ngaythang{text-align: right;} .nguoilap_phieu{margin-top:50px;text-align: center;} #myContentEditableDiv:first-letter {text-transform: capitalize;} .light-small{margin-top: -36px;} .light-medium{margin-top: -20px;} .header_receipt{width:100%!important; text-align:center; } .header_receipt_p{margin-top: -12px;}.light-margin-top-6px{margin-top: -6px;}'})">
                                In
                             </button>
                        </div>

                    </div>

                </div>
                
            </div>
            
        </div>

    </div>
    @endif


@endif