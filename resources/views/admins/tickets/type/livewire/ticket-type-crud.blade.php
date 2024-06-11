@push('style')
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}

.form-control,
.input-group-text {
    border-color: rgb(158, 158, 158);
}

.crud-label {
    font-weight: bold;
}
</style>
@endpush

<div>
    <div class="modal fade" id="crudTicketTypeModal" tabindex="-1" role="dialog" aria-labelledby="createTicketLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTicketLabel" wire:loading.remove wire:target="modalSetup">
                        @if ($action == 'create')
                        Thêm mới loại vé
                        @elseif ($action == 'update')
                        Chỉnh sửa loại vé
                        @elseif ($action == 'delete')
                        Xác nhận xóa
                        @endif
                    </h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>

                <div class="container py-4" wire:loading wire:target="modalSetup">
                    <div class="row align-items-center justify-content-center">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="ml-2">Vui lòng đợi</span>
                    </div>
                </div>
    
                <form wire:submit.prevent="{{ $action }}">
                <div class="modal-body" wire:loading.remove wire:target="modalSetup">

                    @if ($action == 'delete')
                    <div class="container-fluid">
                        <div class="row">
                            <span>Bạn có muốn xóa "{{ $name }}"?</span>
                        </div>
                    </div>
                    @else
                    <div class="container-fluid">
                        <div class="row">
                            <label class="crud-label">Tên loại vé</label>
                            <div class="input-group">
                                <input type="text" class="form-control" wire:model.lazy="title">
                            </div>
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <label class="crud-label">Tên hiển thị</label>
                            <div class="input-group">
                                <textarea rows="4" class="form-control" wire:model.lazy="name"></textarea>
                            </div>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <label class="crud-label">Giá sau thuế</label>
                            <div class="input-group">
                                <input type="text" class="form-control number-separator" wire:model.debounce.500ms="postVatPrice">
                                <div class="input-group-append">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                            </div>
                            @error('postVatPrice')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <label class="crud-label">Giá trước thuế</label>
                            <div class="input-group">
                                <input type="text" class="form-control" readonly wire:model="preVatPrice">
                                <div class="input-group-append">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <div class="row">
                                    <label class="crud-label">VAT</label>
                                    <div class="input-group">
                                        <select class="form-control" wire:model.lazy="vat">
                                            <option value="0">Không chịu thuế</option>
                                            <option value="0">0%</option>
                                            <option value="0.03">3%</option>
                                            <option value="0.05">5%</option>
                                            <option value="0.08">8%</option>
                                            <option value="0.1">10%</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">
                                <div class="row">
                                    <label class="crud-label">Ghi chú</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" wire:model.lazy="note">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <div class="row">
                                    <label class="crud-label">Mẫu số</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" wire:model.lazy="pattern">
                                    </div>
                                    @error('pattern')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">
                                <div class="row">
                                    <label class="crud-label">Ký hiệu</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" wire:model.lazy="serial">
                                    </div>
                                    @error('serial')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer" wire:loading.remove wire:target="modalSetup">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{ $action == 'delete' ? 'Hủy' : 'Đóng' }}</button>
                    <button type="submit" class="btn btn-sm btn-primary">{{ $action == 'delete' ? 'Đồng ý' : 'Lưu' }}</button>
                </div>
                </form>
    
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function() {
        $('#crudTicketTypeModal').on('show.bs.modal', function(e) {
            var id = e.relatedTarget.getAttribute('data-ticket-type-id') ?? 0
            @this.call('modalSetup', id)
        })

        $(document).on('closeCrudTicketType', function() {
            $('#crudTicketTypeModal').modal('hide')
        })
    })
</script>
@endpush