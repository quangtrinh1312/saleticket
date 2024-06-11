<div>
    <div wire:ignore.self class="modal fade" id="modal_update_dor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_update" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel_update">Sửa Ký túc xá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="row">
                            <div class="col-3">
                                <label for="name" class="col-form-label float-right">Tên Ký túc xá:</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="name" class="form-control form-control-sm" wire:model.lazy="name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <input type="text" name="paradigm_id" wire:model="paradigmId" hidden>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-warning btn-sm" style="margin-left: 0.5rem !important;" wire:click.prevent="resetForm">Làm mới</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="" style="margin-left: 0.5rem !important;">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    window.addEventListener('openUpdateDor', () => {
        $('#modal_update_dor').modal('show');
    })

    window.addEventListener('closeUpdateDor', () => {
        $('#modal_update_dor').modal('hide');
    })
</script>
@endpush