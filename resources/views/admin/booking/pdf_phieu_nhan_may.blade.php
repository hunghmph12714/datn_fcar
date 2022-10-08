<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Phiếu nhận máy</title>
</head>

<body>
    <div>
        <h2 style="text-align: center">Gara ô tô FCar</h2>
        <h3 style="text-align: center">Địa chỉ: Số 1 Trịnh Văn Bô, Nam Từ Liêm, Hà Nội</h3>
        <p style="text-align: right"><i>Hotline:</i> 0399958700</p>
        <h2 style="text-align: center">GIẤY HẸN</h2>
        <p style="text-align: center"><i>Mã phiếu: <b>{{ $booking_detail->code }}</b></i></p>
        <div style="font-size: 20px">
            {{-- <b>Họ và tên: </b><span>{{ $booking_detail->full_name }}</span> --}}

            <b>Họ tên khách hàng:</b> {{$booking_detail->booking->full_name}} <br><br>
            <b>Số điện thoại:</b> {{$booking_detail->booking->phone}} <br>
            {{-- Địa chỉ{{ $booking_detail->booking->address }} --}}
            <br>
            <div style="display: inline-block;">
                <div><b>Tên máy:</b> {{ $booking_detail->name_car }} </div><br>
                <div><span><b style="padding-left: 50px">Hãng
                            máy:</b>
                        {{
                        $booking_detail->carCompany->company_name}}</span></div>
            </div>
            <br><b>Ngày đặt:</b>{{ ' '.
            $booking_detail->created_at
            }}
            <br><br>
            <b>Tình trạng máy:</b> {!! $booking_detail->comment !!}
        </div><br><br>

        <div style="display:flex ; margin-bottom: 40px;font-size: 20px">

            <b>Ngày đến lấy:
            </b> <span style="text-align: center">Ngày.....tháng.....năm 20.....</span>
        </div>
    </div>
    <table style="text-align: center;width: 100%">
        <tr>
            <td>
                <div>

                    <h4><b>NHÂN VIÊN NHẬN MÁY</b></h4>

                </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <div>
                    <h4>KHÁCH HÀNG</h4>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div>

                    <h4><b>{{ Auth::user()->name }}</b></h4>

                </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <div>
                    <h4></h4>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>