function listCbbFullname(cbbDOM, listFromResponse) {
    cbbDOM.html('');
    $.each(listFromResponse, function(key, value) {
        cbbDOM.append('\
            <option value="'+ value.id +'">'+ value.fullname +'</option>\
        ');
    });
}

function listCbbName(cbbDOM, listFromResponse) {
    cbbDOM.html('');
    $.each(listFromResponse, function(key, value) {
        cbbDOM.append('\
            <option value="'+ value.id +'">'+ value.name +'</option>\
        ');
    });
}

function listDatalistFullname(cbbDOM, listFromResponse) {
    cbbDOM.html('');
    $.each(listFromResponse, function(key, value) {
        cbbDOM.append('\
            <option>'+ value.fullname +'</option>\
        ');
    });
}

function listDatalistName(cbbDOM, listFromResponse) {
    cbbDOM.html('');
    $.each(listFromResponse, function(key, value) {
        cbbDOM.append('\
            <option>'+ value.name +'</option>\
        ');
    });
}

function preventSpecialChar(str) {
    let regex = /[~`!@#$%\^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    return regex.test(str);
}

function preventSpecialCharNString(str) {
    let regex = /[a-zA-Z~`!@#$%\^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    return regex.test(str);
}

function preventSpecialCharNNumber(str) {
    let regex = /[0-9~`!@#$%\^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    return regex.test(str);
}

function validateSdtFormat(str) {
    let regex = /[a-zA-Z~`!@#$%\^&*_\=\[\]{};':"\\|,.<>\/?]/;
    return regex.test(str);
}

function validatePwdLength(str, name, btn, validateText) {
    if(str.length < 6) {
        if(!$(name).hasClass('border border-danger')) {
            $(name).addClass('border border-danger');
            $(name).after('<small class="text-danger">'+ validateText +'</small>');
            $(name).trigger('focus');
        }
        btn.prop('disabled', false);
        return false;
    }
    return true;
}

function validateEmailFormat(str, name, btn, validateText) {
    let validateResult = String(str)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    if(!validateResult) {
        if(!$(name).hasClass('border border-danger')) {
            $(name).addClass('border border-danger');
            $(name).after('<small class="text-danger">'+ validateText +'</small>');
            $(name).trigger('focus');
        }
        btn.prop('disabled', false);
        return false;
    }
    return true;
};

function vldSpecialChar(name, btn, vldText) {
    if(preventSpecialChar($(name).val())) {
        if(preventSpecialChar($(name).val())) {
            $(name).trigger('focus');
            $(name).addClass('border border-danger');
            $(name + ' + small').removeClass('d-none');
            $(name + ' + small').text(vldText);
            $(btn).prop('disabled', false);
        }
        return false;
    }
    return true;
}

function validateField(name, btn, event, validateText) {
    if($(name).val()?.trim() == '') {
        if(!$(name).hasClass('border border-danger')) {
            $(name).addClass('border border-danger');
            $(name).after('<small class="text-danger">'+ validateText +'</small>');
            $(document).off(event, name).on(event, name, function() {
                if($(this).val()?.trim() != '') {
                    $(this).removeClass('border border-danger');
                    $(name + '+ .text-danger').remove();
                }
            });
        }
        $(btn).prop('disabled', false);
        return false;
    }
    return true;
}

function store_3_1(currentModal_Sltor, modalCreate_Sltor, formCreate_Sltor, btnCreate_Sltor, btnRefresh_Sltor, btnSave_Sltor, name, route, _token, btnRefreshSearch_Sltor, thiss) {
    $(document).off('click', btnCreate_Sltor).on('click', btnCreate_Sltor, function(e) {
        e.preventDefault();
        $(currentModal_Sltor).modal('hide');
        $(modalCreate_Sltor).modal('show');

        $(document).off('click', btnRefresh_Sltor).on('click', btnRefresh_Sltor, function(e) {
            e.preventDefault();
            $(formCreate_Sltor).find(':input').val('');
        });

        $(document).prop('disabled', false).off('click', btnSave_Sltor).on('click', btnSave_Sltor, function(e) {
            e.preventDefault();
            $(this).prop('disabled', true);

            if(!validateField(name, $(this), 'input', 'Vui lòng nhập ' + thiss)) return;
            $.ajax({
                type: "POST",
                url: route,
                data: {
                    name: $(name).val(),
                    _token: _token,
                },
                success: function (res) {
                    if(res.status == 200) {
                        alert(res.message);
                        $(modalCreate_Sltor).modal('hide');
                        $(btnSave_Sltor).prop('disabled', false);
                        $(btnRefreshSearch_Sltor).trigger('click');
                    }
                    if(res.status == 400) {
                        alert(res.message);
                        $(btnSave_Sltor).prop('disabled', false);
                    }
                }
            });
        });

        $(document).off('hidden.bs.modal', modalCreate_Sltor).on('hidden.bs.modal', modalCreate_Sltor, function() {
            $(formCreate_Sltor).find(':input').val('');
            $(formCreate_Sltor).find('.border.border-danger').removeClass('border border-danger');
            $(formCreate_Sltor).find('.text-danger').remove();
            $(currentModal_Sltor).modal('show');
        });
    });
}

function removeValidateDanger(form) {
    $(form).find('.border.border-danger').removeClass('border border-danger');
    $(form).find('.text-danger').addClass('d-none');
}
