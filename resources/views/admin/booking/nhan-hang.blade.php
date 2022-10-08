@extends('admin.layouts.main')
{{-- @section('title','Phiếu giữ máy') --}}
@section('content')
<div class="mx-auto container border">

    <h3 class="text-center" style=" cx"><b>PHIẾU GIỮ MÁY</b></h3>
    <h5 class="text-center"><i>Mã phiếu: <b>{{ $booking_detail->code }}</i></b></h5>
    <label for=""><br><b>Ngày đặt:</b>{{
        $booking_detail->created_at }}</label>
    <div class="form-group">
        <label for="">Ngày đem máy đến : {{ now(7) }}</label>

    </div>
    <form class="row" target="_blank" action="{{ route('phieu-nhan-may', ['booking_detail_id'=>$booking_detail->id]) }}"
        method="POST">
        @csrf

        <div class="form-group col-4">
            <label for="">Họ tên khách hàng</label>
            <input type="text" class="form-control" name="full_name" value="{{$booking_detail->booking->full_name}}"
                placeholder="Họ tên ...">
            {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
        </div>
        <div class="form-group col-4">
            <label for="">Số điện thoại</label>
            <input type="text" class="form-control" type="text" name="phone" value="{{$booking_detail->booking->phone}}"
                placeholder="Số điện thoại ...">
            {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
        </div>
        <div class="form-group col-4">
            <label for="">Tên máy</label>
            <input class="form-control" type="text" name="name_car" value="{{ $booking_detail->name_car }}">
            {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Hãng máy tính</label>

                <select class="form-control" name="company_car_id" id="">
                    @foreach ($cars as $item)
                    <option @if ($item->id==$booking_detail->company_car_id)
                        selected
                        @endif value="{{ $item->id }}">{{ $item->company_name }} </option>
                    @endforeach


                </select>
            </div>
        </div>
        <div class="form-group">

            {{-- <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder=""> --}}
            {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
        </div>




        <div class="form-group">
            <label for="">Ghi chú</label>
            <textarea class="form-control" name="comment" id="ckeditor1"
                rows="3">{{ $booking_detail->comment }}</textarea>
        </div>
        {{--
        <b>SDT:</b> <input class="form-control" type="text" name="phone" value="{{$booking_detail->booking->phone}}">
        <br>
        <b>Tên máy:</b> <input class="form-control" type="text" name="name_computer"
            value="{{ $booking_detail->name_computer }}">
        <br><b>Ngày đặt:</b>{{
        date($booking_detail->created_at) }}
        <br>
        <b>Ngày đem máy đến:</b> {{ now(7) }} <br>
        <b>Tình trạng máy hiện tại:</b> <textarea class="form-control" name="comment" id="" cols="50"
            rows="5"> </textarea> --}}
        {{-- <input type="submit" placeholder="Xuất Phiếu"> --}}
        <div class="mx-auto container ">
            <button type="submit" class="btn btn-success " name="btn" value="luu_xuat">Lưu và xuất phiếu</button>
            <button type="submit" name="btn" id="" class="btn btn-primary " value="luu"> Lưu thông tin</button>
            {{-- <a name="" id="" class="btn btn-info" href="#" role="button">Xuất phiếu</a> --}}
        </div>

    </form>


    {{--
    <div>
        <form action="{{ route('phieu-nhan-may', ['booking_detail_id'=>$booking_detail->id]) }}" method="POST">
            @csrf

            <h2 class="mx-auto">Phiếu tiếp nhận máy</h2>


        </form>
    </div> --}}

</div>
<script src="{{ asset('ckeditor') }}/ckeditor.js"></script>

<script>
    ClassicEditor
.create( document.querySelector( '#editor1' ), {
ckfinder: {
uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
},
toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
} )
.catch( error => {
console.error( error );
} );
</script>

<script>
    CKEDITOR.replace( 'ckeditor1', {
filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
} );
// var editor = CKEDITOR.replace( 'ckeditor1' );
// CKFinder.setupCKEditor( editor, null, { type: 'Files', currentFolder: '/archive/' } );
</script>
@endsection