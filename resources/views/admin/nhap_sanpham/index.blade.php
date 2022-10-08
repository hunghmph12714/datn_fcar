@extends('admin.layouts.main')
@section('title', 'Thông tin nhập hàng sản phẩm')
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

    <div class="row text-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>
                                <a class="btn btn-info" href="{{route('nhap-sanpham.add')}}">Add new</a>
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($nhap_sanpham as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{$item->qty}}</td>
                                    {{-- <td>
                                        <a href="{{ route('category.edit', ['id' => $item->id]) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('category.remove', ['id' => $item->id]) }}"
                                            onclick="return confirm('Bạn có chắc muốn xóa')"
                                            class="btn btn-sm btn-danger">Remove</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{$nhap_sanpham->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
