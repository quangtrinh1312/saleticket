<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MatchOldPassword;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => ['required', new MatchOldPassword],

            'new_password' => ['required'],

            'new_confirm_password' => ['same:new_password'],
        ];
    }

    public function messages() {
        return [
            'current_password.required' => 'Mật khẩu cũ không đúng!',
            'new_password.required' => 'Mật khẩu mới không được bỏ trống!',
            'new_confirm_password.same' => 'Mật khẩu mới không trùng khớp!',
        ];
    }
}
