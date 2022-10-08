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
    @if (Session::has('msg'))
    {!! Session::get('msg') !!}.
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
                                <h1 class="breadcrumbs-title text-success">Đặt Lịch Thành Công !</h1>
                                <div class="row " style="word-wrap: break-word">
                                    <div class="col-lg-6">
                                        <h3><b>Họ và Tên:</b> {{ $request->full_name }}</h3>
                                        <h3><b>Email:</b> {{ $request->email }}
                                        </h3>
                                        {{-- <h3><b>Địa Chỉ:</b> Thôn 9 Cát Quế - Hoài Đức - Hà Nội --}}
                                        </h3>
                                        <h3><b>Số điện thoại:</b>
                                            {{ $request->phone }}</h3>

                                    </div>

                                    {{-- <div>Tên máy: {{ $booking_detail->name_car }}</div> --}}
                                    <div class="col-lg-6">
                                        <h3><b>Tên máy:</b>
                                            {{ $booking_detail->name_car }}</h3>
                                        <h3><b>Hãng máy:</b>
                                            {{ $booking_detail->carCompany->company_name }}</h3>
                                        <h3><b>Khung giờ sửa:</b>
                                            {{ $details['interval'] }}

                                        </h3>
                                        <h3><b>Ngày sửa:</b>
                                            {{ $request->date }}</h3>

                                    </div>
                                    <div class="col">
                                        <h3><b>Mô tả:</b>
                                            <br>
                                            {!! $request->description !!}
                                        </h3>
                                    </div>
                                </div>
                                <hr>
                                <h1 class="text-center"><a href="{{ asset('') }}dat-lich" class="button extra-small ">
                                        <span class="text-uppercase">Xong</span>
                                    </a></h1>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMBS SETCTION END -->

        <!-- START FOOTER AREA -->
        @include('layout_client.footer')
        <!-- END FOOTER AREA -->

    </div>

    @include('layout_client.script')
    <script src="//cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    {{-- <strong>Thông báo: </strong>{{ Session::get('msg') }}. --}}
    @if (Session::has('msg'))
    {{ Session::get('msg') }}.
    @endif
    {{-- <script>
        alert('Đặt lịch thành công');

		

    </script> --}}
</body>

</html>