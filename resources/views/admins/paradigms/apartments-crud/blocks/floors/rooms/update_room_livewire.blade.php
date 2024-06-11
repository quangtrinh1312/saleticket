<div>
    <div wire:ignore.self class="modal fade" id="modal_update_room" role="dialog" aria-labelledby="exampleModalLabel_update" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel_update">Sửa Căn hộ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="update_content_room">
                    <form wire:submit.prevent="update">
                        <div class="row">
                            <div class="col-3">
                                <label class="col-form-label float-right">Chung cư:</label>
                            </div>

                            <div class="col-9">
                                <div wire:ignore>
                                    <select class="custom-select select-update" id="select-apartment-update">
                                        
                                    </select>
                                </div>
                                @error('apartmentId')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-3 mt-3">
                                <label class="col-form-label float-right">Nhà:</label>
                            </div>

                            <div class="col-9 mt-3">
                                <div wire:ignore>
                                    <select class="custom-select select-update" id="select-block-update">
                                        
                                    </select>
                                </div>
                                @error('blockId')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-3 mt-3">
                                <label class="col-form-label float-right">Tầng:</label>
                            </div>

                            <div class="col-9 mt-3">
                                <div wire:ignore>
                                    <select class="custom-select select-update" id="select-floor-update">
                                        
                                    </select>
                                </div>
                                @error('floorId')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-3 mt-3">
                                <label for="name" class="col-form-label float-right">Tên Căn Hộ:</label>
                            </div>
                            <div class="col-9 mt-3">
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
    $(document).ready(function() {
        $('.select-update').select2({
            placeholder: '‎',
            allowClear: false,
        });

        $('#select-apartment-update').on('change', function(e) {
            var value = $('#select-apartment-update').select2("val");
            @this.set('apartmentId', value);
        })

        $('#select-block-update').on('change', function(e) {
            var value = $('#select-block-update').select2("val");
            @this.set('blockId', value);
        })

        $('#select-floor-update').on('change', function(e) {
            var value = $('#select-floor-update').select2("val");
            @this.set('floorId', value);
        })
    });

    window.addEventListener('openUpdateRoom', () => {
        $('#modal_update_room').modal('show');
    })

    window.addEventListener('closeUpdateRoom', () => {
        $('#modal_update_room').modal('hide');
    })

    window.addEventListener('updateEditSelectBox', (e) => {
        var list = @this.get(e.detail + 'Arr')
        var selectedItemId = @this.get(e.detail + 'Id')
        var selectBox = $('#select-' + e.detail + '-update')
        
        selectBox.empty()
        
        if (Object.keys(list).length > 0) {
            Object.keys(list).forEach((key) => {
                var selected = false
                if (key == selectedItemId) selected = true

                selectBox.append(new Option(list[key], key, false, selected))
            })
        }

        selectBox.trigger('change')
    })
</script>
@endpush