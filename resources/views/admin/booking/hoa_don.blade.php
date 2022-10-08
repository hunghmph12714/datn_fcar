@extends('admin.layouts.main')
@section('content')
{{-- <button>Xuất hóa đơn</button>
--}}




<div class="container" style="background-color: white">
    @can('list-booking')

    @if ($booking_detail->list_bill)
    <a name="" id="" class="btn btn-primary" target="_blank"
        href="{{ route('dat-lich.xuat-hoa-don', ['booking_detail_id'=>$booking_detail->id]) }}" role="button"> Xuất hóa
        đơn</a>
    @endif
    @endcan

    <h4 class="text-center"><b>HÓA ĐƠN SỬA CHỮA</b></h4>
    <div class="row">
        <p class="col-3"><b>Họ và tên:</b> {{ $booking_detail->booking->full_name }}</p>
        <p class="col-3"><b>Số điện thoại: </b> {{ $booking_detail->booking->phone }}</p>
    </div>
    {{-- <p><b>Họ và tên:</b> {{ $booking_detail->booking->full_name }}</p> --}}
    <div class="row">
        <p class="col-3"> <b> Tên máy: </b>{{ $booking_detail->name_car }}</p>
        <p class="col-3"> <b> Kiểu máy: </b>{{ $booking_detail->carCompany->company_name }}</p>
    </div><br>

    {{-- <p>Số điện thoại: {{ $booking_detail->booking->phone }}</p> --}}
    <h5><b>Danh sách linh kiện sủa chữa và thay thế</b></h5>

    <table class="table">
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
                <td>{{ $p->name_product }}</td>
                <td>{{number_format( $p->unit_price,0, ',', '.' ) }}</td>
                <td>{{ $p->quantity }}</td>
                <td class="tt">{{ number_format( $p->into_money,0, ',', '.' )}}</td>
                <td> </td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <th colspan="3">Tổng</th>
                <th id="tong"> {{ number_format( array_sum(array_column($repair_parts->toArray(),'into_money')),0, ',',
                    '.' ) }} VND</th>
            </tr>
            {{-- <tr>
                <td></td>
                <th colspan="3">Số tiền khách trả</th>
                <th id="tong">
                    <div class="form-group">
                        <form action="" method="POST" id="form_tien_khach_tra">
                            @csrf
                            <input type="number" onchange="tinhTien()" value="@if (!empty($list_bill->customers_pay))
                                        {{ $list_bill->customers_pay }}
                                    @endif" class="form-control col-4" name="customers_pay" id=""
                                aria-describedby="helpId" placeholder=" VND">
                        </form>
                    </div>
                </th>
            </tr> --}}
            {{-- <tr>
                <td></td>
                <th colspan="3">Tiền thừa</th>
                <th id="tien_thua"> </th>
            <tr> --}}

        </tbody>
    </table>
    @can('list-booking')
    <button form="form_tien_khach_tra" type="submit" class="btn btn-success">Lưu Hóa Đơn</button>
    @endcan
</div>

{{-- <script>
    tt=document.getElementsByClassName('tt')
    tong=document.getElementById('tong')
// Array(tt).map(function(a){
//     console.log(a.innerHTML);
// })
sum=0
for(i=0;i<tt.length;i++){
    // console.log(tt[i]);
    sum=sum+Number(tt[i].innerHTML);
}
tong.innerHTML=sum;

function tinhTien(){
        customers_pay=document.getElementsByName("customers_pay");
        tien_thua=document.getElementById('tien_thua')
        tong=document.getElementById('tong')

        
        tien_thua.innerHTML=customers_pay[0].value-tong.innerHTML
        // console.log(customers_pay[0].va);

}
</script> --}}

@endsection