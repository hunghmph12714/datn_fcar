@extends('admin.layouts.main')
@section('content')
<div class="table-responsive " style="background-color: white">
    <h3 class="text-center"><b>DANH SÁCH ĐÃ SỬA XONG</b></h3>
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                {{-- <th></th> --}}
                <th scope="col" class="sort" data-sort="name">STT</th>
                <th scope="col" class="sort" data-sort="name">Tên máy</th>
                <th scope="col" class="sort" data-sort="budget">Tên khách hàng</th>
                <th scope="col" class="sort" data-sort="status">SDT</th>
                <th scope="col">Nhân viên</th>
                {{-- <th scope="col">Trạng thái</th> --}}
                <th scope="col" class="sort" data-sort="completion">Nhân viên</th>
                @can('add-booking')
                <th scope="col"><a href="{{ route('dat-lich.add') }}">Tạo mới</a></th>
                @endcan
            </tr>
        </thead>
        <tbody class="list">



            @foreach ($booking_details as $b)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('dat-lich.chi-tiet', ['id'=>$b->id]) }}">{{ $b->name_car }}</a></td>
                <td>@if (!empty($b->booking->full_name))
                    {{ $b->booking->full_name }}

                    @endif</td>
                <td>{{ $b->booking->phone }}</td>
                {{-- <td>@if ($b->repair_type=='TN')
                    {{ 'Tại nhà' }}
                    @else
                    {{ 'Đem đến cửa hàng' }}
                    @endif</td> --}}
                <td>{{ $b->users[0]->name }}</td>

                <td class="mx-auto">


                    @can('list-repair')
                    <a name="" id="" class="btn btn-info" href="{{ route('dat-lich.hoa-don', ['id'=>$b->id]) }}"
                        role="button">Chi tiết
                        sửa
                        chữa</a>

                    @endcan

                    @can('list-booking')<a name="" id="" class="btn btn-primary"
                        href="{{ route('dat-lich.send-mail-finish-member', ['booking_detail_id'=>$b->id]) }}"
                        role="button">Gửi mail</a>
                    @endcan
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>{{ $booking_details->appends($_GET)->links() }}
</div>
@endsection