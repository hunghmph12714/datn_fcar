<!DOCTYPE html>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <title>Giỏ hàng</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layout_client.style')
    <style>
    .quantity {
        position: relative;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    .quantity input {
        height: 42px;
        line-height: 1.65;
        float: left;
        display: block;
        padding: 0;
        margin: 0;
        padding-left: 20px;
        border: 1px solid #eee;
    }

    .quantity input:focus {
        outline: 0;
    }

    .quantity-nav {
        float: right;
        position: relative;
        height: 42px;
    }

    .quantity-button {
        position: relative;
        cursor: pointer;
        border-left: 1px solid #eee;
        width: 20px;
        text-align: center;
        color: #333;
        font-size: 13px;
        font-family: "Trebuchet MS", Helvetica, sans-serif !important;
        line-height: 1.7;
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        user-select: none;
    }

    .quantity-button.quantity-up {
        position: absolute;
        height: 50%;
        top: 0;
        border-bottom: 1px solid #eee;
    }

    .quantity-button.quantity-down {
        position: absolute;
        bottom: -1px;
        height: 50%;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('layout_client.menu')
        <!-- Content -->
        <div class="breadcrumbs-section plr-200 mb-80 section">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">Giỏ hàng</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="/">Trang chủ</a></li>
                                    <li>Giỏ hàng</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section id="page-content" class="page-wrapper section">

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2">
                            <ul class="nav cart-tab">
                                <li>
                                    <a class="active">
                                        <span>01</span>
                                        Giỏ hàng
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span>02</span>
                                        Thanh toán
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span>03</span>
                                        Hoàn thành
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-10">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- shopping-cart start -->
                                <div class="tab-pane active" id="shopping-cart">
                                    <div class="shopping-cart-content">
                                        <div class="table-content table-responsive mb-50">
                                            <table class="text-center">
                                                <thead>
                                                    <tr>
                                                        <th class="product-thumbnail">Sản phẩm</th>
                                                        <th class="product-price">Giá</th>
                                                        <th class="product-quantity">Số lượng</th>
                                                        <th class="product-total">Tổng giá</th>
                                                        <th class="product-remove">Xóa</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        use Gloudemans\Shoppingcart\Facades\Cart;

                                                    
                                                    
                                                        // dd($content);
                                                    ?>
                                                    <!-- tr -->
                                                    @if (count(Cart::content()) != 0)
                                                    @foreach ($content as $cont)
                                                    <?php
                                                        if (!function_exists('currency_format')) {
                                                            function currency_format($cont, $suffix = ' VNĐ')
                                                            {
                                                                if (!empty($cont)) {
                                                                    return number_format($cont, 0, ',', '.') . "{$suffix}";
                                                                }
                                                            }
                                                        }
                                                        $total = $cont->qty * $cont->price;
                                                    ?>
                                                    <tr>
                                                        <td class="product-thumbnail">
                                                            <div class="pro-thumbnail-img">
                                                                <img src="{{ asset($cont->options->image) }}" alt="">
                                                            </div>
                                                            <div class="pro-thumbnail-info text-left">
                                                                <h6 class="product-title-2">
                                                                    <a href="#">{{$cont->name}}</a>
                                                                </h6>
                                                            </div>
                                                        </td>
                                                        <td class="product-price">
                                                            {{ currency_format($cont->price) }}</td>
                                                        <td class="product-quantity">
                                                            <form action="{{ URL::to('/update-cart-quantity') }}"
                                                                method="POST">
                                                                @csrf
                                                                @foreach($products as $maxP)
                                                                @if($maxP->id == $cont->id)
                                                                <div class="quantity">
                                                                    <input type="number" name="cart_quantity"
                                                                        value="{{ $cont->qty }}" min="0" max="{{$maxP->qty}}">
                                                                </div>
                                                                @endif
                                                                @endforeach
                                                                <input type="submit" value="Câp nhật" name="update_qty"
                                                                    class="button extra-small button-black form-control m-0">
                                                          
                                                                <input type="hidden" value="{{ $cont->rowId }}"
                                                                    name="rowId_cart">
                                                                <!-- <input class="cart_quantity_input form-control" type="text"
                                                                name="cart_quantity" value="{{ $cont->qty }}">

                                                            <input type="submit" value="Câp nhật" name="update_qty"
                                                                class="btn btn-warning form-control"> -->
                                                            </form>

                                                        </td>
                                                        <td class="product-price">
                                                            {{ currency_format($total) }}
                                                        </td>
                                                        <td class="product-remove">
                                                            <a class="text-danger"
                                                                href="{{ URL::to('/delete-to-cart/' . $cont->rowId) }}"><i
                                                                    class="zmdi zmdi-close"></i>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <p class="text-center"> Không có sản phẩm trong giỏ hàng</p>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- <div class="coupon-discount box-shadow p-30 mb-50">
                                                        <h6 class="widget-title border-left mb-20">coupon discount</h6>
                                                        <p>Enter your coupon code if you have one!</p>
                                                        <input type="text" name="name"
                                                            placeholder="Enter your code here.">
                                                        <button class="submit-btn-1 black-bg btn-hover-2"
                                                            type="submit">apply coupon</button>
                                                    </div> -->
                                            </div>
                                            <div class="col-md-6">
                                                <div class="payment-details box-shadow p-30 mb-50">
                                                    <h6 class="widget-title border-left mb-20">Thanh toán</h6>
                                                    <table>
                                                        <tr>
                                                            <td class="td-title-1">Tổng tiền:</td>
                                                            <td class="td-title-2">
                                                                <h5 class="product-price"> {{ $totalBill }} VNĐ</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                <div class="f-right">


                                                                    <a href="/cua-hang"
                                                                        class="button extra-small button-black"
                                                                        tabindex="-1">
                                                                        <span class="text-uppercase">Trở lại</span>
                                                                    </a>

                                                                    <a href="/thanh-toan"
                                                                        class="button extra-small button-black"
                                                                        tabindex="-1">
                                                                        <span class="text-uppercase">Thanh toán</span>
                                                                    </a>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->

        </section>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#template-booking').booking();
        });
        </script>

        <!-- JS files -->
        @include('layout_client.footer')
        @include('layout_client.script')
        <script>
        jQuery(
                '<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>'
            )
            .insertAfter('.quantity input');
        jQuery('.quantity').each(function() {
            var spinner = jQuery(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');

            btnUp.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue >= max) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue + 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

            btnDown.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue <= min) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue - 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

        });
        </script>
</body>


<!-- Mirrored from quanticalabs.com/Autospa/Template/?page=book-your-wash by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Feb 2022 11:22:27 GMT -->

</html>