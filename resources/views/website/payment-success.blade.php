<!DOCTYPE html>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Đặt hàng thành công</title>
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

    input[type='radio']:checked {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        background-color: #ff7f00;
        display: inline-block;
        border: 2px solid white;
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

    .linedown {
        overflow: hidden;
        word-wrap: break-word;
        /* IE 5.5-7 */
        white-space: -moz-pre-wrap;
        /* Firefox 1.0-2.0 */
        white-space: pre-wrap;
        /* current browsers */
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
                                <h1 class="breadcrumbs-title">Đặt hàng thành công</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="/">Trang chủ</a></li>
                                    <li>Đặt hàng thành công</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section id="page-content" class="page-wrapper section">
            <?php
                if (!function_exists('currency_format')) {
                        function currency_format($bill_d, $suffix = ' VNĐ')
                        {
                            if (!empty($bill_d)) {
                            return number_format($bill_d, 0, ',', '.') . "{$suffix}";
                            }
                        }
                    }
        ?>
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
                                    <a class="active">
                                        <span>02</span>
                                        Thanh toán
                                    </a>
                                </li>
                                <li>
                                    <a class="active">
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
                                <!-- order-complete start -->
                                <div class="tab-pane active" id="shopping-cart">
                                    <div class="shopping-cart-content box-shadow">
                                        <div class="thank-you p-30 text-center">
                                            <h6 class="text-black-5 mb-0">Cảm ơn bạn. Chúng tôi đã nhận được đơn hàng
                                                của bạn!</h6>
                                        </div>
                                        <div class="order-info p-30 mb-10">
                                            <div class="row">
                                                <!-- our order -->
                                                <div class="col-md-12">
                                                    <div class="payment-details p-30">
                                                        <h4 class="widget-title border-left mb-20">Hóa đơn</h4>
                                                        <table>
                                                            <tr>
                                                                <td class="td-title-1 "><h6>Mã hóa đơn: {{$bill->code}}</h6></td>

                                                            </tr>
                                                            @foreach($bill_detail as $bill_d)

                                                            <?php
                                                        if (!function_exists('currency_format')) {
                                                            function currency_format($bill_d, $suffix = ' VNĐ')
                                                            {
                                                                if (!empty($bill_d)) {
                                                                    return number_format($bill_d, 0, ',', '.') . "{$suffix}";
                                                                }
                                                            }
                                                        }
                                                        $total = $bill_d->quaty * $bill_d->ban;
                                                        ?>

                                                            <tr>
                                                                <td class="td-title-1"><h6>Sản phẩm:
                                                                    {{$bill_d->product->name}}</h6>
                                                                   </td>
                                                                   <td class="td-title-2"><h6>Giá: {{currency_format($bill_d->ban)}} x Số lượng: {{$bill_d->quaty}} = {{currency_format($total)}}</h6>
                                                            </td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                            <td class="td-title-1">
                                                                <td class="td-title-2"><h5 class="widget-title order-total text-end">Tổng tiền:
                                                                    {{currency_format($bill->total_price)}}</h5>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="bill-details p-30">
                                                        <h4 class="widget-title border-left mb-20">Thông tin người nhận
                                                        </h4>
                                                        <table>
                                                            <tr>
                                                                <td class="td-title-1"><h6> Họ và tên: {{$bill_user->name}} </h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="td-title-1"><h6>Số điện thoại:   {{$bill_user->phone}} </h6></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="td-title-1"><h6>Email:  {{$bill_user->email}}</h6></td>
                                                          
                                                            </tr>
                                                            <tr>
                                                                <td class="td-title-1"><h6> Địa chỉ:  {{$bill_user->address}}</h6></td>
                                                            </tr>
                                                        </table>
                                                        <!-- <ul class="bill-address">
                                                            <li>
                                                                <span class="linedown" style="width: 100px;">Số điện thoại </span>
                                                                <p class="linedown">{{$bill_user->phone}}</p>
                                                            </li>
                                                            <li>
                                                                <span class="linedown" style="width: 100px;">Email</span>
                                                           <p class="linedown">      {{$bill_user->email}}</p>
                                                            </li>
                                                            <li>
                                                                <span class="linedown" style="width: 100px;">Địa chỉ</span>
                                                               <p class="linedown"> {{$bill_user->address}}3211111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111 </p>
                                                            </li>
                                                        </ul> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- order-complete end -->
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
        @include('layout_client.footer')
        <!-- JS files -->
        @include('layout_client.script')
        @include('layout_client.script_payment')

</body>



</html>