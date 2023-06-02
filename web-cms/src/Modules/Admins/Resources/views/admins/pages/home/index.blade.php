@extends('admins::admins.layouts.main')
@section('style')
    <link rel="stylesheet" type="text/css" href="../assets/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/datatable/rowGroup.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/pickers/form-flat-pickr.css">

    <link rel="stylesheet" type="text/css" href="../assets/css/app-todo.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Dashboard</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.html">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">UI</a>
                                </li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-6 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="d-flex gap-50 justify-content-end sub-nav-list">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-grid">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-check-square me-1">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                    <span class="align-middle">Todo</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-message-square me-1">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                    <span class="align-middle">Chat</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail me-1">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <span class="align-middle">Email</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-calendar me-1">
                                        <rect x="3" y="4" width="18" height="18"
                                            rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span class="align-middle">Calendar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <!-- Dashboard Starts -->
            <section id="dashboard">
                <div class="row match-height">
                    <!-- Target Card -->
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="card card-congratulation-medal">
                            <div class="card-body">
                                <h4 class="card-title">Mục tiêu</h5>
                                    <div>
                                        <h6 class="text-warning">Test các chức năng của xCRM</h6>
                                        <div class="text-muted">16/05/2022 - 12:00:00</div>
                                        <div class="avatar-group mt-50">
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="bottom" title="" class="avatar pull-up"
                                                data-bs-original-title="Vinnie Mostowy">
                                                <img src="../assets/images/avatars/avatar-5.jpg" alt="Avatar"
                                                    height="30" width="30">
                                            </div>
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="bottom" title="" class="avatar pull-up"
                                                data-bs-original-title="Elicia Rieske">
                                                <img src="../assets/images/avatars/avatar-7.jpg" alt="Avatar"
                                                    height="30" width="30">
                                            </div>
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="bottom" title="" class="avatar pull-up"
                                                data-bs-original-title="Julee Rossignol">
                                                <img src="../assets/images/avatars/avatar-4.jpg" alt="Avatar"
                                                    height="30" width="30">
                                            </div>
                                        </div>
                                    </div>
                                    <img src="../assets/images/badge.svg" class="congratulation-medal" alt="Medal Pic" />
                            </div>
                        </div>
                    </div>
                    <!--/ Target Card -->
                    <!-- Overview Card -->
                    <div class="col-xl-8 col-md-6 col-12">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <h4 class="card-title">Tổng quan</h4>
                                <div class="d-flex align-items-center">
                                    <p class="card-text font-small-2 me-25 mb-0">Updated 1 hour ago</p>
                                </div>
                            </div>
                            <div class="card-body statistics-body">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar rounded-3 bg-light-primary me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="file-text" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">52/112</h4>
                                                <p class="card-text font-small-3 mb-0">Hóa đơn</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar rounded-3 bg-light-danger me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="check-square" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">10/33</h4>
                                                <p class="card-text font-small-3 mb-0">Mục tiêu</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar rounded-3 bg-light-success me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="box" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">7/7</h4>
                                                <p class="card-text font-small-3 mb-0">Dự án</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex flex-row">
                                            <div class="avatar rounded-3 bg-light-warning me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="star" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">19/28</h4>
                                                <p class="card-text font-small-3 mb-0">Nhiệm vụ</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Overview Card -->
                </div>
                <div class="row match-height">
                    <!-- Order Table Card -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Đơn hàng sắp giao</h4>
                                <div class="d-flex gap-50">
                                    <button type="button" class="btn btn-icon btn-outline-primary"><i
                                            data-feather="plus"></i></button>
                                    <button type="button" class="btn btn-icon btn-outline-warning"><i
                                            data-feather="file-text"></i></button>
                                    <button type="button" class="btn btn-icon btn-outline-secondary"><i
                                            data-feather="more-horizontal"></i></button>
                                </div>
                            </div>
                            <!--Search Form -->
                            <div class="card-body mt-2 d-none">
                                <form class="dt_adv_search" method="POST">
                                    <div class="row g-1 mb-md-1">
                                        <div class="col-md-3">
                                            <label class="form-label">Ngày tạo:</label>
                                            <div class="mb-0">
                                                <input type="text"
                                                    class="form-control dt-date flatpickr-range dt-input" data-column="1"
                                                    placeholder="StartDate to EndDate" data-column-index="0"
                                                    name="dt_date" />
                                                <input type="hidden" class="form-control dt-date start_date dt-input"
                                                    data-column="1" data-column-index="0" name="value_from_start_date" />
                                                <input type="hidden" class="form-control dt-date end_date dt-input"
                                                    name="value_from_end_date" data-column="1" data-column-index="0" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Ngày giao hàng:</label>
                                            <div class="mb-0">
                                                <input type="text"
                                                    class="form-control dt-date flatpickr-range dt-input" data-column="5"
                                                    placeholder="StartDate to EndDate" data-column-index="4"
                                                    name="dt_date" />
                                                <input type="hidden" class="form-control dt-date start_date dt-input"
                                                    data-column="5" data-column-index="4" name="value_from_start_date" />
                                                <input type="hidden" class="form-control dt-date end_date dt-input"
                                                    name="value_from_end_date" data-column="5" data-column-index="4" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Nhà cung cấp:</label>
                                            <input type="text" class="form-control dt-input" data-column="2"
                                                placeholder="Supplier" data-column-index="1" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Giá trị:</label>
                                            <input type="text" class="form-control dt-input" data-column="3"
                                                placeholder="10000" data-column-index="2" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <hr class="my-0 d-none" />
                            <!-- /Search form -->
                            <div class="card-datatable">
                                <table class="dt-advanced-search table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Ngày tạo</th>
                                            <th>Nhà cung cấp</th>
                                            <th>Giá trị</th>
                                            <th>Thuế</th>
                                            <th>Ngày giao hàng</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Ngày tạo</th>
                                            <th>Nhà cung cấp</th>
                                            <th>Giá trị</th>
                                            <th>Thuế</th>
                                            <th>Ngày giao hàng</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/ Order Table Card -->
                </div>
                <div class="row match-height">
                    <!-- Invoice Card -->
                    <div class="col-xxl-3 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Hóa đơn</div>
                                <div class="d-flex align-items-center">
                                    <p class="card-text font-small-2 me-25 mb-0">Updated 1 hour ago</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="invoice-report-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ Invoice Card -->
                    <!-- Contract Card -->
                    <div class="col-xxl-3 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Báo giá</div>
                                <div class="d-flex align-items-center">
                                    <p class="card-text font-small-2 me-25 mb-0">Updated 1 hour ago</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="contract-report-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ Contract Card -->
                    <!-- Project Card -->
                    <div class="col-xxl-3 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Dự án</div>
                                <div class="d-flex align-items-center">
                                    <p class="card-text font-small-2 me-25 mb-0">Updated 1 hour ago</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="project-report-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ Project Card -->
                    <!-- Todo Card -->
                    <div class="col-xxl-3 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Công việc</h4>
                                <div class="d-flex gap-50">
                                    <button type="button" class="btn btn-icon btn-outline-primary"
                                        data-bs-toggle="modal" data-bs-target="#new-task-modal"><i
                                            data-feather="plus"></i></button>
                                    <a href="#" type="button" class="btn btn-icon btn-outline-secondary"><i
                                            data-feather="list"></i></a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="todo-task-list-wrapper">
                                    <ul class="todo-task-list" id="todo-task-list">
                                        <li class="todo-item pe-2">
                                            <div class="todo-title-wrapper">
                                                <div class="todo-title-area">
                                                    <i data-feather="more-vertical" class="drag-icon"></i>
                                                    <div class="title-wrapper">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck1" />
                                                            <label class="form-check-label" for="customCheck1"></label>
                                                        </div>
                                                        <span class="todo-title">List out all the SEO resources and send it
                                                            to new xCRM </span>
                                                    </div>
                                                </div>
                                                <div class="todo-item-action">
                                                    <small class="text-nowrap text-muted">Jun 08, 15:30:55</small>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item pe-2">
                                            <div class="todo-title-wrapper">
                                                <div class="todo-title-area">
                                                    <i data-feather="more-vertical" class="drag-icon"></i>
                                                    <div class="title-wrapper">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck2" />
                                                            <label class="form-check-label" for="customCheck2"></label>
                                                        </div>
                                                        <span class="todo-title">Fix Responsiveness for new
                                                            structure</span>
                                                    </div>
                                                </div>
                                                <div class="todo-item-action">
                                                    <small class="text-nowrap text-muted">Jun 08, 15:30:55</small>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item pe-2 completed">
                                            <div class="todo-title-wrapper">
                                                <div class="todo-title-area">
                                                    <i data-feather="more-vertical" class="drag-icon"></i>
                                                    <div class="title-wrapper">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck3" checked />
                                                            <label class="form-check-label" for="customCheck3"></label>
                                                        </div>
                                                        <span class="todo-title">Thực hiện bảng testcase, Kiểm tra các chức
                                                            năng nxPOS</span>
                                                    </div>
                                                </div>
                                                <div class="todo-item-action">
                                                    <small class="text-nowrap text-muted">Jun 08, 15:30:55</small>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item pe-2 completed">
                                            <div class="todo-title-wrapper">
                                                <div class="todo-title-area">
                                                    <i data-feather="more-vertical" class="drag-icon"></i>
                                                    <div class="title-wrapper">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck4" checked />
                                                            <label class="form-check-label" for="customCheck4"></label>
                                                        </div>
                                                        <span class="todo-title">Lorem ipsum dolor sit amet consectetur
                                                            adipiscing elit.</span>
                                                    </div>
                                                </div>
                                                <div class="todo-item-action">
                                                    <small class="text-nowrap text-muted">Jun 08, 15:30:55</small>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item pe-2">
                                            <div class="todo-title-wrapper">
                                                <div class="todo-title-area">
                                                    <i data-feather="more-vertical" class="drag-icon"></i>
                                                    <div class="title-wrapper">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck5" />
                                                            <label class="form-check-label" for="customCheck5"></label>
                                                        </div>
                                                        <span class="todo-title">Fix Responsiveness for new
                                                            structure</span>
                                                    </div>
                                                </div>
                                                <div class="todo-item-action">
                                                    <small class="text-nowrap text-muted">Jun 08, 15:30:55</small>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Right Sidebar starts -->
                        <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
                            <div class="modal-dialog sidebar-lg">
                                <div class="modal-content p-0">
                                    <form id="form-modal-todo" class="todo-modal needs-validation" novalidate
                                        onsubmit="return false">
                                        <div class="modal-header align-items-center mb-1">
                                            <h5 class="modal-title">Add Task</h5>
                                            <div class="todo-item-action ms-auto">
                                                <i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal"
                                                    stroke-width="3"></i>
                                            </div>
                                        </div>
                                        <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                            <div class="action-tags">
                                                <div class="mb-1">
                                                    <label for="todoTitleAdd" class="form-label">Title</label>
                                                    <input type="text" id="todoTitleAdd" name="todoTitleAdd"
                                                        class="new-todo-item-title form-control" placeholder="Title" />
                                                </div>
                                                <div class="mb-1 position-relative">
                                                    <label for="task-assigned" class="form-label d-block">Assignee</label>
                                                    <select class="select2 form-select" id="task-assigned"
                                                        name="task-assigned">
                                                        <option data-img="../assets/images/avatars/avatar-3.jpg"
                                                            value="Phill Buffer" selected>
                                                            Phill Buffer
                                                        </option>
                                                        <option data-img="../assets/images/avatars/avatar-1.jpg"
                                                            value="Chandler Bing">
                                                            Chandler Bing
                                                        </option>
                                                        <option data-img="../assets/images/avatars/avatar-4.jpg"
                                                            value="Ross Geller">
                                                            Ross Geller
                                                        </option>
                                                        <option data-img="../assets/images/avatars/avatar-6.jpg"
                                                            value="Monica Geller">
                                                            Monica Geller
                                                        </option>
                                                        <option data-img="../assets/images/avatars/avatar-2.jpg"
                                                            value="Joey Tribbiani">
                                                            Joey Tribbiani
                                                        </option>
                                                        <option data-img="../assets/images/avatars/avatar-5.jpg"
                                                            value="Rachel Green">
                                                            Rachel Green
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <label for="task-due-date" class="form-label">Due Date</label>
                                                    <input type="text" class="form-control task-due-date"
                                                        id="task-due-date" name="task-due-date" />
                                                </div>
                                                <div class="mb-1">
                                                    <label for="task-tag" class="form-label d-block">Tag</label>
                                                    <select class="form-select task-tag" id="task-tag" name="task-tag"
                                                        multiple="multiple">
                                                        <option value="Team">Team</option>
                                                        <option value="Low">Low</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="High">High</option>
                                                        <option value="Update">Update</option>
                                                    </select>
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" placeholder="Write Your Description"></textarea>
                                                </div>
                                            </div>
                                            <div class="my-1">
                                                <!-- Add Task -->
                                                <button type="submit" class="btn btn-primary me-1">Add</button>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <!-- Update Task -->
                                                <button type="button" class="btn btn-primary d-none me-1">Update</button>
                                                <button type="button" class="btn btn-outline-danger d-none"
                                                    data-bs-dismiss="modal">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Right Sidebar ends -->

                    </div>
                    <!--/ Todo Card -->
                </div>
                <div class="row match-height">
                    <div class="col-lg-4 col-12">
                        <div class="row match-height">
                            <!-- Bar Chart - Orders -->
                            <div class="col-lg-6 col-md-3 col-6">
                                <div class="card">
                                    <div class="card-body pb-50">
                                        <h6>Đơn hàng</h6>
                                        <h2 class="fw-bolder mb-1">2,76k</h2>
                                        <div id="statistics-order-chart"></div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Bar Chart - Orders -->
                            <!-- Line Chart - Profit -->
                            <div class="col-lg-6 col-md-3 col-6">
                                <div class="card card-tiny-line-stats">
                                    <div class="card-body pb-50">
                                        <h6>Lợi nhuận</h6>
                                        <h2 class="fw-bolder mb-1">$6,24k</h2>
                                        <div id="statistics-profit-chart"></div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Line Chart - Profit -->
                            <!-- Earnings Card -->
                            <div class="col-lg-12 col-md-6 col-12">
                                <div class="card earnings-card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <h4 class="card-title mb-1">Thu nhập</h4>
                                                <div class="font-small-2">Tháng 6/2022</div>
                                                <h5 class="mb-1">$455.56</h5>
                                                <p class="card-text text-secondary font-small-2">
                                                    <span>Thu nhập nhiều hơn <span class="fw-bolder">68.2%</span> so với
                                                        tháng trước.</span>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <div id="earnings-chart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Earnings Card -->
                        </div>
                    </div>
                    <!-- Revenue Report Card -->
                    <div class="col-lg-8 col-12">
                        <div class="card card-revenue-budget">
                            <div class="row mx-0">
                                <div class="col-md-8 col-12 revenue-report-wrapper">
                                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title mb-50 mb-sm-0">Báo cáo thu chi</h4>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center me-2">
                                                <span
                                                    class="bullet bullet-primary font-small-3 me-50 cursor-pointer"></span>
                                                <span>Doanh thu</span>
                                            </div>
                                            <div class="d-flex align-items-center ms-75">
                                                <span
                                                    class="bullet bullet-warning font-small-3 me-50 cursor-pointer"></span>
                                                <span>Chi phí</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="revenue-report-chart"></div>
                                </div>
                                <div class="col-md-4 col-12 budget-wrapper">
                                    <div class="btn-group">
                                        <button type="button"
                                            class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 2022
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">2021</a>
                                            <a class="dropdown-item" href="#">2020</a>
                                            <a class="dropdown-item" href="#">2019</a>
                                        </div>
                                    </div>
                                    <h2 class="mb-25">$25,852</h2>
                                    <div class="d-flex justify-content-center">
                                        <span class="fw-bolder me-25">Budget:</span>
                                        <span>56,800</span>
                                    </div>
                                    <div id="budget-chart"></div>
                                    <button type="button" class="btn btn-primary">Điều chỉnh</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Revenue Report Card -->
                </div>
            </section>
            <!-- Dashboard ends -->
        </div>

    </div>
@endsection

@section('script')
    <script src="../assets/datatable/jquery.dataTables.min.js"></script>
    <script src="../assets/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/datatable/dataTables.responsive.min.js"></script>
    <script src="../assets/datatable/responsive.bootstrap5.min.js"></script>
    <script src="../assets/datatable/datatables.checkboxes.min.js"></script>
    <script src="../assets/datatable/datatables.buttons.min.js"></script>
    <script src="../assets/datatable/jszip.min.js"></script>
    <script src="../assets/datatable/pdfmake.min.js"></script>
    <script src="../assets/datatable/vfs_fonts.js"></script>
    <script src="../assets/datatable/buttons.html5.min.js"></script>
    <script src="../assets/datatable/buttons.print.min.js"></script>
    <script src="../assets/datatable/dataTables.rowGroup.min.js"></script>
    <script src="../assets/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="../assets/js/dragula.min.js"></script>
    <script src="../assets/js/select2.full.min.js"></script>
    <script src="../dashboard-demo.js"></script>
@endsection
