<form action="{{route('paradigms-apartments.update',['id' => $apartment->id])}}" method="POST">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-3">
            <label for="block_name_create" class="col-form-label float-right">Tên chung Cư</label>
        </div>
        <div class="col-9">
            <input type="text" name="name" value="{{$apartment->name ?? ''}}" id="block_name_create" class="form-control form-control-sm" required>
            <input type="text" name="url" value="{{$url ?? ''}}" hidden>
            <input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary btn-sm" id="" style="margin-left: 0.5rem !important;">Lưu</button>
    </div>
</form>