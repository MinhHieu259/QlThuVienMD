<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $rules = [
            'name' => [
              'required'
            ],
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'min:8'
            ],
            'retypepassword' => [
                'required',
                'same:password'
            ]
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ và tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Không nhập đúng định dạng của email',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 8 kí tự',
            'retypepassword.required' => 'Bạn chưa nhập lại mật khẩu',
            'retypepassword.same' => 'Mật khẩu nhập lại chưa đúng'
        ];
    }
}
