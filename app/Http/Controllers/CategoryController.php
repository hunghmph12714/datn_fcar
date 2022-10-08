<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $Categories = Category::orderBy('id', 'desc')->paginate(10);
        return view('admin.category.index', compact('Categories'));
    }

    public function remove($id)
    {
        $Category = Category::find($id);
        $Category = Category::where('id', '=', $id)->first();
            if ($Category){
                Category::where('id', $id)->delete();
                return redirect(route('category.index'))->with('success', 'Xóa thành công');
            }
            else {
            return redirect(route('category.index'))->with('error', 'Không tìm thấy');
        }
    }
    public function addForm()
    {
        $Category = Category::all();
        return view('admin.category.add', compact('Category'));
    }
    public function saveAdd(Request $request)
    {
        $model = new Category();
        $model->fill($request->all());
        $model->save();
        return redirect(route('category.index'))->with('success', 'Thêm thành công');
    }

    public function editForm($id)
    {
        $Category = Category::find($id);
        if (empty($Category)) {
            return redirect(route('category.index'))->with('error', 'Không tìm thấy danh mục');
        }
        return view(
            'admin.category.edit',
            compact('Category')
        );
    }
    public function saveEdit(Request $request, $id)
    {
        $model = Category::find($id);
        $model->fill($request->all());
        $model->save();
        return redirect(route('category.index'))->with('success', 'Sửa thành công');
    }
    
}