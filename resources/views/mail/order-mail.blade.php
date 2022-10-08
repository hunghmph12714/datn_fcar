<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border: black solid 1px;
        }
    </style>
</head>

<body>
    <p>hi {{ $details['name'] }} </p>
    <p>Bạn đã đặt hàng thành công tại webiste Laptop51 !</p>
    {{-- <p>Vui lòng truy cập <a href="{{ route('history') }}"> Laptop 51</a> để xem thêm thông tin</p> --}}

    <table border="1" class="table table-stripped">
        <thead>
            <tr>
                <th class="col-2">Tên</th>
                <th class="col-2">Thư</th>
                <th class="col-2">Sản phẩm</th>
                <th class="col-2">Thời gian</th>
                <th class="col-4">Mô tả</th>
                <th class="col-2">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $details['name'] }}</td>
                <td>{{ $details['email'] }}</td>
                <td>{{ $details['computer'] }}</td>
                <td>{{ $details['interval'] }}</td>
                <td>{!! $details['desc'] !!}</td>
                <td>{{ $details['status'] }}</td>
            </tr>
        </tbody>
    </table>
    <p>Bạn vui lòng đem máy đến của hàng để đúng thời gian</p>
    Địa chỉ: Số 1, Trịnh Văn Bô, Nam Từ Liêm, Hà Nội
    <p>Số điện thoại: 0399958700</p>
</body>

</html>