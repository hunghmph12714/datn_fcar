@extends('admin.layouts.main')
@section('title', 'Danh sách đặt lịch')
@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thông báo: </strong>{{ Session::get('success') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Thông báo: </strong>{{ Session::get('error') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{ route('bill.index') }}" method="GET" class="row">
        <div class="col-1"></div>
        <div class="form-group col-3">
            <input type="text" class="form-control" name="code" value="{{ isset($_GET['code']) ? $_GET['code'] : '' }}"
                id="" aria-describedby="helpId" placeholder="Tìm kiếm mã hóa đơn">
        </div>

        <div class="form-group col-3">
            <select name="status" class="form-control ">
                <option value="">Tất cả</option>
                <option value="Chờ xử lý">Chờ xử lý</option>
                <option value="Tiếp nhận máy">Tiếp nhận máy</option>
                <option value="Đang chờ sửa">Đang chờ sửa</option>
                <option value="Đang sửa">Đang sửa</option>
                <option value="Hoàn thành sửa">Hoàn thành sửa
                </option>
                <option value="Đã thanh toán">Đã thanh toán
                </option>
                <option value="Hủy">Hủy</option>
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <th>STT</th>
                        <th>Người mua</th>
                        <th>Mã hóa đơn</th>
                        <th>Tổng tiền</th>
                        {{-- <th>Thanh toán</th> --}}
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th>
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($bills as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->full_name }}</td>
                                @if ($item->booking_detail->code == null)
                                    <td></td>
                                @else
                                    <td>{{ $item->booking_detail->code }}</td>
                                @endif

                                @if ($item->booking_detail->list_bill == null)
                                    <td>0</td>
                                @else
                                    <td>
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
                                        {{ currency_format($item->booking_detail->list_bill->total_price) }}
                                    </td>
                                @endif

                                {{-- <td>tiền mặt</td> --}}

                                <td>
                                    @if ($item->booking_detail->status_booking == 'cancel')
                                        <p class="text-danger">Hủy</p>
                                    @elseif($item->booking_detail->status_booking == null)
                                        <p class="text-info">Chờ xử lý</p>
                                    @elseif($item->booking_detail->status_booking == 'latch')
                                    @if ($item->booking_detail->status_repair == null)
                                            <p class="text-info">Tiếp nhận máy</p>
                                        @elseif ($item->booking_detail->status_repair == 'waiting')
                                            <p class="text-info">Đang chờ sửa</p>
                                        @elseif($item->booking_detail->status_repair == 'fixing')
                                            <p class="text-info">Đang sửa</p>
                                        @elseif($item->booking_detail->status_repair == 'finish')
                                            @if (isset($item->booking_detail->list_bill->type) && $item->booking_detail->list_bill->type == 2)
                                                <p class="text-info">Đã thanh toán</p>
                                            @else
                                                <p class="text-info">Hoàn thành sửa</p>
                                            @endif
                                        @endif
                                    @elseif($item->booking_detail->status_booking == 'received')
                                        <p class="text-info">Tiếp nhận máy</p>
                                    @endif

                                </td>



                                <td>{{ $item->created_at }}</td>
                                {{-- {{dd($item)}} --}}
                                <td>
                                    @can('list-bill')
                                        {{-- @if ($item->booking_detail->status_booking == 'cancel')
                                            <a href="{{ route('dat-lich.hoa-don', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-success">Chi
                                                tiết hủy</a>
                                        @endif --}}
                                        {{-- @if ($item->booking_detail->status_booking == null)
                                            <a href="{{ route('dat-lich.hoa-don', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-success">Chi
                                                tiết chờ xử lý</a>
                                        @endif --}}
                                        
                                        {{-- @if ($item->booking_detail->status_repair == 'waiting')
                                            <a href="{{ route('dat-lich.hoa-don', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-success">Chi
                                                tiết chờ sửa</a>
                                        @endif --}}
                                        {{-- @if ($item->booking_detail->status_repair == 'fixing')
                                            <a href="{{ route('dat-lich.hoa-don', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-success">Chi
                                                tiết đang sửa</a>
                                        @endif --}}
                                        {{-- @if ($item->booking_detail->status_repair == 'finish' && !isset($item->booking_detail->list_bill->type))
                                            <a href="{{ route('dat-lich.hoa-don', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-success">Chi
                                                tiết đã sửa xong</a>
                                        @endif --}}
                                        @if ($item->booking_detail->status_repair == 'finish' && isset($item->booking_detail->list_bill->type))
                                            <a href="{{ route('dat-lich.hoa-don', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-success">Chi
                                                tiết hóa đơn</a>
                                        @endif
                                    @endcan
                                    @can('edit-bill')
                                        @if ($item->booking_detail->status_booking == null)
                                            <a href="{{ route('dat-lich.edit', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-warning">Sửa</a>
                                        @endif
                                    @endcan
                                    @can('delete-bill')
                                        <!-- <a class="text-secondary" data-toggle="modal" id="mediumButton"
                                                                                                data-target=".bd-example-modal-lg" data-attr="">
                                                                                                <i class="fas fa-edit text-gray-300"></i>
                                                                                            </a> -->
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4 class="text-center ">
                    @if ($bills == null)
                        Không có dữ liệu
                    @endif
                </h4>
                <div class="d-flex justify-content-center">
                    {{ $bills->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>


    <script>
        // display a modal (medium modal)
        $(document).on('click', '#mediumButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#largeModal').modal("show");
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>

@endsection
