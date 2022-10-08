@extends('admin.layouts.main')
@section('content')
<div class="table-responsive " style="background-color: white">
    <h3 class="text-center">DANH SÁCH ĐẶT LỊCH</h3>


    <form action="" class="row ml-3">

        {{-- <div class="form-group ">
            <input type="text" class="form-control" @if (!empty($_GET['key_search'])) value="{{ $_GET['key_search'] }}"
                @endif name="key_search" id="" placeholder="Số diện thoại...">
        </div>
        <div class="form-group">

            <select class="form-control" name="status" id="">
                <option value="c">Tất cả</option>

                <option @if (isset($_GET['status'])&& !empty($_GET['status']=='received' )) selected @endif
                    value="received">
                    Chưa xác nhận
                </option>
                <option @if (!empty($_GET['status']=='latch' ) && !empty($_GET['status']=='latch' )) selected @endif
                    value="latch">Xác nhận</option>
                <option @if (!empty($_GET['status']=='cancel' ) && !empty($_GET['status']=='cancel' )) selected @endif
                    value="cancel">Hủy bỏ</option>
            </select>
        </div> --}}
        <div>
            <button type="submit" class="btn btn-primary">Tất cả</button>
            <button type="submit" name="status" value="received" class="btn btn-primary">Chưa xác nhận</button>
            <button type="submit" name="status" value="latch" class="btn btn-primary">Đã xác nhận</button>
            <button type="submit" name="status" value="cancel" class="btn btn-primary">Hủy bỏ</button>
        </div>
    </form>
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="name">STT</th>
                <th scope="col" class="sort" data-sort="name">Tên máy</th>
                <th scope="col" class="sort" data-sort="budget">Tên khách hàng</th>
                <th scope="col" class="sort" data-sort="status">Số điện thoại</th>
                <th scope="col">Thời gian</th>
                <th scope="col">Trạng thái</th>
                <th scope="col" class="sort" data-sort="completion">Sửa thông tin</th>
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
                <td>{{ $b->booking->date }}</td>
                {{-- <td>@if ($b->repair_type=='TN')
                    {{ 'Tại nhà' }}
                    @else
                    {{ 'Đem đến cửa hàng' }}
                    @endif</td> --}}
                <td>
                    {{-- @if ($b->active==0)
                    {{ 'Chưa sửa' }}
                    @elseif($b->active==2)
                    {{ 'Tạm dừng' }}
                    @elseif($b->active== 3)
                    {{ 'Đã hoàn thành' }}
                    @elseif($b->active==1 )
                    {{ 'Đang sửa' }}
                    @endif --}}

                    <div class="form-group d-flex" width="50px">
                        {{-- <label for=""></label> --}}
                        <form action="{{ route('dat-lich.chuyen-trang-thai') }}" method="POST" class="d-flex">
                            @csrf
                            <select class="form-control" name="status_booking" id="">
                                <option @if ($b->status_booking=='received')selected
                                    @endif value="received">Chưa xác nhận</option>
                                <option @if ($b->status_booking=='latch')selected
                                    @endif value="latch">Xác nhận</option>
                                <option @if ($b->status_booking=='cancel')selected
                                    @endif value="cancel">Hủy bỏ</option>

                            </select>
                            <input type="hidden" name="booking_detail_id" value="{{ $b->id }}">

                            <button class="btn btn-primary" type="submit">Chọn</button>

                        </form>
                    </div>


                </td>
                {{-- <td>
                    <div class="form-group d-flex" width="50px">
                        <form action="" method="POST" class="d-flex">
                            @csrf
                            <select id="" @if ($b->active==0||$b->active==3||$b->active==4)
                                disabled

                                @endif class="form-control" name="staff">
                                <option value="0">Chưa chọn</option>
                                @foreach ($users as $u)
                                <option @if ($b->user_repair !=null )
                                    @if ($u->id == $b->user_repair->user_id)
                                    selected
                                    @endif

                                    @endif value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select><input type="hidden" name="booking_detail_id" value="{{ $b->id }}">
                            <button @if ($b->active==0||$b->active==3||$b->active==4)
                                disabled

                                @endif class="btn btn-primary" type="submit">Chọn</button>
                        </form>
                    </div>
                </td> --}}
                <td class="mx-auto">
                    {{-- @if ($b->active==1||$b->active==2)
                    <a name="" id="" class="btn btn-success" href="{{ route('suachua.get', ['id'=>$b->id]) }}"
                        role="button">Sửa chữa</a>
                    @endif --}}
                    @can('edit-booking')
                    <a name="" id="" class="btn btn-primary" href="{{ route('dat-lich.chi-tiet', ['id'=>$b->id]) }}"
                        role="button">Chi tiết</a>
                    <a name="" id="" class="btn btn-info" @if ($b->status_booking!='latch')
                        style="display: none"
                        @endif
                        href="{{ route('dat-lich.tiep-nhan-may', ['booking_detail_id'=>$b->id]) }}" role="button">Tiếp
                        nhận máy</a>
                    @endcan
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