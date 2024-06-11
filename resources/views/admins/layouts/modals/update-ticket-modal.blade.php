<div class="modal fade" id="updateTicketModal" tabindex="-1" role="dialog" aria-labelledby="updateTicketLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateTicketLabel">Chỉnh sửa loại vé</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>

            <form action="#!">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label>Tên loại vé</label>
                        <div class="input-group">
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <label>Tên hiển thị</label>
                        <div class="input-group">
                            <textarea name="name" id="name" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <label>Giá sau thuế</label>
                        <div class="input-group">
                            <input type="number" name="post_tax_price" id="post_tax_price" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">Tính trước thuế</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label>Giá trước thuế</label>
                        <div class="input-group">
                            <input type="number" name="pre_tax_price" id="pre_tax_price" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="row">
                                <label>VAT</label>
                                <div class="input-group">
                                    <select name="vat" id="vat" class="form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5">
                            <div class="row">
                                <label>Ghi chú</label>
                                <div class="input-group">
                                    <input type="text" name="note" id="note" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="row">
                                <label>Mẫu số</label>
                                <div class="input-group">
                                    <input type="text" name="pattern" id="pattern" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5">
                            <div class="row">
                                <label>Ký hiệu</label>
                                <div class="input-group">
                                    <input type="text" name="serial" id="serial" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-sm btn-primary">Cập nhật</button>
            </div>
            </form>

        </div>
    </div>
</div>