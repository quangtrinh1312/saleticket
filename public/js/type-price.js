// tp = Type Price

function tpValidate(name, btn) {
    let validateName = validateField(name, btn, 'input', 'Vui lòng nhập Loại tiền');
    if(!validateName) return false;
    return true;
}

$(document).off('keypress', '#tp_name_create, #tp_name_edit').on('keypress', '#tp_name_create, #tp_name_edit', function(e) {
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if(preventSpecialCharNNumber(key)) e.preventDefault();
})

$(document).off('click', '#tp_btn_create').on('click', '#tp_btn_create', function(e) {
    e.preventDefault();
    $('#tp_modal_create').modal('show');

    $(document).prop('disabled', false).off('click', '#tp_btn_store').on('click', '#tp_btn_store', function(e) {
        e.preventDefault();
        $(this).prop('disabled', true);
        let name = $('#tp_name_create');
        let typeReceipt = $('#tp_type_receipt_create');
        let account_create = $('#account_create');
        if(!tpValidate('#tp_name_create', $(this))) return;
        if(preventSpecialCharNNumber(name.val())) {
            // alert('Loại tiền không hợp lệ');
            name.trigger('focus');
            if(!$('#tp_name_create + small.text-danger').length) {
                name.after('<small class="text-danger">Loại tiền không hợp lệ</small>');
                name.addClass('border border-danger');
            }
            $(this).prop('disabled', false);
            return;
        }
        $.ajax({
            type: "POST",
            url: route.store,
            data: {
                name: name.val(),
                typeReceiptId: typeReceipt.val(),
                paradigmId: paradigmId,
                account_id: account_create.val(),
                _token: token,
            },
            success: function (res) {
                if(res.status === 0) {
                    alert(res.message);
                    $('#tp_btn_store').prop('disabled', false);
                    $('#tp_modal_create').modal('hide');
                    handleChange('#tp_row', 5);
                }
                if(res.status === 1 || res.status === 2) {
                    alert(res.message);
                    $('#tp_btn_store').prop('disabled', false);
                    name.trigger('focus');
                }
            }
        });
    });

    $(document).off('click', '#tp_btn_refresh_store').on('click', '#tp_btn_refresh_store', function(e) {
        e.preventDefault();
        $('#tp_form_create').find(':input:not("#tp_type_receipt_create")').val('');
        $('#tp_type_receipt_create').val('1');
        removeValidateDanger('#tp_form_create');
    });
    
    $(document).off('hidden.bs.modal', '#tp_modal_create').on('hidden.bs.modal', '#tp_modal_create', function() {
        $('#tp_btn_refresh_store').trigger('click');
    });
});
    
$(document).off('click', '#tp_btn_edit').on('click', '#tp_btn_edit', function(e) {
    e.preventDefault();
    let id = $(this).val();
    let name = $('#tp_name_edit');
    let typeReceipt = $('#tp_type_receipt_edit');
    let account = $('#account_edit');
    $('#tp_modal_edit').modal('show');

    $(document).off('shown.bs.modal', '#tp_modal_edit').on('shown.bs.modal', '#tp_modal_edit', function() {
        $.ajax({
            type: "GET",
            url: route.edit.replace(':id', id),
            success: function (res) {
                if(res.typePrice !== null) {
                    name.val(res.typePrice.type);
                    typeReceipt.html('');
                    account.html('');
                    $.each(res.typeReceipts, function(key, value) {
                        typeReceipt.append('<option value="'+ value.id +'">'+ value.type +'</option>');
                        if(value.id == res.typePrice.type_receipt_id) {
                            $('#tp_type_receipt_edit > option').prop('selected', true);
                        }
                    });

                    $.each(res.accounts, function(key1, value1) {
                        account.append('<option value="'+ value1.id +'">'+ value1.fullname +'</option>');
                        if(value1.id == res.typePrice.account_id) {
                            $('#account_edit > option').prop('selected', true);
                        }
                    });
                }
            }
        });
    });

    $(document).prop('disabled', false).off('click', '#tp_btn_update').on('click', '#tp_btn_update', function(e) {
        e.preventDefault();
        $(this).prop('disabled', true);
        if(!tpValidate('#tp_name_edit', $(this))) return;
        if(preventSpecialCharNNumber(name.val())) {
            // alert('Loại tiền không hợp lệ');
            name.trigger('focus');
            if(!$('#tp_name_edit + small.text-danger').length) {
                name.after('<small class="text-danger">Loại tiền không hợp lệ</small>');
                name.addClass('border border-danger');
            }
            $(this).prop('disabled', false);
            return;
        }
        $.ajax({
            type: "PATCH",
            url: route.update.replace(':id', id),
            data: {
                name: name.val(),
                typeReceiptId: typeReceipt.val(),
                paradigmId: paradigmId,
                account_id: account.val(),
                _token: token,
            },
            success: function (res) {
                if(res.status === 0) {
                    alert(res.message);
                    $('#tp_btn_update').prop('disabled', false);
                    $('#tp_modal_edit').modal('hide');
                    handleChange('#tp_row', 5);
                }
                if(res.status === 1 || res.status === 2) {
                    alert(res.message);
                    $('#tp_btn_update').prop('disabled', false);
                    name.trigger('focus');
                }
            }
        });
    });

    $(document).off('click', '#tp_btn_refresh_update').on('click', '#tp_btn_refresh_update', function(e) {
        e.preventDefault();
        $('#tp_modal_edit').trigger('shown.bs.modal');
        removeValidateDanger('#tp_form_edit');
    });

    $(document).off('hidden.bs.modal', '#tp_modal_edit').on('hidden.bs.modal', '#tp_modal_edit', function() {
        $('#tp_btn_refresh_update').trigger('click');
    });
});

$(document).off('click', '#tp_btn_delete').on('click', '#tp_btn_delete', function(e) {
    e.preventDefault();
    let id = $(this).val();
    $('#tp_modal_delete').modal('show');

    $(document).prop('disabled', false).off('click', '#tp_btn_destroy').on('click', '#tp_btn_destroy', function(e) {
        e.preventDefault();
        $(this).prop('disabled', true);
        $.ajax({
            type: "DELETE",
            url: route.destroy.replace(':id', id),
            data: { _token: token, },
            success: function (res) {
                if(res.status === 0) {
                    alert(res.message);
                    $('#tp_btn_destroy').prop('disabled', false);
                    $('#tp_modal_delete').modal('hide');
                    handleChange('#tp_row', 5);
                }
                if(res.status === 1) {
                    alert(res.message);
                    $('#tp_btn_destroy').prop('disabled', false);
                }
            }
        });
    });
});

$(document).off('click', '.pagination a').on('click', '.pagination a', function(e) {
    e.preventDefault();
    let page = $(this).attr('href').split('?page=')[1];
    let numRow = $('#tp_row').val();
    $.ajax({
        url: "/admins/paradigms-apartments-type-price/pagination/fetch?page=" + page,
        data: { 
            paradigmId: paradigmId,
            numRow: numRow > 0 ? numRow : 0,
        },
        success: function (res) {
            $('#list_type_price_table').html(res);
            $('#tp_row').val(numRow);
        }
    });
});

function handleChange(row, value = $(row).val()) {
    let numRow = value;
    $.ajax({
        url: route.getRow,
        data: {
            paradigmId: paradigmId,
            numRow: numRow,
        },
        success: function (res) {
            $('#list_type_price_table').html(res);
            $(row).val(numRow);
        }
    });
}

$(document).off('change', '#tp_row').on('change', '#tp_row', function() {
    handleChange(this);
});
