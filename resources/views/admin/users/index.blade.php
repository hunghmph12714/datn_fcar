@extends('admin.layouts.main')
@section('title', 'Danh sách tài khoản')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Họ và Tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Vai trò</th>
                            <th scope="col">
                                @can('add-user')
                                <button type="button" class="btn btn-sm btn-info"><a
                                        style="color:white;  text-decoration: none;"
                                        href="{{route('user.add')}}">Thêm</a></button>
                                @endcan
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td> {{$item->name}} </td>
                            <td> {{$item->email}} </td>
                            <td> {{$item->phone}} </td>
                            <td>
                                @if($item->id_role == 0)
                                <p >Người dùng</p>
                                @else
                                @foreach($item->roles as $role)
                                 <p>{{$role->name}}</p>
                                 @endforeach
                                @endif
                            </td>
                            <td>
                                @if($item->email != 'admin@gmail.com')
                                @can('edit-user')
                                <button type="button" class="btn btn-sm btn-warning"><a
                                        style="color:white;  text-decoration: none;"
                                        href="{{ route('user.edit', ['id'=>$item->id]) }}"> Sửa</a></button>
                                @endcan
                                @if($item->email == 'admin@gmail.com')
                                @can('delete-user')
                                <button type="button" class="btn btn-sm btn-danger"><a
                                        style="color:white;  text-decoration: none;"
                                      
                                        href="{{ route('user.remove', ['id'=>$item->id]) }}"> Xóa</a></button>
                                @endcan
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection