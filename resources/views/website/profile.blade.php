<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang cá nhân</title>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .nav-pills .nav-link.active {
        background-color: #f8f9fa !important;
        color: #ff7f00 !important;
        background-color: #fff !important;
    }

    .nav-pills .nav-link {
        background-color: #f8f9fa !important;
    }

    .shadow {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
    }

    .profile-tab-nav {
        min-width: 250px;
    }

    a:hover {
        color: #ff7f00 !important;
    }

    .tab-content {
        flex: 1;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .nav-pills a.nav-link {
        padding: 15px 20px;
        border-bottom: 1px solid #ddd;
        border-radius: 0;
        background-color: #fff !important;
    }

    .nav-pills a.nav-link i {
        width: 20px;
    }

    .img-circle img {
        height: 100px;
        width: 100px;
        border-radius: 100%;
        border: 5px solid #fff;
    }

    .form-control:focus {
        border-color: #ff7f00 !important;
        outline: none !important;
        box-shadow: none !important;
    }
    </style>
    @include('layout_client.style')
</head>

<body>
    @include('layout_client.menu')

    <div class="container">

    </div>

    <div class="breadcrumbs-section plr-200 mb-80 section">
        <div class="breadcrumbs overlay-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumbs-inner">
                            <h1 class="breadcrumbs-title">Tài Khoản Của Tôi</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg d-block d-sm-flex mt-80">
            <div class="profile-tab-nav border-right">
                <div class="p-4 text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="img-circle text-center mb-3 photo-img rounded-circle" id="image_user"
                            style="background-size: 150px 150px;width: 150px;height: 150px;background-image:url('{{ asset($user->avatar) }}');">
                        </div>
                    </div>
                    <h4 class="text-center td-title-2 mt-20">{{ $user->name }}</h4>
                </div>
                <div class="nav flex-column nav-pills td-title-1" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <a class="nav-link active td-title-1" id="account-tab" data-toggle="pill" href="#account" role="tab"
                        aria-controls="account" aria-selected="true">
                        <i class="fa fa-user text-center mr-1"></i>
                        Tài khoản
                    </a>
                    <a class="nav-link td-title-1" id="password-tab" data-toggle="pill" href="#password" role="tab"
                        aria-controls="password" aria-selected="false">
                        <i class="fa fa-key text-center mr-1"></i>
                        Mật khẩu
                    </a>
                    <a class="nav-link td-title-1" id="security-tab" data-toggle="pill" href="#security" role="tab"
                        aria-controls="security" aria-selected="false">
                        <i class="fa fa-money text-center mr-1"></i>
                        Lịch sử mua hàng
                    </a>
                </div>
            </div>
            <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <h3 class="widget-title border-left mb-20">Cài đặt tài khoản</h3>
                    <form class="form" enctype="multipart/form-data" action="{{ URL::to('/profile/update-info') }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="td-title-2">Họ và tên</label>
                                    <input type="text" class="form-control p-0 m-0" name="name"
                                        value="{{ $user->name }}">
                                    @error('name')
                                    <p class="text-danger p-0 m-0">{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="td-title-2">Số điện thoại</label>
                                    <input type="text" disabled class="form-control p-0 m-0" name="phone"
                                        value="{{ $user->phone }}">
                                    <small class="text-danger">Hiện tại chưa cho phép đổi số điện thoại, vui lòng
                                        liên
                                        hệ 0866491101 để được hỗ trợ</small>
                                    @error('phone')
                                    <p class="text-danger p-0 m-0">{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="td-title-2">Ảnh đại diện: </label>
                                    @error('avatar')
                                    <p class="text-danger p-0 m-0">{{ $message }}
                                    </p>
                                    @enderror
                                    <input type="file" onchange="doAfterSelectImage(this)" id="firstimg" name="avatar">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="td-title-2">Email</label>
                                    <input type="text" @if ($user->email == 'admin@gmail.com') disabled @endif
                                    class="form-control p-0 m-0"
                                    @if ($user->email != 'admin@gmail.com') name="email" @endif
                                    value="{{ $user->email }}">
                                    @if ($user->email == 'admin@gmail.com')
                                    <small class="text-danger">Tài khoản admin không được thay đổi email</small>
                                    @endif
                                    <input type="hidden" @if ($user->email == 'admin@gmail.com') @endif
                                    class="form-control p-0 m-0"
                                    @if ($user->email == 'admin@gmail.com') name="email" @endif
                                    value="{{ $user->email }}">
                                    @error('email')
                                    <p class="text-danger p-0 m-0">{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="td-title-2">Địa chỉ</label>
                                    <input type="text" class="form-control p-0 m-0" name="address"
                                        value="{{ $user->address }}">
                                    @error('address')
                                    <p class="text-danger p-0 m-0">{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="td-title-2">Mô tả</label>
                                    <textarea class="custom-textarea px-0" name="description" id="" cols="10"
                                        rows="3">{{ $user->description }}</textarea>
                                </div>
                            </div>

                        </div>
                        <div>
                            <button class="submit-btn-1 mt-20 btn-hover-1">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                    <h3 class="widget-title border-left mb-20">Đổi mật khẩu</h3>
                    <form class="form" enctype="multipart/form-data" action="{{ URL::to('/profile/update-password') }}"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="td-title-2">Mật khẩu cũ</label>
                                    <input type="password" name="current_password"
                                        class="form-control p-0 m-0 upassword    ">
                                    @error('current_password')
                                    <p class="text-danger p-0 m-0">{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="td-title-2">Mật khẩu mới</label>
                                    <input type="password" name="password" class="form-control p-0 m-0 upassword">
                                    @error('password')
                                    <p class="text-danger p-0 m-0">{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="td-title-2">Nhập lại mật khẩu mới</label>
                                    <input type="password" name="confirm_password"
                                        class="form-control p-0 m-0 upassword">
                                    @error('confirm_password')
                                    <p class="text-danger p-0 m-0">{{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <input type="checkbox" id="show-password">
                                <small for="show-password">Hiện mật khẩu</small>
                            </div>
                        </div>
                        <div>
                            <button class="submit-btn-1 mt-20 btn-hover-1">Đổi mật khẩu</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                    <h3 class="widget-title border-left mb-20">Lịch sử mua hàng</h3>

                    @if ($bill->toArray() == [])
                    <div class="text-center">
                        <h3>hiện tại bạn chưa có đơn hàng nào.</h3>
                        <a href="{{ asset('') }}cua-hang">
                            <b>Đặt hàng ngay</b>
                        </a>
                    </div>
                    @else
                    <table class="table">
                        <thead>
                            <th>Mã hóa đơn</th>
                            <th>Tổng tiền</th>
                            <th>Thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                            <th>
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($bill as $item)
                            <tr class="">
                                <td class="align-middle">{{ $item->code }}</td>
                                <td class="align-middle">
                                    <?php
                                            if (!function_exists('currency_format')) {
                                                function currency_format($cont, $suffix = ' VNĐ')
                                                {
                                                    if (!empty($cont)) {
                                                        return number_format($cont, 0, ',', '.') . "{$suffix}";
                                                    }
                                                }
                                            }
                                            ?>
                                    {{ currency_format($item->total_price) }}
                                </td>
                                <td class="align-middle">
                                    {{ $item->method == 1 ? 'Tiền mặt' : 'Chuyển khoản' }}</td>
                                <td class="align-middle text-center">
                                    @if($item->status == 0)
                                    <p class="text-info">Chưa thanh toán</p>

                                    @elseif($item->status == 1)
                                    <p class="text-danger">Hủy</p>
                                    @elseif($item->status == 2)
                                    <p class="text-success">Đã thanh toán</p>
                                    @elseif($item->status == 3)
                                    <p class="text-primary">Xác nhận</p>
                                    @elseif($item->status == 4)
                                    <p class="text-warning">Đang di chuyển</p>
                                    @endif
                                </td>
                                <td class="align-middle">{{ $item->created_at }}</td>
                                <td class="align-middle">
                                    <a data-bs-toggle="collapse" data-bs-target="#collapseFour{{ $item->id }}"
                                        aria-expanded="false" aria-controls="collapseFour{{ $item->id }}">

                                        <button class="py-1 px-2 submit-btn-1 btn-hover-1">Chi tiết</button>
                                    </a>
                                </td>
                            </tr>
                            <td colspan="12" class="p-0 border-0">
                                <div id="collapseFour{{ $item->id }}" class="collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#accordion">
                                    <div class="card mb-3">
                                        <h5 class="card-header">Thông tin người nhận</h5>
                                        <div class="card-body">

                                            @foreach ($bill_user as $bill_u)
                                            @if ($bill_u->bill_code == $item->code)
                                            <dl class="row mb-0">
                                                <dt class="col-sm-3">Họ và tên:</dt>
                                                <dd class="col-sm-9">{{ $bill_u->name }}
                                                </dd>

                                                <dt class="col-sm-3">Số điện thoại:</dt>
                                                <dd class="col-sm-9">
                                                    {{ $bill_u->phone }}

                                                </dd>

                                                <dt class="col-sm-3">Email</dt>
                                                <dd class="col-sm-9">{{ $bill_u->email }}
                                                </dd>

                                                <dt class="col-sm-3">Địa chỉ</dt>
                                                <dd class="col-sm-9">{{ $bill_u->address }}
                                                </dd>

                                                <dt class="col-sm-3">Ghi chú</dt>
                                                <dd class="col-sm-9">
                                                    <textarea class="p-0" name="" id="" disabled cols="10"
                                                        rows="2">{{ $bill_u->note }}</textarea>
                                                </dd>
                                            </dl>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card">
                                        <h5 class="card-header">Thông tin sản phẩm</h5>
                                        <div class="card-body">
                                            @foreach ($bill_detail as $bill_d)
                                            @if ($bill_d->bill_code == $item->code)
                                            <dl class="row">
                                                <dt class="col-sm-3">
                                                    @foreach ($img_product as $img)
                                                    @if ($img->product_id == $bill_d->product->id)
                                                    <img width="120px" src="{{ asset($img->path) }}"
                                                        alt="{{ asset($img->path) }}">
                                                    @break;
                                                    @endif
                                                    @endforeach
                                                </dt>
                                                <dd class="col-sm-9 pt-5">
                                                    <p> Tên sản phẩm: {{ $bill_d->product->name }} </p>
                                                    <p>Giá: {{ currency_format($bill_d->ban) }}</p>
                                                    <p>Số lượng x {{ $bill_d->quaty }} </p>
                                                </dd>
                                            </dl>
                                            <hr class="m-0">
                                            @endif
                                            @endforeach
                                            <h5 class="card-header order-total-price text-start">Tổng:
                                                {{ currency_format($item->total_price) }}</h5>

                                        </div>
                                    </div>
                                </div>
                                @endforeach

                        </tbody>

                    </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>


    @include('layout_client.footer')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    @include('layout_client.script')


</body>
<script>
function doAfterSelectImage(input) {
    readURL(input);
}

function readURL(input) {
    if (input.files) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#image_user').css('background-image', 'url(' + e.target.result + ')');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</html>