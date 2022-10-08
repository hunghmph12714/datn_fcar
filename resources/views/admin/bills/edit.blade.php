@extends('admin.layouts.main')
@section('title', 'Sửa hóa đơn')
@section('content')

<form method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 style="float: none !important;" class="card-title text-bold text-center">Thông tin người mua
                    </h4>
                    <hr>
                    <div class="form-group">
                        <label for="">Họ và tên</label>
                        <input type="text" name="name" value="{{ $bill_user->name }}" class="form-control"
                            placeholder="">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" value="{{ $bill_user->email }}" class="form-control"
                            placeholder="">
                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" name="phone" value="{{ $bill_user->phone }}" class="form-control"
                            placeholder="">
                        @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" name="address" value="{{ $bill_user->address }}" class="form-control"
                            placeholder="">
                        @error('address')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>



                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 style="float: none !important;" class="card-title text-bold text-center">Thông tin hóa đơn</h4>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Mã hóa đơn</label>
                                <input disabled type="text" name="code" value="{{ $bill->code }}" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <?php
if (!function_exists('currency_format')) {
    function currency_format($item, $suffix = ' VNĐ')
    {
        if (!empty($item)) {
            return number_format($item, 0, ',', '.') . "{$suffix}";
        }
    }
}
?>
                                <div class="form-group">
                                    <label for="">Tổng tiền</label>
                                    <input type="number" name="total_price" value="{{ $bill->total_price }}"
                                        class="form-control" placeholder="">
                                    @error('total_price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">

                            <label for="">Thanh toán bằng</label>
                            <select @if($bill->status == 2 || $bill->status == 1) disabled @endif
                                name="method" class="form-control">


                                <option @if($bill->method == 2) selected @endif value="2">Chuyển khoản</option>
                                <option @if($bill->method == 1) selected @endif value="1">Tiền mặt</option>

                            </select>
                            @error('method')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <select name="status" @if($bill->status == 2 || $bill->status == 1) disabled @endif
                                    class="form-control">
                                    @if($bill->status == 0)
                                    <option @if($bill->status == 0) selected @endif value="0">Chưa thanh toán</option>
                                    @endif
                                    @if($bill->status == 3 || $bill->status == 0)
                                    <option @if($bill->status == 3) selected @endif value="3">Xác nhận</option>
                                    @endif
                                    @if($bill->status == 0 || $bill->status == 3 || $bill->status == 4)
                                    <option @if($bill->status == 4) selected @endif value="4">Đang di chuyển</option>
                                    @endif
                                    <option @if($bill->status == 2) selected @endif value="2">Thanh toán thành công
                                    </option>
                                    <option @if($bill->status == 1) selected @endif value="1">Hủy</option>

                                </select>
                                @error('status')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                    </div>
                    <div class="form-group">
                        <label for="">Ghi chú</label>
                        <textarea class="form-control" name="note" rows="1" id="">{{$bill_user->note}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày tạo</label>
                        <input type="text" name="" disabled value="{{ $bill->created_at }}" class="form-control"
                            placeholder="">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group mb-0 pb-0 text-center">
        <label class="mb-0 pb-0 text-center" for="">Sản phẩm đã mua</label>
    </div>
    <!-- <div class="row" style="height: 30px;">
            <div class="col-7 mb-0 pb-0">
                <label class="mb-0 pb-0" for="">Tên sản phẩm</label>
            </div>
            <div class="col-2 mb-0 pb-0">
                <div class="form-group">
                    <label class="mb-0 pb-0" for="">Giá</label>
                </div>
            </div>
            <div class="col-2 mb-0 pb-0">
                <div class="form-group">
                    <label class="mb-0 pb-0" for="">Số lượng</label>
                </div>
            </div>
            <div class="col-1 mb-0 pb-0 pt-4 mt-1">
                <div class="form-group">
                    <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Thêm</button>
                </div>
            </div>
        </div> -->

    <table class="table table-bordered" id="dynamicAddRemove">
        <tr>
            <th class="p-0">
                <p class="text-center ms-auto mb-0 p-2">Tên sản phẩm</p>
            </th>
            <th class="p-0">
                <p class="text-center ms-auto mb-0 p-2">Giá</p>
            </th>
            <th class="p-0">
                <p class="text-center ms-auto mb-0 p-2">Số lượng</p>
            </th>
            <th class="p-0">
                <!-- <button type="button ms-auto" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Subject</button> -->
            </th>
        </tr>
        @foreach($bill_detail as $bill_d)
        <tr>
            <td><select disabled name="product_id" class="form-control">
                    @foreach ($prod as $pro)
                    <option @if ($pro->id == $bill_d->product_id) selected @endif value="{{ $pro->id }}">
                        {{ $pro->name }}</option>
                    @endforeach
                    <!-- <option value="{{$bill_d->product->id}}">{{$bill_d->product->name}}</option> -->
                </select></td>
            <!-- <td><input disabled type="text" value="{{$bill_d->product->name}}" name="addMoreInputFields[0][subject]"
                        placeholder="Tên sản phẩm" class="form-control" />
                </td> -->
            <td><input disabled type="text" value="{{currency_format($bill_d->ban)}}"
                    name="addMoreInputFields[0][subject]" placeholder="Nhập giá" class="form-control" /></td>
            <td><input disabled type="text" value="{{$bill_d->quaty}}" name="addMoreInputFields[0][subject]"
                    placeholder="Số lượng" class="form-control" /></td>
            <!-- <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Thêm sản
                        phẩm</button></td> -->
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-end mb-2 mr-2">
        <br>
        <a href="{{ route('bill.index2') }}" class="btn btn-sm btn-danger mr-2">Quay lại </a>
        @if($bill->status == 4)
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-info mr-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Gửi tin nhắn
        </button>
        @endif
        <button class="btn btn-sm btn-success" type="submit">Lưu</button>
        &nbsp;
    </div>
    </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Gửi tin nhắn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('send.message') }}" method="POST">
                @csrf
                <input type="hidden" name="code" value="{{$bill->code}}">
                <input type="hidden" name="phone" value="{{$bill_user->phone}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="form-control">Tin nhắn*</label>
                            <select name="code_bill" class="form-control" id="">
                                <option value="Don hang {{$bill->code}} dang duoc don vi van chuyen:">
                                    Don hang {{$bill->code}} dang duoc van chuyen boi </option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="form-control">Đơn vị vận chuyển*</label>
                            <select class="form-control" name="ship" id="">
                                <option value="GoShip">GoShip</option>
                                <option value="Viettel Post">Viettel Post</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="form-control">Mã vận chuyển*</label>
                            <input class="form-control" name="code_ship" placeholder="Nhập mã vận chuyển" id=""></input>
                            @error('code_ship')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success">Gửi tin nhắn</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
var i = 0;
$("#dynamic-ar").click(function() {
    ++i;
    $("#dynamicAddRemove").append(
        '<tr><td><input type="text" name="addMoreInputFields[0][subject]" placeholder="Enter subject"class="form-control" /></td><td><input type="text" name="addMoreInputFields[0][subject]" placeholder="Enter subject"class="form-control" /></td><td><input type="text" name="addMoreInputFields[0][subject]" placeholder="Enter subject"class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
    );
});
$(document).on('click', '.remove-input-field', function() {
    $(this).parents('tr').remove();
});
</script>
<script>
var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function() {
    myInput.focus()
})
</script>
@endsection