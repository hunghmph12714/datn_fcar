<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\bill_detail;
use App\Models\CarCompany;
use App\Models\User;
use App\Models\DetailProduct;
use App\Models\Booking;
use App\Models\BillDetail;
use App\Models\CategoryComponent;
use App\Models\Component;
use App\Models\list_bill;
use App\Models\Product;
use App\Models\UserRepair;
use Illuminate\Http\Request;
use Nette\Schema\Expect;
use PhpParser\Node\Stmt\TryCatch;
use SebastianBergmann\Environment\Console;
use Svg\Tag\Rect;

class DataController extends Controller
{
    public function searchproduct(Request $request)
    {
        $name = $request->only('name');
        $products = Product::where('name', 'like', '%' . $name['name'] . '%')->get();
        return response()->json(['products' => $products], 200);
    }
    public function LayDuLieuTheoNgay(SearchRequest $request)
    {
        $input = $request->only('timestart', 'timeend');
        $start = $input['timestart'];
        $end = $input['timeend'];
        $total_category = CarCompany::whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->count('id');
        $total_product = Product::whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->count('id');
        $total_user = User::whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->count();
        $total_mua_hang = list_bill::whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->where('status',2)->where('type',1)->count('id');
        $total_danh_muc_linh_kien = CategoryComponent::whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->count('id');
        $total_linh_kien = Component::whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->count('id');
        $total_dat_lich = list_bill::whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->where('status',2)->where('type',2)->count('id');

        //data sản phẩm
        $datasanphamban = [];
        $socacsanphamdaban = bill_detail::query()
      ->with('list_bill')
      ->whereHas('list_bill', function ($q) {
        $q->where('status', '=', 2);
      })
      ->whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)
      ->where('product_id','!=',null)->where('component_id','=',null)
      ->distinct()->limit(10)
      ->pluck('product_id');
        foreach ($socacsanphamdaban as $sanpham) {
            try {
                $product = Product::whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->where('id', $sanpham)->get();
                array_push($datasanphamban, [['name' => $product[0]->name,'quaty' => bill_detail::query()
                ->with('list_bill')
                ->whereHas('list_bill', function ($q) {
                  $q->where('status', '=', 2);
                })
                ->where('product_id', $sanpham)->count()]]);
            } catch (\Throwable $th) {
                continue;
            }
        }
        //data nhân viên
        $datanhanvien = [];
        $socacnhanvien = UserRepair::where('status', 2)->whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->distinct()->limit(10)->pluck('user_id');
        foreach ($socacnhanvien as $nhanvien) {
            try {
                $profile = User::whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->where('id', $nhanvien)->get();
                array_push($datanhanvien, [['name' => $profile[0]->name, 'quaty' => UserRepair::where('user_id', $nhanvien)->count()]]);
            } catch (\Throwable $th) {
                continue;
            }
        }

        return response()->json([
            'total_category' => $total_category,
            'total_product' => $total_product,
            'total_user' => $total_user,
            'total_mua_hang' => $total_mua_hang,
            'total_danh_muc_linh_kien' => $total_danh_muc_linh_kien,
            'total_linh_kien' => $total_linh_kien,
            'total_dat_lich' => $total_dat_lich,
            'datasanphamban' => $datasanphamban,
            'datanhanvien' => $datanhanvien,

        ]);
    }
    public function bieudo(Request $request)
    {
        $input = $request->only('timestart', 'timeend');
        return $this->laydatadoanhthu($input['timestart'], $input['timeend']);
    }
    public function bieudosuachua(Request $request)
    {
        $input = $request->only('timestart', 'timeend');
        return $this->doanhthusuachua($input['timestart'], $input['timeend']);
    }
    public function bieudoban(Request $request)
    {
        $input = $request->only('timestart', 'timeend');
        return $this->databan($input['timestart'], $input['timeend']);
    }
    public function databan($start, $end)
    {
        $doanhthutong = list_bill::where('type', 1)->whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->sum('total_price');
        $billBan = bill_detail::query()
      ->with('list_bill')
      ->whereHas('list_bill', function ($q) {
        $q->where('status', '=', 2);
      })
      ->whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)
      ->where('product_id','!=',null)->where('component_id','=',null)->get();
        foreach ($billBan as $item) {
            $item->total_nhap = ($item->nhap * $item->quaty);
            $item->total_ban = ($item->ban * $item->quaty);
        }
        $arrayTotalNhapOrder = $billBan->pluck('total_nhap')->toArray();
        $sotiennhapOrder = array_sum($arrayTotalNhapOrder);
        $arrayTotalBanOrder = $billBan->pluck('total_ban')->toArray();
        $sotienbanOrder = array_sum($arrayTotalBanOrder);
        $sotienlaiban = $sotienbanOrder - $sotiennhapOrder;
        return [
            'doanhthutong' => $doanhthutong,
            'sotiennhap' => $sotiennhapOrder,
            'sotienban' => $sotienbanOrder,
            'sotienlai' => $sotienlaiban
        ];
    }
    public function laydatadoanhthu($start, $end)
    {
        $doanhthutong = list_bill::where('status', 2)->whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->sum('total_price');
        $bill = bill_detail::query()
            ->with('list_bill')
            ->whereHas('list_bill', function ($q) {
                $q->where('status', '=', 2);
            })
            ->whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)
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

        return [
            'doanhthutong' => $doanhthutong,
            'sotiennhap' => $sotiennhap,
            'sotienban' => $sotienban,
            'sotienlai' => $sotienlai
        ];
    }
    public function doanhthusuachua($start, $end)
    {
        $doanhthutong = list_bill::where('type', 2)->whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)->sum('total_price');
        $billSua = bill_detail::query()
      ->with('list_bill')
      ->whereHas('list_bill', function ($q) {
        $q->where('status', '=', 2);
      })
      ->whereDate('created_at', '>', $start)->WhereDate('created_at', '<=', $end)
      ->where('product_id','=',null)->where('component_id','!=',null)->get();
        foreach ($billSua as $item) {
            $item->total_nhap = ($item->nhap * $item->quaty);
            $item->total_ban = ($item->ban * $item->quaty);
        }

        $arrayTotalNhapSua = $billSua->pluck('total_nhap')->toArray();
        $sotiennhapSua = array_sum($arrayTotalNhapSua);
        $arrayTotalBanSua = $billSua->pluck('total_ban')->toArray();
        $sotienbanSua = array_sum($arrayTotalBanSua);
        $sotienlaisuachua = $sotienbanSua - $sotiennhapSua;
        return [
            'doanhthutong' => $doanhthutong,
            'sotiennhap' => $sotiennhapSua,
            'sotienban' => $sotienbanSua,
            'sotienlai' => $sotienlaisuachua
        ];
    }
}
