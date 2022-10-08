<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderSuccessEmail;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\CategoryComponent;
use App\Models\Component;
use App\Models\CarCompany;
use Carbon\Carbon;
use App\Models\DetailProduct;
use App\Models\Product;
use App\Models\RepairPart;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\UserRepair;
use App\Notifications\TestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Nexmo\Laravel\Facade\Nexmo;
use Pusher\Pusher;
use Illuminate\Support\Facades\Request as FacadesRequest;

class BookingController extends Controller
{


   public function formCreateBooking()
   {
      $cars = CarCompany::all();
      // dd($computers);
      return view('admin.booking.create', compact('cars'));
   }
   public function formEditBooking($id)
   {
      $cars = CarCompany::all();
      $booking_detail = BookingDetail::find($id);
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
      // dd($booking_detail->booking->id);
      return view('admin.booking.edit', compact('booking_detail', 'cars'));
   }
   public function EditBooking(Request $request, $id)
   {
      // dd($request);
      $request->validate([
         'full_name' => 'required',
         'phone' => 'required||numeric',
         'email' => 'required||regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
         'interval' => 'required',
         // 'repair_type' => 'required'
      ]);
      $booking_detail = BookingDetail::find($id);
      if ($booking_detail) {
         $booking_detail->fill([
            // 'booking_id' => $model->id,
            'company_car_id' => $request->company_car_id,
            'description' => $request->description,
            'name_car' => $request->name_car
         ]);
         $booking_detail->save();
         $booking = Booking::find($booking_detail->booking_id);
         $booking->fill([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'interval' => $request->interval
         ]);
         $booking->save();
      }
      return redirect(route('sua-chua.danh-sach-chua-xac-nhan'));
   }
   public function listBooking()
   {
      $cars = CarCompany::all();
      $result = [];
      $bookings = Booking::query()->get();
      foreach ($bookings as   $key => $b) {
         if ($b->interval == 1) {
            $b->interval = '8h-10h';
         } elseif ($b->interval == 2) {
            $b->interval = '10h-12h';
         } elseif ($b->interval == 3) {
            $b->interval = '12h-14h';
         } elseif ($b->interval == 4) {
            $b->interval = '14h-16h';
         } elseif ($b->interval == 5) {
            $b->interval = '16h-18h';
         } elseif ($b->interval == 6) {
            $b->interval = '18h-20h';
         } else {

            $b->interval = '20h-22h';
         }
         array_push($result, $b->toArray());

         $booking_detail = $b->bookingDetail()->get();
         $result[$key]['count'] = $booking_detail->count();
         $result[$key]['booking_detail'] = [];
         foreach ($booking_detail as $b_d) {
            // dd($b_d->computerCompany()->get());
            array_push($result[$key]['booking_detail'], $b_d->toArray());
         }
      }
      // dd($result);
      return view('admin.booking.show', compact('result', 'bookings', 'cars'));
   }



   public function creatBooking(Request $request)
   {
      $request->validate([
         'full_name' => 'required',
         'phone' => 'required||numeric||min:10',
         'email' => 'required||email||regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
         'date' => 'required',
         'company_car_id' => 'required',
         'name_car' => 'required',
         'interval' => 'required',
         // 'repair_type' => 'required'
      ], [
         'full_name.required' => 'Vui lòng nhập đầy đủ họ tên',
         'phone.required' => 'Vui lòng nhập số điện thoại',
         'email.required' => 'vui lòng nhập email',
         'email.email' => 'Email không hợp lệ',
         'email.regex' => 'Email không hợp lệ',
         'date.required' => 'Vui lòng chọn ngày đem máy đến',
         'name_car.required' => 'Vui lòng nhập tên máy',
         'company_car_id.required' => 'Vui lòng chọn hãng máy',
         'interval.required' => 'Vui lòng chọn khung giờ đem máy đến',
         // 'company_computer_id.required' => 'Bạn phải nhập tên',

      ]);

      // dd($request);
      // $request->input($request);

      $data_booking = [
         'full_name' => $request->full_name,
         'phone' => $request->phone,
         'email' => $request->email,
         'interval' => $request->interval,
         'date' => $request->date,
      ];
      $booking = Booking::create($data_booking);


      $data_booking_detail = [
         'booking_id' => $booking->id,
         'company_car_id' => $request->company_car_id,
         'description' => $request->description,
         'name_car' => $request->name_car,
         'status_booking' => 'received',
      ];
      $booking_detail = BookingDetail::create($data_booking_detail);
      $booking_detail->load('carCompany');

      // dd(config('mail.from.name'));
      $details = [
         'email' => $request->email,
         'name' => $request->full_name,
         'computer' => $request->name_computer,
         'interval' => $request->interval,
         'repair_type' => $request->repair_type,
         'desc' => $booking_detail->description,
         'status' => "Đang chờ",
      ];

      if ($details['interval'] == 1) {
         $details['interval'] = '8h-10h';
      } elseif ($details['interval'] == 2) {
         $details['interval'] = '10h-12h';
      } elseif ($details['interval'] == 3) {
         $details['interval'] = '12h-14h';
      } elseif ($details['interval'] == 4) {
         $details['interval'] = '14h-16h';
      } elseif ($details['interval'] == 5) {
         $details['interval'] = '16h-18h';
      } elseif ($details['interval'] == 6) {
         $details['interval'] = '18h-20h';
      } else {

         $details['interval'] = '20h-22h';
      }
      // dd($details);

      dispatch(new SendOrderSuccessEmail($details));
      // $mod = $request->all(); 
      // dd($mod);
      // if ($request->btn == 'admin') {
      //    return back()->with('msg', '<script>	alert("Đặt lịch thành công");	</script>');
      // } else {

      $data['title'] = 'Đặt lịch từ: ' .  $request->full_name;
      $data['from'] = 1;
      $data['to'] = 1;
      $data['code'] =  $booking->id;
      $data['url'] = '/admin/dat-lich/chi-tiet/' . $booking_detail->id;
      $users = User::where('id_role', 1)->get();
      foreach ($users as $user) {
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
      if ($request->btn == 'client') {
         return view('website.success', compact('booking', 'booking_detail', 'request', 'details'));
      }

      return back()->with('msg', '<script>alert("Đặt lịch thành công");	</script>');
      // }

      // return redirect(route('dat-lich.index'));
   }

   public function deleteBooking($id)
   {
      $booking =  Booking::find($id);
      if ($booking) {
         $booking->bookingDetail()->delete();
         $booking->delete();
      }
      return redirect(route('dat-lich.danh-sach-may'));
   }


   public function listBookingDetail(Request $request)
   {

      # code...
      $users = User::query()->where('id_role', 12)->get();
      // $users->load('role');pọi
      // dd($users);
      $booking_details = BookingDetail::query()->orderBy('id', 'desc')
         ->get();
      $booking_details->load('user_repair');
      $booking_details->load('booking');
      // dd($users[1]->id);
      // dd($booking_details);


      return view('admin.booking.repair', compact('booking_details', 'users',));
   }
   public function selectStatusBooking(Request $request)
   {
      // dd($request);




      if ($request->status_booking == true) {

         $booking_detail = BookingDetail::find($request->booking_detail_id);
         // dd($booking_detail);
         if ($booking_detail) {
            $booking_detail->status_booking = $request->status_booking;
            $booking_detail->save();
            // if ($request->status_booking == 'latch') {
            //    // $booking_detail->status_repair = 'waiting';
            //    $booking_detail->save();
            // }
            // return redirect(route('sua-chua.danh-sach-chua-xac-nhan'));


            return back();
         }
      }
      if ($request->staff) {
         // dd($request);

         $booking_detail = BookingDetail::find($request->booking_detail_id);
         if ($booking_detail) {
            //  if ($request->booking_detail_id) {
            $check = UserRepair::where('booking_detail_id', $request->booking_detail_id)->first();
            if (!$check) {
               UserRepair::create(
                  [
                     'user_id' => $request->staff,
                     'booking_detail_id' => $request->booking_detail_id
                  ]
               );
            } else {
               $check->user_id = $request->staff;
               $check->save();
               // }
            }

            $data['title'] = 'Bạn có máy cần sửa:';
            $data['from'] = 1;
            $data['to'] = 1;
            $data['code'] =    $request->booking_detail_id;
            $data['url'] = '/admin/dat-lich/chi-tiet/' . $booking_detail->id;
            $user = User::find($request->staff);
            // foreach ($users as $user) {
            $user->notify(new TestNotification($data));
            // }
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
            return redirect(route('sua-chua.danh-sach-cho-sua'));
         }
      }
      // if ($request->user)  

      return redirect(route('sua-chua.danh-sach-chua-xac-nhan'));



      // return redirect(route('dat-lich.danh-sach-may'));
   }
   public function deleteBookingDetail($id)
   {
      Booking::destroy($id);
      return redirect('dat-lich.danh-sach-may');
   }

   public function repairDetail($id)
   {
      $booking_detail = BookingDetail::find($id);
      // dd($booking_detail->booking()->first());
      if ($booking_detail) {

         $booking_detail->status_repair = 'fixing';
         $booking_detail->save();
         $booking = $booking_detail->booking()->first();
         $categories = CategoryComponent::all();
         $components = Component::join('component_car_conpanies', 'components.id', 'component_car_conpanies.component_id')
            ->where('car_conpany_id', $booking_detail->company_car_id)->select('components.id as id', 'name_component', 'qty')
            ->where('qty', '>', 0)
            ->get();;
         $repair_parts = RepairPart::where('booking_detail_id', $id)->get();
         $arr_pd = array_column($repair_parts->toArray(), 'detail_product_id');
         // dd($repair_parts->toArray());
         $user_repair =   UserRepair::where('booking_detail_id', $booking_detail->id)->first();
         if (!empty($user_repair)) {
            $user_repair->status = '1';
            $user_repair->save();
         }
         return view('admin.booking.repair_detail', compact('booking', 'booking_detail', 'components', 'categories', 'arr_pd'));
         // return response()->json($product_detail);
      }
   }

   public function finishRepairDetail($id, Request $request)
   {
      // dd($request->all());
      // dd($request);
      function detailComponent($id)
      {

         $detail_product = Component::find($id);
         if ($detail_product) {
            return $detail_product;
         } else {
            return '';
         }
      }

      $booking_detail = BookingDetail::find($id);

      if ($booking_detail) {
         $repair_part = RepairPart::where('booking_detail_id', $booking_detail->id)->get();
         $arr_component_id = array_column($repair_part->toArray(), 'component_id');

         $arr_quantity = $request->soluong;

         if ($request->repairs) {
            foreach ($request->repairs as $k => $r) {
               if (in_array($r, $arr_component_id) == false) {
                  $dt = [
                     'booking_detail_id' => $id,
                     'component_id' => $r,
                     'unit_price' => detailComponent($r)->price,
                     'quantity' => $arr_quantity[$r],
                     'into_money' => detailComponent($r)->price * $arr_quantity[$r],
                     'name_product' => detailComponent($r)->name_component
                  ];
                  $component = Component::find($r);
                  $q = $component->qty;
                  $component->qty = $q - $arr_quantity[$r];
                  $component->save();
                  RepairPart::create($dt);
               } else {
                  $repair_part = RepairPart::where('booking_detail_id', $booking_detail->id)->where('component_id', $r)->first();
                  $dt = [
                     'booking_detail_id' => $id,
                     'component_id' => $r,
                     'unit_price' => detailComponent($r)->price,
                     'quantity' => $arr_quantity[$r] + $repair_part->quantity,
                     'into_money' => detailComponent($r)->price * ($arr_quantity[$r] + $repair_part->quantity),
                     'name_product' => detailComponent($r)->name_component
                  ];
                  $component = Component::find($r);
                  $q = $component->qty;
                  $component->qty = $q - $arr_quantity[$r];
                  $component->save();
                  $repair_part->fill($dt)->save();
               }
            }
         }
         if ($request->product_repair) {
            foreach ($request->product_repair as $key => $value) {
               if ($value == '' || $value == null || $request->price_product_repair[$key] == null || $request->price_product_repair[$key] == '') {
                  continue;
               }
               $dt = [
                  'booking_detail_id' => $id,
                  // 'detail_product_id' => $r,
                  'unit_price' => $request->price_product_repair[$key],
                  'quantity' => 1,
                  'into_money' => $request->price_product_repair[$key],
                  'name_product' => $value

               ];
               // dd($dt);
               RepairPart::create($dt);
            }
         }

         // if ($request->btn == 'finish') {

         $booking_detail->status_repair = 'finish';
         $booking_detail->repair = $request->description_repair;
         $booking_detail->save();

         //notify
         $data['title'] = 'Máy đã sửa xong: ' .  $booking_detail->full_name;

         $data['from'] = 1;
         $data['to'] = 1;
         $data['code'] =  $booking_detail->id;
         $data['url'] = '/admin/dat-lich/danh-sach-da-sua-xong';
         $users = User::where('id_role', 1)->get();
         foreach ($users as $user) {
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
         // if ($request->btn == 'client') {
         //    return view('website.success', compact('booking', 'booking_detail', 'request', 'details'));
         // }

         // return back()->with('msg', '<script>alert("Đặt lịch thành công");	</script>');


         // }         
         $user_repair =   UserRepair::where('booking_detail_id', $booking_detail->id)->first();
         if (!empty($user_repair)) {
            $user_repair->status = '2';
            $user_repair->save();
         }
      }

      return redirect(route('sua-chua.danh-sach-da-sua-xong'));
   }


   // public function danhSachMayCanSua()
   // {
   // }


   public function userRepair()
   {
      if (Auth::check()) {
         $booking_details = UserRepair::where('user_id', Auth::id())
            ->join('booking_details', 'user_repairs.booking_detail_id', 'booking_details.id')
            ->where('status_repair', '!=', 'finish')
            ->join('bookings', 'booking_details.booking_id', 'bookings.id')
            ->get();
         // dd($booking_details);
         return view('admin.booking.my_repair', compact('booking_details'));
      } else {
         return redirect(route('login'));
      }
   }
   // public function repairerBooking()
   // {
   //    $booking_details = UserRepair::where('user_id', Auth::id())
   //       ->join('booking_details', 'user_repairs.booking_detail_id', 'booking_details.id')->get();
   //    // dd($booking_details);
   //    return view('admin.booking.my_repair', compact('booking_details'));
   //    $booking=
   // }
   public function DanhSachChuaPhanTho()
   {
      // dd(1);
      $booking_details = BookingDetail::join('bookings', 'booking_details.booking_id', 'bookings.id')
         ->where('status_repair', 'null')->where('status_booking', 'latch')->paginate(10);
      // dd($booking_details);

      $users = User::all();
      return view('admin.booking.ds_chua_phan_tho', compact('booking_details', 'users'));
   }
   public function DanhSachDaSuaXong()
   {
      $booking_details = BookingDetail::join('bookings', 'booking_details.booking_id', 'bookings.id')
         ->where('status_repair', 'finish')->orderBy('bookings.updated_at', 'desc')->paginate(10);
      foreach ($booking_details as $b) {
         if (!$b->list_bill) {
         }
      }
      return view('admin.booking.ds_da_sua_xong', compact('booking_details'));
   }
   public function DanhSachChoSua()
   {
      $booking_details = BookingDetail::join('bookings', 'booking_details.booking_id', 'bookings.id')
         ->where('status_repair', 'waiting')->orWhere('status_repair', 'fixing')->where('status_booking', 'latch')->paginate(10);

      // dd($booking_details);
      $users = RoleUser::where('role_id', 15)->join('users', 'role_user.user_id', 'users.id')->orderBy('users.id')->get();



      return view('admin.booking.ds_cho_sua', compact('booking_details', 'users'));
   }
   public function DanhSachChuaXacNhan()
   {

      if (!empty($_GET)) {
         $booking_details = BookingDetail::join('bookings', 'booking_details.booking_id', 'bookings.id')
            ->where('status_repair', null)->where('status_booking', 'like', '%' . $_GET['status'] . '%')
            ->orderBy("bookings.id", 'desc')->paginate(10);
      } else {


         $booking_details = BookingDetail::join('bookings', 'booking_details.booking_id', 'bookings.id')
            ->where('status_repair', null)->orWhereNull('status_booking')
            ->orderBy("bookings.id", 'desc')->paginate(10);
      }


      return view('admin.booking.ds_chua_xac_nhan', compact('booking_details'));
   }

   public function tiepNhanMay($booking_detail_id)
   {
      $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $rand_code = substr(str_shuffle(str_repeat($pool, 5)), 0, 16);

      $booking_detail = BookingDetail::find($booking_detail_id);
      if ($booking_detail) {
         if ($booking_detail->code == null) {
            $booking_detail->code = $rand_code;
            $booking_detail->save();
         }
         // dd($booking_detail);
         $cars = CarCompany::all();

         return view('admin.booking.nhan-hang', compact('booking_detail', 'cars'));
      }
      // dd($length);
   }
   public function DanhSachDaGiaoKhach()
   {

      $booking_details = BookingDetail::join('bookings', 'booking_details.booking_id', 'bookings.id')
         // ->where('status_repair', null)->orWhereNull('status_booking')
         ->join('list_bill', 'booking_details.id', 'list_bill.booking_detail_id')
         ->where('type', 2)->orderBy('list_bill.id', 'desc')
         ->paginate(10);
      dd($booking_details);
      return view('admin.booking.ds_da_giao_khach', compact('booking_details'));
   }
   public function chiTiet($id)
   {
      $booking_detail = BookingDetail::find($id);
      if ($booking_detail->interval == 1) {
         $booking_detail->khung_gio = '8h-10h';
      } elseif ($booking_detail->interval == 2) {
         $booking_detail->khung_gio = '10h-12h';
      } elseif ($booking_detail->interval == 3) {
         $booking_detail->khung_gio = '12h-14h';
      } elseif ($booking_detail->interval == 4) {
         $booking_detail->khung_gio = '14h-16h';
      } elseif ($booking_detail->interval == 5) {
         $booking_detail->khung_gio = '16h-18h';
      } elseif ($booking_detail->interval == 6) {
         $booking_detail->khung_gio = '18h-20h';
      } else {

         $booking_detail->khung_gio = '20h-22h';
      }
      $booking_detail->load('booking');
      if ($booking_detail) {
         return view('admin.booking.chi-tiet-dat-lich', compact('booking_detail'));
      }
   }
}