<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PhoneUserVerifycation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        // $user = Auth::user()->isVerified;
        if(!Auth::user()){
            Toastr::error('Bạn cần đăng nhập và xác minh để mua hàng', 'Thất bại');
            return Redirect::to('/login')->with('error','Bạn cần đăng nhập và xác minh số điện thoại để thực hiện chức năng này');
        }elseif(Auth::user()->isVerified == true){
            return $next($request);
        }
        else{
            Toastr::error('Bạn cần đăng nhập và xác minh để mua hàng', 'Thất bại');
            return redirect('/verify')->with('error','Bạn cần xác minh số điện thoại để thực hiện chức năng này');
        }
    }
}
