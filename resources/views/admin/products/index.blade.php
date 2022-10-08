@extends('admin.layouts.main')
@section('title', 'Danh sách sản phẩm')
@section('content')
@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Thông báo: </strong>{{ Session::get('success') }}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Thông báo: </strong>{{ Session::get('error') }}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="row">
    <div class="col-2 text-right">
        <a class="btn btn-warning" href="{{ route('export-product') }}">Export Data</a>
    </div>
    <div class="col-2">
        <a class="btn btn-info" href="{{ route('view-import-product') }}">Import Data</a>
    </div>

    <form action="{{ route('product.index') }}" method="GET" class="col-8">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" id="" aria-describedby="helpId"
                        placeholder="Tìm kiếm theo tên">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select name="companyComputer_id" class="form-control ">
                        <option value="0">Hãng máy</option>
                        @foreach($ComputerCompany as $com)
                        <option value="{{$com->id}}">{{$com->company_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select name="status" class="form-control ">
                        <option value="0">Trạng thái</option>
                        <option value="1">Đang hiện</option>
                        <option value="2">Đang ẩn</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </div>




    </form>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <th class="px-0 " style="width: 1px;">STT</th>
                        <th style="max-width: 480px;">Tên</th>
                        <th>Hãng</th>
                        <th>Ảnh</th>
                        <th>Giá mua</th>
                        <th>Giá bán</th>
                        <th>Số lượng</th>
                        <th class="">Trạng thái</th>
                        <th>
                            @can('add-product')
                            <a class="btn btn-sm btn-info" href="{{ route('product.add') }}">Thêm</a>
                            @endcan
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <?php
                                            if (!function_exists('currency_format')) {
                                                function currency_format($cont, $suffix = ' VNĐ')
                                                {
                                                    if (!empty($cont)) {
                                                        return number_format($cont, 0, ',', '.') . "{$suffix}";
                                                    }
                                                }
                                            }
                                            ?>
                            <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                            <td style="max-width: 350px;">{{ $item->name }}</td>
                            <td>
                                {{ $item->companyComputer->company_name }}
                            </td>


                            <td>
                                @if(sizeof($item->image_product)>0)
                                {{-- @foreach($item->image_product[0] as $item2) --}}
                                <img src="{{asset($item->image_product[0]->path)}}" alt="" width="100">
                                {{-- @endforeach --}}
                                @endif
                            </td>

                            <td>{{ currency_format($item->import_price) }}</td>
                            <td>{{ currency_format($item->price) }}</td>
                            <td>
                                @if($item->qty <= 0) <p class="text-danger"> Hết hàng</p>
                                    @elseif($item->qty < 5) <p class="text-danger"> {{$item->qty}}</p>
                                        @else
                                        <p>{{$item->qty}}</p>
                                        @endif
                            </td>
                            <td>
                                @if($item->status == 1)
                                <p class="text-success mb-0">Đang hiện</p>
                                @else
                                <p class="text-danger mb-0">Đang ẩn</p>
                                @endif
                            </td>
                            <td>
                                @can('edit-product')
                                <!-- <a href="{{ route('nhap-sanpham.add', ['id' => $item->id]) }}"
                                    class="btn btn-sm btn-success">Thêm SL</a> -->

                                <a href="{{ route('product.edit', ['id' => $item->id]) }}"
                                    class="btn btn-sm btn-warning">Sửa</a>
                                @endcan
                                @can('delete-product')
                                @if($item->status === 0)
                                <form class="d-inline" action="product/show-hide/{{$item->id}}" method="POST">
                                    @csrf
                                    <input name="id" hidden value="{{$item->id}}">
                                    <button style="font:14px" class="btn btn-sm btn-success" type="submit">
                                        Hiện
                                    </button>
                                </form>
                                @endif
                                @if($item->status === 1)
                                <form class="d-inline" action="product/show-hide/{{$item->id}}" method="POST">
                                    @csrf
                                    <input name="id" hidden value="{{$item->id}}">
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        Ẩn
                                    </button>
                                </form>
                                @endif
                                @endcan


                                <!-- <a onclick="return confirm('Bạn có chắc muốn xóa')"
                                    href="{{route('product.remove', ['id' => $item->id])}}"
                                    class="btn btn-sm btn-danger">Xóa</a>  -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center pt-3">
                    {{ $products->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection