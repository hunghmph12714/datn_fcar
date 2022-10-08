@extends('admin.layouts.main')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


    <h5 class="alert alert-info  text-center">DANH SÁCH TIN TỨC</h5>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Từ khóa</label>
                                <input type="text" class="form-control" name="keyword"
                                    value="{{ $searchData['keyword'] }}" placeholder="Tìm theo từ khóa">
                            </div>
                        </div>
                        {{-- <div class="col-6">
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="">Tất cả</option>
                                    @foreach ($status as $item)
                                        <option @if ($item->status == $searchData['status']) selected @endif
                                            value="{{ $item->status }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
            </form>
        </div>
        <table class="table table-striped">
            <thead class="thead">
                <button type="button" class="btn btn-primary"><a style="color:white;  text-decoration: none;"
                        style="text-decoration" href="{{ route('news.add') }}">Thêm mới tin tức</a></button>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tiêu Đề</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Người đăng</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">View</th>
                    <th scope="col">Created_at</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> {{ $item->title }} </td>
                        <td>
                            <img src="{{ asset($item->image) }}" alt="" width="100">
                        </td>
                        <td>{{ $item->user->name }}
                        </td>
                        <td>
                            @if (!empty($item->category_news->name))
                                {{ $item->category_news->name }}
                            @endif
                        </td>
                        <td>{{ $item->status == 1 ? 'Hiện' : 'Ẩn' }}
                        </td>
                        <td>{{ $item->view }}
                        </td>
                        <td> {{ $item->created_at }} </td>
                        <td> <button type="button" class="btn btn-primary"><a style="color:white;  text-decoration: none;"
                                    href="{{ route('news.edit', ['id' => $item->id]) }}"> Sửa</a></button>
                            <button type="button" class="btn btn-danger"><a style="color:white;  text-decoration: none;"
                                 
                                    href="{{ route('news.remove', ['id' => $item->id]) }}"> Xóa</a></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
