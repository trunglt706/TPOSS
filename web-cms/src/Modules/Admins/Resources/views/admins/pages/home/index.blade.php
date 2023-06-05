@extends('admins::admins.layouts.main')
@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <!-- Stats Horizontal Card -->
            <div class="row">
                <a href="" class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="fw-bolder mb-0">10</h2>
                                <p class="card-text">Quản trị viên</p>
                            </div>
                            <div class="avatar bg-light-success p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa-solid fa-users-line font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="fw-bolder mb-0">10</h2>
                                <p class="card-text">Gói dịch vụ</p>
                            </div>
                            <div class="avatar bg-light-info p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa-solid fa-box font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="fw-bolder mb-0">10</h2>
                                <p class="card-text">Bài viết hướng dẫn</p>
                            </div>
                            <div class="avatar bg-light-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa-solid fa-book font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="fw-bolder mb-0">10</h2>
                                <p class="card-text">Đơn hàng</p>
                            </div>
                            <div class="avatar bg-light-danger p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa-solid fa-file font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="fw-bolder mb-0">10</h2>
                                <p class="card-text">Khách hàng</p>
                            </div>
                            <div class="avatar bg-light-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa-solid fa-user-group font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="fw-bolder mb-0">10</h2>
                                <p class="card-text">Khách hàng tiềm năng</p>
                            </div>
                            <div class="avatar bg-light-danger p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa-solid fa-user-plus font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="fw-bolder mb-0">10</h2>
                                <p class="card-text">Cửa hàng</p>
                            </div>
                            <div class="avatar bg-light-info p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa-solid fa-store font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="fw-bolder mb-0">10</h2>
                                <p class="card-text">Đăng ký mới</p>
                            </div>
                            <div class="avatar bg-light-success p-50 m-0">
                                <div class="avatar-content">
                                    <i class="fa-solid fa-pen-ruler font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!--/ Stats Horizontal Card -->

            <div class="row">
                <!-- Scatter Chart Starts -->
                <div class="col-xl-6 col-12">
                    <div class="card">
                        <div
                            class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                            <div>
                                <h4 class="card-title mb-25">Đăng ký mới</h4>
                                <span class="card-subtitle text-muted">Commercial networks & enterprises</span>
                            </div>
                            <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                                <h5 class="fw-bolder mb-0 me-1">
                                    <i class="text-danger font-small-3" data-feather="arrow-down"></i> 20
                                </h5>
                                <a href="" class="badge badge-light-secondary">
                                    Xem thêm
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="scatter-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- Scatter Chart Ends -->
                <!-- Line Chart Starts -->
                <div class="col-xl-6 col-12">
                    <div class="card">
                        <div
                            class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                            <div>
                                <h4 class="card-title mb-25">Doanh thu</h4>
                                <span class="card-subtitle text-muted">Commercial networks & enterprises</span>
                            </div>
                            <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                                <h5 class="fw-bolder mb-0 me-1">
                                    <i class="text-danger font-small-3" data-feather="arrow-down"></i> 100,000$
                                </h5>
                                <a class="badge badge-light-secondary">
                                    Xem thêm
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="line-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7 col-md-6 col-12">
                    <div class="card">
                        <div
                            class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                            <h4 class="card-title">Lịch sử hoạt động mới</h4>
                            <a href="" class="badge badge-light-secondary">
                                Xem thêm
                            </a>
                        </div>
                        <div class="card-body">
                            <ul class="timeline">
                                <li class="timeline-item">
                                    <span class="timeline-point">
                                        <i data-feather="dollar-sign"></i>
                                    </span>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>12 Invoices have been paid</h6>
                                            <span class="timeline-event-time">12 min ago</span>
                                        </div>
                                        <p>Invoices have been paid to the company.</p>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <span class="timeline-point">
                                        <i data-feather="dollar-sign"></i>
                                    </span>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>12 Invoices have been paid</h6>
                                            <span class="timeline-event-time">12 min ago</span>
                                        </div>
                                        <p>Invoices have been paid to the company.</p>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <span class="timeline-point">
                                        <i data-feather="dollar-sign"></i>
                                    </span>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>12 Invoices have been paid</h6>
                                            <span class="timeline-event-time">12 min ago</span>
                                        </div>
                                        <p>Invoices have been paid to the company.</p>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <span class="timeline-point">
                                        <i data-feather="dollar-sign"></i>
                                    </span>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>12 Invoices have been paid</h6>
                                            <span class="timeline-event-time">12 min ago</span>
                                        </div>
                                        <p>Invoices have been paid to the company.</p>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <span class="timeline-point">
                                        <i data-feather="dollar-sign"></i>
                                    </span>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>12 Invoices have been paid</h6>
                                            <span class="timeline-event-time">12 min ago</span>
                                        </div>
                                        <p>Invoices have been paid to the company.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-12">
                    <div class="card card-employee-task">
                        <div
                            class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                            <h4 class="card-title">Khách hàng tiềm năng mới</h4>
                            <a href="" class="badge badge-light-secondary">
                                Xem thêm
                            </a>
                        </div>
                        <div class="card-body pb-3">
                            <div class="employee-task d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-row">
                                    <div class="avatar me-75">
                                        <img src="../assets/images/avatars/avatar-1.jpg" class="rounded" width="42"
                                            height="42" alt="Avatar" />
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="mb-0">Ryan Harrington</h6>
                                        <small>iOS Developer</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted me-75">9hr 20m</small>
                                </div>
                            </div>
                            <div class="employee-task d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-row">
                                    <div class="avatar me-75">
                                        <img src="../assets/images/avatars/avatar-2.jpg" class="rounded" width="42"
                                            height="42" alt="Avatar" />
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="mb-0">Louisa Norton</h6>
                                        <small>UI Designer</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted me-75">4hr 17m</small>
                                </div>
                            </div>
                            <div class="employee-task d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-row">
                                    <div class="avatar me-75">
                                        <img src="../assets/images/avatars/avatar-3.jpg" class="rounded" width="42"
                                            height="42" alt="Avatar" />
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="mb-0">Jayden Duncan</h6>
                                        <small>Java Developer</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted me-75">12hr 8m</small>
                                </div>
                            </div>
                            <div class="employee-task d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-row">
                                    <div class="avatar me-75">
                                        <img src="../assets/images/avatars/avatar-4.jpg" class="rounded" width="42"
                                            height="42" alt="Avatar" />
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="mb-0">Cynthia Howell</h6>
                                        <small>Anguler Developer</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted me-75">3hr 19m</small>
                                </div>
                            </div>
                            <div class="employee-task d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-row">
                                    <div class="avatar me-75">
                                        <img src="../assets/images/avatars/avatar-5.jpg" class="rounded" width="42"
                                            height="42" alt="Avatar" />
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="mb-0">Helena Payne</h6>
                                        <small>Marketing</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted me-75">9hr 50m</small>
                                </div>
                            </div>
                            <div class="employee-task d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-row">
                                    <div class="avatar me-75">
                                        <img src="../assets/images/avatars/avatar-6.jpg" class="rounded" width="42"
                                            height="42" alt="Avatar" />
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="mb-0">Troy Jensen</h6>
                                        <small>iOS Developer</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted me-75">4hr 48m</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script src="{{ asset('js/chart-demo.js') }}"></script>
@endsection
