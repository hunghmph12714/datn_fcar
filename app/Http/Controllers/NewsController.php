<?php

namespace App\Http\Controllers;
use App\Models\CarCompany;
use App\Models\News;
use App\Models\User;
use App\Models\Categories_new;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\News_FormRequest;



class NewsController extends Controller
{
    ///////////////////////DASHBOARD///////////////////
    public function index(Request $request){
        $pageSize = 10;
        $keyword = $request->has('keyword') ? $request->keyword : "";
        $query = News::where('title', 'like', "%$keyword%");
        $news = $query->paginate($pageSize);
        $searchData = compact('keyword');
        $news->load('category_news','user');

        
        return view('admin.news.index', compact('news','searchData'));
    }
    
    //add
    public function add(){
        $cates = Categories_new::all();
        return view('admin.news.add', compact('cates'));
    }
    public function save_add(News_FormRequest $request){
        $model = new News();
        $model->fill($request->all());
        if($request->hasFile('image')){
            $model->image = $request->file('image')->storeAs('news', uniqid() . '-' . $request->image->getClientOriginalName());
        }
        if(Auth::check()){
            $model->actor = Auth::id();
        }else{
            return redirect(route('login'));
        }
        $model->save();
        return redirect(route('news.index'));
    }
    
    //edit
    public function edit($id){
        $cates = Categories_new::all();
        $model = News::find($id);
        if(!$model){
            return redirect()->back();
        }
        return view('admin.news.edit', compact('model','cates'));
    }
    public function save_edit($id,Request $request){
        $model = News::find($id);
        if(!$model){
            return redirect()->back();
        }
        $model->fill($request->all());
        // upload ảnh
        if($request->hasFile('image')){
            $model->image = $request->file('image')->storeAs('news', uniqid() . '-' . $request->image->getClientOriginalName());
        }
        $model->save();
        return redirect(route('news.index'));
    }
    
    //delete
    public function remove($id){
        $model=News::find($id);
        $model->delete(); 
        return redirect(route('news.index'))->with('success', 'Xóa thành công');
    }


    
    /////////////////////CLIENT////////////////////////
    //show
    public function show(Request $request){
        $pageSize = 10;
        $keyword = $request->has('keyword') ? $request->keyword : "";
        $query = News::where('title', 'like', "%$keyword%");
        $news = $query->paginate($pageSize);
        $category_news = Categories_new::all();
        // $news->load('category_news','user');
        $searchData = compact('keyword');
        return view('website.news.tin-tuc', compact('news','category_news','searchData'));
    }
    
    //detail
    public function detail($id){
        $news = News::find($id);
        $news_all = News::all();
        $category_news = Categories_new::all();
        $news->load('category_news','user');
        return view('website.news.tin-tuc-detail', compact('news_all','news','category_news'));
    }
    
    //category
    public function cates($id,Request $request){
        $pageSize = 10;
        $keyword = $request->has('keyword') ? $request->keyword : "";
        $query = News::where('title', 'like', "%$keyword%");
        $news = $query->paginate($pageSize);
        $cates = Categories_new::find($id);
        $cates_all = Categories_new::all();
        $searchData = compact('keyword');
        if(!$cates){
            return redirect()->back();
        }
        return view('website.news.category', compact('news','cates','cates_all','searchData'));
    }
}