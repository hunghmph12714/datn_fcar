<?php

namespace App\Http\Controllers;

use App\Models\CategoryComponent;
use Illuminate\Http\Request;

class CategoryComponentController extends Controller
{
    public function index(Request $request)
    {

        $CategoriesComponent = CategoryComponent::orderBy('id', 'desc')->paginate(10);
        return view('admin.category_component.index', compact('CategoriesComponent'));
    }

    public function remove($id)
    {
        $CategoryComponent = CategoryComponent::find($id);
        $CategoryComponent = CategoryComponent::where('id', '=', $id)->first();
        if ($CategoryComponent) {
            CategoryComponent::where('id', $id)->delete();
            return redirect(route('category_component.index'))->with('success', 'Xóa thành công');
        } else {
            return redirect(route('category_component.index'))->with('error', 'Không tìm thấy');
        }
    }
    public function addForm()
    {
        $CategoryComponent = CategoryComponent::all();
        return view('admin.category_component.add', compact('CategoryComponent'));
    }
    public function saveAdd(Request $request)
    {
        $model = new CategoryComponent();
        $model->fill($request->all());
        $model->save();
        return redirect(route('category_component.index'))->with('success', 'Thêm thành công');
    }

    public function editForm($id)
    {
        $CategoryComponent = CategoryComponent::find($id);
        if (empty($CategoryComponent)) {
            return redirect(route('category_component.index'))->with('error', 'Không tìm thấy danh mục');
        }
        return view(
            'admin.category_component.edit',
            compact('CategoryComponent')
        );
    }
    public function saveEdit(Request $request, $id)
    {
        $model = CategoryComponent::find($id);
        $model->fill($request->all());
        $model->save();
        return redirect(route('category_component.index'))->with('success', 'Sửa thành công');
    }
}