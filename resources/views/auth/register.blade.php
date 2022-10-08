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
@include('layout_client.menu')
<h1 style="padding: 0 0 25px;" class="breadcrumbs-title">Đăng ký</h1>
<div class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6  pb-5">
                <div class="new-customers">
                    @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                    @endif
                    <form method="POST" action="{{route('register')}}">
                        @csrf
                        <div class="login-account p-30 box-shadow">
                            <p>Bạn đã có tài khoản? <a href="/login"> Nhấp vào đây để đăng nhập!</a></p>
                            <input type="text" class="@error('name') is-invalid @enderror mb-0 mt-4"
                                value="{{ old('name') }}" name="name" placeholder="Họ và tên*">
                            @error('name')
                            <span class="invalid-feedback pb-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="text" class="@error('email') is-invalid @enderror mb-0 mt-4"
                                value="{{ old('email') }}" name="email" placeholder="abc@email.com*">
                            @error('email')
                            <span class="invalid-feedback pb-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="text" class="@error('phone') is-invalid @enderror mb-0 mt-4"
                                value="{{ old('phone') }}" name="phone" placeholder="Số điện thoại*">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="password" upassword name="password" placeholder="Mật khẩu*"
                                class="mb-0 mt-4 upassword">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu*"
                                class="mb-0 mt-4 upassword">
                            <div class="row">
                                <div class="d-inline">
                                    <input type="checkbox" id="show-password">
                                    <small for="show-password">Hiện mật khẩu</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="submit-btn-1 mt-20 btn-hover-1" type="submit" value="register">Đăng
                                        ký</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout_client.script')
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>

</body>

</html>