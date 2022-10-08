<!DOCTYPE html>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <title>Bệnh Viện Laptop 51</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <script>
    if (window.performance.navigation.type === 2) {
        location.reload();
    }
    </script>
    @include('layout_client.style')


</head>

<body>

    @include('layout_client.menu')
    <h1 style="padding: 55px 0 55px;" class="breadcrumbs-title">Đăng nhập</h1>
    <div class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 pb-5">
                    <div class="registered-customers">

                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                        @endif
                        <form method="POST" action="{{route('login')}}">
                            @csrf
                            <div class="login-account p-30 box-shadow">
                                <p>Bạn chưa có tài khoản? <a href="/register"> Nhấp vào đây để đăng ký!</a></p>
                                <input type="text" class="@error('phone') is-invalid @enderror mb-0 mt-4"
                                    value="{{ old('phone') }}" name="phone" placeholder="Số điện thoại">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input type="password" name="password" class="mb-0 mt-4 upassword"
                                    placeholder="Mật khẩu">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="row">
                                    <div class="d-inline">
                                        <input type="checkbox" id="show-password">
                                        <small for="show-password">Hiện mật khẩu</small>
                                        <small class="d-inline f-right"><a href="/forget-password">Bạn quên mật
                                                khẩu?</a></small>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <button class="submit-btn-1 btn-hover-1" type="submit">Đăng nhập</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="/login-otp" class="btn-hover-1 f-right" type="reset">Đăng nhâp bằng
                                            OTP</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    @include('layout_client.script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>

</body>

</html>