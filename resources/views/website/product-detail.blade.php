<!DOCTYPE html>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <title>Chi tiết sản phẩm</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layout_client.style')


</head>

<body>
    <div class="wrapper">
        @include('layout_client.menu')
        <div class="breadcrumbs-section plr-200 mb-80 section">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">Chi tiết sản phẩm</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="/">Trang chủ</a></li>
                                    <li>Chi tiết sản phẩm</li>
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
                        <div class="col-lg-9">
                            <!-- single-product-area start -->
                            <div class="single-product-area mb-80">
                                <div class="row">
                                    <!-- imgs-zoom-area start -->
                                    <div class="col-lg-5">
                                        <div class="imgs-zoom-area">
                                            @foreach ($images as $image)
                                            <img id="zoom_03" src="{{ asset($image->path) }}"
                                                data-zoom-image="{{ asset($image->path) }}" alt="">
                                            @break;
                                            @endforeach
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div id="gallery_01" class="carousel-btn slick-arrow-3 mt-30">

                                                        @foreach ($images as $image)
                                                        <div class="p-c">
                                                            <a href="#" data-image="{{ asset($image->path) }}"
                                                                data-zoom-image="{{ asset($image->path) }}">
                                                                <img class="zoom_03" src="{{ asset($image->path) }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- imgs-zoom-area end -->
                                    <!-- single-product-info start -->
                                    <div class="col-lg-7">
                                        <div class="single-product-info">
                                            <h3 class="text-black-1 pro-price">{{$pro->name}}</h3>
                                            <h6 class="brand-name-2">{{$pro->companyCar->company_name}}</h6>

                                            <hr>
                                            <!-- single-pro-color-rating -->
                                            <div class="single-pro-color-rating">
                                                <h5 class="widget-title border-left">Thông số máy</h5>
                                                <div class="sin-pro-color">
                                                    <p class="text-black-1 title">RAM: {{$pro->ram}}</p>
                                                    <p class="text-black-1 title">CPU: {{$pro->cpu}}</p>
                                                    <p class="text-black-1 title">Ổ cứng: {{$pro->harddrive}}</p>
                                                    <p class="text-black-1 title">Màn hình: {{$pro->screen}}</p>
                                                    <p class="text-black-1 title">Card đồ họa: {{$pro->cardgraphic}}</p>
                                                </div>

                                            </div>

                                            <hr>
                                            <?php
                                            if (!function_exists('currency_format')) {
                                                function currency_format($pro, $suffix = ' VNĐ')
                                                {
                                                    if (!empty($pro)) {
                                                        return number_format($pro, 0, ',', '.') . "{$suffix}";
                                                    }
                                                }
                                            }
                                            ?>
                                            <!-- plus-minus-pro-action -->
                                            <h3 class="pro-price">Giá: {{ currency_format($pro->price) }}</h3>
                                            <!-- 
                                            <hr>
                                            <div class="plus-minus-pro-action clearfix">
                                                <div class="sin-plus-minus f-left clearfix">
                                                    <p class="color-title f-left">Số lượng</p>
                                                    <div class="cart-plus-minus f-left">
                                                        <input type="text" value="1" max="{{$pro->qty}}"
                                                            name="qtybutton" class="cart-plus-minus-box">
                                                    </div>
                                                </div>
                                            </div> -->
                                            <hr>
                                            <div class="clearfix">
                                                @if($pro->qty >= 1)
                                                <div class="f-right">
                                                    <form class="" action="{{ URL::to('/add-cart') }}" method="POST">
                                                        @csrf
                                                        <input name="qly" type="number" hidden min="1" value="1">
                                                        <input name="id" hidden value="{{ $pro->id }}">
                                                        <button type="submit">
                                                            <a href="#" class="button extra-small button-black"
                                                                tabindex="-1">
                                                                <span class="text-uppercase">Thêm vào giỏ</span>
                                                            </a>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="f-right">
                                                    <form class="" action="{{ URL::to('/save-cart') }}" method="POST">
                                                        @csrf
                                                        <input name="qly" type="number" hidden min="1" value="1">
                                                        <input name="id" hidden value="{{ $pro->id }}">
                                                        <button type="submit">
                                                            <a href="#" class="button extra-small button-black"
                                                                tabindex="-1">
                                                                <span class="text-uppercase">Mua ngay</span>
                                                            </a>
                                                        </button>
                                                    </form>
                                                </div>
                                                @elseif($pro->qty < 1) <div class="f-right">
                                                    <button type="submit">
                                                        <a href="#" class="button extra-small button-black"
                                                            tabindex="-1">
                                                            <span class="text-uppercase">Hết hàng</span>
                                                        </a>
                                                    </button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product-info end -->
                            </div>
                            <!-- single-product-tab -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- hr -->
                                    <hr>
                                    <div class="single-product-tab reviews-tab">
                                        <ul class="nav mb-20">
                                            <li><a class="active" href="#description" data-bs-toggle="tab">Mô tả</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active show" id="description">

                                                {!! $pro->desc !!}

                                            </div>
                                        </div>
                                    </div>
                                    <!--  hr -->
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-area end -->
                        <div class="related-product-area">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-title text-left mb-40">
                                        <h2 class="uppercase">Sản phẩm cùng hãng</h2>
                                    </div>
                                    <div class="active-related-product">
                                        @foreach($productsCarCompany as $productsCar)
                                        <div class="product-item">
                                            <div class="product-img">
                                                @foreach ($images_product_list as $image)
                                                @if ($image->product_id == $productsCar->id)
                                                <a href="/san-pham/{{$productsCar->slug}}">
                                                    <img src="{{ asset($image->path) }}"
                                                        alt="{{ asset($image->path) }}" />
                                                </a>
                                                @break;
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title text-black-1 px-2 mb-0">
                                                    <a
                                                        href="/san-pham/{{$productsCar->slug}}">{{$productsCar->name}}</a>
                                                </h3>
                                                <?php

if (!function_exists('currency_format')) {
    function currency_format($productsCar, $suffix = ' VNĐ')
    {
        if (!empty($productsCar)) {
            return number_format($productsCar, 0, ',', '.') . "{$suffix}";
        }
    }
}
?>

                                                <h6 class="pro-price mb-0">
                                                    {{ currency_format($productsCar->price) }}</h6>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <!-- widget-categories -->
                        <aside class="widget widget-categories box-shadow mb-30">
                            <h6 class="widget-title border-left mb-20">Danh mục</h6>
                            <div id="cat-treeview" class="product-cat">
                                <ul>
                                    <li class="open"><a href="#">Laptop</a>
                                        <ul>
                                            <li>
                                                <a @if(session()->get('url_path') == "cua-hang") style="color:#ff7f00"
                                                    @endif href="/cua-hang">
                                                    Tất cả
                                                </a>
                                            </li>
                                            @foreach($CarCompany as $CarCom)
                                            <li><a class="" @if(session()->get('url_path') ==
                                                    "cua-hang/$CarCom->id")
                                                    style="color:#ff7f00"
                                                    @endif
                                                    href="/cua-hang/{{$CarCom->id}}">{{$CarCom->company_name}}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                        <aside class="widget widget-product box-shadow">
                            <h6 class="widget-title border-left mb-20">Sản phẩm bán chạy</h6>
                            <!-- product-item start -->
                            @foreach($product_hot_sell as $products_hot)
                            <?php

                                    if (!function_exists('currency_format')) {
                                        function currency_format($products_hot, $suffix = ' VNĐ')
                                        {
                                            if (!empty($products_hot)) {
                                                return number_format($products_hot, 0, ',', '.') . "{$suffix}";
                                            }
                                        }
                                    }
                                    ?>

                            <div class="product-item">
                                <div class="product-img">
                                    @foreach ($images_product_list as $image)
                                    @if ($image->product_id == $products_hot->id)
                                    <a href="/san-pham/{{$products_hot->slug}}">
                                        <img src="{{ asset($image->path) }}" alt="{{ asset($image->path) }}" />
                                    </a>
                                    @break;
                                    @endif
                                    @endforeach
                                </div>
                                <div class="product-info">
                                    <h6 class="product-title">
                                        <a href="/san-pham/{{$products_hot->slug}}">{{$products_hot->name}}</a>
                                    </h6>
                                    <h3 class="pro-price">{{ currency_format($products_hot->price) }}</h3>
                                </div>
                            </div>
                            @endforeach
                            <!-- product-item end -->

                        </aside>
                    </div>
                </div>
            </div>
    </div>
    <!-- SHOP SECTION END -->
    </section>
    </div>

    @include('layout_client.footer')
    @include('layout_client.script')
</body>

</html>