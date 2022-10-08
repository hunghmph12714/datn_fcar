@extends('admin.layouts.main')
@section('title', 'Sửa thông tin danh mục')
@section('content')


<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tên danh mục</label>
                <input type="text" name="company_name" value="{{ old('company_name', $CompanyCar->company_name) }}"
                    class="form-control" placeholder="">
                @error('company_name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Ảnh</label>
                <input type="file" name="anh" class="form-control" placeholder="">
            </div>
            @error('anh')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="mb-2 text-right">

<a href="{{ route('CompanyCar.index') }}" class="btn btn-danger">Hủy</a>
&nbsp;
<button type="submit" class="btn btn-success">Lưu</button>
</div>
        </div>

    </div>
</form>



@endsection