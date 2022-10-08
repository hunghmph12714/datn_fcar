@extends('admin.layouts.main')
@section('title', 'Sửa vai trò')
@section('content')

<script>
$(function() {
    $('.checkbox_wrapper').on('click', function() {
        $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
    });

    $('.checkall').on('click', function() {
        $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
        $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));

    });
});
</script>
<div class="container bg-white">
    <form action="{{route('roles.update', ['id' => $role->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tên vai trò</label>
                    <input type="text" name="name" class="form-control" value="{{$role->name}}" placeholder="">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="display_name" rows="4">{{ $role->display_name }}</textarea>
                </div>
            </div>
            <div class="col-12">
            <label for="">
                <input type="checkbox" class="checkall">
                Checkall
                </label>
                @foreach($permissionsParent as $permissionsParentItem)
                @if(Auth::user()->email == 'admin@gmail.com' || 
                (Auth::user()->email != 'admin@gmail.com' && ($permissionsParentItem->key_code != 'role'))   
                )
                
                <div class="card border-primary mb-3 p-0 col-md-12">
                    <div class="card-header py-0">
                        <label>
                            <input type="checkbox" class="checkbox_wrapper">
                        </label>
                        Module {{$permissionsParentItem->name}}
                    </div>
                    <div class="row">
                        @foreach($permissionsParentItem->permissionChildrent as $permissionChildrentItem)
                        <div class="cart-body text-center col-3 text-alight-center">
                            <h5 class="card-title">
                                <label class="text-center">
                                    <input type="checkbox" name="permission_id[]" {{ $permissionsChecked->contains('id', $permissionChildrentItem->id) ? 'checked' : '' }}
                                    class="checkbox_childrent"
                                      value="{{ $permissionChildrentItem->id }}"  >

                                    {{$permissionChildrentItem->name}}
                                </label>
                            </h5>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        <div class="col-12 d-flex justify-content-end">
            <br>
            <a href="{{route('roles.index')}}" class="btn btn-danger">Hủy</a>
            &nbsp;
            <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>

@endsection