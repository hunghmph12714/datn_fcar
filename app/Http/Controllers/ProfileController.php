<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Bill;
use App\Models\bill_detail;
use App\Models\BookingDetail;
use App\Models\list_bill;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return view('auth.login')->with('message', 'Bạn phải đăng nhập để vào trang này');
        }
    }

    public function index()
    {
        $id = Auth::id();
        $user = User::find($id);
        // dd($user);
        // $bill = DB::table('bill_users')
        //     ->join('list_bill', 'bill_users.bill_code', 'list_bill.code')
        //     ->join('billdetail', 'list_bill.code', 'billdetail.bill_code')
        //     ->join('products', 'billdetail.product_id', 'products.id')
        //     ->select(DB::raw('count(billdetail.bill_code) as count_order'),'bill_users.address', 'list_bill.id', 'list_bill.total_price', 'billdetail.quaty', 'billdetail.ban', 'billdetail.bill_code', 'billdetail.created_at', 'products.name')
        //     ->where('bill_users.user_id', '=', auth()->user()->id)
        //     ->groupBy('list_bill.total_price')
        //     ->get();
        $bill = DB::table('list_bill')->where('type', 1)->where('user_id', $id)->orderBy('created_at','DESC')
            ->get();
        $bill_detail = bill_detail::all();
        $bill_user = DB::table('bill_users')->get();
        $img_product = DB::table('product_images')->get();
        return view('website.profile', compact('user', 'bill', 'bill_user', 'bill_detail', 'img_product'))->with('message', 'Đăng nhập thành công');
    }

    public function cancelOrder(Request $request)
    {
        $data = list_bill::where('code', $request->code)->first();
        $data->status = 1;
        $data->save();
        return redirect()->back();
    }

    public function restoreOrder(Request $request, $code)
    {
        $data = Bill::where('code', $code)->first();
        if ($data['payment_status'] == 0) {
            $data['payment_status'] = 1;
            $data->save();
        }

        return redirect()->back();
    }

    public function cancelRepair(Request $request, $code)
    {
        $data = BookingDetail::where('code', $code)->first();
        $data['status_booking'] = 'cancel';
        // dd($data);
        $data->save();
        return redirect()->back();
    }

    public function restoreRepair(Request $request, $code)
    {
        $data = BookingDetail::where('code', $code)->first();
        if ($data['payment_status'] == 0) {
            $data['payment_status'] = 1;
            $data->save();
        }

        return redirect()->back();
    }

    public function changeImage(Request $request)
    {

        $id = Auth::id();
        $user = User::find($id);
        if ($request->hasFile('avatar')) {
            // $oldImg = str_replace('storage/', 'public/', $model->avatar);
            $imgu = new User;
            $request->validate(
                [
                    'avatar' => 'mimes:jpg,png,jpeg',
                ],
                [
                    'avatar.mimes' => 'Sai định dạng ảnh',
                ]
            );
            Storage::delete($user->avatar);
            $imgu = $request->file('avatar')->store('products');
            $imgu = str_replace('public/', 'storage', $imgu);
            $user->avatar = $imgu;
            $user->save();
            return Redirect::back()->with('message', 'Thay đổi ảnh thành công');
        }

        // dd($user);
        return Redirect::back()->with('message', 'Thay đổi ảnh thành công');
    }

    public function changeInfo(ProfileRequest $request)
    {
        // $reque->validate([
        //     'name' => 'required',
        //     'email' => 'required||email||regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        //     // 'interval' => 'required',
        //     // 'repair_type' => 'required'
        //  ]);
        $id = Auth::id();
        $user = User::find($id);
        if (!$user) {
            return back();
        }

        if ($user->email == 'admin@gmail.com' && $request->email != 'admin@gmail.com') {
            Toastr::error('Tài khoản admin không được thay đổi email', 'Thất bại');
            return back();
        }

        if ($request->hasFile('avatar')) {
            Storage::delete($user->avatar);
            $imgu = $request->file('avatar')->store('products');
            $imgu = str_replace('public/', 'storage', $imgu);
            $user->avatar = $imgu;
        }
        $user->email = $request->email;
        $user->address = $request->address;
        $user->name = $request->name;
        $user->description = $request->description;
        $user->save();
        Toastr::success('Đổi thông tin thành công', 'Thành công');
        return Redirect::back()->with('message', 'Thay đổi thông tin thành công');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $userPassword = $user->password;

        $request->validate(
            [
                'current_password' => 'required',
                'password' => 'required|same:confirm_password|min:6',
                'confirm_password' => 'required',
            ],
            [
                'current_password.required' => 'Nhập mật khẩu cũ',
                'password.required' => 'Nhập mật khẩu mới',
                'password.min' => 'Yêu cầu nhập tối thiểu 6 ký tự',
                'password.same' => 'Mật khẩu không trùng',
                'confirm_password.required' => 'Xác nhận mật khẩu mới',

            ]
        );

        if (!Hash::check($request->current_password, $userPassword)) {
            Toastr::error('Đổi mật khẩu thất bại');
            return Redirect::back();
            // dd($user);
        }

        $user->password = Hash::make($request->password);
        Toastr::success('Đổi mật khẩu thành công');
        $user->save();
        return Redirect::back();
    }

    public function history()
    {
        $bill = DB::table('bills')
            ->join('bill_details', 'bills.code', 'bill_details.bill_code')
            ->join('products', 'bill_details.product_id', 'products.id')
            ->select('bills.total', 'bill_details.qty', 'bill_details.price', 'bill_details.bill_code', 'bill_details.created_at', 'products.name')
            ->where('bills.user_id', '=', auth()->user()->id)
            ->groupBy('bills.total')
            ->get();
        return view('website.profile', compact('bill'));
    }

    public function historyDetail(Request $request, $code)
    {
        $user = User::find(auth()->user()->id);

        $bill = DB::table('bill_users')
            ->join('list_bill', 'bill_users.bill_code', 'list_bill.code')
            ->join('billdetail', 'list_bill.code', 'billdetail.bill_code')
            ->join('products', 'billdetail.product_id', 'products.id')
            ->select(DB::raw('count(billdetail.bill_code) as count_order'), 'billdetail.product_id', 'list_bill.method', 'list_bill.status', 'bill_users.address', 'list_bill.id', 'list_bill.total_price', 'billdetail.quaty', 'billdetail.ban', 'billdetail.bill_code', 'billdetail.created_at', 'products.name')
            ->where('bill_users.user_id', '=', auth()->user()->id)
            ->where('billdetail.bill_code', '=', $code)
            ->get();
        // dd($bill);
        $images = DB::table('product_images')->get();
        // dd($images,$bill);
        return view('website.history-detail', compact('bill', 'user', 'images'));
    }
}
