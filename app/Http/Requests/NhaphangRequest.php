<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhaphangRequest extends FormRequest
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
            'qty' => 'min:0',
           
        ];
    }
    public function messages()
    {
        return [
            'qty.min' => 'Giá trị nhỏ nhất là 0',
            
        ];
    }

}
