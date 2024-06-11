<form action="{{route('paradigms-apartments.worker.housing.collect.edit.post',['id' => $amountReceived_1_->id])}}" method="POST">
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