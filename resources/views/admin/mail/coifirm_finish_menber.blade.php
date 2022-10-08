Xin chào {{ $booking_detail->booking->full_name }} <br><br>
Máy của bạn đã sửa xong vui lòng thu xếp thời gian đến của hàng nhận máy <br>
Thông tin hóa đơn <br>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script> --}}
    <style>
        table {
            border-collapse: collapse;
            width: 660px;

        }

        .nguoi {
            display: flex;
            justify-content: center
        }

        .chu_ky {
            margin-top: 30px;
            text-align: center;
        }

        /* .chu_ky td {
            justify-items: end;
            height: 100px;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
        } */
    </style>
</head>

<body style="max-width: 1024px;">
    <div>
        <h2 style="text-align: center">CỬA HÀNG LAPTOP51</h2>
        <h3 style="text-align: center">Địa chỉ: Số 1 Trịnh Văn Bô, Nam Từ Liêm, Hà Nội</h3>
        <p style="text-align: right"><i>Hotline:</i> 0399958700</p>
        {{-- <h2 style="text-align: center">GIẤY HẸN</h2> --}}
        <h4 style="text-align: center">HÓA ĐƠN SỬA CHỮA</h4>
        <p style="text-align: center"><i>Mã hóa đơn: <b>{{ $booking_detail->code }}</b></i></p>
        {{-- <h5 class="text-center"><i>Số hóa đơn: <b>{{ $booking_detail->code }}</b></i></h5><br> --}}
        <div class="row" style="">
            <p class="col-3"><b>Họ và tên:</b> {{ $booking_detail->booking->full_name }}</p>
            <p class="col-3"><b>Số điện thoại: </b> {{ $booking_detail->booking->phone }}</p>
            {{--
        </div>
        <div class="row"> --}}
            <p class="col-3"> <b> Tên máy: </b>{{ $booking_detail->name_computer }}</p>
            <p class="col-3"> <b> Kiểu máy: </b>{{ $booking_detail->computerCompany->company_name }}</p>
        </div>
        {{-- <p>Hãng máy: {{ $booking_detail->computerCompany->company_name }}</p> --}}

        <h5>DANH SÁCH SỬA CHỮA VÀ THAY THẾ</h5>

        <table class="table" border="1" draggable="false" style="border: red solid 1px">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên linh kiện</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($repair_parts as $key=>$p)
                <tr>
                    <td scope="row">{{ $key +1}}</td>
                    <td>{{$p->name_product }}</td>
                    <td>{{currency_format( $p->unit_price )}}</td>
                    <td>{{ $p->quantity }}</td>
                    <td>{{ currency_format($p->into_money )}}</td>
                    <td></td>
                </tr>
                @endforeach
                <tr>
                    <th colspan='4'>TỔNG</th>
                    <th colspan="" class="tong-tien">{{
                        currency_format(array_sum(array_column($repair_parts->toArray(),'into_money')) )}}</th>
                    <td></td>
                </tr>
                {{-- <tr>
                    <th colspan='4'>Khách trả</th>
                    <th colspan="" class="tong-tien">{{ $booking_detail_bill->customers_pay }}</th>
                    <td></td>
                </tr>
                <tr>
                    <th colspan='4'>Tiền thừa</th>
                    <th colspan="" class="tong-tien">{{ $booking_detail_bill->excess_cash }}</th>
                    <td></td>
                </tr> --}}
            </tbody>

        </table>

        {{-- Mô tả sửa chữa: {{ $data }} --}}
        <p style="font-size: 13px">Xin cám ơn quý khách đã sử dụng dịch vụ sửa chữa của chúng tôi. Nếu có bất cứ thắc
            mắc hay vấn đề gì xin quý
            khách vui lòng liên hệ <i>SDT: 0399958700</i> </p>



    </div>
    {{-- <table class="chu_ky">

        <tr>
            <td>
                <h5>Người xuất</h5>
            </td>
            <td>
                <h5>Người nhận</h5>
            </td>
        </tr>
        <tr>
            <td>@if (Auth::check())
                {{ Auth::user()->name }}
                @endif</td>
        </tr>
    </table> --}}

    <div class="nguoi" style="*">
        <div>


        </div>
        <div>


        </div>
    </div>
</body>

</html>




<br>
Cảm ơn bạn đã tin tưởng Laptop 51!
Kính chúc bạn một ngày tốt lành!