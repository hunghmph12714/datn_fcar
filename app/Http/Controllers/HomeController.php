<?php

namespace App\Http\Controllers;

use App\Models\CarCompany;
use App\Models\DetailProduct;
use App\Models\Product;
use App\Models\News;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['auth','verify']);
    // }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        session()->put('url_path', FacadesRequest::path());
        $product_hot_sell = Product::select('billdetail.*', 'products.*', DB::raw('SUM(billdetail.quaty) As total'))
            ->join('billdetail', 'billdetail.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->where('status', 1)
            ->orderBy('total', 'DESC')
            ->get()
            ->take(8);
        $CarCompany = CarCompany::all();
        $productNew = Product::where('status', 1)->orderBy('id', 'DESC')->get()->take(8);
        // dd($productNew);
        $products = Product::where('status', 1)->get();
        $images = DB::table('product_images')->get();
        // $searchData = compact('keyword', 'computerCompany_id');

        $news = News::all();
        return view('website.index', compact('products', 'CarCompany', 'productNew', 'images', 'product_hot_sell', 'news'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return back();
    }
    public function show(Request $request)
    {   
        session()->put('url_path',FacadesRequest::path());
        
        $product_hot_sell = Product::select('billdetail.*', 'products.*', DB::raw('SUM(billdetail.quaty) As total'))
            ->join('billdetail', 'billdetail.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->where('status',1)
            ->orderBy('total' ,'DESC')
            ->get()->take(5);
            $images_product_list = DB::table('product_images')->get();
        $CarCompany = CarCompany::all();
        $productNew = Product::when($request->name, function ($query, $name) {
            return $query->where('name', 'like', "%{$name}%");
        })->when($request->price && in_array($request->price, ['all','5000000-10000000', '10000000-15000000','15000000-20000000','20000000-30000000']), function ($query) use ($request) {
            if($request->price == '5000000-10000000'){
                return $query->whereRaw('price BETWEEN ' . '5000000' . ' AND ' . '10000000' . '');
            }
            if($request->price == '10000000-15000000'){
                return $query->whereRaw('price BETWEEN ' . '10000000' . ' AND ' . '15000000' . '');
            }
            if($request->price == '15000000-20000000'){
                return $query->whereRaw('price BETWEEN ' . '15000000' . ' AND ' . '20000000' . '');
            }
            if($request->price == '20000000-30000000'){
                return $query->whereRaw('price BETWEEN ' . '20000000' . ' AND ' . '30000000' . '');
            }
            return $query->orderBy('price', $request->price == 'all' ? 'desc' : 'asc');
        })->when($request->companyCar_id, function ($query, $companyCar_id) {
            return $query->where('companyCar_id','=',$companyCar_id);
        })->where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);
        $images = DB::table('product_images')->get();
        // $product_hot_sell =
        return view('website.product', compact( 'CarCompany', 'productNew', 'images', 'product_hot_sell','images_product_list'));
    }
    public function detail($slug)
    {   

        $CarCompany = CarCompany::all();
        $pro = Product::where('slug', $slug)->first();
        // dd($ComputerCompany);
        if (!$pro || !$CarCompany) {
            // $productNew = Product::where('status', 1)->orderBy('id', 'DESC')->get()->take(4);
            // $products = Product::where('status', 1)->get();
            // $images = DB::table('product_images')->get();
            return abort(404);
        }
        session()->put('url_path',FacadesRequest::path());
        $product_hot_sell = Product::select('billdetail.*', 'products.*', DB::raw('SUM(billdetail.quaty) As total'))
        ->join('billdetail', 'billdetail.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('status',1)
        ->orderBy('total' ,'DESC')
        ->get()
        ->take(6);
        // $countPro = Product::where('');
        $productsCarCompany = Product::where('companyCar_id', $pro->companyCar_id)->where('status', 1)->get()->take(8);
        $images = DB::table('product_images')->where('product_id', $pro->id)->get();
        $images_product_list = DB::table('product_images')->get();
        return view(
            'website.product-detail',
            compact('pro', 'productsCarCompany', 'images', 'CarCompany','product_hot_sell','images_product_list')
        );
    }
    public function company($id)

    {   
        $products = Product::where('companyCar_id', $id)->where('status',1)->paginate(9);
        $CarCompany = CarCompany::all();
        $images = DB::table('product_images')->get();
        $product_hot_sell = Product::select('billdetail.*', 'products.*', DB::raw('SUM(billdetail.quaty) As total'))
        ->join('billdetail', 'billdetail.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('status',1)
        ->orderBy('total' ,'DESC')
        ->get()
        ->take(6);
        $productNew = Product::where('status', 1)->orderBy('id', 'DESC')->paginate(9);
        $images_product_list = DB::table('product_images')->get();
        // dd($ComputerCompany = ComputerCompany::find($id)->first());
        // $comPany = ComputerCompany::where('companyComputer_id',$companyComputer_id)->get();
        // $ComputerCompany = ComputerCompany::where('id',$id)->get();
        // $pro = Product::find($id);
        // $detailPro = DetailProduct::where('id', $companyComputer_id)->get();
        if ($CarCompany == null) {
            return back()->with('error', 'Không tìm thấy danh mục sản phẩm');
        }
        
        session()->put('url_path',FacadesRequest::path());
        return view(
            'website.product-category',
            compact('products', 'CarCompany', 'images','id','product_hot_sell','images_product_list','productNew')
        );
    }
    public function seachproduct($name)
    {
        $CarCompany = CarCompany::all();
        $productNew = Product::where('status', 1)->where('name', 'like', '%' . $name . '%')->paginate(9);
        $images = DB::table('product_images')->get();
        // dd($productNew);
        $products = Product::where('status', 1)->get();
        $product_hot_sell = Product::select('billdetail.*', 'products.*', DB::raw('SUM(billdetail.quaty) As total'))
        ->join('billdetail', 'billdetail.product_id', '=', 'products.id')
        ->groupBy('products.id')
        ->where('status',1)
        ->orderBy('total' ,'DESC')
        ->get()->take(5);
        $images_product_list = DB::table('product_images')->get();
        return view('website.product', compact('products', 'CarCompany', 'productNew','images','product_hot_sell','images_product_list'));
    }
}
