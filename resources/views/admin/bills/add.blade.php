@extends('admin.layouts.main')
@section('title', 'Thêm sản phẩm')
@section('content')


    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="row ml-2">
                <div class="col-6 mt-2">
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" placeholder="">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh</label>
                        <input type="file" name="image" class="form-control" placeholder="">

                    </div>
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label for="">Giá nhập</label>
                        <input type="number" name="import_price" value="{{ old('import_price') }}" class="form-control"
                            placeholder="">

                    </div>
                    @error('import_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label for="">Giá bán</label>
                        <input type="number" name="price" value="{{ old('price') }}" class="form-control" placeholder="">

                    </div>
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" name="qty" value="0">
                <div class="col-6 mt-2">
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select name="companyComputer_id" class="form-control">
                            <option value="">Chọn CompanyCar</option>
                            @foreach ($CarCompany as $item)
                                <option value="{{ $item->id }}">{{ $item->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('companyCar_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea name="desc" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Thời gian bảo hành</label>
                        <input type="number" name="insurance" class="form-control">
                    </div>
                    @error('insurance')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input type="hidden" name="status" value="0">
                </div>
                <div class="d-flex justify-content-end mb-2 ml-2">
                    <br>
                    <a href="{{ route('product.index') }}" class="btn btn-sm btn-danger">Hủy</a>
                    &nbsp;
                    <button type="submit" class="btn btn-sm btn-success">Lưu</button>
                </div>
            </div>
        </div>
    </form>

@endsection
