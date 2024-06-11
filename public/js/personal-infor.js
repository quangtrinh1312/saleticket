function iValidate(fullname, email, btn) {
    let validateFullname = validateField(fullname, btn, 'input', 'Vui lòng nhập Họ tên');
    let validateEmail = validateField(email, btn, 'input', 'Vui lòng nhập Email');
    if(!validateFullname || !validateEmail)
        return false;
    return true;
}

function showModalInfor(e, btn, routeEdit, routeUpdate, _token) {
    e.preventDefault();
    $('#modal_show_infor').modal('show');
    let authId = $(btn).val();
    let fullname = $('#i_fullname_edit');
    let username = $('#i_username_edit');
    let email = $('#i_email_edit');
    let phoneNumber = $('#i_phone_number_edit');

    let url = routeEdit.replace(':id', authId);
    $.ajax({
        type: "GET",
        url: url,
        success: function (res) {
            if(res.account !== null) {
                fullname.val(res.account.fullname);
                username.val(res.account.username);
                email.val(res.account.email);
                phoneNumber.val(res.account.phone_number);
            }
        }
    });

    $(document).off('keypress', '#i_fullname_edit').on('keypress', '#i_fullname_edit', function(e) {
        var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if(preventSpecialCharNNumber(key)) e.preventDefault();
    });

    $(document).off('keypress', '#i_phone_number_edit').on('keypress', '#i_phone_number_edit', function(e) {
        var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if(validateSdtFormat(key)) e.preventDefault();
    });

    $(document).off('click', '#i_btn_enable').on('click', '#i_btn_enable', function(e) {
        e.preventDefault();
        $('#form_show_infor').find(':input:not("#i_username_edit")').prop('disabled', false);
        fullname.trigger('focus');
        $('#i_btn_update').removeClass('d-none');
    });

    $(document).prop('disabled', false).off('click', '#i_btn_update').on('click', '#i_btn_update', function(e) {
        e.preventDefault();
        $(this).prop('disabled', true);
        if(!iValidate('#i_fullname_edit', '#i_email_edit', $(this))) return;
        if(!validateEmailFormat(email.val(), '#i_email_edit', $(this), 'Email không đúng định dạng. Hãy thử lại')) return;
        if(preventSpecialCharNNumber(fullname.val())) {
            alert('Họ tên không hợp lệ');
            fullname.trigger('focus');
            $(this).prop('disabled', false);
            return;
        }
        if(phoneNumber.val() != '') {
            if(validateSdtFormat(phoneNumber.val())) {
                alert('Số điện thoại không hợp lệ');
                phoneNumber.trigger('focus')
                $(this).prop('disabled', false);
                return;
            }
        }
        let url = routeUpdate.replace(':id', authId);
        $.ajax({
            type: "PATCH",
            url: url,
            data: {
                fullname: fullname.val(),
                email: email.val(),
                phoneNumber: phoneNumber.val(),
                _token: _token,
            },
            success: function (res) {
                if(res.status === 0) {
                    alert(res.message);
                    $('#i_btn_update').prop('disabled', false);
                    $('#modal_show_infor').modal('hide');
                    window.location.reload();
                }
                if(res.status === 1) {
                    alert(res.message);
                    $('#i_btn_update').prop('disabled', false);
                }
            },
            error: function(res) {
                let message = res.responseJSON.message;
                if(message.indexOf('SQLSTATE[23000]') !== -1 && message.indexOf('1062 Duplicate entry') !== -1 && message.indexOf('accounts_email_unique') !== -1) {
                    alert('Email này đã tồn tại');
                    $('#i_btn_update').prop('disabled', false);
                }
                if(message.indexOf('SQLSTATE[23000]') !== -1 && message.indexOf('1062 Duplicate entry') !== -1 && message.indexOf('accounts_phone_number_unique') !== -1) {
                    alert('Số điện thoại này đã tồn tại');
                    $('#i_btn_update').prop('disabled', false);
                }
            }
        });
    });

    $(document).off('hidden.bs.modal', '#modal_show_infor').on('hidden.bs.modal', '#modal_show_infor', function() {
        $('#form_show_infor').find(':input:not("#i_btn_enable")').prop('disabled', true);
        $('#i_btn_update').addClass('d-none');
    });
}
