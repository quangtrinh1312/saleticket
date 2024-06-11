<div>
    <div wire:ignore.self class="modal fade" id="modal_create_apartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo Chung Cư</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click.prevent="resetForm">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="create">
                        <div class="row">
                            <div class="col-3">
                                <label for="name" class="col-form-label float-right">Tên Chung cư:</label>
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
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal" wire:click.prevent="resetForm">Đóng</button>
                            <button type="button" class="btn btn-warning btn-sm" style="margin-left: 0.5rem !important;" wire:click.prevent="resetForm">Làm mới</button>
                            <button type="submit" class="btn btn-primary btn-sm" style="margin-left: 0.5rem !important;">Lưu và Tạo mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    window.addEventListener('openCreateApartment', () => {
        $('#modal_create_apartment').modal('show');
    })

    window.addEventListener('closeCreateApartment', () => {
        $('#modal_create_apartment').modal('hide');
    })
</script>
@endpush