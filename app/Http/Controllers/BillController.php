<?php

namespace App\Http\Controllers;

use App\Models\BillUser;
use App\Models\bill_detail;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\list_bill;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;

class BillController extends Controller
{
    public function index(Request $request)
    {
        $bills = Booking::query()
            ->with('booking_detail')
            ->whereHas('booking_detail', function ($q) use ($request) {
                if ($request->status == 'Chờ xử lý') {
                    $q->where('status_booking', '=', null);
                }

                if ($request->status == 'Tiếp nhận máy') {
                    $q->where('status_booking', '=', 'received');
                }

                if ($request->status == 'Hủy') {
                    $q->where('status_booking', '=', 'cancel');
                }

                if ($request->status == 'Đang chờ sửa') {
                    $q->where('status_booking', '=', 'latch')
                        ->where('status_repair', '=', 'fixing');
                }

                if ($request->status == 'Đang sửa') {
                    $q->where('status_booking', '=', 'latch')
                        ->where('status_repair', '=', 'waiting');
                }

                if ($request->status == 'Hoàn thành sửa') {
                    $q->where('status_booking', '=', 'latch')
                        ->where('status_repair', '=', 'finish');
                    $q->with('list_bill');
                    $q->whereHas('list_bill', function ($e) use ($request) {
                        $e->where('type', '!=', 2);
                    });
                }

                if ($request->code ?? null) {
                    $q->where('code', 'like', '%' . $request->code . '%');
                };

                if ($request->status == 'Đã thanh toán') {
                    $q->with('list_bill');
                    $q->whereHas('list_bill', function ($e) use ($request) {
                        $e->where('type', 2);
                    });
                };
            })

            ->orderBy('created_at', 'DESC')->paginate(9);

        return view('admin.bills.index', compact('bills'));
    }

    public function index2(Request $request)
    {
        $bills = BillUser::all();
        $bills = DB::table('bill_users')
            ->join('list_bill', 'list_bill.code', '=', 'bill_users.bill_code')
            ->select('bill_users.*', 'list_bill.method', 'list_bill.status', 'list_bill.total_price', 'list_bill.type', 'list_bill.id as bill_id')
            ->when($request->status, function ($query) use ($request) {
                if ($request->status == 5) {
                    return $query->where('status', '=', '0');
                }
                if ($request->status == 1) {
                    return $query->where('status', '=', '1');
                }
                if ($request->status == 2) {
                    return $query->where('status', '=', '2');
                }
                if ($request->status == 3) {
                    return $query->where('status', '=', '3');
                }
                if ($request->status == 4) {
                    return $query->where('status', '=', '4');
                }
                if ($request->status == 0) {
                    return $query->orderBy('status', 'ASC');
                }
            })->when($request->method, function ($query) use ($request) {
                if ($request->method == 0) {
                    return $query->where('method', '=', '0');
                }
                if ($request->method == 1) {
                    return $query->where('method', '=', '1');
                }
                if ($request->method == 2) {
                    return $query->where('method', '=', '2');
                }
            })->when($request->bill_code, function ($query, $bill_code) {
                return $query->where('bill_code', 'like', "%{$bill_code}%");
            })->when($request->name, function ($query, $name) {
                return $query->where('name', 'like', "%{$name}%");
            })->when($request->phone, function ($query, $phone) {
                return $query->where('phone', 'like', "%{$phone}%");
            })->when($request->created_at, function ($query, $created_at) {
                return $query->whereDate('bill_users.created_at', '=', $created_at);
            })->orderBy('created_at', 'DESC')->paginate(9);
        $bill_user = BillUser::all();
        // dd($bills);
        return view('admin.bills.index2', compact('bills', 'bill_user'));
    }
    public function show(Request $request)
    {

        $bills = list_bill::orderBy('id', 'desc')->paginate(8);
        $bill_user = BillUser::all();

        return view('admin.bills.index2', compact('bills', 'bill_user'));
    }
    public function detail($id)
    {
        $bill = list_bill::find($id);
        $bill_user = BillUser::where('bill_code', $bill->code)->get()->first->toArray();
        $bill_detail = bill_detail::where('bill_code', $bill->code)->get();
        $prod = Product::all();
        // dd($bill_detail);

        if (!$bill) {
            return view('admin.bills.index')->with('error', 'Không tìm thấy hóa đơn');
        }
        foreach (Auth::user()->unreadNotifications as $notification) {
            if ($notification->data['url'] ===  '/' . FacadesRequest::path()) {
                $userUnreadNotification = auth()->user()
                    ->unreadNotifications
                    ->where('id', $notification->id)
                    ->first();
                if ($userUnreadNotification) {
                    $userUnreadNotification->markAsRead();
                }
            }
        };
        // $ComputerCompany = ComputerCompany::all();
        return view(
            'admin.bills.detail',
            compact('bill', 'bill_user', 'bill_detail', 'prod')
        );
    }

    public function edit($id)
    {
        $bill = list_bill::find($id);
        if (!$bill) {
            return redirect()->route('bill.index2')->with('error', 'Không tìm thấy hóa đơn');
        }
        $bill_user = BillUser::where('bill_code', $bill->code)->get()->first->toArray();
        $bill_detail = bill_detail::where('bill_code', $bill->code)->get();
        $prod = Product::all();
        // $ComputerCompany = ComputerCompany::all();
        return view(
            'admin.bills.edit',
            compact('bill', 'bill_user', 'bill_detail', 'prod')
        );
    }
    public function saveEdit(Request $request, $id)
    {
        $request->validate(
            [
                'method' => ['required', 'numeric', 'between:0,2'],
                'status' => ['required', 'numeric', 'between:0,4'],
                'name' => ['required'],
                'email' => ['required', 'email'],
                'phone' => ['required', 'regex:/^(0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
                'address' => ['required'],
                'total_price' => ['required', 'numeric', 'min:0'],
            ],
            [
                'method.required' => 'Yêu cầu nhập phương thức thanh toán',
                'method.numeric' => 'Sai định dạng dữ liệu, vui lòng thử lại',
                'method.between' => 'Sai định dạng dữ liệu, vui lòng thử lại',
                'status.required' => 'Yêu cầu nhập trạng thái',
                'status.numeric' => 'Sai định dạng dữ liệu, vui lòng thử lại',
                'status.between' => 'Sai định dạng dữ liệu, vui lòng thử lại',
                'name.required' => 'Yêu cầu nhập tên',
                'email.required' => 'Yêu cầu nhập email',
                'email.email' => 'Phải có đuôi @',
                'phone.required' => 'Yêu cầu nhập số điện thoại',
                'phone.regex' => 'Số điện thoại phải thuộc danh mục số Việt Nam',
                'address.required' => 'Yêu cầu nhập địa chỉ',
                'total_price.required' => 'Yêu cầu nhập tổng tiền',
                'total_price.numeric' => 'Tổng tiền phải là số',
                'total_price.min' => 'Tổng tiền nhỏ nhất là 0',
            ]
        );
        $list_bill = list_bill::find($id);
        $list_bill['method'] = $request->method;
        $bill_detail = bill_detail::where('bill_code', $list_bill->code)->get();
        if (($list_bill->status == 0 || $list_bill->status == 3)  && ($request->status == 2 || $request->status == 4)) {
            foreach ($bill_detail as $bill_d) {
                $products = Product::where('id', $bill_d->product_id)->get();
                foreach ($products as $product) {
                    $product->qty = $product->qty - $bill_d->quaty;
                    $product->save();
                }
            }
        }
        $list_bill['status'] = $request->status;
        $list_bill['total_price'] = $request->total_price;
        $bill_user = BillUser::where('bill_code', $list_bill->code)->orderBy('created_at', 'DESC')->first();
        $bill_user['name'] = $request->name;
        $bill_user['email'] = $request->email;
        $bill_user['phone'] = $request->phone;
        $bill_user['address'] = $request->address;
        $bill_user['note'] = $request->note;
        $list_bill->save();
        $bill_user->save();
        Toastr::success('Sửa hóa đơn thành công', 'Thành công');
        return redirect()->route('bill.index2');
    }
    public function sendMessage(Request $request)
    {
        $request->validate(
            [
                'code_ship' => ['required'],
            ],
            [
                'code_ship.required' => 'Yêu cầu nhập mã vận chuyển',
            ]
        );
        $phone = '+84' . $request->phone;
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_number = getenv("TWILIO_NUMBER");
        $twilio = new Client($twilio_sid, $token);
        $twilio->messages->create(
            $phone,
            array(
                'from' => $twilio_number,
                'body' => $request->code_bill . ' ' . $request->ship . ' Co ma van chuyen la: ' . $request->code_ship . 'Xem chi tiết trong: https://goship.io/',
            )
        );
        Toastr::success('Gửi tin nhắn thành công', 'Thành công');
        return back();
    }
}