@extends('admin.layouts.main')
@section('title', 'Sửa thông tin nhân viên')
@section('content')

<div class="card">
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row m-2">
            <div class="col">
                <div class="form-group">
                    <label for="">Tên người dùng</label>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Ảnh đại diện</label>
                    <input type="file" name="avatar" value="{{$user->avatar}}" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Quyền truy cập admin</label>
                    <div class="form-check mx-2">
                        <input class="form-check-input radio-color" value="1" @if($user->id_role == 1) checked @endif type="radio" name="id_role"
                            id="flexRadioDefault1" autocompleted="">
                        <label class="form-check-label" for="flexRadioDefault1"> Có
                        </label>
                    </div>
                    <div class="form-check mx-2">
                        <input class="form-check-input radio-color" value="0" @if($user->id_role == 0) checked @endif type="radio" name="id_role"
                            id="flexRadioDefault1" autocompleted="">
                        <label class="form-check-label" for="flexRadioDefault1"> Không
                        </label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="number" name="phone" value="{{$user->phone}}" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Địa chỉ</label>
                    <input type="text" name="address" value="{{$user->address}}" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <input type="text" name="description" value="{{$user->description}}" class="form-control"
                        placeholder="">
                </div>

                <div class="form-group">
                    <label for="">Vai trò</label>
                    <select name="role_id[]" class="form-control js-select2" multiple>
                        @foreach($roles as $role)
                        @if($role->id != 1)
                        <option value="{{$role->id}}" {{$rolesOfUser->contains('id',$role->id) ? 'selected' : ''}}>
                            {{$role->name}}
                        </option>
                        @endif
                        @endforeach
                    </select>


                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-end mb-2 pr-3">
            <br>
            <a href="{{route('user.index')}}" class="btn btn-danger">Hủy</a>
            &nbsp;
            <button type="submit" class="btn btn-success">Lưu</button>
        </div>
    </form>

</div>

@endsection