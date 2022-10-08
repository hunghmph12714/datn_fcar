<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailProductRequest;
use App\Http\Requests\SaveProductRequest;
use App\Models\Category;
use App\Models\DetailProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DetailProductController extends Controller
{
    public function index(Request $request)
    {
        $pageSize = 10;
        $column_names = [
            'name' => 'Tên  phụ kiện',
            'price' => 'Giá',
        ];

        $order_by = [
            'asc' => 'Tăng dần',
            'desc' => 'Giảm dần'
        ];


        $keyword = $request->has('keyword') ? $request->keyword : "";
        $companyCar_id = $request->has('companyCar_id') ? $request->companyCar_id : "";
        $rq_order_by = $request->has('order_by') ? $request->order_by : 'asc';
        $rq_column_names = $request->has('column_names') ? $request->column_names : "id";

        // dd($keyword, $cate_id, $rq_column_names, $rq_order_by);
        $query = DetailProduct::where('name', 'like', "%$keyword%");
        if ($rq_order_by == 'asc') {
            $query->orderBy($rq_column_names);
        } else {
            $query->orderByDesc($rq_column_names);
        }

        if (!empty($companyCar_id)) {
            $query->where('product_id', $companyCar_id);
        }
        $details = $query->paginate($pageSize);
        $CarCompany = Product::all();

        $details->load('detaiProduct');
        $searchData = compact('keyword', 'companyCar_id');
        $searchData['order_by'] = $rq_order_by;
        $searchData['column_names'] = $rq_column_names;
        return view('admin.detail-products.index', compact('details', 'CarCompany', 'column_names', 'order_by', 'searchData'));

        $details = DetailProduct::orderBy('id', 'desc')->paginate(10);
        $details->load('products');
        return view('admin.detail-products.index', compact('details'));
    }

    public function remove($id)
    {
        $model = DetailProduct::find($id);
        if (!empty($model->image)) {
            $imgPath = str_replace('storage/', '', $model->image);
            Storage::delete($imgPath);
        }
        $model->delete();
        return redirect(route('detail-product.index'));
    }
    public function addForm()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admin.detail-products.add', compact('products', 'categories'));
    }
    public function saveAdd(DetailProductRequest $request)
    {
        $model = new DetailProduct();
        if ($request->hasFile('anh')) {
            $imgPath = $request->file('anh')->store('products');
            $imgPath = str_replace('public/', 'storage/', $imgPath);
            $request->merge(['image' => $imgPath]);
        }

        $model->fill($request->all());
        $model->save();
        return redirect(route('detail-product.index'));
    }

    public function editForm($id)
    {
        $pro = DetailProduct::find($id);
        if (!$pro) {
            return back();
        }
        return view(
            'admin.detail-products.edit',
            compact('pro')
        );
    }
    public function saveEdit(DetailProductRequest $request, $id)
    {
        // $request la gui du lieu len
        // dd($request->name)
        $model = DetailProduct::find($id);
        Storage::delete($model->image);
        if (!$model) {
            return back();
        }
        if ($request->hasFile('anh')) {
            Storage::delete($model->image);
            $imgPath = $request->file('anh')->store('products');
            $imgPath = str_replace('public/', 'storage/', $imgPath);
            $request->merge(['image' => $imgPath]);
        }

        $model->fill($request->all());
        $model->save();
        return redirect(route('detail-product.index'));
    }
}