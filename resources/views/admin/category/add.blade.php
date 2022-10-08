@extends('admin.layouts.main')
@section('title','Thêm thuộc tính')
@section('content')

    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card row">
            <div class="col-6">
                <div class="form-group mt-2">
                  <label for="">Tên thuộc tính</label>
                  <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="">
                </div>
            <div class="mb-2">
                
                <a href="{{route('category.index')}}" class="btn btn-danger">Hủy</a>
                &nbsp;
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </form>

@endsection 