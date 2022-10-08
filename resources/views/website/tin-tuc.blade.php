<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tin tức</title>
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
                                                            <li class="closed"><a href="#">Brand One</a>
                                                                <ul>
                                                                    <li><a href="#">Mobile</a></li>
                                                                    <li><a href="#">Tab</a></li>
                                                                    <li><a href="#">Watch</a></li>
                                                                    <li><a href="#">Head Phone</a></li>
                                                                    <li><a href="#">Memory</a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="open"><a href="#">Brand Two</a>
                                                                <ul>
                                                                    <li><a href="#">Mobile</a></li>
                                                                    <li><a href="#">Tab</a></li>
                                                                    <li><a href="#">Watch</a></li>
                                                                    <li><a href="#">Head Phone</a></li>
                                                                    <li><a href="#">Memory</a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="closed"><a href="#">Accessories</a>
                                                                <ul>
                                                                    <li><a href="#">Footwear</a></li>
                                                                    <li><a href="#">Sunglasses</a></li>
                                                                    <li><a href="#">Watches</a></li>
                                                                    <li><a href="#">Utilities</a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="closed"><a href="#">Top Brands</a>
                                                                <ul>
                                                                    <li><a href="#">Mobile</a></li>
                                                                    <li><a href="#">Tab</a></li>
                                                                    <li><a href="#">Watch</a></li>
                                                                    <li><a href="#">Head Phone</a></li>
                                                                    <li><a href="#">Memory</a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="closed"><a href="#">Jewelry</a>
                                                                <ul>
                                                                    <li><a href="#">Footwear</a></li>
                                                                    <li><a href="#">Sunglasses</a></li>
                                                                    <li><a href="#">Watches</a></li>
                                                                    <li><a href="#">Utilities</a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </aside>
                                            </div>
                                        </div>
                                        <!-- Tags -->
                                        <div class="dropdown f-left">
                                            <button class="option-btn">
                                                Người đăng
                                                <i class="zmdi zmdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-width mt-30">
                                                <aside class="widget widget-tags box-shadow">
                                                    <h6 class="widget-title border-left mb-20">Người đăng</h6>
                                                    <ul class="widget-tags-list">
                                                        <li><a href="#">Admin</a></li>
                                                        <li><a href="#">Lễ tân</a></li>
                                                        <li><a href="#">Thợ sửa</a></li>
                                                    </ul>
                                                </aside>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- blog-option end -->
                            </div>
                            <div class="row">
                                <!-- blog-item start -->
                                <div class="col-md-6">
                                    <div class="blog-item">
                                        <img src="img/blog/1.jpg" alt="">
                                        <div class="blog-desc">
                                            <h5 class="blog-title"><a href="single-blog.html">dummy Blog name</a>
                                            </h5>
                                            <p>There are many variations of passages of psum available, but the majority
                                                have suffered alterat on in some form, by injected humour, randomis
                                                words which don't look even slightly.</p>
                                            <div class="read-more">
                                                <a href="single-blog.html">Read more</a>
                                            </div>
                                            <ul class="blog-meta">
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-favorite"></i>89 Like</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-comments"></i>59 Comments</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-share"></i>29 Share</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- blog-item end -->
                                <!-- blog-item start -->
                                <div class="col-md-6">
                                    <div class="blog-item">
                                        <img src="img/blog/2.jpg" alt="">
                                        <div class="blog-desc">
                                            <h5 class="blog-title"><a href="single-blog.html">dummy Blog name</a>
                                            </h5>
                                            <p>There are many variations of passages of psum available, but the majority
                                                have suffered alterat on in some form, by injected humour, randomis
                                                words which don't look even slightly.</p>
                                            <div class="read-more">
                                                <a href="single-blog.html">Read more</a>
                                            </div>
                                            <ul class="blog-meta">
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-favorite"></i>89 Like</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-comments"></i>59 Comments</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-share"></i>29 Share</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- blog-item end -->
                                <!-- blog-item start -->
                                <div class="col-md-6">
                                    <div class="blog-item">
                                        <img src="img/blog/3.jpg" alt="">
                                        <div class="blog-desc">
                                            <h5 class="blog-title"><a href="single-blog.html">dummy Blog name</a>
                                            </h5>
                                            <p>There are many variations of passages of psum available, but the majority
                                                have suffered alterat on in some form, by injected humour, randomis
                                                words which don't look even slightly.</p>
                                            <div class="read-more">
                                                <a href="single-blog.html">Read more</a>
                                            </div>
                                            <ul class="blog-meta">
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-favorite"></i>89 Like</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-comments"></i>59 Comments</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-share"></i>29 Share</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- blog-item end -->
                                <!-- blog-item start -->
                                <div class="col-md-6">
                                    <div class="blog-item">
                                        <img src="img/blog/4.jpg" alt="">
                                        <div class="blog-desc">
                                            <h5 class="blog-title"><a href="single-blog.html">dummy Blog name</a>
                                            </h5>
                                            <p>There are many variations of passages of psum available, but the majority
                                                have suffered alterat on in some form, by injected humour, randomis
                                                words which don't look even slightly.</p>
                                            <div class="read-more">
                                                <a href="single-blog.html">Read more</a>
                                            </div>
                                            <ul class="blog-meta">
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-favorite"></i>89 Like</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-comments"></i>59 Comments</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-share"></i>29 Share</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- blog-item end -->
                                <!-- blog-item start -->
                                <div class="col-md-6">
                                    <div class="blog-item">
                                        <img src="img/blog/5.jpg" alt="">
                                        <div class="blog-desc">
                                            <h5 class="blog-title"><a href="single-blog.html">dummy Blog name</a>
                                            </h5>
                                            <p>There are many variations of passages of psum available, but the majority
                                                have suffered alterat on in some form, by injected humour, randomis
                                                words which don't look even slightly.</p>
                                            <div class="read-more">
                                                <a href="single-blog.html">Read more</a>
                                            </div>
                                            <ul class="blog-meta">
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-favorite"></i>89 Like</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-comments"></i>59 Comments</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-share"></i>29 Share</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- blog-item end -->
                                <!-- blog-item start -->
                                <div class="col-md-6">
                                    <div class="blog-item">
                                        <img src="img/blog/6.jpg" alt="">
                                        <div class="blog-desc">
                                            <h5 class="blog-title"><a href="single-blog.html">dummy Blog name</a>
                                            </h5>
                                            <p>There are many variations of passages of psum available, but the majority
                                                have suffered alterat on in some form, by injected humour, randomis
                                                words which don't look even slightly.</p>
                                            <div class="read-more">
                                                <a href="single-blog.html">Read more</a>
                                            </div>
                                            <ul class="blog-meta">
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-favorite"></i>89 Like</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-comments"></i>59 Comments</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-share"></i>29 Share</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- blog-item end -->
                                <!-- blog-item start -->
                                <div class="col-md-6">
                                    <div class="blog-item">
                                        <img src="img/blog/1.jpg" alt="">
                                        <div class="blog-desc">
                                            <h5 class="blog-title"><a href="single-blog.html">dummy Blog name</a>
                                            </h5>
                                            <p>There are many variations of passages of psum available, but the majority
                                                have suffered alterat on in some form, by injected humour, randomis
                                                words which don't look even slightly.</p>
                                            <div class="read-more">
                                                <a href="single-blog.html">Read more</a>
                                            </div>
                                            <ul class="blog-meta">
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-favorite"></i>89 Like</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-comments"></i>59 Comments</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-share"></i>29 Share</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- blog-item end -->
                                <!-- blog-item start -->
                                <div class="col-md-6">
                                    <div class="blog-item">
                                        <img src="img/blog/7.jpg" alt="">
                                        <div class="blog-desc">
                                            <h5 class="blog-title"><a href="single-blog.html">dummy Blog name</a>
                                            </h5>
                                            <p>There are many variations of passages of psum available, but the majority
                                                have suffered alterat on in some form, by injected humour, randomis
                                                words which don't look even slightly.</p>
                                            <div class="read-more">
                                                <a href="single-blog.html">Read more</a>
                                            </div>
                                            <ul class="blog-meta">
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-favorite"></i>89 Like</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-comments"></i>59 Comments</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="zmdi zmdi-share"></i>29 Share</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- blog-item end -->
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
                                        <li class="closed"><a href="#">Brand One</a>
                                            <ul>
                                                <li><a href="#">Mobile</a></li>
                                                <li><a href="#">Tab</a></li>
                                                <li><a href="#">Watch</a></li>
                                                <li><a href="#">Head Phone</a></li>
                                                <li><a href="#">Memory</a></li>
                                            </ul>
                                        </li>
                                        <li class="open"><a href="#">Brand Two</a>
                                            <ul>
                                                <li><a href="#">Mobile</a></li>
                                                <li><a href="#">Tab</a></li>
                                                <li><a href="#">Watch</a></li>
                                                <li><a href="#">Head Phone</a></li>
                                                <li><a href="#">Memory</a></li>
                                            </ul>
                                        </li>
                                        <li class="closed"><a href="#">Accessories</a>
                                            <ul>
                                                <li><a href="#">Footwear</a></li>
                                                <li><a href="#">Sunglasses</a></li>
                                                <li><a href="#">Watches</a></li>
                                                <li><a href="#">Utilities</a></li>
                                            </ul>
                                        </li>
                                        <li class="closed"><a href="#">Top Brands</a>
                                            <ul>
                                                <li><a href="#">Mobile</a></li>
                                                <li><a href="#">Tab</a></li>
                                                <li><a href="#">Watch</a></li>
                                                <li><a href="#">Head Phone</a></li>
                                                <li><a href="#">Memory</a></li>
                                            </ul>
                                        </li>
                                        <li class="closed"><a href="#">Jewelry</a>
                                            <ul>
                                                <li><a href="#">Footwear</a></li>
                                                <li><a href="#">Sunglasses</a></li>
                                                <li><a href="#">Watches</a></li>
                                                <li><a href="#">Utilities</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </aside>

                            <!-- widget-product -->
                            <aside class="widget widget-product box-shadow">
                                <h6 class="widget-title border-left mb-20">Tin tức liên quan</h6>
                                <!-- product-item start -->
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img src="img/product/4.jpg" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-title">
                                            <a href="single-product.html">Product Name</a>
                                        </h6>
                                        <h3 class="pro-price">$ 869.00</h3>
                                    </div>
                                </div>
                                <!-- product-item end -->
                                <!-- product-item start -->
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img src="img/product/8.jpg" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-title">
                                            <a href="single-product.html">Product Name</a>
                                        </h6>
                                        <h3 class="pro-price">$ 869.00</h3>
                                    </div>
                                </div>
                                <!-- product-item end -->
                                <!-- product-item start -->
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img src="img/product/12.jpg" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-title">
                                            <a href="single-product.html">Product Name</a>
                                        </h6>
                                        <h3 class="pro-price">$ 869.00</h3>
                                    </div>
                                </div>
                                <!-- product-item end -->
                            </aside>
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
