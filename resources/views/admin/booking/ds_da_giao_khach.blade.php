@extends('admin.layouts.main')
@section('content')
<div class="table-responsive " style="background-color: white">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="name">Tên máy</th>
                <th scope="col" class="sort" data-sort="budget">Tên khách hàng</th>
                <th scope="col" class="sort" data-sort="status">SDT</th>
                <th scope="col">Hình thức sửa</th>
                <th scope="col">Trạng thái</th>
                <th scope="col" class="sort" data-sort="completion">Nhân viên</th>
                <th scope="col"><a href="{{ route('dat-lich.add') }}">Tạo mới</a></th>
            </tr>
        </thead>
        <tbody class="list">



            @foreach ($booking_details as $b)
            <tr>
                <td>{{ $b->name_car }}</td>
                <td>@if (!empty($b->booking->full_name))
                    {{ $b->booking->full_name }}

                    @endif</td>
                <td>{{ $b->booking->phone }}</td>
                <td>@if ($b->repair_type=='TN')
                    {{ 'Tại nhà' }}
                    @else
                    {{ 'Đem đến cửa hàng' }}
                    @endif</td>


                <td class="mx-auto">



                    <a name="" id="" class="btn btn-info" href="{{ route('dat-lich.hoa-don', ['id'=>$b->id]) }}"
                        role="button">Chi tiết
                        sửa
                        chữa</a>
                    {{-- <a name="" id="" class="btn btn-danger"
                        href="{{ route('dat-lich.deleteBookingDetail', ['id'=>$b->id]) }}" role="button">Xóa</a> --}}
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>{{ $booking_details->links() }}
</div>
@endsection