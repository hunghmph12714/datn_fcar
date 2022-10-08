<?php

namespace App\Imports;

use App\Models\ComputerCompany;
use App\Models\ImageProduct;
use App\Models\Product;
use App\User;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Validation\ValidationException;

class ProductImport implements ToModel, WithStartRow, WithValidation, SkipsOnError
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        $category = ComputerCompany::query()->where("company_name", "=", $row[1])->first();

        if ($row[6] == "Đang hiện") {
            $row[6] = 1;
        } elseif ($row[6] == "Đang ẩn") {
            $row[6] = 0;
        }



        $a = Product::query()->updateOrCreate([
            'name' => $row[0],
            'companyComputer_id' => $category->id,
            'import_price' => $row[3],
            'price' => $row[4],
            'qty' => intval($row[5]),
            'status' => $row[6],
            'desc_short' => $row[7],
            'ram' => $row[8],
            'cpu' => $row[9],
            'cardgraphic' => $row[10],
            'screen' => $row[11],
            'harddrive' => $row[12],
            'slug' => $row[13],

        ]);
        // dd($a);
        if ($row[2] ?? null) {
            ImageProduct::query()->updateOrCreate([
                'path' => $row[2],
                'product_id' => $a->id
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '0' => 'bail|required',
            '1' => 'bail|required|exists:computer_companies,company_name',
            '6' => 'bail|required',
            '3' => 'required|numeric|min:0',
            '4' => 'nullable|numeric|min:0',
            '5' => 'bail|nullable|integer|min:0',
            '2' => 'bail|nullable',
            '7' =>'bail|required',
            '8' =>'bail|required',
            '9' =>'bail|required',
            '10' =>'bail|required',
            '11' =>'bail|required',
            '12' =>'bail|required',
            '13' =>'bail|required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.required' => 'Tên sản phẩm không được để trống',
            '3.required' => 'Giá nhập không được để trống',
            '3.numeric' => 'Giá nhập phải là số',
            '3.min' => 'Giá nhập nhỏ nhất bằng 0',
            '4.required' => 'Giá bán không được để trống',
            '4.numeric' => 'Giá bán phải là số',
            '4.min' => 'Giá bán nhỏ nhất bằng 0',
            '5.integer' => 'Số lượng phải là số',
            '5.min' => 'Số lượng nhỏ nhất bằng 0',
            '6.required' => 'Trạng thái không được để trống',
            '1.required' => 'Danh mục laptop không được để trống',
            '1.exists' => 'Danh mục không tồn tại',
            '7.required' => 'Mô tả ngắn không được để trống',
            '8.required' => 'Ram không được để trống',
            '9.required' => 'Cpu không được để trống',
            '10.required' => 'cardgraphic không được để trống',
            '11.required' => 'Màn hình không được để trống',
            '12.required' => 'harddrive không được để trống',
            '13.required' => 'Đường dẫn không được để trống',

        ];
    }
}