<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt lịch</title>
    @include('layout_client.style')
</head>

<body>
    @if (Session::has('msg'))
    {!! Session::get('msg') !!}
    @endif
    <div class="wrapper">

        <!-- START HEADER AREA -->
        @include('layout_client.menu')
        <!-- END HEADER AREA -->

        <!-- BREADCRUMBS SETCTION START -->
        <div class="breadcrumbs-section plr-200 mb-80 section">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">Đặt Lịch Sửa Chữa Laptop</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="index.html">Trang Chủ</a></li>
                                    <li>Đặt Lịch</li>
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

            <!-- MESSAGE BOX SECTION START -->
            <div class="message-box-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="message-box box-shadow white-bg">
                                <form id="contact-form" action="" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="blog-section-title border-left mb-30">Vui lòng nhập đầy đủ và
                                                chính xác thông tin của bạn</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="">Họ và Tên</label>
                                            <font color="red">*</font>
                                            <input type="text" name="full_name" value="{{ old('full_name') }}"
                                                placeholder="Họ tên">@error('full_name')
                                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="">Email</label>
                                            <font color="red">*</font>
                                            <input type="text" name="email" value="{{ old('email') }}"
                                                placeholder="Email">
                                            @error('email')
                                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="">Tên máy</label>
                                            <font color="red">*</font>
                                            <input type="text" value="{{ old('name_car') }}" name="name_car"
                                                placeholder="Tên máy">
                                            @error('name_car')
                                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6">
                                            <label for="">Số điện thoại</label>
                                            <font color="red">*</font>
                                            <input type="text" value="{{ old('phone') }}" name="phone"
                                                placeholder="Số điện thoại...">
                                            @error('phone')
                                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <select name="con_ht">
                                                <option value="">Hình thức sửa</option>
                                                <option value="CH">Tại cửa hàng</option>
                                                <option value="TN">Tại nhà</option>
                                            </select>
                                        </div> --}}
                                        <div class="col-lg-6">
                                            <label for="">Thương hiệu máy</label>
                                            <font color="red">*</font>
                                            <select name="company_car_id" id="con_ht">
                                                {{-- <option value="company_computer_id" hidden>Thương hiệu máy</option>
                                                --}}
                                                @foreach ($company_Car as $item)
                                                <option value="{{ $item->id }}">{{ $item->company_name }}</option>
                                                @endforeach
                                                {{-- <option value="hp">HP</option>
                                                <option value="acer">Acer</option>
                                                <option value="macbook">Macbook</option>
                                                <option value="msi">Msi</option>
                                                <option value="khac">khác...</option> --}}
                                            </select>
                                            @error('company_car_id')
                                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="">Khung giờ sửa chữa</label>
                                            <font color="red">*</font>
                                            <select name="interval" id="con_ht">
                                                {{-- <option hidden value="">Khung giờ sửa chữa</option> --}}
                                                <option value="1">8h-10h</option>
                                                <option value="2">10h-12h</option>
                                                <option value="3">12h-14h</option>
                                                <option value="4">14h-16h</option>
                                                <option value="5">16h-18h</option>
                                                <option value="6">18h-20h</option>
                                            </select>
                                            @error('interval')
                                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="">Ngày mang đến</label>
                                            <font color="red">*</font>
                                            <input type="date" id="date" min="{{ now()->format('Y-m-d') }}" name="date"
                                                value="{{ old('date') }}" placeholder="Ngày">
                                            @error('date')
                                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="">Mô tả</label>
                                            <textarea class="custom-textarea" name="description" id="ckeditor"
                                                placeholder="Nội dung...">{{ old('description') }}</textarea>

                                        </div> <button class="submit-btn-1 mt-30 btn-hover-1" name="btn" value="client"
                                            type="submit">Đặt
                                            Lịch</button>
                                    </div>
                                    <p class="form-message"></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MESSAGE BOX SECTION END -->
        </section>
        <!-- End page content -->

        <!-- START FOOTER AREA -->
        @include('layout_client.footer')
        <!-- END FOOTER AREA -->

        <!-- START QUICKVIEW PRODUCT -->
        {{-- <div id="quickview-wrapper">
            <!-- Modal -->
            <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-product clearfix">
                                <div class="product-images">
                                    <div class="main-image images">
                                        <img alt="" src="img/product/quickview.jpg">
                                    </div>
                                </div><!-- .product-images -->

                                <div class="product-info">
                                    <h1>Aenean eu tristique</h1>
                                    <div class="price-box-3">
                                        <div class="s-price-box">
                                            <span class="new-price">£160.00</span>
                                            <span class="old-price">£190.00</span>
                                        </div>
                                    </div>
                                    <a href="single-product-left-sidebar.html" class="see-all">See all
                                        features</a>
                                    <div class="quick-add-to-cart">
                                        <form method="post" class="cart">
                                            <div class="numbers-row">
                                                <input type="number" id="french-hens" value="3">
                                            </div>
                                            <button class="single_add_to_cart_button" type="submit">Add to
                                                cart</button>
                                        </form>
                                    </div>
                                    <div class="quick-desc">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec
                                        est tristique auctor. Donec non est at libero.
                                    </div>
                                    <div class="social-sharing">
                                        <div class="widget widget_socialsharing_widget">
                                            <h3 class="widget-title-modal">Share this product</h3>
                                            <ul class="social-icons clearfix">
                                                <li>
                                                    <a class="facebook" href="#" target="_blank" title="Facebook">
                                                        <i class="zmdi zmdi-facebook"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="google-plus" href="#" target="_blank" title="Google +">
                                                        <i class="zmdi zmdi-google-plus"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="twitter" href="#" target="_blank" title="Twitter">
                                                        <i class="zmdi zmdi-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="pinterest" href="#" target="_blank" title="Pinterest">
                                                        <i class="zmdi zmdi-pinterest"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="rss" href="#" target="_blank" title="RSS">
                                                        <i class="zmdi zmdi-rss"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .product-info -->
                            </div><!-- .modal-product -->
                        </div><!-- .modal-body -->
                    </div><!-- .modal-content -->
                </div><!-- .modal-dialog -->
            </div>
            <!-- END Modal -->
        </div> --}}
        <!-- END QUICKVIEW PRODUCT -->
    </div>

    @include('layout_client.script')
    <script src="//cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    {{-- <strong>Thông báo: </strong>{{ Session::get('msg') }}. --}}
    @if (Session::has('msg'))
    {{ Session::get('msg') }}
    @endif
    {{-- <script>
        alert('Đặt lịch thành công');

		

    </script> --}}

    <script src="//cdn.ckeditor.com/4.18.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor')
    </script>
</body>

</html>