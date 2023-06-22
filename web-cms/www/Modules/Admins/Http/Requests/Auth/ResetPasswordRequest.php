<?php

namespace Modules\Admins\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required||exists:admin_reset_passwords,token|max:50',
            'g-recaptcha-response' => 'required|captcha',
            'new_password' => 'required|max:50|min:6|alpha_dash',
            'confirm_password' => 'required|same:new_password',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
