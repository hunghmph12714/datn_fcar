@extends('admin.layouts.main')
@section('title', 'Thống kê doanh thu')
@section('content')
    <form action="" method="get">

        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="">Bắt đầu</label>
                    <input type="text" id="" name="ngay-bd" placeholder="yyyy-mm-dd" {{-- value="{{ $request->get('ngay-bd') }}" --}}
                        class="form-control">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="">Kết thúc</label>
                    <input type="text" id="" name="ngay-kt" placeholder="yyyy-mm-dd" {{-- value="{{ $request->get('ngay-kt') }}" --}}
                        class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                <a href="{{ route('thongke-sanpham') }}" class="btn btn-default">Reset</a>
            </div>
        </div>

    </form>
    <table class=" table table-bordered table-hover text-center mt-3">
        <thead>
            <tr>
                <th class="col-1">Sản phẩm</th>
                <th class="col-1">Tổng số lượng đã bán</th>
                <th class="col-2">Tiền nhập</th>
                <th class="col-2">Tiền bán</th>
                <th class="col-2">Tổng tiền nhập</th>
                <th class="col-2">Tổng tiền bán</th>
                <th class="col-2">Lợi nhuận</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($doanhthu as $item)
                <tr>
                    <th>
                        {{ $item->name }}
                    </th>
                    <th class="product_qty">{{ $item->total_qty }} </th>
                    <th class="products_import">{{ $item->import_price }} </th>
                    <th class="products_price">{{ $item->price }} </th>
                    <th class="products_money_import">{{ $item->total_qty * $item->import_price }}</th>
                    <th class="products_money_price">{{ $item->total_qty * $item->price }} </th>
                    <th class="total_sales">
                        {{ $item->total_qty * $item->price - $item->total_qty * $item->import_price }}
                    </th>

                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>Tổng</td>
                <td class="result_product_qty"></td>
                <td class="result_products_import"></td>
                <td class="result_products_price"></td>
                <td class="result_products_money_import"></td>
                <td class="result_products_money_price"></td>
                <td class="result_total_sales"></td>

            </tr>
        </tfoot>
    </table>
    {{-- {{ $products->links() }} --}}



    <div id="myfirstchart" style="height: 250px;width:400px"></div>

@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                data: {
                    start_date: $("input[name='ngay-bd']").val(),
                    end_date: $("input[name='ngay-kt']").val()
                },
                url: "/admin/thongke/ajax",
                success: function(data) {

                    new Morris.Area({
                        // ID of the element in which to draw the chart.
                        element: 'myfirstchart',
                        // Chart data records -- each entry in this array corresponds to a point on
                        // the chart.
                        data: data,
                        // The name of the data record attribute that contains x-values.
                        xkey: 'time',
                        // A list of names of data record attributes that contain y-values.
                        ykeys: ['value'],
                        // Labels for the ykeys -- will be displayed when you hover over the
                        // chart.
                        labels: ['Value']
                    });
                    console.log(data);
                }
            });
            return false;
        });

        let product_qty = 0;
        let products_import = 0;
        let products_price = 0;
        let products_money_import = 0;
        let products_money_price = 0;
        let total_sales = 0;

        $(".product_qty").each(function() {
            product_qty += parseInt($(this).text())
        })
        $(".products_import").each(function() {
            products_import += parseInt($(this).text())
        })
        $(".products_price").each(function() {
            products_price += parseInt($(this).text())
        })
        $(".products_money_import").each(function() {
            products_money_import += parseInt($(this).text())
        })
        $(".products_money_price").each(function() {
            products_money_price += parseInt($(this).text())
        })
        $(".total_sales").each(function() {
            total_sales += parseInt($(this).text())
        })
        $(".result_product_qty").text(product_qty)
        $(".result_products_import").text(products_import)
        $(".result_products_price").text(products_price)
        $(".result_products_money_import").text(products_money_import)
        $(".result_products_money_price").text(products_money_price)
        $(".result_total_sales").text(total_sales)
    </script>
@endsection
