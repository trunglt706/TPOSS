@extends('admins::admins.layouts.main')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatable/rowGroup.bootstrap5.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.html">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Admins</a>
                                </li>
                                <li class="breadcrumb-item active">Danh sách</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-6 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="d-flex gap-50 justify-content-end sub-nav-list">
                        <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light">
                            Danh mục
                        </button>
                        <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light">
                            Nhật ký
                        </button>
                        <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light">
                            Quyền
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="me-50" data-feather="user"></i> Danh sách quản trị viên
                            </h4>
                        </div>
                        <div class="card-body">
                            {!! $html->table(['class' => 'table table-bordered'], true) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    {!! $html->scripts() !!}

    <script src="{{ asset('assets/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/dataTables.rowGroup.min.js') }}"></script>
@endsection
