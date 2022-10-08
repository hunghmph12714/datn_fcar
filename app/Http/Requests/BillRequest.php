<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
            'name' => ['required','string','min:3'],
            'email' => ['required','email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'phone' => ['required','numeric','regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'address' => ['required','min:6'],
            'payment_method' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Mời nhập Họ và Tên',
            'name.string' => 'Mời bạn nhập tên bằng chữ',
            'name.min' => 'Vui lòng nhập đầy đủ họ và tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập thêm @',
            'email.regex' => 'Vui lòng nhập đúng địa chỉ email',
            'phone.regex' => 'Vui lòng nhập đúng số điện thoại',
            'phone.required' => 'Mời nhập số điện thoại',
            'phone.numeric' => 'Vui lòng nhập số điện thoại',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'address.min' => 'Vui lòng nhập đúng địa chỉ',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán'

        ];
    }
}
