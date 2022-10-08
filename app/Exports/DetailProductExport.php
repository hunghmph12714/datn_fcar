<?php

namespace App\Exports;

use App\Models\DetailProduct;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ProductExport implements FromCollection, WithHeadings
{
    use Exportable;
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    public function collection()
    {
        $data = DetailProduct::all();
        $data->load('products');
        foreach ($data as $row) {
            $order[] = array(
                '0' => $row->name,

                '1' => $row->image,
                '2' => $row->import_price,
                '3' => $row->price,
                '4' => $row->qty,
                '5' => $row->desc,
                '6' => $row->status,
                '7' => $row->companyComputer->company_name,
            );
        }

        return (collect($order));
    }

    
    public function headings(): array
    {
        return [
            'Tên',
            'Ảnh',
            'Giá nhập',
            'Giá',
            'Số lượng',
            'Mô tả',
            'Trạng thái',
            'Loại sản phẩm',
        ];
    }
}
