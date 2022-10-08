@extends('admin.layouts.main')
@section('title', 'Thống kê sản phẩm')
@section('content')
    <form action="" method="get">

        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="">Bắt đầu</label>
                    <input type="text" id="" name="ngay-bd" placeholder="yyyy-mm-dd"
                        value="{{ $request->get('ngay-bd') }}" class="form-control">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="">Kết thúc</label>
                    <input type="text" id="" name="ngay-kt" placeholder="yyyy-mm-dd"
                        value="{{ $request->get('ngay-kt') }}" class="form-control">
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
                <th class="col-2">Sản phẩm</th>
                <th class="col-2">Tổng số lượng</th>
                <th class="col-2">Số lượng đã nhập</th>
                <th class="col-2">Số lượng đã bán</th>
                <th class="col-2">Tổng tiền nhập</th>
                <th class="col-2">Tổng tiền bán</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                <tr>
                    <th>
                        {{ $item->name }}
                    </th>
                    <th>{{ $item->qty }} </th>

                    <th class="product_imports">
                        {{ array_sum(array_column($item->nhaphangsanpham->toArray(), 'qty')) }}
                    </th>
                    <th class="products_sold">{{ array_sum(array_column($item->bill->toArray(), 'qty')) }}</th>
                    </th>
                    <th class="import_money">
                        {{ array_sum(array_column($item->nhaphangsanpham->toArray(), 'qty')) * $item->import_price }}</th>
                    <th class="money_sold">
                        {{ array_sum(array_column($item->nhaphangsanpham->toArray(), 'qty')) * $item->price }}</th>

                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>Tổng</td>
                <td>{{ $sum_product }}</td>
                <td class="result_product_imports"></td>
                <td class="result_products_sold"></td>
                <td class="result_import_money"></td>
                <td class="result_money_sold"></td>
            </tr>
        </tfoot>
    </table>
    {{-- {{ $products->links() }} --}}

    <div class="mt-5">
        <h4>Sản phẩm nhập</h4>
        <table class="table table-bordered table-hover text-center ">
            <thead>
                <tr>
                    <th class="col-2">Ngày nhập</th>
                    <th class="col-2">Sản phẩm</th>
                    <th class="col-2">Số lượng</th>
                    <th class="col-2">Giá nhập</th>
                    <th class="col-2">Tổng</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($nhapSanPham as $item)
                    <tr>
                        <th>
                            {{ date('Y-m-d', strtotime($item->created_at)) }}
                        </th>
                        <th class="product_imports1">{{ $item->importProduct->name }} </th>
                        <th class="products_sold1">{{ $item->qty }}</th>
                        <th class="import_money1">{{ $item->importProduct->import_price }}</th>
                        <th class="money_sold1">{{ $item->qty * $item->importProduct->import_price }}</th>

                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Tổng</td>
                    <td class="">{{ count($nhapSanPham->toArray()) }}</td>
                    <td class="result_products_sold1"></td>
                    <td class="result_import_money1"></td>
                    <td class="result_money_sold1"></td>
                </tr>
            </tfoot>
        </table>


    </div>

    <div class="mt-5">
        <h4>Sản phẩm bán</h4>
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th class="col-2">Ngày bán</th>
                    <th class="col-2">Sản phẩm</th>
                    <th class="col-2">Số lượng</th>
                    <th class="col-2">Giá bán</th>
                    <th class="col-2">Tổng</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($billDetail as $item)
                    <tr>
                        <th>
                            {{ date('Y-m-d', strtotime($item->created_at)) }}
                        </th>
                        <th>{{ $item->product_name }} </th>
                        <th>{{ $item->qty }}</th>
                        <th>{{ $item->price }}</th>
                        <th class="total_price">{{ $item->qty * $item->price }}</th>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Tổng</td>
                    <td class="">{{ count($billDetail->toArray()), 'product_name' }}</td>
                    <td class="">{{ array_sum(array_column($billDetail->toArray(), 'qty')) }}</td>
                    <td class="">{{ array_sum(array_column($billDetail->toArray(), 'price')) }}</td>
                    <td class="result_total_price"></td>
                </tr>
            </tfoot>
        </table>


    </div>

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
                    new Morris.Bar({
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

        let product_imports = 0;
        let products_sold = 0;
        let import_money = 0;
        let money_sold = 0;
        $(".product_imports").each(function() {
            product_imports += parseInt($(this).text())
        })
        $(".products_sold").each(function() {
            products_sold += parseInt($(this).text())
        })
        $(".import_money").each(function() {
            import_money += parseInt($(this).text())
        })
        $(".money_sold").each(function() {
            money_sold += parseInt($(this).text())
        })
        $(".result_product_imports").text(product_imports)
        $(".result_products_sold").text(products_sold)
        $(".result_import_money").text(import_money)
        $(".result_money_sold").text(money_sold)


        let product_imports1 = 0;
        let products_sold1 = 0;
        let import_money1 = 0;
        let money_sold1 = 0;
        $(".product_imports1").each(function() {
            product_imports1 += parseInt($(this).text())
        })
        $(".products_sold1").each(function() {
            products_sold1 += parseInt($(this).text())
        })
        $(".import_money1").each(function() {
            import_money1 += parseInt($(this).text())
        })
        $(".money_sold1").each(function() {
            money_sold1 += parseInt($(this).text())
        })
        $(".result_product_imports1").text(product_imports1)
        $(".result_products_sold1").text(products_sold1)
        $(".result_import_money1").text(import_money1)
        $(".result_money_sold1").text(money_sold1)

        let total_price = 0;
        $(".total_price").each(function() {
            total_price += parseInt($(this).text())
        })
        $(".result_total_price").text(total_price)
    </script>
@endsection
