<?php

namespace App\Exports;

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

        $data = Product::all();
        $data->load('companyComputer',);

        foreach ($data as $row) {
            if ($row->status == 0) {
                $row->status = "Đang ẩn";
            } elseif ($row->status == 1) {
                $row->status = "Đang hiện";
            }
            if(sizeof($row->image_product)>0){
                // dd(array_column($row->image_product->toArray(),'path')[0]);
                $row->image_product->path=array_column($row->image_product->toArray(),'path')[0];
            }else{
                $row->image_product->path='';
            }

            $order[] = array(
                '0' => $row->name,
                '1' => $row->companyComputer->company_name,
                '2' => $row->image_product->path,
                '3' => $row->import_price,
                '4' => $row->price,
                '5' => $row->qty,
                '6' => $row->status,
                '7' => $row->desc_short,
                '8' =>$row->ram,
                '9'=> $row->cpu,
                '10'=>$row->cardgraphic,
                '11' =>$row->screen,
                '12' =>$row->harddrive,
                '13' =>$row->slug
            );
        }

        return (collect($order));
    }


    public function headings(): array
    {
        return [
            'Tên',
            'Danh mục sản phẩm',
            'Ảnh',
            'Giá nhập',
            'Giá bán',
            'Số lượng',
            'Trạng thái',
            'Mô tả ngắn',
            'Ram',
            'Cpu',
            'cardgraphic',
            'screen',
            'harddrive',
            'slug'
        ];
    }
}
