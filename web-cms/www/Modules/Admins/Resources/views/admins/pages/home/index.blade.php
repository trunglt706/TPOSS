@extends('admins::admins.layouts.main')
@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <!-- Stats Horizontal Card -->
            <div class="home-header"></div>
            <!--/ Stats Horizontal Card -->

            <div class="row">
                <!-- Scatter Chart Starts -->
                <div class="col-xl-6 col-12">
                    <div class="card">
                        <div
                            class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                            <div>
                                <h4 class="card-title mb-25">{{ __('dashboard_register') }}</h4>
                                <span class="card-subtitle text-muted">{{ __('dashboard_register_this_month') }}</span>
                            </div>
                            <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                                <h5 class="fw-bolder mb-0 me-1">
                                    {{-- <i class="text-danger font-small-3" data-feather="arrow-down"></i> --}}
                                    0
                                </h5>
                                <a href="{{ route('admin.register_usings.index') }}" class="badge badge-light-secondary">
                                    {{ __('btn_view_more') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="register_usings-chart"></div>
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
                                <h4 class="card-title mb-25">{{ __('dashboard_revenue') }}</h4>
                                <span class="card-subtitle text-muted">{{ __('dashboard_revenue_this_month') }}</span>
                            </div>
                            <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                                <h5 class="fw-bolder mb-0 me-1">
                                    {{-- <i class="text-danger font-small-3" data-feather="arrow-down"></i>  --}}
                                    0 {{ get_option('currency-default', 'vnd') }}
                                </h5>
                                <a href="{{ route('admin.report.revenue') }}" class="badge badge-light-secondary">
                                    {{ __('btn_view_more') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="revenue-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7 col-md-6 col-12">
                    <div class="card">
                        <div
                            class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                            <h4 class="card-title">{{ __('dashboard_activity_lasted') }}</h4>
                            <a href="{{ route('admin.activities.index') }}" class="badge badge-light-secondary">
                                {{ __('btn_view_more') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <ul class="timeline">
                                {{-- start item --}}
                                <li class="timeline-item">
                                    <span class="timeline-point">
                                        <i data-feather="dollar-sign"></i>
                                    </span>
                                    <div class="timeline-event">
                                        <a href="{{ route('admin.activities.detail', ['id' => 1]) }}"
                                            class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>12 Invoices have been paid</h6>
                                            <span class="timeline-event-time">12 min ago</span>
                                        </a>
                                        <p>Invoices have been paid to the company.</p>
                                    </div>
                                </li>
                                {{-- end item --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-12">
                    <div class="card card-employee-task">
                        <div
                            class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                            <h4 class="card-title">{{ __('dashboard_lead_lasted') }}</h4>
                            <a href="{{ route('admin.admin_leads.index') }}" class="badge badge-light-secondary">
                                {{ __('btn_view_more') }}
                            </a>
                        </div>
                        <div class="card-body pb-3">
                            {{-- start item --}}
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
                            {{-- end item --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    @include('admins::admins.pages.home.script')
@endsection