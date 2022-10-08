@extends('admin.layouts.main')
@section('title', 'Thống kê đơn hàng')
@section('content')
    <h3>Tìm kiếm</h3>
    <form action="" method="get">

        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="">Bắt đầu</label>
                    <input type="text" id="datepicker" name="ngay-bd" placeholder="yyyy-mm-dd" class="form-control">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="">Kết thúc</label>
                    <input type="text" id="datepicker2" name="ngay-kt" placeholder="yyyy-mm-dd" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </div>

    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-2">Tên khách hàng</th>
                <th class="col-2">tổng số lần đặt hàng</th>
                <th class="col-3">số lần đặt hàng thành công</th>
                <th class="col-3">số lần hủy đơn</th>
                <th class="col-3">Thành tiền</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($doanhthu as $item)
                <tr>
                    <th>
                        {{ $item->id}}
                    </th>
                    {{-- <th>{{ $item->qty }} </th> --}}
                    <th>
                        {{-- {{ array_sum(array_column($item->nhaphangsanpham->toArray(), 'qty')) }} --}}

                    </th>


                </tr>
            @endforeach

            {{-- @foreach ($a as $item => $value)
                <tr>
                    <td>{{ $item + 1 }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
    <div id="myfirstchart" style="height: 250px;"></div>

    {{-- <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-4">Tháng</th>
                <th class="col-4">Số lượng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($a as $item => $value)
                <tr>
                    <td>{{ $item + 1 }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}


@endsection
@section('page-script')
    <script>
        // <?php
        // echo "var data ='$product';";
        // ?>
        // console.log(data[0]['name']);
        new Morris.Bar({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: data['name','qty'],
            // The name of the data record attribute that contains x-values.
            xkey: ['name','qty'],
            // A list of names of data record attributes that contain y-values.
            ykeys: ['name'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value']
        });
    </script>
@endsection
