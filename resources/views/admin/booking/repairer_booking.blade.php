@extends('admin.layouts.main')
@section('content')
<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="name">Tên máy</th>
                <th scope="col" class="sort" data-sort="budget">Tên khách hàng</th>
                <th scope="col" class="sort" data-sort="status">SDT</th>
                {{-- <th scope="col">Hình thức sửa</th>
                <th scope="col">Trạng thái</th> --}}
                <th scope="col" class="sort" data-sort="completion">Nhân viên</th>
                @can('add-booking')
                <th scope="col"><a href="{{ route('dat-lich.add') }}">Tạo mới</a></th>
                @endcan
            </tr>
        </thead>
        <tbody class="list">



            @foreach ($booking_details as $b)
            <tr>
                <td>{{ $b->name_car }}</td>
                <td>@if (!empty($b->booking->full_name))
                    {{ $b->booking->full_name }}

                    @endif</td>
                {{-- <td>{{ $b->booking->phone }}</td> --}}
                <td>@if ($b->repair_type=='TN')
                    {{ 'Tại nhà' }}
                    @else
                    {{ 'Đem đến cửa hàng' }}
                    @endif</td>
                {{-- <td>


                    <div class="form-group d-flex" width="50px">
                        <form action="" method="POST" class="d-flex">
                            @csrf
                            <select class="form-control" name="active" id="">

                                <option @if ($b->active==1) selected @endif value="1">Chưa sửa</option>
                                <option @if ($b->active==2) selected @endif value="2">Đang sửa</option>
                                <option @if ($b->active==3) selected @endif value="3">Đã hoàn thành</option>
                                <option @if ($b->active==4) selected @endif value="4">Đã trả khách</option>
                            </select>
                            <input type="hidden" name="booking_detail_id" value="{{ $b->id }}">
                            <button class="btn btn-primary" type="submit">Chọn</button>
                        </form>
                    </div>


                </td> --}}
                {{-- <td>
                    <div class="form-group d-flex" width="50px">
                        <form action="" method="POST" class="d-flex">
                            @csrf
                            <select class="form-control" name="staff" id="">
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
                </td> --}}
                <td class="mx-auto">
                    @if ($b->active==1||$b->active==2)
                    @can('edit-repair')
                    <a name="" id="" class="btn btn-success" href="{{ route('suachua.get', ['id'=>$b->id]) }}"
                        role="button">Sửa chữa</a>
                    @endcan
                    @endif

                    {{-- <a name="" id="" class="btn btn-primary" href="{{ route('dat-lich.edit', ['id'=>$b->id]) }}"
                        role="button">Sửa thông tin</a> --}}
                    <a name="" id="" class="btn btn-info" href="{{ route('dat-lich.hoa-don', ['id'=>$b->id]) }}"
                        role="button">Chi tiết sửa chữa</a>
                    {{-- <a name="" id="" class="btn btn-danger"
                        href="{{ route('dat-lich.deleteBookingDetail', ['id'=>$b->id]) }}" role="button">Xóa</a> --}}
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection