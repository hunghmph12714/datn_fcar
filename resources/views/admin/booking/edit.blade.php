{{-- @extends('admin.layouts.main')
@section('content')
<form action="" class="row-8" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="col-4">
    <label for="">Họ Tên</label>
    <input type="text" class="form-control " value="{{ $booking_detail->booking->full_name}}" name="full_name" id=""
      aria-describedby="helpId" placeholder="">
    @error('full_name')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror</small>
  </div>
  <div class="col-4">
    <label for="">SDT</label>
    <input type="text" class="form-control" name="phone" value="{{ $booking_detail->booking->phone}}" id=""
      aria-describedby="helpId" placeholder="">
    @error('phone')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror</small>
  </div>
  <div class="col-4">
    <div class="form-group">
      <label for="">Loại máy tính</label>

      <select class="form-control" name="company_computer_id" id="">
        @foreach ($computers as $item)
        <option @if ($item->id==$booking_detail->company_computer_id)
          selected
          @endif value="{{ $item->id }}">{{ $item->company_name }}</option>
        @endforeach


      </select>
    </div>
  </div>
  <div class="col-4">
    <label for="">Hinh thuc</label> <br>

    <div class="form-check form-check-inline">
      <label class="form-check-label">
        <input class="form-check-input" type="radio" name="repair_type" @if ($booking_detail->repair_type=='CH')
        checked
        @endif checked id="" value="CH"> Cửa hàng
      </label>
      <label class="form-check-label">
        <input class="form-check-input" type="radio" name="repair_type" @if ($booking_detail->repair_type=='TN')
        checked
        @endif value="TN"> Tại nhà
      </label>

    </div>
    @error('repair_type')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror</small>
  </div>
  <div class="col-4">
    <div class="form-group">
      <label for="">Thời gian</label>
      <select class="form-control" name="interval" id="">
        <option @if ($booking_detail->booking->interval ==1)
          selected
          @endif
          value="1">8h-10h</option>
        <option @if ($booking_detail->booking->interval ==2)
          selected
          @endif value="2">10h-12h</option>
        <option @if ($booking_detail->booking->interval ==3)
          selected
          @endif value="3">12h-14h</option>
        <option @if ($booking_detail->booking->interval ==4)
          selected
          @endif value="4">14h-16h</option>
        <option @if ($booking_detail->booking->interval ==5)
          selected
          @endif value="5">16h-18h</option>
        <option @if ($booking_detail->booking->interval ==6)
          selected
          @endif value="6">18h-20h</option>


      </select>
    </div>
  </div>
  <div class="">

    <div class="form-group">
      <label for="">Mô tả</label>
      <textarea class="form-control" name="description" id="ckeditor1"
        rows="3">{{ $booking_detail->description }}</textarea>
    </div>
  </div>
  <input name="" id="" class="btn btn-success" type="submit" value="Lưu  ">

</form>
<script src="{{asset('ckeditor')}}/ckeditor.js"></script>
<script type="text/javascript">
  CKEDITOR.replace('ckeditor');
  CKEDITOR.replace('ckeditor1');

</script>
@endsection --}}


@extends('admin.layouts.main')
@section('content')<script src="ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>

<script src="ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>
<h2><b>SỬA THÔNG TIN</b></h2>
<form action="" class="row" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="col-6">
    <div class="col-3">
      <label for="">Họ Tên</label>
      <input type="text" class="form-control " value="{{ $booking_detail->booking->full_name}}" name="full_name" id=""
        aria-describedby="helpId" placeholder="">
      @error('full_name')
      <small id="helpId" class="form-text text-danger">{{ $message }}</small>
      @enderror</small>
    </div>
    <div class="col-3">
      <label for="">Số điện thoại</label>
      <input type="text" class="form-control" name="phone" value="{{ $booking_detail->booking->phone}}" id=""
        aria-describedby="helpId" placeholder="">
      @error('phone')
      <small id="helpId" class="form-text text-danger">{{ $message }}</small>
      @enderror</small>
    </div>
    <label for="">Email</label>
    <input type="text" class="form-control " value="{{ $booking_detail->booking->email }}" name="email" id=""
      aria-describedby="helpId" placeholder="">
    @error('email')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror</small>
    {{--
  </div>



  <div class="col-4"> --}}
    <div class="form-group">
      <label for="">Thời gian</label>
      <select class="form-control" name="interval" id="">
        <option @if ($booking_detail->booking->interval ==1)
          selected
          @endif
          value="1">8h-10h</option>
        <option @if ($booking_detail->booking->interval ==2)
          selected
          @endif value="2">10h-12h</option>
        <option @if ($booking_detail->booking->interval ==3)
          selected
          @endif value="3">12h-14h</option>
        <option @if ($booking_detail->booking->interval ==4)
          selected
          @endif value="4">14h-16h</option>
        <option @if ($booking_detail->booking->interval ==5)
          selected
          @endif value="5">16h-18h</option>
        <option @if ($booking_detail->booking->interval ==6)
          selected
          @endif value="6">18h-20h</option>


      </select>
    </div>
  </div>

  <div class="col-6" id="form_may">

    <div class="row">
      {{-- <h5 class="mx-auto">Máy 1</h5> --}}
      <div class="form-group col">
        <label for="">Tên máy tính</label>
        <input type="text" class="form-control" name="name_car" value="{{ $booking_detail->name_car }}" id=""
          aria-describedby="" placeholder="">
        {{-- <small id="" class="form-text text-muted">Help text</small> --}}
      </div>
      <div class="col">
        <div class="form-group">
          <label for="">Hãng máy tính</label>

          <select class="form-control" name="company_car_id" id="">
            @foreach ($cars as $item)
            <option @if ($item->id==$booking_detail->company_car_id)
              selected
              @endif value="{{ $item->id }}">{{ $item->company_name }}</option>
            @endforeach


          </select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="">Mô tả</label>
      <textarea class="form-control" name="description" id="ckeditor1"
        rows="3">{{ $booking_detail->description }}</textarea>
    </div>
  </div>
  {{-- <button onclick="AddForm()" type="button" id="btn_themmay">Thêm máy</button> --}}
  <input name="" id="" class="btn btn-primary" type="submit" value="Lưu  ">

</form>


{{-- <div class="row border border-success" style="display: none" id="form_mayadd">
  <div class="col-4">
    <h5 class="mx-auto">Máy 1</h5>
    <div class="form-group">
      <label for="">Tên máy tính</label>
      <input type="text" class="form-control" name="name_computer" id="" aria-describedby="" placeholder="">
      <small id="" class="form-text text-muted">Help text</small>
    </div>
    <div class="col-4">
      <div class="form-group">
        <label for="">Loại máy tính</label>

        <select class="form-control" name="company_computer_id" id="">
          @foreach ($computers as $item)
          <option @if ($item->id==$booking_detail->company_computer_id)
            selected
            @endif value="{{ $item->id }}">{{ $item->company_name }}</option>
          @endforeach


        </select>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="">Mô tả</label>
    <textarea class="form-control" name="description" id="ckeditor1"
      rows="3">{{ $booking_detail->description }}</textarea>
  </div>
</div> --}}
<script src="//cdn.ckeditor.com/4.18.0/basic/ckeditor.js"></script>

{{-- <script src="{{asset('ckeditor')}}/ckeditor.js">
</script> --}}

<script type="text/javascript">
  CKEDITOR.replace('ckeditor');
  CKEDITOR.replace('ckeditor1');

</script>
{{-- <script>
  function AddForm(){
  form_may=document.getElementById('form_may');
  form_mayadd=document.getElementById('form_mayadd');
  form_mayadd.style="display: block";
  form_may.innerHTMT+=form_mayadd.innerHTMT;
  form_mayadd.style="display: none";


}

</script> --}}

@endsection