<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCarRequest;
use App\Models\BookingDetail;
use App\Models\Category;
use App\Models\CarCompany;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyCarController extends Controller
{

    public function index(Request $request)
    {

        $CompanyCar = CarCompany::orderBy('id', 'desc')->paginate(10);
        return view('admin.CompanyCar.index', compact('CompanyCar'));
    }

    public function remove($id)
    {
        $CompanyCar = CarCompany::find($id);
        $products = Product::where('CompanyCar_id', '=', $id)->first();
        if (!empty($CompanyCar)) {
            if (empty($products)) {
                CarCompany::where('id', $id)->delete();
                return redirect(route('CompanyCar.index'))->with('success', 'Xóa thành công');
            } else {
                return redirect(route('CompanyCar.index'))->with('error', 'Bạn không thể xóa khi đang còn sản phẩm');
            }
        } else {
            return redirect(route('CompanyCar.index'))->with('error', 'Không tìm thấy danh mục');
        }
    }
    public function addForm()
    {

        $CompanyCar = CarCompany::all();
        return view('admin.CompanyCar.add', compact('CompanyCar'));
    }
    public function saveAdd(CompanyCarRequest $request)
    {
        $model = new CarCompany();
        if ($request->hasFile('anh')) {
            $imgPath = $request->file('anh')->store('products');
            $imgPath = str_replace('public/', 'storage/', $imgPath);
            $request->merge(['logo'=>$imgPath]);
        }
        $model->logo = $request->logo;
        $model->company_name = $request->company_name;
        // dd($model);
        $model->save();
        return redirect(route('CompanyCar.index'))->with('success', 'Thêm thành công');
    }

    public function editForm($id)
    {   
        
        $CompanyCar = CarCompany::find($id);
        if (empty($CompanyCar)) {
            return redirect(route('CompanyCar.index'))->with('error', 'Không tìm thấy danh mục');
        }
        return view(
            'admin.CompanyCar.edit',
            compact('CompanyCar')
        );
    }
    public function saveEdit(Request $request, $id)
    {
        $request->validate([
            'company_name' => ['required'
                    ],
                    'anh' => [
                        'image','mimes:jpg,png,jpeg,gif,svg'
                    ]
        ],
        [
            'company_name.required' => 'Hãy nhập tên máy tính',
            'anh.image' => 'Phải là ảnh',
            'anh.mimes' => 'Sai dịnh dạng ảnh'
        ]);
        $model = CarCompany::find($id);
        if ($request->hasFile('anh')) {
            $imgPath = $request->file('anh')->store('products');
            $imgPath = str_replace('public/', 'storage/', $imgPath);
            $request->merge(['logo'=>$imgPath]);
            $model->logo = $imgPath;
        }
        $model->company_name = $request->company_name;
        $model->save();
        return redirect(route('CompanyCar.index'))->with('success', 'Sửa thành công');
    }
    
}
