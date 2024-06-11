$('#modal_change_pwd').off('hidden.bs.modal').on('hidden.bs.modal', function() {
    $('#form_change_pwd').find(':input').val('');
    removeValidateDanger('#form_change_pwd');
});

function showModal(e) {
    e.preventDefault();
    $('#modal_change_pwd').modal('show');
}

function confirmChangePwd(e, btn, route, _token) {
    e.preventDefault();
    let currPwd = $('#curr_pwd');
    let newPwd = $('#new_pwd');
    let confirmPwd = $('#confirm_pwd');
    let validateCurrPwd = validateField('#curr_pwd', btn, 'input', 'Hãy nhập mật khẩu hiện tại');
    let validateNewPwd = validateField('#new_pwd', btn, 'input', 'Hãy nhập mật khẩu mới');
    let validateConfirmPwd = validateField('#confirm_pwd', btn, 'input', 'Hãy xác nhận lại mật khẩu');
    if(!validateCurrPwd || !validateNewPwd || !validateConfirmPwd) {
        currPwd.trigger('focus');
        return;
    }
    if(confirmPwd.val() != newPwd.val()) {
        alert('Mật khẩu xác nhận không trùng khớp');
        confirmPwd.trigger('focus');
        return;
    }
    if(!validatePwdLength(newPwd.val(), '#new_pwd', $(btn), 'Vui lòng nhập mật khẩu tối thiểu 6 ký tự')) {
        newPwd.trigger('focus');
        return;
    }
    $(btn).prop('disabled', true);
    $.ajax({
        type: "POST",
        url: route,
        data: { 
            currPwd: currPwd.val(),
            newPwd: newPwd.val(),
            _token: _token,
        },
        success: function (res) {
            if(res.status === 0) {
                alert(res.message);
                $('#modal_change_pwd').modal('hide');
                $(btn).prop('disabled', false);
                window.location.reload();
            }
            if(res.status === 1) {
                alert(res.message);
                $(btn).prop('disabled', false);
            }
            if(res.status === 2) {
                alert(res.message);
                $(btn).prop('disabled', false);
                newPwd.val('');
                newPwd.trigger('focus');
                confirmPwd.val('');
            }
        }
    });
}

$(document).off('input', '#new_pwd').on('input', '#new_pwd', function() {
    if($(this).hasClass('border border-danger')) {
        $(this).removeClass('border border-danger');
        $('#new_pwd' + ' + .text-danger').remove();
    }
});
