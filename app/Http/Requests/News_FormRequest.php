<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class News_FormRequest extends FormRequest
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
        $ruleArr =  [
            'title' => [
                'required',
                Rule::unique('news')->ignore($this->id)
            ],
            'description_short' => 'required',
            'status' => 'required',
            'category_news_id' => 'required',
            'description' => 'required',
        ];
        if($this->id == null){
            $ruleArr['image'] = 'required|mimes:jpg,bmp,png,jpeg';
        }else{
            $ruleArr['image'] = 'mimes:jpg,bmp,png,jpeg';
        }
        return $ruleArr;
    }
    public function messages(){
        return [
            'title.required' => "Tiêu đề không nên để trống",
            'title.unique' => "Tên tiêu đề đã tồn tại",
            'description_short.required' => "Hãy nhập mô tả ngắn",
            'status.required' => "Hãy chọn trạng thái của tin tức",
            'category_news_id.required' => "Hãy chọn danh mục của tin tức",
            'description.required' => "Hãy nhập nội dung của tin tức",
            'image.required' => 'Hãy chọn ảnh',
            'image.mimes' => 'File ảnh sản phẩm không đúng định dạng (jpg, bmp, png, jpeg)',
        ];
    }
}