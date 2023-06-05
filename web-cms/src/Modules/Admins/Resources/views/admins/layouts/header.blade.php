<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center fixed-top navbar-shadow navbar-light">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="#">
                        <i class="ficon" data-feather="menu"></i>
                    </a>
                </li>
            </ul>
            <!-- BEGIN: Notification slide -->
            <ul class="nav navbar-nav bookmark-icons navbar-news">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="ficon text-warning" data-feather="bell"></i>
                        <span class="ms-50"><b>Trần Quốc Nhựt</b> đã thêm người đảm nhiệm mới cho dự án Timevn</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END: Notification slide -->
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item nav-search">
                <a class="nav-link nav-link-search">
                    <i class="ficon" data-feather="search"></i>
                </a>
                <div class="search-input">
                    <div class="search-input-icon">
                        <i data-feather="search"></i>
                    </div>
                    <input class="form-control input" type="text" placeholder="Explore NxCloud..." tabindex="-1"
                        data-search="search">
                    <div class="search-input-close">
                        <i data-feather="x"></i>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-notification me-25">
                <a class="nav-link" href="#" data-bs-toggle="dropdown">
                    <i class="ficon" data-feather="bell"></i>
                    <span class="badge rounded-pill bg-danger badge-up">5</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                            <div class="badge rounded-pill badge-light-primary">1 New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        <a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar">
                                        <img src="../assets/images/avatars/avatar-6.jpg" alt="avatar" width="32"
                                            height="32">
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading">
                                        <span class="fw-bolder">Congratulation Sam 🎉</span>winner!
                                    </p>
                                    <small class="notification-text"> Won the monthly best seller badge.</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-menu-footer">
                        <a class="btn btn-primary w-100" href="{{ route('admin.notifications.index') }}">Read all
                            notifications</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">Vinh Tran</span>
                        <span class="user-status">Admin</span>
                    </div>
                    <span class="avatar">
                        <img class="round" src="../assets/images/avatars/avatar-4.jpg" alt="avatar" height="40"
                            width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                        <i class="me-50" data-feather="user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">
                        <i class="me-50" data-feather="power"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- END: Header-->
