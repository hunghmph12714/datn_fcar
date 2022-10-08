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
        <div id="page-content" class="page-wrapper section">

            <!-- BLOG SECTION START -->
            <div class="blog-section mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 order-lg-2 order-1">
                            <div class="row">
                                <!-- blog-option start -->
                                <div class="col-lg-12">
                                    <div class="blog-option box-shadow mb-30  clearfix">
                                        <!-- categories -->
                                        <div class="dropdown f-left">
                                            <button class="option-btn">
                                                Danh mục
                                                <i class="zmdi zmdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-width mt-30">
                                                <aside class="widget widget-categories box-shadow">
                                                    <h6 class="widget-title border-left mb-20">Danh mục</h6>
                                                    <div id="cat-treeview-2" class="product-cat">
                                                        <ul>
                                                            @foreach ($cates_all as $item)
                                                                <li class="closed">
                                                                    <a
                                                                        href="{{ route('category', ['id' => $item->id]) }}">
                                                                        <span>{{ $item->name }}</span>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </aside>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- blog-option end -->
                            </div>
                            <div class="row">
                                @foreach ($news as $item)
                                    @if ($item->category_news_id == $cates->id && $item->status == 1)
                                        <!-- blog-item start -->
                                        <div class="col-md-6">
                                            <div class="blog-item-2">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="blog-image">
                                                            <a
                                                                href="{{ route('tin-tuc-detail', ['id' => $item->id]) }}"><img
                                                                    src="{{ asset($item->image) }}" alt=""></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="blog-desc">
                                                            <h5 class="blog-title-2"><a
                                                                    href="{{ route('tin-tuc-detail', ['id' => $item->id]) }}">{{ $item->title }}</a>
                                                            </h5>
                                                            <p>{{ $item->description_short }}</p>
                                                            <div class="read-more">

                                                                <a class="button extra-small"
                                                                    href="{{ route('tin-tuc-detail', ['id' => $item->id]) }}">
                                                                    <span class="text-uppercase">Đọc Ngay</span> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- blog-item end -->
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- sidebar -->
                        <div class="col-lg-3 order-lg-1 order-2">
                            <!-- widget-search -->
                            <aside class="widget-search mb-30">
                                <form action="#">
                                    <input type="text" placeholder="Tìm kiếm...">
                                    <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                </form>
                            </aside>
                            <!-- widget-categories -->
                            <aside class="widget widget-categories box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Danh mục tin tức</h6>
                                <div id="cat-treeview" class="product-cat">
                                    <ul>
                                        @foreach ($cates_all as $item)
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

                        </div>
                    </div>
                </div>
            </div>
            <!-- BLOG SECTION END -->
        </div>
        <!-- End page content -->

        <!-- START FOOTER AREA -->
        @include('layout_client.footer')
        <!-- END FOOTER AREA -->
    </div>

    @include('layout_client.script')
</body>


</html>
