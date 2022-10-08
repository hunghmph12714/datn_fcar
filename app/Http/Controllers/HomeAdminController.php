<?php

namespace App\Http\Controllers;

use App\Models\CarCompany;
use App\Models\list_bill;
use App\Models\Product;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserRepair;
use App\Models\bill_detail;
use App\Models\Booking;
use App\Models\CategoryComponent;
use App\Models\Component;
use App\Models\ComponentComputerConpany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class HomeAdminController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $total_category = CarCompany::count('id');
    $total_product = Product::count('id');
    $total_user = User::count('id');
    $total_mua_hang = list_bill::where('type', 1)->where('status', 2)->count('id');
    $total_dat_lich = list_bill::where('type', 2)->where('status', 2)->count('id');
    $total_category_component = CategoryComponent::count('id');
    $total_component = Component::count('id');

    // tong doanh thu 
    $doanhthutong = list_bill::where('status', 2)->sum('total_price');
    $bill = bill_detail::query()
      ->with('list_bill')
      ->whereHas('list_bill', function ($q) {
        $q->where('status', '=', 2);
      })
      ->get();
    foreach ($bill as $item) {
      $item->total_nhap = ($item->nhap * $item->quaty);
      $item->total_ban = ($item->ban * $item->quaty);
    }
    $arrayTotalNhap = $bill->pluck('total_nhap')->toArray();
    $sotiennhap = array_sum($arrayTotalNhap);
    $arrayTotalBan = $bill->pluck('total_ban')->toArray();
    $sotienban = array_sum($arrayTotalBan);
    $sotienlai = $sotienban - $sotiennhap;

    //doanh thu sửa chữa
    $doanhthusuachua = list_bill::where('type', 2)->where('status', 2)->sum('total_price');
    $billSua = bill_detail::query()
      ->with('list_bill')
      ->whereHas('list_bill', function ($q) {
        $q->where('status', '=', 2);
      })
      ->where('product_id', '=', null)->where('component_id', '!=', null)->get();
    foreach ($billSua as $item) {
      $item->total_nhap = ($item->nhap * $item->quaty);
      $item->total_ban = ($item->ban * $item->quaty);
    }
    $arrayTotalNhapSua = $billSua->pluck('total_nhap')->toArray();
    $sotiennhapSua = array_sum($arrayTotalNhapSua);
    $arrayTotalBanSua = $billSua->pluck('total_ban')->toArray();
    $sotienbanSua = array_sum($arrayTotalBanSua);
    $sotienlaisuachua = $sotienbanSua - $sotiennhapSua;

    //doanh thu bán
    $doanhthutongban = list_bill::where('type', 1)->where('status', 2)->sum('total_price');
    $billBan = bill_detail::query()
      ->with('list_bill')
      ->whereHas('list_bill', function ($q) {
        $q->where('status', '=', 2);
      })
      ->where('product_id', '!=', null)->where('component_id', '=', null)->get();
    foreach ($billBan as $item) {
      $item->total_nhap = ($item->nhap * $item->quaty);
      $item->total_ban = ($item->ban * $item->quaty);
    }
    $arrayTotalNhapOrder = $billBan->pluck('total_nhap')->toArray();
    $sotiennhapOrder = array_sum($arrayTotalNhapOrder);
    $arrayTotalBanOrder = $billBan->pluck('total_ban')->toArray();
    $sotienbanOrder = array_sum($arrayTotalBanOrder);
    $sotienlaiban = $sotienbanOrder - $sotiennhapOrder;

    //top thể loại
    $socacsanphamdaban = bill_detail::query()
      ->with('list_bill')
      ->whereHas('list_bill', function ($q) {
        $q->where('status', '=', 2);
      })
      ->where('product_id', '!=', null)->where('component_id', '=', null)
      ->distinct()->limit(10)
      ->pluck('product_id');
    $datasanphamban = [];

    foreach ($socacsanphamdaban as $sanpham) {
      $product = Product::find($sanpham)['name'];
      if ($product ?? null) {
        // dd($product);
        array_push($datasanphamban, [['name' => $product, 'quaty' => bill_detail::query()
          ->with('list_bill')
          ->whereHas('list_bill', function ($q) {
            $q->where('status', '=', 2);
          })
          ->where('product_id', $sanpham)->count()]]);
      }
    }

    // top nv sửa chữa
    $datanhanvien = [];
    $topnvsuachua = UserRepair::where('status', 2)->distinct()->limit(10)->pluck('user_id');

    foreach ($topnvsuachua as $nhanvien) {
      $profile = User::find($nhanvien)['name'];
      if ($profile ?? null) {
        array_push($datanhanvien, ['name' => $profile, 'quaty' => UserRepair::where('user_id', $nhanvien)->count()]);
      }
    }

    return view('admin.index', compact(
      'total_category',
      'total_product',
      'total_mua_hang',
      'total_user',
      'total_dat_lich',
      'total_category_component',
      'total_component',
      'doanhthutong',
      'sotiennhap',
      'sotienlai',
      'doanhthusuachua',
      'sotiennhapSua',
      'sotienbanSua',
      'sotienlaisuachua',
      'doanhthutongban',
      'sotiennhapOrder',
      'sotienbanOrder',
      'sotienlaiban',
      'datasanphamban',
      'datanhanvien'
    ));
  }
}