@extends('admin.layouts.main')
@section('title', 'Thêm nhân viên')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script>
$(function() {
    $('.select2_init').select2({
        'placeholder': 'Chọn vai trò'
    })
});
</script>
<div class="row">
    <div class="card">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tên người dùng</label>
                            <input type="text" name="name" class="form-control" placeholder="">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" placeholder="">
                            @error('password')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh đại diện</label>
                            <input type="file" name="avatar" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Quyền truy cập admin</label>
                            <div class="form-check mx-2">
                                <input class="form-check-input radio-color" value="1" type="radio" name="id_role"
                                    id="flexRadioDefault1" autocompleted="">
                                <label class="form-check-label" for="flexRadioDefault1"> Có
                                </label>
                            </div>
                            <div class="form-check mx-2">
                                <input class="form-check-input radio-color" checked value="0" type="radio"
                                    name="id_role" id="flexRadioDefault1" autocompleted="">
                                <label class="form-check-label" for="flexRadioDefault1"> Không
                                </label>
                            </div>
                            @error('id_role')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Số điện thoại</label>
                            <input type="number" name="phone" class="form-control" placeholder="">
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <input type="text" name="address" class="form-control" placeholder="">
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <input type="text" name="description" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Vai trò</label>
                            <select name="role_id[]" class="form-control select2_init" multiple>
                                @foreach($roles as $role)
                                @if($role->id != 1)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <br>
                        <a href="{{route('user.index')}}" class="btn btn-sm btn-danger">Hủy</a>
                        &nbsp;
                        <button type="submit" class="btn btn-sm btn-success">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection