<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
use App\Models\Nhaphangsanpham;
use App\Models\Product;
use App\Models\RepairPart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

class ThongkeController extends Controller
{
    public function sanpham(Request $request)
    {
        if (isset($_GET['ngay-bd']) && isset($_GET['ngay-kt'])) {
            $ngay_bd = date('Y-m-d', strtotime($_GET['ngay-bd']));
            $ngay_kt = date('Y-m-d', strtotime($_GET['ngay-kt']));
            $products = Product::with('nhaphangsanpham', 'bill')->whereBetween('created_at', [$ngay_bd, $ngay_kt])->get();
            $sum_product = $products->sum('qty');
            $nhapSanPham = Nhaphangsanpham::whereBetween('created_at', [$ngay_bd, $ngay_kt])->get();
            $nhapSanPham->load('importProduct');
            $billDetail = DB::table('products')
                ->join('bill_details', 'bill_details.product_id', '=', 'products.id')
                ->join('bills', 'bill_details.bill_code', '=', 'bills.code')
                ->join('users', 'bills.user_id', '=', 'users.id')
                ->select('bill_details.created_at', 'products.name as product_name', 'bill_details.qty', 'products.price', 'users.name as user_name')
                ->whereBetween('bill_details.created_at', [$ngay_bd, $ngay_kt])
                ->get();
        } else {
            $products = Product::query()->with('nhaphangsanpham', 'bill')->get();
            $sum_product = $products->sum('qty');
            // $products = $products->paginate(10);
            $nhapSanPham = Nhaphangsanpham::all();
            $nhapSanPham->load('importProduct');
            $billDetail = DB::table('products')
                ->join('bill_details', 'bill_details.product_id', '=', 'products.id')
                ->join('bills', 'bill_details.bill_code', '=', 'bills.code')
                ->join('users', 'bills.user_id', '=', 'users.id')
                ->select('bill_details.created_at', 'products.name as product_name', 'bill_details.qty', 'products.price', 'users.name as user_name')
                ->get();
        }

        return view('admin.thongke.sanpham', compact('billDetail', 'products', 'sum_product', 'request', 'nhapSanPham'));
    }
    public function ajax(Request $request)
    {
        $order = null;
        //        if (empty($request->start_date) || empty($request->end_date)){
        $order = BillDetail::query()
            ->orderBy("created_at", "asc")
            ->get()->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            });
        //        }
        $results = [];
        foreach ($order as $time => $order) {
            $value = 0;
            foreach ($order as $item) {
                $value += $item->qty;
            }
            array_push($results, ['time' => $time, 'value' => $value]);
        }
        return response()->json($results);
    }

    public function chitietSanpham()
    {
        return view('admin.thongke.chitiet-sanpham');
    }

    public function order()
    {
        // $users = DB::table('repair_parts')
        //     ->select('repair_parts.id as id', 'bookings.email', DB::raw('count(email) as count_email'))
        //     ->groupBy('email')
        //     ->join('booking_details', 'repair_parts.booking_detail_id', '=', 'booking_details.id')
        //     ->join('bookings', 'booking_details.booking_id', '=', 'bookings.id')
        //     ->first();
        // dd($users);

        $doanhthu = DB::table('bills')->where('payment_status', '0')
        ->get();
        // dd($doanhthu);
        // foreach($doanhthu as $item){
        //     dd($item);
        // }

        return view('admin.thongke.order', compact('doanhthu'));
    }

    public function doanhthu(Request $request)
    {
        // $ngay = date('Y-m-d', strtotime());
        $doanhthu = DB::table('products')
            ->join('bill_details', 'bill_details.product_id', '=', 'products.id')
            ->select('products.name','products.import_price','products.price',DB::raw('sum(bill_details.qty) as total_qty') )
            ->groupBy('bill_details.product_id')
            // ->groupBy(('bill_details.created_at')->format('Y-m-d'))
            ->get();
            // dd ($doanhthu);
        return view('admin.thongke.doanhthu',compact('doanhthu'));
    }
}
