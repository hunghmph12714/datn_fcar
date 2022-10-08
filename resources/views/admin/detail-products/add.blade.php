@extends('admin.layouts.main')
@section('title', 'Thêm chi tiết sản phẩm')
@section('content')


    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="row ml-2">
                <div class="col-6 mt-2">
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input type="text" name="name" class="form-control" placeholder="">
                    </div>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="">Ảnh</label>
                        <input type="file" name="anh" class="form-control" placeholder="">
                    </div>
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label for="">Giá nhập</label>
                        <input type="number" name="import_price" class="form-control" placeholder="">
                    </div>
                    @error('import_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label for="">Giá bán</label>
                        <input type="number" name="price" class="form-control" placeholder="">
                    </div>
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="">Sản phẩm</label>
                        <select name="product_id" class="form-control">
                            <option value="">Chọn sản phẩm</option>
                            @foreach ($products as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('product_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6 mt-2">

                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea name="desc" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Thời gian bảo hành</label>
                        <input type="number" name="insurance" class="form-control">
                    </div>
                    @error('insurance')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="form-group ">
                        <label for="" class="mt-3">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="">Chọn trạng thái</option>
                            <option value="1">Còn hàng</option>
                            <option value="0">Hết hàng</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-2 ml-2">
                    <br>
                    <a href="{{ route('detail-product.index') }}" class="btn btn-danger">Hủy</a>
                    &nbsp;
                    <button type="submit" class="btn btn-success">Lưu</button>
                </div>
            </div>
        </div>
    </form>


@endsection
