<!DOCTYPE html>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <title>Trang chủ</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layout_client.style')

</head>

<body>
    <div class="wrapper">
        @include('layout_client.menu')
        @include('layout_client.header')
        <section id="page-content" class="page-wrapper section">

            <!-- BY BRAND SECTION START-->
            <div class="by-brand-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-left mb-40">
                                <h2 class="uppercase">Các Thương Hiệu</h2>
                            </div>
                            <div class="by-brand-product">
                                <div class="active-by-brand slick-arrow-2">
                                    <!-- single-brand-product start -->

                                    @foreach($CarCompany as $CarCom)
                                    <div class="brand-item">
                                        <div class="single-brand-product">
                                            <a href="/cua-hang/{{$CarCom->id}}"><img
                                                    src="{{asset($CarCom->logo)}}" width="150" alt=""></a>
                                        </div>

                                        <!-- single-brand-product end -->
                                    </div> @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br><br><br>
                <!-- BY BRAND SECTION END -->

                <!-- FEATURED PRODUCT SECTION START -->
                <div class="featured-product-section mb-50">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title text-left mb-40">
                                    <h2 class="uppercase">Sản phẩm mới nhất</h2>
                                </div>
                                <div class="featured-product">
                                    <div class="active-featured-product slick-arrow-2">
                                        @foreach ($productNew as $item)
                                        <?php
                                        
                                        if (!function_exists('currency_format')) {
                                            function currency_format($item, $suffix = ' VNĐ')
                                            {
                                                if (!empty($item)) {
                                                    return number_format($item, 0, ',', '.') . "{$suffix}";
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="product-item">
                                            <div class="product-img">
                                                @foreach ($images as $image)
                                                @if ($image->product_id == $item->id)
                                                <a href="/san-pham/{{ $item->slug }}">
                                                    <img src="{{ asset($image->path) }}"
                                                        alt="{{ asset($image->path) }}" />
                                                </a>
                                                @break;
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-title">
                                                    <a href="/san-pham/{{ $item->slug }}">{{ $item->name }}
                                                    </a>
                                                </h6>
                                                <h3 class="pro-price mb-0"><a href="/san-pham/{{ $item->slug }}">{{
                                                        currency_format($item->price) }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PRODUCT TAB SECTION START -->
                <div class="product-tab-section mb-50">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="section-title text-left mb-40">
                                    <h2 class="uppercase">Sản Phẩm Bán Chạy</h2>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <!-- Tab panes -->
                                <div class="featured-product">
                                    <div class="active-featured-product slick-arrow-2">
                                        <!-- product-item start -->
                                        @foreach ($product_hot_sell as $product_hot)
                                        <?php
                                    
                                    if (!function_exists('currency_format')) {
                                        function currency_format($product_hot, $suffix = ' VNĐ')
                                        {
                                            if (!empty($product_hot)) {
                                                return number_format($product_hot, 0, ',', '.') . "{$suffix}";
                                            }
                                        }
                                    }
                                    ?>

                                        <div class="product-item">
                                            <div class="product-img">
                                                @foreach ($images as $image)
                                                @if ($image->product_id == $product_hot->id)
                                                <a href="/san-pham/{{ $product_hot->slug }}">
                                                    <img src="{{ asset($image->path) }}"
                                                        alt="{{ asset($image->path) }}" />
                                                </a>
                                                @break;
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-title">
                                                    <a href="/san-pham/{{ $product_hot->slug }}">{{ $product_hot->name
                                                        }}
                                                    </a>
                                                </h6>
                                                <h3 class="pro-price mb-0"><a href="/san-pham/{{ $item->slug }}">{{
                                                        currency_format($product_hot->price) }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                        @endforeach
                                        <!-- product-item end -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PRODUCT TAB SECTION END -->

            <!-- BLOG SECTION START -->
            <div class="blog-section mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-left mb-40">
                                <h2 class="uppercase">Tin Tức Mới Nhất</h2>
                            </div>
                            <div class="blog">
                                <div class="active-blog">
                                    @foreach ($news as $item)
                                    <div class="blog-item">
                                        <img src="{{ $item->image }}" alt="">
                                        <div class="blog-desc">
                                            <h5 class="blog-title"><a href="tin-tuc/{{ $item->id }}">{{ $item->title
                                                    }}</a>
                                            </h5>
                                            <p>{{ $item->description_short }}</p>
                                            <div class="read-more">
                                                <a href="tin-tuc/{{ $item->id }}">Đọc Thêm</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BLOG SECTION END -->
        </section>
        <!-- End page content -->

        <!-- START FOOTER AREA -->
        @include('layout_client.footer')
        <!-- END FOOTER AREA -->

    </div>
    @include('layout_client.script')
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
</script>

</html>