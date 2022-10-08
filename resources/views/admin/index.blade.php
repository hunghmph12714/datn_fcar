@extends('admin.layouts.main')
@section('title', 'Trang chủ')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class='row'>
            <div class="col-6">
            </div>
            <div class='col-6 mb-5'>
                <form action="" id="form_search_ajax">
                    {{ csrf_field() }}
                    <label for="datetimestart">Bắt đầu</label>
                    <input type="date" id="datetimestart" name="datetime_start" class="btn btn-light mr-3">
                    @error('datetime_start')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <label for="datetimeend">Kết thúc</label>
                    <input type="date" id="datetimeend" name="datetime_end" class="btn btn-light mr-3">
                    @error('datetime_end')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <button type="button" id="search_date" class="btn btn-primary">tìm kiếm</button>
                </form>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id='total_category'>{{ $total_category }}</h3>
                        <p>Danh mục sản phẩm</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    @can('list-category')
                    {{-- <a href="{{ route('CompanyComputer.index') }}" class="small-box-footer">Chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a> --}}
                    @endcan
                </div>
            </div>


            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id='total_product'>{{ $total_product }}</h3>
                        <p>Sản phẩm</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    @can('list-product')
                    <a href="{{ route('product.index') }}" class="small-box-footer">Chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>
                    @endcan
                </div>

            </div>
            @can('list-user')
            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id='total_user'>{{ $total_user }}</h3>
                        <p>Thành viên</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>

                    <a href="{{ route('user.index') }}" class="small-box-footer">Chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>

                </div>

            </div>
            @endcan
            @can('list-bill')
            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id='total_mua_hang'>{{ $total_mua_hang }}</h3>
                        <p>Mua hàng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('bill.index') }}" class="small-box-footer">Chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endcan

            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id='total_danh_muc_linh_kien'>{{ $total_category_component }}</h3>
                        <p>Danh mục linh kiện</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    @can('list-category')
                    <a href="{{ route('category_component.index') }}" class="small-box-footer">Chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>
                    @endcan

                </div>
            </div>
            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id='total_linh_kien'>{{ $total_component }}</h3>
                        <p>Linh kiện</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    @can('list-product')

                    <a href="{{ route('component.index') }}" class="small-box-footer">Chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>
                    @endcan

                </div>

            </div>
            @can('list-booking')
            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id='total_dat_lich'>{{ $total_dat_lich }}</h3>
                        <p>Đặt lịch</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('dat-lich.index') }}" class="small-box-footer">Chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>

                </div>

            </div>
            @endcan
        </div>

    </div>
    @can('dash-board')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Top sản phẩm bán chạy</h5>
                </div>
                <div class="card-body">

                    <ul class="list-group" id='listtopdata'>
                        @foreach ($datasanphamban as $key => $sanpham)

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $sanpham[0]['name'] }}
                            <span class="badge badge-primary badge-pill">{{ $sanpham[0]['quaty'] }}</span>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Top nhân viên sửa chữa</h5>
                </div>
                <div class="card-body">

                    <ul class="list-group" id='listtopdatanhanvien'>
                        @foreach ($datanhanvien as $key => $nhanvien)
                        {{-- {{dd($nhanvien[$key]['name'])}} --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $nhanvien['name'] }}

                            <span class="badge badge-primary badge-pill">{{ $nhanvien['quaty'] }}</span>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>

        <?php
                                                        if (!function_exists('currency_format')) {
                                                            function currency_format($bill_d, $suffix = ' VNĐ')
                                                            {
                                                                if (!empty($bill_d)) {
                                                                    return number_format($bill_d, 0, ',', '.') . "{$suffix}";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                                <?php
                                                        if (!function_exists('currency')) {
                                                            function currency($bill_d)
                                                            {
                                                                if (!empty($bill_d)) {
                                                                    return number_format($bill_d, 0, ',', '.');
                                                                }
                                                            }
                                                        }
                                                        ?>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng doanh thu: <span id='tongdoanhthu'>
                            {{ currency_format($doanhthutong) }}</span>
                    </h5><br>
                    <input type="button" style="display:none" id='sotiennhap' value="{{ $sotiennhap }}">
                    <input type="button" style="display:none" id='sotienlai' value="{{$sotienlai}}">
                    <canvas id="doanhthuchart">

                    </canvas>
                </div>
            </div>

        </div>
        <div class='col-6'>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng doanh thu sửa chữa: <span id='tongdoanhthusuachua'>
                            {{ currency_format($doanhthusuachua) }}</span>
                        </h5>
                    <input type="button" style="display:none" id='sotiennhapsuachua' value="{{$sotiennhapSua}}">
                    <input type="button" style="display:none" id='sotienlaisuachua' value="{{ $sotienlaisuachua }}">
                    <canvas id="doanhthusuachua">

                    </canvas>
                </div>
            </div>
        </div>
        <div class='col-6'>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng doanh thu bán: <span id='doanhthutongban'>
                            {{ currency_format($doanhthutongban) }}</span>
                    </h5>
                    <input type="button" style="display:none" id='sotiennhapban' value="{{ $sotiennhapOrder }}">
                    <input type="button" style="display:none" id='sotienlaiban' value="{{ $sotienlaiban }}">
                    <canvas id="doanhthuban">

                    </canvas>
                </div>
            </div>
        </div>
    </div>
    @endcan
</section>
@endsection