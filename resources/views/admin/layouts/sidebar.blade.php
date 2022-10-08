<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 text-center ">
        {{-- @if (isset($_SESSION['AUTH']))
        <div class="image">
            <img src="{{ '/public/adminlte/'}}dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{$_SESSION['AUTH']['name']}}</a>
        </div>
        @else --}}
        {{-- <div class="image">
            <img src="{{ '/public/adminlte/'}}dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                alt="User Image">
        </div> --}}
        @if (Auth::user())
        <div class="info">
            <a href="" class="d-block">{{ Auth::user()->name }}</a>
        </div>
        @else
        <div class="info">
            <a href="" class="d-block">dang nhap</a>
        </div>
        @endif

        {{-- @endif --}}
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
                <a href="/admin" class="nav-link ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        {{-- <i class="right fas fa-angle-left"></i> --}}
                    </p>
                </a>

            </li>
            @can('list-user')

            <li class="nav-item {{ request()->is('admin/CompanyCar*') ? ' menu-is-opening menu-open' : '' }}">
                <a href="" class="nav-link {{ request()->is('admin/CompanyCar*') ? 'active ' : '' }}">
                    <i class="nav-icon fas fa-align-justify"></i>
                    <p>
                        Danh mục sản phẩm
                        <i class="fas fa-angle-left right"></i>

                        {{-- <span class="badge badge-info right">6</span> --}}
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('list-category')
                    <li class="nav-item">
                        <a href="/admin/CompanyCar"
                            class="nav-link {{ request()->is('admin/CompanyCar') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách</p>
                        </a>
                    </li>
                    @endcan
                    @can('add-category')
                    <li class="nav-item">
                        <a href="/admin/CompanyCar/add"
                            class="nav-link {{ request()->is('admin/CompanyCar/add') ? 'active' : '' }}">
                            <i class="fas fa-regular fa-plus nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('list-category')
            <li class="nav-item {{ request()->is('admin/product*') ? ' menu-is-opening menu-open' : '' }}">
                <a href="" class="nav-link {{ request()->is('admin/product*') ? 'active' : '' }}">
                    <i class="fas fa-regular fa-laptop nav-icon"></i>
                    <p>
                        Sản phẩm
                        <i class="fas fa-angle-left right"></i>
                        {{-- <span class="badge badge-info right">6</span> --}}
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('list-category')
                    <li class="nav-item">
                        <a href="/admin/product" class="nav-link {{ request()->is('admin/product') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách</p>
                        </a>
                    </li>
                    @endcan
                    @can('add-category')
                    <li class="nav-item">
                        <a href="/admin/product/add"
                            class="nav-link {{ request()->is('admin/product/add') ? 'active' : '' }}">
                            <i class="fas fa-regular fa-plus nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            <li class="nav-item active {{ request()->is('admin/dat-lich*') ? ' menu-is-opening menu-open' : '' }}">
                <a href="" class="nav-link {{ request()->is('admin/dat-lich*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                        Danh sách đặt lịch
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    @can('add-booking')
                    <li class="nav-item">
                        <a href="{{ route('dat-lich.add') }}"
                            class="nav-link {{ request()->is('admin/dat-lich/tao-moi') ? 'active' : '' }}">
                            <i class="fas fa-regular fa-plus nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                    @endcan
                    @can('list-booking')
                    <li class="nav-item">
                        <a href="{{ route('sua-chua.danh-sach-chua-xac-nhan') }}"
                            class="nav-link {{ request()->is('admin/dat-lich/danh-sach-chua-xac-nhan') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>DS máy đặt lịch</p>
                        </a>
                    </li>
                    @endcan
                    {{-- <li class="nav-item">
                        <a href="{{ route('dat-lich.user_epair') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>DS được phân công</p>
                        </a>
                    </li> --}}
                    @can('list-booking')
                    <li class="nav-item">
                        <a href="{{ route('sua-chua.danh-sach-cho-sua') }}"
                            class="nav-link {{ request()->is('admin/dat-lich/danh-sach-cho-sua') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>DS máy chờ sửa </p>
                        </a>
                    </li>
                    @endcan
                    @can('list-repair')
                    <li class="nav-item">
                        <a href="{{ route('sua-chua.danh-sach-da-sua-xong') }}"
                            class="nav-link {{ request()->is('admin/dat-lich/danh-sach-da-sua-xong') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>DS máy đã sửa xong</p>
                        </a>
                    </li>
                    @endcan
                    @can('edit-repair')
                    <li class="nav-item">
                        <a href="{{ route('dat-lich.user_epair') }}"
                            class="nav-link {{ request()->is('admin/dat-lich/user_epair') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>DS được phân công </p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>

            @can('list-category')
            
            {{-- <li class="nav-item {{ request()->is('admin/sua-chua*') ? ' menu-is-opening menu-open' : '' }}">
                <a href="" class="nav-link {{ request()->is('admin/sua-chua*') ? 'active ' : '' }}"> --}}

            <li class="nav-item {{ request()->is('admin/category_component*') ? ' menu-is-opening menu-open' : '' }}">
                <a href="" class="nav-link {{ request()->is('admin/category_component*') ? 'active ' : '' }}">
                    <i class="nav-icon fas fa-list-ul"></i>
                    <p>
                        Danh mục linh kiện sửa
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/admin/category_component"
                            class="nav-link {{ request()->is('admin/category_component') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách</p>
                        </a>
                    </li>
                    @can('add-category')
                    <li class="nav-item">
                        <a href="/admin/category_component/add"
                            class="nav-link {{ request()->is('admin/category_component/add') ? 'active' : '' }}">
                            <i class="fas fa-regular fa-plus nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                    @endcan

                </ul>

            </li>
            @endcan
            @can('list-product')
            <li class="nav-item {{ request()->is('admin/component*') ? ' menu-is-opening menu-open' : '' }}">
                <a href="" class="nav-link {{ request()->is('admin/component*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>
                        DS linh kiện sửa
                        <i class="fas fa-angle-left right"></i>
                        {{-- <span class="badge badge-info right">6</span> --}}
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('list-product')
                    <li class="nav-item">
                        <a href="/admin/component"
                            class="nav-link {{ request()->is('admin/component') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách</p>
                        </a>
                    </li>
                    @endcan
                    @can('add-product')
                    <li class="nav-item">
                        <a href="/admin/component/add"
                            class="nav-link {{ request()->is('admin/component/add') ? 'active' : '' }}">
                            <i class="fas fa-regular fa-plus nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('list-bill')
            <li class="nav-item {{ request()->is('admin/bill*') ? ' menu-is-opening menu-open' : '' }}">
                <a href="" class="nav-link {{ request()->is('admin/bill*') ? 'active ' : '' }}">
                    <i class="nav-icon fas fa-money-bill"></i>
                    <p>
                        Quản lý hóa đơn
                        <i class="fas fa-angle-left right"></i>
                        {{-- <span class="badge badge-info right">6</span> --}}
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('list-bill')
                    <li class="nav-item">
                        <a href="/admin/bill" class="nav-link {{ request()->is('admin/bill') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Đặt lịch</p>
                        </a>
                    </li>
                    @endcan

                    @can('list-bill')
                    <li class="nav-item">
                        <a href="/admin/bill/2" class="nav-link {{ request()->is('admin/bill/2') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Mua hàng</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan


            @can('list-user')
            <li class="nav-item {{ request()->is('admin/user*') ? ' menu-is-opening menu-open' : '' }}">
                <a href="" class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-regular fa-user"></i>
                    <p>
                        Tài khoản
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>

                <ul class="nav nav-treeview">
                    @can('list-user')
                    <li class="nav-item">
                        <a href="/admin/user" class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}">

                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách</p>
                        </a>
                    </li>
                    @endcan
                    @can('add-user')
                    <li class="nav-item">
                        <a href="/admin/user/add" class="nav-link {{ request()->is('user/add') ? 'active' : '' }}">
                            <i class="fas fa-regular fa-plus nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('list-role')
            <li class="nav-item {{ request()->is('admin/roles*') ? ' menu-is-opening menu-open' : '' }}">
                <a href="" class="nav-link {{ request()->is('admin/roles*') ? 'active ' : '' }}">
                    <i class="fas fa-user-tag nav-icon"></i>
                    <p>
                        Vai trò
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/admin/roles" class="nav-link {{ request()->is('admin/roles') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('list-news')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-money-check"></i>
                    <p>
                        Tin Tức
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Tin Tức
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/tin-tuc" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/tin-tuc/add" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm Mới</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Danh Mục
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/danh-muc-tin-tuc" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/danh-muc-tin-tuc/add" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm Mới</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>@endcan
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>