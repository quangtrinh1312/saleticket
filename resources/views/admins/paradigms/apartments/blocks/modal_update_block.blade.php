<form action="{{route('paradigms-blocks.update',['id' => $block->id])}}" method="POST">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-3">
            <label for="apartment_id" class="col-form-label float-right">Chung Cư:</label>
        </div>

        <div class="col-9">
            <select name="apartment_id" id="apartment_id_update" class="custom-select">
            @if ($apartments && count($apartments) > 0)
                @foreach ($apartments as $apartment)
                    <option class="option_apartment" value="{{$apartment->id}}" {{$apartment->id == $apartment_id ? 'selected' : ''}}>{{$apartment->name}}</option>
                @endforeach
            @endif
            </select>
        </div>

        <div class="col-3 mt-3">
            <label for="name" class="col-form-label float-right">Tên Nhà:</label>
        </div>

        <div class="col-9 mt-3">
            <input type="text" name="name" value="{{$block->name ?? ''}}" id="block_name_update" class="form-control form-control-sm" required>
            <input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary btn-sm" id="" style="margin-left: 0.5rem !important;">Lưu</button>
    </div>
</form>