<?php

namespace App\Http\Requests;

use App\Rules\Throttle;
use Illuminate\Foundation\Http\FormRequest;

class ResendVerifyRequest extends FormRequest
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
            'phone' => ['required', 
            'numeric', 
            'regex:/^(0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/',
            new Throttle('resend', $maxAttempts = 3, $minutes = 1),
        ],
        ];
    }
    public function messages()
    {
        return [
            'phone.required' => 'Yêu cầu nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại phải là số',
            'phone.regex' => 'Số điện thoại phải thuộc đầu số Việt Nam',
        ];
    }
}
