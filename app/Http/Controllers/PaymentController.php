<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\bill_detail;
use App\Models\BillDetail;
use App\Models\BillUser;
use App\Models\list_bill;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Notifications\TestNotification;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Twilio\Rest\Client;
use Pusher\Pusher;
class PaymentController extends Controller
{
    public function showPayment()
    {   
        $content = Cart::content();
        if ($countCart = count($content) == 0) {
            Toastr::error('Vui lòng chọn đồ rồi thanh toán', 'Thất bại');
            return Redirect::to('/cua-hang')->with('error', 'Bạn không có đồ trong giỏ hàng, vui lòng thêm đồ vào giỏ rồi thanh toán!');
        } else {
            $totalBill = str_replace(',', ',', Cart::subtotal(0));
            return view('website.payment',compact('totalBill'));
        }
    }
    
    public function savePayment(Request $request)
    {   
        $request->validate([
            'name' => ['required'],
            'phone' => ['required', 'numeric', 'regex:/^(0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'address' => ['required'],
            'email' => ['required'],
            'payment_method' => ['required', 'numeric'],
        ],
            [
                'name.required' => 'Vui lòng nhập họ và tên',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'email.required' => 'Vui lòng nhập email',
                'phone.numeric' => 'Số điện thoại phải là số',
                'phone.regex' => 'Số điện thoại phải thuộc đầu số Việt Nam',
                'address.required' => 'Vui lòng nhập địa chỉ',
                'payment_method.required' => 'Vui lòng chọn phương thức thanh toán',
                'payment_method.numeric' => 'Phương thức thanh toán sai',
                
            ]);
        // Tạo mã ngẫu nhiên 16 số
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = substr(str_shuffle(str_repeat($pool, 5)), 0, 16);
        $content = Cart::content();

        // Kiểm tra giỏ hàng có sản phẩm không
        if ($countCart = count($content) == 0) {
            return Redirect::to('/thanh-toan')->with('error', 'Bạn không có đồ trong giỏ hàng, vui lòng thêm đồ vào giỏ');
        }
        if ($request->payment_method == 2) {
            $totalBill = str_replace(',', '', Cart::subtotal(0));
          
            // Lưu vào bảng bills
            $bill = new list_bill();
            $bill->method = $request->payment_method;
            $bill->total_price = $totalBill;
            $bill->code = $length;
            if (Auth::check()) {
                $bill->user_id = Auth::id();
            }
            $bill->status = 0;
            $bill->type = 1;
            $bill->save();
            
            // Lưu vào bảng bill_details
            foreach ($content as $item) {
                $bill_detail = new bill_detail();
                $bill_detail->product_id = $item->id;
                $bill_detail->quaty = $item->qty;
                $product_import_price = Product::find($item->id);
                $bill_detail->bill_id = $bill->id;
                $bill_detail->ban = $item->price;
                $bill_detail->bill_code = $length;
                $bill_detail->nhap = $product_import_price->import_price;
                $bill_detail->save();
            }

            // Lưu vào bảng bill_users
            $bill_user = new BillUser();
            $bill_user->name = $request->name;
            $bill_user->email = $request->email;
            $bill_user->phone = $request->phone;
            $bill_user->address = $request->address;
            $bill_user->note = $request->note;
            $bill_user->bill_code = $length;
            if (Auth::check()) {
                $bill_user->user_id = Auth::id();
            }
    
            $bill_user->save();
            // dd($request->all());
            //Xóa giỏ hàng
            // Cart::destroy();
            $email = $request->email;
            $code_length = $length;
            return view('vnpay.index', compact('totalBill', 'code_length', 'email'));
        } 
        else {

            // Lưu vào bảng bills
            $bill = new list_bill();
            $totalBill = str_replace(',', '', Cart::subtotal(0));
            $bill->method = $request->payment_method;
            $bill->total_price = $totalBill;
            $bill->code = $length;
            if (Auth::check()) {
                $bill->user_id = Auth::id();
            }
            $bill->status = 0;
            $bill->type = 1;
            $bill->save();
            // Lưu vào bảng bill_details
            foreach ($content as $item) {
                $bill_detail = new bill_detail();
                $bill_detail->product_id = $item->id;
                $bill_detail->quaty = $item->qty;
                $product_import_price = Product::find($item->id);
                $bill_detail->bill_id = $bill->id;
                $bill_detail->ban = $item->price;
                $bill_detail->bill_code = $length;
                $bill_detail->nhap = $product_import_price->import_price;
                $bill_detail->save();

            }

            // Lưu vào bảng bill_users
            $bill_user = new BillUser();
            $bill_user->name = $request->name;
            $bill_user->email = $request->email;
            $bill_user->phone = $request->phone;
            $bill_user->address = $request->address;
            $bill_user->note = $request->note;
            $bill_user->bill_code = $length;
            if (Auth::check()) {
                $bill_user->user_id = Auth::id();
            }
            $bill_user->save();
            // Mail::send('email.sendBill',['name'=> $bill_user->name ,'phone'=> $bill_user->phone,
            // 'address'=>$bill_user->address,'bill_code' => $length,'price' => $bill->total], function($message) use($request){
                //     $message->to($request->email);
                //     $message->subject('THANH TOÁN HÓA ĐƠN | LAPTOP51');
                //       });
                // $phoneSend = '+84'. $bill_user->phone;
                // $token = getenv("TWILIO_AUTH_TOKEN");
                // $twilio_sid = getenv("TWILIO_SID");
                // $twilio_from = getenv("TWILIO_FROM");
                // $twilio = new Client($twilio_sid, $token);
                // $twilio->messages->create(
                //     $phoneSend,
                //     array(
                //         'from' => $twilio_from,
                //         'body' => 'Cam on ban da dat hang tai laptop51, ma hoa don cua ban la: ' . $length,
                //     )
                //     );
            $user_send = User::find(Auth::id());

            $data['title'] = 'Đơn hàng từ: '.  $request->name;
            $data['from'] = $user_send->id;
            $data['to'] = 1;
            $data['code'] = $length;
            $data['url'] = '/admin/bill/detail/'.$bill->id;

            $users = User::where('id_role', 1)->get();
            foreach($users as $user){
                $user->notify(new TestNotification($data));
            }
            $options = array(
                'cluster' => 'ap1',
                'encrypted' => true
            );
    
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
    
            $pusher->trigger('my-channel', 'my-event', $data);
                Toastr::success('Đặt hàng thành công', 'Thành công');
            Cart::destroy();

            return Redirect::to('/don-hang/'.$length);
           
        };
    }

    public function createPayment(Request $request)
    {
        $vnp_TmnCode = "3EW6FLZG";
        $vnp_HashSecret = "XTRTBABSGMLYLMFNAPKGCBPDUVTJGXXK";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/vnpay/return";
        $vnp_TxnRef = $request->vnp_TxnRef; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = str_replace(',', '', Cart::subtotal(0)) * 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,

        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        // dd($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $data = array(
            "bill_code" => $request->vnp_TxnRef,
            "money" => $request->vnp_Amount,
            "note" => $request->vnp_OrderInfo,
            "vnp_response_code" => $request->vnp_TransactionStatus,
            "code_vnpay" => $request->vnp_TransactionNo,
            "code_bank" => $request->vnp_BankCode,
            "time" => $request->vnp_PayDate,
            "created_at" => now(),
            "user_id" => Auth::id(),
        );
        $bill_code = DB::table('bill_users')->where('bill_code',$request->vnp_TxnRef)->first();
        $phone = $bill_code->phone;
        // Update trạng thái đơn hàng
        if ($data['vnp_response_code'] == 00) {
            $payment_status = list_bill::where('code', $data['bill_code'])->first();
            $payment_status->status = 3;
            // dd($request->all());
            $payment_status->update();
            Payment::insert($data);
            $bill_detail = bill_detail::where('bill_code',$payment_status->code)->get();
            foreach($bill_detail as $bill_d){
                $products = Product::where('id', $bill_d->product_id)->get();
                    foreach($products as $product){
                        $product->qty = $product->qty - $bill_d->quaty;
                        $product->save();
                    }
                }
            $user_send = User::find(Auth::id());

            $data['title'] = 'Đơn hàng từ: '.  $bill_code->name;
            $data['from'] = Auth::id();
            $data['to'] = 1;
            $data['code'] = $request->vnp_TxnRef;
            $data['url'] = '/admin/bill/detail/'.$payment_status->id;
            $users = User::where('id_role', 1)->get();
            foreach($users as $user){
                $user->notify(new TestNotification($data));
            }
            $options = array(
                'cluster' => 'ap1',
                'encrypted' => true
            );
    
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
    
            $pusher->trigger('my-channel', 'my-event', $data);
            Cart::destroy();       
            Toastr::success('Đặt hàng thành công', 'Thành công');
            return Redirect::to('/don-hang/'.$data['bill_code']);
        }
            Toastr::error('Đặt hàng thất bại', 'Thất bại');
            return Redirect::to('/cua-hang')
                ->with('error', 'Thanh toán thất bại');
    }
    public function paymentSuccess($code){
        $bill = list_bill::where('code', $code)->first();
        if(!$bill){
            return abort(404);
        }
        $bill_detail = bill_detail::where('bill_code',$code)->get();
        $bill_user = BillUser::where('bill_code',$code)->first();
        return view('website.payment-success',compact('bill','bill_detail','bill_user'));
    }
}