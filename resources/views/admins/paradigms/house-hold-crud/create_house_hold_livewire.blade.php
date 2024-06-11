<div>
    <div wire:ignore.self class="modal fade" id="modal_create_household" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo Hộ dân</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="create">
                        <div class="row pb-3">
                            @if ($householdType == 1)
                            <div class="col-3">
                                <label class="col-form-label float-right">Chung cư:</label>
                            </div>

                            <div class="col-9">
                                <div wire:ignore>
                                    <select class="custom-select select-create-household" id="select-apartment-create-household">
                                        
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
                                    <select class="custom-select select-create-household" id="select-block-create-household">
                                        
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
                                    <select class="custom-select select-create-household" id="select-floor-create-household">
                                        
                                    </select>
                                </div>
                                @error('floorId')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-3 mt-3">
                                <label class="col-form-label float-right">Căn hộ:</label>
                            </div>

                            <div class="col-9 mt-3">
                                <div wire:ignore>
                                    <select class="custom-select select-create-household" id="select-room-create-household">
                                        
                                    </select>
                                </div>
                                @error('roomId')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            @elseif ($householdType == 2)
                            <div class="col-3 mt-3">
                                <label class="col-form-label float-right">Quận/Huyện:</label>
                            </div>

                            <div class="col-9 mt-3">
                                <div wire:ignore>
                                    <select class="custom-select select-create-household" id="select-district-create-household">
                                        
                                    </select>
                                </div>
                                @error('districtId')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-3 mt-3">
                                <label class="col-form-label float-right">Phường:</label>
                            </div>

                            <div class="col-9 mt-3">
                                <div wire:ignore>
                                    <select class="custom-select select-create-household" id="select-ward-create-household">
                                        
                                    </select>
                                </div>
                                @error('wardId')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-3 mt-3 ">
                                <label for="apartment_name" class="col-form-label float-right">Số nhà:</label>
                            </div>
                            <div class="col-9 mt-3">
                                <input type="text" name="apartment_name" class="form-control form-control-sm" wire:model.lazy="apartmentNumber">
                                @error('apartmentNumber')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-3 mt-3 ">
                                <label for="street" class="col-form-label float-right">Tên đường:</label>
                            </div>
                            <div class="col-9 mt-3">
                                <input type="text" name="street" class="form-control form-control-sm" wire:model.lazy="street">
                                @error('street')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            @endif

                            <div class="col-3 mt-3 ">
                                <label for="name" class="col-form-label float-right">Tên Hộ Dân:</label>
                            </div>
                            <div class="col-9 mt-3">
                                <input type="text" name="name" class="form-control form-control-sm" wire:model.lazy="name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-3 mt-3 ">
                                <label for="phone" class="col-form-label float-right">Số điện thoại:</label>
                            </div>
                            <div class="col-9 mt-3">
                                <input type="tel" name="phone" class="form-control form-control-sm" wire:model.lazy="phone">
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-3 mt-3">
                                <label class="col-form-label float-right">Quản lý viên:</label>
                            </div>
                            <div class="col-9 mt-3">
                                <div wire:ignore>
                                    <select class="custom-select select-create-household" id="select-account-create-household">
                                        
                                    </select>
                                </div>
                                @error('accountId')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-3 mt-3">
                                <label class="col-form-label float-right">Hiện trạng:</label>
                            </div>
                            <div class="col-9 mt-3">
                                <div wire:ignore>
                                    <select class="custom-select select-create-household" id="select-status-create-household">
                                        
                                    </select>
                                </div>
                                @error('statusId')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <input type="text" name="paradigm_id" wire:model="paradigmId" hidden>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Đóng</button>
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
    $(document).ready(function() {
        $('.select-create-household').select2({
            placeholder: '‎',
            allowClear: false,
        });

        $('#select-apartment-create-household').on('change', function(e) {
            var value = $('#select-apartment-create-household').select2("val");
            @this.set('apartmentId', value);
        })

        $('#select-block-create-household').on('change', function(e) {
            var value = $('#select-block-create-household').select2("val");
            @this.set('blockId', value);
        })

        $('#select-floor-create-household').on('change', function(e) {
            var value = $('#select-floor-create-household').select2("val");
            @this.set('floorId', value);
        })

        $('#select-room-create-household').on('change', function(e) {
            var value = $('#select-room-create-household').select2("val");
            @this.set('roomId', value);
        })

        $('#select-district-create-household').on('change', function(e) {
            var value = $('#select-district-create-household').select2("val");
            @this.set('districtId', value);
        })

        $('#select-ward-create-household').on('change', function(e) {
            var value = $('#select-ward-create-household').select2("val");
            @this.set('wardId', value);
        })

        $('#select-account-create-household').on('change', function(e) {
            var value = $('#select-account-create-household').select2("val");
            @this.set('accountId', value);
        })

        $('#select-status-create-household').on('change', function(e) {
            var value = $('#select-status-create-household').select2("val");
            @this.set('statusId', value);
        })
    });

    window.addEventListener('openCreateHouseHold', () => {
        $('#modal_create_household').modal('show');
    })

    window.addEventListener('closeCreateHouseHold', () => {
        $('#modal_create_household').modal('hide');
    })

    window.addEventListener('updateCreateHouseholdSelectBox', (e) => {
        var list = @this.get(e.detail + 'Arr')
        var selectedItemId = @this.get(e.detail + 'Id')
        var selectBox = $('#select-' + e.detail + '-create-household')
        
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