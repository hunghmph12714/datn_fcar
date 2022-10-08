@extends('admin.layouts.main')
@section('title', 'Sửa chi tiết sản phẩm')
@section('content')


    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="row ml-2">
                <div class="col-6 mt-2">
                    <div class="form-group">
                        <label for="">Chi tiết</label>
                        <input type="text" name="name" value="{{old('name',$pro->name)}}" class="form-control" placeholder="">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh</label>
                        <input type="file" name="anh" class="form-control" placeholder="">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Giá nhập</label>
                        <input type="number" name="import_price" class="form-control" placeholder="">
                    </div>
                    @error('import_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label for="">Giá</label>
                        <input type="number" name="price" value="{{old('name',$pro->price)}}" class="form-control" placeholder="">
                        @error('price')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng:</label>
                        <input type="text" name="qty" value="{{old('name',$pro->qty)}}" class="form-control" placeholder="">
                        @error('qty')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-6 mt-2">
                    
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <textarea name="desc" rows="4" value="{{old('name',$pro->desc)}}" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian bảo hành</label>
                            <input type="number" name="insurance" value="{{old('insurance',$pro->insurance)}}" class="form-control">
                        </div>
                        <div class="form-group ">
                            <label for="" class="mt-3">Status</label>
                            <select name="status" id="" class="form-control">
                                @if($pro->status)
                                    selected
                                @endif
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
