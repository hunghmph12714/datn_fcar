<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liên hệ</title>
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
                                <h1 class="breadcrumbs-title">Liên Hệ</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="index.html">Trang Chủ</a></li>
                                    <li>Liên Hệ</li>
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

            <!-- ADDRESS SECTION START -->
            <div class="address-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-pin"></i>
                                <h6>Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội, Việt Nam</h6>
                              
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-phone"></i>
                                <h6><a href="tel:0967758023">0967758023</a></h6>
                            
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-address box-shadow">
                                <i class="zmdi zmdi-email"></i>
                                <h6>hungltph08107@fpt.edu.vn</h6>
                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ADDRESS SECTION END -->

            <!-- GOOGLE MAP SECTION START -->
            <div class="google-map-section">
                <div class="container-fluid">
                    <div class="google-map plr-185">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8638558814177!2d105.74459841467802!3d21.038132792834787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b991d80fd5%3A0x53cefc99d6b0bf6f!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1651974559282!5m2!1svi!2s"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
    </div>
    <!-- GOOGLE MAP SECTION END -->

    <!-- MESSAGE BOX SECTION START -->
    <div class="message-box-section mt--50 mb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="message-box box-shadow white-bg">
                        <form id="contact-form" action="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="blog-section-title border-left mb-30">Liên Hệ</h4>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="con_name" placeholder="Họ và tên">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="con_email" placeholder="Email">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="con_subject" placeholder="Địa chỉ">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="con_phone" placeholder="Số điện thoại">
                                </div>
                                <div class="col-lg-12">
                                    <textarea class="custom-textarea" name="con_message" placeholder="Nội dung"></textarea>
                                    <button class="submit-btn-1 mt-30 btn-hover-1" type="submit">Gửi Liên
                                        Hệ</button>
                                </div>
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

    </div>


</body>

@include('layout_client.script')

</html>
