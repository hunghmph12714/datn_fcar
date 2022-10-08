@extends('admin.layouts.main')
@section('content')
<div class="table-responsive " style="background-color: white">
    <h3 class="text-center"><b>DANH SÁCH PHÂN THỢ</b></h3>
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="name">STT</th>
                <th scope="col" class="sort" data-sort="name">Tên máy</th>
                <th scope="col" class="sort" data-sort="budget">Tên khách hàng</th>
                <th scope="col" class="sort" data-sort="status">Số điện thoại</th>
                {{-- <th scope="col">Hình thức sửa</th> --}}
                <th scope="col">Chọn thợ</th>
                <th>Trạng thái</th>
                <th scope="col" class="sort" data-sort="completion">Sửa chữa</th>
                {{-- <th scope="col"><a href="{{ route('dat-lich.add') }}">Tạo mới</a></th> --}}
            </tr>
        </thead>
        <tbody class="list">



            @foreach ($booking_details as $k=>$b)
            <tr>
                <td>{{ $k+1 }}</td>
                <td><a href="{{ route('dat-lich.chi-tiet', ['id'=>$b->id]) }}">{{ $b->name_car }}</a></td>
                <td>@if (!empty($b->booking->full_name))
                    {{ $b->booking->full_name }}

                    @endif</td>
                <td>{{ $b->booking->phone }}</td>

                {{-- <td>


                    <div class="form-group d-flex" width="50px">

                        <form action="{{ route('dat-lich.chuyen-trang-thai') }}" method="POST" class="d-flex">
                            @csrf
                            <select class="form-control" name="status_booking" id="">
                                <option value="received">Chưa xác nhận</option>
                                <option value="latch">Xác nhận</option>
                                <option value="cancel">Hủy bỏ</option>

                            </select>
                            <input type="hidden" name="booking_detail_id" value="{{ $b->id }}">
                            <button class="btn btn-primary" type="submit">Chọn</button>
                        </form>

                    </div>


                </td> --}}
                <td>
                    <div class="form-group d-flex" width="50px">

                        <form action="{{ route('dat-lich.chuyen-trang-thai') }}" method="POST" class="d-flex">
                            @csrf
                            <select id="" class="form-control" name="staff">
                                <option value="0">Chưa chọn</option>
                                @foreach ($users as $u)
                                <option @if ($b->user_repair !=null )
                                    @if ($u->id == $b->user_repair->user_id)
                                    selected
                                    @endif

                                    @endif value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select><input type="hidden" name="booking_detail_id" value="{{ $b->id }}">
                            <button class="btn btn-primary" type="submit">Chọn</button>
                        </form>

                    </div>
                </td>
                <td>

                    @if ($b->status_repair=='fixing')
                    {{ 'đang sửa' }}
                    @else
                    @if ($b->status_repair=='waiting')
                    {{ 'chờ sửa' }}
                    @else
                    {{ 'chưa sửa' }}
                    @endif

                    @endif
                </td>
                <td class="mx-auto">
                    @can('edit-repair')
                    @if ($b->status_repair='waiting')
                    <a name="" id="" class="btn btn-success" href="{{ route('suachua.get', ['id'=>$b->id]) }}"
                        role="button">Sửa chữa</a>
                    @endif
                    @endcan
                    {{-- <a name="" id="" class="btn btn-primary" href="{{ route('dat-lich.edit', ['id'=>$b->id]) }}"
                        role="button">Sửa thông tin</a> --}}
                    {{-- <a name="" id="" class="btn btn-info" href="{{ route('dat-lich.hoa-don', ['id'=>$b->id]) }}"
                        role="button">Chi tiết
                        sửa
                        chữa</a> --}}
                    {{-- <a name="" id="" class="btn btn-danger"
                        href="{{ route('dat-lich.deleteBookingDetail', ['id'=>$b->id]) }}" role="button">Xóa</a> --}}
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $booking_details->links() }}
</div>
@endsection