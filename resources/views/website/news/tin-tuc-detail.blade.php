<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bệnh Viện Laptop 51</title>
    @include('layout_client.style')
</head>

<body>
    <div class="wrapper">

        <!-- START HEADER AREA -->
        @include('layout_client.menu')
        <!-- END MOBILE MENU AREA -->

        <!-- BREADCRUMBS SETCTION START -->
        <div class="breadcrumbs-section plr-200 mb-80 section">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">Tin Tức</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="index.html">Trang Chủ</a></li>
                                    <li>Tin Tức</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMBS SETCTION END -->

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper section">

            <!-- BLOG SECTION START -->
            <div class="blog-section mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="blog-details-area">
                                <!-- blog-details-photo -->
                                <div class="blog-details-photo bg-img-1 p-20 mb-30">
                                    <img src="{{ asset($news->image) }}" alt="">
                                    <div class="today-date bg-img-1">
                                        <span class="meta-date">{{ $news->created_at->format('d') }}</span>
                                        <span class="meta-month">Tháng {{ $news->created_at->format('m') }}</span>
                                    </div>
                                </div>
                                <!-- blog-details-title -->
                                <h3 class="blog-details-title mb-30">{{ $news->title }}</h3>
                                <p>{{ $news->description_short }}</p>
                                <!-- blog-description -->
                                <div class="blog-description mb-60">
                                    <p>{!! $news->description !!}</p>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- widget-search -->

                            <!-- widget-categories -->
                            <aside class="widget widget-categories box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Danh mục tin tức</h6>
                                <div id="cat-treeview" class="product-cat">
                                    <ul>
                                        @foreach ($category_news as $item)
                                            <li class="closed">
                                                <a href="{{ route('category', ['id' => $item->id]) }}">
                                                    <span>{{ $item->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </aside>
                            <!-- widget-product -->
                            <aside class="widget widget-product box-shadow">
                                <h6 class="widget-title border-left mb-20">Tin tức liên quan</h6>
                                <!-- product-item start -->

                                @foreach ($news_all as $item)
                                    @if ($item->category_news_id == $news->category_news_id && $item->status == 1)
                                        <div class="product-item">
                                            <div class="product-img">
                                                <a href="{{ route('tin-tuc-detail', ['id' => $item->id]) }}">
                                                    <img src="{{ asset($item->image) }}" alt="" width="100" />
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <h6 class="product-title">
                                                    <a
                                                        href="{{ route('tin-tuc-detail', ['id' => $item->id]) }}">{{ $item->title }}</a>
                                                </h6>
                                                <h3 class="pro-price">{{ $item->created_at->format('d-m-Y') }}
                                                </h3>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                <!-- product-item end -->
                            </aside>
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


</html>
