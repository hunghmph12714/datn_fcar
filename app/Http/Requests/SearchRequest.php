<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'datetime_start:date|date_format:d-m-Y|before:datetime_end',
            'datetime_end:date_format:d-m-Y'
        ];
    }

    public function messages()
    {
        return [
            'datetime_start.date_format' =>" Định dạng kiểu:d-m-Y",
            'datetime_start.before'=>"Ngày bắt đầu phải nhở hơn ngày kết thúc",
            'datetime_end.date_format' =>" Định dạng kiểu:d-m-Y",

        ];
    }
}
