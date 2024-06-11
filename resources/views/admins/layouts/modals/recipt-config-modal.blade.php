<div class="modal fade" id="reciptConfigModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cấu hình</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>

            <form action="{{route('configs.update', $config->id ?? 0)}}" method="POST">
            @method('PUT')
            @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-5">
                            <div class="row">
                                <label>Tên đơn vị</label>
                                <div class="input-group">
                                    <input type="text" name="name" id="" value="{{$config->name ?? ''}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5">
                            <div class="row">
                                <label>Mã số thuế</label>
                                <div class="input-group">
                                    <input type="text" name="mst" id="" value="{{$config->mst ?? ''}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label>Địa chỉ</label>
                        <div class="input-group">
                            <input type="text" name="address_user" id="" value="{{$config->address_user ?? ''}}" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <label>Link API</label>
                        <div class="input-group">
                            <input type="text" name="link" id="" value="{{$config->link ?? ''}}" class="form-control">
                        </div>
                    </div>

<!--                     <div class="row">
                        <div class="col-5">
                            <div class="row">
                                <label>Tài khoản service</label>
                                <div class="input-group">
                                    <input type="text" name="" id="" value="{{$config->name ?? ''}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5">
                            <div class="row">
                                <label>Mật khẩu service</label>
                                <div class="input-group">
                                    <input type="text" name="" id="" value="{{$config->name ?? ''}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-5">
                            <div class="row">
                                <label>Tài khoản quản trị</label>
                                <div class="input-group">
                                    <input type="text" name="account" id="" value="{{$config->account ?? ''}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5">
                            <div class="row">
                                <label>Mật khẩu quản trị</label>
                                <div class="input-group">
                                    <input type="text" name="acpass" id="" value="{{$config->acpass ?? ''}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
            </div>
            </form>

        </div>
    </div>
</div>