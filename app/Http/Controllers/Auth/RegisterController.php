<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ],
            [
                'name.required' => 'Yêu cầu nhập tên',
                'name.string' => 'Cần đúng định dạng',
                'name.max' => 'Tên dài thế',
                'email.required' => 'Nhập email',
                'email.string' => 'Cần đúng định dạng, không ký tự đặc biẹt',
                'email.email' => 'Cần đúng định dạng email',
                'email.max' => 'Email dài thế, nhập lại đi',
                'email.unique' => 'Bị trùng mail rồi',
                'password.required' => 'Yêu cầu nhập mật khẩu',
                'password.string' => 'Sai định dạng mật khẩu',
                'password.min' => 'Mật khẩu lớn hơn 6 ký tự',
                'password.confirmed' => 'Mật khẩu không trùng',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_role' => 0,
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        if ($user = $this->create($request->all())) {
            event(new Registered($user));
            // dd($user);
            return redirect()->route('login')->with('message', 'Đăng ký tài khoản thành công!');
        }

        return redirect()->back()->with('error', 'Đăng ký không thành công');
    }

}
