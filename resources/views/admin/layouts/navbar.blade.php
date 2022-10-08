<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Trang chủ</a>
        </li> --}}
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/logout" class="nav-link">Đăng xuất</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge pending NotificationBadge"
                    id="NotificationBadge">{{Auth::user()->unreadNotifications()->count()}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;"  id="dropdown-notification">
                @foreach (Auth::user()->notifications as $notification)
                <a href="{{$notification->data['url']}}" @if($notification->unread()) style="background:#f8f9fa;" @endif class="dropdown-item">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            {{ $notification->data['title'] }}
                              
                            </h3>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{$notification->created_at->diffForHumans();}}
                            <span class="float-right text-sm text-primary"> @if($notification->unread())<i class="fa fa-circle" aria-hidden="true"></i>@endif</span>   
                        </p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>