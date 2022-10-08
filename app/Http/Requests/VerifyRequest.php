<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends FormRequest
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
            'verification_code' => ['required', 'numeric'],
            'phone' => ['required', 'numeric', 'regex:/^(0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
        ];
    }
    public function messages()
    {
        return [
            'verification_code.required' => 'Yêu cầu nhập mã xác minh',
            'verification_code.numeric' => 'Mã xác minh phải là số',
            'phone.required' => 'Yêu cầu nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại phải là số',
            'phone.regex' => 'Số điện thoại phải thuộc đầu số Việt Nam',
        ];
    }
}
