<?php

namespace App\Http\Requests;

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
        return [
            'name' => ['required', 'string', 'max:60'],
            'phone' => ['required', 'numeric', 'unique:users','regex:/^(0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required','unique:users','email'],

        ];
        
    }
    public function messages()
    {
        return [
            'name.required' => 'Yêu cầu nhập tên',
            'name.string' => 'Tên phải là chữ',
            'name.max' => 'Tên không dài quá 60 ký tự',
            'email.required' => 'Yêu cầu nhập email',
            'email.unique' => 'Email đã được sử dụng',
            'email.email' => 'Email phải có đuôi @',
            'phone.required' => 'Yêu cầu nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại phải là số',
            'phone.unique' => 'Số điện thoại đã được đăng ký',
            'phone.regex' => 'Số điện thoại phâỉ thuộc danh mục số điện thoại việt nam',
            'password.required' => 'Yêu cầu nhập mật khẩu',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự',
            'password.min' => 'Mật khẩu không được nhỏ hơn 8 kí tự',
            'password.confirmed' => 'Mật khẩu không trùng vui lòng nhập lại',
        ];
    }
}
