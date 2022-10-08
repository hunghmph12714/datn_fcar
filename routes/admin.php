<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingDetailController;
use App\Http\Controllers\CategoryComponentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyCarController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Categories_NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ThongkeController;
use App\Http\Controllers\NhapsanphamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\CategoryComponent;
use App\Models\Component;
use App\Models\DetailProduct;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'account.admin'])->group(function () {

    Route::get('/', [HomeAdminController::class, 'index'])->name('admin.dashboard');
    Route::prefix('bill')->group(function () {
        Route::get('/2', [BillController::class, 'index2'])->name('bill.index2');
        Route::post('send-message', [BillController::class, 'sendMessage'])->name('send.message');
        Route::get('/', [BillController::class, 'index'])->name('bill.index');
        Route::get('detail/{id}', [BillController::class, 'detail'])->name('bill.detail');
        Route::get('edit/{id}', [BillController::class, 'edit'])->name('bill.edit');
        Route::post('edit/{id}', [BillController::class, 'saveEdit']);
    });
    Route::prefix('CompanyCar')->group(function () {
        Route::get('/', [CompanyCarController::class, 'index'])->name('CompanyCar.index')->middleware('can:list-category');
        Route::get('/remove/{id}', [CompanyCarController::class, 'remove'])->name('CompanyCar.remove')->middleware('can:delete-category');
        Route::get('add', [CompanyCarController::class, 'addForm'])->name('CompanyCar.add')->middleware('can:add-category');
        Route::post('add', [CompanyCarController::class, 'saveAdd'])->middleware('can:add-category');
        Route::get('edit/{id}', [CompanyCarController::class, 'editForm'])->name('CompanyCar.edit')->middleware('can:edit-category');
        Route::post('edit/{id}', [CompanyCarController::class, 'saveEdit'])->middleware('can:edit-category');
        Route::get('detail/{id}', [CompanyCarController::class, 'detail'])->middleware('can:list-category');
    });
    Route::prefix('nhap_sanpham')->group(function () {
        Route::get('/', [NhapsanphamController::class, 'index'])->name('nhap-sanpham.index');
        Route::get('/remove/{id}', [NhapsanphamController::class, 'remove'])->name('nhap-sanpham.remove');
        Route::get('add/{id}', [NhapsanphamController::class, 'addForm'])->name('nhap-sanpham.add');
        Route::post('add/{id}', [NhapsanphamController::class, 'saveAdd']);
        Route::get('edit/{id}', [NhapsanphamController::class, 'editForm'])->name('nhap-sanpham.edit');
        Route::post('edit/{id}', [NhapsanphamController::class, 'saveEdit']);
        Route::get('detail/{id}', [NhapsanphamController::class, 'detail']);
    });
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index')->middleware('can:list-product');
        Route::get('/remove/{id}', [ProductController::class, 'remove'])->name('product.remove')->middleware('can:delete-product');
        Route::get('add', [ProductController::class, 'addForm'])->name('product.add')->middleware('can:add-product');
        Route::post('add', [ProductController::class, 'saveAdd'])->middleware('can:add-product');
        Route::get('edit/{id}', [ProductController::class, 'editForm'])->name('product.edit')->middleware('can:edit-product');
        Route::post('edit/{id}', [ProductController::class, 'saveEdit'])->middleware('can:edit-product');
        Route::get('detail/{id}', [ProductController::class, 'detail'])->middleware('can:edit-product');
        Route::post('show-hide/{id}', [ProductController::class, 'ShowHide'])->name('product.show-hide')->middleware('can:edit-product');
    });
    Route::prefix('detail-product')->group(function () {
        Route::get('/', [DetailProductController::class, 'index'])->name('detail-product.index')->middleware('can:list-product');
        Route::get('/remove/{id}', [DetailProductController::class, 'remove'])->name('detail-product.remove')->middleware('can:delete-product');
        Route::get('add', [DetailProductController::class, 'addForm'])->name('detail-product.add')->middleware('can:add-product');
        Route::post('add', [DetailProductController::class, 'saveAdd'])->middleware('can:add-product');
        Route::get('edit/{id}', [DetailProductController::class, 'editForm'])->name('detail-product.edit')->middleware('can:edit-product');
        Route::post('edit/{id}', [DetailProductController::class, 'saveEdit'])->middleware('can:edit-product');
        Route::get('detail/{id}', [DetailProductController::class, 'detail'])->middleware('can:list-product');
    });
    Route::prefix('component')->group(function () {
        Route::get('/', [ComponentController::class, 'index'])->name('component.index')->middleware('can:list-product');
        Route::get('/remove/{id}', [ComponentController::class, 'remove'])->name('component.remove')->middleware('can:delete-product');
        Route::get('add', [ComponentController::class, 'addForm'])->name('component.add')->middleware('can:add-product');
        Route::post('add', [ComponentController::class, 'saveAdd'])->middleware('can:add-product');
        Route::get('edit/{id}', [ComponentController::class, 'editForm'])->name('component.edit')->middleware('can:edit-product');
        Route::post('edit/{id}', [ComponentController::class, 'saveEdit'])->middleware('can:edit-product');
        Route::get('detail/{id}', [ComponentController::class, 'detail'])->middleware('can:list-product');
        Route::get('query/{category_component_id}', function ($category_component_id) {
            $components = Component::where('category_component_id', $category_component_id)->get();
            return $components;
        });
        Route::get('get-detail/{id}', function ($id) {
            $component = Component::find($id);

            if ($component) {
                // dd($component);
                return response()->json($component);
            }
        });
    });
    // Route::prefix('login')->group(function () {
    //     Route::get('/', [LoginController::class, 'index'])->name('admin.login');
    // });

    // Route::prefix('login')->group(function () {
    //     Route::get('/', [LoginController::class, 'index'])->name('admin.login');
    // });
    Route::prefix('dat-lich')->group(function () {
        Route::get('chi-tiet/{id}', [BookingController::class, 'chiTiet'])->name('dat-lich.chi-tiet');

        Route::get('/', [BookingController::class, 'listBookingDetail'])->name('dat-lich.index');
        Route::post('/', [BookingController::class, 'selectStatusBooking']);

        Route::get('/danh-sach-may', [BookingController::class, 'listBookingDetail'])->name('dat-lich.danh-sach-may');
        Route::post('/danh-sach-may', [BookingController::class, 'selectUserRepair']);
        // Route::get('/danh-sach-may-phan-cong', [BookingController::class, 'listBookingDetail'])->name('dat-lich.danh-sach-may');

        Route::get('send-mail-finish-member/{booking_detail_id}', [BookingDetailController::class, 'sendMailFinishMember'])->name('dat-lich.send-mail-finish-member');




        Route::get('tao-moi', [BookingController::class, 'formCreateBooking'])->name('dat-lich.add')->middleware('can:add-booking');
        Route::post('tao-moi', [BookingController::class, 'creatBooking'])->middleware('can:add-booking');
        Route::get('sua/{id}', [BookingController::class, 'formEditBooking'])->name('dat-lich.edit')->middleware('can:edit-booking');
        Route::post('sua/{id}', [BookingController::class, 'editBooking'])->middleware('can:edit-booking');
        Route::get('xoa/{id}', [BookingController::class, 'deleteBooking'])->name('dat-lich.delete')->middleware('can:delete-booking');
        Route::get('demo', [BookingController::class, 'demo']);
        Route::get('hoa-don/{id}', [BookingDetailController::class, 'hoaDon'])->name('dat-lich.hoa-don');
        Route::post('hoa-don/{id}', [BookingDetailController::class, 'luuHoaDon']);
        Route::get('xuat-hoa-don/{booking_detail_id}', [BookingDetailController::class, 'xuatHoaDon'])->name('dat-lich.xuat-hoa-don');

        Route::get('danh-sach-may-phan-cong', [BookingController::class, 'userRepair'])->name('dat-lich.user_epair')->middleware('can:list-repair');
        Route::get('xoa-may/{id}', [BookingController::class, 'deleteBooking'])->name('dat-lich.deleteBookingDetail')->middleware('can:delete-booking');
        Route::get('tiep-nhan-may/{booking_detail_id}', [BookingController::class, 'tiepNhanMay'])->name('dat-lich.tiep-nhan-may')->middleware('can:edit-booking');
        Route::post('phieu-nhan-may/{booking_detail_id}', [BookingDetailController::class, 'phieuNhanMay'])->name('phieu-nhan-may')->middleware('can:edit-booking');
    });
    Route::prefix('sua-chua')->group(function () {
        Route::get('/{id}', [BookingController::class, 'repairDetail'])->name('suachua.get')->middleware('can:edit-repair');
        Route::post('/{id}', [BookingController::class, 'FinishRepairDetail'])->middleware('can:edit-repair');
        Route::get('/detail-product/{id}', [BookingDetailController::class, 'getDetailProduct'])->middleware('can:edit-repair');;
        // Route::get('/danh-sach-chua-phan-tho', [BookingController::class, 'DanhSachChuaDuocPhanTho']);
        // Route::get('/danh-sach-chua-phan-tho', [BookingController::class, 'DanhSachChuaDuocPhanTho']);
        // Route::get('/danh-sach-chua-phan-tho', [BookingController::class, 'DanhSachChuaDuocPhanTho']);

    });
    Route::prefix('tin-tuc')->group(function () {
        //list
        Route::get('/', [NewsController::class, 'index'])->name('news.index')->middleware('can:list-news');
        //remove
        Route::get('/delete/{id}', [NewsController::class, 'remove'])->name('news.remove')->middleware('can:delete-news');


        //add
        Route::get('/add', [NewsController::class, 'add'])->name('news.add')->middleware('can:add-news');
        Route::post('/add', [NewsController::class, 'save_add']);

        //edit
        Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('news.edit')->middleware('can:edit-news');
        Route::post('/edit/{id}', [NewsController::class, 'save_edit']);
    });
    Route::prefix('danh-muc-tin-tuc')->group(function () {
        //list
        Route::get('/', [Categories_NewsController::class, 'index'])->name('category_news.index')->middleware('can:list-news');

        //add
        Route::get('/add', [Categories_NewsController::class, 'add'])->name('category_news.add')->middleware('can:add-news');
        Route::post('/add', [Categories_NewsController::class, 'save_add']);

        //edit
        Route::get('/edit/{id}', [Categories_NewsController::class, 'edit'])->name('category_news.edit')->middleware('can:edit-news');
        Route::post('/edit/{id}', [Categories_NewsController::class, 'save_edit']);

        //remove
        Route::get('/delete/{id}', [Categories_NewsController::class, 'remove'])->name('category_news.remove')->middleware('can:delete-news');
    });
    Route::post('chuyen-trang-thai', [BookingController::class, 'selectStatusBooking'])->name('dat-lich.chuyen-trang-thai');
    Route::get('/dat-lich/danh-sach-chua-phan-tho', [BookingController::class, 'DanhSachChuaPhanTho'])->name('sua-chua.danh-sach-chua-phan-tho')->middleware('can:list-booking');
    Route::get('/dat-lich/danh-sach-da-sua-xong', [BookingController::class, 'DanhSachDaSuaXong'])->name('sua-chua.danh-sach-da-sua-xong');
    Route::get('/dat-lich/danh-sach-cho-sua', [BookingController::class, 'DanhSachChoSua'])->name('sua-chua.danh-sach-cho-sua')->middleware('can:list-booking');
    Route::get('/dat-lich/danh-sach-chua-xac-nhan', [BookingController::class, 'DanhSachChuaXacNhan'])->name('sua-chua.danh-sach-chua-xac-nhan')->middleware('can:list-booking');
    Route::get('/dat-lich/danh-sach-da-giao-khach', [BookingController::class, 'DanhSachDaGiaoKhach'])->name('sua-chua.danh-sach-da-giao-khach');

    // Route::get('/danh-sach-chua-phan-tho', [BookingController::class, 'DanhSachChuaPhanTho']);


    Route::prefix('thongke')->group(function () {

        Route::get('sanpham', [ThongkeController::class, 'sanpham'])->name('thongke-sanpham');
        Route::get('chitiet-sanpham', [ThongkeController::class, 'chitietSanpham'])->name('thongke-chitiet-sanpham');
        Route::get('order', [ThongkeController::class, 'order'])->name('thongke-order');
        Route::get('doanhthu', [ThongkeController::class, 'doanhthu'])->name('thongke-doanhthu');

        Route::get('ajax', [ThongkeController::class, 'ajax']);
    });
    // Route::prefix('category')->group(function () {
    //     Route::get('/', [CategoryController::class, 'index'])->name('category.index')->middleware('can:list-product');
    //     Route::get('/remove/{id}', [CategoryController::class, 'remove'])->name('category.remove')->middleware('can:delete-product');
    //     Route::get('add', [CategoryController::class, 'addForm'])->name('category.add')->middleware('can:add-product');
    //     Route::post('add', [CategoryController::class, 'saveAdd'])->middleware('can:add-product');
    //     Route::get('edit/{id}', [CategoryController::class, 'editForm'])->name('category.edit')->middleware('can:edit-product');
    //     Route::post('edit/{id}', [CategoryController::class, 'saveEdit'])->middleware('can:edit-product');
    //     // Route::get('detail/{id}', [CategoryController::class, 'detail'])->middleware('can:delete-category');
    // });
    Route::prefix('category_component')->group(function () {
        Route::get('/', [CategoryComponentController::class, 'index'])->name('category_component.index')->middleware('can:list-category');
        Route::get('/remove/{id}', [CategoryComponentController::class, 'remove'])->name('category_component.remove')->middleware('can:delete-category');
        Route::get('add', [CategoryComponentController::class, 'addForm'])->name('category_component.add')->middleware('can:add-category');
        Route::post('add', [CategoryComponentController::class, 'saveAdd'])->middleware('can:add-category');
        Route::get('edit/{id}', [CategoryComponentController::class, 'editForm'])->name('category_component.edit')->middleware('can:edit-category');
        Route::post('edit/{id}', [CategoryComponentController::class, 'saveEdit'])->middleware('can:edit-category');
        // Route::get('detail/{id}', [CategoryController::class, 'detail'])->middleware('can:delete-category_component');
        Route::get('select-all', function () {
            $c = CategoryComponent::all();
            return  $c;
        });
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index')->middleware('can:list-user');
        Route::get('add', [UserController::class, 'addForm'])->name('user.add')->middleware('can:add-user');
        Route::post('add', [UserController::class, 'saveAdd'])->middleware('can:add-user');
        Route::get('remove/{id}', [UserController::class, 'remove'])->name('user.remove')->middleware('can:delete-user');
        Route::get('edit/{id}', [UserController::class, 'editForm'])->name('user.edit')->middleware('can:edit-user');
        Route::post('edit/{id}', [UserController::class, 'saveEdit'])->middleware('can:edit-user');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware('can:list-role');
        Route::get('add', [RoleController::class, 'create'])->name('roles.create')->middleware('can:add-role');
        Route::post('add', [RoleController::class, 'store'])->name(('roles.store'))->middleware('can:add-role');
        Route::get('remove/{id}', [RoleController::class, 'remove'])->name('roles.remove')->middleware('can:delete-role');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('roles.edit')->middleware('can:edit-role');
        Route::post('edit/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware('can:edit-role');
    });
});
