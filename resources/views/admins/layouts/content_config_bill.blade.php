
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cấu hình biên nhận: {{$title ?? ''}}</h5>
    </div>
    <div class="modal-body pt-2 pb-2">
        <form action="{{route('configure.receipt.detail.type.post')}}" method="POST">
        	@method('POST')
        	@csrf
            <div class="row">
                <div class="col-2">
                    <label for="" class="col-form-label-sm float-right">Link:</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control form-control-sm" placeholder="https://ttquanlykhaithacnhadngadmindemo.vnpt-invoice.com.vn" value="{{$type_receipt->link ?? ''}}" name="link">
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <label for="" class="col-form-label-sm float-right">Account:</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control form-control-sm" value="{{$type_receipt->account ?? ''}}" name="account">
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <label for="" class="col-form-label-sm float-right">ACpass:</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control form-control-sm" value="{{$type_receipt->acpass ?? ''}}" name="acpass">
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <label for="" class="col-form-label-sm float-right">Username:</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control form-control-sm" name="username" value="{{$type_receipt->username ?? ''}}">
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <label for="" class="col-form-label-sm float-right">Password:</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control form-control-sm" value="{{$type_receipt->password ?? ''}}" name="password">
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <label for="" class="col-form-label-sm float-right">Mẫu số:</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control form-control-sm" value="{{$type_receipt->pattern ?? ''}}" name="pattern">
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <label for="" class="col-form-label-sm float-right">Kí hiệu:</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control form-control-sm" value="{{$type_receipt->serial ?? ''}}" name="serial">
                    <input type="text" name="url" value="{{$url}}" placeholder="" hidden>
                    <input type="text" name="type_receipt_id" value="{{$type_receipt->id ?? '0'}}" placeholder="" hidden>
                </div>
            </div>
            <div class="row">
                <a href="{{$url ?? ''}}" class="btn btn-outline-secondary btn-sm">Quay về</a>
        		<button type="submit" class="btn btn-success btn-sm ml-1">Cập nhật</button>
            </div>
        </form>
    </div>
