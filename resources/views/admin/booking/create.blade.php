@extends('admin.layouts.main')
{{-- @section('title','Thêm lịch sửa chữa') --}}
@section('content')
<script src="ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>

<script src="ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>
<h2 class="text-center mb-4 fw-bolder"><b>THÊM LỊCH SỬA CHỮA</b></h2>
<form action="" class="row container mx-auto" id="form_create" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="col-6 gird border">
    <div class="col-6 ">
      <label for="">Họ Tên</label>
      <input type="text" class="form-control " value="{{ old('full_name') }}" name="full_name" id=""
        aria-describedby="helpId" placeholder="">
      @error('full_name')
      <small id="helpId" class="form-text text-danger">{{ $message }}</small>
      @enderror</small>
    </div>
    <div class="col-6">
      <label for="">Số điện thoại</label>
      <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" id="" aria-describedby="helpId"
        placeholder="">
      @error('phone')
      <small id="helpId" class="form-text text-danger">{{ $message }}</small>
      @enderror</small>
    </div>
    <div class="col-6">
      <label for="">Email</label>
      <input type="text" class="form-control " value="{{ old('email') }}" name="email" id="" aria-describedby="helpId"
        placeholder="">
      @error('email')
      <small id="helpId" class="form-text text-danger">{{ $message }}</small>
      @enderror</small>
    </div>

    <div class="col-6">
      <label for="">Ngày sửa</label>
      <input type="date" min="{{ now(7)->format('Y-m-d') }}" class="form-control" name="date" value="{{ old('date') }}"
        id="" aria-describedby="helpId" placeholder="">
      @error('date')
      <small id="helpId" class="form-text text-danger">{{ $message }}</small>
      @enderror</small>
    </div>

    {{-- <div class="col-4">
      <label for="">Nơi sửa chữa</label> <br>

      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="repair_type" checked id="" value="CH"> Cửa hàng
        </label>
        <label class="form-check-label">
          <input class="form-check-input" type="radio" name="repair_type" value="TN"> Tại nhà
        </label>

      </div>
      @error('repair_type')
      <small id="helpId" class="form-text text-danger">{{ $message }}</small>
      @enderror</small>
    </div> --}}
    <div class="col-6">
      <div class="form-group">
        <label for="">Thời gian</label>
        <select class="form-control" name="interval" id="">
          <option value="1">8h-10h</option>
          <option value="2">10h-12h</option>
          <option value="3">12h-14h</option>
          <option value="4">14h-16h</option>
          <option value="5">16h-18h</option>
          <option value="6">18h-20h</option>


        </select>
      </div>
    </div>
  </div>
  <div class=" border border-success col-6" id="form_may">
    <h3 class="text-center fw-bold"><b>THÔNG TIN MÁY</b></h3>
    <div class="row">
      {{-- <h5 class="mx-auto">Máy 1</h5> --}}
      <div class="form-group col-6">
        <label for="">Tên máy tính</label>
        <input type="text" class="form-control" value="{{ old('name_car') }}" name="name_car" id=""
          aria-describedby="" placeholder="">
        @error('name_car')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror</small>
      </div>
      <div class="form-group col-6">
        <label for="">Loại máy tính</label>

        <select class="form-control" name="company_car_id" id="">
          @foreach ($cars as $item)
          <option value="{{ $item->id }}">{{ $item->company_name }}</option>
          @endforeach


        </select>
      </div>
      <div class="form-group col-12">
        <label for="">Mô tả</label>
        <textarea class="form-control" name="description" id="ckeditor1" rows="3"></textarea>
      </div>
    </div>

  </div>
  {{-- <button onclick="AddForm()" type="button" id="btn_themmay">Thêm máy</button> --}}
  <button class="btn btn-success mx-auto container " name="btn" id="" form="form_create" value="admin"
    type="submit">Thêm
    máy
  </button>

</form>



{{-- <div class="row border border-success" style="display: none" id="form_mayadd">

  <div class="col-4">
    <h5 class="mx-auto">Máy 1</h5>
    <div class="form-group">
      <label for="">Tên máy tính</label>
      <input type="text" class="form-control" name="name_computer" id="" aria-describedby="" placeholder="">
      <small id="" class="form-text text-muted">Help text</small>
    </div>
    <div class="form-group">
      <label for="">Loại máy tính</label>

      <select class="form-control" name="computer_company_id" id="">
        @foreach ($computers as $item)
        <option value="{{ $item->id }}">{{ $item->company_name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group col-4">
    <label for="">Mô tả</label>
    <textarea class="form-control" name="description" id="ckeditor1" rows="3"></textarea>
  </div>
</div> --}}
{{-- <script src="{{asset('ckeditor')}}/ckeditor.js"></script> --}}
<script src="{{asset('ckeditor')}}/ckeditor.js"></script>

<script type="text/javascript">
  CKEDITOR.replace('ckeditor');
  CKEDITOR.replace('ckeditor1');

</script>{{--
<script>
  function AddForm(){
  form_may=document.getElementById('form_may');
  form_mayadd=document.getElementById('form_mayadd');
  form_mayadd.style="display: block";
  form_may.innerHTMT+=form_mayadd.innerHTMT;


}

</script> --}}

@endsection