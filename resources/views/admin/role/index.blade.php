@extends('admin.layouts.main')
@section('title', 'Danh sách vai trò')
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên vai trò</th>
                            <th scope="col">Mô tả vai trò</th>
                            <th scope="col">
                                <button type="button" class="btn btn-sm btn-info"><a
                                        style="color:white;  text-decoration: none;"
                                        href="{{route('roles.create')}}">Thêm
                                        vai trò</a></button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <th scope="row"> {{$role->id}}</th>
                            <td> {{$role->name}} </td>
                            <td> {{$role->display_name}} </td>
                            <td>
                                @foreach(Auth::user()->roles as $user_role)
                                @if($user_role->email == 'admin@gmail.com' || ($user_role->email != 'admin@gmail.com' &&
                                $role->id != 1))
                                <button type="button" class="btn btn-sm btn-warning"><a
                                        style="color:white;  text-decoration: none;"
                                        href="{{route('roles.edit',['id' => $role->id])}}"> Sửa</a></button>
                                <button type="button" class="btn btn-sm btn-danger"><a
                                        href="{{ route('roles.remove', ['id' => $role->id]) }}"
                                        style="color:white;  text-decoration: none;" href=""> Xóa</a></button>
                                @endif
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-12">
                    {{$roles->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection