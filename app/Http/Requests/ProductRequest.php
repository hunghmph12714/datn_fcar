<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

        $result = [
            'name' => 'required|string|min:3|max:80|unique:products,name,' . $this->id,
            'price' => 'required|numeric|min:20000|max:99999999',
            'import_price' => 'required|numeric|min:10000|max:50000000|lt:price',
            'companyComputer_id' => 'required',
            'insurance' => 'required|between:0,36',
            'qty' => 'required|numeric|min:1|max:99',
            'status' => 'required|between:0,1',
            'desc_short' => 'required',
            'ram' => 'required',
            'cpu' => 'required',
            'cardgraphic' => 'required',
            'screen' => 'required',
            'harddrive' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg',
            'slug' => 'required|string|min:3|max:60|unique:products,slug,' . $this->id,

        ];
        return $result;
    }
    public function messages()
    {
        return [
            'name.required' => 'Mời bạn nhập tên sản phẩm',
            'name.string' => 'Mời bạn nhập tên sản phẩm',
            'name.min' => 'Tên phải có độ dài lớn hơn 3 ký tự',
            'name.max' => 'Tên phải có độ dài nhỏ hơn 80 ký tự',
            'images.*.mimes' => 'Sai định dạng ảnh',
            'images.mimes' => 'Sai định dạng ảnh',
            'images.*.required' => 'Yêu cầu nhập ảnh',
            'price.required' => 'Mời bạn nhập giá',
            'qty.required' => 'Mời bạn số lương',
            'qty.numeric' => 'Mời bạn số lương',
            'qty.min' => 'Số lượng nhỏ nhất là 1',
            'qty.max' => 'Số lượng lớn nhất là 99',
            'price.numeric' => 'Kiểu dữ phải là dạng số',
            'price.min' => 'giá bán tối thiểu là 20.000 vnđ',
            'price.max' => 'giá bán tối đa là 99.999.000 vnđ',
            'import_price.required' => 'Mời bạn nhập giá',
            'import_price.lt' => 'Giá nhập phải nhỏ hơn giá bán',
            'import_price.numeric' => 'Kiểu dữ phải là dạng số',
            'import_price.min' => 'Giá nhập tối thiểu là 10.000 vnđ',
            'import_price.max' => 'Giá nhập tối đa là 50.000.000 vnđ',
            'companyComputer_id.required' => 'Bạn chưa chọn danh mục laptop',
            'insurance.required' => 'Bạn chưa nhập thời gian bảo hành',
            'insurance.between' => 'Thời gian bảo hành từ 0 đến 36 tháng',
            'desc_short.required' => 'Mời bạn nhập mô tả',
            'status.required' => 'Mời bạn nhập trạng thái',
            'status.between' => 'Mời bạn chọn lại trạng thái',
            'slug.required' => 'Mời bạn nhập đường dẫn',
            'slug.string' => 'Đường dẫn phải là chuỗi',
            'slug.min' => 'Đường dẫn có độ dài quá ít',
            'slug.max' => 'Đường dẫn quá dài',
            'slug.unique' => 'Đường dẫn không được trùng',
            'name.unique' => 'Tên sản phẩm không được trùng',
            'ram.required' => 'Mời bạn nhập ram',
            'cpu.required' => 'Mời bạn nhập cpu',
            'cardgraphic.required' => 'Mời bạn nhập Card đồ họa',
            'screen.required' => 'Mời bạn nhập màn hình',
            'harddrive.required' => 'Mời bạn nhập ổ cứng',

        ];
    }
}
