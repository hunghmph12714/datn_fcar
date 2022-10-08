<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\User;
use App\Rules\Throttle;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */

    // use SendsPasswordResetEmails;
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showForgetPasswordForm()
    {   
        if(Auth::check()){
        return redirect()->route('home');
        }
        return view('auth.forgetPassword');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {      
        $request->validate([
            'phone' => ['required',
             'numeric', 
             'regex:/^(0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/',
             new Throttle('resend', $maxAttempts = 3, $minutes = 1),
             
            ],
          
        ],
        [
                'phone.required' => 'Yêu cầu nhập số điện thoại',
                'phone.numeric' => 'Số điện thoại phải là số',
                'phone.regex' => 'Số điện thoại phải thuộc đầu số Việt Nam',
        ]);
            $user_phone = User::where('phone',$request->phone)->get()->first();
            if($user_phone == NULL){
                Toastr::error('Số điện thoại không chính xác', 'Thất bại');
                return back();
            }
            $data['phone'] = $request->phone;
            $data['password'] = $request->password;
            $phoneSend['phone'] = '+84'. $request->phone;

            $pool = '0123456789';
            $code_verify = substr(str_shuffle(str_repeat($pool, 2)), 0, 6);
            /* Get credentials from .env */
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_number = getenv("TWILIO_NUMBER");
            $twilio = new Client($twilio_sid, $token);
            $twilio->messages->create(
                $phoneSend['phone'],
                array(
                    'from' => $twilio_number,
                    'body' => 'Ma xac minh cua ban la: '. $code_verify,
                )
                );
                // Tạo mã xác minh
            DB::table('code_verify')->insert([
                    'code_verify' => $code_verify,
                    'phone_number' => $request->phone,
                    'status' => 0,
                    'time_request' => 0,
                    'created_at' => Carbon::now(),
                ]);
            if(Auth::check()){
                if(session()->has('phone')){
                    if(session()->get('phone') != $request->phone)
                    Auth::logout();
                }
            }
        session()->put('code_verify',$code_verify);
        session()->put('phone',$request->phone);
        Toastr::success('Gửi mã về số điện thoại', 'Thành công');
        return redirect()->route('forget.password.code');
    }

    
    public function showForgetPasswordCodeForm()
    {   
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('auth.forgetPasswordCode');
    }

    public function submitResetPasswordForm(Request $request)
    {   
        
        session()->put('phone',$request->phone);
        $data = $request->validate([
            'code_verify' => ['required', 'numeric'],
            'phone' => ['required', 'numeric'],
        ],
        [
                'code_verify.required' => 'Yêu cầu nhập mã xác minh',
                'code_verify.numeric' => 'Mã xác minh phải là số',
                'phone.required' => 'Yêu cầu nhập số điện thoại',
                'phone.numeric' => 'Số điện thoại phải là số',
        ]);
        $user_phone = User::where('phone',$request->phone)->get()->first();
        if(!$user_phone){
            Toastr::error('Không tìm thấy số điện thoại', 'Thất bại');
            return back();
        }
        $code_verify = DB::table('code_verify')->where('phone_number',$request->phone)->orderBy('created_at','DESC')->first();
        $phoneSend['phone'] = '+84'. session()->get('phone');
        // dd($request->phone);
        if ($request->code_verify == $code_verify->code_verify && $request->phone == $code_verify->phone_number && $code_verify->status == 0) {
            $user = tap(User::where('phone', $request->phone))
            ->update([
                'isVerified' => true,
            ]);
            $update_code_verify = DB::table('code_verify')
            ->where('phone_number', $request->phone)
            ->orderBy('created_at','DESC')
            ->limit(1)
            ->update([
                'status' => 0,
                ]);
            // session()->forget('phone_number');
            session()->put(['phone' => $request->phone]);
            session()->put('code_verify',$request->code_verify);
            
            Toastr::success('Xác minh số điện thoại thành công, vui lòng đổi mật khẩu', 'Thành công');
            return redirect()->route('reset.password.get'); 
        }
        
        elseif($request->phone == $code_verify->phone_number){
            $actual_end_at = Carbon::parse(Carbon::now());
            $actual_start_at   = Carbon::parse($code_verify->created_at);
            $mins = $actual_end_at->diffInMinutes($actual_start_at, true);
            if($code_verify->time_request >= 10 || $mins >= 30 || $code_verify->status == 1){
                $update_code_verify = DB::table('code_verify')
                ->where('phone_number', $request->phone)
                ->orderBy('created_at','DESC')
                ->limit(1)
                ->update(['status' => 1]);
                Toastr::error('Mã xác minh đã quá hạn, vui lòng gửi lại mã', 'Thất bại');
                return back(); 
            }
            $update_code_verify = DB::table('code_verify')
              ->where('phone_number', $request->phone)
              ->orderBy('created_at','DESC')
              ->limit(1)
              ->update(['time_request' => $code_verify->time_request + 1]);
            Toastr::error('Mã xác minh không đúng 123132131', 'Thất bại');
            return back();
        }
        Toastr::error('Mã xác minh không đúng', 'Thất bại');
        return back()->with(['phone' => $data['phone']]);
    }

    public function showResetPasswordForm(Request $request)
    {   
        if(session()->has('phone') && session()->has('code_verify')){
            $phone = session()->get('phone');
            $code_verify = DB::table('code_verify')->where('phone_number',$phone)->orderBy('created_at','DESC')->first();
            return view('auth.forgetPasswordLink',compact('code_verify')); 
        }elseif(Auth::check()){
            return redirect()->route('home');
        }
        return redirect()->route('login');
    }

    public function insertResetPasswordForm(Request $request)
    {   
        if(session()->has('phone') && session()->has('code_verify')){
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'password.required' => 'Yêu cầu nhập mật khẩu',
                'password.string' => 'Mật khẩu phải là chuỗi ký tự',
                'password.min' => 'Mật khẩu không được nhỏ hơn 8 kí tự',
                'password.confirmed' => 'Mật khẩu không trùng vui lòng nhập lại',
            ]);
            $phone = session()->get('phone');
            $update_password = User::where('phone',$phone)->get()->first();
            Auth::login($update_password);
            $update_code_verify = DB::table('code_verify')
            ->where('phone_number',$phone)
            ->orderBy('created_at','DESC')
            ->take(1)
            ->update([
                'status' => 2,
            ]);
            $update_password->password = Hash::make($request->password);
            $update_password->save();
        }else{
            return redirect()->route('login');
        }
        Toastr::success('Đổi mật khẩu thành công', 'Thành công');
        if($update_password->id_role == 1){
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    }
}