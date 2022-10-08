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
                <div class="col-lg-6  pb-5">
                    <div class="registered-customers">

                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                        @endif
                        <div class="login-account p-30 box-shadow">
                            <p>Bạn chưa có tài khoản? <a href="/register"> Nhấp vào đây để đăng ký!</a></p>
                            <p>Bạn đã có tài khoản? <a href="/login"> Nhấp vào đây để đăng nhập!</a></p>

                            <form method="POST" action="{{route('forget.password.post')}}" form>
                                @csrf
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="text" name="phone" placeholder="Số điện thoại" id="slug"
                                            onkeyup="ChangeToSlug()"
                                            class="@error('phone_otp') is-invalid @enderror mb-0 mt-4"
                                            value=@if(session()->has('phone'))
                                        "{{session()->get('phone')}}"
                                        @else
                                        "{{ old('phone') }}"
                                        @endif
                                        >
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <!-- Google reCaptcha -->

                                        <!-- End Google reCaptcha -->
                                        <p><small>Nhập số điện thoại</small></p>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="submit-btn-1 btn-hover-1 mb-0 mt-4" type="submit">Gửi
                                            mã</button>
                                    </div>
                                </div>
                            </form>
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
    <script type="text/javascript">
    function ChangeToSlug() {
        var slug;
        //Lấy text từ thẻ input title
        slug = document.getElementById("slug").value;
        slug = slug.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('convert_slug').value = slug;
    }
    </script>

</body>

</html>