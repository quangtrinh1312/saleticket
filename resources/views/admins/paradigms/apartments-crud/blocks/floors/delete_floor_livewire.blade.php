<div>
    <div wire:ignore.self class="modal fade" id="modal_delete_floor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>Bạn có chắc muốn xóa Tầng?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="delete" class="btn btn-danger close-modal">Đồng ý</button>
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    window.addEventListener('openDeleteFloor', () => {
        $('#modal_delete_floor').modal('show');
    })

    window.addEventListener('closeDeleteFloor', () => {
        $('#modal_delete_floor').modal('hide');
    })
</script>
@endpush