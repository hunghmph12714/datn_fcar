<?php
  
namespace App\Imports;

use App\Models\ComputerCompany;
use App\Models\DetailProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DetailProductImport implements ToModel,WithStartRow
{
    
    public function model(array $row)
    {
        $product=Product::all();
        foreach ($product as $item) {
            if ($row[6] == $item->name) {
                $row[6] = $item->id;
            }
        }

        return new DetailProduct([
            'name'     => $row[0],
            'image'     => $row[1],
            'price'     => $row[2],
            'qty'     => $row[3],
            'desc'     => $row[4],
            'status'     => $row[5],
            'product_id'     => $row[6],

        ]);
    }
    public function startRow(): int
    {   
        return 2;
    }
}
