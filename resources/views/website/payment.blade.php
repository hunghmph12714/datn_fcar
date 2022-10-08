<!DOCTYPE html>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <title>Thanh toán</title>
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
                                <h1 class="breadcrumbs-title">Thanh toán</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="/">Trang chủ</a></li>
                                    <li>Thanh toán</li>
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
                                    <a class="active">
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

                                <!-- shopping-cart end -->
                                <!-- wishlist start -->
                                <!-- wishlist end -->
                                <!-- checkout start -->
                                <div class="tab-pane active" id="shopping-cart">
                                    <div class="shopping-cart-content box-shadow p-30">
                                        <form action="{{ URL::to('/save-payment') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <!-- billing details -->
                                                <div class="col-md-6">
                                                    <div class="billing-details pr-10">
                                                        <h6 class="widget-title border-left mb-20">Thông tin người mua
                                                        </h6>
                                                        @error('name')
                                                        <small
                                                            class="font-italic text-danger p-0 m-0">{{ $message }}</small>
                                                        @enderror
                                                        <input type="text" name="name" value="{{ old('name',Auth::user()->name ) }}"
                                                            placeholder="Họ và tên người nhận">
                                                        @error('email')
                                                        <small
                                                            class="font-italic text-danger p-0 m-0">{{ $message }}</small>
                                                        @enderror
                                                        <input type="text" type="email" name="email"
                                                            value="{{ old('email',Auth::user()->email) }}" placeholder="Địa chỉ email">
                                                        @error('phone')
                                                        <small
                                                            class="font-italic text-danger p-0 m-0">{{ $message }}</small>
                                                        @enderror
                                                        <input type="text" name="phone" value="{{ old('phone',Auth::user()->phone) }}"
                                                            placeholder="Số điện thoại">
                                                        @error('address')
                                                        <small
                                                            class="font-italic text-danger p-0 m-0">{{ $message }}</small>
                                                        @enderror
                                                        <input type="text" name="address" value="{{ old('address',Auth::user()->adddress) }}"
                                                            placeholder="Địa chỉ nhà">

                                                        <textarea class="custom-textarea" name="note"
                                                            placeholder="Ghi chú"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- our order -->
                                                    <div class="payment-details pl-10 mb-50">
                                                        <h6 class="widget-title border-left mb-20">Hóa đơn</h6>
                                                        <table>
                                                            <?php
                                                        use Gloudemans\Shoppingcart\Facades\Cart;

                                                        $content = Cart::content();
                                                        // dd($content);
                                                    ?>
                                                            <!-- tr -->
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
                                                                <td class="td-title-1">{{$cont->name}} x {{$cont->qty}}
                                                                </td>
                                                                <td class="td-title-2">{{currency_format($total)}}</td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td class="order-total">Tổng tiền</td>
                                                                <td class="order-total-price">{{ $totalBill }} VNĐ</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <!-- payment-method -->
                                                    <div class="payment-method">
                                                        <h6 class="widget-title border-left mb-20">Phương thức thanh
                                                            toán</h6>
                                                        <div id="accordion">
                                                            <div class="panel">
                                                                <h4 class="payment-title box-shadow">
                                                                    <a data-bs-toggle="collapse" href="#bank-transfer">
                                                                        Chọn phương thức thanh toán
                                                                    </a>
                                                                </h4>
                                                                <div id="bank-transfer"
                                                                    class="panel-collapse collapse show"
                                                                    data-bs-parent="#accordion">
                                                                    <div class="payment-content">
                                                                        <div class="form-check mx-2">
                                                                            <input class="form-check-input radio-color"
                                                                                value="1" type="radio"
                                                                                name="payment_method"
                                                                                id="flexRadioDefault1" />
                                                                            <label class="form-check-label"
                                                                                for="flexRadioDefault1"> Thanh toán khi
                                                                                nhận hàng
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-check pb-2 mx-2">
                                                                            <input class="form-check-input radio-color"
                                                                                value="2" type="radio"
                                                                                name="payment_method"
                                                                                id="flexRadioDefault2" />
                                                                            <label class="form-check-label"
                                                                                for="flexRadioDefault2"> Thanh toán VNPAY </label>
                                                                        </div>
                                                                        @error('payment_method')
                                                                    <small
                                                                        class="font-italic text-danger p-0 m-0">{{ $message }}</small>
                                                                    @enderror
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- payment-method end -->
                                                    <button class="submit-btn-1 mt-30 btn-hover-1" type="submit">Thanh
                                                        toán</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- checkout end -->
                                <!-- order-complete start -->
                                <div class="tab-pane" id="order-complete">
                                    <div class="order-complete-content box-shadow">
                                        <div class="thank-you p-30 text-center">
                                            <h6 class="text-black-5 mb-0">Thank you. Your order has been received.</h6>
                                        </div>
                                        <div class="order-info p-30 mb-10">
                                            <ul class="order-info-list">
                                                <li>
                                                    <h6>order no</h6>
                                                    <p>m 2653257</p>
                                                </li>
                                                <li>
                                                    <h6>order no</h6>
                                                    <p>m 2653257</p>
                                                </li>
                                                <li>
                                                    <h6>order no</h6>
                                                    <p>m 2653257</p>
                                                </li>
                                                <li>
                                                    <h6>order no</h6>
                                                    <p>m 2653257</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="row">
                                            <!-- our order -->
                                            <div class="col-md-6">
                                                <div class="payment-details p-30">
                                                    <h6 class="widget-title border-left mb-20">our order</h6>
                                                    <table>
                                                        <tr>
                                                            <td class="td-title-1">Dummy Product Name x 2</td>
                                                            <td class="td-title-2">$1855.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td-title-1">Dummy Product Name</td>
                                                            <td class="td-title-2">$555.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td-title-1">Cart Subtotal</td>
                                                            <td class="td-title-2">$2410.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td-title-1">Shipping and Handing</td>
                                                            <td class="td-title-2">$15.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td-title-1">Vat</td>
                                                            <td class="td-title-2">$00.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="order-total">Order Total</td>
                                                            <td class="order-total-price">$2425.00</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bill-details p-30">
                                                    <h6 class="widget-title border-left mb-20">billing details</h6>
                                                    <ul class="bill-address">
                                                        <li>
                                                            <span>Address:</span>
                                                            28 Green Tower, Street Name, New York City, USA
                                                        </li>
                                                        <li>
                                                            <span>email:</span>
                                                            info@companyname.com
                                                        </li>
                                                        <li>
                                                            <span>phone : </span>
                                                            (+880) 19453 821758
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="bill-details pl-30">
                                                    <h6 class="widget-title border-left mb-20">billing details</h6>
                                                    <ul class="bill-address">
                                                        <li>
                                                            <span>Address:</span>
                                                            28 Green Tower, Street Name, New York City, USA
                                                        </li>
                                                        <li>
                                                            <span>email:</span>
                                                            info@companyname.com
                                                        </li>
                                                        <li>
                                                            <span>phone : </span>
                                                            (+880) 19453 821758
                                                        </li>
                                                    </ul>
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
        @include('layout_client.script_payment')

</body>

</html>