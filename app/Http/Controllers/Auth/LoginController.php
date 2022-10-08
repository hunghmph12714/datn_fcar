<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\Throttle;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Twilio\Rest\Client;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'phone';
    }
    public function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => ['required', 'string'],
            'password' => ['required', 'string'],
        ],
            [
                'phone.required' => 'Yêu cầu nhập số điện thoại',
                'phone.string' => 'Số điện thoại phải là số',
                // 'phone.regex' => 'Số điện thoại trong khoảng từ 9(bỏ 0 ở đầu) đến 10 số',
                'password.required' => 'Yêu cầu nhập mật khẩu',
                'password.string' => 'Yêu cầu nhập mật khẩu',
                'failed' => 'Sai mật khẩu hoặc tài khoản?',
                'password' => 'Sai mật khẩu',
                'throttle' => 'Đăng nhập quá nhiều vui lòng đợi ít phút',
            ]);

    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            Toastr::success('Đăng nhập thành công', 'Thành công');
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        Toastr::error('Đăng nhập thất baị', 'Thất bại');
        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'phone' => ['required', 'numeric', 'regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('website.index');
        }
        return back()->withErrors([
            'phone.required' => 'Yêu cầu nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại phải là số',
            'phone.regex' => 'Số điện thoại phâỉ thuộc danh mục số điện thoại việt nam',
            'password.required' => 'Yêu cầu nhập mật khẩu',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự',
            'failed' => 'Sai mật khẩu hoặc tài khoản?',
            'password' => 'Sai mật khẩu',
            'throttle' => 'Đăng nhập quá nhiều vui lòng đợi ít phút',
        ]);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }
        if (Auth::user()->id_role === 0) {
            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
            Toastr::success('Đăng nhập thành công', 'Thành công');
        } else {
            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('admin.dashboard')->with('message', 'Đăng nhập tài khoản thành công!');
            Toastr::success('Đăng nhập thành công', 'Thành công');
        }
    }
    protected function showLoginOtp()
    {
        return view('auth.loginOtp');
    }
    protected function sendLoginOtp(Request $request)
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
        $phone_check = User::where('phone', $request->phone)->get()->first();
        if ($phone_check != null) {
            $data['phone'] = $request->phone;
            $phoneSend['phone'] = '+84' . $request->phone;
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
                    'body' => 'Ma dang nhap cua ban la: '. $code_verify,
                )
                );
                // Insert mã vào db
            DB::table('code_verify')->insert([
                    'code_verify' => $code_verify,
                    'phone_number' => $request->phone,
                    'status' => 0,
                    'time_request' => 0,
                    'created_at' => Carbon::now(),
                ]);
            session()->put('phone', $request->phone);
            Toastr::success('Đã gửi mã đăng nhập về số điện thoại', 'Thành công');
            return redirect()->route('login.otp.code');
        } else {
            Toastr::error('Số điện thoại không chính xác', 'Thất bại');
            return back()->with('error','Số điện thoại chưa được đăng ký');
        }
    }

    protected function showLoginOtpCode()
    {
        return view('auth.loginOtpCode');
    }

    protected function loginOtp(Request $request)
    {   
        session()->put('phone', $request->phone);
        $data = $request->validate([
            'phone_otp' => ['required', 'numeric'],
            'phone' => ['required', 'numeric', 'regex:/^(0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
        ],
            [
                'phone_otp.required' => 'Yêu cầu nhập mã xác minh',
                'phone_otp.numeric' => 'Mã xác minh phải là số',
                'phone.required' => 'Yêu cầu nhập số điện thoại',
                'phone.numeric' => 'Số điện thoại phải là số',
                'phone.regex' => 'Số điện thoại phải thuộc đầu số Việt Nam',
            ]);
        $user_login = User::where('phone', $request->phone)->get()->first();

        // Kiểm tra só điện thoại
        if ($user_login == null) {
            Toastr::error('Không tìm thấy số điện thoại', 'Thất bại');
            return back();
        }
        $user_id = User::find($user_login->id);
        $data['phone'] = $request->phone;
        $phoneSend['phone'] = '+84' . $request->phone;
        $code_verify = DB::table('code_verify')->where('phone_number',$request->phone)->orderBy('created_at','DESC')->first();
        $phoneSend['phone'] = '+84' . $request->phone;
        if ($request->phone_otp == $code_verify->code_verify && $request->phone == $code_verify->phone_number && $code_verify->status == 0) {
            $user = tap(User::where('phone', $request->phone))
            ->update([
                'isVerified' => true,
            ]);
            $update_code_verify = DB::table('code_verify')
            ->where('phone_number', $request->phone)
            ->orderBy('created_at','DESC')
            ->limit(1)
            ->update(['status' => 1]);
            /* Authenticate user */
            Auth::login($user_id);
            // session()->forget('login_phone_otp');
            Toastr::success('Đăng nhập thành công', 'Thành công');
            if($user_id->id_role == 1){
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');
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
                return back()->with(['phone' => $request->phone]); 
            }
            $update_code_verify = DB::table('code_verify')
              ->where('phone_number', $request->phone)
              ->orderBy('created_at','DESC')
              ->limit(1)
              ->update(['time_request' => $code_verify->time_request + 1]);
            Toastr::error('Mã xác minh không đúng', 'Thất bại');
            return back()->with(['phone' => $request->phone]);
        }
        Toastr::error('Mã xác minh không đúng', 'Thất bại');
        return redirect()->route('login.otp');

    }    

}