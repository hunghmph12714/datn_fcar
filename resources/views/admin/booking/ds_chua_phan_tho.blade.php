@extends('admin.layouts.main')
@section('content')
<div class="table-responsive " style="background-color: white">
    <h3 class="text-center"><b>DANH SÁCH PHÂN THỢ</b></h3>
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="name">Tên máy</th>
                <th scope="col" class="sort" data-sort="budget">Tên khách hàng</th>
                <th scope="col" class="sort" data-sort="status">Số điện thoại</th>
                {{-- <th scope="col">Hình thức sửa</th> --}}
                {{-- <th scope="col">Trạng thái</th> --}}
                <th scope="col" class="sort" data-sort="completion">Sửa chữa</th>
                {{-- <th scope="col"><a href="{{ route('dat-lich.add') }}">Tạo mới</a></th> --}}
            </tr>
        </thead>
        <tbody class="list">



            @foreach ($booking_details as $b)
            <tr>
                <td><a href="{{ route('dat-lich.chi-tiet', ['id'=>$b->id]) }}">{{ $b->name_car }}</a></td>
                <td>@if (!empty($b->booking->full_name))
                    {{ $b->booking->full_name }}

                    @endif</td>
                <td>{{ $b->booking->phone }}</td>

                <td>
                    <div class="form-group d-flex" width="50px">
                        {{-- <label for=""></label> --}}

                        <form action="{{ route('dat-lich.chuyen-trang-thai') }}" method="POST" class="d-flex">
                            @csrf
                            <select id="" class="form-control" name="staff">
                                <option value="0">Chưa chọn</option>
                                @foreach ($users as $u)
                                {{-- {{ dd($u->id $b->user_repair->id) }} --}}
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
                {{-- <td class="mx-auto">
                    @if ($b->active==1||$b->active==2)
                    <a name="" id="" class="btn btn-success" href="{{ route('suachua.get', ['id'=>$b->id]) }}"
                        role="button">Sửa chữa</a>
                    @endif

                    <a name="" id="" class="btn btn-primary" href="{{ route('dat-lich.edit', ['id'=>$b->id]) }}"
                        role="button">Sửa thông tin</a>
                    <a name="" id="" class="btn btn-info" href="{{ route('dat-lich.hoa-don', ['id'=>$b->id]) }}"
                        role="button">Chi tiết sửa
                        chữa</a>

                </td> --}}
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $booking_details->links() }}
</div>
@endsection