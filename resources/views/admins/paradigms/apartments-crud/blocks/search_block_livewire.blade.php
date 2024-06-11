<div>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Tìm kiếm</legend>
        <form wire:submit.prevent="search" wire:ignore>
            <div class="form-group">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <label>Chung cư:</label>
                        <select class="custom-select select" id="select-apartment">
                            <option></option>
                            @if ($apartments && count($apartments) > 0)
                                @foreach ($apartments as $apartment)
                                    <option value="{{$apartment}}">{{$apartment}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label>Nhà:</label>
                        <select class=" custom-select select" id="select-block">
                            <option></option>
                            @if ($blocks && count($blocks) > 0)
                                @foreach ($blocks as $block)
                                    <option value="{{$block}}">{{$block}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4">
                        <label></label>
                        <input type="text" name="paradigm_id" wire:model="paradigmId" hidden>
                        <button type="submit" class="form-control  btn btn-success btn-sm">
                            <i class="fa-solid fa-magnifying-glass mr-1"></i>
                            Tìm kiếm
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </fieldset>
</div>

@push('script')
<script>
    $(document).ready(function() {
        $('.select').select2({
            placeholder: '‎',
            allowClear: true,
        });

        $('#select-apartment').on('change', function(e) {
            var value = $('#select-apartment').select2("val");
            @this.set('apartmentName', value);
        })

        $('#select-block').on('change', function(e) {
            var value = $('#select-block').select2("val");
            @this.set('blockName', value);
        })
    });

    window.addEventListener('updateSelectBox', (e) => {
        var list = @this.get(e.detail + 's')
        var selectedItem = @this.get(e.detail + 'Name')
        var selectBox = $('#select-' + e.detail)
        
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
</script>
@endpush
