<?php

namespace App\Http\Controllers;
// use Gloudemans\Shoppingcart\Cart;

use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Symfony\Component\HttpFoundation\Session\Session;

class CartController extends Controller
{
    public function saveCart(Request $request)
    {
        $id = $request->id;
        $quantity = $request->qly;
        //        dd($productId);
        $product = DB::table('products')->where('id', $id)->first();
        $image_product = DB::table('product_images')->where('product_id',$product->id)->first();
        //        Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        //        dd($product);
        $data['id'] = $product->id;
        $data['qty'] = $quantity;
        $data['name'] = $product->name;
        $data['price'] = $product->price;
        $data['weight'] = '50';
        $data['options']['image'] = $image_product->path;
        $data['options']['import_price'] = $product->import_price;
        Cart::add($data);
        // dd($data);
        return Redirect::to('/gio-hang');
    }
    public function add(Request $request)
    {   
        $id = $request->id;
        $quantity = $request->qly;
        if($quantity <= 0){
            Toastr::error('Thêm giỏ hàng thất bại', 'Thất bại');
            return back();
        }
        //        dd($productId);
        $product = DB::table('products')->where('id', $id)->first();
        $image_product = DB::table('product_images')->where('product_id',$product->id)->first();
        //        Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        //        dd($product);
        $data['id'] = $product->id;
        $data['qty'] = $quantity;
        $data['name'] = $product->name;
        $data['price'] = $product->price;
        $data['weight'] = '50';
        $data['options']['image'] = $image_product->path;
        $data['options']['import_price'] = $product->import_price;
        Cart::add($data);
        // dd($data)
        Toastr::success('Thêm giỏ hàng thành công', 'Thành công');

        return back()->with('success', 'Thêm vào giỏ thành công');
    }
    public function showCart()
    {   
        $content = Cart::content();
        session()->put('url_path',FacadesRequest::path());
        $cate_product = DB::table('product');
        $user_id = Auth::id();
        $totalBill = str_replace(',', ',', Cart::subtotal(0));
        
        $products = Product::all();
        //    $totalBill = str_replace(',', '', Cart::subtotal(0)) * 100;
        return view('website.cart', compact('totalBill','content','products'));
    }
    public function deleteToCart($rowId)
    {
        Cart::update($rowId, 0);
        return Redirect::to('/gio-hang');
    }
    public function updateCartQuantity(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        $content = Cart::content();
        // dd(count(Cart::content()));
        if (count(Cart::content()) == 0) {
            Cart::destroy();
            return back();
        }
        Toastr::success('Cập nhât sản phẩm thành công', 'Thành công');
        Cart::update($rowId, $qty);
        return back();
    }
}