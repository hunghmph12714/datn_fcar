@extends('admin.layouts.main')
@section('title', 'Thuộc tính')
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
                    <thead>
                        <th>STT</th>
                        <th>Tên thuộc tính</th>
                        <th>
                            {{-- @can('add-category') --}}
                            <a class="btn btn-info" href="{{route('category_component.add')}}">Thêm</a>
                            {{-- @endcan --}}
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($CategoriesComponent as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name_category }}</td>
                            <td>
                                @can('edit-category')
                                <a href="{{ route('category_component.edit', ['id' => $item->id]) }}"
                                    class="btn btn-sm btn-warning">Sửa</a>
                                @endcan
                                @can('delete-category')
                                {{-- <a href="{{ route('category_component.remove', ['id' => $item->id]) }}"
                                    onclick="return confirm('Bạn có chắc muốn xóa')"
                                    class="btn btn-sm btn-danger">Xóa</a> --}}
                                    <button data-toggle="modal" data-target="#exampleModalCenter{{ $item->id }}"
                                        class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                @endcan

                            </td>
                        </tr>
                        <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter{{ $item->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Xóa?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc chắn muốn xóa không?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                    <a href="{{ route('category_component.remove', $item->id) }}" class="btn btn-danger">Xóa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="d-flex justify-content-center">
                    {{$Categories->links()}}
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection