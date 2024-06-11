<div>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Tìm kiếm</legend>
        <form wire:submit.prevent="search" wire:ignore>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-10">
                        @if ($householdType == 1)
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Chung cư:</label>
                                <button type="button" class="btn btn-link btn-sm" wire:click.prevent="$emit('openCreateApartment')" data-toggle="tooltip" data-html="true" data-placement="right" title="<small>Thêm Chung cư</small>"><i class="fa-solid fa-circle-plus"></i></button>
                                <select class="custom-select select-search" id="select-apartment-search">
                                    <option></option>
                                    @if ($apartments && count($apartments) > 0)
                                        @foreach ($apartments as $apartment)
                                            <option value="{{$apartment}}">{{$apartment}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Nhà:</label>
                                <button type="button" class="btn btn-link btn-sm" wire:click.prevent="$emit('openCreateBlock')" data-toggle="tooltip" data-html="true" data-placement="right" title="<small>Thêm Nhà</small>"><i class="fa-solid fa-circle-plus"></i></button>
                                <select class="custom-select select-search" id="select-block-search">
                                    <option></option>
                                    @if ($blocks && count($blocks) > 0)
                                        @foreach ($blocks as $block)
                                            <option value="{{$block}}">{{$block}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Tầng:</label>
                                <button type="button" class="btn btn-link btn-sm" wire:click.prevent="$emit('openCreateFloor')" data-toggle="tooltip" data-html="true" data-placement="right" title="<small>Thêm Tầng</small>"><i class="fa-solid fa-circle-plus"></i></button>
                                <select class="custom-select select-search" id="select-floor-search">
                                    <option></option>
                                    @if ($floors && count($floors) > 0)
                                        @foreach ($floors as $floor)
                                            <option value="{{$floor}}">{{$floor}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Căn hộ:</label>
                                <button type="button" class="btn btn-link btn-sm" wire:click.prevent="$emit('openCreateRoom')" data-toggle="tooltip" data-html="true" data-placement="right" title="<small>Thêm Căn hộ</small>"><i class="fa-solid fa-circle-plus"></i></button>
                                <select class="custom-select select-search" id="select-room-search">
                                    <option></option>
                                    @if ($rooms && count($rooms) > 0)
                                        @foreach ($rooms as $room)
                                            <option value="{{$room}}">{{$room}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @elseif($householdType == 2)
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Quận/Huyện:</label>
                                <select class="custom-select select-search" id="select-district-search">
                                    <option></option>
                                    @if ($districts && count($districts) > 0)
                                        @foreach ($districts as $district)
                                            <option value="{{$district}}">{{$district}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Phường/Xã:</label>
                                <select class="custom-select select-search" id="select-ward-search">
                                    <option></option>
                                    @if ($wards && count($wards) > 0)
                                        @foreach ($wards as $ward)
                                            <option value="{{$ward}}">{{$ward}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="apartment_number" class="col-form-label">Số nhà:</label>
                                <input type="text" name="apartment_number" class="form-control form-control-sm" wire:model.lazy="apartmentNumber">
                            </div>
                            <div class="col-6">
                                <label for="street" class="col-form-label">Tên đường:</label>
                                <input type="text" name="street" class="form-control form-control-sm" wire:model.lazy="street">
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-6">
                                <label for="name" class="col-form-label">Tên Hộ dân:</label>
                                <input type="text" name="name" class="form-control form-control-sm" wire:model.lazy="name">
                            </div>
                            <div class="col-6">
                                <label for="phone" class="col-form-label">Số điện thoại:</label>
                                <input type="tel" name="phone" class="form-control form-control-sm" wire:model.lazy="phone">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="account_id" class="col-form-label">Quản lý viên:</label>
                                <select name="account_id" class="custom-select select-search" id="select-account-search">
                                    <option></option>
                                    @if ($accounts && count($accounts) > 0)
                                        @foreach ($accounts as $account)
                                            <option value="{{$account->id}}">{{$account->fullname}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="status_id" class="col-form-label">Hiện trạng:</label>
                                <select name="status_id" class="custom-select select-search" id="select-status-search">
                                    <option></option>
                                    @if ($statuses && count($statuses) > 0)
                                        @foreach ($statuses as $status)
                                            <option value="{{$status->id}}">{{$status->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="form-control  btn btn-success btn-sm mt-3">
                            <i class="fa-solid fa-magnifying-glass mr-1"></i>
                            Tìm kiếm
                        </button>
                        <button type="button" class="form-control  btn btn-warning btn-sm mt-3" wire:click.prevent="resetForm">
                            <i class="fa-solid fa-arrows-rotate mr-1"></i>
                            Làm mới
                        </button>
                    </div>
                </div>
                <div class="row">
                    




                    <input type="text" name="paradigm_id" wire:model.lazy="paradigmId" hidden>
                </div>

            </div>
        </form>
    </fieldset>
</div>

@push('script')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(document).ready(function() {
        $('.select-search').select2({
            placeholder: '‎',
            allowClear: true,
        });

        $('#select-apartment-search').on('change', function(e) {
            var value = $('#select-apartment-search').select2("val");
            @this.set('apartmentName', value);
        })

        $('#select-block-search').on('change', function(e) {
            var value = $('#select-block-search').select2("val");
            @this.set('blockName', value);
        })

        $('#select-floor-search').on('change', function(e) {
            var value = $('#select-floor-search').select2("val");
            @this.set('floorName', value);
        })

        $('#select-room-search').on('change', function(e) {
            var value = $('#select-room-search').select2("val");
            @this.set('roomName', value);
        })

        $('#select-district-search').on('change', function(e) {
            var value = $('#select-district-search').select2("val");
            @this.set('districtName', value);
        })

        $('#select-ward-search').on('change', function(e) {
            var value = $('#select-ward-search').select2("val");
            @this.set('wardName', value);
        })

        $('#select-account-search').on('change', function(e) {
            var value = $('#select-account-search').select2("val");
            @this.set('accountId', value);
        })

        $('#select-status-search').on('change', function(e) {
            var value = $('#select-status-search').select2("val");
            @this.set('statusId', value);
        })
    });

    window.addEventListener('updateSearchSelectBox', (e) => {
        var list = @this.get(e.detail + 's')
        var selectedItem = @this.get(e.detail + 'Name')
        var selectBox = $('#select-' + e.detail + '-search')
        
        selectBox.empty()
        
        if (list.length > 0) {
            selectBox.append(new Option('', '', false, true))
            list.forEach((item) => {
                var selected = false
                if (item === selectedItem) selected = true

                selectBox.append(new Option(item, item, false, selected))
            })
        }

        selectBox.trigger('change')
    })

    window.addEventListener('resetAccountSelectBox', (e) => {
        $('#select-account-search').val(null).trigger('change')
    })

    window.addEventListener('resetStatusSelectBox', (e) => {
        $('#select-status-search').val(null).trigger('change')
    })
</script>
@endpush