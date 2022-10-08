@extends('admin.layouts.main')
@section('title','Sửa thuộc tính')
@section('content')


    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                  <label for="">Tên thuộc tính</label>
                  <input type="text" name="name" value="{{ old('name', $Category->name) }}" class="form-control" placeholder="">
                </div>
            <div >
                
                <a href="{{route('category.index')}}" class="btn btn-danger">Hủy</a>
                &nbsp;
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </form>


    
@endsection