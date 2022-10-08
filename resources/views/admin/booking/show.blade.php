@extends('admin.layouts.main')
@section('content')
<div class="row">
  <div class="col">
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <h3 class="mb-0">Light table</h3>
      </div>
      <!-- Light table -->
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col" class="sort" data-sort="name">Họ tên</th>
              <th scope="col" class="sort" data-sort="budget">SDT</th>
              <th scope="col" class="sort" data-sort="status">Máy tính</th>
              <th scope="col">Kiểu sửa</th>
              <th scope="col" class="sort" data-sort="completion">Thời gian sửa</th>
              <th scope="col">Trạng thái</th>
              @can('add-booking')
              <th scope="col"><a href="{{ route('dat-lich.add') }}">Tạo mới</a></th>
              @endcan
            </tr>
          </thead>
          <tbody class="list">

            @foreach ($bookings as $b)
            <tr>
              <td>{{ $b->full_name }}</td>
              <td>{{ $b->phone }}</td>
              <td>{{ $b->company_car_id }}</td>
              <td>{{ $b->repair_type }}</td>
              <td>{{ $b->interval }}</td>
              <td>{{
                $b->active==1?'Đã xác nhận':'Chưa xác nhận' }}




              </td>
              <td><a name="" id="" class="btn btn-primary" href="{{ route('dat-lich.edit', ['id'=>$b->id]) }}"
                  role="button">Lễ tân: sửa</a></td>
              <td><a name="" id="" class="btn btn-danger" href="{{ route('dat-lich.delete', ['id'=>$b->id]) }}"
                  role="button">Xóa</a>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>





      <!-- Card footer -->
      <div class="card-footer py-4">
        <nav aria-label="...">
          <ul class="pagination justify-content-end mb-0">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1">
                <i class="fas fa-angle-left"></i>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">
                <i class="fas fa-angle-right"></i>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>

@endsection