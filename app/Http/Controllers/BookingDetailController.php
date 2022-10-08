<?php

namespace App\Http\Controllers;

use App\Models\bill_detail;
use App\Models\BillRepair;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\DetailBillRepair;
use App\Models\DetailProduct;
use App\Models\list_bill;
use App\Models\RepairPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
// use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use PDF;

class BookingDetailController extends Controller
{
    public function getDetailProduct($id)
    {
        $product_detail = DetailProduct::find($id);

        if ($product_detail) {
            // dd($product_detail);
            return response()->json($product_detail);
        }
    }






    public function hoaDon($booking_detail_id)
    {
        $booking_detail = BookingDetail::find($booking_detail_id);
        $repair_parts = RepairPart::where('booking_detail_id', $booking_detail_id)->get();
        $repair_parts->load('component');
        // dd($repair_parts);
        if ($booking_detail) {
            $list_bill = list_bill::where('booking_detail_id', $booking_detail_id)->first();
            $data = [
                'codebill' => $booking_detail->code,
                'booking_detail_id' => $booking_detail_id,
                'date' => now(),
                'total_price' => array_sum(array_column($repair_parts->toArray(), 'into_money')),
                'type' => 2,
                'status' => 2,
                'method' => 1,

            ];
            if (!$list_bill) {
                $data = [
                    'codebill' => $booking_detail->code,
                    'booking_detail_id' => $booking_detail_id,
                    'date' => now(),
                    'total_price' => array_sum(array_column($repair_parts->toArray(), 'into_money')),
                    'type' => 2,
                    'status' => 2,
                    'method' => 1,

                ];
                $bill_repair =    list_bill::create($data);
                foreach ($repair_parts as $r) {
                    $data1 = [
                        'quaty' => $r->quantity,
                        'code_bill' => $bill_repair->codebill,
                        'bill_id' => $bill_repair->id,
                        'nhap' => 0,
                        'ban' => $r->unit_price,
                        'component_id' => $r->component_id,
                        'description' => $r->name_product,
                    ];
                    bill_detail::create($data1);
                }
            } else {
                $list_bill->fill($data)->save();
            }
        }

        $booking_detail = BookingDetail::find($booking_detail_id);
        if ($booking_detail) {
            $booking_detail->booking->full_name;
            $repair_parts = RepairPart::where("booking_detail_id", $booking_detail_id)->get();
            if ($repair_parts) {
                $repair_parts->load('component');
                $repair_parts->load('booking_detail');
                // Auth
                // dd($booking_detail->booking->full_name);
            }
            return   view('admin.booking.hoa_don', compact('booking_detail', 'repair_parts', 'list_bill'));
        }
    }

    public function luuHoaDon($booking_detail_id, Request $request)
    {
        // dd($request);
        $booking_detail = BookingDetail::find($booking_detail_id);
        $repair_parts = RepairPart::where('booking_detail_id', $booking_detail_id)->get();
        $repair_parts->load('component');
        // dd($repair_parts);
        if ($booking_detail) {
            $list_bill = list_bill::where('booking_detail_id', $booking_detail_id)->first();
            $data = [
                'codebill' => $booking_detail->code,
                'booking_detail_id' => $booking_detail_id,
                'date' => now(),
                'total_price' => array_sum(array_column($repair_parts->toArray(), 'into_money')),
                'customers_pay' => $request->customers_pay,
                'excess_cash' => $request->customers_pay - array_sum(array_column($repair_parts->toArray(), 'into_money')),
                'type' => 2,
                'status' => 2,
                'method' => 1,

            ];
            if (!$list_bill) {
                $data = [
                    'codebill' => $booking_detail->code,
                    'booking_detail_id' => $booking_detail_id,
                    'date' => now(),
                    'total_price' => array_sum(array_column($repair_parts->toArray(), 'into_money')),
                    'customers_pay' => $request->customers_pay,
                    'excess_cash' => $request->excess_cash,
                    'type' => 2,
                    'status' => 2,

                ];
                $bill_repair =    list_bill::create($data);
                foreach ($repair_parts as $r) {
                    if (!empty($r->component->import_price)) {
                        $nhap = $r->component->import_price;
                    } else {
                        $nhap = 0;
                    }
                    $data1 = [
                        'quaty' => $r->quantity,
                        'code_bill' => $bill_repair->codebill,
                        'bill_id' => $bill_repair->id,
                        'nhap' =>  $nhap,
                        'ban' => $r->unit_price,
                        'component_id' => $r->component_id,
                        'description' => $r->name_product,
                    ];
                    bill_detail::create($data1);
                }
            } else {
                $list_bill->fill($data)->save();
            }
        }
        return back();
    }
    // public function luuThongTinThanhToan($id, Request $request)
    // {
    //     // dd($request);
    //     $booking_detail = BookingDetail::find($id);
    //     if ($booking_detail) {
    //         $booking_detail_bill = list_bill::where('booking_detail_id', $booking_detail->id)->first();
    //         // dd($booking_detail_bill);
    //         $booking_detail_bill->customers_pay = $request->customers_pay;
    //         $booking_detail_bill->save();
    //         return back();
    //     }
    // }
    public function xuatHoaDon($booking_detail_id)
    {
        $booking_detail = BookingDetail::find($booking_detail_id);
        $booking_detail_bill = list_bill::where('booking_detail_id', $booking_detail_id)->first();

        if ($booking_detail_bill) {
            // $repair_parts = RepairPart::where("booking_detail_id", $booking_detail_id)
            //     ->get();
            // if ($repair_parts) {
            //     $repair_parts->load('components');   
            //     $repair_parts->load('booking_detail');
            // }

            $bill_detail = bill_detail::where('bill_id', $booking_detail_bill->id)->get();
            // dd($bill_detail);
            $data = ['bill_detail' => $bill_detail, 'booking_detail_bill' =>  $booking_detail_bill, 'booking_detail' => $booking_detail];
            $pdf = PDF::loadHTML('admin.booking.xuat_hoa_don');

            $pdf = PDF::loadView('admin.booking.xuat_hoa_don', $data);
            // dd(config('mail.mailers.smtp.username'));
            return  $pdf->stream();
        }
        return back();
    }



    public function phieuNhanMay($booking_detail_id, Request $request)
    {

        $booking_detail = BookingDetail::find($booking_detail_id);
        // $booking_detail
        if ($booking_detail) {
            $booking = Booking::find($booking_detail->booking_id)->fill([
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                // 'email' => $request->email,
                'interval' => $request->interval
            ])->save();
            $booking_detail->comment = $request->comment;
            $booking_detail->save();
            $booking_detail->fill($request->all())->save();
            $booking_detail->status_repair = 'waiting';
            $booking_detail->save();
            if ($request->btn == 'luu_xuat') {
                $data = ['booking_detail' =>  $booking_detail];
                $pdf = PDF::loadHTML('admin.booking.pdf_phieu_nhan_may');

                $pdf = PDF::loadView('admin.booking.pdf_phieu_nhan_may', $data);
                // dd(config('mail.mailers.smtp.username'));
                return  $pdf->stream('nhan-may.pdf');
            }
            return redirect(route('dat-lich.tiep-nhan-may', ['booking_detail_id' => $booking_detail_id]));
        }
    }

    public function sendMailFinishMember($booking_detail_id)
    {
        $booking_detail = BookingDetail::find($booking_detail_id);
        if ($booking_detail) {
            $booking_detail->load('booking');
            $repair_parts = RepairPart::where('booking_detail_id', $booking_detail_id)->get();

            $data = [
                'booking_detail' => $booking_detail, 'repair_parts' => $repair_parts,
            ];
            $email = $booking_detail->booking->email;
            Mail::send('admin.mail.coifirm_finish_menber', $data, function ($message) use ($email) {
                $message->from('manhhung17062001@gmail.com', 'Cửa hàng laptop51');
                $message->to($email, 'John Doe');
                $message->subject('Thông báo sửa máy hoàn thành');
            });
        }
        return back();
    }
}
