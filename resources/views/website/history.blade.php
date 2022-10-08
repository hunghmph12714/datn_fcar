@extends('admin.layouts.main')
@section('title', 'Lịch sử')
@section('content')


    <div class="row text-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>STT</th>
                            <th>Mã hóa đơn</th>
                            <th>Tổng tiền</th>
                            <th>Ngày mua hàng</th>
                        </thead>
                        <tbody>
                            @foreach ($bill as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->bill_code }}</td>
                                    <td>{{$item->total}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td><a href="{{route('profile.history.detail',['code'=>$item->bill_code])}}" class="btn btn-info">Chi tiết</a></td>
                                    <td></td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="d-flex justify-content-center">
                        {{$bill->links()}}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
