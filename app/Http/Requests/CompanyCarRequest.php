<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyComputerRequest extends FormRequest
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
        $requestRule =  [
            'company_name' => [
                'required','unique:car_companies,company_name,'.$this->id
            
            ],
            'anh' => [
                'required','image','mimes:jpg,png,jpeg,gif,svg'
            ]
        ];
        return $requestRule;
    }

    public function messages()
    {
        return [
            'company_name.required' => 'Hãy nhập tên máy tính',
            'company_name.unique' => 'Tên máy tính đã tồn tại',
            'anh.required' => 'Hãy nhập ảnh',
            'anh.image' => 'Là ảnh',
            'anh.mimes' => 'Sai định dạng ảnh'
        ];
    }
}
