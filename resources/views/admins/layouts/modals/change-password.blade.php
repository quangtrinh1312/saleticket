<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đổi mật khẩu</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>

            <form action="" method="POST">
            @method('POST')
            @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label>Mật khẩu cũ<font style="color:red;"> *</font></label>
                        <div class="input-group">
                            <input type="password" name="current_password" id="current_password" value="" class="form-control"><span toggle="#current_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <p class="text-danger" id="text-current_password"></p>
                    </div>
                    <div class="row">
                        <label>Mật khẩu mới<font style="color:red;"> *</font></label>
                        <div class="input-group">
                            <input type="password" name="new_password" id="new_password" value="" class="form-control">
                            <span toggle="#new_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <p class="text-danger" id="text-new_password"></p>
                    </div>
                    <div class="row">
                        <label>Xác nhận mật khẩu<font style="color:red;"> *</font></label>
                        <div class="input-group">
                            <input type="password" name="new_confirm_password" id="new_confirm_password" value="" class="form-control">
                            <span toggle="#new_confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <p class="text-danger" id="text-new_confirm_password"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" id="btn-change-password" class="btn btn-sm btn-primary">Thay đổi</button>
            </div>
            </form>

        </div>
    </div>
</div>
<script>
	$('#btn-change-password').on('click', function() {
		$.ajax({
	        url: '{{route("change.password")}}',
	        type: 'POST',
	        data: {
	            _token: $('input[name=_token]').val(),
	            current_password: $('input[name=current_password]').val(),
	            new_password: $('input[name=new_password]').val(),
	            new_confirm_password: $('input[name=new_confirm_password]').val(),
	        }, success: function(data) {
	     		if (data.success) {
	     			new Noty({
		                text: data.message,
		                type: 'success'
		            }).show();
	     		}else {
	     			new Noty({
		                text: data.message,
		                type: 'error'
		            }).show();
	     		}
	     		$('#text-new_password').text('');
	     		$('#text-new_confirm_password').text('');
	     		$('#text-current_password').text('');
	     		$('input[name=current_password]').val('');
	     		$('input[name=new_password]').val('');
	     		$('input[name=new_confirm_password]').val('');
	        }, error: function(error) {
	        	console.log(error)
	   			if (error.responseJSON.errors.current_password !== undefined) {$('#text-current_password').text(error.responseJSON.errors.current_password[0])}else{$('#text-current_password').text('')}
	   			if (error.responseJSON.errors.new_password !== undefined) {$('#text-new_password').text(error.responseJSON.errors.new_password[0])}else{$('#text-new_password').text('')}
	   			if (error.responseJSON.errors.new_confirm_password !== undefined) {$('#text-new_confirm_password').text(error.responseJSON.errors.new_confirm_password[0])}else{$('#text-new_confirm_password').text('')}
	        }
	    });
	});

	$(".toggle-password").click(function() {

		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});
</script>