<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Imports\DetailProductImport;
use App\Imports\ProductImport;
use App\Models\CarCompany;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;



class ProductExportController extends Controller

{

    public function importViewProduct()
    {
        return view('admin.imports.import-product');
    }

    public function importProduct()
    {
        \request()->validate(["file" => "required|mimes:xlsx,csv"]);
        Excel::import(new ProductImport, request()->file('file'));
        return back()->with('success','Thêm thành công');
    }

    public function importViewDetailProduct()
    {
        return view('admin.imports.import-detail-product');
    }

    public function importDetailProduct()
    {
        Excel::import(new DetailProductImport, request()->file('file'));
        return back()->with('success','Thêm thành công');
    }

    public function exportProduct(Excel $excel, ProductExport $export)
    {
        $export = app()->makeWith(ProductExport::class);
        // $name =  time() . '_users';
        return Excel::download($export, Carbon::now()->format('Y-m-d_H:i:s') . '.xlsx');
    }

    public function exportDetailProduct(Excel $excel, ProductExport $export)
    {
        $export = app()->makeWith(DetailProductExport::class);
        // $name =  time() . '_users';
        return Excel::download($export, Carbon::now()->format('Y-m-d_H:i:s') . '.xlsx');
    }
}
