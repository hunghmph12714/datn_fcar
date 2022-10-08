@extends('admin.layouts.main')
@section('title', 'Sửa sản phẩm')
@section('content')


<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="row ml-2">
            <div class="col-6 mt-2">
                <div class="form-group">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="name" id="slug" onkeyup="ChangeToSlug()" class="form-control" value="{{$pro->name}}"
                        placeholder="Tên sản phẩm">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Slug</label>
                    <input type="text" name="slug" id="convert_slug" class="form-control" value="{{$pro->slug}}"
                        placeholder="">
                    @error('slug')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select name="companyComputer_id" class="form-control">
                        <option value="">Chọn CompanyComputer</option>
                        @foreach ($ComputerCompany as $item)
                        <option @if($pro->companyComputer_id == $item->id) selected @endif
                            value="{{ $item->id }}">{{ $item->company_name }}</option>
                        @endforeach
                    </select>
                    @error('companyComputer_id')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="mt-1 text-center">
                        <div class="preview-image">
                            @foreach($images as $image)
                            <img src="{{ asset($image->path) }}" class="imgpre" alt="{{ asset($image->path) }}">
                            @endforeach
                        </div>
                    </div>
                    <label for="">Ảnh</label>
                    <input type="file" id="images" name="images[]" class="form-control" multiple placeholder="Chọn ảnh">
                    @error('images')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    @error('images.*')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Giá nhập</label>
                    <input type="text" name="import_price" value="{{ $pro->import_price }}" class="form-control"
                        placeholder="Giá nhập">
                    @error('import_price')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Giá bán</label>
                    <input type="text" name="price" value="{{ $pro->price }}" class="form-control"
                        placeholder="Giá bán">

                    @error('price')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <input type="hidden" name="qty" value="0">
            <div class="col-6 mt-2">

                <div class="form-group text-center mb-0">
                    <label for="">Chi tiết sản phẩm</label>
                </div>
                @error('value')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
                @error('value.*')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
                @foreach($attribute_value as $attribute)
                @if($attribute->category_id == 1)
                <div class="form-group row mb-1 pr-2">
                    <label for="" class="font-italic col-sm-2 col-form-label">CPU:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="value[]" value="{{$attribute->value}}"
                            placeholder="CPU">
                    </div>

                    @endif
                    @if($attribute->category_id == 2)
                </div>
                <div class="form-group row mb-1 pr-2">
                    <label class="font-italic col-sm-2 col-form-label">RAM:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="value[]" value="{{$attribute->value}}"
                            placeholder="RAM">

                        <!-- <input type="text" class="form-control" name="value[]" value="{{$attribute->value}}" placeholder="RAM"> -->
                    </div>
                </div>
                @endif
                @if($attribute->category_id == 3)
                <div class="form-group row mb-1 pr-2">
                    <label class="font-italic col-sm-2 col-form-label">Ổ cứng:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{$attribute->value}}" placeholder="Ổ cứng">
                        <!-- <input type="text" class="form-control" name="value[]" value="{{$attribute->value}}" placeholder="Ổ cứng"> -->
                    </div>
                </div>
                @endif
                @if($attribute->category_id == 4)
                <div class="form-group row mb-1 pr-2">
                    <label class="font-italic col-sm-2 col-form-label">Card đồ họa:</label>
                    <div class="col-sm-10">
                        <input class="form-control" value="{{$attribute->value}}" placeholder="Card đồ họa">
                        <!-- <input type="text" class="form-control" name="value[]" value="{{$attribute->value}}" placeholder="Card đồ họa"> -->
                    </div>
                </div>
                @endif
                @if($attribute->category_id == 5)
                <div class="form-group row pr-2">
                    <label class="font-italic col-sm-2 col-form-label">Màn hình:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{$attribute->value}}" placeholder="Màn hình">
                        <!-- <input type="text" class="form-control" name="value[]" value="{{$attribute->value}}" placeholder="Màn hình"> -->
                    </div>
                </div>
                @endif
                @endforeach
                <div class="form-group pt-1 pr-2">
                    <label for="">Thời gian bảo hành</label>
                    <input type="number" name="insurance" value="{{ $pro->price }}" placeholder="Thời gian bảo hành"
                        class="form-control">
                </div>
                <div class="form-group pr-2">
                    <label for="">Trạng thái</label>
                    <select name="status" id="" class="form-control">
                        <option value="">Chọn trạng thái</option>
                        <option @if($pro->status == 1) selected @endif value="1">Còn hàng</option>
                        <option @if($pro->status == 0) selected @endif value="0">Hết hàng</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-12 pr-2">
        <label for="">Mô tả đầu trang</label>
        <input name="desc_short" value="{{$pro->desc_short}}" rows="4" class="form-control"></input>
    </div>
    @error('desc_short')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    <div class="form-group col-12 pr-2">
        <label for="">Mô tả</label>
        <textarea name="desc" rows="4" id="ckeditor1" class="form-control">{!! $pro->desc !!}</textarea>
    </div>
    <div class="d-flex justify-content-end mb-2 ml-2">
        <br>
        <a href="{{ route('product.index') }}" class="btn btn-danger">Hủy</a>
        &nbsp;
        <button type="submit" class="btn btn-success">Lưu</button>
    </div>
    </div>
    </div>
</form>
<script src="{{asset('ckeditor')}}/ckeditor.js"></script>
<script type="text/javascript">
CKEDITOR.replace('ckeditor1');
</script>
<script>
$(function() {
    // Multiple images preview with JavaScript
    let multiImgPreview = function(input, imgPreviewPlaceholder) {

        let filesAmount = input.files.length;
        if (filesAmount > 0) {
            $('#images').on('change', function() {
                $('img.imgpre').remove();
            });
        }

        for (i = 0; i < filesAmount; i++) {
            let reader = new FileReader();
            reader.onload = function() {
                $($.parseHTML('<img>')).attr('src', reader.result).attr('class', 'imgpre').appendTo(
                    imgPreviewPlaceholder);
            }
            reader.readAsDataURL(input.files[i]);
        }
    };
    $('#images').on('change', function() {
        multiImgPreview(this, 'div.preview-image');
    });
});
</script>
<script type="text/javascript">
 
 function ChangeToSlug()
	 {
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

@endsection