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
    <h1 style="padding: 55px 0 55px;" class="breadcrumbs-title">Quên mật khẩu</h1>
    <div class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6 pb-5">
                    <div class="registered-customers">
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                        @endif
                        @if($code_verify->status == 0)
                        <form method="POST" action="{{route('insert.password.post')}}">
                            @csrf
                            <div class="login-account p-30 box-shadow">
                                <input type="password" name="password" placeholder="Mật khẩu"
                                    class="mb-0 mt-4 upassword">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu"
                                    class="mb-0 mt-4 upassword">
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-inline">
                                        <input type="checkbox" id="show-password">
                                        <small for="show-password">Hiện mật khẩu</small>
                                        <button class="submit-btn-1 mt-20 btn-hover-1 f-right button" type="submit"
                                            value="Đổi mật khẩu">Đổi mật khẩu</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @else
                        <h5 class="text-center">Liên kết không tồn tại.<a style="color: #ff7f00;" href="/home"> nhấn vào đây </a>để quay lại trang chủ</h5>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layout_client.script')

</body>

</html>