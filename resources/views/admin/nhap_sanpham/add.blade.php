@extends('admin.layouts.main')
@section('title','Nhập hàng')
@section('content')

    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card row">
            <div class="col-6">
                <div class="form-group mt-2">
                  <label for="">Tên</label>
                  <input type="text" name="name" disabled value="{{$findProduct->name}}" class="form-control" placeholder="">
                </div>
                <div class="form-group mt-2">
                    <label for="">Số lượng</label>
                    <input type="text" name="qty" value="{{old('qty')}}" class="form-control" placeholder="">
                  </div>
            
            <div class="mb-2">
                
                <a href="{{route('nhap-sanpham.index')}}" class="btn btn-danger">Hủy</a>
                &nbsp;
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </form>

@endsection