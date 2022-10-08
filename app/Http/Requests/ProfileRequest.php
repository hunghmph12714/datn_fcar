<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. Auth::id(),
            'avatar' => 'mimes:jpg,png,jpeg',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Mời bạn nhập tên',
            'email.required' => 'Mời bạn nhập email',
            'email.email' => 'Phải là định dạng email',
            'email.unique' => 'Email không được trùng',
            'avatar.mimes' => 'Sai định dạng ảnh',
        ];
    }
    
}
