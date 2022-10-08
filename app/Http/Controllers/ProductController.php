<?php

namespace App\Http\Controllers;

// use App\Helpers\Http;

use App\Http\Requests\ProductRequest;
use App\Models\CarCompany;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::paginate(10);
        $products->load('image_product');
        // dd($products);
        $CarCompany = CarCompany::all();
        $products = Product::when($request->name, function ($query, $name) {
            return $query->where('name', 'like', "%{$name}%");
        })->when($request->status, function ($query) use ($request) {
            if ($request->status == 1) {
                return $query->where('status', '=', '1');
            }
            if ($request->status == 2) {
                return $query->where('status', '=', '0');
            }
            if ($request->status == 0) {
                return $query->orderBy('created_at', 'DESC');
            }
        })->when($request->companyCar_id, function ($query, $companyCar_id) {
            return $query->where('companyCar_id', '=', $companyCar_id);
        })->orderBy('status', 'DESC')->paginate(10);

        return view('admin.products.index', compact('products', 'CarCompany'));
    }

    public function remove($id)
    {
        $model = Product::find($id);
        if (!empty($model)) {
            if (!empty($model->image)) {
                $imgPath = str_replace('storage/', '', $model->image);
                Storage::delete($imgPath);
            }
            $model->delete();
            return redirect(route('product.index'))->with('success', 'Xóa thành công');
        } else {
            return redirect(route('error'));
        }
    }

    public function addForm()
    {
        $CarCompany = CarCompany::all();
        return view('admin.products.add', compact('CarCompany'));
    }

    public function saveAdd(ProductRequest $request)
    {
        $model = new Product();
        $model->name = $request->name;
        $model->slug = $request->slug;
        $model->desc_short = $request->desc_short;
        $model->import_price = $request->import_price;
        $model->price = $request->price;
        $model->qty = $request->qty;
        $model->desc = $request->desc;
        $model->status = $request->status;
        $model->companyCar_id = $request->companyCar_id;
        $model->insurance = $request->insurance;
        // $model->cpu = $request->cpu;
        // $model->ram = $request->ram;
        // $model->cardgraphic = $request->cardgraphic;
        // $model->screen = $request->screen;
        // $model->harddrive = $request->harddrive;
        $model->save();
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $path = $file->store('products');
                $path = str_replace('public/', 'storage/', $path);
                $name = $file->getClientOriginalName();
                $insert[$key]['name_image'] = $name;
                $insert[$key]['product_id'] = $model->id;
                $insert[$key]['path'] = $path;
            }
            DB::table('product_images')->insert($insert);
        }
        Toastr::success('Tạo sản phẩm thành công', 'Thành công');

        return redirect(route('product.index'));
    }

    public function editForm($id)
    {
        $pro = Product::find($id);
        $images = DB::table('product_images')->where('product_id', $id)->get();
        if (!$pro) {
            return redirect(route('error'));
        }
        $CarCompany = CarCompany::all();
        return view(
            'admin.products.edit',
            compact('pro', 'CarCompany', 'images')
        );
    }

    public function saveEdit(ProductRequest $request, $id)
    {
        $model = Product::find($id);
        $model->name = $request->name;
        $model->slug = $request->slug;
        $model->desc_short = $request->desc_short;
        $model->import_price = $request->import_price;
        $model->price = $request->price;
        $model->qty = $request->qty;
        $model->desc = $request->desc;
        $model->status = $request->status;
        $model->companyCar_id = $request->companyCar_id;
        $model->insurance = $request->insurance;
        // $model->cpu = $request->cpu;
        // $model->ram = $request->ram;
        // $model->cardgraphic = $request->cardgraphic;
        // $model->screen = $request->screen;
        // $model->harddrive = $request->harddrive;
        $model->save();
        $images = DB::table('product_images')->where('product_id', $id)->get();

        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $path = $file->store('products');
                $path = str_replace('public/', 'storage/', $path);
                $name = $file->getClientOriginalName();
                $insert[$key]['name_image'] = $name;
                $insert[$key]['product_id'] = $model->id;
                $insert[$key]['path'] = $path;
            }
            foreach ($images as $image) {

                $id = $image->id;
                $image_path = $image->path;
                // if($image_path){
                //     unlink($image_path);
                // }
                DB::table('product_images')->delete($id);
            }
            DB::table('product_images')->insert($insert);
        }
        Toastr::success('Sửa sản phẩm thành công', 'Thành công');
        return redirect(route('product.index'));
    }

    public function ShowHide(Request $request, $id)
    {
        $model = Product::find($id);
        if ($model->status == 1) {
            $model['status'] = 0;
            $model->save();
            Toastr::success('Ẩn sản phẩm thành công', 'Thành công');
            return back();
        } else {
            $model['status'] = 1;
            $model->save();
            Toastr::success('Hiện sản phẩm thành công', 'Thành công');
            return back();
        }
    }

    // public function logOut()
    // {
    //     $response = Http::withHeaders([
    //         'X-Auth-Token' => cookie()->get('aa'),                                                   
    //         'X-User-Id' => "QKCnYgf38Mn4SCsk6",
    //         'Content-Type'  => "application/json"
    //     ])
    //         ->get('http://10.1.38.174:3000/api/v1/logout');
    //     dd($response->json());
    // }
}