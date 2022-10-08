<?php

namespace App\Http\Controllers;

use App\Models\Categories_new;
use Illuminate\Http\Request;

class Categories_NewsController extends Controller
{
    //list
    public function index(Request $request){
        $pageSize = 10;
        $keyword = $request->has('keyword') ? $request->keyword : "";
        $query = Categories_new::where('name', 'like', "%$keyword%");
        
        $category_news = $query->paginate($pageSize);
        $searchData = compact('keyword');
        return view('admin.category_news.index', compact('category_news','searchData'));
    }
    //Add
    public function add(){
        $category_news = Categories_new::all();
        return view('admin.category_news.add', compact('category_news'));
    }
    public function save_add(Request $request){
        $cate = new Categories_new();
        $cate->fill($request->all());
        $cate->save();
        return redirect(route('category_news.index'));
    }

    //Edit
    public function edit($id){
        $cate = Categories_new::find($id);
        if (!$cate) {
            return back();
        }
        return view(
            'admin.category_news.edit',
            compact('cate')
        );
    }
    public function save_edit(Request $request,$id){
        $cate = Categories_new::find($id);
        if (!$cate) {
            return back();
        }
        $cate->fill($request->all());
        $cate->save();
        return redirect(route('category_news.index'));
    }

    public function remove($id){
        $cate = Categories_new::find($id);
        $cate->delete();
         $cate->news()->delete();   
        return redirect(route('category_news.index'))->with('success','Xóa thành công');
    }
}